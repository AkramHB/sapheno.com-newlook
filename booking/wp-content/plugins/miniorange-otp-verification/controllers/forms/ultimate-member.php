<?php

//ultra membership
$um_enabled 			  = get_mo_option('mo_customer_validation_um_default_enable') ? "checked" : "";
$um_hidden 				  = $um_enabled=="checked" ? "" : "hidden";
$um_enabled_type		  = get_mo_option('mo_customer_validation_um_enable_type');
$um_forms 				  = admin_url().'edit.php?post_type=um_form';

$um_type_phone	 		  = UltimateMemberRegistrationForm::TYPE_PHONE;
$um_type_email	 		  = UltimateMemberRegistrationForm::TYPE_EMAIL;
$um_type_both	 		  = UltimateMemberRegistrationForm::TYPE_BOTH;

include MOV_DIR . 'views/forms/ultimate-member.php';