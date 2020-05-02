import gsap from 'gsap';

const debounce = require( 'lodash.debounce' );

class Scrollers {
	constructor() {
		this.faders = document.querySelectorAll( '.scroll-revealer--fade-up' );
		this.headlines = document.querySelectorAll( '.colored-headline' );
	}

	run() {
		if ( this.faders ) {
			this.fadeUpElements();

			window.addEventListener(
				'scroll',
				debounce( this.fadeUpElements.bind( this ), 250 ),
			);
		}

		if ( this.headlines ) {
			this.colorHeadlines();

			window.addEventListener(
				'scroll',
				debounce( this.colorHeadlines.bind( this ), 250 ),
			);
		}
	}

	static checkVisibility( element, ratio ) {
		// get window height
		const windowHeight = window.innerHeight;

		// get element height & top position
		const elPos = element.getBoundingClientRect();
		const elTop = elPos.top;
		const elHeight = elPos.height;

		return ( windowHeight - elTop ) >= ( elHeight * ratio );
	}

	fadeUpElements() {
		this.faders.forEach( ( fader ) => {
			if ( ! fader.classList.contains( '.scroll-revealer--displayed' ) ) {
				const isVisible = this.constructor.checkVisibility( fader, 0.25 );

				if ( isVisible ) {
					fader.classList.add( 'scroll-revealer--displayed' );

					gsap.to( fader, {
						duration: 0.5,
						opacity: 1,
						y: 0,
					} );
				}
			}
		} );
	}

	colorHeadlines() {
		this.headlines.forEach( ( headline ) => {
			if ( ! headline.classList.contains( 'color-headline--no-scroll' ) && ! headline.classList.contains( 'color-headline--displayed' ) ) {
				const isVisible = this.constructor.checkVisibility( headline, 0.25 );

				if ( isVisible ) {
					headline.classList.add( 'color-headline--displayed' );

					const headlineTL = gsap.timeline();
					const content = headline.querySelector( '.colored-headline__content' );
					const background = headline.querySelector( '.colored-headline__background' );

					headlineTL.to( background, {
						scale: 1,
						duration: 0.4,
					} );

					headlineTL.to( content, {
						duration: 0.4,
						y: 0,
						opacity: 1,
					} );
				}
			}
		} );
	}
}

export default Scrollers;
