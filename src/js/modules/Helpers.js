class Helpers {
	static getClosest( elem, selector ) {
		// Element.matches() polyfill
		if ( ! Element.prototype.matches ) {
			Element.prototype.matches = Element.prototype.matchesSelector
				|| Element.prototype.mozMatchesSelector
				|| Element.prototype.msMatchesSelector
				|| Element.prototype.oMatchesSelector
				|| Element.prototype.webkitMatchesSelector
				|| function ( s ) { // eslint-disable-line
					const matches = ( this.document || this.ownerDocument ).querySelectorAll( s );
					let i = matches.length;
					while ( -- i >= 0 && matches.item( i ) !== this ) {} // eslint-disable-line
					return i > - 1;
				};
		}

		// get closest match
		for ( ; elem && elem !== document; elem = elem.parentNode ) { // eslint-disable-line
			if ( elem.matches( selector ) ) return elem;
		}

		return null;
	}

	static validateEmail( email ) {
		const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test( email );
	}

	static validateText( text ) {
		return text.length > 0;
	}

	static spanWordLetters( word ) {
		let html = '';
		const wordEl = word;
		const text = wordEl.innerText;
		const letters = text.split( '' );

		letters.forEach( ( letter ) => {
			html = `${html}<span>${letter}</span>`;
		} );

		wordEl.innerHTML = html;
	}
}

export default Helpers;
