<?php

//profile builder
$pb_enabled         = get_mo_option('mo_customer_validation_pb_default_enable')  ? "checked" : "";
$pb_hidden 	        = $pb_enabled=="checked" ? "" : "hidden";
$pb_enable_type     = get_mo_option('mo_customer_validation_pb_enable_type');
$pb_phone_key       = get_mo_option('mo_customer_validation_pb_phone_meta_key');
$pb_fields          = admin_url() . 'admin.php?page=manage-fields';

$pb_reg_type_phone      = ProfileBuilderRegistrationForm::TYPE_PHONE;
$pb_reg_type_email 	    = ProfileBuilderRegistrationForm::TYPE_EMAIL;
$pb_reg_type_both 	    = ProfileBuilderRegistrationForm::TYPE_BOTH;

include MOV_DIR . 'views/forms/profile-builder.php';