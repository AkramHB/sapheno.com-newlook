<?php

/**
 * Class FMModelCheckpaypal
 */
class FMModelCheckpaypal {
  /**
   * Get form by id.
   *
   * @param  int $id
   *
   * @return object $row
   */
  public function get_form_by_id( $id ) {
    global $wpdb;
    $row = $wpdb->get_row($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'formmaker WHERE id="%d"', $id));

    return $row;
  }

  /**
   * Get form session by group id.
   *
   * @param  int $id
   *
   * @return object $row
   */
  public function get_form_session_by_group_id( $id ) {
    global $wpdb;
    $row = $wpdb->get_row($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'formmaker_sessions WHERE group_id="%d"', $id));

    return $row;
  }

  /**
   * Update submission status.
   *
   * @param  int $payment_status
   * @param  int $group_id
   */
  public function update_submission_status( $payment_status, $group_id ) {
    global $wpdb;
    $wpdb->update($wpdb->prefix . "formmaker_submits", array(
      'element_value' => $payment_status,
    ), array(
                    'group_id' => $group_id,
                    'element_label' => 0,
                  ));

    return;
  }

  /**
   * Connect PayPal.
   *
   * @param  array $params
   *
   * @return array $response
   */
  public function connect_to_paypal( $params ) {
    // Set paypal action, default connect to sandbox.
    if ( $params['checkout_mode'] == 1 || $params['checkout_mode'] == 'production' ) {
      $action = "https://www.paypal.com/cgi-bin/webscr";
    }
    else {
      $action = "https://www.sandbox.paypal.com/cgi-bin/webscr";
    }
    $post_fields = $params['post_fields'];
    $curlConfig = array(
      CURLOPT_URL => $action,
      CURLOPT_POST => TRUE,
      CURLOPT_RETURNTRANSFER => TRUE,
      CURLOPT_SSL_VERIFYPEER => FALSE,
      CURLOPT_POSTFIELDS => $post_fields,
    );
    $curl = curl_init();
    curl_setopt_array($curl, $curlConfig);
    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
  }

  /**
   * Add form maker sessions.
   *
   * @param  array $data
   */
  public function add_formmaker_sessions( $data ) {
    global $wpdb;
    $wpdb->insert($wpdb->prefix . "formmaker_sessions", $data);

    return;
  }

  /**
   * Update form maker sessions by group_id.
   *
   * @param  int   $group_id
   * @param  array $data
   */
  public function update_formmaker_sessions_by_group_id( $group_id, $data ) {
    global $wpdb;
    $wpdb->update($wpdb->prefix . "formmaker_sessions", $data, array( 'group_id' => $group_id ));

    return;
  }
}
