<?php
/**
 * Footer Widgets
 *
 * Registers footer widget areas and hooks into the Poseidon theme to display widgets
 *
 * @package Poseidon Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Header Bar Class
 */
class Poseidon_Pro_Header_Bar {

	/**
	 * Footer Widgets Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Poseidon Theme is not active.
		if ( ! current_theme_supports( 'poseidon-pro' ) ) {
			return;
		}

		// Display Header Bar.
		add_action( 'poseidon_header_bar', array( __CLASS__, 'display_header_bar' ) );

		// Filter Social Menu to add SVG icons.
		add_filter( 'walker_nav_menu_start_el', array( __CLASS__, 'nav_menu_social_icons' ), 10, 4 );
	}

	/**
	 * Displays top navigation and social menu on header bar
	 *
	 * @return void
	 */
	static function display_header_bar() {

		// Check if there are menus.
		if ( has_nav_menu( 'social' ) or has_nav_menu( 'secondary' ) ) {

			echo '<div id="header-top" class="header-bar-wrap">';

			echo '<div id="header-bar" class="header-bar container clearfix">';

			// Check if there is a social menu.
			if ( has_nav_menu( 'social' ) ) {

				echo '<div id="header-social-icons" class="social-icons-navigation clearfix">';

				// Display Social Icons Menu.
				wp_nav_menu( array(
					'theme_location' => 'social',
					'container'      => false,
					'menu_class'     => 'social-icons-menu',
					'echo'           => true,
					'fallback_cb'    => '',
					'link_before'    => '<span class = "screen-reader-text">',
					'link_after'     => '</span>',
					'depth'          => 1,
				) );

				echo '</div>';

			}

			// Check if there is a top navigation menu.
			if ( has_nav_menu( 'secondary' ) ) : ?>

				<button class="secondary-menu-toggle menu-toggle" aria-controls="secondary-menu" aria-expanded="false" <?php self::amp_menu_toggle(); ?>>
					<?php
					echo self::get_svg( 'menu' );
					echo self::get_svg( 'close' );
					?>
					<span class="menu-toggle-text screen-reader-text"><?php esc_html_e( 'Menu', 'poseidon-pro' ); ?></span>
				</button>

				<div class="secondary-navigation">

					<nav class="top-navigation" role="navigation" <?php self::amp_menu_is_toggled(); ?> aria-label="<?php esc_attr_e( 'Secondary Menu', 'poseidon-pro' ); ?>">

						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'secondary',
								'menu_id'        => 'secondary-menu',
								'container'      => false,
							)
						);
						?>

					</nav>

				</div><!-- .secondary-navigation -->

				<?php
			endif;

