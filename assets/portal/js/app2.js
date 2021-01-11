
$(document).ready(function(){

	$(function() {
	    $('#Grid').mixitup();
	});
	
    // hide #back-top first
    $("#back-top").hide();
    
    $('.hover').bind('touchstart', function(e) {
        e.preventDefault();
		var ret = $(this).class('cs-hover');
		if(ret == null){
			$this).toggleClass('cs-hover');
		}
    });
    
    // fade in #back-top
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('#back-top').fadeIn();
            } else {
                $('#back-top').fadeOut();
            }
        });

        // scroll body to 0px on click
        $('#back-top a').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 500);
            return false;
        });
    });

	

	$(document).on('click','a.smooth', function(e){
	    e.preventDefault();
	    var jQuerylink = $(this);
	    var anchor = jQuerylink.attr('href');
	    $('html, body').stop().animate({
	        scrollTop: $(anchor).offset().top
	    }, 1000);
	});
	
});


