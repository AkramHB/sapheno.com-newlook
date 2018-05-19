<?php

	//wc checkout
	$wc_social_login		  = get_mo_option('mo_customer_validation_wc_social_login_enable') ? "checked" : "";

	include MOV_DIR . 'views/forms/woocommerce-social-login.php';
	