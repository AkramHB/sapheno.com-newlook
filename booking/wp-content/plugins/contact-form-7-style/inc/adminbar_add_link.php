<?php 

if ( !defined( 'ABSPATH' ) ) {
 exit;
}

function cf7style_toolbar_link($wp_admin_bar) {
	$args = array(
		'id' => 'cf7-style',
		'title' => 'Contact Form 7 Style', 
		'href' => admin_url("edit.php?post_type=cf7_style"), 
		'meta' => array(
			'class' => 'contact-style', 
			'title' => 'Contact Form 7 Style',
			'html' => '<span class="admin-style-icon"><i class="dashicons-before dashicons-twitter" aria-hidden="true"></i></span>'
		)
	);
	$wp_admin_bar->add_node($args);
}

add_action('admin_bar_menu', 'cf7style_toolbar_link', 999);