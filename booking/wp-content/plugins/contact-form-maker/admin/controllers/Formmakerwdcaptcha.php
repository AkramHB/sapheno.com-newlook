<?php
/**
 * Class FMControllerFormmakerwdcaptcha_fmc
 */
class FMControllerFormmakerwdcaptcha_fmc {
  /**
   * @var view
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
    // Load FMViewFormmakerwdcaptcha class.
    require_once WDCFM()->plugin_dir . "/admin/views/FMCaptcha.php";
    $this->view = new FMViewFormmakerwdcaptcha_fmc();
    // Set params for view.
    $params = array();
    $this->view->display($params);
  }
}
