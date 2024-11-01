<?php
/**
 * Admin View: Notice - Updated
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div id="message" class="updated spacious-toolkit-message spacious-connect spacious-toolkit-message--success">
	<a class="spacious-toolkit-message-close notice-dismiss"
	   href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'spacious-toolkit-hide-notice', 'update', remove_query_arg( 'do_update_spacious_toolkit' ) ), 'spacious_toolkit_hide_notices_nonce', '_spacious_toolkit_notice_nonce' ) ); ?>"><?php esc_html_e( 'Dismiss', 'spacious-toolkit' ); ?></a>

	<p><?php esc_html_e( 'Spacious Toolkit data update complete. Thank you for updating to the latest version!', 'spacious-toolkit' ); ?></p>
</div>
