/**
 * Scroll to Top JS
 *
 * Shows Scroll to Top Button
 *
 * @package Poseidon Pro
 */

 ( function() {

	/**--------------------------------------------------------------
	# Scroll to Top Feature
	--------------------------------------------------------------*/
	function scrollToTop( scrollButton ) {
		// Return early if scroll button is missing.
		if ( scrollButton === null ) {
			return;
		}

		// Show Button on scroll down.
		var showButton = function() {
			var window_top =  window.pageYOffset | document.body.scrollTop;

			if ( window_top > 150 ) {
				scrollButton.classList.add( 'visible' );
			} else {
				scrollButton.classList.remove( 'visible' );
			}
		}

		// Call Show Button function on scrolling window event.
		showButton();
		window.onscroll = function() {
			showButton();
		}

		// Scroll up when Button is clicked.
		scrollButton.addEventListener( 'click', function() {
			window.scrollTo({
				top: 0,
				behavior: 'smooth'
			});
			return false;
		} );
	};

	/**--------------------------------------------------------------
	# Setup Scroll Button
	--------------------------------------------------------------*/
	document.addEventListener( 'DOMContentLoaded', function() {
		// Create Scroll to Top button.
		var scrollButton = document.createElement( 'button' );
		scrollButton.setAttribute( 'id', 'scroll-to-top' );
		scrollButton.classList.add( 'scroll-to-top-button' );

		// Add icon to Scroll to Top button.
		var icon = new DOMParser().parseFromString( poseidonProScrollToTop.icon, 'text/html' ).body.firstElementChild;
		scrollButton.appendChild( icon);

		// Add Button to HTML DOM.
		document.body.appendChild( scrollButton );

		// Add Scroll To Top Functionality.
		scrollToTop( scrollButton );
	} );
} )();
