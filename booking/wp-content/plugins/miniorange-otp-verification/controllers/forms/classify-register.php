<?php

//Classify theme Register Forms 
$classify_enabled 		 = get_mo_option('mo_customer_validation_classify_enable') ? "checked" : "";
$classify_hidden 		 = $classify_enabled== "checked" ? "" : "hidden";
$classify_enabled_type 	 = get_mo_option('mo_customer_validation_classify_type');

$classify_type_phone 	 = ClassifyRegistrationForm::TYPE_PHONE;
$classify_type_email	 = ClassifyRegistrationForm::TYPE_EMAIL;

include MOV_DIR . 'views/forms/classify-register.php';