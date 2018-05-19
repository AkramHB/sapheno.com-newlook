<?php

	if(! defined( 'ABSPATH' )) exit;

	define('MOV_VERSION', '3.2.40');
	define('MOV_DIR', plugin_dir_path(__FILE__));
	define('MOV_URL', plugin_dir_url(__FILE__));
	define('MOV_CSS_URL', MOV_URL . 'includes/css/mo_customer_validation_style.min.css?version='.MOV_VERSION);
	define('MO_INTTELINPUT_CSS', MOV_URL.'includes/css/intlTelInput.css?version='.MOV_VERSION);
	define('MOV_JS_URL', MOV_URL . 'includes/js/settings.min.js?version='.MOV_VERSION);
	define('VALIDATION_JS_URL', MOV_URL . 'includes/js/formValidation.min.js?version='.MOV_VERSION);
	define('MO_INTTELINPUT_JS', MOV_URL.'includes/js/intlTelInput.min.js?version='.MOV_VERSION);
	define('MO_DROPDOWN_JS', MOV_URL.'includes/js/dropdown.min.js?version='.MOV_VERSION);
	define('MOV_LOADER_URL', MOV_URL . 'includes/images/loader.gif');
	define('MOV_LOGO_URL', MOV_URL . 'includes/images/logo.png');
	define('MOV_USE_POLYLANG', TRUE);
	define('MO_TEST_MODE', FALSE);

	//Include all required files for plugin to work.
	includeFile('/objects');
	require_once 'includes/lib/encryption.php';	
	includeFile('/helper');
	includeFile('/handler');
	require_once 'views/common-elements.php';

	global $phoneLogic,$emailLogic;
	$phoneLogic = new PhoneLogic();
	$emailLogic = new EmailLogic();

	function includeFile($folder)
	{
		foreach (scandir(dirname(__FILE__).$folder) as $filename) 
		{
		    $path = dirname(__FILE__) . $folder . '/' . $filename;
		    if (is_file($path) && strpos($filename, '.php') !== false) require_once $path;
		    elseif(is_dir($path) && $filename!="" && $filename!="." && $filename!="..") includeFile($folder . '/' . $filename);
		}
	}

	function mo_($string)
	{
		return is_scalar( $string ) ? ( MoUtility::_is_polylang_installed() && MOV_USE_POLYLANG ? pll__($string) 
				: __( $string, 'miniorange-otp-verification' ) ) : $string;
	}

	function get_mo_option($string)
	{
		return apply_filters('get_mo_option',get_site_option($string));
	}

	function update_mo_option($string,$value)
	{
		update_site_option($string,apply_filters('update_mo_option',$value,$string));
	}

	function delete_mo_option($string)
	{
		delete_site_option($string);
	}