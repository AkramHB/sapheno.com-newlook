<?php 

/*
Create the Contact style post type and custom taxonomy
CPT: cf7_style
Taxonomy: style_category
*/

if ( !defined( 'ABSPATH' ) ) {
 exit;
}

function get_predefined_cf7_style_template_data() {
	$request_json = wp_remote_get( WPCF7S_LOCATION.'admin/predefined-templates.json' );

	if ( is_wp_error( $request_json ) || ( array_key_exists('response', $request_json ) && $request_json['response']['code'] != '200' ) ) {
		require WPCF7S_PLUGIN_DIR.'/admin/predefined_tpls.php';
		$templates = json_decode( $tpl_string, true );
	    return $templates;
	}
	$templates = json_decode( wp_remote_retrieve_body( $request_json ), true );
	return $templates;
}// end of get_predefined_cf7_style_template_data

function cf7_style_set_style_category_on_publish(  $ID, $post ) {
	$temporizator = 0;
	$tpl_data = get_predefined_cf7_style_template_data();
	if( $tpl_data ){
		foreach ( $tpl_data as $predefined_post_titles ) {
			if( $post->post_title == $predefined_post_titles[ "title" ] ){
				$temporizator++;
			}	
		}
	}
	if( 0 == $temporizator ) {
		wp_set_object_terms( $ID, 'custom style', 'style_category' );
	}
} // end cf7_style_set_style_category_on_publish

function cf7_style_create_post( $slug, $title, $image) {
	// Initialize the page ID to -1. This indicates no action has been taken.
	$post_id = -1;
	$was_deleted = get_option('cf7_style_deleted'); 
	if( null == get_page_by_title( $title, "OBJECT", "cf7_style" ) && $was_deleted != "yes" ) {
	// Set the post ID so that we know the post was created successfully
		$post_id = wp_insert_post(
			array(
				'comment_status' => 'closed',
				'ping_status' => 'closed',
				'post_name' => $slug,
				'post_title' => $title,
				'post_status' => 'publish',
				'post_type' => 'cf7_style'
			)
		);
		//if is_wp_error doesn't trigger, then we add the image
		if ( is_wp_error( $post_id ) ) {
			$errors = $post_id->get_error_messages();
			foreach ($errors as $error) {
				echo $error . '<br>'; 
			}
		} else {
			//wp_set_object_terms( $post_id, $category, 'style_category', false );
			update_post_meta( $post_id, 'cf7_style_image_preview', $image );
		}
	// Otherwise, we'll stop
	} else {
	// Arbitrarily use -2 to indicate that the page with the title already exists
		$post_id = -2;
	} // end if
} // end cf7_style_create_post

