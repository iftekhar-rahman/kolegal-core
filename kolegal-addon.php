<?php
/**
 * Plugin Name: Ko Legal Addon
 * Description: Ko Legal Addon
 * Plugin URI:  https://elementor.com/
 * Version:     1.0.0
 * Author:      Iftekhar Rahman
 * Author URI:  https://developers.elementor.com/
 * Text Domain: kolegal-addon
 * 
 * Elementor tested up to:     3.5.0
 * Elementor Pro tested up to: 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function kolegal_addon() {

	// Load plugin file
	require_once( __DIR__ . '/includes/plugin.php' );

	// Run the plugin
	\Ko_Legal_Addon\Plugin::instance();

}
add_action( 'plugins_loaded', 'kolegal_addon' );