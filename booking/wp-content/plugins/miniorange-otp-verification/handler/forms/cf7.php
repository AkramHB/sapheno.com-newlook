<?php

	class ContactForm7 extends FormInterface
	{
		private $formSessionVar 	= FormSessionVars::CF7_FORMS;
		private $formEmailVer 		= FormSessionVars::CF7_EMAIL_VER;
		private $formPhoneVer 		= FormSessionVars::CF7_PHONE_VER;
		private $formFinalEmailVer 	= FormSessionVars::CF7_EMAIL_SUB;
		private $formFinalPhoneVer 	= FormSessionVars::CF7_PHONE_SUB;
		private $phoneFormID;
		private $phoneFieldKey; 
		private $emailFieldKey;
		private $otpType;
		private $formSessionTagName;

		const TYPE_PHONE 		= 'mo_cf7_contact_phone_enable';
		const TYPE_EMAIL 		= 'mo_cf7_contact_email_enable';

		function handleForm()
		{
			$this->otpType = get_mo_option('mo_customer_validation_cf7_contact_type');
			$this->emailFieldKey = get_mo_option('mo_customer_validation_cf7_email_key');
			$this->phoneFieldKey = 'mo_phone';
			$this->phoneFormID = 'input[name='.$this->phoneFieldKey.']';

			add_filter( 'wpcf7_validate_text*'	, array($this,'validateFormPost'), 1 , 2 );
			add_filter( 'wpcf7_validate_email*'	, array($this,'validateFormPost'), 1 , 2 );
			add_filter( 'wpcf7_validate_email'	, array($this,'validateFormPost'), 1 , 2 );
			add_filter( 'wpcf7_validate_tel*'	, array($this,'validateFormPost'), 1 , 2 );

			add_shortcode('mo_verify_email', array($this,'_cf7_email_shortcode') );
			add_shortcode('mo_verify_phone', array($this,'_cf7_phone_shortcode') );

			$this->routeData();
		}

		public static function isFormEnabled()
		{
			return get_mo_option('mo_customer_validation_cf7_contact_enable') ? TRUE : FALSE;
		}

		function routeData()
		{
			if(!array_key_exists('option', $_GET)) return; 

			switch (trim($_GET['option'])) 
			{
				case "miniorange-cf7-contact":
					$this->_handle_cf7_contact_form($_POST);	break; 			
			}
		}	

		function _handle_cf7_contact_form($getdata)
		{
			MoUtility::checkSession();
			MoUtility::initialize_transaction($this->formSessionVar);

			if(array_key_exists('user_email', $getdata) && !MoUtility::isBlank($getdata['user_email']))
			{
				$_SESSION[$this->formEmailVer] = $getdata['user_email'];
				miniorange_site_challenge_otp('test',$getdata['user_email'],null,$getdata['user_email'],"email");
			}
			else if(array_key_exists('user_phone', $getdata) && !MoUtility::isBlank($getdata['user_phone']))
			{
				$_SESSION[$this->formPhoneVer] = trim($getdata['user_phone']);
				miniorange_site_challenge_otp('test','',null, trim($getdata['user_phone']),"phone");
			}
			else
			{
				if(strcasecmp($this->otpType,self::TYPE_PHONE)==0)
					wp_send_json( MoUtility::_create_json_response(MoMessages::showMessage('ENTER_PHONE'),MoConstants::ERROR_JSON_TYPE) );
				else
					wp_send_json( MoUtility::_create_json_response(MoMessages::showMessage('ENTER_EMAIL'),MoConstants::ERROR_JSON_TYPE) );
			}
		}

		function validateFormPost($result, $tag)
		{
			MoUtility::checkSession();
			$tag = new WPCF7_FormTag( $tag );
			$name = $tag->name;
			$value = isset( $_POST[$name] ) ? trim( wp_unslash( strtr( (string) $_POST[$name], "\n", " " ) ) ) : '';

			if ( 'email' == $tag->basetype && $name==$this->emailFieldKey) $_SESSION[$this->formFinalEmailVer] = $value;

			if ( 'tel' == $tag->basetype && $name==$this->phoneFieldKey) $_SESSION[$this->formFinalPhoneVer]  = $value;

			if ( 'text' == $tag->basetype && $name=='email_verify' || 'text' == $tag->basetype && $name=='phone_verify') 
			{
				$_SESSION[$this->formSessionTagName] = $name;
				//check if the otp verification field is empty
				if($this->checkIfVerificationCodeNotEntered($name)) $result->invalidate( $tag, wpcf7_get_message( 'invalid_required' ) );
				//check if the session variable is not true i.e. OTP Verification flow was not started
				if($this->checkIfVerificationNotStarted()) $result->invalidate( $tag, mo_(MoMessages::showMessage('PLEASE_VALIDATE')) );
				//check if the email being sent is the same email that was verified
				if($this->processEmail()) $result->invalidate( $tag, mo_(MoMessages::showMessage('EMAIL_MISMATCH')) );
				//check if the phone being sent is the same phone that was verified
				if($this->processPhoneNumber()) $result->invalidate( $tag, mo_(MoMessages::showMessage('PHONE_MISMATCH')) ); 
				// validate otp if no error
				if(empty($result->invalid_fields)) {
				if(!$this->processOTPEntered())
					$result->invalidate( $tag, MoUtility::_get_invalid_otp_method());
				else
					$this->unsetOTPSessionVariables();
				}
			}
			return $result;
		}

		function handle_failed_verification($user_login,$user_email,$phone_number)
		{
			MoUtility::checkSession();
			if(!isset($_SESSION[$this->formSessionVar])) return;
			$_SESSION[$this->formSessionVar] = 'verification_failed';	
		}

		function handle_post_verification($redirect_to,$user_login,$user_email,$password,$phone_number,$extra_data)
		{
			MoUtility::checkSession();
			if(!isset($_SESSION[$this->formSessionVar])) return;
			$_SESSION[$this->formSessionVar] = 'validated';	
		}

		function validateOTPRequest()
		{
			do_action('mo_validate_otp',$_SESSION[$this->formSessionTagName],NULL);
		}

		function processOTPEntered()
		{
			$this->validateOTPRequest();
			return strcasecmp($_SESSION[$this->formSessionVar],'validated')!=0 ? FALSE : TRUE;
		}

		function processEmail()
		{
			return array_key_exists($this->formEmailVer, $_SESSION) 
				&& strcasecmp($_SESSION[$this->formEmailVer], $_SESSION[$this->formFinalEmailVer])!=0;
		}

		function processPhoneNumber()
		{
			return array_key_exists($this->formPhoneVer, $_SESSION) 
				&& strcasecmp($_SESSION[$this->formPhoneVer], $_SESSION[$this->formFinalPhoneVer])!=0;
		}

		function checkIfVerificationNotStarted()
		{
			return !array_key_exists($this->formSessionVar,$_SESSION); 
		}

		function checkIfVerificationCodeNotEntered($name)
		{
			return !isset($_REQUEST[$name]);
		}

		function _cf7_email_shortcode()
		{
			$img   = "<div style='display:table;text-align:center;'><img src='".MOV_URL. "includes/images/loader.gif'></div>";
			$html  = '<script>jQuery(document).ready(function(){$mo=jQuery;$mo("#miniorange_otp_token_submit").click(function(o){'; 
			$html .= 'var e=$mo("input[name='.$this->emailFieldKey.']").val(); $mo("#mo_message").empty(),$mo("#mo_message").append("'.$img.'"),';
			$html .= '$mo("#mo_message").show(),$mo.ajax({url:"'.site_url().'/?option=miniorange-cf7-contact",type:"POST",data:{user_email:e},';
			$html .= 'crossDomain:!0,dataType:"json",success:function(o){ if(o.result=="success"){$mo("#mo_message").empty(),';
			$html .= '$mo("#mo_message").append(o.message),$mo("#mo_message").css("border-top","3px solid green"),';
			$html .= '$mo("input[name=email_verify]").focus()}else{$mo("#mo_message").empty(),$mo("#mo_message").append(o.message),';
			$html .= '$mo("#mo_message").css("border-top","3px solid red"),$mo("input[name=email_verify]").focus()} ;},';
			$html .= 'error:function(o,e,n){}})});});</script>';
			return $html;
		}

		function _cf7_phone_shortcode()
		{
			$img   = "<div style='display:table;text-align:center;'><img src='".MOV_URL. "includes/images/loader.gif'></div>";
			$html  = '<script>jQuery(document).ready(function(){$mo=jQuery;$mo("#miniorange_otp_token_submit").click(function(o){'; 
			$html .= 'var e=$mo("input[name='.$this->phoneFieldKey.']").val(); $mo("#mo_message").empty(),$mo("#mo_message").append("'.$img.'"),';
			$html .= '$mo("#mo_message").show(),$mo.ajax({url:"'.site_url().'/?option=miniorange-cf7-contact",type:"POST",data:{user_phone:e},';
			$html .= 'crossDomain:!0,dataType:"json",success:function(o){ if(o.result=="success"){$mo("#mo_message").empty(),';
			$html .= '$mo("#mo_message").append(o.message),$mo("#mo_message").css("border-top","3px solid green"),';
			$html .= '$mo("input[name=email_verify]").focus()}else{$mo("#mo_message").empty(),$mo("#mo_message").append(o.message),';
			$html .= '$mo("#mo_message").css("border-top","3px solid red"),$mo("input[name=phone_verify]").focus()} ;},';
			$html .= 'error:function(o,e,n){}})});});</script>';
			return $html;
		}

		public function unsetOTPSessionVariables()
		{
			unset($_SESSION[$this->txSessionId]);
			unset($_SESSION[$this->formSessionVar]);
			unset($_SESSION[$this->formEmailVer]);
			unset($_SESSION[$this->formPhoneVer]);
			unset($_SESSION[$this->formFinalEmailVer]);
			unset($_SESSION[$this->formFinalPhoneVer]);
			unset($_SESSION[$this->formSessionTagName]);
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

			update_mo_option('mo_customer_validation_cf7_contact_enable',
				isset( $_POST['mo_customer_validation_cf7_contact_enable']) ? $_POST['mo_customer_validation_cf7_contact_enable'] : 0);
			update_mo_option('mo_customer_validation_cf7_contact_type',
				isset( $_POST['mo_customer_validation_cf7_contact_type']) ? $_POST['mo_customer_validation_cf7_contact_type'] : '');
			update_mo_option('mo_customer_validation_cf7_email_key',
				isset( $_POST['cf7_email_field_key']) ? $_POST['cf7_email_field_key'] : '');
		}
	}
	new ContactForm7;