<?php

class Hugeit_Contact_Theme_Options extends WPDEV_Settings_API_Form
{
    public $plugin_id = 'forms_contact';

    public $tablename = 'huge_it_contact_style_fields';

    public $to_save = 'theme_options';

    public function __construct()
    {
        $config = array(
            'menu_slug' => 'hugeit_forms_theme_options',
            'parent_slug' => 'hugeit_forms_main_page',
            'page_title' => __('Theme Options', 'hugeit_contact'),
            'title' => __('Forms Contact Theme Options', 'hugeit_contact'),
            'menu_title' => __('Theme Options', 'hugeit_contact'),
        );

        $this->init_panels();
        $this->init();
        $this->init_sections();
        $this->init_controls();

        parent::__construct($config);

        $this->add_css('fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css?ver=4.9' );
        $this->add_css('huge-icons-styles', plugins_url('../style/iconfonts/css/hugeicons.css',__FILE__) );
        $this->add_css('wpdev-custom-styles', plugins_url('../vendor/wpdev-settings/assets/css/wpdev-settings.css',__FILE__) );
        $this->add_css('hugeit-contact-freebanner', plugins_url('../style/admin.style.css',__FILE__) );
        $this->add_js ('wpdev-custom-js',  plugins_url('../vendor/wpdev-settings/assets/js/wpdev-settings.js',__FILE__));
        $this->add_js ('theme-options',  plugins_url('../js/theme_options.js',__FILE__));

        add_action( 'wp_ajax_edit_theme_title', array( $this, 'update_theme_title' ) );
        add_action( 'wpdev_settings_'.$this->plugin_id.'_header', array( $this, 'drawFreeBanner' ) );

    }

    /**
     * Initialize user defined variables
     */
    public function init()
    {
        $this->init_theme_options();
    }


    /**
     *
     */
    public function init_panels()
    {
        $panelsArray = array();

        global $wpdb;

        if(isset($_GET['page']) && $_GET['page']=='hugeit_forms_theme_options' && isset($_GET['id']) && absint($_GET['id'])) {
            $themes = $wpdb->get_results('SELECT name,id FROM '.$wpdb->prefix.'huge_it_contact_styles WHERE id='.$_GET['id']);
        } else {
            $themes = $wpdb->get_results('SELECT name,id FROM '.$wpdb->prefix.'huge_it_contact_styles ORDER BY id asc');
        }

        $theme = $themes[0];

        $panelsArray[str_replace('&','_',str_replace(' ','_',strtolower($theme->name)))] = array(
            'title'=>__($theme->name,'hugeit_contact'),
            'id'=>$theme->id,
            'disabled'=>true,
            'disabled_link'=>'https://goo.gl/ycVtso'
        );


        $this->panels = $panelsArray;
    }


    public function init_sections()
    {
        $sectionsArray = array();
        foreach ($this->panels as $key=>$panel){
            if(isset($_GET['id']) && $panel['id']==$_GET['id']){
                $sectionsArray['form_block_styles'.$panel['id']] = array(
                    'panel' => $key,
                    'title' => __('Form Block Styles', 'hugeit_contact'),
                );
                $sectionsArray['label_styles'.$panel['id']] = array(
                    'panel' => $key,
                    'title' => __('Label Styles', 'hugeit_contact'),
                );
                $sectionsArray['textarea_styles'.$panel['id']] = array(
                    'panel' => $key,
                    'title' => __('Textarea Styles', 'hugeit_contact'),
                );
                $sectionsArray['text_input_styles'.$panel['id']] = array(
                    'panel' => $key,
                    'title' => __('Text Input Styles', 'hugeit_contact'),
                );
                $sectionsArray['checkbox_styles'.$panel['id']] = array(
                    'panel' => $key,
                    'title' => __('Checkbox Styles', 'hugeit_contact'),
                );
                $sectionsArray['selectbox_styles'.$panel['id']] = array(
                    'panel' => $key,
                    'title' => __('Selectbox Styles', 'hugeit_contact'),
                );
                $sectionsArray['radio_styles'.$panel['id']] = array(
                    'panel' => $key,
                    'title' => __('Radio Styles', 'hugeit_contact'),
                );
                $sectionsArray['pagination_styles'.$panel['id']] = array(
                    'panel' => $key,
                    'title' => __('Pagination Styles', 'hugeit_contact'),
                );
                $sectionsArray['file_upload_styles'.$panel['id']] = array(
                    'panel' => $key,
                    'title' => __('File Uploader Styles', 'hugeit_contact'),
                );
                $sectionsArray['button_styles'.$panel['id']] = array(
                    'panel' => $key,
                    'title' => __('Button Styles', 'hugeit_contact'),
                );
                $sectionsArray['custom_styles'.$panel['id']] = array(
                    'panel' => $key,
                    'title' => __('Custom Styles', 'hugeit_contact'),
                );
            }
        }

        $this->sections = $sectionsArray;
    }

    /**
     * Display the admin page
     */
    public function init_controls()
    {
        $this->controls = array();
        $controls_forms_general_options = $this->controls_general_options();

        foreach ($controls_forms_general_options as $control_id => $control) {
            $this->controls[$control_id] = $control;
        }

    }

