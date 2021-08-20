<?php
/**
 * Widget Areas
 *
 * Registers various widget areas and hooks into the Poseidon theme to display widgets
 *
 * @package Poseidon Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Footer Widgets Class
 */
class Poseidon_Pro_Widget_Areas {

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

		// Display widgets.
		add_action( 'poseidon_before_header', array( __CLASS__, 'display_before_header_widgets' ), 20 );
		add_action( 'poseidon_after_header', array( __CLASS__, 'display_after_header_widgets' ), 20 );
		add_action( 'poseidon_before_blog', array( __CLASS__, 'display_before_blog_widgets' ), 20 );
		add_action( 'poseidon_after_posts', array( __CLASS__, 'display_after_posts_widgets' ), 20 );
		add_action( 'poseidon_after_pages', array( __CLASS__, 'display_after_pages_widgets' ), 20 );
		add_action( 'poseidon_before_footer', array( __CLASS__, 'display_before_footer_widgets' ), 20 );
	}

	/**
	 * Displays Before Header Widgets
	 */
	static function display_before_header_widgets() {
		self::display_widget_area( 'before-header' );
	}

	/**
	 * Displays After Header Widgets
	 */
	static function display_after_header_widgets() {
		self::display_widget_area( 'after-header' );
	}

	/**
	 * Displays Before Blog Widgets
	 */
	static function display_before_blog_widgets() {
		self::display_widget_area( 'before-blog' );
	}

	/**
	 * Displays After Single Posts Widgets
	 */
	static function display_after_posts_widgets() {
		self::display_widget_area( 'after-posts' );
	}

	/**
	 * Displays After Static Pages Widgets
	 */
	static function display_after_pages_widgets() {
		self::display_widget_area( 'after-pages' );
	}

	/**
	 * Displays Before Footer Widgets
	 */
	static function display_before_footer_widgets() {
		self::display_widget_area( 'before-footer' );
	}

	/**
	 * Display Widget Area
	 */
	static function display_widget_area( $area ) {
		if ( is_active_sidebar( $area ) ) :
			?>

			<div class="<?php echo esc_attr( $area ); ?>-widget-area widget-area">
				<?php dynamic_sidebar( $area ); ?>
			</div>

			<?php
		endif;
	}

	/**
	 * Register all Footer Widget areas
	 *
	 * @return void
	 */
	static function register_widgets() {

		// Return early if Poseidon Theme is not active.
		if ( ! current_theme_supports( 'poseidon-pro' ) ) {
			return;
		}

		// Register Before Header widget area.
		register_sidebar( array(
			'name'          => esc_html__( 'Before Header', 'poseidon-pro' ),
			'id'            => 'before-header',
			'description'   => esc_html_x( 'Appears above the header area.', 'widget area description', 'poseidon-pro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		// Register After Header widget area.
		register_sidebar( array(
			'name'          => esc_html__( 'After Header', 'poseidon-pro' ),
			'id'            => 'after-header',
			'description'   => esc_html_x( 'Appears below the header area.', 'widget area description', 'poseidon-pro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		// Register Before Blog widget area.
		register_sidebar( array(
			'name'          => esc_html__( 'Before Latest Blog Posts', 'poseidon-pro' ),
			'id'            => 'before-blog',
			'description'   => esc_html_x( 'Appears on the blog page above the latest posts.', 'widget area description', 'poseidon-pro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		// Register After Single Posts widget area.
		register_sidebar( array(
			'name'          => esc_html__( 'After Single Posts', 'poseidon-pro' ),
			'id'            => 'after-posts',
			'description'   => esc_html_x( 'Appears below single posts.', 'widget area description', 'poseidon-pro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		// Register After Static Pages widget area.
		register_sidebar( array(
			'name'          => esc_html__( 'After Static Pages', 'poseidon-pro' ),
			'id'            => 'after-pages',
			'description'   => esc_html_x( 'Appears below static pages.', 'widget area description', 'poseidon-pro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		// Register Before Footer widget area.
		register_sidebar( array(
			'name'          => esc_html__( 'Before Footer', 'poseidon-pro' ),
			'id'            => 'before-footer',
			'description'   => esc_html_x( 'Appears above the footer area.', 'widget area description', 'poseidon-pro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}
}

// Run Class.
add_action( 'init', array( 'Poseidon_Pro_Widget_Areas', 'setup' ) );

// Register widgets in backend.
add_action( 'widgets_init', array( 'Poseidon_Pro_Widget_Areas', 'register_widgets' ), 10 );
