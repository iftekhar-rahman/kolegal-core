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
class Ko_Legal_Expertise_Tab extends \Elementor\Widget_Base {

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
		return 'expertise-tab';
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
		return esc_html__( 'Expertise Tab', 'kolegal-addon' );
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
	

    <div id="container">
  <!-- container -->
  <ul class="skltbs-tab-group">
    <!-- tabGroup -->
    <li class="skltbs-tab-item">
      <!-- tabItem -->
      <button class="skltbs-tab">Tab 1</button
      ><!-- tab -->
    </li>
    <li class="skltbs-tab-item">
      <button class="skltbs-tab">Tab 2</button>
    </li>
    <li class="skltbs-tab-item">
      <button class="skltbs-tab">Tab 3</button>
    </li>
  </ul>
  <div class="skltbs-panel-group">
    <!-- panelGroup -->
    <div class="skltbs-panel">Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque, illum.</div>
    <!-- panel -->
    <div class="skltbs-panel">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Officia ex voluptatem, voluptatibus et animi perferendis earum autem iste dolores! Eos!</div>
    <div class="skltbs-panel">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, pariatur?</div>
  </div>
</div>



	<?php

	}

}