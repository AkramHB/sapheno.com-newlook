<?php 

if ( !defined( 'ABSPATH' ) ) {
 exit;
}

function cf7_style_load_property() {

	$form_property = sanitize_text_field( $_POST['property'] );
	$form_panel = "";
	$saved_values = maybe_unserialize(get_post_meta( $post->ID, 'cf7_style_custom_styler', true ));
	$saved_values = (empty($saved_values)) ? array() : $saved_values;
	require_once( WPCF7S_PLUGIN_DIR.'/plugin-options.php' );
	foreach( $elements as $property => $property_value ) {
		if( $property == $form_property ) {
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
	}
	print_r($form_panel);
	wp_die();
}
add_action( 'wp_ajax_cf7_style_load_property', 'cf7_style_load_property' );