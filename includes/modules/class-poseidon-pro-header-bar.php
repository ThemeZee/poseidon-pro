<?php
/***
 * Footer Widgets
 *
 * Registers footer widget areas and hooks into the Poseidon theme to display widgets
 *
 * @package Poseidon Pro
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Use class to avoid namespace collisions
if ( ! class_exists( 'Poseidon_Pro_Header_Bar' ) ) :

class Poseidon_Pro_Header_Bar {

	/**
	 * Footer Widgets Setup
	 *
	 * @return void
	*/
	static function setup() {
		
		// Return early if Poseidon Theme is not active
		if ( ! current_theme_supports( 'poseidon-pro'  ) ) {
			return;
		}
		
		// Register widgets in backend
		add_action( 'widgets_init', array( __CLASS__, 'register_widgets' ) );
		
	}
	
	/**
	 * Register all Footer Widget areas
	 *
	 * @return void
	*/
	static function register_widgets() {
	
		// Return early if Poseidon Theme is not active
		if ( ! current_theme_supports( 'poseidon-pro'  ) ) {
			return;
		}
		
	}

}

// Run Class
add_action( 'init', array( 'Poseidon_Pro_Header_Bar', 'setup' ) );

endif;