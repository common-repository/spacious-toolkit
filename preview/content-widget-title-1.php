<?php
/**
 * Title 1 Widget controls
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/preview/content-widget-title-1.php.
 *
 * HOWEVER, on occasion Spacious Toolkit will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see      http://docs.themegrill.com/spacious-toolkit/template-structure/
 * @version  1.0.0
 * @package  Spacious_Toolkit/Widgets
 * @category Widgets
 * @author   ThemeGrill
 */

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<#
var wrap_class = '';
if ( 'style_one' !== settings.style ) {
wrap_class = settings.style;
}

if ( 'left' !== settings.alignment ) {
wrap_class += ' ' + settings.alignment;
}
#>

<div class="spacious-title {{{ wrap_class }}}">
	<# if( settings.title ) { #>
	<h3 class="widget-title elementor-inline-editing" data-elementor-setting-key="title">{{{ settings.title }}}</h3>
	<# } #>

	<# if( settings.description ) { #>
	<div class="widget-desc elementor-inline-editing" data-elementor-setting-key="description">
		<# if ( 'style_three' === settings.style ) { #>
		<span>
        <# } #>
        {{{ settings.description }}}
        <# if ( 'style_three' === settings.style ) { #>
        </span>
		<# } #>
	</div> <!-- /.spacious-text-content-->
	<# } #>
</div> <!-- /.spacious-title -->
