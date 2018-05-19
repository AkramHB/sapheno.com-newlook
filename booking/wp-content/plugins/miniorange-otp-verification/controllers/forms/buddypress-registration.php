<?php

	//bbp registration
	$bbp_enabled 			  = get_mo_option('mo_customer_validation_bbp_default_enable') ? "checked" : "";
	$bbp_hidden 			  = $bbp_enabled=="checked" ? "" : "hidden";
	$bbp_enable_type 		  = get_mo_option('mo_customer_validation_bbp_enable_type');
	$bbp_fields 			  = admin_url().'users.php?page=bp-profile-setup';
	$bbp_field_key			  = get_mo_option('mo_customer_validation_bbp_phone_key');
	$automatic_activation     = get_mo_option('mo_customer_validation_bbp_disable_activation') ? "checked" : "";

	$bbp_type_phone 		  = BuddyPressRegistrationForm::TYPE_PHONE;
	$bbp_type_email 		  = BuddyPressRegistrationForm::TYPE_EMAIL;
	$bbp_type_both	 		  = BuddyPressRegistrationForm::TYPE_BOTH;

	include MOV_DIR . 'views/forms/buddypress-registration.php';

