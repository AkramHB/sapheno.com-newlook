<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_Eael_Ninja_Forms_Stand_Alone extends Widget_Base {

	public function get_name() {
		return 'eael-ninja-forms';
	}

	public function get_title() {
		return esc_html__( 'EA Ninja Forms', 'elementor-ninja-forms' );
	}

	public function get_icon() {
		return 'fa fa-envelope-o';
	}

   public function get_categories() {
		return [ 'elementor-ninja-forms' ];
	}

	protected function _register_controls() {


  		$this->start_controls_section(
  			'eael_section_ninja_form',
  			[
  				'label' => esc_html__( 'NInja Forms', 'elementor-ninja-forms' )
  			]
  		);

		$this->add_control(
			'eael_ninja_form',
			[
				'label' => esc_html__( 'Select your ninja form', 'elementor-ninja-forms' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => eael_select_ninja_form_stand_alone(),
			]
		);


		$this->end_controls_section();


        $this->start_controls_section(
			'eael_section_pro',
			[
				'label' => __( 'Go Premium for More Features', 'elementor-ninja-forms' )
			]
		);

        $this->add_control(
            'eael_control_get_pro',
            [
                'label' => __( 'Unlock more possibilities', 'elementor-ninja-forms' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
					'1' => [
						'title' => __( '', 'elementor-ninja-forms' ),
						'icon' => 'fa fa-unlock-alt',
					],
				],
				'default' => '1',
                'description' => '<span class="pro-feature"> Get the  <a href="https://essential-addons.com/elementor/buy.php" target="_blank">Pro version</a> for more stunning elements and customization options.</span>'
            ]
        );

		$this->end_controls_section();


		$this->start_controls_section(
			'eael_section_contact_form_styles',
			[
				'label' => esc_html__( 'Form Container Styles', 'elementor-ninja-forms' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'eael_contact_form_background',
			[
				'label' => esc_html__( 'Form Background Color', 'elementor-ninja-forms' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form-container' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'eael_contact_form_alignment',
			[
				'label' => esc_html__( 'Form Alignment', 'elementor-ninja-forms' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'default' => [
						'title' => __( 'Default', 'elementor-ninja-forms' ),
						'icon' => 'fa fa-ban',
					],
					'left' => [
						'title' => esc_html__( 'Left', 'elementor-ninja-forms' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor-ninja-forms' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementor-ninja-forms' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'default',
				'prefix_class' => 'eael-contact-form-align-',
			]
		);

  		$this->add_responsive_control(
  			'eael_contact_form_width',
  			[
  				'label' => esc_html__( 'Form Width', 'elementor-ninja-forms' ),
  				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1500,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form-container' => 'width: {{SIZE}}{{UNIT}};',
				],
  			]
  		);

  		$this->add_responsive_control(
  			'eael_contact_form_max_width',
  			[
  				'label' => esc_html__( 'Form Max Width', 'elementor-ninja-forms' ),
  				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1500,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form-container' => 'max-width: {{SIZE}}{{UNIT}};',
				],
  			]
  		);


		$this->add_responsive_control(
			'eael_contact_form_margin',
			[
				'label' => esc_html__( 'Form Margin', 'elementor-ninja-forms' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'eael_contact_form_padding',
			[
				'label' => esc_html__( 'Form Padding', 'elementor-ninja-forms' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'eael_contact_form_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementor-ninja-forms' ),
				'type' => Controls_Manager::DIMENSIONS,
				'separator' => 'before',
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'eael_contact_form_border',
				'selector' => '{{WRAPPER}} .eael-contact-form-container',
			]
		);


		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'eael_contact_form_box_shadow',
				'selector' => '{{WRAPPER}} .eael-contact-form-container',
			]
		);

		$this->end_controls_section();



		$this->start_controls_section(
			'eael_section_contact_form_field_styles',
			[
				'label' => esc_html__( 'Form Fields Styles', 'elementor-ninja-forms' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'eael_contact_form_input_background',
			[
				'label' => esc_html__( 'Input Field Background', 'elementor-ninja-forms' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form-container input.ninja-text, {{WRAPPER}} .eael-contact-form-container textarea.ninja-textarea' => 'background: {{VALUE}};',
				],
			]
		);


  		$this->add_responsive_control(
  			'eael_contact_form_input_width',
  			[
  				'label' => esc_html__( 'Input Width', 'elementor-ninja-forms' ),
  				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1500,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form-container input.ninja-text' => 'width: {{SIZE}}{{UNIT}};',
				],
  			]
  		);

  		$this->add_responsive_control(
  			'eael_contact_form_textarea_width',
  			[
  				'label' => esc_html__( 'Textarea Width', 'elementor-ninja-forms' ),
  				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1500,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form-container textarea.ninja-textarea' => 'width: {{SIZE}}{{UNIT}};',
				],
  			]
  		);

		$this->add_responsive_control(
			'eael_contact_form_input_padding',
			[
				'label' => esc_html__( 'Fields Padding', 'elementor-ninja-forms' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form-container input.ninja-text, {{WRAPPER}} .eael-contact-form-container textarea.ninja-textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);



		$this->add_control(
			'eael_contact_form_input_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementor-ninja-forms' ),
				'type' => Controls_Manager::DIMENSIONS,
				'separator' => 'before',
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form-container input.ninja-text, {{WRAPPER}} .eael-contact-form-container textarea.ninja-textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'eael_contact_form_input_border',
				'selector' => '{{WRAPPER}} .eael-contact-form-container input.ninja-text, {{WRAPPER}} .eael-contact-form-container textarea.ninja-textarea',
			]
		);


		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'eael_contact_form_input_box_shadow',
				'selector' => '{{WRAPPER}} .eael-contact-form-container input.ninja-text, {{WRAPPER}} .eael-contact-form-container textarea.ninja-textarea',
			]
		);

		$this->add_control(
			'eael_contact_form_focus_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Focus State Style', 'elementor-ninja-forms' ),
				'separator' => 'before',
			]
		);


		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'eael_contact_form_input_focus_box_shadow',
				'selector' => '{{WRAPPER}} .eael-contact-form-container input.ninja-text:focus, {{WRAPPER}} .eael-contact-form-container textarea.ninja-textarea:focus',
			]
		);

		$this->add_control(
			'eael_contact_form_input_focus_border',
			[
				'label' => esc_html__( 'Border Color', 'elementor-ninja-forms' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'body {{WRAPPER}} .eael-contact-form-container input.ninja-text:focus, body {{WRAPPER}} .eael-contact-form-container textarea.ninja-textarea:focus' => 'border-color: {{VALUE}};',
				],
			]
		);



		$this->end_controls_section();


		$this->start_controls_section(
			'eael_section_contact_form_typography',
			[
				'label' => esc_html__( 'Color & Typography', 'elementor-ninja-forms' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);


		$this->add_control(
			'eael_contact_form_label_color',
			[
				'label' => esc_html__( 'Label Color', 'elementor-ninja-forms' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form-container, {{WRAPPER}} .eael-contact-form-container .ninja-form label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'eael_contact_form_field_color',
			[
				'label' => esc_html__( 'Field Font Color', 'elementor-ninja-forms' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form-container input.ninja-text, {{WRAPPER}} .eael-contact-form-container textarea.ninja-textarea' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'eael_contact_form_placeholder_color',
			[
				'label' => esc_html__( 'Placeholder Font Color', 'elementor-ninja-forms' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form-container ::-webkit-input-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .eael-contact-form-container ::-moz-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} .eael-contact-form-container ::-ms-input-placeholder' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'eael_contact_form_label_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Label Typography', 'elementor-ninja-forms' ),
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'eael_contact_form_label_typography',
				'selector' => '{{WRAPPER}} .eael-contact-form-container, {{WRAPPER}} .eael-contact-form-container .ninja-form label',
			]
		);


		$this->add_control(
			'eael_contact_form_heading_input_field',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Input Fields Typography', 'elementor-ninja-forms' ),
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'eael_contact_form_input_field_typography',
				'selector' => '{{WRAPPER}} .eael-contact-form-container input.ninja-text, {{WRAPPER}} .eael-contact-form-container textarea.ninja-textarea',
			]
		);

		$this->end_controls_section();



		$this->start_controls_section(
			'eael_section_contact_form_submit_button_styles',
			[
				'label' => esc_html__( 'Submit Button Styles', 'elementor-ninja-forms' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

  		$this->add_responsive_control(
  			'eael_contact_form_submit_btn_width',
  			[
  				'label' => esc_html__( 'Button Width', 'elementor-ninja-forms' ),
  				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 1500,
					],
					'em' => [
						'min' => 1,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form-container input.ninja-submit' => 'width: {{SIZE}}{{UNIT}};',
				],
  			]
  		);

		$this->add_responsive_control(
			'eael_contact_form_submit_btn_alignment',
			[
				'label' => esc_html__( 'Button Alignment', 'elementor-ninja-forms' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'default' => [
						'title' => __( 'Default', 'elementor-ninja-forms' ),
						'icon' => 'fa fa-ban',
					],
					'left' => [
						'title' => esc_html__( 'Left', 'elementor-ninja-forms' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor-ninja-forms' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementor-ninja-forms' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'default',
				'prefix_class' => 'eael-contact-form-btn-align-',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'eael_contact_form_submit_btn_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .eael-contact-form-container input.ninja-submit',
			]
		);

		$this->add_responsive_control(
			'eael_contact_form_submit_btn_margin',
			[
				'label' => esc_html__( 'Margin', 'elementor-ninja-forms' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form-container input.ninja-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'eael_contact_form_submit_btn_padding',
			[
				'label' => esc_html__( 'Padding', 'elementor-ninja-forms' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form-container input.ninja-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);



		$this->start_controls_tabs( 'eael_contact_form_submit_button_tabs' );

		$this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', 'elementor-ninja-forms' ) ] );

		$this->add_control(
			'eael_contact_form_submit_btn_text_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor-ninja-forms' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form-container input.ninja-submit' => 'color: {{VALUE}};',
				],
			]
		);



		$this->add_control(
			'eael_contact_form_submit_btn_background_color',
			[
				'label' => esc_html__( 'Background Color', 'elementor-ninja-forms' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form-container input.ninja-submit' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'eael_contact_form_submit_btn_border',
				'selector' => '{{WRAPPER}} .eael-contact-form-container input.ninja-submit',
			]
		);

		$this->add_control(
			'eael_contact_form_submit_btn_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementor-ninja-forms' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form-container input.ninja-submit' => 'border-radius: {{SIZE}}px;',
				],
			]
		);



		$this->end_controls_tab();

		$this->start_controls_tab( 'eael_contact_form_submit_btn_hover', [ 'label' => esc_html__( 'Hover', 'elementor-ninja-forms' ) ] );

		$this->add_control(
			'eael_contact_form_submit_btn_hover_text_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor-ninja-forms' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form-container input.ninja-submit:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'eael_contact_form_submit_btn_hover_background_color',
			[
				'label' => esc_html__( 'Background Color', 'elementor-ninja-forms' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form-container input.ninja-submit:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'eael_contact_form_submit_btn_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'elementor-ninja-forms' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eael-contact-form-container input.ninja-submit:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'eael_contact_form_submit_btn_box_shadow',
				'selector' => '{{WRAPPER}} .eael-contact-form-container input.ninja-submit',
			]
		);


		$this->end_controls_section();


	}


	protected function render( ) {

      $settings = $this->get_settings();


	?>


	<?php if ( ! empty( $settings['eael_ninja_form'] ) ) : ?>
		<div class="eael-contact-form-container">
			<?php echo do_shortcode( '[contact-form-7 id="' . $settings['eael_ninja_form'] . '" ]' ); ?>
		</div>
	<?php endif; ?>

	<?php

	}

	protected function content_template() {''

		?>


		<?php
	}
}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_Eael_Ninja_Forms_Stand_Alone() );