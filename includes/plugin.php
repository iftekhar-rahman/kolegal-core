<?php

namespace Ko_Legal_Addon;



if ( ! defined( 'ABSPATH' ) ) {

	exit; // Exit if accessed directly.

}



/**

 * Plugin class.

 *

 * The main class that initiates and runs the addon.

 *

 * @since 1.0.0

 */

final class Plugin {



	/**

	 * Addon Version

	 *

	 * @since 1.0.0

	 * @var string The addon version.

	 */

	const VERSION = '1.0.0';



	/**

	 * Minimum Elementor Version

	 *

	 * @since 1.0.0

	 * @var string Minimum Elementor version required to run the addon.

	 */

	const MINIMUM_ELEMENTOR_VERSION = '3.0.9';



	/**

	 * Minimum PHP Version

	 *

	 * @since 1.0.0

	 * @var string Minimum PHP version required to run the addon.

	 */

	const MINIMUM_PHP_VERSION = '7.3';



	/**

	 * Instance

	 *

	 * @since 1.0.0

	 * @access private

	 * @static

	 * @var \Ko_Legal_Addon\Plugin The single instance of the class.

	 */

	private static $_instance = null;



	/**

	 * Instance

	 *

	 * Ensures only one instance of the class is loaded or can be loaded.

	 *

	 * @since 1.0.0

	 * @access public

	 * @static

	 * @return \RRF_Commerce_Addon\Plugin An instance of the class.

	 */

	public static function instance() {



		if ( is_null( self::$_instance ) ) {

			self::$_instance = new self();

		}

		return self::$_instance;



	}



	/**

	 * Constructor

	 *

	 * Perform some compatibility checks to make sure basic requirements are meet.

	 * If all compatibility checks pass, initialize the functionality.

	 *

	 * @since 1.0.0

	 * @access public

	 */

	public function __construct() {



		if ( $this->is_compatible() ) {

			add_action( 'elementor/init', [ $this, 'init' ] );

		}



	}



	/**

	 * Compatibility Checks

	 *

	 * Checks whether the site meets the addon requirement.

	 *

	 * @since 1.0.0

	 * @access public

	 */

	public function is_compatible() {



		// Check if Elementor installed and activated

		if ( ! did_action( 'elementor/loaded' ) ) {

			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );

			return false;

		}



		// Check for required Elementor version

		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {

			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );

