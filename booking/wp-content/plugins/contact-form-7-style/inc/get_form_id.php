<?php 

/**
 * Get contact form 7 id
 * 
 * Back compat for CF7 3.9 
 * @see http://contactform7.com/2014/07/02/contact-form-7-39-beta/
 * 
 * @param $cf7 Contact Form 7 object
 * @since 0.1.0
 */	

if ( !defined( 'ABSPATH' ) ) {
 exit;
}

function get_form_id( $cf7 ) {
	if ( version_compare( WPCF7_VERSION, '3.9-alpha', '>' ) ) {
	    if (!is_object($cf7)) {
	        return false;
	    }
	    return $cf7->id();
	}
}