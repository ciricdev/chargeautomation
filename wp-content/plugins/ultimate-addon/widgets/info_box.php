<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Ultimate_Info_Box_Widget extends Widget_Base {

    public function get_name() {
        return 'Ultimate_Info_Box_Widget';
    }
    
    public function get_title() {
        return __( 'Info Box', 'ultimate' );
    }

    public function get_icon() {
        return 'eicon-toggle';
    }

    public function get_categories() {
        return [ 'ultimate-addons' ];
    }

    public function ultimate_infobox_style(){
        return [
            'ultimate__infobox__style__1' => __( 'Style One', 'ultimate' ),
            'ultimate__infobox__style__2' => __( 'Style Two', 'ultimate' ),
            'ultimate__infobox__style__3' => __( 'Style Three', 'ultimate' ),
            'custom'                      => __( 'Custom Style', 'ultimate' ),
        ];
    }

    protected function _register_controls() {
        /*--------------------------
            CONTENT SECTION
        ---------------------------*/
        $this->start_controls_section(
            'infob_box_content_section',
            [
                'label' => __( 'Infobox Content & Style', 'ultimate' ),
            ]
        );
            $this->add_control(
                'info_box_style',
                [
                    'label'   => __( 'Infobox Style', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'ultimate__infobox__style__1',
                    'options' => $this->ultimate_infobox_style(),
                ]
            );
            $this->add_control(
                'title', [
                    'label'       => __( 'Header Title', 'ultimate' ),
                    'type'        => Controls_Manager::TEXT,
                    'default'     => __( 'My Title' , 'ultimate' ),
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
                    'show_icon',
                    [
                        'label'        => __( 'Show Icon', 'ultimate' ),
                        'type'         => Controls_Manager::SWITCHER,
                        'label_on'     => __( 'Show', 'ultimate' ),
                        'label_off'    => __( 'Hide', 'ultimate' ),
                        'return_value' => 'yes',
                        'default'      => 'no',
                        'separator'    => 'before',
                    ]
                );
                $repeater->add_control(
                    'list_icon',
                    [
                        'label'     => __( 'Icon', 'ultimate' ),
                        'type'      => Controls_Manager::ICON,
                        'default'   => __( 'fa fa-check', 'ultimate' ),
                        'condition' => [
                            'show_icon' => 'yes',
                        ],
                    ]
                );
                $repeater->add_control(
                    'list_title', [
                        'label'       => __( 'Info Title', 'ultimate' ),
                        'type'        => Controls_Manager::TEXT,
                        'label_block' => true,
                        'separator'   => 'before',
                    ]
                );
                $repeater->add_control(
                    'list_content', [
                        'label'      => __( 'Info Content', 'ultimate' ),
                        'type'       => Controls_Manager::WYSIWYG,
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
                    'current_item_icon_heading',
                    [
                        'label' => __( 'Current Item Icon Style', 'ultimate' ),
                        'type'  => Controls_Manager::HEADING,
                    ]
                );
                $repeater->add_control(
                    'current_item_icon_color',
                    [
                        'label'     => __( 'Color', 'ultimate' ),
                        'type'      => Controls_Manager::COLOR,
                        'separator' => 'before',
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}} .info__box__icon' => 'color: {{VALUE}}'
                        ],
                    ]
                );
                $repeater->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'      => 'current_item_icon_background',
                        'label'     => __( 'Background', 'ultimate' ),
                        'types'     => [ 'classic', 'gradient' ],
                        'separator' => 'before',
                        'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}} .info__box__icon',
                    ]
                );
                $repeater->add_control(
                    'current_item_heading',
                    [
                        'label'     => __( 'Current Item Style', 'ultimate' ),
                        'type'      => Controls_Manager::HEADING,
                        'separator' => 'before',
                    ]
                );
                $repeater->add_control(
                    'current_item_title_color',
                    [
                        'label'     => __( 'Title Color', 'ultimate' ),
                        'type'      => Controls_Manager::COLOR,
                        'separator' => 'before',
                        'selectors' => [
                            '{{WRAPPER}} .single__info__box{{CURRENT_ITEM}} .info__title' => 'color: {{VALUE}}'
                        ],
                    ]
                );
                $repeater->add_control(
                    'current_item_color',
                    [
                        'label'     => __( 'Description Color', 'ultimate' ),
                        'type'      => Controls_Manager::COLOR,
                        'separator' => 'before',
                        'selectors' => [
                            '{{WRAPPER}} .single__info__box{{CURRENT_ITEM}} .info__details' => 'color: {{VALUE}}'
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
                        'selector'  => '{{WRAPPER}} .single__info__box{{CURRENT_ITEM}}',
                    ]
                );
                $repeater->add_group_control(
                    Group_Control_Border:: get_type(),
                    [
                        'name'      => 'current_item_border',
                        'label'     => __( 'Border', 'ultimate' ),
                        'separator' => 'before',
                        'selector'  => '{{WRAPPER}} .single__info__box{{CURRENT_ITEM}}',
                    ]
                );
                $repeater->add_responsive_control(
                    'wrapper_padding',
                    [
                        'label'      => __( 'Padding', 'ultimate' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors'  => [
                            '{{WRAPPER}} .single__info__box{{CURRENT_ITEM}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                            '{{WRAPPER}} .single__info__box{{CURRENT_ITEM}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'current_item_hover_icon_heading',
                    [
                        'label' => __( 'Current Item Hover Icon Style', 'ultimate' ),
                        'type'  => Controls_Manager::HEADING,
                    ]
                );
                $repeater->add_control(
                    'current_item_hover_icon_color',
                    [
                        'label'     => __( 'Color', 'ultimate' ),
                        'type'      => Controls_Manager::COLOR,
                        'separator' => 'before',
                        'selectors' => [
                            '{{WRAPPER}} .single__info__box{{CURRENT_ITEM}}:hover .info__box__icon' => 'color: {{VALUE}}'
                        ],
                    ]
                );
                $repeater->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'      => 'current_item_hover_icon_background',
                        'label'     => __( 'Background', 'ultimate' ),
                        'types'     => [ 'classic', 'gradient' ],
                        'separator' => 'before',
                        'selector'  => '{{WRAPPER}} .single__info__box{{CURRENT_ITEM}}:hover .info__box__icon',
                    ]
                );
                $repeater->add_control(
                    'current_item_hover_heading',
                    [
                        'label'     => __( 'Current Item Hover Style', 'ultimate' ),
                        'type'      => Controls_Manager::HEADING,
                        'separator' => 'before',
                    ]
                );
                $repeater->add_control(
                    'current_item_hover_title_color',
                    [
                        'label'     => __( 'Title Color', 'ultimate' ),
                        'type'      => Controls_Manager::COLOR,
                        'separator' => 'before',
                        'selectors' => [
                            '{{WRAPPER}} .single__info__box{{CURRENT_ITEM}}:hover .info__title' => 'color: {{VALUE}}'
                        ],
                    ]
                );
                $repeater->add_control(
                    'current_item_hover_color',
                    [
                        'label'     => __( 'Description Color', 'ultimate' ),
                        'type'      => Controls_Manager::COLOR,
                        'separator' => 'before',
                        'selectors' => [
                            '{{WRAPPER}} .single__info__box{{CURRENT_ITEM}}:hover .info__details' => 'color: {{VALUE}}'
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
                        'selector'  => '{{WRAPPER}} .single__info__box{{CURRENT_ITEM}}:hover',
                    ]
                );
                $repeater->add_group_control(
                    Group_Control_Border:: get_type(),
                    [
                        'name'      => 'current_item_hover_border',
                        'label'     => __( 'Border', 'ultimate' ),
                        'separator' => 'before',
                        'selector'  => '{{WRAPPER}} .single__info__box{{CURRENT_ITEM}}:hover',
                    ]
                );
            $repeater->end_controls_tab();
            $repeater->end_controls_tabs();
            $this->add_control(
                'list_content',
                [
                    'label'   => __( 'Add Info Boxes', 'ultimate' ),
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => $repeater->get_controls(),
                    'default' => [
                        [
                            'list_title'   => __( 'PHONE:', 'ultimate' ),
                            'list_content' => __( '+88 01744 430 440', 'ultimate' ),
                        ],
                        [
                            'list_title'   => __( 'EMAIL:', 'ultimate' ),
                            'list_content' => __( 'mehedidb@gmail.com', 'ultimate' ),
                        ],
                        [
                            'list_title'   => __( 'LOCATION:', 'ultimate' ),
                            'list_content' => __( '44 Canal Center Plaza #200 Alexandria, VA 22314, USA', 'ultimate' ),
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
                'label' => __( 'Infobox Wrapper', 'ultimate' ),
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
                    'selector' => '{{WRAPPER}} .info__box__header__title h3',
                ]
            );
            $this->add_control(
                'header_title_color',
                [
                    'label'     => __( 'Color', 'ultimate' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} .info__box__header__title h3' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'header_title_background',
                    'label'    => __( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .info__box__header__title h3',
                ]
            );
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'header_title_border',
                    'label'    => __( 'Border', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .info__box__header__title h3',
                ]
            );
            $this->add_responsive_control(
                'header_title_radius',
                [
                    'label'      => __( 'Border Radius', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .info__box__header__title h3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'header_title_shadow',
                    'selector' => '{{WRAPPER}} .info__box__header__title h3',
                ]
            );
            $this->add_responsive_control(
                'header_title_margin',
                [
                    'label'      => __( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .info__box__header__title h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .info__box__header__title h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .info__box__header__title h3' => 'text-align: {{VALUE}};',
                    ],
                ]
            );
        $this->end_controls_section();
        /*----------------------------
            HEADER TITLE END
        -----------------------------*/

        /*----------------------------
            IOCN STYLE
        -----------------------------*/
        $this->start_controls_section(
            'icon_style_section',
            [
                'label' => __( 'Icon', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs( 'icon_tabs_style' );
                $this->start_controls_tab(
                    'icon_normal_tab',
                    [
                        'label' => __( 'Normal', 'ultimate' ),
                    ]
                );
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
                                '{{WRAPPER}} .info__box__icon' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
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
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .info__box__icon' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                            'separator' => 'after',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'icon_typography',
                            'selector' => '{{WRAPPER}} .info__box__icon',
                        ]
                    );
                    $this->add_control(
                        'icon_color',
                        [
                            'label'     => __( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .info__box__icon' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'icon_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .info__box__icon',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'icon_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .info__box__icon',
                        ]
                    );
                    $this->add_responsive_control(
                        'icon_radius',
                        [
                            'label'      => __( 'Border Radius', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .info__box__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'icon_shadow',
                            'selector' => '{{WRAPPER}} .info__box__icon',
                        ]
                    );
                    $this->add_responsive_control(
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
                                '{{WRAPPER}} .info__box__icon' => 'text-align: {{VALUE}};',
                            ],
                        ]
                    );
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
                                '{{WRAPPER}} .info__box__icon' => 'display: {{VALUE}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
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
                                '{{WRAPPER}} .info__box__icon' => 'position: {{VALUE}};',
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
                                '{{WRAPPER}} .info__box__icon' => 'left: {{SIZE}}{{UNIT}};',
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
                                '{{WRAPPER}} .info__box__icon' => 'right: {{SIZE}}{{UNIT}};',
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
                                '{{WRAPPER}} .info__box__icon' => 'top: {{SIZE}}{{UNIT}};',
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
                                '{{WRAPPER}} .info__box__icon' => 'bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'icon_position' => ['absolute','relative']
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'icon_margin',
                        [
                            'label'      => __( 'Margin', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .info__box__icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'icon_padding',
                        [
                            'label'      => __( 'Padding', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .info__box__icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                '{{WRAPPER}} .info__box__icon' => 'transition: {{SIZE}}s;',
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
                    $this->add_control(
                        'hover_icon_color',
                        [
                            'label'     => __( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .single__info__box:hover .info__box__icon' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'hover_icon_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .single__info__box:hover .info__box__icon',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'hover_icon_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .single__info__box:hover .info__box__icon',
                        ]
                    );
                    $this->add_responsive_control(
                        'hover_icon_radius',
                        [
                            'label'      => __( 'Border Radius', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__info__box:hover .info__box__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'hover_icon_shadow',
                            'selector' => '{{WRAPPER}} .single__info__box:hover .info__box__icon',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*----------------------------
            IOCN STYLE END
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
            $this->start_controls_tabs( 'title_tabs_style' );
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
                            'selector' => '{{WRAPPER}} .single__info__box .info__title',
                        ]
                    );
                    $this->add_control(
                        'title_color',
                        [
                            'label'     => __( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .single__info__box .info__title' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'title_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .single__info__box .info__title',
                        ]
                    );
                    $this->add_responsive_control(
                        'title_margin',
                        [
                            'label'      => __( 'Margin', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__info__box .info__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'title_padding',
                        [
                            'label'      => __( 'Padding', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__info__box .info__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                            'label'     => __( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .single__info__box:hover .info__title' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'hover_title_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .single__info__box:hover .info__title',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*----------------------------
            TITLE STYLE END
        -----------------------------*/

        /*------------------------
			BOX STYLE
        -------------------------*/
        $this->start_controls_section(
            'box_style_section',
            [
                'label' => __( 'Single Info Box', 'ultimate' ),
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
                            'selector' => '{{WRAPPER}} .single__info__box',
                        ]
                    );
                    $this->add_control(
                        'box_color',
                        [
                            'label'     => __( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .single__info__box .info__details' => 'color: {{VALUE}};',
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
                            'selector' => '{{WRAPPER}} .single__info__box',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'box_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .single__info__box',
                        ]
                    );
                    $this->add_responsive_control(
                        'box_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .single__info__box' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator' => 'after',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'      => 'box_box_shadow',
                            'label'     => __( 'Box Shadow', 'ultimate' ),
                            'selector'  => '{{WRAPPER}} .single__info__box',
                            'separator' => 'before',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Text_Shadow:: get_type(),
                        [
                            'name'     => 'box_text_shadow',
                            'label'    => __( 'Text Shadow', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .single__info__box',
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
                                '{{WRAPPER}} .single__info__box' => 'width: {{SIZE}}{{UNIT}};',
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
                                '{{WRAPPER}} .single__info__box' => 'height: {{SIZE}}{{UNIT}};',
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
                                '{{WRAPPER}} .single__info__box' => 'position: {{VALUE}};',
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
                                '{{WRAPPER}} .single__info__box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                '{{WRAPPER}} .single__info__box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                '{{WRAPPER}} .single__info__box' => 'transition: {{SIZE}}s;',
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
                                '{{WRAPPER}} .single__info__box:hover' => 'color: {{VALUE}};',
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
                            'selector' => '{{WRAPPER}} .single__info__box:hover',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'box_hover_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .single__info__box:hover',
                        ]
                    );
                    $this->add_responsive_control(
                        'box_hover_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .single__info__box:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
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
                    <div class = "info__box__header__title">
                        <h3><?php echo esc_html( $settings['title'] ); ?></h3>
                    </div>
                <?php endif; ?>
                <?php if( !empty( $settings['list_content'] ) ): ?>
                    <div class = "info__box__list">
                        <?php foreach ( $settings['list_content'] as $content ): ?>
                            <?php
                                $icon = $list_title = $list_content = '';
                                if ( !empty( $content['list_icon'] ) && $content['show_icon'] == true ) {
                                    $icon = $content['list_icon'];
                                }
                                if ( !empty( $content['list_title'] ) ) {
                                    $list_title = $content['list_title'];
                                }
                                if ( !empty( $content['list_content'] ) ) {
                                    $list_content = $content['list_content'];
                                }
                            ?>
                            <div class="single__info__box elementor-repeater-item-<?php echo $content['_id']; ?>">
                                <?php if( $icon ): ?>
                                    <div class="info__box__icon">
                                        <i class="<?php echo esc_attr( $icon ); ?>"></i>
                                    </div>
                                <?php endif; ?>
                                <?php if ( !empty( $list_title || $list_content ) ) :?>
                                    <?php if( $list_title ) : ?>
                                        <div class="info__title"><?php echo esc_html( $list_title ); ?></div>
                                    <?php endif; ?>
                                    <?php if( $list_content ) : ?>
                                        <div class="info__details"><?php echo wpautop( $list_content ); ?></div>
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
Plugin::instance()->widgets_manager->register_widget_type( new Ultimate_Info_Box_Widget() );