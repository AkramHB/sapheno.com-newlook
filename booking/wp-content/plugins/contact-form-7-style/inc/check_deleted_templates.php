<?php 

if ( !defined( 'ABSPATH' ) ) {
 exit;
}

function cf7style_check_deleted( $postid ){
	global $post_type;   
	if ( $post_type != 'cf7_style' ) return;
	$check_deleted = get_option('cf7_style_deleted');
	$clr_form_args = array(
		'post_type' => 'wpcf7_contact_form',
		'posts_per_page' => -1,
		'meta_key' => 'cf7_style_id',
		'meta_value' => $postid
	);
	$form_query = new WP_Query( $clr_form_args );
	if ( $form_query->have_posts() ) {
		while ( $form_query->have_posts() ) {
			$form_query->the_post();
			/*form id*/
			update_post_meta( get_the_ID(), 'cf7_style_id', '');
		}
		wp_reset_postdata();
	}
	if("yes" != $check_deleted){
		update_option( 'cf7_style_no_temps', 'hide_box' );
		update_option('cf7_style_deleted','yes');
	}
}

add_action( 'before_delete_post', 'cf7style_check_deleted' );