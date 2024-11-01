<?php
/**
 * Spacious_Toolkit SPT_AJAX
 *
 * AJAX Event Handler
 *
 * @class    SPT_AJAX
 * @version  1.0.0
 * @package  Spacious_Toolkit/Classes
 * @category Class
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * SPT_AJAX Class
 */
class SPT_AJAX {

	/**
	 * Hooks in ajax handlers.
	 */
	public static function init() {
		self::add_ajax_events();
	}

	/**
	 * Hook in methods - uses WordPress ajax handlers (admin-ajax).
	 */
	public static function add_ajax_events() {
		// SPACIOUS_TOOLKIT_EVENT => nopriv
		$ajax_events = array(
			'delete_custom_sidebar' => false,
			'rated'                 => false,
		);

		foreach ( $ajax_events as $ajax_event => $nopriv ) {
			add_action( 'wp_ajax_spacious_toolkit_' . $ajax_event, array( __CLASS__, $ajax_event ) );

			if ( $nopriv ) {
				add_action( 'wp_ajax_nopriv_spacious_toolkit_' . $ajax_event, array( __CLASS__, $ajax_event ) );
			}
		}
	}

	/**
	 * Triggered when clicking the rating footer.
	 */
	public static function rated() {
		if ( ! current_user_can( 'manage_options' ) ) {
			die( - 1 );
		}

		update_option( 'spacious_toolkit_admin_footer_text_rated', 1 );
		die();
	}
}

SPT_AJAX::init();
