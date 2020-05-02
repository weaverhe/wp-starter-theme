import gsap from 'gsap';

class Navigation {
	constructor() {
		this.navicon = document.querySelector( '.navicon' );
		this.nav = document.getElementById( 'primary-navigation' );
		this.navContent = document.querySelector( '.nav__content' );
		this.navItems = document.querySelectorAll( '.nav-item--text, .nav__content .sub-menu' );
	}

	run() {
		this.navToggle();
	}

	navToggle() {
		this.navicon.addEventListener( 'click', ( e ) => {
			e.preventDefault();

			// navicon classes for CSS animation
			this.navicon.classList.toggle( 'navicon--closed' );
			this.navicon.classList.toggle( 'navicon--open' );

			// toggle locked class on body (no scroll while menu open)
			document.querySelector( 'html' ).classList.toggle( 'overlay--visible' );

			// opening menu animations
			if ( this.navicon.classList.contains( 'navicon--open' ) ) {
				if ( window.matchMedia( '(min-width:800px)' ).matches ) {
					gsap.to( this.nav, {
						width: '100%',
						duration: 0.5,
					} );
				} else {
					gsap.to( this.nav, {
						width: '100%',
						bottom: 0,
						height: '100%',
						duration: 0.5,
					} );
				}

				setTimeout( () => {
					this.navContent.style.display = 'flex';
				}, 500 );

				setTimeout( () => {
					gsap.to( this.navItems, {
						y: 0,
						opacity: 1,
						duration: 0.4,
						stagger: 0.15,
					} );
				}, 500 );
			} else {
				this.navContent.style.display = 'none';

				if ( window.matchMedia( '(min-width:800px)' ).matches ) {
					gsap.to( this.nav, {
						width: '60px',
						duration: 0.5,
					} );
				} else {
					gsap.to( this.nav, {
						bottom: 'auto',
						height: '50px',
						duration: 0.5,
					} );
				}

				// reset nav item styles
				gsap.to( this.navItems, {
					y: 100,
					opacity: 0,
					duration: 0.01,
				} );
			}
		} );
	}
}

export default Navigation;
