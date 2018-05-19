<?php

	class WpEmemberForm extends FormInterface
	{

		private $formSessionVar = FormSessionVars::EMEMBER;
		private $phoneKey 		= 'wp_emember_phone';
		private $phoneFormID;
		private $otpType;

		const TYPE_PHONE 		= 'mo_emember_phone_enable';
		const TYPE_EMAIL 		= 'mo_emember_email_enable';
		const TYPE_BOTH 		= 'mo_emember_both_enable';

		function handleForm()
		{
			$this->otpType = get_mo_option('mo_customer_validation_emember_enable_type');
			$this->phoneFormID 	= 'input[name='.$this->phoneKey.']';
			if(array_key_exists('emember_dsc_nonce',$_POST) && !array_key_exists('option',$_POST)) 
				$this->miniorange_emember_user_registration();
		}

		public static function isFormEnabled()
		{
			return get_mo_option('mo_customer_validation_emember_default_enable') ? TRUE : FALSE;
		}

		function isPhoneVerificationEnabled()
		{
			return (strcasecmp($this->otpType,self::TYPE_PHONE)==0 || strcasecmp($this->otpType,self::TYPE_BOTH)==0);
		}

		function miniorange_emember_user_registration()
		{
			MoUtility::checkSession();
			if($this->validatePostFields())
			{
				$phone = array_key_exists($this->phoneKey,$_POST) ? $_POST[$this->phoneKey] : NULL;
				$this->startTheOTPVerificationProcess($_POST['wp_emember_user_name'],$_POST['wp_emember_email'],$phone);
			}
		}

		function startTheOTPVerificationProcess($username,$useremail,$phone)
		{
			MoUtility::initialize_transaction($this->formSessionVar);
			$errors = new WP_Error();
			if(strcasecmp($this->otpType,self::TYPE_PHONE)==0)
				miniorange_site_challenge_otp( $username,$useremail,$errors,$phone,"phone");
			else if(strcasecmp($this->otpType,self::TYPE_BOTH)==0)
				miniorange_site_challenge_otp( $username,$useremail,$errors,$phone,"both");
			else
				miniorange_site_challenge_otp( $username,$useremail,$errors,$phone,"email");
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

		function validatePostFields()
		{
			if(is_blocked_ip(get_real_ip_addr())) return FALSE;
            if(emember_wp_username_exists($_POST['wp_emember_user_name']) 
            	|| emember_username_exists($_POST['wp_emember_user_name']) ) return FALSE;
			if(is_blocked_email($_POST['wp_emember_email']) || emember_registered_email_exists($_POST['wp_emember_email']) 
				|| emember_wp_email_exists($_POST['wp_emember_email'])) return FALSE;
			if(isset($_POST['eMember_Register']) && array_key_exists('wp_emember_pwd_re',$_POST) 
				&& $_POST['wp_emember_pwd'] != $_POST['wp_emember_pwd_re']) return FALSE;
			return TRUE;
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

			update_mo_option('mo_customer_validation_emember_default_enable',
				isset( $_POST['mo_customer_validation_emember_default_enable']) ? $_POST['mo_customer_validation_emember_default_enable'] : 0);
			update_mo_option('mo_customer_validation_emember_enable_type',
				isset( $_POST['mo_customer_validation_emember_enable_type']) ? $_POST['mo_customer_validation_emember_enable_type'] : '');
		}	
	}
	new WpEmemberForm;