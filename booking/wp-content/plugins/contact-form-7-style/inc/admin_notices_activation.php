<?php 

if ( !defined( 'ABSPATH' ) ) {
 exit;
}

/*
 * notice for the user
 */
function cf7_designer_deactivation_notice() { ?>
    <div class="error">
        <p><?php _e( "You cannot activate CF7 Designer while CF7 Style is activated!", "contact-form-7-style" ) ?></p>
    </div>
<?php }

/*
 * Function created for deactivated Contact Form 7 Designer plugin.
 * This is because styles of that plugin is in conflict with ours. 
 * No one should add an id in the html tag.
 */

function deactivate_contact_form_7_designer_plugin() {
    if ( is_plugin_active('contact-form-7-designer/cf7-styles.php') ) {
        deactivate_plugins('contact-form-7-designer/cf7-styles.php');
        add_action( 'admin_notices', 'cf7_designer_deactivation_notice' );
    }
}

function cf7_style_rq_plugin($req=false) {

	$all_plugins = get_plugins();

	if( $req == true && array_key_exists( WPCF7S_REQ_PLUGIN, $all_plugins)) return true;
	if(!$req) {
		$active_plugins = get_option( 'active_plugins' );
		if( is_multisite() ) {
			$active_plugins = array_merge($active_plugins, array_keys(get_site_option( 'active_sitewide_plugins')));
		}
		if(in_array( WPCF7S_REQ_PLUGIN, $active_plugins )) return true; 
	}
	return false;
}
 
/**
 *	Check if Contact Form 7 is activated
 */
function contact_form_7_check() {

	if(!cf7_style_rq_plugin(true)){
		$html = '<div class="error">';
		$html .= '<p>';
		$html .= __( "Contact form 7 - Style is an addon. Please install", "contact-form-7-style" ).' <a href="'.esc_url(admin_url('plugin-install.php?s=contact+form+7&tab=search&type=term' )).'">Contact form 7</a>.';
		$html .= '</p>';
		$html .= '</div><!-- /.updated -->';
		echo $html;
	} else {
		if ( !cf7_style_rq_plugin()) {
			$html = '<div class="error">';
			$html .= '<p>';
			$html .= __( "Contact form 7 - Style is an addon. Please activate", "contact-form-7-style" ).' <a href="'.esc_url(wp_nonce_url(admin_url('plugins.php?action=activate&plugin=' . WPCF7S_REQ_PLUGIN ), 'activate-plugin_' . WPCF7S_REQ_PLUGIN )).'">Contact form 7</a>.';
			$html .= '</p>';
			$html .= '</div><!-- /.updated -->';
			echo $html;
		} else {
			// Get the cf7_style_cookie 
			$cf7_style_cookie = get_option( 'cf7_style_cookie' );
			if( $cf7_style_cookie != true ) {

				$html = '<div class="updated">';
				$html .= '<p>';
				$html .= __( "Contact Form 7 - Style addon is now activated. Navigate to", "contact-form-7-style" ).' <a href="' . get_bloginfo( "url" ) . '/wp-admin/edit.php?post_type=cf7_style">'.__( "Contact Style", "contact-form-7-style" ).'</a> '.__( "to get started.", "contact-form-7-style" );
				$html .= '</p>';
				$html .= '</div><!-- /.updated -->';
				echo $html; 
				update_option( 'cf7_style_cookie', true );
			} // end if !$cf7_style_cookie
			$cf7_style_templates = get_option( 'cf7_style_no_temps' );
			if($cf7_style_templates != "hide_box"){
				$box = '<div class="updated template-message-box">';
				$box .= '<p><label><input type="checkbox" name="custom_template_check" />'.__( "Click here, if you want to delete ALL predefined Contact Form 7 Style templates.", "contact-form-7-style" ).'</label></p>';
				$box .= '<p><small>'.__( "This works only if  the  predefined templates are not in the", "contact-form-7-style" ).' <a href="'.admin_url('edit.php?post_status=trash&post_type=cf7_style').'">'.__( "Trash", "contact-form-7-style" ).'</a>.</small></p>';
				$box .= '<div class="double-check hidden">';
				$box .= '<label>'.__( "Are you sure you want to remove? ", "contact-form-7-style" );
				$box .= '<br/><span>( '.__( "All Contact Form 7 Style predefined templates attached to your Contact Form 7 form will be removed", "contact-form-7-style" ).' ) &nbsp;&nbsp;</span>';
				$box .= '<span> '.__( "Yes", "contact-form-7-style" ).'</span><input type="radio" name="double_check_template" value="yes" />';
				$box .= '</label><label>';
				$box .= '<span> '.__( "No", "contact-form-7-style" ).'</span><input type="radio" name="double_check_template" value="no" checked="checked" /></label>';
				$box .= '<a href="#" class="confirm-remove-template button"> '.__( "Confirm", "contact-form-7-style" ).'</a>';
				$box .= '</div><a href="#" class="remove_template_notice">'.__( "Dismiss", "contact-form-7-style" ).'</a>';
				$box .= '<div style="clear:both;"></div>';
				$box .= '</div>';
				$screen = get_current_screen();
				if( !empty($screen) && ($screen->id == 'edit-cf7_style' || $screen->id == 'cf7_style') ){
					echo $box;
				}
			}		
		}		
	} // end if $active_plugins	
}
function cf7_style_activator(){

	deactivate_contact_form_7_designer_plugin();

	add_action( 'admin_notices', 'contact_form_7_check' );

	if(!cf7_style_rq_plugin()) {
		
		deactivate_plugins( plugin_basename( WPCF7S_PLUGIN ) ); 

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
	}

}
add_action( 'admin_init', 'cf7_style_activator' );