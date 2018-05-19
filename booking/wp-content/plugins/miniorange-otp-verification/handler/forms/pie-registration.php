<?php

	class PieRegistrationForm extends FormInterface
	{

		private $formSessionVar = FormSessionVars::PIE_REG;
		private $phoneFormID;
		private $otpType;
		private $phoneFieldKey;

		const TYPE_PHONE 		= 'mo_pie_phone_enable';
		const TYPE_EMAIL 		= 'mo_pie_email_enable';
		const TYPE_BOTH 		= 'mo_pie_both_enable';

		function handleForm()
		{
			$this->otpType = get_mo_option('mo_customer_validation_pie_enable_type');
			$this->phoneFieldKey = get_mo_option('mo_customer_validation_pie_phone_key');
			$this->phoneFormID = $this->getPhoneFieldKey();
			add_action( 'pie_register_after_register_validate', array($this,'miniorange_pie_user_registration'),99,0);
		}

		public static function isFormEnabled()
		{
			return get_mo_option('mo_customer_validation_pie_default_enable') ? TRUE : FALSE;
		}

		function isPhoneVerificationEnabled()
		{
			return (strcasecmp($this->otpType,self::TYPE_PHONE)==0 || strcasecmp($this->otpType,self::TYPE_BOTH)==0);
		}

		function miniorange_pie_user_registration()
		{
			MoUtility::checkSession();
			if(!array_key_exists($this->formSessionVar,$_SESSION))
			{
				$phone_field = $this->getPhoneFieldKey();
				$phone = !MoUtility::isBlank($phone_field) ? $_POST[$phone_field] : NULL;
				$this->startTheOTPVerificationProcess($_POST['username'],$_POST['e_mail'],$phone);
			}
			elseif(strcasecmp($_SESSION[$this->formSessionVar],'validated')==0)
				$_SESSION[$this->formSessionVar] = 'validationChecked';
			elseif(strcasecmp($_SESSION[$this->formSessionVar],'validationChecked')==0)
				$this->unsetOTPSessionVariables();
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

		function getPhoneFieldKey()
		{
			$fields = unserialize(get_mo_option('pie_fields'));
			$keys = array_keys($fields);
			foreach($keys as $key)
			{
				if(strcasecmp(trim($fields[$key]['label']),$this->phoneFieldKey)==0)
					return str_replace("-","_",sanitize_title($fields[$key]['type']."_"
						.(isset($fields[$key]['id']) ? $fields[$key]['id'] : "")));
			}
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
			$_SESSION[$this->formSessionVar]="validated";
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

			update_mo_option('mo_customer_validation_pie_default_enable',
				isset( $_POST['mo_customer_validation_pie_default_enable']) ? $_POST['mo_customer_validation_pie_default_enable'] : 0);
			update_mo_option('mo_customer_validation_pie_enable_type',
				isset( $_POST['mo_customer_validation_pie_enable_type']) ? $_POST['mo_customer_validation_pie_enable_type'] : '');
			update_mo_option('mo_customer_validation_pie_phone_key',
				isset( $_POST['pie_phone_field_key']) ? $_POST['pie_phone_field_key'] : '');
		}	
	}
	new PieRegistrationForm;