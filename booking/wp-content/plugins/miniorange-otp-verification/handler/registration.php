<?php

class MoRegistrationHandler
{
	function __construct()
	{
		add_action( 'admin_init',  array( $this, 'handle_customer_registration' ) );
	}

	function handle_customer_registration()
	{
		if ( !current_user_can( 'manage_options' )) return;
		if(!isset($_POST['option'])) return;
		$option = trim($_POST['option']);
		switch($option)
		{
			case "mo_registration_register_customer":
				$this->_register_customer($_POST);											   			break;
			case "mo_registration_connect_verify_customer":
				$this->_verify_customer($_POST);													   	break;
			case "mo_registration_validate_otp":
				$this->_validate_otp($_POST);														   	break;
			case "mo_registration_resend_otp":
				$this->_send_otp_token(get_mo_option('mo_customer_validation_admin_email'),"",'EMAIL');  	break;
			case "mo_registration_phone_verification":
				$this->_send_phone_otp_token($_POST);												   	break;
			case "mo_registration_go_back":
				$this->_revert_back_registration();												   		break;
			case "mo_registration_forgot_password":
				$this->_reset_password();															   	break;
		}
	}

	function _register_customer($post)
	{
		$email 			 = sanitize_email( $_POST['email'] );
		$company 		 = sanitize_text_field($_POST['company']);
		$first_name 	 = sanitize_text_field($_POST['fname']);
		$last_name 		 = sanitize_text_field($_POST['lname']);
		$phone 			 = sanitize_text_field( $_POST['phone'] );
		$password 		 = sanitize_text_field( $_POST['password'] );
		$confirmPassword = sanitize_text_field( $_POST['confirmPassword'] );

		if( strlen( $password ) < 6 || strlen( $confirmPassword ) < 6)
		{
			do_action('mo_registration_show_message',MoMessages::showMessage('PASS_LENGTH'),'ERROR');
			return;
		}

		if( $password != $confirmPassword )
		{
			delete_mo_option('mo_customer_validation_verify_customer');
			do_action('mo_registration_show_message',MoMessages::showMessage('PASS_MISMATCH'),'ERROR');
			return;
		}

		if( MoUtility::isBlank( $email ) || MoUtility::isBlank( $password )
				|| MoUtility::isBlank( $confirmPassword ) )
		{
			do_action('mo_registration_show_message',MoMessages::showMessage('REQUIRED_FIELDS'),'ERROR');
			return;
		}

		update_mo_option( 'mo_customer_validation_company_name'		, $company);
		update_mo_option( 'mo_customer_validation_first_name'		, $first_name);
		update_mo_option( 'mo_customer_validation_last_name'		, $last_name);
		update_mo_option( 'mo_customer_validation_admin_email'		, $email );
		update_mo_option( 'mo_customer_validation_admin_phone'		, $phone );
		update_mo_option( 'mo_customer_validation_admin_password'	, $password );

		$content  = json_decode(MocURLOTP::check_customer($email), true);
		switch ($content['status'])
		{
			case 'CUSTOMER_NOT_FOUND':
				$this->_send_otp_token($email,"",'EMAIL');
				break;
			default:
				$this->_get_current_customer($email,$password);
				break;
		}

	}

	function _send_otp_token($email,$phone,$auth_type)
	{
		$content  = json_decode(MocURLOTP::mo_send_otp_token($auth_type,$email,$phone), true);
		if(strcasecmp($content['status'], 'SUCCESS') == 0)
		{
			update_mo_option('mo_customer_validation_transactionId',$content['txId']);
			update_mo_option('mo_customer_validation_registration_status','MO_OTP_DELIVERED_SUCCESS');
			if($auth_type=='EMAIL')
				do_action('mo_registration_show_message', MoMessages::showMessage('OTP_SENT',array('method'=>$email)),'SUCCESS');
			else
				do_action('mo_registration_show_message', MoMessages::showMessage('OTP_SENT',array('method'=>$phone)),'SUCCESS');
		}
		else
		{
			update_mo_option('mo_customer_validation_registration_status','MO_OTP_DELIVERED_FAILURE');
			do_action('mo_registration_show_message', MoMessages::showMessage('ERR_OTP'),'ERROR');
		}
	}

	//Function to get customer details
	function _get_current_customer($email,$password)
	{
		$content     = MocURLOTP::get_customer_key($email,$password);
		$customerKey = json_decode($content, true);
		if(json_last_error() == JSON_ERROR_NONE)
		{
			update_mo_option('mo_customer_validation_admin_email', $email );
			update_mo_option( 'mo_customer_validation_admin_phone', $customerKey['phone'] );
			$this->save_success_customer_config($customerKey['id'], $customerKey['apiKey'], $customerKey['token'], $customerKey['appSecret']);
			MoUtility::_handle_mo_check_ln(false,$customerKey['id'], $customerKey['apiKey']);
			do_action('mo_registration_show_message', MoMessages::showMessage('REG_SUCCESS'),'SUCCESS');
		}
		else
		{
			update_mo_option('mo_customer_validation_verify_customer', 'true');
			delete_mo_option('mo_customer_validation_new_registration');
			do_action('mo_registration_show_message', MoMessages::showMessage('ACCOUNT_EXISTS'),'ERROR');
		}
	}

