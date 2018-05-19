  jQuery(document).ready(function($) {

     function dismissRemoveMessage() {
         $.ajax({
             'url': ajaxurl,
             'method': 'POST',
             'data': {
                 'action': 'cf7_style_remove_box'
             },
             'success': function(data) {}
         });
     }

     if ($('.post-type-cf7_style.post-php').length > 0) {
         $('.meta-box-sortables').sortable({
             disabled: true
         });
     }
     $('.cf7_style_page_cf7style-settings .cf7style-tooltip').on('click', function(e) {
         e.preventDefault();
         e.stopPropagation();
         $('.cf7style-tooltip-content').removeClass('show');
         if ($(this).hasClass('on')) {
             $('.cf7style-tooltip-content').removeClass('show');
             $('.cf7_style_page_cf7style-settings .cf7style-tooltip').removeClass('on');
         } else {
             $(this).find('.cf7style-tooltip-content').addClass('show');
             $(this).addClass('on');
         }
     });
     $('.cf7_style_page_cf7style-settings').on('click', function(e) {
         $('.cf7style-tooltip-content').removeClass('show');
         $('.cf7_style_page_cf7style-settings .cf7style-tooltip').removeClass('on');
     });
     $('.cf7style-tooltip-content').on('click', function(e){
        e.stopPropagation();
     });
     $('.remove_template_notice').on('click', function(e) {
         e.preventDefault();
         $('.template-message-box').fadeOut('slow');
         dismissRemoveMessage();
     });
     $(document).on('click', '.cf7style-pointer a.close', function(e) {
         e.preventDefault();
         if ($('#cf7_style_allow_tracking').is(':checked')) {
             $.post(ajaxurl, "action=cf7_style_allow_tracking&cf7_style_allow_tracking=1", function(res) {});
         } else {
             $.post(ajaxurl, "action=cf7_style_show_tracking&cf7_style_allow_tracking=0", function(res) {});
         }
     });
     $('input[name="custom_template_check"]').on('change', function() {
         if ($(this).is(':checked')) {
             $('.double-check').show();
         } else {
             $('.double-check').hide();
         }
     });
     $('.confirm-remove-template').on('click', function(e) {
         e.preventDefault();
         var curParent = $(this).parent();
         if ($('input[name="double_check_template"]:checked').val() == "no") {
             curParent.hide();
             $('input[name="custom_template_check"]').attr('checked', 'checked');
         } else {
             dismissRemoveMessage();
             $.ajax({
                 'url': ajaxurl,
                 'method': 'POST',
                 'data': {
                     'action': 'cf7_style_remove_templates'
                 },
                 'success': function(data) {
                     if (data) {
                         $('<p class="succeded">Predefined templates successfully removed.</p>').appendTo(curParent);
                         setTimeout(function() {
                             curParent.fadeOut('slow');
                             curParent.parent().fadeOut('slow', function() {
                                 setTimeout(function() {
                                     window.location.reload(false);
                                 }, 300);
                             });
                         }, 2000);
                     }
                 }
             });
         }
     });
 });
