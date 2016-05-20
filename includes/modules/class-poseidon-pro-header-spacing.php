<?php
/***
 * Header Spacing
 *
 * Adds header spacing settings and CSS
 *
 * @package Poseidon Pro
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Use class to avoid namespace collisions
if ( ! class_exists( 'Poseidon_Pro_Header_Spacing' ) ) :

class Poseidon_Pro_Header_Spacing {

	/**
	 * Site Logo Setup
	 *
	 * @return void
	*/
	static function setup() {
		
		// Return early if Poseidon Theme is not active
		if ( ! current_theme_supports( 'poseidon-pro'  ) ) {
			return;
		}
		
		// Replace default site title function with new site logo function
		remove_action( 'poseidon_site_title', 'poseidon_site_title' );
		add_action( 'poseidon_site_title', array( __CLASS__, 'display_site_logo' ) );
		
		// Add Custom Spacing CSS code to custom stylesheet output
		add_filter( 'poseidon_pro_custom_css_stylesheet', array( __CLASS__, 'custom_spacing_css' ) ); 
		
		// Add Site Logo Settings
		add_action( 'customize_register', array( __CLASS__, 'header_settings' ) );
	}
	
	/**
	 * Display Site Logo if user uploaded a logo image or shows Site Title as default if not
	 * Hooks into the poseidon_site_title action hook in the on header area.
	 *
	 */
	static function display_site_logo() { 

		// Get Theme Options from Database
		$theme_options = Poseidon_Pro_Customizer::get_theme_options();
		
		// Display Logo Image or Site Title
		if ( isset($theme_options['header_logo']) and $theme_options['header_logo'] <> '' ) : ?>
				
				<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<img class="site-logo" src="<?php echo esc_url($theme_options['header_logo']); ?>" alt="<?php esc_attr(bloginfo('name')); ?>" />
				</a>

		<?php else: ?>
				
				<?php if ( is_home() or is_page_template( 'template-magazine.php' )  ) : ?>
		
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	
				<?php else : ?>
		
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
	
				<?php endif; ?>
		
		<?php endif; 
	
	}
	
	/**
	 * Adds custom Margin CSS styling for the logo and navigation spacing
	 *
	 */
	static function custom_spacing_css( $custom_css ) { 
		
		// Get Theme Options from Database
		$theme_options = Poseidon_Pro_Customizer::get_theme_options();

		// Set CSS Variable
		$spacing_css = '';
		
		// Set Logo Spacing
		if ( $theme_options['logo_spacing'] <> 10 ) { 
		
			$margin = $theme_options['logo_spacing'] / 10;
		
			$spacing_css .= '
				.site-branding {
					margin: '. $margin .'em 0;
				}
				';
				
		}
		
		// Set Navigation Spacing
		if ( $theme_options['navi_spacing'] <> 10 ) { 
		
			$margin = $theme_options['navi_spacing'] / 10;
		
			$spacing_css .= '
				.primary-navigation {
					margin: '. $margin .'em 0;
				}
				
				@media only screen and (max-width: 60em) {
					
					.primary-navigation {
						margin: 0;
					}
					
					.main-navigation-toggle {
						margin: '. $margin .'em 0;
					}
				}
				';
				
		}
		
		// Add Spacing CSS to existing CSS code
		$custom_css .= $spacing_css;
		
		return $custom_css;
		
	}
	
	/**
	 * Adds site logo settings
	 *
	 * @param object $wp_customize / Customizer Object
	 */
	static function header_settings( $wp_customize ) {

		// Add Section for Header Settings
		$wp_customize->add_section( 'poseidon_pro_section_header', array(
			'title'    => __( 'Header Settings', 'poseidon-pro' ),
			'priority' => 20,
			'panel' => 'poseidon_options_panel' 
			)
		);
		
		// Add Upload logo image setting for WordPress 4.4 and earlier
		if ( ! current_theme_supports( 'custom-logo'  ) ) :
		
			$wp_customize->add_setting( 'poseidon_theme_options[header_logo]', array(
				'default'           => '',
				'type'           	=> 'option',
				'transport'         => 'refresh',
				'sanitize_callback' => 'esc_url'
				)
			);
			$wp_customize->add_control( new WP_Customize_Image_Control(
				$wp_customize, 'poseidon_theme_options[header_logo]', array(
					'label'    => __( 'Logo Image (replaces Site Title)', 'poseidon-pro' ),
					'section'  => 'poseidon_pro_section_header',
					'settings' => 'poseidon_theme_options[header_logo]',
					'priority' => 1,
					)
				)
			);
			
		endif;
			
		// Add Logo Spacing setting
		$wp_customize->add_setting( 'poseidon_theme_options[logo_spacing]', array(
			'default'           => 10,
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control( 'poseidon_theme_options[logo_spacing]', array(
			'label'    => __( 'Logo Spacing (default: 10)', 'poseidon-pro' ),
			'section'  => 'poseidon_pro_section_header',
			'settings' => 'poseidon_theme_options[logo_spacing]',
			'type'     => 'text',
			'priority' => 2
			)
		);
		
		// Add Navigation Spacing setting
		$wp_customize->add_setting( 'poseidon_theme_options[navi_spacing]', array(
			'default'           => 10,
			'type'           	=> 'option',
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control( 'poseidon_theme_options[navi_spacing]', array(
			'label'    => __( 'Navigation Spacing (default: 10)', 'poseidon-pro' ),
			'section'  => 'poseidon_pro_section_header',
			'settings' => 'poseidon_theme_options[navi_spacing]',
			'type'     => 'text',
			'priority' => 3
			)
		);

	}

}

// Run Class
add_action( 'init', array( 'Poseidon_Pro_Header_Spacing', 'setup' ) );

endif;