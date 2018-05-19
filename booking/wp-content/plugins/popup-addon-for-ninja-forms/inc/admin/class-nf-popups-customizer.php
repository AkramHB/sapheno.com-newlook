<?php


if ( ! class_exists( 'NF_Popups_Customizer' ) ) :

	/**
	 * WC Email Customizer class
	 */
	class NF_Popups_Customizer {
	private $trigger;
	private $popup_id;
	/**
	 * Constructor
	 */
	public function __construct() {
		global $wp_version;

		// add customizer settings
		add_action( 'customize_register', array( $this, 'customizer_settings' ) );

		if (  class_exists( 'Ninja_Forms' ) ) {
			$this->trigger = 'nf-popups-customizer';

			// only load controls for this plugin
			if ( isset( $_GET[ $this->trigger ] ) ) {

				update_option( 'nf_popup_id_customizer', $_REQUEST['popup_id' ] );
              
				add_filter( 'customize_register', array( $this, 'remove_sections' ), 600 );

				if ( version_compare( $wp_version, '4.4', '>=' ) ) {
					add_filter( 'customize_loaded_components', array( $this, 'remove_widget_panels' ), 60 );
					add_filter( 'customize_loaded_components', array( $this, 'remove_nav_menus_panels' ), 60 );
				} else {
					add_filter( 'customize_register', array( $this, 'remove_panels' ), 60 );
				}

				add_action( 'customize_register', array( $this, 'customizer_sections' ), 40 );
				add_action( 'customize_register', array( $this, 'customizer_controls' ), 50 );
				add_filter( 'customize_control_active', array( $this, 'control_filter' ), 10, 2 );
				// add our custom query vars to the whitelist
				add_filter( 'query_vars', array( $this, 'add_query_vars' ) );
				//add_action( 'customize_preview_init', array( $this, 'customizer_styles' ) );

				// enqueue customizer js
				add_action( 'customize_preview_init', array( $this, 'enqueue_customizer_script' ) );

				//add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_customizer_control_script' ) );
				// listen for the query var and load template
				add_action( 'template_redirect', array( $this, 'load_popup_template' ) );
			}


		} else {

			add_action( 'admin_notices', array( $this, 'missing_notice' ) );

		}

		return true;
	}

	public function enqueue_customizer_script() {
        wp_enqueue_style( 'animate-css', NF_POPUPS_URL . '/css/animations.css' );
		wp_enqueue_script( 'nf-popups-customizer-live-preview', NF_POPUPS_URL . '/js/customizer-preview.js', array( 'jquery', 'customize-preview' ) );
		return true;
	}

	/**
	 * Add our settings to the WordPress Customizer.
	 *
	 * @param object  $wp_customize
	 * @since 1.0.0
	 */
	public function customizer_settings( $wp_customize ) {
		global $wp_customize;
		include 'class-nf-popups-customizer-settings.php';

		NF_Popups_Customizer_Settings::add_settings( );

		return true;
	}

	/**
	 * Show only our  settings in the preview
	 *
	 * @since 1.0.0
	 */
	public function control_filter( $active, $control ) {

		if ( in_array( $control->section, array( 'nf_popups_container_settings', 'nf_popups_overlay_settings','nf_popups_animation_settings','nf_popups_close_btn_settings' ) ) ) {

			return true;
		}

		return false;
	}

	/**
	 * Add our sections to the WordPress Customizer.
	 *
	 * @param object  $wp_customize
	 * @since 1.0.0
	 */
	public function customizer_sections( $wp_customize ) {
		global $wp_customize;

		include 'class-nf-popups-customizer-sections.php';

		NF_Popups_Customizer_Sections::add_sections();

		return true;
	}

	/**
	 * Add our controls to the WordPress Customizer.
	 *
	 * @param object  $wp_customize
	 * @since 1.0.0
	 */
	public function customizer_controls( $wp_customize ) {
		global $wp_customize;

		include 'class-nf-popups-customizer-controls.php';

		NF_Popups_Customizer_Controls::add_controls( );

		return true;
	}



	/**
	 * Remove any unwanted default conrols.
	 *
	 * @param object  $wp_customize
	 * @since 1.0.0
	 */
	public function remove_sections( $wp_customize ) {
        global $wp_customize;  
      //  var_dump($wp_customize->get_section('themes')); die;
		$wp_customize->remove_section( 'themes' );  
		return true;
	}

	/**
	 * Removes the core 'Widgets' panel from the Customizer.
	 *
	 * @param array   $components Core Customizer components list.
	 * @return array (Maybe) modified components list.
	 */
	public function remove_widget_panels( $components ) {
		$i = array_search( 'widgets', $components );
		if ( false !== $i ) {
			unset( $components[ $i ] );
		}
		return $components;
	}

	/**
	 * Removes the core 'Menus' panel from the Customizer.
	 *
	 * @param array   $components Core Customizer components list.
	 * @return array (Maybe) modified components list.
	 */
	public function remove_nav_menus_panels( $components ) {
		$i = array_search( 'nav_menus', $components );
		if ( false !== $i ) {
			unset( $components[ $i ] );
        }
       
		return $components;
	}

	/**
	 * Remove any unwanted default panels.
	 *
	 * @param object  $wp_customize
	 * @since 1.1.2
	 */
	public function remove_panels( $wp_customize ) {
		global $wp_customize;

		// because above causes issues, for now use below work around
		$wp_customize->get_panel( 'nav_menus' )->active_callback = '__return_false';
		$wp_customize->remove_panel( 'widgets' );

		return true;
	}

	/**
	 * Add custom variables to the available query vars
	 *
	 * @param mixed   $vars
	 * @return mixed
	 * @since 1.0.0
	 */
	public function add_query_vars( $vars ) {
		$vars[] = $this->trigger;

		return $vars;
	}

	/**
	 * If the right query var is present load the popup template
	 *
	 * @since 1.0.0
	 */
	public function load_popup_template( $wp_query ) {

		// load this conditionally based on the query var
		if ( get_query_var( $this->trigger ) ) {
			wp_head();

			$popup_id = sanitize_text_field( $_REQUEST['popup_id'] );

			include NF_POPUPS_DIR_URL . '/inc/admin/views/html-popup-template-preview.php';

			$message = ob_get_clean();

			wp_footer();

			echo $message;
			exit;
		}

		return $wp_query;
	}

	/**
	 *  fallback notice.
	 *
	 * @return string
	 */
	public function missing_notice() {
		echo '<div class="error"><p>' . sprintf( __( 'Popup Addon for Ninja Forms requires Ninja Forms 3.0 or later to be installed and active. You can download %s here.', 'nf-popup' ), '<a href="http://www.ninjaforms.com" target="_blank">Ninja Forms</a>' ) . '</p></div>';
		return true;
	}

	public static function get_value( $popup_id, $var ) {
		$val = get_option( 'nf_popups' );

		if ( isset( $val[$popup_id][$var] ) ) {
			return $val[$popup_id][$var];
		}else {
			return '';
		}
	}
}

add_action( 'plugins_loaded', 'nf_popups_customizer_init', 0 );

/**
 * init function
 *
 * @package
 * @since 1.0.0
 * @return bool
 */
function nf_popups_customizer_init() {
	new NF_Popups_Customizer();

	return true;
}
endif;
