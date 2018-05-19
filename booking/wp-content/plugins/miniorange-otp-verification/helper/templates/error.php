<?php

class ErrorPopup extends Template implements ITemplate
{
	public static $key = "ERROR"; 
	public static $templateEditorID = "customEmailMsgEditor4";

	public function __construct()
	{
		parent::__construct();
		$this->requiredTags =  array_diff($this->requiredTags,array("{{FORM_ID}}","{{REQUIRED_FIELDS}}"));
	}

	public function getTemplateKey() { return self::$key; }

	public function getTemplateEditorId(){ return self::$templateEditorID; }

	public function getDefaults($templates)
	{
		if(!is_array($templates)) $templates = array();

		$templates[self::$key] = file_get_contents(MOV_DIR . 'includes/html/error.min.html');
		return $templates;		
	}

	public function parse($template,$message,$otp_type,$from_both)
	{
		$from_both = $from_both ? 'true' : 'false';
		$requiredscripts = $this->getRequiredFormsSkeleton($otp_type,$from_both);

		$template = str_replace("{{JQUERY}}",$this->jqueryUrl,$template);
		$template = str_replace("{{GO_BACK_ACTION_CALL}}",'mo_validation_goback();',$template);
		$template = str_replace("{{MO_CSS_URL}}",MOV_CSS_URL,$template);
		$template = str_replace("{{REQUIRED_FORMS_SCRIPTS}}",$requiredscripts,$template);
		$template = str_replace("{{HEADER}}",mo_("Validate OTP (One Time Passcode)"),$template);
		$template = str_replace("{{GO_BACK}}",mo_('&larr; Go Back'),$template);
		$template = str_replace("{{MESSAGE}}",mo_($message),$template);
		return $template;
	}

	private function getRequiredFormsSkeleton($otp_type,$from_both)
	{
		$requiredFields = '<form name="f" method="post" action="" id="validation_goBack_form">
			<input id="validation_goBack" name="option" value="validation_goBack" type="hidden"></input>
		</form>{{SCRIPTS}}';		
		$requiredFields = str_replace('{{SCRIPTS}}',$this->getRequiredScripts(),$requiredFields);
		return $requiredFields;
	}

	private function getRequiredScripts()
	{
		$scripts = '<style>.mo_customer_validation-modal{display:block!important}</style>';
        $scripts .= '<script>function mo_validation_goback(){document.getElementById("validation_goBack_form").submit()}</script>';
		return $scripts;
	}
}
new ErrorPopup;