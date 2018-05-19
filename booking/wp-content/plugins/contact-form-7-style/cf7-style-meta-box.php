<?php

if ( !defined( 'ABSPATH' ) ) {
 exit;
}

function active_styles() {

	$args = array( 
		'post_type'=>'wpcf7_contact_form',
		'post_status'=>'publish',
		'posts_per_page'=> -1
	);
	$active_styles = array();
	$forms = new WP_Query( $args );

	if( $forms->have_posts() ) :
		while( $forms->have_posts() ) : $forms->the_post();
			$form_title = get_the_title();
			$id = get_the_ID();
			$style_id = get_post_meta( $id, 'cf7_style_id', true );
			if ( ! empty( $style_id ) || $style_id != 0 ) {
				$active_styles[] = $style_id;
			}
		endwhile;
		wp_reset_postdata();
	endif; 
	return $active_styles;
}


/**
 * Calls the class the meta box. Used for selecting forms for each style.
 */
function cf7_style_meta_form_init() {
    new cf7_style_meta_boxes();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'cf7_style_meta_form_init' );
    add_action( 'load-post-new.php', 'cf7_style_meta_form_init' );
}

function filter_w_zeros($var){
  return ($var !== NULL && $var !== FALSE && $var !== '');
}

/** 
 * The Class for creating all of the meta boxes
 */
class cf7_style_meta_boxes {

	/**
	 * Hook into the appropriate actions when the class is constructed.
	 */
	public function __construct() {
		//selector init
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box_style_selector' ) );
		add_action( 'save_post', array( $this, 'save_style_selector' ) );
		//fonts
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box_font_selector' ) );
		add_action( 'save_post', array( $this, 'save_font_id' ) );
		//image meta box init
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box_style_image' ) );
		//add paypal button
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box_style_paypal' ) );
		//custom style meta box1
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box_style_customizer' ), 10, 2 );
		add_action( 'save_post', array( $this, 'save_style_customizer' ) );
	}

	/**************************************************
	 * Adds the meta box container for style selector.
	 * STYLE SELECTOR STARTS HERE
	 */
	public function add_meta_box_style_selector( $post_type ) {
		$post_types = array('cf7_style');     //limit meta box to certain post types
		if ( in_array( $post_type, $post_types )) {
			add_meta_box(
			'cf7_style_meta_box_form_selector'
			,__( 'Select forms for current style', 'contact-form-7-style' )
			,array( $this, 'render_meta_box_selector' )
			,$post_type
			,'advanced'
			,'high'
			);
		}
	}
	public function add_meta_box_style_customizer( $post_type, $post ) {

		$post_types = array('cf7_style');     //limit meta box to certain post types
		$custom_cat = get_the_terms( $post->ID, "style_category" );
		$custom_name = ( empty( $custom_cat ) ) ? "custom style" : $custom_cat[0]->name;
		if ( in_array( $post_type, $post_types ) && ( $custom_name == "custom style" ) ) {
			add_meta_box(
			'cf7_style_meta_box_style_customizer'
			,__( 'Custom style settings', 'contact-form-7-style' )
			,array( $this, 'render_meta_box_style_customizer' )
			,$post_type
			,'advanced'
			,'high'
			);
		}
	}

	public function render_meta_box_style_customizer( $post ) {
		require_once WPCF7S_PLUGIN_DIR . '/options.php';
	}

