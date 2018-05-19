<?php

echo '<div class="mo_registration_divided_layout">
				<div class="mo_registration_table_layout">';
				is_customer_registered();

		echo '<table style="width: 100%;">
			<tr>
				<td colspan="3">
					<h3>'.mo_("SMS & EMAIL CONFIGURATION").'</h3><hr>
				</td>
			</tr>
			<tr>
				<td>
					<b>'.mo_("Look at the sections below to customize the Email and SMS that you receive:").'</b>
					<ol>
						<li><b><a href="#sms">'.mo_("Custom SMS Template").'</a> :
							</b> '.mo_("Change the text of the message that you receive on your phones.").'</li>
						<li><b><a href="#sms">'.mo_("Custom SMS Gateway").'</a> :
							</b> '.mo_("You can configure settings to use your own SMS gateway.").'</li>
						<li><b><a href="#email">'.mo_("Custom Email Template").'</a> :
							</b> '.mo_("Change the text of the email that you receive.").'</li>
						<li><b><a href="#email">'.mo_("Custom Email Gateway").'</a> :
							</b> '.mo_("You can configure settings to use your own Email gateway.").'</li>
					</ol>
			</tr>
			<tr>
				<td>
					<div class="mo_otp_note" style="color:#942828;">
						<b><div class="mo_otp_dropdown_note" data-toggle="wp_sms_integration">
							'.mo_("HOW CAN I CHANGE THE SENDERID/NUMBER OF THE SMS I RECEIVE?").'
							</div></b><hr>
						<div id="wp_sms_integration">
							<i>'.MoMessages::showMessage('CHANGE_SENDER_ID_BODY').'</i>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="mo_otp_note" style="color:#942828;">
						<b><div class="mo_otp_dropdown_note" data-toggle="wp_sms_integration">
							'.mo_("HOW CAN I CHANGE THE SENDER EMAIL OF THE EMAIL I RECEIVE?").'
							</div></b><hr>
						<div id="wp_sms_integration">
							<i>'.MoMessages::showMessage('CHANGE_EMAIL_ID_BODY').'</i>
						</div>
					</div>
				</td>
			</tr>
			<tr id="sms">
				<td>
					<h2>'.mo_("SMS Configuration").'</h2><hr/>
				</td>
			</tr>
			<tr>
				<td>
					<b>'.mo_("Custom SMS Template:").'</b>
					<div style="padding:2%;background-color: rgba(111, 111, 111, 0.09);">
						<img src=" '. MOV_URL .$sms_template_guide_url. ' " />
						<div style="text-align:center">
							<input '. $disabled. ' type="button" 
								title="'.mo_("Need to be registered for this option to be available").'"  
								value="'.mo_("Change SMS Template").'" 
								onclick="extraSettings(\''.MoConstants::HOSTNAME.'\',\'/moas/showsmstemplate\');" 
								class="button button-primary button-large" style="margin-right: 3%;">
						</div>
					</div>
					<b>Custom SMS Gateway:</b>
					<div style="padding:2%;background-color: rgba(111, 111, 111, 0.09);">
						<img src=" '. MOV_URL .$sms_gateway_guide_url. '" />
						<div '. $hidden. ' style="text-align:center">
							<input '. $disabled. ' type="button" 
								title="'.mo_("Need to be registered for this option to be available").'"  
								value="'.mo_("Change SMS Gateway").'" 
								onclick="extraSettings(\''.MoConstants::HOSTNAME.'\',\'/moas/smsconfig\');" 
								class="button button-primary button-large" style="margin-right: 3%;">
						</div>	
					</div>
				</td>
			</tr>
			<tr id="email">
				<td>
					<h2>'.mo_("Email Configuration").'</h2><hr/>
				</td>
			</tr>
			<tr>
				<td>
					<b>Custom Email Template:</b>
					<div style="padding:2%;background-color: rgba(111, 111, 111, 0.09);">
						<img src=" '. MOV_URL .$email_template_guide_url . '" />
						<div style="text-align:center">
							<input '. $disabled. ' type="button" 
								title="'.mo_("Need to be registered for this option to be available").'"  
								value="'.mo_("Change Email Template").'" 
								onclick="extraSettings(\''.MoConstants::HOSTNAME.'\',\'/moas/showemailtemplate\');" 
								class="button button-primary button-large" style="margin-right: 3%;">
						</div>
					</div>
					<b>Custom Email Gateway:</b>
					<div style="padding:2%;background-color: rgba(111, 111, 111, 0.09);">
						<img src=" '. MOV_URL .$email_gateway_guide_url . '" />
						<div '. $hidden. ' style="text-align:center">
							<input type="button" '. $disabled. ' 
								title="'.mo_("Need to be registered for this option to be available").'" 
								value="'.mo_("Change Email Gateway").'" 
								onclick="extraSettings(\''.MoConstants::HOSTNAME.'\',\'/moas/configureSMTP\');" 
								class="button button-primary button-large" style="margin-right: 3%;">
						</div>
					</div>
				</td>
			</tr>
		</table>
		<form id="showExtraSettings" action="'. MoConstants::HOSTNAME.'/moas/login" target="_blank" method="post">
	       <input type="hidden" id="extraSettingsUsername" name="username" value=" '. $email.'"/>
	       <input type="hidden" id="extraSettingsRedirectURL" name="redirectUrl" value="" />
		</form>
	</div>
	</div>';
	?>