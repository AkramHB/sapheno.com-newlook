<?php
/*
Plugin Name: Contact Form 7 Style
Plugin URI: http://wordpress.reea.net/contact-form-7-style/
Description: Simple style customization and templating for Contact Form 7 forms. Requires Contact Form 7 plugin installed.
Version: 3.1.6
Author: Johnny, dorumarginean, mlehelsz, MirceaR
Author URI: http://cf7style.com
License: GPL2
@Author: Johnny, dorumarginean, mlehelsz, MirceaR
*/

if ( !defined( 'ABSPATH' ) ) {
 exit;
}

/*
 *	Include the plugin options
 */
define( 'WPCF7S_PLUGIN', __FILE__ );	
define( 'WPCF7S_PLUGIN_DIR', untrailingslashit( dirname( WPCF7S_PLUGIN ) ) );
define( 'WPCF7S_LOCATION',plugin_dir_url( WPCF7S_PLUGIN ) );
define( 'WPCF7S_PLUGIN_VER', '3.1.6' );
define( 'WPCF7S_REQ_PLUGIN', 'contact-form-7/wp-contact-form-7.php' );

/*
 * Get contact form 7 ID
 */
require_once( 'inc/get_form_id.php' );

/*
 * Load Custom CSS generator function here
 */
require_once( 'inc/custom_css_generator.php' );


/*
 * Check for Contact Form 7 plugin
 * Add proper messages to admin pages : missing CF7, not active CF7, success CF7k, remove predefined templates
 */
require_once( 'inc/admin_notices_activation.php' );

/*
 * Check for current version
 */
require_once( 'inc/check_cfstyle_version.php' );

/*
 * Create custom post type and taxonomy and populate with predefined templates
 * Create custom style layout with metaboxes
 * Front-End part: run style generator
 */
require_once( 'inc/init_style.php' );

/*
 * Add CF7Style edit URL to wpadminbar with bird icon
 * Last positioned element
 */
require_once( 'inc/adminbar_add_link.php' );

/*
 * Add required admin styles and scripts
 */
require_once( 'inc/add_required_admin_scripts.php' );

/*
 * Add required frontend styles and scripts
 */
require_once( 'inc/add_required_frontend_scripts.php' );


/*
 * Add filters to dashboard for CF7Style plugin
 */
require_once( 'inc/taxonomy_filters_add.php' );

/*
 * Add cf7style proper class to CF7 form where needed 
 */
require_once( 'inc/cf7_add_form_class.php' );

/*
 * Add Preview style column to the Contact Styles listing table
 */
require_once( 'inc/dashboard_table_add_preview.php' );

/*
 * Check for Predefined templates and update options : "cf7_style_no_temps" and "cf7_style_deleted"
 */
require_once( 'inc/check_deleted_templates.php' );
 
/*
 * Deactivation hook 
 */
require_once( 'inc/deactivate_style.php' );


/*
 * Tracking feature
 */
require_once( 'misc/tracking.php' );

/*
 * Welcome panel
 */
require_once( 'misc/welcome.php' );

/*
 * Slider meta box in CF7
 */
require_once( 'inc/slider_meta_box.php' );

/*
 * global css page
 */
require_once( 'inc/editor_page.php' );

/*
 * System status
 */
require_once( 'inc/system_status.php' );

/*
 * Remove Predefined templates
 */
require_once( 'inc/remove_predefined_templates.php' );

/*
 * CTA: Close delete predefined box will hide the notice for removing the predefined templates 
 */
require_once( 'inc/dashboard_hide_delete_tpl_box.php' );

/*
 * CTA: Close welcome box will hide the welcome elements
 */
require_once( 'inc/dashboard_hide_welcome_box.php' );

/*
 * Frontend edit link
 */
require_once( 'inc/frontend_edit_style_link.php' );

/*
 * Dashboard generate preview on user interaction
 */
require_once( 'inc/dashboard_generate_preview.php' );

/*
 * Dashboard generate custom style  desired properties
 */
require_once( 'inc/dashboard_load_custom_property.php' );
