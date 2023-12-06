<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Ultimate_Testmonial extends Widget_Base {

	public function get_name() {
		return 'UltimateTestmonial';
	}

	public function get_title() {
		return __( 'Testmonials', 'ultimate' );
	}

	public function get_icon() {
		return 'eicon-testimonial';
	}

	public function get_categories() {
		return array('ultimate-addons');
	}

	public function get_script_depends() {
		return[
			'owl-carousel',
			'ultimate-core',
		];
	}
	public function get_style_depends() {
		return[
			'owl-carousel',
		];
	}

	public static function testmonial_style(){
		return [
			'tesmonial_style_1'      => 'Testmonial Style 1',
			'tesmonial_style_2'      => 'Testmonial Style 2',
			'tesmonial_style_3'      => 'Testmonial Style 3',
			'tesmonial_style_4'      => 'Testmonial Style 4',
			'tesmonial_style_5'      => 'Testmonial Style 5',
			'tesmonial_style_6'      => 'Testmonial Style 6',
			'tesmonial_style_7'      => 'Testmonial Style 7',
			'tesmonial_style_8'      => 'Testmonial Style 8',
			'tesmonial_style_9'      => 'Testmonial Style 9',
			'tesmonial_style_10'     => 'Testmonial Style 10',
			'tesmonial_style_11'     => 'Testmonial Style 11',
			'tesmonial_style_12'     => 'Testmonial Style 12',
			'tesmonial_style_13'     => 'Testmonial Style 13',
			'tesmonial_custom_style' => 'Testmonial Custom Style',
		];
	}

	protected function _register_controls() {

		/******************************
		 * 	CONTENT SECTION
		 ******************************/
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'ultimate' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
			// Type
			$this->add_control(
				'testmonial_style',
				[
					'label'   => __( 'Testmonial Type', 'ultimate' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'tesmonial_style_1',
					'options' => self::testmonial_style(),
				]
			);

			// Icon Toggle
			$this->add_control(
				'show_icon',
				[
					'label'        => __( 'Show Quotation Icon ?', 'ultimate' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'Show', 'ultimate' ),
					'label_off'    => __( 'Hide', 'ultimate' ),
					'return_value' => 'yes',
					'default'      => 'yes',
				]
			);

			// Icon Type
			$this->add_control(
				'icon_type',
				[
					'label'   => __( 'Icon Type', 'ultimate' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'font_icon',
					'options' => [
						'font_icon'  => __( 'Font Icon', 'ultimate' ),
						'image_icon' => __( 'Image Icon', 'ultimate' ),
					],
					'condition' => [
						'show_icon' => 'yes',
					],
				]
			);

			// Font Icon
			$this->add_control(
				'font_icon',
				[
					'label'     => __( 'Font Icons', 'ultimate' ),
					'type'      => Controls_Manager::ICON,
					'default'   => 'fa fa-quote-right',
					'condition' => [
						'icon_type' => 'font_icon',
						'show_icon' => 'yes',
					],
				]
			);

			// Image Icon
			$this->add_control(
				'image_icon',
				[
					'label'   => __( 'Image Icon', 'ultimate' ),
					'type'    => Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
					'condition' => [
						'icon_type' => 'image_icon',
						'show_icon' => 'yes',
					],
				]
			);

			$repeater = new Repeater();

			// Title
			$repeater->add_control(
				'title',
				[
					'label'       => __( 'Title', 'ultimate' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => __( 'Title', 'ultimate' ),
				]
			);

			// Title Tag
			$repeater->add_control(
				'title_tag',
				[
					'label'   => __( 'Title HTML Tag', 'elementor' ),
					'type'    => Controls_Manager::SELECT,
					'options' => [
						'h1'   => 'H1',
						'h2'   => 'H2',
						'h3'   => 'H3',
						'h4'   => 'H4',
						'h5'   => 'H5',
						'h6'   => 'H6',
						'div'  => 'div',
						'span' => 'span',
						'p'    => 'p',
					],
					'default'   => 'h3',
					'condition' => [
						'title!' => '',
					],
				]
			);

			// Subtitle
			$repeater->add_control(
				'subtitle',
				[
					'label'       => __( 'Subtitle', 'ultimate' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => __( 'Subtitle', 'ultimate' ),
				]
			);

			// Subtitle Position
			$repeater->add_control(
				'subtitle_position',
				[
					'label'   => __( 'Subtitle Position', 'ultimate' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'after_title',
					'options' => [
						'before_title' => __( 'Before title', 'ultimate' ),
						'after_title'  => __( 'After Title', 'ultimate' ),
					],
					'condition' => [
						'subtitle!' => '',
					]
				]
			);

			// Member Name
			$repeater->add_control(
				'member_thumb',
				[
					'label'       => __( 'Testmonial Author Thumb', 'ultimate' ),
					'type'        => Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				]
			);

			$repeater->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name' => 'member_thumb_size',
					'default' => 'thumbnail',
				]
			);

			// Member Name
			$repeater->add_control(
				'member_name',
				[
					'label'       => __( 'Testmonial Author Name', 'ultimate' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => __( 'Member Name', 'ultimate' ),
				]
			);

			// Member Designation
			$repeater->add_control(
				'designation',
				[
					'label'       => __( 'Designation', 'ultimate' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => __( 'Designation Or Company', 'ultimate' ),
				]
			);

			// Description
			$repeater->add_control(
				'description',
				[
					'label'       => __( 'Description', 'ultimate' ),
					'type'        => Controls_Manager::WYSIWYG,
					'placeholder' => __( 'Description.', 'ultimate' ),
				]
			);
			$this->add_control(
				'testmonial_content',
				[
					'label' => __( 'Testmonial Items', 'ultimate' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'member_name' => __( 'M Hasan', 'ultimate' ),
							'designation' => __( 'Web Developer' ),
							'description' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga quos pariatur tempore nihil quisquam tempora odio et mollitia. Ea facere expedita beatae nesciunt vero aliquam similique eius veritatis unde eligendi.', 'ultimate' ),
						],
						[
							'member_name' => __( 'M Hasan', 'ultimate' ),
							'designation' => __( 'Web Developer' ),
							'description' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga quos pariatur tempore nihil quisquam tempora odio et mollitia. Ea facere expedita beatae nesciunt vero aliquam similique eius veritatis unde eligendi.', 'ultimate' ),
						],
						[
							'member_name' => __( 'M Hasan', 'ultimate' ),
							'designation' => __( 'Web Developer' ),
							'description' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga quos pariatur tempore nihil quisquam tempora odio et mollitia. Ea facere expedita beatae nesciunt vero aliquam similique eius veritatis unde eligendi.', 'ultimate' ),
						],
					],
					'title_field' => '{{{ member_name }}}',
				]
			);
		$this->end_controls_section();

		/******************************
		 * 	SLIDER OPTIONS SECTION
		 ******************************/
		$this->start_controls_section(
			'options_section',
			[
				'label'     => __( 'Slider Options', 'ultimate' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
		);
			$this->add_control(
				'item_on_large',
				[
					'label' => __( 'Item In large Device', 'ultimate' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 10,
							'step' => 0.1,
						],
					],
					'default' => [
						'size' => 3,
					],
				]
			);
			$this->add_control(
				'item_on_medium',
				[
					'label' => __( 'Item In Medium Device', 'ultimate' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 10,
							'step' => 0.1,
						],
					],
					'default' => [
						'size' => 3,
					],
				]
			);
			$this->add_control(
				'item_on_tablet',
				[
					'label' => __( 'Item In Tablet Device', 'ultimate' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 10,
							'step' => 0.1,
						],
					],
					'default' => [
						'size' => 2,
					],
				]
			);
			$this->add_control(
				'item_on_mobile',
				[
					'label' => __( 'Item In Mobile Device', 'ultimate' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 10,
							'step' => 1,
						],
					],
					'default' => [
						'size' => 1,
					],
				]
			);
			$this->add_control(
				'stage_padding',
				[
					'label' => __( 'Stage Padding', 'ultimate' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
							'step' => 1,
						],
					],
					'default' => [
						'size' => 0,
					],
				]
			);
			$this->add_control(
				'item_margin',
				[
					'label' => __( 'Item Margin', 'ultimate' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
						],
					],
					'default' => [
						'size' => 0,
					],
				]
			);
			$this->add_control(
				'autoplay',
				[
					'label'   => __( 'Slide Autoplay', 'ultimate' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'true',
					'options' => [
						'true'  => __( 'Yes', 'ultimate' ),
						'false' => __( 'No', 'ultimate' ),
					],
				]
			);
			$this->add_control(
				'autoplaytimeout',
				[
					'label' => __( 'Autoplay Timeout', 'ultimate' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 500,
							'max' => 10000,
							'step' => 100,
						],
					],
					'default' => [
						'size' => 3000,
					],
				]
			);
			$this->add_control(
				'slide_speed',
				[
					'label' => __( 'Slide Speed', 'ultimate' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 500,
							'max' => 10000,
							'step' => 100,
						],
					],
					'default' => [
						'size' => 1000,
					],
				]
			);
			$this->add_control(
				'slide_animation',
				[
					'label'   => __( 'Slide Animation', 'ultimate' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'no',
					'options' => [
						'yes' => __( 'Yes', 'ultimate' ),
						'no'      => __( 'No', 'ultimate' ),
					],
				]
			);
			$this->add_control(
				'slide_animate_in',
				[
					'label'   => __( 'Slide Animate In', 'ultimate' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'fadeIn',
					'options' => [
						'bounce'             => __('bounce','ultimate'),
						'flash'              => __('flash','ultimate'),
						'pulse'              => __('pulse','ultimate'),
						'rubberBand'         => __('rubberBand','ultimate'),
						'shake'              => __('shake','ultimate'),
						'headShake'          => __('headShake','ultimate'),
						'swing'              => __('swing','ultimate'),
						'tada'               => __('tada','ultimate'),
						'wobble'             => __('wobble','ultimate'),
						'jello'              => __('jello','ultimate'),
						'heartBeat'          => __('heartBeat','ultimate'),
						'bounceIn'           => __('bounceIn','ultimate'),
						'bounceInDown'       => __('bounceInDown','ultimate'),
						'bounceInLeft'       => __('bounceInLeft','ultimate'),
						'bounceInRight'      => __('bounceInRight','ultimate'),
						'bounceInUp'         => __('bounceInUp','ultimate'),
						'bounceOut'          => __('bounceOut','ultimate'),
						'bounceOutDown'      => __('bounceOutDown','ultimate'),
						'bounceOutLeft'      => __('bounceOutLeft','ultimate'),
						'bounceOutRight'     => __('bounceOutRight','ultimate'),
						'bounceOutUp'        => __('bounceOutUp','ultimate'),
						'fadeIn'             => __('fadeIn','ultimate'),
						'fadeInDown'         => __('fadeInDown','ultimate'),
						'fadeInDownBig'      => __('fadeInDownBig','ultimate'),
						'fadeInLeft'         => __('fadeInLeft','ultimate'),
						'fadeInLeftBig'      => __('fadeInLeftBig','ultimate'),
						'fadeInRight'        => __('fadeInRight','ultimate'),
						'fadeInRightBig'     => __('fadeInRightBig','ultimate'),
						'fadeInUp'           => __('fadeInUp','ultimate'),
						'fadeInUpBig'        => __('fadeInUpBig','ultimate'),
						'fadeOut'            => __('fadeOut','ultimate'),
						'fadeOutDown'        => __('fadeOutDown','ultimate'),
						'fadeOutDownBig'     => __('fadeOutDownBig','ultimate'),
						'fadeOutLeft'        => __('fadeOutLeft','ultimate'),
						'fadeOutLeftBig'     => __('fadeOutLeftBig','ultimate'),
						'fadeOutRight'       => __('fadeOutRight','ultimate'),
						'fadeOutRightBig'    => __('fadeOutRightBig','ultimate'),
						'fadeOutUp'          => __('fadeOutUp','ultimate'),
						'fadeOutUpBig'       => __('fadeOutUpBig','ultimate'),
						'flip'               => __('flip','ultimate'),
						'flipInX'            => __('flipInX','ultimate'),
						'flipInY'            => __('flipInY','ultimate'),
						'flipOutX'           => __('flipOutX','ultimate'),
						'flipOutY'           => __('flipOutY','ultimate'),
						'lightSpeedIn'       => __('lightSpeedIn','ultimate'),
						'lightSpeedOut'      => __('lightSpeedOut','ultimate'),
						'rotateIn'           => __('rotateIn','ultimate'),
						'rotateInDownLeft'   => __('rotateInDownLeft','ultimate'),
						'rotateInDownRight'  => __('rotateInDownRight','ultimate'),
						'rotateInUpLeft'     => __('rotateInUpLeft','ultimate'),
						'rotateInUpRight'    => __('rotateInUpRight','ultimate'),
						'rotateOut'          => __('rotateOut','ultimate'),
						'rotateOutDownLeft'  => __('rotateOutDownLeft','ultimate'),
						'rotateOutDownRight' => __('rotateOutDownRight','ultimate'),
						'rotateOutUpLeft'    => __('rotateOutUpLeft','ultimate'),
						'rotateOutUpRight'   => __('rotateOutUpRight','ultimate'),
						'hinge'              => __('hinge','ultimate'),
						'jackInTheBox'       => __('jackInTheBox','ultimate'),
						'rollIn'             => __('rollIn','ultimate'),
						'rollOut'            => __('rollOut','ultimate'),
						'zoomIn'             => __('zoomIn','ultimate'),
						'zoomInDown'         => __('zoomInDown','ultimate'),
						'zoomInLeft'         => __('zoomInLeft','ultimate'),
						'zoomInRight'        => __('zoomInRight','ultimate'),
						'zoomInUp'           => __('zoomInUp','ultimate'),
						'zoomOut'            => __('zoomOut','ultimate'),
						'zoomOutDown'        => __('zoomOutDown','ultimate'),
						'zoomOutLeft'        => __('zoomOutLeft','ultimate'),
						'zoomOutRight'       => __('zoomOutRight','ultimate'),
						'zoomOutUp'          => __('zoomOutUp','ultimate'),
						'slideInDown'        => __('slideInDown','ultimate'),
						'slideInLeft'        => __('slideInLeft','ultimate'),
						'slideInRight'       => __('slideInRight','ultimate'),
						'slideInUp'          => __('slideInUp','ultimate'),
						'slideOutDown'       => __('slideOutDown','ultimate'),
						'slideOutLeft'       => __('slideOutLeft','ultimate'),
						'slideOutRight'      => __('slideOutRight','ultimate'),
						'slideOutUp'         => __('slideOutUp','ultimate'),
					],
					'condition' => [
						'slide_animation' => 'yes',
					]
				]
			);
			$this->add_control(
				'slide_animate_out',
				[
					'label'   => __( 'Slide Animate Out', 'ultimate' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'fadeOut',
					'options' => [
						'bounce'             => __('bounce','ultimate'),
						'flash'              => __('flash','ultimate'),
						'pulse'              => __('pulse','ultimate'),
						'rubberBand'         => __('rubberBand','ultimate'),
						'shake'              => __('shake','ultimate'),
						'headShake'          => __('headShake','ultimate'),
						'swing'              => __('swing','ultimate'),
						'tada'               => __('tada','ultimate'),
						'wobble'             => __('wobble','ultimate'),
						'jello'              => __('jello','ultimate'),
						'heartBeat'          => __('heartBeat','ultimate'),
						'bounceIn'           => __('bounceIn','ultimate'),
						'bounceInDown'       => __('bounceInDown','ultimate'),
						'bounceInLeft'       => __('bounceInLeft','ultimate'),
						'bounceInRight'      => __('bounceInRight','ultimate'),
						'bounceInUp'         => __('bounceInUp','ultimate'),
						'bounceOut'          => __('bounceOut','ultimate'),
						'bounceOutDown'      => __('bounceOutDown','ultimate'),
						'bounceOutLeft'      => __('bounceOutLeft','ultimate'),
						'bounceOutRight'     => __('bounceOutRight','ultimate'),
						'bounceOutUp'        => __('bounceOutUp','ultimate'),
						'fadeIn'             => __('fadeIn','ultimate'),
						'fadeInDown'         => __('fadeInDown','ultimate'),
						'fadeInDownBig'      => __('fadeInDownBig','ultimate'),
						'fadeInLeft'         => __('fadeInLeft','ultimate'),
						'fadeInLeftBig'      => __('fadeInLeftBig','ultimate'),
						'fadeInRight'        => __('fadeInRight','ultimate'),
						'fadeInRightBig'     => __('fadeInRightBig','ultimate'),
						'fadeInUp'           => __('fadeInUp','ultimate'),
						'fadeInUpBig'        => __('fadeInUpBig','ultimate'),
						'fadeOut'            => __('fadeOut','ultimate'),
						'fadeOutDown'        => __('fadeOutDown','ultimate'),
						'fadeOutDownBig'     => __('fadeOutDownBig','ultimate'),
						'fadeOutLeft'        => __('fadeOutLeft','ultimate'),
						'fadeOutLeftBig'     => __('fadeOutLeftBig','ultimate'),
						'fadeOutRight'       => __('fadeOutRight','ultimate'),
						'fadeOutRightBig'    => __('fadeOutRightBig','ultimate'),
						'fadeOutUp'          => __('fadeOutUp','ultimate'),
						'fadeOutUpBig'       => __('fadeOutUpBig','ultimate'),
						'flip'               => __('flip','ultimate'),
						'flipInX'            => __('flipInX','ultimate'),
						'flipInY'            => __('flipInY','ultimate'),
						'flipOutX'           => __('flipOutX','ultimate'),
						'flipOutY'           => __('flipOutY','ultimate'),
						'lightSpeedIn'       => __('lightSpeedIn','ultimate'),
						'lightSpeedOut'      => __('lightSpeedOut','ultimate'),
						'rotateIn'           => __('rotateIn','ultimate'),
						'rotateInDownLeft'   => __('rotateInDownLeft','ultimate'),
						'rotateInDownRight'  => __('rotateInDownRight','ultimate'),
						'rotateInUpLeft'     => __('rotateInUpLeft','ultimate'),
						'rotateInUpRight'    => __('rotateInUpRight','ultimate'),
						'rotateOut'          => __('rotateOut','ultimate'),
						'rotateOutDownLeft'  => __('rotateOutDownLeft','ultimate'),
						'rotateOutDownRight' => __('rotateOutDownRight','ultimate'),
						'rotateOutUpLeft'    => __('rotateOutUpLeft','ultimate'),
						'rotateOutUpRight'   => __('rotateOutUpRight','ultimate'),
						'hinge'              => __('hinge','ultimate'),
						'jackInTheBox'       => __('jackInTheBox','ultimate'),
						'rollIn'             => __('rollIn','ultimate'),
						'rollOut'            => __('rollOut','ultimate'),
						'zoomIn'             => __('zoomIn','ultimate'),
						'zoomInDown'         => __('zoomInDown','ultimate'),
						'zoomInLeft'         => __('zoomInLeft','ultimate'),
						'zoomInRight'        => __('zoomInRight','ultimate'),
						'zoomInUp'           => __('zoomInUp','ultimate'),
						'zoomOut'            => __('zoomOut','ultimate'),
						'zoomOutDown'        => __('zoomOutDown','ultimate'),
						'zoomOutLeft'        => __('zoomOutLeft','ultimate'),
						'zoomOutRight'       => __('zoomOutRight','ultimate'),
						'zoomOutUp'          => __('zoomOutUp','ultimate'),
						'slideInDown'        => __('slideInDown','ultimate'),
						'slideInLeft'        => __('slideInLeft','ultimate'),
						'slideInRight'       => __('slideInRight','ultimate'),
						'slideInUp'          => __('slideInUp','ultimate'),
						'slideOutDown'       => __('slideOutDown','ultimate'),
						'slideOutLeft'       => __('slideOutLeft','ultimate'),
						'slideOutRight'      => __('slideOutRight','ultimate'),
						'slideOutUp'         => __('slideOutUp','ultimate'),
					],
					'condition' => [
						'slide_animation' => 'yes',
					]
				]
			);
			$this->add_control(
				'nav',
				[
					'label'   => __( 'Show Navigation', 'ultimate' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'false',
					'options' => [
						'true'  => __( 'Yes', 'ultimate' ),
						'false' => __( 'No', 'ultimate' ),
					],
				]
			);
			$this->add_control(
				'nav_position',
				[
					'label'   => __( 'Navigation Position', 'ultimate' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'outside_vertical_center_nav',
					'options' => [
						'inside_vertical_center_nav'  => __( 'Inside Vertical Center', 'ultimate' ),
						'outside_vertical_center_nav' => __( 'Outside Vertical Center', 'ultimate' ),
						'top_left_nav'                => __( 'Top Left', 'ultimate' ),
						'top_center_nav'              => __( 'Top Center', 'ultimate' ),
						'top_right_nav'               => __( 'Top Right', 'ultimate' ),
						'bottom_left_nav'             => __( 'Bottom Left', 'ultimate' ),
						'bottom_center_nav'           => __( 'Bottom Center', 'ultimate' ),
						'bottom_right_nav'            => __( 'Bottom Right', 'ultimate' ),
					],
					'condition' => [
						'nav' => 'true',
					],
				]
			);
			$this->add_control(
				'next_icon',
				[
					'label'     => __( 'Nav Next Icon', 'ultimate' ),
					'type'      => Controls_Manager::ICON,
					'default'   => 'fa fa-angle-right',
					'condition' => [
						'nav' => 'true',
					],
				]
			);
			$this->add_control(
				'prev_icon',
				[
					'label'     => __( 'Nav Prev Icon', 'ultimate' ),
					'type'      => Controls_Manager::ICON,
					'default'   => 'fa fa-angle-left',
					'condition' => [
						'nav' => 'true',
					],
				]
			);
			$this->add_control(
				'dots',
				[
					'label'   => __( 'Slide Dots', 'ultimate' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'false',
					'options' => [
						'true'  => __( 'Yes', 'ultimate' ),
						'false' => __( 'No', 'ultimate' ),
					],
				]
			);
			$this->add_control(
				'loop',
				[
					'label'   => __( 'Slide Loop', 'ultimate' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'true',
					'options' => [
						'true'  => __( 'Yes', 'ultimate' ),
						'false' => __( 'No', 'ultimate' ),
					],
				]
			);
			$this->add_control(
				'hover_pause',
				[
					'label'   => __( 'Pause On Hover', 'ultimate' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'true',
					'options' => [
						'true'  => __( 'Yes', 'ultimate' ),
						'false' => __( 'No', 'ultimate' ),
					],
				]
			);
			$this->add_control(
				'center',
				[
					'label'   => __( 'Slide Center Mode', 'ultimate' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'false',
					'options' => [
						'true'  => __( 'Yes', 'ultimate' ),
						'false' => __( 'No', 'ultimate' ),
					],
				]
			);
			$this->add_control(
				'rtl',
				[
					'label'   => __( 'Direction RTL', 'ultimate' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'false',
					'options' => [
						'true'  => __( 'Yes', 'ultimate' ),
						'false' => __( 'No', 'ultimate' ),
					],
				]
			);
		$this->end_controls_section();

		/*----------------------------
			SLIDER NAV WARP
		-----------------------------*/
		$this->start_controls_section(
			'slider_control_warp_style_section',
			[
				'label' => __( 'Slider Nav Warp', 'ultimate' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
			$this->add_group_control(
				Group_Control_Background:: get_type(),
				[
					'name'     => 'slider_nav_warp_background',
					'label'    => __( 'Background', 'ultimate' ),
					'types'    => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav',
				]
			);
			$this->add_group_control(
				Group_Control_Border:: get_type(),
				[
					'name'     => 'slider_nav_warp_border',
					'label'    => __( 'Border', 'ultimate' ),
					'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav > div',
				]
			);
			$this->add_control(
				'slider_nav_warp_radius',
				[
					'label'      => __( 'Border Radius', 'ultimate' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .sldier-content-area .owl-nav > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow:: get_type(),
				[
					'name'     => 'slider_nav_warp_shadow',
					'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav > div',
				]
			);
			$this->add_responsive_control(
				'slider_nav_warp_display',
				[
					'label'   => __( 'Display', 'ultimate' ),
					'type'    => Controls_Manager::SELECT,
					'default' => '',
					'options' => [
						'initial'      => __( 'Initial', 'ultimate' ),
						'block'        => __( 'Block', 'ultimate' ),
						'inline-block' => __( 'Inline Block', 'ultimate' ),
						'flex'         => __( 'Flex', 'ultimate' ),
						'inline-flex'  => __( 'Inline Flex', 'ultimate' ),
						'none'         => __( 'none', 'ultimate' ),
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav' => 'display: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'slider_nav_warp_position',
				[
					'label'   => __( 'Position', 'ultimate' ),
					'type'    => Controls_Manager::SELECT,
					'default' => '',
					
					'options' => [
						'initial'  => __( 'Initial', 'ultimate' ),
						'absolute' => __( 'Absulute', 'ultimate' ),
						'relative' => __( 'Relative', 'ultimate' ),
						'static'   => __( 'Static', 'ultimate' ),
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav' => 'position: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'slider_nav_warp_position_from_left',
				[
					'label'      => __( 'From Left', 'ultimate' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => -1000,
							'max'  => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav' => 'left: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'slider_nav_warp_position' => ['absolute','relative']
					],
				]
			);
			$this->add_responsive_control(
				'slider_nav_warp_position_from_right',
				[
					'label'      => __( 'From Right', 'ultimate' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => -1000,
							'max'  => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav' => 'right: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'slider_nav_warp_position' => ['absolute','relative']
					],
				]
			);
			$this->add_responsive_control(
				'slider_nav_warp_position_from_top',
				[
					'label'      => __( 'From Top', 'ultimate' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => -1000,
							'max'  => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav' => 'top: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'slider_nav_warp_position' => ['absolute','relative']
					],
				]
			);
			$this->add_responsive_control(
				'slider_nav_warp_position_from_bottom',
				[
					'label'      => __( 'From Bottom', 'ultimate' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => -1000,
							'max'  => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav' => 'bottom: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'slider_nav_warp_position' => ['absolute','relative']
					],
				]
			);
			$this->add_responsive_control(
				'slider_nav_warp_align',
				[
					'label'   => __( 'Alignment', 'ultimate' ),
					'type'    => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'ultimate' ),
							'icon'  => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'ultimate' ),
							'icon'  => 'fa fa-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'ultimate' ),
							'icon'  => 'fa fa-align-right',
						],
						'justify' => [
							'title' => __( 'Justify', 'ultimate' ),
							'icon'  => 'fa fa-align-justify',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav' => 'text-align: {{VALUE}};',
					],
					'default' => '',
				]
			);
			$this->add_responsive_control(
				'slider_nav_warp_width',
				[
					'label'      => __( 'Width', 'ultimate' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'slider_nav_warp_height',
				[
					'label'      => __( 'Height', 'ultimate' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'slider_nav_warp_opacity',
				[
					'label' => __( 'Opacity', 'ultimate' ),
					'type'  => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max'  => 1,
							'min'  => 0.10,
							'step' => 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav' => 'opacity: {{SIZE}};',
					],
				]
			);
			$this->add_control(
				'slider_nav_warp_zindex',
				[
					'label'     => __( 'Z-Index', 'ultimate' ),
					'type'      => Controls_Manager::NUMBER,
					'min'       => -99,
					'max'       => 99,
					'step'      => 1,
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav' => 'z-index: {{SIZE}};',
					],
				]
			);
			$this->add_responsive_control(
				'slider_nav_warp_margin',
				[
					'label'      => __( 'Margin', 'ultimate' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .sldier-content-area .owl-nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'slider_nav_warp_padding',
				[
					'label'      => __( 'Padding', 'ultimate' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .sldier-content-area .owl-nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();
		/*----------------------------
			SLIDER NAV WARP END
		-----------------------------*/

		/*----------------------------
			CONTROL BUTTON STYLE
		-----------------------------*/
		$this->start_controls_section(
			'slider_control_style_section',
			[
				'label' => __( 'Slider Nav Button', 'ultimate' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
			$this->start_controls_tabs( 'slide_button_tab_style' );
			$this->start_controls_tab(
				'slide_button_normal_tab',
				[
					'label' => __( 'Normal', 'ultimate' ),
				]
			);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name'      => 'slide_button_typography',
						'selector'  => '{{WRAPPER}} .sldier-content-area .owl-nav > div',
					]
				);
				$this->add_control(
					'slide_button_hr1',
					[
						'type' => Controls_Manager::DIVIDER,
					]
				);
				$this->add_control(
					'slide_button_color',
					[
						'label'     => __( 'Color', 'ultimate' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .sldier-content-area .owl-nav > div' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Background:: get_type(),
					[
						'name'     => 'slide_button_background',
						'label'    => __( 'Background', 'ultimate' ),
						'types'    => [ 'classic', 'gradient' ],
						'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav > div',
					]
				);
				$this->add_control(
					'slide_button_hr2',
					[
						'type' => Controls_Manager::DIVIDER,
					]
				);
				$this->add_group_control(
					Group_Control_Border:: get_type(),
					[
						'name'     => 'slide_button_border',
						'label'    => __( 'Border', 'ultimate' ),
						'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav > div',
					]
				);
				$this->add_control(
					'slide_button_radius',
					[
						'label'      => __( 'Border Radius', 'ultimate' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors'  => [
							'{{WRAPPER}} .sldier-content-area .owl-nav > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow:: get_type(),
					[
						'name'     => 'slide_button_shadow',
						'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav > div',
					]
				);
				$this->add_control(
					'slide_button_hr3',
					[
						'type' => Controls_Manager::DIVIDER,
					]
				);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'slide_button_hover_tab',
				[
					'label' => __( 'Hover', 'ultimate' ),
				]
			);
				$this->add_control(
					'hover_slide_button_color',
					[
						'label'     => __( 'Color', 'ultimate' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .sldier-content-area .owl-nav > div:hover' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Background:: get_type(),
					[
						'name'     => 'hover_slide_button_background',
						'label'    => __( 'Background', 'ultimate' ),
						'types'    => [ 'classic', 'gradient' ],
						'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav > div:hover',
					]
				);
				$this->add_control(
					'slide_button_hr4',
					[
						'type' => Controls_Manager::DIVIDER,
					]
				);
				$this->add_group_control(
					Group_Control_Border:: get_type(),
					[
						'name'     => 'hover_slide_button_border',
						'label'    => __( 'Border', 'ultimate' ),
						'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav > div:hover',
					]
				);
				$this->add_control(
					'hover_slide_button_radius',
					[
						'label'      => __( 'Border Radius', 'ultimate' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors'  => [
							'{{WRAPPER}} .sldier-content-area .owl-nav > div:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow:: get_type(),
					[
						'name'     => 'hover_slide_button_shadow',
						'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav > div:hover',
					]
				);
				$this->add_control(
					'slide_button_hr9',
					[
						'type' => Controls_Manager::DIVIDER,
					]
				);
			$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->add_control(
				'slide_button_width',
				[
					'label'      => __( 'Width', 'ultimate' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav > div' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'slide_button_height',
				[
					'label'      => __( 'Height', 'ultimate' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav > div' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'slide_button_hr5',
				[
					'type' => Controls_Manager::DIVIDER,
				]
			);
			$this->add_responsive_control(
				'slide_button_display',
				[
					'label'   => __( 'Display', 'ultimate' ),
					'type'    => Controls_Manager::SELECT,
					'default' => '',				
					'options' => [
						'initial'      => __( 'Initial', 'ultimate' ),
						'block'        => __( 'Block', 'ultimate' ),
						'inline-block' => __( 'Inline Block', 'ultimate' ),
						'flex'         => __( 'Flex', 'ultimate' ),
						'inline-flex'  => __( 'Inline Flex', 'ultimate' ),
						'none'         => __( 'none', 'ultimate' ),
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav > div' => 'display: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'slide_button_align',
				[
					'label'   => __( 'Alignment', 'ultimate' ),
					'type'    => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'ultimate' ),
							'icon'  => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'ultimate' ),
							'icon'  => 'fa fa-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'ultimate' ),
							'icon'  => 'fa fa-align-right',
						],
						'justify' => [
							'title' => __( 'Justify', 'ultimate' ),
							'icon'  => 'fa fa-align-justify',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav > div' => 'text-align: {{VALUE}};',
					],
					'default' => '',
				]
			);
			$this->add_control(
				'slide_button_hr6',
				[
					'type' => Controls_Manager::DIVIDER,
				]
			);
			$this->add_responsive_control(
				'slide_button_position',
				[
					'label'   => __( 'Position', 'ultimate' ),
					'type'    => Controls_Manager::SELECT,
					'default' => '',				
					'options' => [
						'initial'  => __( 'Initial', 'ultimate' ),
						'absolute' => __( 'Absulute', 'ultimate' ),
						'relative' => __( 'Relative', 'ultimate' ),
						'static'   => __( 'Static', 'ultimate' ),
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav > div' => 'position: {{VALUE}};',
					],
				]
			);
			$this->start_controls_tabs( 'slide_button_item_tab_style');
			$this->start_controls_tab(
				'slide_button_left_nav_tab',
				[
					'label' => __( 'Left Button', 'ultimate' ),
				]
			);
				$this->add_responsive_control(
					'slide_button_position_from_left',
					[
						'label'      => __( 'From Left', 'ultimate' ),
						'type'       => Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%' ],
						'range'      => [
							'px' => [
								'min'  => -1000,
								'max'  => 1000,
								'step' => 1,
							],
							'%' => [
								'min' => -100,
								'max' => 100,
							],
						],
						'default' => [
							'unit' => 'px',
						],
						'selectors' => [
							'{{WRAPPER}} .sldier-content-area:hover .owl-nav > div.owl-prev' => 'left: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}} .sldier-content-area .owl-nav > div.owl-prev' => 'left: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'slide_button_position' => ['absolute','relative']
						],
					]
				);
				$this->add_responsive_control(
					'slide_button_position_from_bottom',
					[
						'label'      => __( 'From Top', 'ultimate' ),
						'type'       => Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%' ],
						'range'      => [
							'px' => [
								'min'  => -1000,
								'max'  => 1000,
								'step' => 1,
							],
							'%' => [
								'min' => -100,
								'max' => 100,
							],
						],
						'default' => [
							'unit' => 'px',
						],
						'selectors' => [
							'{{WRAPPER}} .sldier-content-area:hover .owl-nav > div.owl-prev' => 'top: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}} .sldier-content-area .owl-nav > div.owl-prev' => 'top: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'slide_button_position' => ['absolute','relative']
						],
					]
				);
				$this->add_responsive_control(
					'slide_button_left_margin',
					[
						'label'      => __( 'Margin Left Button', 'ultimate' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors'  => [
							'{{WRAPPER}} .sldier-content-area .owl-nav > div.owl-prev' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'slide_button_right_nav_tab',
				[
					'label' => __( 'Right Button', 'ultimate' ),
				]
			);
				$this->add_responsive_control(
					'slide_button_position_from_right',
					[
						'label'      => __( 'From Right', 'ultimate' ),
						'type'       => Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%' ],
						'range'      => [
							'px' => [
								'min'  => -1000,
								'max'  => 1000,
								'step' => 1,
							],
							'%' => [
								'min' => -100,
								'max' => 100,
							],
						],
						'default' => [
							'unit' => 'px',
						],
						'selectors' => [
							'{{WRAPPER}} .sldier-content-area:hover .owl-nav > div.owl-next' => 'right: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}} .sldier-content-area .owl-nav > div.owl-next' => 'right: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'slide_button_position' => ['absolute','relative']
						],
					]
				);
				$this->add_responsive_control(
					'slide_button_position_from_top',
					[
						'label'      => __( 'From Top', 'ultimate' ),
						'type'       => Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%' ],
						'range'      => [
							'px' => [
								'min'  => -1000,
								'max'  => 1000,
								'step' => 1,
							],
							'%' => [
								'min' => -100,
								'max' => 100,
							],
						],
						'default' => [
							'unit' => 'px',
						],
						'selectors' => [
							'{{WRAPPER}} .sldier-content-area:hover .owl-nav > div.owl-next' => 'top: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}} .sldier-content-area .owl-nav > div.owl-next' => 'top: {{SIZE}}{{UNIT}};',
						],
						'condition' => [
							'slide_button_position' => ['absolute','relative']
						],
					]
				);
				$this->add_responsive_control(
					'slide_button_right_margin',
					[
						'label'      => __( 'Margin Right Button', 'ultimate' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors'  => [
							'{{WRAPPER}} .sldier-content-area .owl-nav > div.owl-next' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_control(
				'slide_button_hr7',
				[
					'type' => Controls_Manager::DIVIDER,
				]
			);
			$this->add_control(
				'slide_button_transition',
				[
					'label'      => __( 'Transition', 'ultimate' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range'      => [
						'px' => [
							'min'  => 0.1,
							'max'  => 3,
							'step' => 0.1,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 0.3,
					],
					'selectors' => [
						'{{WRAPPER}} .sldier-content-area .owl-nav > div' => 'transition: {{SIZE}}s;',
					],
				]
			);
			$this->add_control(
				'slide_button_hr8',
				[
					'type' => Controls_Manager::DIVIDER,
				]
			);
			$this->add_responsive_control(
				'slide_button_padding',
				[
					'label'      => __( 'Padding', 'ultimate' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .sldier-content-area .owl-nav > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();
		/*----------------------------
			CONTROL BUTTON STYLE END
		-----------------------------*/

		/*----------------------------
			DOTS BUTTON STYLE
		-----------------------------*/
		$this->start_controls_section(
			'slide_dots_button_style_section',
			[
				'label' => __( 'Slide Dots Style', 'ultimate' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
			$this->start_controls_tabs( 'button_tab_style' );
				$this->start_controls_tab(
					'slide_dots_normal_tab',
					[
						'label' => __( 'Normal', 'ultimate' ),
					]
				);
					$this->add_control(
						'slide_dots_width',
						[
							'label'      => __( 'Width', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .sldier-content-area .owl-dots > div' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'slide_dots_height',
						[
							'label'      => __( 'Height', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .sldier-content-area .owl-dots > div' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'slide_dots_background',
							'label'    => __( 'Background', 'ultimate' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .sldier-content-area .owl-dots > div',
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'     => 'slide_dots_border',
							'label'    => __( 'Border', 'ultimate' ),
							'selector' => '{{WRAPPER}} .sldier-content-area .owl-dots > div',
						]
					);
					$this->add_control(
						'slide_dots_radius',
						[
							'label'      => __( 'Border Radius', 'ultimate' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .sldier-content-area .owl-dots > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'slide_dots_shadow',
							'selector' => '{{WRAPPER}} .sldier-content-area .owl-dots > div',
						]
					);
					$this->add_control(
						'slide_dots_hr',
						[
							'type' => Controls_Manager::DIVIDER,
						]
					);
					$this->add_control(
						'slide_dots_align',
						[
							'label'   => __( 'Alignment', 'ultimate' ),
							'type'    => Controls_Manager::CHOOSE,
							'options' => [
								'left' => [
									'title' => __( 'Left', 'ultimate' ),
									'icon'  => 'fa fa-align-left',
								],
								'center' => [
									'title' => __( 'Center', 'ultimate' ),
									'icon'  => 'fa fa-align-center',
								],
								'right' => [
									'title' => __( 'Right', 'ultimate' ),
									'icon'  => 'fa fa-align-right',
								],
								'justify' => [
									'title' => __( 'Justify', 'ultimate' ),
									'icon'  => 'fa fa-align-justify',
								],
							],
							'selectors' => [
								'{{WRAPPER}} .sldier-content-area .owl-dots' => 'text-align: {{VALUE}};',
							],
							'default' => '',
						]
					);
					$this->add_control(
						'slide_dots_transition',
						[
							'label'      => __( 'Transition', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px' ],
							'range'      => [
								'px' => [
									'min'  => 0.1,
									'max'  => 3,
									'step' => 0.1,
								],
							],
							'default' => [
								'unit' => 'px',
								'size' => 0.3,
							],
							'selectors' => [
								'{{WRAPPER}} .sldier-content-area .owl-dots > div' => 'transition: {{SIZE}}s;',
							],
						]
					);
					$this->add_responsive_control(
						'slide_dots_margin',
						[
							'label'      => __( 'Dot Item Margin', 'ultimate' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .sldier-content-area .owl-dots > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'slide_dots_warp_margin',
						[
							'label'      => __( 'Dot Warp Margin', 'ultimate' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .sldier-content-area .owl-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'slide_dots_hover_tab',
					[
						'label' => __( 'Hover & Active', 'ultimate' ),
					]
				);
					$this->add_control(
						'hover_slide_dots_width',
						[
							'label'      => __( 'Width', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .sldier-content-area .owl-dots > div:hover,{{WRAPPER}} .sldier-content-area .owl-dots > div.active' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'hover_slide_dots_height',
						[
							'label'      => __( 'Height', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .sldier-content-area .owl-dots > div:hover,{{WRAPPER}} .sldier-content-area .owl-dots > div.active' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'hover_slide_dots_background',
							'label'    => __( 'Background', 'ultimate' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .sldier-content-area .owl-dots > div:hover,{{WRAPPER}} .sldier-content-area .owl-dots > div.active',
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'     => 'hover_slide_dots_border',
							'label'    => __( 'Border', 'ultimate' ),
							'selector' => '{{WRAPPER}} .sldier-content-area .owl-dots > div:hover,{{WRAPPER}} .sldier-content-area .owl-dots > div.active',
						]
					);
					$this->add_control(
						'hover_slide_dots_radius',
						[
							'label'      => __( 'Border Radius', 'ultimate' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .sldier-content-area .owl-dots > div:hover,{{WRAPPER}} .sldier-content-area .owl-dots > div.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'hover_slide_dots_shadow',
							'selector' => '{{WRAPPER}} .sldier-content-area .owl-dots > div:hover,{{WRAPPER}} .sldier-content-area .owl-dots > div.active',
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
		/*----------------------------
			DOTS BUTTON STYLE END
		-----------------------------*/

		/*********************************
		 * 		STYLE SECTION
		 *********************************/

		/*----------------------------
			THUMB SLIDER STYLE
		-----------------------------*/
		$this->start_controls_section(
			'thumb_slider_section',
			[
				'label' => __( 'Thumbs Slider', 'ultimate' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'testmonial_style' => 'tesmonial_style_13',
				],
			]
		);
			$this->add_responsive_control(
				'thumbs_slider_width',
				[
					'label'      => __( 'Width', 'ultimate' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .testmonial__thumb__content' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'thumbs_slider_height',
				[
					'label'      => __( 'Height', 'ultimate' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .testmonial__thumb__content' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background:: get_type(),
				[
					'name'     => 'thumbs_slider_background',
					'label'    => __( 'Background', 'ultimate' ),
					'types'    => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .testmonial__thumb__content',
				]
			);
			$this->add_group_control(
				Group_Control_Border:: get_type(),
				[
					'name'     => 'thumbs_slider_border',
					'label'    => __( 'Border', 'ultimate' ),
					'selector' => '{{WRAPPER}} .testmonial__thumb__content',
				]
			);
			$this->add_control(
				'thumbs_slider_border_radius',
				[
					'label'      => __( 'Border Radius', 'ultimate' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .testmonial__thumb__content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow:: get_type(),
				[
					'name'     => 'thumbs_slider_shadow',
					'selector' => '{{WRAPPER}} .testmonial__thumb__content',
				]
			);
			$this->add_responsive_control(
				'thumbs_slider_display',
				[
					'label'   => __( 'Display', 'ultimate' ),
					'type'    => Controls_Manager::SELECT,
					'default' => '',
					'options' => [
						'initial'      => __( 'Initial', 'ultimate' ),
						'block'        => __( 'Block', 'ultimate' ),
						'inline-block' => __( 'Inline Block', 'ultimate' ),
						'flex'         => __( 'Flex', 'ultimate' ),
						'inline-flex'  => __( 'Inline Flex', 'ultimate' ),
						'none'         => __( 'none', 'ultimate' ),
					],
					'selectors' => [
						'{{WRAPPER}} .testmonial__thumb__content' => 'display: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'thumbs_slider_padding',
				[
					'label'      => __( 'Padding', 'ultimate' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .testmonial__thumb__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'thumbs_slider_margin',
				[
					'label'      => __( 'Margin', 'ultimate' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .testmonial__thumb__content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'thumbs_slider_align',
				[
					'label'   => __( 'Alignment', 'ultimate' ),
					'type'    => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => __( 'Left', 'ultimate' ),
							'icon'  => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'ultimate' ),
							'icon'  => 'fa fa-align-center',
						],
						'right' => [
							'title' => __( 'Right', 'ultimate' ),
							'icon'  => 'fa fa-align-right',
						],
						'justify' => [
							'title' => __( 'Justify', 'ultimate' ),
							'icon'  => 'fa fa-align-justify',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .testmonial__thumb__content_area' => 'text-align: {{VALUE}};',
					],
					'default' => '',
				]
			);
		$this->end_controls_section();
		/*----------------------------
			THUMB SLIDER STYLE END
		-----------------------------*/

		/*----------------------------
			ICON STYLE
		-----------------------------*/
		$this->start_controls_section(
			'icon_style_section',
			[
				'label' => __( 'Icon', 'ultimate' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->start_controls_tabs( 'icon_tab_style' );
				$this->start_controls_tab(
					'icon_normal_tab',
					[
						'label' => __( 'Normal', 'ultimate' ),
					]
				);
					$this->add_group_control(
						Group_Control_Typography:: get_type(),
						[
							'name'      => 'icon_typography',
							'selector'  => '{{WRAPPER}} .testmonial__quote',
							'condition' => [
								'icon_type' => ['font_icon']
							],
						]
					);
					$this->add_responsive_control(
						'icon_image_size',
						[
							'label'      => __( 'Icon Image Size', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .testmonial__quote img' => 'width: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'icon_type' => ['image_icon']
							],
						]
					);
					$this->add_group_control(
						Group_Control_Css_Filter:: get_type(),
						[
							'name'      => 'icon_image_filters',
							'selector'  => '{{WRAPPER}} .testmonial__quote img',
							'condition' => [
								'icon_type' => ['image_icon']
							],
						]
					);
					$this->add_control(
						'icon_color',
						[
							'label'     => __( 'Color', 'ultimate' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .testmonial__quote' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'icon_background',
							'label'    => __( 'Background', 'ultimate' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .testmonial__quote',
						]
					);
					$this->add_control(
						'icon_hr2',
						[
							'type' => Controls_Manager::DIVIDER,
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'     => 'icon_border',
							'label'    => __( 'Border', 'ultimate' ),
							'selector' => '{{WRAPPER}} .testmonial__quote',
						]
					);
					$this->add_control(
						'icon_radius',
						[
							'label'      => __( 'Border Radius', 'ultimate' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .testmonial__quote' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'icon_shadow',
							'selector' => '{{WRAPPER}} .testmonial__quote',
						]
					);
					$this->add_control(
						'icon_hr3',
						[
							'type' => Controls_Manager::DIVIDER,
						]
					);
					$this->add_control(
						'icon_width',
						[
							'label'      => __( 'Width', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .testmonial__quote' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'icon_height',
						[
							'label'      => __( 'Height', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .testmonial__quote' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'icon_hr5',
						[
							'type' => Controls_Manager::DIVIDER,
						]
					);
					$this->add_responsive_control(
						'icon_display',
						[
							'label'   => __( 'Display', 'ultimate' ),
							'type'    => Controls_Manager::SELECT,
							'default' => '',				
							'options' => [
								'initial'      => __( 'Initial', 'ultimate' ),
								'block'        => __( 'Block', 'ultimate' ),
								'inline-block' => __( 'Inline Block', 'ultimate' ),
								'flex'         => __( 'Flex', 'ultimate' ),
								'inline-flex'  => __( 'Inline Flex', 'ultimate' ),
								'none'         => __( 'none', 'ultimate' ),
							],
							'selectors' => [
								'{{WRAPPER}} .testmonial__quote' => 'display: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'icon_align',
						[
							'label'   => __( 'Alignment', 'ultimate' ),
							'type'    => Controls_Manager::CHOOSE,
							'options' => [
								'left' => [
									'title' => __( 'Left', 'ultimate' ),
									'icon'  => 'fa fa-align-left',
								],
								'center' => [
									'title' => __( 'Center', 'ultimate' ),
									'icon'  => 'fa fa-align-center',
								],
								'right' => [
									'title' => __( 'Right', 'ultimate' ),
									'icon'  => 'fa fa-align-right',
								],
								'justify' => [
									'title' => __( 'Justify', 'ultimate' ),
									'icon'  => 'fa fa-align-justify',
								],
							],
							'selectors' => [
								'{{WRAPPER}} .testmonial__quote' => 'text-align: {{VALUE}};',
							],
							'default' => '',
						]
					);
					$this->add_control(
						'icon_hr6',
						[
							'type' => Controls_Manager::DIVIDER,
						]
					);
					$this->add_responsive_control(
						'icon_position',
						[
							'label'   => __( 'Position', 'ultimate' ),
							'type'    => Controls_Manager::SELECT,
							'default' => '',				
							'options' => [
								'initial'  => __( 'Initial', 'ultimate' ),
								'absolute' => __( 'Absulute', 'ultimate' ),
								'relative' => __( 'Relative', 'ultimate' ),
								'static'   => __( 'Static', 'ultimate' ),
							],
							'selectors' => [
								'{{WRAPPER}} .testmonial__quote' => 'position: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'icon_position_from_left',
						[
							'label'      => __( 'From Left', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .testmonial__quote' => 'left: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'icon_position' => ['absolute','relative']
							],
						]
					);
					$this->add_responsive_control(
						'icon_position_from_right',
						[
							'label'      => __( 'From Right', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .testmonial__quote' => 'right: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'icon_position' => ['absolute','relative']
							],
						]
					);
					$this->add_responsive_control(
						'icon_position_from_top',
						[
							'label'      => __( 'From Top', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .testmonial__quote' => 'top: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'icon_position' => ['absolute','relative']
							],
						]
					);
					$this->add_responsive_control(
						'icon_position_from_bottom',
						[
							'label'      => __( 'From Bottom', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .testmonial__quote' => 'bottom: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'icon_position' => ['absolute','relative']
							],
						]
					);
					$this->add_control(
						'icon_transition',
						[
							'label'      => __( 'Transition', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px' ],
							'range'      => [
								'px' => [
									'min'  => 0.1,
									'max'  => 3,
									'step' => 0.1,
								],
							],
							'default' => [
								'unit' => 'px',
								'size' => 0.3,
							],
							'selectors' => [
								'{{WRAPPER}} .testmonial__quote,{{WRAPPER}} .testmonial__quote img' => 'transition: {{SIZE}}s;',
							],
						]
					);
					$this->add_control(
						'icon_hr7',
						[
							'type' => Controls_Manager::DIVIDER,
						]
					);
					$this->add_responsive_control(
						'icon_margin',
						[
							'label'      => __( 'Margin', 'ultimate' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .testmonial__quote' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'icon_hr8',
						[
							'type' => Controls_Manager::DIVIDER,
						]
					);
					$this->add_responsive_control(
						'icon_padding',
						[
							'label'      => __( 'Padding', 'ultimate' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .testmonial__quote' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();

				$this->start_controls_tab(
					'icon_hover_tab',
					[
						'label' => __( 'Hover', 'ultimate' ),
					]
				);
					$this->add_group_control(
						Group_Control_Css_Filter:: get_type(),
						[
							'name'      => 'hover_icon_image_filters',
							'selector'  => '{{WRAPPER}} :hover .testmonial__quote img',
							'condition' => [
								'icon_type' => ['image_icon']
							],
						]
					);
					$this->add_control(
						'hover_icon_color',
						[
							'label'     => __( 'Color', 'ultimate' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .single__testmonial:hover .testmonial__quote, {{WRAPPER}} :focus .testmonial__quote' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'hover_icon_background',
							'label'    => __( 'Background', 'ultimate' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .single__testmonial:hover .testmonial__quote,{{WRAPPER}} :focus .testmonial__quote',
						]
					);
					$this->add_control(
						'icon_hr4',
						[
							'type' => Controls_Manager::DIVIDER,
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'     => 'hover_icon_border',
							'label'    => __( 'Border', 'ultimate' ),
							'selector' => '{{WRAPPER}} :hover .testmonial__quote,{{WRAPPER}} :hover .testmonial__quote',
						]
					);
					$this->add_control(
						'hover_icon_radius',
						[
							'label'      => __( 'Border Radius', 'ultimate' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .single__testmonial:hover .testmonial__quote' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'hover_icon_shadow',
							'selector' => '{{WRAPPER}} .single__testmonial:hover .testmonial__quote',
						]
					);
					$this->add_control(
						'icon_hover_animation',
						[
							'label'    => __( 'Hover Animation', 'ultimate' ),
							'type'     => Controls_Manager::HOVER_ANIMATION,
							'selector' => '{{WRAPPER}} :hover .testmonial__quote',
						]
					);
					$this->add_control(
						'icon_hr9',
						[
							'type' => Controls_Manager::DIVIDER,
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
		/*----------------------------
			ICON STYLE END
		-----------------------------*/

		/*----------------------------
			TITLE STYLE
		-----------------------------*/
		$this->start_controls_section(
			'title_style_section',
			[
				'label' => __( 'Title', 'ultimate' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->start_controls_tabs( 'title_tab_style' );
				$this->start_controls_tab(
					'title_normal_tab',
					[
						'label' => __( 'Normal', 'ultimate' ),
					]
				);
					$this->add_group_control(
						Group_Control_Typography:: get_type(),
						[
							'name'     => 'title_typography',
							'selector' => '{{WRAPPER}} .testmonial__title',
						]
					);
					$this->add_control(
						'title_text_color',
						[
							'label'     => __( 'Color', 'ultimate' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .testmonial__title, {{WRAPPER}} .testmonial__title a' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'title_margin',
						[
							'label'      => __( 'Margin', 'ultimate' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .testmonial__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'title_hover_tab',
					[
						'label' => __( 'Hover', 'ultimate' ),
					]
				);
					$this->add_control(
						'hover_title_color',
						[
							'label'     => __( 'Link Color', 'ultimate' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .testmonial__title a:hover, {{WRAPPER}} .testmonial__title a:focus' => 'color: {{VALUE}};',
							],
						]
					);
					$this->add_control(
						'box_hover_title_color',
						[
							'label'     => __( 'Box Hover Color', 'ultimate' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} :hover .testmonial__title a, {{WRAPPER}} :focus .testmonial__title a, {{WRAPPER}} :hover .testmonial__title' => 'color: {{VALUE}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
		/*----------------------------
			TITLE STYLE END
		-----------------------------*/

		/*----------------------------
			SUBTITLE STYLE
		-----------------------------*/
		$this->start_controls_section(
			'subtitle_style_section',
			[
				'label' => __( 'Subtitle', 'ultimate' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_group_control(
				Group_Control_Typography:: get_type(),
				[
					'name'     => 'subtitle_typography',
					'selector' => '{{WRAPPER}} .testmonial__subtitle',
				]
			);
			$this->add_control(
				'subtitle_color',
				[
					'label'  => __( 'Color', 'ultimate' ),
					'type'   => Controls_Manager::COLOR,
					'scheme' => [
						'type'  => \Elementor\Core\Schemes\Color::get_type(),
						'value' => \Elementor\Core\Schemes\Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .testmonial__subtitle' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'box_hover_subtitle_color',
				[
					'label'  => __( 'Box Hover Color', 'ultimate' ),
					'type'   => Controls_Manager::COLOR,
					'scheme' => [
						'type'  => \Elementor\Core\Schemes\Color::get_type(),
						'value' => \Elementor\Core\Schemes\Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .single__testmonial:hover .testmonial__subtitle' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'subtitle_margin',
				[
					'label'      => __( 'Margin', 'ultimate' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .testmonial__subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();
		/*----------------------------
			SUBTITLE STYLE END
		-----------------------------*/

		/*----------------------------
			THUMB / DESI WARP STYLE
		-----------------------------*/
		$this->start_controls_section(
			'thumb_desi_warp_section',
			[
				'label' => __( 'Thumb & Designation Warp', 'ultimate' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_responsive_control(
				'thumb_and_desi_width',
				[
					'label'      => __( 'Width', 'ultimate' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .author__thumb__designation' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'thumb_and_desi_height',
				[
					'label'      => __( 'Height', 'ultimate' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .author__thumb__designation' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background:: get_type(),
				[
					'name'     => 'thumb_and_desi_background',
					'label'    => __( 'Background', 'ultimate' ),
					'types'    => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .author__thumb__designation',
				]
			);
			$this->add_group_control(
				Group_Control_Border:: get_type(),
				[
					'name'     => 'thumb_and_desi_border',
					'label'    => __( 'Border', 'ultimate' ),
					'selector' => '{{WRAPPER}} .author__thumb__designation',
				]
			);
			$this->add_control(
				'thumb_and_desi_border_radius',
				[
					'label'      => __( 'Border Radius', 'ultimate' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .author__thumb__designation' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow:: get_type(),
				[
					'name'     => 'thumb_and_desi_shadow',
					'selector' => '{{WRAPPER}} .author__thumb__designation',
				]
			);
			$this->add_responsive_control(
				'thumb_and_desi_display',
				[
					'label'   => __( 'Display', 'ultimate' ),
					'type'    => Controls_Manager::SELECT,
					'default' => '',
					'options' => [
						'initial'      => __( 'Initial', 'ultimate' ),
						'block'        => __( 'Block', 'ultimate' ),
						'inline-block' => __( 'Inline Block', 'ultimate' ),
						'flex'         => __( 'Flex', 'ultimate' ),
						'inline-flex'  => __( 'Inline Flex', 'ultimate' ),
						'none'         => __( 'none', 'ultimate' ),
					],
					'selectors' => [
						'{{WRAPPER}} .author__thumb__designation' => 'display: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'thumb_and_desi_position',
				[
					'label'   => __( 'Position', 'ultimate' ),
					'type'    => Controls_Manager::SELECT,
					'default' => '',
					
					'options' => [
						'initial'  => __( 'Initial', 'ultimate' ),
						'absolute' => __( 'Absulute', 'ultimate' ),
						'relative' => __( 'Relative', 'ultimate' ),
						'static'   => __( 'Static', 'ultimate' ),
					],
					'selectors' => [
						'{{WRAPPER}} .author__thumb__designation' => 'position: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'thumb_and_desi_position_from_left',
				[
					'label'      => __( 'From Left', 'ultimate' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .author__thumb__designation' => 'left: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'thumb_and_desi_position' => ['absolute','relative']
					],
				]
			);
			$this->add_responsive_control(
				'thumb_and_desi_position_from_right',
				[
					'label'      => __( 'From Right', 'ultimate' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .author__thumb__designation' => 'right: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'thumb_and_desi_position' => ['absolute','relative']
					],
				]
			);
			$this->add_responsive_control(
				'thumb_and_desi_position_from_top',
				[
					'label'      => __( 'From Top', 'ultimate' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .author__thumb__designation' => 'top: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'thumb_and_desi_position' => ['absolute','relative']
					],
				]
			);
			$this->add_responsive_control(
				'thumb_and_desi_position_from_bottom',
				[
					'label'      => __( 'From Bottom', 'ultimate' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', '%' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 1000,
							'step' => 1,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .author__thumb__designation' => 'bottom: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'thumb_and_desi_position' => ['absolute','relative']
					],
				]
			);
			$this->add_responsive_control(
				'thumb_and_desi_padding',
				[
					'label'      => __( 'Padding', 'ultimate' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .author__thumb__designation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'thumb_and_desi_margin',
				[
					'label'      => __( 'Margin', 'ultimate' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .author__thumb__designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();
		/*----------------------------
			THUMB / DESI WARP STYLE END
		-----------------------------*/

		/*----------------------------
			THUMB STYLE
		-----------------------------*/
		$this->start_controls_section(
			'thumb_style_section',
			[
				'label' => __( 'Author Thumb', 'ultimate' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->start_controls_tabs(
				'thumb_style_tab'
			);
				$this->start_controls_tab(
					'thum_image_warp_tab',
					[
						'label' => __( 'Tumb Warp', 'ultimate' ),
					]
				);
					$this->add_responsive_control(
						'thumb_width',
						[
							'label'      => __( 'Width', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .author__thumb' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'thumb_height',
						[
							'label'      => __( 'Height', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .author__thumb' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'thumb_background',
							'label'    => __( 'Background', 'ultimate' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .author__thumb',
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'     => 'thumb_border',
							'label'    => __( 'Border', 'ultimate' ),
							'selector' => '{{WRAPPER}} .author__thumb',
						]
					);
					$this->add_control(
						'thumb_border_radius',
						[
							'label'      => __( 'Border Radius', 'ultimate' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .author__thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'thumb_shadow',
							'selector' => '{{WRAPPER}} .author__thumb',
						]
					);
					$this->add_responsive_control(
						'thumb_display',
						[
							'label'   => __( 'Display', 'ultimate' ),
							'type'    => Controls_Manager::SELECT,
							'default' => '',
							'options' => [
								'initial'      => __( 'Initial', 'ultimate' ),
								'block'        => __( 'Block', 'ultimate' ),
								'inline-block' => __( 'Inline Block', 'ultimate' ),
								'flex'         => __( 'Flex', 'ultimate' ),
								'inline-flex'  => __( 'Inline Flex', 'ultimate' ),
								'none'         => __( 'none', 'ultimate' ),
							],
							'selectors' => [
								'{{WRAPPER}} .author__thumb' => 'display: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'thumb_position',
						[
							'label'   => __( 'Position', 'ultimate' ),
							'type'    => Controls_Manager::SELECT,
							'default' => '',
							
							'options' => [
								'initial'  => __( 'Initial', 'ultimate' ),
								'absolute' => __( 'Absulute', 'ultimate' ),
								'relative' => __( 'Relative', 'ultimate' ),
								'static'   => __( 'Static', 'ultimate' ),
							],
							'selectors' => [
								'{{WRAPPER}} .author__thumb' => 'position: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'thumb_position_from_left',
						[
							'label'      => __( 'From Left', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .author__thumb' => 'left: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'thumb_position' => ['absolute','relative']
							],
						]
					);
					$this->add_responsive_control(
						'thumb_position_from_right',
						[
							'label'      => __( 'From Right', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .author__thumb' => 'right: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'thumb_position' => ['absolute','relative']
							],
						]
					);
					$this->add_responsive_control(
						'thumb_position_from_top',
						[
							'label'      => __( 'From Top', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .author__thumb' => 'top: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'thumb_position' => ['absolute','relative']
							],
						]
					);
					$this->add_responsive_control(
						'thumb_position_from_bottom',
						[
							'label'      => __( 'From Bottom', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .author__thumb' => 'bottom: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'thumb_position' => ['absolute','relative']
							],
						]
					);
					$this->add_responsive_control(
						'thumb_padding',
						[
							'label'      => __( 'Padding', 'ultimate' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .author__thumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'thumb_margin',
						[
							'label'      => __( 'Margin', 'ultimate' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .author__thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'thumb_image_tab',
					[
						'label' => __( 'Thumb Image', 'ultimate' ),
					]
				);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'     => 'thumb_image_border',
							'label'    => __( 'Border', 'ultimate' ),
							'selector' => '{{WRAPPER}} .author__thumb img',
						]
					);
					$this->add_control(
						'thumb_image_border_radius',
						[
							'label'      => __( 'Border Radius', 'ultimate' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .author__thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'thumb_image_shadow',
							'selector' => '{{WRAPPER}} .author__thumb img',
						]
					);
					$this->add_responsive_control(
						'thumb_image_width',
						[
							'label'      => __( 'Width', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .author__thumb img' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'thumb_image_height',
						[
							'label'      => __( 'Height', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .author__thumb img' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
		/*----------------------------
			THUMB STYLE END
		-----------------------------*/

		/*----------------------------
			DESCRIPTION STYLE
		-----------------------------*/
		$this->start_controls_section(
			'description_style_section',
			[
				'label' => __( 'Description', 'ultimate' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_group_control(
				Group_Control_Typography:: get_type(),
				[
					'name'     => 'description_typography',
					'selector' => '{{WRAPPER}} .testmonial__description',
				]
			);
			$this->add_control(
				'description_color',
				[
					'label'  => __( 'Color', 'ultimate' ),
					'type'   => Controls_Manager::COLOR,
					'scheme' => [
						'type'  => \Elementor\Core\Schemes\Color::get_type(),
						'value' => \Elementor\Core\Schemes\Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .testmonial__description' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'box_hover_description_color',
				[
					'label'  => __( 'Box Hover Color', 'ultimate' ),
					'type'   => Controls_Manager::COLOR,
					'scheme' => [
						'type'  => \Elementor\Core\Schemes\Color::get_type(),
						'value' => \Elementor\Core\Schemes\Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .single__testmonial:hover .testmonial__description' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'description_margin',
				[
					'label'      => __( 'Margin', 'ultimate' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .testmonial__description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();
		/*----------------------------
			DESCRIPTION STYLE END
		-----------------------------*/

		/*----------------------------
			NAME STYLE
		-----------------------------*/
		$this->start_controls_section(
			'name_style_section',
			[
				'label' => __( 'Name', 'ultimate' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_group_control(
				Group_Control_Typography:: get_type(),
				[
					'name'     => 'name_typography',
					'selector' => '{{WRAPPER}} .author__name',
				]
			);
			$this->add_control(
				'name_color',
				[
					'label'  => __( 'Color', 'ultimate' ),
					'type'   => Controls_Manager::COLOR,
					'scheme' => [
						'type'  => \Elementor\Core\Schemes\Color::get_type(),
						'value' => \Elementor\Core\Schemes\Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .author__name' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'box_hover_name_color',
				[
					'label'  => __( 'Box Hover Color', 'ultimate' ),
					'type'   => Controls_Manager::COLOR,
					'scheme' => [
						'type'  => \Elementor\Core\Schemes\Color::get_type(),
						'value' => \Elementor\Core\Schemes\Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .single__testmonial:hover .author__name' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'name_display',
				[
					'label'   => __( 'Display', 'ultimate' ),
					'type'    => Controls_Manager::SELECT,
					'default' => '',
					'options' => [
						'initial'      => __( 'Initial', 'ultimate' ),
						'block'        => __( 'Block', 'ultimate' ),
						'inline-block' => __( 'Inline Block', 'ultimate' ),
						'flex'         => __( 'Flex', 'ultimate' ),
						'inline-flex'  => __( 'Inline Flex', 'ultimate' ),
						'none'         => __( 'none', 'ultimate' ),
					],
					'selectors' => [
						'{{WRAPPER}} .author__name' => 'display: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'name_margin',
				[
					'label'      => __( 'Margin', 'ultimate' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .author__name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();
		/*----------------------------
			NAME STYLE END
		-----------------------------*/

		/*----------------------------
			DESIGNATION STYLE
		-----------------------------*/
		$this->start_controls_section(
			'designation_style_section',
			[
				'label' => __( 'Designation Or Company', 'ultimate' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_group_control(
				Group_Control_Typography:: get_type(),
				[
					'name'     => 'designation_typography',
					'selector' => '{{WRAPPER}} .author__designation',
				]
			);
			$this->add_control(
				'designation_color',
				[
					'label'  => __( 'Color', 'ultimate' ),
					'type'   => Controls_Manager::COLOR,
					'scheme' => [
						'type'  => \Elementor\Core\Schemes\Color::get_type(),
						'value' => \Elementor\Core\Schemes\Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .author__designation' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_control(
				'box_hover_designation_color',
				[
					'label'  => __( 'Box Hover Color', 'ultimate' ),
					'type'   => Controls_Manager::COLOR,
					'scheme' => [
						'type'  => \Elementor\Core\Schemes\Color::get_type(),
						'value' => \Elementor\Core\Schemes\Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .single__testmonial:hover .author__designation' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'designation_display',
				[
					'label'   => __( 'Display', 'ultimate' ),
					'type'    => Controls_Manager::SELECT,
					'default' => '',
					'options' => [
						'initial'      => __( 'Initial', 'ultimate' ),
						'block'        => __( 'Block', 'ultimate' ),
						'inline-block' => __( 'Inline Block', 'ultimate' ),
						'flex'         => __( 'Flex', 'ultimate' ),
						'inline-flex'  => __( 'Inline Flex', 'ultimate' ),
						'none'         => __( 'none', 'ultimate' ),
					],
					'selectors' => [
						'{{WRAPPER}} .author__designation' => 'display: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'designation_margin',
				[
					'label'      => __( 'Margin', 'ultimate' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .author__designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();
		/*----------------------------
			DESIGNATION STYLE END
		-----------------------------*/

		/*----------------------------
			BOX STYLE
		-----------------------------*/
		$this->start_controls_section(
			'box_style_section',
			[
				'label' => __( 'Box', 'ultimate' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->start_controls_tabs('box_style_tabs');
				$this->start_controls_tab(
					'box_style_normal_tab',
					[
						'label' => __( 'Normal', 'plugin-name' ),
					]
				);
					$this->add_group_control(
						Group_Control_Typography:: get_type(),
						[
							'name'     => 'typography',
							'selector' => '{{WRAPPER}} .single__testmonial',
						]
					);
					$this->add_control(
						'box_color',
						[
							'label'  => __( 'Color', 'ultimate' ),
							'type'   => Controls_Manager::COLOR,
							'scheme' => [
								'type'  => \Elementor\Core\Schemes\Color::get_type(),
								'value' => \Elementor\Core\Schemes\Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .single__testmonial' => 'color: {{VALUE}}',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'box_background',
							'label'    => __( 'Background', 'ultimate' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .single__testmonial',
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'     => 'box_border',
							'label'    => __( 'Border', 'ultimate' ),
							'selector' => '{{WRAPPER}} .single__testmonial',
						]
					);
					$this->add_control(
						'box_radius',
						[
							'label'      => __( 'Border Radius', 'ultimate' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .single__testmonial' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'box_box_shadow',
							'selector' => '{{WRAPPER}} .single__testmonial',
						]
					);
					$this->add_responsive_control(
						'box_align',
						[
							'label'   => __( 'Alignment', 'ultimate' ),
							'type'    => Controls_Manager::CHOOSE,
							'options' => [
								'left' => [
									'title' => __( 'Left', 'ultimate' ),
									'icon'  => 'fa fa-align-left',
								],
								'center' => [
									'title' => __( 'Center', 'ultimate' ),
									'icon'  => 'fa fa-align-center',
								],
								'right' => [
									'title' => __( 'Right', 'ultimate' ),
									'icon'  => 'fa fa-align-right',
								],
								'justify' => [
									'title' => __( 'Justify', 'ultimate' ),
									'icon'  => 'fa fa-align-justify',
								],
							],
							'selectors' => [
								'{{WRAPPER}} .single__testmonial' => 'text-align: {{VALUE}};',
							],
							'default' => '',
						]
					);
					$this->add_control(
						'box_transition',
						[
							'label'      => __( 'Transition', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px' ],
							'range'      => [
								'px' => [
									'min'  => 0.1,
									'max'  => 3,
									'step' => 0.1,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .single__testmonial' => 'transition: {{SIZE}}s;',
							],
						]
					);
					$this->add_responsive_control(
						'box_position',
						[
							'label'   => __( 'Position', 'ultimate' ),
							'type'    => Controls_Manager::SELECT,
							'default' => 'initial',
							
							'options' => [
								'initial'  => __( 'Initial', 'ultimate' ),
								'absolute' => __( 'Absulute', 'ultimate' ),
								'relative' => __( 'Relative', 'ultimate' ),
								'static'   => __( 'Static', 'ultimate' ),
							],
							'selectors' => [
								'{{WRAPPER}} .single__testmonial' => 'position: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'box_padding',
						[
							'label'      => __( 'Padding', 'ultimate' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .single__testmonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'box_margin',
						[
							'label'      => __( 'Margin', 'ultimate' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .single__testmonial' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'box_style_hover_tab',
					[
						'label' => __( 'Hover', 'plugin-name' ),
					]
				);
					$this->add_control(
						'hover_box_color',
						[
							'label'  => __( 'Box Hover Color', 'ultimate' ),
							'type'   => Controls_Manager::COLOR,
							'scheme' => [
								'type'  => \Elementor\Core\Schemes\Color::get_type(),
								'value' => \Elementor\Core\Schemes\Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .single__testmonial:hover' => 'color: {{VALUE}}',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'hover_box_background',
							'label'    => __( 'Background', 'ultimate' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .single__testmonial:hover',
						]
					);
					$this->add_group_control(
						Group_Control_Border:: get_type(),
						[
							'name'     => 'hover_box_border',
							'label'    => __( 'Border', 'ultimate' ),
							'selector' => '{{WRAPPER}} .single__testmonial:hover',
						]
					);
					$this->add_control(
						'hover_box_radius',
						[
							'label'      => __( 'Border Radius', 'ultimate' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .single__testmonial:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
					$this->add_group_control(
						Group_Control_Box_Shadow:: get_type(),
						[
							'name'     => 'hover_box_box_shadow',
							'selector' => '{{WRAPPER}} .single__testmonial:hover',
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
		/*----------------------------
			BOX STYLE END
		-----------------------------*/

		/*----------------------------
			BOX BEFORE / AFTER
		-----------------------------*/
		$this->start_controls_section(
			'box_before_after_style_section',
			[
				'label' => __( 'Before / After', 'ultimate' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->start_controls_tabs( 'box_before_after_tab_style' );
				$this->start_controls_tab(
					'box_before_tab',
					[
						'label' => __( 'BEFORE', 'ultimate' ),
					]
				);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'box_before_background',
							'label'    => __( 'Background', 'ultimate' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .single__testmonial:before',
						]
					);
					$this->add_responsive_control(
						'box_before_display',
						[
							'label'   => __( 'Display', 'ultimate' ),
							'type'    => Controls_Manager::SELECT,
							'default' => '',
							'options' => [
								'initial'      => __( 'Initial', 'ultimate' ),
								'block'        => __( 'Block', 'ultimate' ),
								'inline-block' => __( 'Inline Block', 'ultimate' ),
								'flex'         => __( 'Flex', 'ultimate' ),
								'inline-flex'  => __( 'Inline Flex', 'ultimate' ),
								'none'         => __( 'none', 'ultimate' ),
							],
							'selectors' => [
								'{{WRAPPER}} .single__testmonial:before' => 'display: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'box_before_position',
						[
							'label'   => __( 'Position', 'ultimate' ),
							'type'    => Controls_Manager::SELECT,
							'default' => '',				
							'options' => [
								'initial'  => __( 'Initial', 'ultimate' ),
								'absolute' => __( 'Absulute', 'ultimate' ),
								'relative' => __( 'Relative', 'ultimate' ),
								'static'   => __( 'Static', 'ultimate' ),
							],
							'selectors' => [
								'{{WRAPPER}} .single__testmonial:before' => 'position: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'box_before_position_from_left',
						[
							'label'      => __( 'From Left', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .single__testmonial:before' => 'left: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'box_before_position' => ['absolute','relative']
							],
						]
					);
					$this->add_responsive_control(
						'box_before_position_from_right',
						[
							'label'      => __( 'From Right', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .single__testmonial:before' => 'right: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'box_before_position' => ['absolute','relative']
							],
						]
					);
					$this->add_responsive_control(
						'box_before_position_from_top',
						[
							'label'      => __( 'From Top', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .single__testmonial:before' => 'top: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'box_before_position' => ['absolute','relative']
							],
						]
					);
					$this->add_responsive_control(
						'box_before_position_from_bottom',
						[
							'label'      => __( 'From Bottom', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .single__testmonial:before' => 'bottom: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'box_before_position' => ['absolute','relative']
							],
						]
					);
					$this->add_responsive_control(
						'box_before_align',
						[
							'label'   => __( 'Alignment', 'ultimate' ),
							'type'    => Controls_Manager::CHOOSE,
							'options' => [
								'text-align:left' => [
									'title' => __( 'Left', 'ultimate' ),
									'icon'  => 'fa fa-align-left',
								],
								'margin: 0 auto' => [
									'title' => __( 'Center', 'ultimate' ),
									'icon'  => 'fa fa-align-center',
								],
								'float:right' => [
									'title' => __( 'Right', 'ultimate' ),
									'icon'  => 'fa fa-align-right',
								],
								'text-align:justify' => [
									'title' => __( 'Justify', 'ultimate' ),
									'icon'  => 'fa fa-align-justify',
								],
							],
							'selectors' => [
								'{{WRAPPER}} .single__testmonial:before' => '{{VALUE}};',
							],
							'default' => 'text-align:left',
						]
					);
					$this->add_responsive_control(
						'box_before_width',
						[
							'label'      => __( 'Width', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .single__testmonial:before' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'box_before_height',
						[
							'label'      => __( 'Height', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .single__testmonial:before' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'box_before_opacity',
						[
							'label' => __( 'Opacity', 'ultimate' ),
							'type'  => Controls_Manager::SLIDER,
							'range' => [
								'px' => [
									'max'  => 1,
									'min'  => 0.10,
									'step' => 0.01,
								],
							],
							'selectors' => [
								'{{WRAPPER}} .single__testmonial:before' => 'opacity: {{SIZE}};',
							],
						]
					);
					$this->add_control(
						'box_before_zindex',
						[
							'label'     => __( 'Z-Index', 'ultimate' ),
							'type'      => Controls_Manager::NUMBER,
							'min'       => -99,
							'max'       => 99,
							'step'      => 1,
							'selectors' => [
								'{{WRAPPER}} .single__testmonial:before' => 'z-index: {{SIZE}};',
							],
						]
					);
					$this->add_responsive_control(
						'box_before_margin',
						[
							'label'      => __( 'Margin', 'ultimate' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .single__testmonial:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
				$this->start_controls_tab(
					'box_after_tab',
					[
						'label' => __( 'AFTER', 'ultimate' ),
					]
				);
					$this->add_group_control(
						Group_Control_Background:: get_type(),
						[
							'name'     => 'box_after_background',
							'label'    => __( 'Background', 'ultimate' ),
							'types'    => [ 'classic', 'gradient' ],
							'selector' => '{{WRAPPER}} .single__testmonial:after',
						]
					);
					$this->add_responsive_control(
						'box_after_display',
						[
							'label'   => __( 'Display', 'ultimate' ),
							'type'    => Controls_Manager::SELECT,
							'default' => '',
							'options' => [
								'initial'      => __( 'Initial', 'ultimate' ),
								'block'        => __( 'Block', 'ultimate' ),
								'inline-block' => __( 'Inline Block', 'ultimate' ),
								'flex'         => __( 'Flex', 'ultimate' ),
								'inline-flex'  => __( 'Inline Flex', 'ultimate' ),
								'none'         => __( 'none', 'ultimate' ),
							],
							'selectors' => [
								'{{WRAPPER}} .single__testmonial:after' => 'display: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'box_after_position',
						[
							'label'   => __( 'Position', 'ultimate' ),
							'type'    => Controls_Manager::SELECT,
							'default' => '',
							
							'options' => [
								'initial'  => __( 'Initial', 'ultimate' ),
								'absolute' => __( 'Absulute', 'ultimate' ),
								'relative' => __( 'Relative', 'ultimate' ),
								'static'   => __( 'Static', 'ultimate' ),
							],
							'selectors' => [
								'{{WRAPPER}} .single__testmonial:after' => 'position: {{VALUE}};',
							],
						]
					);
					$this->add_responsive_control(
						'box_after_position_from_left',
						[
							'label'      => __( 'From Left', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .single__testmonial:after' => 'left: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'box_after_position' => ['absolute','relative']
							],
						]
					);
					$this->add_responsive_control(
						'box_after_position_from_right',
						[
							'label'      => __( 'From Right', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .single__testmonial:after' => 'right: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'box_after_position' => ['absolute','relative']
							],
						]
					);
					$this->add_responsive_control(
						'box_after_position_from_top',
						[
							'label'      => __( 'From Top', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .single__testmonial:after' => 'top: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'box_after_position' => ['absolute','relative']
							],
						]
					);
					$this->add_responsive_control(
						'box_after_position_from_bottom',
						[
							'label'      => __( 'From Bottom', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .single__testmonial:after' => 'bottom: {{SIZE}}{{UNIT}};',
							],
							'condition' => [
								'box_after_position' => ['absolute','relative']
							],
						]
					);
					$this->add_responsive_control(
						'box_after_align',
						[
							'label'   => __( 'Alignment', 'ultimate' ),
							'type'    => Controls_Manager::CHOOSE,
							'options' => [
								'text-align:left' => [
									'title' => __( 'Left', 'ultimate' ),
									'icon'  => 'fa fa-align-left',
								],
								'margin: 0 auto' => [
									'title' => __( 'Center', 'ultimate' ),
									'icon'  => 'fa fa-align-center',
								],
								'float:right' => [
									'title' => __( 'Right', 'ultimate' ),
									'icon'  => 'fa fa-align-right',
								],
								'text-align:justify' => [
									'title' => __( 'Justify', 'ultimate' ),
									'icon'  => 'fa fa-align-justify',
								],
							],
							'selectors' => [
								'{{WRAPPER}} .single__testmonial:after' => '{{VALUE}};',
							],
							'default' => 'text-align:left',
						]
					);
					$this->add_responsive_control(
						'box_after_width',
						[
							'label'      => __( 'Width', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .single__testmonial:after' => 'width: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_responsive_control(
						'box_after_height',
						[
							'label'      => __( 'Height', 'ultimate' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px' => [
									'min'  => 0,
									'max'  => 1000,
									'step' => 1,
								],
								'%' => [
									'min' => 0,
									'max' => 100,
								],
							],
							'default' => [
								'unit' => 'px',
							],
							'selectors' => [
								'{{WRAPPER}} .single__testmonial:after' => 'height: {{SIZE}}{{UNIT}};',
							],
						]
					);
					$this->add_control(
						'box_after_opacity',
						[
							'label' => __( 'Opacity', 'ultimate' ),
							'type'  => Controls_Manager::SLIDER,
							'range' => [
								'px' => [
									'max'  => 1,
									'min'  => 0.10,
									'step' => 0.01,
								],
							],
							'selectors' => [
								'{{WRAPPER}} .single__testmonial:after' => 'opacity: {{SIZE}};',
							],
						]
					);
					$this->add_control(
						'box_after_zindex',
						[
							'label'     => __( 'Z-Index', 'ultimate' ),
							'type'      => Controls_Manager::NUMBER,
							'min'       => -99,
							'max'       => 99,
							'step'      => 1,
							'selectors' => [
								'{{WRAPPER}} .single__testmonial:after' => 'z-index: {{SIZE}};',
							],
						]
					);
					$this->add_responsive_control(
						'box_after_margin',
						[
							'label'      => __( 'Margin', 'ultimate' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%', 'em' ],
							'selectors'  => [
								'{{WRAPPER}} .single__testmonial:after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);
				$this->end_controls_tab();
			$this->end_controls_tabs();
		$this->end_controls_section();
		/*----------------------------
			BOX BEFORE / AFTER END
		-----------------------------*/
		
	}
	
	protected function render() {

		$settings = $this->get_settings_for_display();

		// Icon Condition
		if ( 'yes' == $settings['show_icon'] ) {
			if ( 'font_icon' == $settings['icon_type'] && !empty( $settings['font_icon'] ) ) {
				$icon = '<div class="testmonial__quote"><i class="'.esc_attr( $settings['font_icon'] ).'"></i></div>';
			}elseif( 'image_icon' == $settings['icon_type'] && !empty( $settings['image_icon'] ) ){
				$icon_array = $settings['image_icon'];
				$icon_link = wp_get_attachment_image_url( $icon_array['id'], 'thumbnail' );
				$icon = '<div class="testmonial__quote"><img src="'. esc_url( $icon_link ) .'" alt="" /></div>';
			}
		}else{
			$icon = '';
		}

		// Title Tag
		if ( !empty( $settings['title_tag'] ) ) {
			$title_tag = $settings['title_tag'];
		}else{
			$title_tag = 'h3';
		}

		// Title
		if ( !empty( $settings['title'] ) ) {
			$title = '<'.$title_tag.' class="testmonial__title">'.esc_html( $settings['title'] ).'</'.$title_tag.'>';
		}else{
			$title = '';
		}

		// Subtitle
		if ( !empty( $settings['subtitle'] ) ) {
			$subtitle = '<div class="testmonial__subtitle">'.esc_html( $settings['subtitle'] ).'</div>';
		}else{
			$subtitle = '';
		}

		// Member Thumb
		if ( !empty( $settings['testmonial_content']['member_thumb'] ) ) {
			$thumb_array = $settings['testmonial_content']['member_thumb'];
			$thumb_link = wp_get_attachment_image_url( $icon_array['id'], 'thumbnail' );
			$author_thumb = '<div class="author__thumb"><img src="'. esc_url( $thumb_link ) .'" alt="" /></div>';
		}

		// Member Name
		if ( !empty( $settings['testmonial_content']['member_name'] ) ) {
			$author_name = '<h4 class="author__name">'.esc_html( $settings['testmonial_content']['member_name'] ).'</h4>';
		}else{
			$author_name = '';
		}

		// Description
		if ( !empty( $settings['testmonial_content']['description'] ) ) {
			$description = '<div class="testmonial__description">'.wpautop( $settings['testmonial_content']['description'] ).'</div>';
		}

		// Designation
		if ( !empty( $settings['testmonial_content']['designation'] ) ) {
			$designation = '<p class="author__designation">'.wpautop( $settings['testmonial_content']['designation'] ).'</p>';
		}

		if ( !empty($settings['subtitle_position']) ) {
			// Title Condition
			if ( 'before_title' == $settings['subtitle_position'] ) {
				$title_subtitle = $subtitle . $title;
			}elseif( 'after_title' == $settings['subtitle_position'] ){
				$title_subtitle = $title . $subtitle;
			}elseif( empty($settings['subtitle']) ){
				$title_subtitle = $title . $subtitle;
			}
		}else{
			$title_subtitle = $title . $subtitle;
		}

		/*----------------------------
		CONTENT WITH FOR LOOP
		------------------------------*/
		$all_testmonial = '';
		for ($i=0; $i <= count($settings['testmonial_content']) ; $i++) {
			// Member Thumb
			if ( !empty( $settings['testmonial_content'][$i]['member_thumb'] ) ) {
				$thumb_array = $settings['testmonial_content'][$i]['member_thumb'];
				$thumb_link = wp_get_attachment_image_url( $thumb_array['id'], 'thumbnail' );
				$author_thumb = '<div class="author__thumb"><img src="'. esc_url( $thumb_link ) .'" alt="" /></div>';
				$all_testmonial .= $author_thumb;
			}

			// Member Name
			if ( !empty( $settings['testmonial_content'][$i]['member_name'] ) ) {
				$author_name = '<h4 class="author__name">'.esc_html( $settings['testmonial_content'][$i]['member_name'] ).'</h4>';
				$all_testmonial .= $author_name;
			}

			// Description
			if ( !empty( $settings['testmonial_content'][$i]['description'] ) ) {
				$description = '<div class="testmonial__description">'.wpautop( $settings['testmonial_content'][$i]['description'] ).'</div>';
				$all_testmonial .= $description;
			}

			// Designation
			if ( !empty( $settings['testmonial_content'][$i]['designation'] ) ) {
				$designation = '<p class="author__designation">'.wpautop( $settings['testmonial_content'][$i]['designation'] ).'</p>';
				$all_testmonial .= $designation;
			}
		}
		//echo $all_testmonial;

		/*-----------------------------
			CONTENT WITH FOREACH LOOP
		------------------------------*/
	$testmonial_content = '';
	$testimonial_tumb_contnet = '';
	if ($settings['testmonial_content']) {
		if ( 'tesmonial_style_10' == $settings['testmonial_style'] || 'tesmonial_style_11' == $settings['testmonial_style'] || 'tesmonial_style_12' == $settings['testmonial_style'] ) {
			foreach( $settings['testmonial_content'] as $single_testmonial ){

				$testmonial_content .='
					<div class="single__testmonial">';

					if ( !empty( $single_testmonial['member_thumb'] ) ) {

						$thumb_array = $single_testmonial['member_thumb'];
						$thumb_link  = wp_get_attachment_image_url( $thumb_array['id'], 'thumbnail' );
						$thumb_link  = Group_Control_Image_Size::get_attachment_image_src( $thumb_array['id'], 'member_thumb_size', $single_testmonial );
						if ( !empty( $thumb_link ) ) {
							$testmonial_content .='<div class="author__thumb"><img src="'. esc_url( $thumb_link ) .'" alt="'.esc_attr( get_the_title() ).'" /></div>';
						}else{
							$testmonial_content .='<div class="author__thumb"><img src="'. esc_url( $single_testmonial['member_thumb']['url'] ) .'" alt="" /></div>';
						}
					}
					if( !empty( $single_testmonial['description'] ) ){

						$testmonial_content .='
					    <div class="author__content">';
							$testmonial_content .='<div class="testmonial__description">'.wpautop( $single_testmonial['description'] ).'</div>';
						$testmonial_content .='
						</div>';
					}
					if( !empty( $single_testmonial['member_name'] ) ){

						$testmonial_content .='
						<div class="author__thumb__designation__warp">
							<div class="author__thumb__designation">';

							if ( !empty( $icon ) ) {
							    $testmonial_content .=$icon;
							}
							if( !empty( $single_testmonial['member_name'] ) ){
								$testmonial_content .='
								<h4 class="author__name">'.esc_html( $single_testmonial['member_name'] ).'</h4>';
							}
							if( !empty( $single_testmonial['designation'] ) ){
								$testmonial_content .='
								<p class="author__designation">'.esc_html( $single_testmonial['designation'] ).'</p>';
							}

							$testmonial_content .='
							</div>
						</div>';
					}
				$testmonial_content .='
				</div>';
			}
		}elseif( 'tesmonial_style_13' == $settings['testmonial_style'] ){

			foreach( $settings['testmonial_content'] as $single_testmonial ){
				if ( !empty( $single_testmonial['member_thumb'] ) ) {

					$thumb_array = $single_testmonial['member_thumb'];
					$thumb_link  = wp_get_attachment_image_url( $thumb_array['id'], 'thumbnail' );
					$thumb_link  = Group_Control_Image_Size::get_attachment_image_src( $thumb_array['id'], 'member_thumb_size', $single_testmonial );
					if ( !empty( $thumb_link ) ) {
						$testimonial_tumb_contnet .='<div class="author__thumb"><img src="'. esc_url( $thumb_link ) .'" alt="'.esc_attr( get_the_title() ).'" /></div>';
					}else{
						$testimonial_tumb_contnet .='<div class="author__thumb"><img src="'. esc_url( $single_testmonial['member_thumb']['url'] ) .'" alt="" /></div>';
					}
				}


				$testmonial_content .='
					<div class="single__testmonial">';

					if ( !empty( $icon ) ) {
					    $testmonial_content .=$icon;
					}
					if( !empty( $single_testmonial['description'] ) ){

						$testmonial_content .='
					    <div class="author__content">';
							$testmonial_content .='<div class="testmonial__description">'.wpautop( $single_testmonial['description'] ).'</div>';
						$testmonial_content .='
						</div>';
					}
					if( !empty( $single_testmonial['member_name'] ) ){

						$testmonial_content .='
						<div class="author__thumb__designation__warp">
							<div class="author__thumb__designation">';

							if( !empty( $single_testmonial['member_name'] ) ){
								$testmonial_content .='
								<h4 class="author__name">'.esc_html( $single_testmonial['member_name'] ).'</h4>';
							}
							if( !empty( $single_testmonial['designation'] ) ){
								$testmonial_content .='
								<p class="author__designation">'.esc_html( $single_testmonial['designation'] ).'</p>';
							}

							$testmonial_content .='
							</div>
						</div>';
					}
				$testmonial_content .='
				</div>';
			}

		}else{
			foreach( $settings['testmonial_content'] as $single_testmonial ){

				$testmonial_content .='
					<div class="single__testmonial">';
					if( !empty( $single_testmonial['description'] ) ){
						$testmonial_content .='
					    <div class="author__content">';
						    if ( !empty( $icon ) ) {
						        $testmonial_content .=$icon;
						    }
							$testmonial_content .='<div class="testmonial__description">'.wpautop( $single_testmonial['description'] ).'</div>';
						$testmonial_content .='
						</div>';
					}
					if( !empty( $single_testmonial['member_thumb'] ) || !empty( $single_testmonial['member_name'] ) ){

						if( !empty( $single_testmonial['member_thumb'] ) ){

							$testmonial_content .='
							<div class="author__thumb__designation__warp">
								<div class="author__thumb__designation">';
								if ( !empty( $single_testmonial['member_thumb'] ) ) {
									$thumb_array = $single_testmonial['member_thumb'];
									$thumb_link  = wp_get_attachment_image_url( $thumb_array['id'], 'thumbnail' );
									$thumb_link  = Group_Control_Image_Size::get_attachment_image_src( $thumb_array['id'], 'member_thumb_size', $single_testmonial );
									if ( !empty( $thumb_link ) ) {
										$testmonial_content .='<div class="author__thumb"><img src="'. esc_url( $thumb_link ) .'" alt="'.esc_attr( get_the_title() ).'" /></div>';
									}else{
										$testmonial_content .='<div class="author__thumb"><img src="'. esc_url( $single_testmonial['member_thumb']['url'] ) .'" alt="" /></div>';
									}
								}

								if( !empty( $single_testmonial['member_name'] ) ){
									$testmonial_content .='
									<h4 class="author__name">'.esc_html( $single_testmonial['member_name'] ).'</h4>';
								}
								if( !empty( $single_testmonial['designation'] ) ){
									$testmonial_content .='
									<p class="author__designation">'.esc_html( $single_testmonial['designation'] ).'</p>';
								}
								$testmonial_content .='
								</div>
							</div>';
					    }
					}
				$testmonial_content .='
				</div>';
			}
		}
	}

		// Slider Attr
		$this->add_render_attribute( 'testmonial_carousel_attr', 'class', 'ultimate-testmonial-carousel' );
		if ( count( $settings['testmonial_content'] ) > 1 ) {
			$this->add_render_attribute( 'testmonial_carousel_attr', 'class', 'ultimate-carousel-active' );

			// SLIDER OPTIONS
			$options = [
				'item_on_large'     => $settings['item_on_large']["size"],
				'item_on_medium'    => $settings['item_on_medium']["size"],
				'item_on_tablet'    => $settings['item_on_tablet']["size"],
				'item_on_mobile'    => $settings['item_on_mobile']["size"],
				'stage_padding'     => $settings['stage_padding']["size"],
				'item_margin'       => $settings['item_margin']["size"],
				'autoplay'          => ('true' == $settings['autoplay']) ? true : false,
				'autoplaytimeout'   => $settings['autoplaytimeout']["size"],
				'slide_speed'       => $settings['slide_speed']["size"],
				'slide_animation'   => $settings['slide_animation'],
				'slide_animate_in'  => $settings['slide_animate_in'],
				'slide_animate_out' => $settings['slide_animate_out'],
				'nav'               => ( 'true' == $settings['nav'] ) ? true : false,
				'nav_position'      => $settings['nav_position'],
				'next_icon'         => $settings['next_icon'],
				'prev_icon'         => $settings['prev_icon'],
				'dots'              => ( 'true' == $settings['dots'] ) ? true : false,
				'loop'              => ( 'true' == $settings['loop'] ) ? true : false,
				'hover_pause'       => ( 'true' == $settings['hover_pause'] ) ? true : false,
				'center'            => ( 'true' == $settings['center'] ) ? true : false,
				'rtl'               => ( 'true' == $settings['rtl'] ) ? true : false,
			];

			$this->add_render_attribute( 'testmonial_carousel_attr', 'data-settings', wp_json_encode( $options ) );
		}else{
			$this->add_render_attribute( 'testmonial_carousel_attr', 'class', 'testmonial-grid' );
		}

		// Parent Attr.
		$this->add_render_attribute('sldier_parent_attr','class','sldier-content-area');
		$this->add_render_attribute('sldier_parent_attr','class',$settings['testmonial_style']);
		$this->add_render_attribute('sldier_parent_attr','class',$settings['nav_position']);
	?>

	<?php if ( 'tesmonial_style_13' == $settings['testmonial_style'] ): ?>
		<div class="testmonial__thumb__content_area">
			<div class="testmonial__thumb__content">
				<div class="testmonial__thumb__content__slider">
					<?php echo ( isset( $testimonial_tumb_contnet ) ? $testimonial_tumb_contnet : '' ); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div <?php echo $this->get_render_attribute_string('sldier_parent_attr'); ?>>
		<div <?php echo $this->get_render_attribute_string('testmonial_carousel_attr'); ?> >
			<?php echo ( isset( $testmonial_content ) ? $testmonial_content : '' ); ?>
		</div>
	</div>

	<?php

	}

	protected function _content_template() {}

}
Plugin::instance()->widgets_manager->register_widget_type( new Ultimate_Testmonial() );