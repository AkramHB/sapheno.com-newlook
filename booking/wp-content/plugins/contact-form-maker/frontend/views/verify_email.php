<?php

/**
 * Class FMViewVerify_email_fmc
 */
class FMViewVerify_email_fmc {
  /**
   * Display message.
   *
   * @param $message
   */
	public function display($message) {
		echo WDW_FMC_Library::message($message, 'fm-notice-success');
	}
}
