<?php

$sms_template_guide_url 	= 'includes/images/smsTemplate.jpg';
$sms_gateway_guide_url 		= MoUtility::micv() ? 'includes/images/smsGateway.jpg' 		: 'includes/images/smsGatewayOb.jpg';
$email_template_guide_url 	= 'includes/images/emailTemplate.jpg';
$email_gateway_guide_url 	= MoUtility::micv() ? 'includes/images/emailGateway.jpg' 	: 'includes/images/emailGatewayOb.jpg';
$hidden			   			= MoUtility::micv() ? '' 									: "hidden"; 

include MOV_DIR . 'views/configuration.php';