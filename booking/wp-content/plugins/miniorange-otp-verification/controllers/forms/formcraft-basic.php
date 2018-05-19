<?php

//FormCraft Basic form
$formcraft_enabled		  = get_mo_option('mo_customer_validation_formcraft_enable') ? "checked" : "";
$formcraft_hidden		  = $formcraft_enabled== "checked" ? "" : "hidden";
$formcraft_enabled_type   = $formcraft_enabled== "checked" ? get_mo_option('mo_customer_validation_formcraft_enable_type') : "";
$formcraft_list 		  = admin_url().'admin.php?page=formcraft_basic_dashboard';
$formcraft_otp_enabled    = $formcraft_enabled== "checked" ? maybe_unserialize(get_mo_option('mo_customer_validation_formcraft_otp_enabled')) : "";

$formcarft_type_phone 	  = FormCraftBasicForm::TYPE_PHONE;
$formcarft_type_email 	  = FormCraftBasicForm::TYPE_EMAIL;

include MOV_DIR . 'views/forms/formcraft-basic.php';

function get_formcraft_basic_form_list($formcraft_otp_enabled,$disabled,$key)
{
	$keyunter = 0;
	if(!MoUtility::isBlank($formcraft_otp_enabled))
	{
		foreach ($formcraft_otp_enabled as $form_id=>$form) 
		{
			echo '<div id="fc_row'.$key.'_'.$keyunter.'">
					'.mo_( "Form ID").': <input class="field_data" id="formcraft_'.$key.'_'.$keyunter.'" name="formcraft[form][]" type="text" value="'.$form_id.'">&nbsp;';
			echo '<span '.($key==2 ? 'hidden' : '' ).'>&nbsp;'.mo_( "Email Field Label").': <input class="field_data" id="formcraft_email_'.$key.'_'.$keyunter.'" name="formcraft[emailkey][]" type="text" value="'.$form['email_label'].'"></span>';
			echo '<span '.($key==1 ? 'hidden' : '' ).'>'.mo_( "Phone Field Label").': <input class="field_data" id="formcraft_phone_'.$key.'_'.$keyunter.'" name="formcraft[phonekey][]" type="text" value="'.$form['phone_label'].'"></span>';
			echo '<span>&nbsp; '.mo_( "Verification Field Label").': <input class="field_data" id="formcraft_verify_'.$key.'_'.$keyunter.'" name="formcraft[verifyKey][]" type="text" value="'.$form['verify_label'].'"></span>';
			echo '</div>';
			$keyunter+=1;
		}
	}
	else
	{
		echo '<div id="fc_row'.$key.'_0"> 
			'.mo_( "Form ID").': <input id="formcraft_'.$key.'_0" class="field_data"  name="formcraft[form][]" type="text" value="">&nbsp;';
		echo '<span '.($key==2 ? 'hidden' : '' ).'>&nbsp;'.mo_( "Email Field Label").': <input id="formcraft_email_'.$key.'_0" class="field_data" name="formcraft[emailkey][]" type="text" value=""></span>';
		echo '<span '.($key==1 ? 'hidden' : '' ).'>'.mo_( "Phone Field Label").': <input id="formcraft_phone_'.$key.'_0" class="field_data"  name="formcraft[phonekey][]" type="text" value=""></span>';
		echo '<span>&nbsp; '.mo_( "Verification Field Label").': <input class="field_data" id="formcraft_verify_'.$key.'_0" name="formcraft[verifyKey][]" type="text" value=""></span>';
		echo '</div>';
	}
	$result['counter']	 = $keyunter;
	return $result;
}