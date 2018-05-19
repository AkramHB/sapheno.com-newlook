<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class NF_Popups_Customizer_Sections {

	private function __construct() {}

	public static function add_sections() {
		global $wp_customize;

		$wp_customize->add_section( 'nf_popups_overlay_settings', array (
				'title'      => __( 'Popup Overlay Settings', 'nf-popup' ),
				'capability' => 'edit_theme_options',
				'priority'   => 10,
			) );

		$wp_customize->add_section( 'nf_popups_container_settings', array (
				'title'      => __( 'Popup Container Settings', 'nf-popup' ),
				'capability' => 'edit_theme_options',
				'priority'   => 30,
            ) );
            
		$wp_customize->add_section( 'nf_popups_animation_settings', array (
				'title'      => __( 'Popup Animation Settings', 'nf-popup' ),
				'capability' => 'edit_theme_options',
				'priority'   => 30,
			) );

		$wp_customize->add_section( 'nf_popups_close_btn_settings', array (
				'title'      => __( 'Popup Close Button Settings', 'nf-popup' ),
				'capability' => 'edit_theme_options',
				'priority'   => 30,
			) );

	}
}
