<?php
/**
 * Customizer
 *
 * Setup the Customizer and theme options for the Pro plugin
 *
 * @package Poseidon Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizer Class
 */
class Poseidon_Pro_Customizer {

	/**
	 * Customizer Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Poseidon Theme is not active.
		if ( ! current_theme_supports( 'poseidon-pro' ) ) {
			return;
		}

		// Enqueue scripts and styles in the Customizer.
		add_action( 'customize_preview_init', array( __CLASS__, 'customize_preview_js' ) );
		add_action( 'customize_controls_print_styles', array( __CLASS__, 'customize_preview_css' ) );

		// Remove Upgrade section.
		remove_action( 'customize_register', 'poseidon_customize_register_upgrade_settings' );
	}

	/**
	 * Get saved user settings from database or plugin defaults
	 *
	 * @return array
	 */
	static function get_theme_options() {

		// Merge Theme Options Array from Database with Default Options Array.
		return wp_parse_args( get_option( 'poseidon_theme_options', array() ), self::get_default_options() );
	}


	/**
	 * Returns the default settings of the plugin
	 *
	 * @return array
	 */
	static function get_default_options() {

		$default_options = array(
			'header_logo'               => '',
			'logo_spacing'              => 10,
			'navi_spacing'              => 10,
			'header_search'             => false,
			'author_bio'                => false,
			'scroll_to_top'             => false,
			'footer_text'               => '',
			'credit_link'               => true,
			'top_navi_color'            => '#404040',
			'header_color'              => '#ffffff',
			'navi_primary_color'        => '#404040',
			'navi_secondary_color'      => '#22aadd',
			'post_primary_color'        => '#404040',
			'post_secondary_color'      => '#22aadd',
			'link_color'                => '#22aadd',
			'widget_title_color'        => '#404040',
			'widget_link_color'         => '#22aadd',
			'footer_color'              => '#404040',
			'text_font'                 => 'Ubuntu',
			'title_font'                => 'Raleway',
			'title_is_bold'             => true,
			'title_is_uppercase'        => false,
			'navi_font'                 => 'Raleway',
			'navi_is_bold'              => true,
			'navi_is_uppercase'         => true,
			'widget_title_font'         => 'Raleway',
			'widget_title_is_bold'      => true,
			'widget_title_is_uppercase' => true,
		);

		return $default_options;
	}

	/**
	 * Embed JS file to make Theme Customizer preview reload changes asynchronously.
	 *
	 * @return void
	 */
	static function customize_preview_js() {
		wp_enqueue_script( 'poseidon-pro-customizer-js', POSEIDON_PRO_PLUGIN_URL . 'assets/js/customizer.js', array( 'customize-preview' ), '20201119', true );
	}

	/**
	 * Embed CSS styles for the theme options in the Customizer
	 *
	 * @return void
	 */
	static function customize_preview_css() {
		wp_enqueue_style( 'poseidon-pro-customizer-css', POSEIDON_PRO_PLUGIN_URL . 'assets/css/customizer.css', array(), '20201119' );
	}
}

// Run Class.
add_action( 'init', array( 'Poseidon_Pro_Customizer', 'setup' ) );
