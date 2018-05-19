<?php

	class DocDirectThemeRegistration extends FormInterface
	{
		private $formSessionVar = FormSessionVars::DOCDIRECT_REG;
		private $formPhoneVer 	= FormSessionVars::DOCDIRECT_PHONE_VER;
		private $formEmailVer 	= FormSessionVars::DOCDIRECT_EMAIL_VER;
		private $phoneKey;
		private $otpType;
		private $phoneFormID 	= 'input[name=phone_number]';

		const TYPE_PHONE 		= 'mo_docdirect_phone_enable';
		const TYPE_EMAIL 		= 'mo_docdirect_email_enable';

		function handleForm()
		{
			$this->otpType = get_mo_option('mo_customer_validation_docdirect_enable_type');
			add_action( 'wp_enqueue_scripts', array($this,'addScriptToRegistrationPage'));
			add_action('wp_ajax_docdirect_user_registration', array($this,'mo_validate_docdirect_user_registration'),1);
			add_action('wp_ajax_nopriv_docdirect_user_registration', array($this,'mo_validate_docdirect_user_registration'),1);
			$this->routeData();
		}

		function routeData()
		{
			if(!array_key_exists('option', $_GET)) return;
			switch (trim($_GET['option'])) 
			{
				case "miniorange-docdirect-verify":
					$this->startOTPVerificationProcess($_POST);			break;
			}
		}

		function addScriptToRegistrationPage()
		{
			wp_register_script( 'docdirect', MOV_URL . 'includes/js/docdirect.min.js?version='.MOV_VERSION , array('jquery') ,MOV_VERSION,true);
			wp_localize_script( 'docdirect', 'modocdirect', array(
				'imgURL'		=> MOV_URL. "includes/images/loader.gif",
				'buttonText' 	=> mo_("Click Here to Verify Yourself"),
				'insertAfter'	=> strcasecmp($this->otpType,self::TYPE_PHONE)==0 ? 'input[name=phone_number]' : 'input[name=email]',
				'placeHolder' 	=> mo_('OTP Code'),
				'siteURL' 		=> 	site_url(),
			));
			wp_enqueue_script('docdirect');
		}

		public static function isFormEnabled()
		{
			return get_mo_option('mo_customer_validation_docdirect_enable') ? TRUE : FALSE;
		}

		function startOtpVerificationProcess($data)
		{
			MoUtility::checkSession();
			MoUtility::initialize_transaction($this->formSessionVar);
			if(strcasecmp($this->otpType,self::TYPE_PHONE)==0)
				$this->_send_otp_to_phone($data);
			else
				$this->_send_otp_to_email($data);
		}

		function _send_otp_to_phone($data)
		{
			if(array_key_exists('user_phone', $data) && !MoUtility::isBlank($data['user_phone']))
			{
				$_SESSION[$this->formPhoneVer] = trim($data['user_phone']);
				miniorange_site_challenge_otp('test','',null, trim($data['user_phone']),"phone");
			}
			else
				wp_send_json( MoUtility::_create_json_response( MoMessages::showMessage('ENTER_PHONE'),MoConstants::ERROR_JSON_TYPE) );
		}

		function _send_otp_to_email($data)
		{
			if(array_key_exists('user_email', $data) && !MoUtility::isBlank($data['user_email']))
			{
				$_SESSION[$this->formEmailVer] = $data['user_email'];
				miniorange_site_challenge_otp('test',$data['user_email'],null,$data['user_email'],"email");
			}
			else
				wp_send_json( MoUtility::_create_json_response( MoMessages::showMessage('ENTER_EMAIL'),MoConstants::ERROR_JSON_TYPE) );
		}

		function mo_validate_docdirect_user_registration()
		{
			MoUtility::checkSession();
			$this->checkIfVerificationNotStarted();
			$this->checkIfVerificationCodeNotEntered();
			$this->handle_otp_token_submitted();
		}

		function checkIfVerificationNotStarted()
		{
			if(!isset($_SESSION[$this->formSessionVar])) {
				echo json_encode( array('type' => 'error', 'message' =>  MoMessages::showMessage('DOC_DIRECT_VERIFY')) );
				die();
			}
		}

		function checkIfVerificationCodeNotEntered()
		{
			if(!array_key_exists('mo_verify', $_POST) || MoUtility::isBlank($_POST['mo_verify'])){
				echo json_encode( array('type' => 'error', 'message' =>  MoMessages::showMessage('DCD_ENTER_VERIFY_CODE')) );
				die();
			}
		}

		function handle_otp_token_submitted()
		{
			if(strcasecmp($this->otpType,self::TYPE_PHONE)==0) $this->processPhoneNumber();
			else $this->processEmail();
			do_action('mo_validate_otp','mo_verify',NULL);
		}

		function processPhoneNumber()
		{
			MoUtility::checkSession();
			if(strcasecmp($_SESSION[$this->formPhoneVer], MoUtility::processPhoneNumber($_POST['phone_number']))!=0) {
				echo json_encode( array('type' => 'error', 'message' =>  MoMessages::showMessage('PHONE_MISMATCH')) );
				die();
			}
		}

		function processEmail()
		{
			MoUtility::checkSession();
			if(strcasecmp($_SESSION[$this->formEmailVer], $_POST['email'])!=0) {
				echo json_encode( array('type' => 'error', 'message' =>  MoMessages::showMessage('EMAIL_MISMATCH')) );
				die();
			}
		}

		function handle_failed_verification($user_login,$user_email,$phone_number)
		{
			MoUtility::checkSession();
			if(!isset($_SESSION[$this->formSessionVar])) return;
			echo json_encode( array('type' => 'error', 'message' =>  MoUtility::_get_invalid_otp_method()) );
			die();
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
			unset($_SESSION[$this->formPhoneVer]);
			unset($_SESSION[$this->formEmailVer]);
		}

		public function is_ajax_form_in_play($isAjax)
		{
			MoUtility::checkSession();
			return isset($_SESSION[$this->formSessionVar]) ? TRUE : $isAjax;
		}

		public function getPhoneNumberSelector($selector)	
		{
			MoUtility::checkSession();
			if(self::isFormEnabled() && ($this->otpType == self::TYPE_PHONE)) array_push($selector, $this->phoneFormID); 
			return $selector;
		}

		function handleFormOptions()
		{
			if(!MoUtility::areFormOptionsBeingSaved()) return;

			update_mo_option('mo_customer_validation_docdirect_enable',
				isset( $_POST['mo_customer_validation_docdirect_enable']) ? $_POST['mo_customer_validation_docdirect_enable'] : 0);
			update_mo_option('mo_customer_validation_docdirect_enable_type',
				isset( $_POST['mo_customer_validation_docdirect_enable_type']) ? $_POST['mo_customer_validation_docdirect_enable_type'] : '');
		}
	}
	new DocDirectThemeRegistration;