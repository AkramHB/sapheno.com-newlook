(function($){
    setTimeout(function(){
        $(function(){

            window.get_igw_dimensions = function(){
                var $button     = $('.hugeit-forms-add');
                var href        = $button.attr('href');
                var win = jQuery(top);
                var winWidth    = win.width();
                var winHeight   = win.height();
                var popupWidth  = 1200;
                var popupHeight = 600;
                var minWidth    = 800;
                var minHeight   = 600;
                var maxWidth    = winWidth  - (winWidth  * 0.05);
                var maxHeight   = winHeight - (winHeight * 0.05);

                if (maxWidth    < minWidth)  { maxWidth    = winWidth-10  }
                if (maxHeight   < minHeight) { maxHeight   = winHeight-10 }
                if (popupWidth  > maxWidth)  { popupWidth  = maxWidth;  }
                if (popupHeight > maxHeight) { popupHeight = maxHeight; }

                return {
                    width: popupWidth,
                    height: popupHeight,
                    top: (winHeight-popupHeight)/2,
                    left: (winWidth-popupWidth)/2
                };
            };

            // Restore Thickbox functionality
            window.wp_tb_position = window.tb_position;
            window.tb_position = function(){
                var src = $("#TB_window iframe").attr('src');
                if (src && src.match('attach_to_post')) {
                    var dimensions = get_igw_dimensions();
                    $("#TB_window").css({
                        width:  dimensions.width.toString()+ "px",
                        height: dimensions.height.toString()+"px",
                        'top':  dimensions.top.toString()+"px",
                        'left': dimensions.left.toString()+"px"
                    });
                    $('#TB_window iframe').css({
                        width: '100%',
                        height: '93%'
                    });
                }
                else {
                    window.wp_tb_position();
                }
            };
        });
    });
})(jQuery);