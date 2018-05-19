<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin
* Version                 : 2.1.8
* File                    : includes/translation/class-translation-models.php
* File Version            : 1.0
* Created / Last Modified : 14 March 2016
* Author                  : Dot on Paper
* Copyright               : © 2016 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Models translation text PHP class.
*/

    if (!class_exists('DOPBSPTranslationTextModels')){
        class DOPBSPTranslationTextModels{
            /*
             * Constructor
             */
            function __construct(){
                /*
                 * Initialize models text.
                 */
                add_filter('dopbsp_filter_translation_text', array(&$this, 'models'));
                
                add_filter('dopbsp_filter_translation_text', array(&$this, 'modelsModel'));
                add_filter('dopbsp_filter_translation_text', array(&$this, 'modelsAddModel'));
                add_filter('dopbsp_filter_translation_text', array(&$this, 'modelsDeleteModel'));
                
                add_filter('dopbsp_filter_translation_text', array(&$this, 'modelsHelp'));
            }
            
            /*
             * Models text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function models($text){
                array_push($text, array('key' => 'PARENT_MODELS',
                                        'parent' => '',
                                        'text' => 'Business models'));
                
                array_push($text, array('key' => 'MODELS_TITLE',
                                        'parent' => 'PARENT_MODELS',
                                        'text' => 'Business models'));
                array_push($text, array('key' => 'MODELS_CREATED_BY',
                                        'parent' => 'PARENT_MODELS',
                                        'text' => 'Created by'));
                array_push($text, array('key' => 'MODELS_LOAD_SUCCESS',
                                        'parent' => 'PARENT_MODELS',
                                        'text' => 'Business models list loaded.'));
                array_push($text, array('key' => 'MODELS_NO_MODELS',
                                        'parent' => 'PARENT_MODELS',
                                        'text' => 'No business models. Click the above "plus" icon to add a new one.'));
                
                return $text;
            }
            
            /*
             * Models - Model text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function modelsModel($text){
                array_push($text, array('key' => 'PARENT_MODELS_MODEL',
                                        'parent' => '',
                                        'text' => 'Business models - Model'));
                
                array_push($text, array('key' => 'MODELS_MODEL_NAME',
                                        'parent' => 'PARENT_MODELS_MODEL',
                                        'text' => 'Name'));
                array_push($text, array('key' => 'MODELS_MODEL_LANGUAGE',
                                        'parent' => 'PARENT_MODELS_MODEL',
                                        'text' => 'Language'));
                
                array_push($text, array('key' => 'MODELS_MODEL_ENABLED',
                                        'parent' => 'PARENT_MODELS_MODEL',
                                        'text' => 'Use this business model'));
                array_push($text, array('key' => 'MODELS_MODEL_LABEL',
                                        'parent' => 'PARENT_MODELS_MODEL',
                                        'text' => 'Label'));
                array_push($text, array('key' => 'MODELS_MODEL_MULTIPLE_CALENDARS',
                                        'parent' => 'PARENT_MODELS_MODEL',
                                        'text' => 'Use multiple calendars'));
                array_push($text, array('key' => 'MODELS_MODEL_CALENDAR_LABEL',
                                        'parent' => 'PARENT_MODELS_MODEL',
                                        'text' => 'Calendar label'));
                
                array_push($text, array('key' => 'MODELS_MODEL_LOADED',
                                        'parent' => 'PARENT_MODELS_MODEL',
                                        'text' => 'Business model loaded.'));
                
                return $text;
            }
            
            /*
             * Models - Add model text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function modelsAddModel($text){
                array_push($text, array('key' => 'PARENT_MODELS_ADD_MODEL',
                                        'parent' => '',
                                        'text' => 'Business models - Add business model'));
                
                array_push($text, array('key' => 'MODELS_ADD_MODEL_NAME',
                                        'parent' => 'PARENT_MODELS_ADD_MODEL',
                                        'text' => 'New business model'));
                array_push($text, array('key' => 'MODELS_ADD_MODEL_LABEL',
                                        'parent' => 'PARENT_MODELS_ADD_MODEL',
                                        'text' => 'New business model label'));
                array_push($text, array('key' => 'MODELS_ADD_MODEL_LABEL_CALENDAR',
                                        'parent' => 'PARENT_MODELS_ADD_MODEL',
                                        'text' => 'Calendar label'));
                array_push($text, array('key' => 'MODELS_ADD_MODEL_SUBMIT',
                                        'parent' => 'PARENT_MODELS_ADD_MODEL',
                                        'text' => 'Add business model'));
                array_push($text, array('key' => 'MODELS_ADD_MODEL_ADDING',
                                        'parent' => 'PARENT_MODELS_ADD_MODEL',
                                        'text' => 'Adding a business model ...'));
                array_push($text, array('key' => 'MODELS_ADD_MODEL_SUCCESS',
                                        'parent' => 'PARENT_MODELS_ADD_MODEL',
                                        'text' => 'You have succesfully added a new business model.'));
                
                return $text;
            }
            
            /*
             * Models - Delete model text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function modelsDeleteModel($text){
                array_push($text, array('key' => 'PARENT_MODELS_DELETE_MODEL',
                                        'parent' => '',
                                        'text' => 'Business models - Delete business model'));
                
                array_push($text, array('key' => 'MODELS_DELETE_MODEL_CONFIRMATION',
                                        'parent' => 'PARENT_MODELS_DELETE_MODEL',
                                        'text' => 'Are you sure you want to delete this business model?'));
                array_push($text, array('key' => 'MODELS_DELETE_MODEL_SUBMIT',
                                        'parent' => 'PARENT_MODELS_DELETE_MODEL',
                                        'text' => 'Delete business model'));
                array_push($text, array('key' => 'MODELS_DELETE_MODEL_DELETING',
                                        'parent' => 'PARENT_MODELS_DELETE_MODEL',
                                        'text' => 'Deleting business model ...'));
                array_push($text, array('key' => 'MODELS_DELETE_MODEL_SUCCESS',
                                        'parent' => 'PARENT_MODELS_DELETE_MODEL',
                                        'text' => 'You have succesfully deleted the business model.'));
                
                return $text;
            }
            
            /*
             * Models - Help text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function modelsHelp($text){
                array_push($text, array('key' => 'PARENT_MODELS_HELP',
                                        'parent' => '',
                                        'text' => 'Business models - Help'));
                
                array_push($text, array('key' => 'MODELS_HELP',
                                        'parent' => 'PARENT_MODELS_HELP',
                                        'text' => 'Click on a business model item to open the editing area.'));
                array_push($text, array('key' => 'MODELS_ADD_MODEL_HELP',
                                        'parent' => 'PARENT_MODELS_HELP',
                                        'text' => 'Click on the "plus" icon to add a business model.'));
                
                /*
                 * Model help.
                 */
                array_push($text, array('key' => 'MODELS_MODEL_HELP',
                                        'parent' => 'PARENT_MODELS_HELP',
                                        'text' => 'Click the "trash" icon to delete the business model.'));
                array_push($text, array('key' => 'MODELS_MODEL_NAME_HELP',
                                        'parent' => 'PARENT_MODELS_HELP',
                                        'text' => 'Change business model name.'));
                array_push($text, array('key' => 'MODELS_MODEL_LANGUAGE_HELP',
                                        'parent' => 'PARENT_MODELS_HELP',
                                        'text' => 'Change to the language you want to edit the business models.'));
                array_push($text, array('key' => 'MODELS_MODEL_ENABLED_HELP',
                                        'parent' => 'PARENT_MODELS_HELP',
                                        'text' => 'Enable this to use the business model.'));
                array_push($text, array('key' => 'MODELS_MODEL_LABEL_HELP',
                                        'parent' => 'PARENT_MODELS_HELP',
                                        'text' => 'Enter business model label.'));
                array_push($text, array('key' => 'MODELS_MODEL_MULTIPLE_CALENDARS_HELP',
                                        'parent' => 'PARENT_MODELS_HELP',
                                        'text' => 'Enable this option to add more than one calendar to your business model.'));
                array_push($text, array('key' => 'MODELS_MODEL_CALENDAR_LABEL_HELP',
                                        'parent' => 'PARENT_MODELS_HELP',
                                        'text' => 'Set how the calendars should be called. Examples: Room, Staff, ...'));
                
                return $text;
            }
        }
    }