<?php

class NF_Popups_Posttype {
	function __construct() {
		add_action( 'init', array( $this, 'create_posttype' ) );
	}

	function create_posttype() {

		$labels = array(
			'name'               => _x( 'NF Popups', 'post type general name', 'nf-popups' ),
			'singular_name'      => _x( 'NF Popup', 'post type singular name', 'nf-popups' ),
			'menu_name'          => _x( 'NF Popups', 'admin menu', 'nf-popups' ),
			'name_admin_bar'     => _x( 'NF Popup', 'add new on admin bar', 'nf-popups' ),
			'add_new'            => _x( 'Add New', 'book', 'nf-popups' ),
			'add_new_item'       => __( 'Add New NF Popup', 'nf-popups' ),
			'new_item'           => __( 'New NF Popup', 'nf-popups' ),
			'edit_item'          => __( 'Edit NF Popup', 'nf-popups' ),
			'view_item'          => __( 'View NF Popup', 'nf-popups' ),
			'all_items'          => __( 'NF Popups', 'nf-popups' ),
			'search_items'       => __( 'Search NF Popups', 'nf-popups' ),
			'parent_item_colon'  => __( 'Parent NF Popups:', 'nf-popups' ),
			'not_found'          => __( 'No popups found.', 'nf-popups' ),
			'not_found_in_trash' => __( 'No popups found in Trash.', 'nf-popups' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'nf-popups' ),
			'public'             => false,
			'exclude_from_search'=> true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'nf-popups' ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'menu_icon'		 => 'dashicons-format-gallery',
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'false' )
		);

		register_post_type( 'nf-popups', $args );
	}

}

new NF_Popups_Posttype();
