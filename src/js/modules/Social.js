class Social {
	constructor() {
		this.shareLinkContainer = document.querySelector( '.social-share-link-container' );
		this.shareLinks = this.shareLinkContainer.querySelectorAll( 'a' );
	}

	run() {
		this.socialLinks();
	}

	socialLinks() {
		this.shareLinks.forEach( ( link ) => {
			link.addEventListener( 'click', ( e ) => {
				e.preventDefault();

				const url = link.href;

				this.constructor.openSocialLink( url );
			} );
		} );
	}

	static openSocialLink( url ) {
		const docWidth = window.innerWidth
						|| document.documentElement.clientWidth
						|| document.body.clientWidth;
		const docHeight = window.innerHeight
						|| document.documentElement.clientHeight
						|| document.body.clientHeight;

		let popWidth = 600;
		let popHeight = 400;

		if ( docWidth < 768 ) {
			popWidth = docWidth * 0.8;
			popHeight = docHeight * 0.8;
		}

		const leftPos = ( docWidth / 2 ) - ( popWidth / 2 );
		const topPos = ( docHeight / 2 ) - ( popHeight / 2 );

		window.open( url, '', `menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=${popWidth},height=${popHeight},top=${topPos},left=${leftPos}` );
	}
}

export default Social;
