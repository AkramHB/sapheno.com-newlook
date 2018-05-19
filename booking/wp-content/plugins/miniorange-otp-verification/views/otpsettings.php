<?php 

echo'	<div class="mo_registration_divided_layout">
			<div class="mo_registration_table_layout">';

			is_customer_registered();

echo'			<table style="width:100%">
					<form name="f" method="post" action="" id="mo_otp_verification_settings">
						<input type="hidden" name="option" value="mo_otp_extra_settings" />
						<tr>
							<td colspan="2">
								<h2>'.mo_("OTP SETTINGS").'
								<span style="float:right;margin-top:-10px;">
									<input type="submit" '.$disabled.' name="save" id="save" class="button button-primary button-large" value="'.mo_("Save Settings").'"/>
								</span>
								</h2><hr>
							</td>
						</tr>';

						if($showTransactionOptions){
							echo '	<tr>
										<td colspan="2"><strong><i>'.mo_("REMAINING TRANSACTION: ").'</i></strong></td>
									</tr>
									<tr>
										<td colspan="2">
											<input type="checkbox" '.$disabled.' name="mo_show_remaining_trans" value="1"'.$show_trans.' /> '.mo_("Show Remaining Phone and Email Transactions as a baner in your dashboard?").'
											<div class="mo_otp_note" style="color:#942828;">
												 <i>'.mo_("You can still see your remaining transactions in the <b>At a Glance section</b> of your admin dashboard").'</i>
											</div>
										</td>
									</tr>
									<tr><td colspan="2"><hr></td></tr>
									<tr>
										<td><strong><i>'.mo_("OTP LENGTH: ").'</i></strong></td>
										<td><strong><i>'.mo_("OTP VALIDITY (in mins): ").'</i></strong></td>
									</tr>
									<tr>
										<td width="50%">
											<div class="mo_otp_note" style="padding:10px;">
												<div class="mo_otp_dropdown_note" data-toggle="how_to_change_length"><span style="color:#942828;"><i>'.mo_("Click here to get Steps to change OTP Length").'</i></span></div>
												<div id="how_to_change_length" hidden>
													<span style="color:#942828;"><i>'.mo_("Follow these steps to change the length of your OTP. The OTP generated will be of the length specified:").'</i></span>
													<ol>
														<li>'.mo_("Click on the button below.").'</li>
														<li>'.mo_("Login using the Credentials you used to register for this plugin.").'</li>
														<li>'.mo_("You will be presented with a <b><i>General Product Settings Page</i></b>.").'</li>
														<li>'.mo_("On this page search for <b><i>One Time Password Preferences Settings</i></b>.").'</li>
														<li>'.mo_("Choose your OTP length from the OTP length dropdown.").'</li>
														<li>'.mo_("Click on the Save button to save your settings.").'</li>
													</ol>
													<div style="text-align:center">
														<input '. $disabled. ' type="button" 
															title="'.mo_("Need to be registered for this option to be available").'"  
															value="'.mo_("Change OTP Length").'" 
															onclick="extraSettings(\''.MoConstants::HOSTNAME.'\',\'/moas/customerpreferences\');" 
															class="button button-primary button-large" style="margin-right: 3%;">
													</div>
												</div>
											</div>
										</td>
										<td width="50%">
											<div class="mo_otp_note" style="padding:10px;">
												<div class="mo_otp_dropdown_note" data-toggle="how_to_change_validity"><span style="color:#942828;"><i>'.mo_("Click here to get Steps to change OTP Validity").'</span></i></div>
												<div id="how_to_change_validity" hidden>
													<span style="color:#942828;"><i>'.mo_("Follow these steps to change the time for how long the OTP will stay valid for:").'</i></span>
													<ol>
														<li>'.mo_("Click on the button below.").'</li>
														<li>'.mo_("Login using the Credentials you used to register for this plugin.").'</li>
														<li>'.mo_("You will be presented with a <b><i>General Product Settings Page</i></b>.").'</li>
														<li>'.mo_("On this page search for <b><i>One Time Password Preferences Settings</i></b>.").'</li>
														<li>'.mo_("Enter the  number in mins that you want the OTP to stay valid for in the OTP Validity textbox.").'</li>
														<li>'.mo_("Click on the Save button to save your settings.").'</li>
													</ol>
													<div style="text-align:center">
														<input '. $disabled. ' type="button" 
															title="'.mo_("Need to be registered for this option to be available").'"  
															value="'.mo_("Change OTP Validity").'" 
															onclick="extraSettings(\''.MoConstants::HOSTNAME.'\',\'/moas/customerpreferences\');" 
															class="button button-primary button-large" style="margin-right: 3%;">
													</div>
												</div>
											</div>
										</td>
									</tr>
									<tr><td colspan="2"><hr></td></tr>';
						}else{

						echo	'<tr>
									<td><strong><i>'.mo_("OTP LENGTH: ").'</i></strong></td>
									<td><strong><i>'.mo_("OTP VALIDITY (in mins): ").'</i></strong></td>
								</tr>
								<tr>
									<td>
										<input type="text" class="mo_registration_table_textbox" value="'.$mo_otp_length.'" name="mo_otp_length"/>
										<div class="mo_otp_note" style="color:#942828;">
											 <i>'.mo_("Enter the length that you want the OTP to be.<br/>Default is 5").'</i>
										</div>
									</td>
									<td>
										<input type="text" class="mo_registration_table_textbox" value="'.$mo_otp_validity.'" name="mo_otp_validity"/>
										<div class="mo_otp_note" style="color:#942828;">
											 <i>'.mo_("Enter the time in minutes an OTP will stay valid for.<br/>Default is 5 mins").'</i>
										</div>
									</td>
								</tr>
								<tr><td colspan="2"><hr></td></tr>';
						}

