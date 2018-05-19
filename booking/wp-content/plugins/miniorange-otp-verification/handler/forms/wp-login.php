<?php

	class WPLoginForm extends FormInterface
	{
		private $formSessionVar = FormSessionVars::WP_LOGIN_REG_PHONE;
		private $formSessionVar2= FormSessionVars::WP_DEFAULT_LOGIN;
		private $phoneFormID 	= "#mo_phone_number";
		private $phoneNumberKey;

		function handleForm()
		{	
			$this->phoneNumberKey = get_mo_option('mo_customer_validation_wp_login_key');
			add_filter( 'authenticate', array($this,'_handle_mo_wp_login'), 99, 4 );
			$this->routeData();
		}

		function routeData()
		{
			if(!array_key_exists('option', $_REQUEST)) return;
			switch (trim($_REQUEST['option'])) 
			{
				case "miniorange-ajax-otp-generate":
					$this->_handle_wp_login_ajax_send_otp($_POST);				break;
				case "miniorange-ajax-otp-validate":
					$this->_handle_wp_login_ajax_form_validate_action($_POST);	break;
				case "mo_ajax_form_validate":
					$this->_handle_wp_login_create_user_action($_POST);			break;
			}
		}

		public static function isFormEnabled() 
		{
			return get_mo_option('mo_customer_validation_wp_login_enable') ? true : false;
		}

		function check_wp_login_register_phone() 
		{
			return get_mo_option('mo_customer_validation_wp_login_register_phone') ? true : false;
		}

		function check_wp_login_bypass_admin()                                 
		{
			return get_mo_option('mo_customer_validation_wp_login_bypass_admin') ? true : false;
		}

		function check_wp_login_by_phone_number()                                 
		{
			return get_mo_option('mo_customer_validation_wp_login_allow_phone_login') ? true : false;
		}

		function byPassLogin($user_role)
		{
			return in_array('administrator',$user_role) && $this->check_wp_login_bypass_admin() ? true : false;
		}

		function check_wp_login_restrict_duplicates()
		{
			return get_mo_option('mo_customer_validation_wp_login_restrict_duplicates') ? true : false;
		}

		function _handle_wp_login_create_user_action($postdata)
		{
			MoUtility::checkSession();
			if(!isset($_SESSION[$this->formSessionVar]) 
				|| $_SESSION[$this->formSessionVar]!='validated') 	return;

			$user = is_email( $postdata['log'] ) ? get_user_by("email",$postdata['log']) : get_user_by("login",$postdata['log']);
			update_user_meta($user->data->ID, $this->phoneNumberKey ,$postdata['mo_phone_number']);
			$this->login_wp_user($user->data->user_login);
		}

		function login_wp_user($user_log,$extra_data=null)
		{
			$user = is_email( $user_log ) ? get_user_by("email",$user_log) 
					: ( $this->check_wp_login_by_phone_number() && MoUtility::validatePhoneNumber($user_log) 
						? $this->getUserFromPhoneNumber($user_log,$this->phoneNumberKey) : get_user_by("login",$user_log) );
			wp_set_auth_cookie($user->data->ID);
			$this->unsetOTPSessionVariables();
			do_action( 'wp_login', $user->user_login, $user );	
			$redirect = MoUtility::isBlank($extra_data) ? site_url() : $extra_data;
			wp_redirect($redirect);
			exit;
		}

		function _handle_mo_wp_login($user,$username,$password)
		{
			$user = $this->getUserIfUsernameIsPhoneNumber($user,$username,$password,$this->phoneNumberKey);

			if(is_wp_error($user)) return $user;

			MoUtility::checkSession();		
			$user_meta 	= get_userdata($user->data->ID);
			$user_role 	= $user_meta->roles;
			$phone_number = get_user_meta($user->data->ID, $this->phoneNumberKey);
			if(!empty($phone_number)) $phone_number = MoUtility::processPhoneNumber($phone_number[0]);

			if($this->byPassLogin($user_role)) return $user;

			$this->askPhoneAndStartVerification($user,$this->phoneNumberKey,$username,$phone_number);
			$this->fetchPhoneAndStartVerification($user,$this->phoneNumberKey,$username,$password,$phone_number);

			return $user;
		} 

		function getUserIfUsernameIsPhoneNumber($user,$username,$password,$key)
		{
			if(!$this->check_wp_login_by_phone_number() || !MoUtility::validatePhoneNumber($username)) return $user;
			$user_info = $this->getUserFromPhoneNumber($username,$key);
			return $user_info ? wp_authenticate_username_password(NULL,$user_info->data->user_login,$password) 
				: new WP_Error( 'INVALID_USERNAME' , mo_(" <b>ERROR:</b> Invalid UserName. ") );;
		}

		function getUserFromPhoneNumber($username,$key)
		{
			global $wpdb;
			$results = $wpdb->get_row("SELECT `user_id` FROM `{$wpdb->prefix}usermeta` WHERE `meta_key` = '$key' AND `meta_value` =  '$username'");			
			return !MoUtility::isBlank($results) ? get_userdata($results->user_id) : false;
		}

		function askPhoneAndStartVerification($user,$key,$username,$phone_number)
		{
			if(!MoUtility::isBlank($phone_number)) return;

			if( !$this->check_wp_login_register_phone() )			
				miniorange_site_otp_validation_form(null,null,null, MoMessages::showMessage('PHONE_NOT_FOUND'),null,null);
			else
			{		
				MoUtility::initialize_transaction($this->formSessionVar);
				miniorange_site_challenge_otp(NULL,$user->data->user_login,NULL,NULL,'external',NULL,
					array('data'=>array('user_login'=>$username),'message'=>MoMessages::showMessage('REGISTER_PHONE_LOGIN'),
					'form'=>$key,'curl'=>MoUtility::currentPageUrl()));
			}					
		}

		function fetchPhoneAndStartVerification($user,$key,$username,$password,$phone_number)
		{
			if((array_key_exists($this->formSessionVar,$_SESSION) && strcasecmp($_SESSION[$this->formSessionVar],'validated')==0)
				|| (array_key_exists($this->formSessionVar2,$_SESSION) && strcasecmp($_SESSION[$this->formSessionVar2],'validated')==0)) return;

			MoUtility::initialize_transaction($this->formSessionVar2);
			miniorange_site_challenge_otp($username,null,null,$phone_number,"phone",$password,$_REQUEST['redirect_to'],false);
		}

		function _handle_wp_login_ajax_send_otp($data)
		{
			MoUtility::checkSession();
			if($this->check_wp_login_restrict_duplicates() 
				&& !MoUtility::isBlank($this->getUserFromPhoneNumber($data['user_phone'],$this->phoneNumberKey)))
				wp_send_json(MoUtility::_create_json_response(MoMessages::showMessage('PHONE_EXISTS'),MoConstants::ERROR_JSON_TYPE));
			elseif(isset($_SESSION[$this->formSessionVar]))
				miniorange_site_challenge_otp('ajax_phone','',null, trim($data['user_phone']),"phone",null,$data);
		}

		function _handle_wp_login_ajax_form_validate_action($data)
		{
			MoUtility::checkSession();
			if(!isset($_SESSION[$this->formSessionVar])) return;

			if(strcmp($_SESSION['phone_number_mo'], MoUtility::processPhoneNumber($data['user_phone'])))
				wp_send_json( MoUtility::_create_json_response( MoMessages::showMessage('PHONE_MISMATCH'),'error'));
			else
				do_action('mo_validate_otp','mo_customer_validation_otp_token',NULL);
		}

		function handle_failed_verification($user_login,$user_email,$phone_number)
		{
			MoUtility::checkSession();
			if(!isset($_SESSION[$this->formSessionVar]) 
				&& !isset($_SESSION[$this->formSessionVar2]) ) return;

			if(isset($_SESSION[$this->formSessionVar])){	
				$_SESSION[$this->formSessionVar] = 'verification_failed';
				wp_send_json( MoUtility::_create_json_response(MoUtility::_get_invalid_otp_method(),'error'));
			}

			if(isset($_SESSION[$this->formSessionVar2]))
				miniorange_site_otp_validation_form($user_login,$user_email,$phone_number,MoUtility::_get_invalid_otp_method(),"phone",FALSE);
		}

		function handle_post_verification($redirect_to,$user_login,$user_email,$password,$phone_number,$extra_data)
		{
			MoUtility::checkSession();
			if(!isset($_SESSION[$this->formSessionVar])
				 && !isset($_SESSION[$this->formSessionVar2])) return;

			if(isset($_SESSION[$this->formSessionVar])){
				$_SESSION[$this->formSessionVar] = 'validated';
				wp_send_json( MoUtility::_create_json_response('','success') );
			}

			if(isset($_SESSION[$this->formSessionVar2]))
				$this->login_wp_user(array_key_exists('log',$_POST) ? $_POST['log'] : $_POST['username']);
		}

		public function unsetOTPSessionVariables()
		{
			unset($_SESSION[$this->txSessionId]);
			unset($_SESSION[$this->formSessionVar]);
			unset($_SESSION[$this->formSessionVar2]);
		}

		public function is_ajax_form_in_play($isAjax)
		{
			MoUtility::checkSession();
			return isset($_SESSION[$this->formSessionVar]) ? TRUE : $isAjax;
		}

		public function getPhoneNumberSelector($selector)	
		{
			MoUtility::checkSession();
			if(self::isFormEnabled()) array_push($selector, $this->phoneFormID); 
			return $selector;
		}

		function handleFormOptions()
	    {
	    	if(!MoUtility::areFormOptionsBeingSaved()) return;

			update_mo_option('mo_customer_validation_wp_login_enable',
				isset( $_POST['mo_customer_validation_wp_login_enable']) ? $_POST['mo_customer_validation_wp_login_enable'] : 0);
			update_mo_option('mo_customer_validation_wp_login_register_phone',
				isset( $_POST['mo_customer_validation_wp_login_register_phone']) ? $_POST['mo_customer_validation_wp_login_register_phone'] : '');
			update_mo_option('mo_customer_validation_wp_login_bypass_admin',
				isset( $_POST['mo_customer_validation_wp_login_bypass_admin']) ? $_POST['mo_customer_validation_wp_login_bypass_admin'] : '');
			update_mo_option('mo_customer_validation_wp_login_key',
				isset( $_POST['wp_login_phone_field_key']) ? $_POST['wp_login_phone_field_key'] : '');
			update_mo_option('mo_customer_validation_wp_login_allow_phone_login',
				isset( $_POST['mo_customer_validation_wp_login_allow_phone_login']) ? $_POST['mo_customer_validation_wp_login_allow_phone_login'] : '');
			update_mo_option('mo_customer_validation_wp_login_restrict_duplicates',
				isset( $_POST['mo_customer_validation_wp_login_restrict_duplicates']) ? $_POST['mo_customer_validation_wp_login_restrict_duplicates'] : '');
	    }
	}
	new WPLoginForm;

