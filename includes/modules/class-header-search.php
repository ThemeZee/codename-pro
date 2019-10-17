<?php
/**
 * Header Search
 *
 * Displays header search in main navigation menu
 *
 * @package Codename Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Header Search Class
 */
class Codename_Pro_Header_Search {

	/**
	 * Header Search Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Codename Theme is not active.
		if ( ! current_theme_supports( 'codename-pro' ) ) {
			return;
		}

		// Enqueue Header Search JavaScript.
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_script' ) );

		// Add search icon on main navigation menu.
		add_action( 'codename_after_navigation', array( __CLASS__, 'add_header_search_icon' ) );

		// Add search form on header area.
		add_action( 'codename_before_header', array( __CLASS__, 'add_header_search_form' ) );

		// Add Header Search checkbox in Customizer.
		add_action( 'customize_register', array( __CLASS__, 'header_search_settings' ) );

		// Hide Header Search if disabled.
		add_filter( 'codename_hide_elements', array( __CLASS__, 'hide_header_search' ) );
	}

	/**
	 * Enqueue Scroll-To-Top JavaScript
	 *
	 * @return void
	 */
	static function enqueue_script() {

		// Get Theme Options from Database.
		$theme_options = Codename_Pro_Customizer::get_theme_options();

		// Embed header search JS if enabled.
		if ( true === $theme_options['header_search'] || is_customize_preview() ) :

			wp_enqueue_script( 'codename-pro-header-search', CODENAME_PRO_PLUGIN_URL . 'assets/js/header-search.js', array( 'jquery' ), CODENAME_PRO_VERSION, true );

		endif;
	}

	/**
	 * Add search icon to navigation menu
	 *
	 * @return void
	 */
	static function add_header_search_icon() {

		// Get Theme Options from Database.
		$theme_options = Codename_Pro_Customizer::get_theme_options();

		// Show header search if activated.
		if ( true === $theme_options['header_search'] || is_customize_preview() ) : ?>

			<div class="header-search">

				<button class="header-search-icon" aria-controls="header-search" aria-expanded="false">
					<?php echo codename_get_svg( 'search' ); ?>
					<span class="screen-reader-text"><?php esc_html_e( 'Search', 'codename-pro' ); ?></span>
				</button>

			</div>

			<?php
		endif;
	}

	/**
	 * Add search form to header area
	 *
	 * @return void
	 */
	static function add_header_search_form() {

		// Get Theme Options from Database.
		$theme_options = Codename_Pro_Customizer::get_theme_options();

		// Show header search if activated.
		if ( true === $theme_options['header_search'] || is_customize_preview() ) :
			?>

			<div class="header-search-form">
				<?php get_search_form(); ?>
			</div>

			<?php
		endif;
	}

	/**
	 * Adds header search checkbox setting
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function header_search_settings( $wp_customize ) {

		// Add Header Search Headline.
		$wp_customize->add_control( new Codename_Customize_Header_Control(
			$wp_customize, 'codename_theme_options[header_search_title]', array(
				'label'    => esc_html__( 'Header Search', 'codename-pro' ),
				'section'  => 'codename_section_layout',
				'settings' => array(),
				'priority' => 30,
			)
		) );

		// Add Header Search setting and control.
		$wp_customize->add_setting( 'codename_theme_options[header_search]', array(
			'default'           => false,
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'codename_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'codename_theme_options[header_search]', array(
			'label'    => esc_html__( 'Enable search field in header', 'codename-pro' ),
			'section'  => 'codename_section_layout',
			'settings' => 'codename_theme_options[header_search]',
			'type'     => 'checkbox',
			'priority' => 40,
		) );
	}

	/**
	 * Hide Header Search if deactivated.
	 *
	 * @param array $elements / Elements to be hidden.
	 * @return array $elements
	 */
	static function hide_header_search( $elements ) {

		// Get Theme Options from Database.
		$theme_options = Codename_Pro_Customizer::get_theme_options();

		// Hide Header Search?
		if ( false === $theme_options['header_search'] ) {
			$elements[] = '.primary-navigation-wrap .header-search';
		}

		return $elements;
	}
}

// Run Class.
add_action( 'init', array( 'Codename_Pro_Header_Search', 'setup' ) );
