<?php 

if ( !defined( 'ABSPATH' ) ) {
 exit;
}

function cf7_style_remove_templates() {
	global $wpdb;
	update_option( 'cf7_style_deleted', 'yes' );
	update_option( 'cf7_style_add_categories', 0 );
	$del_args = array(
		'posts_per_page' => -1,
		'post_type' => 'cf7_style',
		'tax_query' => array(
			array(
				'taxonomy' => 'style_category',
				'field'    => 'slug',
				'terms'    => 'custom-style',
				'operator' => 'NOT IN',
			),
		),
	);
	$del_query = new WP_Query( $del_args );
	if ( $del_query->have_posts() ) {
		while ( $del_query->have_posts() ) {
			$del_query->the_post();
			$style_id = get_the_ID();
			$clr_form_args = array(
				'post_type' => 'wpcf7_contact_form',
				'posts_per_page' => -1,
				'meta_key' => 'cf7_style_id',
				'meta_value' => $style_id
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
			wp_delete_post( $style_id,false);
		}
		wp_reset_postdata();
		print_r('success');
	}
	wp_die();
}
add_action( 'wp_ajax_cf7_style_remove_templates', 'cf7_style_remove_templates' );