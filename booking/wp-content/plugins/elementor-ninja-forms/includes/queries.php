<?php
/**
 * Get Ninja Form List
 * @return array
 */
function eael_select_ninja_form_stand_alone() {
    global $wpdb;
    $eael_nf_table_name = $wpdb->prefix.'nf3_forms';
    $forms = $wpdb->get_results( "SELECT id, title FROM $eael_nf_table_name" );
    foreach( $forms as $form ) {
        $options[$form->id] = $form->title;
    }
    return $options;
}
