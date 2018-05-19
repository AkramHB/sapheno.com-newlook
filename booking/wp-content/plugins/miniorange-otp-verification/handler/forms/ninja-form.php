<?php 

	class NinjaForm extends FormInterface
	{

		private $formSessionVar = FormSessionVars::NINJA_FORM;
		private $otpType;
		private $ninjaFormsEnabled;
		private $phoneFormID 	= array();

		const TYPE_PHONE 		= 'mo_ninja_form_phone_enable';
		const TYPE_EMAIL 		= 'mo_ninja_form_email_enable';
		const TYPE_BOTH 		= 'mo_ninja_form_both_enable';

		function handleForm()
		{
			$this->otpType = get_mo_option('mo_customer_validation_ninja_form_enable_type');
			$this->ninjaFormsEnabled = maybe_unserialize(get_mo_option('mo_customer_validation_ninja_form_otp_enabled'));

			foreach ($this->ninjaFormsEnabled as $key => $value) {
				array_push($this->phoneFormID,'input[name=ninja_forms_field_'.$value['phonekey'].']');
			}

			if($this->checkIfOTPOptions()) return;

			if($this->checkIfNinjaFormSubmitted()) $this->_handle_ninja_form_submit($_REQUEST);
		}

		function checkIfOTPOptions()
		{
			return array_key_exists('option',$_POST) && (strpos($_POST['option'], 'verification_resend_otp_') 
				|| $_POST['option']=='miniorange-validate-otp-form' || $_POST['option']=='miniorange-validate-otp-choice-form');
		}

		function checkIfNinjaFormSubmitted()
		{
			return array_key_exists('_ninja_forms_display_submit',$_REQUEST)  && array_key_exists('_form_id',$_REQUEST);
		}

		public static function isFormEnabled()
		{
			return get_mo_option('mo_customer_validation_ninja_form_enable') ? true : false;
		}

		function isPhoneVerificationEnabled()
		{
			return (strcasecmp($this->otpType,self::TYPE_PHONE)==0 || strcasecmp($this->otpType,self::TYPE_BOTH)==0);
		}

		function isEmailVerificationEnabled()
		{
			return (strcasecmp($this->otpType,self::TYPE_EMAIL)==0 || strcasecmp($this->otpType,self::TYPE_BOTH)==0);
		}

		function _handle_ninja_form_submit($requestdata) 
		{
			if(!array_key_exists($requestdata['_form_id'],$this->ninjaFormsEnabled)) return; 
			$formdata = $this->ninjaFormsEnabled[$requestdata['_form_id']];
			$email = $this->processEmail($formdata,$requestdata); 			
			$phone = $this->processPhone($formdata,$requestdata); 			
			$this->miniorange_ninja_form_user($email,null,$phone);
		}

		function processPhone($formdata,$requestdata)
		{
			if($this->isPhoneVerificationEnabled())
			{
				$field = "ninja_forms_field_".$formdata['phonekey'];
				return array_key_exists($field,$requestdata) ? $requestdata[$field] : NULL;
			}
		}

		function processEmail($formdata,$requestdata)
		{
			if($this->isEmailVerificationEnabled())
			{
				$field = "ninja_forms_field_".$formdata['emailkey'];
				return array_key_exists($field,$requestdata) ? $requestdata[$field] : NULL;
			}
		}

		function miniorange_ninja_form_user($user_email,$user_name,$phone_number)
		{
			MoUtility::checkSession();
			MoUtility::initialize_transaction($this->formSessionVar);
			$errors = new WP_Error();
			if(strcasecmp($this->otpType,self::TYPE_PHONE)==0)
				miniorange_site_challenge_otp($user_name,$user_email,$errors,$phone_number,"phone");
			else if(strcasecmp($this->otpType,self::TYPE_BOTH)==0)
				miniorange_site_challenge_otp($user_name,$user_email,$errors,$phone_number,"both");
			else
				miniorange_site_challenge_otp($user_name,$user_email,$errors,$phone_number,"email");
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
			if(self::isFormEnabled() && $this->isPhoneVerificationEnabled()) $selector = array_merge($selector, $this->phoneFormID); 
			return $selector;
		}

		function handleFormOptions()
		{
			if(!MoUtility::areFormOptionsBeingSaved()) return;
			if(isset($_POST['mo_customer_validation_nja_enable'])) return;

			foreach (array_filter($_POST['ninja_form']['form']) as $key => $value)
				$form[$value]=array('emailkey'=>$_POST['ninja_form']['emailkey'][$key],'phonekey'=>$_POST['ninja_form']['phonekey'][$key]);

			update_mo_option('mo_customer_validation_ninja_form_enable',
				isset( $_POST['mo_customer_validation_ninja_form_enable']) ? $_POST['mo_customer_validation_ninja_form_enable'] : 0);
			update_mo_option('mo_customer_validation_nja_enable',0);
			update_mo_option('mo_customer_validation_ninja_form_enable_type',
				isset( $_POST['mo_customer_validation_ninja_form_enable_type']) ? $_POST['mo_customer_validation_ninja_form_enable_type'] : '');
			update_mo_option('mo_customer_validation_ninja_form_otp_enabled',!empty($form) ? maybe_serialize($form) : "");
		}

	}
	new NinjaForm;