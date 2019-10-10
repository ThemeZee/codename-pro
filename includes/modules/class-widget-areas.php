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
	}

	/**
	 * Displays Before Header Widgets
	 */
	static function display_before_header_widgets() {
		self::display_widget_area( 'before-header' );
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
	}
}

// Run Class.
add_action( 'init', array( 'Codename_Pro_Widget_Areas', 'setup' ) );

// Register widgets in backend.
add_action( 'widgets_init', array( 'Codename_Pro_Widget_Areas', 'register_widgets' ), 10 );
