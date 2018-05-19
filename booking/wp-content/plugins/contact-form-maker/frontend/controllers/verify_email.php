<?php

/**
 * Class FMControllerVerify_email_fmc
 */
class FMControllerVerify_email_fmc {
  private $view;
  private $model;

  /**
   * FMControllerVerify_email constructor.
   */
  public function __construct() {
    require_once WDCFM()->plugin_dir . "/frontend/models/verify_email.php";
    $this->model = new FMModelVerify_email_fmc();

    require_once WDCFM()->plugin_dir . "/frontend/views/verify_email.php";
    $this->view = new FMViewVerify_email_fmc();
  }

	public function execute() {
		return $this->display();
	}

	public function display() {
    $gid = (int) WDW_FMC_Library::get('gid', 0);
    $hashInfo = WDW_FMC_Library::get('h', 0);
    $hashInfo = explode("@", $hashInfo);
    $md5 = $hashInfo[0];
    $recipient = isset($hashInfo[1]) ? $hashInfo[1] : '';
    if ( $gid <= 0 or strlen($md5) <= 0 or strlen($recipient) <= 0 ) {
      return;
    }

    //Set given email as validated and get message.
    $message = $this->model->set_validation($gid, $md5, $recipient);

    if ( $message ) {
      $this->view->display($message);
    }
	}
}
