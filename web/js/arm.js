if (typeof halumein == "undefined" || !halumein) {
    var halumein = {};
}

halumein.arm = {
	init : function() {
        if($(document).width() > 1100) {
            $('.slide-block').css({'height': screen.height-240, 'width': '277px', 'overflow-x': 'hidden', 'position': 'fixed', 'overflow': 'hidden'});
            $('.slide-content').css({'height': screen.height-180, 'width': '292px', 'overflow-y': 'scroll'});
            
            $(window).on('scroll', function(){
                if($('body').scrollTop() > 210) {
                    $('.slide-block, .slide-content').css({'top': '50px', 'height': screen.height-220});
                } else {
                    $('.slide-block, .slide-content').css({'top': 'auto', 'height': screen.height-230});
                }
            });
        }
    },
}

$(function () {
	halumein.arm.init();
});
