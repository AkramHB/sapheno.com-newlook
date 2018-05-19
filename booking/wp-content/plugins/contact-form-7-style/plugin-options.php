<?php

if ( !defined( 'ABSPATH' ) ) {
 exit;
}

$request_json = wp_remote_get( WPCF7S_LOCATION.'admin/settings-setup.json' );

if ( is_wp_error( $request_json ) || ( array_key_exists('response', $request_json ) && $request_json['response']['code'] != '200' )  ) {
    require WPCF7S_PLUGIN_DIR.'/admin/settings_setup.php';
    $options = json_decode( $setting_str, true );
} else {
    $options = json_decode( wp_remote_retrieve_body( $request_json ) , true);
}



/**
 * Generate property fields
 */

function generate_property_fields( $key, $std, $name, $type, $saved_values, $selector_type ) {
    $temp = '';
    /*Had to remove numbers which adds the  UNIQUE keys!*/
    $title_addon = ($selector_type != "") ? str_replace('_', ' ', $selector_type): "";
    $hidden_element = ($selector_type != "") ? "class='hidden".$title_addon."-element'": "";
    $current_key = preg_replace('/[0-9]+/', '', strtolower( $key ) );
    switch ( $current_key ) {
        case 'color-picker':
        case 'input':
            $field_class = ($current_key == "input") ? "cf7-style-upload-field" : "cf7-style-color-field";
            $saved_one = (array_key_exists( $name . "_". $std["style"].$selector_type, $saved_values)) ? $saved_values[ $name . "_". $std["style"].$selector_type] : "";
            return "<li ".$hidden_element."><label for='". $name . "_". $std["style"] .$selector_type."'><strong>".$std["title"].$title_addon.":</strong></label>".(($current_key == "color-picker") ? "<span class='icon smaller'><i class='icon-eyedropper' aria-hidden='true'></i></span>" : "")."<input type='text' id='". $name . "_". $std["style"] .$selector_type."' name='cf7stylecustom[". $name . "_". $std["style"] .$selector_type."]' value='". $saved_one ."' class='".$field_class."' /></li>";
            break;
        case 'comming-soon': 
            return "<li></li>";
        break;
        case 'numeric':
            $val = explode( " ", $std["property"] );
            $temp .= "<li ".$hidden_element.">";
            if( $std["property"] == "0 0 0 0"){
                if( $std["style"] == "border-radius"){
                    $element= array( "top-left", "top-right-radius", "bottom-left-radius", "bottom-right-radius" );
                    $temp .=  "<label for='".$name . "_border-top-left-radius".$selector_type."'><strong>".$std["title"].":</strong>";
                } else {
                    $element= array( "top", "right", "bottom", "left" );
                     $labelos = explode( "-",$std["style"]);
                     if( $std["style"] == "border-radius"){
                        $ending =  "-top-".$labelos[1].$selector_type;
                     } else {
                        $ending =  "-top".$selector_type;
                     }
                    $temp .=  "<label for='".$name . "_". $labelos[0].$ending."'><strong>".$std["title"].$title_addon.":</strong>";
                }
            }else {
                $temp .=  "<label for='".$name . "_". $std["style"].$selector_type."'><strong>".$std["title"].$title_addon.":</strong>";
            }
            $incrementor = 0;
            $indexer = 0;
            $arrows = array('up', 'right', 'down' , 'left');
            $fonts = array( 'font-size' => 'text-height', 'line-height' => 'font', 'text-indent' => 'indent-right');
            foreach( $val as $elem_key => $elem_value ) {
                if( $std["property"] == "0 0 0 0"){
                    /*Add new style properties if 4 value property inserted*/
                    $newproperty = explode("-", $std["style"]);
                    $endstyling = $element[ $incrementor];
                    if( $std["style"] == "border-radius"){
                        $endstyling = $element[ $incrementor ]."-".end($newproperty);
                    }
                    $std["style"] = $newproperty[0] ."-".$endstyling;
                    $incrementor++;
                }
                $test = ( $std["style"] == "border-top" || $std["style"] == "border-right" || $std["style"] == "border-bottom" || $std["style"] == "border-left") ? '-width' : '' ;
                $saved_one = ( array_key_exists( $name . "_". $std["style"].$test.$selector_type, $saved_values)) ? $saved_values [ $name . "_". $std["style"].$test.$selector_type ] : "";
                switch ($type){
                    case "width" : $temp .= '<span class="element-wrapper"><span class="icon"><i class="icon-resize-horizontal" aria-hidden="true"></i></span>'; break;
                    case "height" : $temp .= '<span class="element-wrapper"><span class="icon"><i class="icon-resize-vertical" aria-hidden="true"></i></span>'; break;
                    case "opacity" : $temp .= '<span class="element-wrapper"><span class="icon"><i class="icon-adjust" aria-hidden="true"></i></span>'; break;
                    case "border" :
                    case "margin" :
                    case "padding": $temp .= '<span class="element-wrapper"><span class="icon"><i class="icon-'.$arrows[$indexer++].'" aria-hidden="true"></i></span>'; break;
                    case "font" : $temp .= '<span class="element-wrapper"><span class="icon"><i class="icon-'.$fonts[$std["style"]].'" aria-hidden="true"></i></span>';break;
                }
                $min_val = ("margin" == $type) ? '-1000' : '0';
                $max_val = ("opacity" == $type) ? '1' : '1000';
                $step_value = ("opacity" == $type) ? '0.01' : '1';
                $temp .= "<input type='number' step='".$step_value."' min='".$min_val."' max='".$max_val."' id='". $name . "_". $std["style"].$test.$selector_type."' name='cf7stylecustom[". $name . "_". $std["style"].$test.$selector_type."]' value='". $saved_one ."' />";
                if( array_key_exists('unit', $std) ) {
                    $temp .= "<select id='". $name . "_". $std["style"] .$test . "_unit".$selector_type."' name='cf7stylecustom[". $name . "_". $std["style"] .$test ."_unit".$selector_type."]'>";
                
                    foreach( $std["unit"] as $unit_val ) {
                        $saved_one_unit =  ( array_key_exists( $name . "_". $std["style"]. "_unit".$selector_type, $saved_values) ) ? $saved_values[ $name . "_". $std["style"]. "_unit".$selector_type ] : "";
                        $temp .= "<option ". selected( $saved_one_unit , $unit_val, false ) . ">". $unit_val ."</option>";
                    }

                    $temp .= "</select>";
                }
                switch ($type){
                    case "width" : 
                    case "height" :
                    case "border" :
                    case "margin" :
                    case "padding":
                    case "opacity": 
                    case "font" : $temp .= '</span>';break;
                }
            }
            $temp .= "</label></li>";
            return $temp;
            break;

        case 'select':
            $fonts = array( 'font-style' => 'italic', 'font-weight' => 'bold', 'text-align' => 'align-center', 'text-decoration' => 'underline', 'text-transform' => 'header'  );
            $temp .= "<li ".$hidden_element."><label for='".$name . "_" . $std["style"].$selector_type."'><strong>".$std["title"].$title_addon.":</strong>";
            switch ($type){
                case "font" : $temp .= '<span class="icon"><i class="icon-'.$fonts[$std["style"]].'" aria-hidden="true"></i></span>';break;
            }
            $temp .= "<select id='". $name . "_" . $std["style"].$selector_type. "' name='cf7stylecustom[". $name . "_" . $std["style"] .$selector_type."]'>";
            $temp .= '<option value="">'.__( "Choose value", 'contact-form-7-style' ).'</option>';
            foreach( $std["property"] as $key => $value ) {
                $saved_one = ( array_key_exists($name . "_". $std["style"].$selector_type, $saved_values) ) ? $saved_values[ $name . "_". $std["style"].$selector_type] : "";
                $temp .= "<option ". selected( $saved_one , $value, false ) . ">". $value ."</option>";
            }
            $temp .= "</select></label></li>";
            return $temp;

            break;

        default:
            
            break;
    }

}