	//Save all required fields on customer registration/retrieval complete.
	function save_success_customer_config($id, $apiKey, $token, $appSecret)
	{
		update_mo_option( 'mo_customer_validation_admin_customer_key'   , $id 		);
		update_mo_option( 'mo_customer_validation_admin_api_key'       	, $apiKey   );
		update_mo_option( 'mo_customer_validation_customer_token'		, $token 	);
		delete_mo_option( 'mo_customer_validation_verify_customer'				  	);
		delete_mo_option( 'mo_customer_validation_new_registration'				  	);
		delete_mo_option( 'mo_customer_validation_admin_password'					);
	}

	//Function to validate OTP
	function _validate_otp($post)
	{
		$otp_token 		 = sanitize_text_field( $post['otp_token'] );
		$email 			 = get_mo_option( 'mo_customer_validation_admin_email');
		$company 		 = get_mo_option( 'mo_customer_validation_company_name');
		$first_name 	 = get_mo_option( 'mo_customer_validation_first_name');
		$last_name 		 = get_mo_option( 'mo_customer_validation_last_name');
		$phone 			 = get_mo_option( 'mo_customer_validation_admin_phone');
		$password 		 = get_mo_option( 'mo_customer_validation_admin_password');

		if( MoUtility::isBlank( $otp_token ) )
		{
			update_mo_option('mo_customer_validation_registration_status','MO_OTP_VALIDATION_FAILURE');
			do_action('mo_registration_show_message', MoMessages::showMessage('REQUIRED_OTP'),'ERROR');
			return;
		}

		$content = json_decode(MocURLOTP::validate_otp_token(get_mo_option('mo_customer_validation_transactionId'), $otp_token ),true);
		if(strcasecmp($content['status'], 'SUCCESS') == 0)
		{
			$customerKey = json_decode(MocURLOTP::create_customer($email, $company, $password, $phone = '', $first_name = '', $last_name = ''), true);
			if(strcasecmp($customerKey['status'], 'CUSTOMER_USERNAME_ALREADY_EXISTS') == 0)
			{
				$this->_get_current_customer($email,$password);
			}
			else if(strcasecmp($customerKey['status'], 'SUCCESS') == 0)
			{
				$this->save_success_customer_config($customerKey['id'], $customerKey['apiKey'], $customerKey['token'], $customerKey['appSecret']);
				update_mo_option('mo_customer_validation_registration_status','MO_CUSTOMER_VALIDATION_REGISTRATION_COMPLETE');
				update_mo_option('mo_customer_email_transactions_remaining',MoConstants::EMAIL_TRANS_REMAINING);
				update_mo_option('mo_customer_phone_transactions_remaining',MoConstants::PHONE_TRANS_REMAINING);
				do_action('mo_registration_show_message', MoMessages::showMessage('REG_COMPLETE'),'SUCCESS');
				header('Location: admin.php?page=pricing');
			}
		}
		else
		{
			update_mo_option('mo_customer_validation_registration_status','MO_OTP_VALIDATION_FAILURE');
			do_action('mo_registration_show_message', MoUtility::_get_invalid_otp_method() ,'ERROR');
		}
	}

	//Function to send otp token to phone
	function _send_phone_otp_token($post)
	{
		$phone = sanitize_text_field($_POST['phone_number']);
		$phone = str_replace(' ', '', $phone);
		$pattern = "/[\+][0-9]{1,3}[0-9]{10}/";
		if(preg_match($pattern, $phone, $matches, PREG_OFFSET_CAPTURE))
		{
			update_mo_option('mo_customer_validation_admin_phone',$phone);
			$this->_send_otp_token("",$phone,'SMS');
		}
		else
		{
			update_mo_option('mo_customer_validation_registration_status','MO_OTP_DELIVERED_FAILURE');
			do_action('mo_registration_show_message', MoMessages::showMessage('INVALID_SMS_OTP'),'ERROR');
		}
	}

	//Function to verify customer
	function _verify_customer($post)
	{
		$email 	  = sanitize_email( $post['email'] );
		$password = sanitize_text_field( $post['password'] );

		if( MoUtility::isBlank( $email ) || MoUtility::isBlank( $password ) )
		{
			do_action('mo_registration_show_message', MoMessages::showMessage('REQUIRED_FIELDS'),'ERROR');
			return;
		}
		$this->_get_current_customer($email,$password);
	}

	//Function to reset customer's password
	function _reset_password()
	{
		$email 	  = get_mo_option('mo_customer_validation_admin_email');
		$forgot_password_response = json_decode(MocURLOTP::forgot_password($email));
		if($forgot_password_response->status == 'SUCCESS')
			do_action('mo_registration_show_message', MoMessages::showMessage('RESET_PASS'),'SUCCESS');
		else 
			do_action('mo_registration_show_message',MoMessages::showMessage('UNKNOWN_ERROR'),'ERROR');
	}

	// Incase of an error delete all option values to revert back 
	// the registration.
	function _revert_back_registration()
	{
		update_mo_option('mo_customer_validation_registration_status','');
		delete_mo_option('mo_customer_validation_new_registration');
		delete_mo_option('mo_customer_validation_verify_customer' ) ;
		delete_mo_option('mo_customer_validation_admin_email');
		delete_mo_option('mo_customer_validation_sms_otp_count');
		delete_mo_option('mo_customer_validation_email_otp_count');
	}
}
new MoRegistrationHandler;