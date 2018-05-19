<?php

/**
 * Class FMViewCheckpaypal
 */
class FMViewCheckpaypal {
  /**
   * Payment information template.
   *
   * @param array $template_params
   *
   * @return string
   */
  public function payment_information_template( $template_params ) {
    $form_session = $template_params['form_session'];
    $data = $template_params['data'];
    $tax = $data['tax'];
    $total = $data['total'];
    $shipping = $data['shipping'];
    $currency = $form_session->currency;
    ob_start();
    ?>
    <table class="admintable" border="1">
      <tr>
        <td class="key"><?php _e('Currency', WDCFM()->prefix); ?></td>
        <td><?php echo $currency; ?></td>
      </tr>
      <tr>
        <td class="key"><?php _e('Date', WDCFM()->prefix); ?></td>
        <td><?php echo $form_session->ord_last_modified; ?></td>
      </tr>
      <tr>
        <td class="key"><?php _e('Status', WDCFM()->prefix); ?></td>
        <td><?php echo $form_session->status; ?></td>
      </tr>
      <tr>
        <td class="key"><?php _e('Full name', WDCFM()->prefix); ?></td>
        <td><?php echo $form_session->full_name; ?></td>
      </tr>
      <tr>
        <td class="key"><?php _e('Email', WDCFM()->prefix); ?></td>
        <td><?php echo $form_session->email; ?></td>
      </tr>
      <tr>
        <td class="key"><?php _e('Phone', WDCFM()->prefix); ?></td>
        <td><?php echo $form_session->phone; ?></td>
      </tr>
      <tr>
        <td class="key"><?php _e('Mobile phone', WDCFM()->prefix); ?></td>
        <td><?php echo $form_session->mobile_phone; ?></td>
      </tr>
      <tr>
        <td class="key"><?php _e('Fax', WDCFM()->prefix); ?></td>
        <td><?php echo $form_session->fax; ?></td>
      </tr>
      <tr>
        <td class="key"><?php _e('Address', WDCFM()->prefix); ?></td>
        <td><?php echo $form_session->address; ?></td>
      </tr>
      <tr>
        <td class="key"><?php _e('Payment info', WDCFM()->prefix); ?></td>
        <td><?php echo $form_session->paypal_info; ?></td>
      </tr>
      <tr>
        <td class="key"><?php _e('IPN', WDCFM()->prefix); ?></td>
        <td><?php echo $form_session->ipn; ?></td>
      </tr>
      <tr>
        <td class="key"><?php _e('tax', WDCFM()->prefix); ?></td>
        <td><?php echo $form_session->tax; ?>%</td>
      </tr>
      <tr>
        <td class="key"><?php _e('shipping', WDCFM()->prefix); ?></td>
        <td><?php echo $form_session->shipping; ?></td>
      </tr>
      <tr>
        <td class="key"><?php _e('read', WDCFM()->prefix); ?></td>
        <td><?php echo $form_session->read; ?></td>
      </tr>
      <tr>
        <td class="key"><b><?php _e('Item total', WDCFM()->prefix); ?></b></td>
        <td><?php echo ($total - $tax - $shipping) . $currency; ?></td>
      </tr>
      <tr>
        <td class="key"><b><?php _e('Tax', WDCFM()->prefix); ?></b></td>
        <td> <?php echo $tax . $currency; ?></td>
      </tr>
      <tr>
        <td class="key"><b><?php _e('Shipping and handling', WDCFM()->prefix); ?></b></td>
        <td><?php echo $shipping . $currency; ?></td>
      </tr>
      <tr>
        <td class="key"><b><?php _e('Total', WDCFM()->prefix); ?></b></td>
        <td><?php echo $total . $currency; ?></td>
      </tr>
    </table>
    <?php

    return ob_get_clean();
  }
}
