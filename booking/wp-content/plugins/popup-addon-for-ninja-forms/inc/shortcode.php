<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class NF_Popups_Shortocde {
	public function __construct() {
		add_shortcode( 'nf-popup', array( $this, 'nf_popup_shortcode' ) );
	}

	public function nf_popup_shortcode( $atts ) {
		if ( empty( $atts['id'] ) ) {
			return;
		}
		$trigger_id          = '';
		$popup_id            = $atts['id'];
		$nf_popups_settings  = get_post_meta( $popup_id, 'nf_popups_settings', true );
		$ninja_form_id       = isset( $nf_popups_settings['ninja_form_id'] )?$nf_popups_settings['ninja_form_id']:             '';
		$content_before_form = isset( $nf_popups_settings['content_before_form'] )?$nf_popups_settings['content_before_form']: '';
		$content_after_form  = isset( $nf_popups_settings['content_after_form'] )?$nf_popups_settings['content_after_form']:   '';
		$delay               = isset( $nf_popups_settings['auto_open_delay'] )?$nf_popups_settings['auto_open_delay']:         '0';
		$show_popup_times    = isset( $nf_popups_settings['show_popup_times'] )?$nf_popups_settings['show_popup_times']:'';
		$cookie_expiry_length    = isset( $nf_popups_settings['cookie_expiry_length'] )?$nf_popups_settings['cookie_expiry_length']:'';
		$cookie_expiry_type    = isset( $nf_popups_settings['cookie_expiry_type'] )?$nf_popups_settings['cookie_expiry_type']:'';
		$auto_open           = false;
		if ( $nf_popups_settings['trigger'] == 'auto_open' ) {
			$auto_open = true;
			$trigger_id =  '#preview-popup-link-' . $popup_id;
		} elseif ( $nf_popups_settings['trigger'] == 'click' ) {
			$trigger_id = $nf_popups_settings['trigger_id'];
		}

		$trigger_id = apply_filters( 'nf_popups_trigger_id', $trigger_id, $nf_popups_settings['trigger'], $popup_id );

		if ( ! empty( $show_popup_times ) ) {
			$cookie_settings = array(
				'popup_id' =>$popup_id,
				'times'     => $show_popup_times,
				'expiry_length' => $cookie_expiry_length,
				'expiry_type'   => $cookie_expiry_type
			);
		}

		if ( ! empty( $ninja_form_id ) ) {
			ob_start(); ?>

	<style type="text/css">

	.white-popup {
		  position: relative;
		  background: #FFF;
		  padding: 20px;
		  width: auto;
		  margin: 20px auto;
	}

	.mfp-ready.mfp-bg{
		background-color: <?php echo NF_Popups_Customizer::get_value( $popup_id, 'overlay_color' ); ?>;
		opacity:<?php echo NF_Popups_Customizer::get_value( $popup_id, 'overlay_opacity' ) == 0 ? 0 : NF_Popups_Customizer::get_value( $popup_id, 'overlay_opacity' )/100; ?>;
	}
	.mfp-wrap.mfp-removing .mfp-content {
		opacity: 0;
	}
	/* .nf-animate .mfp-content {
		opacity: 0;
		transition: opacity .5s ease-out;
	} */
	.nf-animate {
		animation-duration: 1s;
	}
	.nf-animate.mfp-ready .mfp-content {
		opacity: 1;
	}
	/* .nf-animate.mfp-removing.mfp-bg {
	opacity: 0;
	}    */
	body .nf-popup-<?php echo $popup_id; ?>{
		width:         <?php echo NF_Popups_Customizer::get_value( $popup_id, 'container_width' ); ?>;
		height:        <?php echo NF_Popups_Customizer::get_value( $popup_id, 'container_height' ); ?>;
		padding:       <?php echo NF_Popups_Customizer::get_value( $popup_id, 'container_padding' ); ?>px;
		margin:        <?php echo NF_Popups_Customizer::get_value( $popup_id, 'container_margin' ); ?>;
		background:    <?php echo NF_Popups_Customizer::get_value( $popup_id, 'container_background_color' ); ?>;
		border-radius: <?php echo NF_Popups_Customizer::get_value( $popup_id, 'container_border_radius' ); ?>px;
		border-width:  <?php echo NF_Popups_Customizer::get_value( $popup_id, 'container_border_thickness' ); ?>px;
		border-color:  <?php echo NF_Popups_Customizer::get_value( $popup_id, 'container_border_color' ); ?>;
		border-style:  <?php echo NF_Popups_Customizer::get_value( $popup_id, 'container_border_style' ); ?>;
	}
	body .nf-popup-<?php echo $popup_id ?> .mfp-close{
		top:   <?php echo NF_Popups_Customizer::get_value( $popup_id, 'close_btn_top_margin' ); ?>;
		right: <?php echo NF_Popups_Customizer::get_value( $popup_id, 'close_btn_right_margin' ); ?>;
	}
	/* media query for mobile */
	@media only screen and (max-width : 736px){
		body .nf-popup-<?php echo $popup_id ?>{
			width: <?php echo NF_Popups_Customizer::get_value( $popup_id, 'container_width_mobile' ); ?>;
			height: <?php echo NF_Popups_Customizer::get_value( $popup_id, 'container_height_mobile' ); ?>;
		}
	}


	</style>
	<script type="text/javascript">
	<?php if ( ! empty( $show_popup_times ) ) { ?>
	var nf_popups_<?php echo $popup_id; ?>_cookie = <?php echo json_encode( $cookie_settings ); ?>;
	<?php }else{ ?>
	var nf_popups_<?php echo $popup_id; ?>_cookie= '';
	<?php  } ?>

	(function($){
		$(function(){

			NF_Popup_Cookies.check_popup_cookie_validity( nf_popups_<?php echo $popup_id; ?>_cookie );
			var close_counter = NF_Popup_Cookies.get_cookie( 'nf_popups_close_counter_<?php echo $popup_id ?>');
			var show_popup = true;
			if( nf_popups_<?php echo $popup_id; ?>_cookie.times != undefined ){
				var show_popup = parseInt(close_counter) < parseInt(nf_popups_<?php echo $popup_id; ?>_cookie.times);
			}
			if( show_popup ){
			$('<?php echo $trigger_id; ?>').magnificPopup({
			  	items: {
					src: '#nf-popup-<?php echo $popup_id ?>',
					type: 'inline'
				},
				removalDelay: 100,
				callbacks: {
					beforeOpen: function() {
						this.wrap.addClass("nf-animate animated <?php echo NF_Popups_Customizer::get_value( $popup_id, 'open_animation' ); ?>");
					},
					close: function() {
						NF_Popup_Cookies.set_popup_cookie( nf_popups_<?php echo $popup_id; ?>_cookie );
					},
				},
				disableOn: function() {
					var close_counter = NF_Popup_Cookies.get_cookie( 'nf_popups_close_counter_<?php echo $popup_id ?>');
					var show_popup = true;
					if( nf_popups_<?php echo $popup_id; ?>_cookie.times != undefined ){
						var show_popup = parseInt(close_counter) < parseInt(nf_popups_<?php echo $popup_id; ?>_cookie.times);
					}				
					return show_popup;
				}
				
			});
			<?php if ( $auto_open ) { ?>

				setTimeout(function(){ $('<?php echo $trigger_id; ?>').trigger('click'); }, <?php echo $delay; ?>);

			<?php } ?>
			}

	})
		})(jQuery);
	</script>
	<a style="display:none" href="javscript:void(0)" id="<?php echo str_replace( "#", "", $trigger_id ); ?>">Click</a>
	<div class=" nf-popup-<?php echo $popup_id ?> white-popup mfp-hide" id="nf-popup-<?php echo $popup_id ?>">
	<?php echo $content_before_form; ?>
		<?php echo do_shortcode( '[ninja_form id=' . $ninja_form_id . ']' ); ?>
	<?php echo $content_after_form; ?>
	</div>

<?php
		}
		$content = ob_get_contents();
		ob_clean();
		return $content;
	}
}

new NF_Popups_Shortocde();
