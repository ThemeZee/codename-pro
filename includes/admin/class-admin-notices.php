<?php
/**
 * Codename Pro Admin Notices
 *
 * Adds admin notices to the WordPress Dashboard
 *
 * @package Codename Pro
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Admin Notices Class
 */
class Codename_Pro_Admin_Notices {

	/**
	 * Setup the Settings Page class
	 *
	 * @return void
	 */
	static function setup() {

		// Add Missing Theme Notice.
		add_action( 'admin_notices', array( __CLASS__, 'activate_license' ) );

		// Add Missing Theme Notice.
		add_action( 'admin_notices', array( __CLASS__, 'expired_license' ) );

		// Dismiss Notices.
		add_action( 'init', array( __CLASS__, 'dismiss_notices' ) );

	}

	/**
	 * Display activate license notice
	 *
	 * @return void
	 */
	static function activate_license() {
		global $pagenow;

		// Get Settings.
		$options = Codename_Pro_Settings::instance();

		if ( 'valid' !== $options->get( 'license_status' ) && 'expired' !== $options->get( 'license_status' ) && in_array( $pagenow, array( 'index.php', 'update-core.php', 'plugins.php', 'themes.php' ) ) && ! isset( $_GET['page'] ) && current_theme_supports( 'codename-pro' ) && ! get_transient( 'codename_pro_activate_license_dismissed' ) && current_user_can( 'edit_theme_options' ) ) : ?>

			<div class="notice notice-info">
				<p>
					<?php printf( __( 'Please enter your license key for the %1$s add-on in order to receive updates and support. <a href="%2$s">Enter License Key</a>', 'codename-pro' ),
						CODENAME_PRO_NAME,
						admin_url( 'themes.php?page=codename-pro' )
					);
					?>
					<a style="float: right" href="<?php echo wp_nonce_url( add_query_arg( array( 'codename_pro_action' => 'dismiss_notices', 'codename_pro_notice' => 'activate_license' ) ), 'codename_pro_dismiss_notice', 'codename_pro_dismiss_notice_nonce' ); ?>"><?php _e( 'Dismiss Notice', 'codename-pro' ); ?></a>
				</p>
			</div>

		<?php
		endif;

	}

	/**
	 * Display expired license notice
	 *
	 * @return void
	 */
	static function expired_license() {
		global $pagenow;

		// Get Settings.
		$options = Codename_Pro_Settings::instance();

		if ( 'expired' === $options->get( 'license_status' ) && in_array( $pagenow, array( 'index.php', 'update-core.php', 'plugins.php', 'themes.php' ) ) && ! isset( $_GET['page'] ) && current_theme_supports( 'codename-pro' ) && ! get_transient( 'codename_pro_expired_license_dismissed' ) && current_user_can( 'edit_theme_options' ) ) : ?>

			<div class="notice notice-warning">
				<p>
					<?php printf( __( 'Your license for %1$s has expired. Please <a href="%2$s">renew</a> to continue getting updates and support!', 'codename-pro' ),
						CODENAME_PRO_NAME,
						admin_url( 'themes.php?page=codename-pro' )
					);
					?>
					<a style="float: right" href="<?php echo wp_nonce_url( add_query_arg( array( 'codename_pro_action' => 'dismiss_notices', 'codename_pro_notice' => 'expired_license' ) ), 'codename_pro_dismiss_notice', 'codename_pro_dismiss_notice_nonce' ); ?>"><?php _e( 'Dismiss Notice', 'codename-pro' ); ?></a>
				</p>
			</div>

		<?php
		endif;

	}

	/**
	 * Dismiss admin notices when Dismiss links are clicked
	 *
	 * @return void
	 */
	static function dismiss_notices() {

		// Return early if codename_pro_action was not fired.
		if ( ! isset( $_REQUEST['codename_pro_action'] ) ) {
			return;
		}

		if ( ! isset( $_GET['codename_pro_dismiss_notice_nonce'] ) || ! wp_verify_nonce( $_GET['codename_pro_dismiss_notice_nonce'], 'codename_pro_dismiss_notice' ) ) {
			wp_die( __( 'Security check failed', 'codename-pro' ), __( 'Error', 'codename-pro' ), array( 'response' => 403 ) );
		}

		if ( isset( $_GET['codename_pro_notice'] ) ) {
			set_transient( 'codename_pro_' . $_GET['codename_pro_notice'] . '_dismissed', 1, DAY_IN_SECONDS * 60 );
			wp_redirect( remove_query_arg( array( 'codename_pro_action', 'codename_pro_notice', 'codename_pro_dismiss_notice_nonce' ) ) );
			exit;
		}

	}
}

// Run Codename Pro Admin Notices Class.
Codename_Pro_Admin_Notices::setup();
