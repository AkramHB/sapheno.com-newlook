<?php 

if ( !defined( 'ABSPATH' ) ) {
 exit;
}

function cf7_style_frontend_scripts(){
	if (!wp_script_is( 'jquery', 'enqueued' )) {
		wp_enqueue_script('jquery');
	}
	if(is_user_logged_in()){
		wp_enqueue_style( "cf7-style-bar-style", WPCF7S_LOCATION . "css/admin-bar.css", array(), WPCF7S_PLUGIN_VER, "all");
	}
	wp_enqueue_style( "cf7-style-frontend-style", WPCF7S_LOCATION . "css/frontend.css", array(), WPCF7S_PLUGIN_VER, "all");
	wp_enqueue_style( "cf7-style-responsive-style", WPCF7S_LOCATION . "css/responsive.css", array(), WPCF7S_PLUGIN_VER, "all");
	wp_enqueue_script( "cf7-style-frontend-script", WPCF7S_LOCATION . "js/frontend-min.js", array( 'jquery' ), WPCF7S_PLUGIN_VER, true);
}

add_action( 'wp_enqueue_scripts', 'cf7_style_frontend_scripts' );