<?php

/*
* Title                   : Pinpoint Booking System WordPress Plugin
* Version                 : 2.1.8
* File                    : includes/translation/class-translation-text-locations.php
* File Version            : 1.0.1
* Created / Last Modified : 17 March 2016
* Author                  : Dot on Paper
* Copyright               : © 2016 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Locations translation text PHP class.
*/

    if (!class_exists('DOPBSPTranslationTextLocations')){
        class DOPBSPTranslationTextLocations{
            /*
             * Constructor
             */
            function __construct(){
                /*
                 * Initialize locations text.
                 */
                add_filter('dopbsp_filter_translation_text', array(&$this, 'locations'));
                
                add_filter('dopbsp_filter_translation_text', array(&$this, 'locationsLocation'));
                add_filter('dopbsp_filter_translation_text', array(&$this, 'locationsAddLocation'));
                add_filter('dopbsp_filter_translation_text', array(&$this, 'locationsDeleteLocation'));
                
                add_filter('dopbsp_filter_translation_text', array(&$this, 'locationsHelp'));
            }
            
            /*
             * Locations text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function locations($text){
                array_push($text, array('key' => 'PARENT_LOCATIONS',
                                        'parent' => '',
                                        'text' => 'Locations'));
                
                array_push($text, array('key' => 'LOCATIONS_TITLE',
                                        'parent' => 'PARENT_LOCATIONS',
                                        'text' => 'Locations'));
                array_push($text, array('key' => 'LOCATIONS_CREATED_BY',
                                        'parent' => 'PARENT_LOCATIONS',
                                        'text' => 'Created by'));
                array_push($text, array('key' => 'LOCATIONS_LOAD_SUCCESS',
                                        'parent' => 'PARENT_LOCATIONS',
                                        'text' => 'Locations list loaded.'));
                array_push($text, array('key' => 'LOCATIONS_NO_LOCATIONS',
                                        'parent' => 'PARENT_LOCATIONS',
                                        'text' => 'No locations. Click the above "plus" icon to add a new one.'));
                
                return $text;
            }
            
            /*
             * Locations - Location text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function locationsLocation($text){
                array_push($text, array('key' => 'PARENT_LOCATIONS_LOCATION',
                                        'parent' => '',
                                        'text' => 'Locations - Location'));
                
                array_push($text, array('key' => 'LOCATIONS_LOCATION_NAME',
                                        'parent' => 'PARENT_LOCATIONS_LOCATION',
                                        'text' => 'Name'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_MAP',
                                        'parent' => 'PARENT_LOCATIONS_LOCATION',
                                        'text' => 'Enter the address'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_ADDRESS',
                                        'parent' => 'PARENT_LOCATIONS_LOCATION',
                                        'text' => 'Address'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_ALT_ADDRESS',
                                        'parent' => 'PARENT_LOCATIONS_LOCATION',
                                        'text' => 'Alternative address'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_CALENDARS',
                                        'parent' => 'PARENT_LOCATIONS_LOCATION',
                                        'text' => 'Add calendars to location'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_NO_CALENDARS',
                                        'parent' => 'PARENT_LOCATIONS_LOCATION',
                                        'text' => 'There are no calendars created. Go to <a href="%s">calendars</a> page to create one.'));
		
                array_push($text, array('key' => 'LOCATIONS_LOCATION_SHARE',
                                        'parent' => 'PARENT_LOCATIONS_LOCATION',
                                        'text' => 'Share your location with '));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_LINK',
                                        'parent' => 'PARENT_LOCATIONS_LOCATION',
                                        'text' => 'Enter the link of your site'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_IMAGE',
                                        'parent' => 'PARENT_LOCATIONS_LOCATION',
                                        'text' => 'Enter a link with an image'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESSES',
                                        'parent' => 'PARENT_LOCATIONS_LOCATION',
                                        'text' => 'Select what kind of businesses you have at this location'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESSES_OTHER',
                                        'parent' => 'PARENT_LOCATIONS_LOCATION',
                                        'text' => 'Enter businesses that are not in the list'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_LANGUAGES',
                                        'parent' => 'PARENT_LOCATIONS_LOCATION',
                                        'text' => 'Enter the languages that are spoken in your business'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_EMAIL',
                                        'parent' => 'PARENT_LOCATIONS_LOCATION',
                                        'text' => 'Your email'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_SHARE_SUBMIT',
                                        'parent' => 'PARENT_LOCATIONS_LOCATION',
                                        'text' => 'Share to PINPOINT.WORLD'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_SHARE_SUBMIT_SUCCESS',
                                        'parent' => 'PARENT_LOCATIONS_LOCATION',
                                        'text' => 'Your location has been sent to PINPOINT.WORLD'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_SHARE_SUBMIT_ERROR',
                                        'parent' => 'PARENT_LOCATIONS_LOCATION',
                                        'text' => 'Please complete all location data. Only alternative address is mandatory and you need to select a businness or enter another business.'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_SHARE_SUBMIT_ERROR_DUPLICATE',
                                        'parent' => 'PARENT_LOCATIONS_LOCATION',
                                        'text' => 'The location has already been submitted to PINPOINT.WORLD'));
		
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_APARTMENT',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Appartment'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_BABY_SITTER',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Baby sitter'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_BAR',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Bar'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_BASKETBALL_COURT',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Basketball court(s)'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_BEAUTY_SALON',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Beauty salon'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_BIKES',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Bikes'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_BOAT',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Boat'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_BUSINESS',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Business'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_CAMPING',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Camping'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_CAMPING_GEAR',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Camping gear'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_CARS',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Cars'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_CHEF',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Chef'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_CINEMA',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Cinema'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_CLOTHES',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Clothes'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_COSTUMES',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Costumes'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_CLUB',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                       
					'text' => 'Club'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_DANCE_INSTRUCTOR',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Dance instructor'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_DENTIST',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Dentist'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_DESIGNER_HANDBAGS',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Designer handbags'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_DOCTOR',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Doctor'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_ESTHETICIAN',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Esthetician'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_FOOTBALL_COURT',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Football court(s)'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_FISHING',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Fishing'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_GADGETS',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Gadgets'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_GAMES',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Games'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_GOLF',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Golf'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_HAIRDRESSER',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Hairdresser'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_HEALTH_CLUB',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Health club'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_HOSPITAL',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Hospital'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_HOTEL',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Hotel'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_HUNTING',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Hunting'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_LAWYER',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Lawyer'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_LIBRARY',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Library'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_MASSAGE',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Massage'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_MUSIC_BAND',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Music band'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_NAILS_SALON',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Nails salon'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_PARTY_SUPPLIES',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Party supplies'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_PERSONAL_TRAINER',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Personal trainer'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_PET_CARE',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Pet care'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_PHOTO_EQUIPMENT',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Photo equipment'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_PHOTOGRAPHER',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Photographer'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_PILLATES_INSTRUCTOR',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Pillates instructor'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_PLANE_TICKETS',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Plane tickets'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_PLANES',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Plane(s)'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_RESTAURANT',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Restaurant'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_SHOES',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Shoes'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_SNOW_EQUIPMENT',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Snow equipment'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_SPA',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Spa'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_SPORTS_COACH',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Sports coach'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_TAXIES',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Taxies'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_TENIS_COURT',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Tenis court(s)'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_THEATRE',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Theatre'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_VILLA',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Villa'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_WEAPONS',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Weapons'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESS_WORKING_TOOLS',                                        
					'parent' => 'PARENT_LOCATIONS_LOCATION',                                        
					'text' => 'Working tools'));
                
                array_push($text, array('key' => 'LOCATIONS_LOCATION_LOADED',
                                        'parent' => 'PARENT_LOCATIONS_LOCATION',
                                        'text' => 'Location loaded.'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_NO_GOOGLE_MAPS',
                                        'parent' => 'PARENT_LOCATIONS_LOCATION',
                                        'text' => 'Google maps did not load. Please refresh the page to try again.'));
                
                return $text;
            }
            
            /*
             * Locations - Add location text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function locationsAddLocation($text){
                array_push($text, array('key' => 'PARENT_LOCATIONS_ADD_LOCATION',
                                        'parent' => '',
                                        'text' => 'Locations - Add location'));
                
                array_push($text, array('key' => 'LOCATIONS_ADD_LOCATION_NAME',
                                        'parent' => 'PARENT_LOCATIONS_ADD_LOCATION',
                                        'text' => 'New location'));
                array_push($text, array('key' => 'LOCATIONS_ADD_LOCATION_SUBMIT',
                                        'parent' => 'PARENT_LOCATIONS_ADD_LOCATION',
                                        'text' => 'Add location'));
                array_push($text, array('key' => 'LOCATIONS_ADD_LOCATION_ADDING',
                                        'parent' => 'PARENT_LOCATIONS_ADD_LOCATION',
                                        'text' => 'Adding a new location ...'));
                array_push($text, array('key' => 'LOCATIONS_ADD_LOCATION_SUCCESS',
                                        'parent' => 'PARENT_LOCATIONS_ADD_LOCATION',
                                        'text' => 'You have succesfully added a new location.'));
                
                return $text;
            }
            
            /*
             * Locations - Delete location text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function locationsDeleteLocation($text){
                array_push($text, array('key' => 'PARENT_LOCATIONS_DELETE_LOCATION',
                                        'parent' => '',
                                        'text' => 'Locations - Delete location'));
                
                array_push($text, array('key' => 'LOCATIONS_DELETE_LOCATION_CONFIRMATION',
                                        'parent' => 'PARENT_LOCATIONS_DELETE_LOCATION',
                                        'text' => 'Are you sure you want to delete this location?'));
                array_push($text, array('key' => 'LOCATIONS_DELETE_LOCATION_SUBMIT',
                                        'parent' => 'PARENT_LOCATIONS_DELETE_LOCATION',
                                        'text' => 'Delete location'));
                array_push($text, array('key' => 'LOCATIONS_DELETE_LOCATION_DELETING',
                                        'parent' => 'PARENT_LOCATIONS_DELETE_LOCATION',
                                        'text' => 'Deleting location ...'));
                array_push($text, array('key' => 'LOCATIONS_DELETE_LOCATION_SUCCESS',
                                        'parent' => 'PARENT_LOCATIONS_DELETE_LOCATION',
                                        'text' => 'You have succesfully deleted the location.'));
                
                return $text;
            }
            
            /*
             * Locations - Help text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function locationsHelp($text){
                array_push($text, array('key' => 'PARENT_LOCATIONS_HELP',
                                        'parent' => '',
                                        'text' => 'Locations - Help'));
                
                array_push($text, array('key' => 'LOCATIONS_HELP',
                                        'parent' => 'PARENT_LOCATIONS_HELP',
                                        'text' => 'Click on a location item to open the editing area.'));
                array_push($text, array('key' => 'LOCATIONS_ADD_LOCATION_HELP',
                                        'parent' => 'PARENT_LOCATIONS_HELP',
                                        'text' => 'Click on the "plus" icon to add a location.'));
                
                /*
                 * Location help.
                 */
                array_push($text, array('key' => 'LOCATIONS_LOCATION_HELP',
                                        'parent' => 'PARENT_LOCATIONS_HELP',
                                        'text' => 'Click the "trash" icon to delete the location.'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_NAME_HELP',
                                        'parent' => 'PARENT_LOCATIONS_HELP',
                                        'text' => 'Change location name.'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_ADDRESS_HELP',
                                        'parent' => 'PARENT_LOCATIONS_HELP',
                                        'text' => 'Enter location address or drag the marker on the map to select it.'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_ALT_ADDRESS_HELP',
                                        'parent' => 'PARENT_LOCATIONS_HELP',
                                        'text' => 'Enter an alternative address if the marker is in the correct position but the address is not right.'));
		
                array_push($text, array('key' => 'LOCATIONS_LOCATION_LINK_HELP',
                                        'parent' => 'PARENT_LOCATIONS_HELP',
                                        'text' => 'Enter the link of your site. Make sure it redirects to a page where people can make a booking or can view relevant content.'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_IMAGE_HELP',
                                        'parent' => 'PARENT_LOCATIONS_HELP',
                                        'text' => 'Make sure the image is relevant to your business.'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESSES_HELP',
                                        'parent' => 'PARENT_LOCATIONS_HELP',
                                        'text' => 'Select what kind of businesses you have at this location. You can select multiple businesses.'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_BUSINESSES_OTHER_HELP',
                                        'parent' => 'PARENT_LOCATIONS_HELP',
                                        'text' => 'We will add them in the list as soon as possible.'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_LANGUAGES_HELP',
                                        'parent' => 'PARENT_LOCATIONS_HELP',
                                        'text' => 'Enter the languages that are spoken in your business. You can select multiple languages.'));
                array_push($text, array('key' => 'LOCATIONS_LOCATION_EMAIL_HELP',
                                        'parent' => 'PARENT_LOCATIONS_HELP',
                                        'text' => 'Enter the email where we can contact you if there are problems with your submission'));
                
                return $text;
            }
        }
    }