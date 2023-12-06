<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Ultimate_Positions_Element extends Widget_Base {

	public function get_name() {
		return 'PositionElement';
	}

	public function get_title() {
		return __( 'Position Element', 'ultimate' );
	}

	public function get_icon() {
		return 'eicon-drag-n-drop';
	}

	public function get_categories() {
		return array('ultimate-addons');
	}

	public static function get_animation_style(){
		return [
			'Zoom_In_Out animated'       => __('Zoom_In_Out', 'ultimate'),
			'Circle_Large animated'       => __('Circle_Large', 'ultimate'),
			'Fade_In_Out animated'       => __('Fade_In_Out', 'ultimate'),
			'littleCircle animated'       => __('littleCircle', 'ultimate'),
			'bigCircle animated'          => __('bigCircle', 'ultimate'),
			'Hoop animated'               => __('Hoop', 'ultimate'),
			'triAngle animated'           => __('triAngle', 'ultimate'),
			'littleSquare animated'       => __('littleSquare', 'ultimate'),
			'bigSquare animated'          => __('bigSquare', 'ultimate'),
			'fadeInRotate animated'       => __('fadeInRotate', 'ultimate'),
			'fadeInBack animated'         => __('fadeInBack', 'ultimate'),
			'blurFadeIn animated'         => __('blurFadeIn', 'ultimate'),
			'blurFadeInOut animated'      => __('blurFadeInOut', 'ultimate'),
			'ballBounce animated'         => __('ballBounce', 'ultimate'),
			'zoomBounce animated'         => __('zoomBounce', 'ultimate'),
			'FramesOne animated'          => __('FramesOne', 'ultimate'),
			'FramesTwo animated'          => __('FramesTwo', 'ultimate'),
			'FramesThree animated'        => __('FramesThree', 'ultimate'),
			'FramesFour animated'         => __('FramesFour', 'ultimate'),
			'FramesFive animated'         => __('FramesFive', 'ultimate'),
			'scaleUpOne animated'         => __('scaleUpOne', 'ultimate'),
			'scaleUpOne animated'         => __('scaleUpOne', 'ultimate'),
			'scaleUpTwo animated'         => __('scaleUpTwo', 'ultimate'),
			'scaleUpThree animated'       => __('scaleUpThree', 'ultimate'),
			'prettyFade animated'         => __('prettyFade', 'ultimate'),
			'fade_in animated'            => __('fade_in', 'ultimate'),
			'scaleRight animated'         => __('scaleRight', 'ultimate'),
			'scaleUpOne animated'         => __('scaleUpOne', 'ultimate'),
			'bigSpin animated'            => __('bigSpin', 'ultimate'),
			'rotated animated'            => __('rotated', 'ultimate'),
			'rotatedHalf animated'        => __('rotatedHalf', 'ultimate'),
			'rotatedHalfTwo animated'     => __('rotatedHalfTwo', 'ultimate'),
			'jump animated'               => __('jump', 'ultimate'),
			'imageBgAnim animated'        => __('imageBgAnim', 'ultimate'),
			'bgMove animated'             => __('bgMove', 'ultimate'),
			'gradientBG animated'         => __('gradientBG', 'ultimate'),
			'rippleOutOne animated'       => __('rippleOutOne', 'ultimate'),
			'rippleOuTwo animated'        => __('rippleOuTwo', 'ultimate'),
			'bounce animated'             => __('bounce','ultimate'),
			'flash animated'              => __('flash','ultimate'),
			'pulse animated'              => __('pulse','ultimate'),
			'rubberBand animated'         => __('rubberBand','ultimate'),
			'shake animated'              => __('shake','ultimate'),
			'headShake animated'          => __('headShake','ultimate'),
			'swing animated'              => __('swing','ultimate'),
			'tada animated'               => __('tada','ultimate'),
			'wobble animated'             => __('wobble','ultimate'),
			'jello animated'              => __('jello','ultimate'),
			'heartBeat animated'          => __('heartBeat','ultimate'),
			'bounceIn animated'           => __('bounceIn','ultimate'),
			'bounceInDown animated'       => __('bounceInDown','ultimate'),
			'bounceInLeft animated'       => __('bounceInLeft','ultimate'),
			'bounceInRight animated'      => __('bounceInRight','ultimate'),
			'bounceInUp animated'         => __('bounceInUp','ultimate'),
			'bounceOut animated'          => __('bounceOut','ultimate'),
			'bounceOutDown animated'      => __('bounceOutDown','ultimate'),
			'bounceOutLeft animated'      => __('bounceOutLeft','ultimate'),
			'bounceOutRight animated'     => __('bounceOutRight','ultimate'),
			'bounceOutUp animated'        => __('bounceOutUp','ultimate'),
			'fadeIn animated'             => __('fadeIn','ultimate'),
			'fadeInDown animated'         => __('fadeInDown','ultimate'),
			'fadeInDownBig animated'      => __('fadeInDownBig','ultimate'),
			'fadeInLeft animated'         => __('fadeInLeft','ultimate'),
			'fadeInLeftBig animated'      => __('fadeInLeftBig','ultimate'),
			'fadeInRight animated'        => __('fadeInRight','ultimate'),
			'fadeInRightBig animated'     => __('fadeInRightBig','ultimate'),
			'fadeInUp animated'           => __('fadeInUp','ultimate'),
			'fadeInUpBig animated'        => __('fadeInUpBig','ultimate'),
			'fadeOut animated'            => __('fadeOut','ultimate'),
			'fadeOutDown animated'        => __('fadeOutDown','ultimate'),
			'fadeOutDownBig animated'     => __('fadeOutDownBig','ultimate'),
			'fadeOutLeft animated'        => __('fadeOutLeft','ultimate'),
			'fadeOutLeftBig animated'     => __('fadeOutLeftBig','ultimate'),
			'fadeOutRight animated'       => __('fadeOutRight','ultimate'),
			'fadeOutRightBig animated'    => __('fadeOutRightBig','ultimate'),
			'fadeOutUp animated'          => __('fadeOutUp','ultimate'),
			'fadeOutUpBig animated'       => __('fadeOutUpBig','ultimate'),
			'flip animated'               => __('flip','ultimate'),
			'flipInX animated'            => __('flipInX','ultimate'),
			'flipInY animated'            => __('flipInY','ultimate'),
			'flipOutX animated'           => __('flipOutX','ultimate'),
			'flipOutY animated'           => __('flipOutY','ultimate'),
			'lightSpeedIn animated'       => __('lightSpeedIn','ultimate'),
			'lightSpeedOut animated'      => __('lightSpeedOut','ultimate'),
			'rotateIn animated'           => __('rotateIn','ultimate'),
			'rotateInDownLeft animated'   => __('rotateInDownLeft','ultimate'),
			'rotateInDownRight animated'  => __('rotateInDownRight','ultimate'),
			'rotateInUpLeft animated'     => __('rotateInUpLeft','ultimate'),
			'rotateInUpRight animated'    => __('rotateInUpRight','ultimate'),
			'rotateOut animated'          => __('rotateOut','ultimate'),
			'rotateOutDownLeft animated'  => __('rotateOutDownLeft','ultimate'),
			'rotateOutDownRight animated' => __('rotateOutDownRight','ultimate'),
			'rotateOutUpLeft animated'    => __('rotateOutUpLeft','ultimate'),
			'rotateOutUpRight animated'   => __('rotateOutUpRight','ultimate'),
			'hinge animated'              => __('hinge','ultimate'),
			'jackInTheBox animated'       => __('jackInTheBox','ultimate'),
			'rollIn animated'             => __('rollIn','ultimate'),
			'rollOut animated'            => __('rollOut','ultimate'),
			'zoomIn animated'             => __('zoomIn','ultimate'),
			'zoomInDown animated'         => __('zoomInDown','ultimate'),
			'zoomInLeft animated'         => __('zoomInLeft','ultimate'),
			'zoomInRight animated'        => __('zoomInRight','ultimate'),
			'zoomInUp animated'           => __('zoomInUp','ultimate'),
			'zoomOut animated'            => __('zoomOut','ultimate'),
			'zoomOutDown animated'        => __('zoomOutDown','ultimate'),
			'zoomOutLeft animated'        => __('zoomOutLeft','ultimate'),
			'zoomOutRight animated'       => __('zoomOutRight','ultimate'),
			'zoomOutUp animated'          => __('zoomOutUp','ultimate'),
			'slideInDown animated'        => __('slideInDown','ultimate'),
			'slideInLeft animated'        => __('slideInLeft','ultimate'),
			'slideInRight animated'       => __('slideInRight','ultimate'),
			'slideInUp animated'          => __('slideInUp','ultimate'),
			'slideOutDown animated'       => __('slideOutDown','ultimate'),
			'slideOutLeft animated'       => __('slideOutLeft','ultimate'),
			'slideOutRight animated'      => __('slideOutRight','ultimate'),
			'slideOutUp animated'         => __('slideOutUp','ultimate'),
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

		// Icon Type
		$this->add_control(
			'icon_type',
			[
				'label'   => __( 'Element Type', 'ultimate' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'font_icon',
				'options' => [
					'font_icon'  => __( 'Font Icon', 'ultimate' ),
					'image_icon' => __( 'Image Icon / Image', 'ultimate' ),
					'text'       => __( 'Simple Text', 'ultimate' ),
				],
			]
		);

		// Font Icon
		$this->add_control(
			'font_icon',
			[
				'label'     => __( 'Font Icons', 'ultimate' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-star',
				'condition' => [
					'icon_type' => 'font_icon',
				],
			]
		);

		// Image Icon
		$this->add_control(
			'image_icon',
			[
				'label'   => __( 'Image Icon / Image', 'ultimate' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => 'image_icon',
				],
			]
		);

		// Image size
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'icon_image_size',
				'default'   => 'thumbnail',
				'condition' => [
					'icon_type' => 'image_icon',
				],
			]
		);

		// Title
		$this->add_control(
			'title',
			[
				'label'       => __( 'Title', 'ultimate' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Title', 'ultimate' ),
				'condition'   => [
					'icon_type' => 'text',
				],
			]
		);

		// Animation
		$this->add_control(
			'element_animation',
			[
				'label'   => __( 'Element Animation', 'ultimate' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'yes' => __( 'Yes', 'ultimate' ),
					'no'  => __( 'No', 'ultimate' ),
				],
			]
		);

		// Custom Animate
		$this->add_control(
			'element_animation_type',
			[
				'label'   => __( 'Custom Animate Type', 'ultimate' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'fadeIn',
				'options' => self::get_animation_style(),
				'condition' => [
					'element_animation' => 'yes',
				]
			]
		);

		// Speed
		$this->add_control(
			'element_animation_speed',
			[
				'label'   => __( 'Animation Speed', 'ultimate' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'fast' => __( 'Fast', 'ultimate' ),
					'faster' => __( 'Faster', 'ultimate' ),
					'slow' => __( 'Slow', 'ultimate' ),
					'slower' => __( 'Slower', 'ultimate' ),
				],
				'condition' => [
					'element_animation' => 'yes',
				]
			]
		);

		// Infinite
		$this->add_control(
			'element_animation_infinite',
			[
				'label'   => __( 'Infine Animation', 'ultimate' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'infinite' => __( 'Yes', 'ultimate' ),
					'normal'  => __( 'No', 'ultimate' ),
				],
				'condition' => [
					'element_animation' => 'yes',
				]
			]
		);

		// Mode
		$this->add_control(
			'element_animation_direction',
			[
				'label'   => __( 'Animation Direction', 'ultimate' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'normal',
				'options' => [
					'normal'  => __( 'Normal', 'ultimate' ),
					'alternate' => __( 'Alternate', 'ultimate' ),
					'reverse' => __( 'Reverse', 'ultimate' ),
					'alternate-reverse' => __( 'Alternate Reverse', 'ultimate' ),
				],
				'condition' => [
					'element_animation' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .posiion__element__wrap' => '-webkit-animation-direction: {{VALUE}};  animation-direction: {{VALUE}};',
				],
			]
		);

		// Mode
		$this->add_control(
			'element_animation_custom_speed',
			[
				'label' => __( 'Animation Custom Duration', 'ultimate' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0.5,
						'max'  => 100,
						'step' => 0.5,
					],
				],
				'default' => [
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .posiion__element__wrap' => '-webkit-animation-duration: {{SIZE}}s;  animation-duration: {{SIZE}}s;',
				],
			]
		);

		$this->end_controls_section();

		/*********************************
		 * 		STYLE SECTION
		 *********************************/

		/*----------------------------
			ELEMENT STYLE
		-----------------------------*/
		$this->start_controls_section(
			'element_style_section',
			[
				'label' => __( 'Position Element', 'ultimate' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'warapper_width',
			[
				'label'      => __( 'Warapper Width', 'ultimate' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 2000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'vw' => [
						'min' => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .posiion__element__wrap' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'warapper_height',
			[
				'label'      => __( 'Warapper Height', 'ultimate' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vw' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 2000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'vw' => [
						'min' => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .posiion__element__wrap' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'warp_hr2',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		
		// Typgraphy
		$this->add_group_control(
			Group_Control_Typography:: get_type(),
			[
				'name'      => 'icon_typography',
				'selector'  => '{{WRAPPER}}',
				'condition' => [
					'icon_type' => ['font_icon','text']
				],
			]
		);

		// Image Size
		$this->add_responsive_control(
			'icon_image_size_width',
			[
				'label'      => __( 'Image Width', 'ultimate' ),
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
					'{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_type' => ['image_icon']
				],
			]
		);

		// Image Size
		$this->add_responsive_control(
			'icon_image_size_height',
			[
				'label'      => __( 'Image Height', 'ultimate' ),
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
					'{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_type' => ['image_icon']
				],
			]
		);

		// Image Filter
		$this->add_group_control(
			Group_Control_Css_Filter:: get_type(),
			[
				'name'      => 'icon_image_filters',
				'label'        => __( 'Image Filter', 'plugin-domain' ),
				'selector'  => '{{WRAPPER}} img',
				'condition' => [
					'icon_type' => ['image_icon']
				],
			]
		);

		// Hr
		$this->add_control(
			'icon_hr1',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Color
		$this->add_control(
			'icon_color',
			[
				'label'     => __( 'Color', 'ultimate' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}}' => 'color: {{VALUE}};',
				],
			]
		);

		// Background
		$this->add_group_control(
			Group_Control_Background:: get_type(),
			[
				'name'     => 'icon_background',
				'label'    => __( 'Background', 'ultimate' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}}',
			]
		);

		// Hr
		$this->add_control(
			'icon_hr2',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border:: get_type(),
			[
				'name'     => 'icon_border',
				'label'    => __( 'Border', 'ultimate' ),
				'selector' => '{{WRAPPER}}',
			]
		);

		// Border Radius
		$this->add_control(
			'icon_radius',
			[
				'label'      => __( 'Border Radius', 'ultimate' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}}, {{WRAPPER}} img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		// Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow:: get_type(),
			[
				'name'     => 'icon_shadow',
				'selector' => '{{WRAPPER}}',
			]
		);

		// Hr
		$this->add_control(
			'icon_hr3',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Width
		$this->add_control(
			'icon_width',
			[
				'label'      => __( 'Width', 'ultimate' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px','vw','%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'vw' => [
						'min'  => -100,
						'max'  => 100,
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
					'{{WRAPPER}}' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Height
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
					'{{WRAPPER}}' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Hr
		$this->add_control(
			'icon_hr5',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Display;
		$this->add_control(
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
					'{{WRAPPER}}' => 'display: {{VALUE}};',
				],
			]
		);

		// Alignment
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
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
				'default' => '',
			]
		);

		// Hr
		$this->add_control(
			'icon_hr6',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Postion From Left
		$this->add_responsive_control(
			'icon_position_from_left',
			[
				'label'      => __( 'Horizontal Offset', 'ultimate' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vw','%' ],
				'range'      => [
					'px' => [
						'min'  => -2000,
						'max'  => 2000,
						'step' => 1,
					],
					'vw' => [
						'min'  => -100,
						'max'  => 100,
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
					'{{WRAPPER}}' => 'position:absolute; left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Postion From Top
		$this->add_responsive_control(
			'icon_position_from_top',
			[
				'label'      => __( 'Vertical Offset', 'ultimate' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vw','%' ],
				'range'      => [
					'px' => [
						'min'  => -2000,
						'max'  => 2000,
						'step' => 1,
					],
					'vw' => [
						'min'  => -100,
						'max'  => 100,
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
					'{{WRAPPER}}' => 'position:absolute; top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Hr
		$this->add_control(
			'icon_hr7',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Z-Index
		$this->add_control(
			'icon_zindex',
			[
				'label'     => __( 'Z-Index', 'ultimate' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => -99,
				'max'       => 99,
				'step'      => 1,
				'selectors' => [
					'{{WRAPPER}}' => 'z-index: {{SIZE}};',
				],
			]
		);

		// Opacity
		$this->add_control(
			'icon_opacity',
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
					'{{WRAPPER}}' => 'opacity: {{SIZE}};',
				],
			]
		);

		// Margin
		$this->add_responsive_control(
			'icon_margin',
			[
				'label'      => __( 'Margin', 'ultimate' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Hr
		$this->add_control(
			'icon_hr8',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Padding
		$this->add_responsive_control(
			'icon_padding',
			[
				'label'      => __( 'Padding', 'ultimate' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		/*----------------------------
			ICON STYLE END
		-----------------------------*/		
	}
	
	protected function render() {

		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'posiion__element__wrap_attr', 'class', 'posiion__element__wrap' );
		$this->add_render_attribute( 'posiion__element__wrap_attr', 'class', $settings['element_animation_type'] );
		$this->add_render_attribute( 'posiion__element__wrap_attr', 'class', $settings['element_animation_infinite'] );
		$this->add_render_attribute( 'posiion__element__wrap_attr', 'class', $settings['element_animation_speed'] );
		$this->add_render_attribute( 'posiion__element__wrap_attr', 'class', $settings['element_animation_infinite'] );

		// Icon Condition
		if ( 'font_icon' == $settings['icon_type'] && !empty( $settings['font_icon'] ) ) {
			$element = '<div class="posiion__element__item"><i class="'.esc_attr( $settings['font_icon'] ).'"></i></div>';
		}elseif( 'image_icon' == $settings['icon_type'] && !empty( $settings['image_icon'] ) ){
			$element_array = $settings['image_icon'];
			$element_link  = wp_get_attachment_image_url( $element_array['id'], 'thumbnail' );
			$image         = Group_Control_Image_Size::get_attachment_image_html( $settings, 'icon_image_size', 'image_icon');
			$element       = '<div class="posiion__element__item">'.$image.'</div>';
		}elseif ( 'text' == $settings['icon_type'] && !empty( $settings['title'] ) ) {
			$element = '<div class="posiion__element__item">'.esc_html( $settings['title'] ).'</div>';
		}else{
			$element = '';
		}

		echo '<div '.$this->get_render_attribute_string('posiion__element__wrap_attr').'>
				'.( isset( $element ) ? $element : '' ).'
			</div>';

	}

	protected function _content_template() {}
}
Plugin::instance()->widgets_manager->register_widget_type( new Ultimate_Positions_Element() );