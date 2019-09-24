<?php
/**
 * Customizer
 *
 * Setup the Customizer and theme options for the Pro plugin
 *
 * @package Codename Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizer Class
 */
class Codename_Pro_Customizer {

	/**
	 * Customizer Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Codename Theme is not active.
		if ( ! current_theme_supports( 'codename-pro' ) ) {
			return;
		}

		// Enqueue scripts and styles in the Customizer.
		add_action( 'customize_preview_init', array( __CLASS__, 'customize_preview_js' ) );
		add_action( 'customize_controls_print_styles', array( __CLASS__, 'customize_preview_css' ) );

		// Remove Upgrade section.
		remove_action( 'customize_register', 'codename_customize_register_upgrade_settings' );
	}

	/**
	 * Get saved user settings from database or plugin defaults
	 *
	 * @return array
	 */
	static function get_theme_options() {

		// Merge Theme Options Array from Database with Default Options Array.
		$theme_options = wp_parse_args( get_option( 'codename_theme_options', array() ), self::get_default_options() );

		// Return theme options.
		return $theme_options;
	}

	/**
	 * Returns the default settings of the plugin
	 *
	 * @return array
	 */
	static function get_default_options() {

		$default_options = array(
			'license_key'           => '',
			'license_status'        => 'inactive',
			'header_text'           => '',
			'header_date'           => false,
			'header_search'         => false,
			'author_bio'            => false,
			'footer_content'        => false,
			'footer_text'           => '',
			'credit_link'           => true,
			'scroll_to_top'         => false,
			'page_background_color' => '#ffffff',
			'link_color'            => '#e59f00',
			'link_hover_color'      => '#c68000',
			'header_color'          => '#ffffff',
			'title_color'           => '#202020',
			'title_hover_color'     => '#e59f00',
			'footer_color'          => '#202020',
			'text_font'             => 'SystemFontStack',
			'title_font'            => 'SystemFontStack',
			'title_is_bold'         => true,
			'title_is_uppercase'    => false,
			'navi_font'             => 'SystemFontStack',
			'navi_is_bold'          => false,
			'navi_is_uppercase'     => false,
		);

		return $default_options;
	}

	/**
	 * Embed JS file to make Theme Customizer preview reload changes asynchronously.
	 *
	 * @return void
	 */
	static function customize_preview_js() {
		wp_enqueue_script( 'codename-pro-customizer-js', CODENAME_PRO_PLUGIN_URL . 'assets/js/customizer.js', array( 'customize-preview' ), CODENAME_PRO_VERSION, true );
	}

	/**
	 * Embed CSS styles for the theme options in the Customizer
	 *
	 * @return void
	 */
	static function customize_preview_css() {
		wp_enqueue_style( 'codename-pro-customizer-css', CODENAME_PRO_PLUGIN_URL . 'assets/css/customizer.css', array(), CODENAME_PRO_VERSION );
	}
}

// Run Class.
add_action( 'init', array( 'Codename_Pro_Customizer', 'setup' ) );
