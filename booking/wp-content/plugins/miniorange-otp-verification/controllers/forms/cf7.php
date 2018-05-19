<?php

//cf7 form
$cf7_enabled 			  = get_mo_option('mo_customer_validation_cf7_contact_enable') ? "checked" : "";
$cf7_hidden 			  = $cf7_enabled== "checked" ? "" : "hidden";
$cf7_enabled_type 		  = get_mo_option('mo_customer_validation_cf7_contact_type');
$cf7_field_list 		  = admin_url().'admin.php?page=wpcf7';
$cf7_field_key 			  = get_mo_option('mo_customer_validation_cf7_email_key');

$cf7_type_phone 		  = ContactForm7::TYPE_PHONE;
$cf7_type_email 		  = ContactForm7::TYPE_EMAIL;

include MOV_DIR . 'views/forms/cf7.php';