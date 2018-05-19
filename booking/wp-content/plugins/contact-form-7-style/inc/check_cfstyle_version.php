<?php 

if ( !defined( 'ABSPATH' ) ) {
 exit;
}

function cf7_style_create_posts(){
	update_option( 'cf7_style_no_temps', 'show_box' );
	update_option( 'cf7_style_welcome', 'show_box' );
	update_option( 'cf7_style_update_saved', 'yes' );
	update_option( 'cf7_style_allow_tracking', '5' );
	update_option( 'cf7_style_add_categories', '0' );
}

function cf7style_update_db_check() {
	if (get_option( 'cf7_style_plugin_version' ) != WPCF7S_PLUGIN_VER) {
	    cf7_style_create_posts();
	    update_option( 'cf7_style_plugin_version', WPCF7S_PLUGIN_VER );
	}
}

add_action( 'plugins_loaded', 'cf7style_update_db_check' );