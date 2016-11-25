function mobileNav() {
	$('.navigation--mobile__trigger').on('click', function(e) {
		e.preventDefault();
        if($('.navigation--mobile__page').css('right') === '0px') {
            $('.navigation--mobile__page').css('position', 'fixed');
            $('.navigation--mobile__container').css('display', 'block');
            //$('nav li.logo').css('display', 'none');
            $('.navigation--mobile__page').animate({ right:250 }, '200', function() {
                $('.navigation--mobile__trigger i').removeClass('fa-navicon').addClass('fa-times');
            });
            //$('.navigation--primary').css('position', 'absolute').animate({right:250}, 'slow');
        }
        else {
            $('.navigation--mobile__page').animate({ right:0 }, '200', function() {
                $('.navigation--mobile__page').css('position', 'absolute');
            	//$('nav li.logo').css('display', 'block');
                $('.navigation--mobile__trigger i').removeClass('fa-times').addClass('fa-navicon');
                $('.navigation--mobile__container').css('display', 'none');

            });
            $('.navigation--primary').animate({right:0}, '200');
        }
	});
}
