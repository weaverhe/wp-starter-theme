
export const mobileNav = () => {
	// get the relevant elements
	const mobileNavTrigger = document.querySelector( '.nav__mobile-link' );
	const menu = document.querySelector( '.nav--top .nav__menu' );
	const menuItems = Array.prototype.slice.call( menu.querySelectorAll( 'li' ) );

	// setup the timeline
	const menuTL = new TimelineLite( {
		paused: true,
	} );
	menuTL.add( TweenMax.to( menu, 0.5, { x: 0 } ) );
	menuTL.add( TweenMax.staggerTo( menuItems, 0.3, { y: 0, opacity: 1 }, 0.1 ) );

	mobileNavTrigger.addEventListener( 'click', ( e ) => {
		e.preventDefault();

		// handle unopened menus
		if ( ! menu.classList.contains( 'nav__menu--visible' ) ) {
			// open menu
			menuTL.play();
			menu.classList.add( 'nav__menu--visible' );

			// update button
			mobileNavTrigger.setAttribute( 'aria-expanded', true );
			mobileNavTrigger.innerText = 'Close';

			// body class
			document.querySelector( 'body' ).classList.add( 'no-scroll' );
		} else {
			// close menu
			menuTL.reverse();
			menu.classList.remove( 'nav__menu--visible' );

			// update button
			mobileNavTrigger.setAttribute( 'aria-expanded', false );
			mobileNavTrigger.innerText = 'Menu';

			// body class
			document.querySelector( 'body' ).classList.remove( 'no-scroll' );
		}
	} );
};

export const stickNav = () => {
	// console.log( 'running sticky nav' );
};
