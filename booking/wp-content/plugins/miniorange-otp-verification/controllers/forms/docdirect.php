<?php

//DocDirect Registration form
$docdirect_enabled 		= get_mo_option('mo_customer_validation_docdirect_enable') ? "checked" : "";
$docdirect_hidden 		= $docdirect_enabled== "checked" ? "" : "hidden";
$docdirect_enabled_type = get_mo_option('mo_customer_validation_docdirect_enable_type');

$docdirect_type_phone 	= DocDirectThemeRegistration::TYPE_PHONE;
$docdirect_type_email 	= DocDirectThemeRegistration::TYPE_EMAIL;

include MOV_DIR . 'views/forms/docdirect.php';