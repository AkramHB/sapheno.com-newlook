<?php 

if ( !defined( 'ABSPATH' ) ) {
 exit;
}

function generate_row($f_keypart, $s_keypart, $temp_element, $setting_key, $setting, $cf7s_custom_settings, $css_base, $type, $cf7s_force_css){
	$unit = '';
	$innerstyle = '';
	$kkey = ( $type == ":hover") ? '_hover' : '';
	if( $temp_element != $f_keypart ){
		$temp_element  = $f_keypart;
		$type_s = ( strpos($setting_key,'placeholder') === false ) ? $type : '';
		$innerstyle .= $css_base.$type_s.' {';
	}
	if( strpos($setting_key,'_unit') === false){
		$unitkey = ( $type == ":hover") ? $f_keypart.'_'.$s_keypart.'_unit'.$kkey : $setting_key.'_unit';

		$unit = ( array_key_exists( $unitkey ,$cf7s_custom_settings)) ? $cf7s_custom_settings[$unitkey] : '';

		$setting = ( strpos($s_keypart,'background-image') === false ) ? $setting : 'url("'.$setting.'")';

		$innerstyle .=  $s_keypart.": ".$setting.$unit.$cf7s_force_css. ";";
	}

	return array( 
		'temp' => $temp_element, 
		'style' => $innerstyle);
}

function generate_css_code($style, $cf7s_custom_settings, $classelem, $cf7s_force_css, $type, $placenot ) {

	$result = array();
	$temp_element = '';

	reset($cf7s_custom_settings);
	$first_setting_key = key($cf7s_custom_settings);

	/* get last key of custom style settings array */
	end($cf7s_custom_settings);
	$last_setting_key = key($cf7s_custom_settings);

	foreach( $cf7s_custom_settings as $setting_key => $setting ){

		$endtag = ( $first_setting_key == $setting_key ) ? "" : "}";

		$setting_key_part = explode( "_", $setting_key );

		$html_element = ( $setting_key_part[0] == "submit" || $setting_key_part[0] == "radio" || $setting_key_part[0] == "checkbox" ) ?
		" input[type='". $setting_key_part[0]."']" : ( ( $setting_key_part[0] == "form" ) ? "" : (( $setting_key_part[0] == "wpcf7-not-valid-tip" || $setting_key_part[0] == "wpcf7-validation-errors" || $setting_key_part[0] == "wpcf7-mail-sent-ok" ) ?
		" .". $setting_key_part[0] : ' '.$setting_key_part[0]) );

		$html_element = ( $placenot == '' ) ? $html_element : ' '.$placenot;

		$css_base = $endtag.$classelem.$html_element;

		$result = generate_row($setting_key_part[0], $setting_key_part[1], $temp_element, $setting_key, $setting, $cf7s_custom_settings, $css_base, $type, $cf7s_force_css);
		$temp_element = $result['temp'];
		$style .= $result['style'];

		if( $last_setting_key == $setting_key ){
			$style .= '}';
		}
	}/*foreach end*/
	return $style;
}

