<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * This is a library called WPdev Settings API which allows to easily create and manage options page for wordpress admin
 * this is a experemental version.
 */

if( !class_exists( 'WPDEV_Settings_API_Form' ) ):
    class WPDEV_Settings_API_Form {

        public $plugin_id = 'wpdev_settings';

        /**
         * @var WPDEV_Settings_API_Form
         */
        protected static $_instance;

        public $tablename = null;

        public $to_save = 'settings';


        /** @var string The Page Title */
        public $page_title = '';

        /** @var string ID of form to handle settings */
        public $form_id = 'wpdev_settings_form';

        /** @var string method for form ( get/post ) */
        public $method = 'post';

        /** @var string ID of settings */
        public $id = null;

        /** @var  array Array of controls to display */
        public $controls = array();

        /** @var array Array of panels */
        public $panels = array();

        /** @var  array Sections of controls */
        public $sections = array();

        /** @var  array default values for controls */
        public $defaults;

        /** @var  string Menu slug */
        private $menu_slug;

        /** @var  bool|string Parent slug */
        private $parent_slug;

        /** @var array js files urls */
        private $js;

        /** @var  array css files urls */
        private $css;

        /** @var  array */
        private $page_hook = array();

        /** @var  string */
        private $capability;

        /** @var  string */
        private $menu_title;

        /** @var  string|bool if this variable is defined and simultaneously parent_slug is false than a toplevel page will be created with a submneu page which menu title is this variable */
        private $subtitle;

        /**
         * WPDEV_Settings_API_Form constructor.
         */
        protected function __construct( $config = array() ){
            $js = array(
                array(
                    'handle' => 'wpdev-settings',
                    'src' => plugins_url('assets/js/wpdev-settings.js',__FILE__),
                    'deps' => array( 'jquery', 'jquery-masonry' ),
                    'localize' => array(
                        'key' => 'wpDevL10n',
                        'data' => array(
                            'ajax_admin' => admin_url('admin-ajax.php'),
                            'nonce' => wp_create_nonce('wpdev-settings-save-options'),
                            'problemz' => __( 'Something Went Wrong' )
                        )
                    )
                ),
                array(
                    'handle' => 'jscolor',
                    'src' => plugins_url('assets/js/jscolor.js',__FILE__),
                    'deps' => 'jquery'
                ),
                array(
                    'handle' => 'simple-slider.js',
                    'src' => plugins_url('assets/js/simple-slider.js',__FILE__),
                    'deps' => array( 'jquery' )
                ),
            );

            $css = array(
                array(
                    'handle' => 'wpdev-settings',
                    'src' => plugins_url( 'assets/css/wpdev-settings.css', __FILE__ )
                ),
                array(
                    'handle' => 'simple-slider',
                    'src' => plugins_url( 'assets/css/simple-slider.css', __FILE__ )
                ),
                array(
                    'handle' => 'open-sans',
                    'src' => 'https://fonts.googleapis.com/css?family=Open+Sans:400,600,700'
                ),
                array(
                    'handle' => 'roboto',
                    'src' => 'https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,500i,700,900'
                )
            );

            $config = wp_parse_args($config, array(
                'menu_slug' => 'wpdev_settings',
                'parent_slug' => false,
                'js' => $js,
                'css' => $css,
                'menu_title' => __( 'Settings' ),
                'subtitle' => false,
                'page_title' => __( 'Settings' ),
                'capability' => 'manage_options',
            ));

            foreach( $config as $key=>$val ){
                $this->{$key} = $val;
            }

            add_action( 'admin_menu', array( $this, 'admin_menu' ) );

            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
            add_action( 'init', array( $this, 'save_options'  ) );
            add_action( 'wp_ajax_wpdev_save_'.$this->to_save, array( $this, 'save_options' ) );

        }

        /**
         * Returns instance of a class from which it was called
         *
         * @return static
         */
        public static function instance() {
            $class_name = static::get_class_name();
            if ( ! ( self::$_instance instanceof $class_name ) ) {
                self::$_instance = new $class_name();
            }

            return self::$_instance;
        }

        final protected static function get_class_name() {
            return get_called_class();
        }

        private function __clone() {
            _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '2.1' );
        }

        /**
         * Unserializing instances of this class is forbidden.
         */
        private function __wakeup() {
            _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '2.1' );
        }

        public function __get( $key ) {
            if ( $this->id ) {
                $this->$key = get_option( $this->plugin_id . "_" . $this->id . "_" . $key, false );
            } else {
                $this->$key = get_option( $this->plugin_id . "_" . $key, false );
            }

            return $this->$key;
        }

        /**
         * @param $key
         * @param bool $default
         * @param bool $concat
         *
         * @return mixed|void
         */
        public function get_option( $key, $default = false, $concat = true ) {
            if ( ! $concat ) {
                $value = get_option( $key, $default );
            } else {
                $value = get_option( $this->plugin_id . "_" . $key, $default );
            }

            if( is_string( $value ) ){
                $value = wp_unslash( $value );
            }

            return $value;
        }

        /**
         * Initialize admin page
         */
        public function admin_menu(){
            if( ! $this->parent_slug ){
                $this->page_hook['toplevel'] = add_menu_page( $this->page_title, $this->menu_title, $this->capability, $this->menu_slug, array( $this, 'init_admin' ), $this->icon_url );
                if( $this->subtitle ){
                    $this->page_hook['submenu'] = add_submenu_page( $this->menu_slug, $this->page_title, $this->subtitle, $this->capability, $this->menu_slug, array( $this, 'init_admin' ) );
                }
            }else{
                $this->page_hook['submenu'] = add_submenu_page( $this->parent_slug, $this->page_title, $this->menu_title, $this->capability, $this->menu_slug, array( $this, 'init_admin' ) );
            }
            do_action( 'wpdev_settings_'.$this->plugin_id.'_admin_menu' );
        }

        /**
         * Add a javascript resource to the page
         *
         * @param null|string $handle
         * @param null|string $src
         * @param null|string[] $dependencies
         * @param null|array $localize
         * @return bool
         */
        protected function add_js( $handle = null, $src = null, $dependencies = null, $localize = null ){
            if( is_null( $handle ) || is_null( $src ) ){
                return false;
            }

            $this->js[] = array(
                'handle' => $handle,
                'src' => $src,
                'deps' => $dependencies,
                'localize' => $localize,
            );

            return true;
        }

        /**
         * @param null|string $handle
         * @param null|string $src
         * @param null|string[] $deps
         * @param bool|string $ver
         * @param string $media
         * @return bool
         */
        protected function add_css( $handle = null, $src = null, $deps = null, $ver = false, $media = 'all' ){
            if( is_null( $handle ) || is_null( $src ) ){
                return false;
            }

            $this->css[] = array(
                'handle' => $handle,
                'src' => $src,
                'deps' => $deps,
                'ver' => $ver,
                'media' => $media
            );

            return true;
        }

        /**
         * Enqueue scripts and styles to the settings page
         *
         * @param $hook string
         */
        public function enqueue($hook){
            if( in_array($hook, $this->page_hook) ){

                foreach( $this->css as $source ){
                    if( is_null($source['handle']) || is_null( $source['handle'] ) ){
                        continue;
                    }

                    $deps = isset( $source['deps'] ) ? $source['deps'] : false;

                    $ver = isset( $source['ver'] ) ? $source['ver'] : false;

                    $media = isset( $source['media'] ) ? $source['media'] : 'all';

                    wp_enqueue_style( $source['handle'], $source['src'], $deps, $ver, $media );
                }

                foreach($this->js as $source){
                    $ver = isset( $source['ver'] ) ? $source['ver'] : false;

                    $in_footer = isset( $source['in_footer'] ) ? $source['in_footer'] : true;

                    wp_enqueue_script($source['handle'], $source['src'], $source['deps'], $ver, $in_footer );

                    if( isset( $source['localize'] ) && is_array( $source['localize']) && !empty( $source['localize'] ) ){

                        wp_localize_script( $source['handle'], $source['localize']['key'], $source['localize']['data'] );

                    }
                }
            }
        }

        /**
         * Initialize admin and display the page
         */
        public function init_admin() {
            echo $this->display();
        }

        /**
         * Category dropdown
         *
         * @param $id
         * @param $control
         */
        protected function control_category_dropdown( $id, $control ){
            if( !isset( $control['category_args'] ) ) {
                $control['category_args'] = array();
            }

            $args = array(
                'type'         => 'post',
                'child_of'     => 0,
                'orderby'      => 'name',
                'order'        => 'ASC',
                'hide_empty'   => 0,
                'hierarchical' => 1,
                'taxonomy'     => 'category',
                'pad_counts'   => false
            );
            $cats = get_categories( $args );

            $control['choices'] = array();
            foreach( $cats as $cat ){
                $control['choices'][ $cat->term_id ] = $cat->name;
            }
            $this->control_select( $id, $control );
        }

        /**
         * Pages dropdown
         *
         * @param $id
         * @param $control
         */
        protected function control_page_dropdown( $id, $control ){
            if( !isset( $control['page_args'] ) ) {
                $control['page_args'] = array();
            }

            $args = wp_parse_args($control['page_args'],array(
                'sort_order'   => 'asc',
                'sort_column'  => 'post_title',
                'hierarchical' => 1,
                'child_of'     => 0,
                'parent'       => - 1,
                'offset'       => 0,
                'post_type'    => 'page',
                'post_status'  => 'publish'
            ));
            $pages      = get_pages( $args );
            $control['choices'] = array();
            foreach( $pages as $page ){
                $control['choices'][ $page->ID ] = $page->post_title;
            }

            $this->control_select( $id, $control );

        }

        /**
         * JScolor
         *
         * @param $id
         * @param $control
         */
        protected function control_color( $id, $control ){
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
            ?>
            <input type="text" class="jscolor <?php echo $html_class_str; ?>" <?php echo $placeholder; ?> id="<?php echo $id; ?>" name="wpdev_options[<?php echo $id; ?>]" value="<?php echo $default; ?>" />
            <?php
            echo $description_str;
        }

        protected function control_image_radio( $id, $control ){
            $default = ( isset( $control['default'] ) ? $control['default'] : "" );

            $label_str       = ( isset( $control['label'] ) ? '<span class="control-title" > ' . $control['label'] : '' );
            $label_str      .= isset( $control['help'] ) ? '<div class="wpdev_settings_help">&#63;<div class="wpdev_settings_help_block"><span class="pnt"></span><p>'. $control['help'] .'</p></div></div></span>' : '</span>';

            $width = isset( $control['width'] ) ? $control['width'] : '48';
            $height = isset( $control['height'] ) ? $control['height'] : '48';

            echo $label_str;
            ?>
            <div class="image-radio-block">
                <?php
                if( isset( $control['choices'] ) && !empty( $control['choices'] ) ){
                    ?>
                    <ul>
                        <?php
                        foreach( $control['choices'] as $key=>$choice ){
                            ?>
                            <li>
                                <input type="radio" value="<?php echo $key ?>" <?php checked($default, $key); ?> id="<?php echo $id.'-'.$key; ?>" name="wpdev_options[<?php echo $id; ?>]"  />
                                <label for="<?php echo $id.'-'.$key; ?>"><img src="<?php echo $choice; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" /></label>
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

        /**
         * Simple Slider
         *
         * @param $id
         * @param $control
         * @throws Exception
         */
        protected function control_simple_slider( $id, $control ){
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

            if( !isset( $control['choices'] ) || empty( $control['choices'] ) ){
                throw new Exception('"choices" parameter is required for simple-slider control.');
            }

            echo $label_str;
            ?>
            <div class="slider-container">
                <input type="text" name="wpdev_options[<?php echo $id; ?>]" id="<?php echo $id; ?>"
                       class="<?php echo $html_class_str; ?>" data-slider-highlight="true"
                       data-slider-values="<?php echo implode(',',$control['choices']); ?>" data-slider="true"
                       value="<?php echo $default; ?>"/>
                <span><?php echo $default; ?></span>
            </div>
            <?php
        }

        /**
         * Radio buttons
         *
         * @param $id
         * @param $control
         */
        protected function control_radio( $id, $control ){
            $default = ( isset( $control['default'] ) ? $control['default'] : "" );

            $label_str       = ( isset( $control['label'] ) ? '<span class="control-title" > ' . $control['label'] : '' );
            $label_str      .= isset( $control['help'] ) ? '<div class="wpdev_settings_help">&#63;<div class="wpdev_settings_help_block"><span class="pnt"></span><p>'. $control['help'] .'</p></div></div></span>' : '</span>';

            echo $label_str;
            ?>
            <div class="radio-block">
                <?php
                if( isset( $control['choices'] ) && !empty( $control['choices'] ) ){
                    ?>
                    <ul>
                        <?php
                        foreach( $control['choices'] as $key=>$choice ){
                            ?>
                            <li>
                                <input type="radio" value="<?php echo $key ?>" <?php checked($default, $key); ?> id="<?php echo $id.'-'.$key; ?>" name="wpdev_options[<?php echo $id; ?>]"  />
                                <label for="<?php echo $id.'-'.$key; ?>"><span class="radicon"></span><?php echo $choice; ?></label>
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

        /**
         * Selectbox
         *
         * @param $id
         * @param $control
         */
        protected function control_select( $id, $control ){
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
            echo $label_str;
            ?>
            <select <?php echo implode( ' ', $attrs ); ?> class="<?php echo $html_class_str; ?>" id="<?php echo $id; ?>" name="wpdev_options[<?php echo $id; ?>]" >
                <?php
                if ( isset( $control['choices'] ) && ! empty( $control['choices'] ) ) {
                    foreach ( $control['choices'] as $key => $choice ) {
                        $attrs = array();
                        if ( is_array( $choice ) ) {
                            $html = $choice['html'];
                            if ( isset( $choice['attrs'] ) ) {
                                foreach ( $choice['attrs'] as $k => $attr ) {
                                    $attrs[] = $k . '=' . $attr;
                                }
                            }
                        } else {
                            $html = $choice;
                        }
                        if ( is_array( $default ) ) {
                            $selected = in_array( $key, $default ) ? 'selected="selected"' : '';
                        } else {
                            $selected = selected( $key, $default, false );
                        }
                        echo '<option ' . implode( ' ', $attrs ) . ' value="' . esc_attr( $key ) . '" ' . $selected . ' >' . $html . '</option>';
                    }
                }
                ?>
            </select>
            <?php
            echo $description_str;
        }

        /**
         * @param $id
         * @param $control
         */
        protected function control_textarea( $id, $control ) {
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

            echo $label_str;
            ?>
            <textarea <?php echo implode( ' ', $attrs ); ?> class="<?php echo $html_class_str; ?>" id="<?php echo $id; ?>" name="wpdev_options[<?php echo $id; ?>]" ><?php echo $default; ?></textarea>
            <?php
            echo $description_str;
        }

        protected function _control_hidden( $id, $control ){
            $default = ( isset( $control['default'] ) ? $control['default'] : "" );
            ?>
            <input type="hidden" name="wpdev_options[<?php echo $id; ?>]" id="<?php echo $id; ?>" value="<?php echo $default; ?>" />
            <?php
        }

        protected function _control_checkbox( $id, $control ){
            $type = ( isset( $control['type'] ) ? $control['type'] : "text" );

            $default = ( isset( $control['default'] ) ? $control['default'] : "" );
            $checked = checked( "on", $default, false );
            $val = "yes";
            $off_val = "no";

            if(isset($control['checked_val'])) $val = $control['checked_val'];
            if(isset($control['unchecked_val'])) $off_val = $control['unchecked_val'];

            if( is_string( $default ) ){
                if( in_array( $default, array($val,$off_val) ) ){
                    $checked = checked( $val, $default, false );
                } elseif( in_array( $default, array( "true", "false" ) ) ){
                    $checked = checked( "true", $default, false );
                    $val = "true";
                    $off_val = "false";
                }
            }else{
                $checked = checked(  true, $default, false );
                $val = "true";
                $off_val = "false";
            }


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
            ?>
            <div class="control-container control-container-<?php echo $type.' '.implode( ' ', $html_class ); ?>">
                <?php echo $label_str; ?>
                <input type="hidden" name="wpdev_options[<?php echo $id; ?>]" value="<?php echo $off_val; ?>" />
                <input <?php echo implode( ' ', $attrs ); ?> type="checkbox" class="<?php echo $html_class_str; ?>" id="<?php echo $id; ?>" <?php echo $checked; ?> name="wpdev_options[<?php echo $id; ?>]" value="<?php echo $val; ?>" />
                <?php echo $description_str; ?>
            </div>
            <?php
        }

        /**
         * @param $id
         * @param $control
         */
        public function single_control( $id, $control ) {
            $type = ( isset( $control['type'] ) ? $control['type'] : "text" );

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

            if ( method_exists( $this, '_control_' . $type ) ) {
                echo call_user_func(
                    array( $this, '_control_' . $type ),
                    $id,
                    $control
                );
            } elseif ( method_exists( $this, 'control_' . $type ) ) {
                echo '<div class="control-container control-container-' . $type . ' ' . $html_class_str . '"    >';
                echo call_user_func(
                    array( $this, 'control_' . $type ),
                    $id,
                    $control
                );
                echo '</div>';
            } else {
                $attrs = array();
                if ( isset( $control['attrs'] ) && ! empty( $control['attrs'] ) ) {
                    foreach ( $control['attrs'] as $k => $attr ) {
                        $attrs[] = $k . '=' . $attr;
                    }
                }
                ?>
                <div class="control-container control-container-<?php echo $type.' '.implode( ' ', $html_class ); ?>">
                    <?php echo $label_str; ?>
                    <input <?php echo implode( ' ', $attrs ); ?> type="<?php echo $type; ?>" class="<?php echo $html_class_str; ?>" <?php echo $placeholder; ?> id="<?php echo $id; ?>" name="wpdev_options[<?php echo $id; ?>]" value="<?php echo $default; ?>" />
                    <?php echo $description_str; ?>
                </div>
                <?php
            }
        }

        /**
         * The Panels navigation
         */
        public function print_navigation() {
            echo '<div id="' . $this->id . '_navigation" class="wpdev_settings_navigation wpdev_settings_section_navigation">';
            foreach ( $this->panels as $panel_id => $panel ) {
                echo '<span rel="' . $panel_id . '" ' . ( $panel == reset( $this->panels ) ? 'class="active"' : '' ) . ' class="wpdev_setting_nav_sub">' . $panel['title'] . '</span>';
            }
            echo '</div>';
        }

        /**
         * The title section
         */
        protected function print_page_title(){ ?>
            <div class="wpdev-settings-pagetitle"><h2><?php echo $this->page_title; ?></h2><button value="save" type="submit" class="wpdev_settings_save_button wpdev-primary-button" name="wpdev_settings_save_options" ><?php _e( 'Save Settings' ); ?></button><span class="spinner"></span></div>
        <?php }

        protected function single_section( $section_id, $section ){
            $disabled = isset( $section['disabled'] );

            if( $disabled ){
                $disabled_class = apply_filters( 'wpdev_settings_disabled_section_class', 'wpdev-disabled-section' );
            }else{
                $disabled_class='';
            }

            echo '<div class="wpdev-settings-section '.$disabled_class.'">';
            if ( isset( $section['title'] ) && ! empty( $section['title'] ) ) {
                echo '<h2 class="wpdev_settings_subtitle">' . $section['title'] . '</h2>';
            }
            if ( isset( $section['description'] ) && ! empty( $section['description'] ) ) {
                echo '<p>' . $section['description'] . '</p>';
            }
            foreach ( $this->controls as $control_id => $control ) {
                if ( $control['section'] == $section_id ) {

                    if( $disabled || isset( $section['disabled_panel'] ) ){
                        if( isset( $control['html_class'] ) && is_string( $control['html_class'] ) ){
                            $control['html_class'] .= ' --disabled';
                        }elseif( isset( $control['html_class'] ) && is_array( $control['html_class'] ) ){
                            array_push( $control['html_class'], '--disabled' );
                        }else{
                            $control['html_class'] = array('--disabled');
                        }
                    }

                    $this->single_control( $control_id, $control );
                }
            }
            if($disabled){
                $disabled_description = isset( $section['disabled_description'] ) ? $section['disabled_description'] : 'This section is disabled for current version of plugin';
                $disabled_button_text = isset( $section['disabled_button_text'] ) ? $section['disabled_button_text'] : 'Get Full Version';
                $disabled_link = isset( $section['disabled_link'] ) ? $section['disabled_link'] : '#';
                $disabled_bg_color = isset( $section['disabled_bg_color'] ) ? $section['disabled_bg_color'] : '#b21919';
                $disabled_color = isset( $section['disabled_color'] ) ? $section['disabled_color'] : '#fff';

                echo '<div class="wpdev-settings-disabled-container">';
                echo '<div class="--description">'.$disabled_description.'</div>';
                echo '<a style="color:'.$disabled_color.';background-color:'.$disabled_bg_color.'" href="'.$disabled_link.'" target="_blank">'.$disabled_button_text.'</a>';
                echo '</div>';
            }
            echo '</div>';
        }

        /**
         * @param $panel_id
         * @param $panel
         */
        protected function single_panel( $panel_id, $panel ){
            $disabled = isset( $panel['disabled'] );

            if( $disabled ){
                $disabled_class = apply_filters( 'wpdev_settings_disabled_panel_class', 'wpdev-disabled-panel' );
            }else{
                $disabled_class='';
            }

            echo '<section id="' . $panel_id . '" class="'.$disabled_class.' wpdev_settings' . ( count($this->panels)>1 ? '_hidden' : '' ) . '_section ' . ( count($this->panels)>1 && $panel == reset( $this->panels ) ? 'active' : '' ) . '"" >';
            foreach ( $this->sections as $section_id => $section ) {
                if ( isset( $section['panel'] ) && $section['panel'] != $panel_id ) {
                    continue;
                }

                if( $disabled ){
                    $section['disabled_panel'] = true;
                }

                $this->single_section( $section_id, $section );

            }
            if($disabled){
                $disabled_description = isset( $panel['disabled_description'] ) ? $panel['disabled_description'] : 'This section is disabled for current version of plugin';
                $disabled_button_text = isset( $panel['disabled_button_text'] ) ? $panel['disabled_button_text'] : 'Get Full Version';
                $disabled_link = isset( $panel['disabled_link'] ) ? $panel['disabled_link'] : '#';
                $disabled_bg_color = isset( $panel['disabled_bg_color'] ) ? $panel['disabled_bg_color'] : '#b21919';
                $disabled_color = isset( $panel['disabled_color'] ) ? $panel['disabled_color'] : '#fff';

                echo '<div class="wpdev-settings-disabled-container">';
                echo '<div class="--description">'.$disabled_description.'</div>';
                echo '<a style="color:'.$disabled_color.';background-color:'.$disabled_bg_color.'" href="'.$disabled_link.'" target="_blank">'.$disabled_button_text.'</a>';
                echo '</div>';
            }
            echo '</section>';
        }

        protected function display(){
            ob_start();
            if( ! empty( $this->controls ) ){
                do_action('wpdev_settings_'.$this->plugin_id.'_header');
                ?>
                <div class="wpdev_settings_cluster">
                    <form class="wpdev_settings_form" id="<?php echo $this->form_id; ?>" action="" method="<?php echo $this->method; ?>">
                        <?php
                        if( '' !== $this->page_title ){
                            $this->print_page_title();
                        }

                        if ( empty( $this->panels ) ) {
                            $this->panels = array(
                                'main' => array(
                                    'priority' => 1
                                ),
                            );
                        }else{
                            $this->print_navigation();
                        }

                        foreach ( $this->panels as $panel_id => $panel ) {
                            $this->single_panel( $panel_id, $panel );
                        }
                        ?>
                        <div class="wpdev-settins-submit-block">
                            <?php wp_nonce_field('wpdev_settings_save_options', 'wpdev_settings_save_nonce'); ?>
                            <input type="hidden" name="action" value="wpdev_save_<?php echo $this->to_save;?>" />
                            <input type="hidden" name="wpdev_settings_current_plugin" value="<?php echo $this->plugin_id; ?>" />
                            <span class="spinner"></span>
                            <button value="save" type="submit" class="wpdev_settings_save_button wpdev-primary-button" name="wpdev_settings_save_options" ><?php _e( 'Save Settings' ); ?></button>
                        </div>
                    </form>
                </div>
                <?php
                do_action('wpdev_settings_'.$this->plugin_id.'_footer');
            }
            return ob_get_clean();
        }

        public function save_options(){
            $ajax = false;
            if (defined('DOING_AJAX') && DOING_AJAX){
                $ajax = true;

            }

            if( ! isset( $_REQUEST['wpdev_settings_current_plugin'] ) || $_REQUEST['wpdev_settings_current_plugin'] !== $this->plugin_id ){
                return false;
            }

            if( !isset( $_REQUEST['action'] ) || $_REQUEST['action'] !== 'wpdev_save_'.$this->to_save ){

                return false;
            }

            if( !check_admin_referer( 'wpdev_settings_save_options', 'wpdev_settings_save_nonce' ) ){

                if( $ajax ){
                    echo json_encode( array( 'errorMsg' => __( "Wrong nonce parameter" ) ) );die;
                }

                return false;
            }

            if( isset( $_REQUEST['wpdev_options'] ) && is_array( $_REQUEST['wpdev_options'] ) && !empty( $_REQUEST['wpdev_options'] ) ){
                foreach( $_REQUEST['wpdev_options'] as $name => $value ){
                    if( method_exists( $this, 'set_'.$name ) ){
                        call_user_func( array( $this, 'set_'.$name ), $value );
                    }else{
                        if($this->tablename){
                            $this->update_option_in_table( $name, $value );
                        } else {
                            update_option( $this->plugin_id . "_" . $name, $value );
                        }
                    }

                }

                if( $ajax ){
                    echo json_encode( array( 'successMsg' => __( "Saved Successfully" ) ) );die;
                }
                return true;
            }

            if( $ajax ){
                echo json_encode( array( 'errorMsg' => __( "Something went wrong" ) ) );die;
            }

            return true;

        }

        /**
         * @param $key
         * @param $value
         *
         */
        public function update_option_in_table( $key, $value ) {
            global $wpdb;

            $wpdb->update( $wpdb->prefix.$this->tablename,
                array(
                    'value'=>$value
                ),
                array(
                    'name'=>$key
                )
            );
        }

    }

endif;