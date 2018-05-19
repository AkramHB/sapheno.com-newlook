(function($) {
    'use strict';

    $('.customize-partial-edit-shortcuts-shown').css('background-color', '#ffffff');
    var popup_id = nf_popup_getParameterByName('popup_id');

    wp.customize('nf_popups[' + popup_id + '][overlay_color]', function(value) {
        value.bind(function(newval) {
            $('.mfp-bg.mfp-ready').css('background-color', newval);
        });
    });
    wp.customize('nf_popups[' + popup_id + '][overlay_opacity]', function(value) {
        value.bind(function(newval) {
            var opacity = newval / 100;
            $('.mfp-bg.mfp-ready').css('opacity', opacity);
        });
    });

    //Container

    wp.customize('nf_popups[' + popup_id + '][container_background_color]', function(value) {
        value.bind(function(newval) {
            $('.white-popup').css('background-color', newval);
        });
    });
    wp.customize('nf_popups[' + popup_id + '][container_padding]', function(value) {
        value.bind(function(newval) {
            $('.white-popup').css('padding', newval + 'px');
        });
    });
    wp.customize('nf_popups[' + popup_id + '][container_width]', function(value) {
        value.bind(function(newval) {
            var width = newval;
            if (width == '') {
                width = 'auto';
            }
            $('.white-popup').css('width', width);
        });
    });
    wp.customize('nf_popups[' + popup_id + '][container_height]', function(value) {
        value.bind(function(newval) {
            var height = newval;
            if (newval == '') {
                height = 'auto';
            }
            $('.white-popup').css('height', height);
        });
    });
    wp.customize('nf_popups[' + popup_id + '][container_border_radius]', function(value) {
        value.bind(function(newval) {
            $('.white-popup').css('border-radius', newval + 'px');
        });
    });
    wp.customize('nf_popups[' + popup_id + '][container_border_style]', function(value) {
        value.bind(function(newval) {

            $('.white-popup').css('border-style', newval);
        });
    });
    wp.customize('nf_popups[' + popup_id + '][container_border_thickness]', function(value) {
        value.bind(function(newval) {
            $('.white-popup').css('border-width', newval + 'px');
        });
    });
    wp.customize('nf_popups[' + popup_id + '][container_border_color]', function(value) {
        value.bind(function(newval) {
            $('.white-popup').css('border-color', newval);
        });
    });

    wp.customize('nf_popups[' + popup_id + '][close_btn_top_margin]', function(value) {
        value.bind(function(newval) {
            $('.mfp-close').css('top', newval);
        });
    });

    wp.customize('nf_popups[' + popup_id + '][close_btn_right_margin]', function(value) {
        value.bind(function(newval) {
            $('.mfp-close').css('right', newval);
        });
    });

    function nf_popup_getParameterByName(name, url) {
        if (!url) url = window.location.href;
        var name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }


})(jQuery);