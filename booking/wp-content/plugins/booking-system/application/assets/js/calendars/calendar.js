/*
 * Title                   : Pinpoint Booking System
 * File                    : application/assets/js/calendars/calendar.js
 * Author                  : Dot on Paper
 * Copyright               : © 2017 Dot on Paper
 * Website                 : https://www.dotonpaper.net
 * Description             : Calendar JavaScript class.
 */

DOT.methods.calendar = new function(){
    'use strict';
    
    /*
     * Private variables.
     */
    var $ = jQuery.noConflict();
    
    /*
     * Public variables.
     */
    this.settings = new Array();
    
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
    this.__construct = function(){
    };
    
    this.get = function(id){
	var post = new Array();
	
	/*
	 * Set post variables.
	 */
	post.push(DOT.ajax.var+'='+DOT.ajax.keys['user_calendars_data']);
	post.push('calendar_id='+id);
	
	$(document).ready(function(){
	    $.post(DOT.ajax.url, post.join('&'), function(data){
		data = JSON.parse($.trim(data));
		
		DOT.methods.calendar_availability.data[id] = data['availability'];
	    }).fail(function(data){
		// console.log(data.status+': '+data.statusText);
	    });
	});
    };

    return this.__construct();
};