<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin
* Version                 : 2.1.2
* File                    : addons/woocommerce/includes/class-woocommerce-translation-text.php
* File Version            : 1.0
* Created / Last Modified : 04 December 2015
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : WooCommerce translation text PHP class.
*/

    if (!class_exists('DOPBSPWooCommerceTranslationText')){
        class DOPBSPWooCommerceTranslationText{
            /*
             * Constructor
             */
            function __construct(){
                /*
                 * Initialize WooCommerce text.
                 */
                add_filter('dopbsp_filter_translation_text', array(&$this, 'woocommerce'));
                add_filter('dopbsp_filter_translation_text', array(&$this, 'woocommerceHelp'));
            }
            
            /*
             * WooCommerce text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function woocommerce($text){
                array_push($text, array('key' => 'PARENT_WOOCOMMERCE',
                                        'parent' => '',
                                        'text' => 'WooCommerce'));
                /*
                 * Back end tab.
                 */
                array_push($text, array('key' => 'WOOCOMMERCE_TAB',
                                        'parent' => 'PARENT_WOOCOMMERCE',
                                        'text' => 'Pinpoint Booking System'));
                array_push($text, array('key' => 'WOOCOMMERCE_TAB_CALENDAR',
                                        'parent' => 'PARENT_WOOCOMMERCE',
                                        'text' => 'Calendar'));
                array_push($text, array('key' => 'WOOCOMMERCE_TAB_CALENDAR_NO_CALENDARS',
                                        'parent' => 'PARENT_WOOCOMMERCE',
                                        'text' => 'No calendars.'));
                array_push($text, array('key' => 'WOOCOMMERCE_TAB_CALENDAR_SELECT',
                                        'parent' => 'PARENT_WOOCOMMERCE',
                                        'text' => 'Select calendar'));
                array_push($text, array('key' => 'WOOCOMMERCE_TAB_LANGUAGE',
                                        'parent' => 'PARENT_WOOCOMMERCE',
                                        'text' => 'Language'));
                array_push($text, array('key' => 'WOOCOMMERCE_TAB_POSITION',
                                        'parent' => 'PARENT_WOOCOMMERCE',
                                        'text' => 'Position'));
                array_push($text, array('key' => 'WOOCOMMERCE_TAB_POSITION_SUMMARY',
                                        'parent' => 'PARENT_WOOCOMMERCE',
                                        'text' => 'Summary'));
                array_push($text, array('key' => 'WOOCOMMERCE_TAB_POSITION_TABS',
                                        'parent' => 'PARENT_WOOCOMMERCE',
                                        'text' => 'Tabs'));
                array_push($text, array('key' => 'WOOCOMMERCE_TAB_POSITION_SUMMARY_AND_TABS',
                                        'parent' => 'PARENT_WOOCOMMERCE',
                                        'text' => 'Summary & Tabs'));
                array_push($text, array('key' => 'WOOCOMMERCE_TAB_ADD_TO_CART',
                                        'parent' => 'PARENT_WOOCOMMERCE',
                                        'text' => 'Use the "Add To Cart" button from'));
                
                /*
                 * Front end.
                 */
                array_push($text, array('key' => 'WOOCOMMERCE_VIEW_AVAILABILITY',
                                        'parent' => 'PARENT_WOOCOMMERCE',
                                        'text' => 'View availability',
                                        'location' => 'woocommerce_frontend'));
                array_push($text, array('key' => 'WOOCOMMERCE_STARTING_FROM',
                                        'parent' => 'PARENT_WOOCOMMERCE',
                                        'text' => 'Starting from',
                                        'location' => 'woocommerce_frontend'));
                array_push($text, array('key' => 'WOOCOMMERCE_ADD_TO_CART',
                                        'parent' => 'PARENT_WOOCOMMERCE',
                                        'text' => 'Add to cart',
                                        'location' => 'woocommerce_frontend'));
                array_push($text, array('key' => 'WOOCOMMERCE_TABS',
                                        'parent' => 'PARENT_WOOCOMMERCE',
                                        'text' => 'Book',
                                        'location' => 'woocommerce_frontend'));
                
                /*
                 * Messages
                 */
                array_push($text, array('key' => 'WOOCOMMERCE_VIEW_CART',
                                        'parent' => 'PARENT_CART',
                                        'text' => 'View cart',
                                        'location' => 'woocommerce_frontend'));
                array_push($text, array('key' => 'WOOCOMMERCE_SUCCESS',
                                        'parent' => 'PARENT_CART',
                                        'text' => 'The reservation has been added to cart.',
                                        'location' => 'woocommerce_frontend'));
                array_push($text, array('key' => 'WOOCOMMERCE_UNAVAILABLE',
                                        'parent' => 'PARENT_CART',
                                        'text' => 'The period you selected is not available anymore.',
                                        'location' => 'woocommerce_frontend'));
                array_push($text, array('key' => 'WOOCOMMERCE_OVERLAP',
                                        'parent' => 'PARENT_CART',
                                        'text' => 'The period you selected will overlap with the ones you already added to cart. Please select another one.',
                                        'location' => 'woocommerce_frontend'));
                array_push($text, array('key' => 'WOOCOMMERCE_DELETED',
                                        'parent' => 'PARENT_CART',
                                        'text' => 'The reservation(s) has(have) been deleted from cart.',
                                        'location' => 'woocommerce_frontend'));
                
                return $text;
            }
            
            /*
             * WooCommerce - Help text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function woocommerceHelp($text){
                array_push($text, array('key' => 'PARENT_WOOCOMMERCE_HELP',
                                        'parent' => '',
                                        'text' => 'WooCommerce - Help'));
                
                array_push($text, array('key' => 'WOOCOMMERCE_TAB_CALENDAR_HELP',
                                        'parent' => 'PARENT_WOOCOMMERCE_HELP',
                                        'text' => 'Select the calendar that you want asociated with this product.'));
                array_push($text, array('key' => 'WOOCOMMERCE_TAB_LANGUAGE_HELP',
                                        'parent' => 'PARENT_WOOCOMMERCE_HELP',
                                        'text' => 'Select the language for the calendar.'));
                array_push($text, array('key' => 'WOOCOMMERCE_TAB_POSITION_HELP',
                                        'parent' => 'PARENT_WOOCOMMERCE_HELP',
                                        'text' => 'Select the calendar position. Add it in "product summary", "product tabs" or add the form in "summary" and the calendar in "product tabs".'));
                array_push($text, array('key' => 'WOOCOMMERCE_TAB_ADD_TO_CART_HELP',
                                        'parent' => 'PARENT_WOOCOMMERCE_HELP',
                                        'text' => 'Select to choose to use Pinpoint Booking System<<single-quote>>s "Add to cart" button, or WooCommerce default button.'));
                
                return $text;
            }
        }
    }