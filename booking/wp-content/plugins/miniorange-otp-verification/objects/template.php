<?php

    class Template
    {
        protected $preview              = FALSE;
        protected $jqueryUrl            = '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>';
        protected $img                  = "<div style='display:table;text-align:center;'><img src='{{LOADER_CSV}}'></div>";
        protected $errorPopup           = FALSE;

        protected $requiredTags         = array("{{JQUERY}}","{{GO_BACK_ACTION_CALL}}","{{FORM_ID}}","{{REQUIRED_FIELDS}}","{{REQUIRED_FORMS_SCRIPTS}}");        

        public static $nonce            = 'mo_popup_options';

        public static $paneContent      = "<div style='text-align: center;width: 480px;height: 420px;display: table-cell;vertical-align: middle;'>{{CONTENT}}</div>";

        public static $messageDiv       = "<div style='font-style: italic;font-weight: 600;color: #23282d;font-family:Segoe UI,Helvetica Neue,sans-serif;color:#942828;'>{{MESSAGE}}</div>";

        public static $successMessageDiv= "<div style='font-style: italic;font-weight: 600;color: #23282d;font-family:Segoe UI,Helvetica Neue,sans-serif;color:#138a3d;'>{{MESSAGE}}</div>";

        public static $templateEditor   = array(
                                            'wpautop' => false, 'media_buttons' => false, 'textarea_rows' => 20, 'tabindex' => '',
                                            'tabfocus_elements' => ':prev,:next', 'editor_css' => '', 'editor_class' => '', 'teeny' => false, 'dfw' => false,
                                            'tinymce' => false, 'quicktags' => true
                                        ); 

        public function __construct()
        {
            $this->img = str_replace("{{LOADER_CSV}}",MOV_LOADER_URL,$this->img);
            add_filter( 'mo_template_defaults', array($this,'getDefaults'), 1,1);
            add_filter( 'mo_template_build', array($this,'build'), 1,5);
            add_action( 'admin_post_mo_preview_popup', array($this,'showPreview'));
            add_action( 'admin_post_nopriv_mo_preview_popup', array($this,'showPreview'));
            add_action( 'admin_post_mo_popup_save', array($this,'savePopup'));
            add_action( 'admin_post_nopriv_mo_popup_save', array($this,'savePopup'));
            //add_action( 'admin_post_mo_popup_reset', array($this,'resetPopup'));
            //add_action( 'admin_post_nopriv_mo_popup_reset', array($this,'resetPopup'));
        }                                        

        public function showPreview()
        {
            if(array_key_exists('popuptype',$_POST) && $_POST['popuptype']!=$this->getTemplateKey()) return;
            $message = "<i>" . mo_("PopUp Message shows up here.") . "</i>";
            $otp_type = 'test';
            $from_both = false;
            $template = stripslashes($_POST[$this->getTemplateEditorId()]);
            $this->preview = TRUE;
            header("X-XSS-Protection: 0");
            echo $this->parse($template,$message,$otp_type,$from_both);
            exit;
        }

        public function savePopup()
        {
            if(!$this->isTemplateType() || !$this->isValidRequest()) return;    
            $template = stripslashes($_POST[$this->getTemplateEditorId()]);
            $this->validateRequiredFields($template);
            $email_templates = maybe_unserialize(get_mo_option('mo_customer_validation_custom_popups'));
            $email_templates[$this->getTemplateKey()] = $template;
            update_mo_option('mo_customer_validation_custom_popups',$email_templates);
            $this->showSuccessMessage(MoMessages::showMessage('TEMPLATE_SAVED'));
        }

        public function build($template,$templateType,$message,$otp_type,$from_both)
        {
            if(strcasecmp($templateType,$this->getTemplateKey())!=0) return $template;
            $email_templates = maybe_unserialize(get_mo_option('mo_customer_validation_custom_popups'));
            $template = $email_templates[$this->getTemplateKey()];
            return $this->parse($template,$message,$otp_type,$from_both);
        }

        protected function isValidRequest()
        {
            return ( !current_user_can( 'manage_options' ) || !MoUtility::micr()
            || !check_admin_referer( self::$nonce )) ? FALSE : TRUE;
        }

        protected function validateRequiredFields($template)
        {
           foreach($this->requiredTags as $tag) {
                if (strpos($template, $tag) === FALSE) {
                    $message = str_replace("{{MESSAGE}}",MoMessages::showMessage('REQUIRED_TAGS',array('TAG'=>$tag)),self::$messageDiv);
                    echo str_replace("{{CONTENT}}",$message,self::$paneContent);
                    exit;
                }
           }
        }

        protected function showSuccessMessage($message)
        {
            $message = str_replace("{{MESSAGE}}",$message,self::$successMessageDiv);
            echo str_replace("{{CONTENT}}",$message,self::$paneContent);
            exit;
        }

        protected function showMessage($message)
        {
            $message = str_replace("{{MESSAGE}}",$message,self::$messageDiv);
            echo str_replace("{{CONTENT}}",$message,self::$paneContent);
            exit;
        }

        protected function isTemplateType()
        {
            return array_key_exists('popuptype',$_POST) && strcasecmp($_POST['popuptype'],$this->getTemplateKey())==0 ? TRUE : FALSE;
        }
    }