<?php
/**
 * Header Search
 *
 * Displays header search in main navigation menu
 *
 * @package Poseidon Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Header Search Class
 */
class Poseidon_Pro_Header_Search {

	/**
	 * Header Search Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Poseidon Theme is not active.
		if ( ! current_theme_supports( 'poseidon-pro' ) ) {
			return;
		}

		// Enqueue Header Search JavaScript.
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_script' ) );

		// Add search icon on main navigation menu.
		add_filter( 'wp_nav_menu_items', array( __CLASS__, 'add_header_search' ), 10, 2 );

		// Add Header Search checkbox in Customizer.
		add_action( 'customize_register', array( __CLASS__, 'header_search_settings' ) );

		// Hide Header Search if disabled.
		add_filter( 'poseidon_hide_elements', array( __CLASS__, 'hide_header_search' ) );
	}

	/**
	 * Enqueue Scroll-To-Top JavaScript
	 *
	 * @return void
	 */
	static function enqueue_script() {

		// Get Theme Options from Database.
		$theme_options = Poseidon_Pro_Customizer::get_theme_options();

		// Embed header search JS if enabled.
		if ( ( true === $theme_options['header_search'] || is_customize_preview() ) && ! self::is_amp() ) :

			wp_enqueue_script( 'poseidon-pro-header-search', POSEIDON_PRO_PLUGIN_URL . 'assets/js/header-search.min.js', array( 'jquery' ), '20210212', true );

		endif;
	}

	/**
	 * Add search form to navigation menu
	 *
	 * @return void
	 */
	static function add_header_search( $items, $args ) {

		// Return early if not main navigation.
		if ( 'primary' !== $args->theme_location ) {
			return $items;
		}

		// Get Theme Options from Database.
		$theme_options = Poseidon_Pro_Customizer::get_theme_options();

		// Show header search if activated.
		if ( true === $theme_options['header_search'] || is_customize_preview() ) :

			$items .= '<li class="header-search menu-item menu-item-search">';
			$items .= '<a class="header-search-icon" aria-expanded="false" ' . self::amp_search_toggle() . '>';
			$items .= '<span class="genericon-search"></span>';
			$items .= '<span class="screen-reader-text">' . esc_html_x( 'Search', 'poseidon-pro' ) . '</span>';
			$items .= '</a>';
			$items .= '<div class="header-search-form" ' . self::amp_search_is_toggled() . '>';
			$items .= get_search_form( false );
			$items .= '</div>';
			$items .= '</li>';

		endif;

		return $items;
	}

	/**
	 * Adds header search checkbox setting
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function header_search_settings( $wp_customize ) {

		// Add Header Search Headline.
		$wp_customize->add_control( new Poseidon_Customize_Header_Control(
			$wp_customize, 'poseidon_theme_options[header_search_title]', array(
				'label'    => esc_html__( 'Header Search', 'poseidon-pro' ),
				'section'  => 'poseidon_pro_section_header',
				'settings' => array(),
				'priority' => 30,
			)
		) );

		// Add Header Search setting and control.
		$wp_customize->add_setting( 'poseidon_theme_options[header_search]', array(
			'default'           => false,
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'poseidon_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'poseidon_theme_options[header_search]', array(
			'label'    => esc_html__( 'Enable search field in main navigation', 'poseidon-pro' ),
			'section'  => 'poseidon_pro_section_header',
			'settings' => 'poseidon_theme_options[header_search]',
			'type'     => 'checkbox',
			'priority' => 40,
		) );
	}

	/**
	 * Hide Header Search if deactivated.
	 *
	 * @param array $elements / Elements to be hidden.
	 * @return array $elements
	 */
	static function hide_header_search( $elements ) {

		// Get Theme Options from Database.
		$theme_options = Poseidon_Pro_Customizer::get_theme_options();

		// Hide Header Search?
		if ( false === $theme_options['header_search'] ) {
			$elements[] = '.primary-navigation .main-navigation li.header-search';
		}

		return $elements;
	}

	/**
	 * Checks if AMP page is rendered.
	 */
	static function is_amp() {
		return function_exists( 'is_amp_endpoint' ) && is_amp_endpoint();
	}

	/**
	 * Adds amp support for search toggle.
	 */
	static function amp_search_toggle() {
		if ( self::is_amp() ) {
			return "[aria-expanded]=\"headerSearchExpanded? 'true' : 'false'\" on=\"tap:AMP.setState({headerSearchExpanded: !headerSearchExpanded})\"";
		}
	}

	/**
	 * Adds amp support for search form.
	 */
	static function amp_search_is_toggled() {
		if ( self::is_amp() ) {
			return "[class]=\"'header-search-form' + ( headerSearchExpanded ? ' toggled-on' : '' )\"";
		}
	}
}

// Run Class.
add_action( 'init', array( 'Poseidon_Pro_Header_Search', 'setup' ) );
