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
		
		// Adds custom CSS code to change fonts
		add_action( 'wp_head', array( __CLASS__, 'custom_colors_css' ) );
		
		// Add Custom Color Settings
		add_action( 'customize_register', array( __CLASS__, 'color_settings' ) );
		
	}
	
	/**
	 * Adds Color CSS styles in the head area to override default colors
	 *
	 */
	static function custom_colors_css() { 
		
		// Get Theme Options from Database
		$theme_options = Poseidon_Pro_Customizer::get_theme_options();

		// Set Color CSS Variable
		$color_css = '';
		
		// Set Link Color
		if ( isset($theme_options['link_color']) and $theme_options['link_color'] <> '#2299cc' ) : 
		
			$color_css .= '
				a, a:link, a:visited, .comment a:link, .top-navigation-toggle:after, .top-navigation-menu .submenu-dropdown-toggle:before, 
				.footer-navigation-toggle:after, .social-icons-navigation-toggle:after {
					color: '. $theme_options['link_color'] .';
				}
				a:hover, a:focus, a:active { color: #444; }
				button, input[type="button"], input[type="reset"], input[type="submit"], .search-form .search-submit, .more-link {
					background-color: '. $theme_options['link_color'] .';
				}
				.entry-tags .meta-tags a, .post-pagination a, .post-pagination .current, .comment-navigation a, .widget_tag_cloud .tagcloud a {
					border: 1px solid '. $theme_options['link_color'] .';
				}
				.entry-tags .meta-tags a:hover, .entry-tags .meta-tags a:active, .post-pagination a:hover, .post-pagination .current, 
				.comment-navigation a:hover, .comment-navigation a:active, .widget_tag_cloud .tagcloud a:hover, .widget_tag_cloud .tagcloud a:active {
					background-color: '. $theme_options['link_color'] .';
				}';
				
		endif;
		
		// Set Navigation Color
		if ( isset($theme_options['navi_color']) and $theme_options['navi_color'] <> '#444444' ) : 
		
			$color_css .= '
				.primary-navigation, .main-navigation-toggle, .sidebar-navigation-toggle {
					background-color: '. $theme_options['navi_color'] .';
				}';
				
		endif;
		
		// Set Navigation Hover Color
		if ( isset($theme_options['navi_hover_color']) and $theme_options['navi_hover_color'] <> '#2299cc' ) : 
		
			$color_css .= '
				.main-navigation-menu a:hover, .main-navigation-menu ul, .main-navigation-menu li.current-menu-item a, 
				.main-navigation-toggle:hover, .main-navigation-toggle:active, .main-navigation-toggle:focus, 
				.sidebar-navigation-toggle:hover, .sidebar-navigation-toggle:active, .sidebar-navigation-toggle:focus {
					background-color: '. $theme_options['navi_hover_color'] .';
				}
				@media only screen and (max-width: 60em) {
					.main-navigation-menu a:hover, .main-navigation-menu li.current-menu-item a {
						background: none;
					}
				}
				@media only screen and (min-width: 60em) {
					.main-navigation-menu li.menu-item:hover a {
						background-color: '. $theme_options['navi_hover_color'] .';
					}
				}';
				
		endif;
		
		// Set Post Title Color
		if ( isset($theme_options['title_color']) and $theme_options['title_color'] <> '#2299cc' ) : 
		
			$color_css .= '
				.site-title, .page-title, .entry-title, .entry-title a:link, .entry-title a:visited {
					color: '. $theme_options['title_color'] .';
				}
				.entry-title {
					border-bottom: 3px solid '. $theme_options['title_color'] .';
				}
				.entry-title a:hover, .entry-title a:focus, .entry-title a:active { color: #444; }';
				
		endif;
		
		// Set Widget Title Color
		if ( isset($theme_options['widget_title_color']) and $theme_options['widget_title_color'] <> '#2299cc' ) : 
		
			$color_css .= '
				.widget-title, .page-header .archive-title, .comments-header .comments-title, .comment-reply-title span,
				.tzwb-tabbed-content .tzwb-tabnavi li a:hover, .tzwb-tabbed-content .tzwb-tabnavi li a:active, .tzwb-tabbed-content .tzwb-tabnavi li a.current-tab { 
					background-color: '. $theme_options['widget_title_color'] .';
				}
				.widget-category-posts .widget-header .category-archive-link .category-archive-icon {
					color: '. $theme_options['widget_title_color'] .';
				}';
				
		endif;
		
		// Set Slider Color
		if ( isset($theme_options['slider_color']) and $theme_options['slider_color'] <> '#2299cc' ) : 
		
			$color_css .= '
				.post-slider .zeeslide .slide-content, .post-slider-controls .zeeflex-direction-nav a {
					background-color: '. $theme_options['slider_color'].';
				}
				.post-slider .zeeslide .more-link {
					color: '. $theme_options['slider_color'].';
				}';
				
		endif;
		
		
		// Print Color CSS
		if ( isset($color_css) and $color_css <> '' ) :
		
			echo '<style type="text/css">';
			echo $color_css;
			echo '</style>';
		
		endif;
		
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
		
		// Add Link Color setting
		$wp_customize->add_setting( 'poseidon_theme_options[link_color]', array(
			'default'           => '#2299cc',
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 'link_color', array(
				'label'      => _x( 'Links & Buttons', 'color setting', 'poseidon-pro' ),
				'section'    => 'poseidon_pro_section_colors',
				'settings'   => 'poseidon_theme_options[link_color]',
				'priority' => 1
			) ) 
		);
		
		// Add Navigation Color setting
		$wp_customize->add_setting( 'poseidon_theme_options[navi_color]', array(
			'default'           => '#444444',
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 'navi_color', array(
				'label'      => _x( 'Navigation (primary)', 'color setting', 'poseidon-pro' ),
				'section'    => 'poseidon_pro_section_colors',
				'settings'   => 'poseidon_theme_options[navi_color]',
				'priority' => 2
			) ) 
		);
		
		// Add Navigation Hover Color setting
		$wp_customize->add_setting( 'poseidon_theme_options[navi_hover_color]', array(
			'default'           => '#2299cc',
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 'navi_hover_color', array(
				'label'      => _x( 'Navigation (secondary)', 'color setting', 'poseidon-pro' ),
				'section'    => 'poseidon_pro_section_colors',
				'settings'   => 'poseidon_theme_options[navi_hover_color]',
				'priority' => 3
			) ) 
		);
		
		// Add Title Color setting
		$wp_customize->add_setting( 'poseidon_theme_options[title_color]', array(
			'default'           => '#2299cc',
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 'title_color', array(
				'label'      => _x( 'Post Titles', 'color setting', 'poseidon-pro' ),
				'section'    => 'poseidon_pro_section_colors',
				'settings'   => 'poseidon_theme_options[title_color]',
				'priority' => 4
			) ) 
		);

		// Add Widget Title Color setting
		$wp_customize->add_setting( 'poseidon_theme_options[widget_title_color]', array(
			'default'           => '#2299cc',
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 'widget_title_color', array(
				'label'      => _x( 'Widget Titles', 'color setting', 'poseidon-pro' ),
				'section'    => 'poseidon_pro_section_colors',
				'settings'   => 'poseidon_theme_options[widget_title_color]',
				'priority' => 5
			) ) 
		);
		
		// Add Slider Color setting
		$wp_customize->add_setting( 'poseidon_theme_options[slider_color]', array(
			'default'           => '#2299cc',
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color'
			)
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( 
			$wp_customize, 'slider_color', array(
				'label'      => _x( 'Post Slider', 'color setting', 'poseidon-pro' ),
				'section'    => 'poseidon_pro_section_colors',
				'settings'   => 'poseidon_theme_options[slider_color]',
				'active_callback' => 'poseidon_slider_activated_callback',
				'priority' => 7
			) ) 
		);
		
	}

}

// Run Class
add_action( 'init', array( 'Poseidon_Pro_Custom_Colors', 'setup' ) );

endif;