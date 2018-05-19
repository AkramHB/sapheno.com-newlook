jQuery(document).ready(function () {
    var x = (jQuery(document).find(".paj").length>1)? true : false;
    if(x){
        var parentPag = jQuery(document).find(".paj").parent();
        var defValue=1,numPages= parentPag.children(".paj").length,pages=parentPag.children(".paj"),title=parentPag.children('h3'), current = 1;
        function init(){
            parentPag.html(jQuery(pages.hide()));
            jQuery(pages).eq(0).show();
            jQuery(pages).eq(0).before(title);
            jQuery("#prev").css("visibility","hidden");
            jQuery(".paginationUl").show();
        }

        function createPagination(){
            for(var i=1;i<=numPages;i++){
                var li = "<li value='"+i+"' class='item'> "+i+"</li>";
                jQuery("#next").before(li);

                if(i==1) {
                    jQuery(".paginationUl li.item").css({
                        "background-color":"#f44336",
                        "color":"white"
                    });
                }
            }
        }

        function validation(val) {
            return val <= 0 || val > numPages ? false : true;
        }

        function setCurrent(val){
            jQuery(pages).hide();
            jQuery(".paginationUl li").css({
                "background-color":"",
                "color":""
            });
            current=val;
            if(current!=1){
                jQuery("#prev").css("visibility","visible");
            }
            else {
                jQuery("#prev").css("visibility","hidden");
            }
            if(current!=numPages){
                jQuery("#next").css("visibility","visible");
            }
            else {
                jQuery("#next").css("visibility","hidden");
            }

            jQuery(".paginationUl li[value='"+current+"']").css({
                "background-color":"#f44336",
                "color":"white"
            });
            var counter = current;
            var currentDiv = jQuery(pages.get(--counter));
            currentDiv.fadeIn("slow");
        }

        init();
        createPagination();

        jQuery(document).on("click",".paginationUl li.item",function () {
            var currentValue = this.value;
            validation(currentValue);
            setCurrent(currentValue);
        });

        jQuery(document).on("click","#prev,#next",function () {
            var copyCurrent = current;
            var currentValue = (this.id=="next")?++copyCurrent:--copyCurrent;
            if(validation(currentValue)){
                setCurrent(currentValue);
            }

        });
    }
    /* Pagination */

    /* Mask On */
    jQuery(".hugeit-contact-form-container").find("[data-hg-pattern]").each(function () {
        var hg_pattern = jQuery(this).data('hg-pattern');
        hg_pattern = hg_pattern.toString();
        jQuery(this).mask(hg_pattern);
    });
    /* Mask On */


    function hugeitFormsResize(){
        var forms = jQuery('.hugeit-contact-wrapper .multicolumn');

        forms.each(function () {
            if( jQuery(this).width() < 521 ){
                jQuery(this).find('.hugeit-contact-column-block').addClass('fullWidth')
            } else {
                jQuery(this).find('.hugeit-contact-column-block').removeClass('fullWidth')
            }
        })
    }


    function reOrganizeFields(){

        var forms = jQuery('.hugeit-contact-wrapper');



        if( jQuery(window).width()<768 ){
            forms.each(function () {
                var form = jQuery(this);
                if(!form.children('.hugeit-form-mobile').length){
                    form.append('<div class="hugeit-form-mobile"></div>');

                    var movingCaptchaBlocks = form.find('.hugeit-field-block.captcha-block,.hugeit-field-block.simple-captcha-block');
                    var movingButtonsBlocks = form.find('.hugeit-field-block.buttons-block');

                    movingCaptchaBlocks.each(function () {
                        var rel = jQuery(this).attr('rel');
                        jQuery('<span data-placeholder="'+rel+'"></span>').insertBefore(this);
                        jQuery(this).appendTo(form.find('.hugeit-form-mobile'));
                    })

                    movingButtonsBlocks.each(function () {
                        var rel = jQuery(this).attr('rel');
                        jQuery('<span data-placeholder="'+rel+'"></span>').insertBefore(this);
                        jQuery(this).appendTo(form.find('.hugeit-form-mobile'));
                    })
                }
            })

        } else {
            forms.each(function () {
                var form = jQuery(this);
                if(form.children('.hugeit-form-mobile').length){
                    var movedBlocks = form.find('.hugeit-form-mobile').find('.hugeit-field-block.captcha-block,.hugeit-field-block.simple-captcha-block,.hugeit-field-block.buttons-block');

                    movedBlocks.each(function () {
                        var rel = jQuery(this).attr('rel');
                        jQuery(this).insertBefore(jQuery('span[data-placeholder="'+rel+'"]'));
                        jQuery('span[data-placeholder="'+rel+'"]').remove();
                    })

                    form.find('.hugeit-form-mobile').remove();
                }
            })
        }
    }

    hugeitFormsResize();
    reOrganizeFields();

    /* window resize */
    jQuery(window).on('resize',function () {
        hugeitFormsResize();

        reOrganizeFields();
    })
    /* end window resize */


});