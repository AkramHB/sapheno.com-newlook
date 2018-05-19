<?php

/**
 * Class FMViewLicensing_fmc
 */
class FMViewLicensing_fmc {
  /**
   * FMViewLicensing_fm constructor.
   */
  public function __construct() {
    wp_enqueue_style('fm-license' . WDCFM()->menu_postfix);
    wp_enqueue_style('fm-style');
    wp_enqueue_style('fm-tables');
    wp_enqueue_script('fm-admin');
  }

  public function display() {
    ?>
    <div style="width:99%">
      <div id="featurs_tables">
        <div id="featurs_table1">
          <span>File Upload Field</span>
          <span>Google Map</span>
          <span>PayPal Integration</span>
          <span>Front-End Submissions</span>
          <span>Multiple/Single Choice</span>
          <span>Survey Tools</span>
          <span>Time and Date Fields</span>
          <span>Select Box</span>
          <span>MySQL mapping</span>
        </div>
        <div id="featurs_table2">
          <span>Free</span>
          <span class="no"></span>
          <span class="no"></span>
          <span class="no"></span>
          <span class="no"></span>
          <span class="no"></span>
          <span class="no"></span>
          <span class="no"></span>
          <span class="no"></span>
          <span class="no"></span>
        </div>
        <div id="featurs_table3">
          <span>Pro Version</span>
          <span class="yes"></span>
          <span class="yes"></span>
          <span class="yes"></span>
          <span class="yes"></span>
          <span class="yes"></span>
          <span class="yes"></span>
          <span class="yes"></span>
          <span class="yes"></span>
          <span class="yes"></span>
        </div>
      </div>
      <div style="float: left; clear: both;">
        <a href="https://web-dorado.com/files/fromFormMaker.php" class="button-primary" target="_blank">Purchase a
          License</a>
        <br/><br/>
        <p>After purchasing the commercial version follow these steps:</p>
        <ol>
          <li>Deactivate Form Maker Plugin.</li>
          <li>Delete Form Maker Plugin.</li>
          <li>Install the downloaded commercial version of the plugin.</li>
        </ol>
      </div>
    <?php
  }
}
