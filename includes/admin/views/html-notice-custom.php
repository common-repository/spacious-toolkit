<?php
/**
 * Admin View: Custom Notices
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div id="message" class="updated spacious-toolkit-message">
	<a class="spacious-toolkit-message-close notice-dismiss"
	   href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'spacious-toolkit-hide-notice', $notice ), 'spacious_toolkit_hide_notices_nonce', '_spacious_toolkit_notice_nonce' ) ); ?>"><?php esc_html_e( 'Dismiss', 'spacious-toolkit' ); ?></a>
	<?php echo wp_kses_post( wpautop( $notice_html ) ); ?>
</div>
