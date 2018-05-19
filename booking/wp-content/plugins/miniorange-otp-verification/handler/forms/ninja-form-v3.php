<?php 

	class NinJaFormAjaxForm extends FormInterface
	{
		private $formSessionVar 	= FormSessionVars::NINJA_FORM_AJAX;
		private $formEmailVer 		= FormSessionVars::NINJA_FORM_AJAX_EMAIL;
		private $formPhoneVer 		= FormSessionVars::NINJA_FORM_AJAX_PHONE;
		private $ninjaFormSessionId = 'nja_form_id';
		private $otpType;
		private $ninjaForms;
		private $phoneFormID		= array();

		const TYPE_PHONE 		= 'mo_ninja_form_phone_enable';
		const TYPE_EMAIL 		= 'mo_ninja_form_email_enable';

		function handleForm()
		{
			$this->otpType = get_mo_option('mo_customer_validation_ninja_form_enable_type');
			$this->ninjaForms = maybe_unserialize(get_mo_option('mo_customer_validation_ninja_form_otp_enabled'));

			foreach ($this->ninjaForms as $key => $value) {
				array_push($this->phoneFormID,'input[name=nf-field-'.$value['phonekey'].']');
			}

			add_action( 'ninja_forms_after_form_display'	, array($this,'enqueue_nj_form_script'),  99 , 1);
			add_filter( 'ninja_forms_submit_data'			, array($this,'_handle_nj_ajax_form_submit') , 99 ,1);
			add_filter( 'ninja_forms_display_fields'		, array($this,'_add_button') ,99,1);
			add_filter( 'ninja_forms_display_form_settings'	, array($this,'setFormId') ,99 ,2);

			$this->routeData();
		}

		function routeData()
		{
			if(!array_key_exists('option', $_GET)) return;
			switch (trim($_GET['option'])) 
			{
				case "miniorange-nj-ajax-verify":
					$this->_send_otp_nj_ajax_verify($_POST);		break;
			}
		}

		function enqueue_nj_form_script($form_id)
		{
			if(array_key_exists($form_id,$this->ninjaForms))
			{
				$formdata = $this->ninjaForms[$form_id];
				wp_register_script( 'njscript', MOV_URL . 'includes/js/ninjaformajax.min.js', array('jquery'), MOV_VERSION, true );
				wp_localize_script('njscript', 'moninjavars', array(
					'imgURL'		=> MOV_URL. "includes/images/loader.gif",
					'key'     		=> 	$this->otpType==self::TYPE_PHONE 
											? "nf-field-".$formdata['phonekey'] : "nf-field-".$formdata['emailkey'],
					'fieldName'		=> 	$this->otpType==self::TYPE_PHONE
											? "phone number" : "email",	
					'verifyField'	=>	get_mo_option('mo_customer_validation_nfa_verify_field'),
					'siteURL' 		=> 	site_url(),
				));
				wp_enqueue_script('njscript');
			}
			return $form_id;
		}

		public static function isFormEnabled()
		{
			return get_mo_option('mo_customer_validation_nja_enable') ? true : false;
		}

		function setFormId($settings,$form_id)
		{
			MoUtility::checkSession();
			$_SESSION[$this->ninjaFormSessionId] = $form_id; 
			return $settings;
		}

		function _add_button($fields)
		{
			MoUtility::checkSession();

			if(!array_key_exists($_SESSION[$this->ninjaFormSessionId],$this->ninjaForms)) return $fields;	

			$formdata = $this->ninjaForms[$_SESSION[$this->ninjaFormSessionId]];
			$fieldName = $this->otpType==self::TYPE_PHONE ? "phone number" : "email";
			$fieldKey = $this->otpType==self::TYPE_PHONE ? "phonekey" : "emailkey";

			foreach ($fields as $key => $field) 
			{
				if($field['id']==$formdata[$fieldKey]){
					$fields[$key]['afterField']='<div id="nf-field-4-container" class="nf-field-container submit-container  label-above ">
					<div class="nf-before-field"><nf-section></nf-section></div><div class="nf-field"><div class="field-wrap submit-wrap">
					<div class="nf-field-label"></div><div class="nf-field-element"><input id="miniorange_otp_token_submit" class="ninja-forms-field nf-element" 
					value="Verify your '.$fieldName.'" type="button"></div></div></div><div class="nf-after-field"><nf-section><div class="nf-input-limit">
					</div><div class="nf-error-wrap nf-error"></div></nf-section></div></div>
					<div id="mo_message" hidden="" style="background-color: #f7f6f7;padding: 1em 2em 1em 3.5em;"></div>';
				}
			}

			return $fields;
		}

		function _handle_nj_ajax_form_submit($data)
		{
			MoUtility::checkSession();

			if(!array_key_exists($data['id'],$this->ninjaForms)) return $data;

			$formdata = $this->ninjaForms[$data['id']];
			$data = $this->checkIfOtpVerificationStarted($formdata,$data);

			if(isset($data['errors']['fields'])) return $data;

			if(strcasecmp($this->otpType,self::TYPE_EMAIL)==0)
				$data = $this->processEmail($formdata,$data);
			if(strcasecmp($this->otpType,self::TYPE_PHONE)==0)
				$data = $this->processPhone($formdata,$data);
			if(!isset($data['errors']['fields']))
				$data = $this->processOTPEntered($data,$formdata);	

			return $data;
		}

		function validateOTPRequest($value)
		{
			do_action('mo_validate_otp',NULL,$value);
		}

		function processOTPEntered($data,$formdata)
		{
			$verify_field = $formdata['verifyKey'];	
			$this->validateOTPRequest($data['fields'][$verify_field]['value']);
			if(strcasecmp($_SESSION[$this->formSessionVar],'validated')!=0)
				$data['errors']['fields'][$verify_field]=MoUtility::_get_invalid_otp_method();
			else
				$this->unsetOTPSessionVariables();
			return $data;
		}

		function checkIfOtpVerificationStarted($formdata,$data)
		{
			if(array_key_exists($this->formSessionVar, $_SESSION)) return $data;

			if(strcasecmp($this->otpType,self::TYPE_EMAIL)==0)
				$data['errors']['fields'][$formdata['emailkey']]=MoMessages::showMessage('ENTER_VERIFY_CODE');
			else
				$data['errors']['fields'][$formdata['phonekey']]=MoMessages::showMessage('ENTER_VERIFY_CODE');

			return $data;
		}

		function processEmail($formdata,$data)
		{
			$field_id = $formdata['emailkey'];
			if($_SESSION[$this->formEmailVer]!=$data['fields'][$field_id]['value'])
				$data['errors']['fields'][$field_id]=MoMessages::showMessage('EMAIL_MISMATCH');
			return $data;
		}

		function processPhone($formdata,$data)
		{
			$field_id = $formdata['phonekey'];
			if($_SESSION[$this->formPhoneVer]!= $data['fields'][$field_id]['value'])
				$data['errors']['fields'][$field_id]=MoMessages::showMessage('PHONE_MISMATCH');
			return $data;
		}

		function _send_otp_nj_ajax_verify($data)
		{
			MoUtility::checkSession();
			MoUtility::initialize_transaction($this->formSessionVar);
			if($this->otpType==self::TYPE_PHONE)
				$this->_send_nj_ajax_otp_to_phone($data);
			else
				$this->_send_nj_ajax_otp_to_email($data);
		}

		function _send_nj_ajax_otp_to_phone($data)
		{
			if(!array_key_exists('user_phone', $data) || !isset($data['user_phone']))
				wp_send_json( MoUtility::_create_json_response(MoMessages::showMessage('ENTER_PHONE'),MoConstants::ERROR_JSON_TYPE) );
			else
				$this->setSessionAndStartOTPVerification(trim($data['user_phone']),NULL,trim($data['user_phone']),"phone");
		}

		function _send_nj_ajax_otp_to_email($data)
		{
			if(!array_key_exists('user_email', $data) || !isset($data['user_email']))
				wp_send_json( MoUtility::_create_json_response(MoMessages::showMessage('ENTER_EMAIL'),MoConstants::ERROR_JSON_TYPE) );
			else
				$this->setSessionAndStartOTPVerification($data['user_email'],$data['user_email'],NULL,"email");
		}

		function setSessionAndStartOTPVerification($sessionvalue,$useremail,$phoneNumber,$otpType)
		{
			$_SESSION[ strcasecmp($this->otpType,self::TYPE_PHONE)==0 ? $this->formPhoneVer : $this->formEmailVer ] = $sessionvalue;
			miniorange_site_challenge_otp('testUser',$useremail,NULL,$phoneNumber,$otpType);
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
			unset($_SESSION[$this->formEmailVer]);
			unset($_SESSION[$this->formPhoneVer]);
			unset($_SESSION[$this->ninjaFormSessionId]);
		}

		public function is_ajax_form_in_play($isAjax)
		{
			MoUtility::checkSession();
			return isset($_SESSION[$this->formSessionVar]) ? TRUE : $isAjax;
		}

		public function getPhoneNumberSelector($selector)	
		{
			MoUtility::checkSession();
			if(self::isFormEnabled() && ($this->otpType == self::TYPE_PHONE)) $selector = array_merge($selector, $this->phoneFormID); 
			return $selector;
		}

		function getFieldId($data)
		{
			global $wpdb;
			return $wpdb->get_var("SELECT id FROM {$wpdb->prefix}nf3_fields where `key` ='".$data."'");
		}

		function handleFormOptions()
		{
			if(!MoUtility::areFormOptionsBeingSaved()) return;
			if(!isset($_POST['mo_customer_validation_nja_enable'])) return;

			foreach (array_filter($_POST['ninja_ajax_form']['form']) as $key => $value)
			{
				$form[$value]= array(
					'emailkey'=> $this->getFieldId($_POST['ninja_ajax_form']['emailkey'][$key]),
					'phonekey'=> $this->getFieldId($_POST['ninja_ajax_form']['phonekey'][$key]),
					'verifyKey'=> $this->getFieldId($_POST['ninja_ajax_form']['verifyKey'][$key]),
					'phone_show_key'=>$_POST['ninja_ajax_form']['phonekey'][$key],
					'email_show_key'=>$_POST['ninja_ajax_form']['emailkey'][$key],
					'verify_show_key'=>$_POST['ninja_ajax_form']['verifyKey'][$key]
				);
			}

			update_mo_option('mo_customer_validation_ninja_form_enable',0);
			update_mo_option('mo_customer_validation_nja_enable',
				isset( $_POST['mo_customer_validation_nja_enable']) ? $_POST['mo_customer_validation_nja_enable'] : 0 );
			update_mo_option('mo_customer_validation_ninja_form_enable_type',
				isset( $_POST['mo_customer_validation_nja_enable_type']) ? $_POST['mo_customer_validation_nja_enable_type'] : '');
			update_mo_option('mo_customer_validation_ninja_form_otp_enabled',!empty($form) ? maybe_serialize($form) : "");
		}
	}
	new NinJaFormAjaxForm;