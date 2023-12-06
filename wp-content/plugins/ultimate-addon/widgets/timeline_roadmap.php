<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Ultimate_Timeline_Roadmap_Widget extends Widget_Base {

	public function get_name() {
		return 'Ultimate_Timeline_Roadmap_Widget';
	}

	public function get_title() {
		return __( 'Timeline Roadmap', 'ultimate' );
	}

	public function get_icon() {
		return 'eicon-time-line';
	}

	public function get_categories() {
		return array('ultimate-addons');
	}

	public static function box_style(){
		return [
			'single__timeline__roadmap__layout__1'      => 'Timeline Roadmap Style 1',
			'single__timeline__roadmap__layout__2'      => 'Timeline Roadmap Style 2',
			'single__timeline__roadmap__layout__custom' => 'Custom Roadmap Style',
		];
	}

	public function get_script_depends(){
        return [
            'roadmap',
            'ultimate-core',
        ];
	}

	public function get_style_depends() {
		return[
			'roadmap',
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

		$repeater = new Repeater();


		// Font Icon
		$repeater->add_control(
			'icon',
			[
				'label'     => __( 'Font Icons', 'ultimate' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-star-o',
			]
		);

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
			'date',
			[
				'label'       => __( 'Date', 'ultimate' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( '10-12-2022', 'ultimate' ),
			]
		);

		// Description
		$repeater->add_control(
			'description',
			[
				'label'       => __( 'Description', 'ultimate' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Description.', 'ultimate' ),
			]
		);


		$this->add_control(
			'timeline_content',
			[
				'label' => __( 'Roadmap Timeline Items', 'ultimate' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'date' => __( 'Q1 - 2021', 'ultimate' ),
						'title' => __( 'First Impression', 'ultimate' ),
						'description' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 'ultimate' ),
					],
					[
						'date' => __( 'Q2 - 2022', 'ultimate' ),
						'title' => __( 'First Impression', 'ultimate' ),
						'description' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 'ultimate' ),
					],
					[
						'date' => __( 'Q3 - 2023', 'ultimate' ),
						'title' => __( 'First Impression', 'ultimate' ),
						'description' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 'ultimate' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);		
		$this->end_controls_section();



		$this->start_controls_section(
			'option_section',
			[
				'label' => __( 'Roadmap Options', 'ultimate' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'timeline_per_slide',
			[
				'label'      => __( 'Timeline Per Slide', 'ultimate' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 15,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '6',
				],
			]
		);

		$this->add_responsive_control(
			'slide',
			[
				'label'      => __( 'Total Slide', 'ultimate' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 5,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '1',
				],
			]
		);

		$this->add_control(
			'next_icon',
			[
				'label'     => __( 'Next Icon', 'ultimate' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-angle-right',
			]
		);
		$this->add_control(
			'prev_icon',
			[
				'label'     => __( 'Prev Icon', 'ultimate' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-angle-left',
			]
		);

		$this->add_control(
			'orientation',
			[
				'label'   => __( 'Orientation', 'ultimate' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'auto',
				'options' => [
					'auto'       => __( 'Auto', 'ultimate' ),
					'horizontal' => __( 'Horizontal', 'ultimate' ),
					'vertical'   => __( 'Vertical', 'ultimate' ),
				],
			]
		);
		$this->end_controls_section();



		/*********************************
		 * 		STYLE SECTION
		 *********************************/




		/*----------------------------
			BORDER STYLE
		-----------------------------*/
		$this->start_controls_section(
			'border_style_section',
			[
				'label' => __( 'Timeline Border Background', 'ultimate' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);		

		// Icon Background
		$this->add_group_control(
			Group_Control_Background:: get_type(),
			[
				'name'     => 'border_background',
				'label'    => __( 'Background', 'ultimate' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .roadmap__events__event:after,{{WRAPPER}} .roadmap__events__event:before,{{WRAPPER}} .roadmap__events:after',
			]
		);
		$this->end_controls_section();
		/*----------------------------
			BORDER STYLE END
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
		
		// Icon Typgraphy
		$this->add_group_control(
			Group_Control_Typography:: get_type(),
			[
				'name'      => 'icon_typography',
				'selector'  => '{{WRAPPER}} .roadmap__event__icon',
			]
		);

		// Icon Hr
		$this->add_control(
			'icon_hr1',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);


		$this->start_controls_tabs( 'icon_tab_style' );
		$this->start_controls_tab(
			'icon_normal_tab',
			[
				'label' => __( 'Normal', 'ultimate' ),
			]
		);

		// Icon Color
		$this->add_control(
			'icon_color',
			[
				'label'     => __( 'Color', 'ultimate' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .roadmap__event__icon' => 'color: {{VALUE}};',
				],
			]
		);

		// Icon Background
		$this->add_group_control(
			Group_Control_Background:: get_type(),
			[
				'name'     => 'icon_background',
				'label'    => __( 'Background', 'ultimate' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .roadmap__event__icon',
			]
		);

		// Icon Hr
		$this->add_control(
			'icon_hr2',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Icon Border
		$this->add_group_control(
			Group_Control_Border:: get_type(),
			[
				'name'     => 'icon_border',
				'label'    => __( 'Border', 'ultimate' ),
				'selector' => '{{WRAPPER}} .roadmap__event__icon',
			]
		);

		// Icon Radius
		$this->add_control(
			'icon_radius',
			[
				'label'      => __( 'Border Radius', 'ultimate' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .roadmap__event__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		// Icon Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow:: get_type(),
			[
				'name'     => 'icon_shadow',
				'selector' => '{{WRAPPER}} .roadmap__event__icon',
			]
		);

		// Icon Hr
		$this->add_control(
			'icon_hr3',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Icon Width
		$this->add_responsive_control(
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
					'{{WRAPPER}} .roadmap__event__icon' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Icon Height
		$this->add_responsive_control(
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
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .roadmap__event__icon' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Icon Hr
		$this->add_control(
			'icon_hr5',
			[
				'type' => Controls_Manager::DIVIDER
			]
		);

		// Icon Display;
		$this->add_responsive_control(
			'icon_display',
			[
				'label'   => __( 'Display', 'ultimate' ),
				'type'    => Controls_Manager::SELECT,			
				'options' => [
					'initial'      => __( 'Initial', 'ultimate' ),
					'block'        => __( 'Block', 'ultimate' ),
					'inline-block' => __( 'Inline Block', 'ultimate' ),
					'flex'         => __( 'Flex', 'ultimate' ),
					'inline-flex'  => __( 'Inline Flex', 'ultimate' ),
					'none'         => __( 'none', 'ultimate' ),
				],
				'selectors' => [
					'{{WRAPPER}} .roadmap__event__icon' => 'display: {{VALUE}};',
				],
			]
		);

		// Icon Alignment
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
					'{{WRAPPER}} .roadmap__event__icon' => 'text-align: {{VALUE}};',
				],
			]
		);

		// Icon Hr
		$this->add_control(
			'icon_hr6',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Icon Postion
		$this->add_responsive_control(
			'icon_position',
			[
				'label'   => __( 'Position', 'ultimate' ),
				'type'    => Controls_Manager::SELECT,				
				'options' => [
					'initial'  => __( 'Initial', 'ultimate' ),
					'absolute' => __( 'Absulute', 'ultimate' ),
					'relative' => __( 'Relative', 'ultimate' ),
					'static'   => __( 'Static', 'ultimate' ),
				],
				'selectors' => [
					'{{WRAPPER}} .roadmap__event__icon' => 'position: {{VALUE}};',
				],
			]
		);

		// Postion From Left
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
					'{{WRAPPER}} .roadmap__event__icon' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_position!' => ['initial','static']
				],
			]
		);

		// Postion From Right
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
					'{{WRAPPER}} .roadmap__event__icon' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_position!' => ['initial','static']
				],
			]
		);

		// Postion From Top
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
					'{{WRAPPER}} .roadmap__event__icon' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_position!' => ['initial','static']
				],
			]
		);

		// Postion From Bottom
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
					'{{WRAPPER}} .roadmap__event__icon' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_position!' => ['initial','static']
				],
			]
		);

		// Icon Transition
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
					'{{WRAPPER}} .roadmap__event__icon' => 'transition: {{SIZE}}s;',
				],
			]
		);

		// Icon Hr
		$this->add_control(
			'icon_hr7',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Icon Margin
		$this->add_responsive_control(
			'icon_margin',
			[
				'label'      => __( 'Margin', 'ultimate' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .roadmap__event__icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Icon Hr
		$this->add_control(
			'icon_hr8',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Icon Padding
		$this->add_responsive_control(
			'icon_padding',
			[
				'label'      => __( 'Padding', 'ultimate' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .roadmap__event__icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		// Box Hover Icon Color
		$this->add_control(
			'hover_icon_color',
			[
				'label'     => __( 'Color', 'ultimate' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} :hover .roadmap__event__icon, {{WRAPPER}} :focus .roadmap__event__icon' => 'color: {{VALUE}};',
				],
			]
		);

		// Box Hover Icon Background
		$this->add_group_control(
			Group_Control_Background:: get_type(),
			[
				'name'     => 'hover_icon_background',
				'label'    => __( 'Background', 'ultimate' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} :hover .roadmap__event__icon,{{WRAPPER}} :focus .roadmap__event__icon',
			]
		);	

		// Icon Hr
		$this->add_control(
			'icon_hr4',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Icon Border
		$this->add_group_control(
			Group_Control_Border:: get_type(),
			[
				'name'     => 'hover_icon_border',
				'label'    => __( 'Border', 'ultimate' ),
				'selector' => '{{WRAPPER}} :hover .roadmap__event__icon,{{WRAPPER}} :hover .roadmap__event__icon',
			]
		);

		// Icon Radius
		$this->add_control(
			'hover_icon_radius',
			[
				'label'      => __( 'Border Radius', 'ultimate' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} :hover .roadmap__event__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Icon Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow:: get_type(),
			[
				'name'     => 'hover_icon_shadow',
				'selector' => '{{WRAPPER}} :hover .roadmap__event__icon',
			]
		);

		// Icon Hover Animation
		$this->add_control(
			'icon_hover_animation',
			[
				'label'    => __( 'Hover Animation', 'ultimate' ),
				'type'     => Controls_Manager::HOVER_ANIMATION,
				'selector' => '{{WRAPPER}} :hover .roadmap__event__icon',
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

		// Title Typography
		$this->add_group_control(
			Group_Control_Typography:: get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .roadmap__event__title',
			]
		);

		// Title Color
		$this->add_control(
			'title_text_color',
			[
				'label'     => __( 'Color', 'ultimate' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .roadmap__event__title' => 'color: {{VALUE}};',
				],
			]
		);

		// Title Margin
		$this->add_responsive_control(
			'title_margin',
			[
				'label'      => __( 'Margin', 'ultimate' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .roadmap__event__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		// Box Hover Title Color
		$this->add_control(
			'box_hover_title_color',
			[
				'label'     => __( 'Box Hover Color', 'ultimate' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} :hover .roadmap__event__title' => 'color: {{VALUE}};',
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
			DATE STYLE
		-----------------------------*/
		$this->start_controls_section(
			'date_style_section',
			[
				'label' => __( 'Date', 'ultimate' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'date_tab_style' );
		$this->start_controls_tab(
			'date_normal_tab',
			[
				'label' => __( 'Normal', 'ultimate' ),
			]
		);

		// Date Typography
		$this->add_group_control(
			Group_Control_Typography:: get_type(),
			[
				'name'     => 'date_typography',
				'selector' => '{{WRAPPER}} .roadmap__event__date',
			]
		);

		// Title Color
		$this->add_control(
			'date_text_color',
			[
				'label'     => __( 'Color', 'ultimate' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .roadmap__event__date' => 'color: {{VALUE}};',
				],
			]
		);
		
		// Title Margin
		$this->add_responsive_control(
			'date_margin',
			[
				'label'      => __( 'Margin', 'ultimate' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .roadmap__event__date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'date_hover_tab',
			[
				'label' => __( 'Hover', 'ultimate' ),
			]
		);

		// Box Hover Title Color
		$this->add_control(
			'box_hover_date_color',
			[
				'label'     => __( 'Box Hover Color', 'ultimate' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} :hover .roadmap__event__date' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*----------------------------
			DATE STYLE END
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

		$this->start_controls_tabs( 'box_tab_style' );
		$this->start_controls_tab(
			'box_normal_tab',
			[
				'label' => __( 'Normal', 'ultimate' ),
			]
		);

			// Box Color
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
						'{{WRAPPER}} .single__roadmap__event' => 'color: {{VALUE}}',
					],
				]
			);

			// Box Typography
			$this->add_group_control(
				Group_Control_Typography:: get_type(),
				[
					'name'     => 'typography',
					'selector' => '{{WRAPPER}} .single__roadmap__event',
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'box_background',
					'label' => __( 'Background', 'ultimate' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .single__roadmap__event',
				]
			);

			// Box Align
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
						'{{WRAPPER}} .single__roadmap__event' => 'text-align: {{VALUE}};',
					],
				]
			);

			// Box Border
			$this->add_group_control(
				Group_Control_Border:: get_type(),
				[
					'name'     => 'box_border',
					'label'    => __( 'Border', 'ultimate' ),
					'selector' => '{{WRAPPER}} .single__roadmap__event',
				]
			);

			// Box Radius
			$this->add_control(
				'box_radius',
				[
					'label'      => __( 'Border Radius', 'ultimate' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .single__roadmap__event' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			
			// Box Shadow
			$this->add_group_control(
				Group_Control_Box_Shadow:: get_type(),
				[
					'name'     => 'box_shadow',
					'selector' => '{{WRAPPER}} .single__roadmap__event',
				]
			);

			// Box Transition
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
						'{{WRAPPER}} .single__roadmap__event' => 'transition: {{SIZE}}s;',
					],
				]
			);

			// Postion
			$this->add_responsive_control(
				'box_position',
				[
					'label'   => __( 'Position', 'ultimate' ),
					'type'    => Controls_Manager::SELECT,					
					'options' => [
						'initial'  => __( 'Initial', 'ultimate' ),
						'absolute' => __( 'Absulute', 'ultimate' ),
						'relative' => __( 'Relative', 'ultimate' ),
						'static'   => __( 'Static', 'ultimate' ),
					],
					'selectors' => [
						'{{WRAPPER}} .single__roadmap__event' => 'position: {{VALUE}};',
					],
				]
			);

			// BOX Margin
			$this->add_responsive_control(
				'box_margin',
				[
					'label'      => __( 'Margin', 'ultimate' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .single__roadmap__event' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			// BOX Padding
			$this->add_responsive_control(
				'box_padding',
				[
					'label'      => __( 'Padding', 'ultimate' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .single__roadmap__event' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'box_hover_tab',
			[
				'label' => __( 'Hover', 'ultimate' ),
			]
		);

			// Hover Color
			$this->add_control(
				'hover_box_color',
				[
					'label'  => __( 'Color', 'ultimate' ),
					'type'   => Controls_Manager::COLOR,
					'scheme' => [
						'type'  => \Elementor\Core\Schemes\Color::get_type(),
						'value' => \Elementor\Core\Schemes\Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .single__roadmap__event:hover' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'hover_box_background',
					'label' => __( 'Background', 'ultimate' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .single__roadmap__event:hover',
				]
			);

			// Box Border
			$this->add_group_control(
				Group_Control_Border:: get_type(),
				[
					'name'     => 'hover_box_border',
					'label'    => __( 'Border', 'ultimate' ),
					'selector' => '{{WRAPPER}} .single__roadmap__event:hover',
				]
			);

			// Box Radius
			$this->add_control(
				'hover_box_radius',
				[
					'label'      => __( 'Border Radius', 'ultimate' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .single__roadmap__event:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			
			// Box Shadow
			$this->add_group_control(
				Group_Control_Box_Shadow:: get_type(),
				[
					'name'     => 'hover_box_shadow',
					'selector' => '{{WRAPPER}} .single__roadmap__event:hover',
				]
			);

			// Transform
			$this->add_responsive_control(
				'hover_box_transform',
				[
					'label'      => __( 'Transform Vartically', 'ultimate' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range'      => [
						'px' => [
							'min'  => -100,
							'max'  => 100,
							'step' => 1,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 0,
					],
					'selectors' => [
						'{{WRAPPER}} .single__roadmap__event:hover' => 'transform: translateY({{SIZE}}{{UNIT}});',
					],
				]
			);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*----------------------------
			BOX STYLE END
		-----------------------------*/
	}
	
	protected function render() {

		$settings = $this->get_settings_for_display();

		$timeline_content_array = array();
		if ( $settings['timeline_content'] ) {
			foreach ($settings['timeline_content'] as $timeline ) {
				$single_content = array();

				if ( !empty($timeline['icon']) ) {
					$single_content['icon'] ='<i class="'.$timeline['icon'].'"></i>';
				}else{
					$single_content['icon'] = '';
				}

				if ( !empty($timeline['title']) ) {
					$single_content['title'] = $timeline['title'];
				}else{
					$single_content['title'] = '';
				}

				if ( !empty($timeline['date']) ) {
					$single_content['date'] = $timeline['date'];
				}else{
					$single_content['date'] = '';
				}

				if ( !empty($timeline['description']) ) {
					$single_content['content'] = $timeline['description'];
				}else{
					$single_content['content'] = '';
				}
				$timeline_content_array[] = $single_content;
			}
		}
		$random_id = rand(2545,6546);
		$options = array(
			'random_id'      => $random_id,
			'eventsPerSlide' => $settings['timeline_per_slide']['size'],
			'slide'          => $settings['slide']['size'],
			'prevArrow'      => '<i class="'.$settings['prev_icon'].'"></i>',
			'nextArrow'      => '<i class="'.$settings['next_icon'].'"></i>',
			'orientation'    => $settings['orientation'],
			'content'        => $timeline_content_array
		);

		$this->add_render_attribute( 'timeline_style_attr', 'id', 'ultimate__roadmap__timeline__'.$random_id );
		$this->add_render_attribute( 'timeline_style_attr', 'class', 'ultimate__roadmap__activation' );

		$this->add_render_attribute( 'timeline_style_attr', 'class', 'single__roadmap__timeline' );
		$this->add_render_attribute( 'timeline_style_attr', 'data-settings', wp_json_encode( $options ) );

		echo'<div '.$this->get_render_attribute_string('timeline_style_attr').'></div>';
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Ultimate_Timeline_Roadmap_Widget() );