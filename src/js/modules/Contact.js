import gsap from 'gsap';

import Helpers from './Helpers';

class Contact {
	run() {
		setTimeout( () => {
			this.constructor.contactAnimations();
		}, 750 );
	}

	static contactAnimations() {
		// first, break up the headline into individual letters
		Helpers.spanWordLetters( document.querySelector( '.hero--contact__title' ) );

		// set up the timeline
		const contactIntroTl = gsap.timeline();

		// draw on background
		contactIntroTl.to(
			'.hero--contact',
			{
				duration: 0.5,
				scale: 1,
			},
		);

		// fade up headline letters
		contactIntroTl.to(
			'.hero--contact__title span',
			{
				duration: 0.3,
				opacity: 1,
				stagger: 0.05,
				y: 0,
			},
		);

		// fade up remaining content
		contactIntroTl.to(
			['.contact-content__email', '.contact-content__social', '.contact-content__form-intro', '.contact-form'],
			{
				duration: 0.4,
				stagger: 0.2,
				opacity: 1,
				y: 0,
			},
			'+=0.2',
		);
	}
}

export default Contact;
