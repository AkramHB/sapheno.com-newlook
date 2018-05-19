<?php
/**
 * CF7 Style System status
 */

if ( !defined( 'ABSPATH' ) ) {
 exit;
}

function cf7style_system_status() {

	/**
	 * let_to_num function.
	 *
	 * This function transforms the php.ini notation for numbers (like '2M') to an integer.
	 *
	 * @param $size
	 * @return int
	 */
	function cf7style_let_to_num( $size ) {
		$l   = substr( $size, -1 );
		$ret = substr( $size, 0, -1 );
		switch ( strtoupper( $l ) ) {
			case 'P':
				$ret *= 1024;
			case 'T':
				$ret *= 1024;
			case 'G':
				$ret *= 1024;
			case 'M':
				$ret *= 1024;
			case 'K':
				$ret *= 1024;
		}
		return $ret;
	}


	// Cache variables
	$html   = '';
	$table  = '';
	$form   = '';
	$table_start = '<table class="wp-list-table widefat striped cf7style-status-table">';
	$table_end   = '</table><small>&nbsp;</small>';

    $html .= '<div class="wrap">';
    $html .= '<h2>' . __( "System Status", "contact-form-7-style" ) . '</h2>';
    $html .= '<p>' . __( "The Contact Form 7 Style System Status is a tool for troubleshooting issues with your site.", "contact-form-7-style" ) . '</p>';
    $html .= '<p>' . __( "With the informations gathered from you we can debug and analyze and try to offer you a fix.", "contact-form-7-style" ) . '</p>';
    $html .= '<p>' . __( "The System Status is the best way for Contact Form 7 Style Support to help you!", "contact-form-7-style" ) . '</p>';

    // Form
    $form .= '<form class="cf7style-status-form">';
    $form .= '<p><input type="text" name="cf7style-name" class="cf7style-name cf7style-input" placeholder="' . __( "Your name", "contact-form-7-style" ) .'" /></p>';
    $form .= '<p><input type="email" name="cf7style-email" class="cf7style-email cf7style-input" placeholder="' . __( "Your email", "contact-form-7-style" ) .'" /></p>';
    $form .= '<p><textarea name="cf7style-message" class="cf7style-message cf7style-input" placeholder="' . __( "Your message", "cf7style-message", "contact-form-7-style" ) . '"></textarea></p>';
    $form .= '<button class="button cf7style-status-info">' . __( "Show the environment report", "contact-form-7-style" ) . '</button>';

    // Debug - system status send button
	//delete_transient( 'cf7style_system_report' );

    $report_status = get_transient( 'cf7style_system_report' );

    if( $report_status && 'sent' == $report_status ) {
    	$form .= '<button class="button-primary" disabled="disabled">' . __( "Report sent", "contact-form-7-style" ) . '</button>';
    } else {
    	$form .= '<button class="button-primary cf7style-status-submit">' . __( "I think I have a CF7 Style issue. Send Report to CF7 Style Support team.", "contact-form-7-style" ) . '</button>';
    }

    $form .= '</form>';

    $html .= $form;

    // General
    $table .= $table_start;
    	$table .= '<thead><tr><th colspan="2"><strong>' . __( "Your WordPress Setup", "contact-form-7-style" ) . '</strong></th></tr></thead>'; 

	    // Home URL
	    $table .= "<tr><td>" . __( 'Home URL:', 'contact-form-7-style' ) . "</td>";
	    $table .= "<td>" . home_url() . "</td></tr>";

	    // Site URL
	    $table .= "<tr><td>" . __( 'Site URL:', 'contact-form-7-style' ) . "</td>";
	    $table .= "<td>" . site_url() . "</td></tr>";

	    // CF7 Style Version
	    $table .= "<tr><td>" . __( 'Contact Form 7 Style Version:', 'contact-form-7-style' ) . "</td>";
	    $table .= "<td>" . WPCF7S_PLUGIN_VER . "</td></tr>";

	    // WP Version
	    $table .= "<tr><td>" . __( 'WP Version:', 'contact-form-7-style' ) . "</td>";
	    $table .= "<td>" . get_bloginfo( 'version' )  . "</td></tr>";	    	    

	    // WP Multisite
	    $table .= "<tr><td>" . __( 'WP Multisite:', 'contact-form-7-style' ) . "</td>";
	    $table .= "<td>" . ( ( is_multisite() ) ? "Yes" : "No" ) . "</td></tr>";

	    // WP Memory Limit
	    $memory = cf7style_let_to_num( WP_MEMORY_LIMIT );
	    $table .= "<tr><td>" . __( ' WP Memory Limit:', 'contact-form-7-style' ) . "</td>";

		if ( $memory < 100663296 ) {
			$table .= '<td><mark class="error">' . sprintf( __( '%s - Recommended memory at least 96MB. See: <a href="%s" target="_blank">Increasing memory allocated to PHP</a>', 'contact-form-7-style' ), size_format( $memory ), 'http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP' ) . '</mark></td></tr>';
		} else {
			$table .= '<td><mark class="yes">' . size_format( $memory ) . '</mark></td></tr>';
		}

	    // WP Debug Mode
	    $table .= "<tr><td>" . __( 'WP Debug Mode:', 'contact-form-7-style' ) . "</td>";
	    $table .= "<td>" . ( ( WP_DEBUG ) ? "enabled" : "disabled" )  . "</td></tr>";	

	    // Language
	    $table .= "<tr><td>" . __( 'Language:', 'contact-form-7-style' ) . "</td>";
	    $table .= "<td>" . get_locale()  . "</td></tr>";		

	    // Email address for feedback
	    $table .= "<tr><td>" . __( 'Site email address', 'contact-form-7-style' ) . "</td>";
	    $table .= "<td>" . get_option( 'admin_email' ) . "</td></tr>";

	$table .= $table_end;


    // Your Server Setup
    $table .= $table_start;
    	$table .= '<thead><tr><th colspan="2"><strong>' . __( "Your Server Setup", "contact-form-7-style" ) . '</strong></th></tr></thead>'; 

	    // Server info
		$table .= "<tr><td>" . __( 'Server info', 'contact-form-7-style' ) . "</td>";
		$table .= "<td>" . esc_html( $_SERVER['SERVER_SOFTWARE'] ) . "</td></tr>";

		// PHP version
		$table .= "<tr><td>" . __( 'PHP Version', 'contact-form-7-style' ) . "</td>";
		if ( function_exists( 'phpversion' ) ) :

			$php_version = phpversion();

			if ( version_compare( $php_version, '5.6', '<' ) ) {
				$table .= '<td><mark class="error">' . sprintf( __( '%s - WordPress recommends a minimum PHP version of 5.6. See: %s', 'contact-form-7-style' ), esc_html( $php_version ), '<a href="https://wordpress.org/about/requirements/" target="_blank">' . __( 'WordPress Requirements', 'contact-form-7-style' ) . '</a>' ) . '</mark></td></tr>';
			} else {
				$table .= '<td><mark class="yes">' . esc_html( $php_version ) . '</mark></td></tr>';
			}
		else :
			$table .= '<td>' . __( "Couldn't determine PHP version because phpversion() doesn't exist.", 'contact-form-7-style' ) . '</td></tr>';
		endif;

		if ( function_exists( 'ini_get' ) ) :

		    // PHP Post Max Size
			$table .= "<tr><td>" . __( 'PHP Post Max Size:', 'contact-form-7-style' ) . "</td>";
			$table .= "<td>" . size_format( cf7style_let_to_num( ini_get( 'post_max_size' ) ) ) . "</td></tr>";

		endif;
		
		// MySQL Version
			 
		/** @global wpdb $wpdb */
		global $wpdb;
			 
		$table .= "<tr><td>" . __( 'MySQL Version:', 'contact-form-7-style' ) . "</td>";
		$table .= "<td>" . $wpdb->db_version() . "</td></tr>";
		
		// Max Upload Size
		$table .= "<tr><td>" . __( 'Max Upload Size', 'contact-form-7-style' ) . "</td>";
		$table .= "<td>" . size_format( wp_max_upload_size() ) . "</td></tr>";

		// Default Timezone
		$default_timezone = date_default_timezone_get();

		$table .= "<tr><td>" . __( 'Default Timezone:', 'contact-form-7-style' ) . "</td>";
		$table .= '<td>' . $default_timezone . '</td></tr>';
	
	$table .= $table_end;
	

    // Active Plugins
	$active_plugins_count = count( (array) get_option( 'active_plugins' ) );

    $table .= $table_start;
    	$table .= '<thead><tr><th colspan="2"><strong>' . __( "Active Plugins", "contact-form-7-style" ) . ' (' . $active_plugins_count . ')</strong></th></tr></thead>';

    	$active_plugins = (array) get_option( 'active_plugins', array() );

		if ( is_multisite() ) {
			$network_activated_plugins = array_keys( get_site_option( 'active_sitewide_plugins', array() ) );
			$active_plugins            = array_merge( $active_plugins, $network_activated_plugins );
		}

		foreach ( $active_plugins as $plugin ) {

			$plugin_data    = @get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );
			$dirname        = dirname( $plugin );
			$version_string = '';
			$network_string = '';

			if ( ! empty( $plugin_data['Name'] ) ) {

				// Link the plugin name to the plugin url if available.
				$plugin_name = esc_html( $plugin_data['Name'] );

				if ( ! empty( $plugin_data['PluginURI'] ) ) {
					$plugin_name = '<a href="' . esc_url( $plugin_data['PluginURI'] ) . '" title="' . esc_attr__( 'Visit plugin homepage' , 'contact-form-7-style' ) . '" target="_blank">' . $plugin_name . '</a>';
				}

				$table .= "<tr><td>" . $plugin_name. "</td>";
				$table .= "<td>" . sprintf( _x( 'by %s', 'by author', 'contact-form-7-style' ), $plugin_data['Author'] ) . ' &ndash; ' . __( 'Version', 'contact-form-7-style' ) . ' ' . esc_html( $plugin_data['Version'] ) . $version_string . $network_string . "</td></tr>";				
 
			}			

		}

	$table .= $table_end;
 

    // Active Theme
    $active_theme = wp_get_theme(); 

    $table .= $table_start;
    	$table .= '<thead><tr><th colspan="2"><strong>' . __( "Theme", "contact-form-7-style" ) . '</strong></th></tr></thead>';

		$table .= "<tr><td>" . __( 'Name:', 'contact-form-7-style' ) . "</td>";
		$table .= "<td>" . $active_theme->Name . "</td></tr>";

		$table .= "<tr><td>" . __( 'Version:', 'contact-form-7-style' ) . "</td>";
		$table .= "<td>" . $active_theme->Version . "</td></tr>";

		$table .= "<tr><td>" . __( 'Child Theme:', 'contact-form-7-style' ) . "</td>";
		$table .= "<td>" . ( ( is_child_theme() ) ? 'Yes' : 'No' ) . "</td></tr>";
		
		$table .= "<tr><td>" . __( 'Theme URL:', 'contact-form-7-style' ) . "</td>";
		$table .= "<td>" . $active_theme->get( 'ThemeURI' ) . "</td></tr>";
		
	$table .= $table_end;
  
  	$html .= $table;
    $html .= '</div>';

    echo $html;
}

