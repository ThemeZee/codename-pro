<?php
/**
 * Widget Areas
 *
 * Registers various widget areas and hooks into the Codename theme to display widgets
 *
 * @package Codename Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Footer Widgets Class
 */
class Codename_Pro_Widget_Areas {

	/**
	 * Footer Widgets Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Codename Theme is not active.
		if ( ! current_theme_supports( 'codename-pro' ) ) {
			return;
		}

		// Display widgets.
		add_action( 'codename_before_header', array( __CLASS__, 'display_before_header_widgets' ), 20 );
		add_action( 'codename_after_header', array( __CLASS__, 'display_after_header_widgets' ), 20 );
		add_action( 'codename_before_blog', array( __CLASS__, 'display_before_blog_widgets' ), 20 );
		add_action( 'codename_after_posts', array( __CLASS__, 'display_after_posts_widgets' ), 20 );
		add_action( 'codename_after_pages', array( __CLASS__, 'display_after_pages_widgets' ), 20 );
		add_action( 'codename_before_footer', array( __CLASS__, 'display_before_footer_widgets' ), 20 );
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
	 * Displays After Posts Widgets
	 */
	static function display_after_posts_widgets() {
		self::display_widget_area( 'after-posts' );
	}

	/**
	 * Displays After Pages Widgets
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

		// Return early if Codename Theme is not active.
		if ( ! current_theme_supports( 'codename-pro' ) ) {
			return;
		}

		// Register Before Header widget area.
		register_sidebar( array(
			'name'          => esc_html__( 'Before Header', 'codename-pro' ),
			'id'            => 'before-header',
			'description'   => esc_html_x( 'Appears above the header area.', 'widget area description', 'codename-pro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		// Register After Header widget area.
		register_sidebar( array(
			'name'          => esc_html__( 'After Header', 'codename-pro' ),
			'id'            => 'after-header',
			'description'   => esc_html_x( 'Appears below the header area.', 'widget area description', 'codename-pro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		// Register Before Blog widget area.
		register_sidebar( array(
			'name'          => esc_html__( 'Before Blog Posts', 'codename-pro' ),
			'id'            => 'before-blog',
			'description'   => esc_html_x( 'Appears on the blog page above the latest posts.', 'widget area description', 'codename-pro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		// Register After Posts widget area.
		register_sidebar( array(
			'name'          => esc_html__( 'After Posts', 'codename-pro' ),
			'id'            => 'after-posts',
			'description'   => esc_html_x( 'Appears below single posts.', 'widget area description', 'codename-pro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		// Register After Pages widget area.
		register_sidebar( array(
			'name'          => esc_html__( 'After Pages', 'codename-pro' ),
			'id'            => 'after-pages',
			'description'   => esc_html_x( 'Appears below static pages.', 'widget area description', 'codename-pro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		// Register Before Footer widget area.
		register_sidebar( array(
			'name'          => esc_html__( 'Before Footer', 'codename-pro' ),
			'id'            => 'before-footer',
			'description'   => esc_html_x( 'Appears above the footer area.', 'widget area description', 'codename-pro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}
}

// Run Class.
add_action( 'init', array( 'Codename_Pro_Widget_Areas', 'setup' ) );

// Register widgets in backend.
add_action( 'widgets_init', array( 'Codename_Pro_Widget_Areas', 'register_widgets' ), 10 );