<?php
/**
 * on deactivation, if tracking is on, it will send info to plugin authors that the plugin is no longer active
 */

if ( !defined( 'ABSPATH' ) ) {
 exit;
}


define( 'CF7_STYLE_PLUGIN_PATH', WP_PLUGIN_DIR . '/contact-form-7-style/' );
if ( !function_exists( 'cf7_style_announce_authors_about_deactivation' ) ) {
    function cf7_style_announce_authors_about_deactivation () {
        $allowedornot = get_option( 'cf7_style_allow_tracking' );
        if( '1' == $allowedornot){
            cf7style_send_tracking_info( $allowedornot, '1' );
        }
        
    }
    register_deactivation_hook( CF7_STYLE_PLUGIN_PATH . 'cf7-style.php' , 'cf7_style_announce_authors_about_deactivation' );
}
/*
 * on activation, if tracking is on, it will send info to plugin authors that the plugin is active.
 */
if ( !function_exists( 'cf7_style_announce_authors_about_activation' ) ) {
    function cf7_style_announce_authors_about_activation () {
        $allowedornot = get_option( 'cf7_style_allow_tracking' );
        if( '1' == $allowedornot){
            cf7style_send_tracking_info( $allowedornot, '1' );
        }
    }
    register_activation_hook( CF7_STYLE_PLUGIN_PATH . 'cf7-style.php' , 'cf7_style_announce_authors_about_activation' );
}
/*
 * enque pointer 
 */
if ( !function_exists( 'cf7_style_tracking_enque_script' ) ) {
    add_action( 'admin_enqueue_scripts', 'cf7_style_tracking_enque_script' );
    function cf7_style_tracking_enque_script() {
        $activeordismiss = get_option( 'cf7_style_allow_tracking' );
        if ( $activeordismiss !== '0' && $activeordismiss !== '1' ) {
            wp_enqueue_style( 'wp-pointer' );
            wp_enqueue_script( 'wp-pointer' );
            add_action( 'admin_print_footer_scripts', 'cf7_style_print_tooltip' );
        }
    }
}

/*
 * prints the tooltip
 */
if ( !function_exists( 'cf7_style_print_tooltip' ) ) {
    function cf7_style_print_tooltip() {
        $pointer_content = '<h3>'.__( "Thank You for choosing<br/>Contact Form 7 Style!", "contact-form-7-style" ).'</h3>';
        $pointer_content .= '<p>'.__( "Want to help make CF7 Style even more better? Allow Us to collect non-sensitive diagnostic data.", "contact-form-7-style" ).'</p>';
        $pointer_content .= '<p>'.__( "We will only collect your website URL, WordPress version, CF7Style plugin version and active status.", "contact-form-7-style" ).'</p>';
        $pointer_content .= '<p><label>'.__( "Allow collecting data:", "contact-form-7-style" ).'<input id="cf7_style_allow_tracking" type="checkbox" checked="checked" value="1" name="cf7_style_allow_tracking" /></label> </p>'; ?>
        <script type="text/javascript">
        //<![CDATA[
        jQuery(document).ready( function($) {
            $('.menu-icon-cf7_style').eq(0).pointer({
                pointerClass: 'cf7style-pointer',
                content: '<?php echo $pointer_content; ?>',
                position: 'left',
                close: function() {
                    $('.cf7style-pointer').hide();
                    return false;
                }
            }).pointer('open');
        });
        //]]>
        </script>
        <style type="text/css">
            .cf7style-pointer .wp-pointer-arrow {
               top: 20px; 
               left: -1px;
            }
        </style>
    <?php
    }
}

/*
 * allow tracking set option
 */
if ( !function_exists( 'cf7_style_allow_tracking' ) ) {
    function cf7_style_allow_tracking() {
        if ( $_POST['action'] == 'cf7_style_allow_tracking' ) {
            if ( !is_numeric( $_POST['cf7_style_allow_tracking'] ) ) {
                die();
            }
            $allowedornot = $_POST['cf7_style_allow_tracking'];
            if ( $allowedornot == '1' ) {
                update_option( 'cf7_style_allow_tracking', '1' );
                cf7style_send_tracking_info( $allowedornot, '1' );
            }
            die();
        }
    }
    add_action( 'wp_ajax_cf7_style_allow_tracking', 'cf7_style_allow_tracking' );
}
if ( !function_exists( 'cf7_style_show_tracking' ) ) {
    function cf7_style_show_tracking() {
        if ( $_POST['action'] == 'cf7_style_show_tracking' ) {
            if ( !is_numeric( $_POST['cf7_style_allow_tracking'] ) ) {
                die();
            }
            $allowedornot = $_POST['cf7_style_allow_tracking'];
            if ( $allowedornot == '0' ) {
                update_option( 'cf7_style_allow_tracking', '0' );
            }
            die();
        }
    }
    add_action( 'wp_ajax_cf7_style_show_tracking', 'cf7_style_show_tracking' );
}


/*
 * send traciking info function
 */
if ( !function_exists( 'cf7style_send_tracking_info' ) ) {
    function cf7style_send_tracking_info( $allowedornot, $activated ) {
        $url = 'http://cf7style.com/tracking/index.php';
        $plugin_folder = get_plugins( '/' . 'contact-form-7-style' );
        $plugin_file = 'cf7-style.php';
        $plugindata = $plugin_folder[$plugin_file]['Version'];
        $multi = ( is_multisite() ? '1' : '0' );
        $data = array (
            'allowed'       => $allowedornot,
            'wpversion'     => get_bloginfo('version'),
            'styleversion'  => $plugindata,
            'siteurl'       => site_url(),
            'multisite'     => $multi,
            'activated'     => $activated
        );
        if(function_exists('curl_version')){
            $cf7curl = curl_init();
            $Curl = $url.'?method=withstyle&data='.base64_encode(json_encode($data)).'&format=json';
            $curlconfig = array ( 
                    CURLOPT_URL            => $Curl,
                    CURLOPT_RETURNTRANSFER => true
            );
            curl_setopt_array( $cf7curl, $curlconfig );
            $output = curl_exec($cf7curl);
            curl_close($cf7curl);
        }
    }
}