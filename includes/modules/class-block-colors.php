<?php
/**
 * Block Colors
 *
 * Adds block color settings to Customizer and generates color CSS code
 *
 * @package Codename Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Block Colors Class
 */
class Codename_Pro_Block_Colors {

	/**
	 * Block Colors Setup
	 *
	 * @return void
	 */
	static function setup() {

		// Return early if Codename Theme is not active.
		if ( ! current_theme_supports( 'codename-pro' ) ) {
			return;
		}

		// Add Custom Color CSS code to custom stylesheet output.
		add_filter( 'codename_pro_custom_css_stylesheet', array( __CLASS__, 'custom_colors_css' ) );

		// Add Custom Color Settings.
		add_action( 'customize_register', array( __CLASS__, 'color_settings' ) );
	}

	/**
	 * Adds Color CSS styles in the head area to override default colors
	 *
	 * @param String $custom_css Custom Styling CSS.
	 * @return string CSS code
	 */
	static function custom_colors_css( $custom_css ) {

		// Get Theme Options from Database.
		$theme_options = Codename_Pro_Customizer::get_theme_options();

		// Get Default Fonts from settings.
		$default_options = Codename_Pro_Customizer::get_default_options();

		// Color Variables.
		$color_variables = '';

		// Set Primary Color.
		if ( $theme_options['primary_color'] !== $default_options['primary_color'] ) {
			$color_variables .= '--primary-color: ' . $theme_options['primary_color'] . ';';
		}

		// Set Secondary Color.
		if ( $theme_options['secondary_color'] !== $default_options['secondary_color'] ) {
			$color_variables .= '--secondary-color: ' . $theme_options['secondary_color'] . ';';
		}

		// Set Accent Color.
		if ( $theme_options['accent_color'] !== $default_options['accent_color'] ) {
			$color_variables .= '--accent-color: ' . $theme_options['accent_color'] . ';';
		}

		// Set Highlight Color.
		if ( $theme_options['highlight_color'] !== $default_options['highlight_color'] ) {
			$color_variables .= '--highlight-color: ' . $theme_options['highlight_color'] . ';';
		}

		// Set Light Gray Color.
		if ( $theme_options['light_gray_color'] !== $default_options['light_gray_color'] ) {
			$color_variables .= '--light-gray-color: ' . $theme_options['light_gray_color'] . ';';
		}

		// Set Gray Color.
		if ( $theme_options['gray_color'] !== $default_options['gray_color'] ) {
			$color_variables .= '--gray-color: ' . $theme_options['gray_color'] . ';';
		}

		// Set Dark Gray Color.
		if ( $theme_options['dark_gray_color'] !== $default_options['dark_gray_color'] ) {
			$color_variables .= '--dark-gray-color: ' . $theme_options['dark_gray_color'] . ';';
		}

		// Set Color Variables.
		if ( '' !== $color_variables ) {
			$custom_css .= ':root {' . $color_variables . '}';
		}

		return $custom_css;
	}

	/**
	 * Adds all color settings in the Customizer
	 *
	 * @param object $wp_customize / Customizer Object.
	 */
	static function color_settings( $wp_customize ) {

		// Add Section for Block Colors.
		$wp_customize->add_section( 'codename_pro_section_block_colors', array(
			'title'    => esc_html__( 'Block Colors', 'codename-pro' ),
			'priority' => 100,
			'panel'    => 'codename_options_panel',
		) );

		// Get Default Colors from settings.
		//$default_options = Codename_Pro_Customizer::get_default_options();
		$default_options = codename_default_options();

		// Add Primary Color setting.
		$wp_customize->add_setting( 'codename_theme_options[primary_color]', array(
			'default'           => $default_options['primary_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'codename_theme_options[primary_color]', array(
				'label'    => esc_html_x( 'Primary', 'Color Option', 'codename-pro' ),
				'section'  => 'codename_pro_section_block_colors',
				'settings' => 'codename_theme_options[primary_color]',
				'priority' => 10,
			)
		) );

		// Add Secondary Color setting.
		$wp_customize->add_setting( 'codename_theme_options[secondary_color]', array(
			'default'           => $default_options['secondary_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'codename_theme_options[secondary_color]', array(
				'label'    => esc_html_x( 'Secondary', 'Color Option', 'codename-pro' ),
				'section'  => 'codename_pro_section_block_colors',
				'settings' => 'codename_theme_options[secondary_color]',
				'priority' => 20,
			)
		) );

		// Add Accent Color setting.
		$wp_customize->add_setting( 'codename_theme_options[accent_color]', array(
			'default'           => $default_options['accent_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'codename_theme_options[accent_color]', array(
				'label'    => esc_html_x( 'Accent', 'Color Option', 'codename-pro' ),
				'section'  => 'codename_pro_section_block_colors',
				'settings' => 'codename_theme_options[accent_color]',
				'priority' => 30,
			)
		) );

		// Add Highlight Color setting.
		$wp_customize->add_setting( 'codename_theme_options[highlight_color]', array(
			'default'           => $default_options['highlight_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'codename_theme_options[highlight_color]', array(
				'label'    => esc_html_x( 'Highlight', 'Color Option', 'codename-pro' ),
				'section'  => 'codename_pro_section_block_colors',
				'settings' => 'codename_theme_options[highlight_color]',
				'priority' => 40,
			)
		) );

		// Add Light Gray Color setting.
		$wp_customize->add_setting( 'codename_theme_options[light_gray_color]', array(
			'default'           => $default_options['light_gray_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'codename_theme_options[light_gray_color]', array(
				'label'    => esc_html_x( 'Light Gray', 'Color Option', 'codename-pro' ),
				'section'  => 'codename_pro_section_block_colors',
				'settings' => 'codename_theme_options[light_gray_color]',
				'priority' => 50,
			)
		) );

		// Add Gray Color setting.
		$wp_customize->add_setting( 'codename_theme_options[gray_color]', array(
			'default'           => $default_options['gray_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'codename_theme_options[gray_color]', array(
				'label'    => esc_html_x( 'Gray', 'Color Option', 'codename-pro' ),
				'section'  => 'codename_pro_section_block_colors',
				'settings' => 'codename_theme_options[gray_color]',
				'priority' => 60,
			)
		) );

		// Add Dark Gray Color setting.
		$wp_customize->add_setting( 'codename_theme_options[dark_gray_color]', array(
			'default'           => $default_options['dark_gray_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'codename_theme_options[dark_gray_color]', array(
				'label'    => esc_html_x( 'Dark Gray', 'Color Option', 'codename-pro' ),
				'section'  => 'codename_pro_section_block_colors',
				'settings' => 'codename_theme_options[dark_gray_color]',
				'priority' => 70,
			)
		) );
	}
}

// Run Class.
add_action( 'init', array( 'Codename_Pro_Block_Colors', 'setup' ) );
