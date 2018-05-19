<?php

//pie registration
$pie_enabled 			  = get_mo_option('mo_customer_validation_pie_default_enable') ? "checked" : "";
$pie_hidden 			  = $pie_enabled== "checked" ? "" : "hidden";
$pie_enable_type		  = get_mo_option('mo_customer_validation_pie_enable_type');
$pie_field_key    	 	  = get_mo_option('mo_customer_validation_pie_phone_key');

$pie_type_phone 		  = PieRegistrationForm::TYPE_PHONE;
$pie_type_email 		  = PieRegistrationForm::TYPE_EMAIL;
$pie_type_both 		  	  = PieRegistrationForm::TYPE_BOTH;

include MOV_DIR . 'views/forms/pie-registration.php';