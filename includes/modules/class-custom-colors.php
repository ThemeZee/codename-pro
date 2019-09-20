<?php
/**
 * Theme Colors
 *
 * Adds theme color settings to Customizer and generates color CSS code
 *
 * @package Codename Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme Colors Class
 */
class Codename_Pro_Theme_Colors {

	/**
	 * Theme Colors Setup
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

		// Set Page Background Color.
		if ( $theme_options['page_background_color'] !== $default_options['page_background_color'] ) {
			$color_variables .= '--page-background-color: ' . $theme_options['page_background_color'] . ';';

			// Check if a dark background color was chosen.
			if ( self::is_color_dark( $theme_options['page_background_color'] ) ) {
				$color_variables .= '--text-color: rgba(255, 255, 255, 0.9);';
				$color_variables .= '--medium-text-color: rgba(255, 255, 255, 0.7);';
				$color_variables .= '--light-text-color: rgba(255, 255, 255, 0.5);';
				$color_variables .= '--page-border-color: rgba(255, 255, 255, 0.1);';
				$color_variables .= '--page-light-bg-color: rgba(255, 255, 255, 0.05);';
			}
		}

		// Set Link Color.
		if ( $theme_options['link_color'] !== $default_options['link_color'] ) {
			$color_variables .= '--link-color: ' . $theme_options['link_color'] . ';';
			$color_variables .= '--button-color: ' . $theme_options['link_color'] . ';';
		}

		// Set Link Hover Color.
		if ( $theme_options['link_hover_color'] !== $default_options['link_hover_color'] ) {
			$color_variables .= '--link-hover-color: ' . $theme_options['link_hover_color'] . ';';
			$color_variables .= '--button-hover-color: ' . $theme_options['link_hover_color'] . ';';
		}

		// Set Header Color.
		if ( $theme_options['header_color'] !== $default_options['header_color'] ) {
			$color_variables .= '--header-background-color: ' . $theme_options['header_color'] . ';';

			// Check if a light background color was chosen.
			if ( self::is_color_light( $theme_options['header_color'] ) ) {
				$color_variables .= '--header-text-color: rgba(0, 0, 0, 0.95);';
				$color_variables .= '--header-text-hover-color: rgba(0, 0, 0, 0.5);';
				$color_variables .= '--header-border-color: rgba(0, 0, 0, 0.1);';
			}
		}

		// Set Title Color.
		if ( $theme_options['title_color'] !== $default_options['title_color'] ) {
			$color_variables .= '--title-color: ' . $theme_options['title_color'] . ';';
		}

		// Set Title Hover Color.
		if ( $theme_options['title_hover_color'] !== $default_options['title_hover_color'] ) {
			$color_variables .= '--title-hover-color: ' . $theme_options['title_hover_color'] . ';';
		}

		// Set Footer Color.
		if ( $theme_options['footer_color'] !== $default_options['footer_color'] ) {
			$color_variables .= '--footer-background-color: ' . $theme_options['footer_color'] . ';';

			// Check if a light background color was chosen.
			if ( self::is_color_light( $theme_options['footer_color'] ) ) {
				$color_variables .= '--footer-text-color: #242424;';
				$color_variables .= '--footer-link-color: rgba(0, 0, 0, 0.6);';
				$color_variables .= '--footer-link-hover-color: #242424;';
			}
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

		// Add Section for Theme Colors.
		$wp_customize->add_section( 'codename_pro_section_theme_colors', array(
			'title'    => esc_html__( 'Theme Colors', 'codename-pro' ),
			'priority' => 60,
			'panel'    => 'codename_options_panel',
		) );

		// Get Default Colors from settings.
		$default_options = Codename_Pro_Customizer::get_default_options();

		// Add Page Background Color setting.
		$wp_customize->add_setting( 'codename_theme_options[page_background_color]', array(
			'default'           => $default_options['page_background_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'codename_theme_options[page_background_color]', array(
				'label'    => esc_html_x( 'Page Background', 'Color Option', 'codename' ),
				'section'  => 'codename_pro_section_theme_colors',
				'settings' => 'codename_theme_options[page_background_color]',
				'priority' => 5,
			)
		) );

		// Add Link Color setting.
		$wp_customize->add_setting( 'codename_theme_options[link_color]', array(
			'default'           => $default_options['link_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'codename_theme_options[link_color]', array(
				'label'    => esc_html_x( 'Links', 'Color Option', 'codename' ),
				'section'  => 'codename_pro_section_theme_colors',
				'settings' => 'codename_theme_options[link_color]',
				'priority' => 10,
			)
		) );

		// Add Link Hover Color setting.
		$wp_customize->add_setting( 'codename_theme_options[link_hover_color]', array(
			'default'           => $default_options['link_hover_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'codename_theme_options[link_hover_color]', array(
				'label'    => esc_html_x( 'Link Hover', 'Color Option', 'codename' ),
				'section'  => 'codename_pro_section_theme_colors',
				'settings' => 'codename_theme_options[link_hover_color]',
				'priority' => 20,
			)
		) );

		// Add Header Color setting.
		$wp_customize->add_setting( 'codename_theme_options[header_color]', array(
			'default'           => $default_options['header_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'codename_theme_options[header_color]', array(
				'label'    => esc_html_x( 'Header', 'Color Option', 'codename' ),
				'section'  => 'codename_pro_section_theme_colors',
				'settings' => 'codename_theme_options[header_color]',
				'priority' => 30,
			)
		) );

		// Add Titles Color setting.
		$wp_customize->add_setting( 'codename_theme_options[title_color]', array(
			'default'           => $default_options['title_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'codename_theme_options[title_color]', array(
				'label'    => esc_html_x( 'Titles', 'Color Option', 'codename' ),
				'section'  => 'codename_pro_section_theme_colors',
				'settings' => 'codename_theme_options[title_color]',
				'priority' => 40,
			)
		) );

		// Add Title Hover Color setting.
		$wp_customize->add_setting( 'codename_theme_options[title_hover_color]', array(
			'default'           => $default_options['title_hover_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'codename_theme_options[title_hover_color]', array(
				'label'    => esc_html_x( 'Title Hover', 'Color Option', 'codename' ),
				'section'  => 'codename_pro_section_theme_colors',
				'settings' => 'codename_theme_options[title_hover_color]',
				'priority' => 50,
			)
		) );

		// Add Footer Color setting.
		$wp_customize->add_setting( 'codename_theme_options[footer_color]', array(
			'default'           => $default_options['footer_color'],
			'type'              => 'option',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize, 'codename_theme_options[footer_color]', array(
				'label'    => esc_html_x( 'Footer Widgets', 'Color Option', 'codename' ),
				'section'  => 'codename_pro_section_theme_colors',
				'settings' => 'codename_theme_options[footer_color]',
				'priority' => 60,
			)
		) );
	}

	/**
	 * Returns color brightness.
	 *
	 * @param int Number of brightness.
	 */
	static function get_color_brightness( $hex_color ) {

		// Remove # string.
		$hex_color = str_replace( '#', '', $hex_color );

		// Convert into RGB.
		$r = hexdec( substr( $hex_color, 0, 2 ) );
		$g = hexdec( substr( $hex_color, 2, 2 ) );
		$b = hexdec( substr( $hex_color, 4, 2 ) );

		return ( ( ( $r * 299 ) + ( $g * 587 ) + ( $b * 114 ) ) / 1000 );
	}

	/**
	 * Check if the color is light.
	 *
	 * @param bool True if color is light.
	 */
	static function is_color_light( $hex_color ) {
		return ( self::get_color_brightness( $hex_color ) > 130 );
	}

	/**
	 * Check if the color is dark.
	 *
	 * @param bool True if color is dark.
	 */
	static function is_color_dark( $hex_color ) {
		return ( self::get_color_brightness( $hex_color ) <= 130 );
	}
}

// Run Class.
add_action( 'init', array( 'Codename_Pro_Theme_Colors', 'setup' ) );
