let lazyObserver,
	imageCount;

/*****
*
* Master Functions
*
*****/

// master lazy loader function, to set up the observer && observe the appropriate images
const lazyLoad = function() {
	// get all of the images marked up to lazy load
	const images = document.querySelectorAll('.lazy-load');

	// config for the observer
	const config = {
		rootMargin: '50px 0px', // if img gets within 50px of viewport, start the download
		threshold: 0.01
	};

	// init variables
	imageCount = images.length;

	if(!('IntersectionObserver' in window)) {
		$('.lazy-load').unveil();
	} else {
		// init observer
		lazyObserver = new IntersectionObserver(onIntersection, config);
		// observer all images w/ class
		images.forEach(image => {
			if(image.classList.contains('lazy-load--handled')) {
				return;
			}

			lazyObserver.observe(image);
		});
	}
};

// handle intersections
const onIntersection = function(entries) {
	// disconnect if we've already loaded all images
	if(imageCount === 0) {
		lazyObserver.disconnect();
	}

	// loop through the entries
	entries.forEach(entry => {
		// check if in viewport
		if(entry.intersectionRatio > 0) {
			imageCount--;
			// stop watching
			lazyObserver.unobserve(entry.target);
			// load the image
			preloadImage(entry.target);
		}
	});
};

/******
*
* Image Loading Utility Functions
*
******/

// fetches the image for the given URL
const fetchImage = function(url) {
	return new Promise((resolve,reject) => {
		const image = new Image();
		image.src = url;
		image.onload = resolve;
		image.onerror = reject;
	});
};

// preloads the image
const preloadImage = function(image) {
	const src = image.dataset.src;

	if(!src) return;

	// get and load the image based on the data-src provided in markup
	return fetchImage(src).then(() => {
		applyLoadedClass(image, src);
	});
};

// load all images immediately (fallback when lacking browser support)
const loadImagesImmediately = function(images) {
	Array.from(images).forEach(image => preloadImage(image));
};

// apply the class to prevent image from being loaded a second time
function applyLoadedClass(img, src) {
	addClass(img, 'lazy-load--handled');
	img.src = src;
	addClass(img, 'fade-in');
}

/*****
*
* Observer Utilities
*
*****/

// disconnect the observer
const disconnectObserver = function() {
	if(!lazyObserver) return;

	lazyObserver.disconnect();
};