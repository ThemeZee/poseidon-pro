/**
 * Header Search JS
 *
 * @package Poseidon Pro
 */

( function() {

	document.addEventListener( 'DOMContentLoaded', function() {
		var headerSearch = document.querySelector( '#site-navigation .header-search' );

		// Return early if header search is missing.
		if ( headerSearch === null ) {
			return;
		}

		// Find header search elements.
		var searchIcon = headerSearch.querySelector( '.header-search-icon' );
		var searchForm = headerSearch.querySelector( '.header-search-form' );

		// Display Search Form when search icon is clicked.
		searchIcon.addEventListener( 'click', function() {
			searchForm.classList.toggle( 'toggled-on' );
			searchForm.querySelector( '.search-form .search-field' ).focus();
			searchIcon.setAttribute( 'aria-expanded', searchForm.classList.contains( 'toggled-on' ) );
		});

		// Do not close search form if click is inside header search element.
		headerSearch.addEventListener( 'click', function(e) {
			e.stopPropagation();
		});

		// Close search form if click is outside header search element.
		document.addEventListener( 'click', function() {
			searchForm.classList.remove( 'toggled-on' );
			searchIcon.setAttribute( 'aria-expanded', 'false' );
		});
	} );

} )();
