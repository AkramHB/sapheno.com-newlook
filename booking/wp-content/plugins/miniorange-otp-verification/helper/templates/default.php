<?php

class DefaultPopup extends Template implements ITemplate
{
	public static $key = "DEFAULT"; 
	public static $templateEditorID = "customEmailMsgEditor";

	public function __construct()
	{
		parent::__construct();
		$this->requiredTags =  array_merge($this->requiredTags,array("{{OTP_FIELD_NAME}}"));
	}

	public function getTemplateKey() { return self::$key; }

	public function getTemplateEditorId(){ return self::$templateEditorID; }

	public function getDefaults($templates)
	{
		if(!is_array($templates)) $templates = array();

		$templates[self::$key] = file_get_contents(MOV_DIR . 'includes/html/default.min.html');
		return $templates;		
	}

	public function parse($template,$message,$otp_type,$from_both)
	{
		$from_both = $from_both ? 'true' : 'false';
		$requiredscripts = $this->getRequiredFormsSkeleton($otp_type,$from_both);
		$extraPostData = $this->preview ? "" : extra_post_data();
		$extraformfields = $this->getExtraFormFields($otp_type,$from_both);
		$extraformfields .= '<input type="hidden" name="option" value="miniorange-validate-otp-form" />';

		$template = str_replace("{{JQUERY}}",$this->jqueryUrl,$template);
		$template = str_replace("{{FORM_ID}}",'mo_validate_form',$template);
		$template = str_replace("{{GO_BACK_ACTION_CALL}}",'mo_validation_goback();',$template);
		$template = str_replace("{{OTP_MESSAGE_BOX}}",'mo_message',$template);
		$template = str_replace("{{MO_CSS_URL}}",MOV_CSS_URL,$template);
		$template = str_replace("{{REQUIRED_FORMS_SCRIPTS}}",$requiredscripts,$template);
		$template = str_replace("{{HEADER}}",mo_("Validate OTP (One Time Passcode)"),$template);
		$template = str_replace("{{GO_BACK}}",mo_('&larr; Go Back'),$template);
		$template = str_replace("{{MESSAGE}}",mo_($message),$template);
		$template = str_replace("{{OTP_FIELD_NAME}}",'mo_customer_validation_otp_token',$template);
		$template = str_replace("{{OTP_FIELD_TITLE}}",mo_("Only digits within range 4-8 are allowed."),$template);
		$template = str_replace("{{BUTTON_TEXT}}",mo_("Validate OTP"),$template);
		$template = str_replace("{{REQUIRED_FIELDS}}",$extraformfields,$template);
		$template = str_replace("{{LOADER_IMG}}",$this->img,$template);
		$template = str_replace('{{EXTRA_POST_DATA}}',$extraPostData,$template);
		return $template;
	}

	private function getRequiredFormsSkeleton($otp_type,$from_both)
	{
		$requiredFields = '<form name="f" method="post" action="" id="validation_goBack_form">
			<input id="validation_goBack" name="option" value="validation_goBack" type="hidden"></input>
		</form>
		<form name="f" method="post" action="" id="verification_resend_otp_form">
			<input id="verification_resend_otp" name="option" value="verification_resend_otp_'.$otp_type.'" type="hidden"></input>
			<input type="hidden" id="from_both" name="from_both" value="'.$from_both.'"> {{EXTRA_POST_DATA}}
		</form>
		<form name="f" method="post" action="" id="goBack_choice_otp_form">
			<input id="verification_resend_otp" name="option" value="verification_resend_otp_both" type="hidden"></input>
			<input type="hidden" id="from_both" name="from_both" value="true">{{EXTRA_POST_DATA}}</form>
		{{SCRIPTS}}';		
		$requiredFields = str_replace('{{SCRIPTS}}',$this->getRequiredScripts(),$requiredFields);
		return $requiredFields;
	}

	private function getRequiredScripts()
	{
		$scripts = '<style>.mo_customer_validation-modal{display:block!important}</style>';
		if(!$this->preview) {
			$scripts .= '<script>function mo_validation_goback(){
				document.getElementById("validation_goBack_form").submit()}function mo_otp_verification_resend(){
					document.getElementById("verification_resend_otp_form").submit()}function mo_select_goback(){
						document.getElementById("goBack_choice_otp_form").submit()}jQuery(document).ready(function(){
							$mo=jQuery,$mo("#mo_validate_form").submit(function(){$mo(this).hide(),$mo("#mo_message").show()})})</script>';
		} else {
			$scripts .=  '<script>$mo=jQuery,$mo("#mo_validate_form").submit(function(e){e.preventDefault();});</script>';
		}
		return $scripts;
	}

	private function getExtraFormFields($otp_type,$from_both)
	{
		$extraformfields = ' <input type="hidden" name="otp_type" value="'.$otp_type.'">
			<input type="hidden" id="from_both" name="from_both" value="'.$from_both.'">
			<a style="float:right"  onclick="mo_otp_verification_resend();">{{RESEND_OTP}}</a>
			{{EXTRA_POST_DATA}}';
		$extraformfields = str_replace('{{RESEND_OTP}}',mo_("Resend OTP"),$extraformfields);
		return $extraformfields;								
	}
}
new DefaultPopup;