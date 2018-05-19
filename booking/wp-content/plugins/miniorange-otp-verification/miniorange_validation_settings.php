<?php

/**
* Plugin Name: Email Verification / SMS verification / Mobile Verification
* Plugin URI: http://miniorange.com
* Description: Email verification for all forms Woocommerce, Contact 7 etc. SMS and Mobile Verification for all forms. Enterprise grade. Active Support. 
* Version: 3.2.41
* Author: miniOrange
* Author URI: http://miniorange.com
* Text Domain: miniorange-otp-verification
* Domain Path: /lang
* License: GPL2
*/

include '_autoload.php';

class Miniorange_Customer_Validation 
{
	function __construct()
	{
		add_action( 'plugins_loaded'				, array( $this, 'otp_load_textdomain'						 )		  );
		add_action( 'admin_menu'					, array( $this, 'miniorange_customer_validation_menu' 		 ) 		  );
		add_action( 'admin_enqueue_scripts'			, array( $this, 'mo_registration_plugin_settings_style'      ) 		  );
		add_action( 'admin_enqueue_scripts'			, array( $this, 'mo_registration_plugin_settings_script' 	 ) 		  );
		add_action( 'wp_enqueue_scripts'		  	, array( $this, 'mo_registration_plugin_frontend_scripts' 	 ),99	  );
		add_action( 'login_enqueue_scripts'		  	, array( $this, 'mo_registration_plugin_frontend_scripts' 	 ),99	  );
		add_action( 'mo_registration_show_message'	, array( $this, 'mo_show_otp_message'    		 			 ),1   , 2);
		add_action( 'init'							, array( $this, 'moScheduleTransactionSync'	 			 	 ),1   	  );
		add_action( 'hourlySync'					, array( $this, 'hourlySync'								 ) 		  );
		add_action( 'admin_init'					, array( $this, 'register_ppl_strings'						 ),1	  );
		register_deactivation_hook(__FILE__			, array( $this, 'mo_registration_deactivate'				 ) 		  );

		register_activation_hook(__FILE__			, array( $this, 'initializeDefaults'						 ) 		  );
	}

	function miniorange_customer_validation_menu() 
	{
		$menu_slug = 'mosettings';
		add_menu_page (	'OTP Verification' , 'OTP Verification' , 'activate_plugins', $menu_slug , 
			array( $this, 'mo_customer_validation_options'), plugin_dir_url(__FILE__) . 'includes/images/miniorange_icon.png' );
		add_submenu_page( $menu_slug	,'OTP Verification'	,'Forms','administrator',$menu_slug		
			, array( $this, 'mo_customer_validation_options'));
		add_submenu_page( $menu_slug	,'OTP Verification'	,'OTP Settings','administrator','otpsettings'
			, array( $this, 'mo_customer_validation_options'));
		add_submenu_page( $menu_slug	,'OTP Verification'	,'Account','administrator','otpaccount'		
			, array( $this, 'mo_customer_validation_options'));
		add_submenu_page( $menu_slug	,'OTP Verification'	,'SMS/EMail Templates','administrator','config'		
			, array( $this, 'mo_customer_validation_options'));
		add_submenu_page( $menu_slug	,'OTP Verification'	,'Messages','administrator','messages'		
			, array( $this, 'mo_customer_validation_options'));
		add_submenu_page( $menu_slug	,'OTP Verification'	,'Design','administrator','design'		
			, array( $this, 'mo_customer_validation_options'));
		add_submenu_page( $menu_slug	,'OTP Verification'	,'Send Custom Message','administrator','custom'		
			, array( $this, 'mo_customer_validation_options'));
		add_submenu_page( $menu_slug	,'OTP Verification'	,'Licensing Plans','administrator','pricing'		
			, array( $this, 'mo_customer_validation_options'));
		add_submenu_page( $menu_slug	,'OTP Verification'	,'Troubleshooting','administrator','help'			
			, array( $this, 'mo_customer_validation_options'));
	}

