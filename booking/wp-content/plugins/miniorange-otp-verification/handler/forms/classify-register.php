<?php

	class ClassifyRegistrationForm extends FormInterface
	{

		private $formSessionVar = FormSessionVars::CLASSIFY_REGISTER;
		private $phoneFormID 	= 'input[name=phone]';
		private $otpType;

		const TYPE_PHONE 		= 'classify_phone_enable';
		const TYPE_EMAIL 		= 'classify_email_enable';

		function handleForm()
		{
			$this->otpType = get_mo_option('mo_customer_validation_classify_type');

			add_action( 'wp_enqueue_scripts', array($this,'_show_phone_field_on_page'));
			add_action( 'user_register', array($this,'save_phone_number'), 10, 1);

			$this->routeData();
		}

		public static function isFormEnabled()                                 
		{
			return get_mo_option('mo_customer_validation_classify_enable') ? TRUE : FALSE;
		}

		function routeData()
		{
			MoUtility::checkSession();
			if(array_key_exists($this->formSessionVar,$_SESSION) && $_SESSION[$this->formSessionVar]=="success")
				$this->unsetOTPSessionVariables();
			else if(array_key_exists('option',$_POST) && $_POST['option']=="verify_user_classify")
				$this->_handle_classify_theme_form_post($_POST);				
		}	

		function _show_phone_field_on_page()
		{
			wp_enqueue_script('classifyscript', MOV_URL . 'includes/js/classify.min.js?version='.MOV_VERSION , array('jquery'));
		}

		function _handle_classify_theme_form_post($data)
		{
			$username = $data['username'];
			$email_id = $data['email'];
			$phone 	  = $data['phone'];

	       	if ( username_exists( $username )!=FALSE ) return;
			if ( email_exists( $email_id )!=FALSE ) return;

			MoUtility::initialize_transaction($this->formSessionVar);

			if(strcasecmp($this->otpType,self::TYPE_PHONE)==0)
				miniorange_site_challenge_otp($_POST['username'],$email_id,null,$phone,"phone",null,null);
			else if(strcasecmp($this->otpType,self::TYPE_EMAIL)==0)
				miniorange_site_challenge_otp($_POST['username'],$email_id,null, null,"email",null,null);
			else
				miniorange_site_challenge_otp($_POST['username'],$email_id,null, $phone,"both",null,null);
		}

		function save_phone_number($user_id)
		{
			MoUtility::checkSession();	
			if(array_key_exists('phone_number_mo',$_SESSION))
	        	update_user_meta($user_id, 'phone', $_SESSION['phone_number_mo']);
		}

		function handle_failed_verification($user_login,$user_email,$phone_number)
		{
			MoUtility::checkSession();
			if(!isset($_SESSION[$this->formSessionVar])) return;
			$otpVerType = strcasecmp($this->otpType,self::TYPE_PHONE)==0 ? "phone" 
							: (strcasecmp($this->otpType,self::TYPE_EMAIL)==0 ? "email" : "both" );
			$fromBoth = strcasecmp($otpVerType,"both")==0 ? TRUE : FALSE;
			miniorange_site_otp_validation_form($user_login,$user_email,$phone_number,MoUtility::_get_invalid_otp_method(),$otpVerType,$fromBoth);
		}

		function handle_post_verification($redirect_to,$user_login,$user_email,$password,$phone_number,$extra_data)
		{
			MoUtility::checkSession();
			if(!isset($_SESSION[$this->formSessionVar])) return;
			$_SESSION[$this->formSessionVar] = 'success';	
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
			if(self::isFormEnabled() && $this->otpType==self::TYPE_PHONE) array_push($selector, $this->phoneFormID); 
			return $selector;
		}

		function handleFormOptions()
		{
			if(!MoUtility::areFormOptionsBeingSaved()) return;

			update_mo_option('mo_customer_validation_classify_enable',
				isset( $_POST['mo_customer_validation_classify_enable']) ? $_POST['mo_customer_validation_classify_enable'] : 0);
			update_mo_option('mo_customer_validation_classify_type',
				isset( $_POST['mo_customer_validation_classify_type']) ? $_POST['mo_customer_validation_classify_type'] : '');
		}
	}
	new ClassifyRegistrationForm;