<?php
/**
 * Plugin Name: Ninja Forms styler for Elementor
 * Description: Ninja Forms styler for elementor. Design the form visually with elementor.
 * Plugin URI: https://essential-addons.com/elementor/ninja-forms
 * Author: Essential Addons
 * Version: 1.0.0
 * Author URI: https://essential-addons.com/elementor/
 *
 * Text Domain: elementor-ninja-forms
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'EAEL_NINJA_FORMS_URL', plugins_url( '/', __FILE__ ) );
define( 'EAEL_NINJA_FORMS_PATH', plugin_dir_path( __FILE__ ) );


require_once EAEL_NINJA_FORMS_PATH.'includes/elementor-helper.php';
require_once EAEL_NINJA_FORMS_PATH.'includes/queries.php';
require_once EAEL_NINJA_FORMS_PATH.'admin/settings.php';


// Upsell
include_once dirname( __FILE__ ) . '/includes/eael-ninja-forms-upsell.php';
new Eael_Ninja_Forms_Upsell('');
/**
 * Load Elementor Contact Form 7
 */
function add_eael_ninja_forms() {

  if ( function_exists( 'Ninja_Forms' ) ) {
    require_once EAEL_NINJA_FORMS_PATH.'includes/ninja-forms.php';
  }

}
add_action('elementor/widgets/widgets_registered','add_eael_ninja_forms');

/**
 * Load Eael Contact Form 7 CSS
 */
function eael_ninja_forms_enqueue() {

   wp_enqueue_style('essential_addons_elementor-nf-css',EAEL_NINJA_FORMS_URL.'assets/css/elementor-ninja-forms.css');

}
add_action( 'wp_enqueue_scripts', 'eael_ninja_forms_enqueue' );

/**
 * Admin Notices
 */
function eael_ninja_forms_admin_notice() {
	if( !function_exists( 'Ninja_Forms' ) ) :
	?>
		<div class="error notice is-dismissible">
			<p><strong>Elementor Ninja Forms styler</strong> needs <strong>Ninja Forms</strong> plugin to be installed. Please install the plugin now! <button id="eael-install-nf" class="button button-primary">Install Now!</button></p>
		</div>
	<?php
	endif;
}
add_action( 'admin_notices', 'eael_ninja_forms_admin_notice' );
