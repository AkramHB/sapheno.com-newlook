<?php 
/*
 * Welcome panel html
 */

if ( !defined( 'ABSPATH' ) ) {
 exit;
}

if ( !function_exists( 'cf7_style_show_welcome_panel' ) ) {
    function cf7_style_show_welcome_panel() {
        $welm = get_option( 'cf7_style_welcome' );
        if( $welm == "show_box") {
     ?>
        <div class="wrap welcome-container">
            <table class="wp-list-table fixed cf7style-welcome-panel ">
                <tbody>
                    <tr>
                        <td>
                            <h3><?php _e( "Need support?", "contact-form-7-style" ); ?></h3>
                            <p><?php _e( "Support can be found", "contact-form-7-style" ); ?> <a href="https://wordpress.org/support/plugin/contact-form-7-style" target="_blank"><?php _e( "here", "contact-form-7-style" ); ?></a> <?php _e( "or you can", "contact-form-7-style" ); ?> <a href="http://cf7style.com/contact/" target="_blank"><?php _e( "contact us", "contact-form-7-style" ); ?></a> <?php _e( "for any related question!", "contact-form-7-style" ); ?></p>
                            <p><?php _e( "You can use our \"System Status\"  to send us a quick report about your environment and with the informations gathered from you we can debug and analyze and try to offer you a fix.", "contact-form-7-style" ); ?> </p>
                            <p><a href="<?php echo admin_url('edit.php?post_type=cf7_style&page=system-status'); ?>" class="button-primary"><?php _e( "System status", "contact-form-7-style" ); ?></a></p>
                            <p><?php _e( "Thank you for using Contact Form 7 Style!", "contact-form-7-style" ); ?></p>
                        </td>
                        <td>
                            <ul>
                                <li><h3><?php _e( "Get Started", "contact-form-7-style" ); ?></h3></li>
                                <li><a href="<?php echo admin_url('post-new.php?post_type=cf7_style'); ?>"><?php _e( "Creating you first custom template", "contact-form-7-style" ); ?></a></li>
                                <li><a href="<?php echo admin_url('edit.php?post_type=cf7_style'); ?>"><?php _e( "Using predefined templates", "contact-form-7-style" ); ?></a></li>
                                <li><a href="<?php echo admin_url('edit.php?post_type=cf7_style&page=cf7style-css-editor'); ?>"><?php _e( "Adding Extra CSS", "contact-form-7-style" ); ?></a></li>
                            </ul>
                        </td>
                        <td>
                            <ul>
                                <li>
                                    <h3><?php _e( "Information", "contact-form-7-style" ); ?></h3>
                                </li>
                                <li><a href="http://cf7style.com/#team" target="_blank"><?php _e( "Who we are?", "contact-form-7-style" ); ?></a></li>
                                <li><a href="http://cf7style.com/#why-cf7style" target="_blank"><?php _e( "Why use our plugin?", "contact-form-7-style" ); ?></a></li>
                                <li><a href="http://cf7style.com/faq/" target="_blank"><?php _e( "FAQ", "contact-form-7-style" ); ?></a></li>
                            </ul>
                        </td>
                        <td>
                            <h3><?php _e( "Buy us a coffee", "contact-form-7-style" ); ?></h3>
                            <p><?php _e( "Supporting and developing this plugin takes us a lot of effort and energy.", "contact-form-7-style" ); ?></p>
                            <p><?php _e( "You would help us a lot if you make a donation. We thank you in advance.", "contact-form-7-style" ); ?></p>
                        </td>
                        <td>
                            <h3>&nbsp;</h3>
                            <a href="http://cf7style.com/back-this-project/" target="_blank">
                                <?php echo '<img src="' . plugins_url( 'contact-form-7-style/admin/images/donate1.jpg' ) . '" > ';?>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <a class="close-cf7-panel" href="#"><?php _e( "Dismiss", "contact-form-7-style" ); ?></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php } 
    }
}

/*
 * Welcome panel initialization on Cf7Style screen
 */
if ( !function_exists( 'cf7style_screen_page' ) ) {
    function cf7style_screen_page() {
        $screen = get_current_screen();
        if ( $screen->id ==  'edit-cf7_style' ) {
            add_action( 'admin_notices' , 'cf7_style_show_welcome_panel' );
        }
    }
    add_action( 'current_screen', 'cf7style_screen_page' );
}

