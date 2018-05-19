<?php
/**
 * Contact Form 7 Style Options
 */

if ( !defined( 'ABSPATH' ) ) {
 exit;
}

require_once 'plugin-options.php';

/**
 * Get saved values
 */ 

wp_nonce_field( 'cf_7_style_style_customizer_inner_custom_box', 'cf_7_style_customizer_custom_box_nonce' );
$saved_values = maybe_unserialize(get_post_meta( $post->ID, 'cf7_style_custom_styler', true ));
$saved_values = (empty($saved_values)) ? array() : $saved_values;
$encoded_data = str_replace( "\"", "'", json_encode( $saved_values));
$active_panel = get_post_meta( $post->ID, 'cf7_style_active_panel', 'form' );
$active_panel = ( $active_panel=="" ) ? "form" : $active_panel;
$form_tags = '<div id="form-tag">';
$form_tags .= '<h4>'. __( "Choose element", 'contact-form-7-style' ).'</h4>';
$form_panel  = "";
$form_index = 0;
foreach( $elements as $property => $property_value ) {
	$selected_class = ( $active_panel == $property) ? ' button-primary' : '';
	$hidden_class = ( $active_panel != $property || ( $active_panel =="" && $form_index++ > 0)) ? ' hidden' : ''; 
	$form_tags .= "<a href='#' class='button".$selected_class."' data-property='".$property."'>" . $property_value['name'] . "</a>";
	$form_panel .= "<div class='". $property ."-panel panel".$hidden_class." clearfix'>";
		if( $property == $active_panel ) {
			if( $property_value['description'] != ""){
				$form_panel .= '<h4 class="description-title">'.$property_value['description'].'</h4>';
			}
			foreach( $property_value['settings'] as $sub_property_key => $sub_property_value ) {
				$property = strtolower( $property );
				$sub_property_slug = strtolower( $options[$sub_property_value]['slug'] );
				$style_element_name 	= strtolower($options[$sub_property_value]['name']);
				$half_width_class = ( $style_element_name == "box sizing" || $style_element_name == "display" || $style_element_name == "position" ||  $style_element_name == "width" || $style_element_name == "height") ? "half-size" : "";
				$form_panel .= '<div class="element-styling '.$half_width_class.' '.$style_element_name.'"><h3><span>&lt;'.$property.'&gt;</span> '.$style_element_name . '</h3>';
				if( $options[$sub_property_value]['type'] ) {
					$form_panel .= "<ul>";
					foreach( $options[$sub_property_value]['type'] as $key => $value ) {
						if( $key != "comming-soon"  ){
							$form_panel .= generate_property_fields( $key, $value, $property, $sub_property_slug, $saved_values, '');
							$form_panel .= generate_property_fields( $key, $value, $property, $sub_property_slug, $saved_values, '_hover');
						} else {
							$form_panel .= "<li></li>";
						}
					}
					$form_panel .= "</ul>";
					$form_panel .= "</div>";
				}
			}
		}
	$form_panel .= "</div>";
}
?>

<div class="generate-preview">		
	<?php
		$form_args = array(
			'post_type'		=> 'wpcf7_contact_form',
			'posts_per_page'	=> -1,
			'meta_key' 		=> 'cf7_style_id',
			'meta_value' 		=> $post->ID
		);
		$indexter = 0;
		$form_el = array();
		$form_query = new WP_Query( $form_args );
		while ( $form_query->have_posts() ) : $form_query->the_post(); 
			$cur_title = get_the_title();
			$form_el[$indexter]['form'] = do_shortcode( '[contact-form-7 id="'.get_the_ID().'" title="'.$cur_title.'"]' );
			$form_el[$indexter++]['form_title'] = $cur_title;
		endwhile; 
		wp_reset_postdata();
		$form_choose ="";
		if($indexter > 1){
			$form_choose 	= '<div class="choose-preview"><h4>'.__( "Choose form to preview:", 'contact-form-7-style' ).'</h4>';
			$form_choose 	.= '<select name="form-preview" id="form-preview">';
			foreach ($form_el as $key => $cur_form) {   
				$form_choose .= '<option value="'.$key.'" '.selected($key,0,false).'>'.$cur_form['form_title'].'</option>';
			} 
			$form_choose .= "</select></div>";
		}
		$form_tags 	.= '</div>';?>
	<div class="panel-options">
		<h3><?php echo __( "Customize form", 'contact-form-7-style' );?></h3>
		<?php echo $form_tags; ?>
		<div class="element-selector clearfix">
			<h4><?php echo __( "Choose element state", 'contact-form-7-style' ); ?></h4>
			<label><input type="radio" name="element-type" checked = "checked" value="normal" /> <?php echo __( "normal state", 'contact-form-7-style' ); ?></label>
			<label><input type="radio" name="element-type" value="hover" /> <?php echo __( ":hover state", 'contact-form-7-style' ); ?></label>
			<div class="hidden"><input type="text" name="cf7styleactivepane" value="<?php echo $active_panel;  ?>"></div>
			<div class="hidden"><input type="text" name="cf7styleallvalues" value="<?php echo $encoded_data;  ?>"></div>
		</div>
		<?php echo $form_panel; ?>
		<div class="loading hidden">
			<img src="<?php echo WPCF7S_LOCATION; ?>admin/images/gears.svg" alt="loading...">
		</div><!-- /.loading hidden -->
		<div class="decision hidden">
			<?php $check_screen = get_current_screen(); ?>
			<?php if( $check_screen->action == "add" && $check_screen->post_type == "cf7_style" ){ ?>
				<input type="submit" name="publish" class="button button-primary button-large save-btn" value="<?php echo __( 'Publish Style', 'contact-form-7-style' );?>">
			<?php } else { ?>
				<input name="save" type="submit" class="button button-primary button-large save-btn" value="<?php echo __( 'Update Style', 'contact-form-7-style' );?>">
			<?php } ?>
			<a href="#" class="button button-primary cancel-btn"><?php echo __( "Cancel", 'contact-form-7-style' );?></a>
		</div><!-- /.decision hidden -->
	</div>
	<div class='panel-header'>

		<h3><?php echo __( "Preview Area", 'contact-form-7-style' ); ?></h3>
		<?php echo $form_choose;   ?>
		<div class='preview-form-tag' id="preview">
			<?php 
			$indexter = 0;

			// Show default form when on first custom style edit
			if( empty( $form_el ) ) {
				echo "<p class='cf7style-no-forms-added'>" . __( 'Please check one of the forms above and press generate preview button to activate the preview mode.', 'contact-form-7-style' ) . "</p>";
			}

			foreach ( $form_el as $key => $cur_form ) { 
				$extra_class= ($indexter++ != 0) ? 'hidden' : ''; ?>
				<div class="preview-form-container <?php echo $extra_class; ?>">
					<h4><?php echo $cur_form['form_title']; ?></h4>
					<?php echo $cur_form['form'];  ?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php $check_screen = get_current_screen(); ?>
<div class="fixed-save-style">
	<?php if( $check_screen->action == "add" && $check_screen->post_type == "cf7_style" ){ ?>
		<input type="submit" name="publish" class="button button-primary button-large" value="<?php echo __( 'Publish Style', 'contact-form-7-style' );?>">
	<?php } else { ?>
		<input name="save" type="submit" class="button button-primary button-large" value="<?php echo __( 'Update Style', 'contact-form-7-style' );?>">
	<?php } ?>
</div>