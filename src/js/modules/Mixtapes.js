import gsap from 'gsap';

class Mixtapes {
	run() {
		this.loadAnimation();
	}

	loadAnimation() {
		this.mixtapeLoadTL = gsap.timeline();

		this.mixtapeLoadTL.to(
			'.mixtape-header',
			{
				duration: 0.4,
				scale: 1,
			},
		);

		this.mixtapeLoadTL.to(
			'.mixtape-header__title',
			{
				duration: 0.3,
				opacity: 1,
				y: 0,
			},
		);

		this.mixtapeLoadTL.to(
			['.mixtape__details', '.mixtape__embed'],
			{
				duration: 0.3,
				opacity: 1,
				stagger: 0.15,
				y: 0,
			},
		);
	}
}

export default Mixtapes;
