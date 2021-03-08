<?php
/**
 * Custom Colors
 *
 * Adds color settings to Customizer and generates color CSS code
 *
 * @package Poseidon Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom Colors Class
 */
class Poseidon_Pro_Custom_Colors {

	/**
	 * Custom Colors Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Poseidon Theme is not active.
		if ( ! current_theme_supports( 'poseidon-pro' ) ) {
			return;
		}

		// Add Custom Color CSS code to custom stylesheet output.
		add_filter( 'poseidon_pro_custom_css_stylesheet', array( __CLASS__, 'custom_colors_css' ) );

		// Add Custom Color Settings.
		add_action( 'customize_register', array( __CLASS__, 'color_settings' ) );
	}

	/**
	 * Adds Color CSS styles in the head area to override default colors
	 *
	 * @param String $custom_css Custom Styling CSS.
	 * @return string CSS code
	 */
	static function custom_colors_css( $custom_css ) {

		// Get Theme Options from Database.
		$theme_options = Poseidon_Pro_Customizer::get_theme_options();

		// Get Default Fonts from settings.
		$default_options = Poseidon_Pro_Customizer::get_default_options();

		// Color Variables.
		$color_variables = '';

		// Set Link Color.
		if ( $theme_options['link_color'] !== $default_options['link_color'] ) {
			$color_variables .= '--link-color: ' . $theme_options['link_color'] . ';';
			$color_variables .= '--button-color: ' . $theme_options['link_color'] . ';';

			// Check if a light background color was chosen.
			if ( self::is_color_light( $theme_options['link_color'] ) ) {
				$color_variables .= '--button-text-color: #111;';
			}
		}

		// Set Primary Post Color.
		if ( $theme_options['post_primary_color'] !== $default_options['post_primary_color'] ) {
			$color_variables .= '--title-color: ' . $theme_options['post_primary_color'] . ';';
			$color_variables .= '--site-title-color: ' . $theme_options['post_primary_color'] . ';';
		}

		// Set Secondary Post Color.
		if ( $theme_options['post_secondary_color'] !== $default_options['post_secondary_color'] ) {
			$color_variables .= '--title-hover-color: ' . $theme_options['post_secondary_color'] . ';';
			$color_variables .= '--site-title-hover-color: ' . $theme_options['post_secondary_color'] . ';';
			$color_variables .= '--widget-title-hover-color: ' . $theme_options['post_secondary_color'] . ';';
		}

		// Set Top Navigation Color.
		if ( $theme_options['top_navi_color'] !== $default_options['top_navi_color'] ) {
			$color_variables .= '--header-bar-background-color: ' . $theme_options['top_navi_color'] . ';';

			// Check if a light background color was chosen.
			if ( self::is_color_light( $theme_options['top_navi_color'] ) ) {
				$color_variables .= '--header-bar-text-color: #111;';
				$color_variables .= '--header-bar-text-hover-color: rgba(0, 0, 0, 0.5);';
				$color_variables .= '--header-bar-border-color: rgba(0, 0, 0, 0.15);';
			}
		}

		// Set Header Color.
		if ( $theme_options['header_color'] !== $default_options['header_color'] ) {
			$color_variables .= '--header-background-color: ' . $theme_options['header_color'] . ';';
			$color_variables .= '--navi-submenu-color: ' . $theme_options['header_color'] . ';';
			$color_variables .= '--site-title-color: #404040;';
			$color_variables .= '--site-title-hover-color: rgba(0, 0, 0, 0.5);';
			$color_variables .= '--navi-border-color: rgba(0, 0, 0, 0.1);';

			// Check if a dark background color was chosen.
			if ( self::is_color_dark( $theme_options['header_color'] ) ) {
				$color_variables .= '--site-title-color: #fff;';
				$color_variables .= '--site-title-hover-color: rgba(255, 255, 255, 0.5);';
				$color_variables .= '--navi-border-color: rgba(255, 255, 255, 0.1);';
			}
		}

		// Set Primary Navigation Color.
		if ( $theme_options['navi_primary_color'] !== $default_options['navi_primary_color'] ) {
			$color_variables .= '--navi-color: ' . $theme_options['navi_primary_color'] . ';';
		}

		// Set Secondary Navigation Color.
		if ( $theme_options['navi_secondary_color'] !== $default_options['navi_secondary_color'] ) {
			$color_variables .= '--navi-hover-color: ' . $theme_options['navi_secondary_color'] . ';';
		}

		// Set Widget Title Color.
		if ( $theme_options['widget_title_color'] !== $default_options['widget_title_color'] ) {
			$color_variables .= '--widget-title-color: ' . $theme_options['widget_title_color'] . ';';
		}

		// Set Footer Widgets Color.
		if ( $theme_options['footer_color'] !== $default_options['footer_color'] ) {
			$color_variables .= '--footer-widgets-background-color: ' . $theme_options['footer_color'] . ';';

			// Check if a light background color was chosen.
			if ( self::is_color_light( $theme_options['footer_color'] ) ) {
				$color_variables .= '--footer-widgets-text-color: rgba(0, 0, 0, 0.5);';
				$color_variables .= '--footer-widgets-link-color: #111;';
				$color_variables .= '--footer-widgets-link-hover-color: rgba(0, 0, 0, 0.5);';
				$color_variables .= '--footer-widgets-border-color: rgba(0, 0, 0, 0.08);';
			}
		}

		// Set Color Variables.
		if ( '' !== $color_variables ) {
			$custom_css .= ':root {' . $color_variables . '}';
		}

		return $custom_css;
	}

