<?php

//upme registration
$upme_enabled 			  = get_mo_option('mo_customer_validation_upme_default_enable') ? "checked" : "";
$upme_hidden 			  = $upme_enabled== "checked" ? "" : "hidden";
$upme_enable_type		  = get_mo_option('mo_customer_validation_upme_enable_type');
$upme_field_list 		  = admin_url().'admin.php?page=upme-field-customizer';
$upme_field_key    	 	  = get_mo_option('mo_customer_validation_upme_phone_key');

$upme_type_phone 		  = UserProfileMadeEasyRegistrationForm::TYPE_PHONE;
$upme_type_email 		  = UserProfileMadeEasyRegistrationForm::TYPE_EMAIL;
$upme_type_both 		  = UserProfileMadeEasyRegistrationForm::TYPE_BOTH;

include MOV_DIR . 'views/forms/upme-registration.php';