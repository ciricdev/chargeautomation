<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Ultimate_Social_Widget extends Widget_Base {

    public function get_name() {
        return 'Ultimate_Social_Widget';
    }
    
    public function get_title() {
        return __( 'Social Buttons', 'ultimate' );
    }

    public function get_icon() {
        return 'eicon-social-icons';
    }
    public function get_categories() {
        return [ 'ultimate-addons' ];
    }

    protected function _register_controls() {
        /*----------------------------
            CONTENT SECTION
        -----------------------------*/
        $this->start_controls_section(
            'social_media_sheres',
            [
                'label' => __( 'Social Shere', 'ultimate' ),
            ]
        );
            $this->add_control(
                'social_view',
                [
                    'label'       => esc_html__( 'Social Icon Style', 'ultimate' ),
                    'type'        => Controls_Manager::SELECT,
                    'label_block' => false,
                    'options'     => [
                        'icon'       => 'Icon',
                        'title'      => 'Title',
                        'icon-title' => 'Icon & Title',
                    ],
                    'default'      => 'icon',
                ]
            );
            $repeater = new Repeater();
            $repeater->start_controls_tabs('social_content_area_tabs');

                $repeater->start_controls_tab(
                    'social_content_tab',
                    [
                        'label' => __( 'Content', 'ultimate' ),
                    ]
                );
                    $repeater->add_control(
                        'ultimate_social_icon',
                        [
                            'label'   => esc_html__( 'Icon', 'ultimate' ),
                            'type'    => Controls_Manager::ICON,
                            'default' => 'fa fa-twitter',
                        ]
                    );
                    $repeater->add_control(
                        'ultimate_social_link',
                        [
                            'label'         => esc_html__( 'Url', 'ultimate' ),
                            'type'          => Controls_Manager::URL,
                            'show_external' => true,
                            'default' => [
                                'url' => '#',
                            ],
                        ]
                    );
                    $repeater->add_control(
                        'ultimate_social_title',
                        [
                            'label'   => esc_html__( 'Title', 'ultimate' ),
                            'type'    => Controls_Manager::TEXT,
                            'default' => esc_html__( 'Twitter', 'ultimate' ),
                        ]
                    );
                $repeater->end_controls_tab();
                $repeater->start_controls_tab(
                    'social_rep_style',
                    [
                        'label' => __( 'Style', 'ultimate' ),
                    ]
                );
                    $repeater->add_control(
                        'normal_style_heading',
                        [
                            'label'     => __( 'Normal Style', 'ultimate' ),
                            'type'      => Controls_Manager::HEADING,
                            'separator' => 'before',
                        ]
                    );
                    $repeater->add_control(
                        'social_text_color',
                        [
                            'label'     => __( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ultimate__socials__buttons {{CURRENT_ITEM}} a' => 'color: {{VALUE}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $repeater->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'     => 'social_rep_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .ultimate__socials__buttons {{CURRENT_ITEM}} a',
                        ]
                    );
                    $repeater->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'social_rep_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .ultimate__socials__buttons {{CURRENT_ITEM}} a',
                        ]
                    );
                    $repeater->add_control(
                        'hover_style_heading',
                        [
                            'label' => __( 'Hover Style', 'ultimate' ),
                            'type'  => Controls_Manager::HEADING,
                            'separator' => 'before',
                        ]
                    );
                    $repeater->add_control(
                        'social_text_hover_color',
                        [
                            'label'     => __( 'Hover color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ultimate__socials__buttons {{CURRENT_ITEM}} a:hover' => 'color: {{VALUE}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $repeater->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'     => 'social_rep_hover_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .ultimate__socials__buttons {{CURRENT_ITEM}} a:hover',
                        ]
                    );
                    $repeater->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'social_rep_hover_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .ultimate__socials__buttons {{CURRENT_ITEM}} a:hover',
                        ]
                    );
                $repeater->end_controls_tab();
                $repeater->start_controls_tab(
                    'social_rep_icon_style',
                    [
                        'label' => __( 'Icon Style', 'ultimate' ),
                    ]
                );
                    $repeater->add_control(
                        'normal_style_icon_heading',
                        [
                            'label'     => __( 'Normal Style', 'ultimate' ),
                            'type'      => Controls_Manager::HEADING,
                            'separator' => 'before',
                        ]
                    );
                    $repeater->add_control(
                        'social_icon_color',
                        [
                            'label'     => __( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ultimate__socials__buttons {{CURRENT_ITEM}} a i' => 'color: {{VALUE}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $repeater->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'     => 'social_rep_icon_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .ultimate__socials__buttons {{CURRENT_ITEM}} a i',
                        ]
                    );
                    $repeater->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'social_rep_icon_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .ultimate__socials__buttons {{CURRENT_ITEM}} a i',
                        ]
                    );
                    $repeater->add_responsive_control(
                        'social_rep_icon_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .ultimate__socials__buttons {{CURRENT_ITEM}} a i' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                    $repeater->add_control(
                        'hover_style_icon_heading',
                        [
                            'label' => __( 'Hover Style', 'ultimate' ),
                            'type'  => Controls_Manager::HEADING,
                            'separator' =>'before',
                        ]
                    );
                    $repeater->add_control(
                        'social_icon_hover_color',
                        [
                            'label'     => __( 'Hover color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ultimate__socials__buttons {{CURRENT_ITEM}} a:hover i' => 'color: {{VALUE}};',
                            ],
                            'separator' =>'before',
                        ]
                    );
                    $repeater->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'     => 'social_rep_icon_hover_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .ultimate__socials__buttons {{CURRENT_ITEM}} a:hover i',
                        ]
                    );
                    $repeater->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name'     => 'social_rep_icon_hover_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .ultimate__socials__buttons {{CURRENT_ITEM}} a:hover i',
                        ]
                    );
                $repeater->end_controls_tab();
            $repeater->end_controls_tabs();
            $this->add_control(
                'ultimate_socialmedia_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => array_values( $repeater->get_controls() ),
                    'default' => [
                        [
                            'ultimate_social_icon'  => 'fa fa-twitter',
                            'ultimate_social_title' => __( 'Twitter', 'ultimate' ),
                        ],
                    ],
                    'title_field' => '{{{ ultimate_social_title }}}',
                ]
            );
            $this->add_responsive_control(
                'social_wrap_align',
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
                        '{{WRAPPER}} .ultimate__socials__buttons ul' => 'text-align: {{VALUE}};',
                    ],
                ]
            );
        $this->end_controls_section();
        /*----------------------------
            CONTENT SECTION END
        -----------------------------*/

        /*----------------------------
            ICON STYLE
        -----------------------------*/
        $this->start_controls_section(
            'socialshere_icon_style_section',
            [
                'label'     => __( 'Icon', 'ultimate' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' =>[
                    'social_view' => array( 'icon-title','icon'),
                ]
            ]
        );
            $this->add_responsive_control(
                'icon_fontsize',
                [
                    'label'      => __( 'Icon Font Size', 'ultimate' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min'  => 0,
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
                        'size' => 20,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ultimate__socials__buttons ul li i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name'     => 'social_icon_background',
                    'label'    => __( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .ultimate__socials__buttons li i',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'social_icon_border',
                    'label'    => __( 'Border', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .ultimate__socials__buttons li i',
                ]
            );

            $this->add_responsive_control(
                'social_icon_radius',
                [
                    'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .ultimate__socials__buttons li i' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_height',
                [
                    'label'      => __( 'Icon Height', 'ultimate' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 100,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ultimate__socials__buttons ul li i' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'icon_width',
                [
                    'label'      => __( 'Icon Width', 'ultimate' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 100,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ultimate__socials__buttons ul li i' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            // Margin
            $this->add_responsive_control(
                'social_icon_margin',
                [
                    'label'      => __( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__socials__buttons ul li a i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // Padding
            $this->add_responsive_control(
                'social_icon_padding',
                [
                    'label'      => __( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__socials__buttons ul li a i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        /*----------------------------
            ICON STYLE END
        -----------------------------*/

        /*----------------------------
            ITEM STYLE
        -----------------------------*/
        $this->start_controls_section(
            'social_button_item_style_section',
            [
                'label' => __( 'Social Item', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs( 'social_button_tabs_style' );
                $this->start_controls_tab(
                    'social_button_normal_tab',
                    [
                        'label' => __( 'Normal', 'ultimate' ),
                    ]
                );

                    // Typgraphy
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'      => 'social_button_typography',
                            'selector'  => '{{WRAPPER}} .ultimate__socials__buttons ul li a',
                        ]
                    );

                    // Icon Color
                    $this->add_control(
                        'social_button_color',
                        [
                            'label'     => __( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .ultimate__socials__buttons ul li a' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    // Background
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'social_button_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .ultimate__socials__buttons ul li a:before',
                        ]
                    );

                    // Border
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'social_button_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .ultimate__socials__buttons ul li a',
                        ]
                    );

                    // Radius
                    $this->add_responsive_control(
                        'social_button_radius',
                        [
                            'label'      => __( 'Border Radius', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .ultimate__socials__buttons ul li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    
                    // Shadow
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'social_button_shadow',
                            'selector' => '{{WRAPPER}} .ultimate__socials__buttons ul li a',
                        ]
                    );
                    $this->add_responsive_control(
                        'social_button_display',
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
                            'default' => 'inline-block',
                            'selectors' => [
                                '{{WRAPPER}} .ultimate__socials__buttons ul li' => 'display: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'social_button_link_display',
                        [
                            'label'   => __( 'Link Display', 'ultimate' ),
                            'type'    => Controls_Manager::SELECT,          
                            'options' => [
                                'initial'      => __( 'Initial', 'ultimate' ),
                                'block'        => __( 'Block', 'ultimate' ),
                                'inline-block' => __( 'Inline Block', 'ultimate' ),
                                'flex'         => __( 'Flex', 'ultimate' ),
                                'inline-flex'  => __( 'Inline Flex', 'ultimate' ),
                                'none'         => __( 'none', 'ultimate' ),
                            ],
                            'default' => 'inline-block',
                            'selectors' => [
                                '{{WRAPPER}} .ultimate__socials__buttons ul li a' => 'display: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'social_button_width',
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
                                '{{WRAPPER}} .ultimate__socials__buttons ul li a' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    // Height
                    $this->add_responsive_control(
                        'social_button_height',
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
                                '{{WRAPPER}} .ultimate__socials__buttons ul li a' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    // Margin
                    $this->add_responsive_control(
                        'social_button_margin',
                        [
                            'label'      => __( 'Margin', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .ultimate__socials__buttons ul li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    // Padding
                    $this->add_responsive_control(
                        'social_button_padding',
                        [
                            'label'      => __( 'Padding', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .ultimate__socials__buttons ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    // Transition
                    $this->add_control(
                        'social_button_transition',
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
                                '{{WRAPPER}} .ultimate__socials__buttons ul li a,{{WRAPPER}} .ultimate__socials__buttons ul li a:before,{{WRAPPER}} .ultimate__socials__buttons ul li a:after' => 'transition: {{SIZE}}s;',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'social_button_align',
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
                                '{{WRAPPER}} .ultimate__socials__buttons ul li a' => 'text-align: {{VALUE}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();

                $this->start_controls_tab(
                    'social_button_hover_tab',
                    [
                        'label' => __( 'Hover', 'ultimate' ),
                    ]
                );

                    //Hover Color
                    $this->add_control(
                        'hover_social_button_color',
                        [
                            'label'     => __( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ultimate__socials__buttons ul li a:hover, {{WRAPPER}} .ultimate__socials__buttons ul li a:focus' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    // Hover Background
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'hover_social_button_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .ultimate__socials__buttons ul li a:after',
                        ]
                    );

                    // Border
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'hover_social_button_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .ultimate__socials__buttons ul li a:hover,{{WRAPPER}}.ultimate__socials__buttons ul li a:focus',
                        ]
                    );

                    // Radius
                    $this->add_responsive_control(
                        'hover_social_button_radius',
                        [
                            'label'      => __( 'Border Radius', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .ultimate__socials__buttons ul li a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    // Shadow
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'hover_social_button_shadow',
                            'selector' => '{{WRAPPER}} .ultimate__socials__buttons ul li a:hover',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*----------------------------
            ITEM STYLE END
        -----------------------------*/
    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'ultimate_socials_buttons_attr', 'class', 'ultimate__socials__buttons' );
        $this->add_render_attribute( 'ultimate_socials_buttons_attr', 'class', 'socials__buttons__style__1' );
        if( 'icon-title' == $settings['social_view'] || 'title' == $settings['social_view'] ){
            $this->add_render_attribute( 'ultimate_socials_buttons_attr', 'class', 'ultimate__socials__view__'.$settings['social_view'] );
        }
        ?>
            <div <?php echo $this->get_render_attribute_string( 'ultimate_socials_buttons_attr' ); ?> >
                <ul>
                    <?php foreach ( $settings['ultimate_socialmedia_list'] as $socialmedia ) :?>
                        <?php 
                            $attribute = array();
                            if ( ! empty( $socialmedia['ultimate_social_link']['url'] ) ) {
                                $attribute[] = 'href="'.$socialmedia['ultimate_social_link']['url'].'"';
                                if ( $socialmedia['ultimate_social_link']['is_external'] ) {
                                    $attribute[] = 'target="_blank"';
                                }
                                if ( $socialmedia['ultimate_social_link']['nofollow'] ) {
                                    $attribute[] = 'rel="nofollow"';
                                }
                            }
                        ?>
                        <li class="elementor-repeater-item-<?php echo $socialmedia['_id']; ?>">
                            <a <?php echo implode(' ', $attribute ); $attribute = array();?>>
                                <?php
                                    if( 'icon' == $settings['social_view'] ){
                                        echo sprintf('<i class="%1$s"></i>', $socialmedia['ultimate_social_icon'] );
                                    }elseif( 'title' == $settings['social_view'] ){
                                        echo sprintf('<span>%1$s</span>', $socialmedia['ultimate_social_title'] );
                                    }else{
                                        echo sprintf('<i class="%1$s"></i><span>%2$s</span>', $socialmedia['ultimate_social_icon'], $socialmedia['ultimate_social_title'] );
                                    }
                                ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new Ultimate_Social_Widget() );