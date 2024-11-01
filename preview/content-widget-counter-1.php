<?php
/**
 * COUNTER 1 Widget controls
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/preview/content-widget-counter-1.php.
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

<div class="counter">
	<# if( settings.icon.length != 0 ) { #>
	<div class="counter__icon">
		<i class="{{{ settings.icon }}}"></i>
	</div>
	<# } #>

	<# if( settings.ending_number ) { #>
	<div class="counter__number"
	     data-from="{{{ ( settings.starting_number ) ? Math.abs( settings.starting_number ) : 0 }}}"
	     data-to="{{{ settings.ending_number }}}"
	     data-speed="4000"
	     data-refresh-interval="25">
		{{{ settings.starting_number }}}
	</div>
	<# } #>

	<# if ( settings.title ) { #>
	<span class="counter__title elementor-inline-editing"
	      data-elementor-setting-key="title">{{{ settings.title }}}</span>
	<# } #>

</div> <!-- .counter -->