function cf7_style_custom_css_generator(){
	global $post;
	if( empty( $post ) ) {
		return false;
	}
	$args = array( 
		'post_type' => 'wpcf7_contact_form',
		'post_status' => 'publish',
		'posts_per_page' => -1
	);

	$placeholder_fallback = array('::-webkit-input-placeholder','::-moz-placeholder',':-ms-input-placeholder',':-moz-placeholder');
	$placeholder_hover_fallback = array('[placeholder]:hover::-webkit-input-placeholder','[placeholder]:hover::-moz-placeholder','[placeholder]:hover:-ms-input-placeholder','[placeholder]:hover:-moz-placeholder');
	
	$forms = new WP_Query( $args );
	//$total_num_posts = $forms->found_posts;
	$style = "";
	$cf7s_manual_style = html_entity_decode( stripslashes(get_option( 'cf7_style_manual_style', true )),ENT_QUOTES );
	$cf7s_manual_style = ( $cf7s_manual_style == '1' ) ? "" : $cf7s_manual_style;
	$cf7s_force_css = get_option( 'cf7_style_forcecss', true );
	
	$cf7s_force_css = ('1' === $cf7s_force_css ) ? " !important" : "";
	$active_styles = array();
	$style_number = 0;
	if( $forms->have_posts() ) :
		while( $forms->have_posts() ) : $forms->the_post();
			$id = get_the_ID();
			$cf7s_id = get_post_meta( $id, 'cf7_style_id', true );
			$form_title = get_the_title($cf7s_id);
			if ( ( ! empty( $cf7s_id ) || $cf7s_id !== 0 ) && ! in_array( $cf7s_id, $active_styles ) ) {	
				array_push( $active_styles, $cf7s_id );
				$cf7_style_data = get_post( $cf7s_id, OBJECT );	
				$check_custom_style = has_term( 'custom-style', 'style_category', $cf7_style_data );
				/*Check if custom style or template*/
				$cf7s_slug = ( $check_custom_style ) ? $cf7s_id : sanitize_title( $form_title);
				/*check if custom again*/
				if( $check_custom_style ){

					$cf7s_custom_settings = maybe_unserialize( get_post_meta( $cf7s_id, 'cf7_style_custom_styler', true ));
					$cf7s_custom_settings = ( empty($cf7s_custom_settings) ) ? array() : $cf7s_custom_settings;

					$classelem = "body .cf7-style." . ( ( is_numeric( $cf7s_slug ) ) ? "cf7-style-".$cf7s_slug : $cf7s_slug );

					$normal_arr = array();
					$hover_arr = array();

					$placeholder_arr = array();
					$placeholder_hover_arr = array();

					foreach( $cf7s_custom_settings as $setting_key => $setting ){
						if( strpos($setting_key,'_hover') === false ){
							if( strpos($setting_key,'placeholder') !== false ){
								$placeholder_arr[$setting_key] = $setting; 
							} else {
								$normal_arr[$setting_key] = $setting;
							}
						} else {
							
							if( strpos($setting_key,'placeholder') !== false ){
								$placeholder_hover_arr[$setting_key] = $setting; 
							} else {
								$hover_arr[$setting_key] = $setting;
							}
						}
					}

					$style .= generate_css_code( (( $style_number == 0) ? $style : ''), $normal_arr, $classelem, $cf7s_force_css, '', '' );
					$style .= generate_css_code( '', $hover_arr, $classelem, $cf7s_force_css, ':hover', '' );

					if( !empty($placeholder_arr) ){
						foreach ($placeholder_fallback as $placeh) {
							$style .= generate_css_code( '', $placeholder_arr, $classelem, $cf7s_force_css, '', $placeh);
						}
					}

					if( !empty($placeholder_hover_arr) ){
						foreach ($placeholder_hover_fallback as $placeh) {
							$style .= generate_css_code( '', $placeholder_hover_arr, $classelem, $cf7s_force_css, ':hover', $placeh);
						}
					}

				}/*custom end*/

				$font_family = return_font_name( $cf7s_id );

				if( ! empty( $font_family ) && "none" !== $font_family ) {
					if (is_numeric($cf7s_slug)) {
						$cf7s_slug = "cf7-style-".$cf7s_slug;
					}
					$style .= 'body .cf7-style.' . $cf7s_slug . ",body .cf7-style." . $cf7s_slug . " input[type='submit'] {font-family: '" . $font_family . "',sans-serif;} ";
				}
				$style_number++;
			}/*Main if ends here*/
		endwhile;
		$style_manual = "";
		$style_start = "\n<style class='cf7-style' media='screen' type='text/css'>\n";
		if( !empty( $cf7s_manual_style ) ){
			$style_manual = "\n".$cf7s_manual_style."\n";
		}
		$cur_css = $style_start;
		$cur_css .= $style;
		$cur_css .= $style_manual;
		if( ( $style_number !== 0 ) && $style_number == count( $active_styles ) ) {
			$cur_css .= "\n</style>\n";
		}
		$cur_css = str_replace(' 0px;', ' 0;', $cur_css);

		echo $cur_css;
		wp_reset_postdata();
	endif;	
}// end of cf7_style_custom_css_generator