    private function init_theme_options()
    {
        foreach ($this->panels as $key=>$panel){
            if(isset($_GET['id']) && $panel['id']==$_GET['id']){
                $this->{'form_wrapper_width'.$panel['id']} = $this->get_option_from_table("form_wrapper_width", '100', true, array('options_name'=>$panel['id']));
                $this->{'form_wrapper_background_type'.$panel['id']} = $this->get_option_from_table("form_wrapper_background_type", 'color', true, array('options_name'=>$panel['id']));
                $this->{'form_wrapper_background_color'.$panel['id']} = $this->get_option_from_table("form_wrapper_background_color", '#fff', true, array('options_name'=>$panel['id']));
                $this->{'form_border_size'.$panel['id']} = $this->get_option_from_table("form_border_size", '1', true, array('options_name'=>$panel['id']));
                $this->{'form_border_color'.$panel['id']} = $this->get_option_from_table("form_border_color", '#ccc', true, array('options_name'=>$panel['id']));
                $this->{'form_show_title'.$panel['id']} = $this->get_option_from_table("form_show_title", 'on', true, array('options_name'=>$panel['id']));
                $this->{'form_title_size'.$panel['id']} = $this->get_option_from_table("form_title_size", '18', true, array('options_name'=>$panel['id']));
                $this->{'form_title_color'.$panel['id']} = $this->get_option_from_table("form_title_color", '#666', true, array('options_name'=>$panel['id']));

                $this->{'form_label_size'.$panel['id']} = $this->get_option_from_table("form_label_size", '14', true, array('options_name'=>$panel['id']));
                $this->{'form_label_font_family'.$panel['id']} = $this->get_option_from_table("form_label_font_family", '', true, array('options_name'=>$panel['id']));
                $this->{'form_label_color'.$panel['id']} = $this->get_option_from_table("form_label_color", '3B3B3B', true, array('options_name'=>$panel['id']));
                $this->{'form_label_error_color'.$panel['id']} = $this->get_option_from_table("form_label_error_color", '2C15C2', true, array('options_name'=>$panel['id']));
                $this->{'form_label_required_color'.$panel['id']} = $this->get_option_from_table("form_label_required_color", 'FE5858', true, array('options_name'=>$panel['id']));
                $this->{'form_label_success_message'.$panel['id']} = $this->get_option_from_table("form_label_success_message", '3DAD48', true, array('options_name'=>$panel['id']));

                $this->{'form_input_text_has_background'.$panel['id']} = $this->get_option_from_table("form_input_text_has_background", 'on', true, array('options_name'=>$panel['id']));
                $this->{'form_input_text_background_color'.$panel['id']} = $this->get_option_from_table("form_input_text_background_color", 'FFF', true, array('options_name'=>$panel['id']));
                $this->{'form_input_text_border_size'.$panel['id']} = $this->get_option_from_table("form_input_text_border_size", '1', true, array('options_name'=>$panel['id']));
                $this->{'form_input_text_border_radius'.$panel['id']} = $this->get_option_from_table("form_input_text_border_radius", '0', true, array('options_name'=>$panel['id']));
                $this->{'form_input_text_border_color'.$panel['id']} = $this->get_option_from_table("form_input_text_border_color", 'cecece', true, array('options_name'=>$panel['id']));
                $this->{'form_input_text_font_size'.$panel['id']} = $this->get_option_from_table("form_input_text_font_size", '13', true, array('options_name'=>$panel['id']));
                $this->{'form_input_text_font_color'.$panel['id']} = $this->get_option_from_table("form_input_text_font_color", '999', true, array('options_name'=>$panel['id']));

                $this->{'form_textarea_has_background'.$panel['id']} = $this->get_option_from_table("form_textarea_has_background", 'on', true, array('options_name'=>$panel['id']));
                $this->{'form_textarea_background_color'.$panel['id']} = $this->get_option_from_table("form_textarea_background_color", 'FFF', true, array('options_name'=>$panel['id']));
                $this->{'form_textarea_border_size'.$panel['id']} = $this->get_option_from_table("form_textarea_border_size", '1', true, array('options_name'=>$panel['id']));
                $this->{'form_textarea_border_radius'.$panel['id']} = $this->get_option_from_table("form_textarea_border_radius", '0', true, array('options_name'=>$panel['id']));
                $this->{'form_textarea_border_color'.$panel['id']} = $this->get_option_from_table("form_textarea_border_color", '7d7d7d', true, array('options_name'=>$panel['id']));
                $this->{'form_textarea_font_size'.$panel['id']} = $this->get_option_from_table("form_textarea_font_size", '12', true, array('options_name'=>$panel['id']));
                $this->{'form_textarea_font_color'.$panel['id']} = $this->get_option_from_table("form_textarea_font_color", '999', true, array('options_name'=>$panel['id']));

                $this->{'form_checkbox_size'.$panel['id']} = $this->get_option_from_table("form_checkbox_size", 'medium', true, array('options_name'=>$panel['id']));
                $this->{'form_checkbox_type'.$panel['id']} = $this->get_option_from_table("form_checkbox_type", 'square', true, array('options_name'=>$panel['id']));
                $this->{'form_checkbox_color'.$panel['id']} = $this->get_option_from_table("form_checkbox_color", '999', true, array('options_name'=>$panel['id']));
                $this->{'form_checkbox_hover_color'.$panel['id']} = $this->get_option_from_table("form_checkbox_hover_color", '999', true, array('options_name'=>$panel['id']));
                $this->{'form_checkbox_active_color'.$panel['id']} = $this->get_option_from_table("form_checkbox_active_color", '666', true, array('options_name'=>$panel['id']));

                $this->{'form_selectbox_has_background'.$panel['id']} = $this->get_option_from_table("form_selectbox_has_background", 'on', true, array('options_name'=>$panel['id']));
                $this->{'form_selectbox_background_color'.$panel['id']} = $this->get_option_from_table("form_selectbox_background_color", 'FFF', true, array('options_name'=>$panel['id']));
                $this->{'form_selectbox_border_size'.$panel['id']} = $this->get_option_from_table("form_selectbox_border_size", '1', true, array('options_name'=>$panel['id']));
                $this->{'form_selectbox_border_radius'.$panel['id']} = $this->get_option_from_table("form_selectbox_border_radius", '0', true, array('options_name'=>$panel['id']));
                $this->{'form_selectbox_border_color'.$panel['id']} = $this->get_option_from_table("form_selectbox_border_color", '666', true, array('options_name'=>$panel['id']));
                $this->{'form_selectbox_font_size'.$panel['id']} = $this->get_option_from_table("form_selectbox_font_size", '12', true, array('options_name'=>$panel['id']));
                $this->{'form_selectbox_font_color'.$panel['id']} = $this->get_option_from_table("form_selectbox_font_color", '666', true, array('options_name'=>$panel['id']));

                $this->{'form_radio_size'.$panel['id']} = $this->get_option_from_table("form_radio_size", 'medium', true, array('options_name'=>$panel['id']));
                $this->{'form_radio_type'.$panel['id']} = $this->get_option_from_table("form_radio_type", 'square', true, array('options_name'=>$panel['id']));
                $this->{'form_radio_color'.$panel['id']} = $this->get_option_from_table("form_radio_color", '999', true, array('options_name'=>$panel['id']));
                $this->{'form_radio_hover_color'.$panel['id']} = $this->get_option_from_table("form_radio_hover_color", '999', true, array('options_name'=>$panel['id']));
                $this->{'form_radio_active_color'.$panel['id']} = $this->get_option_from_table("form_radio_active_color", '666', true, array('options_name'=>$panel['id']));

                $this->{'form_pagination_has_background'.$panel['id']} = $this->get_option_from_table("form_pagination_has_background", 'on', true, array('options_name'=>$panel['id']));
                $this->{'form_pagination_background_color'.$panel['id']} = $this->get_option_from_table("form_pagination_background_color", 'FFF', true, array('options_name'=>$panel['id']));
                $this->{'form_pagination_background_size'.$panel['id']} = $this->get_option_from_table("form_pagination_background_size", '30', true, array('options_name'=>$panel['id']));
                $this->{'form_pagination_font_color'.$panel['id']} = $this->get_option_from_table("form_pagination_font_color", '30', true, array('options_name'=>$panel['id']));

                $this->{'form_file_has_background'.$panel['id']} = $this->get_option_from_table("form_file_has_background", 'on', true, array('options_name'=>$panel['id']));
                $this->{'form_file_background'.$panel['id']} = $this->get_option_from_table("form_file_background", 'FFF', true, array('options_name'=>$panel['id']));
                $this->{'form_file_border_size'.$panel['id']} = $this->get_option_from_table("form_file_border_size", '1', true, array('options_name'=>$panel['id']));
                $this->{'form_file_border_radius'.$panel['id']} = $this->get_option_from_table("form_file_border_radius", '1', true, array('options_name'=>$panel['id']));
                $this->{'form_file_border_color'.$panel['id']} = $this->get_option_from_table("form_file_border_color", 'CCC', true, array('options_name'=>$panel['id']));
                $this->{'form_file_font_size'.$panel['id']} = $this->get_option_from_table("form_file_font_size", '16', true, array('options_name'=>$panel['id']));
                $this->{'form_file_font_color'.$panel['id']} = $this->get_option_from_table("form_file_font_color", '393939', true, array('options_name'=>$panel['id']));
                $this->{'form_file_button_text'.$panel['id']} = $this->get_option_from_table("form_file_button_text", 'Upload', true, array('options_name'=>$panel['id']));
                $this->{'form_file_button_background_color'.$panel['id']} = $this->get_option_from_table("form_file_button_background_color", 'F4F4F4', true, array('options_name'=>$panel['id']));
                $this->{'form_file_button_background_hover_color'.$panel['id']} = $this->get_option_from_table("form_file_button_background_hover_color", 'FFF', true, array('options_name'=>$panel['id']));
                $this->{'form_file_button_text_color'.$panel['id']} = $this->get_option_from_table("form_file_button_text_color", 'F4F4F4', true, array('options_name'=>$panel['id']));
                $this->{'form_file_button_text_hover_color'.$panel['id']} = $this->get_option_from_table("form_file_button_text_hover_color", 'FFF', true, array('options_name'=>$panel['id']));
                $this->{'form_file_has_icon'.$panel['id']} = $this->get_option_from_table("form_file_has_icon", 'on', true, array('options_name'=>$panel['id']));
                $this->{'form_file_icon_style'.$panel['id']} = $this->get_option_from_table("form_file_icon_style", 'hugeicons-paperclip', true, array('options_name'=>$panel['id']));
                $this->{'form_file_icon_position'.$panel['id']} = $this->get_option_from_table("form_file_icon_position", 'right', true, array('options_name'=>$panel['id']));
                $this->{'form_file_icon_color'.$panel['id']} = $this->get_option_from_table("form_file_icon_color", 'FFF', true, array('options_name'=>$panel['id']));
                $this->{'form_file_icon_hover_color'.$panel['id']} = $this->get_option_from_table("form_file_icon_hover_color", 'FFF', true, array('options_name'=>$panel['id']));

                $this->{'form_button_position'.$panel['id']} = $this->get_option_from_table("form_button_position", 'left', true, array('options_name'=>$panel['id']));
                $this->{'form_button_fullwidth'.$panel['id']} = $this->get_option_from_table("form_button_fullwidth", 'off', true, array('options_name'=>$panel['id']));
                $this->{'form_button_padding'.$panel['id']} = $this->get_option_from_table("form_button_padding", '8', true, array('options_name'=>$panel['id']));
                $this->{'form_button_font_size'.$panel['id']} = $this->get_option_from_table("form_button_font_size", '14', true, array('options_name'=>$panel['id']));
                $this->{'form_button_icons_position'.$panel['id']} = $this->get_option_from_table("form_button_icons_position", 'right', true, array('options_name'=>$panel['id']));
                $this->{'form_button_submit_has_icon'.$panel['id']} = $this->get_option_from_table("form_button_submit_has_icon", 'on', true, array('options_name'=>$panel['id']));
                $this->{'form_button_submit_icon_style'.$panel['id']} = $this->get_option_from_table("form_button_submit_icon_style", 'hugeicons-mail-forward', true, array('options_name'=>$panel['id']));
                $this->{'form_button_submit_icon_color'.$panel['id']} = $this->get_option_from_table("form_button_submit_icon_color", '999', true, array('options_name'=>$panel['id']));
                $this->{'form_button_submit_icon_hover_color'.$panel['id']} = $this->get_option_from_table("form_button_submit_icon_hover_color", '999', true, array('options_name'=>$panel['id']));
                $this->{'form_button_submit_font_color'.$panel['id']} = $this->get_option_from_table("form_button_submit_font_color", '999', true, array('options_name'=>$panel['id']));
                $this->{'form_button_submit_font_hover_color'.$panel['id']} = $this->get_option_from_table("form_button_submit_font_hover_color", '666', true, array('options_name'=>$panel['id']));
                $this->{'form_button_submit_background'.$panel['id']} = $this->get_option_from_table("form_button_submit_background", '5d5d5d', true, array('options_name'=>$panel['id']));
                $this->{'form_button_submit_hover_background'.$panel['id']} = $this->get_option_from_table("form_button_submit_hover_background", '5f5f5f', true, array('options_name'=>$panel['id']));
                $this->{'form_button_submit_border_size'.$panel['id']} = $this->get_option_from_table("form_button_submit_border_size", '1', true, array('options_name'=>$panel['id']));
                $this->{'form_button_submit_border_color'.$panel['id']} = $this->get_option_from_table("form_button_submit_border_color", 'ccc', true, array('options_name'=>$panel['id']));
                $this->{'form_button_submit_border_radius'.$panel['id']} = $this->get_option_from_table("form_button_submit_border_radius", '5', true, array('options_name'=>$panel['id']));
                $this->{'form_button_reset_has_icon'.$panel['id']} = $this->get_option_from_table("form_button_reset_has_icon", 'on', true, array('options_name'=>$panel['id']));
                $this->{'form_button_reset_icon_style'.$panel['id']} = $this->get_option_from_table("form_button_reset_icon_style", 'hugeicons-refresh', true, array('options_name'=>$panel['id']));
                $this->{'form_button_reset_icon_color'.$panel['id']} = $this->get_option_from_table("form_button_reset_icon_color", '999', true, array('options_name'=>$panel['id']));
                $this->{'form_button_reset_icon_color'.$panel['id']} = $this->get_option_from_table("form_button_reset_icon_color", '666', true, array('options_name'=>$panel['id']));
                $this->{'form_button_reset_font_color'.$panel['id']} = $this->get_option_from_table("form_button_reset_font_color", '999', true, array('options_name'=>$panel['id']));
                $this->{'form_button_reset_font_hover_color'.$panel['id']} = $this->get_option_from_table("form_button_reset_font_hover_color", '666', true, array('options_name'=>$panel['id']));
                $this->{'form_button_reset_background'.$panel['id']} = $this->get_option_from_table("form_button_reset_background", '5d5d5d', true, array('options_name'=>$panel['id']));
                $this->{'form_button_reset_hover_background'.$panel['id']} = $this->get_option_from_table("form_button_reset_hover_background", '5f5f5f', true, array('options_name'=>$panel['id']));
                $this->{'form_button_reset_border_size'.$panel['id']} = $this->get_option_from_table("form_button_reset_border_size", '1', true, array('options_name'=>$panel['id']));
                $this->{'form_button_reset_border_color'.$panel['id']} = $this->get_option_from_table("form_button_reset_border_color", 'ccc', true, array('options_name'=>$panel['id']));
                $this->{'form_button_reset_border_radius'.$panel['id']} = $this->get_option_from_table("form_button_reset_border_radius", '5', true, array('options_name'=>$panel['id']));

                $this->{'form_custom_css'.$panel['id']} = $this->get_option_from_table("form_custom_css", '/* Write Your Custom CSS Code Here */', true, array('options_name'=>$panel['id']));

            }

        }
    }

