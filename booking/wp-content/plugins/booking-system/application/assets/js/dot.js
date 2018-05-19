/*
 * Title                   : Pinpoint Booking System
 * File                    : application/assets/js/dot.js
 * Author                  : Dot on Paper
 * Copyright               : © 2017 Dot on Paper
 * Website                 : https://www.dotonpaper.net
 * Description             : DOT JavaScript class.
 */

var DOT = new function(){
    this.ajax = {
	keys: new Array(),
	var: 'action',
	url: ''
    };
    this.methods = {};
};

DOT.ajax.keys['user_calendars_data'] = 'pbs_user_calendars_data';