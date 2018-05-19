<?php

/*
 * Title                   : Pinpoint Booking System
 * File                    : application/controllers/user/calendars.php
 * Author                  : Dot on Paper
 * Copyright               : © 2017 Dot on Paper
 * Website                 : https://www.dotonpaper.net
 * Description             : User calendars controller PHP class.
 */

    if (!class_exists('DOTControllerUserCalendars')){
        class DOTControllerUserCalendars{
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
	     * The page.
	     * 
	     * @usage
	     *	    Reserved controller function that will be interpreted by DOT framework.
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
	     *	    framework : hooks->add() // Add a hook.
	     *	    framework : hooks->set() // Set a hook.
	     * 
	     *	    framework : link() // Returns the page's permalink depending on language selected.
	     *	    framework : text() // Returns the translated text.
	     * 
	     * @hooks
	     *	    init (action): The initialization hook present in all controllers [index] function.
	     *	    verify_login (action): A hook present in all controllers [index] function that need authentication to be made available.
	     * 
	     *	    title (filter): Page title that will appear in <head> <title> tag.
	     * 
	     * @layouts
	     *	    -
	     * 
	     * @return
	     *	    Redirect to page PINPOINT.WORLD/user/profile
	     * 
	     * @return_details
	     *	    -
	     * 
	     * @dv
	     *	    section (string): site section
	     * 
	     * @tests
	     *	    -
             */
	    public function index(){
		global $DOT;
		
		echo 'shortcode display';
//		
//		/*
//		 * Initialization
//		 */
//		$DOT->dv['section'] = 'user'; // Set application section.
//		$DOT->hooks->add('title', 'filter', $DOT->text('TITLE')); // Set page title.
//		
//		/*
//		 * Set init hook.
//		 */
//		$DOT->hooks->set('init');
//		
//		/*
//		 * Verify if user is logged in.
//		 */
//		$DOT->hooks->set('verify_login', 'action', $DOT->link('user', true, false));
//		
//		/*
//		 * Redirect to profile page.
//		 */
//		header('Location: '.$DOT->link('user/profile', true, false));
//		exit;
	    }
	    
/*
 * AJAX
 */
	    
            /*
	     * Get calendar data.
	     * 
	     * @usage
	     *	    -
	     * 
             * @params
	     *	    -
	     * 
	     * @post
             *	    DOT_AJAX_VAR (string): AJAX key
	     *	    calendar_id (integer): calendar ID
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
	     *	    DOT_AJAX_VAR (string): AJAX request variable
	     * 
	     * @globals
	     *	    DOT (object): DOT framework main class variable
	     * 
	     * @functions
	     *	    framework : post() // Get a $_POST variable.
	     * 
	     *	    application/models/users/model-user-register.php : activation() // Send activation email.
	     * 
	     * @hooks
	     *	    -
	     * 
	     * @layouts
	     *	    -
	     * 
	     * @return
	     *	    "true" is returned if the email was sent, "false" otherwise.
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
	    public function ajax_data(){
		global $DOT;
		
		if ($DOT->post(DOT_AJAX_VAR)){
		    $calendar_id = $DOT->post('calendar_id', 'int');
		    
		    $data = new stdClass;
		    
		    $data->availability = $DOT->models->availability->get($calendar_id); 
			    
		    echo json_encode($data);
		}
		else{
		    echo 'false';
		}
		
		exit;
	    }
	    
/*
 * Assets
 */	    
	    
	    /*
	     * Add CSS files specific to this page.
	     * 
	     * @usage
	     *	    Reserved controller function that will be interpreted by DOT framework.
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
	     *	    An array with the CSS files.
	     * 
	     * @return_details
	     *	    All files are loaded in page header after the content is loaded.
	     *	    The array will contain up to 3 keys each with its own array:
	     *		beta : The list of CSS files that will appear on development site.
	     *		live : The list of CSS files that will appear on live site.
	     *		page : The list of CSS files which content will appear in page header.
	     * 
	     * @dv
	     *	    -
	     * 
	     * @tests
	     *	    -
             */
	    public function css(){
		return array('beta' => array(),
			     'live' => array(),
			     'page' => array()); 
	    }
	    
	    /*
	     * Add JavaScript files specific to this page.
	     * 
	     * @usage
	     *	    Reserved controller function that will be interpreted by DOT framework.
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
	     *	    DOT (object): DOT framework main class variable.
	     *			   Use [$DOT->paths->url] variable to set the path to files for "beta" or "live" : $DOT->paths->url.'path to file'
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
	     *	    An array with the JavaScript files.
	     * 
	     * @return_details
	     *	    All files are added in page footer.
	     *	    The array will contain up to 3 keys each with its own array:
	     *		beta : The list of JavaScript files that will appear on development site.
	     *		live : The list of JavaScript files that will appear on live site (usually one minified version).
	     *		page : The list of JavaScript files which content will appear in page footer.
	     * 
	     * @dv
	     *	    -
	     * 
	     * @tests
	     *	    -
             */
	    public function js(){
		return array('beta' => array(),
			     'live' => array(),
			     'page' => array());
	    }
	}
    }