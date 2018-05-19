<?php 
/*
 * function for displaying the meta box
 */

if ( !defined( 'ABSPATH' ) ) {
 exit;
}

function cf7_style_display_slider( $post ) { 
    $stylearray = array(
        'post_type'         => 'cf7_style',
        'posts_per_page'    => -1,
        'order'             => 'DESC',
        'orderby'           => 'ID'
    );
    $styles = get_posts( $stylearray );
    $activetemplate = get_post_meta( $post->id(), 'cf7_style_id', true );

    ?>
    <div class="cf7-style-slider">
        <div class="cf7-style-slider-wrap">
            <ul class="cf7slider">
                <?php 
                $i = 1;
                foreach ($styles as $style) {
                    $previewimage = get_post_meta( $style->ID, 'cf7_style_image_preview', true ); ?>
                    <li class="slide  <?php echo ( ( $activetemplate  == $style->ID ) ? 'active current-saved' : '' );?>">
                        <span>
                            <div class="overlay">
                                <em><?php echo ( ( $activetemplate  == $style->ID ) ? 'Active' : 'Not Active' );?></em>
                            </div>
                            <img src="<?php echo plugins_url(); ?>/contact-form-7-style/<?php echo ( !empty( $previewimage ) ? $previewimage : '/images/default_form.jpg' ); ?>" alt="" />
                            <input type="radio" id="cf7style_template_<?php echo $i; ?>" name="cf7style_template" class="cf7style_template" value="<?php echo $style->ID; ?>" <?php echo ( ( $activetemplate  == $style->ID ) ? 'checked' : '' );?> />
                            
                            <?php echo $style->post_title; ?>
                        </span>
                    </li>
                <?php $i++; } ?>
            </ul>
            <div class="cf7arrows">
                <div><a href="#" class="narrow left" data-direction="left"></a></div>
                <div><a href="#" class="narrow right" data-direction="right"></a></div>
            </div>
        </div>
    </div>
    
<?php }
/*
 * saving stuff
 */
function cf7_style_save_meta_box_data( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( isset( $_POST['wpcf7-new'] ) ) {
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }
    } else {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }
    if ( ! isset( $_POST['cf7style_template'] ) ) {
        return;
    }

    if ( !is_numeric( $_POST['cf7style_template'] ) ) {
        die('No tricks please');
    }
    $styleid = sanitize_text_field( $_POST['cf7style_template'] );
    update_post_meta( $post_id, 'cf7_style_id', $styleid );
}
add_action( 'save_post', 'cf7_style_save_meta_box_data' );


/*
 * new panel
 */
function cf7style_add_template_panel ( $panels ) {
    $panels['Cf7StyleTemplate'] = array(
        'title'     => __( 'Contact Form 7 Style Template', 'contact-form-7' ),
        'callback'  => 'cf7_style_display_slider'
    );
    return $panels;
}



/*
 * old meta box
 */
function cf7style_meta_box ( $post_id ) {
    add_meta_box('cf7_style_slider', 'Choose a template', 'cf7_style_display_slider', null, 'mail', 'core');
}

/*
 * depending on what CF7 version is active, 
 * we use the appropiate hook!
 */
function init_meta_box_by_version() {
    $plugin_folder = get_plugins( '/' . 'contact-form-7' );
    $plugin_file = 'wp-contact-form-7.php';
    if($plugin_folder){
        $CF7Version = $plugin_folder[$plugin_file]['Version'];
        if ( $CF7Version < 4.2 ) {
            add_action( 'wpcf7_add_meta_boxes', 'cf7style_meta_box' );
        } else {
            add_filter( 'wpcf7_editor_panels', 'cf7style_add_template_panel' );
        }
    }
}
add_action( 'admin_init', 'init_meta_box_by_version' );