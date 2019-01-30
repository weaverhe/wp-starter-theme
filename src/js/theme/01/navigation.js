const mobileNav = () => {
	$('.navigation--mobile__trigger').on('click', (e) => {
		e.preventDefault();
		if ($('.navigation--mobile__page').css('right') === '0px') {
			$('.navigation--mobile__page').css('position', 'fixed');
			$('.navigation--mobile__container').css('display', 'block');
			$('.navigation--mobile__page').animate({ right: 250 }, '200', () => {
				$('.navigation--mobile__trigger').addClass('navigation--mobile__trigger--arrow');
			});
		} else {
			$('.navigation--mobile__page').animate({ right: 0 }, '200', () => {
				$('.navigation--mobile__page').css('position', 'absolute');
				$('.navigation--mobile__trigger').removeClass('navigation--mobile__trigger--arrow');
				$('.navigation--mobile__container').css('display', 'none');
			});
			$('.navigation--primary').animate({ right: 0 }, '200');
		}
	});
};

const stickyNav = () => {
	const waypoint = new Waypoint({
		element: $('.navigation--primary'),
		handler: (direction) => {
			if (direction === 'down') {
				$('.navigation--primary').addClass('navigation--primary-fixed');
			} else {
				$('.navigation--primary').removeClass('navigation--primary-fixed');
			}
		},
		offset: -300,
	});

	const footerHeight = $('footer').height();
	$(window).scroll(() => {
		if ($(window).scrollTop() + $(window).height() >= $(document).height() - footerHeight + 200) {
			$('.navigation--primary').removeClass('navigation--primary-fixed');
		}
	});
};
