jQuery.fn.wpDevserializeControls = function() {
    var data = {};

    function buildInputObject(arr, val) {
        if (arr.length < 1)
            return val;
        var objkey = arr[0];
        if (objkey.slice(-1) == "]") {
            objkey = objkey.slice(0,-1);
        }
        var result = {};
        if (arr.length == 1){
            result[objkey] = val;
        } else {
            arr.shift();
            var nestedVal = buildInputObject(arr,val);
            result[objkey] = nestedVal;
        }
        return result;
    }

    jQuery.each(this.serializeArray(), function() {
        var val = this.value;
        var c = this.name.split("[");
        if( !jQuery(this).closest( '.control-container' ).hasClass( '--disabled' ) ){
            var a = buildInputObject(c, val);
            jQuery.extend(true, data, a);
        }

    });

    return data;
};

function WPDEV_Settings(){
    var _this = this;

    _this.changeActiveNav = function( active ){
        _this.navigation.find("span.active").removeClass("active");
        _this.navigation.find("span[rel="+active+"]").addClass("active");
        _this.container.find("section.active").removeClass("active");
        window.location.hash = active;
        _this.container.find( "#" + active ).addClass("active");
        _this.masonry.masonry();
    };

    _this.changeNav = function(){

        var rel = jQuery(this).attr("rel");
        _this.changeActiveNav( rel );

    };

    _this.submitForm = function(){
        if(typeof tinyMCE != 'undefined'){
            var i, t = tinyMCE.editors;
            for (i in t) {
                jQuery('button.switch-html').click();
            }
        }


        var formData = _this.form.serialize();
        jQuery.ajax({
            url: wpDevL10n.ajax_admin,
            method : 'post',
            data : formData,
            dataType : 'json',
            beforeSend: function(){
                _this.submitBtn.attr("disabled",'disabled');
                _this.submitBtn.parent().find(".spinner").css("visibility","visible");
            }
        }).done(function(response){
            _this.submitBtn.removeAttr("disabled");
            _this.submitBtn.parent().find(".spinner").css("visibility","hidden");
            if( typeof response.successMsg !== 'undefined' ){
                _this.showPopup( '-success', response.successMsg );
            }else if(typeof response.errorMsg !== 'undefined' ) {
                _this.showPopup( '-error', response.errorMsg );
            }

            if( typeof tinyMCE != 'undefined'){
                var i, t = tinyMCE.editors;
                for (i in t) {
                    jQuery('button.switch-tmce').click();
                }
            }
        }).fail(function(error){
            _this.showPopup( '-error', wpDevL10n.probemz );
        });

        return false;
    };

    _this.simpleSlider = function(){
        var slides = _this.container.find('input[data-slider="true"]');
        if(slides.length){
            slides.bind("slider:changed", function (event, data) {
                jQuery(this).parent().find('span').html(data.value);
                jQuery(this).val(data.value);
            });
        }
    };

    _this.attachEvents = function(){
        if( _this.navigation.length ){
            _this.navigation.find( 'span' ).on('click',_this.changeNav);
        }
        _this.submitBtn.on("click",_this.submitForm);

        _this.simpleSlider();
    };

    _this.init = function(){
        _this.container = jQuery(".wpdev_settings_cluster");
        if( _this.container.length ){
            _this.form = jQuery(".wpdev_settings_form");
            _this.sections = _this.form.find( 'section' );
            _this.navigation = jQuery(".wpdev_settings_navigation");
            _this.submitBtn = jQuery(".wpdev_settings_save_button");

            setTimeout(function () {
                _this.masonry = _this.container.find( 'section' ).masonry({
                    columnWidth : '.wpdev-settings-section',
                    itemSelector : '.wpdev-settings-section',
                    percentPosition: true,
                    transitionDuration: 0
                });
            },500);

            var hash = window.location.hash.replace('#','');
            if( hash != '' ){
                _this.changeActiveNav(hash);
            }
            _this.attachEvents();
        }
    };

    _this.showPopup = function( type, msg ){
        type = type !== 'undefined' ? type : '-notice';

        msg = msg !== 'undefined' ? msg : '';

        jQuery.when(_this.closePopup()).done(function(){
            jQuery("body").append('<div id="wpdev-toast" class="'+ type +'" ><p>'+ msg +'</p></div>');
            _this.toastTimeout = setTimeout(function(){
                _this.closePopup();
            },5000);
            jQuery("#wpdev-toast").on("click",function(){
                _this.closePopup();
            });
        });
    };

    _this.closePopup = function(){
        var dfd = jQuery.Deferred();
        clearTimeout(_this.toastTimeout);
        if( jQuery("#wpdev-toast").length ){
            jQuery("#wpdev-toast").addClass("close--popup");

            var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
            jQuery("#wpdev-toast").one( animationEnd,function(){
                jQuery(this).remove();
                dfd.resolve();
            } );
        }else{
            dfd.resolve();
        }

        return dfd.promise();
    };

    _this.init();
}

jQuery(document).ready(function(){
    window.wpdevSetttings = new WPDEV_Settings();
});
