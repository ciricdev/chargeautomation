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
			'circliful',
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

		$this->add_control(
			'foreground_Color',
			[
				'label'   => __( 'Foreground Color', 'ultimate' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#ef296c',
			]
		);
		$this->add_control(
			'background_color',
			[
				'label'   => __( 'Background Color', 'ultimate' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#18bfc3',
				'separator'=>'before',
			]
		);
		$this->add_control(
			'fill_color',
			[
				'label'   => __( 'Fill Color', 'ultimate' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#ffd200',
				'separator'=>'before',
			]
		);
		$this->add_control(
			'point_color',
			[
				'label'   => __( 'Point Color', 'ultimate' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#182eff',
				'separator'=>'before',
			]
		);

		$this->add_control(
			'point_size',
			[
				'label'      => __( 'Point Size', 'ultimate' ),
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
					'size' => 28.5,
				],
				'separator'    => 'before',
			]
		);
		$this->add_control(
			'foreground_border_width',
			[
				'label'      => __( 'Foreground Border Bidth', 'ultimate' ),
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
		$this->add_control(
			'background_border_width',
			[
				'label'      => __( 'Background Border Bidth', 'ultimate' ),
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
		$this->add_control(
			'animation_step',
			[
				'label'      => __( 'Animation Step', 'ultimate' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 100,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
				'separator'    => 'before',
			]
		);
		$this->add_control(
			'half_circle',
			[
				'label'        => __( 'Half Circle ?', 'ultimate' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'ultimate' ),
				'label_off'    => __( 'No', 'ultimate' ),
				'return_value' => true,
				'default'      => false,
				'separator'    => 'before',
			]
		);
		$this->add_control(
			'animate_in_view',
			[
				'label'        => __( 'Animate In View ?', 'ultimate' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'ultimate' ),
				'label_off'    => __( 'No', 'ultimate' ),
				'return_value' => true,
				'default'      => false,
				'separator'    => 'before',
			]
		);
		$this->end_controls_section();

		/*--------------------------
			PERCENT TEXT
		----------------------------*/
		$this->start_controls_section(
			'section_counter_percent_text',
			[
				'label' => __( 'Percent Text', 'ultimate' ),
			]
		);
        $this->add_control(
            'percent_text_hidding',
            [
                'label'     => __( 'Percent Text', 'ultimate' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
		$this->add_control(
			'circle_percent',
			[
				'label'      => __( 'Percent', 'ultimate' ),
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
					'size' => 70,
				],
				'separator'=>'before',
			]
		);
		$this->add_control(
			'font_color',
			[
				'label'   => __( 'Font Color', 'ultimate' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#aaaaaa',
				'separator'=>'before',
			]
		);
		$this->add_control(
			'percentage_Y',
			[
				'label'      => __( 'Vertical Postion Text', 'ultimate' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 100,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'separator'    => 'before',
			]
		);
		$this->add_control(
			'percentage_X',
			[
				'label'      => __( 'Horizontal Postion Text', 'ultimate' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 100,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'separator'    => 'before',
			]
		);
		$this->add_control(
			'percentage_text_size',
			[
				'label'      => __( 'Percentage Text Size', 'ultimate' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 12,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 22,
				],
				'separator'    => 'before',
			]
		);
		$this->add_responsive_control(
		    'text_additional_css',
		    [
		        'label'     => __( 'Text Additional Css', 'ultimate' ),
		        'type'      => Controls_Manager::CODE,
		        'rows'      => 20,
		        'language'  => 'css',
		        'separator' => 'before',
		    ]
		);
		$this->end_controls_section();

		/*-------------------------
			TARGET PERCENT
		---------------------------*/
		$this->start_controls_section(
			'section_counter_target_percent',
			[
				'label' => __( 'Target Percent', 'ultimate' ),
			]
		);
        $this->add_control(
            'target_percent_hidding',
            [
                'label'     => __( 'Target Percent', 'ultimate' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
		$this->add_control(
			'target_percent',
			[
				'label'      => __( 'Target Percent', 'ultimate' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 5,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'separator'    => 'before',
			]
		);
		$this->add_control(
			'target_text_size',
			[
				'label'      => __( 'Target Text Size', 'ultimate' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 5,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 17,
				],
				'separator'    => 'before',
			]
		);
		$this->add_control(
			'target_color',
			[
				'label'   => __( 'Target Color', 'ultimate' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#2980B9',
				'separator'=>'before',
			]
		);
		$this->end_controls_section();

		/*-----------------------
			CIRCLE INFO TEXT
		-------------------------*/
		$this->start_controls_section(
			'section_counter_info_text',
			[
				'label' => __( 'Info Text', 'ultimate' ),
			]
		);
        $this->add_control(
            'text_hidding',
            [
                'label'     => __( 'Info Text', 'ultimate' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
		$this->add_control(
			'info_text',
			[
				'label'       => __( 'Info Text', 'ultimate' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'HTML', 'ultimate' ),
			]
		);
		$this->add_control(
			'text_color',
			[
				'label'   => __( 'Text Color', 'ultimate' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#666666',
				'separator'=>'before',
			]
		);
		$this->add_control(
			'text_Y',
			[
				'label'      => __( 'Info Text Vertical Postion', 'ultimate' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 100,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'separator'    => 'before',
			]
		);
		$this->add_control(
			'text_X',
			[
				'label'      => __( 'Info Text Horizontal Postion', 'ultimate' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 100,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
				],
				'separator'    => 'before',
			]
		);
		$this->add_control(
			'text_below',
			[
				'label'        => __( 'Show Text In Below ?', 'ultimate' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'ultimate' ),
				'label_off'    => __( 'No', 'ultimate' ),
				'return_value' => true,
				'default'      => false,
				'separator'    => 'before',
			]
		);
		$this->add_responsive_control(
		    'text_style',
		    [
		        'label'     => __( 'Text Css', 'ultimate' ),
		        'type'      => Controls_Manager::CODE,
		        'rows'      => 20,
		        'language'  => 'css',
		        'separator' => 'before',
		    ]
		);
		/*-------------------------
			MULTI LAYER CIRCLE
		---------------------------*/

		$this->end_controls_section();
		/*-------------------------
			CONTENT SECTION END
		---------------------------*/
        
        /*--------------------------
			STYLE SECTION
        ---------------------------*/
		$this->start_controls_section(
			'section_number',
			[
				'label' => __( 'Number', 'ultimate' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'number_color',
			[
				'label'  => __( 'Color', 'ultimate' ),
				'type'   => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} .time_circles > div > span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography:: get_type(),
			[
				'name'     => 'typography_number',
				'selector' => '{{WRAPPER}} .time_circles > div > span',
			]
		);

        $this->add_responsive_control(
            'number_margin',
            [
                'label'      => __( 'Margin', 'ultimate' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .time_circles > div > span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title',
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
					'{{WRAPPER}} .time_circles > div > h4' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography:: get_type(),
			[
				'name'     => 'typography_title',
				'selector' => '{{WRAPPER}} .time_circles > div > h4',
			]
		);
        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __( 'Margin', 'ultimate' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .time_circles > div > h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
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
			'class' => 'ultimate__circle__counter',
		] );

		$random_id = rand(5655,5874);

        $counter_options = [
			'random_id'               => $random_id,
			'foreground_color'        => $settings['foreground_color'],
			'background_color'        => $settings['background_color'],
			'fill_color'              => $settings['fill_color'],
			'point_color'             => $settings['point_color'],
			'point_size'              => $settings['point_size']['size'],
			'foreground_border_width' => $settings['foreground_border_width']['size'],
			'background_border_width' => $settings['background_border_width']['size'],
			'circle_animation'        => $settings['circle_animation'] ? $settings['circle_animation'] : 0,
			'animation_step'          => $settings['animation_step']['size'],
			'half_circle'             => $settings['half_circle'] ? $settings['half_circle'] : false,
			'animate_in_view'         => $settings['animate_in_view'] ? $settings['animate_in_view'] : false,
			'circle_percent'          => $settings['circle_percent']['size'],
			'font_color'              => $settings['font_color'],
			'percentage_Y'            => $settings['percentage_Y']['size'],
			'percentage_X'            => $settings['percentage_X']['size'],
			'percentage_text_size'    => $settings['percentage_text_size']['size'],
			'text_additional_css'     => $settings['text_additional_css'],
			'target_percent'          => $settings['target_percent']['size'],
			'target_text_size'        => $settings['target_text_size']['size'],
			'target_color'            => $settings['target_color'],
			'info_text'               => $settings['info_text'],
			'text_color'              => $settings['text_color'],
			'text_Y'                  => $settings['text_Y']['size'],
			'text_X'                  => $settings['text_X']['size'],
			'text_below'              => $settings['text_below'] ? $settings['text_below'] : false,
			'text_style'              => $settings['text_style'],
        ];

        $this->add_render_attribute( 'counter_circle_wrap_attr', 'data-settings', wp_json_encode( $counter_options ) );
		?>

		<div <?php echo $this->get_render_attribute_string('counter_circle_wrap_attr'); ?>>
			<div id="ultimate__circle__counter__item__<?php echo esc_attr( $random_id ); ?>" class="svg-container"></div>
		</div>
	<?php 
	} 
}