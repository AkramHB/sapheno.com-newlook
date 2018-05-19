<?php

//wp members 
$wp_member_reg_enabled 		= get_mo_option('mo_customer_validation_wp_member_reg_enable') ? "checked" : "";
$wp_member_reg_hidden 		= $wp_member_reg_enabled== "checked" ? "" : "hidden";
$wpmember_enabled_type 	 	= get_mo_option('mo_customer_validation_wp_member_reg_enable_type');
$wpm_field_list				= admin_url().'admin.php?page=wpmem-settings&tab=fields';

$wpm_type_phone 			= WpMemberForm::TYPE_PHONE;
$wpm_type_email 			= WpMemberForm::TYPE_EMAIL;

include MOV_DIR . 'views/forms/wp-member.php';