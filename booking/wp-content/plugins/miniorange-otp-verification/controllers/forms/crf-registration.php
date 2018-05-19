<?php

//crf registration
$crf_enabled 			  = get_mo_option('mo_customer_validation_crf_default_enable') ? "checked" : "";
$crf_hidden  			  = $crf_enabled== "checked" ? "" : "hidden";
$crf_enable_type		  = get_mo_option('mo_customer_validation_crf_enable_type');
$crf_form_list  		  = admin_url().'admin.php?page=rm_form_manage';
$crf_form_otp_enabled     = maybe_unserialize(get_mo_option('mo_customer_validation_crf_otp_enabled'));

$crf_type_phone 		  = RegistrationMagicForm::TYPE_PHONE;
$crf_type_email 		  = RegistrationMagicForm::TYPE_EMAIL;
$crf_type_both  		  = RegistrationMagicForm::TYPE_BOTH;

include MOV_DIR .'views/forms/crf-registration.php';

function get_crf_form_list($crf_form_otp_enabled,$disabled,$key)
{
	$keyunter = 0;
	if(!MoUtility::isBlank($crf_form_otp_enabled))
	{
		foreach ($crf_form_otp_enabled as $form_id=>$crf_form) 
		{
			echo '<div id="crfrow'.$key.'_'.$keyunter.'">
					'.mo_("Form ID").': <input class="field_data" id="crf_form_'.$key.'_'.$keyunter.'" name="crf_form[form][]" type="text" value="'.$form_id.'">&nbsp;';
			echo '<span '.($key==2 ? 'hidden' : '' ).'> '.mo_("Email Field Label").': <input class="field_data" id="crf_form_email_'.$key.'_'.$keyunter.'" name="crf_form[emailkey][]" type="text" value="'.$crf_form['emailkey'].'"></span>';
			echo '<span '.($key==1 ? 'hidden' : '' ).'> '.mo_("Phone Field Label").': <input class="field_data" id="crf_form_phone_'.$key.'_'.$keyunter.'" name="crf_form[phonekey][]" type="text" value="'.$crf_form['phonekey'].'"></span>';
			echo '</div>';
			$keyunter+=1;
		}
	}
	else
	{
		echo '<div id="crfrow'.$key.'_0"> 
					'.mo_("Form ID").': <input id="crf_form_'.$key.'_0" class="field_data"  name="crf_form[form][]" type="text" value="">&nbsp;';
		echo '<span '.($key==2 ? 'hidden' : '' ).'> '.mo_("Email Field Label").': <input id="crf_form_email_'.$key.'_0" class="field_data" name="crf_form[emailkey][]" type="text" value=""></span>';
		echo '<span '.($key==1 ? 'hidden' : '' ).'> '.mo_("Phone Field Label").': <input id="crf_form_phone_'.$key.'_0" class="field_data"  name="crf_form[phonekey][]" type="text" value=""></span>';
		echo '</div>';
	}
	$result['counter']	 = $keyunter;
	return $result;
}