<?php

//Theme my login form
$tml_enabled      = get_mo_option('mo_customer_validation_tml_enable')? "checked" : "";
$tml_hidden 	  = $tml_enabled == "checked" ? "" : "hidden";
$tml_enable_type  = get_mo_option('mo_customer_validation_tml_enable_type');

$tml_type_phone   = TmlRegistrationForm::TYPE_PHONE;
$tml_type_email   = TmlRegistrationForm::TYPE_EMAIL;
$tml_type_both   = TmlRegistrationForm::TYPE_BOTH;

include MOV_DIR . 'views/forms/tml-forms.php';