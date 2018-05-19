<?php

//event registration
$event_enabled 			  = get_mo_option('mo_customer_validation_event_default_enable') ? "checked" : "";
$event_hidden			  = $event_enabled=="checked" ? "" : "hidden";
$event_enabled_type 	  = get_mo_option('mo_customer_validation_event_enable_type');

$event_type_phone 		  = EventRegistrationForm::TYPE_PHONE;
$event_type_email 		  = EventRegistrationForm::TYPE_EMAIL;
$event_type_both 		  = EventRegistrationForm::TYPE_BOTH;

//include MOV_DIR . 'views/forms/event-registration.php';