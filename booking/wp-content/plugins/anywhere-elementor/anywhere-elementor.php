<?php
/**
 * Plugin Name: Anywhere Elementor
 * Description: Allows you to insert elementor pages and library templates anywhere using shortcodes.
 * Plugin URI: http://www.elementoraddons.com/
 * Author: WebTechStreet
 * Version: 1.0
 * Author URI: http://www.elementoraddons.com/
 * Text Domain: wts_ae
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'AE_VERSION', '1.0' );

define( 'WTS_AE__FILE__', __FILE__ );
define( 'WTS_AE_PLUGIN_BASE', plugin_basename( WTS_AE__FILE__ ) );
define( 'WTS_AE_URL', plugins_url( '/', WTS_AE__FILE__ ) );
define( 'WTS_AE_PATH', plugin_dir_path( WTS_AE__FILE__ ) );
define( 'WTS_AE_ASSETS_URL', WTS_AE_URL . 'includes/assets/' );

add_action( 'plugins_loaded', 'wts_ae_load_plugin_textdomain' );


require_once( WTS_AE_PATH . 'includes/post-type.php' );
require_once( WTS_AE_PATH . 'includes/meta-box.php' );
require_once( WTS_AE_PATH . 'includes/bootstrap.php' );


/**
 *  Load gettext translate for our text domain.
 */
function WTS_AE_load_plugin_textdomain(){
    load_plugin_textdomain( 'wts_ae' );
}


function wts_ae_styles_method() {
    $custom_css = "<style type='text/css'> .ae_data .elementor-editor-element-setting {
                        display:none !important;
                }
                </style>";
    echo $custom_css;
}
add_action( 'wp_head', 'wts_ae_styles_method' );
