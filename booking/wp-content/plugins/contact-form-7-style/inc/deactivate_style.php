<?php 
/*
 * Reset the cf7_style_cookie option
 */

if ( !defined( 'ABSPATH' ) ) {
 exit;
}

function cf7_style_deactivate() {
	update_option( 'cf7_style_cookie', false );
	update_option( 'cf7_style_add_categories', 0 );
}
register_deactivation_hook( __FILE__, 'cf7_style_deactivate' );