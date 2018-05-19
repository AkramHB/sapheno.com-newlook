<?php

// get variables

global $postid;

$post_id = $postid;

$name = 	get_post_meta($post_id, "_cf7pp_name", true);
$price = 	get_post_meta($post_id, "_cf7pp_price", true);
$id = 		get_post_meta($post_id, "_cf7pp_id", true);


$options = get_option('cf7pp_options');

// live or test mode
if ($options['mode'] == "1") {
	$account = $options['sandboxaccount'];
	$path = "sandbox.paypal";
} elseif ($options['mode'] == "2")  {
	$account = $options['liveaccount'];
	$path = "paypal";
}

// currency
if ($options['currency'] == "1") { $currency = "AUD"; }
if ($options['currency'] == "2") { $currency = "BRL"; }
if ($options['currency'] == "3") { $currency = "CAD"; }
if ($options['currency'] == "4") { $currency = "CZK"; }
if ($options['currency'] == "5") { $currency = "DKK"; }
if ($options['currency'] == "6") { $currency = "EUR"; }
if ($options['currency'] == "7") { $currency = "HKD"; }
if ($options['currency'] == "8") { $currency = "HUF"; }
if ($options['currency'] == "9") { $currency = "ILS"; }
if ($options['currency'] == "10") { $currency = "JPY"; }
if ($options['currency'] == "11") { $currency = "MYR"; }
if ($options['currency'] == "12") { $currency = "MXN"; }
if ($options['currency'] == "13") { $currency = "NOK"; }
if ($options['currency'] == "14") { $currency = "NZD"; }
if ($options['currency'] == "15") { $currency = "PHP"; }
if ($options['currency'] == "16") { $currency = "PLN"; }
if ($options['currency'] == "17") { $currency = "GBP"; }
if ($options['currency'] == "18") { $currency = "RUB"; }
if ($options['currency'] == "19") { $currency = "SGD"; }
if ($options['currency'] == "20") { $currency = "SEK"; }
if ($options['currency'] == "21") { $currency = "CHF"; }
if ($options['currency'] == "22") { $currency = "TWD"; }
if ($options['currency'] == "23") { $currency = "THB"; }
if ($options['currency'] == "24") { $currency = "TRY"; }
if ($options['currency'] == "25") { $currency = "USD"; }

// language
if ($options['language'] == "1") {
	$language = "da_DK";
} //Danish

if ($options['language'] == "2") {
	$language = "nl_BE";
} //Dutch

if ($options['language'] == "3") {
	$language = "EN_US";
} //English

if ($options['language'] == "20") {
	$language = "en_GB";
} //English - UK

if ($options['language'] == "4") {
	$language = "fr_CA";
} //French

if ($options['language'] == "5") {
	$language = "de_DE";
} //German

if ($options['language'] == "6") {
	$language = "he_IL";
} //Hebrew

if ($options['language'] == "7") {
	$language = "it_IT";
} //Italian

if ($options['language'] == "8") {
	$language = "ja_JP";
} //Japanese

if ($options['language'] == "9") {
	$language = "no_NO";
} //Norwgian

if ($options['language'] == "10") {
	$language = "pl_PL";
} //Polish

if ($options['language'] == "11") {
	$language = "pt_BR";
} //Portuguese

if ($options['language'] == "12") {
	$language = "ru_RU";
} //Russian

if ($options['language'] == "13") {
	$language = "es_ES";
} //Spanish

if ($options['language'] == "14") {
	$language = "sv_SE";
} //Swedish

if ($options['language'] == "15") {
	$language = "zh_CN";
} //Simplified Chinese - China

if ($options['language'] == "16") {
	$language = "zh_HK";
} //Traditional Chinese - Hong Kong

if ($options['language'] == "17") {
	$language = "zh_TW";
} //Traditional Chinese - Taiwan

if ($options['language'] == "18") {
	$language = "tr_TR";
} //Turkish

if ($options['language'] == "19") {
	$language = "th_TH";
} //Thai


	$array = array(
		'business'			=> $account,
		'currency_code'		=> $currency,
		'charset'			=> get_bloginfo('charset'),
		'rm'				=> '1', 				// return method for return url, use 1 for GET
		'return'			=> $options['return'],
		'cancel_return'		=> $options['cancel'],
		'cbt'				=> get_bloginfo('name'),
		'bn'				=> 'WPPlugin_SP',
		'lc'				=> $language,
		'item_number'		=> $id,
		'item_name'			=> $name,
		'amount'			=> $price,
		'cmd'				=> '_xclick',
	);
	
	
	// generate url with parameters
	$paypal_url = "https://www.$path.com/cgi-bin/webscr?";
	$paypal_url .= http_build_query($array);
	$paypal_url = htmlentities($paypal_url); // fix for &curren was displayed literally
	$paypal_url = str_replace('&amp;','&',$paypal_url);

	// redirect to paypal
	wp_redirect($paypal_url);
	exit;
	
?>