const formFieldFilled = function(e) {
	// field just blurred
	let field = e.srcElement;
	// value of field
	let fieldVal = field.value;
	// find parent of field ('.input')
	let parent = field.parentNode;

	if(e.type === 'focus') {
		addClass(parent, 'input--filled');
	}

	// check if any characters have been entered (length > 0)
	if(e.type === 'blur' && fieldVal.length === 0) {
		// add input--filled class to parent
		removeClass(parent, 'input--filled');
	}
};


/* Master Function to set event listeners calling functions above */
const formActions = function() {
	// set formFieldFilled event listener for all fancy form inputs
	let fillableInputs = document.querySelectorAll('.form--fancy input');
	fillableInputs.forEach((el) => {
		el.addEventListener('focus', formFieldFilled);	
		el.addEventListener('blur', formFieldFilled);	
	});
};