<?php
/**
 * HFE_Elementor_Canvas_Compat setup
 *
 * @package header-footer-elementor
 */

/**
 * Astra theme compatibility.
 */
class HFE_Elementor_Canvas_Compat {

	/**
	 * Instance of HFE_Elementor_Canvas_Compat.
	 *
	 * @var HFE_Elementor_Canvas_Compat
	 */
	private static $instance;

	/**
	 *  Initiator
	 */
	public static function instance() {

		if ( ! isset( self::$instance ) ) {
			self::$instance = new HFE_Elementor_Canvas_Compat();

			self::$instance->hooks();
		}

		return self::$instance;
	}

	/**
	 * Run all the Actions / Filters.
	 */
	public function hooks() {

		if ( hfe_header_enabled() ) {
			add_action( 'wp_head', array( $this, 'render_header' ) );
		}

		if ( hfe_footer_enabled() ) {
			add_action( 'wp_footer', array( $this, 'render_footer' ) );
		}

	}

	/**
	 * Render the header if display template on elementor canvas is enabled
	 * and current template is Elementor Canvas
	 */
	public function render_header() {

		// bail if current page template is not Elemenntor Canvas.
		if ( 'elementor_canvas' !== get_page_template_slug() ) {
			return;
		}

		$override_cannvas_template = get_post_meta( get_hfe_header_id(), 'display-on-canvas-template', true );

		if ( '1' == $override_cannvas_template ) {
			hfe_render_header();
		}
	}

	/**
	 * Render the footer if display template on elementor canvas is enabled
	 * and current template is Elementor Canvas
	 */
	public function render_footer() {

		// bail if current page template is not Elemenntor Canvas.
		if ( 'elementor_canvas' !== get_page_template_slug() ) {
			return;
		}

		$override_cannvas_template = get_post_meta( get_hfe_footer_id(), 'display-on-canvas-template', true );

		if ( '1' == $override_cannvas_template ) {
			hfe_render_footer();
		}
	}

}

HFE_Elementor_Canvas_Compat::instance();
