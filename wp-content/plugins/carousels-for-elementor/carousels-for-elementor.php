<?php
/**
 * Plugin Name: Carousels For Elementor
 * Description: Creates Carousel UIs extension for elementor
 * Version:     1.1.1
 * Author:      Tatenda Munenge
 * Author URI:  https://tatendamunenge.me
 * Text Domain: carousels-for-elementor
 * Elementor tested up to: 3.7.0
 * Elementor Pro tested up to: 3.7.0
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.0.1' );
}
/**
 * Register List Widget.
 *
 * Include widget file and register widget class.
 *
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function creative_studio_register_tabbed_carousel_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/tabbed-carousel-widget.php' );

	$widgets_manager->register( new \Elementor_Tabbed_Carousel_Widget() );

}

add_action( 'elementor/widgets/register', 'creative_studio_register_tabbed_carousel_widget' );

/**
* Enqueue scripts and styles.
*/
function creative_studio_register_tabbed_carousel_scripts() {
   wp_enqueue_style( 'slick-slider',   plugins_url( '/assets/slick/slick.css', __FILE__ ), array());
   wp_enqueue_style( 'slick-slider-theme', plugins_url( '/assets/slick/slick-theme.css', __FILE__ ), array() );
   wp_enqueue_style( 'tabbed-carousel-slider-css', plugins_url( '/assets/css/tabbed-carousel.css', __FILE__ ), array());
   wp_enqueue_script( 'slick-library', plugins_url( '/assets/slick/slick.min.js', __FILE__ ), array('jquery') );
   wp_enqueue_script( 'init-carousels', plugins_url('/assets/js/tabbed-carousel.js', __FILE__ ),array('jquery','slick-library'), _S_VERSION, true );
}

add_action( 'wp_enqueue_scripts', 'creative_studio_register_tabbed_carousel_scripts' );
