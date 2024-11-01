<?php
/**
 * The template for displaying Counter 1 widget.
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/content-widget-counter-1.php.
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
 * @var $instance SPT_COUNTER_1
 */

use Elementor\SPT_COUNTER_1;

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$icon            = $instance->get_settings( 'icon' );
$starting_number = $instance->get_settings( 'starting_number' );
$ending_number   = $instance->get_settings( 'ending_number' );
$title           = $instance->get_settings( 'title' );

$instance->add_render_attribute( 'title', 'class', 'counter__title' );
?>

<div class="counter">
	<?php if ( ! empty( $icon ) ) : ?>
		<div class="counter__icon">
			<i class="<?php echo esc_attr( $icon ); ?>"></i>
		</div>
	<?php endif; ?>

	<?php if ( ! empty( $ending_number ) ) : ?>
		<div class="counter__number"
		     data-from="<?php echo $starting_number ? absint( $starting_number ) : 0; ?>"
		     data-to="<?php echo absint( $ending_number ); ?>"
		     data-speed="1000"
		     data-refresh-interval="25">
			<?php echo absint( $starting_number ); ?>
		</div>
	<?php endif; ?>

	<?php if ( ! empty( $title ) ) : ?>
		<span <?php echo $instance->get_render_attribute_string( 'title' ); ?>>
			<?php echo esc_html( $title ); ?>
		</span>
	<?php endif; ?>
</div> <!-- .counter -->
