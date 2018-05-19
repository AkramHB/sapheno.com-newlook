<?php

/**
 * Class FMControllerOptions_fmc
 */
class FMControllerOptions_fmc {
  private $model;
  private $view;

  public function __construct() {
    require_once WDCFM()->plugin_dir . "/admin/models/Options_fm.php";
    $this->model = new FMModelOptions_fmc();
    require_once WDCFM()->plugin_dir . "/admin/views/Options_fm.php";
    $this->view = new FMViewOptions_fmc();
  }

  public function execute() {
    $task = WDW_FMC_Library::get('task');
    $id = (int) WDW_FMC_Library::get('current_id', 0);
    if ( method_exists($this, $task) ) {
      check_admin_referer(WDCFM()->nonce, WDCFM()->nonce);
      $this->$task($id);
    }
    else {
      $this->display();
    }
  }

  public function display() {
    $fm_settings = get_option('fmc_settings');
    $this->view->display($fm_settings);
  }

  public function save() {
    $message = $this->model->save_db();
    $page = WDW_FMC_Library::get('page');
    WDW_FMC_Library::fm_redirect(add_query_arg(array(
                                                'page' => $page,
                                                'task' => 'display',
                                                'message' => $message,
                                              ), admin_url('admin.php')));
  }
}