	public function save_style_customizer( $post_id ) {

		if ( ! isset( $_POST['cf_7_style_customizer_custom_box_nonce'] ) )
			return $post_id;

		$nonce = sanitize_text_field($_POST['cf_7_style_customizer_custom_box_nonce']);
		

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'cf_7_style_style_customizer_inner_custom_box' ) ) {
			return $post_id;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		if ( 'page' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
				
		}
		
		$posted_data = $_POST['cf7styleallvalues'];
		$posted_data = str_replace("\'", '"', $posted_data);
		$posted_data = json_decode($posted_data, true);

		foreach ( $posted_data as $p_key => $p_value) {
			if( strpos($p_key, '_unit' ) !== false){
				$no_unit = str_replace("_unit","", $p_key );
				if( !array_key_exists($no_unit, $posted_data) || empty( $posted_data[$no_unit]) ){
					unset($posted_data[$p_key]);
				}
			}
		}
		
		ksort($posted_data);

		$active_pane = sanitize_text_field($_POST['cf7styleactivepane']);
		if( isset( $active_pane )){
			update_post_meta( $post_id, 'cf7_style_active_panel', $active_pane, "");
		}
		if ( is_array( $posted_data ) && isset( $posted_data ) ) {
			update_post_meta( $post_id, 'cf7_style_custom_styler', array_filter($posted_data,'filter_w_zeros') , "");
		}

	}

	/**
	 * Save the style selector when the post is saved.
	 */
	public function save_style_selector( $post_id ) {
		if ( ! isset( $_POST['cf_7_style_selector_custom_box_nonce'] ) )
			return $post_id;

		$nonce = $_POST['cf_7_style_selector_custom_box_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'cf_7_style_selector_inner_custom_box' ) ) {
			return $post_id;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		if ( 'page' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
				
		}
		
		//getting all the cf7 forms
		$cf7formsargs = array(
			'post_type'		=> 'wpcf7_contact_form',
			'posts_per_page'	=> -1
		);
		$cf7forms = get_posts( $cf7formsargs );
		
		//for each checked form, saving the style id
		foreach ( $cf7forms as $cf7form ) {
			if ( isset( $_POST[$cf7form->post_name] ) ) {
				//if ( !empty( $_POST[$cf7form->post_name] ) ) {
					update_post_meta( $cf7form->ID, 'cf7_style_id', $post_id);
				//} 
			} else {
				$getthisstyle = get_post_meta( $cf7form->ID, 'cf7_style_id', $post_id );
				
				if ( !empty( $getthisstyle ) && $post_id == $getthisstyle ) {
					update_post_meta( $cf7form->ID, 'cf7_style_id', '' );
				}
				
				if ( !empty( $getthisstyle ) ) {
					//update_post_meta( $cf7form->ID, 'cf7_style_id', $getthisstyle );
				}
			}
		}
	}

	/**
	 * Render Meta Box content.
	 */
	public function render_meta_box_selector( $post ) {
		wp_nonce_field( 'cf_7_style_selector_inner_custom_box', 'cf_7_style_selector_custom_box_nonce' );

		// Display the form, using the current value.
		$args = array(
			'post_type'		=> 'wpcf7_contact_form',
			'posts_per_page'	=> -1
		);
		$currentpostid = get_the_ID();

		$query = new WP_Query( $args );
		echo '<table class="wp-list-table fixed pages widefat">'; 
			echo '<thead>';
				echo '<tr>';
					echo '<th class="manage-column">' . __('Contact form 7 forms', 'contact-form-7-style' ) . '</th>';
					echo '<th class="manage-column different-style"><input type="checkbox" id="select_all"/><label for="select_all">' . __('Select all','contact-form-7-style' ) . '</label></th>';
					echo '<th class="generate-preview-option">' . __( "Generate preview", 'contact-form-7-style'  ) . '</th>';
					echo '<th class="gotoform-option">' . __( "Navigate to CF7 form", 'contact-form-7-style'  ) . '</th>';
				echo '</tr>';
			echo '</thead>';
			echo '<tbody class="cf7style_body_select_all">';
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) : $query->the_post(); 
					$cf7ID = get_the_ID();
					$cf7stylehas = get_post_meta( $cf7ID, 'cf7_style_id', true ); 
				?>
					<tr>
						<td>
							<label for="<?php echo cf7_style_the_slug();  ?>"><?php the_title(); ?></label>
						</td>
						<td>
							<input type="checkbox" id="<?php echo cf7_style_the_slug(); ?>" name="<?php echo cf7_style_the_slug(); ?>" value="<?php echo get_the_ID(); ?>" <?php if ( $currentpostid == $cf7stylehas ) { echo 'checked'; } ?>  />
						</td>
						<td class="generate-preview-option">
							<button class="button-primary generate-preview-button" data-attr-title="<?php the_title(); ?>" data-attr-id="<?php the_ID(); ?>"><?php _e( "Generate preview", 'contact-form-7-style'  ); ?></button>
						</td>
						<td class="gotoform-option">
							<a class="button-primary" href="<?php echo esc_url(admin_url('?page=wpcf7&post='.$cf7ID.'&action=edit' )) ?>" target="_blank" title="<?php the_title(); ?>"><?php _e( "Go To CF7", 'contact-form-7-style'  ); ?></a>
						</td>
					</tr>
					<tr>
						<td colspan="2">
						<?php  if ( $currentpostid != $cf7stylehas && !empty( $cf7stylehas ) ) {
							echo '<p class="description">' . __('Notice: This form allready has a selected style. Checking this one will overwrite the ', 'contact-form-7-style' ) . '<a href="' . get_admin_url() . 'post.php?post_type=cf7_style&post=' . $cf7stylehas . '&action=edit">' . __('other one.', 'contact-form-7-style' ) . '</a></p>'; 
						} ?>							
						</td>
						<td class="generate-preview-option">&nbsp;</td>
					</tr>
				<?php endwhile; wp_reset_postdata();
				echo '</tbody>';
			echo '</table>';
			} else {
				echo '<tr><td><p class="description">' . __( 'Please create a form. You can do it by clicking', 'contact-form-7-style' ) . '<a href="' . admin_url() . 'admin.php?page=wpcf7-new" target="_blank">' . __(' here', 'contact-form-7-style' ) . '</a></p></td></tr></table>';
			}
	}
	/**
	 *STYLE SELECTOR ENDS HERE
	 *****************************
	 */
	 
	/*************************************************
	 * Adds the meta box container for IMAGE PREVIEW
	 * IMAGE META BOX STARTS HERE
	 */
	public function add_meta_box_style_image( $post_type ) {
		$post_types = array('cf7_style');     //limit meta box to certain post types
		if ( in_array( $post_type, $post_types )) {
			add_meta_box(
				'cf7_style_meta_box_image'
				,__( 'Preview', 'contact-form-7-style' )
				,array( $this, 'render_meta_box_image' )
				,$post_type
				,'side'
				,'high'
			);
		}
	}
	/*
	 * renders the image
	 */
	public function render_meta_box_image( $post ) {
		$image = get_post_meta( $post->ID, 'cf7_style_image_preview', true );
		if ( !empty( $image ) ) {
			echo '<img src="' . plugins_url() . '/contact-form-7-style' . $image . '" alt="' . $post->title . '" />';
		} else {
			//here will be the placeholder in case the image is not available
			$image = 'default_form.jpg';
			echo '<img src="' . plugins_url() . '/contact-form-7-style/images/' . $image . '" alt="' . $post->title . '" />';
		}
	}
	
	/**
	 *IMAGE META BOX ENDS HERE
	 ***************************
	 */
	/*
	* Meta box for font selector
	*/
	public function add_meta_box_font_selector( $post_type ) {
		$post_types = array('cf7_style');     //limit meta box to certain post types
		if ( in_array( $post_type, $post_types )) {
			add_meta_box(
				'cf7_style_meta_box_font_selector'
				,__( 'Select a Google Font', 'contact-form-7-style' )
				,array( $this, 'render_font_selector' )
				,$post_type
				,'advanced'
				,'high'
			);
		}
	}
	public function render_font_selector( $post ) {
		wp_nonce_field( 'cf_7_style_font_inner_custom_box', 'cf_7_style_font_custom_box_nonce' );
		//getting all google fonts
		$google_list = wp_safe_remote_get( 'https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyBAympIKDNKmfxhI3udY-U_9vDWSdfHrEo' );
		$response    = wp_remote_retrieve_body( $google_list );

		$font_obj = json_decode( $response );
		$cf7_style_font = get_post_meta( $post->ID, 'cf7_style_font', true );
		$selected = '';
		echo '<select name="cf7_style_font_selector">';
		echo '<option value="none">'.__( 'None', 'contact-form-7-style' ).'</option>';
		foreach ( $font_obj->items as $font) {
			echo '<option value="' . $font->family . '"' . ( $cf7_style_font == $font->family ? 'selected="selected"' : '' ) . '>' . $font->family . '</option>';
		}
		echo '</select>'; ?>
		<div class="cf7-style preview-zone">
			<h4><?php _e( "Preview Selected font:", "contact-form-7-style" ) ?></h4>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rhoncus ultrices neque sit amet consequat. Aenean facilisis massa convallis nisl viverra eleifend. Nam fermentum mauris eu eleifend posuere.</p>
		</div>
		<div class="clear"></div>
		<?php
	}
        
	/**
	* Save the font id
	*/
	public function save_font_id( $post_id ) {
		if ( ! isset( $_POST['cf_7_style_font_custom_box_nonce'] ) )
			return $post_id;

		$nonce = $_POST['cf_7_style_font_custom_box_nonce'];

		if ( ! wp_verify_nonce( $nonce, 'cf_7_style_font_inner_custom_box' ) ) {
			return $post_id;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		if ( 'page' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
				
		}
		
	                if ( isset ( $_POST['cf7_style_font_selector'] ) ) {
	                    update_post_meta( $post_id, 'cf7_style_font', sanitize_text_field( $_POST['cf7_style_font_selector'] ));
	                }
	}
	/*************************************************
	* Adds the meta box container for IMAGE PREVIEW
	* IMAGE META BOX STARTS HERE
	*/
	public function add_meta_box_style_paypal( $post_type ) {
		$post_types = array('cf7_style');     //limit meta box to certain post types
		if ( in_array( $post_type, $post_types )) {
			add_meta_box(
				'cf7_style_meta_box_paypal'
				,__( 'Donate', 'contact-form-7-style' )
				,array( $this, 'render_meta_paypal' )
				,$post_type
				,'side'
				,'high'
			);
		}
	}
	/*
	 * renders the image
	 */
	public function render_meta_paypal( $post ) { ?>
		<p><?php _e( "Your donation will motivate us to work more and improve this plugin.", "contact-form-7-style" ); ?></p>
		<a href="http://cf7style.com/back-this-project/" target="_blank">
			<img src="<?php echo WPCF7S_LOCATION;?>admin/images/paypal.svg">
		</a>
	<?php }
}

