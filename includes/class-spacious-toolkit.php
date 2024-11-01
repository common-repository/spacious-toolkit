<?php
/**
 * Spacious Toolkit setup
 *
 * @author   ThemeGrill
 * @category Core
 * @package  Spacious_ToolKit
 * @since    1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main Spacious Toolkit Class.
 *
 * @class   Spacious_ToolKit
 * @version 1.0.0
 */
final class Spacious_Toolkit {

	/**
	 * Plugin Version.
	 *
	 * @var string
	 */
	public $version = '1.0.5';

	/**
	 * The single instance of the class.
	 *
	 * @var object
	 */
	protected static $_instance = null;

	/**
	 * Array of deprecated hook handlers.
	 *
	 * @var array of ORR_Deprecated_Hooks
	 */
	public $deprecated_hook_handlers = array();

	/**
	 * Main Spacious Toolkit Instance.
	 *
	 * Ensure only one instance of Spacious Toolkit is loaded or can be loaded.
	 *
	 * @static
	 * @see    SPT()
	 * @return Spacious_Toolkit - Main instance.
	 */
	public static function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'spacious-toolkit' ), '1.0.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'spacious-toolkit' ), '1.0.0' );
	}

	/**
	 * Spacious Toolkit Constructor.
	 *
	 * @since 1.0.0
	 */
	private function __construct() {
		$this->define_constants();
		$this->includes();
		$this->init_hooks();

		do_action( 'spacious_toolkit_loaded' );
	}

	/**
	 * Hook into actions and filters.
	 *
	 * @since 1.0.0
	 */
	private function init_hooks() {
		register_activation_hook( SPACIOUS_TOOLKIT_PLUGIN_FILE, array(
			'SPT_Install',
			'install',
		) );

		add_action( 'init', array(
			$this,
			'load_plugin_textdomain',
		) );

		add_action( 'admin_notices', array(
			$this,
			'theme_support_missing_notice',
		) );
	}

	/**
	 * Define Spacious Toolkit Constants.
	 *
	 * @since 1.0.0
	 */
	private function define_constants() {
		$this->define( 'SPT_ABSPATH', dirname( SPACIOUS_TOOLKIT_PLUGIN_FILE ) . '/' );
		$this->define( 'SPT_PLUGIN_BASENAME', plugin_basename( SPACIOUS_TOOLKIT_PLUGIN_FILE ) );
		$this->define( 'SPT_VERSION', $this->version );
		$this->define( 'SPT_TEMPLATE_DEBUG_MODE', false );
	}

	/**
	 * Define constant if not already set.
	 *
	 * @param string      $name  Constant name.
	 * @param string|bool $value Constant value.
	 *
	 * @since 1.0.0
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * What type of request is this?
	 *
	 * @param  string $type admin or frontend.
	 *
	 * @return bool
	 */
	private function is_request( $type ) {
		switch ( $type ) {
			case 'admin' :
				return is_admin();
			case 'frontend' :
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
		}
	}

	/**
	 * Includes the required core files used in admin and on the frontend.
	 *
	 * @since 1.0.0
	 */
	public function includes() {

		/**
		 * Core classes.
		 */
		include_once( SPT_ABSPATH . 'includes/functions-spacious-core.php' );
		include_once( SPT_ABSPATH . 'includes/functions-spacious-elementor.php' );
		include_once( SPT_ABSPATH . 'includes/class-spacious-autoloader.php' );
		include_once( SPT_ABSPATH . 'includes/class-spacious-toolkit-install.php' );
		include_once( SPT_ABSPATH . 'includes/class-spacious-ajax.php' );

		if ( $this->is_request( 'admin' ) ) {
			include_once( SPT_ABSPATH . 'includes/admin/class-spacious-admin.php' );
		}

	}

	/**
	 * Load Localisation files.
	 *
	 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
	 *
	 * Locales found in:
	 *      - WP_LANG_DIR/spacious-toolkit/spacious-toolkit-LOCALE.mo
	 *      - WP_LANG_DIR/plugins/spacious-toolkit-LOCALE.mo
	 */
	public function load_plugin_textdomain() {
		$locale = is_admin() && function_exists( 'get_user_locale' ) ? get_user_locale() : get_locale();
		$locale = apply_filters( 'plugin_locale', $locale, 'spacious-toolit' );

		unload_textdomain( 'spacious-toolit' );

		load_textdomain( 'spacious-toolit', WP_LANG_DIR . '/spacious-toolit/spacious-toolit-' . $locale . '.mo' );
		load_plugin_textdomain( 'spacious-toolit', false, plugin_basename( dirname( SPACIOUS_TOOLKIT_PLUGIN_FILE ) ) . '/languages' );
	}

	/**
	 * Theme support fallback notice.
	 *
	 * @return string
	 */
	public function theme_support_missing_notice() {
		$theme  = wp_get_theme();
		$parent = $theme->parent();

		// Check with ThemeGrill Spacious Theme is installed.
		if ( ( $theme != 'Spacious' ) && ( $theme != 'Spacious Pro' ) && ( $parent != 'Spacious' ) && ( $parent != 'Spacious Pro' ) ) {
			echo '<div class="error notice is-dismissible"><p><strong>' . __( 'Spacious Toolkit', 'spacious-toolkit' ) . '</strong> &#8211; ' . sprintf( __( 'This plugin requires %s by ThemeGrill to work.', 'spacious-toolkit' ), '<a href="http://www.themegrill.com/themes/spacious/" target="_blank">' . __( 'Spacious Theme', 'spacious-toolkit' ) . '</a>' ) . '</p></div>';
		}
	}

	/**
	 * Get the plugin url.
	 *
	 * @return string
	 */
	public function plugin_url() {
		return untrailingslashit( plugins_url( '/', SPACIOUS_TOOLKIT_PLUGIN_FILE ) );
	}

	/**
	 * Get the plugin path.
	 *
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( SPACIOUS_TOOLKIT_PLUGIN_FILE ) );
	}

	/**
	 * Get the template path.
	 *
	 * @return string
	 */
	public function template_path() {
		return apply_filters( 'spacious_toolkit_template_path', 'spacious-toolkit/' );
	}

	/**
	 * Get the template controls path.
	 *
	 * @return string
	 */
	public function template_controls_path() {
		return apply_filters( 'spacious_toolkit_controls_path', 'spacious-toolkit/controls/' );
	}

	/**
	 * Get the template preview path.
	 *
	 * @return string
	 */
	public function template_preview_path() {
		return apply_filters( 'spacious_toolkit_preview_path', 'spacious-toolkit/preview/' );
	}

	/**
	 * Get Ajax URL.
	 *
	 * @return string
	 */
	public function ajax_url() {
		return admin_url( 'admin-ajax.php', 'relative' );
	}

}
