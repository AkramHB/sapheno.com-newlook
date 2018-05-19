<?php 

/**
 * Add cf7skins classes to the CF7 HTML form class
 * 
 * Based on selected template & style
 * eg. class="wpcf7-form cf7t-fieldset cf7s-wild-west"
 * 
 * @uses 'wpcf7_form_class_attr' filter in WPCF7_ContactForm->form_html()
 * @uses wpcf7_get_current_contact_form()
 * @file wp-content\plugins\contact-form-7\includes\contact-form.php
 * 
 * @param $class is the CF7 HTML form class
 * @since 0.0.1
 */		

if ( !defined( 'ABSPATH' ) ) {
 exit;
}

function form_class_attr( $class, $id ) {

	// Get the current CF7 form ID
	$cf7 = wpcf7_get_current_contact_form();  // Current contact form 7 object
	$form_id = get_form_id( $cf7 );
	$template_class ='';
	$cf7_style_id = get_post_meta( $form_id, 'cf7_style_id' );
	if ( isset( $cf7_style_id[0] ) ) {
		$cf7_style_data = get_post( $cf7_style_id[0], OBJECT );
		$template_class = ( has_term( 'custom-style', 'style_category', $cf7_style_data ) ) ? 
			"cf7-style-" . $cf7_style_id[0] :  $cf7_style_data->post_name;
	}	

	// Return the modified class
	return $template_class;
}

function cf7_style_add_class( $class ){
	global $post;
	$class.= " cf7-style ".form_class_attr( $post, "no" );
	return $class;
}// end of cf7_style_add_class

add_filter( 'wpcf7_form_class_attr', 'cf7_style_add_class' );