/**
 * Elements
 */

$sameElements = array( "width", "height", "background", "margin", "padding", "font", "border",  "float", "display", "box-sizing" );
$containerElements = array( "width", "height",  "margin", "padding", "font", "border",   "float", "box-sizing" );
$placeholderElements = array( "placefont", "opacity" );
$elements = array(
    'form'  => array(
        'name' => 'form',
        'description' => 'The Contact Form 7 form element\'s design can be modified below:',
        'settings' => array("width", "height", "background", "margin", "padding", "border",  "float", "box-sizing" )
    ),
    'input' => array(
        'name' => 'input',
        'description' => 'This section allows styling of text, email, URL and contact numbers fields.', 
        'settings' => $sameElements
    ),
    'textarea' => array(
        'name' => 'text area',
        'description' => 'This section allows styling the textarea fields.', 
        'settings' => $sameElements
    ),
    "p" => array(
        'name' => 'text',
        'description' => '', 
        'settings' => $containerElements
    ),
    "placeholder" => array(
        'name' => 'placeholder',
        'description' => 'This section allows styling the placholder element of the input fields if present', 
        'settings' => $placeholderElements
    ),
    'label' => array(
        'name' => 'input label',
        'description' => 'This section allows styling the input label.', 
        'settings' => $containerElements
    ),
    'fieldset' => array(
        'name' => 'fieldset',
        'description' => '', 
        'settings' => $containerElements
    ),
    'submit' => array(
        'name' => 'submit button',
        'description' => 'This section allows styling the submit button.', 
        'settings' => $sameElements
    ),
    'select' => array(
        'name' => 'dropdown menu',
        'description' => 'This section allows styling the dropdown menus.', 
        'settings' => $sameElements
    ),
    'checkbox' => array(
        'name' => 'checkboxes',
        'description' => '', 
        'settings' => array( "width", "height" )
    ),
    'radio' => array(
        'name' => 'radio buttons',
        'description' => '', 
        'settings' => array( "width", "height" )
    ),
    'wpcf7-not-valid-tip' => array(
        'name' => 'error messages',
        'description' => 'There is a field that the sender must fill in, this message can be modified below.', 
        'settings' => $sameElements
    ),
    'wpcf7-validation-errors' => array(
        'name' => 'validation errors',
        'description' => 'This section allows styling the error message when the user submits the whole form.', 
        'settings' => $sameElements
    ),
    'wpcf7-mail-sent-ok' => array(
        'name' => 'successfully sent message',
        'description' => 'This section allows styling the message which appears on succesfull submit.', 
        'settings' => $sameElements
    ),
    'acceptance' => array(
        'name' => 'acceptance',
        'description' => '', 
        'settings' => array("comming-soon")
    ),
    'file' => array(
        'name' => 'file',
        'description' => '', 
        'settings' => array("comming-soon")
    ),
    'quiz' => array(
        'name' => 'quiz',
        'description' => '', 
        'settings' => array("comming-soon")
    ),
);