echo					'<tr>
							<td><strong><i>'.mo_("COUNTRY CODE: ").'</i></strong><br/></td>
						</tr>
						<tr>
							<td colspan="2">
								<strong><i>'.mo_("Select Default Country Code").': </i></strong>
							';

								get_country_code_dropdown(); 
								mo_draw_tooltip(MoMessages::showMessage('COUNTRY_CODE_HEAD'),MoMessages::showMessage('COUNTRY_CODE_BODY'));

								echo "<i style='margin-left:1%''>".mo_("Country Code").": <span id='country_code'></span></i> " ;

echo						'</td>
						</tr>
						<tr>
							<td colspan="2"><br/><input type="checkbox" '.$disabled.' name="show_dropdown_on_form" value="1"'.$show_dropdown_on_form.' /> '.mo_("Show a country code dropdown on the phone field.").'</td>
						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<tr>
							<td colspan="2"><strong><i>'.mo_("BLOCKED EMAIL DOMAINS: ").'</i></strong></td>
						</tr>
						<tr>
							<td colspan="2"><textarea name="mo_otp_blocked_email_domains" rows="5" style="width:100%" 
								placeholder="'.mo_(" Enter semicolon separated domains that you want to block. Eg. gmail.com ").'">'.$otp_blocked_email_domains.'</textarea></td>
						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<tr>
							<td colspan="2"><strong><i>'.mo_("BLOCKED PHONE NUMBERS: ").'</i></strong></td>
						</tr>
						<tr>
							<td colspan="2"><textarea name="mo_otp_blocked_phone_numbers" rows="5" style="width:100%" 
								placeholder="'.mo_(" Enter semicolon separated phone numbers (with country code) that you want to block. Eg. +1XXXXXXXX ").'">'.$otp_blocked_phones.'</textarea></td>
						</tr>
					</form>	
				</table>
			</div>
		</div>
		<form id="showExtraSettings" action="'. MoConstants::HOSTNAME.'/moas/login" target="_blank" method="post">
	       <input type="hidden" id="extraSettingsUsername" name="username" value=" '. $email.'"/>
	       <input type="hidden" id="extraSettingsRedirectURL" name="redirectUrl" value="" />
		</form>';			