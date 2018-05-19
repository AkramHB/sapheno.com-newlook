var NF_Popup_Cookies = {
	set_popup_cookie: function ( cookie_settings ) {
		if ( cookie_settings != '' ) {
			var popup_id = cookie_settings.popup_id;
			var closed_times = cookie_settings.times;
			var expiry_length = cookie_settings.expiry_length;
			var expiry_type = cookie_settings.expiry_type;
			var expiry_days = this.get_cookie_expiry_days( expiry_length, expiry_type );
			//set how many times popup is closed by user
			var current_closed_times = this.get_cookie( 'nf_popups_close_counter_' + popup_id );
			if ( current_closed_times != '' ) {
				current_closed_times++;
			} else {
				current_closed_times = 1;
			}
			//	console.log(current_closed_times);
			//update current times popup closed
			this.set_cookie( 'nf_popups_close_counter_' + popup_id, current_closed_times, expiry_days );
			var counter_start_date = this.get_cookie( 'nf_popups_counter_start_date_' + popup_id );
			if ( counter_start_date == '' ) {
				//set the expiry first time
				this.set_cookie( 'nf_popups_counter_start_date_' + popup_id, this.get_current_date(), expiry_days );
			}

			//set main cookie 
			// var hide_popup_cookie = this.get_cookie( 'nf_popups_hide_' + popup_id );
			// //only set cookie if it doesn't exists
			// if( hide_popup_cookie ==' '){
			// 	this.set_cookie( 'nf_popups_hide_' + popup_id, 1, expiry_days );
			// 	this.set_cookie( 'nf_popups_hide_' + popup_id+'_created', 1, expiry_days );
			// }
		}
		//
	},
	get_cookie_expiry_days: function ( expiry_length, expiry_type ) {
		if ( expiry_length == '' ) {
			return 1;
		}
		switch ( expiry_type ) {
			case 'D':
				return expiry_length;
				break;
			case 'W':
				return expiry_length * 7;
				break;
			case 'M':
				return expiry_length * 30;
				break;
			case 'Y':
				return expiry_length * 365;
				break;
		}

	},
	set_cookie: function ( cname, cvalue, exdays ) {
		var d = new Date();
		d.setTime( d.getTime() + ( exdays * 24 * 60 * 60 * 1000 ) );
		var expires = "expires=" + d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	},
	get_cookie: function ( cname ) {
		var name = cname + "=";
		var ca = document.cookie.split( ';' );
		for ( var i = 0; i < ca.length; i++ ) {
			var c = ca[ i ];
			while ( c.charAt( 0 ) == ' ' ) {
				c = c.substring( 1 );
			}
			if ( c.indexOf( name ) == 0 ) {
				return c.substring( name.length, c.length );
			}
		}
		return "";
	},
	get_current_date: function () {
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth() + 1; //January is 0!

		var yyyy = today.getFullYear();
		if ( dd < 10 ) {
			dd = '0' + dd;
		}
		if ( mm < 10 ) {
			mm = '0' + mm;
		}
		var today = dd + '/' + mm + '/' + yyyy;
		return today;
	},
	check_popup_cookie_validity: function ( cookie_settings ) {
		var popup_id = cookie_settings.popup_id;
		var expiry_length = cookie_settings.expiry_length;
		var expiry_type = cookie_settings.expiry_type;
		var expiry_days = this.get_cookie_expiry_days( expiry_length, expiry_type );

		var counter_start_date = this.get_cookie( 'nf_popups_counter_start_date_' + popup_id );
		var current_date = this.get_current_date();
		var diff = this.date_diff_indays( counter_start_date, current_date );
		// console.log( diff );
		// console.log( expiry_days );
		// console.log( current_date );

		if ( diff > expiry_days ) {
			// reset close counter after n days
			this.set_cookie( 'nf_popups_close_counter_' + popup_id, 1, 500 );
			// reset the popup shown date 
			this.set_cookie( 'nf_popups_counter_start_date_' + popup_id, '', 500 );
		}
	},
	date_diff_indays: function ( date1, date2 ) {
		dt1 = new Date( date1 );
		dt2 = new Date( date2 );
		return Math.floor( ( Date.UTC( dt2.getFullYear(), dt2.getMonth(), dt2.getDate() ) - Date.UTC( dt1.getFullYear(), dt1.getMonth(), dt1.getDate() ) ) / ( 1000 * 60 * 60 * 24 ) );
	}
}
