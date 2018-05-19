<?php

$is_wpform_enabled                =     get_mo_option('mo_customer_validation_wpform_enable')  ? "checked" : "";
$is_wpform_hidden		    	  =     $is_wpform_enabled== "checked" ? "" : "hidden";
$wpform_enabled_type  			  =		$is_wpform_enabled== "checked" ? get_mo_option('mo_customer_validation_wpform_enable_type') : "";
$wpform_list_of_forms_otp_enabled = 	$is_wpform_enabled==  "checked" ? maybe_unserialize(get_mo_option('mo_customer_validation_wpform_forms')): "";
$wpform_form_list				  = 	admin_url().'admin.php?page=wpforms-overview';
$button_text 					  = 	get_mo_option('mo_customer_validation_wpforms_button_text');
$button_text 					  = 	!MoUtility::isBlank($button_text) ? $button_text :  mo_("Click Here to send OTP");
$wpform_phone_type 		          =     WPFormsPlugin::TYPE_PHONE;
$wpform_email_type 		          =     WPFormsPlugin::TYPE_EMAIL;

include MOV_DIR . 'views/forms/wpforms.php';

function get_wpform_list($wpform_list_of_forms_otp_enabled,$disabled,$key)
{
	$keyunter = 0;
	if(!MoUtility::isBlank($wpform_list_of_forms_otp_enabled))
	{	
		foreach ($wpform_list_of_forms_otp_enabled as $form_id=>$wpform) 
		{	
			echo '<div id="ajax_row_wpform'.$key.'_'.$keyunter.'">
					'.mo_("Form ID").': <input class="field_data" id="wp_form_'.$key.'_'.$keyunter.'" name="wpform[form][]" 
                        type="text" value="'.$form_id.'">&nbsp;';
            echo '<span '.($key==2 ? 'hidden' : '' ).'>&nbsp;'.mo_("Email Field Label").': <input class="field_data" 
                id="wp_form_email_'.$key.'_'.$keyunter.'" name="wpform[emailLabel][]" type="text" value="'.$wpform['emailLabel'].'"></span>';
            echo '<span '.($key==1 ? 'hidden' : '' ).'>'.mo_("Phone Field Label").': <input class="field_data" 
				id="wp_form_phone_'.$key.'_'.$keyunter.'" name="wpform[phoneLabel][]" type="text" value="'.$wpform['phoneLabel'].'"></span>';
			echo '<span>'.mo_("Verification Field Label").': <input class="field_data" 
                id="wp_form_verify_'.$key.'_'.$keyunter.'" name="wpform[verifyLabel][]" type="text" value="'.$wpform['verifyLabel'].'"></span>';
			echo '</div>';
			$keyunter+=1;
		}
	}
	else
	{
		echo '<div id="ajax_row_wpform'.$key.'_0"> 
			'.mo_("Form ID").': <input id="wp_form_'.$key.'_0" class="field_data"  name="wpform[form][]" type="text" value="">&nbsp;';
        echo '<span '.($key==2 ? 'hidden' : '' ).'>&nbsp;'.mo_("Email Field Label").': <input id="wp_form_email_'.$key.'_0" class="field_data" 
                name="wpform[emailLabel][]" type="text" value=""></span>';
        echo '<span '.($key==1 ? 'hidden' : '' ).'>'.mo_("Phone Field Label").': <input id="wp_form_phone_'.$key.'_0" class="field_data" 
				name="wpform[phoneLabel][]" type="text" value=""></span>&nbsp;';
		echo '<span>'.mo_("Verification Field Label").': <input id="wp_form_verify_'.$key.'_0" class="field_data" name="wpform[verifyLabel][]" 
				type="text" value=""></span>';
		echo '</div>';
	}
	$result['counter']	 = $keyunter;
	return $result;
}