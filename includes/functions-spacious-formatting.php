<?php
/**
 * Spacious_Toolkit Formatting
 *
 * Functions for formatting data.
 *
 * @author   ThemeGrill
 * @category Core
 * @package  Spacious_Toolkit/Functions
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sanitize a string destined to be a tooltip.
 *
 * @since  1.1.0  Tooltips are encoded with htmlspecialchars to prevent XSS. Should not be used in conjunction with
 *         esc_attr()
 *
 * @param  string $var
 *
 * @return string
 */
function spacious_toolkit_sanitize_tooltip( $var ) {
	return htmlspecialchars( wp_kses( html_entity_decode( $var ), array(
		'br'     => array(),
		'em'     => array(),
		'strong' => array(),
		'small'  => array(),
		'span'   => array(),
		'ul'     => array(),
		'li'     => array(),
		'ol'     => array(),
		'p'      => array(),
	) ) );
}
