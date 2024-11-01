<?php
/**
 * Admin View: Notice - Update
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div id="message" class="updated spacious-toolkit-message spacious-connect">
	<p><strong><?php esc_html_e( 'Spacious Toolkit Data Update', 'spacious-toolkit' ); ?></strong>
		&#8211; <?php esc_html_e( 'We need to update your site\'s database to the latest version.', 'spacious-toolkit' ); ?>
	</p>

	<p class="submit">
		<a href="<?php echo esc_url( add_query_arg( 'do_update_spacious_toolkit', 'true', admin_url( 'themes.php' ) ) ); ?>"
		   class="spacious-update-now button-primary"><?php esc_html_e( 'Run the updater', 'spacious-toolkit' ); ?></a>
	</p>
</div>

<script type="text/javascript">
	jQuery( '.spacious-update-now' ).click( 'click', function () {
		return window.confirm( '<?php echo esc_js( esc_html__( 'It is strongly recommended that you backup your database before proceeding. Are you sure you wish to run the updater now?', 'spacious-toolkit' ) ); ?>' ); // jshint ignore:line
	} );
</script>
