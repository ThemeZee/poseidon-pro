<?php
/***
 * Custom Fonts
 *
 * Adds custom font settings to Customizer and generates font CSS code
 *
 * @package Poseidon Pro
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Use class to avoid namespace collisions
if ( ! class_exists( 'Poseidon_Pro_Custom_Fonts' ) ) :

class Poseidon_Pro_Custom_Fonts {

	/**
	 * Custom Fonts Setup
	 *
	 * @return void
	*/
	static function setup() {
		
		// Return early if Poseidon Theme is not active
		if ( ! current_theme_supports( 'poseidon-pro'  ) ) {
			return;
		}
		
		// Include Font List Control Files
		require_once POSEIDON_PRO_PLUGIN_DIR . 'includes/customizer/class-font-list.php';
		require_once POSEIDON_PRO_PLUGIN_DIR . 'includes/customizer/class-customize-font-control.php';
		require_once POSEIDON_PRO_PLUGIN_DIR . 'includes/customizer/class-customize-font-list-control.php';
		
		// Add Custom Color CSS code to custom stylesheet output
		add_filter( 'poseidon_pro_custom_css_stylesheet', array( __CLASS__, 'custom_fonts_css' ) ); 
		
		// Load custom fonts from Google web font API
		add_filter( 'poseidon_google_fonts_url', array( __CLASS__, 'google_fonts_url' ) );
		
		// Add Font Settings in Customizer
		add_action( 'customize_register', array( __CLASS__, 'font_settings' ) );
		
	}
	
	/**
	 * Adds Font Family CSS styles in the head area to override default typography
	 *
	 * @return string CSS code
	 */
	static function custom_fonts_css( $custom_css ) {
		
		// Get Theme Options from Database
		$theme_options = Poseidon_Pro_Customizer::get_theme_options();
		
		// Get Default Fonts from settings
		$default_options = Poseidon_Pro_Customizer::get_default_options();
		
		// Set Font CSS Variable
		$font_css = '';
		
		// Set Default Text Font
		if ( $theme_options['text_font'] != $default_options['text_font'] ) { 
		
			$font_css .= '
				/* Base Font Setting */
				body,
				button,
				input,
				select,
				textarea {
					font-family: "'.esc_attr($theme_options['text_font']).'";
				}
				';
			
		}
		
		// Set Title Font
		if ( $theme_options['title_font'] != $default_options['title_font'] ) { 
		
			$font_css .= '
				/* Headings Font Setting */
				.site-title, 
				.page-title, 
				.entry-title {
					font-family: "'.esc_attr($theme_options['title_font']).'";
				}
				';
			
		}
		
		// Set Navigation Font
		if ( $theme_options['navi_font'] != $default_options['navi_font'] ) { 
		
			$font_css .= '
				/* Navigation Font Setting */
				.top-navigation-menu a,
				.main-navigation-menu a,
				.footer-navigation-menu a {
					font-family: "'.esc_attr($theme_options['navi_font']).'";
				}
				';
			
		}
		
		// Set Widget Title Font
		if ( $theme_options['widget_title_font'] != $default_options['widget_title_font'] ) { 
		
			$font_css .= '
				/* Widget Titles Font Setting */
				button,
				input[type="button"],
				input[type="reset"],
				input[type="submit"],
				.more-link,
				.widget-title,
				.post-pagination a,
				.post-pagination .current,
				.page-header .archive-title,
				.comments-header .comments-title,
				.comment-reply-title span,
				.tzwb-tabbed-content .tzwb-tabnavi li a {
					font-family: "'.esc_attr($theme_options['widget_title_font']).'";
				}
				';
			
		}
		
		$font_css = $font_css <> '' ? $font_css : '/* No Custom Font settings were saved */';
		$custom_css .= $font_css;
		
		return $custom_css;
		
	}
	
	/**
	 * Replace default Google Fonts URL with custom Fonts from theme settings
	 *
	 * @uses poseidon_google_fonts_url filter hook
	 * @return string Google Font URL
	 */
	static function google_fonts_url( $google_fonts_url ) { 

		// Get Theme Options from Database
		$theme_options = Poseidon_Pro_Customizer::get_theme_options();
		
		// Default Fonts which haven't to be load from Google
		$default_fonts = Poseidon_Pro_Custom_Font_Lists::default_browser_fonts();
		
		// Set Google Font Array
		$google_font_families = array();
		
		// Set Font Styles
		$font_styles = ':400,400italic,700,700italic';
		
		// Add Text Font
		if( isset( $theme_options['text_font'] ) and ! in_array( $theme_options['text_font'], $default_fonts ) ) {
			
			$google_font_families[] = $theme_options['text_font'] . $font_styles;
			$default_fonts[] = $theme_options['text_font']; 
			
		}
		
		// Add Title Font
		if( isset( $theme_options['title_font'] ) and ! in_array( $theme_options['title_font'], $default_fonts ) ) {
			
			$google_font_families[] = $theme_options['title_font'] . $font_styles;
			$default_fonts[] = $theme_options['title_font']; 
			
		}
		
		// Add Navigation Font
		if( isset( $theme_options['navi_font'] ) and ! in_array( $theme_options['navi_font'], $default_fonts ) ) {
			
			$google_font_families[] = $theme_options['navi_font'] . $font_styles;
			$default_fonts[] = $theme_options['navi_font'];
			
		}

		// Add Widget Title Font
		if( isset( $theme_options['widget_title_font'] ) and ! in_array( $theme_options['widget_title_font'], $default_fonts ) ) {
			
			$google_font_families[] = $theme_options['widget_title_font'] . $font_styles;
			$default_fonts[] = $theme_options['widget_title_font']; 
			
		}
		
		// Return early if google font array is empty
		if ( empty( $google_font_families ) ) {
			return $google_fonts_url;
		}
		
		// Setup Google Font URLs
		$query_args = array(
			'family' => urlencode( implode( '|', $google_font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$google_fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		
		return $google_fonts_url;
	}
	
	/**
	 * Adds all font settings in the Customizer
	 *
	 * @param object $wp_customize / Customizer Object
	 */
	static function font_settings( $wp_customize ) {

		// Add Section for Theme Fonts
		$wp_customize->add_section( 'poseidon_pro_section_fonts', array(
			'title'    => __( 'Theme Fonts', 'poseidon-pro' ),
			'priority' => 70,
			'panel' => 'poseidon_options_panel' 
			)
		);
		
		// Get Default Fonts from settings
		$default_options = Poseidon_Pro_Customizer::get_default_options();

		// Add settings and controls for theme fonts
		$wp_customize->add_setting( 'poseidon_theme_options[text_font]', array(
			'default'           => $default_options['text_font'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_attr'
			)
		);
		$wp_customize->add_control( new Poseidon_Pro_Customize_Font_Control( 
			$wp_customize, 'text_font', array(
				'label'      => __( 'Base Font', 'poseidon-pro' ),
				'section'    => 'poseidon_pro_section_fonts',
				'settings'   => 'poseidon_theme_options[text_font]',
				'priority' => 1
			) ) 
		);
		
		$wp_customize->add_setting( 'poseidon_theme_options[title_font]', array(
			'default'           => $default_options['title_font'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_attr'
			)
		);
		$wp_customize->add_control( new Poseidon_Pro_Customize_Font_Control( 
			$wp_customize, 'title_font', array(
				'label'      => _x( 'Headings', 'font setting', 'poseidon-pro' ),
				'section'    => 'poseidon_pro_section_fonts',
				'settings'   => 'poseidon_theme_options[title_font]',
				'priority' => 2
			) ) 
		);
		
		$wp_customize->add_setting( 'poseidon_theme_options[navi_font]', array(
			'default'           => $default_options['navi_font'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_attr'
			)
		);
		$wp_customize->add_control( new Poseidon_Pro_Customize_Font_Control( 
			$wp_customize, 'navi_font', array(
				'label'      => _x( 'Navigation', 'font setting', 'poseidon-pro' ),
				'section'    => 'poseidon_pro_section_fonts',
				'settings'   => 'poseidon_theme_options[navi_font]',
				'priority' => 3
			) ) 
		);
		
		$wp_customize->add_setting( 'poseidon_theme_options[widget_title_font]', array(
			'default'           => $default_options['widget_title_font'],
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_attr'
			)
		);
		$wp_customize->add_control( new Poseidon_Pro_Customize_Font_Control( 
			$wp_customize, 'widget_title_font', array(
				'label'      => _x( 'Widget Titles', 'font setting', 'poseidon-pro' ),
				'section'    => 'poseidon_pro_section_fonts',
				'settings'   => 'poseidon_theme_options[widget_title_font]',
				'priority' => 4
			) ) 
		);
		
		// Choose Available Fonts
		$wp_customize->add_setting( 'poseidon_theme_options[available_fonts]', array(
			'default'           => 'favorites',
			'type'           	=> 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => array( 'Poseidon_Pro_Custom_Fonts', 'poseidon_pro_sanitize_available_fonts' )
			)
		);
		$wp_customize->add_control( new Poseidon_Pro_Customize_Font_List_Control( 
			$wp_customize, 'poseidon_control_available_fonts', array(
				'label'      => __( 'Choose available Fonts', 'poseidon-pro' ),
				'section'    => 'poseidon_pro_section_fonts',
				'settings'   => 'poseidon_theme_options[available_fonts]',
				'choices' => array(
					'default' => __( 'Default Browser Fonts (12)', 'poseidon-pro' ),
					'favorites' => __( 'ThemeZee Favorite Fonts (35)', 'poseidon-pro' ),
					'popular' => __( 'Most Popular Google Fonts (100)', 'poseidon-pro' ),
					'all' => __( 'All Google Fonts (650)', 'poseidon-pro' )
					),
				'priority' => 5
			) ) 
		);
		
	}
	
	/**
	 *  Sanitize available fonts value.
	 *
	 * @param string $value / Value of the setting
	 * @return string
	 */
	static function sanitize_available_fonts( $value ) {

		if ( ! in_array( $value, array( 'default', 'favorites', 'popular', 'all' ), true ) ) :
			$value = 'favorites';
		endif;

		return $value;
	}

}

// Run Class
add_action( 'init', array( 'Poseidon_Pro_Custom_Fonts', 'setup' ) );

endif;