<?php 

//WP Comment Form 
$wpcomment_enabled		  	= get_mo_option('mo_customer_validation_wpcomment_enable') ? "checked" : "";
$wpcomment_hidden 		  	= $wpcomment_enabled== "checked" ? "" : "hidden";
$wpcomment_type   			= get_mo_option('mo_customer_validation_wpcomment_enable_type');
$wpComment_force_verify 	= get_mo_option('mo_customer_validation_wpcomment_enable_for_loggedin_users') ? "checked" : ""	;

$wpcomment_type_phone 		= WordPressComments::TYPE_PHONE;
$wpcomment_type_email 		= WordPressComments::TYPE_EMAIL;

include MOV_DIR . 'views/forms/wp-comment.php';