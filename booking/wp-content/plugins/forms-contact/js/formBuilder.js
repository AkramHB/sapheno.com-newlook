jQuery(document).ready(function(e) {
    ////ADD FIELDS START///

    jQuery('#add-fields-block #add-default-fields').on('click', 'li>a', function(event) {

        event.preventDefault();
        var readyDef;
        if (jQuery(this).parents('#add-default-fields').hasClass('readyFields')) {
            alert('This option is disabled for free version. Please upgrade to pro license to be able to use it.');
            return;
        } else {
            readyDef = jQuery('#add-fields-block li.spinnerLi>img.defSpin');
            //jQuery("#add-fields-block").css("pointer-events","none");
        }
        var formId = jQuery(this).attr('data-formId');
        var inputType = jQuery(this).attr('id');
        var inputTypeStatus = 0;
        if (jQuery(this).parent().hasClass('disabled')) {
            inputTypeStatus = 'disabled';
        }
        var themeId = jQuery(this).attr('data-themeId');
        if (inputType == 'captcha' || inputType == 'buttons' || inputType=='simple_captcha_box') {
            if(jQuery('#add-fields-block').find('li>a#'+inputType+'').parent().hasClass('disabled')){
                jQuery("#add-fields-block").css("pointer-events","all");
            }
            jQuery('#add-default-fields').find('li>a#' + inputType + '').parent().addClass('disabled');
        }
        if (jQuery('#add-fields-block li.spinnerLi>img').css('display') != 'inline') {
            if (inputTypeStatus != 'disabled' && inputType != 'Nocaptcha' && inputType != 'custom_text') {
                readyDef.css('display', 'inline');
                jQuery.ajax({
                    type: "POST",
                    url: ajaxurl,
                    data: {
                        action: 'hugeit_contact_formBuilder_action',
                        task: 'addFieldsTask',
                        formId: formId,
                        nonce: hugeit_forms_obj.nonce,
                        inputType: inputType,
                        themeId: themeId
                    }
                }).done(function(response) {
                    var response = jQuery.parseJSON(response);
                    if (response) {
                        if (response.captchaNum) {
                            var ifExists = false;
                            if (jQuery('#fields-list-block #fields-list-right li').length == 0) {
                                jQuery('#fields-list-block #fields-list-left').append(response.outputFieldSettings);
                            } else {
                                jQuery('#fields-list-block #fields-list-right').append(response.outputFieldSettings);
                            }
                            if (jQuery('#hugeit-contact-wrapper .hugeit-contact-block-right div').length == 0) {
                                jQuery(".hugeit-contact-block-left > div").each(function() {
                                    if (jQuery(this).hasClass('buttons-block')) {
                                        ifExists = true;
                                    }
                                });
                                if (ifExists) {
                                    var beforeAdd = jQuery('.hugeit-contact-block-left').find('div.buttons-block');
                                    jQuery(response.outputField).insertBefore(beforeAdd);
                                } else {
                                    jQuery('#hugeit-contact-wrapper .hugeit-contact-block-left').append(response.outputField);
                                }
                            } else {
                                jQuery(".hugeit-contact-block-right > div").each(function() {
                                    if (jQuery(this).hasClass('buttons-block')) {
                                        ifExists = true;
                                    }
                                });
                                if (ifExists) {
                                    var beforeAdd = jQuery('.hugeit-contact-block-right').find('div.buttons-block');
                                    jQuery(response.outputField).insertBefore(beforeAdd);
                                } else {
                                    jQuery('#hugeit-contact-wrapper .hugeit-contact-block-right').append(response.outputField);
                                }
                            }
                            var leftelement = [];
                            var rightelement = [];

                            jQuery(".hugeit-contact-block-left > div").each(function() {
                                leftelement.push(jQuery('.fields-list li[id="' + jQuery(this).attr('rel') + '"]'));
                                jQuery(this).find('.left-right-position').val('left');
                            });

                            jQuery(".hugeit-contact-block-right > div").each(function() {
                                rightelement.push(jQuery('.fields-list li[id="' + jQuery(this).attr('rel') + '"]'));
                                jQuery(this).find('.left-right-position').val('right');
                            });

                            jQuery('#fields-list-left').html(leftelement);
                            jQuery('#fields-list-right').html(rightelement);

                            var public_num = response.captchaNum;
                            var verifyCallback = function(response) {
                            };
                            grecaptcha.render('democaptchalight', {
                                'sitekey': public_num,
                                'callback': verifyCallback,
                                'theme': 'light',
                                'type': 'image'
                            });

                            grecaptcha.render('democaptchadark', {
                                'sitekey': public_num,
                                'callback': verifyCallback,
                                'theme': 'dark',
                                'type': 'image'
                            });

                            refreshOrdering();

                            jQuery(".fields-list > li").removeClass('has-background');
                            count = jQuery(".fields-list > li").length;
                            for (var i = 0; i <= count; i += 2) {
                                jQuery("#fields-list-left > li").eq(i).addClass("has-background");
                                jQuery("#fields-list-right > li").eq(i).addClass("has-background");
                            }
                            readyDef.css('display', 'none');
                        } else if (response.customText) {
                            jQuery('#hugeit-contact-wrapper .hugeit-contact-block-left').prepend(response.outputField);
                            jQuery('#fields-list-block #fields-list-left').prepend(response.outputFieldSettings);

                            refreshOrdering();

                            jQuery(".fields-list > li").removeClass('has-background');
                            count = jQuery(".fields-list > li").length;
                            for (var i = 0; i <= count; i += 2) {
                                jQuery("#fields-list-left > li").eq(i).addClass("has-background");
                                jQuery("#fields-list-right > li").eq(i).addClass("has-background");
                            }
                            readyDef.css('display', 'none');

                            location.reload();
                        } else if (response.buttons) {
                            if (jQuery('#fields-list-block #fields-list-right li').length == 0) {
                                jQuery('#fields-list-block #fields-list-left').append(response.outputFieldSettings);
                            } else {
                                jQuery('#fields-list-block #fields-list-right').append(response.outputFieldSettings);
                            }
                            if (jQuery('#hugeit-contact-wrapper .hugeit-contact-block-right div').length == 0) {
                                jQuery('#hugeit-contact-wrapper .hugeit-contact-block-left').append(response.outputField);
                            } else {
                                jQuery('#hugeit-contact-wrapper .hugeit-contact-block-right').append(response.outputField);
                            }
                            var leftelement = [];
                            var rightelement = [];

                            jQuery(".hugeit-contact-block-left > div").each(function() {
                                leftelement.push(jQuery('.fields-list li[id="' + jQuery(this).attr('rel') + '"]'));
                                jQuery(this).find('.left-right-position').val('left');
                            });

                            jQuery(".hugeit-contact-block-right > div").each(function() {
                                rightelement.push(jQuery('.fields-list li[id="' + jQuery(this).attr('rel') + '"]'));
                                jQuery(this).find('.left-right-position').val('right');
                            });

                            jQuery('#fields-list-left').html(leftelement);
                            jQuery('#fields-list-right').html(rightelement);
                            jQuery(".fields-list > li").removeClass('has-background');
                            count = jQuery(".fields-list > li").length;
                            for (var i = 0; i <= count; i += 2) {
                                jQuery("#fields-list-left > li").eq(i).addClass("has-background");
                                jQuery("#fields-list-right > li").eq(i).addClass("has-background");
                            }

                            refreshOrdering();

                            readyDef.css('display', 'none');
                        } else {
                            if( inputType == 'simple_captcha_box'){
                                if( jQuery('li[data-fieldtype=buttons]').length ){
                                    jQuery('li[data-fieldtype=buttons]').before(response.outputFieldSettings);
                                    jQuery('.hugeit-field-block.buttons-block').before(response.outputField);
                                } else {
                                    jQuery('#hugeit-contact-wrapper .hugeit-contact-block-left').append(response.outputField);
                                    jQuery('#fields-list-block #fields-list-left').append(response.outputFieldSettings);
                                }
                            } else {
                                jQuery('#hugeit-contact-wrapper .hugeit-contact-block-left').prepend(response.outputField);
                                jQuery('#fields-list-block #fields-list-left').prepend(response.outputFieldSettings);
                            }


                            refreshOrdering();

                            jQuery(".fields-list > li").removeClass('has-background');
                            count = jQuery(".fields-list > li").length;
                            for (var i = 0; i <= count; i += 2) {
                                jQuery("#fields-list-left > li").eq(i).addClass("has-background");
                                jQuery("#fields-list-right > li").eq(i).addClass("has-background");
                            }
                            readyDef.css('display', 'none');
                        }
                        jscolor.init();
                    }

                    function refreshOrdering() {
                        //
                        i = 0;
                        jQuery("#fields-list-right > li").each(function() {
                            jQuery(this).find('.ordering').val(i);
                            i++;
                        });
                        i = 0;
                        jQuery("#fields-list-left > li").each(function() {
                            jQuery(this).find('.ordering').val(i);
                            i++;
                        });
                        i = 0;
                        jQuery(".hugeit-contact-block-left > div.hugeit-field-block").each(function() {
                            jQuery(this).find('input.ordering').val(i);
                            i++;
                        });
                        i = 0;
                        jQuery(".hugeit-contact-block-right > div.hugeit-field-block").each(function() {
                            jQuery(this).find('input.ordering').val(i);
                            i++;
                        });
                    }
                    refreshOrdering();
                    jQuery("#add-fields-block").css("pointer-events","all");
                });

            }
        }
    });
    ////ADD FIELDS END///
    /***************************/
    ////DELETE FIELDS START///
    jQuery('#fields-list-block').on('click', '.field-top-options-block>a.remove-field', function(event) {
        var self = jQuery(this);
        var selfField = jQuery(this).parent().parent().parent();
        var formId = jQuery("#add-fields-block").find('li.spinnerLi').attr('data-idForm');
        var fieldId = jQuery(this).parents('li[data-fieldNum]').attr('data-fieldNum');
        event.preventDefault();
        var form = jQuery('#adminForm');
        var inputTypeStatus = 0;
        if (jQuery(this).parents('#huge-contact-field-' + fieldId + '').attr('data-fieldType') == 'captcha') {
            inputTypeStatus = 'captcha';
        } else if (jQuery(this).parents('#huge-contact-field-' + fieldId + '').attr('data-fieldType') == 'buttons') {
            inputTypeStatus = 'buttons';
        }  else if(jQuery(this).parents('#huge-contact-field-'+fieldId+'').attr('data-fieldType')=='simple_captcha_box'){
            inputTypeStatus='simple_captcha_box';
        }

        jQuery.ajax({
            type: "POST",
            url: ajaxurl,
            data: {
                action: 'hugeit_contact_formBuilder_action',
                task: 'removeFieldTask',
                formId: formId,
                nonce: hugeit_forms_obj.nonce,
                fieldId: fieldId,
                formData: form.serialize()
            },
            beforeSend: function() {
                jQuery("#fields-list-block").css("pointer-events","none");
                self.addClass('remove-spinner');
            },
            success: function(response) {
                var response = jQuery.parseJSON(response);
                if (response.removedField) {
                    var fieldRes = response.removedField;
                    jQuery('#fields-list-block').find('li[id="huge-contact-field-' + fieldRes + '"]').fadeOut(function() {
                        jQuery(this).animate({"left": "0", "top": "0"});
                        jQuery(this).remove();
                    });
                    jQuery('#hugeit-contact-wrapper').find('div[rel="huge-contact-field-' + fieldRes + '"]').fadeOut(function() {
                        jQuery(this).animate({"left": "0", "top": "0"});
                        jQuery(this).remove();
                    });
                    i = 0;
                    jQuery("#fields-list-right > li").each(function() {
                        jQuery(this).find('.ordering').val(i);
                        i++;
                    });
                    i = 0;
                    jQuery("#fields-list-left > li").each(function() {
                        jQuery(this).find('.ordering').val(i);
                        i++;
                    });
                    i = 0;
                    jQuery(".hugeit-contact-block-left > div.hugeit-field-block").each(function() {
                        jQuery(this).find('input.ordering').val(i);
                        i++;
                    });
                    i = 0;
                    jQuery(".hugeit-contact-block-right > div.hugeit-field-block").each(function() {
                        jQuery(this).find('input.ordering').val(i);
                        i++;
                    });
                    jQuery(".fields-list > li").removeClass('has-background');
                    count = jQuery(".fields-list > li").length;
                    for (var i = 0; i <= count; i += 2) {
                        jQuery("#fields-list-left > li").eq(i).addClass("has-background");
                        jQuery("#fields-list-right > li").eq(i).addClass("has-background");
                    }
                    jQuery('.fields-list>li').each(function() {
                        jQuery(this).css('display', 'block');
                    });
                }
                if (inputTypeStatus == 'captcha' || inputTypeStatus == 'buttons' ||  inputTypeStatus=='simple_captcha_box') {
                    jQuery('#add-default-fields').find('li>a#' + inputTypeStatus + '').parent().removeClass('disabled');
                }
                jQuery("#fields-list-block").css("pointer-events","all");
            }
        });
    });
    /* DELETE FIELDS END */
    /* DUBLICATE FIELDS START */
    jQuery('#fields-list-block').on('click', '.field-top-options-block>a.copy-field', function(event) {
        var self = jQuery(this);
        var formId = jQuery("#add-fields-block").find('li.spinnerLi').attr('data-idForm');
        var fieldId = jQuery(this).parents('li[data-fieldNum]').attr('data-fieldNum');
        var themeId = jQuery("#add-fields-block #add-default-fields li>a").attr('data-themeId');
        var fieldType = jQuery(this).parents('#huge-contact-field-' + fieldId + '').attr('data-fieldType');
        event.preventDefault();
        var form = jQuery('#adminForm');
        if (fieldType != 'custom_text') {
            jQuery.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: 'hugeit_contact_formBuilder_action',
                    task: 'dublicateFieldTask',
                    formId: formId,
                    nonce: hugeit_forms_obj.nonce,
                    fieldId: fieldId,
                    themeId: themeId,
                    formData: form.serialize()
                },
                beforeSend: function() {
                    jQuery("#fields-list-block").css("pointer-events","none");
                    self.addClass('remove-spinner');
                },
                success: function(response) {
                    var response = jQuery.parseJSON(response);
                    var beforeID = response.beforeId;
                    var beforeAdd = jQuery('#hugeit-contact-wrapper .hugeit-contact-column-block').find('div[rel="huge-contact-field-' + beforeID + '"]');
                    var beforeAddSettings = jQuery('#fields-list-block .fields-list').find('li[id="huge-contact-field-' + beforeID + '"]');
                    jQuery(response.outputFieldSettings).insertAfter(beforeAddSettings);
                    jQuery(response.outputField).insertAfter(beforeAdd);
                    i = 0;
                    jQuery("#fields-list-right > li").each(function() {
                        jQuery(this).find('.ordering').val(i);
                        i++;
                    });
                    i = 0;
                    jQuery("#fields-list-left > li").each(function() {
                        jQuery(this).find('.ordering').val(i);
                        i++;
                    });
                    i = 0;
                    jQuery(".hugeit-contact-block-left > div.hugeit-field-block").each(function() {
                        jQuery(this).find('input.ordering').val(i);
                        i++;
                    });
                    i = 0;
                    jQuery(".hugeit-contact-block-right > div.hugeit-field-block").each(function() {
                        jQuery(this).find('input.ordering').val(i);
                        i++;
                    });
                    jQuery(".fields-list > li").removeClass('has-background');
                    count = jQuery(".fields-list > li").length;
                    for (var i = 0; i <= count; i += 2) {
                        jQuery("#fields-list-left > li").eq(i).addClass("has-background");
                        jQuery("#fields-list-right > li").eq(i).addClass("has-background");
                    }
                    ;
                    self.removeClass('remove-spinner');
                    jQuery("#fields-list-block").css("pointer-events","all");
                }
            });
        } else {
            self.addClass('remove-spinner');
        }
    });
    ////DUBLICATE FIELDS END///

    jQuery(document).on('click','.tb-close-icon',function () {
        jQuery("#add-fields-block").css("pointer-events","all");
    });


    ///SAVE FORM STARTS///
    jQuery('#hg_n_btn_block').on('click', 'input#save-buttom', function(event) {
        event.preventDefault();
        var formId = jQuery("#add-fields-block").find('li.spinnerLi').attr('data-idForm');
        var form = jQuery('#adminForm');
        var spinner = jQuery(this).parent().find('.saveSpinnerWrapper>img');

        var formData = {};
        var captcha_digits=5;
        var captcha_color="FF601C";
        jQuery(form).find("input[name],select[name],textarea[name]").each(function (index, node) {
            if(jQuery(this).is(':checkbox') ){
                if(!jQuery(this).is(':checked') ){
                    formData[node.name] = '';
                }
                else{
                    formData[node.name] = node.value;
                }
            }
            else if(jQuery(this).is(':radio')){
                if(jQuery(this).is(':checked') ) {
                    formData[node.name] = node.value;
                }
            }
            else{
                var nodename=node.name;

                if(nodename.indexOf('[color]')>0 ){
                    nodename=nodename.replace('[color]','');
                    captcha_color=node.value;

                    formData[nodename]={'digits':captcha_digits,'color':captcha_color};
                }
                else if(nodename.indexOf('[digits]')>0 ){
                    nodename=nodename.replace('[digits]','');
                    captcha_digits=node.value;
                    formData[nodename]={'digits':captcha_digits,'color':captcha_color};
                }
                else{
                    formData[node.name] = node.value;
                }
            }

        });

        jQuery.ajax({
            type: "POST",
            url: ajaxurl,
            data: {
                action: 'hugeit_contact_formBuilder_action',
                task: 'saveEntireForm',
                formId: formId,
                nonce: hugeit_forms_obj.nonce,
                formData: formData
            },
            beforeSend: function() {
                spinner.css('display', 'block');
            },
            success: function(response) {
                var response = jQuery.parseJSON(response);
                if (response.saveForm) {
                    spinner.css('display', 'none');
                }
            }
        });
    });
    /* SAVE FORM END */

    /* CHANGE THEME START */
    jQuery('#save-button-block').on('change', 'select#select_form_theme', function(event) {
        var themeId = jQuery(this).val();
        var formId = jQuery("#add-fields-block").find('li.spinnerLi').attr('data-idForm');
        var form = jQuery('#adminForm');
        var spinner = jQuery(this).parent().parent().find('img.themeSpinner');


        jQuery.ajax({
            type: "POST",
            url: ajaxurl,
            data: {
                action: 'hugeit_contact_formBuilder_action',
                task: 'changeFormTheme',
                formId: formId,
                themeId: themeId,
                formData: form.serialize(),
                nonce: hugeit_forms_obj.nonce
            },
            beforeSend: function() {
                spinner.css('display', 'inline');
            },
            success: function(response) {
                if (response) {
                    /*Find the icon name*/
                    var _hg_icons = response.slice(response.indexOf("hugeicons"),response.indexOf("{"));
                    _hg_icons = _hg_icons.split("_");
                    var _hg_res_icon= response.slice(response.indexOf("hugeicons", response.indexOf("#", 1)),response.indexOf("{",response.indexOf("#",1))).split("_");
                    /*Find the icon name*/
                    var style = document.getElementById('formStyles'),
                        script = document.getElementsByTagName('script')[0],
                        styles = response;
                    script.parentNode.insertBefore(style, script);
                    var regexp = /#hugeit-contact-wrapper\s?>\s?div\s?>\s?h3\s?{.+?display\s?:\s?([a-zA-Z-]+)/i;
                    defaultTitleVisibility = regexp.exec(styles)[1];
                    jQuery('#select_form_show_title').trigger('change');
                    try {
                        style.innerHTML = styles;
                        /*Change icon dynamically*/
                        if(jQuery("#hugeit-contact-wrapper").find("button[id^='hugeit_preview_button__submit_']").length){

                            var _hg_this_btn = jQuery("button[id^='hugeit_preview_button__submit_']");

                            if(_hg_this_btn.find("i").length){
                                var _hg_this_btn_i = _hg_this_btn.find("i");
                                _hg_this_btn_i = (_hg_icons[1]=="on")?_hg_this_btn_i.removeClass().addClass(_hg_icons[0]):_hg_this_btn.find("i").removeClass();

                            }
                            else {
                                if(_hg_icons[1]=="on") {
                                    _hg_this_btn.append("<i class='"+_hg_icons[0]+"'></i>");
                                }
                            }

                        }
                        if(jQuery("#hugeit-contact-wrapper").find("button[id^='hugeit_preview_button_reset_']").length){

                            var _hg_res_this_btn = jQuery("button[id^='hugeit_preview_button_reset_']");

                            if(_hg_res_this_btn.find("i").length){
                                var _hg_res_this_btn_i = _hg_res_this_btn.find("i");
                                _hg_res_this_btn_i = (_hg_res_icon[1]=="on")?_hg_res_this_btn_i.removeClass().addClass(_hg_res_icon[0]):_hg_res_this_btn.find("i").removeClass();

                            }
                            else {
                                if(_hg_res_icon[1]=="on") {
                                    _hg_res_this_btn.append("<i class='"+_hg_res_icon[0]+"'></i>");
                                }
                            }

                        }
                        /*Change icon dynamically*/

                    }
                    catch (error) {
                        style.styleSheet.cssText = styles;
                    }
                }
                spinner.css('display', 'none');
            }
        });
    });
    ///CHANGE THEME END///
});