<?php

echo'	<div class="mo_registration_divided_layout">
			<div class="mo_registration_table_layout">';

			is_customer_registered();

echo'			<form name="f" method="post" action="" id="mo_otp_verification_settings">
					<input type="hidden" id="error_message" name="error_message" value="">
					<input type="hidden" name="option" value="mo_customer_validation_settings" />
					<table style="width:100%">
						<tr>
							<td colspan="2">
								<h2>'.mo_("CONFIGURE YOUR FORM").'</h2>
								<hr/>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<div class="mo_otp_note">
									<b><div class="mo_otp_dropdown_note" data-toggle="how_to_use_the_otp_plugin">
										'.mo_('HOW DO I USE THE PLUGIN?').'
										</div></b>
									<div id="how_to_use_the_otp_plugin" hidden>
										<b>'.mo_("By following these easy steps you can verify your users email or phone number instantly").':
										<ol>
											<li>'.mo_("Select the form from the list below.");  
												mo_draw_tooltip(MoMessages::showMessage('FORM_NOT_AVAIL_HEAD'),
																MoMessages::showMessage('FORM_NOT_AVAIL_BODY'));
		echo'								</li>
											<li>'.mo_("Save your settings.").'</li>
											<li>'.mo_("Log out and go to your registration or landing page for testing.").'</li>
											<li>'.mo_("To customize your SMS/Email messages/gateway check under").' 
													<a href="'.$config.'"> '.mo_("SMS/Email Templates Tab").'</a></li>
											<li>'.mo_("For any query related to custom SMS/Email messages/gateway check").' 
												<a href="'.$help_url.'"> '.mo_("Help & Troubleshooting Tab").'</a></li>
											<li>
											<div>
												<i><b>'.mo_("Cannot see your registration form in the list above? Have your own custom registration form?"
															).'</b></i>';
												mo_draw_tooltip(MoMessages::showMessage('FORM_NOT_AVAIL_HEAD'),
																MoMessages::showMessage('FORM_NOT_AVAIL_BODY'));
		echo'								</div>
											</li>
											</b>
										</ol>
									</div>
								</div>
								<div class="mo_otp_note" style="color:#942828;">
									<b><div class="mo_otp_dropdown_note" data-toggle="wp_sms_integration">
										'.mo_('NEED A DEVELOPER DOCUMENTATION? WISH TO INTEGRATE YOUR FORM WITH THE PLUGIN?').'
										</div></b>
									<div id="wp_sms_integration" hidden>
										'.mo_( " <i>If you wish to integrate the plugin with your form then you can follow our documentation. Contact us at info@miniorange.com or use the support section on the right to get the documentaion.</i>").'
									</div>
								</div>
								<div class="mo_otp_note" style="color:#942828;">
									<b><div class="mo_otp_dropdown_note" data-toggle="wp_sms_transaction_upgrade">
										'.mo_('HOW DO I BUY MORE TRANSACTIONS? HOW DO I UPGRADE?').'
										</div></b>
									<div id="wp_sms_transaction_upgrade" hidden>
										<i>'.mo_( "You can upgrade and recharge at any time. You can even configure any external SMS/Email gateway provider with the plugin. <a href='".$license_url."'>Click Here</a> or the upgrade button on the top of the page to check our pricing and plans.").'</i>
									</div>
								</div>
								<div class="mo_otp_note" style="color:#942828;">
									<div class="mo_corner_ribbon shadow">'.mo_("NEW").'</div>
									<b><div class="mo_otp_dropdown_note" data-toggle="wc_sms_notif_addon" style="color:#942828;margin-left: 50px;">
										'.mo_('LOOKING FOR A WOOCOMMERCE SMS NOTIFICATION PLUGIN?').'
										</div></b>
									<div id="wc_sms_notif_addon" style="margin-left: 20px;">
										'.mo_( " <b> Looking for a plugin that will send out SMS notifications to users and admin for WooCommerce? </b> <i>We have a separate add-on for that. Contact us at info@miniorange.com or use the support section on the right and we will help you get started.</i>").'
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<tr>
							<td>
								<h2>'.mo_("Select your form from the list").': </h2>
								<!--<div style="margin-top:1em;margin-left:1%;float:left;"><input type="text" id="mo_search" 
									placeholder="Search for your form"></input></div>-->
								</td><td>';

								get_otp_verification_form_dropdown();
								mo_draw_tooltip(MoMessages::showMessage('FORM_NOT_AVAIL_HEAD'),MoMessages::showMessage('FORM_NOT_AVAIL_BODY'));
echo'							
							</td>
						</tr>
					</table>
					<table id="mo_forms" style="width: 100%;">
						<tr>
							<td><strong><i>'.mo_("REGISTRATION FORMS").'</i></strong><hr></td>
						</tr>';

						show_form_details('forms',$controller,$disabled,$page_list);

echo'					</tr>
					</table>
					<br>
					<table id="mo_forms" style="width: 100%;">
						<tr>
							<td><strong><i>'.mo_("LOGIN FORMS").'</i></strong><hr></td>
						</tr>
						<tr>
	 						<td>';
								include $controller . 'forms/wp-login.php';											
echo'						</td>
						</tr>
					</table>
					<input type="button" id="ov_settings_button"  
						title="'.mo_("Please select atleast one form from the list above to enable this button").'" 
						value="'.mo_("Save").'" style="float:left;margin-bottom:2%;" '.$disabled.'
						class="button button-primary button-large" />
			</form>
		</div>
	</div>';