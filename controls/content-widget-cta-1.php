<?php
/**
 * CTA 1 Widget controls
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/controls/content-widget-cta-1.php.
 *
 * HOWEVER, on occasion Spacious Toolkit will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see      http://docs.themegrill.com/spacious-toolkit/template-structure/
 * @extends  SPT_CTA_1
 * @extends  Scheme_Color
 * @version  1.0.0
 * @package  Spacious_Toolkit/Widgets
 * @category Widgets
 * @author   ThemeGrill
 *
 * @var $instance SPT_CTA_1
 */

use Elementor\SPT_CTA_1;
use Elementor\Scheme_Color;
use Elementor\Controls_Manager;

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Widget title section
$instance->start_controls_section(
	'section_cta_title',
	array(
		'label' => esc_html__( 'Call to Action', 'spacious-toolkit' ),
	)
);

// Title
$instance->add_control(
	'title',
	array(
		'label'   => esc_html__( 'Title', 'spacious-toolkit' ),
		'type'    => Controls_Manager::TEXT,
		'default' => esc_html__( 'Call to Action title', 'spacious-toolkit' ),
	)
);

// Content
$instance->add_control(
	'content',
	array(
		'label'   => esc_html__( 'Content', 'spacious-toolkit' ),
		'type'    => Controls_Manager::TEXTAREA,
		'default' => esc_html__( 'Content goes here.', 'spacious-toolkit' ),
	)
);

// Button Text
$instance->add_control(
	'button_text',
	array(
		'label'   => esc_html__( 'Button Text', 'spacious-toolkit' ),
		'type'    => Controls_Manager::TEXT,
		'default' => esc_html__( 'Click here', 'spacious-toolkit' ),
	)
);

// Button Link
$instance->add_control(
	'button_link',
	array(
		'label'       => esc_html__( 'Button Link', 'spacious-toolkit' ),
		'type'        => Controls_Manager::URL,
		'placeholder' => esc_html__( 'http://site-link.com' ),
	)
);

$instance->end_controls_section();
