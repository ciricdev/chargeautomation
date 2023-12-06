<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Ultimate_Contact_Form_Seven_Widget extends Widget_Base {

    public function get_name() {
        return 'Ultimate_Contact_Form_Seven_Widget';
    }
    
    public function get_title() {
        return __( 'Contact form 7', 'ultimate' );
    }

    public function get_icon() {
        return 'eicon-mail';
    }

    public function get_categories() {
        return [ 'ultimate-addons' ];
    }
    /**
     *  FORMS STYLE CLASS
     */
    public function form_layout(){
        return[
            '1' => __( 'Style One', 'ultimate' ),
            '2' => __( 'Style Two', 'ultimate' ),
            '3' => __( 'Style Three', 'ultimate' ),
        ];
    }

    protected function _register_controls() {
        /*--------------------------
            FORMS CONTENT
        ----------------------------*/
        $this->start_controls_section(
            'ultimate_contact_form_section',
            [
                'label' => __( 'Contact Form', 'ultimate' ),
            ]
        );
            $this->add_control(
                'ultimate_form_layout_style',
                [
                    'label'   => __( 'Style', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '1',
                    'options' => $this->form_layout(),
                ]
            );

            $this->add_control(
                'ultimate_contact_form_id',
                [
                    'label'   => __( 'Contact Form', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'options' => ultimate_get_contact_forms_seven_list(),
                ]
            );
        $this->end_controls_section();
        /*--------------------------
            FORMS CONTENT
        ---------------------------*/

        /*---------------------------
            WRAPPER STYLE
        ----------------------------*/
        $this->start_controls_section(
            'ultimate_form_style_section',
            [
                'label' => __( 'Wrapper Style', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'ultimate_form_section_background',
                    'label'    => __( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .ultimate__form__wrapper',
                ]
            );
            $this->add_responsive_control(
                'ultimate_form_section_padding',
                [
                    'label'      => __( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__form__wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'ultimate_form_section_margin',
                [
                    'label'      => __( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__form__wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'ultimate_form_section_align',
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
                            'title' => __( 'Justified', 'ultimate' ),
                            'icon'  => 'fa fa-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ultimate__form__wrapper' => 'text-align: {{VALUE}};',
                    ],
                    'separator' => 'before',
                ]
            );
        $this->end_controls_section();
        /*--------------------------
            WRAPPER STYLE END
        ----------------------------*/

        /*----------------------------
            LABEL STYLE
        ------------------------------*/
        $this->start_controls_section(
            'ultimate_form_label_style_section',
            [
                'label' => __( 'Label', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'label_typography',
                    'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .ultimate__form__wrapper form.wpcf7-form label',
                ]
            );
            $this->add_control(
                'label_text_color',
                [
                    'label'     => __( 'Text Color', 'ultimate' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .ultimate__form__wrapper form.wpcf7-form label' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'label_background',
                    'label'    => __( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .ultimate__form__wrapper form.wpcf7-form label',
                ]
            );
            $this->add_responsive_control(
                'label_width',
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
                        'unit' => '%',
                        'size' => 100
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ultimate__form__wrapper form.wpcf7-form label' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );            
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'label_border',
                    'label'    => __( 'Border', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .ultimate__form__wrapper form.wpcf7-form label',
                ]
            );
            $this->add_responsive_control(
                'label_border_radius',
                [
                    'label'     => __( 'Border Radius', 'ultimate' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .ultimate__form__wrapper form.wpcf7-form label' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'label_padding',
                [
                    'label'      => __( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__form__wrapper form.wpcf7-form label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'label_margin',
                [
                    'label'      => __( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__form__wrapper form.wpcf7-form label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
        $this->end_controls_section();
        /*---------------------------
            LABEL STYLE END
        -----------------------------*/

        /*---------------------------
            INPUT FIELD STYLE TAB START
        ----------------------------*/
        $this->start_controls_section(
            'ultimate_tform_input_style_section',
            [
                'label' => __( 'Input', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs( 'input_box_tabs' );
                $this->start_controls_tab(
                    'input_box_normal_tab',
                    [
                        'label' => __( 'Normal', 'ultimate' ),
                    ]
                );
                    $this->add_responsive_control(
                        'input_box_height',
                        [
                            'label'      => __( 'Height', 'ultimate' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range'      => [
                                'px' => [
                                    'max' => 150,
                                ],
                            ],
                            'default' => [
                                'size' => 55,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form input[type*="text"]'   => 'height:{{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="email"]'  => 'height:{{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="url"]'    => 'height:{{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="number"]' => 'height:{{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="tel"]'    => 'height:{{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="date"]'   => 'height:{{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-select'         => 'height:{{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'input_box_width',
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
                                'unit' => '%',
                                'size' => 100,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form input[type*="text"]'   => 'width:{{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="email"]'  => 'width:{{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="url"]'    => 'width:{{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="number"]' => 'width:{{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="tel"]'    => 'width:{{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="date"]'   => 'width:{{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-select'         => 'width:{{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'input_box_typography',
                            'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                            'selector' => '
                                {{WRAPPER}} .wpcf7-form input[type*="text"],
                                {{WRAPPER}} .wpcf7-form input[type*="email"],
                                {{WRAPPER}} .wpcf7-form input[type*="url"],
                                {{WRAPPER}} .wpcf7-form input[type*="number"],
                                {{WRAPPER}} .wpcf7-form input[type*="tel"],
                                {{WRAPPER}} .wpcf7-form input[type*="date"],
                                {{WRAPPER}} .wpcf7-form .wpcf7-select',
                        ]
                    );
                    $this->add_control(
                        'input_box_text_color',
                        [
                            'label'     => __( 'Text Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form input[type*="text"]'   => 'color:{{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="email"]'  => 'color:{{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="url"]'    => 'color:{{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="number"]' => 'color:{{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="tel"]'    => 'color:{{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="date"]'   => 'color:{{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-select'         => 'color:{{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'input_box_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '
                                {{WRAPPER}} .wpcf7-form input[type*="text"],
                                {{WRAPPER}} .wpcf7-form input[type*="email"],
                                {{WRAPPER}} .wpcf7-form input[type*="url"],
                                {{WRAPPER}} .wpcf7-form input[type*="number"],
                                {{WRAPPER}} .wpcf7-form input[type*="tel"],
                                {{WRAPPER}} .wpcf7-form input[type*="date"],
                                {{WRAPPER}} .wpcf7-form .wpcf7-select
                            ',
                        ]
                    );
                    $this->add_control(
                        'input_box_placeholder_color',
                        [
                            'label'     => __( 'Placeholder Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form input[type*="text"]::-webkit-input-placeholder'   => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="text"]::-moz-placeholder'            => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="text"]:-ms-input-placeholder'        => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="email"]::-webkit-input-placeholder'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="email"]::-moz-placeholder'           => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="email"]:-ms-input-placeholder'       => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="url"]::-webkit-input-placeholder'    => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="url"]::-moz-placeholder'             => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="url"]:-ms-input-placeholder'         => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="number"]::-webkit-input-placeholder' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="number"]::-moz-placeholder'          => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="number"]:-ms-input-placeholder'      => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="tel"]::-webkit-input-placeholder'    => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="tel"]::-moz-placeholder'             => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="tel"]:-ms-input-placeholder'         => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="date"]::-webkit-input-placeholder'   => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="date"]::-moz-placeholder'            => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="date"]:-ms-input-placeholder'        => 'color: {{VALUE}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-select'                                    => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'input_box_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '
                                {{WRAPPER}} .wpcf7-form input[type*="text"],
                                {{WRAPPER}} .wpcf7-form input[type*="email"],
                                {{WRAPPER}} .wpcf7-form input[type*="url"],
                                {{WRAPPER}} .wpcf7-form input[type*="number"],
                                {{WRAPPER}} .wpcf7-form input[type*="tel"],
                                {{WRAPPER}} .wpcf7-form input[type*="date"],
                                {{WRAPPER}} .wpcf7-form .wpcf7-select
                            ',
                        ]
                    );
                    $this->add_responsive_control(
                        'input_box_border_radius',
                        [
                            'label'     => __( 'Border Radius', 'ultimate' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form input[type*="text"]'   => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .wpcf7-form input[type*="email"]'  => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .wpcf7-form input[type*="url"]'    => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .wpcf7-form input[type*="number"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .wpcf7-form input[type*="tel"]'    => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .wpcf7-form input[type*="date"]'   => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-select'         => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'input_box_shadow',
                            'selector' => '
                                {{WRAPPER}} .wpcf7-form input[type*="text"],
                                {{WRAPPER}} .wpcf7-form input[type*="email"],
                                {{WRAPPER}} .wpcf7-form input[type*="url"],
                                {{WRAPPER}} .wpcf7-form input[type*="number"],
                                {{WRAPPER}} .wpcf7-form input[type*="tel"],
                                {{WRAPPER}} .wpcf7-form input[type*="date"],
                                {{WRAPPER}} .wpcf7-form .wpcf7-select
                            ',
                        ]
                    );
                    $this->add_responsive_control(
                        'input_box_padding',
                        [
                            'label'      => __( 'Padding', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .wpcf7-form input[type*="text"]'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="email"]'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="url"]'    => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="number"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="tel"]'    => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="date"]'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-select'         => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'input_box_margin',
                        [
                            'label'      => __( 'Margin', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .wpcf7-form input[type*="text"]'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="email"]'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="url"]'    => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="number"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="tel"]'    => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form input[type*="date"]'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-select'         => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_control(
                        'input_box_transition',
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
                                '{{WRAPPER}} .wpcf7-form input[type*="text"]'   => 'transition: {{SIZE}}s;',
                                '{{WRAPPER}} .wpcf7-form input[type*="email"]'  => 'transition: {{SIZE}}s;',
                                '{{WRAPPER}} .wpcf7-form input[type*="url"]'    => 'transition: {{SIZE}}s;',
                                '{{WRAPPER}} .wpcf7-form input[type*="number"]' => 'transition: {{SIZE}}s;',
                                '{{WRAPPER}} .wpcf7-form input[type*="tel"]'    => 'transition: {{SIZE}}s;',
                                '{{WRAPPER}} .wpcf7-form input[type*="date"]'   => 'transition: {{SIZE}}s;',
                                '{{WRAPPER}} .wpcf7-form .wpcf7-select'         => 'transition: {{SIZE}}s;',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'input_box_hover_tabs',
                    [
                        'label' => __( 'Focus', 'ultimate' ),
                    ]
                );
                $this->add_control(
                    'input_box_hover_color',
                    [
                        'label'     => __( 'Text Color', 'ultimate' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .wpcf7-form input[type*="text"]:focus'   => 'color:{{VALUE}};',
                            '{{WRAPPER}} .wpcf7-form input[type*="email"]:focus'  => 'color:{{VALUE}};',
                            '{{WRAPPER}} .wpcf7-form input[type*="url"]:focus'    => 'color:{{VALUE}};',
                            '{{WRAPPER}} .wpcf7-form input[type*="number"]:focus' => 'color:{{VALUE}};',
                            '{{WRAPPER}} .wpcf7-form input[type*="tel"]:focus'    => 'color:{{VALUE}};',
                            '{{WRAPPER}} .wpcf7-form input[type*="date"]:focus'   => 'color:{{VALUE}};',
                            '{{WRAPPER}} .wpcf7-form .wpcf7-select:focus'         => 'color:{{VALUE}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'     => 'input_box_hover_backkground',
                        'label'    => __( 'Focus Background', 'ultimate' ),
                        'types'    => [ 'classic', 'gradient' ],
                        'selector' => '
                            {{WRAPPER}} .wpcf7-form input[type*="text"]:focus,
                            {{WRAPPER}} .wpcf7-form input[type*="email"]:focus,
                            {{WRAPPER}} .wpcf7-form input[type*="url"]:focus,
                            {{WRAPPER}} .wpcf7-form input[type*="number"]:focus,
                            {{WRAPPER}} .wpcf7-form input[type*="tel"]:focus,
                            {{WRAPPER}} .wpcf7-form input[type*="date"]:focus,
                            {{WRAPPER}} .wpcf7-form .wpcf7-select:focus
                        ',
                    ]
                );
                $this->add_control(
                    'input_box_hover_border_color',
                    [
                        'label'     => __( 'Border Color', 'ultimate' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .wpcf7-form input[type*="text"]:focus'   => 'border-color:{{VALUE}};',
                            '{{WRAPPER}} .wpcf7-form input[type*="email"]:focus'  => 'border-color:{{VALUE}};',
                            '{{WRAPPER}} .wpcf7-form input[type*="url"]:focus'    => 'border-color:{{VALUE}};',
                            '{{WRAPPER}} .wpcf7-form input[type*="number"]:focus' => 'border-color:{{VALUE}};',
                            '{{WRAPPER}} .wpcf7-form input[type*="tel"]:focus'    => 'border-color:{{VALUE}};',
                            '{{WRAPPER}} .wpcf7-form input[type*="date"]:focus'   => 'border-color:{{VALUE}};',
                            '{{WRAPPER}} .wpcf7-form .wpcf7-select:focus'         => 'border-color:{{VALUE}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow:: get_type(),
                    [
                        'name'     => 'input_box_hover_shadow',
                        'selector' => '
                            {{WRAPPER}} .wpcf7-form input[type*="text"]:focus,
                            {{WRAPPER}} .wpcf7-form input[type*="email"]:focus,
                            {{WRAPPER}} .wpcf7-form input[type*="url"]:focus,
                            {{WRAPPER}} .wpcf7-form input[type*="number"]:focus,
                            {{WRAPPER}} .wpcf7-form input[type*="tel"]:focus,
                            {{WRAPPER}} .wpcf7-form input[type*="date"]:focus,
                            {{WRAPPER}} .wpcf7-form .wpcf7-select:focus
                        ',
                    ]
                );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*-----------------------------
            INPUT STYLE END
        -------------------------------*/

        /*-----------------------------
            TEXTAREA STYLE
        -----------------------------*/
        $this->start_controls_section(
            'ultimate_form_textarea_style_section',
            [
                'label' => __( 'Textarea', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs( 'textarea_box_tabs' );
            $this->start_controls_tab(
                'textarea_box_normal_tab',
                [
                    'label' => __( 'Normal', 'ultimate' ),
                ]
            );
                $this->add_responsive_control(
                    'textarea_box_height',
                    [
                        'label'      => __( 'Height', 'ultimate' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => [ 'px' ],
                        'range'      => [
                            'px' => [
                                'max' => 500,
                            ],
                        ],
                        'default' => [
                            'size' => 150,
                        ],

                        'selectors' => [
                            '{{WRAPPER}} .wpcf7-form textarea' => 'height: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Typography:: get_type(),
                    [
                        'name'     => 'textarea_box_typography',
                        'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                        'selector' => '{{WRAPPER}} .wpcf7-form textarea',
                    ]
                );
                $this->add_control(
                    'textarea_box_text_color',
                    [
                        'label'     => __( 'Text Color', 'ultimate' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .wpcf7-form textarea' => 'color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_control(
                    'textarea_box_placeholder_color',
                    [
                        'label'     => __( 'Placeholder Color', 'ultimate' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .wpcf7-form textarea::-webkit-input-placeholder' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .wpcf7-form textarea::-moz-placeholder'          => 'color: {{VALUE}};',
                            '{{WRAPPER}} .wpcf7-form textarea:-ms-input-placeholder'      => 'color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'     => 'textarea_box_background',
                        'label'    => __( 'Background', 'ultimate' ),
                        'types'    => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .wpcf7-form textarea',
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border:: get_type(),
                    [
                        'name'     => 'textarea_box_border',
                        'label'    => __( 'Border', 'ultimate' ),
                        'selector' => '{{WRAPPER}} .wpcf7-form textarea',
                    ]
                );
                $this->add_responsive_control(
                    'textarea_box_border_radius',
                    [
                        'label'     => __( 'Border Radius', 'ultimate' ),
                        'type'      => Controls_Manager::DIMENSIONS,
                        'selectors' => [
                            '{{WRAPPER}} .wpcf7-form textarea' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        ],
                        'separator' => 'before',
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow:: get_type(),
                    [
                        'name'     => 'textarea_box_shadow',
                        'selector' => '{{WRAPPER}} .wpcf7-form textarea',
                    ]
                );
                $this->add_responsive_control(
                    'textarea_box_padding',
                    [
                        'label'      => __( 'Padding', 'ultimate' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors'  => [
                            '{{WRAPPER}} .wpcf7-form textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'separator' => 'before',
                    ]
                );
                $this->add_responsive_control(
                    'textarea_box_margin',
                    [
                        'label'      => __( 'Margin', 'ultimate' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors'  => [
                            '{{WRAPPER}} .wpcf7-form textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'separator' => 'before',
                    ]
                );
                $this->add_control(
                    'textarea_box_transition',
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
                            '{{WRAPPER}} .wpcf7-form textarea' => 'transition: {{SIZE}}s;',
                        ],
                    ]
                );
            $this->end_controls_tab();
            $this->start_controls_tab(
                'textarea_box_hover_tabs',
                [
                    'label' => __( 'Focus', 'ultimate' ),
                ]
            );
                $this->add_control(
                    'textarea_box_hover_color',
                    [
                        'label'     => __( 'Text Color', 'ultimate' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .wpcf7-form textarea:focus' => 'color:{{VALUE}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'     => 'textarea_box_hover_backkground',
                        'label'    => __( 'Focus Background', 'ultimate' ),
                        'types'    => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .wpcf7-form textarea:focus',
                    ]
                );
                $this->add_control(
                    'textarea_box_hover_border_color',
                    [
                        'label'     => __( 'Border Color', 'ultimate' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .wpcf7-form textarea:focus' => 'border-color:{{VALUE}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow:: get_type(),
                    [
                        'name'     => 'textarea_box_hover_shadow',
                        'selector' => '{{WRAPPER}} .wpcf7-form textarea:focus',
                    ]
                );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*----------------------------
            TEXTAREA STYLE END
        -----------------------------*/

        /*----------------------------
            BUTTONS TYLE
        ------------------------------*/
        $this->start_controls_section(
            'ultimate_input_submit_style_section',
            [
                'label' => __( 'Button', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs('submit_style_tabs');
                $this->start_controls_tab(
                    'submit_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'ultimate' ),
                    ]
                );
                    $this->add_responsive_control(
                        'input_submit_width',
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
                                'size' => 200,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-submit,{{WRAPPER}} button[type="submit"]' => 'width:{{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'input_submit_height',
                        [
                            'label'      => __( 'Height', 'ultimate' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range'      => [
                                'px' => [
                                    'max' => 150,
                                ],
                            ],
                            'default' => [
                                'size' => 55,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-submit,{{WRAPPER}} button[type="submit"]' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'input_submit_typography',
                            'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                            'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-submit,{{WRAPPER}} button[type="submit"]',
                        ]
                    );
                    $this->add_control(
                        'input_submit_text_color',
                        [
                            'label'     => __( 'Text Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-submit,{{WRAPPER}} button[type="submit"]' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'input_submit_background_color',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-submit,{{WRAPPER}} button[type="submit"]',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'input_submit_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-submit,{{WRAPPER}} button[type="submit"]',
                        ]
                    );
                    $this->add_responsive_control(
                        'input_submit_border_radius',
                        [
                            'label'     => __( 'Border Radius', 'ultimate' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-submit,{{WRAPPER}} button[type="submit"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'input_submit_box_shadow',
                            'label'    => __( 'Box Shadow', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-submit,{{WRAPPER}} button[type="submit"]',
                        ]
                    );
                    $this->add_responsive_control(
                        'input_submit_padding',
                        [
                            'label'      => __( 'Padding', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-submit,{{WRAPPER}} button[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'input_submit_margin',
                        [
                            'label'      => __( 'Margin', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-submit,{{WRAPPER}} button[type="submit"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_control(
                        'input_submit_transition',
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
                                '{{WRAPPER}} .wpcf7-form .wpcf7-submit, {{WRAPPER}} button[type="submit"]' => 'transition: {{SIZE}}s;',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'input_submit_floting',
                        [
                            'label'   => __( 'Button Floating', 'ultimate' ),
                            'type'    => Controls_Manager::CHOOSE,
                            'options' => [
                                'left' => [
                                    'title' => __( 'Left', 'ultimate' ),
                                    'icon'  => 'fa fa-align-left',
                                ],
                                'none' => [
                                    'title' => __( 'None', 'ultimate' ),
                                    'icon'  => 'fa fa-align-center',
                                ],
                                'right' => [
                                    'title' => __( 'Right', 'ultimate' ),
                                    'icon'  => 'fa fa-align-right',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-submit, {{WRAPPER}} button[type="submit"]' => 'float: {{VALUE}};',
                            ],
                            'default'   => 'none',
                            'separator' => 'before',
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'submit_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'ultimate' ),
                    ]
                );
                    $this->add_control(
                        'input_submithover_text_color',
                        [
                            'label'     => __( 'Text Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wpcf7-form .wpcf7-submit:hover,{{WRAPPER}} button[type="submit"]:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'input_submithover_background_color',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-submit:hover,{{WRAPPER}} button[type="submit"]:hover',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'input_submithover_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-submit:hover,{{WRAPPER}} button[type="submit"]:hover',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'input_submithover_shadow',
                            'label'    => __( 'Box Shadow', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .wpcf7-form .wpcf7-submit:hover,{{WRAPPER}} button[type="submit"]:hover',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*----------------------------
            BUTTONS TYLE END
        ------------------------------*/
    }

    protected function render( $instance = [] ) {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute( 'ultimate__form__area__attr', 'class', 'ultimate__form__wrapper' );
        $this->add_render_attribute( 'ultimate__form__area__attr', 'class', 'contact__form__style__'.$settings['ultimate_form_layout_style'] );
        ?>
            <div <?php echo $this->get_render_attribute_string( 'ultimate__form__area__attr' ); ?> >
                <?php
                    if( !empty($settings['ultimate_contact_form_id']) ){
                        echo do_shortcode( '[contact-form-7  id="'.$settings['ultimate_contact_form_id'].'"]' ); 
                    }else{
                        echo '<div class="form_no_select">' .__('Please Select contact form.','ultimate'). '</div>';
                    }
                ?>
            </div>
        <?php
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new Ultimate_Contact_Form_Seven_Widget() );