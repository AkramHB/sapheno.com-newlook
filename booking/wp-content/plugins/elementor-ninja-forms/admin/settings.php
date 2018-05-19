<?php
/**
 * Admin Settings Page
 */

if( ! defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly

class Eael_Ninja_Forms_Admin_Settings {

	private $is_pro = false;

	/**
	 * Will Contain All Components Default Values
	 * @var array
	 * @since 2.3.0
	 */
	private $eael_default_settings;

	/**
	 * Will Contain User End Settings Value
	 * @var array
	 * @since 2.3.0
	 */
	private $eael_settings;

	/**
	 * Will Contains Settings Values Fetched From DB
	 * @var array
	 * @since 2.3.0
	 */
	private $eael_get_settings;

	/**
	 * Initializing all default hooks and functions
	 * @param
	 * @return void
	 * @since 1.1.2
	 */
	public function __construct() {

		add_action( 'admin_menu', array( $this, 'create_eael_admin_menu' ) );
		add_action( 'init', array( $this, 'enqueue_eael_admin_scripts' ) );

	}

	/**
	 * Loading all essential scripts
	 * @param
	 * @return void
	 * @since 1.1.2
	 */
	public function enqueue_eael_admin_scripts() {

		if( isset( $_GET['page'] ) && $_GET['page'] == 'eael-ninja-forms-settings' ) {
			wp_enqueue_style( 'eael-ninja-forms-admin-css', plugins_url( '/', __FILE__ ).'assets/css/admin.css' );
			wp_enqueue_style( 'eael-ninja-forms-sweetalert2-css', plugins_url( '/', __FILE__ ).'assets/vendor/sweetalert2/css/sweetalert2.min.css' );

			wp_enqueue_script( 'eael-ninja-forms-admin-js', plugins_url( '/', __FILE__ ).'assets/js/admin.js', array( 'jquery', 'jquery-ui-tabs' ), '1.0', true );
			wp_enqueue_script( 'eael-ninja-forms-core-js', plugins_url( '/', __FILE__ ).'assets/vendor/sweetalert2/js/core.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_script( 'eael-ninja-forms-sweetalert2-js', plugins_url( '/', __FILE__ ).'assets/vendor/sweetalert2/js/sweetalert2.min.js', array( 'jquery', 'eael-ninja-forms-core-js' ), '1.0', true );
		}

	}

	/**
	 * Create an admin menu.
	 * @param
	 * @return void
	 * @since 1.1.2
	 */
	public function create_eael_admin_menu() {

		add_menu_page(
			'Elementor Ninja Forms',
			'Elementor Ninja Forms',
			'manage_options',
			'eael-ninja-forms-settings',
			array( $this, 'eael_ninja_forms_admin_settings_page' ),
			plugins_url( '/', __FILE__ ).'/assets/images/ea-icon.png',
			199
		);

	}

	/**
	 * Create settings page.
	 * @param
	 * @return void
	 * @since 1.1.2
	 */
	public function eael_ninja_forms_admin_settings_page() {

		?>
		<div class="wrap">
			<div class="response-wrap"></div>
		  		<div class="eael-header-bar">
					<div class="eael-header-left">
						<h4 class="title"><?php _e( 'Elementor Ninja Forms', 'elementor-ninja-forms' ); ?></h4>
					</div>
				</div>
				<?php if( !function_exists( 'eael_activate' ) ): ?>
				<div class="eael-header-bar-after">
					<div class="eael-header-left">
						<h4 class="title-2"><?php _e( 'Get all essential elements in a single plugin!', 'elementor-ninja-forms' ); ?></h4>
						<p class="eael-subtitle-text"><?php _e( 'You can enable certain elements that you are only using. So it will not slow down your site since it won\'t load the associated resources', 'elementor-ninja-forms' ); ?></p>
					</div>
					<div class="eael-header-right">
						<button class="button eael-btn" id="eael-nf-install-now">Install Essential Addons for Elementor</button>
					</div>
				</div>
				<?php else: ?>
				<div class="error notice is-dismissible">
					<p>Looks like you have <strong>Essential Addons for Elementor</strong> installed.</strong> You can <a href="<?php echo admin_url().'plugins.php' ?>">deactivate</a> <strong>Elementor Contact Form 7</strong> and use Essential Addons.</p>
				</div>
				<?php endif; ?>
			  	<div class="eael-settings-tabs">
			    	<div id="elements" class="eael-settings-tab">
				      	<div class="row">
				      		<div class="col-full">
					            <!-- Content Element Starts -->
					            <h4>Content Elements</h4>
					            <table class="form-table">
					                <tr>
					                    <td>
					                        <div class="eael-checkbox">
					                            <p class="title">
					                                <?php _e( 'Info Box', 'essential-addons-elementor' ) ?>
					                            </p>
					                            <p class="desc">
					                                <?php _e( 'Activate / Deactive Info Box', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <input type="checkbox" id="info-box" name="info-box" disabled>
					                            <label for="info-box" class="<?php if( (bool) $this->is_pro === false ) : echo 'eael-get-pro'; endif; ?>"></label>
					                        </div>
					                    </td>
					                    <td>
					                        <div class="eael-checkbox">
					                            <p class="title">
					                                <?php _e( 'Team Member', 'essential-addons-elementor' ) ?>
					                            </p>
					                            <p class="desc">
					                                <?php _e( 'Activate / Deactivate Team Member', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <input type="checkbox" id="team-members" name="team-members" disabled>
					                            <label for="team-members" class="<?php if( (bool) $this->is_pro === false ) : echo 'eael-get-pro'; endif; ?>"></label>
					                        </div>
					                    </td>
					                    <td>
					                        <div class="eael-checkbox">
					                            <p class="title">
					                                <?php _e( 'Flip Box', 'essential-addons-elementor' ) ?>
					                            </p>
					                            <p class="desc">
					                                <?php _e( 'Activate / Deactive Flip Box', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <input type="checkbox" id="flip-box" name="flip-box" disabled>
					                            <label for="flip-box" class="<?php if( (bool) $this->is_pro === false ) : echo 'eael-get-pro'; endif; ?>"></label>
					                        </div>
					                    </td>
					                    <td>
					                        <div class="eael-checkbox">
					                            <p class="title">
					                                <?php _e( 'Dual Color Header', 'essential-addons-elementor' ) ?>
					                            </p>
					                            <p class="desc">
					                                <?php _e( 'Activate / Deactive Dual Color Header', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <input type="checkbox" id="dual-header" name="dual-header" disabled>
					                            <label for="dual-header" class="<?php if( (bool) $this->is_pro === false ) : echo 'eael-get-pro'; endif; ?>"></label>
					                        </div>
					                    </td>
					                    <td>
					                        <div class="eael-checkbox">
					                            <p class="title">
					                                <?php _e( 'Creative Button', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <p class="desc">
					                                <?php _e( 'Activate / Deactivate Creative Button', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <input type="checkbox" id="creative-btn" name="creative-btn" disabled>
					                            <label for="creative-btn" class="<?php if( (bool) $this->is_pro === false ) : echo 'eael-get-pro'; endif; ?>"></label>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <td>
					                        <div class="eael-checkbox">
					                            <p class="title">
					                                <?php _e( 'Testimonial Slider', 'essential-addons-elementor' ) ?>
					                            </p>
					                            <p class="desc">
					                                <?php _e( 'Activate / Deactivate Testimonial Slider', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <input type="checkbox" id="testimonial-slider" name="testimonial-slider" disabled>
					                            <label for="testimonial-slider" class="<?php if( (bool) $this->is_pro === false ) : echo 'eael-get-pro'; endif; ?>"></label>
					                        </div>
					                    </td>
					                    <td>
					                        <div class="eael-checkbox">
					                            <p class="title">
					                                <?php _e( 'Testimonials', 'essential-addons-elementor' ) ?>
					                            </p>
					                            <p class="desc">
					                                <?php _e( 'Activate / Deactivate Testimonials', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <input type="checkbox" id="testimonials" name="testimonials" disabled>
					                            <label for="testimonials" class="<?php if( (bool) $this->is_pro === false ) : echo 'eael-get-pro'; endif; ?>"></label>
					                        </div>
					                    </td>
					                </tr>
					            </table>
					            <!-- Content Element Ends -->
					            <!-- Dynamic Content Element Starts -->
					            <h4>Dynamic Content Elements</h4>
					            <table class="form-table">
					                <tr>
					                    <td>
					                        <div class="eael-checkbox">
					                            <p class="title">
					                                <?php _e( 'Post Grid', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <p class="desc">
					                                <?php _e( 'Activate / Deactivate Post Grid', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <input type="checkbox" id="post-grid" name="post-grid" disabled>
					                            <label for="post-grid" class="<?php if( (bool) $this->is_pro === false ) : echo 'eael-get-pro'; endif; ?>"></label>
					                        </div>
					                    </td>
					                    <td>
					                        <div class="eael-checkbox">
					                            <p class="title">
					                                <?php _e( 'Post Timeline', 'essential-addons-elementor' ) ?>
					                            </p>
					                            <p class="desc">
					                                <?php _e( 'Activate / Deactivate Post Timeline', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <input type="checkbox" id="post-timeline" name="post-timeline" disabled>
					                            <label for="post-timeline" class="<?php if( (bool) $this->is_pro === false ) : echo 'eael-get-pro'; endif; ?>"></label>
					                        </div>
					                    </td>
					                    <td>
					                        <div class="eael-checkbox">
					                            <p class="title">
					                                <?php _e( 'Post Block', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <p class="desc">
					                                <?php _e( 'Activate / Deactivate Post Block', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <input type="checkbox" id="post-block" name="post-block" disabled>
					                            <label for="post-block" class="<?php if( (bool) $this->is_pro === false ) : echo 'eael-get-pro'; endif; ?>"></label>
					                        </div>
					                    </td>
					                    <td>
					                        <div class="eael-checkbox">
					                            <p class="title">
					                                <?php _e( 'Instagram Gallery', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <p class="desc">
					                                <?php _e( 'Activate / Deactivate Instagram Gallery', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <input type="checkbox" id="instagram-gallery" name="instagram-gallery" disabled>
					                            <label for="instagram-gallery" class="<?php if( (bool) $this->is_pro === false ) : echo 'eael-get-pro'; endif; ?>"></label>
					                        </div>
					                    </td>
					                    <td>
					                        <div class="eael-checkbox">
					                            <p class="title">
					                                <?php _e( 'Woo Product Grid', 'essential-addons-elementor' ) ?>
					                            </p>
					                            <p class="desc">
					                                <?php _e( 'Activate / Deactivate Woo Product Grid', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <input type="checkbox" id="product-grid" name="product-grid" disabled>
					                            <label for="product-grid" class="<?php if( (bool) $this->is_pro === false ) : echo 'eael-get-pro'; endif; ?>"></label>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <td>
					                        <div class="eael-checkbox">
					                            <p class="title">
					                                <?php _e( 'Content Timeline', 'essential-addons-elementor' ) ?>
					                            </p>
					                            <p class="desc">
					                                <?php _e( 'Activate / Deactive Content Timeline', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <input type="checkbox" id="content-timeline" name="content-timeline" disabled>
					                            <label for="content-timeline" class="<?php if( (bool) $this->is_pro === false ) : echo 'eael-get-pro'; endif; ?>"></label>
					                        </div>
					                    </td>
					                </tr>
					            </table>
					            <!-- Dynamic Content Element Ends -->
					            <!-- Creative Element Starts -->
					            <h4>Creative Elements</h4>
					            <table class="form-table">
					                <tr>
					                    <td>
					                        <div class="eael-checkbox">
					                            <p class="title">
					                                <?php _e( 'Fancy Text', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <p class="desc">
					                                <?php _e( 'Activate / Deactivate Fancy Text', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <input type="checkbox" id="fancy-text" name="fancy-text" disabled>
					                            <label for="fancy-text" class="<?php if( (bool) $this->is_pro === false ) : echo 'eael-get-pro'; endif; ?>"></label>
					                        </div>
					                    </td>
					                    <td>
					                        <div class="eael-checkbox">
					                            <p class="title">
					                                <?php _e( 'Interactive Promo', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <p class="desc">
					                                <?php _e( 'Activate / Deactivate Interactive Promo', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <input type="checkbox" id="interactive-promo" name="interactive-promo" disabled>
					                            <label for="interactive-promo" class="<?php if( (bool) $this->is_pro === false ) : echo 'eael-get-pro'; endif; ?>"></label>
					                        </div>
					                    </td>
					                    <td>
					                        <div class="eael-checkbox">
					                            <p class="title">
					                                <?php _e( 'Count Down', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <p class="desc">
					                                <?php _e( 'Activate / Deactivate Count Down', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <input type="checkbox" id="count-down" name="count-down" disabled>
					                            <label for="count-down" class="<?php if( (bool) $this->is_pro === false ) : echo 'eael-get-pro'; endif; ?>"></label>
					                        </div>
					                    </td>
					                    <td>
					                        <div class="eael-checkbox">
					                            <p class="title">
					                                <?php _e( 'Lightbox', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <p class="desc">
					                                <?php _e( 'Activate / Deactivate Lightbox', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <input type="checkbox" id="lightbox" name="lightbox" disabled>
					                            <label for="lightbox" class="<?php if( (bool) $this->is_pro === false ) : echo 'eael-get-pro'; endif; ?>"></label>
					                        </div>
					                    </td>
					                    <td>
					                        <div class="eael-checkbox">
					                            <p class="title">
					                                <?php _e( 'Static Product', 'essential-addons-elementor' ) ?>
					                            </p>
					                            <p class="desc">
					                                <?php _e( 'Activate / Deactivate Static Product', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <input type="checkbox" id="static-product" name="static-product" disabled>
					                            <label for="static-product" class="<?php if( (bool) $this->is_pro === false ) : echo 'eael-get-pro'; endif; ?>"></label>
					                        </div>
					                    </td>
					                </tr>
					                <tr>
					                    <td>
					                        <div class="eael-checkbox">
					                            <p class="title">
					                                <?php _e( 'Image Comparison', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <p class="desc">
					                                <?php _e( 'Activate / Deactivate Image Comparison', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <input type="checkbox" id="img-comparison" name="img-comparison" disabled>
					                            <label for="img-comparison" class="<?php if( (bool) $this->is_pro === false ) : echo 'eael-get-pro'; endif; ?>"></label>
					                        </div>
					                    </td>
					                    <td>
					                        <div class="eael-checkbox">
					                            <p class="title">
					                                <?php _e( 'Flip Carousel', 'essential-addons-elementor' ) ?>
					                            </p>
					                            <p class="desc">
					                                <?php _e( 'Activate / Deactive Flip Carousel', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <input type="checkbox" id="flip-carousel" name="flip-carousel" disabled>
					                            <label for="flip-carousel" class="<?php if( (bool) $this->is_pro === false ) : echo 'eael-get-pro'; endif; ?>"></label>
					                        </div>
					                    </td>
					                    <td>
					                        <div class="eael-checkbox">
					                            <p class="title">
					                                <?php _e( 'Interactive Cards', 'essential-addons-elementor' ) ?>
					                            </p>
					                            <p class="desc">
					                                <?php _e( 'Activate / Deactive Interactive Cards', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <input type="checkbox" id="interactive-cards" name="interactive-cards" disabled>
					                            <label for="interactive-cards" class="<?php if( (bool) $this->is_pro === false ) : echo 'eael-get-pro'; endif; ?>"></label>
					                        </div>
					                    </td>
					                </tr>
					            </table>
					            <!-- Creative Element Ends -->
					            <!-- Marketing Elements Starts -->
					            <h4>Marketing Elements</h4>
					            <table class="form-table">
					                <tr>
					                    <td>
					                        <div class="eael-checkbox">
					                            <p class="title">
					                                <?php _e( 'Call To Action', 'essential-addons-elementor' ) ?>
					                            </p>
					                            <p class="desc">
					                                <?php _e( 'Activate / Deactive Call To Action', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <input type="checkbox" id="call-to-action" name="call-to-action" disabled>
					                            <label for="call-to-action" class="<?php if( (bool) $this->is_pro === false ) : echo 'eael-get-pro'; endif; ?>"></label>
					                        </div>
					                    </td>
					                    <td>
					                        <div class="eael-checkbox">
					                            <p class="title">
					                                <?php _e( 'Pricing Table', 'essential-addons-elementor' ) ?>
					                            </p>
					                            <p class="desc">
					                                <?php _e( 'Activate / Deactive Pricing Table', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <input type="checkbox" id="price-table" name="price-table" disabled>
					                            <label for="price-table" class="<?php if( (bool) $this->is_pro === false ) : echo 'eael-get-pro'; endif; ?>"></label>
					                        </div>
					                    </td>
					                </tr>
					            </table>
					            <!-- Marketing Elements Ends -->
					            <!-- Form Styler Elements Starts -->
					            <h4>Form Styler Elements</h4>
					            <table class="form-table">
					                <tr>
					                    <td>
					                        <div class="eael-checkbox">
					                            <p class="title">
					                                <?php _e( 'We-Forms', 'essential-addons-elementor' ) ?>
					                            </p>
					                            <p class="desc">
					                                <?php _e( 'Activate / Deactivate WeForms', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <input type="checkbox" id="weforms" name="weforms" disabled>
					                            <label for="weforms" class="<?php if( (bool) $this->is_pro === false ) : echo 'eael-get-pro'; endif; ?>"></label>
					                        </div>
					                    </td>
					                    <td>
					                        <div class="eael-checkbox">
					                            <p class="title">
					                                <?php _e( 'Contact Form 7', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <p class="desc">
					                                <?php _e( 'Activate / Deactivate Contact Form 7', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <input type="checkbox" id="ninja-forms" name="ninja-forms" disabled >
					                            <label for="ninja-forms" class="<?php if( (bool) $this->is_pro === false ) : echo 'eael-get-pro'; endif; ?>"></label>
					                        </div>
					                    </td>
					                    <td>
					                        <div class="eael-checkbox">
					                            <p class="title">
					                                <?php _e( 'Ninja Form', 'essential-addons-elementor' ) ?>
					                            </p>
					                            <p class="desc">
					                                <?php _e( 'Activate / Deactive Ninja Form', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <input type="checkbox" id="ninja-form" name="ninja-form" disabled>
					                            <label for="ninja-form" class="<?php if( (bool) $this->is_pro === false ) : echo 'eael-get-pro'; endif; ?>"></label>
					                        </div>
					                    </td>
					                    <td>
					                        <div class="eael-checkbox">
					                            <p class="title">
					                                <?php _e( 'Gravity Form', 'essential-addons-elementor' ) ?>
					                            </p>
					                            <p class="desc">
					                                <?php _e( 'Activate / Deactive Gravity Form', 'essential-addons-elementor' ); ?>
					                            </p>
					                            <input type="checkbox" id="gravity-form" name="gravity-form" disabled>
					                            <label for="gravity-form" class="<?php if( (bool) $this->is_pro === false ) : echo 'eael-get-pro'; endif; ?>"></label>
					                        </div>
					                    </td>
					                </tr>
					            </table>
					            <!-- Form Styler Elements Ends -->
					        </div>
				      	</div>
			    	</div>
			  	</div>
		</div>
		<?php

	}

}

new Eael_Ninja_Forms_Admin_Settings();