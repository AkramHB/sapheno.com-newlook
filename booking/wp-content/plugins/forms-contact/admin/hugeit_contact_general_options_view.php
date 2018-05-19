<?php
if(! defined( 'ABSPATH' )) exit;
if (function_exists('current_user_can'))
    if (!current_user_can('manage_options')) {
        die('Access Denied');
    }
if (!function_exists('current_user_can')) {
    die('Access Denied');
}
require_once("hugeit_free_version.php");

