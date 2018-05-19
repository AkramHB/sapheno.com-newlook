<?php
/**
 * GeneratepressCompatibility.
 *
 * @package  header-footer-elementor
 */

/**
 * HFE_GeneratePress_Compat setup
 *
 * @since 1.0
 */
class HFE_GeneratePress_Compat {

	/**
	 * Instance of HFE_GeneratePress_Compat
	 *
	 * @var HFE_GeneratePress_Compat
	 */
	private static $instance;

	/**
	 *  Initiator
	 */
	public static function instance() {

		if ( ! isset( self::$instance ) ) {
			self::$instance = new HFE_GeneratePress_Compat();

			self::$instance->hooks();
		}

		return self::$instance;
	}

	/**
	 * Run all the Actions / Filters.
	 */
	public function hooks() {

		if ( hfe_header_enabled() ) {
			add_action( 'init', array( $this, 'generatepress_setup_header' ), 10 );
			add_action( 'generate_header', 'hfe_render_header' );
		}

		if ( hfe_footer_enabled() ) {
			add_action( 'init', array( $this, 'generatepress_setup_footer' ), 10 );
			add_action( 'generate_footer', 'hfe_render_footer' );
		}

	}

	/**
	 * Disable header from the theme.
	 */
	public function generatepress_setup_header() {
		remove_action( 'generate_header', 'generate_construct_header' );
	}

	/**
	 * Disable footer from the theme.
	 */
	public function generatepress_setup_footer() {
		remove_action( 'generate_footer', 'generate_construct_footer_widgets', 5 );
		remove_action( 'generate_footer', 'generate_construct_footer' );
	}

}

HFE_GeneratePress_Compat::instance();
