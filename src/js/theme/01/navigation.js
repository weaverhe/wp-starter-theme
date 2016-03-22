function mobileNav() {
	$('#mobile-menu-trigger').on('click', function(e) {
		e.preventDefault();
        if($('.menu-slide-left').css('right') === '0px') {
            $('.menu-slide-left').css('position', 'fixed');
            $('.mobile-menu').css('display', 'block');
            //$('nav li.logo').css('display', 'none');
            $('.menu-slide-left').animate({ right:250 }, 'slow', function() {
                $('#mobile-menu-trigger i').removeClass('fa-navicon').addClass('fa-times');
            });
            $('header').css('position', 'absolute').animate({right:250}, 'slow');
        }
        else {
            $('.menu-slide-left').animate({ right:0 }, 'slow', function() {
                $('.menu-slide-left').css('position', 'absolute');
            	//$('nav li.logo').css('display', 'block');
                $('#mobile-menu-trigger i').removeClass('fa-times').addClass('fa-navicon');
                $('.mobile-menu').css('display', 'none');

            });
            $('header').animate({right:0}, 'slow');
        }
	});
}
