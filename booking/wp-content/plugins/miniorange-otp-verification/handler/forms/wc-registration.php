<?php

	class WooCommerceRegistrationForm extends FormInterface
	{
		private $formSessionVar = FormSessionVars::WC_DEFAULT_REG;
		private $phoneFormID 	= '#reg_billing_phone';
		private $otpType;
		private $generateUserName;
		private $generatePassword;
		private $redirectToPage;

		const TYPE_PHONE 		= 'mo_wc_phone_enable';
		const TYPE_EMAIL 		= 'mo_wc_email_enable';
		const TYPE_BOTH 		= 'mo_wc_both_enable';

		function handleForm()
		{
			$this->otpType = get_mo_option('mo_customer_validation_wc_enable_type');
			$this->generateUserName = get_mo_option( 'woocommerce_registration_generate_username' );
			$this->generatePassword = get_mo_option( 'woocommerce_registration_generate_password' );  
			$this->redirectToPage = get_mo_option('mo_customer_validation_wc_redirect'); 

			add_filter('woocommerce_process_registration_errors', array($this,'woocommerce_site_registration_errors'),99,4);
			if($this->isPhoneVerificationEnabled()) add_action( 'woocommerce_register_form', array($this,'mo_add_phone_field'),1);
		}

		public static function isFormEnabled()
		{
			return get_mo_option('mo_customer_validation_wc_default_enable') ? true : false;
		}

		function isPhoneVerificationEnabled()
		{
			return (strcasecmp($this->otpType,self::TYPE_PHONE)==0 || strcasecmp($this->otpType,self::TYPE_BOTH)==0);
		}

		function check_wc_restrict_duplicates()
		{
			return get_mo_option('mo_customer_validation_wc_restrict_duplicates') ? true : false;
		}

		function woocommerce_site_registration_errors($errors,$username,$password,$email)
		{
			MoUtility::checkSession();
			if(!MoUtility::isBlank(array_filter($errors->errors))) return $errors; 

			MoUtility::initialize_transaction($this->formSessionVar);
			if( $this->generateUserName==='no' )
			{
				if (  MoUtility::isBlank( $username ) || ! validate_username( $username ) )
					return new WP_Error( 'registration-error-invalid-username', __( 'Please enter a valid account username.', 'woocommerce' ) );
				if ( username_exists( $username ) )
					return new WP_Error( 'registration-error-username-exists', __( 'An account is already registered with that username. Please choose another.', 'woocommerce' ) );
			}

			if( $this->generatePassword==='no' )
			{
				if (  MoUtility::isBlank( $password ) )
					return new WP_Error( 'registration-error-invalid-password', __( 'Please enter a valid account password.', 'woocommerce' ) );
			}

			if ( MoUtility::isBlank( $email ) || ! is_email( $email ) )
				return new WP_Error( 'registration-error-invalid-email', __( 'Please enter a valid email address.', 'woocommerce' ) );
			if ( email_exists( $email ) )
				return new WP_Error( 'registration-error-email-exists', __( 'An account is already registered with your email address. Please login.', 'woocommerce' ) );

			do_action( 'woocommerce_register_post', $username, $email, $errors );
			if($errors->get_error_code())
				throw new Exception( $errors->get_error_message() );

			//process and start the OTP verification process
			return $this->processFormFields($username,$email,$errors,$password); 		
		}

		function processFormFields($username,$email,$errors,$password)
		{
			global $phoneLogic;
			if(strcasecmp($this->otpType,self::TYPE_PHONE)==0)
			{
				if ( !isset( $_POST['billing_phone'] ) || !MoUtility::validatePhoneNumber($_POST['billing_phone']))
					return new WP_Error( 'billing_phone_error',
						str_replace("##phone##",$_POST['billing_phone'],$phoneLogic->_get_otp_invalid_format_message()) );
				elseif($this->check_wc_restrict_duplicates() && $this->isPhoneNumberAlreadyInUse($_POST['billing_phone'],'billing_phone'))
					return new WP_Error( 'billing_phone_error', MoMessages::showMessage('PHONE_EXISTS'));
				miniorange_site_challenge_otp($username,$email,$errors,$_POST['billing_phone'],"phone",$password);
			}
			else if(strcasecmp($this->otpType,self::TYPE_EMAIL)==0)
			{
				$phone = isset($_POST['billing_phone']) ? $_POST['billing_phone'] : "";
				miniorange_site_challenge_otp($username,$email,$errors,$phone,"email",$password);
			}
			else if(strcasecmp($this->otpType,self::TYPE_BOTH)==0)
			{
				if ( !isset( $_POST['billing_phone'] ) || !MoUtility::validatePhoneNumber($_POST['billing_phone']))
					return new WP_Error( 'billing_phone_error',
						str_replace("##phone##",$_POST['billing_phone'],$phoneLogic->_get_otp_invalid_format_message()) );
				miniorange_site_challenge_otp($username,$email,$errors,$_POST['billing_phone'],"both",$password);
			}
		}

		public function register_woocommerce_user($username,$email,$password,$phone_number)
		{
			require_once(  plugin_dir_path(MOV_DIR) . 'woocommerce/includes/class-wc-emails.php' );
			WC_Emails::init_transactional_emails();

			$new_customer = wc_create_new_customer( sanitize_email( $email ), wc_clean( $username ), $password );

			if ( is_wp_error( $new_customer ) )
				wc_add_notice( $new_customer->get_error_message(), 'error' );
			if ( apply_filters( 'woocommerce_registration_auth_new_customer', true, $new_customer ) ) 
				wc_set_customer_auth_cookie( $new_customer );

			if(isset($_POST['billing_phone']))
				update_user_meta( $new_customer, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );

			$this->unsetOTPSessionVariables();
			wp_redirect(get_permalink( get_page_by_title( $this->redirectToPage )->ID));
			exit;
		} 

		function mo_add_phone_field()
		{
			echo '<p class="form-row form-row-wide">
					<label for="reg_billing_phone">'.mo_('Phone').'<span class="required">*</span></label>
					<input type="text" class="input-text" name="billing_phone" id="reg_billing_phone" value="'.(!empty( $_POST['billing_phone'] ) ? $_POST['billing_phone'] : "").'" />
			  	  </p>';
		}

		function handle_failed_verification($user_login,$user_email,$phone_number)
		{
			MoUtility::checkSession();
			if(!isset($_SESSION[$this->formSessionVar])) return;
			$otpVerType = strcasecmp($this->otpType,self::TYPE_PHONE)==0 ? "phone" 
							: (strcasecmp($this->otpType,"mo_wc_both_enable")==0 ? "both" : "email" );
			$fromBoth = strcasecmp($otpVerType,"both")==0 ? TRUE : FALSE;
			miniorange_site_otp_validation_form($user_login,$user_email,$phone_number,MoUtility::_get_invalid_otp_method(),$otpVerType,$fromBoth);
		}

		function handle_post_verification($redirect_to,$user_login,$user_email,$password,$phone_number,$extra_data)
		{
			MoUtility::checkSession();
			if(!isset($_SESSION[$this->formSessionVar])) return;
			$this->register_woocommerce_user($user_login,$user_email,$password,$phone_number);
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
			if(self::isFormEnabled() && $this->isPhoneVerificationEnabled()) array_push($selector, $this->phoneFormID); 
			return $selector;
		}

		function isPhoneNumberAlreadyInUse($phone,$key)
		{
			global $wpdb;
			MoUtility::processPhoneNumber($phone);
			$results = $wpdb->get_row("SELECT `user_id` FROM `{$wpdb->prefix}usermeta` WHERE `meta_key` = '$key' AND `meta_value` =  '$phone'");			
			return !MoUtility::isBlank($results);
		}

		function handleFormOptions()
		{
			if(!MoUtility::areFormOptionsBeingSaved()) return;

			update_mo_option('mo_customer_validation_wc_default_enable',
				isset( $_POST['mo_customer_validation_wc_default_enable']) ? $_POST['mo_customer_validation_wc_default_enable'] : 0);
			update_mo_option('mo_customer_validation_wc_enable_type',
				isset( $_POST['mo_customer_validation_wc_enable_type']) ? $_POST['mo_customer_validation_wc_enable_type'] : '');
			update_mo_option('mo_customer_validation_wc_restrict_duplicates',
				isset( $_POST['mo_customer_validation_wc_restrict_duplicates']) ? $_POST['mo_customer_validation_wc_restrict_duplicates'] : '');
			update_mo_option('mo_customer_validation_wc_redirect',
				isset( $_POST['page_id']) ? get_the_title($_POST['page_id']) : 'My Account');
		}
	}
	new WooCommerceRegistrationForm;