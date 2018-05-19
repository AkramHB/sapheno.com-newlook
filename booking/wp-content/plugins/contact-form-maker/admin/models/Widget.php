<?php

/**
 * Class FMModelWidget_fmc
 */
class FMModelWidget_fmc {
  public function get_gallery_rows_data() {
    global $wpdb;
    $query = "SELECT * FROM " . $wpdb->prefix . "formmaker order by `title`";
    $rows = $wpdb->get_results($query);

    return $rows;
  }
}
