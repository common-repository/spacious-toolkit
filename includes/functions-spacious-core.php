<?php
/**
 * Spacious_Toolkit Core Functions.
 *
 * General core functions available on both the front-end and admin.
 *
 * @author   ThemeGrill
 * @category Core
 * @package  Spacious_Toolkit/Functions
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Include core functions (available in both admin and frontend).
include( 'functions-spacious-deprecated.php' );
include( 'functions-spacious-formatting.php' );

/**
 * is_spacious_pro_active - Check if Spacious Pro is active.
 *
 * @return bool
 */
function is_spacious_pro_active() {
	return false !== strpos( get_option( 'template' ), 'spacious-pro' );
}

/**
 * is_on_elementor_page - Check if currently viewed page is of Elementor.
 *
 * @return bool
 */
function is_on_elementor_page() {
	global $post;

	if ( get_post_meta( $post->ID, '_elementor_edit_mode', true ) ) {
		return true;
	}

	return false;
}

/**
 * Queue some JavaScript code to be output in the footer.
 *
 * @param string $code
 */
function spacious_toolkit_enqueue_js( $code ) {
	global $spacious_toolkit_queued_js;

	if ( empty( $spacious_toolkit_queued_js ) ) {
		$spacious_toolkit_queued_js = '';
	}

	$spacious_toolkit_queued_js .= "\n" . $code . "\n";
}

/**
 * Output any queued javascript code in the footer.
 */
function spacious_toolkit_print_js() {
	global $spacious_toolkit_queued_js;

	if ( ! empty( $spacious_toolkit_queued_js ) ) {

		// Sanitize.
		$spacious_toolkit_queued_js = wp_check_invalid_utf8( $spacious_toolkit_queued_js );
		$spacious_toolkit_queued_js = preg_replace( '/&#(x)?0*(?(1)27|39);?/i', "'", $spacious_toolkit_queued_js );
		$spacious_toolkit_queued_js = str_replace( "\r", '', $spacious_toolkit_queued_js );

		$js = "<!-- Spacious Toolkit JavaScript -->\n<script type=\"text/javascript\">\njQuery(function($) { $spacious_toolkit_queued_js });\n</script>\n";

		/**
		 * social_icons_queued_js filter.
		 *
		 * @param string $js JavaScript code.
		 */
		echo apply_filters( 'spacious_toolkit_queued_js', $js );

		unset( $spacious_toolkit_queued_js );
	}
}

/**
 * Display a Spacious Toolkit help tip.
 *
 * @param  string $tip        Help tip text
 * @param  bool   $allow_html Allow sanitized HTML if true or escape
 *
 * @return string
 */
function spacious_toolkit_help_tip( $tip, $allow_html = false ) {
	if ( $allow_html ) {
		$tip = spacious_toolkit_sanitize_tooltip( $tip );
	} else {
		$tip = esc_attr( $tip );
	}

	return '<span class="spacious-toolkit-help-tip" data-tip="' . $tip . '"></span>';
}

/**
 * Get and include template files.
 *
 * @param string $template_name
 * @param array  $args          (default: array())
 * @param string $template_path (default: '')
 * @param string $default_path  (default: '')
 */
function spacious_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
	if ( ! empty( $args ) && is_array( $args ) ) {
		extract( $args );
	}

	$located = spacious_locate_template( $template_name, $template_path, $default_path );

	if ( ! file_exists( $located ) ) {
		_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $located ), '1.0' );

		return;
	}

	// Allow 3rd party plugin filter template file from their plugin.
	$located = apply_filters( 'spacious_get_template', $located, $template_name, $args, $template_path, $default_path );

	do_action( 'spacious_toolkit_before_template_part', $template_name, $template_path, $located, $args );

	include( $located );

	do_action( 'spacious_toolkit_after_template_part', $template_name, $template_path, $located, $args );
}

/**
 * Locate a template and return the path for inclusion.
 *
 * Note: SPT_TEMPLATE_DEBUG_MODE will prevent overrides in themes from taking priority.
 *
 * This is the load order:
 *
 *      yourtheme       /   $template_path   /   $template_name
 *      yourtheme       /   $template_name
 *      $default_path   /   $template_name
 *
 * @param  string $template_name
 * @param  string $template_path (default: '')
 * @param  string $default_path  (default: '')
 *
 * @return string
 */
function spacious_locate_template( $template_name, $template_path = '', $default_path = '' ) {
	if ( ! $template_path ) {
		$template_path = Spacious_Toolkit()->template_path();
	}

	if ( ! $default_path ) {
		$default_path = Spacious_Toolkit()->plugin_path() . '/templates/';
	}

	// Look within passed path within the theme - this is priority.
	$template = locate_template(
		array(
			trailingslashit( $template_path ) . $template_name,
			$template_name,
		)
	);

	// Get default template/
	if ( ! $template || SPT_TEMPLATE_DEBUG_MODE ) {
		$template = $default_path . $template_name;
	}

	// Return what we found.
	return apply_filters( 'spacious_toolkit_locate_template', $template, $template_name, $template_path );
}

/**
 * Get and include template files.
 *
 * @param string $template_controls_name
 * @param array  $args                   (default: array())
 * @param string $template_controls_path (default: '')
 * @param string $default_controls_path  (default: '')
 */
