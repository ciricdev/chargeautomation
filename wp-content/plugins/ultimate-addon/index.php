<?php

/**
 * Plugin Name: Ultimate Addon For Elementor
 * Description: Ultimate Addon For Elementor is a full plugin for colleciton of elementor widgets.
 * Plugin URI: http://quomodosoft.com/plugins/ultimate-addon-elementor
 * Author: Mehedi Hasan Nahid
 * Author URI: http://quomodosoft.com
 * Version: 1.0.0
 * License: GPL2
 * Text Domain: ultimate
 * Domain Path: /languages/
 */

namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * PUGINS MAIN PATH CONSTANT
 */
define( 'ULTIMATE_VERSION', '1.0.0' );
define( 'ULTIMATE_ADDONS_ROOT', dirname(__FILE__) );

define( 'ULTIMATE_ADDONS_URL', plugins_url( '/', __FILE__ ) );
define( 'ULTIMATE_ADDONS_ROOT_JS', plugins_url( '/assets/js/', __FILE__ ) );
define( 'ULTIMATE_ADDONS_ROOT_CSS', plugins_url( '/assets/css/', __FILE__ ) );
define( 'ULTIMATE_ADDONS_ROOT_ICON', plugins_url( '/assets/icons/', __FILE__ ) );
define( 'ULTIMATE_ADDONS_ROOT_IMG', plugins_url( '/assets/img/', __FILE__ ) );

