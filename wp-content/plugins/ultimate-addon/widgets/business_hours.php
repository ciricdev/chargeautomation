<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Ultimate_Business_Hours_Widget extends Widget_Base {

    public function get_name() {
        return 'Ultimate_Business_Hours_Widget';
    }
    
    public function get_title() {
        return __( 'Business Hours', 'ultimate' );
    }

    public function get_icon() {
        return 'eicon-clock-o';
    }

    public function get_categories() {
        return [ 'ultimate-addons' ];
    }

    public function ultimate_infobox_style(){
        return [
            'ultimate__business__hour__style__1' => __( 'Style One', 'ultimate' ),
            'ultimate__business__hour__style__2' => __( 'Style Two', 'ultimate' ),
            'ultimate__business__hour__style__3' => __( 'Style Three', 'ultimate' ),
            'custom'                             => __( 'Custom Style', 'ultimate' ),
        ];
    }

    protected function _register_controls() {
        /*--------------------------
            CONTENT SECTION
        ---------------------------*/
        $this->start_controls_section(
            'infob_box_content_section',
            [
                'label' => __( 'Business Hours Content & Style', 'ultimate' ),
            ]
        );
            $this->add_control(
                'info_box_style',
                [
                    'label'   => __( 'Business Hours Style', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'ultimate__business__hour__style__1',
                    'options' => $this->ultimate_infobox_style(),
                ]
            );
            $this->add_control(
                'title', [
                    'label'       => __( 'Header Title', 'ultimate' ),
                    'type'        => Controls_Manager::TEXT,
                    'default'     => __( 'Office Time' , 'ultimate' ),
                    'label_block' => true,
                    'separator'   => 'before',
                ]
            );
            $repeater = new Repeater();
            $repeater->start_controls_tabs(
                'ultimate_list_tabs'
            );
            $repeater->start_controls_tab(
                'list_content_tab',
                [
                    'label' => __( 'Content', 'ultimate' ),
                ]
            );
                $repeater->add_control(
                    'list_title', [
                        'label'       => __( 'Day Name', 'ultimate' ),
                        'type'        => Controls_Manager::TEXT,
                        'label_block' => true,
                        'separator'   => 'before',
                    ]
                );
                $repeater->add_control(
                    'list_content', [
                        'label'      => __( 'Opening Time', 'ultimate' ),
                        'type'       => Controls_Manager::TEXT,
                        'label_block' => true,
                        'separator'   => 'before',
                    ]
                );
            $repeater->end_controls_tab();
            $repeater->start_controls_tab(
                'list_style_tab',
                [
                    'label' => __( 'Style', 'ultimate' ),
                ]
            );
                $repeater->add_control(
                    'current_item_heading',
                    [
                        'label'     => __( 'Current Item Style', 'ultimate' ),
                        'type'      => Controls_Manager::HEADING,
                    ]
                );
                $repeater->add_control(
                    'current_item_title_color',
                    [
                        'label'     => __( 'Day Color', 'ultimate' ),
                        'type'      => Controls_Manager::COLOR,
                        'separator' => 'before',
                        'selectors' => [
                            '{{WRAPPER}} .single__business__hours{{CURRENT_ITEM}} .business__hour__day' => 'color: {{VALUE}}'
                        ],
                    ]
                );
                $repeater->add_control(
                    'current_item_color',
                    [
                        'label'     => __( 'Time Color', 'ultimate' ),
                        'type'      => Controls_Manager::COLOR,
                        'separator' => 'before',
                        'selectors' => [
                            '{{WRAPPER}} .single__business__hours{{CURRENT_ITEM}}' => 'color: {{VALUE}}'
                        ],
                    ]
                );
                $repeater->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'      => 'current_item_background',
                        'label'     => __( 'Background', 'ultimate' ),
                        'types'     => [ 'classic', 'gradient' ],
                        'separator' => 'before',
                        'selector'  => '{{WRAPPER}} .single__business__hours{{CURRENT_ITEM}}',
                    ]
                );
                $repeater->add_group_control(
                    Group_Control_Border:: get_type(),
                    [
                        'name'      => 'current_item_border',
                        'label'     => __( 'Border', 'ultimate' ),
                        'separator' => 'before',
                        'selector'  => '{{WRAPPER}} .single__business__hours{{CURRENT_ITEM}}',
                    ]
                );
                $repeater->add_responsive_control(
                    'wrapper_padding',
                    [
                        'label'      => __( 'Padding', 'ultimate' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors'  => [
                            '{{WRAPPER}} .single__business__hours{{CURRENT_ITEM}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                $repeater->add_responsive_control(
                    'wrapper_margin',
                    [
                        'label'      => __( 'Margin', 'ultimate' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors'  => [
                            '{{WRAPPER}} .single__business__hours{{CURRENT_ITEM}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
            $repeater->end_controls_tab();
            $repeater->start_controls_tab(
                'list_style_hover_tab',
                [
                    'label' => __( 'Hover', 'ultimate' ),
                ]
            );
                $repeater->add_control(
                    'current_item_hover_heading',
                    [
                        'label'     => __( 'Current Item Hover Style', 'ultimate' ),
                        'type'      => Controls_Manager::HEADING,
                    ]
                );
                $repeater->add_control(
                    'current_item_hover_title_color',
                    [
                        'label'     => __( 'Day Color', 'ultimate' ),
                        'type'      => Controls_Manager::COLOR,
                        'separator' => 'before',
                        'selectors' => [
                            '{{WRAPPER}} .single__business__hours{{CURRENT_ITEM}}:hover .business__hour__day' => 'color: {{VALUE}}'
                        ],
                    ]
                );
                $repeater->add_control(
                    'current_item_hover_color',
                    [
                        'label'     => __( 'Time Color', 'ultimate' ),
                        'type'      => Controls_Manager::COLOR,
                        'separator' => 'before',
                        'selectors' => [
                            '{{WRAPPER}} .single__business__hours{{CURRENT_ITEM}}:hover' => 'color: {{VALUE}}'
                        ],
                    ]
                );
                $repeater->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'      => 'current_item_hover_background',
                        'label'     => __( 'Background', 'ultimate' ),
                        'types'     => [ 'classic', 'gradient' ],
                        'separator' => 'before',
                        'selector'  => '{{WRAPPER}} .single__business__hours{{CURRENT_ITEM}}:hover',
                    ]
                );
                $repeater->add_group_control(
                    Group_Control_Border:: get_type(),
                    [
                        'name'      => 'current_item_hover_border',
                        'label'     => __( 'Border', 'ultimate' ),
                        'separator' => 'before',
                        'selector'  => '{{WRAPPER}} .single__business__hours{{CURRENT_ITEM}}:hover',
                    ]
                );
            $repeater->end_controls_tab();
            $repeater->end_controls_tabs();
            $this->add_control(
                'content_list',
                [
                    'label'   => __( 'Add Business Hours', 'ultimate' ),
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => $repeater->get_controls(),
                    'default' => [
                        [
                            'list_title' => __( 'Saturday', 'ultimate' ),
                            'list_content' => __( '10:00AM - 07:00PM', 'ultimate' ),
                        ],
                        [
                            'list_title' => __( 'Sunday', 'ultimate' ),
                            'list_content' => __( 'Closed', 'ultimate' ),
                        ],
                        [
                            'list_title' => __( 'Monday', 'ultimate' ),
                            'list_content' => __( '10:00AM - 07:00PM', 'ultimate' ),
                        ],
                        [
                            'list_title' => __( 'Tuesday', 'ultimate' ),
                            'list_content' => __( '10:00AM - 07:00PM', 'ultimate' ),
                        ],
                        [
                            'list_title' => __( 'Wednesday', 'ultimate' ),
                            'list_content' => __( '10:00AM - 07:00PM', 'ultimate' ),
                        ],
                        [
                            'list_title' => __( 'Thursday', 'ultimate' ),
                            'list_content' => __( '10:00AM - 07:00PM', 'ultimate' ),
                        ],
                        [
                            'list_title' => __( 'Friday', 'ultimate' ),
                            'list_content' => __( '10:00AM - 07:00PM', 'ultimate' ),
                        ],
                    ],
                    'title_field' => '{{{ list_title }}}',
                    'separator'   => 'before',
                ]
            );
        $this->end_controls_section();
        /*--------------------------
            CONTENT SECTION END
        ---------------------------*/

        /*--------------------------
            AREA STYLE
        ---------------------------*/
        $this->start_controls_section(
            'wrapper_style_section',
            [
                'label' => __( 'Wrapper', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'wrapper_background',
                    'label'    => __( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .ultimate__info__box__wrap',
                ]
            );
            $this->add_responsive_control(
                'wrapper_align',
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
                        '{{WRAPPER}} .ultimate__info__box__wrap' => 'text-align: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'wrapper_border',
                    'label'    => __( 'Border', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .ultimate__info__box__wrap',
                ]
            );
            $this->add_responsive_control(
                'wrapper_radius',
                [
                    'label'      => __( 'Border Radius', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__info__box__wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'wrapper_shadow',
                    'selector' => '{{WRAPPER}} .ultimate__info__box__wrap',
                ]
            );

            $this->add_responsive_control(
                'wrapper_padding',
                [
                    'label'      => __( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__info__box__wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'wrapper_margin',
                [
                    'label'      => __( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__info__box__wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        /*----------------------------
            AREA STYLE END
        -----------------------------*/

        /*----------------------------
            HEADER TITLE
        -----------------------------*/
        $this->start_controls_section(
            'header_title_style_section',
            [
                'label' => __( 'Header Title', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'header_title_typography',
                    'selector' => '{{WRAPPER}} .business__hour__header__title h3',
                ]
            );
            $this->add_control(
                'header_title_color',
                [
                    'label'     => __( 'Color', 'ultimate' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} .business__hour__header__title h3' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'header_title_background',
                    'label'    => __( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .business__hour__header__title h3',
                ]
            );
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'header_title_border',
                    'label'    => __( 'Border', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .business__hour__header__title h3',
                ]
            );
            $this->add_responsive_control(
                'header_title_radius',
                [
                    'label'      => __( 'Border Radius', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .business__hour__header__title h3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'header_title_shadow',
                    'selector' => '{{WRAPPER}} .business__hour__header__title h3',
                ]
            );
            $this->add_responsive_control(
                'header_title_margin',
                [
                    'label'      => __( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .business__hour__header__title h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'header_title_padding',
                [
                    'label'      => __( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .business__hour__header__title h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'header_title_align',
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
                        '{{WRAPPER}} .business__hour__header__title h3' => 'text-align: {{VALUE}};',
                    ],
                ]
            );
        $this->end_controls_section();
        /*----------------------------
            HEADER TITLE END
        -----------------------------*/

        /*------------------------
			BOX STYLE
        -------------------------*/
        $this->start_controls_section(
            'box_style_section',
            [
                'label' => __( 'Single Day Item', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs( 'box_style_tabs' );
                $this->start_controls_tab(
                    'box_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'ultimate' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'box_typography',
                            'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                            'selector' => '{{WRAPPER}} .single__business__hours',
                        ]
                    );
                    $this->add_control(
                        'box_color',
                        [
                            'label'     => __( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .single__business__hours' => 'color: {{VALUE}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'box_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .single__business__hours',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'box_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .single__business__hours',
                        ]
                    );
                    $this->add_responsive_control(
                        'box_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .single__business__hours' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator' => 'after',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'      => 'box_box_shadow',
                            'label'     => __( 'Box Shadow', 'ultimate' ),
                            'selector'  => '{{WRAPPER}} .single__business__hours',
                            'separator' => 'before',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Text_Shadow:: get_type(),
                        [
                            'name'     => 'box_text_shadow',
                            'label'    => __( 'Text Shadow', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .single__business__hours',
                        ]
                    );
                    $this->add_responsive_control(
                        'box_width',
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
                                '{{WRAPPER}} .single__business__hours' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'box_height',
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
                                '{{WRAPPER}} .single__business__hours' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
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
                                '{{WRAPPER}} .single__business__hours' => 'position: {{VALUE}};',
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
                                '{{WRAPPER}} .single__business__hours' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'box_padding',
                        [
                            'label'      => __( 'Padding', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__business__hours' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
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
                                'size' => 0.3,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__business__hours' => 'transition: {{SIZE}}s;',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'box_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'ultimate' ),
                    ]
                );
                    $this->add_control(
                        'box_hover_color',
                        [
                            'label'     => __( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .single__business__hours:hover' => 'color: {{VALUE}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'box_hover_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .single__business__hours:hover',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'box_hover_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .single__business__hours:hover',
                        ]
                    );
                    $this->add_responsive_control(
                        'box_hover_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .single__business__hours:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator' => 'after',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*-------------------------
			BOX STYLE END
        --------------------------*/
    }

    protected function render( $instance = [] ) {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute( 'ultimate_info_box_attr', 'class', 'ultimate__info__box__wrap' );
        $this->add_render_attribute( 'ultimate_info_box_attr', 'class', $settings['info_box_style'] );

        ?>
            <div <?php echo $this->get_render_attribute_string('ultimate_info_box_attr'); ?> >

                <?php if( !empty( $settings['title'] ) ): ?>
                    <div class = "business__hour__header__title">
                        <h3><?php echo esc_html( $settings['title'] ); ?></h3>
                    </div>
                <?php endif; ?>
                <?php if( !empty( $settings['content_list'] ) ): ?>
                    <div class = "business__hours__list">
                        <?php foreach ( $settings['content_list'] as $content ): ?>
                            <?php
                                $icon = $list_title = '';
                                if ( !empty( $content['list_title'] ) ) {
                                    $list_title = $content['list_title'];
                                }
                                if ( !empty( $content['list_content'] ) ) {
                                    $list_content = $content['list_content'];
                                }
                            ?>
                            <div class="single__business__hours elementor-repeater-item-<?php echo $content['_id']; ?>">
                                <?php if ( !empty( $list_title || $list_content ) ) :?>
                                    <?php if( $list_title ) : ?>
                                        <div class="business__hour__day"><?php echo esc_html( $list_title ); ?></div>
                                    <?php endif; ?>
                                    <?php if( $list_content ) : ?>
                                        <div class="business__hour__time"><?php echo esc_html( $list_content ); ?></div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new Ultimate_Business_Hours_Widget() );