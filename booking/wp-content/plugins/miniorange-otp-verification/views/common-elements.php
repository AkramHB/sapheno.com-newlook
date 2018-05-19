<?php

	function is_customer_registered()
	{
		$registration_url = add_query_arg( array('page' => 'otpaccount'), $_SERVER['REQUEST_URI'] );
		if(MoUtility::micr())  return;
		echo '<div style="display:block;margin-top:10px;color:red;background-color:rgba(251, 232, 0, 0.15);
							padding:5px;border:solid 1px rgba(255, 0, 9, 0.36);">
		 <a href="'.$registration_url.'">'.mo_( "Register or Login with miniOrange") .'</a> 
		 	'. mo_( "to enable OTP Verification").'</div>';
	}

	function get_plugin_form_link($formalink)
	{
		echo '<a class="dashicons dashicons-admin-page" href="'.$formalink.'" title="'.$formalink.'" ></a>';
	}

	function mo_draw_tooltip($header,$message)
	{
		echo '<span class="tooltip">
				<span class="dashicons dashicons-editor-help"></span>
				<span class="tooltiptext"><span class="header"><b><i>'. mo_( $header).'</i></b></span><br/><br/>
				<span class="body">'.mo_($message).'</span></span>
			  </span>';
	}

	function extra_post_data($data=null)
	{
		$mo_fields 		= array('option','mo_customer_validation_otp_token','miniorange_otp_token_submit',
								'miniorange-validate-otp-choice-form','submit','mo_customer_validation_otp_choice');
		$extrafields1 	= array('user_login','user_email','register_nonce','option','register_tml_nonce','mo_customer_validation_otp_token'); 
		$extrafields2 	= array('register_nonce','option','form_id','timestamp','mo_customer_validation_otp_token'); 
		$extraPostData  = '';

		if  (	isset($_SESSION[FormSessionVars::WC_DEFAULT_REG])
				|| 	isset($_SESSION[FormSessionVars::CRF_DEFAULT_REG])
				|| 	isset($_SESSION[FormSessionVars::UULTRA_REG])
				|| 	isset($_SESSION[FormSessionVars::UPME_REG])
				|| 	isset($_SESSION[FormSessionVars::PIE_REG])
				|| 	isset($_SESSION[FormSessionVars::PB_DEFAULT_REG])
				|| 	isset($_SESSION[FormSessionVars::NINJA_FORM])
				|| 	isset($_SESSION[FormSessionVars::USERPRO_FORM])
				||  isset($_SESSION[FormSessionVars::BUDDYPRESS_REG])
				||  isset($_SESSION[FormSessionVars::WP_DEFAULT_LOGIN])
				||  isset($_SESSION[FormSessionVars::WP_LOGIN_REG_PHONE])
				||  isset($_SESSION[FormSessionVars::CLASSIFY_REGISTER])
				||  isset($_SESSION[FormSessionVars::EMEMBER])
			)
		{
			foreach ($_POST as $key => $value)
			{
				$extraPostData .= !in_array($key,$mo_fields) ? get_hidden_fields($key,$value) : "";
				$extraPostData .= $key=='g-recaptcha-response' && isset($_REQUEST['g-recaptcha-response']) 
					? '<input type="hidden" name="g-recaptcha-response" value="'.$_POST['g-recaptcha-response'].'" />'
					: '';
			}
		}
		elseif  (	(isset($_SESSION[FormSessionVars::WC_SOCIAL_LOGIN])
					|| isset($_SESSION[FormSessionVars::UM_DEFAULT_REG]))
					&& !MoUtility::isBlank($data)
				)
		{
			foreach ($data as $key => $value)
			{
				$extraPostData .= !in_array($key, $extrafields2) ? get_hidden_fields($key,$value) : "";
			}
		}elseif (	(isset($_SESSION[FormSessionVars::TML_REG])
					|| 	isset($_SESSION[FormSessionVars::WP_DEFAULT_REG]))
					&& !MoUtility::isBlank($_POST)
				)
		{
			foreach ($_POST as $key => $value)
			{
				$extraPostData .= !in_array($key, $extrafields1) ? get_hidden_fields($key,$value) : "";
			}
		}
		return $extraPostData;
	}

	function get_hidden_fields($key,$value)
	{
		if(is_array($value))
			foreach ($value as $t => $val)
				get_hidden_fields($key.'['.$t.']',$val);
		else	
			return '<input type="hidden" name="'.$key.'" value="'.$value.'" />';
	}

	function miniorange_site_otp_validation_form($user_login,$user_email,$phone_number,$message,$otp_type,$from_both)
	{
		if(!headers_sent()) header('Content-Type: text/html; charset=utf-8');
		$htmlcontent = MoUtility::isBlank($user_email) && MoUtility::isBlank($phone_number) ? 
						apply_filters( 'mo_template_build', '', ErrorPopup::$key ,$message,$otp_type,$from_both)
						: apply_filters( 'mo_template_build', '', DefaultPopup::$key ,$message,$otp_type,$from_both);
		echo $htmlcontent;
		exit();
	}

	function miniorange_verification_user_choice($user_login, $user_email,$phone_number,$message,$otp_type)
	{
		if(!headers_sent()) header('Content-Type: text/html; charset=utf-8');
		$htmlcontent = apply_filters( 'mo_template_build', '',UserChoicePopup::$key ,$message,$otp_type,TRUE);
		echo $htmlcontent;
		exit();
	}    

	function mo_external_phone_validation_form($goBackURL,$user_email,$message,$form,$usermeta)
	{
		if(!headers_sent()) header('Content-Type: text/html; charset=utf-8');
		$htmlcontent = apply_filters( 'mo_template_build', '', ExternalPopup::$key ,$message,NULL,FALSE);
		echo $htmlcontent;
		exit();
	}

	function get_otp_verification_form_dropdown()
	{
		$enabled = 'style="color:green;font-style:italic;font-weight:bold"';
		echo '<div class="modropdown">
				<span class="dashicons dashicons-search"></span>
				<input type="text" class="dropbtn" placeholder="'.mo_( 'Select your Form' ).'"></input>
				<div class="modropdown-content">';
			foreach (FormList::getFormList() as $key => $value)
			{
				echo '<div class="search_box"><a class="mo_search" href="#'.strtolower($key).'" ';
				echo FormList::isFormEnabled($value) ? $enabled : '';
				echo ' data-value="'.mo_($value).'">'.mo_($value).'</a></div>';
			}
		echo	'</div>
			</div>';
	}

	function get_country_code_dropdown()
	{
		echo '<select name="default_country_code" id="mo_country_code">';
		echo '<option value="" disabled selected="selected">
				--------- '.mo_( 'Select your Country' ).' -------
			  </option>';
		foreach (CountryList::getCountryCodeList() as $key => $country)
		{
			echo '<option data-countrycode="'.$country['countryCode'].'" value="'.$key.'"';
			echo CountryList::isCountrySelected($country['countryCode'],$country['alphacode']) ? 'selected' : '';
			echo '>'.$country['name'].'</option>';
		}
		echo '</select>';
	}

	function get_country_code_multiple_dropdown()
	{
		echo '<select multiple size="5" name="allow_countries[]" id="mo_country_code">';
		echo '<option value="" disabled selected="selected">
				--------- '.mo_( 'Select your Countries' ).' -------
			  </option>';
		foreach (CountryList::getCountryCodeList() as $country)
		{

		}
		echo '</select>';
	}

	function show_form_details($folder,$controller,$disabled,$page_list)
	{
		foreach (scandir(dirname(__FILE__).'/'.$folder) as $filename)
		{
			if($filename=="" || $filename=="." 
				|| $filename==".." || $filename =="wp-login.php") continue;
			$path = dirname(__FILE__) . '/'. $folder . '/' . $filename;
			if (is_file($path)) {
				echo'<tr> <td>';
					include $controller . $folder .'/'. $filename;							
				echo'</td></tr>';
			}elseif(is_dir($path)){
				show_form_details($folder.'/'.$filename,$controller,$disabled,$page_list);
			}
		}
	}

	function get_wc_payment_dropdown($disabled,$checkout_payment_plans)
	{
		if( !is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			echo mo_( '[ Please activate the WooCommerce Plugin ]' ); return;
		}
		$paymentPlans = WC()->payment_gateways->get_available_payment_gateways();
		echo '<select multiple size="5" name="wc_payment[]" id="wc_payment">';
		echo 	'<option value="" disabled>'.mo_( 'Select your Payment Methods' ).'</option>';
		foreach ($paymentPlans as $paymentPlan) {
			echo '<option ';
			if($checkout_payment_plans && array_key_exists($paymentPlan->id, $checkout_payment_plans)) echo 'selected';
			elseif(!$checkout_payment_plans) echo 'selected';
			echo ' value="'.esc_attr( $paymentPlan->id ).'">'.$paymentPlan->title.'</option>';
		}
		echo '</select>';
	}