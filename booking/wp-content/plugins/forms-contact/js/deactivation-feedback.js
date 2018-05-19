/**
 * Created by User on 6/17/2017.
 */
"use strict";
jQuery(document).ready(function () {


    var confirmDeactivationLink = jQuery(".hugeit-deactivate-plugin-forms-contact"),
        cancelDeactivationLink = jQuery(".hugeit-cancel-deactivation-forms-contact"),
        deactivationURL;


    jQuery('body').on('click', '#the-list tr[data-slug=forms-contact] .deactivate a', function (e) {
        e.preventDefault();
        hugeitModalContactForms.show('forms-contact-deactivation-feedback');
        deactivationURL = jQuery(this).attr('href');

        return false;
    });

    confirmDeactivationLink.on('click', function (e) {
        e.preventDefault();

        var checkedOption = jQuery('input[name=forms-contact-deactivation-reason]:checked'),
            comment = jQuery('textarea[name=forms-contact-deactivation-comment]').val(),
            nonce = jQuery('#hugeit-contact-deactivation-nonce').val();
        if (checkedOption.length || comment.length) {
            hugeitModalContactForms.hide('forms-contact-deactivation-feedback');
            sendDeactivationFeedback(checkedOption.val(), comment, nonce);
            setTimeout(function () {
                window.location.replace(deactivationURL);
            }, 0);
        } else {
            hugeitModalContactForms.hide('forms-contact-deactivation-feedback');
            window.location.replace(deactivationURL);
        }

        return false;
    });

    cancelDeactivationLink.on('click', function (e) {
        e.preventDefault();

        hugeitModalContactForms.hide('forms-contact-deactivation-feedback');
        return false;
    });

    function sendDeactivationFeedback(v, c, n) {
        jQuery.ajax({
            url: ajaxurl,
            method: 'post',
            data: {
                action: 'hugeit_contact_deactivation_feedback',
                value: v,
                comment: c,
                nonce: n
            }
        });
    }
});