<?php

class NF_Popups_Extensions {
    function __construct(){
        add_action( 'admin_menu', array( $this, 'add_extensions_page') );
    }

    function add_extensions_page(){
        add_submenu_page(
            'edit.php?post_type=nf-popups',
            __( 'Extensions', 'nf-popups' ),
            __( 'Extensions', 'nf-popups' ),
            'manage_options',
            'nf-popups-extensions',
            array( $this, 'extensions_display' )
        );
    }

    function extensions_display(){
        //http://ninja-forms.dev/wp-content/plugins/ninja-forms/assets/img/add-ons/layout-styles.png

        ?>
        	<!-- Create a header in the default WordPress 'wrap' container -->
            <div class="wrap">
                <h1>Extensions</h1>
            <p> You can use below extensions to add extra features to the addon</p>

             <ul class="nf-popups-extension-row">
             <li class="nf-popups-extension">
                 <h2 style="text-align:center">Exit Intent</h2>
                <img src="<?php echo NF_POPUPS_URL.'/images/exit-intent.jpg' ?>">
                <p> Convert abandoning visitors into subscribers and customers.Show users popup before they leave your site</p>
                <div class="action-links">
			        <a class="button" target="_blank" href="https://ninjapopup.org/extensions">Get Extension</a>
			    </div>
			 </li>
			 <li class="nf-popups-extension">
                 <h2 style="text-align:center">Advanced Animations</h2>
                <img src="<?php echo NF_POPUPS_URL.'/images/advanced-animations.jpg' ?>">
                <p> Open Popup using beautiful animations to get user attention.</p>
                <div class="action-links">
			        <a class="button" target="_blank" href="https://ninjapopup.org/extensions">Get Extension</a>
			    </div>
             </li>

            </ul>



            </div>
        <?php


    }

}//class ends

new NF_Popups_Extensions();