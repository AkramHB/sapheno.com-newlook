<?php

//gravityForms
$gf_enabled 		 = get_mo_option('mo_customer_validation_gf_contact_enable') ? "checked" : "";
$gf_hidden 			 = $gf_enabled== "checked" ? "" : "hidden";
$gf_enabled_type 	 = get_mo_option('mo_customer_validation_gf_contact_type');
$gf_field_list 		 = admin_url().'admin.php?page=gf_edit_forms';
$gf_otp_enabled 	 = maybe_unserialize(get_mo_option('mo_customer_validation_gf_otp_enabled'));

$gf_type_email 		 = GravityForm::TYPE_EMAIL;
$gf_type_phone 		 = GravityForm::TYPE_PHONE;

include MOV_DIR . 'views/forms/gravity-forms.php';

function get_gf_form_list($gf_otp_enabled,$disabled,$key)
{
	$keyunter = 0;
	if(!MoUtility::isBlank($gf_otp_enabled))
	{
		foreach ($gf_otp_enabled as $gfkey=>$gf) 
		{
			echo '<div id="gfrow'.$key.'_'.$keyunter.'">
					'.mo_("Form ID").': <input class="field_data" id="gravity_form_'.$key.'_'.$keyunter.'" name="gravity_form['.$key.'][]" type="text" value="'.$gf.'">&nbsp';
			echo '</div>';
			$keyunter+=1;
		}
	}
	else
	{
		echo '<div id="gfrow'.$key.'_0"> 
				'.mo_("Form ID").': <input id="gravity_form_'.$key.'_0" class="field_data"  name="gravity_form['.$key.'][]" type="text" value="">&nbsp';
		echo '</div>';
	}
	$result['counter']	 = $keyunter;
	return $result;
}
