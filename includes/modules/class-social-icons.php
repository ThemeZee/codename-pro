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

		// Replace menu links with social icons.
		add_filter( 'walker_nav_menu_start_el', array( __CLASS__, 'social_icons_menu_walker' ), 10, 4 );
	}

	/**
	 * Displays social icons menu
	 *
	 * @return void
	 */
	static function display_social_icons_menu( $menu ) {
		wp_nav_menu( array(
			'theme_location' => $menu,
			'container'      => false,
			'menu_class'     => $menu . '-menu social-icons-menu',
			'echo'           => true,
			'fallback_cb'    => '',
			'link_before'    => '<span class = "screen-reader-text">',
			'link_after'     => '</span>',
			'depth'          => 1,
		) );
	}

	/**
	 * Return SVG markup for social icons.
	 *
	 * @param string $icon SVG icon id.
	 * @return string $svg SVG markup.
	 */
	function get_social_svg( $icon = null ) {
		// Return early if no icon was defined.
		if ( empty( $icon ) ) {
			return;
		}

		// Create SVG markup.
		$svg  = '<svg class="icon icon-' . esc_attr( $icon ) . '" aria-hidden="true" role="img">';
		$svg .= ' <use xlink:href="' . CODENAME_PRO_PLUGIN_URL . 'assets/icons/social-icons.svg#icon-' . esc_html( $icon ) . '"></use> ';
		$svg .= '</svg>';

		return $svg;
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
	function social_icons_menu_walker( $item_output, $item, $depth, $args ) {

		// Get supported social icons.
		$social_icons = self::supported_social_icons();

		// Change SVG icon inside social links menu if there is supported URL.
		if ( 'social-header' === $args->theme_location || 'social-footer' === $args->theme_location ) {
			$icon = 'star';
			foreach ( $social_icons as $attr => $value ) {
				if ( false !== strpos( $item_output, $attr ) ) {
					$icon = esc_attr( $value );
				}
			}
			$item_output = str_replace( $args->link_after, '</span>' . self::get_social_svg( $icon ), $item_output );
		}

		return $item_output;
	}

	/**
	 * Returns an array of supported social links (URL and icon name).
	 *
	 * @return array $social_links_icons
	 */
	function supported_social_icons() {
		// Supported social links icons.
		$supported_social_icons = array(
			'500px.com'       => '500px',
			'amazon'          => 'amazon',
			'apple'           => 'apple',
			'bandcamp.com'    => 'bandcamp',
			'behance.net'     => 'behance',
			'bitbucket.org'   => 'bitbucket',
			'codepen.io'      => 'codepen',
			'deviantart.com'  => 'deviantart',
			'digg.com'        => 'digg',
			'dribbble.com'    => 'dribbble',
			'dropbox.com'     => 'dropbox',
			'etsy.com'        => 'etsy',
			'facebook.com'    => 'facebook',
			'feed'            => 'feed',
			'flickr.com'      => 'flickr',
			'foursquare.com'  => 'foursquare',
			'plus.google.com' => 'google-plus',
			'github.com'      => 'github',
			'instagram.com'   => 'instagram',
			'linkedin.com'    => 'linkedin',
			'mailto:'         => 'envelope-o',
			'medium.com'      => 'medium',
			'meetup.com'      => 'meetup',
			'pinterest.com'   => 'pinterest-p',
			'getpocket.com'   => 'get-pocket',
			'reddit.com'      => 'reddit-alien',
			'skype.com'       => 'skype',
			'skype:'          => 'skype',
			'slideshare.net'  => 'slideshare',
			'snapchat.com'    => 'snapchat-ghost',
			'soundcloud.com'  => 'soundcloud',
			'spotify.com'     => 'spotify',
			'stumbleupon.com' => 'stumbleupon',
			'tumblr.com'      => 'tumblr',
			'twitch.tv'       => 'twitch',
			'twitter.com'     => 'twitter',
			'vimeo.com'       => 'vimeo',
			'vine.co'         => 'vine',
			'vk.com'          => 'vk',
			'wordpress.org'   => 'wordpress',
			'wordpress.com'   => 'wordpress',
			'xing.com'        => 'xing',
			'yelp.com'        => 'yelp',
			'youtube.com'     => 'youtube',
		);

		return $supported_social_icons;
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
			'social-header' => esc_html__( 'Social Icons (Header)', 'codename-pro' ),
			'social-footer' => esc_html__( 'Social Icons (Footer)', 'codename-pro' ),
		) );

	}
}

// Run Class.
add_action( 'init', array( 'Codename_Pro_Social_Icons', 'setup' ) );

// Register navigation menus in backend.
add_action( 'after_setup_theme', array( 'Codename_Pro_Social_Icons', 'register_nav_menus' ), 30 );
