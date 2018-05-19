<?php

	class RegistrationMagicForm extends FormInterface
	{
		private $formSessionVar = FormSessionVars::CRF_DEFAULT_REG;
		private $phoneFormID = array();
		private $crfFormsEnabled;
		private $otpType;
		private $formIDSession;
		//private $emailKey;
		//private $phoneKey;

		const TYPE_PHONE 		= 'mo_crf_phone_enable';
		const TYPE_EMAIL 		= 'mo_crf_email_enable';
		const TYPE_BOTH 		= 'mo_crf_both_enable';

		function handleForm()
		{
			$this->otpType = get_mo_option('mo_customer_validation_crf_enable_type');
			$this->crfFormsEnabled =  maybe_unserialize(get_mo_option('mo_customer_validation_crf_otp_enabled'));

			foreach ($this->crfFormsEnabled as $key => $value) {
				array_push($this->phoneFormID,'input[name='.$this->getFieldID($value['phonekey']).']');
			}

			if(!$this->checkIfPromptForOTP()) return;
			$this->_handle_crf_form_submit($_REQUEST);
		}

		public static function isFormEnabled()
		{
			return get_mo_option('mo_customer_validation_crf_default_enable') ? TRUE : FALSE;
		}

		private function checkIfPromptForOTP()
		{
			if(array_key_exists('option',$_POST) || !array_key_exists('rm_form_sub_id',$_POST)) return FALSE;
			foreach($this->crfFormsEnabled as $key => $value) {
				if (strpos($_POST['rm_form_sub_id'], 'form_' . $key . '_') !== FALSE){
					MoUtility::checkSession();
					$_SESSION[$this->formIDSession] = $key;
					return TRUE;
				} 
			}
			return FALSE;
		}

		private function isPhoneVerificationEnabled()
		{
			return (strcasecmp($this->otpType,self::TYPE_PHONE)==0 || strcasecmp($this->otpType,self::TYPE_BOTH)==0);
		}

		private function _handle_crf_form_submit($requestdata)
		{
			MoUtility::checkSession();
			if($this->checkIfValidated()) return;
			$email = $this->otpType == self::TYPE_EMAIL || $this->otpType == self::TYPE_BOTH 
				? $this->getCRFEmailFromRequest($requestdata) : "";
			$phone = $this->isPhoneVerificationEnabled() ? $this->getCRFPhoneFromRequest($requestdata) : "";
			$this->miniorange_crf_user($email, isset($requestdata['user_name']) ? $requestdata['user_name'] : NULL ,$phone);
		}

		private function checkIfValidated() 
		{
			if(array_key_exists($this->formSessionVar,$_SESSION) && $_SESSION[$this->formSessionVar]=='validated') {
				$this->unsetOTPSessionVariables();
				return TRUE;
			}
			return FALSE;
		}

		private function getCRFEmailFromRequest($requestdata)
		{
			$emailKey = $this->crfFormsEnabled[$_SESSION[$this->formIDSession]]['emailkey'];
			return $this->getFormPostSubmittedValue($this->getFieldID($emialKey),$requestdata);
		}

		private function getCRFPhoneFromRequest($requestdata)
		{
			$phonekey = $this->crfFormsEnabled[$_SESSION[$this->formIDSession]]['phonekey'];
			return $this->getFormPostSubmittedValue($this->getFieldID($phonekey),$requestdata);
		}

		private function getFormPostSubmittedValue($reg1,$requestdata)
		{
			return isset($requestdata[$reg1]) ? $requestdata[$reg1] : "";
		}

		private function getFieldID($key)
		{
			global $wpdb;
			$crf_fields =$wpdb->prefix."rm_fields";
			$row1 = $wpdb->get_row("SELECT * FROM $crf_fields where field_label ='".$key."'");
			return isset($row1) ? $row1->field_type.'_'.$row1->field_id : "null";
		}

		private function miniorange_crf_user($user_email,$user_name,$phone_number)
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
			$_SESSION[$this->formSessionVar] = 'validated';	
		}

		public function unsetOTPSessionVariables()
		{
			unset($_SESSION[$this->txSessionId]);
			unset($_SESSION[$this->formSessionVar]);
			unset($_SESSION[$this->formIDSession]);
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

			foreach (array_filter($_POST['crf_form']['form']) as $key => $value)
				$form[$value]=array('emailkey'=>$_POST['crf_form']['emailkey'][$key],'phonekey'=>$_POST['crf_form']['phonekey'][$key]);

			update_mo_option('mo_customer_validation_crf_default_enable', 
				isset( $_POST['mo_customer_validation_crf_default_enable']) ? $_POST['mo_customer_validation_crf_default_enable'] : 0);
			update_mo_option('mo_customer_validation_crf_enable_type',
				isset( $_POST['mo_customer_validation_crf_enable_type']) ? $_POST['mo_customer_validation_crf_enable_type'] : 0);
			update_mo_option('mo_customer_validation_crf_otp_enabled',!empty($form) ? maybe_serialize($form) : "");
			// update_mo_option('mo_customer_validation_crf_phone_key',
			// 	isset( $_POST['crf_phone_field_key']) ? $_POST['crf_phone_field_key'] : '');
			// update_mo_option('mo_customer_validation_crf_email_key',
			// 	isset( $_POST['crf_email_field_key']) ? $_POST['crf_email_field_key'] : '');
		}
	}
	new RegistrationMagicForm;