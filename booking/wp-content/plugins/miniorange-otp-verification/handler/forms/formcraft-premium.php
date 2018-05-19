<?php

	class FormCraftPremiumForm extends FormInterface
	{
		private $formSessionVar 	= FormSessionVars::FORMCRAFT;
		private $formEmailVer 		= FormSessionVars::FORMCRAFT_EMAIL_VER;
		private $formPhoneVer 		= FormSessionVars::FORMCRAFT_PHONE_VER;
		private $otpFieldSessionID  = 'fc_form_id';
		private $phoneFormID 		= array();
		private $otpType;
		private $formCraftForms;

		const TYPE_PHONE 			= 'mo_formcraft_phone_enable';
		const TYPE_EMAIL 			= 'mo_formcraft_email_enable';

		function handleForm()
		{
			if(!$this->isFormCraftPluginInstalled()) return; //check to see if plugin is activated

			$this->otpType = get_mo_option('mo_customer_validation_formcraft_premium_enable_type');
			$this->formCraftForms = maybe_unserialize(get_mo_option('mo_customer_validation_fcpremium_otp_enabled'));

			if($this->isFormCraftVersion3Installed()) {
				foreach ($this->formCraftForms as $key => $value) {
					array_push($this->phoneFormID,'input[name^='.$value['phonekey'].']');
				}
			} else {
				foreach ($this->formCraftForms as $key => $value) {
					array_push($this->phoneFormID,'.nform_li input[name^='.$value['phonekey'].']');
				}
			}

			add_action( 'wp_ajax_formcraft_submit', array($this,'validate_formcraft_form_submit'),1);
			add_action( 'wp_ajax_nopriv_formcraft_submit', array($this,'validate_formcraft_form_submit'),1);
			add_action( 'wp_ajax_formcraft3_form_submit', array($this,'validate_formcraft_form_submit'),1);
			add_action( 'wp_ajax_nopriv_formcraft3_form_submit', array($this,'validate_formcraft_form_submit'),1);
			add_action( 'wp_enqueue_scripts', array($this,'enqueue_script_on_page'));
			$this->routeData();
		}

		public static function isFormEnabled()
		{
			return get_mo_option('mo_customer_validation_formcraft_premium_enable') ? TRUE : FALSE;
		}

		function routeData()
		{
			if(!array_key_exists('option', $_GET)) return; 

			switch (trim($_GET['option'])) 
			{
				case "miniorange-formcraftpremium-verify":
					$this->_handle_formcraft_form($_POST);										break; 			
				case "miniorange-formcraftpremium-form-otp-enabled":
					wp_send_json($this->isVerificationEnabledForThisForm($_POST['form_id']));	break;
			}
		}	

		function _handle_formcraft_form($data)
		{
			MoUtility::checkSession();
			if(!$this->isVerificationEnabledForThisForm($_POST['form_id'])) return;
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

		function validate_formcraft_form_submit()
		{
			MoUtility::checkSession();
			global $errors;
			$id = $_POST['id'];

			if(!$this->isVerificationEnabledForThisForm($id)) return;

			$formData = $this->parseSubmittedData($_POST,$id);
			$this->checkIfVerificationNotStarted($errors,$id,$formData);

			$phone = is_array($formData['phone']['value']) ? $formData['phone']['value'][0] : $formData['phone']['value'];
			$email = is_array($formData['email']['value']) ? $formData['email']['value'][0] : $formData['email']['value']; 
			$otp   = is_array($formData['otp']['value']) ? $formData['otp']['value'][0] : $formData['otp']['value'];

			if($this->otpType==self::TYPE_PHONE 
				&& strcasecmp($_SESSION[$this->formPhoneVer],$phone)!=0)
				$this->sendJSONErrorMessage( mo_(MoMessages::showMessage('PHONE_MISMATCH')), $formData['phone']['field']);
			if($this->otpType==self::TYPE_EMAIL 
				&& strcasecmp($_SESSION[$this->formEmailVer],$email)!=0)
				$this->sendJSONErrorMessage( mo_(MoMessages::showMessage('EMAIL_MISMATCH')), $formData['email']['field']);
			if(MoUtility::isBlank($formData['otp']['value']))
				$this->sendJSONErrorMessage( mo_(MoMessages::showMessage('INVALID_OTP')), $formData['otp']['field']);

			$_SESSION[$this->otpFieldSessionID] = $formData['otp']['field'];
			do_action('mo_validate_otp',NULL,$otp);
		}

		function enqueue_script_on_page()
		{
			wp_register_script( 'fcpremiumscript', MOV_URL . 'includes/js/formcraftpremium.min.js?version='.MOV_VERSION , array('jquery') );
			wp_localize_script( 'fcpremiumscript', 'mofcpvars', array(
				'imgURL'		=> 	MOV_URL. "includes/images/loader.gif",
				'formCraftForms'=> 	$this->formCraftForms,
				'siteURL' 		=> 	site_url(),
				'otpType' 		=>  $this->otpType,
				'buttonText'	=> 	mo_('Click here to send OTP'),
				'buttonTitle'	=> 	$this->otpType==self::TYPE_PHONE ? 
									mo_('Please enter a Phone Number to enable this field.' ) 
									: mo_('Please enter a Phone Number to enable this field.' ),
				'ajaxurl'       => 	admin_url('admin-ajax.php'),
				'typePhone'		=>  self::TYPE_PHONE,
				'countryDrop'	=> get_mo_option('mo_customer_validation_show_dropdown_on_form'),
				'version3' 		=> $this->isFormCraftVersion3Installed(),
			));
			wp_enqueue_script('fcpremiumscript');
		}

		function parseSubmittedData($post,$id)
		{
			$data = array();
			$form = $this->formCraftForms[$id];
			foreach ($post as $key => $value) {
				if(strpos($key, 'field')===FALSE) continue;
				$this->getValueAndFieldFromPost($data,'email',$key,$form['emailkey'],$value);
				$this->getValueAndFieldFromPost($data,'phone',$key,$form['phonekey'],$value);
				$this->getValueAndFieldFromPost($data,'otp',$key,$form['verifyKey'],$value);
			}
			return $data;
		}

		function getValueAndFieldFromPost(&$data,$dataKey,$postKey,$checkKey,$value)
		{
			if(is_null($data[$dataKey]) && strpos($postKey,$checkKey,0)!==FALSE){
				$data[$dataKey]['value'] = $this->isFormCraftVersion3Installed() && $dataKey=='otp' ? $value[0] : $value;
				$index = strpos($postKey, 'field', 0);
				$data[$dataKey]['field'] = $this->isFormCraftVersion3Installed() ? $postKey 
					: substr($postKey, $index, strpos($postKey,'_',$index) - $index);
			}
		}

		function isVerificationEnabledForThisForm($id)
		{
			return array_key_exists($id,$this->formCraftForms);
		}

		function sendJSONErrorMessage($errors,$field)
		{
			if($this->isFormCraftVersion3Installed())
			{
				$response['failed'] =  mo_("Please correct the errors and try again");
				$response['errors'][$field] = $errors;
			}
			else
			{
				$response['errors'] =  mo_("Please correct the errors and try again");
				$response[$field][0] = $errors;
			}
			echo json_encode($response);
			die();
		}

		function checkIfVerificationNotStarted($errors,$id,$formData)
		{
			if(array_key_exists($this->formSessionVar,$_SESSION)) return;

			if($this->otpType==self::TYPE_PHONE)
				$this->sendJSONErrorMessage( mo_(MoMessages::showMessage('PLEASE_VALIDATE')) , $formData['phone']['field']);
			else
				$this->sendJSONErrorMessage( mo_(MoMessages::showMessage('PLEASE_VALIDATE')) , $formData['email']['field']);
		}

		function handle_failed_verification($user_login,$user_email,$phone_number)
		{
			MoUtility::checkSession();
			if(!isset($_SESSION[$this->formSessionVar])) return;
			$form_id = $_SESSION[$this->otpFieldSessionID];
			$this->sendJSONErrorMessage( MoUtility::_get_invalid_otp_method() , $form_id );
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
			unset($_SESSION[$this->currentFormID]);
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

		function getFieldId($data,$formData)
		{
			foreach ($formData as $form)
				if($form['elementDefaults']['main_label'] == $data) return $form['identifier'];
			return NULL;
		}

		function getFormCraftFormDataFromID($id)
		{
			global $wpdb,$fc_forms_table;
			$meta = $wpdb->get_var( "SELECT meta_builder FROM $fc_forms_table WHERE id=$id" );
			$meta = json_decode(stripcslashes($meta),1);
			return $meta['fields'];
		}

		function isFormCraftPluginInstalled()
		{
			if( !function_exists('is_plugin_active') ) include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			return is_plugin_active( 'formcraft/function.php' ) || $this->isFormCraftVersion3Installed();
		}

		function isFormCraftVersion3Installed()
		{
			if( !function_exists('is_plugin_active') ) include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			return is_plugin_active( 'formcraft3/formcraft-main.php' );
		}

		function handleFormOptions()
		{
			if(!MoUtility::areFormOptionsBeingSaved()) return;
			if(!$this->isFormCraftPluginInstalled()) return; //check to see if plugin is installed
			$form = array();

			foreach (array_filter($_POST['fcpremium']['form']) as $key => $value)
			{
				!$this->isFormCraftVersion3Installed() ? $this->processAndGetFormData($_POST,$key,$value,$form) 
					: $this->processAndGetForm3Data($_POST,$key,$value,$form);
			}

			update_mo_option('mo_customer_validation_formcraft_premium_enable',
				isset( $_POST['mo_customer_validation_fcpremium_enable']) ? $_POST['mo_customer_validation_fcpremium_enable'] : 0);
			update_mo_option('mo_customer_validation_formcraft_premium_enable_type',
				isset( $_POST['mo_customer_validation_fcpremium_enable_type']) ? $_POST['mo_customer_validation_fcpremium_enable_type'] : '');
			update_mo_option('mo_customer_validation_fcpremium_otp_enabled',!empty($form) ? maybe_serialize($form) : "");
		}	

		function processAndGetFormData($post,$key,$value,&$form)
		{
			$form[$value]= array(
				'emailkey'=> str_replace(" ","_", $post['fcpremium']['emailkey'][$key]).'_email_',
				'phonekey'=> str_replace(" ","_", $post['fcpremium']['phonekey'][$key]).'_text_',
				'verifyKey'=> str_replace(" ","_", $post['fcpremium']['verifyKey'][$key]).'_text_',
				'phone_label'=>$post['fcpremium']['phonekey'][$key],
				'email_label'=>$post['fcpremium']['emailkey'][$key],
				'verify_label'=>$post['fcpremium']['verifyKey'][$key]
			);
		}

		function processAndGetForm3Data($post,$key,$value,&$form)
		{
			$formData = $this->getFormCraftFormDataFromID($value);
			if(MoUtility::isBlank($formData)) return;
			$form[$value]= array(
				'emailkey'=> $this->getFieldId($post['fcpremium']['emailkey'][$key],$formData),
				'phonekey'=> $this->getFieldId($post['fcpremium']['phonekey'][$key],$formData),
				'verifyKey'=> $this->getFieldId($post['fcpremium']['verifyKey'][$key],$formData),
				'phone_label'=>$post['fcpremium']['phonekey'][$key],
				'email_label'=>$post['fcpremium']['emailkey'][$key],
				'verify_label'=>$post['fcpremium']['verifyKey'][$key]
			);
		}
	}
	new FormCraftPremiumForm;