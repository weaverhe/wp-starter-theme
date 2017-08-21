function addClass(elements, newClass) {
	// if there are no elements, end function
	if (!elements) return;

	// if we have a selector, get the chosen elements
	if(typeof(elements) === 'string') {
		elements = document.querySelectorAll(elements);
	}

	// if we have a single DOM element, make it an array to simplify behavior
	else if(elements.tagName) {
		elements=[elements];
	}

	// add class to all chosen elements
	elements.forEach((el) => {
		el.classList.add(newClass);
	});
}

function removeClass(elements, newClass) {
	// if there are no elements, end function
	if (!elements) return;

	// if we have a selector, get the chosen elements
	if(typeof(elements) === 'string') {
		elements = document.querySelectorAll(elements);
	}

	// if we have a single DOM element, make it an array to simplify behavior
	else if(elements.tagName) {
		elements=[elements];
	}

	// add class to all chosen elements
	elements.forEach((el) => {
		el.classList.remove(newClass);
	});
}