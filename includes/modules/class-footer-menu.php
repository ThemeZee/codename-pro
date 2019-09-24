<?php
/**
 * Footer Menu
 *
 * Displays credit link and footer text based on theme options
 * Registers and displays footer navigation
 *
 * @package Codename Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Footer Menu Class
 */
class Codename_Pro_Footer_Menu {

	/**
	 * Class Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Codename Theme is not active.
		if ( ! current_theme_supports( 'codename-pro' ) ) {
			return;
		}

		// Display footer navigation.
		add_action( 'codename_footer_menu', array( __CLASS__, 'display_footer_menu' ) );
	}

	/**
	 * Display footer navigation menu
	 *
	 * @return void
	 */
	static function display_footer_menu() {

		// Check if there is a footer menu.
		if ( has_nav_menu( 'footer' ) ) {

			echo '<nav id="footer-links" class="footer-navigation navigation clearfix" role="navigation">';

			wp_nav_menu( array(
				'theme_location' => 'footer',
				'container'      => false,
				'menu_class'     => 'footer-navigation-menu',
				'echo'           => true,
				'fallback_cb'    => '',
				'depth'          => 1,
			) );

			echo '</nav><!-- #footer-links -->';

		}
	}

	/**
	 * Register footer navigation menu
	 *
	 * @return void
	 */
	static function register_footer_menu() {

		// Return early if Codename Theme is not active.
		if ( ! current_theme_supports( 'codename-pro' ) ) {
			return;
		}

		register_nav_menu( 'footer', esc_html__( 'Footer Navigation', 'codename-pro' ) );
	}
}

// Run Class.
add_action( 'init', array( 'Codename_Pro_Footer_Menu', 'setup' ) );

// Register footer navigation in backend.
add_action( 'after_setup_theme', array( 'Codename_Pro_Footer_Menu', 'register_footer_menu' ), 30 );