//gets the slug of a post
function cf7_style_the_slug() {
	global $post; 
	$post_data = get_post($post->ID, ARRAY_A);
	$slug = $post_data['post_name'];
	return $slug; 
}
//enques the font
function enque_selected_font() {
	if ( is_page() || is_single() || is_home() ) {
		global $post;
		$active_styles = active_styles();
		foreach( $active_styles as $cf7s_id ) {
			if ( $cf7s_id ) {
				$fontid 	= get_post_meta( $cf7s_id, 'cf7_style_font', true );
				$googlefont = preg_replace( "/ /", "+", $fontid );
				if( ! empty( $googlefont ) && "none" !== $googlefont )  {
					wp_register_style( 'googlefont-cf7style-' . $cf7s_id, 'https://fonts.googleapis.com/css?family=' . $googlefont . ':100,200,300,400,500,600,700,800,900&subset=latin,latin-ext,cyrillic,cyrillic-ext,greek-ext,greek,vietnamese', array(), false, 'all' );
					wp_enqueue_style( 'googlefont-cf7style-' . $cf7s_id );
				}
			}
		}
	}
}
add_action( 'wp_enqueue_scripts', 'enque_selected_font' );

/*
 * returns the name of the font on the current page/post
 */
function return_font_name( $cf7s_id ) {
	if ( $cf7s_id ) {
		$fontname = get_post_meta( $cf7s_id, 'cf7_style_font', true );
		return ( $fontname );
	}
	return false;
}

