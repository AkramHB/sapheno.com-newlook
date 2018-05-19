<?php

/*
 * Title                   : DOT Framework
 * File                    : framework/includes/class-translation.php
 * Author                  : Dot on Paper
 * Copyright               : © 2017 Dot on Paper
 * Website                 : https://www.dotonpaper.net
 * Description             : Translation PHP class.
 */

    if (!class_exists('DOTTranslation')){
        class DOTTranslation{
	    /*
	     * Private variables.
	     */
	    private $data = array(); // The data about all translation files.

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
	     * Initialize translation.
	     * 
	     * @usage
	     *	    framework/dot.php : init()
	     * 
             * @params
	     *	    language (string): current language ISO 639-1 code
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
	     *	    framework/includes/class-files.php : scan() // Scan all translation files.
	     *	    framework/dot.php : load() // Load all translation files.
	     *	    
	     * @hooks
	     *	    -
	     * 
	     * @layouts
	     *	    -
	     * 
	     * @return
	     *	    Private variable [data] will be completed with the data about all translation files.
	     * 
	     * @return_details
	     *	    The translation files are created in "application/translation/{language ISO 639-1 code}" folder. Each language has its own {language ISO 639-1 code} folder. (Example: application/translation/en)
	     *	    The file name format will be "text-{name}.php, with lower characters. (Example: application/translation/en/text-shop.php)
	     *	    All translation text is added to a global variable, the array [dot_languages].
	     * 
	     *	    NOTE: The files can have more words, in which case they will be separeted by the "-" character. (Example: application/translation/en/text-{word1}-{word2}-...-{wordN}.php -> application/translation/en/text-shop-cart.php)
	     * 
	     *	    [data] variable description:
	     *		data : array 
	     *		    data[{key}] (string): translation key = {word1}_{word2}_..._{wordN}
	     *		    data[{key}]->file (string): absolute path to translation file
	     * 
	     * @dv
	     *	    -
	     * 
	     * @tests
	     *	    -
             */
	    function init($language = 'en'){
		global $DOT;
		
		/*
		 * Verify if translation folder exists.
		 */
		
		$translation_folder = $DOT->paths->abs.(file_exists($DOT->paths->abs.'application/translation/'.$language.'/') ? 'application/translation/'.$language.'/':'application/translation/en/');
		
		/*
		 * Scan translation in folder "application/translation/{{language ISO 639-1 code}}".
		 */
		$files = $DOT->classes->files->scan($translation_folder);
		
		foreach ($files as $file){
		    /*
		     * Get translation file name.
		     * {word1}-{word2}-...-{wordN}
		     */
		    $file_name = str_replace('.php', '', substr($file, strrpos($file, 'text-')+6));
		    
		    /*
		     * Get translation file name sections.
		     * array(0 => {word1},
		     *	     1 => {word2},
		     *	     ...
		     *	     n-1 => {wordN})	
		     */
		    $sections = explode('-', $file_name);
		    
		    /*
		     * Get translation key.
		     * {word1}_{word2}_..._{wordN}
		     */
		    $key = implode('_', $sections);
		    
		    $this->data[$key] = new stdClass;
		    $this->data[$key]->file = $DOT->paths->abs.'application/translation/'.$language.'/'.$file;
		}
		
		/*
		 * Load translation.
		 */
		$DOT->load('translation',
			   $this->data);
	    }
	}
    }