function spacious_get_controls_template( $template_controls_name, $args = array(), $template_controls_path = '', $default_controls_path = '' ) {
	if ( ! empty( $args ) && is_array( $args ) ) {
		extract( $args );
	}

	$located = spacious_controls_locate_template( $template_controls_name, $template_controls_path, $default_controls_path );

	if ( ! file_exists( $located ) ) {
		_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $located ), '1.0' );

		return;
	}

	// Allow 3rd party plugin filter template file from their plugin.
	$located = apply_filters( 'spacious_get_controls_template', $located, $template_controls_name, $args, $template_controls_path, $default_controls_path );

	do_action( 'spacious_toolkit_before_controls_template_part', $template_controls_name, $template_controls_path, $located, $args );

	include( $located );

	do_action( 'spacious_toolkit_after_controls_template_part', $template_controls_name, $template_controls_path, $located, $args );
}

/**
 * Locate a template and return the path for inclusion.
 *
 * Note: SPT_TEMPLATE_DEBUG_MODE will prevent overrides in themes from taking priority.
 *
 * This is the load order:
 *
 *      yourtheme       /   $template_controls_path   /   $template_controls_name
 *      yourtheme       /   $template_controls_name
 *      $default_path   /   $template_controls_name
 *
 * @param  string $template_controls_name
 * @param  string $template_controls_path (default: '')
 * @param  string $default_controls_path  (default: '')
 *
 * @return string
 */
function spacious_controls_locate_template( $template_controls_name, $template_controls_path = '', $default_controls_path = '' ) {
	if ( ! $template_controls_path ) {
		$template_controls_path = Spacious_Toolkit()->template_controls_path();
	}

	if ( ! $default_controls_path ) {
		$default_controls_path = Spacious_Toolkit()->plugin_path() . '/controls/';
	}

	// Look within passed path within the theme - this is priority.
	$template = locate_template(
		array(
			trailingslashit( $template_controls_path ) . $template_controls_name,
			$template_controls_name,
		)
	);

	// Get default template/
	if ( ! $template || SPT_TEMPLATE_DEBUG_MODE ) {
		$template = $default_controls_path . $template_controls_name;
	}

	// Return what we found.
	return apply_filters( 'spacious_toolkit_controls_locate_template', $template, $template_controls_name, $template_controls_path );
}

/**
 * Get and include template files.
 *
 * @param string $template_preview_name
 * @param array  $args                  (default: array())
 * @param string $template_preview_path (default: '')
 * @param string $default_preview_path  (default: '')
 */
function spacious_get_preview_template( $template_preview_name, $args = array(), $template_preview_path = '', $default_preview_path = '' ) {
	if ( ! empty( $args ) && is_array( $args ) ) {
		extract( $args );
	}

	$located = spacious_preview_locate_template( $template_preview_name, $template_preview_path, $default_preview_path );

	if ( ! file_exists( $located ) ) {
		_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $located ), '1.0' );

		return;
	}

	// Allow 3rd party plugin filter template file from their plugin.
	$located = apply_filters( 'spacious_get_preview_template', $located, $template_preview_name, $args, $template_preview_path, $default_preview_path );

	do_action( 'spacious_toolkit_before_preview_template_part', $template_preview_name, $template_preview_path, $located, $args );

	include( $located );

	do_action( 'spacious_toolkit_after_preview_template_part', $template_preview_name, $template_preview_path, $located, $args );
}

/**
 * Locate a template and return the path for inclusion.
 *
 * Note: SPT_TEMPLATE_DEBUG_MODE will prevent overrides in themes from taking priority.
 *
 * This is the load order:
 *
 *      yourtheme       /   $template_preview_path   /   $template_preview_name
 *      yourtheme       /   $template_preview_name
 *      $default_path   /   $template_preview_name
 *
 * @param  string $template_preview_name
 * @param  string $template_preview_path (default: '')
 * @param  string $default_preview_path  (default: '')
 *
 * @return string
 */
function spacious_preview_locate_template( $template_preview_name, $template_preview_path = '', $default_preview_path = '' ) {
	if ( ! $template_preview_path ) {
		$template_preview_path = Spacious_Toolkit()->template_preview_path();
	}

	if ( ! $default_preview_path ) {
		$default_preview_path = Spacious_Toolkit()->plugin_path() . '/preview/';
	}

	// Look within passed path within the theme - this is priority.
	$template = locate_template(
		array(
			trailingslashit( $template_preview_path ) . $template_preview_name,
			$template_preview_name,
		)
	);

	// Get default template/
	if ( ! $template || SPT_TEMPLATE_DEBUG_MODE ) {
		$template = $default_preview_path . $template_preview_name;
	}

	// Return what we found.
	return apply_filters( 'spacious_toolkit_preview_locate_template', $template, $template_preview_name, $template_preview_path );
}

/**
 * Switch Spacious Toolkit to site language.
 *
 * @since 1.0.0
 */
function spacious_switch_to_site_locale() {
	if ( function_exists( 'switch_to_locale' ) ) {
		switch_to_locale( get_locale() );

		// Filter on plugin_locale so load_plugin_textdomain loads the correct locale.
		add_filter( 'plugin_locale', 'get_locale' );

		// Init Spacious_Toolkit locale.
		Spacious_Toolkit()->load_plugin_textdomain();
	}
}

/**
 * Switch Spacious Toolkit language to original.
 *
 * @since 1.0.0
 */
function spacious_restore_locale() {
	if ( function_exists( 'restore_previous_locale' ) ) {
		restore_previous_locale();

		// Remove filter.
		remove_filter( 'plugin_locale', 'get_locale' );

		// Init Spacious_Toolkit locale.
		Spacious_Toolkit()->load_plugin_textdomain();
	}
}
