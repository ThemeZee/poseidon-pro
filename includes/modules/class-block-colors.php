<?php
/**
 * Block Colors
 *
 * Adds block color settings to Customizer and generates color CSS code
 *
 * @package Poseidon Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Block Colors Class
 */
class Poseidon_Pro_Block_Colors {

	/**
	 * Block Colors Setup
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
	 * Return colors for Gutenberg Editor.
	 *
	 * @param array $color_palette Default Color Palette.
	 * @return array New Color Palette.
	 */
	static function block_color_palette( $color_palette ) {
		// Get Theme Options from Database.
		$theme_options = Poseidon_Pro_Customizer::get_theme_options();

		// Override default block color palette.
		return array(
			'primary_color'    => sanitize_hex_color( $theme_options['primary_color'] ),
			'secondary_color'  => sanitize_hex_color( $theme_options['secondary_color'] ),
			'tertiary_color'   => sanitize_hex_color( $theme_options['tertiary_color'] ),
			'accent_color'     => sanitize_hex_color( $theme_options['accent_color'] ),
			'highlight_color'  => sanitize_hex_color( $theme_options['highlight_color'] ),
			'light_gray_color' => sanitize_hex_color( $theme_options['light_gray_color'] ),
			'gray_color'       => sanitize_hex_color( $theme_options['gray_color'] ),
			'dark_gray_color'  => sanitize_hex_color( $theme_options['dark_gray_color'] ),
		);
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

		// Set Primary Color.
		if ( $theme_options['primary_color'] !== $default_options['primary_color'] ) {
			$color_variables .= '--primary-color: ' . $theme_options['primary_color'] . ';';
		}

		// Set Secondary Color.
		if ( $theme_options['secondary_color'] !== $default_options['secondary_color'] ) {
			$color_variables .= '--secondary-color: ' . $theme_options['secondary_color'] . ';';
		}

		// Set Tertiary Color.
		if ( $theme_options['tertiary_color'] !== $default_options['tertiary_color'] ) {
			$color_variables .= '--tertiary-color: ' . $theme_options['tertiary_color'] . ';';
		}

		// Set Accent Color.
		if ( $theme_options['accent_color'] !== $default_options['accent_color'] ) {
			$color_variables .= '--accent-color: ' . $theme_options['accent_color'] . ';';
		}

		// Set Highlight Color.
		if ( $theme_options['highlight_color'] !== $default_options['highlight_color'] ) {
			$color_variables .= '--highlight-color: ' . $theme_options['highlight_color'] . ';';
		}

		// Set Light Gray Color.
		if ( $theme_options['light_gray_color'] !== $default_options['light_gray_color'] ) {
			$color_variables .= '--light-gray-color: ' . $theme_options['light_gray_color'] . ';';
		}

		// Set Gray Color.
		if ( $theme_options['gray_color'] !== $default_options['gray_color'] ) {
			$color_variables .= '--gray-color: ' . $theme_options['gray_color'] . ';';
		}

		// Set Dark Gray Color.
		if ( $theme_options['dark_gray_color'] !== $default_options['dark_gray_color'] ) {
			$color_variables .= '--dark-gray-color: ' . $theme_options['dark_gray_color'] . ';';
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

		// Add Section for Block Colors.
		$wp_customize->add_section( 'poseidon_pro_section_block_colors', array(
			'title'    => esc_html__( 'Block Colors', 'poseidon-pro' ),
			'priority' => 55,
			'panel'    => 'poseidon_options_panel',
		) );

		// Get Default Colors from settings.
		$default_options = Poseidon_Pro_Customizer::get_default_options();

		// Add Primary Color setting.
		$wp_customize->add_setting( 'poseidon_theme_options[primary_color]', array(
			'default'           => $default_options['primary_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'poseidon_theme_options[primary_color]', array(
				'label'    => esc_html_x( 'Primary', 'Color Option', 'poseidon-pro' ),
				'section'  => 'poseidon_pro_section_block_colors',
				'settings' => 'poseidon_theme_options[primary_color]',
				'priority' => 10,
			)
		) );

		// Add Secondary Color setting.
		$wp_customize->add_setting( 'poseidon_theme_options[secondary_color]', array(
			'default'           => $default_options['secondary_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'poseidon_theme_options[secondary_color]', array(
				'label'    => esc_html_x( 'Secondary', 'Color Option', 'poseidon-pro' ),
				'section'  => 'poseidon_pro_section_block_colors',
				'settings' => 'poseidon_theme_options[secondary_color]',
				'priority' => 20,
			)
		) );

		// Add Tertiary Color setting.
		$wp_customize->add_setting( 'poseidon_theme_options[tertiary_color]', array(
			'default'           => $default_options['tertiary_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'poseidon_theme_options[tertiary_color]', array(
				'label'    => esc_html_x( 'Tertiary', 'Color Option', 'poseidon-pro' ),
				'section'  => 'poseidon_pro_section_block_colors',
				'settings' => 'poseidon_theme_options[tertiary_color]',
				'priority' => 30,
			)
		) );

		// Add Accent Color setting.
		$wp_customize->add_setting( 'poseidon_theme_options[accent_color]', array(
			'default'           => $default_options['accent_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'poseidon_theme_options[accent_color]', array(
				'label'    => esc_html_x( 'Accent', 'Color Option', 'poseidon-pro' ),
				'section'  => 'poseidon_pro_section_block_colors',
				'settings' => 'poseidon_theme_options[accent_color]',
				'priority' => 40,
			)
		) );

		// Add Highlight Color setting.
		$wp_customize->add_setting( 'poseidon_theme_options[highlight_color]', array(
			'default'           => $default_options['highlight_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'poseidon_theme_options[highlight_color]', array(
				'label'    => esc_html_x( 'Highlight', 'Color Option', 'poseidon-pro' ),
				'section'  => 'poseidon_pro_section_block_colors',
				'settings' => 'poseidon_theme_options[highlight_color]',
				'priority' => 50,
			)
		) );

		// Add Light Gray Color setting.
		$wp_customize->add_setting( 'poseidon_theme_options[light_gray_color]', array(
			'default'           => $default_options['light_gray_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'poseidon_theme_options[light_gray_color]', array(
				'label'    => esc_html_x( 'Light Gray', 'Color Option', 'poseidon-pro' ),
				'section'  => 'poseidon_pro_section_block_colors',
				'settings' => 'poseidon_theme_options[light_gray_color]',
				'priority' => 60,
			)
		) );

		// Add Gray Color setting.
		$wp_customize->add_setting( 'poseidon_theme_options[gray_color]', array(
			'default'           => $default_options['gray_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'poseidon_theme_options[gray_color]', array(
				'label'    => esc_html_x( 'Gray', 'Color Option', 'poseidon-pro' ),
				'section'  => 'poseidon_pro_section_block_colors',
				'settings' => 'poseidon_theme_options[gray_color]',
				'priority' => 70,
			)
		) );

		// Add Dark Gray Color setting.
		$wp_customize->add_setting( 'poseidon_theme_options[dark_gray_color]', array(
			'default'           => $default_options['dark_gray_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'poseidon_theme_options[dark_gray_color]', array(
				'label'    => esc_html_x( 'Dark Gray', 'Color Option', 'poseidon-pro' ),
				'section'  => 'poseidon_pro_section_block_colors',
				'settings' => 'poseidon_theme_options[dark_gray_color]',
				'priority' => 80,
			)
		) );
	}
}

// Run Class.
add_action( 'init', array( 'Poseidon_Pro_Block_Colors', 'setup' ) );
add_filter( 'poseidon_color_palette', array( 'Poseidon_Pro_Block_Colors', 'block_color_palette' ) );
