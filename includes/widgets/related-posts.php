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
class Ko_Legal_Related_Posts extends \Elementor\Widget_Base {

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
		return 'related-posts';
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
		return esc_html__( 'Related Posts', 'kolegal-addon' );
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
			'title_word_limit',
			[
				'label' => esc_html__( 'Title Word Limit', 'kolegal-addon' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 8,
			]
		);
		$this->add_control(
			'content_limit',
			[
				'label' => esc_html__( 'Content Limit', 'kolegal-addon' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
			]
		);
		$this->add_control(
			'post_count',
			[
				'label' => esc_html__( 'Post Per Page', 'kolegal-addon' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 6,
			]
		);

		$this->add_control(
			'icon_left',
			[
				'label' => esc_html__( 'Icon Left', 'kolegal-addon' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-left',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'circle',
						'dot-circle',
						'square-full',
					],
					'fa-regular' => [
						'circle',
						'dot-circle',
						'square-full',
					],
				],
			]
		);

		$this->add_control(
			'icon_right',
			[
				'label' => esc_html__( 'Icon Left', 'kolegal-addon' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'circle',
						'dot-circle',
						'square-full',
					],
					'fa-regular' => [
						'circle',
						'dot-circle',
						'square-full',
					],
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
		$title_word_limit = $settings['title_word_limit'];
	?>

	<div class="success-story-wrap recent-posts related-posts">
		<div class="swiper recentPosts">
			<div class="swiper-wrapper">
				<?php

				// The Query
				$args = array(
					'post_type' => 'post',
					'posts_per_page'      => $settings['post_count'],
					'post_status' => 'publish',
					'ignore_sticky_posts' => 1,
					'orderby' => 'date',
					'order'   =>  'DESC',
				);

				$the_query = new \WP_Query( $args );
				// The Loop
				if ( $the_query->have_posts() ) {
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						
						?>
						<article id="post-<?php the_ID();?>" <?php post_class( 'swiper-slide single-success-story' );?>>
							<a href="<?php the_permalink(  ); ?>" class="d-block success-story-thumb-wrap">
								<div class="success-story-thumb" style="background-image: url(<?php  the_post_thumbnail_url('full'); ?>);"></div>
							</a>
							<div class="service-content success-story-content">
								<div class="blog-meta">
									<p><?php echo get_the_date(); ?></p>
								</div>
								<a href="<?php the_permalink(  ); ?>" class="d-block"><h2><?php echo wp_trim_words( get_the_title(), $title_word_limit, '' ); ?></h2></a>
								<a href="<?php the_permalink(  ); ?>" class="learn-btn"><?php echo esc_html__( 'Read more', 'kolegal' ) ?> <i class="fas fa-arrow-right"></i></a>
							</div>
						</article>
						<?php
					}
				}
				wp_reset_postdata();
				?>
			</div>
		</div>
		<div class="swiper-button-next">
			<?php \Elementor\Icons_Manager::render_icon( $settings['icon_right'], [ 'aria-hidden' => 'true' ] ); ?>
		</div>
    	<div class="swiper-button-prev">
			<?php \Elementor\Icons_Manager::render_icon( $settings['icon_left'], [ 'aria-hidden' => 'true' ] ); ?>
		</div>
	</div>

	


	<?php

	}

}