add_action( 'admin_menu', 'cf7style_register_help_submenu_page' );
 
function cf7style_register_help_submenu_page() {
    add_submenu_page(
        'edit.php?post_type=cf7_style',
        'System Status',
        'System Status',
        'manage_options',
        'system-status',
        'cf7style_system_status' 
	);
}


/**
 * Send status report
 */

function cf7_style_send_status_report() {

	$name      = sanitize_text_field( $_POST['name'] );
	$email     = sanitize_email( $_POST['email'] );
	$message   = sanitize_text_field( $_POST['message'] );
	$site_name = get_bloginfo( 'name' );

	$to        = 'cf7style@gmail.com';
	$subject   = __( 'CF7 Style System Status', 'contact-form-7-style' ) . " - {$site_name}";
	$body      = wp_kses_post( $_POST['report'] );
	$body     .= "<table><tr><td>Name: " . $name . "</td></tr>";
	$body     .= "<tr><td>Email: " . $email . "</td></tr>";
	$body     .= "<tr><td>Message: " . $message . "</td></tr></table>";
	$headers   = array( 'Content-Type: text/html; charset=UTF-8' );

	$wp_mail  = wp_mail( $to, $subject, $body, $headers );

	// Auto-response
	$auto_response = "<table><tr><td>" . __( 'Hey there', 'contact-form-7-style' ) . ",</td></tr><tr><td></td></tr>";
	$auto_response .= "<tr><td>" . __( 'Thank you for using Contact Form 7 Style', 'contact-form-7-style' ) . ".</td></tr>";
	$auto_response .= "<tr><td>" . __( 'One of our consultants will reply as soon as possible', 'contact-form-7-style' ) . ".</td></tr>";
	$auto_response .= "<tr><td></td></tr><tr><td></td></tr>";
	$auto_response .= "<tr style='font-size: 13px;'><td>" . __( 'Thank you!', 'contact-form-7-style' ) . "</td></tr>";
	$auto_response .= "<tr style='font-size: 13px;'><td>" . __( 'Contact Form 7 Style Support Team', 'contact-form-7-style' ) . "</td></tr><tr><td></td></tr></table>";
	
	$auto_response .= "<table style='font-size: 12px; color: #777;'>";
	$auto_response .= "<tr><td></td></tr><tr><td></td></tr>";
	$auto_response .= "<tr><td>" . __( 'If you like this plugin we hope that you will help support our continued development', 'contact-form-7-style' ) . ".</td></tr>";
	$auto_response .= "<tr><td>" . __( 'The two best ways to offer your support is to', 'contact-form-7-style' ) . " <a href='http://cf7style.com/back-this-project/'>";
	$auto_response .= __( 'send us a Donation', 'contact-form-7-style' ) . "</a>. "; 
	$auto_response .= __( 'Even $1 helps encourage us to do more', 'contact-form-7-style' ) . ".</td></tr>";
	$auto_response .= "<tr><td>" . __( 'If you can’t donate, please help us reach our 5-star rating by', 'contact-form-7-style' );
	$auto_response .= " <a href='https://wordpress.org/support/view/plugin-reviews/contact-form-7-style#postform'>" . __( 'rating this plugin', 'contact-form-7-style' ) . "</a>.";
	$auto_response .= "</td></tr><tr><td></td></tr>";
	$auto_response .= "<tr><td>" . __( 'All contributions will be gratefully acknowledged', 'contact-form-7-style' ) . "!</td></tr></table>";
	
	$wp_mail2 = wp_mail( $email, $subject, $auto_response, $headers ); 

	if( false === $wp_mail ) {
		echo 'error';
	} else {
		set_transient( 'cf7style_system_report', 'sent', DAY_IN_SECONDS );
		echo 'success';
	}

	wp_die();
}
add_action( 'wp_ajax_cf7_style_send_status_report', 'cf7_style_send_status_report' );