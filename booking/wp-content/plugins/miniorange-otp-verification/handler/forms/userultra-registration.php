<?php

	class UserUltraRegistrationForm extends FormInterface
	{
		private $formSessionVar = FormSessionVars::UULTRA_REG;
		private $otpType;
		private $phoneKey;
		private $phoneFormID;

		const TYPE_PHONE 		= 'mo_uultra_phone_enable';
		const TYPE_EMAIL 		= 'mo_uultra_email_enable';
		const TYPE_BOTH 		= 'mo_uultra_both_enable';

		function handleForm()
		{
			$this->phoneKey = get_mo_option('mo_customer_validation_uultra_phone_key');
			$this->otpType = get_mo_option('mo_customer_validation_uultra_enable_type');
			$this->phoneFormID = 'input[name='.$this->phoneKey.']';

			if(!array_key_exists('xoouserultra-register-form',$_POST)) return;

			$phone =  $this->isPhoneVerificationEnabled() ? $_POST[$this->phoneKey] : NULL;
			$this->_handle_uultra_form_submit($_POST['user_login'],$_POST['user_email'],$phone);
		}

		public static function isFormEnabled() 
		{
			return get_mo_option('mo_customer_validation_uultra_default_enable') ? true : false;
		}

		function isPhoneVerificationEnabled()
		{
			return (strcasecmp($this->otpType,self::TYPE_PHONE)==0 || strcasecmp($this->otpType,self::TYPE_BOTH)==0);
		}

		function _handle_uultra_form_submit($user_name,$user_email,$phone)
		{	
			MoUtility::checkSession();
			$xoUser = new XooUserRegister;

			if(array_key_exists($this->formSessionVar,$_SESSION)) return;

			$xoUser->uultra_prepare_request( $_POST );
			$xoUser->uultra_handle_errors();
			if(!MoUtility::isBlank($xoUser->errors)) $_POST['no_captcha'] = 'yes';
			$this->_handle_otp_verification_uultra($user_name,$user_email,null,$phone);

		}

		function _handle_otp_verification_uultra($user_name,$user_email,$errors,$phone)
		{
			MoUtility::initialize_transaction($this->formSessionVar);		
			if(strcasecmp($this->otpType,self::TYPE_PHONE)==0)
				miniorange_site_challenge_otp($user_name,$user_email,$errors,$phone,"phone");
			else if(strcasecmp($this->otpType,self::TYPE_BOTH)==0)
				miniorange_site_challenge_otp($user_name,$user_email,$errors,$phone,"both");
			else
				miniorange_site_challenge_otp($user_name,$user_email,$errors,$phone,"email");
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
			$this->unsetOTPSessionVariables();	
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

			update_mo_option('mo_customer_validation_uultra_default_enable',
				isset( $_POST['mo_customer_validation_uultra_default_enable']) ? $_POST['mo_customer_validation_uultra_default_enable'] : 0);
			update_mo_option('mo_customer_validation_uultra_enable_type',
				isset( $_POST['mo_customer_validation_uultra_enable_type']) ? $_POST['mo_customer_validation_uultra_enable_type'] : '');
			update_mo_option('mo_customer_validation_uultra_phone_key',
				isset( $_POST['uultra_phone_field_key']) ? $_POST['uultra_phone_field_key'] : '');
	    }
	}
	new UserUltraRegistrationForm;