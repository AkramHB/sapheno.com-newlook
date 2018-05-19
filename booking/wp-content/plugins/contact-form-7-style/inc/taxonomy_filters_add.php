<?php 

if ( !defined( 'ABSPATH' ) ) {
 exit;
}

function cf7_style_add_taxonomy_filters() {
	global $typenow;
	// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array( 'style_category' );
	// must set this to the post type you want the filter(s) displayed on
	if( $typenow == 'cf7_style' ){
		foreach ( $taxonomies as $tax_slug ) {
			$tax_obj = get_taxonomy( $tax_slug );
			
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms( $tax_slug );
			if( count( $terms ) > 0 ) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>Show All $tax_name</option>";
				foreach ( $terms as $term ) {
					$resultA = "<option value='".$term->slug."' selected='selected'>".$term->name .' (' . $term->count .')'."</option>";
					$resultB = "<option value='".$term->slug."'>".$term->name .' (' . $term->count .')'."</option>";
					echo ( isset( $_GET[$tax_slug] ) ) ? ( ( $_GET[$tax_slug] == $term->slug ) ? $resultA : $resultB ) : $resultB;
				}
				echo "</select>";
			}
		}
	}
}// end cf7_style_add_taxonomy_filters

add_action( 'restrict_manage_posts', 'cf7_style_add_taxonomy_filters' );