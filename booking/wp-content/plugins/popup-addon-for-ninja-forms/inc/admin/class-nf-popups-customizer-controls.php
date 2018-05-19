<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class NF_Popups_Customizer_Controls {

	private function __construct() {}

	public static function add_controls(  ) {
		global $wp_customize;
		$popup_id = get_option( 'nf_popup_id_customizer' );
		$open_animations = array(
			'none'   => __( 'None', 'nf-popup' ),
			'fadeIn' => __( 'Fade In', 'nf-popup' ),
			'bounce' => __( 'Bounce', 'nf-popup' ),
			'flash'  => __( 'Flash', 'nf-popup' ),
		);

		$open_animations_list = apply_filters( 'nf_popups_open_animation_list', $open_animations );

		// $close_animations_list = array(
		//  'none'    => __( 'None', 'nf-popup' ),
		//  'fadeOut' => __( 'Fade Out', 'nf-popup' ),
		//  'bounce'  => __( 'Bounce', 'nf-popup' ),
		//  'flash'   => __( 'Flash', 'nf-popup' ),

		// );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nf_popups_overlay_color_control', array(
					'label'     => __( 'Overlay Color', 'nf-popup' ),
					'priority'  => 30,
					'section'   => 'nf_popups_overlay_settings',
					'settings'  => 'nf_popups[' . $popup_id . '][overlay_color]',
				) ) );
		$wp_customize->add_control( 'nf_popups_overlay_opacity_control', array(
				'type'        => 'range',
				'priority'    => 90,
				'section'     => 'nf_popups_overlay_settings',
				'label'       => __( 'Overlay Opacity', 'nf-popup' ),
				'settings'    => 'nf_popups[' . $popup_id . '][overlay_opacity]',
				'input_attrs' => array(
					'min'   => 0,
					'max'   => 100,
					'step'  => 10,
				),
			) );

		$wp_customize->add_control( 'nf_popups_container_padding_control', array(
				'type'        => 'range',
				'priority'    => 90,
				'section'     => 'nf_popups_container_settings',
				'label'       => __( 'Padding', 'nf-popup' ),
				'settings'    => 'nf_popups[' . $popup_id . '][container_padding]',
				'input_attrs' => array(
					'min'   => 0,
					'max'   => 100,
					'step'  => 1,
				),
			) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nf_popups_container_background_color_control', array(
					'label'     => __( 'Background Color', 'nf-popup' ),
					'priority'  => 30,
					'section'   => 'nf_popups_container_settings',
					'settings'  => 'nf_popups[' . $popup_id . '][container_background_color]',
				) ) );
		$wp_customize->add_control( 'nf_popups_container_width_control', array(
				'type'        => 'text',
				'priority'    => 90,
				'section'     => 'nf_popups_container_settings',
				'label'       => __( 'Width', 'nf-popup' ),
				'description' => 'Width in px or percentage, e.g 200px, 80% or auto',
				'input_attrs' => array(
					'placeholder' =>'auto',
				),
				'settings'    => 'nf_popups[' . $popup_id . '][container_width]',
			) );
		$wp_customize->add_control( 'nf_popups_container_height_control', array(
				'type'        => 'text',
				'priority'    => 90,
				'description' => 'Height in px or percentage, e.g 200px, 80% or auto',
				'input_attrs' => array(
					'placeholder' =>'auto',
				),
				'section'     => 'nf_popups_container_settings',
				'label'       => __( 'Height', 'nf-popup' ),
				'settings'    => 'nf_popups[' . $popup_id . '][container_height]',
			) );
		$wp_customize->add_control( 'nf_popups_container_width_mobile_control', array(
				'type'        => 'text',
				'priority'    => 90,
				'section'     => 'nf_popups_container_settings',
				'label'       => __( 'Mobile Width', 'nf-popup' ),
				'description' => 'Width in px or percentage, e.g 200px, 80% or auto',
				'input_attrs' => array(
					'placeholder' =>'auto',
				),
				'settings'    => 'nf_popups[' . $popup_id . '][container_width_mobile]',
			) );
		$wp_customize->add_control( 'nf_popups_container_height_mobile_control', array(
				'type'        => 'text',
				'priority'    => 90,
				'description' => 'Height in px or percentage, e.g 200px, 80% or auto',
				'input_attrs' => array(
					'placeholder' =>'auto',
				),
				'section'     => 'nf_popups_container_settings',
				'label'       => __( 'Mobile Height', 'nf-popup' ),
				'settings'    => 'nf_popups[' . $popup_id . '][container_height_mobile]',
			) );
		$wp_customize->add_control( 'nf_popups_container_border_radius_control', array(
				'type'        => 'range',
				'priority'    => 90,
				'section'     => 'nf_popups_container_settings',
				'label'       => __( 'Rounded Corners', 'nf-popup' ),
				'settings'    => 'nf_popups[' . $popup_id . '][container_border_radius]',
				'input_attrs' => array(
					'min'   => 0,
					'max'   => 100,
					'step'  => 1,
				),
			) );

		$wp_customize->add_control( 'nf_popups_container_border_thickness_control', array(
				'type'        => 'range',
				'priority'    => 90,
				'section'     => 'nf_popups_container_settings',
				'label'       => __( 'Border Thickness', 'nf-popup' ),
				'settings'    => 'nf_popups[' . $popup_id . '][container_border_thickness]',
				'input_attrs' => array(
					'min'   => 0,
					'max'   => 100,
					'step'  => 1,
				),
			) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nf_popups_container_border_color_control', array(
					'label'     => __( 'Border Color', 'nf-popup' ),
					'priority'  => 90,
					'section'   => 'nf_popups_container_settings',
					'settings'  => 'nf_popups[' . $popup_id . '][container_border_color]',
				) ) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nf_popups_container_border_style_control', array(
					'label'    => __( 'Border Style', 'nf-popup' ),
					'priority' => 90,
					'section'  => 'nf_popups_container_settings',
					'settings' => 'nf_popups[' . $popup_id . '][container_border_style]',
					'type'     => 'select',
					'choices' =>array(
						'none'    => __( 'None', 'nf-popup' ),
						'solid'   => __( 'Solid', 'nf-popup' ),
						'dotted'  => __( 'Dotted', 'nf-popup' ),
						'dashed'  => __( 'Dashed', 'nf-popup' ),
						'doubled' => __( 'Doubled', 'nf-popup' ),
						'groove'  => __( 'Groove', 'nf-popup' ),
						'inset'   => __( 'Inset', 'nf-popup' ),
						'outset'  => __( 'Outset', 'nf-popup' ),
						'ridge'   => __( 'Ridge', 'nf-popup' ),
					),
                ) ) );
                
                if( ! defined('NF_POPUPS_ANIMATIONS_VERSION') ){
                    $animate_description = 'Want more animations ? Try <a href="https://ninjapopup.org/extensions" target="_blank">animations addon</a>';
                }else{
                    $animate_description = '';
                }

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nf_popups_open_animation_control', array(
					'label'     => __( 'Display Animation', 'nf-popup' ),
                    'priority'  => 90,
                    'description' => $animate_description,
					'section'   => 'nf_popups_animation_settings',
					'settings'  => 'nf_popups[' . $popup_id . '][open_animation]',
					'type'      => 'select',
					'choices'   => $open_animations_list
				) ) );
		// $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'nf_popups_close_animation_control', array(
		//    'label'     => __( 'Close Animation', 'nf-popup' ),
		//    'priority'  => 90,
		//    'section'   => 'nf_popups_animation_settings',
		//    'settings'  => 'nf_popups[' . $popup_id . '][close_animation]',
		//    'type'      => 'select',
		//    'choices'   => $close_animations_list
		//   ) ) );
		$wp_customize->add_control( 'nf_popups_close_btn_top_margin_control', array(
				'type'        => 'text',
				'priority'    => 90,
				'description' => 'Top Margin in px or percentage, e.g 20px, 80%',
				'input_attrs' => array(
					'placeholder' =>'0px',
				),
				'section'     => 'nf_popups_close_btn_settings',
				'label'       => __( 'Top Margin', 'nf-popup' ),
				'settings'    => 'nf_popups[' . $popup_id . '][close_btn_top_margin]',
			) );
		$wp_customize->add_control( 'nf_popups_close_btn_right_margin_control', array(
				'type'        => 'text',
				'priority'    => 90,
				'description' => 'Right Margin in px or percentage, e.g 20px, 80%',
				'input_attrs' => array(
					'placeholder' =>'0px',
				),
				'section'     => 'nf_popups_close_btn_settings',
				'label'       => __( 'Right Margin', 'nf-popup' ),
				'settings'    => 'nf_popups[' . $popup_id . '][close_btn_right_margin]',
			) );


	}
}
