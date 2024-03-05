<?php

namespace Ko_Legal_Addon;



if (!defined('ABSPATH')) {

	exit; // Exit if accessed directly.

}



/**

 * Elementor oEmbed Widget.

 *

 * Elementor widget that inserts an embbedable content into the page, from any given URL.

 *

 * @since 1.0.0

 */

class Ko_Legal_Mobile_Header extends \Elementor\Widget_Base

{



	/**

	 * Get widget name.

	 *

	 * Retrieve oEmbed widget name.

	 *

	 * @since 1.0.0

	 * @access public

	 * @return string Widget name.

	 */

	public function get_name()

	{

		return 'mobile-header';

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

	public function get_title()

	{

		return esc_html__('Mobile Header', 'kolegal-addon');

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

	public function get_icon()

	{

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

	public function get_categories()

	{

		return ['basic', 'kolegal'];

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

	protected function register_controls()

	{



		$this->start_controls_section(

			'content_section',

			[

				'label' => esc_html__('Content', 'kolegal-addon'),

				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,

			]

		);



		$this->add_control(

			'title',

			[

				'label' => esc_html__('Title', 'kolegal-addon'),

				'type' => \Elementor\Controls_Manager::TEXT,

				'default' => esc_html__('Default title', 'kolegal-addon'),

				'placeholder' => esc_html__('Type your title here', 'kolegal-addon'),

				'label_block' => true,

			]

		);



		$this->add_control(

			'link_text',

			[

				'label' => esc_html__('Link Text', 'kolegal-addon'),

				'type' => \Elementor\Controls_Manager::TEXT,

				'default' => esc_html__('Default text', 'kolegal-addon'),

				'placeholder' => esc_html__('Type your link text', 'kolegal-addon'),

				'label_block' => true,

			]

		);



		$this->add_control(

			'link',

			[

				'label' => esc_html__('Link', 'kolegal-addon'),

				'type' => \Elementor\Controls_Manager::URL,

				'placeholder' => esc_html__('https://your-link.com', 'kolegal-addon'),

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

				'label' => esc_html__('Choose Image', 'kolegal-addon'),

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

	protected function render()

	{



		$settings = $this->get_settings_for_display();

		?>



		<div class="cd-dropdown-wrapper">

			<a class="cd-dropdown-trigger" href="#0"><i aria-hidden="true" class="fas fa-bars"></i></a>

			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id' => 'primary-menu',
					'container_id' => 'mobile-menu-wrap',
					'container_class' => 'cd-dropdown',
					'menu_class' => 'cd-dropdown-content',
					'li_class' => 'has-children',
				)
			);

			?>
			<nav class="cd-dropdown" hidden>
				<!-- <a href="#0" class="cd-close">Close</a> -->
				<!-- <h2>Title</h2> -->

				<ul class="cd-dropdown-content">

					<li class="has-children">
						<a href="http://codyhouse.co/?p=748">Clothing</a>

						<ul class="cd-secondary-dropdown is-hidden">
							<li class="go-back"><a href="#0">Back</a></li>
							<!-- <li class="see-all"><a href="http://codyhouse.co/?p=748">All Clothing</a></li> -->
							<li class="has-children">
								<a href="http://codyhouse.co/?p=748">Accessories</a>

								<ul class="i s-hidden">
									<li class="go-back"><a href="#0">Clothing</a></li>
									<li class="see-all"><a href="http://codyhouse.co/?p=748">All Accessories</a></li>
									<li class="has-children">
										<a href="#0">Beanies</a>
										<ul class="is-hidden">
											<li class="go-back"><a href="#0">Accessories</a></li>
											<li class="see-all"><a href="http://codyhouse.co/?p=748">All Benies</a></li>
											<li><a href="http://codyhouse.co/?p=748">Caps &amp; Hats</a></li>
											<li><a href="http://codyhouse.co/?p=748">Gifts</a></li>
											<li><a href="http://codyhouse.co/?p=748">Scarves &amp; Snoods</a></li>
										</ul>
									</li>
									<li class="has-children">
										<a href="#0">Caps &amp; Hats</a>
										<ul class="is-hidden">
											<li class="go-back"><a href="#0">Accessories</a></li>
											<li class="see-all"><a href="http://codyhouse.co/?p=748">All Caps &amp; Hats</a>
											</li>
											<li><a href="http://codyhouse.co/?p=748">Beanies</a></li>
											<li><a href="http://codyhouse.co/?p=748">Caps</a></li>
											<li><a href="http://codyhouse.co/?p=748">Hats</a></li>
										</ul>
									</li>
									<li><a href="http://codyhouse.co/?p=748">Glasses</a></li>
									<li><a href="http://codyhouse.co/?p=748">Gloves</a></li>
									<li><a href="http://codyhouse.co/?p=748">Jewellery</a></li>
									<li><a href="http://codyhouse.co/?p=748">Scarves</a></li>
								</ul>
							</li>
							<li class="has-children">
								<a href="http://codyhouse.co/?p=748">Bottoms</a>
								<ul class="is-hidden">
									<li class="go-back"><a href="#0">Clothing</a></li>
									<li class="see-all"><a href="http://codyhouse.co/?p=748">All Bottoms</a></li>
									<li><a href="http://codyhouse.co/?p=748">Casual Trousers</a></li>
									<li class="has-children">
										<a href="#0">Jeans</a>
										<ul class="is-hidden">
											<li class="go-back"><a href="#0">Bottoms</a></li>
											<li class="see-all"><a href="http://codyhouse.co/?p=748">All Jeans</a></li>
											<li><a href="http://codyhouse.co/?p=748">Ripped</a></li>
											<li><a href="http://codyhouse.co/?p=748">Skinny</a></li>
											<li><a href="http://codyhouse.co/?p=748">Slim</a></li>
											<li><a href="http://codyhouse.co/?p=748">Straight</a></li>
										</ul>
									</li>
									<li><a href="#0">Leggings</a></li>
									<li><a href="#0">Shorts</a></li>
								</ul>
							</li>
							<li class="has-children">
								<a href="http://codyhouse.co/?p=748">Jackets</a>
								<ul class="is-hidden">
									<li class="go-back"><a href="#0">Clothing</a></li>
									<li class="see-all"><a href="http://codyhouse.co/?p=748">All Jackets</a></li>
									<li><a href="http://codyhouse.co/?p=748">Blazers</a></li>
									<li><a href="http://codyhouse.co/?p=748">Bomber jackets</a></li>
									<li><a href="http://codyhouse.co/?p=748">Denim Jackets</a></li>
									<li><a href="http://codyhouse.co/?p=748">Duffle Coats</a></li>
									<li><a href="http://codyhouse.co/?p=748">Leather Jackets</a></li>
									<li><a href="http://codyhouse.co/?p=748">Parkas</a></li>
								</ul>
							</li>
							<li class="has-children">
								<a href="http://codyhouse.co/?p=748">Tops</a>
								<ul class="is-hidden">
									<li class="go-back"><a href="#0">Clothing</a></li>
									<li class="see-all"><a href="http://codyhouse.co/?p=748">All Tops</a></li>
									<li><a href="http://codyhouse.co/?p=748">Cardigans</a></li>
									<li><a href="http://codyhouse.co/?p=748">Coats</a></li>
									<li><a href="http://codyhouse.co/?p=748">Polo Shirts</a></li>
									<li><a href="http://codyhouse.co/?p=748">Shirts</a></li>
									<li class="has-children">
										<a href="#0">T-Shirts</a>
										<ul class="is-hidden">
											<li class="go-back"><a href="#0">Tops</a></li>
											<li class="see-all"><a href="http://codyhouse.co/?p=748">All T-shirts</a></li>
											<li><a href="http://codyhouse.co/?p=748">Plain</a></li>
											<li><a href="http://codyhouse.co/?p=748">Print</a></li>
											<li><a href="http://codyhouse.co/?p=748">Striped</a></li>
											<li><a href="http://codyhouse.co/?p=748">Long sleeved</a></li>
										</ul>
									</li>
									<li><a href="http://codyhouse.co/?p=748">Vests</a></li>
								</ul>
							</li>
						</ul> <!-- .cd-secondary-dropdown -->
					</li> <!-- .has-children -->
					<li class="has-children">
						<a href="http://codyhouse.co/?p=748">Gallery</a>
						<ul class="cd-dropdown-gallery is-hidden">
							<li class="go-back"><a href="#0">Menu</a></li>
							<li class="see-all"><a href="http://codyhouse.co/?p=748">Browse Gallery</a></li>
							<li>
								<a class="cd-dropdown-item" href="http://codyhouse.co/?p=748">
									<img src="img/img.png" alt="Product Image">
									<h3>Product #1</h3>
								</a>
							</li>
							<li>
								<a class="cd-dropdown-item" href="http://codyhouse.co/?p=748">
									<img src="img/img.png" alt="Product Image">
									<h3>Product #2</h3>
								</a>
							</li>
							<li>
								<a class="cd-dropdown-item" href="http://codyhouse.co/?p=748">
									<img src="img/img.png" alt="Product Image">
									<h3>Product #3</h3>
								</a>
							</li>
							<li>
								<a class="cd-dropdown-item" href="http://codyhouse.co/?p=748">
									<img src="img/img.png" alt="Product Image">
									<h3>Product #4</h3>
								</a>
							</li>
						</ul> <!-- .cd-dropdown-gallery -->
					</li> <!-- .has-children -->
					<li class="has-children">
						<a href="http://codyhouse.co/?p=748">Services</a>
						<ul class="cd-dropdown-icons is-hidden">
							<li class="go-back"><a href="#0">Menu</a></li>
							<li class="see-all"><a href="http://codyhouse.co/?p=748">Browse Services</a></li>
							<li>
								<a class="cd-dropdown-item item-1" href="http://codyhouse.co/?p=748">
									<h3>Service #1</h3>
									<p>This is the item description</p>
								</a>
							</li>
							<li>
								<a class="cd-dropdown-item item-2" href="http://codyhouse.co/?p=748">
									<h3>Service #2</h3>
									<p>This is the item description</p>
								</a>
							</li>
							<li>
								<a class="cd-dropdown-item item-3" href="http://codyhouse.co/?p=748">
									<h3>Service #3</h3>
									<p>This is the item description</p>
								</a>
							</li>
							<li>
								<a class="cd-dropdown-item item-4" href="http://codyhouse.co/?p=748">
									<h3>Service #4</h3>
									<p>This is the item description</p>
								</a>
							</li>
							<li>
								<a class="cd-dropdown-item item-5" href="http://codyhouse.co/?p=748">
									<h3>Service #5</h3>
									<p>This is the item description</p>
								</a>
							</li>
							<li>
								<a class="cd-dropdown-item item-6" href="http://codyhouse.co/?p=748">
									<h3>Service #6</h3>
									<p>This is the item description</p>
								</a>
							</li>
							<li>
								<a class="cd-dropdown-item item-7" href="http://codyhouse.co/?p=748">
									<h3>Service #7</h3>
									<p>This is the item description</p>
								</a>
							</li>
							<li>
								<a class="cd-dropdown-item item-8" href="http://codyhouse.co/?p=748">
									<h3>Service #8</h3>
									<p>This is the item description</p>
								</a>
							</li>
							<li>
								<a class="cd-dropdown-item item-9" href="http://codyhouse.co/?p=748">
									<h3>Service #9</h3>
									<p>This is the item description</p>
								</a>
							</li>
							<li>
								<a class="cd-dropdown-item item-10" href="http://codyhouse.co/?p=748">
									<h3>Service #10</h3>
									<p>This is the item description</p>
								</a>
							</li>
							<li>
								<a class="cd-dropdown-item item-11" href="http://codyhouse.co/?p=748">
									<h3>Service #11</h3>
									<p>This is the item description</p>
								</a>
							</li>
							<li>
								<a class="cd-dropdown-item item-12" href="http://codyhouse.co/?p=748">
									<h3>Service #12</h3>
									<p>This is the item description</p>
								</a>
							</li>
						</ul> <!-- .cd-dropdown-icons -->
					</li> <!-- .has-children -->
					<li class="cd-divider">Divider</li>
					<!-- <li><a href="http://codyhouse.co/?p=748">Page 1</a></li>
					<li><a href="http://codyhouse.co/?p=748">Page 2</a></li>
					<li><a href="http://codyhouse.co/?p=748">Page 3</a></li> -->
				</ul> <!-- .cd-dropdown-content -->
			</nav> <!-- .cd-dropdown -->
		</div> <!-- .cd-dropdown-wrapper -->







		<?php





	}



}