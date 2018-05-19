<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin
* Version                 : 2.2.4
* File                    : includes/translation/class-translation-text-settings.php
* File Version            : 1.2.1
* Created / Last Modified : 07 May 2016
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Settings translation text PHP class.
*/

    if (!class_exists('DOPBSPTranslationTextSettings')){
        class DOPBSPTranslationTextSettings{
            /*
             * Constructor
             */
            function __construct(){
                /*
                 * Initialize settings text.
                 */
                add_filter('dopbsp_filter_translation_text', array(&$this, 'settings'));
                add_filter('dopbsp_filter_translation_text', array(&$this, 'settingsHelp'));
                
                add_filter('dopbsp_filter_translation_text', array(&$this, 'settingsCalendar'));
                add_filter('dopbsp_filter_translation_text', array(&$this, 'settingsCalendarHelp'));
                
                add_filter('dopbsp_filter_translation_text', array(&$this, 'settingsNotifications'));
                add_filter('dopbsp_filter_translation_text', array(&$this, 'settingsNotificationsHelp'));
                
                add_filter('dopbsp_filter_translation_text', array(&$this, 'settingsPaymentGateways'));
                add_filter('dopbsp_filter_translation_text', array(&$this, 'settingsPaymentGatewaysHelp'));
                
                add_filter('dopbsp_filter_translation_text', array(&$this, 'settingsSearch'));
                add_filter('dopbsp_filter_translation_text', array(&$this, 'settingsSearchHelp'));
                
                add_filter('dopbsp_filter_translation_text', array(&$this, 'settingsUsers'));
                add_filter('dopbsp_filter_translation_text', array(&$this, 'settingsUsersHelp'));
                
                add_filter('dopbsp_filter_translation_text', array(&$this, 'settingsLicences'));
                add_filter('dopbsp_filter_translation_text', array(&$this, 'settingsLicencesHelp'));
            }
            
            /*
             * Settings text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function settings($text){
                array_push($text, array('key' => 'PARENT_SETTINGS',
                                        'parent' => '',
                                        'text' => 'Settings'));
                
                array_push($text, array('key' => 'SETTINGS_TITLE',
                                        'parent' => 'PARENT_SETTINGS',
                                        'text' => 'Settings'));
                
                array_push($text, array('key' => 'SETTINGS_ENABLED',
                                        'parent' => 'PARENT_SETTINGS',
                                        'text' => 'Enabled'));
                array_push($text, array('key' => 'SETTINGS_DISABLED',
                                        'parent' => 'PARENT_SETTINGS',
                                        'text' => 'Disabled'));
                
                array_push($text, array('key' => 'SETTINGS_GENERAL_TITLE',
                                        'parent' => 'PARENT_SETTINGS',
                                        'text' => 'General settings'));
                
                return $text;
            }
            
            /*
             * Settings help text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function settingsHelp($text){
                array_push($text, array('key' => 'PARENT_SETTINGS_HELP',
                                        'parent' => '',
                                        'text' => 'Settings - Help'));
                
                array_push($text, array('key' => 'SETTINGS_HELP',
                                        'parent' => 'PARENT_SETTINGS_HELP',
                                        'text' => 'Edit booking system settings.'));
                
                return $text;
            }
            
            /*
             * Calendar settings text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function settingsCalendar($text){
                array_push($text, array('key' => 'PARENT_SETTINGS_CALENDAR',
                                        'parent' => '',
                                        'text' => 'Settings - Calendar'));
                
                array_push($text, array('key' => 'SETTINGS_CALENDAR_TITLE',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Calendar settings'));
                
                array_push($text, array('key' => 'SETTINGS_CALENDAR_NAME',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Name'));
                /*
                 * General settings.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GENERAL_SETTINGS',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'General settings'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GENERAL_DATE_TYPE',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Date type'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GENERAL_DATE_TYPE_AMERICAN',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'American (mm dd, yyyy)'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GENERAL_DATE_TYPE_EUROPEAN',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'European (dd mm yyyy)'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GENERAL_TEMPLATE',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Style template'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GENERAL_BOOKING_STOP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Stop booking x minutes in advance'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GENERAL_MONTHS_NO',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Number of months displayed'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GENERAL_VIEW_ONLY',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'View only info'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GENERAL_SERVER_TIME',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Enable server time'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GENERAL_TIMEZONE',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Timezone'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GENERAL_HIDE_PRICE',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Hide price'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GENERAL_HIDE_NO_AVAILABLE',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Hide No available'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GENERAL_MINIMUM_NO_AVAILABLE',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Minimum no available'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GENERAL_POST_ID',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Post ID'));
                /*
                 * Currency settings.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_CURRENCY_SETTINGS',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Currency settings'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_CURRENCY',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Currency'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_CURRENCY_POSITION',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Currency position'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_CURRENCY_POSITION_BEFORE',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Before'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_CURRENCY_POSITION_BEFORE_WITH_SPACE',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Before with space'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_CURRENCY_POSITION_AFTER',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'After'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_CURRENCY_POSITION_AFTER_WITH_SPACE',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'After with space'));
                /*
                 * Days settings.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_DAYS_SETTINGS',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Days settings'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_DAYS_AVAILABLE',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Available days'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_DAYS_FIRST',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'First weekday'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_DAYS_FIRST_DISPLAYED',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'First day displayed'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_DAYS_MULTIPLE_SELECT',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Use Check in/Check out'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_DAYS_MORNING_CHECK_OUT',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Morning check out'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_DAYS_DETAILS_FROM_HOURS',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Use hours details to set day details'));
                /*
                 * Hours settings.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_HOURS_SETTINGS',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Hours settings'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_HOURS_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Use hours'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_HOURS_INFO_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Enable hours info'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_HOURS_DEFINITIONS',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Define hours'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_HOURS_MULTIPLE_SELECT',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Use start/finish hours'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_HOURS_AMPM',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Enable AM/PM format'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_HOURS_ADD_LAST_HOUR_TO_TOTAL_PRICE',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Add last selected hour price to total price'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_HOURS_INTERVAL_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Enable hours interval'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_HOURS_INTERVAL_AUTOBREAK_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Enable breaks for hours interval'));
                /*
                 * Sidebar settings.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_SIDEBAR_SETTINGS',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Sidebar settings'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_SIDEBAR_STYLE',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Sidebar style'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_SIDEBAR_NO_ITEMS_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Enable number of items select'));
                /*
                 * Rules settings.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_RULES_SETTINGS',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Rules settings'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_RULES',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Select rule'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_RULES_NONE',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'None'));
                /*
                 * Extras settings.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_EXTRAS_SETTINGS',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Extras settings'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_EXTRAS',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Select extra'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_EXTRAS_NONE',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'None'));
                /*
                 * Cart settings.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_CART_SETTINGS',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Cart settings'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_CART_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Enable cart'));
                /*
                 * Discounts settings.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_DISCOUNTS_SETTINGS',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Discounts settings'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_DISCOUNTS',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Select discount'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_DISCOUNTS_NONE',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'None'));
                /*
                 * Taxes & fees settings.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_FEES_SETTINGS',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Taxes & fees settings'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_FEES',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Select taxes and/or fees'));
                /*
                 * Coupons settings.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_COUPONS_SETTINGS',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Coupons settings'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_COUPONS',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Select coupons'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_COUPONS_NONE',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'None'));
                /*
                 * Deposit settings.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_DEPOSIT_SETTINGS',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Deposit settings'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_DEPOSIT',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Deposit value'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_DEPOSIT_TYPE',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Deposit type'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_DEPOSIT_TYPE_FIXED',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Fixed'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_DEPOSIT_TYPE_PERCENT',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Percent'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_DEPOSIT_PAY_FULL_AMOUNT',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Enable Pay full amount.'));
                /*
                 * Forms ssettings.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_FORMS_SETTINGS',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Forms settings'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_FORMS',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Select form'));
                /*
                 * Order settings.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_ORDER_SETTINGS',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Order settings'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_ORDER_TERMS_AND_CONDITIONS_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Enable Terms & Conditions'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_ORDER_TERMS_AND_CONDITIONS_LINK',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Terms & Conditions link'));
                /*
                 * Google Calendar Sync settings.
                 */
                
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GOOGLE_SYNC_SETTINGS',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Google Calendar Sync settings'));
                
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GOOGLE_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Enable Google Calendar Sync'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GOOGLE_CLIENT_ID',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Client ID'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GOOGLE_CLIENT_SECRET',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Client secret'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GOOGLE_CALENDAR_ID',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Calendar ID'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GOOGLE_FEED_URL',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Feed URL'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GOOGLE_SYNC_TIME',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Sync time'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GOOGLE_SYNC_TIMEOUT',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Sync timeout'));
                
                /*
                 * iCAL Sync settings.
                 */
                
                array_push($text, array('key' => 'SETTINGS_CALENDAR_SYNC_SETTINGS',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'iCalendar - Synchronization'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_ICAL_URL',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'iCalendar URL'));
                
                /*
                 * Airbnb Sync settings.
                 */
                
                array_push($text, array('key' => 'SETTINGS_CALENDAR_AIRBNB_SYNC_SETTINGS',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Airbnb Sync settings'));
                
                array_push($text, array('key' => 'SETTINGS_CALENDAR_AIRBNB_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Enable Airbnb Sync'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_AIRBNB_FEED_URL',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Feed URL'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_AIRBNB_SYNC_TIME',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Sync time'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_AIRBNB_SYNC_TIMEOUT',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Sync timeout'));
                
                return $text;
            }
            
            /*
             * Calendar settings help text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function settingsCalendarHelp($text){
                array_push($text, array('key' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'parent' => '',
                                        'text' => 'Settings - Calendar - Help'));
                
                array_push($text, array('key' => 'SETTINGS_CALENDAR_NAME_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Change calendar name.'));
                /*
                 * General settings.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GENERAL_DATE_TYPE_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: American. Select date format: American (mm dd, yyyy) or European (dd mm yyyy).'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GENERAL_TEMPLATE_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: default. Select styles template.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GENERAL_BOOKING_STOP_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR',
                                        'text' => 'Default value: 0. Set the number of minutes before the booking is stopped in advance. For 1 hour you have 60 minutes, for 1 day you have 1440 minutes.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GENERAL_MONTHS_NO_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: 1. Set the number of months initialy displayed. Maximum number allowed is 6.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GENERAL_VIEW_ONLY_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: Enabled. Set to display only booking information in front end.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GENERAL_SERVER_TIME_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: Disabled. Use server time.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GENERAL_TIMEZONE_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Select your timezone.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GENERAL_HIDE_PRICE_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: false. Enable to hide price from calendar ( frontend ).'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GENERAL_HIDE_NO_AVAILABLE_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: false. Enable to hide number of days/hours available from calendar ( frontend ).'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GENERAL_MINIMUM_NO_AVAILABLE_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: 1. Set minimum no available from sidebar ( frontend ).'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GENERAL_POST_ID_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Set post ID were the calendar will be added. It is mandatory if you create a searching system through some calendars.'));
                /*
                 * Currency settings help.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_CURRENCY_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: United States Dollar ($, USD). Select calendar currency.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_CURRENCY_POSITION_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: Before. Select currency position.'));
                /*
                 * Days settings help.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_DAYS_MULTIPLE_SELECT_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: Enabled. Use Check in/Check out or select only one day.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_DAYS_AVAILABLE_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: all available. Select available weekdays.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_DAYS_FIRST_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: Monday. Select calendar first weekday.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_DAYS_FIRST_DISPLAYED_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Format: YYYY-MM-DD. Default value: today. Select the day to be first displayed when the calendar calendar is loaded.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_DAYS_MORNING_CHECK_OUT_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: Disabled. This option enables "Check in" in the afternoon of first day and "Check out" in the morning of the day after last day.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_DAYS_DETAILS_FROM_HOURS_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: Enabled. Check this option, when hours are enabled, if you want for days details to be updated (calculated) from hours details or disable it if you want to have complete control of day derails.'));
                /*
                 * Hours settings help.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_HOURS_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: Disabled. Enable hours for the calendar.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_HOURS_INFO_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: Enabled. Display hours info when you hover a day in calendar.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_HOURS_DEFINITIONS_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Enter hh:mm ... add one per line. Changing the definitions will overwrite any previous hours data. Use only 24 hours format.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_HOURS_MULTIPLE_SELECT_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: Enabled. Use Start/Finish Hours or select only one hour.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_HOURS_AMPM_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: Disabled. Display hours in AM/PM format. NOTE: Hours definitions still need to be in 24 hours format.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_HOURS_ADD_LAST_HOUR_TO_TOTAL_PRICE_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: Enabled. It calculates the total price before the last hours selected if Disabled. It calculates the total price including the last hour selected if Enabled. <br /><br /><strong>Warning: </strong> In administration area the last hours from your definitions list will not be displayed.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_HOURS_INTERVAL_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: Disabled. Show hours interval from the current hour to the next one.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_HOURS_INTERVAL_AUTOBREAK_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: Disabled. Put a break before each interval.'));
                /*
                 * Sidebar settings help.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_SIDEBAR_STYLE_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Set sidebar position and number of columns.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_SIDEBAR_NO_ITEMS_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: Enabled. Set to display number of items you want to book in front end.'));
                /*
                 * Rules settings.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_RULES_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Select calendar rules.'));
                /*
                 * Extras settings help.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_EXTRAS_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Select calendar extras.'));
                /*
                 * Cart settings help.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_CART_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: Disabled. Use a shopping cart in calendar.'));
                /*
                 * Discounts settings help.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_DISCOUNTS_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Select calendar discount.'));
                /*
                 * Taxes & fees settings help.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_FEES_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Select calendar taxes and/or fees.'));
                /*
                 * Coupons settings help.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_COUPONS_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Select calendar coupons.'));
                /*
                 * Deposit settings help.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_DEPOSIT_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: 0. Set calendar deposit value.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_DEPOSIT_TYPE_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: Percent. Set deposit value type.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_DEPOSIT_TYPE_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: Enabled. Enable Pay full amount option.'));
                /*
                 * Forms settings help.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_FORMS_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Select calendar form.'));
                /*
                 * Order settings help.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_ORDER_TERMS_AND_CONDITIONS_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: Disabled. Enable Terms & Conditions check box.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_ORDER_TERMS_AND_CONDITIONS_LINK_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Enter the link to Terms & Conditions page.'));
                
                /*
                 * Google Calendar Sync settings.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GOOGLE_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: Disabled. Enable Google Calendar Sync.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GOOGLE_CLIENT_ID_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Enter Google Client ID.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GOOGLE_CLIENT_SECRET_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Enter Google Client secret.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GOOGLE_CALENDAR_ID_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Enter Google Calendar ID.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GOOGLE_FEED_URL_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Enter Google iCalendar feed URL.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GOOGLE_SYNC_TIME_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Sync calendar at every x seconds.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GOOGLE_SYNC_TIMEOUT_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Stop sync after x seconds if is not finished.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_GOOGLE_CALENDAR_SYNC_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Synchronize'));
                
                /*
                 * iCAL Sync settings.
                 */
                
                array_push($text, array('key' => 'SETTINGS_CALENDAR_ICAL_URL_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Copy the iCalendar URL and paste it in the import URL field.'));
                /*
                 * Airbnb Sync settings.
                 */
                array_push($text, array('key' => 'SETTINGS_CALENDAR_AIRBNB_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Default value: Disabled. Enable Airbnb Sync.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_AIRBNB_FEED_URL_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Enter Airbnb ICAL feed URL.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_AIRBNB_SYNC_TIME_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Sync calendar at every x seconds.'));
                array_push($text, array('key' => 'SETTINGS_CALENDAR_AIRBNB_SYNC_TIMEOUT_HELP',
                                        'parent' => 'PARENT_SETTINGS_CALENDAR_HELP',
                                        'text' => 'Stop sync after x seconds if is not finished.'));
                
                return $text;
            }
            
            /*
             * Notifications settings text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function settingsNotifications($text){
                array_push($text, array('key' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'parent' => '',
                                        'text' => 'Settings - Notifications'));
                
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_TITLE',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Notifications'));
                
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_TEMPLATES',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Email templates'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_METHOD_ADMIN',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Admin notifications method'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_METHOD_USER',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'User notifications method'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_EMAIL',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Notifications email'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_EMAIL_REPLY',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Reply email'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_EMAIL_NAME',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Email name'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_EMAIL_CC',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Notifications Cc email(s)'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_EMAIL_CC_NAME',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Notifications Cc name(s)'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_EMAIL_BCC',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Notifications Bcc email(s)'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_EMAIL_BCC_NAME',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Notifications Bcc name(s)'));
                /*
                 * Send notifications.
                 */
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SEND_TITLE',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Enable notifications'));
                
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SEND_BOOK_ADMIN',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Notify admin on book request'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SEND_BOOK_USER',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Notify user on book request'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SEND_BOOK_WITH_APPROVAL_ADMIN',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Notify admin on approved book request'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SEND_BOOK_WITH_APPROVAL_USER',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Notify user on approved book request'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SEND_APPROVED',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Notify user when reservation is approved'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SEND_CANCELED',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Notify user when reservation is canceled'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SEND_REJECTED',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Notify user when reservation is rejected'));
                /*
                 * SMTP settings.
                 */
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMTP_TITLE',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'SMTP settings'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMTP_SECOND_TITLE',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Second SMTP settings'));
                
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMTP_HOST_NAME',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'SMTP host name'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMTP_HOST_PORT',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'SMTP host port'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMTP_SSL',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'SMTP SSL conection'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMTP_TLS',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'SMTP TLS conection'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMTP_USER',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'SMTP host user'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMTP_PASSWORD',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'SMTP host password'));
                /*
                 * Test
                 */
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_TEST_TITLE',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Test notification methods'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_TEST_METHOD',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Select notifications method'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_TEST_EMAIL',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Test email'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_TEST_SUBMIT',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Send test'));
                
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_TEST_SENDING',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Sending notification test email ...'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_TEST_SUCCESS',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Notification test email has been sent.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_TEST_ERROR',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Notification test email could not be sent.'));
                
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_TEST_MAIL_SUBJECT',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Pinpoint Booking System - PHP mail notification test'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_TEST_MAIL_MESSAGE',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Pinpoint Booking System notification test sent with PHP mail function.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_TEST_MAILER_SUBJECT',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Pinpoint Booking System - PHPMailer notification test'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_TEST_MAILER_MESSAGE',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Pinpoint Booking System notification test sent with PHPMailer class.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_TEST_SMTP_SUBJECT',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Pinpoint Booking System - SMTP notification test'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_TEST_SMTP_MESSAGE',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Pinpoint Booking System notification test sent with PHPMailer SMTP.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_TEST_SMTP2_SUBJECT',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Pinpoint Booking System - Second SMTP notification test'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_TEST_SMTP2_MESSAGE',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Pinpoint Booking System notification test sent with second SMTP.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_TEST_WP_SUBJECT',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Pinpoint Booking System - WordPress mail notification test'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_TEST_WP_MESSAGE',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Pinpoint Booking System notification test sent with WordPress mail function.'));
                
                /*
                 * SMS notifications - Clickatell.com
                 */
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMS_CLICKATELL_TITLE',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'SMS notifications - Clickatell.com'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMS_CLICKATELL_USERNAME',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Username'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMS_CLICKATELL_PASSWORD',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Password'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMS_CLICKATELL_API_ID',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'API ID'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMS_CLICKATELL_FROM',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'From'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMS_CLICKATELL_ADMIN_PHONE',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Notifications phone'));
                
                
                return $text;
            }
            
            /*
             * Notifications settings help text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function settingsNotificationsHelp($text){
                array_push($text, array('key' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'parent' => '',
                                        'text' => 'Settings - Notifications - Help'));
                
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_TEMPLATES_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Select email templates.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_METHOD_ADMIN_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Select notifications method used to send emails to admins. You can use PHP mail function, PHPMailer class, SMTP, second SMTP or WordPress wp_mail function.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_METHOD_USER_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Select notifications method used to send emails to users. You can use PHP mail function, PHPMailer class, SMTP, second SMTP or WordPress wp_mail function.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_EMAIL_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Enter the email were you will be notified about booking requests or you will use to notify users. Enter other emails that will be notified in Cc & Bcc fields.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_EMAIL_REPLY_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Enter the reply email that will appear in the email the user will receive.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_EMAIL_NAME_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Enter the name that will appear in the email the user will receive.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_EMAIL_CC_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Enter the email(s) for Cc field, were others be notified about booking requests or they will use to notify users. Add an email per line.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_EMAIL_CC_NAME_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Enter the name(s) for Cc field, equivalent to Cc email(s). Add a name per line, like emails.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_EMAIL_BCC_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Enter the email(s) for Bcc field, were others be notified about booking requests or they will use to notify users. Add an email per line.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_EMAIL_BCC_NAME_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Enter the name(s) for Bcc field, equivalent to Bcc email(s). Add a name per line, like emails.'));
                /*
                 * Send notifications.
                 */
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SEND_BOOK_ADMIN_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Enable to send an email notification to admin on book request.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SEND_BOOK_USER_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Enable to send an email notification to user on book request.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SEND_BOOK_WITH_APPROVAL_ADMIN_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Enable to send an email notification to admin on book request and reservation is approved.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SEND_BOOK_WITH_APPROVAL_USER_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Enable to send an email notification to user on book request and reservation is approved.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SEND_APPROVED_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Enable to send an email notification to user when reservation is approved.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SEND_CANCELED_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Enable to send an email notification to user when reservation is canceled.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SEND_REJECTED_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Enable to send an email notification to user when reservation is rejected.'));
                /*
                 * SMTP
                 */
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMTP_HOST_NAME_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Enter SMTP host name.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMTP_HOST_PORT_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Enter SMTP host port.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMTP_SSL_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Use a  SSL conection.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMTP_TLS_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Use a TLS conection.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMTP_USER_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Enter SMTP host username.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMTP_PASSWORD_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Enter SMTP host password.'));
                /*
                 * Test
                 */
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_TEST_METHOD_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Select the notifications method for which the test will be performed.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_TEST_EMAIL_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Enter the email to which the test notification will be sent.'));
                
                /*
                 * SMS notifications - Clickatell.com
                 */
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMS_CLICKATELL_USERNAME_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Enter the username from clickatell.com.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMS_CLICKATELL_PASSWORD_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Enter the password from clickatell.com.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMS_CLICKATELL_API_ID_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Enter the API ID from clickatell.com.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMS_CLICKATELL_FROM_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Enter the text from message header.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMS_CLICKATELL_ADMIN_PHONE_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Enter the admin phone.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMS_CLICKATELL_ADMIN_PHONE_ADD_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Add phone number.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMS_CLICKATELL_BOOK_ADMIN',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'You received a booking request.|DETAILS|'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMS_CLICKATELL_BOOK_USER',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Your booking request has been sent.|DETAILS|'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMS_CLICKATELL_BOOK_WITH_APPROVAL_ADMIN',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'You received a booking request.|DETAILS|'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMS_CLICKATELL_BOOK_WITH_APPROVAL_USER',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Your booking request has been sent.|DETAILS|'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMS_CLICKATELL_APPROVED',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Your booking request has been approved.|DETAILS|'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMS_CLICKATELL_CANCELED',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Your booking request has been canceled.|DETAILS|'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMS_CLICKATELL_REJECTED',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS',
                                        'text' => 'Your booking request has been rejected.|DETAILS|'));
                /*
                 * Send notifications.
                 */
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMS_SEND_BOOK_ADMIN_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Enable to send an SMS notification to admin on book request.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMS_SEND_BOOK_USER_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Enable to send an SMS notification to user on book request.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMS_SEND_BOOK_WITH_APPROVAL_ADMIN_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Enable to send an SMS notification to admin on book request and reservation is approved.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMS_SEND_BOOK_WITH_APPROVAL_USER_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Enable to send an SMS notification to user on book request and reservation is approved.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMS_SEND_APPROVED_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Enable to send an SMS notification to user when reservation is approved.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMS_SEND_CANCELED_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Enable to send an SMS notification to user when reservation is canceled.'));
                array_push($text, array('key' => 'SETTINGS_NOTIFICATIONS_SMS_SEND_REJECTED_HELP',
                                        'parent' => 'PARENT_SETTINGS_NOTIFICATIONS_HELP',
                                        'text' => 'Enable to send an SMS notification to user when reservation is rejected.'));
                
                return $text;
            }
            
            /*
             * Payment gateways settings text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function settingsPaymentGateways($text){
                array_push($text, array('key' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'parent' => '',
                                        'text' => 'Settings - Payment gateways'));
                
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_TITLE',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Payment gateways'));
                
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_PAYMENT_ARRIVAL_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Enable payment on arrival'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_PAYMENT_ARRIVAL_WITH_APPROVAL_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Enable instant approval'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_PAYMENT_REDIRECT',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Redirect after book'));
                
                /*
                 * Billing address.
                 */
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Billing address'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Enable billing address'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_FIRST_NAME_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'First name (enable)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_FIRST_NAME_REQUIRED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'First name (required)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_LAST_NAME_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Last name (enable)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_LAST_NAME_REQUIRED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Last name (required)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_COMPANY_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Company (enable)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_COMPANY_REQUIRED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Company (required)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_EMAIL_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Email (enable)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_EMAIL_REQUIRED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Email (required)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_PHONE_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Phone number (enable)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_PHONE_REQUIRED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Phone number (required)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_COUNTRY_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Country (enable)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_COUNTRY_REQUIRED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Country (required)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_ADDRESS_FIRST_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Address line 1 (enable)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_ADDRESS_FIRST_REQUIRED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Address line 1 (required)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_ADDRESS_SECOND_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Address line 2 (enable)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_ADDRESS_SECOND_REQUIRED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Address line 2 (required)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_CITY_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'City (enable)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_CITY_REQUIRED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'City (required)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_STATE_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'State (enable)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_STATE_REQUIRED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'State (required)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_ZIP_CODE_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Zip code (enable)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_ZIP_CODE_REQUIRED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Zip code (required)'));
                
                /*
                 * Shipping address.
                 */
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Shipping address'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Enable shipping address'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_FIRST_NAME_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'First name (enable)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_FIRST_NAME_REQUIRED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'First name (required)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_LAST_NAME_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Last name (enable)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_LAST_NAME_REQUIRED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Last name (required)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_COMPANY_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Company (enable)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_COMPANY_REQUIRED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Company (required)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_EMAIL_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Email (enable)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_EMAIL_REQUIRED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Email (required)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_PHONE_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Phone number (enable)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_PHONE_REQUIRED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Phone number (required)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_COUNTRY_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Country (enable)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_COUNTRY_REQUIRED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Country (required)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_ADDRESS_FIRST_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Address line 1 (enable)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_ADDRESS_FIRST_REQUIRED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Address line 1 (required)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_ADDRESS_SECOND_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Address line 2 (enable)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_ADDRESS_SECOND_REQUIRED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Address line 2 (required)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_CITY_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'City (enable)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_CITY_REQUIRED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'City (required)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_STATE_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'State (enable)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_STATE_REQUIRED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'State (required)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_ZIP_CODE_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Zip code (enable)'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_ZIP_CODE_REQUIRED',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS',
                                        'text' => 'Zip code (required)'));
                
                return $text;
            }
            
            /*
             * Payment gateways settings help text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function settingsPaymentGatewaysHelp($text){
                array_push($text, array('key' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'parent' => '',
                                        'text' => 'Settings - Payment gateways - Help'));
                
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_PAYMENT_ARRIVAL_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Allow user to pay on arrival. Need approval.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_PAYMENT_ARRIVAL_WITH_APPROVAL_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Disabled. Instantly approve the reservation once the request to pay on arrival has been submitted.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_PAYMENT_REDIRECT_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Enter the URL where to redirect after the booking request has been sent. Leave it blank to not redirect.'));
                
                /*
                 * Billing address.
                 */
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Disabled. Enable it if you want the billing address form to be visible.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_FIRST_NAME_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "First name" field to be visible in billing address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_FIRST_NAME_REQUIRED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "First name" field to be mandatory in billing address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_LAST_NAME_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Last name" field to be visible in billing address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_LAST_NAME_REQUIRED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Last name" field to be mandatory in billing address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_COMPANY_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Company" field to be visible in billing address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_COMPANY_REQUIRED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Disabled. Enable it if you want the "Company" field to be mandatory in billing address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_EMAIL_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Email" field to be visible in billing address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_EMAIL_REQUIRED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Email" field to be mandatory in billing address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_PHONE_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Phone number" field to be visible in billing address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_PHONE_REQUIRED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Phone number" field to be mandatory in billing address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_COUNTRY_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Country" field to be visible in billing address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_COUNTRY_REQUIRED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Country" field to be mandatory in billing address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_ADDRESS_FIRST_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Address line 1" field to be visible in billing address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_ADDRESS_FIRST_REQUIRED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Address line 1" field to be mandatory in billing address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_ADDRESS_SECOND_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Address line 2" field to be visible in billing address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_ADDRESS_SECOND_REQUIRED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Disabled. Enable it if you want the "Address line 2" field to be mandatory in billing address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_CITY_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "City" field to be visible in billing address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_CITY_REQUIRED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "City" field to be mandatory in billing address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_STATE_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "State" field to be visible in billing address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_STATE_REQUIRED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "State" field to be mandatory in billing address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_ZIP_CODE_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Zip code" field to be visible in billing address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_BILLING_ZIP_CODE_REQUIRED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Zip code" field to be mandatory in billing address form.'));
                
                /*
                 * Shipping address.
                 */
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Disabled. Enable it if you want the shipping address form to be visible.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_FIRST_NAME_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "First name" field to be visible in shipping address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_FIRST_NAME_REQUIRED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "First name" field to be mandatory in shipping address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_LAST_NAME_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Last name" field to be visible in shipping address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_LAST_NAME_REQUIRED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Last name" field to be mandatory in shipping address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_COMPANY_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Company" field to be visible in shipping address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_COMPANY_REQUIRED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Disabled. Enable it if you want the "Company" field to be mandatory in shipping address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_EMAIL_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Email" field to be visible in shipping address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_EMAIL_REQUIRED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Email" field to be mandatory in shipping address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_PHONE_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Phone number" field to be visible in shipping address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_PHONE_REQUIRED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Phone number" field to be mandatory in shipping address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_COUNTRY_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Country" field to be visible in shipping address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_COUNTRY_REQUIRED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Country" field to be mandatory in shipping address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_ADDRESS_FIRST_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Address line 1" field to be visible in shipping address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_ADDRESS_FIRST_REQUIRED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Address line 1" field to be mandatory in shipping address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_ADDRESS_SECOND_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Address line 2" field to be visible in shipping address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_ADDRESS_SECOND_REQUIRED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Disabled. Enable it if you want the "Address line 2" field to be mandatory in shipping address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_CITY_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "City" field to be visible in shipping address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_CITY_REQUIRED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "City" field to be mandatory in shipping address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_STATE_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "State" field to be visible in shipping address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_STATE_REQUIRED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "State" field to be mandatory in shipping address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_ZIP_CODE_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Zip code" field to be visible in shipping address form.'));
                array_push($text, array('key' => 'SETTINGS_PAYMENT_GATEWAYS_ADDRESS_SHIPPING_ZIP_CODE_REQUIRED_HELP',
                                        'parent' => 'PARENT_SETTINGS_PAYMENT_GATEWAYS_HELP',
                                        'text' => 'Default value: Enabled. Enable it if you want the "Zip code" field to be mandatory in shipping address form.'));
                
                return $text;
            }
            
            /*
             * Search settings text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function settingsSearch($text){
                array_push($text, array('key' => 'PARENT_SETTINGS_SEARCH',
                                        'parent' => '',
                                        'text' => 'Settings - Search'));
                
                array_push($text, array('key' => 'SETTINGS_SEARCH_TITLE',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Search settings'));
                
                /*
                 * General settings.
                 */
                array_push($text, array('key' => 'SETTINGS_SEARCH_GENERAL_SETTINGS',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'General settings'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_GENERAL_DATE_TYPE',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Date type'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_GENERAL_DATE_TYPE_AMERICAN',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'American (mm dd, yyyy)'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_GENERAL_DATE_TYPE_EUROPEAN',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'European (dd mm yyyy)'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_GENERAL_TEMPLATE',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Style template'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_GENERAL_SEARCH_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Enable search input'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_GENERAL_PRICE_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Filter results by price'));
                /*
                 * View Settings.
                 */
                array_push($text, array('key' => 'SETTINGS_SEARCH_VIEW_SETTINGS',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'View settings'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_VIEW_DEFAULT',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Defaul view'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_VIEW_DEFAULT_LIST',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'List'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_VIEW_DEFAULT_GRID',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Grid'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_VIEW_DEFAULT_MAP',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Map'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_VIEW_LIST_VIEW_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'List view'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_VIEW_GRID_VIEW_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Grid view'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_VIEW_MAP_VIEW_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Map view'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_VIEW_RESULTS_PAGE',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Results per page'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_VIEW_SIDEBAR_POSITION',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Sidebar position'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_VIEW_SIDEBAR_POSITION_LEFT',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Left'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_VIEW_SIDEBAR_POSITION_RIGHT',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Right'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_VIEW_SIDEBAR_POSITION_TOP',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Top'));
                /*
                 * Currency settings.
                 */
                array_push($text, array('key' => 'SETTINGS_SEARCH_CURRENCY_SETTINGS',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Currency settings'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_CURRENCY',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Currency'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_CURRENCY_POSITION',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Currency position'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_CURRENCY_POSITION_BEFORE',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Before'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_CURRENCY_POSITION_BEFORE_WITH_SPACE',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Before with space'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_CURRENCY_POSITION_AFTER',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'After'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_CURRENCY_POSITION_AFTER_WITH_SPACE',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'After with space'));
                /*
                 * Days settings.
                 */
                array_push($text, array('key' => 'SETTINGS_SEARCH_DAYS_SETTINGS',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Days settings'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_DAYS_FIRST',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'First weekday'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_DAYS_MULTIPLE_SELECT',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Search start/end days'));
                /*
                 * Hours settings.
                 */
                array_push($text, array('key' => 'SETTINGS_SEARCH_HOURS_SETTINGS',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Hours settings'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_HOURS_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Search hours'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_HOURS_DEFINITIONS',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Define hours'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_HOURS_MULTIPLE_SELECT',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Search start/end hours'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_HOURS_AMPM',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Enable AM/PM format'));
                /*
                 * Availability settings.
                 */
                array_push($text, array('key' => 'SETTINGS_SEARCH_AVAILABILITY_SETTINGS',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Availability settings'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_AVAILABILITY_ENABLED',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Filter results by no of items available'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_AVAILABILITY_MIN',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Minimum availability value'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_AVAILABILITY_MAX',
                                        'parent' => 'PARENT_SETTINGS_SEARCH',
                                        'text' => 'Maximum availability value'));
                
                return $text;
            }
            
            /*
             * Search settings help text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function settingsSearchHelp($text){
                array_push($text, array('key' => 'PARENT_SETTINGS_SEARCH_HELP',
                                        'parent' => '',
                                        'text' => 'Settings - Search - Help'));
                
                /*
                 * General settings.
                 */
                array_push($text, array('key' => 'SETTINGS_SEARCH_GENERAL_DATE_TYPE_HELP',
                                        'parent' => 'PARENT_SETTINGS_SEARCH_HELP',
                                        'text' => 'Default value: American. Select date format: American (mm dd, yyyy) or European (dd mm yyyy).'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_GENERAL_TEMPLATE_HELP',
                                        'parent' => 'PARENT_SETTINGS_SEARCH_HELP',
                                        'text' => 'Default value: default. Select styles template.'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_GENERAL_SEARCH_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_SEARCH_HELP',
                                        'text' => 'Default value: Disabled. Enable the option to search by name or location (a location needs to be created).'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_GENERAL_PRICE_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_SEARCH_HELP',
                                        'text' => 'Default value: Disabled. Enable the option to filter results by price.'));
                /*
                 * View Settings.
                 */
                array_push($text, array('key' => 'SETTINGS_SEARCH_VIEW_DEFAULT_HELP',
                                        'parent' => 'PARENT_SETTINGS_SEARCH_HELP',
                                        'text' => 'Default value: List. Select the default view that the search results will first display.'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_VIEW_LIST_VIEW_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_SEARCH_HELP',
                                        'text' => 'Default value: Enabled. Enable to display results in list view.'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_VIEW_GRID_VIEW_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_SEARCH_HELP',
                                        'text' => 'Default value: Disabled. Enable to display results in grid view.'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_VIEW_MAP_VIEW_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_SEARCH_HELP',
                                        'text' => 'Default value: Disabled. Enable to display results on a google map.'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_VIEW_RESULTS_PAGE_HELP',
                                        'parent' => 'PARENT_SETTINGS_SEARCH_HELP',
                                        'text' => 'Default value: 10. Set the number of results to display on a page.'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_VIEW_SIDEBAR_POSITION_HELP',
                                        'parent' => 'PARENT_SETTINGS_SEARCH_HELP',
                                        'text' => 'Default value: Left. Set filters sidebar position: Left, Right & Top.'));
                /*
                 * Currency settings.
                 */
                array_push($text, array('key' => 'SETTINGS_SEARCH_CURRENCY_HELP',
                                        'parent' => 'PARENT_SETTINGS_SEARCH_HELP',
                                        'text' => 'Default value: United States Dollar ($, USD). Select search default currency.'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_CURRENCY_POSITION_HELP',
                                        'parent' => 'PARENT_SETTINGS_SEARCH_HELP',
                                        'text' => 'Default value: Before. Select currency position.'));
                /*
                 * Days settings.
                 */
                array_push($text, array('key' => 'SETTINGS_SEARCH_DAYS_MULTIPLE_SELECT_HELP',
                                        'parent' => 'PARENT_SETTINGS_SEARCH_HELP',
                                        'text' => 'Default value: Enabled. Use start/end days or select only one day to filter results.'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_DAYS_FIRST_HELP',
                                        'parent' => 'PARENT_SETTINGS_SEARCH_HELP',
                                        'text' => 'Default value: Monday. Select search first weekday.'));
                /*
                 * Hours settings.
                 */
                array_push($text, array('key' => 'SETTINGS_SEARCH_HOURS_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_SEARCH_HELP',
                                        'text' => 'Default value: Disabled. Enable hours to use them to filter results.'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_HOURS_DEFINITIONS_HELP',
                                        'parent' => 'PARENT_SETTINGS_SEARCH_HELP',
                                        'text' => 'Enter hh:mm ... add one per line.'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_HOURS_MULTIPLE_SELECT_HELP',
                                        'parent' => 'PARENT_SETTINGS_SEARCH_HELP',
                                        'text' => 'Default value: Enabled. Use start/end hours or select only one hour to filter results.'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_HOURS_AMPM_HELP',
                                        'parent' => 'PARENT_SETTINGS_SEARCH_HELP',
                                        'text' => 'Default value: Disabled. Display hours in AM/PM format. NOTE: Hours definitions still need to be in 24 hours format.'));
                /*
                 * Hours settings.
                 */
                array_push($text, array('key' => 'SETTINGS_SEARCH_AVAILABILITY_ENABLED_HELP',
                                        'parent' => 'PARENT_SETTINGS_SEARCH_HELP',
                                        'text' => 'Default value: Disabled. Enable the option to filter results by the number of items available to book.'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_AVAILABILITY_MIN_HELP',
                                        'parent' => 'PARENT_SETTINGS_SEARCH_HELP',
                                        'text' => 'Default value: 1. Set minimum availability value to filter results.'));
                array_push($text, array('key' => 'SETTINGS_SEARCH_AVAILABILITY_MAX_HELP',
                                        'parent' => 'PARENT_SETTINGS_SEARCH_HELP',
                                        'text' => 'Default value: 10. Set maximum availability value to filter results.'));
                
                return $text;
            }
            
            /*
             * Users settings text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function settingsUsers($text){
                array_push($text, array('key' => 'PARENT_SETTINGS_USERS',
                                        'parent' => '',
                                        'text' => 'Settings - Users permissions'));
                
                array_push($text, array('key' => 'SETTINGS_USERS_TITLE',
                                        'parent' => 'PARENT_SETTINGS_USERS',
                                        'text' => 'Users permissions'));
                /*
                 * Users permissions.
                 */
                array_push($text, array('key' => 'SETTINGS_USERS_PERMISSIONS',
                                        'parent' => 'PARENT_SETTINGS_USERS',
                                        'text' => 'Set users permissions to use the booking system.'));
                array_push($text, array('key' => 'SETTINGS_USERS_PERMISSIONS_ADMINISTRATORS_LABEL',
                                        'parent' => 'PARENT_SETTINGS_USERS',
                                        'text' => 'Allow %s users to view all the calendars from all the users and/or individually add/edit them.'));
                array_push($text, array('key' => 'SETTINGS_USERS_PERMISSIONS_LABEL',
                                        'parent' => 'PARENT_SETTINGS_USERS',
                                        'text' => 'Allow %s users to view the plugin and individually edit only their own calendars.'));
                /*
                 * Users custom posts permissions.
                 */
                array_push($text, array('key' => 'SETTINGS_USERS_PERMISSIONS_CUSTOM_POSTS',
                                        'parent' => 'PARENT_SETTINGS_USERS',
                                        'text' => 'Set users permissions to use custom posts'));
                array_push($text, array('key' => 'SETTINGS_USERS_PERMISSIONS_CUSTOM_POSTS_LABEL',
                                        'parent' => 'PARENT_SETTINGS_USERS',
                                        'text' => 'Allow %s users to use custom posts.'));
                /*
                 * Individual users permissions.
                 */
                array_push($text, array('key' => 'SETTINGS_USERS_PERMISSIONS_INDIVIDUAL',
                                        'parent' => 'PARENT_SETTINGS_USERS',
                                        'text' => 'Set permissions on individual users'));
                /*
                 * Search filters.
                 */
                array_push($text, array('key' => 'SETTINGS_USERS_PERMISSIONS_FILTERS_ROLE',
                                        'parent' => 'PARENT_SETTINGS_USERS',
                                        'text' => 'Change role to'));
                array_push($text, array('key' => 'SETTINGS_USERS_PERMISSIONS_FILTERS_ROLE_ALL',
                                        'parent' => 'PARENT_SETTINGS_USERS',
                                        'text' => 'All'));
                
                array_push($text, array('key' => 'SETTINGS_USERS_PERMISSIONS_FILTERS_ORDER_BY',
                                        'parent' => 'PARENT_SETTINGS_USERS',
                                        'text' => 'Order by'));
                array_push($text, array('key' => 'SETTINGS_USERS_PERMISSIONS_FILTERS_ORDER_BY_EMAIL',
                                        'parent' => 'PARENT_SETTINGS_USERS',
                                        'text' => 'Email'));
                array_push($text, array('key' => 'SETTINGS_USERS_PERMISSIONS_FILTERS_ORDER_BY_ID',
                                        'parent' => 'PARENT_SETTINGS_USERS',
                                        'text' => 'ID'));
                array_push($text, array('key' => 'SETTINGS_USERS_PERMISSIONS_FILTERS_ORDER_BY_USERNAME',
                                        'parent' => 'PARENT_SETTINGS_USERS',
                                        'text' => 'Username'));
                
                array_push($text, array('key' => 'SETTINGS_USERS_PERMISSIONS_FILTERS_ORDER',
                                        'parent' => 'PARENT_SETTINGS_USERS',
                                        'text' => 'Order'));
                array_push($text, array('key' => 'SETTINGS_USERS_PERMISSIONS_FILTERS_ORDER_ASCENDING',
                                        'parent' => 'PARENT_SETTINGS_USERS',
                                        'text' => 'Ascending'));
                array_push($text, array('key' => 'SETTINGS_USERS_PERMISSIONS_FILTERS_ORDER_DESCENDING',
                                        'parent' => 'PARENT_SETTINGS_USERS',
                                        'text' => 'Descending'));
                
                array_push($text, array('key' => 'SETTINGS_USERS_PERMISSIONS_FILTERS_SEARCH',
                                        'parent' => 'PARENT_SETTINGS_USERS',
                                        'text' => 'Search'));
                /*
                 * Users list.
                 */
                array_push($text, array('key' => 'SETTINGS_USERS_PERMISSIONS_LIST_ID',
                                        'parent' => 'PARENT_SETTINGS_USERS',
                                        'text' => 'ID'));
                array_push($text, array('key' => 'SETTINGS_USERS_PERMISSIONS_USERNAME',
                                        'parent' => 'PARENT_SETTINGS_USERS',
                                        'text' => 'Username'));
                array_push($text, array('key' => 'SETTINGS_USERS_PERMISSIONS_EMAIL',
                                        'parent' => 'PARENT_SETTINGS_USERS',
                                        'text' => 'Email'));
                array_push($text, array('key' => 'SETTINGS_USERS_PERMISSIONS_ROLE',
                                        'parent' => 'PARENT_SETTINGS_USERS',
                                        'text' => 'Role'));
                array_push($text, array('key' => 'SETTINGS_USERS_PERMISSIONS_VIEW',
                                        'parent' => 'PARENT_SETTINGS_USERS',
                                        'text' => 'View all calendars'));
                array_push($text, array('key' => 'SETTINGS_USERS_PERMISSIONS_USE',
                                        'parent' => 'PARENT_SETTINGS_USERS',
                                        'text' => 'Use booking system'));
                array_push($text, array('key' => 'SETTINGS_USERS_PERMISSIONS_USE_CUSTOM_POSTS',
                                        'parent' => 'PARENT_SETTINGS_USERS',
                                        'text' => 'Use custom posts'));
                array_push($text, array('key' => 'SETTINGS_USERS_PERMISSIONS_USE_CALENDAR',
                                        'parent' => 'PARENT_SETTINGS_USERS',
                                        'text' => 'Use calendar'));
                
                return $text;
            }
            
            /*
             * Users settings help text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function settingsUsersHelp($text){
                array_push($text, array('key' => 'PARENT_SETTINGS_USERS_HELP',
                                        'parent' => '',
                                        'text' => 'Settings - Users Permissions - Help'));
                
                array_push($text, array('key' => 'SETTINGS_USERS_PERMISSIONS_HELP',
                                        'parent' => 'PARENT_SETTINGS_USERS_HELP',
                                        'text' => 'Allow administrators to edit/view all calendars and other users to use the plugin.'));
                array_push($text, array('key' => 'SETTINGS_USERS_CUSTOM_POSTS_PERMISSIONS_HELP',
                                        'parent' => 'PARENT_SETTINGS_USERS_HELP',
                                        'text' => 'Allow users to use custom posts.'));
                
                return $text;
            }
            
            /*
             * Licences settings text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function settingsLicences($text){
                array_push($text, array('key' => 'PARENT_SETTINGS_LICENCES',
                                        'parent' => '',
                                        'text' => 'Settings - Licences'));
                
                array_push($text, array('key' => 'SETTINGS_LICENCES_TITLE',
                                        'parent' => 'PARENT_SETTINGS_LICENCES',
                                        'text' => 'Licences'));
                array_push($text, array('key' => 'SETTINGS_LICENCES_TITLE_PRO',
                                        'parent' => 'PARENT_SETTINGS_LICENCES',
                                        'text' => 'Pinpoint Booking System PRO licence'));
                
                array_push($text, array('key' => 'SETTINGS_LICENCES_STATUS',
                                        'parent' => 'PARENT_SETTINGS_LICENCES',
                                        'text' => 'Status'));
                array_push($text, array('key' => 'SETTINGS_LICENCES_STATUS_ACTIVATE',
                                        'parent' => 'PARENT_SETTINGS_LICENCES',
                                        'text' => 'Activate'));
                array_push($text, array('key' => 'SETTINGS_LICENCES_STATUS_DEACTIVATE',
                                        'parent' => 'PARENT_SETTINGS_LICENCES',
                                        'text' => 'Deactivate'));
                array_push($text, array('key' => 'SETTINGS_LICENCES_STATUS_ACTIVATED',
                                        'parent' => 'PARENT_SETTINGS_LICENCES',
                                        'text' => 'Activated'));
                array_push($text, array('key' => 'SETTINGS_LICENCES_STATUS_ACTIVATED_SUCCESS',
                                        'parent' => 'PARENT_SETTINGS_LICENCES',
                                        'text' => 'The item was successfully activated.'));
                array_push($text, array('key' => 'SETTINGS_LICENCES_STATUS_ACTIVATED_ERROR',
                                        'parent' => 'PARENT_SETTINGS_LICENCES',
                                        'text' => 'There is an error when trying to activate the item. Please try again.'));
                array_push($text, array('key' => 'SETTINGS_LICENCES_STATUS_DEACTIVATED',
                                        'parent' => 'PARENT_SETTINGS_LICENCES',
                                        'text' => 'Deactivated'));
                array_push($text, array('key' => 'SETTINGS_LICENCES_STATUS_DEACTIVATED_SUCCESS',
                                        'parent' => 'PARENT_SETTINGS_LICENCES',
                                        'text' => 'The item was successfully deactivated.'));
                array_push($text, array('key' => 'SETTINGS_LICENCES_STATUS_DEACTIVATED_ERROR',
                                        'parent' => 'PARENT_SETTINGS_LICENCES',
                                        'text' => 'There is an error when trying to deactivate the item. Please try again.'));
                array_push($text, array('key' => 'SETTINGS_LICENCES_STATUS_TIMEOUT_ERROR',
                                        'parent' => 'PARENT_SETTINGS_LICENCES',
                                        'text' => 'The connection to the server timed out. Please try again later.'));
                
                array_push($text, array('key' => 'SETTINGS_LICENCES_KEY',
                                        'parent' => 'PARENT_SETTINGS_LICENCES',
                                        'text' => 'Licence key'));
                array_push($text, array('key' => 'SETTINGS_LICENCES_EMAIL',
                                        'parent' => 'PARENT_SETTINGS_LICENCES',
                                        'text' => 'Licence email'));
                
                return $text;
            }
            
            /*
             * Licences settings help text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function settingsLicencesHelp($text){
                array_push($text, array('key' => 'PARENT_SETTINGS_LICENCES_HELP',
                                        'parent' => '',
                                        'text' => 'Settings - Licences - Help'));
                
                array_push($text, array('key' => 'SETTINGS_LICENCES_HELP',
                                        'parent' => 'PARENT_SETTINGS_LICENCES_HELP',
                                        'text' => 'Activate the plugin and add-ons to check and receive automatic updates. Activation is not required to use the items.'));
                
                array_push($text, array('key' => 'SETTINGS_LICENCES_KEY_HELP',
                                        'parent' => 'PARENT_SETTINGS_LICENCES_HELP',
                                        'text' => 'Enter the licence key which you received with your order confirmation email. You can also find it in %s'));
                array_push($text, array('key' => 'SETTINGS_LICENCES_EMAIL_HELP',
                                        'parent' => 'PARENT_SETTINGS_LICENCES_HELP',
                                        'text' => 'Enter the email you are using on %s'));
                
                return $text;
            }
        }
    }