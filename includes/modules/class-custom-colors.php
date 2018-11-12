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

		// Add Custom Color CSS code to the Gutenberg editor.
		add_action( 'enqueue_block_editor_assets', array( __CLASS__, 'custom_editor_colors_css' ) );

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

		// Set Link Color.
		if ( $theme_options['link_color'] !== $default_options['link_color'] ) {

			$custom_css .= '
				/* Link and Button Color Setting */
				a:link,
				a:visited,
				.more-link,
				.widget-title a:hover,
				.widget-title a:active,
				.tzwb-tabbed-content .tzwb-tabnavi li a:hover,
				.tzwb-tabbed-content .tzwb-tabnavi li a:active,
				.tzwb-tabbed-content .tzwb-tabnavi li a.current-tab,
				.has-primary-color {
					color: ' . $theme_options['link_color'] . ';
				}

				a:hover,
				a:focus,
				a:active {
					color: #404040;
				}

				button,
				input[type="button"],
				input[type="reset"],
				input[type="submit"],
				.entry-tags .meta-tags a:hover,
				.entry-tags .meta-tags a:active,
				.widget_tag_cloud .tagcloud a:hover,
				.widget_tag_cloud .tagcloud a:active,
				.scroll-to-top-button,
				.scroll-to-top-button:focus,
				.scroll-to-top-button:active,
				.tzwb-social-icons .social-icons-menu li a {
					color: #fff;
					background: ' . $theme_options['link_color'] . ';
				}

				button:hover,
				input[type="button"]:hover,
				input[type="reset"]:hover,
				input[type="submit"]:hover,
				button:focus,
				input[type="button"]:focus,
				input[type="reset"]:focus,
				input[type="submit"]:focus,
				button:active,
				input[type="button"]:active,
				input[type="reset"]:active,
				input[type="submit"]:active,
				.scroll-to-top-button:hover {
					background: #404040;
				}

				.has-primary-background-color {
					background-color: ' . $theme_options['link_color'] . ';
				}
			';
		} // End if().

		// Set Top Navigation Color.
		if ( $theme_options['top_navi_color'] !== $default_options['top_navi_color'] ) {

			$custom_css .= '
				/* Top Navigation Color Setting */
				.header-bar-wrap,
				.top-navigation-menu ul {
					background: ' . $theme_options['top_navi_color'] . ';
				}
			';

			// Check if a dark background color was chosen.
			if ( self::is_color_light( $theme_options['top_navi_color'] ) ) {
				$custom_css .= '
					.header-bar-wrap,
					.top-navigation-menu a,
					.top-navigation-menu a:link,
					.top-navigation-menu a:visited,
					.top-navigation-toggle,
					.top-navigation-toggle:focus,
					.top-navigation-menu .submenu-dropdown-toggle,
					.header-bar .social-icons-menu li a,
					.header-bar .social-icons-menu li a:link,
					.header-bar .social-icons-menu li a:visited {
					    color: rgba(0,0,0,0.75);
					}

					.top-navigation-menu a:hover,
					.top-navigation-menu a:active,
					.top-navigation-toggle:hover,
					.top-navigation-toggle:active,
					.top-navigation-menu .submenu-dropdown-toggle:hover,
					.top-navigation-menu .submenu-dropdown-toggle:active,
					.header-bar .social-icons-menu li a:hover,
					.header-bar .social-icons-menu li a:active {
						color: rgba(0,0,0,0.6);
					}

					.top-navigation-menu,
					.top-navigation-menu a,
					.top-navigation-menu ul,
					.top-navigation-menu ul a,
					.top-navigation-menu ul li:last-child > a {
						border-color: rgba(0,0,0,0.15);
					}

					.header-bar-wrap {
						border-bottom: 1px solid rgba(0,0,0,0.1);
					}
				';
			} // End if().
		} // End if().

		// Set Primary Navigation Color.
		if ( $theme_options['navi_primary_color'] !== $default_options['navi_primary_color'] ) {

			$custom_css .= '
				/* Navigation Primary Color Setting */
				.main-navigation-menu a:link,
				.main-navigation-menu a:visited,
				.main-navigation-toggle,
				.main-navigation-menu .submenu-dropdown-toggle,
				.footer-navigation-menu a:link,
				.footer-navigation-menu a:visited,
				.header-search .header-search-icon {
					color: ' . $theme_options['navi_primary_color'] . ';
				}

				.main-navigation-menu a:hover,
				.main-navigation-menu a:active,
				.main-navigation-toggle:hover,
				.main-navigation-menu .submenu-dropdown-toggle:hover,
				.footer-navigation-menu a:hover,
				.footer-navigation-menu a:active {
					color: #22aadd;
				}

				.main-navigation-menu,
				.main-navigation-menu ul {
					border-top-color: ' . $theme_options['navi_primary_color'] . ';
				}
			';
		} // End if().

		// Set Secondary Navigation Color.
		if ( $theme_options['navi_secondary_color'] !== $default_options['navi_secondary_color'] ) {

			$custom_css .= '
				/* Navigation Secondary Color Setting */
				.main-navigation-menu a:hover,
				.main-navigation-menu a:active,
				.main-navigation-menu li.current-menu-item > a,
				.main-navigation-toggle:hover,
				.main-navigation-menu .submenu-dropdown-toggle:hover,
				.footer-navigation-menu a:hover,
				.footer-navigation-menu a:active {
					color: ' . $theme_options['navi_secondary_color'] . ';
				}
			';
		}

		// Set Primary Post Color.
		if ( $theme_options['post_primary_color'] !== $default_options['post_primary_color'] ) {

			$custom_css .= '
				/* Post Titles Primary Color Setting */
				.site-title,
				.site-title a:link,
				.site-title a:visited,
				.page-title,
				.entry-title,
				.entry-title a:link,
				.entry-title a:visited {
					color: ' . $theme_options['post_primary_color'] . ';
				}

				.site-title a:hover,
				.site-title a:active,
				.entry-title a:hover,
				.entry-title a:active {
					color: #22aadd;
				}
			';
		}

		// Set Secondary Post Color.
		if ( $theme_options['post_secondary_color'] !== $default_options['post_secondary_color'] ) {

			$custom_css .= '
				/* Post Titles Secondary Color Setting */
				.site-title a:hover,
				.site-title a:active,
				.entry-title a:hover,
				.entry-title a:active {
					color: ' . $theme_options['post_secondary_color'] . ';
				}
			';
		}

		// Set Header Color.
		if ( $theme_options['header_color'] !== $default_options['header_color'] ) {

			$custom_css .= '
				/* Header Color Setting */
				.site-header,
				.main-navigation-menu ul,
				.footer-wrap {
					background: ' . $theme_options['header_color'] . ';
				}
			';

			// Check if a dark background color was chosen.
			if ( self::is_color_dark( $theme_options['header_color'] ) ) {
				$custom_css .= '
					.site-header,
					.footer-wrap {
						border-color: rgba(255,255,255,0.12);
					}

					.main-navigation-menu ul {
						border-left-color: rgba(255,255,255,0.12);
						border-right-color: rgba(255,255,255,0.12);
						border-bottom-color: rgba(255,255,255,0.12);
					}

					.main-navigation-menu ul a {
						border-color: rgba(255,255,255,0.24);
					}

					.site-branding,
					.site-title,
					.site-title a:link,
					.site-title a:visited,
					.site-info a:link,
					.site-info a:visited {
						color: #ffffff;
					}

					.site-title a:hover,
					.site-title a:active,
					.site-info,
					.site-info a:hover,
					.site-info a:active {
						color: rgba(255,255,255,0.6);
					}
				';
			} // End if().
		} // End if().

		// Set Widget Title Color.
		if ( $theme_options['widget_title_color'] !== $default_options['widget_title_color'] ) {

			$custom_css .= '
				/* Widget Titles Color Setting */
				.widget-title,
				.widget-title a:link,
				.widget-title a:visited,
				.page-header .archive-title,
				.comments-header .comments-title,
				.comment-reply-title span {
					color: ' . $theme_options['widget_title_color'] . ';
				}

				.widget-title a:hover,
				.widget-title a:active  {
					color: #22aadd;
				}
			';
		}

		// Set Hover Widget Title Color.
		if ( $theme_options['link_color'] !== $default_options['link_color'] ) {

			$custom_css .= '
				.widget-title a:hover,
				.widget-title a:active  {
					color: ' . $theme_options['link_color'] . ';
				}
			';
		}

		// Set Footer Widgets Color.
		if ( $theme_options['footer_color'] !== $default_options['footer_color'] ) {

			$custom_css .= '
				/* Footer Widget Color Setting */
				.footer-widgets-background {
					background: ' . $theme_options['footer_color'] . ';
				}
			';

			// Check if a dark background color was chosen.
			if ( self::is_color_light( $theme_options['footer_color'] ) ) {
				$custom_css .= '
					.footer-widgets-background {
						border-top: 1px solid rgba(0,0,0,0.1);
					}

					.footer-widgets .widget-title,
					.footer-widgets .widget a:link,
					.footer-widgets .widget a:visited {
					    color: rgba(0,0,0,0.8);
					}

					.footer-widgets .widget,
					.footer-widgets .widget a:hover,
					.footer-widgets .widget a:active {
						color: rgba(0,0,0,0.6);
					}

					.footer-widgets .widget-title,
					.footer-widgets .tzwb-tabbed-content .tzwb-tabnavi {
						border-color: rgba(0,0,0,0.08);
					}

					#footer-widgets .tzwb-social-icons .social-icons-menu li a,
					#footer-widgets .widget_tag_cloud .tagcloud a {
						background: rgba(0,0,0,0.1);
					}

					#footer-widgets .tzwb-social-icons .social-icons-menu li a:hover,
					#footer-widgets .widget_tag_cloud .tagcloud a:hover,
					#footer-widgets .widget_tag_cloud .tagcloud a:active {
						color: rgba(0,0,0,0.8);
						background:  rgba(0,0,0,0.2);
					}

					.footer-widgets .tzwb-tabbed-content .tzwb-tabnavi li a:link,
					.footer-widgets .tzwb-tabbed-content .tzwb-tabnavi li a:visited {
						color: rgba(0,0,0,0.6);
					}

					.footer-widgets .tzwb-tabbed-content .tzwb-tabnavi li a:hover,
					.footer-widgets .tzwb-tabbed-content .tzwb-tabnavi li a:active,
					.footer-widgets .tzwb-tabbed-content .tzwb-tabnavi li a.current-tab {
						color: rgba(0,0,0,0.8);
					}
				';
			} // End if().
		} // End if().

		return $custom_css;
	}

	/**
	 * Adds Color CSS styles in the Gutenberg Editor to override default colors
	 *
	 * @return void
	 */
	static function custom_editor_colors_css() {

		// Get Theme Options from Database.
		$theme_options = Poseidon_Pro_Customizer::get_theme_options();

		// Get Default Fonts from settings.
		$default_options = Poseidon_Pro_Customizer::get_default_options();

		// Set Primary Color.
		if ( $theme_options['link_color'] !== $default_options['link_color'] ) {

			$custom_css = '
				.has-primary-color,
				.edit-post-visual-editor .editor-block-list__block a {
					color: ' . $theme_options['link_color'] . ';
				}
				.has-primary-background-color {
					background-color: ' . $theme_options['link_color'] . ';
				}
			';

			wp_add_inline_style( 'poseidon-editor-styles', $custom_css );
		}
	}

	/**
	 * Change primary color in Gutenberg Editor.
	 *
	 * @return array $editor_settings
	 */
	static function change_primary_color( $color ) {
		// Get Theme Options from Database.
		$theme_options = Poseidon_Pro_Customizer::get_theme_options();

		// Get Default Fonts from settings.
		$default_options = Poseidon_Pro_Customizer::get_default_options();

		// Set Primary Color.
		if ( $theme_options['link_color'] !== $default_options['link_color'] ) {
			$color = $theme_options['link_color'];
		}

		return $color;
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
			'priority' => 60,
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
add_filter( 'poseidon_primary_color', array( 'Poseidon_Pro_Custom_Colors', 'change_primary_color' ) );
