<?php

/**
 * Class FMControllerLicensing_fmc
 */
class FMControllerLicensing_fmc {
  private $view;
  public function __construct() {
    require_once WDCFM()->plugin_dir . "/admin/views/Licensing_fm.php";
    $this->view = new FMViewLicensing_fmc();
  }
  public function execute() {
    $task = WDW_FMC_Library::get('task');
    $id = (int) WDW_FMC_Library::get('current_id', 0);
    if (method_exists($this, $task)) {
      $this->$task($id);
    }
    else {
      $this->display();
    }
  }

  public function display() {
    $this->view->display();
  }
}