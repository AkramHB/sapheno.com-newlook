<?php 

if ( !defined( 'ABSPATH' ) ) {
 exit;
}

function cf7_style_frontend_edit_link( $form ) {

	if( is_user_logged_in() && current_user_can( 'manage_options' ) && !is_admin() && get_option( 'cf7_style_form_tooltip' ) == 1 ) {

		$cf7 = wpcf7_get_current_contact_form();  // Current contact form 7 object
		$form_id = get_form_id( $cf7 );
		$cf7_style_id = get_post_meta( $form_id, 'cf7_style_id', true );

		if( empty( $cf7_style_id ) ) {
			$form .= "<a href='" . admin_url( 'edit.php?post_type=cf7_style' ) . "' class='frontend-edit-style-link'>" . __( 'Add Style', 'contact-form-7-style' ) . "</a>";
		} else {
			$cf7_style_data = get_post( $cf7_style_id, OBJECT );
			$template_type  = ( has_term( 'custom-style', 'style_category', $cf7_style_data ) ) ? __( 'Edit custom style', 'contact-form-7-style' ) :  __( 'Edit predifined template', 'contact-form-7-style' );
			$form .= "<a href='" . admin_url( 'post.php?post=' . $cf7_style_id . '&action=edit' ) . "' class='frontend-edit-style-link'>" . $template_type . "</a>";	
		}
	}

	return $form;
}
add_filter( 'wpcf7_form_elements', 'cf7_style_frontend_edit_link' );