/*
 * hides change permalink and view buttons on editing screen
 */

add_action('admin_head', 'hide_edit_permalinks_on_style_customizer');
function hide_edit_permalinks_on_style_customizer() {
	$currentScreen = get_current_screen();
	if(empty($currentScreen)) { return false;}
	if ( $currentScreen->post_type == 'cf7_style' ) { 
	?>
		<style type="text/css">
			#titlediv {
				margin-bottom: 10px;
			}
			#edit-slug-box, .inline-edit-col-left, .inline-edit-col-right, .view{
				display: none;
			}
			.inline-edit-col-left.cf7-quick-edit {
				display: block;
			}
			.inline-edit-cf7_style {
				background: #eaeaea;
				padding: 20px 0;
			} 
		</style>
	<?php }
}


/**
 * Quick edit
 */ 

add_action( 'quick_edit_custom_box', 'manage_wp_posts_qe_bulk_quick_edit_custom_box', 10, 2 );
function manage_wp_posts_qe_bulk_quick_edit_custom_box( $column_name, $post_type ) {
 
	if( $post_type == 'cf7_style' && $column_name == 'preview-style' ) {

		switch ( $post_type ) {
			case 'cf7_style': ?>
				<fieldset class="inline-edit-col-left cf7-quick-edit" style="clear:both">
					<div class="hidden-fields"></div>
					<h4><?php _e( "Activate this template on the following forms:", "contact-form-7-style" ); ?></h4>
					<div class="inline-edit-col"> 
						<span class="data">
						<?php
							$args = array( 
								'post_type'		=> 'wpcf7_contact_form',
								'post_status'		=> 'publish',
								'posts_per_page'	=> -1
							);
							$forms = new WP_Query( $args );

							if( $forms->have_posts() ) :
								while( $forms->have_posts() ) : $forms->the_post();
									$form_title = get_the_title();
									$id 		= get_the_ID();
									$form_id    = "form-" . $id;
									$form_style = get_post_meta( get_the_ID(), 'cf7_style_id', true );

									echo "<p><span class='input-text-wrap'><input type='checkbox' name='form[{$id}]' id='form[{$id}]' data-id='{$id}' data-style='{$form_style}' /><label for='form[{$id}]' style='display:inline'>{$form_title}</label></span></p>";
									if( ! empty( $form_style ) && $id != $form_style ) {
										$template  = get_the_title( $form_style );
										$permalink = admin_url() . "post.php?post={$form_style}&action=edit";
										echo "<span class='notice'>".__( "Notice: This form allready has a selected style. Checking this one will overwrite the", "contact-form-7-style" )." <a href='{$permalink}' title='{$template}'>".__( "other one", "contact-form-7-style" )."</a>.</span>";
									}
								endwhile;
								wp_reset_postdata();
							endif; ?>
						</span>
					</div>
				</fieldset><?php
			break;
		}
	}
}