	function  mo_customer_validation_options()
	{
		include 'controllers/main-controller.php';
	}

	function mo_registration_plugin_settings_style()
	{
		wp_enqueue_style( 'mo_customer_validation_admin_settings_style'	 , MOV_CSS_URL);		
	}

	function mo_registration_plugin_settings_script()
	{
		wp_enqueue_script( 'mo_customer_validation_admin_settings_script', MOV_JS_URL , array('jquery'));
		wp_enqueue_script( 'mo_customer_validation_form_validation_script', VALIDATION_JS_URL , array('jquery'));
	}

	function mo_registration_plugin_frontend_scripts()
	{
		if(!get_mo_option('mo_customer_validation_show_dropdown_on_form')) return;
		$selector = apply_filters( 'mo_phone_dropdown_selector', array() );
		if (MoUtility::isBlank($selector)) return;
		$selector = array_unique($selector); // get unique values 
		wp_enqueue_script('mo_customer_validation_inttelinput_script', MO_INTTELINPUT_JS , array('jquery'));
		wp_enqueue_style( 'mo_customer_validation_inttelinput_style', MO_INTTELINPUT_CSS);	
		wp_register_script('mo_customer_validation_dropdown_script', MO_DROPDOWN_JS , array('jquery'), MOV_VERSION, true);
		wp_localize_script('mo_customer_validation_dropdown_script', 'modropdownvars', array( 
			'selector' =>  json_encode($selector), 
			'defaultCountry' => CountryList::getDefaultCountryIsoCode(),
			'onlyCountries' => CountryList::getOnlyCountryList(),
		));
		wp_enqueue_script('mo_customer_validation_dropdown_script');
	}

	function mo_registration_deactivate()
	{
		wp_clear_scheduled_hook('hourlySync');
		delete_mo_option('mo_customer_validation_transactionId');
		delete_mo_option('mo_customer_validation_admin_password');
		delete_mo_option('mo_customer_validation_registration_status');
		delete_mo_option('mo_customer_validation_admin_phone');
		delete_mo_option('mo_customer_validation_new_registration');
		delete_mo_option('mo_customer_validation_admin_customer_key');
		delete_mo_option('mo_customer_validation_admin_api_key');
		delete_mo_option('mo_customer_validation_customer_token');
		delete_mo_option('mo_customer_validation_verify_customer');
		delete_mo_option('mo_customer_validation_message');
		delete_mo_option('mo_customer_check_ln');
	}

	public function initializeDefaults()
	{
		$templates = apply_filters( 'mo_template_defaults', array() );
		update_mo_option('mo_customer_validation_custom_popups',maybe_serialize($templates));
	}

	function mo_show_otp_message($content,$type) 
	{
		new MoDisplayMessages($content,$type);
	}

	function moScheduleTransactionSync()
	{

		if (! wp_next_scheduled('hourlySync') && MoUtility::micr()) wp_schedule_event(time(), 'daily', 'hourlySync');
	}

	function otp_load_textdomain()
	{
		load_plugin_textdomain( 'miniorange-otp-verification', FALSE, dirname( plugin_basename(__FILE__) ) . '/lang/' );
	}

	function register_ppl_strings()
	{
		if(!MoUtility::_is_polylang_installed()) return;
		foreach (unserialize(MO_POLY_STRINGS) as $key => $value) {
			pll_register_string($key,$value,'miniorange-otp-verification');
		}
	}

	function hourlySync()
	{

		$customerKey = get_mo_option('mo_customer_validation_admin_customer_key');
		$apiKey = get_mo_option('mo_customer_validation_admin_api_key');
		if(isset($customerKey) && isset($apiKey)) MoUtility::_handle_mo_check_ln(FALSE, $customerKey, $apiKey);
	}
}
new Miniorange_Customer_Validation;