	/**
	 * Adds all color settings in the Customizer
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function color_settings( $wp_customize ) {

		// Add Section for Theme Colors.
		$wp_customize->add_section( 'poseidon_pro_section_colors', array(
			'title'    => __( 'Theme Colors', 'poseidon-pro' ),
			'priority' => 70,
			'panel'    => 'poseidon_options_panel',
		) );

		// Get Default Colors from settings.
		$default_options = Poseidon_Pro_Customizer::get_default_options();

		// Add Top Navigation Color setting.
		$wp_customize->add_setting( 'poseidon_theme_options[top_navi_color]', array(
			'default'           => $default_options['top_navi_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'poseidon_theme_options[top_navi_color]', array(
				'label'    => _x( 'Top Navigation', 'color setting', 'poseidon-pro' ),
				'section'  => 'poseidon_pro_section_colors',
				'settings' => 'poseidon_theme_options[top_navi_color]',
				'priority' => 10,
			)
		) );

		// Add Header Color setting.
		$wp_customize->add_setting( 'poseidon_theme_options[header_color]', array(
			'default'           => $default_options['header_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'poseidon_theme_options[header_color]', array(
				'label'    => _x( 'Header', 'color setting', 'poseidon-pro' ),
				'section'  => 'poseidon_pro_section_colors',
				'settings' => 'poseidon_theme_options[header_color]',
				'priority' => 20,
			)
		) );

		// Add Navigation Primary Color setting.
		$wp_customize->add_setting( 'poseidon_theme_options[navi_primary_color]', array(
			'default'           => $default_options['navi_primary_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'poseidon_theme_options[navi_primary_color]', array(
				'label'    => _x( 'Navigation (primary)', 'color setting', 'poseidon-pro' ),
				'section'  => 'poseidon_pro_section_colors',
				'settings' => 'poseidon_theme_options[navi_primary_color]',
				'priority' => 30,
			)
		) );

		// Add Navigation Secondary Color setting.
		$wp_customize->add_setting( 'poseidon_theme_options[navi_secondary_color]', array(
			'default'           => $default_options['navi_secondary_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'poseidon_theme_options[navi_secondary_color]', array(
				'label'    => _x( 'Navigation (secondary)', 'color setting', 'poseidon-pro' ),
				'section'  => 'poseidon_pro_section_colors',
				'settings' => 'poseidon_theme_options[navi_secondary_color]',
				'priority' => 40,
			)
		) );

		// Add Post Primary Color setting.
		$wp_customize->add_setting( 'poseidon_theme_options[post_primary_color]', array(
			'default'           => $default_options['post_primary_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'poseidon_theme_options[post_primary_color]', array(
				'label'    => _x( 'Post Titles (primary)', 'color setting', 'poseidon-pro' ),
				'section'  => 'poseidon_pro_section_colors',
				'settings' => 'poseidon_theme_options[post_primary_color]',
				'priority' => 50,
			)
		) );

		// Add Post Secondary Color setting.
		$wp_customize->add_setting( 'poseidon_theme_options[post_secondary_color]', array(
			'default'           => $default_options['post_secondary_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'poseidon_theme_options[post_secondary_color]', array(
				'label'    => _x( 'Post Titles (secondary)', 'color setting', 'poseidon-pro' ),
				'section'  => 'poseidon_pro_section_colors',
				'settings' => 'poseidon_theme_options[post_secondary_color]',
				'priority' => 60,
			)
		) );

		// Add Link and Button Color setting.
		$wp_customize->add_setting( 'poseidon_theme_options[link_color]', array(
			'default'           => $default_options['link_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'poseidon_theme_options[link_color]', array(
				'label'    => _x( 'Links and Buttons', 'color setting', 'poseidon-pro' ),
				'section'  => 'poseidon_pro_section_colors',
				'settings' => 'poseidon_theme_options[link_color]',
				'priority' => 70,
			)
		) );

		// Add Widget Title Color setting.
		$wp_customize->add_setting( 'poseidon_theme_options[widget_title_color]', array(
			'default'           => $default_options['widget_title_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'poseidon_theme_options[widget_title_color]', array(
				'label'    => _x( 'Widget Titles', 'color setting', 'poseidon-pro' ),
				'section'  => 'poseidon_pro_section_colors',
				'settings' => 'poseidon_theme_options[widget_title_color]',
				'priority' => 80,
			)
		) );

		// Add Footer Widgets Color setting.
		$wp_customize->add_setting( 'poseidon_theme_options[footer_color]', array(
			'default'           => $default_options['footer_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'poseidon_theme_options[footer_color]', array(
				'label'    => _x( 'Footer Widgets', 'color setting', 'poseidon-pro' ),
				'section'  => 'poseidon_pro_section_colors',
				'settings' => 'poseidon_theme_options[footer_color]',
				'priority' => 90,
			)
		) );
	}

	/**
	 * Returns color brightness.
	 *
	 * @param int Number of brightness.
	 */
	static function get_color_brightness( $hex_color ) {

		// Remove # string.
		$hex_color = str_replace( '#', '', $hex_color );

		// Convert into RGB.
		$r = hexdec( substr( $hex_color, 0, 2 ) );
		$g = hexdec( substr( $hex_color, 2, 2 ) );
		$b = hexdec( substr( $hex_color, 4, 2 ) );

		return ( ( ( $r * 299 ) + ( $g * 587 ) + ( $b * 114 ) ) / 1000 );
	}

	/**
	 * Check if the color is light.
	 *
	 * @param bool True if color is light.
	 */
	static function is_color_light( $hex_color ) {
		return ( self::get_color_brightness( $hex_color ) > 130 );
	}

	/**
	 * Check if the color is dark.
	 *
	 * @param bool True if color is dark.
	 */
	static function is_color_dark( $hex_color ) {
		return ( self::get_color_brightness( $hex_color ) <= 130 );
	}
}

// Run Class.
add_action( 'init', array( 'Poseidon_Pro_Custom_Colors', 'setup' ) );
