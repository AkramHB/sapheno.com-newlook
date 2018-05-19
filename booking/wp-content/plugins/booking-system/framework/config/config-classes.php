<?php

/*
 * Title                   : DOT Pinpoint Framework (World)
 * File                    : framework/config/config-classes.php
 * Author                  : Dot on Paper
 * Copyright               : © 2017 Dot on Paper
 * Website                 : https://www.dotonpaper.net
 * Description             : Framework classes config file.
 */

global $dot_classes;

$dot_classes = array(/*
		      * Helper - 1st class to load.
		      */
		     'helper' => (object)array('class' => 'DOTHelper', 
			  		       'file' => 'class-helper'),
		     /*
		      * Prototypes - 2nd class to load.
		      */
		     'prototypes' => (object)array('class' => 'DOTPrototypes', 
						   'file' => 'class-prototypes'),
		     /*
		      * Session - 3rd class to load.
		      */
		     'session' => (object)array('class' => 'DOTSession', 
					        'file' => 'class-session'),
		     /*
		      * Cookie - 4th class to load.
		      */
		     'cookie' => (object)array('class' => 'DOTCookie', 
					       'file' => 'class-cookie'),
		     /*
		      * Hooks - 5th class to load.
		      */
		     'hooks' => (object)array('class' => 'DOTHooks', 
					      'file' => 'class-hooks'),
		     /*
		      * Files - 6th class to load.
		      */
		     'files' => (object)array('class' => 'DOTFiles', 
					      'file' => 'class-files'),
		     /*
		      * Database - 7th class to load.
		      */
		     'db' => (object)array('class' => 'DOTDatabase', 
					   'file' => 'class-database'),
		     /*
		      * Translation - 8th class to load.
		      */
		     'translation' => (object)array('class' => 'DOTTranslation', 
						    'file' => 'class-translation'),
		     /*
		      * Models - 9th class to load.
		      */
		     'models' => (object)array('class' => 'DOTModels', 
					       'file' => 'class-models'),
		     /*
		      * View - 10th class to load.
		      */
		     'view' => (object)array('class' => 'DOTView', 
					     'file' => 'class-view'),
		     /*
		      * Controllers - 11th class to load.
		      */
		     'controllers' => (object)array('class' => 'DOTControllers', 
						    'file' => 'class-controllers'),
		     /*
		      * Controller - 12th class to load.
		      */
		     'controller' => (object)array('class' => 'DOTController', 
						   'file' => 'class-controller'),
		     /*
		      * Email - 13th class to load.
		      */
		     'email' => (object)array('class' => 'DOTEmail', 
					      'file' => 'class-email'));