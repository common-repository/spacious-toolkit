<?php
/**
 * Spacious_Toolkit Elementor Filters and hooks
 *
 * @author   ThemeGrill
 * @category Core
 * @package  Spacious_Toolkit/Functions
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class SPT_Elementor_Addons {

	/**
	 * A reference to an instance of this class.
	 */
	private static $instance;

	/**
	 * Returns an instance of this class.
	 */
	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new SPT_Elementor_Addons();
		}

		return self::$instance;

	}

	/**
	 * Initializes the plugin by setting filters and administration functions.
	 */
	private function __construct() {

		// Including the helper files
		$this->includes();

		// Adding Elementor category
		add_action( 'elementor/init', array(
			$this,
			'spacious_toolkit_add_elementor_category',
		) );

		// Adding Elementor widgets
		add_action( 'elementor/widgets/widgets_registered', array(
			$this,
			'spacious_toolkit_add_elementor_widgets',
		) );

		// Enqueue style for Elementor editor, especially for the icons
		add_action( 'elementor/editor/after_enqueue_styles', array(
			$this,
			'spacious_toolkit_elementor_editor_styles',
		) );

		// Filter the rendering of the default WordPress widgets
		add_filter( 'elementor/widgets/wordpress/widget_args', array(
			$this,
			'spacious_toolkit_elementor_widget_render_filter',
		) );

	}

	/**
	 * Includes the required core Elementor helper files.
	 *
	 * @since 1.0.0
	 */
	public function includes() {

		// Elementor helper files include
		require SPT_ABSPATH . 'includes/functions-spacious-elementor-helper.php';
	}

	/**
	 * Add the Category for Spacious Widgets.
	 */
	public function spacious_toolkit_add_elementor_category() {

		\Elementor\Plugin::instance()->elements_manager->add_category(
			'spacious-toolkit-counter-widgets',
			array(
				'title' => esc_html__( 'Spacious Counter', 'spacious-toolkit' ),
			),
			1
		);

		\Elementor\Plugin::instance()->elements_manager->add_category(
			'spacious-toolkit-cta-widgets',
			array(
				'title' => esc_html__( 'Spacious Call to Action', 'spacious-toolkit' ),
			),
			2
		);

		\Elementor\Plugin::instance()->elements_manager->add_category(
			'spacious-toolkit-icon-box-widgets',
			array(
				'title' => esc_html__( 'Spacious Icon Box', 'spacious-toolkit' ),
			),
			3
		);

		\Elementor\Plugin::instance()->elements_manager->add_category(
			'spacious-toolkit-pricing-table-widgets',
			array(
				'title' => esc_html__( 'Spacious Pricing Table', 'spacious-toolkit' ),
			),
			4
		);

		\Elementor\Plugin::instance()->elements_manager->add_category(
			'spacious-toolkit-team-widgets',
			array(
				'title' => esc_html__( 'Spacious Team', 'spacious-toolkit' ),
			),
			5
		);

		\Elementor\Plugin::instance()->elements_manager->add_category(
			'spacious-toolkit-testimonial-widgets',
			array(
				'title' => esc_html__( 'Spacious Testimonial', 'spacious-toolkit' ),
			),
			6
		);

		\Elementor\Plugin::instance()->elements_manager->add_category(
			'spacious-toolkit-slider-widgets',
			array(
				'title' => esc_html__( 'Spacious Slider', 'spacious-toolkit' ),
			),
			7
		);

		\Elementor\Plugin::instance()->elements_manager->add_category(
			'spacious-toolkit-general-widgets',
			array(
				'title' => esc_html__( 'Spacious General Elements', 'spacious-toolkit' ),
			),
			8
		);

		\Elementor\Plugin::instance()->elements_manager->add_category(
			'spacious-toolkit-block-widgets',
			array(
				'title' => esc_html__( 'Spacious Block Posts', 'spacious-toolkit' ),
			),
			9
		);

		\Elementor\Plugin::instance()->elements_manager->add_category(
			'spacious-toolkit-grid-widgets',
			array(
				'title' => esc_html__( 'Spacious Grid Posts', 'spacious-toolkit' ),
			),
			10
		);
	}

	/**
	 * Require and instantiate Elementor Widgets.
	 *
	 * @param $widgets_manager
	 */
	public function spacious_toolkit_add_elementor_widgets( $widgets_manager ) {
		// Add elementor widgets files
		$this->spacious_toolkit_add_elementor_widget();

		// Add elementor widget classes
		$this->spacious_toolkit_add_elementor_class( $widgets_manager );
	}

	/**
	 * Add the list of files for elementor widgets
	 */
	public function spacious_toolkit_add_elementor_widget() {

		// List of files of the elementor widgets
		// COUNTER 1
		require SPT_ABSPATH . 'includes/widgets/class-spacious-widget-counter-1.php';

		// CTA 1
		require SPT_ABSPATH . 'includes/widgets/class-spacious-widget-cta-1.php';

		// TEAM 1
		require SPT_ABSPATH . 'includes/widgets/class-spacious-widget-team-1.php';

		// TEAM 2
		require SPT_ABSPATH . 'includes/widgets/class-spacious-widget-team-2.php';

		// TITLE 1
		require SPT_ABSPATH . 'includes/widgets/class-spacious-widget-title-1.php';

		// BLOCK POSTS 1
		require SPT_ABSPATH . 'includes/widgets/class-spacious-widget-block-1.php';

		// GRID POSTS 1
		require SPT_ABSPATH . 'includes/widgets/class-spacious-widget-grid-1.php';

	}

	/**
	 * Add the list of classes for elementor widgets
	 */
	public function spacious_toolkit_add_elementor_class( $widgets_manager ) {

		// List of class of the elementor widgets
		// COUNTER 1
		$widgets_manager->register_widget_type( new \Elementor\SPT_COUNTER_1() );

		// CTA 1
		$widgets_manager->register_widget_type( new \Elementor\SPT_CTA_1() );

		// TEAM 1
		$widgets_manager->register_widget_type( new \Elementor\SPT_TEAM_1() );

		// TEAM 2
		$widgets_manager->register_widget_type( new \Elementor\SPT_TEAM_2() );

		// TITLE 1
		$widgets_manager->register_widget_type( new \Elementor\SPT_TITLE_1() );

		// BLOCK POSTS 1
		$widgets_manager->register_widget_type( new \Elementor\SPT_BLOCK_1() );

		// GRID POSTS 1
		$widgets_manager->register_widget_type( new \Elementor\SPT_GRID_1() );
	}

	/**
	 * Enqueue styles for Elementor icons
	 */
	public function spacious_toolkit_elementor_editor_styles() {
		wp_enqueue_style( 'spacious-toolkit-econs', Spacious_Toolkit()->plugin_url() . '/assets/css/spacious-toolkit-econs.css', false );
	}

	/**
	 * Render the default WordPress widget settings, ie, divs
	 *
	 * @param $args the widget id
	 *
	 * @return array register sidebar divs
	 *
	 * @since 1.0.0
	 */
	function spacious_toolkit_elementor_widget_render_filter( $args ) {
		return
			array(
				'before_widget' => '<aside class="widget ' . spacious_toolkit_widget_class_names( $args['widget_id'] ) . '">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			);
	}
}

add_action( 'plugins_loaded', array(
	'SPT_Elementor_Addons',
	'get_instance',
) );
