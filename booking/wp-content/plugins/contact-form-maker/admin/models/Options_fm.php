<?php

/**
 * Class FMModelOptions_fmc
 */
class FMModelOptions_fmc {
  /**
   * Save data to DB.
   */
  public function save_db() {
    $public_key = WDW_FMC_Library::get('public_key', '');
    $private_key = WDW_FMC_Library::get('private_key', '');
    $csv_delimiter = (isset($_POST['csv_delimiter']) && $_POST['csv_delimiter'] != '' ? esc_html(stripslashes($_POST['csv_delimiter'])) : ',');
    $fm_shortcode = (isset($_POST['fm_shortcode']) ? "old" : '');
    $fm_advanced_layout = WDW_FMC_Library::get('fm_advanced_layout', '0');
    $map_key = WDW_FMC_Library::get('map_key', '');
    update_option('fmc_settings', array(
      'public_key' => $public_key,
      'private_key' => $private_key,
      'csv_delimiter' => $csv_delimiter,
      'map_key' => $map_key,
      'fm_shortcode' => $fm_shortcode,
      'fm_advanced_layout' => $fm_advanced_layout,
    ));
    return 8;
  }
}
