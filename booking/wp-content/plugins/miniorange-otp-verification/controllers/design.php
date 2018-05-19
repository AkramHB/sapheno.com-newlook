<?php

    $email_templates = maybe_unserialize(get_mo_option('mo_customer_validation_custom_popups'));
    $custom_default_popup = $email_templates[DefaultPopup::$key];
    $custom_external_popup = $email_templates[ExternalPopup::$key];
    $custom_userchoice_popup = $email_templates[UserChoicePopup::$key];
    $error_popup = $email_templates[ErrorPopup::$key];
    $common_template_settings = Template::$templateEditor;
    $nonce = Template::$nonce;

    $editorId 		   = DefaultPopup::$templateEditorID;
    $templateSettings  = array_merge($common_template_settings,array('textarea_name' => $editorId));

    $editorId2         = UserChoicePopup::$templateEditorID;
    $templateSettings2 = array_merge($common_template_settings,array('textarea_name' => $editorId2));

    $editorId3         = ExternalPopup::$templateEditorID;
    $templateSettings3 = array_merge($common_template_settings,array('textarea_name' => $editorId3));

    $editorId4         = ErrorPopup::$templateEditorID;
    $templateSettings4 = array_merge($common_template_settings,array('textarea_name' => $editorId4));

    $default_template_type = DefaultPopup::$key; 
    $userchoice_template_type = UserChoicePopup::$key; 
    $external_template_type = ExternalPopup::$key;
    $error_template_type = ErrorPopup::$key;

    $loaderimgdiv = str_replace("{{CONTENT}}","<img src='".MOV_LOADER_URL."'>",Template::$paneContent);
    $previewpane = "<span style='font-size: 1.3em;'>PREVIEW PANE<br/><br/></span><span>Click on the Preview button above to check how your popup "
                    ."would look like.</span>";
    $previewpane = str_replace("{{MESSAGE}}",$previewpane,Template::$messageDiv);                    
    $message = str_replace("{{CONTENT}}",$previewpane,Template::$paneContent);

    include MOV_DIR . 'views/design.php';