var goToTop = function() {
	var waypoint = new Waypoint({
      element: $('.navigation--primary'),
      handler: function(direction) {
        if(direction === 'down') {
            $('.go-top-button').addClass('go-top-button--visible');
        } else {
            $('.go-top-button').removeClass('go-top-button--visible');
        }
      },
      offset: -700
    });

	$('.go-top-button').on('click', function(e) {
		e.preventDefault();
		$('html, body').animate({scrollTop: 0}, 500);
	});
};