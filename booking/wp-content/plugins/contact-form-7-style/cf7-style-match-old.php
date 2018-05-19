<?php

if ( !defined( 'ABSPATH' ) ) {
 exit;
}

function get_new_styler_data($a){
	$t = array();
	$u = "px";
	foreach ( $a as $k => $d ) {
		if( $d != 'Default' && $d != ''){
			if($k=="form-padding" || $k=="form-margin" ||$k=="input-margin" ||$k=="input-padding" ){
				$d = str_replace("px", "", $d); 
				$da = explode(" ", $d);
				$nr = count($da);
				$tfn = "";
			} 
			switch($k){
				case 'form-background'	 : 
					$t['form_background-color'] = $d; 
					break;
				case 'form-width' : $t['form_width'] = $d;
					$t['form_width_unit'] = $u; 
					break;
				case 'form-border-width' : 
					$t['form_border-top-width'] = $d;
					$t['form_border-top-width_unit'] = $u;
					$t['form_border-right-width'] = $d;
					$t['form_border-right-width_unit'] = $u;
					$t['form_border-bottom-width'] = $d;
					$t['form_border-bottom-width_unit'] = $u;
					$t['form_border-left-width'] = $d;
					$t['form_border-left-width_unit'] = $u;
					break;
				case 'form-border-style' :
					$t['form_border-style'] = $d;
					break;
				case 'form-padding' :
					$tfn = "form_padding";
					break;
				case 'form-margin' :
					$tfn = "form_margin";
					break;
				case 'form-border-color' : 
					$t['form_border-color'] = $d;
					break;
				case 'form-border-radius' : 
					$t['form_border-top-left-radius'] = $d;
					$t['form_border-top-left-radius_unit'] 	= $u;
					$t['form_border-top-right-radius'] = $d;
					$t['form_border-top-right-radius_unit'] = $u;
					$t['form_border-bottom-left-radius'] = $d;
					$t['form_border-bottom-left-radius_unit'] = $u;
					$t['form_border-bottom-right-radius'] = $d;
					$t['form_border-bottom-right-radius_unit'] = $u;
					break;
				case 'form-line-height' : 
					$t['form_line-height']= $d;
					$t['form_line-height_unit']= $u;
					break;
				case 'input-background' :
					$t['input_background-color'] = $d;
					break;
				case 'input-color' : 
					$t['input_color'] = $d;
					break;
				case 'input-border-color' : 
					$t['input_border-color'] = $d;
					break;
				case 'input-font-size' : 
					$t['input_font-size'] = $d;
					$t['input_font-size_unit'] = $u;
					break;
				case 'input-line-height' : 
					$t['input_line-height'] = $d;
					$t['input_line-height_unit'] = $u; 
					break;
				case 'input-border-width' :
					$t['input_border-top-width'] = $d;
					$t['input_border-top-width_unit'] = $u;
					$t['input_border-right-width'] = $d;
					$t['input_border-right-width_unit'] = $u;
					$t['input_border-bottom-width'] = $d;
					$t['input_border-bottom-width_unit'] = $u;
					$t['input_border-left-width'] = $d;
					$t['input_border-left-width_unit'] = $u;
					break;
				case 'input-border-style' : 
					$t['input_border-style'] = $d; 
					break;
				case 'input-border-radius' : 
					$t['input_border-top-left-radius'] = $d;
					$t['input_border-top-left-radius_unit'] = $u;
					$t['input_border-top-right-radius'] = $d;
					$t['input_border-top-right-radius_unit'] = $u;
					$t['input_border-bottom-left-radius'] = $d;
					$t['input_border-bottom-left-radius_unit'] = $u;
					$t['input_border-bottom-right-radius'] = $d;
					$t['input_border-bottom-right-radius_unit'] = $u; 
					break;
				case 'input-font-style' :
					$t['input_font-style'] = $d; 
					break;
				case 'input-font-weight' : 
					$t['input_font-weight'] = $d; 
					break;
				case 'input-width' : $t['input_width'] = $d;
					$t['input_width_unit'] = $u;
					break;
				case 'input-box-sizing' :
					$t['input_box-sizing']= $d;
					break;
				case 'input-height' : 
					$t['input_height'] = $d;
					$t['input_height_unit'] = $u;
					break;
				case 'input-padding' :
					$tfn = "input_padding";
					break;
				case 'input-margin' :
					$tfn = "input_margin";
					break;
				case 'textarea-background-color' : 
					$t['textarea_background-color'] = $d;
					break;
				case 'textarea-height' :
				 	$t['textarea_height'] = $d;
					$t['textarea_height_unit'] = $u;
					break;
				case 'textarea-width' :
					$t['textarea_width'] = $d;
					$t['textarea_width_unit'] = $u;
					break;
				case 'textarea-box-sizing' : 
					$t['textarea_box-sizing'] = $d;
					break;
				case 'textarea-border-size' :
					$t['textarea_border-top-width'] = $d;
					$t['textarea_border-top-width_unit'] = $u;
					$t['textarea_border-right-width'] = $d;
					$t['textarea_border-right-width_unit'] = $u;
					$t['textarea_border-bottom-width'] = $d;
					$t['textarea_border-bottom-width_unit'] = $u;
					$t['textarea_border-left-width'] = $d;
					$t['textarea_border-left-width_unit'] = $u;
					break;
				case 'textarea-border-color' : 
					$t['textarea_border-color']= $d;
					break;
				case 'textarea-border-style' : 
					$t['textarea_border-style'] = $d;
					break;
				case 'textarea-border-radius' : 
					$t['textarea_border-top-left-radius'] = $d;
					$t['textarea_border-top-left-radius_unit'] = $u;
					$t['textarea_border-top-right-radius'] = $d;
					$t['textarea_border-top-right-radius_unit'] = $u;
					$t['textarea_border-bottom-left-radius'] = $d;
					$t['textarea_border-bottom-left-radius_unit'] = $u;
					$t['textarea_border-bottom-right-radius'] = $d;
					$t['textarea_border-bottom-right-radius_unit'] = $u;
					break;
				case 'textarea-font-size' : 
					$t['textarea_font-size'] = $d; 
					$t['textarea_font-size_unit'] = $u;
					break;
				case 'textarea-line-height' : 	
					$t['textarea_line-height'] = $d; 
					$t['textarea_line-height_unit'] = $u;
					break;
				case 'textarea-font-style' : 
					$t['textarea_font-style'] = $d;
					break;
				case 'label-font-style' : 	
					$t['label_font-style']= $d;
					$t['p_font-style']= $d;
					break;
				case 'label-font-weight' : 	
					$t['label_font-weight'] = $d;
					$t['p_font-weight'] = $d;
					break;
				case 'label-font-size' : 	
					$t['label_font-size'] = $d; 
					$t['label_font-size_unit'] = $u;
					$t['p_font-size'] = $d; 
					$t['p_font-size_unit'] = $u;
					break;
				case 'label-line-height' : 
					$t['label_line-height']= $d; 
					$t['label_line-height_unit']= $u;
					$t['p_line-height']= $d; 
					$t['p_line-height_unit']= $u;
					break;
				case 'label-color' : 
					$t['label_color'] = $d;
					$t['p_color'] = $d;
					break;
				case 'submit-button-width' : 
					$t['submit_width'] = $d;
					$t['submit_width_unit'] = $u;
					break;
				case 'submit-button-box-sizing' : 	
					$t['submit_box-sizing'] = $d;
					break;
				case 'submit-button-height' : 
					$t['submit_height'] = $d;
					$t['submit_height_unit'] = $u;
					break;
				case 'submit-button-border-radius' :  	
					$t['submit_border-top-left-radius'] = $d;
					$t['submit_border-top-left-radius_unit'] = $u;
					$t['submit_border-top-right-radius'] = $d;
					$t['submit_border-top-right-radius_unit'] = $u;
					$t['submit_border-bottom-left-radius'] = $d;
					$t['submit_border-bottom-left-radius_unit'] = $u;
					$t['submit_border-bottom-right-radius'] = $d;
					$t['submit_border-bottom-right-radius_unit'] 	= $u;
					break;
				case 'submit-button-font-size' : 
					$t['submit_font-size'] = $d; 
					$t['submit_font-size_unit'] = $u;
					break;
				case 'submit-button-line-height' : 
					$t['submit_line-height'] = $d; 
					$t['submit_line-height_unit'] = $u;
					break;
				case 'submit-button-border-width' : 
					$t['submit_border-top-width'] = $d;
					$t['submit_border-top-width_unit'] = $u;
					$t['submit_border-right-width'] = $d;
					$t['submit_border-right-width_unit'] = $u;
					$t['submit_border-bottom-width'] = $d;
					$t['submit_border-bottom-width_unit']= $u;
					$t['submit_border-left-width']= $d;
					$t['submit_border-left-width_unit']= $u;
					break;
				case 'submit-button-border-style': 
					$t['submit_border-style'] = $d;
					break;
				case 'submit-button-border-color' :
					$t['submit_border-color'] = $d;
					break;
				case 'submit-button-color' :
					$t['submit_color'] = $d;
					break;
				case 'submit-button-background' :
					$t['submit_background-color'] = $d;
					break;
			}
			if($k=="form-padding" || $k=="form-margin" ||$k=="input-margin" ||$k=="input-padding" ){
				switch($nr){
					case 1: 
						$t[$tfn.'-top'] = $d;
						$t[$tfn.'-top_unit'] = $u;
						$t[$tfn.'-right'] = $d;
						$t[$tfn.'-right_unit'] = $u;
						$t[$tfn.'-bottom'] = $d;
						$t[$tfn.'-bottom_unit'] = $u;
						$t[$tfn.'-left'] = $d;
						$t[$tfn.'-left_unit'] = $u;
						break;
					case 2:
						$t[$tfn.'-top'] = $da[0];
						$t[$tfn.'-top_unit'] = $u;
						$t[$tfn.'-right'] = $da[1];
						$t[$tfn.'-right_unit'] = $u;
						$t[$tfn.'-bottom'] = $da[0];
						$t[$tfn.'-bottom_unit'] = $u;
						$t[$tfn.'-left'] = $da[1];
						$t[$tfn.'-left_unit'] = $u;
						break;
					case 3: 
						$t[$tfn.'-top'] = $da[0];
						$t[$tfn.'-top_unit'] = $u;
						$t[$tfn.'-right'] = $da[1];
						$t[$tfn.'-right_unit'] = $u;
						$t[$tfn.'-bottom'] = $da[2];
						$t[$tfn.'-bottom_unit'] = $u;
						$t[$tfn.'-left'] = $da[1];
						$t[$tfn.'-left_unit'] = $u;
						break;
					case 4:  
						$t[$tfn.'-top'] = $da[0];
						$t[$tfn.'-top_unit'] = $u;
						$t[$tfn.'-right'] = $da[1];
						$t[$tfn.'-right_unit'] = $u;
						$t[$tfn.'-bottom'] = $da[2];
						$t[$tfn.'-bottom_unit'] = $u;
						$t[$tfn.'-left'] = $da[3];
						$t[$tfn.'-left_unit'] = $u;
						break;
				}
			}
		}
	}
	return $t;
}