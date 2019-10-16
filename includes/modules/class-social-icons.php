<?php
/**
 * Social Icons Menus
 *
 * @package Codename Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Header Bar Class
 */
class Codename_Pro_Social_Icons {

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

		// Display Social Icons in Header.
		//add_action( 'codename_before_header', array( __CLASS__, 'display_social_icons' ), 20 );
	}

	/**
	 * Displays social icons menu
	 *
	 * @return void
	 */
	static function display_social_icons() {

	}

	/**
	 * Register navigation menus
	 *
	 * @return void
	 */
	static function register_nav_menus() {

		// Return early if Codename Theme is not active.
		if ( ! current_theme_supports( 'codename-pro' ) ) {
			return;
		}

		register_nav_menus( array(
			'social-top'    => esc_html__( 'Social Icons (Top Navigation)', 'codename-pro' ),
			'social-header' => esc_html__( 'Social Icons (Main Navigation)', 'codename-pro' ),
			'social-footer' => esc_html__( 'Social Icons (Footer Navigation)', 'codename-pro' ),
		) );

	}
}

// Run Class.
add_action( 'init', array( 'Codename_Pro_Social_Icons', 'setup' ) );

// Register navigation menus in backend.
add_action( 'after_setup_theme', array( 'Codename_Pro_Social_Icons', 'register_nav_menus' ), 30 );
