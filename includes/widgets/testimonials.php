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
class Ko_Legal_Testimonials extends \Elementor\Widget_Base {

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
		return 'Testimonials';
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
		return esc_html__( 'Testimonials', 'kolegal-addon' );
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

		// $this->add_control(
		// 	'title_word_limit',
		// 	[
		// 		'label' => esc_html__( 'Title Word Limit', 'kolegal-addon' ),
		// 		'type' => \Elementor\Controls_Manager::NUMBER,
		// 		'default' => 10,
		// 	]
		// );
		$this->add_control(
			'content_limit',
			[
				'label' => esc_html__( 'Content Limit', 'kolegal-addon' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 60,
			]
		);
		$this->add_control(
			'post_count',
			[
				'label' => esc_html__( 'Post Per Page', 'kolegal-addon' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 3,
			]
		);
		$this->add_control(
			'arrow_left',
			[
				'label' => esc_html__( 'Arrow Left', 'kolegal-addon' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'arrow_right',
			[
				'label' => esc_html__( 'Arrow Right', 'kolegal-addon' ),
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
		$content_limit = $settings['content_limit'];
		// $title_word_limit = $settings['title_word_limit'];
	?>

	<div class="testimonials-wrap">
		<div class="swiper testimonials">
			<div class="swiper-wrapper">
				<?php

				// The Query
				$args = array(
					'post_type' => 'testimonial',
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
						<article id="post-<?php the_ID();?>" <?php post_class( 'swiper-slide single-testimonial' );?>>
							<div class="single-slide-inner">
								<div class="content-wrap">
									<i aria-hidden="true" class="icon icon-quote left-icon"></i>
									<?php echo wp_trim_words( get_the_content(), $content_limit, '...' ); ?>
									<i aria-hidden="true" class="icon icon-quote right-icon"></i>
								</div>
								<div class="testimonial-footer">
									<div class="author-detail author-extra-text">
										<div class="author-image">
											<?php
											if ( has_post_thumbnail() ) {
												the_post_thumbnail();
											}
											?>
										</div>
										<?php
										$author_heading_one = get_field( "author_heading_one" );
										$author_heading_two = get_field( "author_heading_two" );

										if( $author_heading_one || $author_heading_two ) {
											?>
											<div class="author-meta">
												<?php if($author_heading_one): ?>
												<h3><?php echo $author_heading_one; ?></h3>
												<?php endif; ?>
												<p><?php echo $author_heading_two; ?></p>
											</div>
											<?php
										} 
										?>
									</div>
									<div class="stars">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
									</div>
								</div>
							</div>
						</article>
						<?php
					}
				}
				wp_reset_postdata();
				?>
			</div>
		</div>
		<div class="swiper-slide-nav">
			<div class="swiper-button-next-testi">
				<img src="<?php echo esc_url($settings['arrow_left']['url']); ?>" alt="">
			</div>
			<div class="swiper-button-prev-testi">
				<img src="<?php echo esc_url($settings['arrow_right']['url']); ?>" alt="">
			</div>
		</div>
	</div>

	<?php

	}

}