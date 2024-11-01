<?php
/**
 * Spacious_Toolkit Elementor Functions
 *
 * Elementor related functions
 *
 * @author   ThemeGrill
 * @category Core
 * @package  Spacious_Toolkit/Functions
 * @version  1.0.0
 */

/**
 * Render the widget classes for Elementor plugin compatibility
 *
 * @param $widgets_id the widgets of the id
 *
 * @return mixed the widget classes of the id passed
 *
 * @since 1.0.0
 */
function spacious_toolkit_widget_class_names( $widgets_id ) {

	$widgets_id = str_replace( 'wp-widget-', '', $widgets_id );

	$classes = spacious_toolkit_widgets_classes();

	$return_value = isset( $classes[ $widgets_id ] ) ? $classes[ $widgets_id ] : '';

	return $return_value;
}

/**
 * Return all the arrays of widgets classes and classnames of same respectively
 *
 * @return array the array of widget classnames and its respective classes
 *
 * @since 1.0.0
 */
function spacious_toolkit_widgets_classes() {

	return
		array(
			'spacious_featured_single_page_widget' => 'widget_featured_single_post',
			'spacious_service_widget'              => 'widget_service_block',
			'spacious_call_to_action_widget'       => 'widget_call_to_action',
			'spacious_testimonial_widget'          => 'widget_testimonial',
			'spacious_recent_work_widget'          => 'widget_recent_work',
			'spacious_featured_posts_widget'       => 'widget_featured_posts',
			'spacious_our_clients_widget'          => 'widget_our_clients',
			'spacious_team_widget'                 => 'widget_team_block',
			'spacious_fun_facts_widget'            => 'widget_fun_facts',
			'spacious_pricing_table_widget'        => 'widget_table_pricing',
			'spacious_accordian_widget'            => 'tg_widget_accordian',
		);
}


/**
 * Return the values of all the categories of the posts
 * present in the site
 *
 * @return array of category ids and its respective names
 *
 * @since 1.0.0
 */
function spacious_toolkit_elementor_categories() {
	$output     = array();
	$categories = get_categories();

	foreach ( $categories as $category ) {
		$output[ $category->term_id ] = $category->name;
	}

	return $output;
}

/**
 * Return the values of all the tags of the posts
 * present in the site
 *
 * @return array of tag ids and its respective names
 *
 * @since 1.0.0
 */
function spacious_toolkit_elementor_tags() {
	$output = array();
	$tags   = get_tags();

	foreach ( $tags as $tag ) {
		$output[ $tag->term_id ] = $tag->name;
	}

	return $output;
}

/**
 * Return the values of all the authors of the posts
 * present in the site
 *
 * @return array of author ids and its respective names
 *
 * @since 1.0.0
 */
function spacious_toolkit_elementor_authors() {
	$output  = array();
	$authors = get_users(
		array(
			'who' => 'authors',
		)
	);

	foreach ( $authors as $author ) {
		$output[ $author->ID ] = $author->display_name;
	}

	return $output;
}
