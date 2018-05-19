<?php

	class UserProRegistrationForm extends FormInterface
	{
		private $formSessionVar = FormSessionVars::USERPRO_FORM;
		private $formEmailVer 	= FormSessionVars::USERPRO_EMAIL_VER;
		private $formPhoneVer 	= FormSessionVars::USERPRO_PHONE_VER;
		private $userAjaxCheck	= "mo_phone_validation";
		private $userFieldMeta  = "verification_form";
		private $phoneFormID 	= "input[data-label='Phone Number']";
		private $otpType;

		const TYPE_PHONE 		= 'mo_userpro_registration_phone_enable';
		const TYPE_EMAIL 		= 'mo_userpro_registration_email_enable';

		function handleForm()
		{
			$this->otpType = get_mo_option('mo_customer_validation_userpro_enable_type');
			if(strcasecmp($this->otpType,self::TYPE_PHONE)==0)
			{
				add_action('wp_ajax_userpro_side_validate', array($this,'validate_userpro_phone'),1);
				add_action('wp_ajax_nopriv_userpro_side_validate', array($this,'validate_userpro_phone'),1);
			}

			add_filter('userpro_register_validation',array($this,'_process_userpro_form_submit'),1,2);
			add_action('userpro_after_new_registration',array($this,'_auto_verify_user'),1,1);
			add_shortcode('mo_verify_email_userpro', array($this,'_userpro_email_shortcode') );
			add_shortcode('mo_verify_phone_userpro', array($this,'_userpro_phone_shortcode') );

			$this->routeData();
		}

		function routeData()
		{
			if(!array_key_exists('option', $_GET)) return;
			switch (trim($_GET['option'])) 
			{
				case "miniorange-userpro-form":
					$this->_send_otp($_POST);			break;
			}
		}

		public static function isFormEnabled() 
		{
			return get_mo_option('mo_customer_validation_userpro_default_enable') ? true : false;
		}

		function _auto_verify_user($user_id)
		{
			if(get_mo_option('mo_customer_validation_userpro_verify')) update_user_meta($user_id,'userpro_verified', 1);
		}

		function validate_userpro_phone()
		{
			global $phoneLogic;
			if($this->checkIfUserHasNotSubmittedTheFormForValidation()) return;

			$message = MoUtility::_get_invalid_otp_method();
			if(strcasecmp($_POST['ajaxcheck'],$this->userAjaxCheck)!=0) return;
			if(!MoUtility::validatePhoneNumber("+".trim($_POST['input_value']))) wp_send_json(array('error'=>$message));
		}

		function checkIfUserHasNotSubmittedTheFormForValidation()
		{
			return isset($_POST['action']) && isset($_POST['ajaxcheck']) 
					&& isset($_POST['input_value']) && $_POST['action'] != 'userpro_side_validate' ? TRUE : FALSE;
		}

		function _send_otp($getdata)
		{
			MoUtility::checkSession();
			MoUtility::initialize_transaction($this->formSessionVar);
			$this->processEmailAndStartOTPVerificationProcess($getdata);
			$this->processPhoneAndStartOTPVerificationProcess($getdata);
			$this->sendErrorMessageIfOTPVerificationNotStarted();
		}

		function processEmailAndStartOTPVerificationProcess($getdata)
		{
			if(!array_key_exists('user_email', $getdata) || !isset($getdata['user_email'])) return;

			$_SESSION[$this->formEmailVer] = $getdata['user_email'];
			miniorange_site_challenge_otp('testuser',$getdata['user_email'],null,$getdata['user_email'],"email");
		}

		function processPhoneAndStartOTPVerificationProcess($getdata)
		{
			if(!array_key_exists('user_phone', $getdata) || !isset($getdata['user_phone'])) return;

			$_SESSION[$this->formPhoneVer] = trim($getdata['user_phone']);
			miniorange_site_challenge_otp('testuser','',null, trim($getdata['user_phone']),"phone");
		}

		function sendErrorMessageIfOTPVerificationNotStarted()
		{
			if(strcasecmp($this->otpType,self::TYPE_PHONE)==0)
				wp_send_json( MoUtility::_create_json_response( MoMessages::showMessage('ENTER_PHONE'),MoConstants::ERROR_JSON_TYPE) );
			else
				wp_send_json( MoUtility::_create_json_response( MoMessages::showMessage('ENTER_EMAIL'),MoConstants::ERROR_JSON_TYPE) );
		}

		function _process_userpro_form_submit($output,$form)
		{
			MoUtility::checkSession();

			if(!$this->checkIfValidFormSubmition($output,$form)) return $output;

			if(array_key_exists($this->formEmailVer, $_SESSION) && strcasecmp($_SESSION[$this->formEmailVer], $form['user_email'])!=0)
				$output['user_email'] =  MoMessages::showMessage('EMAIL_MISMATCH');

			if(array_key_exists($this->formPhoneVer, $_SESSION) && strcasecmp($_SESSION[$this->formPhoneVer], $form['phone_number'])!=0)
				$output['phone_number'] =  MoMessages::showMessage('PHONE_MISMATCH');

			$this->processOTPEntered($output,$form);
			return $output;
		}

		function checkIfValidFormSubmition(&$output,$form)
		{
			if(!array_key_exists($this->formSessionVar, $_SESSION) && array_key_exists($this->userFieldMeta,$form))
			{
				$output[$this->userFieldMeta] =  MoMessages::showMessage('USERPRO_VERIFY');
				return FALSE;
			}
			return TRUE;
		}

		function validateOTPRequest($value)
		{
			do_action('mo_validate_otp',NULL,$value);
		}

		function processOTPEntered(&$output,$form)
		{
			if(!empty($output)) return;
			$this->validateOTPRequest($form[$this->userFieldMeta]);
			if(strcasecmp($_SESSION[$this->formSessionVar],'validated') != 0) 
				$output[$this->userFieldMeta] = MoUtility::_get_invalid_otp_method();
			else
				$this->unsetOTPSessionVariables();
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

		function _userpro_phone_shortcode()
		{
			$img 			 = "<div style='display:table;text-align:center;'><img src='".MOV_URL. "includes/images/loader.gif'></div>";
			$htmlcontent 	 = "<div style='margin-top: 2%;'><button type='button' class='button alt' style='width:100%;height:30px;";
			$htmlcontent 	.= "font-family: Roboto;font-size: 12px !important;' id='miniorange_otp_token_submit' ";
			$htmlcontent  	.= "title='".mo_('Please Enter a phone number to enable this')."'>".mo_('Click Here to Verify Phone')."</button></div>";
			$htmlcontent 	.= "<div style='margin-top:2%'><div id='mo_message' hidden='' style='background-color: "; 
			$htmlcontent	.= "#f7f6f7;padding: 1em 2em 1em 3.5em;''></div></div>";
			$html 		 	 = '<script>jQuery(document).click(function(e){$mo=jQuery;if($mo("#miniorange_otp_token_submit").length==0){';
			$html 			.= 'var unique_id=$mo("#unique_id").val();var phone_field="#phone_number-"+unique_id;if($mo(phone_field).length)';
			$html 			.= '$mo("'.$htmlcontent.'").insertAfter(phone_field);}if(e.target.id=="miniorange_otp_token_submit"){';
			$html 			.= 'var unique_id=$mo("#unique_id").val();var phone_field="phone_number-"+unique_id;var ';
			$html 			.= 'e=$mo("input[name="+phone_field+"]").val();$mo("#mo_message").empty(),$mo("#mo_message").append("'.$img.'"),';
			$html 			.= '$mo("#mo_message").show(),$mo.ajax({url:"'.site_url().'/?option=miniorange-userpro-form",type:"POST",data:{';
			$html 			.= 'user_phone:e},crossDomain:!0,dataType:"json",success:function(o){if(o.result=="success"){$mo("#mo_message").empty(),';
			$html 			.= '$mo("#mo_message").append(o.message),$mo("#mo_message").css("border-top","3px solid green"),';
			$html 			.= '$mo("input[name=email_verify]").focus()}else{$mo("#mo_message").empty(),$mo("#mo_message").append(o.message),';
			$html 			.= '$mo("#mo_message").css("border-top","3px solid red"),$mo("input[name=phone_verify]").focus()};},';
			$html 			.= 'error:function(o,e,n){}});}});</script>';
			return $html;
		}	

		function _userpro_email_shortcode()
		{
			$img 			= "<div style='display:table;text-align:center;'><img src='".MOV_URL. "includes/images/loader.gif'></div>";
			$htmlcontent 	= "<div style='margin-top: 2%;'><button type='button' class='button alt' style='width:100%;height:30px;";
			$htmlcontent   .= "font-family: Roboto;font-size: 12px !important;' id='miniorange_otp_token_submit' ";
			$htmlcontent   .= "title='".mo_('Please Enter a email to enable this.')."'>".mo_('Click Here to Verify Email')."</button></div>";
			$htmlcontent   .= "<div style='margin-top:2%'><div id='mo_message' hidden='' style='background-color: #f7f6f7;";
			$htmlcontent   .= "padding: 1em 2em 1em 3.5em;''></div></div>";
			$html 			= '<script>jQuery(document).click(function(e){$mo=jQuery;if($mo("#miniorange_otp_token_submit").length==0){';
			$html 		   .= 'var unique_id=$mo("#unique_id").val();var email_field="#user_email-"+unique_id;if($mo(email_field).length)';
			$html 		   .= '$mo("'.$htmlcontent.'").insertAfter(email_field);}if(e.target.id=="miniorange_otp_token_submit"){';
			$html 		   .= 'var unique_id=$mo("#unique_id").val();var email_field="user_email-"+unique_id;var e=';
			$html 		   .= '$mo("input[name="+email_field+"]").val();$mo("#mo_message").empty(),$mo("#mo_message").append("'.$img.'"),';
			$html 		   .= '$mo("#mo_message").show(),$mo.ajax({url:"'.site_url().'/?option=miniorange-userpro-form",type:"POST",';
			$html 		   .= 'data:{user_email:e},crossDomain:!0,dataType:"json",success:function(o){if(o.result=="success"){';
			$html 		   .= '$mo("#mo_message").empty(),$mo("#mo_message").append(o.message),$mo("#mo_message").css("border-top",';
			$html 		   .= '"3px solid green"),$mo("input[name=email_verify]").focus()}else{$mo("#mo_message").empty(),';
			$html 		   .= '$mo("#mo_message").append(o.message),$mo("#mo_message").css("border-top","3px solid red"),';
			$html 		   .= '$mo("input[name=phone_verify]").focus()};},error:function(o,e,n){}});}});</script>';
			return $html;
		}

		public function unsetOTPSessionVariables()
		{
			unset($_SESSION[$this->txSessionId]);
			unset($_SESSION[$this->formSessionVar]);
			unset($_SESSION[$this->formEmailVer]);
			unset($_SESSION[$this->formPhoneVer]);
		}

		public function is_ajax_form_in_play($isAjax)
		{
			MoUtility::checkSession();
			return isset($_SESSION[$this->formSessionVar]) ? TRUE : $isAjax;
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

			update_mo_option('mo_customer_validation_userpro_default_enable',
				isset( $_POST['mo_customer_validation_userpro_registration_enable']) ? $_POST['mo_customer_validation_userpro_registration_enable'] : 0);
			update_mo_option('mo_customer_validation_userpro_enable_type',
				isset( $_POST['mo_customer_validation_userpro_registration_type']) ? $_POST['mo_customer_validation_userpro_registration_type'] : '');
			update_mo_option('mo_customer_validation_userpro_verify',
				isset( $_POST['mo_customer_validation_userpro_verify']) ? $_POST['mo_customer_validation_userpro_verify'] : 0);
	    }
	}
	new UserProRegistrationForm;