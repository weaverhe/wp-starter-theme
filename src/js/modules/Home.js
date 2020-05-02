import gsap from 'gsap';

import Helpers from './Helpers';

class Home {
	constructor() {
		this.page = document.querySelector( 'body' );
		this.headlineWords = document.querySelectorAll( '.homepage-hero__rt-item' );
		this.visibleWord = document.querySelector( '.homepage-hero__rt-item--visible' );
	}

	run() {
		// break up letters into spans
		this.setupLetters();

		setTimeout( () => {
			// bring in background, top text.
			const homeTL = gsap.timeline();
			homeTL.to(
				'.hero--homepage',
				{
					duration: 0.5,
					scale: 1,
				},
			);

			homeTL.to(
				'.homepage-hero__intro-top',
				{
					duration: 0.3,
					opacity: 1,
					y: 0,
				},
			);

			// show the first word of the cycler
			setTimeout( () => {
				this.showFirstWord();
			}, 800 );

			// fade in remaining content
			setTimeout( () => {
				homeTL.to( ['.hero__cta-button', '.hero__cta-subtext'], {
					duration: 0.5,
					opacity: 1,
					stagger: 0.25,
					y: 0,
				} );
			}, 2000 );
		}, 250 );

		this.wordCycler = setInterval( () => {
			this.cycleTheWord();
		}, 7500 );
	}

	setupLetters() {
		this.headlineWords.forEach( ( word ) => {
			Helpers.spanWordLetters( word );
		} );
	}

	showFirstWord() {
		const firstWord = this.headlineWords[0];
		const firstWordSpans = firstWord.querySelectorAll( 'span' );

		gsap.to(
			firstWordSpans, {
				duration: 0.2,
				opacity: 1,
				stagger: 0.1,
				y: 0,
			},
		);

		this.visibleWord = firstWord;
	}

	cycleTheWord() {
		this.nextWord = this.visibleWord.nextElementSibling || this.headlineWords[0];

		const animateUp = this.visibleWord.querySelectorAll( 'span' );
		const animateIn = this.nextWord.querySelectorAll( 'span' );
		const wordTL = gsap.timeline();

		wordTL.to(
			animateUp,
			{
				duration: 0.15,
				opacity: 0,
				stagger: 0.05,
				y: -125, // eslint-disable-line
			},
		);

		wordTL.to( animateIn, {
			duration: 0.2,
			ease: Back,
			opacity: 1,
			stagger: 0.1,
			y: 0,
		} );

		wordTL.to( animateUp, {
			duration: 0.01,
			stagger: 0.001,
			y: 125,
		} );

		this.visibleWord = this.nextWord;
	}
}

export default Home;
