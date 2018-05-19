<?php

//WP eMember
$emember_enabled 			  = get_mo_option('mo_customer_validation_emember_default_enable') ? "checked" : "";
$emember_hidden 			  = $emember_enabled== "checked" ? "" : "hidden";
$emember_enable_type		  = get_mo_option('mo_customer_validation_emember_enable_type');
$form_settings_link 		  = admin_url().'admin.php?page=eMember_settings_menu&tab=4';

$emember_type_phone 		  = WpEmemberForm::TYPE_PHONE;
$emember_type_email 		  = WpEmemberForm::TYPE_EMAIL;
$emember_type_both 		  	  = WpEmemberForm::TYPE_BOTH;

include MOV_DIR . 'views/forms/emember-registration.php';