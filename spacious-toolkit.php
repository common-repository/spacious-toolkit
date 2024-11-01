<?php
/**
 * Plugin Name: Spacious Toolkit
 * Plugin URI: https://themegrill.com/themes/spacious/
 * Description: Spacious Toolkit is a companion for Spacious WordPress theme by ThemeGrill
 * Version: 1.0.5
 * Author: ThemeGrill
 * Author URI: https://themegrill.com/
 * License: GPLv3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 *
 * Text Domain: spacious-toolkit
 * Domain Path: /languages/
 *
 * @package  Spacious Toolkit
 * @category Core
 * @author   ThemeGrill
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define SPACIOUS_TOOLKIT_PLUGIN_FILE.
if ( ! defined( 'SPACIOUS_TOOLKIT_PLUGIN_FILE' ) ) {
	define( 'SPACIOUS_TOOLKIT_PLUGIN_FILE', __FILE__ );
}

// Include the main Spacious Toolkit class.
if ( ! class_exists( 'Spacious_Toolkit' ) ) {
	include_once dirname( __FILE__ ) . '/includes/class-spacious-toolkit.php';
}

/**
 * Main instance of Spacious Toolkit.
 *
 * Returns the main instance of Spacious Toolkit to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return Spacious_Toolkit
 */
function Spacious_Toolkit() {
	return Spacious_Toolkit::get_instance();
}

// Global for backwards compatibility.
$GLOBALS['spacious_toolkit'] = Spacious_Toolkit();
