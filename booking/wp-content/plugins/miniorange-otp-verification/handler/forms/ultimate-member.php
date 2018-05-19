<?php

	class UltimateMemberRegistrationForm extends FormInterface
	{
		private $formSessionVar = FormSessionVars::UM_DEFAULT_REG;
		private $phoneFormID 	= "input[name^='mobile_number']";
		private $otpType;

		const TYPE_PHONE 		= 'mo_um_phone_enable';
		const TYPE_EMAIL 		= 'mo_um_email_enable';
		const TYPE_BOTH 		= 'mo_um_both_enable';

		function handleForm()
		{
			$this->otpType = get_mo_option('mo_customer_validation_um_enable_type');
			add_action( 'um_submit_form_errors_hook_', array($this,'miniorange_um_phone_validation'), 99,1);
			add_action( 'um_before_new_user_register', array($this,'miniorange_um_user_registration'), 99,1);
		}

		public static function isFormEnabled() 
		{
			return get_mo_option('mo_customer_validation_um_default_enable') ? true : false;
		}

		function isPhoneVerificationEnabled()
		{
			return (strcasecmp($this->otpType,self::TYPE_PHONE)==0 || strcasecmp($this->otpType,self::TYPE_BOTH)==0);
		}

		function miniorange_um_user_registration($args)
		{
			MoUtility::checkSession();
			$errors = new WP_Error();
			MoUtility::initialize_transaction($this->formSessionVar);
			foreach ($args as $key => $value)
			{
				if($key=="user_login")
					$username = $value;
				elseif ($key=="user_email")
					$email = $value;
				elseif ($key=="user_password")
					$password = $value;
				elseif ($key == 'mobile_number')
					$phone_number = $value;
				else
					$extra_data[$key]=$value;
			}
			$this->startOtpTransaction($username,$email,$errors,$phone_number,$password,$extra_data);
		}

		function startOtpTransaction($username,$email,$errors,$phone_number,$password,$extra_data)
		{
			if(strcasecmp($this->otpType,self::TYPE_PHONE)==0)
				miniorange_site_challenge_otp($username,$email,$errors,$phone_number,"phone",$password,$extra_data);
			elseif(strcasecmp($this->otpType,self::TYPE_BOTH)==0)
				miniorange_site_challenge_otp($username,$email,$errors,$phone_number,"both",$password,$extra_data);
			else
				miniorange_site_challenge_otp($username,$email,$errors,$phone_number,"email",$password,$extra_data);
		}

		function miniorange_um_phone_validation($args)
		{
			global $ultimatemember,$phoneLogic;
			foreach ($args as $key => $value) 
				if ($key == 'mobile_number')
					if(!MoUtility::validatePhoneNumber($value))
						$ultimatemember->form->add_error($key, str_replace("##phone##",$value,$phoneLogic->_get_otp_invalid_format_message()));
		}

		function register_ultimateMember_user($user_login,$user_email,$password,$phone_number,$extra_data)
		{
			$args = Array();
			$args['user_login'] = $user_login;
			$args['user_email'] = $user_email;
			$args['user_password'] = $password;
			$args = array_merge($args,$extra_data);
			$user_id = wp_create_user( $user_login,$password, $user_email );
			$this->unsetOTPSessionVariables();
			do_action('um_after_new_user_register', $user_id, $args);
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
			$this->register_ultimateMember_user($user_login,$user_email,$password,$phone_number,$extra_data);
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

			update_mo_option('mo_customer_validation_um_default_enable',
				isset( $_POST['mo_customer_validation_um_default_enable']) ? $_POST['mo_customer_validation_um_default_enable'] : 0);
			update_mo_option('mo_customer_validation_um_enable_type',
				isset( $_POST['mo_customer_validation_um_enable_type']) ? $_POST['mo_customer_validation_um_enable_type'] : '');
	    }
	}
	new UltimateMemberRegistrationForm;