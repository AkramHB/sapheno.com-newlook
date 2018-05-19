<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( function_exists( 'current_user_can' ) ) {
    if ( ! current_user_can( 'manage_options' ) ) {
        die( 'Access Denied' );
    }
}
if ( ! function_exists( 'current_user_can' ) ) {
    die( 'Access Denied' );
}

function hugeit_contact_show_settings() {
    global $wpdb;
    $query        = "SELECT *  FROM " . $wpdb->prefix . "huge_it_contact_general_options ";
    $rows         = $wpdb->get_results( $query );
    $param_values = array();
    foreach ( $rows as $row ) {
        $key                  = $row->name;
        $value                = $row->value;
        $param_values[ $key ] = $value;
    }
    hugeit_contact_html_show_settings( $param_values );
}

function hugeit_contact_save_styles_options(){
    global $wpdb;
    if ( !isset($_GET['_wpnonce'] ) || ! wp_verify_nonce($_GET['_wpnonce'], 'hugeit_forms_save_general_options') ) {
        return false;
    }
    if (isset($_POST['params'])){
    $params = $_POST['params'];
        foreach ($params as $key => $value) {
            $option_exists=count($wpdb->get_results($wpdb->prepare('SELECT * FROM '.$wpdb->prefix . 'huge_it_contact_general_options WHERE name= %s',$key)));
            if($option_exists) {
                $wpdb->update($wpdb->prefix . 'huge_it_contact_general_options',
                    array('value' => esc_sql($value)),
                    array('name' => esc_sql($key)),
                    array('%s')
                );
            }
            else{
                $wpdb->insert($wpdb->prefix . 'huge_it_contact_general_options',
                    array('value' => esc_sql($value),'name' => esc_sql($key)),
                    array('%s')
                );
            }
        }

        $adminMessage = sanitize_text_field(htmlspecialchars(stripslashes($_POST['hugeit_contact_adminmessage'])));
        $userMessage = sanitize_text_field(htmlspecialchars(stripslashes($_POST['hugeit_contact_usermessage'])));
        $images='';
        $pattern='/(<img.*?>)/';
        preg_match_all($pattern, $userMessage, $images);
        $i=0;
        $patterns=array();
        foreach ($images[0] as $image) {
            $image =preg_replace('/"/', "", $image); 
            $image =preg_replace('/\</', "", $image);
            $image =preg_replace('/\>/', "", $image);   
             

            $patterns[$i]=$image;
            $i++;           
        }
        $userMessage=preg_replace($images[0], $patterns, $userMessage);
        $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_contact_general_options SET  value='%s'  WHERE name = 'form_adminstrator_message' ", $adminMessage));
        $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_contact_general_options SET  value='%s'  WHERE name = 'form_user_message' ", $userMessage));

        ?>
        <div class="updated"><p><strong><?php _e('Item Saved'); ?></strong></p></div>
        <?php
	}
}