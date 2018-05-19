<?php

//Reales WP Theme
$reales_enabled      	= get_mo_option('mo_customer_validation_reales_enable')? "checked" : "";
$reales_hidden 	  		= $reales_enabled == "checked" ? "" : "hidden";
$reales_enable_type  	= get_mo_option('mo_customer_validation_reales_enable_type');

$reales_type_phone 		= RealesWPTheme::TYPE_PHONE;
$reales_type_email 		= RealesWPTheme::TYPE_EMAIL;

include MOV_DIR . 'views/forms/reales-theme.php';