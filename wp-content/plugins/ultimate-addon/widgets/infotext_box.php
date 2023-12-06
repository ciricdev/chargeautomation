<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Ultimate_Infotext_Box_Widget extends Widget_Base {

    public function get_name() {
        return 'Ultimate_Infotext_Box_Widget';
    }
    
    public function get_title() {
        return __( 'Info Text Box', 'ultimate' );
    }

    public function get_icon() {
        return 'eicon-info-circle-o';
    }

    public function get_categories() {
        return [ 'ultimate-addons' ];
    }

    public function ultimate_infotext_box_style(){
        return [
            'infotex_box__style__1' => __( 'Style One', 'ultimate' ),
            'infotex_box__style__2' => __( 'Style Two', 'ultimate' ),
            'infotex_box__style__3' => __( 'Style Three', 'ultimate' ),
            'custom'                => __( 'Custom Style', 'ultimate' ),
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
                    'label'   => __( 'Info Textbox Style', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'infotex_box__style__1',
                    'options' => $this->ultimate_infotext_box_style(),
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
            $this->add_control(
                'info_content', [
                    'label'      => __( 'Info Content', 'ultimate' ),
                    'type'       => Controls_Manager::WYSIWYG,
                    'label_block' => true,
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
                    'selector' => '{{WRAPPER}} .infotext__header__title h3',
                ]
            );
            $this->add_control(
                'header_title_color',
                [
                    'label'     => __( 'Color', 'ultimate' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} .infotext__header__title h3' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'header_title_background',
                    'label'    => __( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .infotext__header__title h3',
                ]
            );
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'header_title_border',
                    'label'    => __( 'Border', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .infotext__header__title h3',
                ]
            );
            $this->add_responsive_control(
                'header_title_radius',
                [
                    'label'      => __( 'Border Radius', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .infotext__header__title h3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'header_title_shadow',
                    'selector' => '{{WRAPPER}} .infotext__header__title h3',
                ]
            );
            $this->add_responsive_control(
                'header_title_margin',
                [
                    'label'      => __( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .infotext__header__title h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .infotext__header__title h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .infotext__header__title h3' => 'text-align: {{VALUE}};',
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
                'label' => __( 'Details Box', 'ultimate' ),
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
                            'selector' => '{{WRAPPER}} .single__infotext__box',
                        ]
                    );
                    $this->add_control(
                        'box_color',
                        [
                            'label'     => __( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .single__infotext__box' => 'color: {{VALUE}};',
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
                            'selector' => '{{WRAPPER}} .single__infotext__box',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'box_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .single__infotext__box',
                        ]
                    );
                    $this->add_responsive_control(
                        'box_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .single__infotext__box' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator' => 'after',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'      => 'box_box_shadow',
                            'label'     => __( 'Box Shadow', 'ultimate' ),
                            'selector'  => '{{WRAPPER}} .single__infotext__box',
                            'separator' => 'before',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Text_Shadow:: get_type(),
                        [
                            'name'     => 'box_text_shadow',
                            'label'    => __( 'Text Shadow', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .single__infotext__box',
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
                                '{{WRAPPER}} .single__infotext__box' => 'width: {{SIZE}}{{UNIT}};',
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
                                '{{WRAPPER}} .single__infotext__box' => 'height: {{SIZE}}{{UNIT}};',
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
                                '{{WRAPPER}} .single__infotext__box' => 'position: {{VALUE}};',
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
                                '{{WRAPPER}} .single__infotext__box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                '{{WRAPPER}} .single__infotext__box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                '{{WRAPPER}} .single__infotext__box' => 'transition: {{SIZE}}s;',
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
                                '{{WRAPPER}} .single__infotext__box:hover' => 'color: {{VALUE}};',
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
                            'selector' => '{{WRAPPER}} .single__infotext__box:hover',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'box_hover_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .single__infotext__box:hover',
                        ]
                    );
                    $this->add_responsive_control(
                        'box_hover_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .single__infotext__box:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
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
        $this->add_render_attribute( 'ultimate_infotext_box_attr', 'class', 'ultimate__info__box__wrap' );
        $this->add_render_attribute( 'ultimate_infotext_box_attr', 'class', $settings['info_box_style'] );
        ?>
            <div <?php echo $this->get_render_attribute_string('ultimate_infotext_box_attr'); ?> >
            <?php if( !empty( $settings['title'] ) ): ?>
                <div class = "infotext__header__title">
                    <h3><?php echo esc_html( $settings['title'] ); ?></h3>
                </div>
            <?php endif; ?>
            <?php if( !empty( $settings['info_content'] ) ): ?>
                <div class="single__infotext__box">
                    <?php echo wpautop( $settings['info_content'] ); ?>
                </div>
            <?php endif; ?>
            </div>
        <?php
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new Ultimate_Infotext_Box_Widget() );