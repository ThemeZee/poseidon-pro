<?php
/*
Plugin Name: Poseidon Pro
Plugin URI: http://themezee.com/addons/poseidon-pro/
Description: Adds additional features like footer widgets, custom colors, fonts and logo upload to the Poseidon theme.
Author: ThemeZee
Author URI: https://themezee.com/
Version: 1.0.3
Text Domain: poseidon-pro
Domain Path: /languages/
License: GPL v3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Poseidon Pro
Copyright(C) 2015, ThemeZee.com - support@themezee.com

*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Use class to avoid namespace collisions
if ( ! class_exists( 'Poseidon_Pro' ) ) :


/**
 * Main Poseidon_Pro Class
 *
 * @package Poseidon Pro
 */
class Poseidon_Pro {

	/**
	 * Call all Functions to setup the Plugin
	 *
	 * @uses Poseidon_Pro::constants() Setup the constants needed
	 * @uses Poseidon_Pro::includes() Include the required files
	 * @uses Poseidon_Pro::setup_actions() Setup the hooks and actions
	 * @return void
	 */
	static function setup() {
	
		// Setup Constants
		self::constants();
		
		// Setup Translation
		add_action( 'plugins_loaded', array( __CLASS__, 'translation' ) );
	
		// Include Files
		self::includes();
		
		// Setup Action Hooks
		self::setup_actions();
		
	}
	
	/**
	 * Setup plugin constants
	 *
	 * @return void
	 */
	static function constants() {
		
		// Define Plugin Name
		define( 'POSEIDON_PRO_NAME', 'Poseidon Pro' );

		// Define Version Number
		define( 'POSEIDON_PRO_VERSION', '1.0.3' );
		
		// Define Plugin Name
		define( 'POSEIDON_PRO_PRODUCT_ID', 53694 );

		// Define Update API URL
		define( 'POSEIDON_PRO_STORE_API_URL', 'https://themezee.com' ); 

		// Plugin Folder Path
		define( 'POSEIDON_PRO_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

		// Plugin Folder URL
		define( 'POSEIDON_PRO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

		// Plugin Root File
		define( 'POSEIDON_PRO_PLUGIN_FILE', __FILE__ );
		
	}
	
	/**
	 * Load Translation File
	 *
	 * @return void
	 */
	static function translation() {

		load_plugin_textdomain( 'poseidon-pro', false, dirname( plugin_basename( POSEIDON_PRO_PLUGIN_FILE ) ) . '/languages/' );
		
	}
	
	/**
	 * Include required files
	 *
	 * @return void
	 */
	static function includes() {
	
		// Include Admin Classes
		require_once POSEIDON_PRO_PLUGIN_DIR . 'includes/admin/class-plugin-updater.php';
		require_once POSEIDON_PRO_PLUGIN_DIR . 'includes/admin/class-settings.php';
		require_once POSEIDON_PRO_PLUGIN_DIR . 'includes/admin/class-settings-page.php';
		require_once POSEIDON_PRO_PLUGIN_DIR . 'includes/admin/class-admin-notices.php';
		
		// Include Customizer Classes
		require_once POSEIDON_PRO_PLUGIN_DIR . 'includes/customizer/class-customizer.php';
		
		// Include Pro Features
		require_once POSEIDON_PRO_PLUGIN_DIR . 'includes/modules/class-custom-colors.php';
		require_once POSEIDON_PRO_PLUGIN_DIR . 'includes/modules/class-custom-fonts.php';
		require_once POSEIDON_PRO_PLUGIN_DIR . 'includes/modules/class-footer-line.php';
		require_once POSEIDON_PRO_PLUGIN_DIR . 'includes/modules/class-footer-widgets.php';
		require_once POSEIDON_PRO_PLUGIN_DIR . 'includes/modules/class-header-bar.php';
		require_once POSEIDON_PRO_PLUGIN_DIR . 'includes/modules/class-header-spacing.php';
		
		// Include Magazine Widgets
		require_once POSEIDON_PRO_PLUGIN_DIR . 'includes/widgets/widget-magazine-posts-list.php';
		require_once POSEIDON_PRO_PLUGIN_DIR . 'includes/widgets/widget-magazine-posts-sidebar.php';
		require_once POSEIDON_PRO_PLUGIN_DIR . 'includes/widgets/widget-magazine-posts-single.php';
		
		// Include Custom Stylesheet class
		require_once POSEIDON_PRO_PLUGIN_DIR . 'includes/class-custom-stylesheet.php';

	}
	
	/**
	 * Setup Action Hooks
	 *
	 * @see https://codex.wordpress.org/Function_Reference/add_action WordPress Codex
	 * @return void
	 */
	static function setup_actions() {
		
		// Enqueue Poseidon Pro Stylesheet
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_styles' ), 11 );
		
		// Register additional Magazine Post Widgets
		add_action( 'widgets_init', array( __CLASS__, 'register_widgets' ) );
		
		// Add Settings link to Plugin actions
		add_filter( 'plugin_action_links_' . plugin_basename( POSEIDON_PRO_PLUGIN_FILE ), array( __CLASS__, 'plugin_action_links' ) );
		
		// Add automatic plugin updater from ThemeZee Store API
		add_action( 'admin_init', array( __CLASS__, 'plugin_updater' ), 0 );
		
	}

	/**
	 * Enqueue Styles
	 *
	 * @return void
	 */
	static function enqueue_styles() {

		// Return early if Poseidon Theme is not active
		if ( ! current_theme_supports( 'poseidon-pro'  ) ) {
			return;
		}
		
		// Enqueue Plugin Stylesheet
		wp_enqueue_style( 'poseidon-pro', POSEIDON_PRO_PLUGIN_URL . 'assets/css/poseidon-pro.css', array(), POSEIDON_PRO_VERSION );
		
	}
	
	/**
	 * Register Magazine Widgets
	 *
	 * @return void
	 */
	static function register_widgets() {
		
		// Return early if Poseidon Theme is not active
		if ( ! current_theme_supports( 'poseidon-pro'  ) ) {
			return;
		}
		
		register_widget( 'Poseidon_Pro_Magazine_Posts_List_Widget' );
		register_widget( 'Poseidon_Pro_Magazine_Posts_Sidebar_Widget' );
		register_widget( 'Poseidon_Pro_Magazine_Posts_Single_Widget' );
		
	}
	
	/**
	 * Add Settings link to the plugin actions
	 *
	 * @return array $actions Plugin action links
	 */
	static function plugin_action_links( $actions ) {

		$settings_link = array( 'settings' => sprintf( '<a href="%s">%s</a>', admin_url( 'themes.php?page=poseidon-pro' ), __( 'Settings', 'poseidon-pro' ) ) );
		
		return array_merge( $settings_link, $actions );
	}
	
	/**
	 * Plugin Updater
	 *
	 * @return void
	 */
	static function plugin_updater() {

		if( ! is_admin() ) :
			return;
		endif;
		
		$options = Poseidon_Pro_Settings::instance();

		if( $options->get( 'license_key' ) <> '' ) :
			
			$license_key = $options->get( 'license_key' );
			
			// setup the updater
			$poseidon_pro_updater = new Poseidon_Pro_Plugin_Updater( POSEIDON_PRO_STORE_API_URL, __FILE__, array(
					'version' 	=> POSEIDON_PRO_VERSION,
					'license' 	=> $license_key,
					'item_name' => POSEIDON_PRO_NAME,
					'item_id'   => POSEIDON_PRO_PRODUCT_ID,
					'author' 	=> 'ThemeZee'
				)
			);
			
		endif;
		
	}
	
}

// Run Plugin
Poseidon_Pro::setup();

endif;