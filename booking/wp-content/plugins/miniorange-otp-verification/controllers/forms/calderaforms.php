<?php

$is_caldera_enabled               = get_mo_option('mo_customer_validation_caldera_enable')  ? "checked" : "";
$is_caldera_hidden		    	  = $is_caldera_enabled== "checked" ? "" : "hidden";
$caldera_enabled_type  			  = $is_caldera_enabled== "checked" ? get_mo_option('mo_customer_validation_caldera_enable_type') : "";
$caldera_list_of_forms_otp_enabled= $is_caldera_enabled== "checked" ? maybe_unserialize(get_mo_option('mo_customer_validation_caldera_forms')): "";
$caldera_form_list				  = admin_url().'admin.php?page=caldera-forms';
$button_text 					  = get_mo_option('mo_customer_validation_caldera_button_text');
$button_text 					  = !MoUtility::isBlank($button_text) ? $button_text :  mo_("Click Here to send OTP");
$caldera_phone_type 		      = CalderaForms::TYPE_PHONE;
$caldera_email_type 		      = CalderaForms::TYPE_EMAIL;

include MOV_DIR . 'views/forms/calderaforms.php';

function get_caldera_list($caldera_list_of_forms_otp_enabled,$disabled,$key)
{
	$keyunter = 0;
	if(!MoUtility::isBlank($caldera_list_of_forms_otp_enabled))
	{	
		foreach ($caldera_list_of_forms_otp_enabled as $form_id=>$caldera) 
		{	
			echo '<div id="ajax_row_caldera'.$key.'_'.$keyunter.'">
					'.mo_("Form ID").': <input class="field_data" id="wp_form_'.$key.'_'.$keyunter.'" name="caldera[form][]" 
                        type="text" value="'.$form_id.'">&nbsp;';
            echo '<span '.($key==2 ? 'hidden' : '' ).'>&nbsp;'.mo_("Email Field ID").': <input class="field_data" 
                id="wp_form_email_'.$key.'_'.$keyunter.'" name="caldera[emailkey][]" type="text" value="'.$caldera['emailkey'].'"></span>';
            echo '<span '.($key==1 ? 'hidden' : '' ).'>'.mo_("Phone Field ID").': <input class="field_data" 
				id="wp_form_phone_'.$key.'_'.$keyunter.'" name="caldera[phonekey][]" type="text" value="'.$caldera['phonekey'].'"></span>';
			echo '<span>'.mo_("Verification Field ID").': <input class="field_data" 
                id="wp_form_verify_'.$key.'_'.$keyunter.'" name="caldera[verifyKey][]" type="text" value="'.$caldera['verifyKey'].'"></span>';
			echo '</div>';
			$keyunter+=1;
		}
	}
	else
	{
		echo '<div id="ajax_row_caldera'.$key.'_0"> 
			'.mo_("Form ID").': <input id="wp_form_'.$key.'_0" class="field_data"  name="caldera[form][]" type="text" value="">&nbsp;';
        echo '<span '.($key==2 ? 'hidden' : '' ).'>&nbsp;'.mo_("Email Field ID").': <input id="wp_form_email_'.$key.'_0" class="field_data" 
                name="caldera[emailkey][]" type="text" value=""></span>';
        echo '<span '.($key==1 ? 'hidden' : '' ).'>'.mo_("Phone Field ID").': <input id="wp_form_phone_'.$key.'_0" class="field_data" 
				name="caldera[phonekey][]" type="text" value=""></span>&nbsp;';
		echo '<span>'.mo_("Verification Field ID").': <input id="wp_form_verify_'.$key.'_0" class="field_data" name="caldera[verifyKey][]" 
				type="text" value=""></span>';
		echo '</div>';
	}
	$result['counter']	 = $keyunter;
	return $result;
}