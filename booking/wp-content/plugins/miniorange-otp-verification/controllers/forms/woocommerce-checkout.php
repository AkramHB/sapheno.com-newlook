<?php

//wc checkout
$wc_checkout 			  = get_mo_option('mo_customer_validation_wc_checkout_enable') ? "checked" : "";
$wc_checkout_hidden		  = $wc_checkout=="checked" ? "" : "hidden";
$wc_checkout_enable_type  = get_mo_option('mo_customer_validation_wc_checkout_type');
$guest_checkout 		  = get_mo_option('mo_customer_validation_wc_checkout_guest')  ? "checked" : "";
$checkout_button 		  = get_mo_option('mo_customer_validation_wc_checkout_button') ? "checked" : "";
$checkout_popup 		  = get_mo_option('mo_customer_validation_wc_checkout_popup')  ? "checked" : "";
$checkout_payment_plans   = maybe_unserialize(get_mo_option('mo_customer_validation_wc_checkout_payment_type'));
$checkout_selection       = get_mo_option('mo_customer_validation_wc_checkout_selective_payment') ? "checked" : "";
$checkout_selection_hidden= $checkout_selection=="checked" ? "" : "hidden";
$wc_type_phone 			  = WooCommerceCheckOutForm::TYPE_PHONE;
$wc_type_email 			  = WooCommerceCheckOutForm::TYPE_EMAIL;
$button_text              = get_mo_option('mo_customer_validation_wc_checkout_button_link_text'); 
$button_text              = !MoUtility::isBlank($button_text) ? $button_text : mo_("Verify Your Purchase");

include MOV_DIR . 'views/forms/woocommerce-checkout.php';