<?php

	class BuddyPressRegistrationForm extends FormInterface
	{
		private $formSessionVar = FormSessionVars::BUDDYPRESS_REG;
		private $phoneFormID;
		private $phoneKey;
		private $otpType;
		private $disableAutoActivate;

		const TYPE_PHONE 		= 'mo_bbp_phone_enable';
		const TYPE_EMAIL 		= 'mo_bbp_email_enable';
		const TYPE_BOTH 		= 'mo_bbp_both_enable';

		function handleForm()
		{
			$this->phoneKey = get_mo_option('mo_customer_validation_bbp_phone_key');
			$this->otpType = get_mo_option('mo_customer_validation_bbp_enable_type');
			$this->autoActivate = get_mo_option('mo_customer_validation_bbp_default_enable');
			$this->disableAutoActivate = get_mo_option('mo_customer_validation_bbp_disable_activation');
			$this->phoneFormID = 'input[name=field_'.$this->moBBPgetphoneFieldId().']';

			add_filter( 'bp_registration_needs_activation', '__return_false');
			add_filter( 'bp_registration_needs_activation'	, array($this,'fix_signup_form_validation_text'));
			add_filter( 'bp_core_signup_send_activation_key', array($this,'disable_activation_email'));
			add_filter( 'bp_signup_usermeta', array($this,'miniorange_bp_user_registration'),1,1);
			add_action( 'bp_signup_validate', array($this,'validateOTPRequest'), 99,0);

			if($this->disableAutoActivate) add_action( 'bp_core_signup_user',array($this,'mo_activate_bbp_user'),1,5);	
		}

		public static function isFormEnabled()
		{
			return get_mo_option('mo_customer_validation_bbp_default_enable') ? TRUE : FALSE;
		}

		function fix_signup_form_validation_text()
		{
			return $this->disableAutoActivate ? FALSE : TRUE;
		}

		function disable_activation_email()
		{
			return $this->disableAutoActivate ? FALSE : TRUE;
		}

		function isPhoneVerificationEnabled()
		{
			return (strcasecmp($this->otpType,self::TYPE_PHONE)==0 || strcasecmp($this->otpType,self::TYPE_BOTH)==0);
		}

		function validateOTPRequest()
		{
			global $bp,$phoneLogic;
			$field_key = "field_".$this->moBBPgetphoneFieldId();
			if(isset($_POST[$field_key]) && !MoUtility::validatePhoneNumber($_POST[$field_key]))
				$bp->signup->errors[$field_key] = str_replace("##phone##",$_POST[$field_key],$phoneLogic->_get_otp_invalid_format_message());
		}

		function checkIfVerificationIsComplete()
		{
			if(isset($_SESSION[$this->formSessionVar]) && $_SESSION[$this->formSessionVar]=='completed')
			{
				$this->unsetOTPSessionVariables();
				return TRUE;
			}
			return FALSE;
		}

		function handle_failed_verification($user_login,$user_email,$phone_number)
		{
			MoUtility::checkSession();
			if(!isset($_SESSION[$this->formSessionVar])) return;
			$otpVerType = strcasecmp($this->otpType,self::TYPE_PHONE)==0 ? "phone" 
							: (strcasecmp($this->otpType,self::TYPE_BOTH)==0 ? "both" : "email" );
			$fromBoth = strcasecmp($otpVerType,"both")==0 ? TRUE : FALSE;
			miniorange_site_otp_validation_form($user_login,$user_email,$phone_number,MoUtility::_get_invalid_otp_method(),$otpVerType,$fromBoth);
		}

		function handle_post_verification($redirect_to,$user_login,$user_email,$password,$phone_number,$extra_data)
		{
			MoUtility::checkSession();
			if(!isset($_SESSION[$this->formSessionVar])) return;
			$_SESSION[$this->formSessionVar] = 'completed';	
		}

		function miniorange_bp_user_registration($usermeta)
		{
			MoUtility::checkSession();
			if($this->checkIfVerificationIsComplete()) return $usermeta; 
			MoUtility::initialize_transaction($this->formSessionVar);
			$errors = new WP_Error();
			$phone_number = NULL;

			foreach ($_POST as $key => $value)
			{
				if($key=="signup_username")
					$username = $value;
				elseif ($key=="signup_email") 
					$email = $value;
				elseif ($key=="signup_password") 
					$password = $value;
				else
					$extra_data[$key]=$value;
			}

			$reg1 = $this->moBBPgetphoneFieldId();

			if(isset($_POST["field_".$reg1])) $phone_number = $_POST["field_".$reg1];

			$extra_data['usermeta'] = $usermeta;
			$this->startVerificationProcess($username,$email,$errors,$phone_number,$password,$extra_data);
		}

		function startVerificationProcess($username,$email,$errors,$phone_number,$password,$extra_data)
		{
			if(strcasecmp($this->otpType,self::TYPE_PHONE)==0)
				miniorange_site_challenge_otp($username,$email,$errors,$phone_number,'phone',$password,$extra_data);
			else if(strcasecmp($this->otpType,self::TYPE_BOTH)==0)
				miniorange_site_challenge_otp($username,$email,$errors,$phone_number,'both',$password,$extra_data);
			else
				miniorange_site_challenge_otp($username,$email,$errors,$phone_number,'email',$password,$extra_data);
		}

		function mo_activate_bbp_user($userID,$user_login,$user_password, $user_email, $usermeta)
		{
			$activation_key = $this->moBBPgetActivationKey($user_login); 
			bp_core_activate_signup($activation_key);   
			BP_Signup::validate($activation_key); 				
			$u = new WP_User( $userID ); 
			$u->add_role( 'subscriber' ); 			
			return;
		}

		function moBBPgetActivationKey($user_login)
		{
			global $wpdb;
			return $wpdb->get_var( "SELECT activation_key FROM {$wpdb->prefix}signups WHERE active = '0' AND user_login = '".$user_login."'");
		}

		function moBBPgetphoneFieldId()
		{
			global $wpdb;
			return $wpdb->get_var("SELECT id FROM {$wpdb->prefix}bp_xprofile_fields where name ='".$this->phoneKey."'");
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
			if(self::isFormEnabled() && $this->isPhoneVerificationEnabled()) array_push($selector, $this->phoneFormID); 
			return $selector;
		}

		function handleFormOptions()
		{
			if(!MoUtility::areFormOptionsBeingSaved()) return;

			update_mo_option('mo_customer_validation_bbp_default_enable', 
				isset( $_POST['mo_customer_validation_bbp_default_enable']) ? $_POST['mo_customer_validation_bbp_default_enable'] : 0);
			update_mo_option('mo_customer_validation_bbp_disable_activation',
				isset( $_POST['mo_customer_validation_bbp_disable_activation']) ? $_POST['mo_customer_validation_bbp_disable_activation'] : '');
			update_mo_option('mo_customer_validation_bbp_enable_type',
				isset( $_POST['mo_customer_validation_bbp_enable_type']) ? $_POST['mo_customer_validation_bbp_enable_type'] : '');
			update_mo_option('mo_customer_validation_bbp_phone_key',
				isset( $_POST['bbp_phone_field_key']) ? $_POST['bbp_phone_field_key'] : '');
		}
	}
	new BuddyPressRegistrationForm;