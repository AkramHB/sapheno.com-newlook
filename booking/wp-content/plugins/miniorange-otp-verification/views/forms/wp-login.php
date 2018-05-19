<?php

echo'				<div class="mo_otp_form">
						<input type="checkbox" '.$disabled.' id="wp_login" class="app_enable" data-toggle="wp_login_options" name="mo_customer_validation_wp_login_enable" value="1"
								'.$wp_login_enabled.' /><strong>'. mo_( "WordPress Default Login Form <i>( SMS Verification )</i>" ).'</strong>';

echo'					<div class="mo_registration_help_desc" '.$wp_login_hidden.' id="wp_login_options">
							'. mo_( "Follow the following steps to add a users phone number in the database" ).': 
							<ol>									
								<li>'. mo_( "Enter the phone User Meta Key" );

								mo_draw_tooltip(MoMessages::showMessage('META_KEY_HEADER'),MoMessages::showMessage('META_KEY_BODY'));

echo'							: <input class="mo_registration_table_textbox" id="wp_login_phone_field_key" name="wp_login_phone_field_key" type="text" value="'.$wp_login_field_key.'">
								<div class="mo_otp_note" style="margin-top:1%">
									'.mo_( "If you don't know the metaKey against which the phone number is stored for all your users then put the default value as phone." ).'
								</div>
								<li>'. mo_( "Click on the Save Button below to save your settings." ).'</li>						
							</ol>
							<input type="checkbox" '.$disabled.' id="wp_login_reg" name="mo_customer_validation_wp_login_register_phone" value="1"
								'.$wp_login_enabled_type .' /><strong>'. mo_( "Allow the user to add a phone number if it does not exist." ).'</strong><br/><br/>
							<input type="checkbox" '.$disabled.' id="wp_login_admin" name="mo_customer_validation_wp_login_bypass_admin" 	value="1"
								'.$wp_login_admin.' /><strong>'. mo_( "Allow the administrator to bypass OTP verification during login." ).'</strong><br/><br/>
							<input type="checkbox" '.$disabled.' id="wp_login_admin" name="mo_customer_validation_wp_login_allow_phone_login" 	value="1"
								'.$wp_login_with_phone.' /><strong>'. mo_( "Allow users to login with their phone number." ).'</strong><br/><br/>
							<input type="checkbox" '.$disabled.' id="wp_login_admin" name="mo_customer_validation_wp_login_restrict_duplicates"	value="1"
								'.$wp_handle_duplicates.' /><strong>'. mo_( "Do not allow users to use the same phone number for multiple accounts." ).'</strong>
						</div>
					</div>';

