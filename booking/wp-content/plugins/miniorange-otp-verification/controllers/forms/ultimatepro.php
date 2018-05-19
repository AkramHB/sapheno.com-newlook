<?php

//ultimatePRO registration form
$ultipro_enabled 		 = get_mo_option('mo_customer_validation_ultipro_enable') ? "checked" : "";
$ultipro_hidden 		 = $ultipro_enabled== "checked" ? "" : "hidden";
$ultipro_enabled_type 	 = get_mo_option('mo_customer_validation_ultipro_type');
$umpro_custom_field_list = admin_url().'admin.php?page=ihc_manage&tab=register&subtab=custom_fields';

$umpro_type_phone 		 = UltimateProRegistrationForm::TYPE_PHONE;
$umpro_type_email 		 = UltimateProRegistrationForm::TYPE_EMAIL;

include MOV_DIR . 'views/forms/ultimatepro.php';
