<?php
/***
 * Poseidon Pro Settings Page Class
 *
 * Adds a new tab on the themezee plugins page and displays the settings page.
 *
 * @package Poseidon Pro
 */
 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Use class to avoid namespace collisions
if ( ! class_exists('Poseidon_Pro_Settings_Page') ) :

class Poseidon_Pro_Settings_Page {

	/**
	 * Setup the Settings Page class
	 *
	 * @return void
	*/
	static function setup() {
		
		// Add settings page to appearance menu
		add_action( 'admin_menu', array( __CLASS__, 'add_settings_page' ), 12 );
		
		// Enqueue Settings CSS
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'settings_page_css' ) );
	}
	
	/**
	 * Add Settings Page to Admin menu
	 *
	 * @return void
	*/
	static function add_settings_page() {
	
		// Return early if Poseidon Theme is not active
		if ( ! current_theme_supports( 'poseidon-pro'  ) ) {
			return;
		}
			
		add_theme_page(
			esc_html__( 'Pro Version', 'poseidon-pro' ),
			esc_html__( 'Pro Version', 'poseidon-pro' ),
			'edit_theme_options',
			'poseidon-pro',
			array( __CLASS__, 'display_settings_page' )
		);
		
	}
	
	/**
	 * Display settings page
	 *
	 * @return void
	*/
	static function display_settings_page() { 
		
		// Get Theme Details from style.css
		$theme = wp_get_theme(); 
	
		ob_start();
		?>

		<div class="wrap pro-version-wrap">

			<h1><?php echo POSEIDON_PRO_NAME; ?> <?php echo POSEIDON_PRO_VERSION; ?></h1>
			
			<div id="poseidon-pro-settings" class="poseidon-pro-settings-wrap">
				
				<form class="poseidon-pro-settings-form" method="post" action="options.php">
					<?php
						settings_fields( 'poseidon_pro_settings' );
						do_settings_sections( 'poseidon_pro_settings' );
					?>
				</form>
				
				<p><?php printf( __( 'You can find your license keys and manage your active sites on <a href="%s" target="_blank">themezee.com</a>.', 'poseidon-pro' ), __( 'https://themezee.com/license-keys/', 'poseidon-pro' ) . '?utm_source=plugin-settings&utm_medium=textlink&utm_campaign=poseidon-pro&utm_content=license-keys' ); ?></p>
				
			</div>
			
		</div>
<?php
		echo ob_get_clean();
	}
	
	/**
	 * Enqueues CSS for Settings page
	 *
	 * @return void
	*/
	static function settings_page_css( $hook ) { 

		// Load styles and scripts only on theme info page
		if ( 'appearance_page_poseidon-pro' != $hook ) {
			return;
		}
		
		// Embed theme info css style
		wp_enqueue_style( 'poseidon-pro-settings-css', plugins_url('/assets/css/settings.css', dirname( dirname(__FILE__) ) ), array(), POSEIDON_PRO_VERSION );

	}
	
}

// Run Poseidon Pro Settings Page Class
Poseidon_Pro_Settings_Page::setup();

endif;