<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor counter widget.
 *
 * Elementor widget that displays stats and numbers in an escalating manner.
 *
 * @since 1.0.0
 */
class Ultimate_Counter_Circle_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve counter widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Ultimate_Counter_Circle_Widget';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve counter widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Circle Counter', 'ultimate' );
	}
        
	public function get_categories() {
		return [ 'ultimate-addons' ];
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve counter widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-counter-circle';
	}

	/**
	 * Retrieve the list of scripts the counter widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 
			'svg-progress',
			'ultimate-core',
		];
	}

	/**
	 * Register counter widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_counter',
			[
				'label' => __( 'Counter', 'ultimate' ),
			]
		);
		$this->add_responsive_control(
			'figure_display',
			[
				'label'   => __( 'Progress Type', 'ultimate' ),
				'type'    => Controls_Manager::SELECT,			
				'options' => [
					'circle'   => __( 'Circle', 'ultimate' ),
					'hexagon'  => __( 'Hexagon', 'ultimate' ),
					'rhomb'    => __( 'Rhomb', 'ultimate' ),
					'rect'     => __( 'Rect', 'ultimate' ),
					'triangle' => __( 'Triangle', 'ultimate' ),
					'pentagon' => __( 'Pentagon', 'ultimate' ),
				],
				'default' => 'circle',
				'separator'    => 'before',
			]
		);
		$this->add_control(
			'end_fill',
			[
				'label'      => __( 'Count Percentage', 'ultimate' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'separator'    => 'before',
			]
		);
		$this->add_control(
			'unit_output_text',
			[
				'label'       => __( 'Suffix Unit Text', 'ultimate' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( '% , KmH, Km, HP', 'ultimate' ),
			]
		);
		$this->add_control(
			'unit_progress_title',
			[
				'label'       => __( 'Title Text', 'ultimate' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Super Speed', 'ultimate' ),
			]
		);
		$this->add_control(
			'main_background',
			[
				'label'   => __( 'Background Color', 'ultimate' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'separator'=>'before',
			]
		);
		$this->add_control(
			'fill_color',
			[
				'label'   => __( 'Fill Color', 'ultimate' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#f2f2f2',
				'separator'=>'before',
			]
		);
		$this->add_control(
			'empty_fill_opacity',
			[
				'label'      => __( 'Fill Opacity', 'ultimate' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size'  => 0.3,
				],
				'separator'    => 'before',
			]
		);
		$this->add_control(
			'progress_fill_color',
			[
				'label'   => __( 'Progress Fill Color', 'ultimate' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#182eff',
				'separator'=>'before',
			]
		);
		$this->add_control(
			'progress_width',
			[
				'label'      => __( 'Progress Width', 'ultimate' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 50,
						'step' => 0.5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'separator'    => 'before',
			]
		);
		$this->add_control(
			'animation_duration',
			[
				'label'      => __( 'Animation Duration', 'ultimate' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 30,
						'step' => 0.5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'separator'    => 'before',
			]
		);
		$this->add_responsive_control(
			'progress_wrap_width',
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
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .ultimate__progress__item' => 'width: {{SIZE}}{{UNIT}};',
				],
				'separator'    => 'before',
			]
		);
		$this->add_responsive_control(
			'progress_wrap_height',
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
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .ultimate__progress__item' => 'height: {{SIZE}}{{UNIT}};',
				],
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'circle_animation',
			[
				'label'        => __( 'Animation ?', 'ultimate' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'ultimate' ),
				'label_off'    => __( 'No', 'ultimate' ),
				'return_value' => 1,
				'default'      => 1,
				'separator'    => 'before',
			]
		);
		$this->end_controls_section();
		/*-------------------------
			CONTENT SECTION END
		---------------------------*/

		/*---------------------------
			CENTER 
		----------------------------*/
		$this->start_controls_section(
			'process_text_section_style',
			[
				'label' => __( 'Progress Text', 'ultimate' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_group_control(
				Group_Control_Typography:: get_type(),
				[
					'name'      => 'progress_text_typography',
					'selector'  => '{{WRAPPER}} .svg-progress-output',
				]
			);
			$this->add_control(
				'progress_text_color',
				[
					'label'     => __( 'Color', 'ultimate' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .svg-progress-output' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background:: get_type(),
				[
					'name'     => 'progress_text_background',
					'label'    => __( 'Background', 'ultimate' ),
					'types'    => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .svg-progress-output',
				]
			);
			$this->add_group_control(
				Group_Control_Border:: get_type(),
				[
					'name'     => 'progress_text_border',
					'label'    => __( 'Border', 'ultimate' ),
					'selector' => '{{WRAPPER}} .svg-progress-output',
				]
			);
			$this->add_responsive_control(
				'progress_text_radius',
				[
					'label'      => __( 'Border Radius', 'ultimate' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .svg-progress-output' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow:: get_type(),
				[
					'name'     => 'progress_text_shadow',
					'selector' => '{{WRAPPER}} .svg-progress-output',
				]
			);
			$this->add_responsive_control(
				'progress_text_width',
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
						'{{WRAPPER}} .svg-progress-output' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'progress_text_height',
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
						'{{WRAPPER}} .svg-progress-output' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'progress_text_display',
				[
					'label'   => __( 'Display', 'ultimate' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'inline-block',
					'options' => [
						'initial'      => __( 'Initial', 'ultimate' ),
						'block'        => __( 'Block', 'ultimate' ),
						'inline-block' => __( 'Inline Block', 'ultimate' ),
						'flex'         => __( 'Flex', 'ultimate' ),
						'inline-flex'  => __( 'Inline Flex', 'ultimate' ),
						'none'         => __( 'none', 'ultimate' ),
					],
					'selectors' => [
						'{{WRAPPER}} .svg-progress-output' => 'display: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'progress_text_position',
				[
					'label'   => __( 'Position', 'ultimate' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'absolute',
					'options' => [
						'initial'  => __( 'Initial', 'ultimate' ),
						'absolute' => __( 'Absulute', 'ultimate' ),
						'relative' => __( 'Relative', 'ultimate' ),
						'static'   => __( 'Static', 'ultimate' ),
					],
					'selectors' => [
						'{{WRAPPER}} .svg-progress-output' => 'position: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'progress_text_position_from_left',
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
						'{{WRAPPER}} .svg-progress-output' => 'left: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'progress_text_position!' => ['initial','static']
					],
				]
			);
			$this->add_responsive_control(
				'progress_text_position_from_right',
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
						'{{WRAPPER}} .svg-progress-output' => 'right: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'progress_text_position!' => ['initial','static']
					],
				]
			);
			$this->add_responsive_control(
				'progress_text_position_from_top',
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
						'{{WRAPPER}} .svg-progress-output' => 'top: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'progress_text_position!' => ['initial','static']
					],
				]
			);
			$this->add_responsive_control(
				'progress_text_position_from_bottom',
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
						'{{WRAPPER}} .svg-progress-output' => 'bottom: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'progress_text_position!' => ['initial','static']
					],
				]
			);
			$this->add_responsive_control(
				'progress_text_align',
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
						'{{WRAPPER}} .svg-progress-output' => 'text-align: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'progress_text_opacity',
				[
					'label'      => __( 'Opacity', 'ultimate' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 1,
							'step' => 0.1,
						],
					],
					'default' => [
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .svg-progress-output,{{WRAPPER}} .svg-progress-output img' => 'opacity: {{SIZE}};',
					],
				]
			);
			$this->add_responsive_control(
				'progress_text_margin',
				[
					'label'      => __( 'Margin', 'ultimate' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .svg-progress-output' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'progress_text_padding',
				[
					'label'      => __( 'Padding', 'ultimate' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .svg-progress-output' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();

		/*---------------------------
			SUFFIX TEXT STYLE
		----------------------------*/
		$this->start_controls_section(
			'suffix_unit_section_style',
			[
				'label' => __( 'Unit Suffix', 'ultimate' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'suffix_unit_color',
			[
				'label'  => __( 'Color', 'ultimate' ),
				'type'   => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} .suffix__unit__text' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography:: get_type(),
			[
				'name'     => 'suffix_unit_typography',
				'selector' => '{{WRAPPER}} .suffix__unit__text',
			]
		);
        $this->add_responsive_control(
            'suffix_unit_margin',
            [
                'label'      => __( 'Margin', 'ultimate' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .suffix__unit__text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
		$this->end_controls_section();

		/*---------------------------
			TITLE STYLE
		----------------------------*/
		$this->start_controls_section(
			'title_section_style',
			[
				'label' => __( 'Title', 'ultimate' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label'  => __( 'Color', 'ultimate' ),
				'type'   => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} .process__counter__title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography:: get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .process__counter__title',
			]
		);
        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __( 'Margin', 'ultimate' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .process__counter__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
		$this->end_controls_section();

        /*--------------------------
			STYLE SECTION
        ---------------------------*/
		$this->start_controls_section(
			'box_section_style',
			[
				'label' => __( 'Box', 'ultimate' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'box_color',
			[
				'label'  => __( 'Color', 'ultimate' ),
				'type'   => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} .ultimate__progress__counter' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography:: get_type(),
			[
				'name'     => 'box_typography',
				'selector' => '{{WRAPPER}} .ultimate__progress__counter',
			]
		);
        $this->add_responsive_control(
            'box_margin',
            [
                'label'      => __( 'Margin', 'ultimate' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .ultimate__progress__counter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
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
					'{{WRAPPER}} .ultimate__progress__counter' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Render counter widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'counter_circle_wrap_attr', [
			'class' => 'ultimate__progress__counter',
		] );

		$random_id = rand(5655,5874);

        $counter_options = [
			'random_id'           => $random_id,
			'figure_display'      => $settings['figure_display'],
			'end_fill'            => $settings['end_fill']['size'],
			'unit_output_text'    => $settings['unit_output_text'],
			'main_background'     => $settings['main_background'],
			'fill_color'          => $settings['fill_color'],
			'progress_fill_color' => $settings['progress_fill_color'],
			'progress_width'      => $settings['progress_width']['size'],
			'empty_fill_opacity'  => $settings['empty_fill_opacity']['size'],
			'animation_duration'  => $settings['animation_duration']['size'],
        ];
        $this->add_render_attribute( 'counter_circle_wrap_attr', 'data-settings', wp_json_encode( $counter_options ) );
		?>

		<div <?php echo $this->get_render_attribute_string('counter_circle_wrap_attr'); ?>>
			<div id="ultimate__progress__counter__<?php echo esc_attr( $random_id ); ?>" class="ultimate__progress__item">
				<span class="svg-progress-output"></span>
			</div>
			<?php if( !empty($settings['unit_progress_title']) ): ?>
			<h3 class="process__counter__title"><?php echo esc_html( $settings['unit_progress_title'] ); ?></h3>
			<?php endif; ?>
		</div>
	<?php 
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new Ultimate_Counter_Circle_Widget() );