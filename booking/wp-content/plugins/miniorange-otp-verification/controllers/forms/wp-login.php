<?php

//wp login form
$wp_login_enabled 		= get_mo_option('mo_customer_validation_wp_login_enable') ? "checked" : "";
$wp_login_hidden 		= $wp_login_enabled == "checked" ? "" : "hidden";
$wp_login_enabled_type 	= get_mo_option('mo_customer_validation_wp_login_register_phone')? "checked" : "";
$wp_login_otp_enabled   = maybe_unserialize(get_mo_option('mo_customer_validation_wp_login_otp_enabled'));
$wp_login_field_key    	= get_mo_option('mo_customer_validation_wp_login_key');
$wp_login_admin			= get_mo_option('mo_customer_validation_wp_login_bypass_admin')? "checked" : "";
$wp_login_with_phone 	= get_mo_option('mo_customer_validation_wp_login_allow_phone_login')? "checked" : "";
$wp_handle_duplicates   = get_mo_option('mo_customer_validation_wp_login_restrict_duplicates')? "checked" : "";

include MOV_DIR . 'views/forms/wp-login.php';     