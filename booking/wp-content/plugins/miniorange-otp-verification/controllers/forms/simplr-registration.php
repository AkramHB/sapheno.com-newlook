<?php

//Simplr Registration Form
$simplr_enabled			  = get_mo_option('mo_customer_validation_simplr_default_enable') ? "checked" : "";
$simplr_hidden			  = $simplr_enabled=="checked" ? "" : "hidden";
$simplr_enabled_type  	  = get_mo_option('mo_customer_validation_simplr_enable_type');
$simplr_fields_page       = admin_url().'options-general.php?page=simplr_reg_set&regview=fields&orderby=name&order=desc';
$simplr_field_key  		  = get_mo_option('mo_customer_validation_simplr_field_key');

$simplr_type_phone 		  = SimplrRegistrationForm::TYPE_PHONE;
$simplr_type_email 		  = SimplrRegistrationForm::TYPE_EMAIL;
$simplr_type_both 		  = SimplrRegistrationForm::TYPE_BOTH;

include MOV_DIR . 'views/forms/simplr-registration.php';