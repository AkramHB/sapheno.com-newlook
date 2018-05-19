<?php

	class ProfileBuilderRegistrationForm extends FormInterface
	{

		private $formSessionVar = FormSessionVars::PB_DEFAULT_REG;
		private $otpType;
		private $phoneFormID;
		private $phoneMetaKey;

		const TYPE_PHONE 		= 'mo_pb_phone_enable';
		const TYPE_EMAIL 		= 'mo_pb_email_enable';
		const TYPE_BOTH 		= 'mo_pb_both_enable';

		function handleForm()
		{
			$this->otpType = get_mo_option('mo_customer_validation_pb_enable_type');
			$this->phoneMetaKey = get_mo_option('mo_customer_validation_pb_phone_meta_key');
			$this->phoneFormID = "input[name=" . $this->phoneMetaKey . "]";
			add_filter( 'wppb_output_field_errors_filter', array($this,'formbuilder_site_registration_errors'),99,4);
		}

		public static function isFormEnabled()
		{
			return get_mo_option('mo_customer_validation_pb_default_enable') ? true : false;
		}

		function isPhoneVerificationEnabled()
		{
			return (strcasecmp($this->otpType,self::TYPE_PHONE)==0 || strcasecmp($this->otpType,self::TYPE_BOTH)==0);
		}

		function formbuilder_site_registration_errors($fieldErrors,$fieldArgs,$global_request,$typeArgs)
		{
			MoUtility::checkSession();

			if(!empty($fieldErrors)) return $fieldErrors; 			
			if($global_request['action']=='register')
			{
				if(isset($_SESSION[$this->formSessionVar]) && strcasecmp($_SESSION[$this->formSessionVar],'validated')==0)
				{
					$this->unsetOTPSessionVariables();
					return $fieldErrors;
				}
				return $this->startOTPVerificationProcess($fieldErrors,$global_request);
			}
			return $fieldErrors;
		}

		function startOTPVerificationProcess($fieldErrors,$data)
		{
			MoUtility::initialize_transaction($this->formSessionVar);
			extract($data);
			if(strcasecmp($this->otpType,self::TYPE_PHONE)==0 || strcasecmp($this->otpType,self::TYPE_BOTH)==0)
			{
				$phone = $this->phoneMetaKey;
				miniorange_site_challenge_otp($username,$email,new WP_Error(),$$phone,"phone",$passw1,array());
			}
			else if(strcasecmp($this->otpType,self::TYPE_EMAIL)==0)
			{
				miniorange_site_challenge_otp($username,$email,new WP_Error(),null,"email",$passw1,array());
			}
		}

		function handle_failed_verification($user_login,$user_email,$phone_number)
		{
			MoUtility::checkSession();
			if(!isset($_SESSION[$this->formSessionVar])) return;
			miniorange_site_otp_validation_form($user_login,$user_email,$phone_number,MoUtility::_get_invalid_otp_method(),"email",FALSE);
		}

		function handle_post_verification($redirect_to,$user_login,$user_email,$password,$phone_number,$extra_data)
		{
			MoUtility::checkSession();
			if(!isset($_SESSION[$this->formSessionVar])) return;
			$_SESSION[$this->formSessionVar]='validated';
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
			if(self::isFormEnabled() && $this->isPhoneVerificationEnabled()) array_push($selector, $this->phoneFormID); 
			return $selector;
		}

		function handleFormOptions()
		{
			if(!MoUtility::areFormOptionsBeingSaved()) return;

			update_mo_option('mo_customer_validation_pb_default_enable',
				isset( $_POST['mo_customer_validation_pb_default_enable']) ? $_POST['mo_customer_validation_pb_default_enable'] : 0);
			update_mo_option('mo_customer_validation_pb_enable_type',
				isset( $_POST['mo_customer_validation_pb_enable_type']) ? $_POST['mo_customer_validation_pb_enable_type'] : '');
			update_mo_option('mo_customer_validation_pb_phone_meta_key',
				isset( $_POST['pb_phone_field_key']) ? $_POST['pb_phone_field_key'] : '');
		}
	}
	new ProfileBuilderRegistrationForm;
