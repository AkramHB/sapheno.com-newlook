<?php

class NF_Popups_Settings_Metabox {

	private $customizer_url;
	private $settings;

	function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'register_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_box' ) );

	}
	/**
	 * Register meta box(es).
	 */
	function register_meta_boxes() {
		add_meta_box( 'nf-popups-shortcode-metabox', __( 'Popup Shortcode', 'nf-popup' ),  array( $this, 'shortcode_popup_metabox' ), 'nf-popups', 'side', 'high' );
		add_meta_box( 'nf-popups-customize-metabox', __( 'Design Popup', 'nf-popup' ),  array( $this, 'design_popup_metabox' ), 'nf-popups', 'side', 'high' );
		add_meta_box( 'nf-popups-settings-metabox', __( 'Popup Settings', 'nf-popup' ),  array( $this, 'settings_metabox' ), 'nf-popups', 'normal', 'high' );
	}

	function shortcode_popup_metabox($post){
		?>
		<br/>
		<code>[nf-popup id=<?php echo get_the_ID(); ?>]</code>

		<p style="margin-top:10px" class="description">Use this shortcode to show popup anywhere on your site.</p>
		<?php
	}

	/**
	 * Meta box display callback.
	 *
	 * @param WP_Post $post Current post object.
	 */
	function design_popup_metabox( $post ) {
		// set the settings variable
		$this->settings =get_post_meta( $post->ID, 'nf_popups_settings', true );
		$form_id = $this->get_setting( 'ninja_form_id' );
		 if( empty($form_id)){
			 // nor form selected 
			 $this->customizer_url = '#';
			 $description = 'Please select & save the Ninja Forms first to customize the popup layout';
		 } else {
			$this->_set_customizer_url( $post ); 
			$description ='';
		 } 
		?>
		<a id="nf-design-button" class="button" href="<?php echo $this->customizer_url; ?>">Customize Popup<a>
		<p class="description" style="color:red"><?php echo $description; ?></p>
	<?php }

	function settings_metabox( $post ) {
		$form_id = $this->get_setting( 'ninja_form_id' );
		if ( class_exists( 'Ninja_Forms' ) ) {
			$forms = Ninja_Forms()->form()->get_forms();
			$popup_triggers_type = apply_filters( 'nf_popups_trigger_types', array('click'=>'Click','auto_open'=>'Auto Open') );
			// Add an nonce field so we can check for it later.
			wp_nonce_field( 'nf_popups_inner_custom_box', 'nf_popups_inner_custom_box_nonce' );
?>
			<table class="form-table">
				<tbody>
					<tr class="nf-popups-metabox-row">
						<th scope="row">
							<label>
								Select Ninja Forms
							</label>
						</th>
						<td>
							<select name='nf_popups_settings[ninja_form_id]'>
								<option value="0">None</option>
								<?php foreach ( $forms as $form ): ?>
									<?php $id = $form->get_id(); ?>
										<option value="<?php echo $id; ?>" <?php selected( $id, $form_id );?>>
											<?php echo $form->get_setting( 'title' ); ?>
										</option>
								<?php endforeach; ?>
							</select>
							<p class="description">Select Ninja Forms to show in Popup</p>
						</td>
					</tr>

					<tr class="nf-popups-metabox-row">
						<th scope="row">
							<label>
								Add Content Before Form
							</label>
						</th>
						<td>
							<?php echo wp_editor( $this->get_setting( 'content_before_form' ), 'nf_popups_content_before_form', array( 'textarea_name'=>'nf_popups_settings[content_before_form]', 'textarea_rows'=>8 ) ); ?>
						</td>
					</tr>

					<tr class="nf-popups-metabox-row">
						<th scope="row">
							<label>
								Add Content After Form
							</label>
						</th>
						<td>
							<?php echo wp_editor( $this->get_setting( 'content_after_form' ), 'nf_popups_content_after_form', array( 'textarea_name'=>'nf_popups_settings[content_after_form]', 'textarea_rows'=>8 ) ); ?>
						</td>
					</tr>
					<tr >
						<th colspan="2">
							<div style="position:relative">
								<h2 class="nf-popups-section-heading"><span>Trigger Settings</span></h2>
							</div>
						</th>
					</tr>
					<tr class="nf-popups-metabox-row">
						<th scope="row">
							<label>
								Popup Trigger
							</label>
						</th>
						<td>
							<select id="nf-popups-settings-trigger" name='nf_popups_settings[trigger]'>
								<?php foreach ( $popup_triggers_type as $trigger_key => $trigger_label ) { ?>

								<option <?php selected(  $this->get_setting( 'trigger' ),$trigger_key  );?> value="<?php echo $trigger_key; ?>"><?php echo $trigger_label; ?></option>

							   <?php } ?>

							</select>
						</td>
					</tr>
					<tr style="<?php echo $this->get_setting( 'trigger' ) == 'auto'? 'display:block':'display:none'; ?>" class="nf-popups-metabox-delay-row">
						<th scope="row">
							<label>
								Select Delay
							</label>
						</th>
						<td>
						<input type="text" value="<?php echo  $this->get_setting( 'auto_open_delay' ) ?>" class="small" name="nf_popups_settings[auto_open_delay]">ms
						</td>
					</tr>
					<tr style="<?php echo $this->get_setting( 'trigger' ) == 'auto_open'? 'display:none':''; ?>" class="nf-popups-metabox-trigger-class-row">
						<th scope="row">
							<label>
								Trigger Class/ID
							</label>
						</th>
						<td>
						<input type="text" value="<?php echo  $this->get_setting( 'trigger_id' ) ?>" class="small" name="nf_popups_settings[trigger_id]" placeholder="e.g .mypopup or #mypopup">
						<p class="description"> Give this class/id to your button/achor to open popup when clicked on them. Use classname with dot e.g .mypopup & id with # e.g #mypopup</p>
						</td>
					</tr>
					<tr >
						<th colspan="2">
							<div style="position:relative">
								<h2 class="nf-popups-section-heading"><span>Hide Settings</span></h2>
							</div>
						</th>
					</tr>
					<tr class="nf-popups-metabox-trigger-class-row">
						<th scope="row">
							<label>
								Hide Popup after closed
							</label>
						</th>
						<td>
						<input type="text" style="width:50px" placeholder="e.g 1" value="<?php echo  $this->get_setting( 'show_popup_times' ) ?>" class="small" name="nf_popups_settings[show_popup_times]" > times
						<p class="description"> Enter Integer value to hide popup after closed by users number of times. Leave it empty to show popup everytime user visit your site/page.</p>
						</td>
					</tr>

					<tr class="nf-popups-metabox-trigger-class-row">
						<th scope="row">
							<label>
							Cookie Expiry 
							</label>
						</th>
						<td>
						<input type="text" style="width:50px" placeholder="e.g 1" name="nf_popups_settings[cookie_expiry_length]" value="<?php echo  $this->get_setting( 'cookie_expiry_length' ) ?>" class="small"  >
						<select id="nf-popups-cookie-expiry-type" name="nf_popups_settings[cookie_expiry_type]">
							<option <?php selected(  $this->get_setting( 'cookie_expiry_type' ),'D'  );?> value='D'>Days</option>
							<option <?php selected(  $this->get_setting( 'cookie_expiry_type' ),'W'  );?> value='W'>Weeks</option>
							<option <?php selected(  $this->get_setting( 'cookie_expiry_type' ),'M'  );?> value='M'>Months</option>
							<option <?php selected(  $this->get_setting( 'cookie_expiry_type' ),'Y'  );?> value='Y'>Years</option>
						</select>
						<p class="description"> Resets the hide popup counter after seleted duration </p>
						</td>
					</tr>


				</tbody>
			</table>

		<?php
		} else {
			echo 'Please install Ninja Forms 3.0 or later to use this plugin';

		}
	}

	/**
	 * Save meta box content.
	 *
	 * @param int     $post_id Post ID
	 */
	function save_meta_box( $post_id ) {

		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['nf_popups_inner_custom_box_nonce'] ) ) {
			return $post_id;
		}

		$nonce = $_POST['nf_popups_inner_custom_box_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'nf_popups_inner_custom_box' ) ) {
			return $post_id;
		}

		/*
		 * If this is an autosave, our form has not been submitted,
		 * so we don't want to do anything.
		 */
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		// Check the user's permissions.
		if ( 'page' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
		}

		/* OK, it's safe for us to save the data now. */

		// Sanitize the user input.
		$nf_popups = $_POST['nf_popups_settings'];

		// Update the meta field.
		update_post_meta( $post_id, 'nf_popups_settings', $nf_popups );
	}

	/**
	 * Set the customizer url
	 *
	 * @since 1.0.0
	 */
	private function _set_customizer_url( $post ) {

		$post_id = $post->ID;

		$url = admin_url( 'customize.php' );

		$url = add_query_arg( 'nf-popups-customizer', 'true', $url );

		$url = add_query_arg( 'popup_id', $post_id, $url );

		$url = add_query_arg( 'url', wp_nonce_url(  urlencode( add_query_arg( array( 'popup_id' => $post_id, 'nf-popups-customizer' => 'true' ), site_url() ) ), 'preview-popup' ), $url );

		$url = add_query_arg( 'return', urlencode( add_query_arg( array( 'post' => $post_id, 'action' => 'edit' ), admin_url( 'post.php' ) ) ), $url );

		$this->customizer_url = esc_url_raw( $url );

		return true;
	}

	function get_setting( $setting_name ) {
		$settings = $this->settings;
		return isset( $settings[$setting_name] )?$settings[$setting_name]: '';
	}

}

new NF_Popups_Settings_Metabox();
