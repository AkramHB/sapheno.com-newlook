<?php
namespace Elementor;

function eael_ninja_forms_init() {
    Plugin::instance()->elements_manager->add_category(
        'elementor-ninja-forms',
        [
            'title'  => 'Elementor Ninja Forms',
            'icon' => 'font'
        ],
        1
    );
}
add_action( 'elementor/init','Elementor\eael_ninja_forms_init' );



