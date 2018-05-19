<?php

	class CalderaForms extends FormInterface
	{
        private $formSessionVar        = FormSessionVars:: CALDERA;
		private $formEmailVer 		   = FormSessionVars:: CALDERA_EMAIL_VER;	
		private $formPhoneVer		   = FormSessionVars:: CALDERA_PHONE_VER;
		private $otpType;
		private $listOfForms;
        private $phoneFormID = array();
        private $buttonText;

		const TYPE_PHONE 		= 'mo_caldera_phone_enable';
		const TYPE_EMAIL 		= 'mo_caldera_email_enable';

		function handleForm()
		{	
			$this->otpType = get_mo_option('mo_customer_validation_caldera_enable_type');
            $this->listOfForms = maybe_unserialize(get_mo_option('mo_customer_validation_caldera_forms'));
            $this->buttonText = get_mo_option('mo_customer_validation_caldera_button_text');
			$this->buttonText = !MoUtility::isBlank($this->buttonText) ? $this->buttonText : mo_("Click Here to send OTP");

			foreach ($this->listOfForms as $key => $value) {
                array_push($this->phoneFormID,'input[name='.$value["phonekey"]);
                add_filter( 'caldera_forms_validate_field_'.$value["phonekey"], array($this,'validateForm'),99,3);
                add_filter( 'caldera_forms_validate_field_'.$value["emailkey"], array($this,'validateForm'),99,3);			        
                add_filter( 'caldera_forms_validate_field_'.$value["verifyKey"], array($this,'validateForm'),99,3);			        
			}
            add_filter( 'caldera_forms_render_field_structure', array($this,'showVerificationButton'),99,2);			
			$this->routeData();
		}

		public static function isFormEnabled() 
		{
			return get_mo_option('mo_customer_validation_caldera_enable') ? true : false;
		}

		private function routeData()
		{
			if(!array_key_exists('option', $_GET)) return;
			switch (trim($_GET['option'])) 
			{
				case "miniorange-calderaforms":
					$this->_send_otp($_POST);		break;
			}
		}

		function _send_otp($data)
		{
			MoUtility::checkSession();
			MoUtility::initialize_transaction($this->formSessionVar);
			if($this->otpType==self::TYPE_PHONE)
				$this->_processPhoneAndStartOTPVerificationProcess($data);
			else
				$this->_processEmailAndStartOTPVerificationProcess($data);
		}

		private function _processEmailAndStartOTPVerificationProcess($data)
		{
			if(!array_key_exists('user_email', $data) || !isset($data['user_email']))
				wp_send_json( MoUtility::_create_json_response(MoMessages::showMessage('ENTER_EMAIL'),MoConstants::ERROR_JSON_TYPE) );
			else
				$this->setSessionAndStartOTPVerification($data['user_email'],$data['user_email'],NULL,"email");
		}

		private function _processPhoneAndStartOTPVerificationProcess($data)
		{
			if(!array_key_exists('user_phone', $data) || !isset($data['user_phone']))
				wp_send_json( MoUtility::_create_json_response(MoMessages::showMessage('ENTER_PHONE'),MoConstants::ERROR_JSON_TYPE) );
			else
				$this->setSessionAndStartOTPVerification(trim($data['user_phone']),NULL,trim($data['user_phone']),"phone");		
		}

		private function setSessionAndStartOTPVerification($sessionvalue,$useremail,$phoneNumber,$otpType)
		{
			$_SESSION[ strcasecmp($this->otpType,self::TYPE_PHONE)==0 ? $this->formPhoneVer : $this->formEmailVer ] = $sessionvalue;
			miniorange_site_challenge_otp('testUser',$useremail,NULL,$phoneNumber,$otpType);
		}

		public function showVerificationButton($field_structure,$form)
		{
			$formId = $form['ID'];
			if(!array_key_exists($formId,$this->listOfForms)) return $field_structure;
            $formData = $this->listOfForms[$formId];
			if($this->otpType==self::TYPE_PHONE && strcasecmp($field_structure['field']['ID'],$formData['phonekey'])==0) {
				$field_structure['field_after'] = $this->getButtonAndScriptCode('phone',$formData);
			}
			elseif($this->otpType==self::TYPE_EMAIL && strcasecmp($field_structure['field']['ID'],$formData['emailkey'])==0) {
				$field_structure['field_after'] = $this->getButtonAndScriptCode('email',$formData);
            }
            return $field_structure;
		}

		private function getButtonAndScriptCode($mo_type,$formData)
		{
            $button_title = $mo_type == "phone" ? mo_("Please Enter your phone details to enable this.") :  mo_("Please Enter your email to enable this.");
			$img = "<div style='display:table;text-align:center;'><img src='".MOV_URL. "includes/images/loader.gif'></div>";
			$field_content = '</div><div style="margin-top: 2%;"><div class=""><button type="button" style="width:100%;"';
			$field_content .= 'class="btn btn-default" id="miniorange_otp_token_submit" title="'.$button_title.'">';
			$field_content .= $this->buttonText.'</button></div></div><div style="margin-top:2%">';
			$field_content .= '<div id="mo_message" hidden="" style="background-color: #f7f6f7;padding: 1em 2em 1em 3.5em;"></div></div>';
			$field_content .= '<script>jQuery(document).ready(function(){$mo=jQuery;$mo("#miniorange_otp_token_submit").click(function(o){'; 
			$field_content .= 'var e=$mo("input[name='.$formData[$mo_type."key"].'").val();';
			$field_content .= '$mo("#mo_message").empty(),$mo("#mo_message").append("'.$img.'")';
			$field_content .= ',$mo("#mo_message").show(),$mo.ajax({url:"'.site_url().'/?option=miniorange-calderaforms",type:"POST",data:{user_';
			$field_content .= $mo_type.':e},crossDomain:!0,dataType:"json",success:function(o){ if(o.result=="success"){$mo("#mo_message").empty()';
			$field_content .= ',$mo("#mo_message").append(o.message),$mo("#mo_message").css("border-top","3px solid green"),$mo("';
			$field_content .= 'input[name='.$formData[$mo_type."key"].'").focus()}else{$mo("#mo_message").empty(),$mo("#mo_message").append(o.message),';
			$field_content .= '$mo("#mo_message").css("border-top","3px solid red"),';
			$field_content .= '$mo("input[name='.$formData["verifyKey"].'").focus()} ;},';
			$field_content .= 'error:function(o,e,n){}})});});</script>';
			return $field_content;
		}

		public function validateForm($entry, $field, $form)
		{
			if(is_wp_error( $entry ) ) return $entry;
			$id = $form['ID'];
			if(!array_key_exists($id,$this->listOfForms)) return;
			$formData = $this->listOfForms[$id];
			MoUtility::checkSession();
            $entry = $this->checkIfOtpVerificationStarted($entry);

			if(is_wp_error($entry)) return $entry;
			if(strcasecmp($this->otpType,self::TYPE_EMAIL)==0 && strcasecmp($field['ID'],$formData['emailkey'])==0)
				$entry= $this->processEmail($entry);
			if(strcasecmp($this->otpType,self::TYPE_PHONE)==0 && strcasecmp($field['ID'],$formData['phonekey'])==0)
				$entry = $this->processPhone($entry);

			if(empty($errors) && strcasecmp($field['ID'],$formData['verifyKey'])==0) 
				$entry = $this->processOTPEntered($entry);
			return $entry;
		}

		function processOTPEntered($entry)
		{
			do_action('mo_validate_otp',NULL,$entry);
			if(strcasecmp($_SESSION[$this->formSessionVar],'validated')!=0)
				$entry = new WP_Error('INVALID_OTP',MoUtility::_get_invalid_otp_method());
			else
				$this->unsetOTPSessionVariables();
			return $entry;
		}

		function checkIfOtpVerificationStarted($entry)
		{
			if(array_key_exists($this->formSessionVar, $_SESSION)) return $entry;
			if(strcasecmp($this->otpType,self::TYPE_EMAIL)==0)
				return new WP_Error('ENTER_VERIFY_CODE',MoMessages::showMessage('ENTER_VERIFY_CODE'));
			else
                return new WP_Error('ENTER_VERIFY_CODE',MoMessages::showMessage('ENTER_VERIFY_CODE'));
			return $entry;
		}

		function processEmail($entry)
		{
			return $_SESSION[$this->formEmailVer]!=$entry ? new WP_Error('EMAIL_MISMATCH',MoMessages::showMessage('EMAIL_MISMATCH')) : $entry;
		}

		function processPhone($entry)
		{
			return $_SESSION[$this->formPhoneVer]!=$entry ? new WP_Error('PHONE_MISMATCH',MoMessages::showMessage('PHONE_MISMATCH')) : $entry;
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
			if(self::isFormEnabled() && $this->otpType==self::TYPE_PHONE) 
				$selector = array_merge($selector, $this->phoneFormID); 
			return $selector;
		}

		function handleFormOptions()
	    {
            if(!MoUtility::areFormOptionsBeingSaved()) return;

            foreach (array_filter($_POST['caldera']['form']) as $key => $value)
			{
				$form[$value]= array(
					'emailkey'=> $_POST['caldera']['emailkey'][$key],
					'phonekey'=> $_POST['caldera']['phonekey'][$key],
					'verifyKey'=> $_POST['caldera']['verifyKey'][$key],
				);
			}

			update_mo_option('mo_customer_validation_caldera_enable',
				isset( $_POST['mo_customer_validation_caldera_enable']) ? $_POST['mo_customer_validation_caldera_enable'] : 0);
			update_mo_option('mo_customer_validation_caldera_enable_type',
                isset( $_POST['mo_customer_validation_caldera_enable_type']) ? $_POST['mo_customer_validation_caldera_enable_type'] : '');
            update_mo_option('mo_customer_validation_caldera_button_text',
				isset($_POST['mo_customer_validation_caldera_button_text']) ? $_POST['mo_customer_validation_caldera_button_text'] : '');
			update_mo_option('mo_customer_validation_caldera_forms',!empty($form) ? maybe_serialize($form) : "");
		}

	}
	new CalderaForms;

