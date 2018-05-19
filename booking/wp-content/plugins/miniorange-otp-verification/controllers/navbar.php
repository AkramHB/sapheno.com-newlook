<?php

	$registered 	= MoUtility::micr();
	$profile_url	= add_query_arg( array('page' => 'otpaccount' ), $_SERVER['REQUEST_URI'] );
	$settings		= add_query_arg( array('page' => 'mosettings' ), $_SERVER['REQUEST_URI'] );
	$messages		= add_query_arg( array('page' => 'messages'	  ), $_SERVER['REQUEST_URI'] );
	$help_url		= add_query_arg( array('page' => 'help'		  ), $_SERVER['REQUEST_URI'] );
	$license_url	= add_query_arg( array('page' => 'pricing'	  ), $_SERVER['REQUEST_URI'] );
	$config			= add_query_arg( array('page' => 'config'	  ), $_SERVER['REQUEST_URI'] );
	$custom			= add_query_arg( array('page' => 'custom'	  ), $_SERVER['REQUEST_URI'] );
	$otpsettings	= add_query_arg( array('page' => 'otpsettings'), $_SERVER['REQUEST_URI'] );
	$design			= add_query_arg( array('page' => 'design'	  ), $_SERVER['REQUEST_URI'] );

	$active_tab 	= $_GET['page'];

	include MOV_DIR . 'views/navbar.php';