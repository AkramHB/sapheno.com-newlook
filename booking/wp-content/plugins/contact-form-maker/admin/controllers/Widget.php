<?php

/**
 * Class FMControllerWidget_fmc
 */
class FMControllerWidget_fmc extends WP_Widget {
  private $view;
  private $model;

  public function __construct() {
    $widget_ops = array(
      'classname' => 'form_maker_widget',
      'description' => __('Add Contact Form Maker widget.', WDCFM()->prefix),
    );
    // Widget Control Settings.
    $control_ops = array( 'id_base' => 'form_maker_widget' );
    // Create the widget.
    parent::__construct('form_maker_widget', WDCFM()->nicename, $widget_ops, $control_ops);
    require_once WDCFM()->plugin_dir . "/admin/models/Widget.php";
    $this->model = new FMModelWidget_fmc();
    require_once WDCFM()->plugin_dir . "/admin/views/Widget.php";
    $this->view = new FMViewWidget_fmc($this->model);
  }

  public function widget( $args, $instance ) {
    require_once(WDCFM()->plugin_dir . '/frontend/controllers/form_maker.php');
    $controller_class = 'FMControllerForm_maker_fmc';
    $controller = new $controller_class();
    $execute = $controller->execute($instance['form_id']);
    $this->view->widget($args, $instance, $execute);
  }

  public function form( $instance ) {
    $ids_FM = $this->model->get_gallery_rows_data(); // ids_Form_Maker
    $this->view->form($instance, $ids_FM, parent::get_field_id('title'), parent::get_field_name('title'), parent::get_field_id('form_id'), parent::get_field_name('form_id'));
  }

  // Update Settings.
  public function update( $new_instance, $old_instance ) {
    $instance['title'] = $new_instance['title'];
    $instance['form_id'] = $new_instance['form_id'];

    return $instance;
  }
}
