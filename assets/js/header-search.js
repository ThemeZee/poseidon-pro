/**
 * Header Search JS
 *
 * @package Poseidon Pro
 */

( function( $ ) {

	$( document ).ready( function() {

		/* Display Search Form when search icon is clicked */
		$( '#site-navigation li.header-search a.header-search-icon' ).on( 'click', function() {
			$( '#site-navigation .header-search .header-search-form' ).toggle().find( '.search-form .search-field' ).focus();
			$( this ).toggleClass( 'active' );
		});

		/* Do not close search form if click is inside header search element */
		$( '#site-navigation li.header-search' ).click( function(e) {
			e.stopPropagation();
		});

		/* Close search form if click is outside header search element */
		$( document ).click( function() {
			$( '#site-navigation .header-search .header-search-form' ).hide();
		});
	} );

} )( jQuery );
