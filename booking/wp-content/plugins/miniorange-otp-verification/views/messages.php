<?php 

echo'

	 <div class="mo_registration_divided_layout">
		<div class="mo_registration_table_layout">';

			is_customer_registered();

echo '<form name="f" method="post" action="" id="mo_otp_verification_messages">
		<input type="hidden" name="option" value="mo_customer_validation_messages" />
			<table style="width:100%">
				<tr>
					<td>
						<h2>'.mo_("CONFIGURE MESSAGES").'
							<span style="float:right;margin-top:-10px;">
								<input type="submit" '.$disabled.' name="save" id="save" class="button button-primary button-large" 
									value="'.mo_("Save Settings").'"/>
							</span>
						</h2><hr/>
					</td>
				</tr>
				<tr>
					<td> <strong>'.mo_("Configure messages your users will see on successful and failure of Email or SMS delivery.").'</strong> </td>
				</tr>
				<tr>
					<td>
						<h3>'.mo_("Email Messages").'</h3><hr/>
						<div style="margin-left:1%;">
							<div style="margin-bottom:1%;"><strong>'.mo_("SUCCESS OTP MESSAGE").': </strong>
							<span style="color:red">'.mo_("( NOTE: ##email## in the message body will be replaced by the user's email address )").'</span></div>
							<textarea name="otp_success_email" rows="4" style="width:100%;padding:2%;">'.mo_($otp_success_email).'</textarea><br/><br/>
							<div style="margin-bottom:1%;"><strong>'.mo_("ERROR OTP MESSAGE").': </strong></div>
							<textarea name="otp_error_email" rows="4" style="width:100%;padding:2%;">'.mo_($otp_error_email).'</textarea><br/><br/>
							<div style="margin-bottom:1%;"><strong>'.mo_("BLOCKED EMAIL MESSAGE").': </strong>
							<span style="color:red">'.mo_("( NOTE: ##email## in the message body will be replaced by the user's email address )").'</span></div>
							<textarea name="otp_blocked_email" rows="4" style="width:100%;padding:2%;">'.mo_($otp_blocked_email).'</textarea><br/>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<h3>'.mo_("SMS/Mobile Messages").'</h3><hr/>
						<div style="margin-left:1%;">
							<div style="margin-bottom:1%;"><strong>'.mo_("SUCCESS OTP MESSAGE").': </strong>
							<span style="color:red">'.mo_("( NOTE: ##phone## in the message body will be replaced by the user's mobile number )").'</span></div>
							<textarea name="otp_success_phone" rows="4" style="width:100%;padding:2%;">'.mo_($otp_success_phone).'</textarea><br/><br/>
							<div style="margin-bottom:1%;"><strong>'.mo_("ERROR OTP MESSAGE").': </strong></div>
							<textarea name="otp_error_phone" rows="4" style="width:100%;padding:2%;">'.mo_($otp_error_phone).'</textarea><br/><br/>
							<div style="margin-bottom:1%;"><strong>'.mo_("INVALID FORMAT MESSAGE").': </strong>
							<span style="color:red">'.mo_("( NOTE: ##phone## in the message body will be replaced by the user's mobile number )").'</span></div>
							<textarea name="otp_invalid_phone" rows="4" style="width:100%;padding:2%;">'.mo_($otp_invalid_format).'</textarea><br/><br/>
							<div style="margin-bottom:1%;"><strong>'.mo_("BLOCKED PHONE MESSAGE").': </strong>
							<span style="color:red">'.mo_("( NOTE: ##phone## in the message body will be replaced by the user's mobile number )").'</span></div>
							<textarea name="otp_blocked_phone" rows="4" style="width:100%;padding:2%;">'.mo_($otp_blocked_phone).'</textarea><br/>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<h3>'.mo_("Common Messages").'</h3><hr/>
						<div style="margin-left:1%">
							<div style="margin-bottom:1%;"><strong>'.mo_("INVALID OTP MESSAGE").': </strong></div>
							<textarea name="invalid_otp" rows="4" style="width:100%;padding:2%;">'.mo_($invalid_otp).'</textarea><br/>
						</div>
					</td>
				</tr>

			</table>
	  </form>'; 

echo '
		</div>
	 </div>	';

