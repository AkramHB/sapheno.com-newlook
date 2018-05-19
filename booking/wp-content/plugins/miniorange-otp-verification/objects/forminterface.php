<?php

	abstract class FormInterface
	{
		protected $txSessionId = FormSessionVars::TX_SESSION_ID;
		protected $otpFormData;

		function __construct()
		{

			add_action( 'admin_init', array($this,'handleFormOptions') , 1 );

			if(!MoUtility::micr() || !$this->isFormEnabled()) return; 

			add_action(	'init', array($this,'handleForm') ,1 );		

			add_action( 'otp_verification_successful',array($this,'handle_post_verification'),1,6); 

			add_action( 'otp_verification_failed',array($this,'handle_failed_verification'),1,3);  

			add_filter( 'is_ajax_form', array($this,'is_ajax_form_in_play'), 1,1);

			add_filter( 'mo_phone_dropdown_selector', array($this,'getPhoneNumberSelector'),1,1);

			add_action( 'unset_session_variable', array( $this, 'unsetOTPSessionVariables'), 1, 0);
		}	

		//Abstract function to be defined by the form class extending this class
		abstract public function unsetOTPSessionVariables();
		abstract public function handle_post_verification($redirect_to,$user_login,$user_email,$password,$phone_number,$extra_data);
		abstract public function handle_failed_verification($user_login,$user_email,$phone_number);
		abstract public function handleForm();
		abstract public function handleFormOptions();
		abstract public function is_ajax_form_in_play($isAjax);
		abstract public function getPhoneNumberSelector($selector);
	}