			return false;

		}



		// Check for required PHP version

		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {

			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );

			return false;

		}



		return true;



	}



	/**

	 * Admin notice

	 *

	 * Warning when the site doesn't have Elementor installed or activated.

	 *

	 * @since 1.0.0

	 * @access public

	 */

	public function admin_notice_missing_main_plugin() {



		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );



		$message = sprintf(

			/* translators: 1: Plugin name 2: Elementor */

			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'elementor-test-addon' ),

			'<strong>' . esc_html__( 'AdmissionSight Addon', 'elementor-test-addon' ) . '</strong>',

			'<strong>' . esc_html__( 'Elementor', 'elementor-test-addon' ) . '</strong>'

		);



		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );



	}



	/**

	 * Admin notice

	 *

	 * Warning when the site doesn't have a minimum required Elementor version.

	 *

	 * @since 1.0.0

	 * @access public

	 */

	public function admin_notice_minimum_elementor_version() {



		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );



		$message = sprintf(

			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */

			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-addon' ),

			'<strong>' . esc_html__( 'AdmissionSight Addon', 'elementor-test-addon' ) . '</strong>',

			'<strong>' . esc_html__( 'Elementor', 'elementor-test-addon' ) . '</strong>',

			 self::MINIMUM_ELEMENTOR_VERSION

		);



		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );



	}



	/**

	 * Admin notice

	 *

	 * Warning when the site doesn't have a minimum required PHP version.

	 *

	 * @since 1.0.0

	 * @access public

	 */

	public function admin_notice_minimum_php_version() {



		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );



		$message = sprintf(

			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */

			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-addon' ),

			'<strong>' . esc_html__( 'AdmissionSight Addon', 'elementor-test-addon' ) . '</strong>',

			'<strong>' . esc_html__( 'PHP', 'elementor-test-addon' ) . '</strong>',

			 self::MINIMUM_PHP_VERSION

		);



		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );



	}



	/**

	 * Initialize

	 *

	 * Load the addons functionality only after Elementor is initialized.

	 *

	 * Fired by `elementor/init` action hook.

	 *

	 * @since 1.0.0

	 * @access public

	 */

	public function init() {



		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		add_action( 'elementor/elements/categories_registered', [$this, 'custom_categories' ]);

		add_action( 'elementor/frontend/after_enqueue_styles', [$this, 'my_plugin_frontend_stylesheets'] );

		add_action( 'elementor/frontend/after_register_scripts', [$this, 'my_plugin_frontend_scripts'] );

		

	}





	// To load CSS on all pages

	public function my_plugin_frontend_stylesheets() {

		wp_register_style( 'swiper-bundle', plugins_url( '/assets/css/swiper-bundle.min.css', __FILE__ ) );
		wp_register_style( 'common-css', plugins_url( '/assets/css/common.css', __FILE__ ) );
		wp_register_style( 'services-css', plugins_url( '/assets/css/services.css', __FILE__ ) );
		wp_register_style( 'clientstory-css', plugins_url( '/assets/css/clientstory.css', __FILE__ ) );
		wp_register_style( 'blog-css', plugins_url( '/assets/css/blog.css', __FILE__ ) );
		wp_register_style( 'testimonial-css', plugins_url( '/assets/css/testimonial.css', __FILE__ ) );
		wp_register_style( 'about-css', plugins_url( '/assets/css/about.css', __FILE__ ) );
		wp_register_style( 'slide-menu', plugins_url( '/assets/css/slide-menu.min.css', __FILE__ ) );
		wp_register_style( 'custom', plugins_url( '/assets/css/custom.css', __FILE__ ) );
		wp_register_style( 'process', plugins_url( '/assets/css/process.css', __FILE__ ) );
		wp_register_style( 'calculator', plugins_url( '/assets/css/calculator.css', __FILE__ ) );

		wp_enqueue_style( 'swiper-bundle' );
		wp_enqueue_style( 'common-css' );
		wp_enqueue_style( 'services-css' );
		wp_enqueue_style( 'clientstory-css' );
		wp_enqueue_style( 'blog-css' );
		wp_enqueue_style( 'testimonial-css' );
		wp_enqueue_style( 'about-css' );
		wp_enqueue_style( 'slide-menu' );
		wp_enqueue_style( 'custom' );
		wp_enqueue_style( 'process' );
		wp_enqueue_style( 'calculator' );



	}



	// JS

	public function my_plugin_frontend_scripts() {

		wp_register_script( 'tab-js', plugins_url( '/assets/js/tab.js', __FILE__ ), [ 'jquery' ], '', true );
		wp_register_script( 'calculator-js', plugins_url( '/assets/js/calculator.js', __FILE__ ), [ 'jquery' ], '', true );
		wp_register_script( 'swiper-bundle', plugins_url( '/assets/js/swiper-bundle.min.js', __FILE__ ), [ 'jquery' ], '', true );
		// wp_register_script( 'menu-aim', plugins_url( '/assets/js/jquery.menu-aim.js', __FILE__ ), [ 'jquery' ], '', true );
		wp_register_script( 'slide-menu', plugins_url( '/assets/js/slide-menu.min.js', __FILE__ ), [ 'jquery' ], '', true );
		wp_register_script( 'main-js', plugins_url( '/assets/js/main.js', __FILE__ ), [ 'jquery' ], '', true );

		wp_enqueue_script( 'tab-js' );
		wp_enqueue_script( 'calculator-js' );
		wp_enqueue_script( 'swiper-bundle' );
		// wp_enqueue_script( 'menu-aim' );
		wp_enqueue_script( 'slide-menu' );
		wp_enqueue_script( 'main-js' );

	}

	

	

	



	public function custom_categories( $elements_manager ) {

		$elements_manager->add_category(

			'kolegal',
			[

				'title' => esc_html__( 'Ko Legal', 'kolegal-addon' ),
				'icon' => 'fa fa-plug',
			]

		);

	

	}


	/**

	 * Register Widgets
	 *
	 * Load widgets files and register new Elementor widgets.
	 *
	 * Fired by `elementor/widgets/register` action hook.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
	 */

	public function register_widgets( $widgets_manager ) {



		// require_once( __DIR__ . '/widgets/expertise.php' );
		// require_once( __DIR__ . '/widgets/about.php' );
		// require_once( __DIR__ . '/widgets/recent-posts.php' );
		// require_once( __DIR__ . '/widgets/expertise-tab.php' );
		require_once( __DIR__ . '/widgets/client-stories.php' );
		require_once( __DIR__ . '/widgets/home-blog.php' );
		require_once( __DIR__ . '/widgets/recent-stories.php' );
		require_once( __DIR__ . '/widgets/testimonials.php' );
		require_once( __DIR__ . '/widgets/client-story-posts.php' );
		require_once( __DIR__ . '/widgets/mobile-menu.php' );
		require_once( __DIR__ . '/widgets/process.php' );
		require_once( __DIR__ . '/widgets/interest-calculator.php' );


		// $widgets_manager->register( new \Ko_Legal_Addon\Ko_Legal_About() );
		// $widgets_manager->register( new \Ko_Legal_Addon\Ko_Legal_Expertise() );
		// $widgets_manager->register( new \Ko_Legal_Addon\Ko_Legal_Expertise_Tab() );
		// $widgets_manager->register( new \Ko_Legal_Addon\Ko_Legal_Recent_Posts() );
		$widgets_manager->register( new \Ko_Legal_Addon\Ko_Legal_Client_Stories() );
		$widgets_manager->register( new \Ko_Legal_Addon\Ko_Legal_Home_Blog() );
		$widgets_manager->register( new \Ko_Legal_Addon\Ko_Legal_Recent_Stories() );
		$widgets_manager->register( new \Ko_Legal_Addon\Ko_Legal_Testimonials() );
		$widgets_manager->register( new \Ko_Legal_Addon\Ko_Legal_Client_Story_Posts() );
		$widgets_manager->register( new \Ko_Legal_Addon\Ko_Legal_Mobile_Menu() );
		$widgets_manager->register( new \Ko_Legal_Addon\Ko_Legal_Process() );
		$widgets_manager->register( new \Ko_Legal_Addon\Ko_Legal_Calculator() );

	}



	



}





/**

 * Enqueue scripts and styles.

 */

// function rrf_commerce_plugin_scripts() {

// 	wp_enqueue_style( 'common-css', plugins_url('./assets/css/common.css', __FILE__));

	

// 	wp_enqueue_script( 'slick-js', plugins_url( './assets/js/slick.min.js', __FILE__ ), [ 'jquery' ] );

// }

// add_action( 'wp_enqueue_scripts', 'rrf_commerce_plugin_scripts' );