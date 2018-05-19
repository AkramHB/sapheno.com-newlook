/*
jQuery functions for the Admin area
*/
jQuery(document).ready(function($) {

    /* System Status */

    /* Email address validation */

    function isValidEmailAddress(emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(emailAddress);
    }

    function hideShowBtns(previewForm) {
        if (previewForm.find('label').length < 1) {
            $('.button[data-property="label"]').hide();
        }
        if (previewForm.find('p').length < 1) {
            $('.button[data-property="p"]').hide();
        }
        if (previewForm.find('fieldset').length < 1) {
            $('.button[data-property="fieldset"]').hide();
        }
        if (previewForm.find('select').length < 1) {
            $('.button[data-property="select"]').hide();
        }
        if (previewForm.find('input[type="checkbox"]').length < 1) {
            $('.button[data-property="checkbox"]').hide();
        }
        if (previewForm.find('input[type="radio"]').length < 1) {
            $('.button[data-property="radio"]').hide();
        }
    }

    /* Validation border color */

    function validateInput(elem, result) {

        if (result == 'valid') {
            elem.css('border-color', '#ddd');
        } else {
            elem.css('border-color', 'red');
        }
    }

    /* Send Report */

    var cf7s_status_name = $('.cf7style-name'),
        cf7s_status_email = $('.cf7style-email'),
        cf7s_status_message = $('.cf7style-message'),
        cf7s_status_submit = $('.cf7style-status-submit');

    cf7s_status_submit.on('click', function(e) {
        e.preventDefault();

        $('.cf7style-input').each(function(index, value) {
            if ($(this).val() == '') {
                validateInput($(this), 'error');
            } else {
                validateInput($(this), 'valid');
            }
        });

        if (cf7s_status_name.val() !== '' && cf7s_status_email.val() !== '') {
            if (!isValidEmailAddress(cf7s_status_email.val())) {
                validateInput(cf7s_status_email, 'error');
            } else {
                validateInput(cf7s_status_email, 'valid');

                var status = $('<div />');

                $('.cf7style-status-table').each(function(index, value) {
                    var table = $("<table />");
                    table.html($(this).html());
                    status.append(table);
                });

                $.ajax({
                    'url': ajaxurl,
                    'method': 'POST',
                    'data': {
                        'action': 'cf7_style_send_status_report',
                        'name': cf7s_status_name.val(),
                        'email': cf7s_status_email.val(),
                        'message': cf7s_status_message.val(),
                        'report': status.html()
                    },
                    'beforeSend': function() {
                        cf7s_status_submit.text('Sending...');
                    },
                    'success': function(data) {
                        if ($.trim(data) == 'success') {
                            cf7s_status_submit.text('Report sent').removeClass('cf7style-status-submit').attr('disabled', 'disabled');
                        } else {
                            cf7s_status_submit.text('Something went wrong!').removeClass('cf7style-status-submit').attr('disabled', 'disabled');
                        }
                    }
                });
            }

        } else {
            console.log('error 1');
        }
    });

    /* Show info */

    $('.cf7style-status-info').on('click', function(e) {
        e.preventDefault();
        $('.cf7style-status-table').toggle();

    });

    String.prototype.filename = function(extension) {
        var s = this.replace(/\\/g, '/');
        s = s.substring(s.lastIndexOf('/') + 1);
        return extension ? s.replace(/[?#].+$/, '') : s.split('.')[0];
    }

    function changeFont(value) {
        $(".google-fontos").remove();
        if ("none" != value && "undefined" != typeof value) {
            $("head").append('<link class="google-fontos" rel="stylesheet" href="https://fonts.googleapis.com/css?family=' + value + ':100,200,300,400,500,600,700,800,900&subset=latin,latin-ext,cyrillic,cyrillic-ext,greek-ext,greek,vietnamese" />');
            $(".cf7-style.preview-zone p").css("font-family", "'" + value + "', sans-serif");
            $('.preview-form-container .wpcf7').css("font-family", "'" + value + "', sans-serif");
        }
    }

    function scrolling(element) {
        $(window).scroll(function() {
            if ($(window).width() > 1600) {
                var offset = element.find('.panel-header').offset(),
                    cf7styleOffset = $('#cf7_style_meta_box_style_customizer').offset(),
                    diff = $(window).scrollTop() - cf7styleOffset.top;
                if (diff > 0) {
                    element.find('.panel-header').css('top', diff);
                }
                if (diff <= 0) {
                    element.find('.panel-header').css('top', 0);
                }
            }
            if ($(window).scrollTop() > 700) {
                $('.fixed-save-style').show();
            } else {
                $('.fixed-save-style').hide();
            }

        }).trigger('scroll');
    }

    function autoCompleteOtherValues() {
        $("input[type='number']").on("change", function() {
            var _t = $(this),
                value = _t.val(),
                indexor = _t.parent().index(),
                allInput = _t.parent().parent().find("input[type=number]");
            switch (indexor) {
                case 1:
                    allInput.each(function() {
                        if (parseFloat($(this).attr('step')) == parseFloat(_t.attr('step'))) {
                            $(this).val(value);
                        }
                    });
                    break;
                case 2:
                    if (parseFloat(allInput.eq(3).attr('step')) == parseFloat(_t.attr('step'))) {
                        allInput.eq(3).val(value);
                    }
                    break;
            }
        });
    }

    function initialPreview(previewType) {
        var hiddenInputData = $('input[name="cf7styleallvalues"]');
        if (hiddenInputData.length > 0) {
            var loadedData = $('input[name="cf7styleallvalues"]').val(),
                loadedArray = $.parseJSON(loadedData.replace(/'/g, '"'));
            $('.place-style').remove();
            $.each(loadedArray, function(index, value) {
                if (index.indexOf('unit') < 0 && ((previewType == "hover" && index.indexOf('hover') > 0) || (previewType != "hover" && index.indexOf('hover') < 0))) {
                    var splitArray = index.split("_"),
                        newElem = splitArray[0],
                        unit = (previewType == "hover" && index.indexOf('hover') > 0) ? loadedArray[index.replace('hover', '') + "unit_hover"] : loadedArray[index + "_unit"];
                    if (splitArray[0] == "placeholder" && value != '') {
                        unit = (typeof unit == 'undefined' || value == "") ? "" : unit;
                        var newValue = value + unit;
                        var $style = $('<style>').attr('class', 'place-style');
                        $style.text(
                            '.preview-form-container ::-webkit-input-placeholder { ' +
                            splitArray[1] + ': ' + newValue + ';' +
                            '}' +
                            '.preview-form-container ::-moz-placeholder { ' +
                            splitArray[1] + ': ' + newValue + ';' +
                            '}' +
                            '.preview-form-container :-ms-input-placeholder { ' +
                            splitArray[1] + ': ' + newValue + ';' +
                            '}' +
                            '.preview-form-container :-moz-placeholder { ' +
                            splitArray[1] + ': ' + newValue + ';' +
                            '}');
                        $style.appendTo('head');
                        return;
                    }

                    if (splitArray[0] == "submit") {
                        newElem = "input[type='submit']";
                    }
                    if (splitArray[0] == "form") {
                        newElem = ".wpcf7";
                    }
                    if (splitArray[0] == 'wpcf7-not-valid-tip' || splitArray[0] == 'wpcf7-validation-errors' || splitArray[0] == 'wpcf7-mail-sent-ok') {
                        newElem = "." + splitArray[0];
                    }
                    unit = (typeof unit == 'undefined' || value == "") ? "" : unit;
                    var newValue = value + unit;
                    if (splitArray[1] == "background-image") {
                        newValue = 'url(' + value + ')';
                    }
                    newElem = (newElem == 'radio') ? 'input[type="radio"]' : (newElem == 'checkbox') ? 'input[type="checkbox"]' : newElem;
                    $('.preview-form-container ' + newElem).css(splitArray[1], newValue);
                }
            });
        }
    }

    function selectAllForms(element) {
        element.on("click", function() {
            $(".cf7style_body_select_all input").prop('checked', ($(this).is(":checked")) ? true : false);
        });
    }

    function cf7_slider(elem, slideWidth, animationSpeed, showArrows) {

        var active = elem.find('.active'),
            index = active.index() + 1,
            slide = elem.find('li'),
            sliderViewport = elem.find('ul'),
            arrow = elem.find('.narrow'),
            arrowLeft = elem.find('.narrow.left'),
            arrowRight = elem.find('.narrow.right'),
            totalSlides = elem.find('li').length;

        arrowRight.addClass('visible');
        sliderViewport.css('width', totalSlides * slideWidth);

        if (showArrows == false) {
            elem.mouseenter(function() {
                elem.find('.visible').stop().show();
            }).mouseleave(function() {
                elem.find('.visible').stop().hide();
            });
        }

        arrow.on('click', function(e) {
            e.stopPropagation();
            e.preventDefault();
            var direction = $(this).attr('data-direction');

            if (direction == "left" && index !== 1) {
                sliderViewport.stop(true, true).animate({
                    marginLeft: "+=" + (slideWidth) + "px"
                }, animationSpeed);

                index--;
            }

            if (direction == "right" && index !== totalSlides) {
                sliderViewport.stop(true, true).animate({
                    marginLeft: -(slideWidth * index) + "px"
                }, animationSpeed);

                index++;
            }

            if (index == 1) {
                arrowLeft.hide().removeClass('visible');
                arrowRight.show().addClass('visible');
            }

            if (index == totalSlides) {
                arrowRight.hide().removeClass('visible');
            }

            if (index < totalSlides) {
                arrowRight.show().addClass('visible');
            }

            if (index > 1) {
                arrowLeft.show().addClass('visible');
            }

            slide.removeClass('active').eq(index - 1).addClass('active');
        });
        sliderViewport.css({
            'margin-left': '-' + (index - 1) * slideWidth + 'px'
        });
    }

    function sliderInit(element) {
        cf7_slider(element, 202, 500, true);
        element.find('li').on('click', function() {
            if (!$(this).hasClass('current-saved')) {
                element.find('li').removeClass('current-saved');
                $(this).addClass('current-saved');
                element.find('.overlay em').html('Not Active');
                $(this).find('.overlay em').html('Active');
                $('.cf7style_template').removeAttr('checked');
                $(this).find('.cf7style_template').attr("checked", "checked");
            }
        });
    }

    $.fn.serializeObject = function() {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    }

    function updateHiddenInput(current) {
        var loadedString = "",
            loadedArray = $.parseJSON($('input[name="cf7styleallvalues"]').val().replace(/'/g, '"'));
        $.each(current.serializeObject(), function(index, value) {
            if (loadedArray.length == 0) {
                loadedArray = {};
            }
            loadedArray[index.replace(/cf7stylecustom\[/g, '').replace(/]/g, '')] = value;
        });
        loadedString = JSON.stringify(loadedArray);
        loadedString = loadedString.replace(/cf7stylecustom\[/g, '').replace(/]/g, '').replace(/"/g, "'");
        $('input[name="cf7styleallvalues"]').val(loadedString);
        $('input[name="cf7styleallvalues"]').attr('value', loadedString);
    }

    function showTheOption() {
        initialPreview();
        $('#form-tag a.button').on('click', function(e) {
            e.preventDefault();
            var _t = $(this),
                currentElement = $('.' + _t.attr('data-property') + '-panel'),
                onlyOnce = 0;
            if ($('.modified-style-here').length == 0) {
                if (!_t.hasClass('button-primary')) {
                    $('.panel').stop(true, true).animate({
                        'opacity': 0
                    }, 300, function() {
                        if (onlyOnce === 0) {
                            onlyOnce++;

                            $('.panel').addClass('hidden');
                            $('.panel').html('');
                            currentElement.css('opacity', '0');
                            currentElement.removeClass('hidden');

                            $.ajax({
                                'url': ajaxurl,
                                'method': 'POST',
                                'data': {
                                    'action': 'cf7_style_load_property',
                                    'property': _t.attr('data-property')
                                },
                                'beforeSend': function() {
                                    _t.parent().find('a').prop('disabled', 'true');
                                    $('.panel-options .loading').removeClass('hidden');
                                },
                                'success': function(data) {
                                    _t.parent().find('a').prop('disabled', 'false');
                                    onlyOnce = 0;
                                    currentElement.html(data);
                                    $('.panel-options .loading').addClass('hidden');
                                    var loadedData = $('input[name="cf7styleallvalues"]').val(),
                                        loadedArray = $.parseJSON(loadedData.replace(/'/g, '"'));
                                    currentElement.find('[name^="cf7stylecustom"]').each(function() {
                                        if (($(this).attr('id') in loadedArray) && loadedArray[$(this).attr('id')] != "") {
                                            $(this).val(loadedArray[$(this).attr('id')]);
                                        }
                                    });
                                    currentElement.find('.cf7-style-color-field').wpColorPicker(options);
                                    autoCompleteOtherValues();
                                    addBgImage();
                                    currentElement.stop(true, true).animate({
                                        'opacity': 1
                                    }, 300);
                                    injectCheckbox();
                                    changeInputStep();
                                }
                            });

                        }
                    });

                    $(".element-selector input:eq(0)").prop("checked", true);
                }
                $('#form-tag a.button').removeClass('button-primary');
                _t.addClass('button-primary');
                $('input[name="cf7styleactivepane"]').val(_t.attr('data-property'));
            } else {
                $('.panel-options .decision').removeClass('hidden');
            }
        });

        $('.panel-options .cancel-btn').on('click', function(e) {
            e.preventDefault();
            $('.panel-options .decision').addClass('hidden');
        });

        $('.element-selector input').on('change', function() {
            $('.element-selector input').prop('checked', false);
            $(this).prop('checked', true);
            if ($(this).val() == "hover") {
                $('.panel:visible li').addClass('hidden');
                $('.panel:visible li.hover-element').removeClass('hidden');
                initialPreview("hover");
            } else {
                $('.panel:visible li.hover-element').addClass('hidden');
                $('.panel:visible li').not('.hover-element').removeClass('hidden');
                initialPreview();
            }
        });
        $('#form-preview').on('change', function() {
            $('.preview-form-container').addClass('hidden');
            $('.preview-form-container').eq($(this).val()).removeClass('hidden');
        });
        var once = 0;
        $(document).on("change", '[name^="cf7stylecustom"]', function() {
            if (once == 0) {
                once++;
                $(this).parents('.panel').addClass('modified-style-here');
            }
            updateHiddenInput($(this).parents('.panel').find('[name^="cf7stylecustom"]'));
            if ($('input[name="element-type"]:checked').val() == "hover") {
                initialPreview('hover');
            } else {
                initialPreview();
            }
        });
        $(document).on("keyup", '[name^="cf7stylecustom"]', function() {
            updateHiddenInput($(this).parents('.panel').find('[name^="cf7stylecustom"]'));
            if ($('input[name="element-type"]:checked').val() == "hover") {
                initialPreview('hover');
            } else {
                initialPreview();
            }
        });
    }

    function removePreviewfields(element) {
        element.remove();
    }

    function disableSubmit(element) {
        element.on('click', function(e) {
            e.preventDefault();
        });
    }

    function addDummyElements() {
        $('.wpcf7 input[aria-required="true"]').each(function() {
            $('<span role="alert" class="wpcf7-not-valid-tip">Required field message example.</span>').insertAfter($(this));
        });
        $('.wpcf7').each(function() {
            $('<div class="wpcf7-response-output wpcf7-display-none wpcf7-validation-errors" style="display: block;" role="alert">Error message example.</div>').appendTo($(this));
            $('<div class="wpcf7-response-output wpcf7-display-none wpcf7-mail-sent-ok" style="display: block;" role="alert">Thank you message example.</div>').appendTo($(this));
        });
    }

    function addBgImage() {
        var bgFormInput = $('.cf7-style-upload-field');
        bgFormInput.addClass('hidden');
        bgFormInput.each(function() {
            var _t = $(this);
            $('<span class="image-info-box"></span>').insertAfter(_t);
            if (_t.val() != "") {
                _t.parent().find('.image-info-box').text(_t.val().filename('yes'));
            }
        });
        if ($('.upload-btn').length <= 0) {
            $("<a href='javascript: void(0);' class='remove-btn button'>Remove</a>").insertAfter(bgFormInput);
            $("<a href='javascript: void(0);' class='upload-btn button'>Upload</a>").insertAfter(bgFormInput);
        }
        $('.upload-btn').on('click', function() {
            var _t = $(this),
                currentimage = _t.parent().find('.cf7-style-upload-field');
            tb_show('New Banner', 'media-upload.php?type=image&TB_iframe=1');
            window.send_to_editor = function(html) {
                currentimage.val($(html).attr('src'));
                currentimage.trigger('change');
                _t.parent().find('.image-info-box').text($(html).attr('src').filename('yes'));
                tb_remove();
            }
        });
        $('.remove-btn').on('click', function() {
            var _t = $(this),
                currentimage = _t.parent().find('.cf7-style-upload-field');
            currentimage.val(' ');
            currentimage.attr('value', ' ');
            currentimage.trigger('change');
            _t.parent().find('.image-info-box').text('');
        });
    }

    function codeMirrorInit() {
        if ($("#cf7_style_manual_style").length > 0) {
            var editor = CodeMirror.fromTextArea(document.getElementById("cf7_style_manual_style"), {
                lineNumbers: true,
                theme: "default",
                mode: "text/css"
            });
        }
    }
    if ($('.cf7style-no-forms-added').length > 0) {
        $('.generate-preview-button, .generate-preview-option').show();
    } else {
        $('.generate-button-hidden').show();
    }

    $('.generate-preview-button').on('click', function(e) {
        e.preventDefault();
        $('.cf7style-no-forms-added').hide();

        var form_id = $(this).attr('data-attr-id'),
            form_title = $(this).attr('data-attr-title');
        $(this).prop('disabled', true);
        $(this).parents('tr').find('input').prop('checked', true);

        var paragraph = $("<p />");
        $('.preview-form-tag').prepend(paragraph);

        $.ajax({
            'url': ajaxurl,
            'method': 'POST',
            'data': {
                'action': 'cf7_style_generate_preview_dashboard',
                'form_id': form_id,
                'form_title': form_title
            },
            'beforeSend': function() {
                paragraph.text("Loading...");
                $('.multiple-form-generated-preview').hide();
            },
            'success': function(data) {
                if (data) {
                    paragraph.remove();
                    $('.preview-form-tag').append(data);
                    $('.multiple-form-generated-preview').eq($('.multiple-form-generated-preview').length - 1).show();
                    initialPreview();
                    addDummyElements();
                    hideShowBtns($('.preview-form-container form:visible'));
                }
            }
        });
    });

    function injectCheckbox() {

        $('.wp-picker-container').each(function() {
            if ($(this).parent().find('label[for*="_color"]').length < 1) {
                $('<label><input type="checkbox" class="transparent-box" name="transparent-box">Transparent</label>').insertAfter($(this));
            }
        });
        $('.transparent-box').each(function() {
            var curParent = $(this).parent().parent();
            if (curParent.find('.cf7-style-color-field').val() == "transparent") {
                $(this).prop("checked", true);
            }
        });
        $('.transparent-box').on('click', function() {
            var curParent = $(this).parent().parent();
            if ($(this).is(':checked')) {
                curParent.find('.cf7-style-color-field').val('transparent');
                curParent.find('.cf7-style-color-field').attr('value', 'transparent');
                curParent.find('.wp-color-result').css('background-color', 'transparent');
            } else {
                curParent.find('.cf7-style-color-field').val('');
                curParent.find('.cf7-style-color-field').attr('value', '');
            }
            updateHiddenInput($(this).parents('.panel').find('[name^="cf7stylecustom"]'));
        });
    }

    function returnStep(element) {
        return (("%" == element.val() || "em" == element.val()) ? "0.01" : "1");
    }

    function changeInputStep() {
        $('.panel input[type="number"]:not([id*="opacity"])').each(function() {
            var _t = $(this);
            _t.attr('step', returnStep(_t.next()));
        });
        $('.panel select[name*="unit"]').off("change").on("change", function() {
            var _t = $(this);
            _t.prev().attr('step', returnStep(_t));
            if (_t.val() == "px") {
                var curVal = Math.floor(_t.prev().val());
                _t.prev().val(curVal);
                _t.prev().attr('value', curVal);
            }
        });
    }

    var previewEl = $(".generate-preview"),
        cf7StylePostType = $(".post-type-cf7_style"),
        selectAll = $('#select_all'),
        fontSelectVar = $('select[name="cf7_style_font_selector"]'),
        sliderWrapper = $('.cf7-style-slider-wrap'),
        previewForm = $('.preview-form-container'),
        options = {
            change: function(event, ui) {
                var _t = $(this);
                _t.parents('.wp-picker-container').parent().find('.transparent-box').prop("checked", false);
                setTimeout(function() {
                    updateHiddenInput(_t.parents('.panel').find('[name^="cf7stylecustom"]'));
                }, 0);
                if ($('input[name="element-type"]:checked').val() == "hover") {
                    initialPreview('hover');
                } else {
                    initialPreview();
                }
            }
        };

    $('.cf7-style-color-field').wpColorPicker(options);
    /*Scrolling  on settings*/
    if (previewEl.length > 0) {
        scrolling(previewEl);
    }

    if (cf7StylePostType.length > 0) {
        /*codemirror*/
        codeMirrorInit();
        /*backgroundimage*/
        addBgImage();
        /*Autocomplete number fields*/
        autoCompleteOtherValues();
        addDummyElements();
        var previewForm = $('.preview-form-container').not('.hidden');
        /*Hide settings which are not present in the current selected form*/
        if( $('.post-new-php').length < 1 ){
            hideShowBtns(previewForm);
        }
        /*Checkbox for select all the forms*/
        selectAllForms(selectAll);
        /*Change Font*/
        changeFont(fontSelectVar.val());
        fontSelectVar.on("change", function() {
            changeFont($(this).val());
        });
        /*show the right options*/
        showTheOption();
        /*remove nonce*/
        removePreviewfields(previewForm.find('input[type="hidden"]'));
        /*disable submit*/
        disableSubmit(previewForm.find('input[type="submit"]'));
    }
    if (sliderWrapper.length > 0) {
        sliderInit(sliderWrapper);
    }
    $('.close-cf7-panel').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            'url': ajaxurl,
            'method': 'POST',
            'data': {
                'action': 'cf7_style_remove_welcome_box'
            },
            'success': function(data) {
                $('.welcome-container').fadeOut('slow');
            }
        });
    });
    injectCheckbox();
    changeInputStep();
}); /*doc.ready end*/