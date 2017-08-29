<?php
/**
 * Header Spacing
 *
 * Adds header spacing settings and CSS
 *
 * @package Poseidon Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Header Spacing Class
 */
class Poseidon_Pro_Header_Spacing {

	/**
	 * Site Logo Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Poseidon Theme is not active.
		if ( ! current_theme_supports( 'poseidon-pro' ) ) {
			return;
		}

		// Add Custom Spacing CSS code to custom stylesheet output.
		add_filter( 'poseidon_pro_custom_css_stylesheet', array( __CLASS__, 'custom_spacing_css' ) );

		// Add Site Logo Settings.
		add_action( 'customize_register', array( __CLASS__, 'header_settings' ) );
	}

	/**
	 * Adds custom Margin CSS styling for the logo and navigation spacing
	 *
	 * @param String $custom_css Custom Styling CSS.
	 * @return string CSS code
	 */
	static function custom_spacing_css( $custom_css ) {

		// Get Theme Options from Database.
		$theme_options = Poseidon_Pro_Customizer::get_theme_options();

		// Set Logo Spacing.
		if ( 10 !== $theme_options['logo_spacing'] ) {

			$margin = $theme_options['logo_spacing'] / 10;

			$custom_css .= '
				.site-branding {
					margin: ' . $margin . 'em 0;
				}
			';
		}

		// Set Navigation Spacing.
		if ( 10 !== $theme_options['navi_spacing'] ) {

			$margin = $theme_options['navi_spacing'] / 10;

			$custom_css .= '
				.primary-navigation {
					margin: ' . $margin . 'em 0;
				}

				@media only screen and (max-width: 60em) {

					.primary-navigation {
					    margin: 0;
					}

					.main-navigation-toggle {
						margin: ' . $margin . 'em 0;
					}
				}
			';
		}

		return $custom_css;
	}

	/**
	 * Adds site logo settings
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function header_settings( $wp_customize ) {

		// Add Section for Header Settings.
		$wp_customize->add_section( 'poseidon_pro_section_header', array(
			'title'    => __( 'Header Settings', 'poseidon-pro' ),
			'priority' => 20,
			'panel' => 'poseidon_options_panel',
		) );

		// Add Logo Spacing setting.
		$wp_customize->add_setting( 'poseidon_theme_options[logo_spacing]', array(
			'default'           => 10,
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint',
		) );

		$wp_customize->add_control( 'poseidon_theme_options[logo_spacing]', array(
			'label'    => __( 'Logo Spacing (default: 10)', 'poseidon-pro' ),
			'section'  => 'poseidon_pro_section_header',
			'settings' => 'poseidon_theme_options[logo_spacing]',
			'type'     => 'text',
			'priority' => 10,
		) );

		// Add Navigation Spacing setting.
		$wp_customize->add_setting( 'poseidon_theme_options[navi_spacing]', array(
			'default'           => 10,
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint',
		) );

		$wp_customize->add_control( 'poseidon_theme_options[navi_spacing]', array(
			'label'    => __( 'Navigation Spacing (default: 10)', 'poseidon-pro' ),
			'section'  => 'poseidon_pro_section_header',
			'settings' => 'poseidon_theme_options[navi_spacing]',
			'type'     => 'text',
			'priority' => 20,
		) );
	}
}

// Run Class.
add_action( 'init', array( 'Poseidon_Pro_Header_Spacing', 'setup' ) );
