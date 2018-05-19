<?php

/**
 * Class FMControllerFormmakerwdmathcaptcha_fmc
 */
class FMControllerFormmakerwdmathcaptcha_fmc {
  /**
   * @var $view
   */
  private $view;

  /**
   * Execute.
   */
  public function execute() {
    $this->display();
  }

  /**
   * Display.
   */
  public function display() {
    // Load FMViewFormmakerwdmathcaptcha class.
    require_once WDCFM()->plugin_dir . "/admin/views/FMMathCaptcha.php";
    $this->view = new FMViewFormmakerwdmathcaptcha_fmc();
    // Set params for view.
    $params = array();
    $this->view->display($params);
  }
}
