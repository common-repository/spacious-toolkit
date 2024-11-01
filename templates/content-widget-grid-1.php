<?php
/**
 * The template for displaying Grid Posts 1 widget.
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/content-widget-grid-1.php.
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
 * @var $instance SPT_GRID_1
 */

use Elementor\SPT_GRID_1;

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$settings            = $instance->get_settings();
$widget_title        = $settings['widget_title'];
$posts_count         = $settings['posts_count'];
$offset_posts_number = $settings['offset_posts_number'];
$posts_option        = $settings['posts_option'];
$layout              = $settings['layout'];

$layout_class = '';
if ( 'two_column' === $layout ) {
	$layout_class = 'tg-grid-two-col';
} elseif ( 'three_column' === $layout ) {
	$layout_class = 'tg-grid-three-col';
} elseif ( 'four_column' === $layout ) {
	$layout_class = 'tg-grid-four-col';
}

$args = array(
	'posts_per_page'      => $posts_count,
	'post_type'           => 'post',
	'ignore_sticky_posts' => true,
	'no_found_rows'       => true,
	'post_status'         => 'publish',
);

// Assign selected category
if ( 'categories' === $posts_option ) {
	$args['category__in'] = $settings['categories_option'];
}

// Assign Offset
if ( ! empty( $offset_posts_number ) ) {
	$args['offset'] = $offset_posts_number;
}

// Start the WP_Query Object/Class
$grid_posts = new WP_Query( $args );
?>
<div class="tg-grid-wrapper <?php echo esc_attr( $layout_class ); ?>">
	<?php if ( ! empty( $widget_title ) ) : ?>
		<h4 class="grid-title">
			<span><?php echo $widget_title; ?></span>
		</h4>
	<?php endif; ?>

	<div class="tg-grid-row">
		<?php
		while ( $grid_posts->have_posts() ) :
			$grid_posts->the_post(); ?>

			<div class="tg-grid-content-wrapper">
				<div class="tg-grid-content">
					<?php if ( has_post_thumbnail() ) : ?>
						<figure class="tg-grid-thumb">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'thumbnail' ); ?>
							</a>
						</figure>
					<?php endif; ?>

					<div class="tg-entry-content">
						<h3 class="tg-grid-title entry-title">
							<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</h3>

						<?php
						if ( function_exists( 'spacious_entry_meta' ) ) {
							spacious_entry_meta( false );
						}
						?>

					</div>
				</div>
			</div>

		<?php endwhile;
		wp_reset_postdata(); ?>
	</div>
</div> <!-- /.tg-grid-wrapper -->
