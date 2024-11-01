<?php
/**
 * Admin View: Notice - Updating
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div id="message" class="updated spacious-toolkit-message spacious-connect">
	<p><strong><?php esc_html_e( 'Spacious Toolkit Data Update', 'spacious-toolkit' ); ?></strong>
		&#8211; <?php esc_html_e( 'Your database is being updated in the background.', 'spacious-toolkit' ); ?>
		<a href="<?php echo esc_url( add_query_arg( 'force_update_spacious_toolkit', 'true', admin_url( 'themes.php' ) ) ); ?>"><?php esc_html_e( 'Taking a while? Click here to run it now.', 'spacious-toolkit' ); ?></a>
	</p>
</div>
