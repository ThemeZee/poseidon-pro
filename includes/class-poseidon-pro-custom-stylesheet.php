<?php
/***
 * Custom Stylesheet
 *
 * Creates a custom stylesheet including the custom color, custom fonts and header spacing CSS code
 *
 * @package Poseidon Pro
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Use class to avoid namespace collisions
if ( ! class_exists( 'Poseidon_Pro_Custom_Stylesheet' ) ) :

class Poseidon_Pro_Custom_Stylesheet {

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
		
		// Enqueue Custom CSS Stylesheet
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_custom_stylesheet' ), 20 );
		
		// Print Custom CSS in stylesheet
		self::print_custom_css();
		
		// Print custom CSS to wp_head in Customizer for live preview
		add_action( 'wp_head', array( __CLASS__, 'customizer_custom_css' ) );
		
	}
	
	/**
	 * Register and Enqueue Custom CSS Stylesheet
	 *
	 */
	static function enqueue_custom_stylesheet() {
	
		// Do not include stylesheet in Customizer
		if ( is_customize_preview() ) {
			return;
		}

		wp_enqueue_style( 'poseidon-pro-custom-stylesheet', add_query_arg( 'poseidon_pro_custom_css', 1, home_url( '/' ) ) );
		
	}
	
	/**
	 * If the query var is set, print the Custom CSS rules.
	 *
	 */
	static function print_custom_css() {
		
		// Only print CSS if this is a stylesheet request
		if( ! isset( $_GET['poseidon_pro_custom_css'] ) || intval( $_GET['poseidon_pro_custom_css'] ) !== 1 ) {
			return;
		}

		// CSS File Header
		ob_start();
		header( 'Content-type: text/css' );
		
		// Get CSS
		$raw_css = self::get_custom_css();
		
		// Sanitize CSS Code
		$css = wp_kses( $raw_css, array( '\'', '\"' ) );
		$css = str_replace( '&gt;', '>', $css );
		$css = preg_replace( '/\t\t\t\t/', '', $css );
		
		// Print CSS
		echo $css;
		die();
	}
	
	/**
	 * Print Custom CSS in Customizer for live preview
	 *
	 */
	static function customizer_custom_css() {
		
		// Do not include stylesheet in Customizer
		if ( ! is_customize_preview() ) {
			return;
		}
		
		echo '<style type="text/css">';
		echo self::get_custom_css();
		echo '</style>';
		
	}
	
	/**
	 * Get Custom CSS code from other modules
	 *
	 */
	static function get_custom_css() {
		
		// Allow other modules to add CSS code per filter
		return apply_filters( 'poseidon_pro_custom_css_stylesheet', '' );
		
	}

}

// Run Class
add_action( 'init', array( 'Poseidon_Pro_Custom_Stylesheet', 'setup' ) );

endif;