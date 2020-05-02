import Helpers from './Helpers';

class Forms {
	constructor() {
		this.forms = document.querySelectorAll( 'form' );
		this.formInputFields = document.querySelectorAll( '.form__input--text' );
		this.ppBoxes = document.querySelectorAll( 'input[name="PPCOMPLIANCE"]' );
	}

	run() {
		this.formInputs();
		this.privacyCheckbox();
	}

	static fieldFocus( input ) {
		const parent = input.parentNode;

		parent.classList.add( 'form__input--filled' );
	}

	static fieldBlur( input ) {
		const { value } = input;
		const parent = input.parentNode;

		if ( value.length === 0 ) {
			parent.classList.remove( 'form__input--filled' );
		}
	}

	formInputs() {
		this.formInputFields.forEach( ( field ) => {
			field.addEventListener( 'focus', () => {
				this.constructor.fieldFocus( field );
			} );

			field.addEventListener( 'blur', () => {
				this.constructor.fieldBlur( field );
			} );
		} );
	}

	privacyCheckbox() {
		this.ppBoxes.forEach( ( box ) => {
			box.addEventListener( 'change', () => {
				const parentForm = Helpers.getClosest( box, 'form' );
				const submit = parentForm.querySelector( 'button' );

				submit.disabled = ! box.checked;
			} );
		} );
	}
}

export default Forms;