function cf7style_load_elements(){

	$labels = array(
			'name'                	=> _x( 'Contact Styles', 'Post Type General Name', 'contact-form-7-style' ),
			'singular_name'       	=> _x( 'Contact Style', 'Post Type Singular Name', 'contact-form-7-style' ),
			'menu_name'           	=> __( 'Contact Style', 'contact-form-7-style' ),
			'parent_item_colon'   	=> __( 'Parent Style:', 'contact-form-7-style' ),
			'all_items'           	=> __( 'All Styles', 'contact-form-7-style' ),
			'view_item'           	=> __( 'View Style', 'contact-form-7-style' ),
			'add_new_item'        	=> __( 'Add New', 'contact-form-7-style' ),
			'add_new'             	=> __( 'Add New', 'contact-form-7-style' ),
			'edit_item'           	=> __( 'Edit Style', 'contact-form-7-style' ),
			'update_item'         	=> __( 'Update Style', 'contact-form-7-style' ),
			'search_items'        	=> __( 'Search Style', 'contact-form-7-style' ),
			'not_found'           	=> __( 'Not found', 'contact-form-7-style' ),
			'not_found_in_trash'  	=> __( 'Not found in Trash', 'contact-form-7-style' )
		);
	$args = array(
		'label'               		=> __( 'cf7_style', 'contact-form-7-style' ),
		'description'         		=> __( 'Add/remove contact style', 'contact-form-7-style' ),
		'labels'              		=> $labels,
		'supports'            		=> array( 'title' ),
		'hierarchical'        		=> false,
		'taxonomies' 				=> array('style_category'), 
		'public'              		=> true,
		'show_ui'             		=> true,
		'show_in_menu'        		=> true,
		'show_in_nav_menus'   		=> false,
		'show_in_admin_bar'   		=> false,
		'menu_icon'					=> "dashicons-twitter",
		'menu_position'       		=> 28.555555,
		'can_export'          		=> true,
		'has_archive'         		=> false,
		'exclude_from_search' 		=> true,								
		'publicly_queryable'  		=> false,
		'capability_type'     		=> 'page'
	);
	/*register custom post type CF7_STYLE*/
	register_post_type( 'cf7_style', $args );

	$labels = array(
		'name'                       		=> _x( 'Categories', 'Taxonomy General Name', 'contact-form-7-style' ),
		'singular_name'              		=> _x( 'Categories', 'Taxonomy Singular Name', 'contact-form-7-style' ),
		'menu_name'                  		=> __( 'Categories', 'contact-form-7-style' ),
		'all_items'                  		=> __( 'All Categories', 'contact-form-7-style' ),
		'parent_item'                		=> __( 'Parent Categories', 'contact-form-7-style' ),
		'parent_item_colon'    				=> __( 'Parent Categories:', 'contact-form-7-style' ),
		'new_item_name'        				=> __( 'New Categories Name', 'contact-form-7-style' ),
		'add_new_item'               		=> __( 'Add New Categories', 'contact-form-7-style' ),
		'edit_item'                  		=> __( 'Edit Categories', 'contact-form-7-style' ),
		'update_item'                		=> __( 'Update Categories', 'contact-form-7-style' ),
		'separate_items_with_commas' 		=> __( 'Separate Categories with commas', 'contact-form-7-style' ),
		'search_items'               		=> __( 'Search Categories', 'contact-form-7-style' ),
		'add_or_remove_items'        		=> __( 'Add or remove Categories', 'contact-form-7-style' ),
		'choose_from_most_used'     		=> __( 'Choose from the most used Categories', 'contact-form-7-style' ),
		'not_found'                  		=> __( 'Not Found', 'contact-form-7-style' ),
	);
	$args = array(
		'labels'                => $labels,
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => false,
		'show_admin_column' 	=> true,
		'show_in_nav_menus' 	=> false,
		'show_tagcloud'         => true,
	);
	//register tax
	register_taxonomy( 'style_category', array( 'cf7_style' ), $args );
	$tpl_data = get_predefined_cf7_style_template_data();
	if( $tpl_data ){
		foreach ( $tpl_data as $style ) {
			cf7_style_create_post( strtolower( str_replace( " ", "-", $style['title'] ) ), $style['title'], $style['image'] );
		}
		if( get_option( 'cf7_style_add_categories', 0 ) == 0 ){
			$cf7_style_args = array(
				'post_type' => 'cf7_style',
				'posts_per_page' => '-1'
			);
			
			$cf7_style_query = new WP_Query( $cf7_style_args );
			if ( $cf7_style_query->have_posts() ) {
				while ( $cf7_style_query->have_posts() ) {
					$cf7_style_query->the_post();
					$temp_title = get_the_title();
					$temp_ID = get_the_ID();

					foreach ( $tpl_data as $style ) {
						if( $temp_title == wptexturize( $style[ 'title' ] ) ) {
							wp_set_object_terms( $temp_ID, $style[ 'category' ], 'style_category' );
						}
					}
				}
				wp_reset_postdata();
				update_option( 'cf7_style_add_categories', 1 );
			}
		}
	}
	$cf7_style_update_saved = get_option( 'cf7_style_update_saved' );
	if( $cf7_style_update_saved == "yes" ) {
			$cf7_style_args = array(
				'post_type' 		=> 'cf7_style',
				'style_category' 	=> 'custom-style',
				'posts_per_page' 	=> '-1'
			);
			$cf7s_manual_old_style = "";
			$new_settings = array();
			$cf7_style_query = new WP_Query( $cf7_style_args );
			if ( $cf7_style_query->have_posts() ) {
				while ( $cf7_style_query->have_posts() ) {
					$cf7_style_query->the_post();
					$cur_style_id 		= get_the_ID();
					$cur_manual_style 	= get_post_meta( $cur_style_id, 'cf7_style_manual_style', true );
					$cur_custom_styles 	= maybe_unserialize( get_post_meta( $cur_style_id, 'cf7_style_custom_styles', true ));
					if($cur_manual_style){
						$cf7s_manual_old_style .= $cur_manual_style;
						update_post_meta( $cur_style_id, 'cf7_style_manual_style', '' );
					}
					if($cur_custom_styles){
						$cf7s_custom_old_settings = $cur_custom_styles;
						require_once( WPCF7S_PLUGIN_DIR.'/cf7-style-match-old.php' );
						$new_settings = get_new_styler_data( $cf7s_custom_old_settings );
						update_post_meta( $cur_style_id, 'cf7_style_manual_styles', '');
						update_post_meta( $cur_style_id, 'cf7_style_custom_styles', '');
						update_post_meta( $cur_style_id, 'cf7_style_custom_styler', $new_settings, "");
					}
				}
				wp_reset_postdata();
				if($cf7s_manual_old_style){
					update_option( 'cf7_style_manual_style', $cf7s_manual_old_style );
				}
			}
			update_option( 'cf7_style_update_saved', 'no' );
	}
	require_once( WPCF7S_PLUGIN_DIR.'/cf7-style-meta-box.php' );
	if ( ! is_admin() ) {
		add_action('wp_head', 'cf7_style_custom_css_generator');  
	}
}

add_action( 'init', 'cf7style_load_elements' );
add_action( 'publish_cf7_style', 'cf7_style_set_style_category_on_publish', 10, 2 );