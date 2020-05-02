import mixitup from 'mixitup';

class WorkHome {
	constructor() {
		this.workMixer = null;
		this.filterToggles = document.querySelectorAll( '.work-filter__content a' );
		this.filterLists = document.querySelectorAll( '.work-filter__list' );
		this.filterLinks = document.querySelectorAll( '.work-filter__filter-link' );
		this.workContainer = document.querySelector( '.work' );
		this.resetLink = document.querySelector( '.filter-reset-link' );
		this.typeSentenceText = document.querySelector( '#project-type-filter span' );
		this.industrySentenceText = document.querySelector( '#project-industry-filter span' );
	}

	run() {
		// show/hide filter lists
		this.filterToggles.forEach( ( toggle ) => {
			toggle.addEventListener( 'click', ( e ) => {
				e.preventDefault();
				this.toggleFilter( toggle );
			} );
		} );

		// init mixitup for the filtering
		this.filterWorkInit();

		// handle clicks on filter links
		this.filterLinks.forEach( ( link ) => {
			link.addEventListener( 'click', ( e ) => {
				e.preventDefault();
				this.filterWork( link );
			} );
		} );

		// reset filter link
		this.resetLink.addEventListener( 'click', ( e ) => {
			e.preventDefault();
			this.resetFilters();
		} );
	}

	toggleFilter( toggle ) {
		const listID = toggle.hash;
		const list = document.querySelector( listID );

		// check if target list is open or closed
		if ( list.classList.contains( 'work-filter__list--hidden' ) ) { // open the list
			// first hide all lists by applying class
			this.filterLists.forEach( ( fList ) => {
				fList.classList.add( 'work-filter__list--hidden' );
			} );

			// remove active class from current active toggle.
			const activeToggle =  document.querySelector( '.work-filter__toggle--active' );

			if ( activeToggle ) {
				activeToggle.classList.remove( 'work-filter__toggle--active' );
			}

			// open the selected list by removing class
			list.classList.remove( 'work-filter__list--hidden' );

			// apply the active class to the clicked toggle
			toggle.classList.add( 'work-filter__toggle--active' );
		} else { // close the list
			list.classList.add( 'work-filter__list--hidden' );
			toggle.classList.remove( 'work-filter__toggle--active' );
		}
	}

	filterWorkInit() {
		this.workMixer = mixitup( '.work', {
			selectors: {
				target: '.featured-project',
			},
			animation: {
				effectsOut: 'fade',
				effectsIn: '',
			},
		} );
	}

	filterWork( filter ) {
		// init variables
		let typeValue = '';
		let typeName = '';
		let typeText = 'all projects';
		let industryValue = '';
		let industryName = '';
		let industryText = 'any industry';

		// first, get the 'type' and value of each filter
		const filterType = filter.getAttribute( 'data-filter' );

		if ( filterType === 'type' ) {
			typeValue = filter.getAttribute( 'data-type' );
			industryValue = this.workContainer.getAttribute( 'data-current-industry' );
		} else {
			typeValue = this.workContainer.getAttribute( 'data-current-type' );
			industryValue = filter.getAttribute( 'data-industry' );
		}

		typeName = typeValue.replace( '-', ' ' );
		industryName = industryValue.replace( '-', ' ' );
		let filterString = '';

		if ( typeValue !== 'all' && industryValue !== 'all' ) {
			filterString = `.${typeValue}.${industryValue}`;
			typeText = `${typeName} projects`;
			industryText = `the ${industryName} industry`;
		} else if ( typeValue !== 'all' ) {
			filterString = `.${typeValue}`;
			typeText = `${typeName} projects`;
		} else if ( industryValue !== 'all' ) {
			filterString = `.${industryValue}`;
			industryText = `the ${industryName} industry`;
		} else {
			filterString = 'all';
		}

		// filter work content.
		this.workMixer
			.filter( filterString )
			.then( ( state ) => {
				if ( state.totalShow === 0 ) {
					this.resetLink.classList.remove( 'filter-reset-link--hidden' );
				}
			} );

		// remove active class from previous filter.
		filter.parentNode.parentNode.querySelector( '.work-filter__list-item--active' ).classList.remove( 'work-filter__list-item--active' );

		// update active class of selected filter
		filter.parentNode.classList.add( 'work-filter__list-item--active' );

		// update the sentence text
		this.typeSentenceText.innerText = typeText;
		this.industrySentenceText.innerText = industryText;

		// save the values to the work container for future reference
		this.workContainer.setAttribute( 'data-current-type', typeValue );
		this.workContainer.setAttribute( 'data-current-industry', industryValue );
	}

	resetFilters() {
		this.workMixer.filter( 'all' );

		// reset filter sentence
		this.typeSentenceText.innerHTML = 'all projects';
		this.industrySentenceText.innerHTML = 'any industry';

		// close filter menus
		this.filterLists.forEach( ( list ) => {
			list.classList.add( 'work-filter__list--hidden' );
		} );

		// reset toggle styles
		document.querySelector( '.work-filter__toggle--active' ).classList.remove( 'work-filter__toggle--active' );

		// update work container data attributes
		this.workContainer.setAttribute( 'data-currenttype', 'all' );
		this.workContainer.setAttribute( 'data-currentindustry', 'all' );

		// hide the reset filter link
		this.resetLink.classList.add( 'filter-reset-link--hidden' );
	}
}

export default WorkHome;
