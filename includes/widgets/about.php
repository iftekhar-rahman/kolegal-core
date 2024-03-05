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
class Ko_Legal_About extends \Elementor\Widget_Base {

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
		return 'about';
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
		return esc_html__( 'About', 'kolegal-addon' );
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

		// About First Section
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'About First Section', 'kolegal-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'title_1',
			[
				'label' => esc_html__( 'Title', 'kolegal-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Type your title here', 'kolegal-addon' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'description_1',
			[
				'label' => esc_html__( 'Description', 'kolegal-addon' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Type your description here', 'kolegal-addon' ),
			]
		);
		$this->add_control(
			'expertise_list',
			[
				'label' => esc_html__( 'Expertise List', 'kolegal-addon' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'expertise_text',
						'label' => esc_html__( 'Text', 'kolegal-addon' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'placeholder' => esc_html__( 'List Item', 'kolegal-addon' ),
						'default' => esc_html__( 'List Item', 'kolegal-addon' ),
					],
					[
						'name' => 'expertise_link',
						'label' => esc_html__( 'Link', 'kolegal-addon' ),
						'type' => \Elementor\Controls_Manager::URL,
						'placeholder' => esc_html__( 'https://your-link.com', 'kolegal-addon' ),
					],
				],
				'default' => [
					[
						'expertise_text' => esc_html__( 'List Item #1', 'kolegal-addon' ),
						'expertise_link' => 'https://elementor.com/',
					],
					[
						'expertise_text' => esc_html__( 'List Item #2', 'kolegal-addon' ),
						'expertise_link' => 'https://elementor.com/',
					],
				],
				'title_field' => '{{{ expertise_text }}}',
			]
		);
		$this->add_control(
			'image_1',
			[
				'label' => esc_html__( 'Choose Image', 'kolegal-addon' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'signature',
			[
				'label' => esc_html__( 'Signature', 'kolegal-addon' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'lawyer_name',
			[
				'label' => esc_html__( 'Lawyer Name', 'kolegal-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Type here', 'kolegal-addon' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'lawyer_designation',
			[
				'label' => esc_html__( 'Lawyer Designation', 'kolegal-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Type here', 'kolegal-addon' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		// About Second/Video Section
		$this->start_controls_section(
			'second_section',
			[
				'label' => esc_html__( 'About Second/Video Section', 'kolegal-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'video_link',
			[
				'label' => esc_html__( 'Video Link', 'kolegal-addon' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'title_2',
			[
				'label' => esc_html__( 'Title', 'kolegal-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Type your title here', 'kolegal-addon' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'description_2',
			[
				'label' => esc_html__( 'Description', 'kolegal-addon' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Type your description here', 'kolegal-addon' ),
			]
		);


		$this->end_controls_section();

		// About Third/Values Section
		$this->start_controls_section(
			'third_section',
			[
				'label' => esc_html__( 'About Third/Values Section', 'kolegal-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title_3',
			[
				'label' => esc_html__( 'Title', 'kolegal-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Type your title here', 'kolegal-addon' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'description_3',
			[
				'label' => esc_html__( 'Description', 'kolegal-addon' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Type your description here', 'kolegal-addon' ),
			]
		);
		$this->add_control(
			'image_2',
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
	
    <div class="about-area">
        <!-- our-mission-section starts -->
        <div class="our-mission-section position-relative">
            <div class="about-bg about-bg-1" style="background-image:url(<?php echo esc_url( $settings['image_1']['url'] ); ?>);"></div>
            <div class="custom-container d-flex">
                <div class="about-content order2 about-left-column w-50 d-flex align-items-center">
                    <div class="content-inner">
                        <h3><?php echo esc_html( $settings['title_1'] ); ?></h3>
                        <?php echo wpautop($settings['description_1']); ?>
                        <ul class="service-list">
							<?php foreach ( $settings['expertise_list'] as $index => $expertise_item ) : ?>
								<li>
									<?php
									if ( ! $expertise_item['expertise_link']['url'] ) {
										echo $expertise_item['expertise_text'];
									} else {
										?><a href="<?php echo esc_url( $expertise_item['expertise_link']['url'] ); ?>"><?php echo $expertise_item['expertise_text']; ?></a><?php
									}
									?>
								</li>
							<?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="about-right-column w-50 position-relative">
					<div class="signature">
						<img src="<?php echo esc_attr( $settings['signature']['url'] ); ?>" alt="">
					</div>
                    <div class="about-box">
                        <h3><?php echo esc_html( $settings['lawyer_name'] ); ?></h3>
                        <h6><?php echo esc_html( $settings['lawyer_designation'] ); ?></h6>
                    </div>
                </div>
            </div>
        </div><!-- our-mission-section ends -->
        <!-- story starts -->
        <div class="story-section position-relative">
            <div class="custom-container d-flex">
                <div class="video-left-column w-50 d-flex align-items-center">
					<div class="video-con">
						<iframe width="560" height="315" src="<?php echo $settings['video_link']['url']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
					</div>
                </div>
                <div class="about-content video-right-column w-50 d-flex align-items-center">
                    <div class="content-inner">
						<h3><?php echo esc_html( $settings['title_2'] ); ?></h3>
                        <?php echo wpautop($settings['description_2']); ?>
                    </div>
                </div>
            </div>
        </div><!-- story ends -->

        <!-- our-values-section starts -->
        <div class="our-values-section position-relative">
            <div class="about-bg our-values-bg" style="background-image:url(<?php echo esc_url( $settings['image_2']['url'] ); ?>);"></div>
            <div class="custom-container d-flex">
                <div class="about-content about-left-column w-50 d-flex align-items-center">
                    <div class="content-inner">
						<h3><?php echo esc_html( $settings['title_3'] ); ?></h3>
                        <?php echo wpautop($settings['description_3']); ?>
                    </div>
                </div>
                <div class="about-right-column w-50 position-relative">
                    
                </div>
            </div>
        </div><!-- our-mission-section ends -->
        
    </div>

	<?php

	}

}