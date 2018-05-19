<?php

	class WpMemberForm extends FormInterface
	{	
		private $formSessionVar = FormSessionVars::WPMEMBER_REG;
		private $formPhoneVer   = FormSessionVars::WPM_PHONE_VER;
		private $formEmailVer   = FormSessionVars::WPM_EMAIL_VER;
		private $emailFieldKey  = 'user_email'; 
		private $phoneFieldKey  = 'phone1';
		private $phoneFormID 	= 'input[name=phone1]';
		private $otpType;

		const TYPE_PHONE 		= 'mo_wpmember_reg_phone_enable';
		const TYPE_EMAIL 		= 'mo_wpmember_reg_email_enable';

		function handleForm()
		{
			$this->otpType = get_mo_option('mo_customer_validation_wp_member_reg_enable_type');
			add_filter('wpmem_register_form_rows', array($this,'wpmember_add_button'),99,2);
			add_action('wpmem_pre_register_data', array($this,'validate_wpmember_submit'),99,1);

			$this->routeData();
		}

		function routeData()
		{
			if(!array_key_exists('option', $_REQUEST)) return;
			switch (trim($_REQUEST['option'])) 
			{
				case "miniorange-wpmember-form":
					$this->_handle_wp_member_form($_POST);		break;
			}
		}

		public static function isFormEnabled()                                
		{
			return get_mo_option('mo_customer_validation_wp_member_reg_enable') ? true : false;
		}

		function _handle_wp_member_form($data)
		{		
			MoUtility::checkSession();
			MoUtility::initialize_transaction($this->formSessionVar);

			$this->processEmailAndStartOTPVerificationProcess($data);
			$this->processPhoneAndStartOTPVerificationProcess($data);
			$this->sendErrorMessageIfOTPVerificationNotStarted();
		}

		function processEmailAndStartOTPVerificationProcess($data)
		{
			if(!array_key_exists('user_phone', $data) || !isset($data['user_phone'])) return;

			$_SESSION[$this->formPhoneVer] = $data['user_phone'];
			miniorange_site_challenge_otp(null,'',null,$data['user_phone'],"phone",null,null,false);
		}

		function processPhoneAndStartOTPVerificationProcess($data)
		{
			if(!array_key_exists($this->emailFieldKey, $data) || !isset($data[$this->emailFieldKey])) return;

			$_SESSION[$this->formEmailVer] = $data[$this->emailFieldKey];
			miniorange_site_challenge_otp(null,$data[$this->emailFieldKey],null,'',"email",null,null,false);
		}

		function sendErrorMessageIfOTPVerificationNotStarted()
		{
			if(strcasecmp($this->otpType,self::TYPE_PHONE)==0)
				wp_send_json( MoUtility::_create_json_response( MoMessages::showMessage('ENTER_PHONE'),MoConstants::ERROR_JSON_TYPE) );
			else
				wp_send_json( MoUtility::_create_json_response( MoMessages::showMessage('ENTER_EMAIL'),MoConstants::ERROR_JSON_TYPE) );
		}

		function wpmember_add_button($rows, $tag)
		{
			foreach($rows as $key=>$field)
			{
				if(strcasecmp($this->otpType,self::TYPE_PHONE)==0 && $key=="phone1")
				{
					$rows[$key]['field'] .= $this->_add_shortcode_to_wpmember("phone",$field['meta']);
					break;
				}
				else if(strcasecmp($this->otpType,self::TYPE_EMAIL)==0 && $key=="user_email")
				{
					$rows[$key]['field'] .= $this->_add_shortcode_to_wpmember("email",$field['meta']);
					break;
				}			
			}
			return $rows;
		}

		function validate_wpmember_submit($fields)
		{
			global $wpmem_themsg; 
			MoUtility::checkSession();
			if(!array_key_exists($this->txSessionId, $_SESSION)) $wpmem_themsg =  MoMessages::showMessage('PLEASE_VALIDATE');

			if(!$this->validate_submitted($fields)) return;

			do_action('mo_validate_otp',NULL,$fields['validate_otp']);
		}

		function validate_submitted($fields)
		{
			global $wpmem_themsg;
			MoUtility::checkSession();
			if(array_key_exists($this->formEmailVer, $_SESSION) && strcasecmp($_SESSION[$this->formEmailVer], $fields[$this->emailFieldKey])!=0)
			{
				$wpmem_themsg =  MoMessages::showMessage('EMAIL_MISMATCH');
				return false;
			}
			else if(array_key_exists($this->formPhoneVer, $_SESSION) && strcasecmp($_SESSION[$this->formPhoneVer], $fields[$this->phoneFieldKey])!=0)
			{	
				$wpmem_themsg =  MoMessages::showMessage('PHONE_MISMATCH');
				return false;
			}
			else
				return true;
		}

		function _add_shortcode_to_wpmember($mo_type,$field) 
		{
			$img  			= "<div style='display:table;text-align:center;'><img src='".MOV_URL. "includes/images/loader.gif'></div>";
			$field_content  = "<div style='margin-top: 2%;'><button type='button' class='button alt' style='width:100%;height:30px;";
			$field_content .= "font-family: Roboto;font-size: 12px !important;' id='miniorange_otp_token_submit' ";
			$field_content .= "title='Please Enter an '".$mo_type."'to enable this.'>Click Here to Verify ". $mo_type."</button></div>";
			$field_content .= "<div style='margin-top:2%'><div id='mo_message' hidden='' style='background-color: #f7f6f7;padding: ";
			$field_content .= "1em 2em 1em 3.5em;'></div></div>";
			$field_content .= '<script>jQuery(document).ready(function(){$mo=jQuery;$mo("#miniorange_otp_token_submit").click(function(o){ ';
			$field_content .= 'var e=$mo("input[name='.$field.']").val(); $mo("#mo_message").empty(),$mo("#mo_message").append("'.$img.'"),';
			$field_content .= '$mo("#mo_message").show(),$mo.ajax({url:"'.site_url().'/?option=miniorange-wpmember-form",type:"POST",';
			$field_content .= 'data:{user_'.$mo_type.':e},crossDomain:!0,dataType:"json",success:function(o){ ';
			$field_content .= 'if(o.result=="success"){$mo("#mo_message").empty(),$mo("#mo_message").append(o.message),';
			$field_content .= '$mo("#mo_message").css("border-top","3px solid green"),$mo("input[name=email_verify]").focus()}else{';
			$field_content .= '$mo("#mo_message").empty(),$mo("#mo_message").append(o.message),$mo("#mo_message").css("border-top","3px solid red")';
			$field_content .= ',$mo("input[name=phone_verify]").focus()} ;},error:function(o,e,n){}})});});</script>';

			return $field_content;
		}

		function handle_failed_verification($user_login,$user_email,$phone_number)
		{
			global $wpmem_themsg; 
			MoUtility::checkSession();
			if(!isset($_SESSION[$this->formSessionVar])) return;
			$wpmem_themsg =  MoUtility::_get_invalid_otp_method();
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

			update_mo_option('mo_customer_validation_wp_member_reg_enable',
				isset( $_POST['mo_customer_validation_wp_member_reg_enable']) ? $_POST['mo_customer_validation_wp_member_reg_enable'] : 0);
			update_mo_option('mo_customer_validation_wp_member_reg_enable_type',
				isset( $_POST['mo_customer_validation_wp_member_reg_enable_type']) ? $_POST['mo_customer_validation_wp_member_reg_enable_type'] : '');
		}
	}
	new WpMemberForm;

