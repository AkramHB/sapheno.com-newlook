<?php 

if ( !defined( 'ABSPATH' ) ) {
 exit;
}

function cf7_style_event_table_head( $defaults ) {
    $new = array();
    foreach( $defaults as $key=>$value) {
        if( $key=='title') {  // when we find the date column
          	$new['preview-style']  = 'Preview Style';
        }    
        $new[$key]=$value;
    }  
    return $new;
}

function cf7_style_event_table_content( $column_name, $post_id ) {
	//    cf7_style_image_preview
	if ( $column_name == 'preview-style' ) {
		$img_src = get_post_meta( $post_id, 'cf7_style_image_preview', true );
		echo "<a href='".admin_url() ."post.php?post=".$post_id."&action=edit"."'><span class='thumb-preview'><img src='" . plugins_url() ."/"."contact-form-7-style". ( empty( $img_src ) ? "/images/default_form.jpg" : $img_src ) . "' alt='".get_the_title( $post_id )."' title='".get_the_title( $post_id )."'/><div class='previewed-img'><img src='" . plugins_url() ."/"."contact-form-7-style". ( empty( $img_src ) ? "/images/default_form.jpg" : $img_src ) . "' alt='".get_the_title( $post_id )."' title='Edit ".get_the_title( $post_id )." Style'/></div></span></a>"	;
	}
}

add_filter( 'manage_cf7_style_posts_columns', 'cf7_style_event_table_head');
add_action( 'manage_cf7_style_posts_custom_column', 'cf7_style_event_table_content', 10, 2 );