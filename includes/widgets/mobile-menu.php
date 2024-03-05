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
class Ko_Legal_Mobile_Menu extends \Elementor\Widget_Base {

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
		return 'mobile-menu';
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
		return esc_html__( 'Mobile Menu', 'kolegal-addon' );
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

	
<div class="slide-menu-control" id="mobile-menu-handle" data-target="demo-2" data-action="toggle">
	<span></span>
	<span></span>
	<span></span>
	<span></span>
</div>


<!-- 
<nav class="slide-menu" id="demo-2">
  <div class="controls">
    <button type="button" class="btn slide-menu-control" data-action="close">Close</button>
    <button type="button" class="btn slide-menu-control" data-action="back">Back</button>
  </div> -->

  	<?php
		wp_nav_menu(
			array(
				'theme_location' => 'menu-1',
				'menu_id' => 'primary-menu',
				'container_id' => 'demo-2',
				'container_class' => 'slide-menu',
				// 'menu_class' => 'cd-dropdown-content',
				// 'li_class' => 'has-children',
			)
		);
	?>
    
  <!-- <ul>
    <li><a href="#">Home</a>
      <ul>
        <li><a href="#">Submenu entry</a></li>
        <li><a href="#">Submenu entry</a>
          <ul>
            <li><a href="#">Subsubmenu entry</a></li>
            <li><a href="#" id="special-link-2">Subsubsubmenu entry - I'm special 2!</a></li>
            <li><a href="#">Subsubmenu entry</a></li>
            <li><a href="#">Subsubmenu entry</a>
              <ul>
                <li><a href="#">Subsubsubmenu entry</a></li>
                <li><a href="#">Subsubsubmenu entry</a></li>
                <li><a href="#">Subsubsubmenu entry</a></li>
                <li id="special-link-3"><a href="#">Subsubsubmenu entry - I'm special 3!</a></li>
                <li><a href="#">Subsubsubmenu entry</a></li>
              </ul>
            </li>
            <li><a href="#">Subsubmenu entry</a></li>
          </ul>
        </li>
        <li><a href="#">Submenu entry</a></li>
        <li><a href="#">Submenu entry</a></li>
        <li><a href="#">Submenu entry</a></li>
      </ul>
    </li>
    <li><a href="#" id="special-link-1">Contact</a></li>
    <li><a href="#">Services</a>
      <ul>
        <li><a href="#">Submenu entry</a></li>
        <li><a href="#">Submenu entry</a>
          <ul>
            <li><a href="#">Subsubmenu entry</a></li>
            <li><a href="#">Subsubmenu entry</a></li>
            <li><a href="#">Subsubmenu entry</a></li>
            <li><a href="#">Subsubmenu entry</a></li>
            <li><a href="#">Subsubmenu entry</a></li>
          </ul>
        </li>
        <li><a href="#">Submenu entry</a></li>
        <li><a href="#">Submenu entry</a></li>
        <li><a href="#">Submenu entry</a></li>
      </ul>
    </li>
  </ul> -->
<!-- </nav> -->

	<?php
	

	}

}