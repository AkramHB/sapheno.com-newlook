<?php if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Plugin Name: Popup Addon for Ninja Forms
 * Plugin URI: https://ninjapopup.org
 * Description: Open Ninja Forms in beautiful Popups
 * Version: 3.2.3
 * Author: WebHolics
 * Text Domain: nf-popup
 *
 * Copyright 2018 WebHolics.
 */

define( "NF_POPUPS_URL", plugins_url() . "/" . basename( dirname( __FILE__ ) ) );
define( "NF_POPUPS_DIR_URL", WP_PLUGIN_DIR . "/" . basename( dirname( __FILE__ ) ) );

define( 'NF_POPUPS_STORE_URL', 'https://ninjapopup.org/' );

require_once NF_POPUPS_DIR_URL . '/inc/admin/class-nf-popups-postype.php';
require_once NF_POPUPS_DIR_URL . '/inc/admin/class-nf-popups-settings-metabox.php';
require_once NF_POPUPS_DIR_URL . '/inc/admin/class-nf-popups-customizer.php';
require_once NF_POPUPS_DIR_URL . '/inc/shortcode.php';

require_once NF_POPUPS_DIR_URL . '/inc/admin/class-nf-popups-extensions.php';
require_once NF_POPUPS_DIR_URL . '/inc/admin/class-nf-popups-licenses.php';
/**
 * Frontend Scripts
 *
 * @return void
 */
function nf_popups_scripts() {
    wp_enqueue_style( 'animate-css', NF_POPUPS_URL . '/css/animations.css' );
	wp_enqueue_style( 'magnific-popup', NF_POPUPS_URL . '/css/magnific-popup.css' );
	wp_enqueue_script( 'magnific-popup', NF_POPUPS_URL . '/js/magnific-popup.js', array( 'jquery' ), false, false );
	wp_enqueue_script( 'nf-popups', NF_POPUPS_URL . '/js/nf-popups.js', array( 'jquery' ) );
}
add_action( 'wp_enqueue_scripts', 'nf_popups_scripts' );
/**
 * Backend Scripts
 *
 * @return void
 */
function nf_popups_admin_scripts() {
	wp_enqueue_style( 'nf-popups-admin', NF_POPUPS_URL . '/css/nf-popups-admin.css' );
	wp_enqueue_script( 'nf-popups-admin', NF_POPUPS_URL . '/js/admin.js', array( 'jquery' ), false, false );
}
add_action( 'admin_enqueue_scripts', 'nf_popups_admin_scripts' );
