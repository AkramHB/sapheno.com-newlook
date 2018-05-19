<?php

/**
 * Class FMControllerGenerete_csv
 */
class FMControllerGenerete_csv {
  /**
   * Execute.
   */
  public function execute() {
    $this->display();
  }

  /**
   * display.
   */
  public function display() {
    // Get form maker settings
    $fm_settings = get_option('fm_settings');
    $csv_delimiter = isset($fm_settings['csv_delimiter']) ? $fm_settings['csv_delimiter'] : ',';
    $form_id = (int) $_REQUEST['form_id'];
    $limitstart = (int) $_REQUEST['limitstart'];
    $send_header = (int) $_REQUEST['send_header'];
    $params = WDW_FM_Library::get_submissions_to_export();
    $data = $params[0];
    $title = $params[1];
    $is_paypal_info = $params[2];
    $all_keys = array();
    foreach ( $data as $row ) {
      $all_keys = array_merge($all_keys, $row);
    }
    $keys_array = array_keys($all_keys);
    foreach ( $data as $key => $row ) {
      foreach ( $keys_array as $key1 => $value ) {
        if ( !array_key_exists($value, $row) ) {
          array_splice($row, $key1, 0, '');
        }
      }
      $data[$key] = $row;
    }
    $upload_dir = wp_upload_dir();
    $file_path = $upload_dir['basedir'] . '/form-maker';
    if ( !is_dir($file_path) ) {
      mkdir($file_path, 0777);
    }
    $tempfile = $file_path . '/export' . $form_id . '.txt';
    if ( $limitstart == 0 && file_exists($tempfile) ) {
      unlink($tempfile);
    }
    $output = fopen($tempfile, "a");
    if ( $limitstart == 0 ) {
      fputcsv($output, str_replace('PAYPAL_', '', $keys_array), $csv_delimiter);
    }
    foreach ( $data as $record ) {
      fputcsv($output, $record, $csv_delimiter);
    }
    fclose($output);
    if ( $send_header == 1 ) {
      $txtfile = fopen($tempfile, "r");
      $txtfilecontent = fread($txtfile, filesize($tempfile));
      fclose($txtfile);
      $filename = $title . "_" . date('Ymd') . ".csv";
      header('Content-Encoding: Windows-1252');
      header('Content-type: text/csv; charset=Windows-1252');
      header("Content-Disposition: attachment; filename=\"$filename\"");
      echo $txtfilecontent;
      unlink($tempfile);
    }
    die();
  }
}
