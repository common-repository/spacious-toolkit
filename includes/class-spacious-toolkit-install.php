<?php
/**
 * Installation related functions and actions.
 *
 * @class    SPT_Install
 * @version  1.0.0
 * @package  Spacious_Toolkit/Classes
 * @category Admin
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * SPT_Install Class.
 */
class SPT_Install {

	/** @var array DB updates and callbacks that need to be run per version */
	private static $db_updates
		= array(
			'1.0.0' => array(
				'spacious_update_100_db_version',
			),
		);

	/** @var object Background update class */
	private static $background_updater;

	/**
	 * Hook in tabs.
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'check_version' ), 5 );
		add_action( 'init', array( __CLASS__, 'init_background_updater' ), 5 );
		add_action( 'admin_init', array( __CLASS__, 'install_actions' ) );
		add_filter( 'plugin_row_meta', array( __CLASS__, 'plugin_row_meta' ), 10, 2 );
	}

	/**
	 * Init background updates.
	 */
	public static function init_background_updater() {
		include_once( dirname( __FILE__ ) . '/class-spacious-background-updater.php' );
		self::$background_updater = new SPT_Background_Updater();
	}

	/**
	 * Check Spacious_Toolkit version and run the updater is required.
	 *
	 * This check is done on all requests and runs if the versions do not match.
	 */
	public static function check_version() {
		if ( ! defined( 'IFRAME_REQUEST' ) && get_option( 'spacious_toolkit_version' ) !== Spacious_Toolkit()->version ) {
			self::install();
			do_action( 'spacious_toolkit_updated' );
		}
	}

	/**
	 * Install actions when a update button is clicked within the admin area.
	 *
	 * This function is hooked into admin_init to affect admin only.
	 */
	public static function install_actions() {
		if ( ! empty( $_GET['do_update_spacious_toolkit'] ) ) {
			self::update();
			SPT_Admin_Notices::add_notice( 'update' );
		}

		if ( ! empty( $_GET['force_update_spacious_toolkit'] ) ) {
			do_action( 'wp_spacious_updater_cron' );
			wp_safe_redirect( admin_url( 'themes.php' ) );
		}
	}

	/**
	 * Install ST.
	 */
	public static function install() {
		global $wpdb;

		// Check if we are not already running this routine.
		if ( 'yes' === get_transient( 'spt_installing' ) ) {
			return;
		}

		// If we made it till here nothing is running yet, lets set the transient now.
		set_transient( 'spt_installing', 'yes', MINUTE_IN_SECONDS * 10 );

		if ( ! defined( 'SPACIOUS_TOOLKIT_INSTALLING' ) ) {
			define( 'SPACIOUS_TOOLKIT_INSTALLING', true );
		}

		// Ensure needed classes are loaded.
		include_once( dirname( __FILE__ ) . '/admin/class-spacious-admin-notices.php' );

		// Queue upgrades wizard
		$current_spt_version = get_option( 'spacious_toolkit_version', null );
		$current_db_version  = get_option( 'spacious_toolkit_db_version', null );

		SPT_Admin_Notices::remove_all_notices();

		// No versions? This is a new install :)
		if ( is_null( $current_spt_version ) && is_null( $current_db_version ) && apply_filters( 'spacious_toolkit_enable_setup_wizard', true ) ) {
			set_transient( '_spacious_activation_redirect', 1, 30 );
		}

		if ( ! is_null( $current_db_version ) && version_compare( $current_db_version, max( array_keys( self::$db_updates ) ), '<' ) ) {
			SPT_Admin_Notices::add_notice( 'update' );
		} else {
			self::update_db_version();
		}

		self::update_spt_version();

		delete_transient( 'spt_installing' );

		/*
		 * Deletes all expired transients. The multi-table delete syntax is used
		 * to delete the transient record from table a, and the corresponding
		 * transient_timeout record from table b.
		 *
		 * Based on code inside core's upgrade_network() function.
		 */
		$sql
			= "DELETE a, b FROM $wpdb->options a, $wpdb->options b
			WHERE a.option_name LIKE %s
			AND a.option_name NOT LIKE %s
			AND b.option_name = CONCAT( '_transient_timeout_', SUBSTRING( a.option_name, 12 ) )
			AND b.option_value < %d";
		$wpdb->query( $wpdb->prepare( $sql, $wpdb->esc_like( '_transient_' ) . '%', $wpdb->esc_like( '_transient_timeout_' ) . '%', time() ) );

		// Trigger action
		do_action( 'spacious_toolkit_installed' );
	}

	/**
	 * Update Spacious_Toolkit version to current.
	 */
	private static function update_spt_version() {
		delete_option( 'spacious_toolkit_version' );
		add_option( 'spacious_toolkit_version', Spacious_Toolkit()->version );
	}

	/**
	 * Push all needed DB updates to the queue for processing.
	 */
	private static function update() {
		$current_db_version = get_option( 'spacious_toolkit_db_version' );
		$update_queued      = false;

		foreach ( self::$db_updates as $version => $update_callbacks ) {
			if ( version_compare( $current_db_version, $version, '<' ) ) {
				foreach ( $update_callbacks as $update_callback ) {
					self::$background_updater->push_to_queue( $update_callback );
					$update_queued = true;
				}
			}
		}

		if ( $update_queued ) {
			self::$background_updater->save()
			                         ->dispatch();
		}
	}

	/**
	 * Update DB version to current.
	 *
	 * @param string $version
	 */
	public static function update_db_version( $version = null ) {
		delete_option( 'spacious_toolkit_db_version' );
		add_option( 'spacious_toolkit_db_version', is_null( $version ) ? Spacious_Toolkit()->version : $version );
	}

	/**
	 * Display row meta in the Plugins list table.
	 *
	 * @param  array  $plugin_meta
	 * @param  string $plugin_file
	 *
	 * @return array
	 */
	public static function plugin_row_meta( $plugin_meta, $plugin_file ) {
		if ( $plugin_file == SPT_PLUGIN_BASENAME ) {
			$new_plugin_meta = array(
				'docs'    => '<a href="' . esc_url( apply_filters( 'spacious_toolkit_docs_url', 'http://docs.themegrill.com/spacious/' ) ) . '" title="' . esc_attr( __( 'View Spacious Toolkit Documentation', 'spacious-toolkit' ) ) . '">' . __( 'Docs', 'spacious-toolkit' ) . '</a>',
				'support' => '<a href="' . esc_url( apply_filters( 'spacious_toolkit_support_url', 'http://themegrill.com/support-forum/' ) ) . '" title="' . esc_attr( __( 'Visit Free Customer Support Forum', 'spacious-toolkit' ) ) . '">' . __( 'Free Support', 'spacious-toolkit' ) . '</a>',
			);

			return array_merge( $plugin_meta, $new_plugin_meta );
		}

		return (array) $plugin_meta;
	}
}

SPT_Install::init();
