(function($) {
    $(function() {
        $('body').on('change', '#nf-popups-settings-trigger', function() {
            if ($(this).val() == 'click') {
                $('.nf-popups-metabox-delay-row').hide()
                $('.nf-popups-metabox-trigger-class-row').show()
            } else {
                $('.nf-popups-metabox-trigger-class-row').hide()
                $('.nf-popups-metabox-delay-row').show()
            }
        });

    })
})(jQuery);