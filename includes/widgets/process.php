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
class Ko_Legal_Process extends \Elementor\Widget_Base {

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
		return 'process';
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
		return esc_html__( 'Process', 'kolegal-addon' );
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
			'process_list',
			[
				'label' => esc_html__( 'List', 'kolegal-addon' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'process_text',
						'label' => esc_html__( 'Text', 'kolegal-addon' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'placeholder' => esc_html__( 'List Item', 'kolegal-addon' ),
						'default' => esc_html__( 'List Item', 'kolegal-addon' ),
					],
					[
						'name' => 'process_icon',
						'label' => esc_html__( 'Icon', 'kolegal-addon' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'placeholder' => esc_html__( 'List Item', 'kolegal-addon' ),
						'default' => esc_html__( 'List Item', 'kolegal-addon' ),
					],
					[
						'name' => 'process_link',
						'label' => esc_html__( 'Link', 'kolegal-addon' ),
						'type' => \Elementor\Controls_Manager::URL,
						'placeholder' => esc_html__( 'https://your-link.com', 'kolegal-addon' ),
					],
				],
				'default' => [
					[
						'process_text' => esc_html__( 'List Item #1', 'kolegal-addon' ),
						'process_icon' => esc_html__( 'Icon', 'kolegal-addon' ),
						'process_link' => 'https://elementor.com/',
					],
					[
						'process_text' => esc_html__( 'List Item #2', 'kolegal-addon' ),
                        'process_icon' => esc_html__( 'Icon', 'kolegal-addon' ),
						'process_link' => 'https://elementor.com/',
					],
					[
						'process_text' => esc_html__( 'List Item #3', 'kolegal-addon' ),
                        'process_icon' => esc_html__( 'Icon', 'kolegal-addon' ),
						'process_link' => 'https://elementor.com/',
					],
				],
				'title_field' => '{{{ process_text }}}',
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
	
    <div class="process-area">
        <div class="swiper Process">
            <div class="swiper-wrapper process-wrap">
                <?php foreach ($settings['process_list'] as $list_item) : ?>
					<div class="single-process swiper-slide" >
                        <a href="<?php echo $list_item['process_link']['url']; ?>">
                            <i class="<?php echo $list_item['process_icon']; ?>"></i>
                        </a>
                        <h4><?php echo $list_item['process_text']; ?></h4>
					</div>
				<?php endforeach; ?>
            </div>
        </div>
    </div>

	<?php

	}

}