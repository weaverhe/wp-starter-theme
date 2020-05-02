import gsap from 'gsap';

class About {
	run() {
		setTimeout( () => {
			this.constructor.aboutAnimations();
		}, 750 );
	}

	static aboutAnimations() {
		const loadTL = gsap.timeline();

		// fade in image
		loadTL.to(
			'.about-bio__image',
			{
				duration: 0.4,
				opacity: 1,
			},
		);

		// main headline
		loadTL.to(
			'.about-bio__title .color-headline__background',
			{
				duration: 0.4,
				scale: 1,
			},
		);
		loadTL.to(
			'.about-bio__title .colored-headline__content',
			{
				duration: 0.2,
				opacity: 1,
				y: 0,
			},
		);

		// fade up content
		loadTL.to(
			'.about-bio__content',
			{
				duration: 0.4,
				opacity: 1,
				y: 0,
			},
			'-=0.6',
		);

		loadTL.to(
			'.about-intro__animation-column-1 .colored-headline__background',
			{
				duration: 0.3,
				scale: 1,
			},
			'-=0.4',
		);

		loadTL.to(
			'.about-intro__animation-column-1 .colored-headline__content',
			{
				duration: 0.3,
				opacity: 1,
				y: 0,
			},
			'-=0.1',
		);

		loadTL.to(
			'.about-intro__animation-column-1 .about-details__list',
			{
				duration: 0.3,
				opacity: 1,
				y: 0,
			},
			'-=0.1',
		);

		loadTL.to(
			'.about-intro__animation-column-2 .colored-headline__background',
			{
				duration: 0.3,
				scale: 1,
			},
			'-=0.3',
		);

		loadTL.to(
			'.about-intro__animation-column-2 .colored-headline__content',
			{
				duration: 0.3,
				opacity: 1,
				y: 0,
			},
			'-=0.1',
		);

		loadTL.to(
			'.about-intro__animation-column-2 .about-details__list',
			{
				duration: 0.3,
				opacity: 1,
				y: 0,
			},
			'-=0.1',
		);
	}
}

export default About;
