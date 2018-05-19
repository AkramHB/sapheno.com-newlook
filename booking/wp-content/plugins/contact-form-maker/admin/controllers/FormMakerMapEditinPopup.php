<?php

/**
 * Class FMControllerFormmakermapeditinpopup_fmc
 */
class FMControllerFormmakermapeditinpopup_fmc {
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
    // Load FMViewFrommapeditinpopup class.
    require_once WDCFM()->plugin_dir . "/admin/views/FMMapEditinPopup.php";
    $this->view = new FMViewFrommapeditinpopup_fmc();
    // Get form maker settings.
    $fm_settings = get_option('fmc_settings');
    // Set params for view.
    $params = array();
    $params['map_key'] = !empty($fm_settings['map_key']) ? '&key=' . $fm_settings['map_key'] : '';
    $params['long'] = WDW_FMC_Library::get('long', 0);
    $params['lat'] = WDW_FMC_Library::get('lat', 0);
    $this->view->display($params);
  }
}
