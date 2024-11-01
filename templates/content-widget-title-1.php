<?php
/**
 * The template for displaying Title 1 widget.
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/content-widget-title-1.php.
 *
 * HOWEVER, on occasion Spacious Toolkit will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     http://docs.themegrill.com/spacious-toolkit/template-structure/
 * @author  ThemeGrill
 * @package Spacious_Toolkit/Templates
 * @version 1.0.0
 *
 * @var $instance SPT_TITLE_1
 */

use Elementor\SPT_TITLE_1;

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$title       = $instance->get_settings( 'title' );
$description = $instance->get_settings( 'description' );
$style       = $instance->get_settings( 'style' );
$alignment   = $instance->get_settings( 'alignment' );

$wrap_class = '';
if ( 'style_one' !== $style ) {
	$wrap_class = $style;
}

if ( 'left' !== $alignment ) {
	$wrap_class .= ' ' . $alignment;
}

$instance->add_render_attribute( 'title', 'class', 'widget-title' );
$instance->add_render_attribute( 'description', 'class', 'widget-desc' );
?>

<div class="spacious-title <?php echo esc_attr( $wrap_class ); ?>">
	<?php if ( ! empty( $title ) ): ?>
		<h3 <?php echo $instance->get_render_attribute_string( 'title' ); ?>><?php echo esc_html( $title ); ?></h3>
	<?php endif; ?>

	<?php if ( ! empty( $description ) ): ?>
		<div <?php echo $instance->get_render_attribute_string( 'description' ); ?>>
			<?php if ( 'style_three' === $style ) :
				echo '<span>';
			endif;

			echo esc_html( $description );

			if ( 'style_three' === $style ) :
				echo '</span>';
			endif; ?>
		</div> <!-- /.spacious-text-content-->
	<?php endif; ?>
</div> <!-- /.spacious-text -->
