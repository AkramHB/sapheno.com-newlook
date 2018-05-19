<?php

/**
 * Class FMModelFMShortocde_fmc
 */
class FMModelFMShortocde_fmc {
  /**
   * Get forms.
   *
   * @return array $rows
   */
  public function get_form_data() {
    global $wpdb;
    $rows = $wpdb->get_results("SELECT * FROM `" . $wpdb->prefix . "formmaker`" . (!WDCFM()->is_free ? '' : ' WHERE id' . (WDCFM()->is_free == 1 ? ' NOT ' : ' ') . 'IN (' . (get_option('contact_form_forms', '') != '' ? get_option('contact_form_forms') : 0) . ') ORDER BY `title`'));
    return $rows;
  }
}
