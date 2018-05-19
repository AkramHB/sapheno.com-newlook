<?php

	//wc default registration
	$woocommerce_registration = get_mo_option('mo_customer_validation_wc_default_enable')  ? "checked" : "";
	$wc_hidden 				  = $woocommerce_registration=="checked" ? "" : "hidden";
	$wc_enable_type			  = get_mo_option('mo_customer_validation_wc_enable_type');
	$wc_restrict_duplicates   = get_mo_option('mo_customer_validation_wc_restrict_duplicates');
	$wc_restrict_duplicates   = $wc_restrict_duplicates ? "checked" : "";

	$wc_reg_type_phone 		  = WooCommerceRegistrationForm::TYPE_PHONE;
	$wc_reg_type_email 		  = WooCommerceRegistrationForm::TYPE_EMAIL;
	$wc_reg_type_both 		  = WooCommerceRegistrationForm::TYPE_BOTH;

	include MOV_DIR . 'views/forms/woocommerce-registration.php';