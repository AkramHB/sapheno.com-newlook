<?php

/**
 * Class FMControllerFormmakereditcountryinpopup_fmc
 */
class FMControllerFormmakereditcountryinpopup_fmc {
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
    // Load FMViewFromeditcountryinpopup class.
    require_once WDCFM()->plugin_dir . "/admin/views/FMEditCountryinPopup.php";
    $this->view = new FMViewFromeditcountryinpopup_fmc();
    // Set params for view.
    $params = array();
    $params['field_id'] = WDW_FMC_Library::get('field_id', 0);
    $this->view->display($params);
  }
}
