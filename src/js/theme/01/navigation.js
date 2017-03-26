var mobileNav = function() {
	$('.navigation--mobile__trigger').on('click', function(e) {
		e.preventDefault();
        if($('.navigation--mobile__page').css('right') === '0px') {
            $('.navigation--mobile__page').css('position', 'fixed');
            $('.navigation--mobile__container').css('display', 'block');
            //$('nav li.logo').css('display', 'none');
            $('.navigation--mobile__page').animate({ right:250 }, '200', function() {
                $('.navigation--mobile__trigger').addClass('navigation--mobile__trigger--arrow');
            });
            //$('.navigation--primary').css('position', 'absolute').animate({right:250}, 'slow');
        }
        else {
            $('.navigation--mobile__page').animate({ right:0 }, '200', function() {
                $('.navigation--mobile__page').css('position', 'absolute');
            	//$('nav li.logo').css('display', 'block');
                $('.navigation--mobile__trigger').removeClass('navigation--mobile__trigger--arrow');
                $('.navigation--mobile__container').css('display', 'none');

            });
            $('.navigation--primary').animate({right:0}, '200');
        }
	});
};

var stickyNav = function() {
    var waypoint = new Waypoint({
      element: $('.navigation--primary'),
      handler: function(direction) {
        if(direction === 'down') {
            $('.navigation--primary').addClass('navigation--primary-fixed');
        } else {
            $('.navigation--primary').removeClass('navigation--primary-fixed');
        }
      },
      offset: -300
    });

    var footerHeight = $('footer').height();
    $(window).scroll(function() {
        console.log($(window).scrollTop(), $(window).height());
        // console.log(($(window).scrollTop() + $(window).height()), ($(document).height() - footerHeight + 200));
        if($(window).scrollTop() + $(window).height() >= $(document).height() - footerHeight + 200) {
            $('.navigation--primary').removeClass('navigation--primary-fixed');
        }
    });
};
