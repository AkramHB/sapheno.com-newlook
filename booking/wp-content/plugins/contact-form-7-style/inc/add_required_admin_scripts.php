<?php 

if ( !defined( 'ABSPATH' ) ) {
 exit;
}

function cf7_style_admin_scripts($hook){
	global $post_type;
	if (!wp_script_is( 'jquery', 'enqueued' )) {
		wp_enqueue_script('jquery');
	}
	wp_enqueue_style( "cf7-style-bar-style", WPCF7S_LOCATION . "css/admin-bar.css", array(), WPCF7S_PLUGIN_VER, "all");
	wp_enqueue_script( "cf7_style_overall", WPCF7S_LOCATION . "admin/js/overall-min.js", array('jquery'), WPCF7S_PLUGIN_VER, true );
	if( 'cf7_style_page_cf7style-css-editor' == $hook ){
		wp_enqueue_script( "cf7_style_codemirror_js", WPCF7S_LOCATION . "admin/js/codemirror.js", array( 'jquery' ), WPCF7S_PLUGIN_VER, true );
		wp_enqueue_style( "cf7-style-codemirror-style", WPCF7S_LOCATION . "admin/css/codemirror.css", array(), WPCF7S_PLUGIN_VER, "all" );
		wp_enqueue_script( "cf7-style-codemirror-mode", WPCF7S_LOCATION . "admin/js/mode/css/css.js",  array( 'jquery' ), WPCF7S_PLUGIN_VER, true );
	}
	if( 'cf7_style' == $post_type){
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'thickbox' );
		wp_enqueue_style( 'thickbox' );
		wp_enqueue_script( 'media-upload' );
	}
	if( 'plugins.php'== $hook || 'cf7_style' == $post_type || 'toplevel_page_wpcf7' == $hook || 'cf7_style_page_cf7style-css-editor' == $hook || 'cf7_style_page_system-status' == $hook || 'cf7_style_page_cf7style-settings' == $hook ){
		/*wp_enqueue_style('cf7-style-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');*/
		wp_enqueue_style( "cf7-style-fontello-ie7", WPCF7S_LOCATION . "admin/css/fontello-ie7.css", false, WPCF7S_PLUGIN_VER, "all"); 
		wp_enqueue_style( "cf7-style-fontello", WPCF7S_LOCATION . "admin/css/fontello.css", false, WPCF7S_PLUGIN_VER, "all"); 
		wp_enqueue_style( "cf7-style-admin-style", WPCF7S_LOCATION . "admin/css/admin.css", false, WPCF7S_PLUGIN_VER, "all");  
		wp_enqueue_script( "cf7_style_admin_js", WPCF7S_LOCATION . "admin/js/admin-min.js", array( 'wp-color-picker', 'jquery' ), WPCF7S_PLUGIN_VER, true );
	}
}

add_action( 'admin_enqueue_scripts', 'cf7_style_admin_scripts' );