<?php
/**
 * Call to Action 1 Widget controls
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/preview/content-widget-cta-1.php.
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
 *
 */

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<#
var target = settings.button_link.is_external ? 'target="_blank"' : '';
var nofollow = settings.button_link.nofollow === 'on' ? 'rel="nofollow"' : '';
#>

<div class="call-to-action">
	<div class="call-to-action-left">
		<# if( settings.title ) { #>
		<h3 class="call-to-action__title elementor-inline-editing" data-elementor-setting-key="title">
			{{{ settings.title}}}
		</h3>
		<# } #>

		<# if( settings.content ) { #>
		<div class="call-to-action__content">
			<p class="elementor-inline-editing" data-elementor-setting-key="content">{{{ settings.content }}}</p>
		</div>
		<# } #>
	</div>

	<# if( settings.button_text ) { #>
	<div class="call-to-action-right">
		<a href="{{{ settings.button_link.url }}}" {{ target }} {{ nofollow }}
		   class="btn call-to-action__button btn--medium btn--rectangular-rounded btn--primary elementor-inline-editing"
		   data-elementor-setting-key="button_text">
			{{{ settings.button_text }}}
		</a>
	</div>
	<# } #>
</div>
