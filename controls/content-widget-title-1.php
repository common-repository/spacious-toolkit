<?php
/**
 * Title 1 Widget controls
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/controls/content-widget-title-1.php.
 *
 * HOWEVER, on occasion Spacious Toolkit will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see      http://docs.themegrill.com/spacious-toolkit/template-structure/
 * @extends  SPT_TITLE_1
 * @extends  Scheme_Color
 * @version  1.0.0
 * @package  Spacious_Toolkit/Widgets
 * @category Widgets
 * @author   ThemeGrill
 *
 * @var $instance SPT_TITLE_1
 */

use Elementor\SPT_TITLE_1;
use Elementor\Controls_Manager;

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Widget title section
$instance->start_controls_section(
	'section_text_title',
	array(
		'label' => esc_html__( 'Title 1', 'spacious-toolkit' ),
	)
);

// Title
$instance->add_control(
	'title',
	array(
		'label'   => esc_html__( 'Title', 'spacious-toolkit' ),
		'type'    => Controls_Manager::TEXT,
		'default' => esc_html__( 'Section title', 'spacious-toolkit' ),
	)
);

// Content
$instance->add_control(
	'description',
	array(
		'label'   => esc_html__( 'Description', 'spacious-toolkit' ),
		'type'    => Controls_Manager::TEXTAREA,
		'default' => esc_html__( 'Some description about the section.', 'spacious-toolkit' ),
	)
);

$instance->add_control(
	'alignment',
	array(
		'label'   => esc_html__( 'Alignment', 'spacious-toolkit' ),
		'type'    => Controls_Manager::CHOOSE,
		'default' => 'left',
		'options' => array(
			'left'   => array(
				'icon' => 'fa fa-align-left',
			),
			'center' => array(
				'icon' => 'fa fa-align-center',
			),
			'right'  => array(
				'icon' => 'fa fa-align-right',
			),

		),
	)
);

$instance->end_controls_section();

// Widget style section
$instance->start_controls_section(
	'section_title_style',
	array(
		'label' => esc_html__( 'Styles', 'spacious-toolkit' ),
		'tab'   => Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'style',
	array(
		'label'   => esc_html__( 'Styles', 'spacious-toolkit' ),
		'type'    => Controls_Manager::SELECT,
		'default' => 'style_one',
		'options' => array(
			'style_one'   => esc_html__( 'Style 1', 'spacious-toolkit' ),
			'style_two'   => esc_html__( 'Style 2', 'spacious-toolkit' ),
			'style_three' => esc_html__( 'Style 3', 'spacious-toolkit' ),
		),
	)
);

$instance->end_controls_section();