define( 'ULTIMATE_ADDONS_DIR_URL' , plugin_dir_url( __FILE__ ));
define( 'ULTIMATE_ADDONS_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'ULTIMATE_ADDONS_BASE', plugin_basename( ULTIMATE_ADDONS_ROOT ) );

final class Ultimate_Elementor_Extension {

	const VERSION                   = '1.0.0';
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
	const MINIMUM_PHP_VERSION       = '5.7';

	private static $_instance = null;
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}
	public function init() {

		load_plugin_textdomain( 'ultimate' );

		/*---------------------------------
			Check if Elementor installed and activated
		-----------------------------------*/
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		/*---------------------------------
			Check for required Elementor version
		----------------------------------*/
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		/*----------------------------------
			Check for required PHP version
		-----------------------------------*/
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		/*----------------------------------
			ADD NEW ELEMENTOR CATEGORIES
		------------------------------------*/
		add_action( 'elementor/init', [ $this, 'add_elementor_category' ] );

		/*----------------------------------
			ADD PLUGIN WIDGETS ACTIONS
		-----------------------------------*/
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );

		/*----------------------------------
			ELEMENTOR REGISTER CONTROL
		-----------------------------------*/
		/*add_action( 'elementor/controls/controls_registered', [ $this, 'init_controls' ] );*/	

		/*----------------------------------
			EDITOR STYLE
		----------------------------------*/
		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'ultimate_editor_styles' ] );

		/*----------------------------------
			ENQUEUE DEFAULT SCRIPT
		-----------------------------------*/
		add_action( 'wp_enqueue_scripts', array ( $this, 'ultimate_default_scripts' ) );

		/*----------------------------------
			EDITOR ENQUEUE STYLE & SCRIPTS
		-----------------------------------*/
		/*add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'register_widget_scripts' ] );
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'enqueue_widget_styles' ] );*/

		/*---------------------------------
			REGISTER FRONTEND SCRIPTS
		----------------------------------*/
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'ultimate_register_frontend_scripts' ] );
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'ultimate_register_frontend_styles' ]);

		/*--------------------------------
			ENQUEUE FRONTEND SCRIPTS
		---------------------------------*/
		add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'ultimate_enqueue_frontend_scripts' ] );
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'ultimate_enqueue_frontend_style' ] );

		if (file_exists(dirname(__FILE__) . '/post/texonomy.php' )) {
			require_once(dirname(__FILE__) . '/post/texonomy.php' );
		}
		if (file_exists(dirname(__FILE__) . '/inc/helper_functions.php' )) {
			require_once(dirname(__FILE__) . '/inc/helper_functions.php' );
		}

		if (file_exists(dirname(__FILE__) . '/inc/dsicons.php' )) {
			require_once(dirname(__FILE__) . '/inc/dsicons.php' );
		}
	}

	/*******************************
	 * 	ADD ASSETS
	 *******************************/

	public function ultimate_editor_styles(){
		wp_enqueue_style( 'ultimate-editor', ULTIMATE_ADDONS_ROOT_CSS . 'ultimate-editor.css' );
	}

	public function ultimate_default_scripts(){
		if ( class_exists('Give') ) {
			wp_enqueue_style( 'overwrite', ULTIMATE_ADDONS_ROOT_CSS . 'overwrite.css', array('give-styles'), ULTIMATE_VERSION, 'all' );
		}
	}

	/**
	 * Enqueue Widget Scripts
	 *
	 * Enqueue custom Scripts required to run Skima Core.
	 *
	 * @since 1.7.0
	 * @since 1.7.1 The method moved to this class.
	 *
	 * @access public
	 */
	public function ultimate_enqueue_frontend_scripts(){
        wp_enqueue_script( 'appear', ULTIMATE_ADDONS_ROOT_JS . 'appear.js', array('jquery'), ULTIMATE_VERSION, true );
	}

	/**
	 * Register Widget Scripts
	 *
	 * Register custom scripts required to run Skima Core.
	 *
	 * @since 1.6.0
	 * @since 1.7.1 The method moved to this class.
	 *
	 * @access public
	 */
	public function ultimate_register_frontend_scripts() {

        wp_register_script( 'owl-carousel', ULTIMATE_ADDONS_ROOT_JS . 'owl.carousel.min.js', array('jquery'), ULTIMATE_VERSION, true );
        wp_register_script( 'slick', ULTIMATE_ADDONS_ROOT_JS . 'slick.min.js', array('jquery'), ULTIMATE_VERSION, true );
        wp_register_script( 'swiper', ULTIMATE_ADDONS_ROOT_JS . 'swiper.min.js', array('jquery'), ULTIMATE_VERSION, true );
        wp_register_script( 'modal-video', ULTIMATE_ADDONS_ROOT_JS . 'modal-video.min.js', array('jquery'), ULTIMATE_VERSION, true );
        wp_register_script( 'svg-progress', ULTIMATE_ADDONS_ROOT_JS . 'svg-progress-min.js', array('jquery'), ULTIMATE_VERSION, true );
        wp_register_script( 'TimeCircle', ULTIMATE_ADDONS_ROOT_JS . 'TimeCircles.js', array('jquery'), ULTIMATE_VERSION, true );
        wp_register_script( 'roadmap', ULTIMATE_ADDONS_ROOT_JS . 'roadmap.min.js', array('jquery'), ULTIMATE_VERSION, true );
        wp_register_script( 'timeline', ULTIMATE_ADDONS_ROOT_JS . 'timeline.min.js', array('jquery'), ULTIMATE_VERSION, true );

        /*--------------------------
			SINGLE SCRIPTS
        ---------------------------*/
        wp_register_script( 'isotope', ULTIMATE_ADDONS_ROOT_JS . 'isotope.pkgd.min.js', array('jquery','imagesloaded'), ULTIMATE_VERSION, true );
        wp_register_script( 'masonry', array('jquery' , 'imagesloaded') );
        wp_register_script( 'ajaxchimp', ULTIMATE_ADDONS_ROOT_JS . 'ajaxchimp.js', array('jquery'), ULTIMATE_VERSION, true );
        wp_register_script( 'anime', ULTIMATE_ADDONS_ROOT_JS . 'anime.min.js', array('jquery'), ULTIMATE_VERSION, true );
        wp_register_script( 'ultimate-effect', ULTIMATE_ADDONS_ROOT_JS . 'ultimate-effect.min.js', array('jquery'), ULTIMATE_VERSION, true );
        wp_register_script( 'ultimate-core', ULTIMATE_ADDONS_ROOT_JS . 'active.js', array('jquery'), ULTIMATE_VERSION, true );
	}

	/**
	 * Enqueue Widget Styles
	 *
	 * Enqueue custom styles required to run Skima Core.
	 *
	 * @since 1.7.0
	 * @since 1.7.1 The method moved to this class.
	 *
	 * @access public
	 */
	public function ultimate_enqueue_frontend_style() {
        wp_enqueue_style( 'ultimate-widgets', ULTIMATE_ADDONS_ROOT_CSS . 'widgets.css' );		
        wp_enqueue_style( 'animate', ULTIMATE_ADDONS_ROOT_CSS . 'animate.min.css' );		
	}

	/**
	 * Register Widget Styles
	 *
	 * Register custom styles required to run Skima Core.
	 *
	 * @since 1.7.0
	 * @since 1.7.1 The method moved to this class.
	 *
	 * @access public
	 */
	public function ultimate_register_frontend_styles(){
		wp_register_style( 'owl-carousel', ULTIMATE_ADDONS_ROOT_CSS .'owl.carousel.css' );
        wp_register_style( 'slick', ULTIMATE_ADDONS_ROOT_CSS .'slick.min.css' );
        wp_register_style( 'swiper', ULTIMATE_ADDONS_ROOT_CSS .'swiper.min.css' );
        wp_register_style( 'modal-video', ULTIMATE_ADDONS_ROOT_CSS .'modal-video.min.css' );
        wp_register_style( 'TimeCircle', ULTIMATE_ADDONS_ROOT_CSS .'TimeCircles.css' );
        wp_register_style( 'roadmap', ULTIMATE_ADDONS_ROOT_CSS .'roadmap.min.css' );
        wp_register_style( 'timeline', ULTIMATE_ADDONS_ROOT_CSS .'timeline.min.css' );

        //wp_register_script( $handle, $src, $deps = array, $ver = false, $in_footer = false );
	}

	/***************************
	 * 	VERSION CHECK
	 * *************************/
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'ultimate' ),
			'<strong>' . esc_html__( 'Elementor Ultimate Addons', 'ultimate' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'ultimate' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**************************
	 * 	MISSING NOTICE
	 ***************************/
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'ultimate' ),
			'<strong>' . esc_html__( 'Elementor Ultimate Addons', 'ultimate' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'ultimate' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/****************************
	 * 	PHP VERSION NOTICE
	 ****************************/
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'ultimate' ),
			'<strong>' . esc_html__( 'Elementor Ultimate Addons', 'ultimate' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'ultimate' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/****************************
	 * 	INIT WIDGETS
	 ****************************/
	public function init_widgets() {
		$this->ultimate_widgets();
		$this->ultimate_widgets_register();
	}

	public function ultimate_widgets(){
		/*---------------------------
			Include Widget files
		-----------------------------*/
		if (array_key_exists( 'accordion' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/adv_accordion.php' );
		}
		if (array_key_exists( 'area_title' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/area_title.php' );
		}
		if (array_key_exists( 'box' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/box.php' );
		}
		if (array_key_exists( 'info_box' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/info_box.php' );
		}
		if (array_key_exists( 'infotext_box' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/infotext_box.php' );
		}
		if (array_key_exists( 'business_hours' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/business_hours.php' ); /* Also It Will Be Used For Mega Listing With Icon*/
		}
		if (array_key_exists( 'multitype_gallery' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/multitype_gallery.php' );
		}
		if (array_key_exists( 'instagram' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/instagram.php' );
		}
		if (array_key_exists( 'cf7' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/ultimate_contact_from_seven.php' );
		}
		if (array_key_exists( 'testimonials' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/testimonials.php' );
		}
		if (array_key_exists( 'position_element' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/position_element.php' );
		}
		if (array_key_exists( 'teams' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/teams.php' );
		}
		if (array_key_exists( 'tabs' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/tabs.php' );
		}
		if (array_key_exists( 'post_carousel' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/post_carousel.php' );
		}
		if (array_key_exists( 'post_group' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/post_group.php' );
		}
		if (array_key_exists( 'portfolio_carousel' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/portfolio_carousel.php' );
		}
		if (array_key_exists( 'woocommerce_products' , ultimate_widget_control()) && class_exists( 'WooCommerce' ) ){
		    require_once( __DIR__ . '/widgets/woocommerce_products.php' );
		}
		if (array_key_exists( 'subscriber_form' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/subscriber_form.php' );
		}
		if (array_key_exists( 'tabs_price' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/tabs_price.php' );
		}
		if (array_key_exists( 'price_table' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/price_table.php' );
		}
		if (array_key_exists( 'shortcode' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/shortcode.php' );
		}
		if (array_key_exists( 'image_carousel' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/image_carousel.php' );
		}
		if (array_key_exists( 'image_carousel_alt' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/image_carousel_alt.php' );
		}
		if (array_key_exists( 'download_button' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/download_button.php' );
		}
		if (array_key_exists( 'dual_button' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/dual_button.php' );
		}
		if (array_key_exists( 'socials' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/socials.php' );
		}
		if (array_key_exists( 'video' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/video.php' );
		}
		if (array_key_exists( 'video_popup_button' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/video_popup_button.php' );
		}
		if (array_key_exists( 'welcome_slides' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/welcome_slides.php' );
		}
		if (array_key_exists( 'counter' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/counter.php' );
		}
		if (array_key_exists( 'counter_circle' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/counter_circle.php' );
		}
		if (array_key_exists( 'countdown_circle' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/countdown_circle.php' );
		}
		if (array_key_exists( 'navigation_menu' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/navigation_menu.php' );
		}
		if (array_key_exists( 'give_campains' , ultimate_widget_control()) && class_exists('Give') ){
		    require_once( __DIR__ . '/widgets/give_campains.php' );
		}
		if (array_key_exists( 'progress_roadmap' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/progress_roadmap.php' );
		}
		if (array_key_exists( 'timeline_roadmap' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/timeline_roadmap.php' );
		}
		if (array_key_exists( 'timeline_step' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/timeline_step.php' );
		}
		if (array_key_exists( 'timeline' , ultimate_widget_control()) ){
		    require_once( __DIR__ . '/widgets/timeline.php' );
		}
	}
	public function ultimate_widgets_register(){

		/**
		 * NOTE: If you use ( use \Elementor\Plugin as Plugin; ) you need to set namespace before instansiate in widget register.
		 * Like Plugin::instance()->widgets_manager->register_widget_type( new Widget_Class() );
		 * and If you use ( namespace Elementor ) No need instansiate in widget register.
		 * Like Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Widget_Class() );
		 */
	}

	/******************************
	 * 	INIT CONTROLS
	 ******************************/
	public function init_controls() {
		/*---------------------------
			Include Control files
		---------------------------*/
		//require_once( __DIR__ . '/controls/control.php' );

		/*---------------------------
			Register control
		---------------------------*/
		//Plugin::$instance->controls_manager->register_control( 'control-type-', new \Ultimate_Control() );
	}

	/*******************************
	 * 	ADD CUSTOM CATEGORY
	 *******************************/
	public function add_elementor_category()
	{
		Plugin::instance()->elements_manager->add_category( 'ultimate-addons', array(
			'title' => __( 'Ultimate Addons', 'ultimate' ),
			'icon'  => 'fa fa-plug',
		), 1 );
	}


	/******************************
	 * 	ALL INCLUDES
	******************************/
	public function includes() {

	}
}
Ultimate_Elementor_Extension::instance();
