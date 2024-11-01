<?php
/**
 * Spacious_Toolkit Updates
 *
 * Function for updating data, used by the background updater.
 *
 * @author   ThemeGrill
 * @category Core
 * @package  Spacious_Toolkit/Functions
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function spacious_update_100_db_version() {
	SPT_Install::update_db_version( '1.0.0' );
}
