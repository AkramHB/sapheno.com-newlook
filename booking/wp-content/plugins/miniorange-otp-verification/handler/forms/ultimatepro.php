<?php

	class UltimateProRegistrationForm extends FormInterface
	{

		private $formSessionVar = FormSessionVars::ULTIMATE_PRO;
		private $formPhoneVer   = FormSessionVars::ULTIMATE_PRO_PHONE_VER;
		private $formEmailVer   = FormSessionVars::ULTIMATE_PRO_EMAIL_VER;
		private $phoneFormID 	= 'input[name=phone]';
		private $otpType;

		const TYPE_PHONE 		= 'mo_ultipro_phone_enable';
		const TYPE_EMAIL 		= 'mo_ultipro_email_enable';

		function handleForm()
		{	
			$this->otpType = get_mo_option('mo_customer_validation_ultipro_type');
			add_action("wp_ajax_nopriv_ihc_check_reg_field_ajax", array($this,"_ultipro_handle_submit"),1 );
			add_action('wp_ajax_ihc_check_reg_field_ajax', array($this,'_ultipro_handle_submit'), 1);

			if(strcasecmp($this->otpType,self::TYPE_PHONE)==0)
				add_shortcode('mo_phone', array($this,'_phone_shortcode'));
			if(strcasecmp($this->otpType,self::TYPE_EMAIL)==0)
				add_shortcode('mo_email', array($this,'_email_shortcode'));

			$this->routeData();
		}

		function routeData()
		{
			if(!array_key_exists('option', $_GET)) return;

			switch (trim($_GET['option'])) 
			{
				case "miniorange-ulti":
					$this->_handle_ulti_form($_POST);		break;
			}
		}

		public static function isFormEnabled()                                
		{
			return get_mo_option('mo_customer_validation_ultipro_enable') ? true : false;
		}

		function _ultipro_handle_submit()
		{
			$field_check_list = array('phone','user_email','validate');
			$register_msg = ihc_return_meta_arr('register-msg');

		    if (isset($_REQUEST['type']) && isset($_REQUEST['value']))
		    	echo ihc_check_value_field($_REQUEST['type'], $_REQUEST['value'], $_REQUEST['second_value'], $register_msg);
		    else if (isset($_REQUEST['fields_obj']))
		    {
		        $arr = $_REQUEST['fields_obj'];
		        foreach ($arr as $k=>$v)
		        {
		        	if(in_array($v['type'],$field_check_list))
		        		$return_arr[] = $this->validate_umpro_submitted_value($v['type'],$v['value'],$v['second_value'],$register_msg);
					else
						$return_arr[] = array( 'type' => $v['type'], 'value' => ihc_check_value_field($v['type'], 
												$v['value'], $v['second_value'], $register_msg) );
		        }
		        echo json_encode($return_arr);
		    }
		    die();
		}

		function _phone_shortcode()
		{
			$img   = "<div style='display:table;text-align:center;'><img src='".MOV_URL. "includes/images/loader.gif'></div>";
			$div   = "<div style='margin-top: 2%;'><button type='button' disabled='disabled' class='button alt' style='width:100%;height:30px;";
			$div  .= "font-family: Roboto;font-size: 12px !important;' id='miniorange_otp_token_submit' title='Please Enter an phone to enable this.'>";
			$div  .= "Click Here to Verify Phone</button></div><div style='margin-top:2%'><div id='mo_message' hidden='' ";
			$div  .= "style='background-color: #f7f6f7;padding: 1em 2em 1em 3.5em;''></div></div>";

			$html  = '<script>jQuery(document).ready(function(){$mo=jQuery; var divElement = "'.$div.'"; ';
			$html .= '$mo("input[name=phone]").change(function(){ if(!$mo(this).val()){ $mo("#miniorange_otp_token_submit").prop("disabled",true);';
			$html .= ' }else{ $mo("#miniorange_otp_token_submit").prop("disabled",false); } });';
			$html .= ' $mo(divElement).insertAfter($mo( "input[name=phone]")); $mo("#miniorange_otp_token_submit").click(function(o){ ';
			$html .= 'var e=$mo("input[name=phone]").val(); $mo("#mo_message").empty(),$mo("#mo_message").append("'.$img.'"),';
			$html .= '$mo("#mo_message").show(),$mo.ajax({url:"'.site_url().'/?option=miniorange-ulti",type:"POST",';
			$html .= 'data:{user_phone:e},crossDomain:!0,dataType:"json",success:function(o){ if(o.result=="success"){$mo("#mo_message").empty(),';
			$html .= '$mo("#mo_message").append(o.message),$mo("#mo_message").css("border-top","3px solid green"),';
			$html .= '$mo("input[name=email_verify]").focus()}else{$mo("#mo_message").empty(),$mo("#mo_message").append(o.message),';
			$html .= '$mo("#mo_message").css("border-top","3px solid red"),$mo("input[name=phone_verify]").focus()} ;},';
			$html .= 'error:function(o,e,n){}})});});</script>';
			return $html;
		}

		function _email_shortcode()
		{
			$img   = "<div style='display:table;text-align:center;'><img src='".MOV_URL. "includes/images/loader.gif'></div>";
			$div   = "<div style='margin-top: 2%;'><button type='button' disabled='disabled' class='button alt' ";
			$div  .= "style='width:100%;height:30px;font-family: Roboto;font-size: 12px !important;' id='miniorange_otp_token_submit' ";
			$div  .= "title='Please Enter an email to enable this.'>Click Here to Verify your email</button></div><div style='margin-top:2%'>";
			$div  .= "<div id='mo_message' hidden='' style='background-color: #f7f6f7;padding: 1em 2em 1em 3.5em;''></div></div>";
			$html  = '<script>jQuery(document).ready(function(){$mo=jQuery; var divElement = "'.$div.'"; ';
			$html .= '$mo("input[name=user_email]").change(function(){ if(!$mo(this).val()){ ';
			$html .= '$mo("#miniorange_otp_token_submit").prop("disabled",true); }else{ ';
			$html .= '$mo("#miniorange_otp_token_submit").prop("disabled",false); } }); ';
			$html .= '$mo(divElement).insertAfter($mo( "input[name=user_email]")); $mo("#miniorange_otp_token_submit").click(function(o){ ';
			$html .= 'var e=$mo("input[name=user_email]").val(); $mo("#mo_message").empty(),$mo("#mo_message").append("'.$img.'"),';
			$html .= '$mo("#mo_message").show(),$mo.ajax({url:"'.site_url().'/?option=miniorange-ulti",type:"POST",data:{user_phone:e},crossDomain:!0,dataType:"json",success:function(o){ if(o.result=="success"){$mo("#mo_message").empty(),$mo("#mo_message").append(o.message),$mo("#mo_message").css("border-top","3px solid green"),$mo("input[name=email_verify]").focus()}else{$mo("#mo_message").empty(),$mo("#mo_message").append(o.message),$mo("#mo_message").css("border-top","3px solid red"),$mo("input[name=phone_verify]").focus()} ;},error:function(o,e,n){}})});});</script>';	
			return $html;
		}

		function _handle_ulti_form($data)
		{
			MoUtility::checkSession();
			MoUtility::initialize_transaction($this->formSessionVar);

			if(strcasecmp($this->otpType,self::TYPE_PHONE)==0)
			{
				$_SESSION[$this->formPhoneVer] = $data['user_phone'];
				miniorange_site_challenge_otp('testuser',null,null,$data['user_phone'],"phone");
			}
			else
			{
				$_SESSION[$this->formEmailVer] = trim($data['user_email']);
				miniorange_site_challenge_otp('testuser',$data['user_email'],null,null,"email");
			}
		}

		function validate_umpro_submitted_value($type,$value,$second_value,$register_msg)
		{
			MoUtility::checkSession();
			$return = array();
			switch ($type)
			{
				case 'phone':
					$this->processPhone($return,$type,$value,$second_value,$register_msg);			break;
				case 'user_email':
					$this->processEmail($return,$type,$value,$second_value,$register_msg);			break;	
				case 'validate':
					$this->processOTPEntered($return,$type,$value,$second_value,$register_msg); 	break;
			}
			return $return;
		}

		function processPhone(&$return,$type,$value,$second_value,$register_msg)
		{
			if(strcasecmp($this->otpType,self::TYPE_PHONE)!=0)
				$return = array( 'type' => $type, 'value' => ihc_check_value_field($type, $value, $second_value, $register_msg) );
			else
				if(!array_key_exists($this->txSessionId, $_SESSION))
					$return = array( 'type' => $type, 'value' =>   MoMessages::showMessage('UMPRO_VERIFY') );
				else if(strcasecmp($_SESSION[$this->formPhoneVer], $value)!=0)
					$return = array( 'type' => $type, 'value' =>   MoMessages::showMessage('PHONE_MISMATCH') );
				else
					$return = array( 'type' => $type, 'value' => ihc_check_value_field($type, $value, $second_value, $register_msg) );				
		}

		function processEmail(&$return,$type,$value,$second_value,$register_msg)
		{
			if(strcasecmp($this->otpType,self::TYPE_EMAIL)!=0)
				$return = array( 'type' => $type, 'value' => ihc_check_value_field($type, $value, $second_value, $register_msg) );
			else
				if(!array_key_exists($this->txSessionId, $_SESSION))
					$return = array( 'type' => $type, 'value' =>   MoMessages::showMessage('UMPRO_VERIFY') );
				else if(strcasecmp($_SESSION[$this->formEmailVer], $value)!=0)
					$return = array( 'type' => $type, 'value' =>  MoMessages::showMessage('EMAIL_MISMATCH') );
				else
					$return = array( 'type' => $type, 'value' => ihc_check_value_field($type, $value, $second_value, $register_msg) );
		}

		function processOTPEntered(&$return,$type,$value,$second_value,$register_msg)
		{
			if(!array_key_exists($this->txSessionId, $_SESSION))
				$return = array( 'type' => $type, 'value' =>   MoMessages::showMessage('UMPRO_VERIFY') );
			else
				$this->validateAndProcessOTP($return,$type,$value);				
		}

		function validateOTPRequest($otpToken)
		{
			do_action('mo_validate_otp',NULL,$otpToken);
		}

		function validateAndProcessOTP(&$return,$type,$otpToken)
		{
			$this->validateOTPRequest($otpToken);
			if(strcasecmp($_SESSION[$this->formSessionVar], 'validated') != 0)
				$return = array( 'type' => $type, 'value' =>  MoUtility::_get_invalid_otp_method() );
			else
			{
				$this->unsetOTPSessionVariables();
				$return = array( 'type' => $type, 'value' => 1 );
			}
		}

		function handle_failed_verification($user_login,$user_email,$phone_number)
		{
			MoUtility::checkSession();
			if(!isset($_SESSION[$this->formSessionVar])) return;
			$_SESSION[$this->formSessionVar] = 'failed';
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

			update_mo_option('mo_customer_validation_ultipro_enable',
				isset( $_POST['mo_customer_validation_ultipro_enable']) ? $_POST['mo_customer_validation_ultipro_enable'] : 0);
			update_mo_option('mo_customer_validation_ultipro_type',
				isset( $_POST['mo_customer_validation_ultipro_type']) ? $_POST['mo_customer_validation_ultipro_type'] : '');
	    }
	}
	new UltimateProRegistrationForm;