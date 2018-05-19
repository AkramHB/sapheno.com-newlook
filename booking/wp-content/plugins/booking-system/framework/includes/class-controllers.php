<?php

/*
 * Title                   : DOT Framework
 * File                    : framework/includes/class-controller.php
 * Author                  : Dot on Paper
 * Copyright               : © 2017 Dot on Paper
 * Website                 : https://www.dotonpaper.net
 * Description             : Controller PHP class.
 */

    if (!class_exists('DOTControllers')){
        class DOTControllers{
	    /*
	     * Private variables.
	     */
	    private $data = array(); // The data of all controller type classes.

            /*
             * Constructor
	     * 
	     * @usage
	     *	    The constructor is called when a class instance is created.
	     * 
             * @params
	     *	    -
	     * 
	     * @post
	     *	    -
	     * 
	     * @get
	     *	    -
	     * 
	     * @sessions
	     *	    -
	     * 
	     * @cookies
	     *	    -
	     * 
	     * @constants
	     *	    -
	     * 
	     * @globals
	     *	    -
	     * 
	     * @functions
	     *	    -
	     *	    
	     * @hooks
	     *	    -
	     * 
	     * @layouts
	     *	    -
	     * 
	     * @return
	     *	    -
	     * 
	     * @return_details
	     *	    -
	     * 
	     * @dv
	     *	    -
	     * 
	     * @tests
	     *	    -
             */
            function __construct(){
            }
	    
	    /*
	     * Initialize controllers.
	     * 
	     * @usage
	     *	    framework/dot.php : init()
	     * 
             * @params
	     *	    -
	     * 
	     * @post
	     *	    -
	     * 
	     * @get
	     *	    -
	     * 
	     * @sessions
	     *	    -
	     * 
	     * @cookies
	     *	    -
	     * 
	     * @constants
	     *	    -
	     * 
	     * @globals
	     *	    DOT (object): DOT framework main class variable
	     * 
	     * @functions
	     *	    framework/includes/class-files.php : scan() // Scan all controller type files.
	     *	    framework/dot.php : load() // Load all controller type files and initialize them.
	     * 
	     *	    this : set() // Parse the controllers to get AJAX functions and permalinks.
	     *	    
	     * @hooks
	     *	    -
	     * 
	     * @layouts
	     *	    -
	     * 
	     * @return
	     *	    Private variable [data] will be completed with the data about all controller type classes.
	     * 
	     * @return_details
	     *	    The controllers are created in "application/controllers" folder.
	     *	    The structure of the "application/controllers" folder is the same as the sitemap: aplication/controllers/{folder}/{file}.php -> https://{domain}/{folder}/{file}. (Example: aplication/controllers/shop/cart.php -> https://{domain}/shop/cart)
	     *	    The file name will be default page link's last section: https://{domain}/{section1}/{file} -> {file}.php. (Example: https://{domain}/shop/cart -> cart.php)
	     *	    If you have a section in your site with more pages the controller file for that section's page will be named like the folder: https://{domain}/{section}/ -> aplication/controllers/{section}/{section}.php. (Example: https://{domain}/shop -> aplication/controllers/shop/shop.php)
	     *	    The controller class name will be DOTController{Folder1}{Folder2}...{FolderN}{File}, first character of each folder & file being an uppercase. (Example: DOTControllerShopCart)
	     *	    
	     *	    NOTE: The folders & files can have more words, in which case they will be separeted by the "-" character. (Example: application/controllers/shop/mobile-apps/display-app.php -> https://{domain}/shop/mobile-apps/display-app)
	     * 
	     *	    [data] variable description:
	     *		data : array 
	     *		    data[{key}] (string): model key = {folder1}_{folder2}_..._{folderN}_{file} // If a file has a "-" character, it is replaced with a "_" character.
	     *		    data[{key}]->class (string): the controller class name
	     *		    data[{key}]->file (string): absolute path to controller file
	     *		    data[{key}]->permalink (string): the controller permalink
	     * 
	     * @dv
	     *	    -
	     * 
	     * @tests
	     *	    -
             */
	    function init(){
		global $DOT;
		
		/*
		 * Scan controllers in folder "application/controllers".
		 */
		$files = $DOT->classes->files->scan($DOT->paths->abs.'application/controllers/');
		
		/*
		 * Go through all files and set data.
		 */
		foreach ($files as $file){
		    /*
		     * Get controller default permalink.
		     * {folder1}/{folder2}/.../{folderN}/{file}
		     */
		    $permalink = str_replace('.php', '', $file);
		    
		    /*
		     * Clean permalink if the last folder's name is the same as file name.
		     * {folder1}/{folder2}/.../{folderN-name-like-file}/{file} -> {folder1}/{folder2}/.../{folderN-name-like-file}
		     */
		    $sections_permalink = explode('/', $permalink);
		    $sections_permalink_no = count($sections_permalink);
		    isset($sections_permalink[$sections_permalink_no-2]) && $sections_permalink[$sections_permalink_no-1] == $sections_permalink[$sections_permalink_no-2] ? array_pop($sections_permalink):'';
		    $permalink = implode('/', $sections_permalink);

		    /*
		     * Get controller class name.
		     * DOTController{Folder1}{Folder2}...{FolderN}{File}
		     */
		    $sections_class = explode('/', str_replace('-', '/', $permalink));
		    $sections_class_no = count($sections_permalink);
		    isset($sections_class[$sections_class_no-2]) && $sections_class[$sections_class_no-1] == $sections_class[$sections_class_no-2] ? array_pop($sections_class):'';
		    $class = 'DOTController'.str_replace(' ', '', ucwords(implode(' ', $sections_class)));
		    
		    /*
		     * Get controller key.
		     * {folder1}_{folder2}_..._{folderN}_{file}
		     */
		    $key = implode('_', $sections_class);
		    
		    $this->data[$key] = new stdClass;
		    $this->data[$key]->class = $class;
		    $this->data[$key]->file = $DOT->paths->abs.'application/controllers/'.$file;
		    $this->data[$key]->permalink = $permalink;
		}
		
		/*
		 * Load controllers.
		 */
		$DOT->load('controllers',
			   $this->data);
		
		/*
		 * Set controllers data.
		 */
		$this->set();
	    }
	    
	    /*
	     * Set the controllers AJAX functions and permalinks.
	     * 
	     * @usage
	     *	    this : init()
	     * 
             * @params
	     *	    -
	     * 
	     * @post
	     *	    -
	     * 
	     * @get
	     *	    -
	     * 
	     * @sessions
	     *	    -
	     * 
	     * @cookies
	     *	    -
	     * 
	     * @constants
	     *	    -
	     * 
	     * @globals
	     *	    DOT (object): DOT framework main class variable
	     * 
	     * @functions
	     *	    framework/includes/class-permalink.php : set() // Set permalink data to know what controller to access.
	     *	    
	     * @hooks
	     *	    -
	     * 
	     * @layouts
	     *	    -
	     * 
	     * @return
	     *	    Variables [DOTP->ajax] & [DOTP->permalink] will be completed with the data grabbed from all controller type classes.
	     * 
	     * @return_details
	     *	    For more details about variables [DOTP->ajax] & [DOTP->permalink] variables view framework/dot.php : __construct() description.
	     *	    When you create an AJAX function in a controller add "ajax_" in front of it.
	     *	    The name of the AJAX function should contain only lower characters and the words should be separated by "_" character. (Example: ajax_{function}_{name})
	     *	    The variable [DOTP->permalink] is translated and set depending on the language.
	     * 
	     * @dv
	     *	    -
	     * 
	     * @tests
	     *	    -
             */
	    public function set(){
		global $DOT;
		
		foreach ($DOT->controllers as $key => $controller){
		    /*
		     * Get AJAX functions.
		     */
		    $methods = get_class_methods($controller);
		    
		    foreach ($methods as $method){
			if (strpos($method, 'ajax_') !== false){
			    /*
			     * Get AJAX key. Is preceded by controller key.
			     * ajax_functionName -> {controller_key}_function_name
			     */
			    $method_name = explode('ajax_', $method);
			    $method_sections = preg_split('/(?=[A-Z])/', $method_name[1]);
			    $key_ajax = $key.'_'.implode('_', array_map('strtolower', $method_sections));
			    
			    $DOT->ajax->$key_ajax = new stdClass; 
			    $DOT->ajax->$key_ajax->controller = $this->data[$key]->class;
			    $DOT->ajax->$key_ajax->method = $method;
			}
		    }
		    
		    /*
		     * Get permalinks from method "permalinks" in each controller..
		     */
//		    $DOT->permalink->routes[str_replace('/', '_', $this->data[$key]->permalink)] = $this->data[$key]->permalink;
//				
//		    if (method_exists($controller, 'permalinks')){
//			$DOT->permalink->translation[$this->data[$key]->permalink] = $DOT->controllers->$key->permalinks();
//			
//			foreach ($DOT->permalink->translation[$this->data[$key]->permalink] as $route){
//			    $DOT->permalink->routes[str_replace('/', '_', $route)] = $this->data[$key]->permalink;
//			}
//			$DOT->permalink->translation[$this->data[$key]->permalink]['en'] = $this->data[$key]->permalink;
//		    }
		}
		
		/*
		 * Set AJAX requests.
		 */
//                    add_action('admin_menu', array(&$this, 'admin'));
//		$this->admin();
		$this->ajax();
//		$DOT->classes->permalink->set();
	    }
	    
	    function admin(){
		global $DOPBSP;
                /*
                 * Set role action for current user.
                 */
                $user_roles = array_values(wp_get_current_user()->roles);
                
                switch ($user_roles[0]){
                    case 'administrator':
                        $DOPBSP->vars->role_action = 'manage_options';
                        break;
                    case 'author':
                        $DOPBSP->vars->role_action = 'publish_posts';
                        break;
                    case 'contributor':
                        $DOPBSP->vars->role_action = 'edit_posts';
                        break;
                    case 'editor':
                        $DOPBSP->vars->role_action = 'edit_pages';
                        break;
                    case 'subscriber':
                        $DOPBSP->vars->role_action = 'read';
                        break;
                    default:
                        $DOPBSP->vars->role_action = $user_roles[0];
                        break;
                }
                
                if (!isset($DOPBSP->classes->backend_settings_users)){
                    return false;
                }
                
                if (!$DOPBSP->classes->backend_settings_users->permission(wp_get_current_user()->ID, 'use-booking-system')
                        && !$DOPBSP->classes->backend_settings_users->permission(wp_get_current_user()->ID, 'use-calendars')){
                    return false;
                }

                /*
                 * Set back end menu.
                 */
                if (function_exists('add_options_page')){
                    add_menu_page($DOPBSP->text('TITLE'), $DOPBSP->text('TITLE'), $DOPBSP->vars->role_action, DOT_ID, array(&$DOPBSP->classes->backend_dashboard, 'view'), 'div');
                    add_submenu_page(DOT_ID, $DOPBSP->text('DASHBOARD_TITLE'), $DOPBSP->text('DASHBOARD_TITLE'), $DOPBSP->vars->role_action, DOT_ID, array(&$DOPBSP->classes->backend_dashboard, 'view'));
//                    add_submenu_page(DOT_ID, $this->text('CALENDARS_TITLE'), $this->text('CALENDARS_TITLE'), $this->vars->role_action, 'dopbsp-calendars', array(&$this->classes->backend_calendars, 'view'));
//                    add_submenu_page(DOT_ID, $this->text('LOCATIONS_TITLE'), $this->text('LOCATIONS_TITLE'), $this->vars->role_action, 'dopbsp-locations', array(&$this->classes->backend_locations, 'view'));
//                    add_submenu_page(DOT_ID, $this->text('SEARCHES_TITLE'), $this->text('SEARCHES_TITLE'), $this->vars->role_action, 'dopbsp-search', array(&$this->classes->backend_searches, 'view'));
//                    add_submenu_page(DOT_ID, $this->text('RESERVATIONS_TITLE'), $this->text('RESERVATIONS_TITLE'), $this->vars->role_action, 'dopbsp-reservations', array(&$this->classes->backend_reservations, 'view'));
//                        DOPBSP_DEVELOPMENT_MODE ? add_submenu_page('dopbsp', $this->text('REVIEWS_TITLE').$this->text('SOON'), $this->text('REVIEWS_TITLE').$this->text('SOON'), $this->vars->role_action, 'dopbsp-reviews', array(&$this->classes->backend_reviews, 'view')):'';
//                    add_submenu_page('dopbsp', $this->text('RULES_TITLE'), $this->text('RULES_TITLE'), $this->vars->role_action, 'dopbsp-rules', array(&$this->classes->backend_rules, 'view'));
//                    add_submenu_page('dopbsp', $this->text('EXTRAS_TITLE'), $this->text('EXTRAS_TITLE'), $this->vars->role_action, 'dopbsp-extras', array(&$this->classes->backend_extras, 'view'));
//                        DOPBSP_DEVELOPMENT_MODE ? add_submenu_page('dopbsp', $this->text('AMENITIES_TITLE').$this->text('SOON'), $this->text('AMENITIES_TITLE').$this->text('SOON'), $this->vars->role_action, 'dopbsp-amenities', array(&$this->classes->backend_amenities, 'view')):'';
//                    add_submenu_page('dopbsp', $this->text('DISCOUNTS_TITLE'), $this->text('DISCOUNTS_TITLE'), $this->vars->role_action, 'dopbsp-discounts', array(&$this->classes->backend_discounts, 'view'));
//                    add_submenu_page('dopbsp', $this->text('FEES_TITLE'), $this->text('FEES_TITLE'), $this->vars->role_action, 'dopbsp-fees', array(&$this->classes->backend_fees, 'view'));
//                    add_submenu_page('dopbsp', $this->text('COUPONS_TITLE'), $this->text('COUPONS_TITLE'), $this->vars->role_action, 'dopbsp-coupons', array(&$this->classes->backend_coupons, 'view'));
//                    add_submenu_page('dopbsp', $this->text('FORMS_TITLE'), $this->text('FORMS_TITLE'), $this->vars->role_action, 'dopbsp-forms', array(&$this->classes->backend_forms, 'view'));
//                        DOPBSP_DEVELOPMENT_MODE ? add_submenu_page('dopbsp', $this->text('TEMPLATES_TITLE').$this->text('SOON'), $this->text('TEMPLATES_TITLE').$this->text('SOON'), $this->vars->role_action, 'dopbsp-templates', array(&$this->classes->backend_templates, 'view')):'';
//                    add_submenu_page('dopbsp', $this->text('EMAILS_TITLE'), $this->text('EMAILS_TITLE'), $this->vars->role_action, 'dopbsp-emails', array(&$this->classes->backend_emails, 'view'));
//                    add_submenu_page('dopbsp', $this->text('TRANSLATION_TITLE', 'Translation'), $this->text('TRANSLATION_TITLE', 'Translation'), 'manage_options', 'dopbsp-translation', array(&$this->classes->translation, 'view'));
//		        DOPBSP_DEVELOPMENT_MODE ? add_submenu_page('dopbsp', $this->text('MODELS_TITLE'), $this->text('MODELS_TITLE'), 'manage_options', 'dopbsp-models', array(&$this->classes->backend_models, 'view')):'';
//                    add_submenu_page('dopbsp', $this->text('SETTINGS_TITLE'), $this->text('SETTINGS_TITLE'), 'manage_options', 'dopbsp-settings', array(&$this->classes->backend_settings, 'view'));
//                    add_submenu_page('dopbsp', $this->text('TOOLS_TITLE', 'Tools'), $this->text('TOOLS_TITLE', 'Tools'), 'manage_options', 'dopbsp-tools', array(&$this->classes->backend_tools, 'view'));
//                    DOPBSP_CONFIG_VIEW_ADDONS ? add_submenu_page('dopbsp', $this->text('ADDONS_TITLE'), $this->text('ADDONS_TITLE'), 'manage_options', 'dopbsp-addons', array(&$this->classes->backend_addons, 'view')):'';
//                    DOPBSP_CONFIG_VIEW_THEMES ? add_submenu_page('dopbsp', $this->text('THEMES_TITLE'), $this->text('THEMES_TITLE'), 'manage_options', 'dopbsp-themes', array(&$this->classes->backend_themes, 'view')):'';
                }
	    }
	    
	    /*
	     * Set AJAX keys.
	     * 
	     * @usage
	     *	    this : set()
	     * 
             * @params
	     *	    -
	     * 
	     * @post
	     *	    -
	     * 
	     * @get
	     *	    -
	     * 
	     * @sessions
	     *	    -
	     * 
	     * @cookies
	     *	    -
	     * 
	     * @constants
	     *	    -
	     * 
	     * @globals
	     *	    DOT (object): DOT framework main class variable
	     * 
	     * @functions
	     *	    -
	     *	    
	     * @hooks
	     *	    -
	     * 
	     * @layouts
	     *	    -
	     * 
	     * @return
	     *	    -
	     * 
	     * @return_details
	     *	    -
	     * 
	     * @dv
	     *	    -
	     * 
	     * @tests
	     *	    -
             */
	    public function ajax(){
		global $DOT;
		
		foreach ($DOT->ajax as $key => $function){
		    add_action('wp_ajax_'.DOT_ID.'_'.$key, array(&$function->controller, $function->method));
		    add_action('wp_ajax_nopriv_'.DOT_ID.'_'.$key, array(&$function->controller, $function->method));
		}
	    }
	}
    }