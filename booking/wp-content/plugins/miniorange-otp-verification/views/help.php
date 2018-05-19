<?php

echo'

 <div class="mo_registration_divided_layout">
	<div class="mo_registration_table_layout">';

		is_customer_registered();

echo'	<table width="100%">
		<tbody>
		 	<tr><td>
		 		<p>'.mo_("If any section is not opening, press CTRL + F5 to clear cache.").'<p>
		 		<div class="registration_question"><h3><a>'.mo_("How does this plugin work?").'</a></h3></div>
		 		<div hidden  class="mo_registration_help_desc">
					<ol>
						<li>'.mo_("On submitting the registration form an Email/SMS with OTP is sent to the email address/mobile number 
							 provided by the user.").'</li>
						<li>'.mo_("Once the OTP is entered, it is verified by our servers.").'</li>
					</ol>
				</div>
				<hr>
			</td></tr>

			<tr><td>
				<div class="registration_question">
					<h3><a>'.mo_("My Registration form is missing from the list").'</a></h3>
				</div>
				<div  hidden  class="mo_registration_help_desc">
					'.mo_("We are actively adding support for more forms. Please contact us using the support form on your right or email us at 
							<b>info@miniorange.com</b>. <br/>While contacting us please include enough information about your registration form 
							and how you intend to use this plugin. We will respond promptly.").'
				</div>
				<hr>
			</td></tr>
			<tr><td>
				<div class="registration_question">
					<h3><a>'.mo_("Is OTP SMS delivered to DND(Do Not Disturb) mobile numbers?").'</a></h3>
				</div>
				<div hidden class="mo_registration_help_desc">
					'.mo_("Yes, OTP SMS is even delivered to DND mobile numbers.").'
				</div>
				<hr>
			</td></tr>
			<tr><td>
				<div class="registration_question">
					<h3><a>'.mo_("Is SMS OTP delivered in any part of the world?").'</a></h3>
				</div>
				<div hidden class="mo_registration_help_desc">
					'.mo_("Yes, miniOrange SMS gateway delivers SMS all over the world but the pricing on 
							SMS delivery defers from country to country.").'
				</div>
				<hr>
			</td></tr>

		 	<tr><td>
				<div class="registration_question">
					<h3><a>'.mo_("How do i integrate the plugin with my own custom Registration Form?").'</a></h3></div>
				<div  hidden  class="mo_registration_help_desc">
					'.mo_("Please contact us using the support form on your right or email us at <b>info@miniorange.com</b>. 
						<br/>While contacting us please include enough information about your registration form and how you intend to use 
						this plugin. We will respond promptly.").'
				</div>
				<hr>
		 	</td></tr>
		 	<tr><td>
				<div class="registration_question">
					<h3><a>'.mo_("How to enable PHP cURL extension? (Pre-requisite)").'</a></h3>
				</div>
				<div hidden  class="mo_registration_help_desc">
					'.mo_("cURL is enabled by default but in case you have disabled it, follow the steps to enable it").'
					<ol>
						<li>'.mo_("Open php.ini(it's usually in /etc/ or in php folder on the server).").'</li>
						<li>'.mo_("Search for extension=php_curl.dll. Uncomment it by removing the semi-colon( ; ) in front of it.").'</li>
						<li>'.mo_("Restart the Apache Server.").'</li>
					</ol>
					'.mo_("For any further queries, please submit a query on right hand side in our <b>Support Section</b>.").'
				</div>
				<hr>
			</td></tr>
			<tr><td>
				<div class="registration_question">
					<h3><a>'.mo_("I am getting this error. What do i do?").'
				<span style="font-size:12px;">
					<br/>'.mo_("[ curl_setopt(): CURLOPT_FOLLOWLOCATION cannot be activated when an open_basedir is set. ]"
						).'</a></span></h3></div>
				<div hidden class="mo_registration_help_desc">
					'.mo_("Just set safe_mode = Off in your php.ini file (it's usually in /etc/ on the server). If that's already off, 
						then look around for the open_basedir in the php.ini file, and change it to open_basedir = .").'
				</div>
				<hr>
			</td></tr>

		 	<tr><td>
				<div class="registration_question">
					<h3><a>'.mo_("I did not recieve OTP. What should I do?").'</a></h3>
				</div>
				<div hidden class="mo_registration_help_desc">
					'.mo_("The OTP is sent as an email to your email address with which you have registered. 
							If you cannot see the email from miniOrange in your mails, please make sure to check your SPAM folder. 
							<br/><br/>If you don't see an email even in SPAM folder, please verify your account using your mobile number. 
							You will get an OTP on your mobile number which you need to enter on the page. If none of the above works, 
							please contact us using the Support form on the right.").'
				</div>
				<hr>
			</td></tr>
			<tr><td>
				<div class="registration_question">
					<h3><a>'.mo_("After entering OTP, I get Invalid OTP. What should I do?").'</a></h3>
				</div>
				<div hidden class="mo_registration_help_desc">
					'.mo_("Use the <b>Resend OTP</b> option to get an additional OTP. 
							Plese make sure you did not enter the first OTP you recieved if you selected <b>Resend OTP</b> option to get an 
							additional OTP. Enter the latest OTP since the previous ones expire once you click on Resend OTP. <br/><br/>
							If OTP sent on your email address are not working, please verify your account using your mobile number. 
							You will get an OTP on your mobile number which you need to enter on the page. If none of the above works, please 
							contact us using the Support form on the right.").'
				</div>
				<hr>
			</td></tr>
			<tr><td>
				<div class="registration_question">
					<h3><a>'.mo_("I forgot the password of my miniOrange account. How can I reset it?").'</a></h3>
				</div>
				<div hidden class="mo_registration_help_desc">
					'.mo_("There are two cases according to the page you see -").'<br><br/>
					'.mo_("1. <b>Login with miniOrange</b> screen: You should click on <b>forgot password</b> link. You will get your new password on 
							your email address which you have registered with miniOrange . Now you can login with the new password."
							).'<br><br/>
					'.mo_("2. <b>Register with miniOrange</b> screen: Enter your email ID and any random password in <b>password</b> and <b>
							confirm password</b> input box. This will redirect you to <b>Login with miniOrange</b> screen. Now follow first step."
							).'
				</div>
				<hr>
			</td></tr>
			<tr><td>
				<div class="registration_question">
					<h3><a>'.mo_("How is this plugin better than other plugins available?").'</a></h3>
				</div>
				<div hidden class="mo_registration_help_desc">
					<ol>
						<li>'.mo_("Verification of user's Email Address/Mobile Number during registration is a must these days. 
								But what if you do not have your own SMTP/SMS gateway? With our plugin it's not necessary to have your 
								own SMTP/SMS gateway. You can use our own gateways to send OTP over Email/SMS.").'</li>
						<li>'.mo_("You can even use your own SMS/SMTP Gateway if you choose to do so.").'</li>
						<li>'.mo_("Each Email is verified for it's authenticity by miniOrange servers.").'</li>
						<li>'.mo_("Easy and hassle free setup. No SMTP/SMS gateway configuration required. 
									You just need to choose your registration form and you are good to go.").'</li>
						<li>'.mo_("Customizable Email/SMS Templates.").'</li>
					</ol>
				</div>
				<hr>
			</td></tr>
		</tbody>
		</table>
		</div>
	</div>';