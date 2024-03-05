<?php
namespace Ko_Legal_Addon;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Ko_Legal_Calculator extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'calculator';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Calculator', 'kolegal-addon' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-code';
	}


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'basic', 'kolegal' ];
	}

	// Load CSS
	// public function get_style_depends() {

	// 	wp_register_style( 'guide-posts', plugins_url( '../assets/css/guide-posts.css', __FILE__ ));

	// 	return [
	// 		'guide-posts',
	// 	];

	// }

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	// public function get_keywords() {
	// 	return [ 'oembed', 'url', 'link' ];
	// }

	/**
	 * Register oEmbed widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'kolegal-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'kolegal-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'kolegal-addon' ),
				'placeholder' => esc_html__( 'Type your title here', 'kolegal-addon' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'link_text',
			[
				'label' => esc_html__( 'Link Text', 'kolegal-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Default text', 'kolegal-addon' ),
				'placeholder' => esc_html__( 'Type your link text', 'kolegal-addon' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'kolegal-addon' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'kolegal-addon' ),
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'kolegal-addon' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
	?>

    <div class="calculator-wrap">
        <div class="calculator">
            <div class="calculator-inner">
				<h3>Calculator</h3>
				<label for="principal"><?php echo esc_html__( 'Principal:', 'kolegal-addon' ) ?></label>
				<input type="number" id="principal" placeholder="Enter principal amount">

				<label for="rate"><?php echo esc_html__( 'Rate (%):', 'kolegal-addon' ) ?></label>
				<input type="number" id="rate" placeholder="Enter rate of interest">

				<div class="date-input">
					<label><?php echo esc_html__( 'Start Date:', 'kolegal-addon' ) ?></label>
					<div class="date-input-container">
						<input type="number" id="startDay" placeholder="DD" min="1" max="31">
						<input type="number" id="startMonth" placeholder="MM" min="1" max="12">
						<input type="number" id="startYear" placeholder="YYYY" min="1">
					</div>
				</div>

				<div class="date-input">
					<label><?php echo esc_html__( 'End Date:', 'kolegal-addon' ) ?></label>
					<div class="date-input-container">
						<input type="number" id="endDay" placeholder="DD" min="1" max="31">
						<input type="number" id="endMonth" placeholder="MM" min="1" max="12">
						<input type="number" id="endYear" placeholder="YYYY" min="1">
					</div>
				</div>

				<label for="period"><?php echo esc_html__( 'Interest Period:', 'kolegal-addon' ) ?></label>
				<select id="period">
					<option value="daily"><?php echo esc_html__( 'Daily', 'kolegal-addon' ) ?></option>
					<option value="weekly"><?php echo esc_html__( 'Weekly', 'kolegal-addon' ) ?></option>
					<option value="monthly"><?php echo esc_html__( 'Monthly', 'kolegal-addon' ) ?></option>
					<option value="quarterly"><?php echo esc_html__( 'Quarterly', 'kolegal-addon' ) ?></option>
					<option value="half-yearly"><?php echo esc_html__( 'Half-Yearly', 'kolegal-addon' ) ?></option>
					<option value="yearly"><?php echo esc_html__( 'Yearly', 'kolegal-addon' ) ?></option>
				</select>
				<div class="button-container">
					<button onclick="calculateInterest()"><?php echo esc_html__( 'Calculate', 'kolegal-addon' ) ?></button>
					<button onclick="reset()"><?php echo esc_html__( 'Reset', 'kolegal-addon' ) ?></button>
				</div>
			</div>
            <div class="results-wrap">
				<h3><?php echo esc_html__( 'Result:', 'kolegal-addon' ) ?></h3>
				<div id="result">
					<p><strong><?php echo esc_html__( 'Simple Interest:', 'kolegal-addon' ) ?></strong> <span id="interestResult">-</span></p>
					<p><strong><?php echo esc_html__( 'Total Amount:', 'kolegal-addon' ) ?></strong> <span id="totalAmountResult">-</span></p>
					<p><strong><?php echo esc_html__( 'Time Period:', 'kolegal-addon' ) ?></strong> <span id="timePeriodResult">-</span></p>
				</div>
			</div>
        </div>
        <script src="script.js"></script>

    </div>


	<?php

	}

}

