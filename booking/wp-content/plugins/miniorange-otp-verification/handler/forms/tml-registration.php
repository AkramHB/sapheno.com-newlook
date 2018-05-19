<?php

	class TmlRegistrationForm extends FormInterface
	{

		private $formSessionVar = FormSessionVars::TML_REG;
		private $phoneFormID 	= '#phone_number_mo';
		private $otpType;

		const TYPE_PHONE 		= 'mo_tml_phone_enable';
		const TYPE_EMAIL 		= 'mo_tml_email_enable';
		const TYPE_BOTH 		= 'mo_tml_both_enable';

		function handleForm()
		{
			$this->otpType = get_mo_option('mo_customer_validation_tml_enable_type');

			add_action( 'register_form', array($this,'miniorange_tml_register_form'));
			add_filter( 'registration_errors',  array($this,'miniorange_tml_registration_errors'), 1, 3 );
			add_action( 'admin_post_nopriv_validation_goBack',  array($this,'_handle_validation_goBack_action'));
			add_action( 'user_register',  array($this,'miniorange_tml_registration_save'), 10, 1 );
		}

		public static function isFormEnabled()
		{
			return get_mo_option('mo_customer_validation_tml_enable') ? true : false;
		}

		function isPhoneVerificationEnabled()
		{
			return (strcasecmp($this->otpType,self::TYPE_PHONE)==0 || strcasecmp($this->otpType,self::TYPE_BOTH)==0);
		}

		function miniorange_tml_register_form()
		{	
	 		echo '<input type="hidden" name="register_tml_nonce" value="register_tml_nonce"/>';
	 		if($this->isPhoneVerificationEnabled())
	 			echo '<label for="phone_number_mo">'.mo_("Phone Number").'<br />
					  <input type="text" name="phone_number_mo" id="phone_number_mo" class="input" value="" style=""  /></label>';
		}

		function miniorange_tml_registration_save($user_id)
		{
			if (isset( $_SESSION['phone_number_mo'] ) ) add_user_meta($user_id, 'telephone', $_SESSION['phone_number_mo']);
		}

		function miniorange_tml_registration_errors($errors, $sanitized_user_login, $user_email )
		{
			MoUtility::checkSession();

			$phone_number = isset($_POST['phone_number_mo'])? $_POST['phone_number_mo'] : null;
			if($this->isPhoneVerificationEnabled() && MoUtility::validatePhoneNumber($phone_number))
				$this->startOTPTransaction($sanitized_user_login,$user_email,$errors,$phone_number);
			elseif($this->otpType == self::TYPE_EMAIL)
				$this->startOTPTransaction($sanitized_user_login,$user_email,$errors,$phone_number);
			else
				$errors->add( 'invalid_phone', MoMessages::showMessage('ENTER_PHONE_DEFAULT') );
			return $errors;
		}

		function startOTPTransaction($sanitized_user_login,$user_email,$errors,$phone_number)
		{
			if(!MoUtility::isBlank(array_filter($errors->errors)) || !isset($_POST['register_tml_nonce'])) return;

			if(array_key_exists($this->formSessionVar, $_SESSION) && $_SESSION[$this->formSessionVar]=='validated') return;

			MoUtility::initialize_transaction($this->formSessionVar);
			if(strcasecmp($this->otpType,self::TYPE_PHONE)==0)
				miniorange_site_challenge_otp($sanitized_user_login,$user_email,$errors,$phone_number,"phone");
			else if(strcasecmp($this->otpType,self::TYPE_BOTH)==0)
				miniorange_site_challenge_otp($sanitized_user_login,$user_email,$errors,$phone_number,"both");
			else
				miniorange_site_challenge_otp($sanitized_user_login,$user_email,$errors,$phone_number,"email");
		}

		function handle_failed_verification($user_login,$user_email,$phone_number)
		{
			MoUtility::checkSession();
			if(!isset($_SESSION[$this->formSessionVar])) return;
			$otpVerType = strcasecmp($this->otpType,self::TYPE_PHONE)==0 ? "phone" 
							: (strcasecmp($this->otpType,self::TYPE_BOTH)==0 ? "both" : "email" );
			$fromBoth = strcasecmp($otpVerType,"both")==0 ? TRUE : FALSE;
			miniorange_site_otp_validation_form($user_login,$user_email,$phone_number,MoUtility::_get_invalid_otp_method(),$otpVerType,$fromBoth);
		}

		function handle_post_verification($redirect_to,$user_login,$user_email,$password,$phone_number,$extra_data)
		{
			MoUtility::checkSession();
			if(!isset($_SESSION[$this->formSessionVar])) return;
			$_SESSION[$this->formSessionVar] = 'validated';
			$errors = register_new_user($user_login, $user_email);
			$this->unsetOTPSessionVariables();
			if ( !is_wp_error($errors) ) {
				$redirect_to = !MoUtility::isBlank( $redirect_to ) ? $redirect_to :  wp_login_url()."?checkemail=registered";
				wp_redirect( $redirect_to );
				exit();
			}
		}

		public function unsetOTPSessionVariables()
		{
			unset($_SESSION[$this->txSessionId]);
			unset($_SESSION[$this->formSessionVar]);
		}

		public function is_ajax_form_in_play($isAjax)
		{
			MoUtility::checkSession();
			return isset($_SESSION[$this->formSessionVar]) ? FALSE : $isAjax;
		}

		public function getPhoneNumberSelector($selector)	
		{
			MoUtility::checkSession();
			if(self::isFormEnabled() && $this->isPhoneVerificationEnabled()) array_push($selector, $this->phoneFormID); 
			return $selector;
		}

		function handleFormOptions()
	    {
	    	if(!MoUtility::areFormOptionsBeingSaved()) return;

			update_mo_option('mo_customer_validation_tml_enable',
				isset( $_POST['mo_customer_validation_tml_enable']) ? $_POST['mo_customer_validation_tml_enable'] : 0);
			update_mo_option('mo_customer_validation_tml_enable_type',
				isset( $_POST['mo_customer_validation_tml_enable_type']) ? $_POST['mo_customer_validation_tml_enable_type'] : 0);
	    }
	}
	new TmlRegistrationForm;