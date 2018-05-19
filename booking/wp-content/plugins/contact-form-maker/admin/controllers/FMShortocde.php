<?php

/**
 * Class FMControllerFMShortocde
 */
class FMControllerFMShortocde_fmc {
  private $model;
  private $view;

  /**
   * FMControllerFMShortocde constructor.
   */
  public function __construct() {
    require_once WDCFM()->plugin_dir . "/admin/models/FMShortocde.php";
    $this->model = new FMModelFMShortocde_fmc();

    require_once WDCFM()->plugin_dir . "/admin/views/FMShortocde.php";
    $this->view = new FMViewFMShortocde_fmc();
  }

  /**
   * Execute.
   */
  public function execute() {
    $task = WDW_FMC_Library::get('task');
    $this->display($task);
  }

  /**
   * Display.
   */
  public function display($task) {
    // Get forms.
    $forms = $this->model->get_form_data();

    if ( method_exists($this->view, $task) ) {
      $this->view->$task($forms);
    }
    else {
      $this->view->form($forms);
    }
  }
}
