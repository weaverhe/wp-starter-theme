import $ from 'jquery';

import Helpers from './Helpers';

class Mailchimp {
	constructor() {
		this.errorMessage = '';
		this.forms = document.querySelectorAll( '.newsletter-form__form' );
	}

	run() {
		this.forms.forEach( ( form ) => {
			this.handleSubmission( form );
		} );
	}

	handleSubmission( form ) {
		form.addEventListener( 'submit', ( e ) => {
			e.preventDefault();

			const errorMessage = form.querySelector( '.form__message' );
			errorMessage.classList.remove( 'form__message--error' );
			errorMessage.querySelector( 'p' ).innerText = '';

			if ( this.validateForm( form ) ) {
				this.constructor.submitMailchimp( form );
			} else {
				errorMessage.classList.add( 'form__message--error' );
				errorMessage.querySelector( 'p' ).innerText = this.errorMessage;
			}
		} );
	}

	validateForm( form ) {
		const validEmail = Helpers.validateEmail( form.querySelector( 'input[type="email"]' ).value );
		const validName = Helpers.validateText( form.querySelector( 'input[name="NAME"]' ).value );

		if ( validName && ! validEmail ) {
			this.errorMessage = 'Uh-oh. Seems to be an issue with your email address.';
		} else if ( validEmail && ! validName ) {
			this.errorMessage = 'Hm. Please give me a name, and then try subscribing.';
		} else if ( ! validEmail && ! validName ) {
			this.errorMessage = 'Errr. Seems to be missing a name and valid email.';
		}

		return validEmail && validName;
	}

	static submitMailchimp( form ) {
		const email = form.querySelector( 'input[type="email"]' ).value;
		const fname = form.querySelector( 'input[name="NAME"]' ).value;
		const action = '/wp-content/themes/hw-portfolio-theme/inc/mailchimp-submit.php';

		$.ajax( {
			url: action,
			method: 'POST',
			data: {
				email,
				fname,
			},
			success: ( res ) => {
				const messageHolder = form.querySelector( '.form__message' );
				const messageTextHolder = messageHolder.querySelector( 'p' );

				messageHolder.classList.add( 'form__message--success' );
				messageTextHolder.innerText = 'Thanks for subscribing! A confirmation email is headed your way.';

				$( form ).find( 'button, .form__field-group' ).remove();

				return true;
			},
			error: ( err ) => {
				console.error( err );
			},
		} );
	}
}

export default Mailchimp;
