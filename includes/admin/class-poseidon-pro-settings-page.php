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
		
	}
	
	/**
	 * Add Settings Page to Admin menu
	 *
	 * @return void
	*/
	static function add_settings_page() {
			
		add_theme_page(
			esc_html__( 'Pro Version', 'poseidon-pro' ),
			esc_html__( 'Pro Version', 'poseidon-pro' ),
			'manage_options',
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
	
		ob_start();
	?>

		<div id="poseidon-pro-settings" class="poseidon-pro-settings-wrap wrap">
			
			<h1><?php esc_html_e( 'Poseidon Pro', 'poseidon-pro' ); ?></h1>
			<?php settings_errors(); ?>
			
			<form class="poseidon-pro-settings-form" method="post" action="options.php">
				<?php
					settings_fields( 'poseidon_pro_settings' );
					do_settings_sections( 'poseidon_pro_settings' );
					submit_button();
				?>
			</form>
			
		</div>
<?php
		echo ob_get_clean();
	}
	
}

// Run Poseidon Pro Settings Page Class
Poseidon_Pro_Settings_Page::setup();

endif;