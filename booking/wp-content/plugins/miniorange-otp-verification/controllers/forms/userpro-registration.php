<?php

//UserPro Form
$userpro_enabled 			  = get_mo_option('mo_customer_validation_userpro_default_enable') ? "checked" : "";
$userpro_hidden 			  = $userpro_enabled== "checked" ? "" : "hidden";
$userpro_enabled_type 		  = get_mo_option('mo_customer_validation_userpro_enable_type');
$userpro_field_list 		  = admin_url().'admin.php?page=userpro&tab=fields';
$automatic_verification		  = get_mo_option('mo_customer_validation_userpro_verify') ? "checked" : "";

$userpro_type_phone 		  = UserProRegistrationForm::TYPE_PHONE;
$userpro_type_email 		  = UserProRegistrationForm::TYPE_EMAIL;

include MOV_DIR . 'views/forms/userpro-registration.php';