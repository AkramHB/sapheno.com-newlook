<?php

//WP default Registration form
$default_registration 	  = get_mo_option('mo_customer_validation_wp_default_enable')  ? "checked" : "";
$wp_default_hidden		  = $default_registration== "checked" ? "" : "hidden";
$wp_default_type		  = get_mo_option('mo_customer_validation_wp_default_enable_type');
$wp_handle_reg_duplicates = get_mo_option('mo_customer_validation_wp_reg_restrict_duplicates')? "checked" : "";

$wpreg_phone_type 		  = DefaultWordPressRegistrationForm::TYPE_PHONE;
$wpreg_email_type 		  = DefaultWordPressRegistrationForm::TYPE_EMAIL;
$wpreg_both_type 		  = DefaultWordPressRegistrationForm::TYPE_BOTH;

include MOV_DIR . 'views/forms/wp-registration.php';