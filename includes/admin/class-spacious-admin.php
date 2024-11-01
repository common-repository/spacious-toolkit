<?php
/**
 * Spacious Toolkit Admin.
 *
 * @class    SPT_Admin
 * @version  1.0.0
 * @package  Spacious_Toolkit/Admin
 * @category Admin
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * SPT_Admin Class
 */
class SPT_Admin {

	/**
	 * Hook in tabs.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'includes' ) );
		add_action( 'current_screen', array( $this, 'conditional_includes' ) );
		add_action( 'admin_footer', 'spacious_toolkit_print_js', 25 );
//		add_filter( 'admin_footer_text', array( $this, 'admin_footer_text' ), 1 );
	}

	/**
	 * Includes any classes we need within admin.
	 */
	public function includes() {
		include_once( dirname( __FILE__ ) . '/class-spacious-admin-notices.php' );
	}

	/**
	 * Include admin files conditionally.
	 */
	public function conditional_includes() {
		if ( ! $screen = get_current_screen() ) {
			return;
		}
	}

	/**
	 * Change the admin footer text on Spacious Toolkit admin pages.
	 *
	 * @param  string $footer_text
	 *
	 * @return string
	 */
	public function admin_footer_text( $footer_text ) {
		if ( ! current_user_can( 'manage_options' ) ) {
			return $footer_text;
		}

		$current_screen = get_current_screen();

		// Check to make sure we're on a Spacious Toolkit admin page.
		if ( isset( $current_screen->id ) ) {
			// Change the footer text.
			if ( ! get_option( 'spacious_toolkit_admin_footer_text_rated' ) ) {
				$footer_text = sprintf( __( 'If you like <strong>Spacious Toolkit</strong> please leave us a %s&#9733;&#9733;&#9733;&#9733;&#9733;%s rating. A huge thanks in advance!', 'spacious-toolkit' ), '<a href="https://wordpress.org/support/view/plugin-reviews/spacious-toolkit?filter=5#postform" target="_blank" class="spacious-toolkit-rating-link" data-rated="' . esc_attr__( 'Thanks :)', 'spacious-toolkit' ) . '">', '</a>' );
				spacious_toolkit_enqueue_js( "
					jQuery( 'a.spacious-toolkit-rating-link' ).click( function() {
						jQuery.post( '" . Spacious_Toolkit()->ajax_url() . "', { action: 'spacious_toolkit_rated' } );
						jQuery( this ).parent().text( jQuery( this ).data( 'rated' ) );
					});
				" );
			} else {
				$footer_text = __( 'Thank you for creating with Spacious Toolkit.', 'spacious-toolkit' );
			}
		}

		return $footer_text;
	}
}

new SPT_Admin();
