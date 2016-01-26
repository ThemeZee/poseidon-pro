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
if ( ! class_exists( 'Poseidon_Pro_Custom_Colors' ) ) :

class Poseidon_Pro_Custom_Colors {

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
		
		// Enqueue Custom Color Stylesheet
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'custom_colors_stylesheet' ), 20 );
		
		// Add Custom Color Settings
		add_action( 'customize_register', array( __CLASS__, 'color_settings' ) );
		
	}
	
	/**
	 * Register and Enqueue Custom Color Stylesheet
	 *
	 */
	static function custom_colors_stylesheet() {

		wp_enqueue_style( 'poseidon-pro-custom-colors', add_query_arg( 'poseidon_pro_colors', 1, home_url( '/' ) ) );
		
	}
	
	/**
	 * Adds Color CSS styles in the head area to override default colors
	 *
	 */
	static function custom_colors_css() { 
		
		// Get Theme Options from Database
		$theme_options = Poseidon_Pro_Customizer::get_theme_options();
		
		// Get Default Fonts from settings
		$default_options = Poseidon_Pro_Customizer::get_default_options();

		// Set Color CSS Variable
		$color_css = '';
		
		/* Set Link Color */
		if ( $theme_options['link_color'] != $default_options['link_color'] ) { 
		
			$color_css .= '
				/* Link and Button Color Setting */
				a:link, 
				a:visited,
				.more-link {
					color: '. $theme_options['link_color'] .';
				}
				
				a:hover, 
				a:focus, 
				a:active { 
					color: #404040; 
				}
				
				.entry-tags .meta-tags a:link, 
				.entry-tags .meta-tags a:visited {
					color: #777;
				}
				
				button,
				input[type="button"],
				input[type="reset"],
				input[type="submit"],
				.entry-tags .meta-tags a:hover, 
				.entry-tags .meta-tags a:active {
					color: #fff;
					background: '. $theme_options['link_color'] .';
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
				input[type="submit"]:active {
					background: #404040;
				}
				';
				
		}
		
		// Set Top Navigation Color
		if ( $theme_options['top_navi_color'] != $default_options['top_navi_color'] ) { 
		
			$color_css .= '
				/* Top Navigation Color Setting */
				.header-bar-wrap, 
				.top-navigation-menu ul {
					background: '. $theme_options['top_navi_color'] .';
				}';
				
		}
		
		// Set Primary Navigation Color
		if ( $theme_options['navi_primary_color'] != $default_options['navi_primary_color'] ) { 
		
			$color_css .= '
				/* Navigation Primary Color Setting */
				.main-navigation-menu a:link, 
				.main-navigation-menu a:visited,
				.main-navigation-menu > .menu-item-has-children > a:after,
				.main-navigation-menu ul .menu-item-has-children > a:after,
				.footer-navigation-menu a:link, 
				.footer-navigation-menu a:visited {
					color: '. $theme_options['navi_primary_color'] .';
				}
				
				.main-navigation-menu a:hover, 
				.main-navigation-menu a:active,
				.main-navigation-menu > .menu-item-has-children > a:hover:after,
				.main-navigation-menu ul .menu-item-has-children > a:hover:after,
				.footer-navigation-menu a:hover,
				.footer-navigation-menu a:active {
					color: #22aadd;
				}
				
				.main-navigation-menu ul {
					border-top: 4px solid '. $theme_options['navi_primary_color'] .';
				}
				
				@media only screen and (max-width: 60em) {
					
					.main-navigation-toggle:after,
					.main-navigation-menu .submenu-dropdown-toggle:before,
					.footer-navigation-toggle:after {
						color: '. $theme_options['navi_primary_color'] .';
					}
					
					.main-navigation-menu {
						border-top: 4px solid '. $theme_options['navi_primary_color'] .';
					}
					
					.main-navigation-menu ul {
						border: none;
					}
					
					.footer-navigation-menu {
						border-top: 2px solid '. $theme_options['navi_primary_color'] .';
					}
				}
				';
				
		}
		
		// Set Secondary Navigation Color
		if ( $theme_options['navi_secondory_color'] != $default_options['navi_secondory_color'] ) { 
		
			$color_css .= '
				/* Navigation Secondary Color Setting */
				.main-navigation-menu a:hover, 
				.main-navigation-menu a:active,
				.main-navigation-menu li.current-menu-item > a, 
				.main-navigation-menu > .menu-item-has-children > a:hover:after,
				.main-navigation-menu ul .menu-item-has-children > a:hover:after,
				.footer-navigation-menu a:hover,
				.footer-navigation-menu a:active {
					color: '. $theme_options['navi_secondory_color'] .';
				}
				
				@media only screen and (max-width: 60em) {
					
					.main-navigation-toggle:hover:after, 
					.main-navigation-menu .submenu-dropdown-toggle:hover:before,
					.footer-navigation-toggle:hover:after {
						color: '. $theme_options['navi_secondory_color'] .';
					}
					
				}
				';
				
		}
		
		// Set Primary Post Color
		if ( $theme_options['post_primary_color'] != $default_options['post_primary_color'] ) { 
		
			$color_css .= '
				/* Post Titles Primary Color Setting */
				.site-title, 
				.page-title, 
				.entry-title, 
				.entry-title a:link, 
				.entry-title a:visited {
					color: '. $theme_options['post_primary_color'] .';
				}
				
				.entry-title a:hover, 
				.entry-title a:active{
					color: #22aadd;
				}
				';
				
		}
		
		// Set Secondary Post Color
		if ( $theme_options['post_secondory_color'] != $default_options['post_secondory_color'] ) { 
		
			$color_css .= '
				/* Post Titles Secondary Color Setting */
				.site-branding a:hover .site-title,
				.entry-title a:hover, 
				.entry-title a:active {
					color: '. $theme_options['post_secondory_color'] .';
				}
				';
				
		}
		
		// Set Widget Title Color
		if ( $theme_options['widget_title_color'] != $default_options['widget_title_color'] ) { 
		
			$color_css .= '
				/* Widget Titles Color Setting */
				.widget-title,
				.widget-title a:link,
				.widget-title a:visited,
				.page-header .archive-title,
				.comments-header .comments-title,
				.comment-reply-title span,
				.tzwb-tabbed-content .tzwb-tabnavi li a:hover, 
				.tzwb-tabbed-content .tzwb-tabnavi li a:active,
				.tzwb-tabbed-content .tzwb-tabnavi li a.current-tab {
					color: '. $theme_options['widget_title_color'] .';
				}
				
				.widget-title a:hover, 
				.widget-title a:active  {
					color: #22aadd;
				}
				';
				
		}
		
		// Set Widget Link Color
		if ( $theme_options['widget_link_color'] != $default_options['widget_link_color'] ) { 
		
			$color_css .= '
				/* Widget Links Color Setting */
				.sidebar .widget a:link,
				.sidebar .widget a:visited,
				.widget-title a:hover, 
				.widget-title a:active {
					color: '. $theme_options['widget_link_color'] .';
				}
				
				.sidebar .widget a:hover,
				.sidebar .widget a:active {
					color: #404040;
				}
				
				.sidebar .widget .entry-meta a:link,
				.sidebar .widget .entry-meta a:visited {
					color: #aaa;
				}
				
				.sidebar .widget_tag_cloud .tagcloud a:link, 
				.sidebar .widget_tag_cloud .tagcloud a:visited,
				.sidebar .widget .entry-meta a:hover,
				.sidebar .widget .entry-meta a:active {
					color: #777;
				}
				
				.sidebar .widget_tag_cloud .tagcloud a:hover, 
				.sidebar .widget_tag_cloud .tagcloud a:active,
				.tzwb-social-icons .social-icons-menu li a {
					color: #fff;
					background: '. $theme_options['widget_link_color'] .';
				}

				.tzwb-social-icons .social-icons-menu li a:hover {
					background: #404040;
				}
				';
		}
		
		// Set Footer Widgets Color
		if ( $theme_options['footer_color'] != $default_options['footer_color'] ) { 
		
			$color_css .= '
				/* Footer Widget Color Setting */
				.footer-widgets-background {
					background: '. $theme_options['footer_color'] .';
				}
				';
				
		}

		return $color_css;
		
	}
	
	/**
	 * Adds all color settings in the Customizer
	 *
	 * @param object $wp_customize / Customizer Object
	 */
	static function color_settings( $wp_customize ) {

		// Add Section for Theme Colors
		$wp_customize->add_section( 'poseidon_pro_section_colors', array(
			'title'    => __( 'Theme Colors', 'poseidon-pro' ),
			'priority' => 60,
			'panel' => 'poseidon_options_panel' 
			)
		);
		
		// Get Default Colors from settings
		$default_options = Poseidon_Pro_Customizer::get_default_options();
		
		// Add Top Navigation Color setting
		$wp_customize->add_setting( 'poseidon_theme_options[top_navi_color]', array(
			'default'           => $default_options['top_navi_color'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 'poseidon_theme_options[top_navi_color]', array(
				'label'      => _x( 'Top Navigation', 'color setting', 'poseidon-pro' ),
				'section'    => 'poseidon_pro_section_colors',
				'settings'   => 'poseidon_theme_options[top_navi_color]',
				'priority' => 1
			) ) 
		);
		
		// Add Link and Button Color setting
		$wp_customize->add_setting( 'poseidon_theme_options[link_color]', array(
			'default'           => $default_options['link_color'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 'poseidon_theme_options[link_color]', array(
				'label'      => _x( 'Links and Buttons', 'color setting', 'poseidon-pro' ),
				'section'    => 'poseidon_pro_section_colors',
				'settings'   => 'poseidon_theme_options[link_color]',
				'priority' => 2
			) ) 
		);
		
		// Add Navigation Primary Color setting
		$wp_customize->add_setting( 'poseidon_theme_options[navi_primary_color]', array(
			'default'           => $default_options['navi_primary_color'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 'poseidon_theme_options[navi_primary_color]', array(
				'label'      => _x( 'Navigation (primary)', 'color setting', 'poseidon-pro' ),
				'section'    => 'poseidon_pro_section_colors',
				'settings'   => 'poseidon_theme_options[navi_primary_color]',
				'priority' => 3
			) ) 
		);
		
		// Add Navigation Secondary Color setting
		$wp_customize->add_setting( 'poseidon_theme_options[navi_secondory_color]', array(
			'default'           => $default_options['navi_secondory_color'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 'poseidon_theme_options[navi_secondory_color]', array(
				'label'      => _x( 'Navigation (secondary)', 'color setting', 'poseidon-pro' ),
				'section'    => 'poseidon_pro_section_colors',
				'settings'   => 'poseidon_theme_options[navi_secondory_color]',
				'priority' => 4
			) ) 
		);
		
		// Add Post Primary Color setting
		$wp_customize->add_setting( 'poseidon_theme_options[post_primary_color]', array(
			'default'           => $default_options['post_primary_color'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 'poseidon_theme_options[post_primary_color]', array(
				'label'      => _x( 'Post Titles (primary)', 'color setting', 'poseidon-pro' ),
				'section'    => 'poseidon_pro_section_colors',
				'settings'   => 'poseidon_theme_options[post_primary_color]',
				'priority' => 5
			) ) 
		);
		
		// Add Post Secondary Color setting
		$wp_customize->add_setting( 'poseidon_theme_options[post_secondory_color]', array(
			'default'           => $default_options['post_secondory_color'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 'poseidon_theme_options[post_secondory_color]', array(
				'label'      => _x( 'Post Titles (secondary)', 'color setting', 'poseidon-pro' ),
				'section'    => 'poseidon_pro_section_colors',
				'settings'   => 'poseidon_theme_options[post_secondory_color]',
				'priority' => 6
			) ) 
		);

		// Add Widget Title Color setting
		$wp_customize->add_setting( 'poseidon_theme_options[widget_title_color]', array(
			'default'           => $default_options['widget_title_color'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 'poseidon_theme_options[widget_title_color]', array(
				'label'      => _x( 'Widget Titles', 'color setting', 'poseidon-pro' ),
				'section'    => 'poseidon_pro_section_colors',
				'settings'   => 'poseidon_theme_options[widget_title_color]',
				'priority' => 7
			) ) 
		);
		
		// Add Widget Title Color setting
		$wp_customize->add_setting( 'poseidon_theme_options[widget_link_color]', array(
			'default'           => $default_options['widget_link_color'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 'poseidon_theme_options[widget_link_color]', array(
				'label'      => _x( 'Widget Links', 'color setting', 'poseidon-pro' ),
				'section'    => 'poseidon_pro_section_colors',
				'settings'   => 'poseidon_theme_options[widget_link_color]',
				'priority' => 8
			) ) 
		);
		
		// Add Footer Widgets Color setting
		$wp_customize->add_setting( 'poseidon_theme_options[footer_color]', array(
			'default'           => $default_options['footer_color'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 'poseidon_theme_options[footer_color]', array(
				'label'      => _x( 'Footer Widgets', 'color setting', 'poseidon-pro' ),
				'section'    => 'poseidon_pro_section_colors',
				'settings'   => 'poseidon_theme_options[footer_color]',
				'priority' => 9
			) ) 
		);
		
	}
	
	/**
	 * If the query var is set, print the Custom Color CSS rules.
	 *
	 */
	static function print_custom_colors_css() {

		// Only print CSS if this is a stylesheet request
		if( ! isset( $_GET['poseidon_pro_colors'] ) || intval( $_GET['poseidon_pro_colors'] ) !== 1 ) {
			return;
		}

		// CSS File Header
		ob_start();
		header( 'Content-type: text/css' );
		
		// Get CSS
		$raw_css = self::custom_colors_css();
		$raw_css = $raw_css <> '' ? $raw_css : '/* No Custom Colors settings were saved */';
		
		// Sanitize CSS Code
		$css = wp_kses( $raw_css, array( '\'', '\"' ) );
		$css = str_replace( '&gt;', '>', $css );
		$css = preg_replace( '/\t\t\t\t/', '', $css );
		
		// Print CSS
		echo $css;
		die();
	}

}

// Run Class
add_action( 'init', array( 'Poseidon_Pro_Custom_Colors', 'setup' ) );

// Print Custom Color CSS
add_action( 'plugins_loaded', array( 'Poseidon_Pro_Custom_Colors', 'print_custom_colors_css' ) );

endif;