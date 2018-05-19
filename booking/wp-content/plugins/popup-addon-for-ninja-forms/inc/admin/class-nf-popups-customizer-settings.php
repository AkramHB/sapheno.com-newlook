<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class NF_Popups_Customizer_Settings {
	private function __construct() {
	}

	public static function add_settings() {
		$settings = array(
			array( 'name' => 'overlay_color' ),
			array( 'name' => 'overlay_opacity' ),
			array( 'name' => 'container_padding' ),
			array( 'name' => 'container_background_color' ),
			array( 'name' => 'container_width' ),
			array( 'name' => 'container_height' ),
			array( 'name' => 'container_width_mobile', 'postMessage'=>false ),
			array( 'name' => 'container_height_mobile', 'postMessage'=>false ),
			array( 'name' => 'container_border_radius' ),
			array( 'name' => 'container_border_thinkness' ),
			array( 'name' => 'container_border_color' ),
			array( 'name' => 'container_border_style' ),
			array( 'name' => 'open_animation' ),
			//array( 'name' => 'close_animation' ),
			array( 'name' => 'close_btn_top_margin' ),
			array( 'name' => 'close_btn_right_margin' ),
		);

		NF_Popups_Customizer_Settings::add_popup_setting( $settings );
	
	}

	public static function add_popup_setting( $settings ) {
		global $wp_customize;
		$popup_id = get_option( 'nf_popup_id_customizer' );
		foreach ( $settings as $setting ) {
			if ( $setting['postMessage'] != false ) {
				$wp_customize->add_setting( 'nf_popups[' . $popup_id . '][' . $setting['name'] . ']', array(
						'type'      => 'option',
						'transport' => 'postMessage',
					) );
			} else {
				$wp_customize->add_setting( 'nf_popups[' . $popup_id . '][' . $setting['name'] . ']', array(
						'type'      => 'option',
					) );
			}
		}
	}
}
