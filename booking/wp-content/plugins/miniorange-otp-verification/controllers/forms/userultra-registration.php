<?php

//uultra registration
$uultra_enabled           = get_mo_option('mo_customer_validation_uultra_default_enable')? "checked" : "";
$uultra_hidden 			  = $uultra_enabled == "checked" ? "" : "hidden";
$uultra_enable_type		  = get_mo_option('mo_customer_validation_uultra_enable_type');
$uultra_form_list 		  = admin_url().'admin.php?page=userultra&tab=fields';
$uultra_field_key    	  = get_mo_option('mo_customer_validation_uultra_phone_key');

$uultra_type_phone 		  = UserUltraRegistrationForm::TYPE_PHONE;
$uultra_type_email 		  = UserUltraRegistrationForm::TYPE_EMAIL;
$uultra_type_both 		  = UserUltraRegistrationForm::TYPE_BOTH;

include MOV_DIR . 'views/forms/userultra-registration.php';