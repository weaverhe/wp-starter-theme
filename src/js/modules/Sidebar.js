const debounce = require( 'lodash.debounce' );

class Sidebar {
	constructor() {
		this.sidebar = document.querySelector( '.sidebar' );
		this.toggles = this.sidebar.querySelectorAll( '.sidebar-toggle__header-link' );
		this.postBody = document.querySelector( '.post__body' );
		this.footer = document.querySelector( 'footer' );
	}

	run() {
		this.sidebarToggles();
		window.addEventListener(
			'scroll',
			debounce( this.stickySidebar.bind( this ), 25 ),
		);
	}

	stickySidebar() {
		// get post position
		const postPos = this.postBody.getBoundingClientRect();

		// get sidebar height
		const sidebarHeight = this.sidebar.querySelector( '.sidebar__content' ).getBoundingClientRect().height;

		if ( postPos.top < 0 ) {
			if ( postPos.bottom < sidebarHeight ) {
				this.sidebarBottom();
			} else {
				this.sidebarFixed();
			}
		} else {
			this.sidebarTop();
		}
	}

	sidebarBottom() {
		this.sidebar.classList.add( 'sidebar--bottom' );
		this.sidebar.classList.remove( 'sidebar--fixed' );
		this.sidebar.classList.remove( 'sidebar--top' );
	}

	sidebarFixed() {
		this.sidebar.classList.add( 'sidebar--fixed' );
		this.sidebar.classList.remove( 'sidebar--bottom' );
		this.sidebar.classList.remove( 'sidebar--top' );
	}

	sidebarTop() {
		this.sidebar.classList.add( 'sidebar--top' );
		this.sidebar.classList.remove( 'sidebar--fixed' );
		this.sidebar.classList.remove( 'sidebar--bottom' );
	}

	sidebarToggles() {
		this.toggles.forEach( ( toggle ) => {
			toggle.addEventListener( 'click', ( e ) => {
				e.preventDefault();

				const toggleContainer = toggle.parentNode.parentNode;

				const toggleContent = toggleContainer.querySelector( '.sidebar-toggle__content' );

				if ( toggleContent.classList.contains( 'sidebar-toggle__content--hidden' ) ) {
					toggleContent.classList.remove( 'sidebar-toggle__content--hidden' );
					toggleContent.classList.add( 'sidebar-toggle__content--animate-in' );
					toggle.querySelector( 'i' ).classList.add( 'sidebar-toggle__icon--open' );

					setTimeout( () => {
						toggleContent.classList.remove( 'sidebar-toggle__content--animate-in' );
					}, 500 );
				} else {
					toggleContent.classList.add( 'sidebar-toggle__content--animate-out' );
					toggleContent.classList.add( 'sidebar-toggle__content--hidden' );
					toggle.querySelector( 'i' ).classList.remove( 'sidebar-toggle__icon--open' );

					setTimeout( () => {
						toggleContent.classList.remove( 'sidebar-toggle__content--animate-out' );
					}, 500 );
				}
			} );
		} );
	}
}

export default Sidebar;