/**
 * Populate Quick Edit fields
 */

add_action( 'admin_print_scripts-edit.php', 'manage_wp_posts_be_qe_enqueue_admin_scripts' );
function manage_wp_posts_be_qe_enqueue_admin_scripts() {
	// if using code as plugin
	wp_enqueue_script( 'manage-wp-posts-using-bulk-quick-edit', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'admin/js/quick.edit-min.js', array( 'jquery', 'inline-edit-post' ), '', true );
}


/**
 * Save quick edit templates
 */

add_action( 'save_post_cf7_style', 'manage_wp_posts_be_qe_save_post', 10, 2 );
function manage_wp_posts_be_qe_save_post( $post_id, $post ) {
	// pointless if $_POST is empty (this happens on bulk edit)
	if ( empty( $_POST ) )
		return $post_id;
		
	// verify quick edit nonce
	if ( isset( $_POST[ '_inline_edit' ] ) && ! wp_verify_nonce( $_POST[ '_inline_edit' ], 'inlineeditnonce' ) )
		return $post_id;
			
	// don't save for autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return $post_id;
		
	// dont save for revisions
	if ( isset( $post->post_type ) && $post->post_type == 'revision' )
		return $post_id;

	if( isset( $_POST['form'] ) ) {
		foreach( $_POST['form'] as $form_id => $value ) {
			update_post_meta( $form_id, 'cf7_style_id', $post_id );
		}
	}

	if( isset( $_POST['remove-form'] ) ) {
		foreach( $_POST['remove-form'] as $form_id => $value ) {
			update_post_meta( $form_id, 'cf7_style_id', '' );
		}				
	}

} 