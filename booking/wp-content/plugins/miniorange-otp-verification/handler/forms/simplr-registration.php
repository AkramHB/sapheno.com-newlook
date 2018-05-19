<?php

	class SimplrRegistrationForm extends FormInterface
	{

		private $formSessionVar = FormSessionVars::SIMPLR_REG;
		private $phoneFormID;
		private $otpType;
		private $phoneFieldKey;

		const TYPE_PHONE 		= 'mo_phone_enable';
		const TYPE_EMAIL 		= 'mo_email_enable';
		const TYPE_BOTH 		= 'mo_both_enable';

		function handleForm()
		{
			$this->phoneFieldKey = get_mo_option('mo_customer_validation_simplr_field_key');
			$this->otpType = get_mo_option('mo_customer_validation_simplr_enable_type');
			$this->phoneFormID = 'input[name='.$this->phoneFieldKey.']';
			add_filter( 'simplr_validate_form', array($this,'simplr_site_registration_errors'),10,1);
		}	

		public static function isFormEnabled()
		{
			return get_mo_option('mo_customer_validation_simplr_default_enable') ? true : false;
		}

		function isPhoneVerificationEnabled()
		{
			return (strcasecmp($this->otpType,self::TYPE_PHONE)==0 || strcasecmp($this->otpType,self::TYPE_BOTH)==0);
		}

	    function simplr_site_registration_errors($errors)
	    {
	    	global $phoneLogic;
	    	$password = $phone_number = "";
			MoUtility::checkSession();
			if(!empty($errors) || isset($_POST['fbuser_id'])) return $errors;

			foreach ($_POST as $key => $value)
			{
				if($key=="username")
					$username = $value;
				elseif ($key=="email")
					$email = $value;
				elseif ($key=="password")
					$password = $value;
				elseif ($key==$this->phoneFieldKey)
					$phone_number = $value;
				else
					$extra_data[$key]=$value;
			}
			if(strcasecmp($this->otpType,self::TYPE_PHONE)==0 
				&& !$this->processPhone($phone_number,$errors)) return $errors;
			$this->processAndStartOTPVerificationProcess($username,$email,$errors,$phone_number,$password,$extra_data);	
		}

		function processPhone($phone_number,&$errors)
		{
			if(!MoUtility::validatePhoneNumber($phone_number))
			{
				global $phoneLogic;
				$errors[].= str_replace("##phone##",$value,$phoneLogic->_get_otp_invalid_format_message());
				add_filter($key.'_error_class','_sreg_return_error');
				return FALSE;
			}
			return TRUE;
		}

		function processAndStartOTPVerificationProcess($username,$email,$errors,$phone_number,$password,$extra_data)
		{
			MoUtility::initialize_transaction($this->formSessionVar);
			if(strcasecmp($this->otpType,self::TYPE_PHONE)==0)
				miniorange_site_challenge_otp($username,$email,$errors,$phone_number,"phone",$password,$extra_data);
			else if(strcasecmp($this->otpType,self::TYPE_BOTH)==0)
				miniorange_site_challenge_otp($username,$email,$errors,$phone_number,"both",$password,$extra_data);
			else
				miniorange_site_challenge_otp($username,$email,$errors,$phone_number,"email",$password,$extra_data);
		}

	    function register_simplr_user($user_login,$user_email,$password,$phone_number,$extra_data)
	    {
	    	$data = Array(); 
	    	global $sreg;
	    	if( !$sreg ) $sreg = new stdClass;
	    	$data['username'] 	= $user_login;
	    	$data['email'] 		= $user_email;
	    	$data['password'] 	= $password;
	    	if($this->phoneFieldKey) $data[$this->phoneFieldKey] = $phone_number;
	    	$data = array_merge($data,$extra_data);
	    	$atts = $extra_data['atts'];
	    	$sreg->output = simplr_setup_user($atts,$data);
	    	if(MoUtility::isBlank($sreg->errors))
	    		$this->checkMessageAndRedirect($atts);
	    }

	    function checkMessageAndRedirect()
	    {
	    	global $sreg,$simplr_options;

			$page = isset($atts['thanks']) ? get_permalink($atts['thanks']) 
					: (!MoUtility::isBlank($simplr_options->thank_you) ? get_permalink($simplr_options->thank_you) : '' );
			if(MoUtility::isBlank($page)) 
				$sreg->success = $sreg->output;
			else
			{
				wp_redirect($page);
				exit;
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
			$this->unsetOTPSessionVariables();
			$this->register_simplr_user($user_login,$user_email,$password,$phone_number,$extra_data);
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

			update_mo_option('mo_customer_validation_simplr_default_enable',
				isset( $_POST['mo_customer_validation_simplr_default_enable']) ? $_POST['mo_customer_validation_simplr_default_enable'] : 0);
			update_mo_option('mo_customer_validation_simplr_enable_type',
				isset( $_POST['mo_customer_validation_simplr_enable_type']) ? $_POST['mo_customer_validation_simplr_enable_type'] : '');
			update_mo_option('mo_customer_validation_simplr_field_key',
				isset( $_POST['simplr_phone_field_key']) ? $_POST['simplr_phone_field_key'] : '');
	    }
	}
	new SimplrRegistrationForm;