    private function controls_general_options()
    {
        $controlsArray = array();
        foreach($this->panels as $key=>$panel){
            if(isset($_GET['id']) && $panel['id']==$_GET['id']){
                /* form general controls */
                $controlsArray['form_wrapper_width'.$panel['id']] = array(
                    'section' => 'form_block_styles'.$panel['id'],
                    'type' => 'simple_slider',
                    'choices' => range(0, 100),
                    'default' => $this->{'form_wrapper_width'.$panel['id']},
                    'label' => __('Form Width', 'hugeit_contact'),
                    'help' => __('Select the width of the form by dragging the circle.', 'hugeit_contact')
                );
                $controlsArray['form_wrapper_background_type'.$panel['id']] = array(
                    'section' => 'form_block_styles'.$panel['id'],
                    'type' => 'select',
                    'choices' => array(
                        'color' => 'Color',
                        'transparent' => 'Transparent',
                        'gradient' => 'Gradient',
                    ),
                    'default' => $this->{'form_wrapper_background_type'.$panel['id']},
                    'label' => __('Form Background Type', 'hugeit_contact'),
                );
                $controlsArray['form_wrapper_background_color'.$panel['id']] = array(
                    'section' => 'form_block_styles'.$panel['id'],
                    'type' => 'color_complex',
                    'isGradient'=>($this->{'form_wrapper_background_type'.$panel['id']}=='gradient'),
                    'default' => $this->{'form_wrapper_background_color'.$panel['id']},
                    'label' => __('Form Background Color', 'hugeit_contact'),
                );
                $controlsArray['form_border_size'.$panel['id']] = array(
                    'section' => 'form_block_styles'.$panel['id'],
                    'type' => 'number',
                    'default' => $this->{'form_border_size'.$panel['id']},
                    'label' => __('Form Border Size (px)', 'hugeit_contact'),
                );
                $controlsArray['form_border_color'.$panel['id']] = array(
                    'section' => 'form_block_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_border_color'.$panel['id']},
                    'label' => __('Form Border Color', 'hugeit_contact'),
                );
                $controlsArray['form_show_title'.$panel['id']] = array(
                    'section' => 'form_block_styles'.$panel['id'],
                    'type' => 'checkbox',
                    'checked_val'=>'on',
                    'unchecked_val'=>'off',
                    'default' =>  $this->{'form_show_title'.$panel['id']},
                    'label' => __('Form Show Title', 'hugeit_contact'),
                );
                $controlsArray['form_title_size'.$panel['id']] = array(
                    'section' => 'form_block_styles'.$panel['id'],
                    'type' => 'number',
                    'default' =>  $this->{'form_title_size'.$panel['id']},
                    'label' => __('Form Title Size (px)', 'hugeit_contact'),
                    'help' => __('Select the font size of the form title.', 'hugeit_contact')
                );
                $controlsArray['form_title_color'.$panel['id']] = array(
                    'section' => 'form_block_styles'.$panel['id'],
                    'type' => 'color',
                    'default' =>  $this->{'form_title_color'.$panel['id']},
                    'label' => __('Form Title Color', 'hugeit_contact'),
                    'help' => __('Select the text color of the form title.', 'hugeit_contact')
                );

                /* label controls */
                $controlsArray['form_label_size'.$panel['id']] = array(
                    'section' => 'label_styles'.$panel['id'],
                    'type' => 'number',
                    'default' => $this->{'form_label_size'.$panel['id']},
                    'label' => __('Label Size', 'hugeit_contact'),
                    'help' => __('The label font size can be editted here.', 'hugeit_contact')
                );
                $controlsArray['form_label_font_family'.$panel['id']] = array(
                    'section' => 'label_styles'.$panel['id'],
                    'type' => 'select',
                    'choices'=> array(
                        '' => 'Default',
                        'Arial,Helvetica Neue,Helvetica,sans-serif' => 'Arial *',
                        'Arial Black,Arial Bold,Arial,sans-serif' => 'Arial Black *',
                        'Arial Nicon,Arial,Helvetica Neue,Helvetica,sans-serif' => 'Arial Nicon *',
                        'Courier,Verdana,sans-serif' => 'Courier *',
                        'Georgia,Times New Roman,Times,serif' => 'Georgia *',
                        'Times New Roman,Times,Georgia,serif' => 'Times New Roman *',
                        'Verdana,sans-serif' => 'Verdana *',
                        'American Typewriter,Georgia,serif' => 'American Typewriter',
                        'Bookman Old Style,Georgia,Times New Roman,Times,serif' => 'Bookman Old Style',
                        'Calibri,Helvetica Neue,Helvetica,Arial,Verdana,sans-serif' => 'Calibri',
                        'Cambria,Georgia,Times New Roman,Times,serif' => 'Cambria',
                        'Candara,Verdana,sans-serif' => 'Candara',
                        'Century Gothic,Apple Gothic,Verdana,sans-serif' => 'Century Gothic',
                        'Century Schoolbook,Georgia,Times New Roman,Times,serif' => 'Century Schoolbook',
                        'Consolas,Andale Mono,Monaco,Courier,Courier New,Verdana,sans-serif' => 'Consolas',
                        'Constantia,Georgia,Times New Roman,Times,serif' => 'Constantia',
                        'Corbel,Lucida Grande,Lucida Sans Unicode,Arial,sans-serif' => 'Corbel',
                        'Tahoma,Geneva,Verdana,sans-serif' => 'Tahoma',
                        'Rockwell, Arial Black, Arial Bold, Arial, sans-serif' => 'Rockwell',
                    ),
                    'default' => $this->{'form_label_font_family'.$panel['id']},
                    'label' => __('Label Font Family', 'hugeit_contact'),
                );
                $controlsArray['form_label_color'.$panel['id']] = array(
                    'section' => 'label_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_label_color'.$panel['id']},
                    'label' => __('Label Color', 'hugeit_contact'),
                    'help' => __('The label text color.', 'hugeit_contact')
                );
                $controlsArray['form_label_error_color'.$panel['id']] = array(
                    'section' => 'label_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_label_error_color'.$panel['id']},
                    'label' => __('Error Text Color', 'hugeit_contact'),
                    'help' => __('The error text color.', 'hugeit_contact')
                );
                $controlsArray['form_label_required_color'.$panel['id']] = array(
                    'section' => 'label_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_label_required_color'.$panel['id']},
                    'label' => __('Asterix(*) Color', 'hugeit_contact'),
                    'help' => __('The error text * color.', 'hugeit_contact')
                );
                $controlsArray['form_label_success_message'.$panel['id']] = array(
                    'section' => 'label_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_label_success_message'.$panel['id']},
                    'label' => __('Success Message Color', 'hugeit_contact'),
                    'help' => __('Success Message is displayed below the form after successful submission.', 'hugeit_contact')
                );

                /* textarea controls */
                $controlsArray['form_textarea_has_background'.$panel['id']] = array(
                    'section' => 'textarea_styles'.$panel['id'],
                    'type' => 'checkbox',
                    'checked_val'=>'on',
                    'unchecked_val'=>'off',
                    'default' => $this->{'form_textarea_has_background'.$panel['id']},
                    'label' => __('Textarea has background', 'hugeit_contact'),
                    'help' => __('Whether textarea should have color background or transparent.', 'hugeit_contact')
                );
                $controlsArray['form_textarea_background_color'.$panel['id']] = array(
                    'section' => 'textarea_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_textarea_background_color'.$panel['id']},
                    'label' => __('Textarea Background Color', 'hugeit_contact'),
                );
                $controlsArray['form_textarea_border_size'.$panel['id']] = array(
                    'section' => 'textarea_styles'.$panel['id'],
                    'type' => 'number',
                    'default' => $this->{'form_textarea_border_size'.$panel['id']},
                    'label' => __('Textarea Border Width (px)', 'hugeit_contact'),
                );
                $controlsArray['form_textarea_border_radius'.$panel['id']] = array(
                    'section' => 'textarea_styles'.$panel['id'],
                    'type' => 'number',
                    'default' => $this->{'form_textarea_border_radius'.$panel['id']},
                    'label' => __('Textarea Border Radius (px)', 'hugeit_contact'),
                );
                $controlsArray['form_textarea_border_color'.$panel['id']] = array(
                    'section' => 'textarea_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_textarea_border_color'.$panel['id']},
                    'label' => __('Textarea Border Color', 'hugeit_contact'),
                );
                $controlsArray['form_textarea_font_size'.$panel['id']] = array(
                    'section' => 'textarea_styles'.$panel['id'],
                    'type' => 'number',
                    'default' => $this->{'form_textarea_font_size'.$panel['id']},
                    'label' => __('Textarea Font Size (px)', 'hugeit_contact'),
                    'help' => __('Text size of textarea font.', 'hugeit_contact')
                );
                $controlsArray['form_textarea_font_color'.$panel['id']] = array(
                    'section' => 'textarea_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_textarea_font_color'.$panel['id']},
                    'label' => __('Textarea Font Color', 'hugeit_contact'),
                );

                /* input text controls */
                $controlsArray['form_input_text_has_background'.$panel['id']] = array(
                    'section' => 'text_input_styles'.$panel['id'],
                    'type' => 'checkbox',
                    'checked_val'=>'on',
                    'unchecked_val'=>'off',
                    'default' => $this->{'form_input_text_has_background'.$panel['id']},
                    'label' => __('Text Input Has background', 'hugeit_contact'),
                    'help' => __('Whether text input should have color background or transparent.', 'hugeit_contact')
                );
                $controlsArray['form_input_text_background_color'.$panel['id']] = array(
                    'section' => 'text_input_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_input_text_background_color'.$panel['id']},
                    'label' => __('Text Input Background Color', 'hugeit_contact'),
                );
                $controlsArray['form_input_text_border_size'.$panel['id']] = array(
                    'section' => 'text_input_styles'.$panel['id'],
                    'type' => 'number',
                    'default' => $this->{'form_input_text_border_size'.$panel['id']},
                    'label' => __('Text Input Border Width (px)', 'hugeit_contact'),
                );
                $controlsArray['form_input_text_border_radius'.$panel['id']] = array(
                    'section' => 'text_input_styles'.$panel['id'],
                    'type' => 'number',
                    'default' => $this->{'form_input_text_border_radius'.$panel['id']},
                    'label' => __('Text Input Border Radius (px)', 'hugeit_contact'),
                );
                $controlsArray['form_input_text_border_color'.$panel['id']] = array(
                    'section' => 'text_input_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_input_text_border_color'.$panel['id']},
                    'label' => __('Text Input Border Color', 'hugeit_contact'),
                );
                $controlsArray['form_input_text_font_size'.$panel['id']] = array(
                    'section' => 'text_input_styles'.$panel['id'],
                    'type' => 'number',
                    'default' => $this->{'form_input_text_font_size'.$panel['id']},
                    'label' => __('Text Input Font Size (px)', 'hugeit_contact'),
                    'help' => __('Text size of text input field.', 'hugeit_contact')
                );
                $controlsArray['form_input_text_font_color'.$panel['id']] = array(
                    'section' => 'text_input_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_input_text_font_color'.$panel['id']},
                    'label' => __('Text Input Font Color', 'hugeit_contact'),
                );

                /* checkbox controls */
                $controlsArray['form_checkbox_size'.$panel['id']] = array(
                    'section' => 'checkbox_styles'.$panel['id'],
                    'type' => 'select',
                    'choices'=> array(
                        'big'=>'Big',
                        'medium'=>'Medium',
                        'small'=>'Small',
                    ),
                    'default' => $this->{'form_checkbox_size'.$panel['id']},
                    'label' => __('Checkbox Size', 'hugeit_contact'),
                );
                $controlsArray['form_checkbox_type'.$panel['id']] = array(
                    'section' => 'checkbox_styles'.$panel['id'],
                    'type' => 'select',
                    'choices'=> array(
                        'circle'=>'Circle',
                        'square'=>'Square',
                    ),
                    'default' => $this->{'form_checkbox_type'.$panel['id']},
                    'label' => __('Checkbox Type', 'hugeit_contact'),
                );
                $controlsArray['form_checkbox_color'.$panel['id']] = array(
                    'section' => 'checkbox_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_checkbox_color'.$panel['id']},
                    'label' => __('Checkbox Border Color', 'hugeit_contact'),
                );
                $controlsArray['form_checkbox_hover_color'.$panel['id']] = array(
                    'section' => 'checkbox_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_checkbox_hover_color'.$panel['id']},
                    'label' => __('Checkbox Hover Border Color', 'hugeit_contact'),
                );
                $controlsArray['form_checkbox_active_color'.$panel['id']] = array(
                    'section' => 'checkbox_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_checkbox_active_color'.$panel['id']},
                    'label' => __('Checkbox Checked Border Color', 'hugeit_contact'),
                );

                /* selectbox controls */
                $controlsArray['form_selectbox_has_background'.$panel['id']] = array(
                    'section' => 'selectbox_styles'.$panel['id'],
                    'type' => 'checkbox',
                    'checked_val'=>'on',
                    'unchecked_val'=>'off',
                    'default' => $this->{'form_selectbox_has_background'.$panel['id']},
                    'label' => __('Selectbox Has background', 'hugeit_contact'),
                    'help' => __('Whether selectbox should have color background or transparent.', 'hugeit_contact')
                );
                $controlsArray['form_selectbox_background_color'.$panel['id']] = array(
                    'section' => 'selectbox_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_selectbox_background_color'.$panel['id']},
                    'label' => __('Selectbox Background Color', 'hugeit_contact'),
                );
                $controlsArray['form_selectbox_border_size'.$panel['id']] = array(
                    'section' => 'selectbox_styles'.$panel['id'],
                    'type' => 'number',
                    'default' => $this->{'form_selectbox_border_size'.$panel['id']},
                    'label' => __('Selectbox Border Width (px)', 'hugeit_contact'),
                );
                $controlsArray['form_selectbox_border_radius'.$panel['id']] = array(
                    'section' => 'selectbox_styles'.$panel['id'],
                    'type' => 'number',
                    'default' => $this->{'form_selectbox_border_radius'.$panel['id']},
                    'label' => __('Selectbox Border Radius (px)', 'hugeit_contact'),
                );
                $controlsArray['form_selectbox_border_color'.$panel['id']] = array(
                    'section' => 'selectbox_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_selectbox_border_color'.$panel['id']},
                    'label' => __('Selectbox Border Color', 'hugeit_contact'),
                );
                $controlsArray['form_selectbox_font_size'.$panel['id']] = array(
                    'section' => 'selectbox_styles'.$panel['id'],
                    'type' => 'number',
                    'default' => $this->{'form_selectbox_font_size'.$panel['id']},
                    'label' => __('Selectbox Font Size (px)', 'hugeit_contact'),
                    'help' => __('Text size of selectbox.', 'hugeit_contact')
                );
                $controlsArray['form_selectbox_arrow_color'.$panel['id']] = array(
                    'section' => 'selectbox_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_selectbox_arrow_color'.$panel['id']},
                    'label' => __('Selectbox Font Color', 'hugeit_contact'),
                );

                /* radio controls */
                $controlsArray['form_radio_size'.$panel['id']] = array(
                    'section' => 'radio_styles'.$panel['id'],
                    'type' => 'select',
                    'choices'=> array(
                        'big'=>'Big',
                        'medium'=>'Medium',
                        'small'=>'Small',
                    ),
                    'default' => $this->{'form_radio_size'.$panel['id']},
                    'label' => __('Radio Size', 'hugeit_contact'),
                );
                $controlsArray['form_radio_type'.$panel['id']] = array(
                    'section' => 'radio_styles'.$panel['id'],
                    'type' => 'select',
                    'choices'=> array(
                        'circle'=>'Circle',
                        'square'=>'Square',
                    ),
                    'default' => $this->{'form_radio_type'.$panel['id']},
                    'label' => __('Radio Type', 'hugeit_contact'),
                );
                $controlsArray['form_radio_color'.$panel['id']] = array(
                    'section' => 'radio_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_radio_color'.$panel['id']},
                    'label' => __('Radio Border Color', 'hugeit_contact'),
                );
                $controlsArray['form_radio_hover_color'.$panel['id']] = array(
                    'section' => 'radio_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_radio_hover_color'.$panel['id']},
                    'label' => __('Radio Hover Border Color', 'hugeit_contact'),
                );
                $controlsArray['form_radio_active_color'.$panel['id']] = array(
                    'section' => 'radio_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_radio_active_color'.$panel['id']},
                    'label' => __('Radio Checked Border Color', 'hugeit_contact'),
                );

                /* pagination controls */
                $controlsArray['form_pagination_has_background'.$panel['id']] = array(
                    'section' => 'pagination_styles'.$panel['id'],
                    'type' => 'checkbox',
                    'checked_val'=>'on',
                    'unchecked_val'=>'off',
                    'default' => $this->{'form_pagination_has_background'.$panel['id']},
                    'label' => __('Pagination Has background', 'hugeit_contact'),
                    'help' => __('Whether pagination should have color background or transparent.', 'hugeit_contact')
                );
                $controlsArray['form_pagination_background_color'.$panel['id']] = array(
                    'section' => 'pagination_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_pagination_background_color'.$panel['id']},
                    'label' => __('Pagination Background Color', 'hugeit_contact'),
                );
                $controlsArray['form_pagination_background_size'.$panel['id']] = array(
                    'section' => 'pagination_styles'.$panel['id'],
                    'type' => 'number',
                    'default' => $this->{'form_pagination_background_size'.$panel['id']},
                    'label' => __('Pagination Background Size (px)', 'hugeit_contact'),
                );
                $controlsArray['form_pagination_font_color'.$panel['id']] = array(
                    'section' => 'pagination_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_pagination_font_color'.$panel['id']},
                    'label' => __('Pagination Font Color', 'hugeit_contact'),
                );

                /* file uploader controls */
                $controlsArray['form_file_has_background'.$panel['id']] = array(
                    'section' => 'file_upload_styles'.$panel['id'],
                    'type' => 'checkbox',
                    'checked_val'=>'on',
                    'unchecked_val'=>'off',
                    'default' => $this->{'form_file_has_background'.$panel['id']},
                    'label' => __('FileBox Has background', 'hugeit_contact'),
                    'help' => __('Whether FileBox should have color background or transparent.', 'hugeit_contact')
                );
                $controlsArray['form_file_background'.$panel['id']] = array(
                    'section' => 'file_upload_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_file_background'.$panel['id']},
                    'label' => __('FileBox Background Color', 'hugeit_contact'),
                );
                $controlsArray['form_file_border_size'.$panel['id']] = array(
                    'section' => 'file_upload_styles'.$panel['id'],
                    'type' => 'number',
                    'default' => $this->{'form_file_border_size'.$panel['id']},
                    'label' => __('FileBox Border Size (px)', 'hugeit_contact'),
                );
                $controlsArray['form_file_border_radius'.$panel['id']] = array(
                    'section' => 'file_upload_styles'.$panel['id'],
                    'type' => 'number',
                    'default' => $this->{'form_file_border_radius'.$panel['id']},
                    'label' => __('FileBox Border Radius (px)', 'hugeit_contact'),
                );
                $controlsArray['form_file_border_color'.$panel['id']] = array(
                    'section' => 'file_upload_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_file_border_color'.$panel['id']},
                    'label' => __('FileBox Border Color', 'hugeit_contact'),
                );
                $controlsArray['form_file_font_size'.$panel['id']] = array(
                    'section' => 'file_upload_styles'.$panel['id'],
                    'type' => 'number',
                    'default' => $this->{'form_file_font_size'.$panel['id']},
                    'label' => __('FileBox Font Size (px)', 'hugeit_contact'),
                );
                $controlsArray['form_file_font_color'.$panel['id']] = array(
                    'section' => 'file_upload_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_file_font_color'.$panel['id']},
                    'label' => __('FileBox Font Color', 'hugeit_contact'),
                );
                $controlsArray['form_file_button_text'.$panel['id']] = array(
                    'section' => 'file_upload_styles'.$panel['id'],
                    'type' => 'text',
                    'default' => $this->{'form_file_button_text'.$panel['id']},
                    'label' => __('Upload Button Text', 'hugeit_contact'),
                );
                $controlsArray['form_file_button_background_color'.$panel['id']] = array(
                    'section' => 'file_upload_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_file_button_background_color'.$panel['id']},
                    'label' => __('Button Background Color', 'hugeit_contact'),
                );
                $controlsArray['form_file_button_background_hover_color'.$panel['id']] = array(
                    'section' => 'file_upload_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_file_button_background_hover_color'.$panel['id']},
                    'label' => __('Button Hover Background Color', 'hugeit_contact'),
                );
                $controlsArray['form_file_button_text_color'.$panel['id']] = array(
                    'section' => 'file_upload_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_file_button_text_color'.$panel['id']},
                    'label' => __('Upload Button Text Color', 'hugeit_contact'),
                );
                $controlsArray['form_file_button_text_hover_color'.$panel['id']] = array(
                    'section' => 'file_upload_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_file_button_text_hover_color'.$panel['id']},
                    'label' => __('Upload Button Hover Text Color', 'hugeit_contact'),
                );
                $controlsArray['form_file_has_icon'.$panel['id']] = array(
                    'section' => 'file_upload_styles'.$panel['id'],
                    'type' => 'checkbox',
                    'checked_val'=>'on',
                    'unchecked_val'=>'off',
                    'default' => $this->{'form_file_has_icon'.$panel['id']},
                    'label' => __('Upload Button Has Icon', 'hugeit_contact'),
                );
                $controlsArray['form_file_icon_style'.$panel['id']] = array(
                    'section' => 'file_upload_styles'.$panel['id'],
                    'type' => 'icon_radio',
                    'width' => 30,
                    'height' => 30,
                    'choices' => array(
                        "hugeicons-paperclip",
                        "hugeicons-camera",
                        "hugeicons-picture-o",
                        "hugeicons-file",
                        "hugeicons-dropbox",
                        "hugeicons-cloud",
                        "hugeicons-cloud-upload",
                        "hugeicons-download",
                        "hugeicons-cloud-download",
                        "hugeicons-file-pdf-o",
                        "hugeicons-file-text",
                        "hugeicons-file-excel-o",
                        "hugeicons-file-powerpoint-o",
                        "hugeicons-file-zip-o",
                        "hugeicons-file-audio-o",
                        "hugeicons-floppy-o",
                        "hugeicons-music",
                        "hugeicons-film",
                        "hugeicons-camera-retro",
                        "hugeicons-gift"
                    ),
                    'default' => $this->{'form_file_icon_style'.$panel['id']},
                    'label' => __('Upload Button Icon', 'hugeit_contact'),
                );
                $controlsArray['form_file_icon_position'.$panel['id']] = array(
                    'section' => 'file_upload_styles'.$panel['id'],
                    'type' => 'select',
                    'choices'=>array(
                        'left'=>'Before Text',
                        'right'=>'After Text',
                    ),
                    'default' => $this->{'form_file_icon_position'.$panel['id']},
                    'label' => __('Button\'s Icon Position', 'hugeit_contact'),
                );
                $controlsArray['form_file_icon_color'.$panel['id']] = array(
                    'section' => 'file_upload_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_file_icon_color'.$panel['id']},
                    'label' => __('FileBox Icon Color', 'hugeit_contact'),
                );
                $controlsArray['form_file_icon_hover_color'.$panel['id']] = array(
                    'section' => 'file_upload_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_file_icon_hover_color'.$panel['id']},
                    'label' => __('FileBox Icon Hover Color', 'hugeit_contact'),
                );


                /* bottons controls */
                $controlsArray['form_button_position'.$panel['id']] = array(
                    'section' => 'button_styles'.$panel['id'],
                    'type' => 'select',
                    'choices'=>array(
                        'left'=>'Left',
                        'right'=>'Right',
                        'center'=>'Center',
                    ),
                    'default' => $this->{'form_button_position'.$panel['id']},
                    'label' => __('Submit/Reset Buttons Alignment', 'hugeit_contact'),
                );
                $controlsArray['form_button_fullwidth'.$panel['id']] = array(
                    'section' => 'button_styles'.$panel['id'],
                    'type' => 'checkbox',
                    'checked_val'=>'on',
                    'unchecked_val'=>'off',
                    'default' => $this->{'form_button_fullwidth'.$panel['id']},
                    'label' => __('Make Buttons Fullwidth', 'hugeit_contact'),
                );
                $controlsArray['form_button_padding'.$panel['id']] = array(
                    'section' => 'button_styles'.$panel['id'],
                    'type' => 'number',
                    'default' => $this->{'form_button_padding'.$panel['id']},
                    'label' => __('Padding (px)', 'hugeit_contact'),
                );
                $controlsArray['form_button_font_size'.$panel['id']] = array(
                    'section' => 'button_styles'.$panel['id'],
                    'type' => 'number',
                    'default' => $this->{'form_button_font_size'.$panel['id']},
                    'label' => __('Font Size (px)', 'hugeit_contact'),
                );
                $controlsArray['form_button_icons_position'.$panel['id']] = array(
                    'section' => 'button_styles'.$panel['id'],
                    'type' => 'select',
                    'choices'=>array(
                        'left'=>'Before Text',
                        'right'=>'After Text',
                    ),
                    'default' => $this->{'form_button_icons_position'.$panel['id']},
                    'label' => __('Icons Position', 'hugeit_contact'),
                );
                $controlsArray['form_button_submit_has_icon'.$panel['id']] = array(
                    'section' => 'button_styles'.$panel['id'],
                    'type' => 'checkbox',
                    'checked_val'=>'on',
                    'unchecked_val'=>'off',
                    'default' => $this->{'form_button_submit_has_icon'.$panel['id']},
                    'label' => __('Submit Button Has Icon', 'hugeit_contact'),
                );
                $controlsArray['form_button_submit_icon_style'.$panel['id']] = array(
                    'section' => 'button_styles'.$panel['id'],
                    'type' => 'icon_radio',
                    'choices'=>array(
                        "hugeicons-mail-forward",
                        "hugeicons-mail-reply",
                        "hugeicons-clock",
                        "hugeicons-bell",
                        "hugeicons-paper-plane",
                        "hugeicons-sign-in",
                        "hugeicons-bars",
                        "hugeicons-child",
                        "hugeicons-gift",
                        "hugeicons-rocket",
                        "hugeicons-fire",
                        "hugeicons-anchor",
                        "hugeicons-plus",
                        "hugeicons-envelope-o",
                        "hugeicons-envelope",
                        "hugeicons-cart-plus"
                    ),
                    'default' => $this->{'form_button_submit_icon_style'.$panel['id']},
                    'label' => __('Submit Button Icon Image', 'hugeit_contact'),
                );
                $controlsArray['form_button_submit_icon_color'.$panel['id']] = array(
                    'section' => 'button_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_button_submit_icon_color'.$panel['id']},
                    'label' => __('Submit Button Icon Color', 'hugeit_contact'),
                );
                $controlsArray['form_button_submit_icon_hover_color'.$panel['id']] = array(
                    'section' => 'button_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_button_submit_icon_hover_color'.$panel['id']},
                    'label' => __('Submit Button Hover Icon Color', 'hugeit_contact'),
                );
                $controlsArray['form_button_submit_font_color'.$panel['id']] = array(
                    'section' => 'button_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_button_submit_font_color'.$panel['id']},
                    'label' => __('Submit Button Font Color', 'hugeit_contact'),
                );
                $controlsArray['form_button_submit_font_hover_color'.$panel['id']] = array(
                    'section' => 'button_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_button_submit_font_hover_color'.$panel['id']},
                    'label' => __('Submit Button Hover Font Color', 'hugeit_contact'),
                );
                $controlsArray['form_button_submit_background'.$panel['id']] = array(
                    'section' => 'button_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_button_submit_background'.$panel['id']},
                    'label' => __('Submit Button Background Color', 'hugeit_contact'),
                );
                $controlsArray['form_button_submit_hover_background'.$panel['id']] = array(
                    'section' => 'button_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_button_submit_hover_background'.$panel['id']},
                    'label' => __('Submit Button Hover Background Color', 'hugeit_contact'),
                );
                $controlsArray['form_button_submit_border_size'.$panel['id']] = array(
                    'section' => 'button_styles'.$panel['id'],
                    'type' => 'number',
                    'default' => $this->{'form_button_submit_border_size'.$panel['id']},
                    'label' => __('Submit Button Border Size (px)', 'hugeit_contact'),
                );
                $controlsArray['form_button_submit_border_color'.$panel['id']] = array(
                    'section' => 'button_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_button_submit_border_color'.$panel['id']},
                    'label' => __('Submit Button Border Color', 'hugeit_contact'),
                );
                $controlsArray['form_button_submit_border_radius'.$panel['id']] = array(
                    'section' => 'button_styles'.$panel['id'],
                    'type' => 'number',
                    'default' => $this->{'form_button_submit_border_radius'.$panel['id']},
                    'label' => __('Submit Button Border Radius (px)', 'hugeit_contact'),
                );
                $controlsArray['form_button_reset_has_icon'.$panel['id']] = array(
                    'section' => 'button_styles'.$panel['id'],
                    'type' => 'checkbox',
                    'checked_val'=>'on',
                    'unchecked_val'=>'off',
                    'default' => $this->{'form_button_reset_has_icon'.$panel['id']},
                    'label' => __('Reset Button Has Icon', 'hugeit_contact'),
                );
                $controlsArray['form_button_reset_icon_style'.$panel['id']] = array(
                    'section' => 'button_styles'.$panel['id'],
                    'type' => 'icon_radio',
                    'choices'=>array(
                        "hugeicons-refresh",
                        "hugeicons-power-off",
                        "hugeicons-minus-circle",
                        "hugeicons-times",
                        "hugeicons-bell-slash",
                        "hugeicons-trash-o",
                        "hugeicons-user-times",
                        "hugeicons-street-view",
                        "hugeicons-times-circle-o",
                        "hugeicons-reply",
                        "hugeicons-fire",
                        "hugeicons-retweet"
                    ),
                    'default' => $this->{'form_button_reset_icon_style'.$panel['id']},
                    'label' => __('Reset Button Icon Image', 'hugeit_contact'),
                );
                $controlsArray['form_button_reset_icon_color'.$panel['id']] = array(
                    'section' => 'button_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_button_reset_icon_color'.$panel['id']},
                    'label' => __('Reset Button Icon Color', 'hugeit_contact'),
                );
                $controlsArray['form_button_reset_icon_hover_color'.$panel['id']] = array(
                    'section' => 'button_styles'.$panel['id'],
                    'type' => 'color',
                    'default' =>  $this->{'form_button_reset_icon_hover_color'.$panel['id']},
                    'label' => __('Reset Button Hover Icon Color', 'hugeit_contact'),
                );
                $controlsArray['form_button_reset_font_color'.$panel['id']] = array(
                    'section' => 'button_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_button_reset_font_color'.$panel['id']},
                    'label' => __('Reset Button Font Color', 'hugeit_contact'),
                );
                $controlsArray['form_button_reset_font_hover_color'.$panel['id']] = array(
                    'section' => 'button_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_button_reset_font_hover_color'.$panel['id']},
                    'label' => __('Reset Button Hover Font Color', 'hugeit_contact'),
                );
                $controlsArray['form_button_reset_background'.$panel['id']] = array(
                    'section' => 'button_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_button_reset_background'.$panel['id']},
                    'label' => __('Reset Button Background Color', 'hugeit_contact'),
                );
                $controlsArray['form_button_reset_hover_background'.$panel['id']] = array(
                    'section' => 'button_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_button_reset_hover_background'.$panel['id']},
                    'label' => __('Reset Button Hover Background Color', 'hugeit_contact'),
                );
                $controlsArray['form_button_reset_border_size'.$panel['id']] = array(
                    'section' => 'button_styles'.$panel['id'],
                    'type' => 'number',
                    'default' => $this->{'form_button_reset_border_size'.$panel['id']},
                    'label' => __('Reset Button Border Size (px)', 'hugeit_contact'),
                );
                $controlsArray['form_button_reset_border_color'.$panel['id']] = array(
                    'section' => 'button_styles'.$panel['id'],
                    'type' => 'color',
                    'default' => $this->{'form_button_reset_border_color'.$panel['id']},
                    'label' => __('Reset Button Border Color', 'hugeit_contact'),
                );
                $controlsArray['form_button_reset_border_radius'.$panel['id']] = array(
                    'section' => 'button_styles'.$panel['id'],
                    'type' => 'number',
                    'default' => $this->{'form_button_reset_border_radius'.$panel['id']},
                    'label' => __('Reset Button Border Radius (px)', 'hugeit_contact'),
                );

                /* custom controls */
                $controlsArray['form_custom_css'.$panel['id']] = array(
                    'section' => 'custom_styles'.$panel['id'],
                    'type' => 'textarea',
                    'default' => $this->{'form_custom_css'.$panel['id']},
                    'label' => __('', 'form_custom_css'),
                );
            }
        }
        return $controlsArray;
    }




    /**
     * @param $id
     * @param $control
     */
    protected function control_editor( $id, $control ) {
        $default = ( isset( $control['default'] ) ? $control['default'] : "" );

        $html_class = isset( $control['html_class'] ) ? $control['html_class'] : array();

        if ( is_string( $html_class ) ) {
            explode( ' ', $html_class );
        }
        $html_class_str  = implode( ' ', $html_class );
        $label_str       = ( isset( $control['label'] ) ? '<label for="'.$id.'" > ' . $control['label'] : '' );
        $label_str      .= isset( $control['help'] ) ? '<div class="wpdev_settings_help">&#63;<div class="wpdev_settings_help_block"><span class="pnt"></span><p>'. $control['help'] .'</p></div></div></label>' : '</label>';
        $description     = isset( $control['description'] ) ? $control['description'] : "";
        $description_str = $description != "" ? '<p class="description">' . $description . '</p>' : '';

        $attrs = array();
        if ( isset( $control['attrs'] ) && ! empty( $control['attrs'] ) ) {
            foreach ( $control['attrs'] as $k => $attr ) {
                $attrs[] = $k . '=' . $attr;
            }
        }

        $editorId   = ( isset( $control['editorId'] )) ? $control['editorId'] : '';
        $editorName   = ( isset( $control['editorId'] )) ? $control['editorName'] : '';

        echo $label_str;
        ?>

        <?php wp_editor( html_entity_decode(stripslashes($default)), $editorId , array('textarea_name'=>'wpdev_options['.$editorName.']')); ?>
        <?php
        echo $description_str;
    }


    /**
     * @param $key
     * @param bool $default
     * @param bool $concat
     *
     * @return mixed|void
     */
    public function get_option_from_table( $key, $default = false, $concat = true , $where = array() ) {
        global $wpdb;
        $query = 'SELECT `value` FROM '.$wpdb->prefix.$this->tablename.' WHERE `name`="'.$key.'"';

        if(!empty($where)) {
            foreach ($where as $key=>$value){
                $query .= ' AND `'.$key.'`='.$value;
            }
        }
        $value = $wpdb->get_var( $query );

        if(!$value) $value = $default;

        return $value;
    }

    /**
     * @param $key
     * @param $value
     *
     */
    public function update_option_in_table( $key, $value ) {
        global $wpdb;
        $theme_id = intval(preg_replace('/[^0-9]+/', '', $key), 10);
        $key = preg_replace('/[0-9]+/', '', $key);
        $wpdb->update( $wpdb->prefix.$this->tablename,
            array(
                'value'=>$value
            ),
            array(
                'name'=>$key,
                'options_name'=>$theme_id
            )
        );
    }

    /**
     * Initialize admin and display the page
     */
    public function init_admin() {
        if(isset($_GET['task']) && $_GET['task']=='edit_theme'){
            echo $this->display( true );
        } else if(isset($_GET['task']) && $_GET['task']=='delete_theme'){

        } else if(isset($_GET['task']) && $_GET['task']=='add_theme'){

        } else {
            global $wpdb;
            $themes = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'huge_it_contact_styles');
            echo $this->display_themes_page($themes);
        }
    }

    /**
     * The Panels navigation
     */
    public function print_navigation() {
        echo '<div id="' . $this->id . '_navigation" class="wpdev_settings_section_navigation">';
        foreach ( $this->panels as $panel_id => $panel ) {
            echo '<span data-id="'.$panel['id'].'" rel="' . $panel_id . '"  class="active">' . $panel['title'] . '</span>';
        }
        echo '</div>';
    }


    public function update_theme_title(){
        $theme_id = absint($_REQUEST['id']);
        $theme_title = esc_html($_REQUEST['title']);

        if($theme_id && $theme_title){
            global $wpdb;
            $result = $wpdb->update($wpdb->prefix.'huge_it_contact_styles',array('name'=>$theme_title),array('id'=>$theme_id));
            if(!$result) return json_encode(array('error'=>$wpdb->last_error));
        }
    }

    public function display_themes_page($themes){
        ob_start();?>
        <div class="wrap">
            <div id="poststuff">
                <?php do_action('wpdev_settings_'.$this->plugin_id.'_header');?>

                <div id="hugeit_contacts-list-page">
                    <form method="post"  onkeypress="doNothing()" action="admin.php?page=hugeit_forms_main_page" id="admin_form" name="admin_form">
                        <h2>
                            <?php _e('Huge IT Forms Themes', 'hugeit_contact'); ?>
                            <a onclick="alert('This option is disabled for free version. Please upgrade to pro license to be able to use it.');	" class="add-new-h2" >
                                <?php _e('Add New Theme','hugeit_contact');?>
                            </a>
                        </h2>
                        <?php if ( isset( $_POST['serch_or_not'] ) ) { $serch_value = $_POST['serch_or_not'] == "search" ? esc_html( stripslashes( $_POST['search_events_by_title'] ) ) : "";}
                        $serch_fields='<div class="alignleft actions"">				
                    <div class="alignleft actions">
                        <input type="button" value="Search" onclick="document.getElementById(\'page_number\').value=\'1\'; document.getElementById(\'serch_or_not\').value=\'search\';
                         document.getElementById(\'admin_form\').submit();" class="button-secondary action">
                         <input type="button" value="Reset" onclick="window.location.href=\'admin.php?page=hugeit_forms_main_page\'" class="button-secondary action">
                    </div>';
                        ?>
                        <table class="wp-list-table widefat fixed pages">
                            <thead>
                            <tr>
                                <th scope="col" id="id" style="width:30px" ><span><?php _e('ID', 'hugeit_contact'); ?></span><span class="sorting-indicator"></span></th>
                                <th scope="col" id="name" style="width:85px" ><span><?php _e('Name', 'hugeit_contact'); ?></span><span class="sorting-indicator"></span></th>
                                <th scope="col" id="prod_count"  style="width:75px;" ><span><?php _e('Last Update', 'hugeit_contact'); ?></span><span class="sorting-indicator"></span></th>
                                <th style="width:40px"><?php _e('Delete', 'hugeit_contact'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($themes as $theme):?>
                                <tr>
                                    <td ><span><?php echo $theme->id;?></span></td>
                                    <td ><span><a href="admin.php?page=hugeit_forms_theme_options&task=edit_theme&id=<?php echo intval($theme->id);?>"><?php echo $theme->name;?></span></a></td>
                                    <td ><span><?php echo $theme->last_update;?></span></td>
                                    <td ><a  onclick="alert('This option is disabled for free version. Please upgrade to pro license to be able to use it.');	" > <i style="font-size: 18px; margin-left: 14px" class="hugeicons-trash"></i> </a></td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                        <input type="hidden" name="oreder_move" id="oreder_move" value="" />
                        <input type="hidden" name="asc_or_desc" id="asc_or_desc" value="<?php if(isset($_POST['asc_or_desc'])) echo esc_attr($_POST['asc_or_desc']);?>"  />
                        <input type="hidden" name="order_by" id="order_by" value="<?php if(isset($_POST['order_by'])) echo esc_attr($_POST['order_by']);?>"  />
                        <input type="hidden" name="saveorder" id="saveorder" value="" />
                    </form>
                </div>
            </div>
        </div>
        <?php return ob_get_clean();
    }

    protected function control_icon_radio( $id, $control ){
        $default = ( isset( $control['default'] ) ? $control['default'] : "" );

        $label_str       = ( isset( $control['label'] ) ? '<span class="control-title" > ' . $control['label'] : '' );
        $label_str      .= isset( $control['help'] ) ? '<div class="wpdev_settings_help">&#63;<div class="wpdev_settings_help_block"><span class="pnt"></span><p>'. $control['help'] .'</p></div></div></span>' : '</span>';

        echo $label_str;
        ?>
        <div class="icon-radio-block">
            <?php
            if( isset( $control['choices'] ) && !empty( $control['choices'] ) ){
                ?>
                <ul>
                    <?php
                    foreach( $control['choices'] as $key=>$choice ){
                        ?>
                        <li>
                            <input type="radio" value="<?php echo $choice ?>" <?php checked($default, $choice); ?> id="<?php echo $id.'-'.$key; ?>" name="wpdev_options[<?php echo $id; ?>]"  />
                            <label for="<?php echo $id.'-'.$key; ?>"><i class="<?php echo $choice;?>"></i> </label>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <?php
            }
            ?>
        </div>
        <?php
    }


    protected function control_color_complex( $id, $control ){
        $default = ( isset( $control['default'] ) ? $control['default'] : "" );

        $placeholder = isset( $control['placeholder'] ) ? 'placeholder="'.$control['placeholder'].'"' : '';

        $html_class = isset( $control['html_class'] ) ? $control['html_class'] : array();

        if ( is_string( $html_class ) ) {
            explode( ' ', $html_class );
        }
        $html_class_str  = implode( ' ', $html_class );
        $label_str       = ( isset( $control['label'] ) ? '<label for="'.$id.'" > ' . $control['label'] : '' );
        $label_str      .= isset( $control['help'] ) ? '<div class="wpdev_settings_help">&#63;<div class="wpdev_settings_help_block"><span class="pnt"></span><p>'. $control['help'] .'</p></div></div></label>' : '</label>';
        $description     = isset( $control['description'] ) ? $control['description'] : "";
        $description_str = $description != "" ? '<p class="description">' . $description . '</p>' : '';

        echo $label_str;

        $color = explode(',', $default);
        ?>

        <input  type="text" class="jscolor <?php echo $control['isGradient']?'half':'';?> form_background_color form_first_background_color" value="<?php echo esc_html($color[0]);?>" size="10" autocomplete="off" >
        <input  type="text" class="jscolor <?php echo $control['isGradient']?'half':'hidden';?> form_background_color form_second_background_color "  value="<?php echo (isset($color[1]))?esc_html($color[1]):$color[0];?>" size="10" autocomplete="off" >
        <input  type="hidden" name="wpdev_options[<?php echo $id; ?>]" value="<?php echo $default;?>" size="13" autocomplete="off" >
        <?php
        echo $description_str;
    }


    public function drawFreeBanner(){
        Hugeit_Contact_Template_Loader::get_template('admin/free-banner.php');
    }

}

