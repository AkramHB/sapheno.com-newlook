<?php

if ( !defined( 'ABSPATH' ) ) {
 exit;
}

function cf7_style_generate_preview_dashboard() {

	$form_id = sanitize_text_field( $_POST['form_id'] );
	$form_title = sanitize_text_field( $_POST['form_title'] );
	$form = "<div class='multiple-form-generated-preview preview-form-container'><h4>" . $form_title . "</h4>" . do_shortcode( '[contact-form-7 id="'. $form_id .'" title="'. $form_title .'"]' ) . "</div>";
	echo $form;

	wp_die();
}
add_action( 'wp_ajax_cf7_style_generate_preview_dashboard', 'cf7_style_generate_preview_dashboard' );