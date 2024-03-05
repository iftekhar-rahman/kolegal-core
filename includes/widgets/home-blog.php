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
class Ko_Legal_Home_Blog extends \Elementor\Widget_Base {

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
		return 'home-blog';
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
		return esc_html__( 'Home Blog', 'kolegal-addon' );
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
				'label' => esc_html__( 'Content', 'honestdental-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'post_count',
			[
				'label' => esc_html__( 'Post Per Page', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 3,
			]
		);

		$this->add_control(
			'post_orderby',
			[
				'label' => esc_html__( 'Post Order By', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'ID'  => esc_html__( 'ID', 'plugin-name' ),
					'date' => esc_html__( 'Date', 'plugin-name' ),
					'comment_count' => esc_html__( 'Comment Count', 'plugin-name' ),
					'author' => esc_html__( 'Author', 'plugin-name' ),
					'title' => esc_html__( 'Title', 'plugin-name' ),
					'rand' => esc_html__( 'Rand', 'plugin-name' ),
				],
			]
		);

		$this->add_control(
			'post_order',
			[
				'label' => esc_html__( 'Post Order', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'ASC'  => esc_html__( 'Ascending', 'plugin-name' ),
					'DESC' => esc_html__( 'Descending', 'plugin-name' ),
				],
			]
		);

		$this->add_control(
			'title_word_limit',
			[
				'label' => esc_html__( 'Title Word Limit', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 40,
			]
		);


		$this->end_controls_section();

		// section_style
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'honestdental-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

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

	<div class="enginescale-blog-section grid-container grid-wrapper">
	<?php

		// The Query
		$args = array(
			'post_type' => 'post',
			'posts_per_page'      => $settings['post_count'],
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1,
			'orderby' => $settings['post_orderby'],
			'order'   =>  $settings['post_order'],
			'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
		);

		$the_query = new \WP_Query( $args );
		// The Loop
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				
				?>
				<article id="post-<?php the_ID();?>" <?php post_class( 'single-item' );?>>
					<div class="blog-inner">
						<a href="<?php the_permalink(  ); ?>" class="d-block blog-thumb-wrap">
							<div class="blog-thumb" style="background-image: url(<?php  the_post_thumbnail_url('full'); ?>);"></div>
							<div class="blog-content">
								<div class="blog-meta">
									<p><?php echo get_the_date(); ?></p>
								</div>
								<h2><?php echo wp_trim_words( get_the_title(), $title_word_limit, '' ); ?></h2>
							</div>
						</a>
					</div>
				</article>
				<?php
			}
		}
		wp_reset_postdata();
	?>
	</div>


	<?php

	}

}