			echo '</div>';
			echo '</div>';

		}
	}

	/**
	 * Get SVG icon.
	 *
	 * @return void
	 */
	static function get_svg( $icon ) {
		if ( function_exists( 'poseidon_get_svg' ) ) {
			return poseidon_get_svg( $icon );
		}
	}

	/**
	 * Display SVG icons in social links menu.
	 *
	 * @param  string  $item_output The menu item output.
	 * @param  WP_Post $item        Menu item object.
	 * @param  int     $depth       Depth of the menu.
	 * @param  array   $args        wp_nav_menu() arguments.
	 * @return string  $item_output The menu item output with social icon.
	 */
	static function nav_menu_social_icons( $item_output, $item, $depth, $args ) {
		// Return early if no social menu is filtered.
		if ( 'social' !== $args->theme_location ) {
			return $item_output;
		}

		// Get supported social icons.
		$social_icons = self::supported_social_icons();

		// Search if menu URL is in supported icons.
		$icon = 'star';
		foreach ( $social_icons as $attr => $value ) {
			if ( false !== stripos( $item_output, $attr ) ) {
				$icon = esc_attr( $value );
			}
		}

		// Get SVG.
		$svg = apply_filters( 'poseidon_pro_get_social_svg', self::get_social_svg( $icon ), $item_output );

		// Add SVG to menu item.
		$item_output = str_replace( $args->link_after, $args->link_after . $svg, $item_output );

		return $item_output;
	}

	/**
	 * Return social SVG markup.
	 *
	 * @param string $icon SVG icon id.
	 * @return string $svg SVG markup.
	 */
	static function get_social_svg( $icon = null ) {
		// Return early if no icon was defined.
		if ( empty( $icon ) ) {
			return;
		}

		// Create SVG markup.
		$svg  = '<svg class="icon icon-' . esc_attr( $icon ) . '" aria-hidden="true" role="img">';
		$svg .= ' <use xlink:href="' . POSEIDON_PRO_PLUGIN_URL . 'assets/icons/social-icons.svg?ver=20221122#icon-' . esc_html( $icon ) . '"></use> ';
		$svg .= '</svg>';

		return $svg;
	}

	/**
	 * Returns an array of supported social links (URL and icon name).
	 *
	 * @return array $social_links_icons
	 */
	static function supported_social_icons() {
		// Supported social links icons.
		$supported_social_icons = array(
			'500px'           => '500px',
			'amazon'          => 'amazon',
			'apple'           => 'apple',
			'bandcamp'        => 'bandcamp',
			'behance.net'     => 'behance',
			'bitbucket'       => 'bitbucket',
			'codepen'         => 'codepen',
			'deviantart'      => 'deviantart',
			'digg.com'        => 'digg',
			'discord'         => 'discord',
			'dribbble'        => 'dribbble',
			'dropbox.com'     => 'dropbox',
			'etsy.com'        => 'etsy',
			'facebook.com'    => 'facebook',
			'feed'            => 'rss',
			'rss'             => 'rss',
			'flickr.com'      => 'flickr',
			'foursquare.com'  => 'foursquare',
			'github.com'      => 'github',
			'instagram.com'   => 'instagram',
			'linkedin.com'    => 'linkedin',
			'mailto:'         => 'envelope',
			'mastodon'        => 'mastodon',
			'medium.com'      => 'medium-m',
			'meetup.com'      => 'meetup',
			'patreon'         => 'patreon',
			'pinterest'       => 'pinterest-p',
			'getpocket.com'   => 'get-pocket',
			'reddit.com'      => 'reddit-alien',
			'skype.com'       => 'skype',
			'skype:'          => 'skype',
			'slideshare'      => 'slideshare',
			'snapchat.com'    => 'snapchat',
			'soundcloud.com'  => 'soundcloud',
			'spotify.com'     => 'spotify',
			'steam'           => 'steam',
			'strava'          => 'strava',
			'stumbleupon.com' => 'stumbleupon',
			'telegram'        => 'telegram',
			't.me'            => 'telegram',
			'tumblr.com'      => 'tumblr',
			'twitch.tv'       => 'twitch',
			'twitter.com'     => 'twitter',
			'vimeo.com'       => 'vimeo',
			'vine.co'         => 'vine',
			'vk.com'          => 'vk',
			'whatsapp'        => 'whatsapp',
			'wa.me'           => 'whatsapp',
			'wordpress.org'   => 'wordpress',
			'wordpress.com'   => 'wordpress',
			'xing.com'        => 'xing',
			'yelp.com'        => 'yelp',
			'youtube.com'     => 'youtube',
		);

		return apply_filters( 'poseidon_pro_supported_social_icons', $supported_social_icons );
	}

	/**
	 * Register navigation menus
	 *
	 * @return void
	 */
	static function register_nav_menus() {

		// Return early if Poseidon Theme is not active.
		if ( ! current_theme_supports( 'poseidon-pro' ) ) {
			return;
		}

		register_nav_menus( array(
			'secondary' => esc_html__( 'Top Navigation', 'poseidon-pro' ),
			'social'    => esc_html__( 'Social Icons', 'poseidon-pro' ),
		) );
	}

	/**
	 * Adds amp support for menu toggle.
	 */
	static function amp_menu_toggle() {
		if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) {
			echo "[aria-expanded]=\"secondaryMenuExpanded? 'true' : 'false'\" ";
			echo 'on="tap:AMP.setState({secondaryMenuExpanded: !secondaryMenuExpanded})"';
		}
	}

	/**
	 * Adds amp support for mobile dropdown navigation menu.
	 */
	static function amp_menu_is_toggled() {
		if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) {
			echo "[class]=\"'top-navigation' + ( secondaryMenuExpanded ? ' toggled-on' : '' )\"";
		}
	}
}

// Run Class.
add_action( 'init', array( 'Poseidon_Pro_Header_Bar', 'setup' ) );

// Register navigation menus in backend.
add_action( 'after_setup_theme', array( 'Poseidon_Pro_Header_Bar', 'register_nav_menus' ), 20 );
