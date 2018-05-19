<?php

if ( !defined( 'ABSPATH' ) ) {
 exit;
}

function cf7_style_remove_box() {
	global $wpdb;
	update_option( 'cf7_style_no_temps', 'hide_box' );
	wp_die();
}
add_action( 'wp_ajax_cf7_style_remove_box', 'cf7_style_remove_box' );