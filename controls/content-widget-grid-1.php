<?php
/**
 * Grid 1 Widget controls
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/controls/content-widget-grid-1.php.
 *
 * HOWEVER, on occasion Spacious Toolkit will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see      http://docs.themegrill.com/spacious-toolkit/template-structure/
 * @extends  \Elementor\SPT_GRID_1
 * @version  1.0.1
 * @package  Spacious_Toolkit/Widgets
 * @category Widgets
 * @author   ThemeGrill
 *
 */

use Elementor\Controls_Manager;

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Widget title section
 */
$instance->start_controls_section(
	'section_grid_1_title',
	array(
		'label' => esc_html__( 'Grid Title', 'spacious-toolkit' ),
	)
);

// Icon
$instance->add_control(
	'widget_title',
	array(
		'label'   => esc_html__( 'Title', 'spacious-toolkit' ),
		'type'    => Controls_Manager::TEXT,
		'default' => esc_html__( 'Grid posts 1' ),
	)
);
$instance->end_controls_section();


/**
 * Widget posts section
 */
$instance->start_controls_section(
	'section_grid_1_posts',
	array(
		'label' => esc_html__( 'Posts', 'spacious-toolkit' ),
	)
);

// Number of posts
$instance->add_control(
	'posts_count',
	array(
		'label'   => esc_html__( 'Number of posts:', 'spacious-toolkit' ),
		'type'    => Controls_Manager::NUMBER,
		'default' => 2,
		'min'     => 0,
	)
);

// Offset Posts
$instance->add_control(
	'offset_posts_number',
	array(
		'label' => esc_html__( 'Offset Posts:', 'spacious-toolkit' ),
		'type'  => Controls_Manager::NUMBER,
		'min'   => 0,
	)
);
$instance->end_controls_section();

/**
 * Widget posts section
 */
$instance->start_controls_section(
	'section_grid_1_filter',
	array(
		'label' => esc_html__( 'Filter', 'spacious-toolkit' ),
	)
);

$instance->add_control(
	'posts_option',
	array(
		'label'   => esc_html__( 'Display the posts from:', 'spacious-toolkit' ),
		'type'    => Controls_Manager::SELECT,
		'default' => 'latest',
		'options' => array(
			'latest'     => esc_html__( 'Latest Posts', 'spacious-toolkit' ),
			'categories' => esc_html__( 'Categories', 'spacious-toolkit' ),
		),
	)
);

$instance->add_control(
	'categories_option',
	array(
		'label'     => esc_html__( 'Select categories:', 'spacious-toolkit' ),
		'type'      => Controls_Manager::SELECT,
		'options'   => spacious_toolkit_elementor_categories(),
		'condition' => array(
			'posts_option' => 'categories',
		),
	)
);

$instance->end_controls_section();

/**
 * Widget layout section
 */
$instance->start_controls_section(
	'section_grid_1_styles',
	array(
		'label' => esc_html__( 'Layout', 'spacious-toolkit' ),
		'tab'   => Controls_Manager::TAB_STYLE,
	)
);

// Column Layout
$instance->add_control(
	'layout',
	array(
		'label'   => esc_html__( 'Layout', 'spacious-toolkit' ),
		'type'    => Controls_Manager::CHOOSE,
		'default' => 'two_column',
		'options' => array(
			'one_column'   => array(
				'icon' => 'fa fa-columns',
			),
			'two_column'   => array(
				'icon' => 'fa fa-columns',
			),
			'three_column' => array(
				'icon' => 'fa fa-columns',
			),
			'four_column'  => array(
				'icon' => 'fa fa-columns',
			),

		),
	)
);

$instance->end_controls_section();