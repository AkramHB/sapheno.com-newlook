<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class WPBC_Dismiss {
    
    public  $element_id;
    public  $title;
    public  $html_class;

    public function __construct( ) {
        
    }
    
    public function render( $params = array() ){
        if (isset($params['id'])) 
                $this->element_id = $params['id'];
        else    return  false;                                                  // Exit, because we do not have ID of element
        
        if (isset($params['title'])) 
                $this->title = $params['title'];
        else    $this->title = __( 'Dismiss'  ,'booking');
        
        if (isset($params['class'])) 
                $this->html_class = $params['class'];
        else    $this->html_class = 'wpbc-panel-dismiss';
        
        $this->show();
        return true;
    }

    public function show(){
        
        // Check if this window is already Hided or not
        if ( '1' == get_user_option( 'booking_win_' . $this->element_id ) )     // Panel Hided
            return false;                                                       
        else {                                                                  // Show Panel
            ?><script type="text/javascript"> jQuery('#<?php echo $this->element_id; ?>').show(); </script><?php
        }
        wp_nonce_field('wpbc_ajax_admin_nonce',  "wpbc_admin_panel_dismiss_window_nonce" ,  true , true );
        // Show Hide link
        ?><a class="<?php echo $this->html_class; ?>" href="javascript:void(0)" 
             onclick="javascript: wpbc_hide_window('<?php echo $this->element_id; ?>');
                                  wpbc_dismiss_window(<?php echo get_bk_current_user_id(); ?>, '<?php echo $this->element_id; ?>');"
          ><?php echo $this->title; ?></a><?php
    }
}

global $wpbc_Dismiss;
$wpbc_Dismiss = new WPBC_Dismiss();
