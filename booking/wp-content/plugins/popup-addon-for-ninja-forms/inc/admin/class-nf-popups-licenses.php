<?php

class NF_Popups_Licensing{

	function __construct(){
		add_action('admin_menu',array($this,'register_menu') );
		add_action( 'admin_init', array( $this, 'setting_fields' ) );
	}

	public function register_menu(){
		add_submenu_page( 'edit.php?post_type=nf-popups', 'Licenses', 'Licenses', 'manage_options', 'nf_popups_licenses', array( $this, 'license_settings' ) );
	}

	public function license_settings(){
		?>
			<!-- Create a header in the default WordPress 'wrap' container -->
    <div class="wrap">

        <!-- Make a call to the WordPress function for rendering errors when settings are saved. -->
        <?php settings_errors(); ?>

        <!-- Create the form that will be used to render our options -->
        <form method="post" action="options.php">
            <?php settings_fields( 'nf_popups_licenses' ); ?>
            <?php do_settings_sections( 'nf_popups_licenses' ); ?>
            <?php submit_button(); ?>
        </form>

    </div><!-- /.wrap -->
	<?php
	}


	function setting_fields(){
		// If settings don't exist, create them.
		if ( false == get_option( 'nf_popups_licenses' ) ) {
			add_option( 'nf_popups_licenses' );
		}

		add_settings_section(
			'nf_popups_licenses_section',
			'Add-On Licenses',
			array( $this, 'section_callback' ),
			'nf_popups_licenses'
		);

		do_action('nf_popups_licenses_fields',$this);

		//register settings
		register_setting( 'nf_popups_licenses', 'nf_popups_licenses' );

	}

	public function section_callback() {
		echo '';
	}


}

new NF_Popups_Licensing();