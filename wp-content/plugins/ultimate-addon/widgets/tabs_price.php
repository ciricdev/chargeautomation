<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ){ 
    exit;
}

class Ultimate_Price_Tabs_Widget extends Widget_Base {

    public function get_name() {
        return 'Ultimate_Price_Tabs_Widget';
    }
    
    public function get_title() {
        return __( 'Price Tab', 'ultimate' );
    }

	public function get_icon() {
		return "eicon-tabs";
	}
    
	public function get_categories() {
		return [ 'ultimate-addons' ];
	}

    /*
     * Elementor Templates List
     * return array
     */
    public function ultimate_elementor_template() {
        $templates = Plugin::instance()->templates_manager->get_source( 'local' )->get_items();
        $types     = array();
        if ( empty( $templates ) ) {
            $template_lists = [ '0' => __( 'Do not Saved Templates.', 'ultimate' ) ];
        } else {
            $template_lists = [ '0' => __( 'Select Template', 'ultimate' ) ];
            foreach ( $templates as $template ) {
                $template_lists[ $template['template_id'] ] = $template['title'] . ' (' . $template['type'] . ')';
            }
        }
        return $template_lists;
    }

    public function ultimate_tab_style(){
        $tab_style = [
            '1' => __( 'Style 1', 'ultimate' ),
            '2' => __( 'Style 2', 'ultimate' ),
            '3' => __( 'Style 3', 'ultimate' ),
            '4' => __( 'Style 4', 'ultimate' ),
            '5' => __( 'Style 5', 'ultimate' ),
            '6' => __( 'Style 6', 'ultimate' ),
            '7' => __( 'Style 7', 'ultimate' ),
            '8' => __( 'Style 8', 'ultimate' ),
            '9' => __( 'Style 9', 'ultimate' ),
        ];
        return $tab_style;
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'tab_content',
            [
                'label' => __( 'Tabs', 'ultimate' ),
            ]
        );
            $this->add_control(
                'tab_style',
                [
                    'label'   => __( 'Tab Price Style', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '1',
                    'options' => $this->ultimate_tab_style(),
                ]
            );

            $repeater = new Repeater();
            $repeater->start_controls_tabs('tab_content_item_area_tabs');

                $repeater->start_controls_tab(
                    'tab_content_item_area',
                    [
                        'label' => __( 'Content', 'ultimate' ),
                    ]
                );
                    $repeater->add_control(
                        'set_default',
                        [
                        'label'        => __('Set as Default', 'ultimate'),
                        'type'         => Controls_Manager::SWITCHER,
                        'default'      => 'inactive',
                        'return_value' => 'active',
                        ]
                    );

                    $repeater->add_control(
                        'tab_title',
                        [
                            'label'   => esc_html__( 'Title', 'ultimate' ),
                            'type'    => Controls_Manager::TEXT,
                            'default' => esc_html__( 'Tab #1', 'ultimate' ),
                        ]
                    );

                    $repeater->add_control(
                        'tab_icon',
                        [
                            'label' => esc_html__( 'Icon', 'ultimate' ),
                            'type'  => Controls_Manager::ICON,
                        ]
                    );

                    $repeater->add_control(
                        'content_source',
                        [
                            'label'   => esc_html__( 'Select Content Source', 'ultimate' ),
                            'type'    => Controls_Manager::SELECT,
                            'default' => 'custom',
                            'options' => [
                                'custom'    => esc_html__( 'Content', 'ultimate' ),
                                "elementor" => esc_html__( 'Template', 'ultimate' ),
                            ],
                        ]
                    );

                     $repeater->add_control(
                        'template_id',
                        [
                            'label'     => __( 'Content', 'ultimate' ),
                            'type'      => Controls_Manager::SELECT,
                            'default'   => '0',
                            'options'   => $this->ultimate_elementor_template(),
                            'condition' => [
                                'content_source' => "elementor"
                            ],
                        ]
                    );

                     $repeater->add_control(
                        'custom_content',
                        [
                            'label'      => __( 'Content', 'ultimate' ),
                            'type'       => Controls_Manager::WYSIWYG,
                            'title'      => __( 'Content', 'ultimate' ),
                            'show_label' => false,
                            'condition'  => [
                                'content_source' => 'custom',
                            ],
                        ]
                    );

                $repeater->end_controls_tab();// Tab Content area end

                // Style area start
                $repeater->start_controls_tab(
                    'tab_item_style_area',
                    [
                        'label' => __( 'Style', 'ultimate' ),
                    ]
                );
                    
                    $repeater->add_control(
                        'tab_title_color',
                        [
                            'label'     => esc_html__( 'Title Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .tab__nav a{{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    
                    $repeater->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'title_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .tab__nav a{{CURRENT_ITEM}}',
                        ]
                    );

                    $repeater->add_control(
                        'tab_title_active_color',
                        [
                            'label'     => esc_html__( 'Title Active Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .tab__nav li.active a{{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $repeater->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'title_active_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .tab__nav li.active a{{CURRENT_ITEM}}',
                        ]
                    );

                    $repeater->add_control(
                        'tab_icon_color',
                        [
                            'label'     => esc_html__( 'Icon Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .tab__nav a{{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
                            ],
                            'condition' => [
                                'tab_icon!' => '',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $repeater->add_control(
                        'tab_icon_size',
                        [
                            'label' => __( 'Icon Size', 'ultimate' ),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'size' => 14,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .tab__nav a{{CURRENT_ITEM}} i' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $repeater->add_control(
                        'tab_icon_active_color',
                        [
                            'label'     => esc_html__( 'Active Icon Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .tab__nav li.active a{{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
                            ],
                            'condition' => [
                                'tab_icon!' => '',
                            ]
                        ]
                    );

                $repeater->end_controls_tab(); // Style area end

            $repeater->end_controls_tabs();

            $this->add_control(
                'tabs_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => array_values( $repeater->get_controls() ),
                    'default' => [
                        [
                            'tab_title'      => esc_html__( 'Yearly', 'ultimate' ),
                            'custom_content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolo magna aliqua. Ut enim ad minim veniam, quis nostrud exerci ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in repre in voluptate.','ultimate' ),
                        ],
                        [
                            'tab_title'      => esc_html__( 'Monthly', 'ultimate' ),
                            'custom_content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolo magna aliqua. Ut enim ad minim veniam, quis nostrud exerci ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in repre in voluptate.','ultimate' ),
                        ],
                    ],
                    'title_field' => '{{{ tab_title }}}',
                    'separator' =>  'before',
                ]
            );
            
        $this->end_controls_section();

        $this->start_controls_section(
            'tab_text_content_section',
            [
                'label' => __( 'Text Content', 'ultimate' ),
            ]
        );

            // Icon Toggle
            $this->add_control(
                'show_icon',
                [
                    'label'        => __( 'Show Icon ?', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'Show', 'ultimate' ),
                    'label_off'    => __( 'Hide', 'ultimate' ),
                    'return_value' => 'yes',
                    'default'      => 'no',
                    'separator' =>  'before',
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
                    'default'   => 'fa fa-star-o',
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

            // Title
            $this->add_control(
                'title',
                [
                    'label'       => __( 'Title', 'ultimate' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => __( 'Title', 'ultimate' ),
                    'separator' =>  'before',
                ]
            );

            // Title Tag
            $this->add_control(
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
            $this->add_control(
                'subtitle',
                [
                    'label'       => __( 'Subtitle', 'ultimate' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => __( 'Subtitle', 'ultimate' ),
                ]
            );

            // Subtitle Position
            $this->add_control(
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

            // Description
            $this->add_control(
                'description',
                [
                    'label'       => __( 'Description', 'ultimate' ),
                    'type'        => Controls_Manager::TEXTAREA,
                    'placeholder' => __( 'Description.', 'ultimate' ),
                    'separator' =>  'before',
                ]
            );
            
        $this->end_controls_section();
        
        // Style tab area tab section
        $this->start_controls_section(
            'ultimate_tab_style_area',
            [
                'label' => __( 'Tab Menu Wrap', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'ultimate_tab_section_display',
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
                        '{{WRAPPER}} .tab__nav' => 'display: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'menu_text_align',
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
                        ]
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .tab__nav' => 'text-align: {{VALUE}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'ultimate_tab_section_float',
                [
                    'label'   => __( 'Float', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'options' => [
                        'left'     => __( 'Left', 'ultimate' ),
                        'right'    => __( 'Right', 'ultimate' ),
                        'inherit ' => __( 'Inherit', 'ultimate' ),
                        'none'     => __( 'None', 'ultimate' ),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .tab__nav' => 'float: {{VALUE}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'ultimate_tab_section_margin',
                [
                    'label'      => __( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .tab__nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'ultimate_tab_section_padding',
                [
                    'label'      => __( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .tab__nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
        
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'ultimate_tab_section_bg',
                    'label'    => __( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .tab__nav',
                ]
            );
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'ultimate_tab_section_border',
                    'label'    => __( 'Border', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .tab__nav',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'ultimate_tab_section_shadow',
                    'label'    => __( 'Box Shadow', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .tab__nav',
                ]
            );
            $this->add_responsive_control(
                'ultimate_tab_section_width',
                [
                    'label'      => __( 'Width', 'ultimate' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'vw' ],
                    'range'      => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 9999,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .tab__nav' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'ultimate_tab_section_height',
                [
                    'label'      => __( 'Height', 'ultimate' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 9999,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .tab__nav' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        
            $this->add_responsive_control(
                'ultimate_tab_section_border_radius',
                [
                    'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .tab__nav' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'custom_area_css',
                [
                    'label'     => __( 'Custom CSS', 'ultimate' ),
                    'type'      => Controls_Manager::CODE,
                    'rows'      => 20,
                    'language'  => 'css',
                    'selectors' => [
                        '{{WRAPPER}} .tab__nav' => '{{VALUE}};',
                    ],
                    'separator' => 'before',
                ]
            );

        $this->end_controls_section();
        







        $this->start_controls_section(
            'tab_button_icon_style_section',
            [
                'label' => __( 'Tab Menu Icon', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs( 'tabs_button_icon_style' );
            $this->start_controls_tab(
                'tab_button_icon_normal',
                [
                    'label' => __( 'Normal', 'ultimate' ),
                ]
            );
                $this->add_responsive_control(
                    'tab_button_icon_display',
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
                            '{{WRAPPER}} .tab__nav li .tab__button__icon' => 'display: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_responsive_control(
                    'tab_button_icon_align',
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
                            ]
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .tab__nav li .tab__button__icon' => 'text-align: {{VALUE}};',
                        ],
                        'separator' => 'before',
                    ]
                );
                $this->add_group_control(
                    Group_Control_Typography:: get_type(),
                    [
                        'name'     => 'tab_button_icon_typography',
                        'selector' => '{{WRAPPER}} .tab__nav li .tab__button__icon',
                    ]
                );
                $this->add_control(
                    'tab_button_icon_color',
                    [
                        'label'     => __( 'Color', 'ultimate' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .tab__nav li .tab__button__icon' => 'color: {{VALUE}};',
                        ],
                    ]
                );                
                $this->add_responsive_control(
                    'tab_button_icon_width',
                    [
                        'label'      => __( 'Width', 'ultimate' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'vw' ],
                        'range'      => [
                            'px' => [
                                'min'  => 0,
                                'max'  => 9999,
                                'step' => 1,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .tab__nav li .tab__button__icon' => 'width: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_responsive_control(
                    'tab_button_icon_height',
                    [
                        'label'      => __( 'Height', 'ultimate' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'vw' ],
                        'range'      => [
                            'px' => [
                                'min'  => 0,
                                'max'  => 9999,
                                'step' => 1,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .tab__nav li .tab__button__icon' => 'width: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                
                $this->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'     => 'tab_button_icon_background',
                        'label'    => __( 'Background', 'ultimate' ),
                        'types'    => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .tab__nav li .tab__button__icon',
                    ]
                );
                
                $this->add_responsive_control(
                    'tab_button_icon_margin',
                    [
                        'label'      => __( 'Margin', 'ultimate' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} .tab__nav li .tab__button__icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'separator' => 'before',
                    ]
                );
                
                $this->add_responsive_control(
                    'tab_button_icon_padding',
                    [
                        'label'   => __( 'Padding', 'ultimate' ),
                        'type'    => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors'  => [
                            '{{WRAPPER}} .tab__nav li .tab__button__icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'separator' => 'before',
                    ]
                );   
                
                $this->add_group_control(
                    Group_Control_Border:: get_type(),
                    [
                        'name'     => 'tab_button_icon_border',
                        'selector' => '{{WRAPPER}} .tab__nav li .tab__button__icon',
                    ]
                );

                $this->add_control(
                    'tab_button_icon_radius',
                    [
                        'label'      => __( 'Border Radius', 'ultimate' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selectors' => [
                            '{{WRAPPER}} .tab__nav li .tab__button__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                
                $this->add_group_control(
                    Group_Control_Box_Shadow:: get_type(),
                    [
                        'name'     => 'tab_button_icon_box_shadow',
                        'selector' => '{{WRAPPER}} .tab__nav li .tab__button__icon',
                    ]
                );
                $this->add_responsive_control(
                    'tab_button_icon_custom_css',
                    [
                        'label'     => __( 'Custom CSS', 'ultimate' ),
                        'type'      => Controls_Manager::CODE,
                        'rows'      => 20,
                        'language'  => 'css',
                        'selectors' => [
                            '{{WRAPPER}} .tab__nav li .tab__button__icon' => '{{VALUE}};',
                        ],
                        'separator' => 'before',
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'tab_button_icon_hover',
                [
                    'label' => __( 'Hover', 'ultimate' ),
                ]
            );

                $this->add_control(
                    'tab_button_icon_hover_color',
                    [
                        'label'     => __( 'Color', 'ultimate' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .tab__nav li:hover .tab__button__icon, {{WRAPPER}} .tab__nav li.active .tab__button__icon' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'tab_button_icon_hover_background',
                    [
                        'label'     => __( 'Background Color', 'ultimate' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#f8f8f8',
                        'selectors' => [
                            '{{WRAPPER}} .tab__nav li:hover .tab__button__icon, {{WRAPPER}} .tab__nav li.active .tab__button__icon' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );
                
                $this->add_control(
                    'tab_button_icon_hover_border_color',
                    [
                        'label'     => __( 'Border Color', 'ultimate' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .tab__nav li:hover .tab__button__icon, {{WRAPPER}} .tab__nav li.active .tab__button__icon' => 'border-color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow:: get_type(),
                    [
                        'name'     => 'tab_button_icon_hover_box_shadow',
                        'selector' => '{{WRAPPER}} .tab__nav li:hover .tab__button__icon, {{WRAPPER}} .tab__nav li.active .tab__button__icon',
                    ]
                );
                $this->add_responsive_control(
                    'tab_button_icon_hover_custom_css',
                    [
                        'label'     => __( 'Custom CSS', 'ultimate' ),
                        'type'      => Controls_Manager::CODE,
                        'rows'      => 20,
                        'language'  => 'css',
                        'selectors' => [
                            '{{WRAPPER}} .tab__nav li:hover .tab__button__icon, {{WRAPPER}} .tab__nav li.active .tab__button__icon' => '{{VALUE}};',
                        ],
                        'separator' => 'before',
                    ]
                );

            $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'tab_button_style_section',
            [
                'label' => __( 'Tab Menu Item', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs( 'tabs_button_style' );
            $this->start_controls_tab(
                'tab_button_normal',
                [
                    'label' => __( 'Normal', 'ultimate' ),
                ]
            );
                $this->add_responsive_control(
                    'tab_button_display',
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
                            '{{WRAPPER}} .tab__nav li' => 'display: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_responsive_control(
                    'tab_button_text_align',
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
                            ]
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .tab__nav .tab__button' => 'text-align: {{VALUE}};',
                        ],
                        'separator' => 'before',
                    ]
                );
                $this->add_group_control(
                    Group_Control_Typography:: get_type(),
                    [
                        'name'     => 'tab_button_typography',
                        'selector' => '{{WRAPPER}} .tab__nav .tab__button',
                    ]
                );
                $this->add_control(
                    'tab_button_color',
                    [
                        'label'     => __( 'Color', 'ultimate' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .tab__nav .tab__button' => 'color: {{VALUE}};',
                        ],
                    ]
                );                
                $this->add_responsive_control(
                    'tab_button_width',
                    [
                        'label'      => __( 'Width', 'ultimate' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'vw' ],
                        'range'      => [
                            'px' => [
                                'min'  => 0,
                                'max'  => 9999,
                                'step' => 1,
                            ],
                            '%' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .tab__nav li' => 'width: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                
                $this->add_group_control(
                    Group_Control_Background:: get_type(),
                    [
                        'name'     => 'tab_button_background_color',
                        'label'    => __( 'Background', 'ultimate' ),
                        'types'    => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .tab__nav .tab__button',
                    ]
                );
                
                $this->add_responsive_control(
                    'tab_button_margin',
                    [
                        'label'      => __( 'Margin', 'ultimate' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} .tab__nav .tab__button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'separator' => 'before',
                    ]
                );
                
                $this->add_responsive_control(
                    'tab_button_padding',
                    [
                        'label'   => __( 'Padding', 'ultimate' ),
                        'type'    => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors'  => [
                            '{{WRAPPER}} .tab__nav .tab__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'separator' => 'before',
                    ]
                );   
                
                $this->add_group_control(
                    Group_Control_Border:: get_type(),
                    [
                        'name'     => 'tab_button_border',
                        'selector' => '{{WRAPPER}} .tab__nav .tab__button',
                    ]
                );

                $this->add_control(
                    'tab_button_radius',
                    [
                        'label'      => __( 'Border Radius', 'ultimate' ),
                        'type'       => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selectors' => [
                            '{{WRAPPER}} .tab__nav .tab__button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                
                $this->add_group_control(
                    Group_Control_Box_Shadow:: get_type(),
                    [
                        'name'     => 'tab_button_box_shadow',
                        'selector' => '{{WRAPPER}} .tab__nav .tab__button',
                    ]
                );
                $this->add_responsive_control(
                    'tab_button_custom_css',
                    [
                        'label'     => __( 'Custom CSS', 'ultimate' ),
                        'type'      => Controls_Manager::CODE,
                        'rows'      => 20,
                        'language'  => 'css',
                        'selectors' => [
                            '{{WRAPPER}} .tab__nav li' => '{{VALUE}};',
                        ],
                        'separator' => 'before',
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'tab_button_hover',
                [
                    'label' => __( 'Hover', 'ultimate' ),
                ]
            );

                $this->add_control(
                    'tab_button_hover_color',
                    [
                        'label'     => __( 'Color', 'ultimate' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .tab__nav .tab__button:hover, {{WRAPPER}} .tab__nav li.active .tab__button' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'tab_button_hover_background',
                    [
                        'label'     => __( 'Background Color', 'ultimate' ),
                        'type'      => Controls_Manager::COLOR,
                        'default'   => '#f8f8f8',
                        'selectors' => [
                            '{{WRAPPER}} .tab__nav .tab__button:hover, {{WRAPPER}} .tab__nav li.active .tab__button' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );
                
                $this->add_control(
                    'tab_button_hover_border_color',
                    [
                        'label'     => __( 'Border Color', 'ultimate' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .tab__nav .tab__button:hover, {{WRAPPER}} .tab__nav li.active .tab__button' => 'border-color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow:: get_type(),
                    [
                        'name'     => 'tab_button_hover_box_shadow',
                        'selector' => '{{WRAPPER}} .tab__nav .tab__button:hover, {{WRAPPER}} .tab__nav li.active .tab__button',
                    ]
                );
                $this->add_responsive_control(
                    'tab_button_hover_custom_css',
                    [
                        'label'     => __( 'Custom CSS', 'ultimate' ),
                        'type'      => Controls_Manager::CODE,
                        'rows'      => 20,
                        'language'  => 'css',
                        'selectors' => [
                            '{{WRAPPER}} .tab__nav li' => '{{VALUE}};',
                        ],
                        'separator' => 'before',
                    ]
                );

            $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();        
        
        // Style tab item content
        $this->start_controls_section(
            'tab_style_content_section',
            [
                'label' => __( 'Tab Content', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'ultimate_tab_content_display',
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
                        '{{WRAPPER}} .single__tab__item' => 'display: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'ultimate_tab_content_float',
                [
                    'label'   => __( 'Float', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'options' => [
                        'left'     => __( 'Left', 'ultimate' ),
                        'right'    => __( 'Right', 'ultimate' ),
                        'inherit ' => __( 'Inherit', 'ultimate' ),
                        'none'     => __( 'None', 'ultimate' ),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .single__tab__item' => 'float: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'ultimate_tab_content_width',
                [
                    'label'      => __( 'Width', 'ultimate' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'vw' ],
                    'range'      => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 9999,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .single__tab__item' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'tab_content_background',
                    'label'    => __( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .single__tab__item',
                ]
            );

            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'tab_content_border',
                    'label'    => __( 'Border', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .single__tab__item',
                ]
            );

            $this->add_responsive_control(
                'tab_content_border_radius',
                [
                    'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .single__tab__item' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'tab_content_padding',
                [
                    'label'      => __( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .single__tab__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'tab_content_margin',
                [
                    'label'      => __( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .single__tab__item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style tab area tab section
        $this->start_controls_section(
            'ultimate_tab_content_area_style',
            [
                'label' => __( 'Tab Content Wrap', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            
            $this->add_responsive_control(
                'ultimate_tab_content_area_display',
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
                        '{{WRAPPER}} .tab__content__area' => 'display: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'ultimate_tab_content_area_float',
                [
                    'label'   => __( 'Float', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,                    
                    'options' => [
                        'left'     => __( 'Left', 'ultimate' ),
                        'right'    => __( 'Right', 'ultimate' ),
                        'inherit ' => __( 'Inherit', 'ultimate' ),
                        'none'     => __( 'None', 'ultimate' ),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .tab__content__area' => 'float: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'ultimate_tab_content_area_margin',
                [
                    'label'      => __( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .tab__content__area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'ultimate_tab_content_area_padding',
                [
                    'label'      => __( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .tab__content__area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
        
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'ultimate_tab_content_area_bg',
                    'label'    => __( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .tab__content__area',
                ]
            );
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'ultimate_tab_content_area_border',
                    'label'    => __( 'Border', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .tab__content__area',
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'ultimate_tab_content_area_shadow',
                    'label'    => __( 'Box Shadow', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .tab__content__area',
                ]
            );
            $this->add_responsive_control(
                'ultimate_tab_content_area_width',
                [
                    'label'      => __( 'Width', 'ultimate' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'vw' ],
                    'range'      => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 9999,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .tab__content__area' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'ultimate_tab_content_area_height',
                [
                    'label'      => __( 'Height', 'ultimate' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 9999,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .tab__content__area' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        
            $this->add_responsive_control(
                'ultimate_tab_content_area_border_radius',
                [
                    'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .tab__content__area' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'custom_tab_content_area_css',
                [
                    'label'     => __( 'Custom CSS', 'ultimate' ),
                    'type'      => Controls_Manager::CODE,
                    'rows'      => 20,
                    'language'  => 'css',
                    'selectors' => [
                        '{{WRAPPER}} .tab__content__area' => '{{VALUE}};',
                    ],
                    'separator' => 'before',
                ]
            );

        $this->end_controls_section();

        /*----------------------------
            TXT BOX
        -----------------------------*/
        $this->start_controls_section(
            'box_style_section',
            [
                'label' => __( 'Menu And Content Area', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ultimate_box_display',
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
                    '{{WRAPPER}} .tab__menu__content' => 'display: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ultimate_box_float',
            [
                'label'   => __( 'Float', 'ultimate' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'left'     => __( 'Left', 'ultimate' ),
                    'right'    => __( 'Right', 'ultimate' ),
                    'inherit ' => __( 'Inherit', 'ultimate' ),
                    'none'     => __( 'None', 'ultimate' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .tab__menu__content' => 'float: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        // Box Typography
        $this->add_group_control(
            Group_Control_Typography:: get_type(),
            [
                'name'     => 'typography',
                'selector' => '{{WRAPPER}} .tab__menu__content',
            ]
        );

        // Box Default Color
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
                    '{{WRAPPER}} .tab__menu__content' => 'color: {{VALUE}}',
                ],
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
                    '{{WRAPPER}} .tab__menu__content' => 'text-align: {{VALUE}};',
                ],
                'default' => 'center',
            ]
        );

        $this->add_responsive_control(
            'ultimate_box_width',
            [
                'label'      => __( 'Width', 'ultimate' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 9999,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tab__menu__content' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_content_box_margin',
            [
                'label'      => __( 'Margin', 'ultimate' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .tab__menu__content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
        /*----------------------------
            TXT BOX END
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
                'selector'  => '{{WRAPPER}} .box__icon',
                'condition' => [
                    'icon_type' => ['font_icon']
                ],
            ]
        );

        // Icon Image Size
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
                    '{{WRAPPER}} .box__icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'icon_type' => ['image_icon']
                ],
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

        // Icon Image Filter
        $this->add_group_control(
            Group_Control_Css_Filter:: get_type(),
            [
                'name'      => 'icon_image_filters',
                'selector'  => '{{WRAPPER}} .box__icon img',
                'condition' => [
                    'icon_type' => ['image_icon']
                ],
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
                    '{{WRAPPER}} .box__icon' => 'color: {{VALUE}};',
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
                'selector' => '{{WRAPPER}} .box__icon',
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
                'selector' => '{{WRAPPER}} .box__icon',
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
                    '{{WRAPPER}} .box__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        // Icon Shadow
        $this->add_group_control(
            Group_Control_Box_Shadow:: get_type(),
            [
                'name'     => 'icon_shadow',
                'selector' => '{{WRAPPER}} .box__icon',
            ]
        );

        // Icon Hr
        $this->add_control(
            'icon_hr3',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_hover_tab',
            [
                'label' => __( 'Hover', 'ultimate' ),
            ]
        );

        // Icon Image Filter
        $this->add_group_control(
            Group_Control_Css_Filter:: get_type(),
            [
                'name'      => 'hover_icon_image_filters',
                'selector'  => '{{WRAPPER}} :hover .box__icon img',
                'condition' => [
                    'icon_type' => ['image_icon']
                ],
            ]
        );

        // Box Hover Icon Color
        $this->add_control(
            'hover_icon_color',
            [
                'label'     => __( 'Color', 'ultimate' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} :hover .box__icon, {{WRAPPER}} :focus .box__icon' => 'color: {{VALUE}};',
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
                'selector' => '{{WRAPPER}} :hover .box__icon,{{WRAPPER}} :focus .box__icon',
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
                'selector' => '{{WRAPPER}} :hover .box__icon,{{WRAPPER}} :hover .box__icon',
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
                    '{{WRAPPER}} :hover .box__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Icon Shadow
        $this->add_group_control(
            Group_Control_Box_Shadow:: get_type(),
            [
                'name'     => 'hover_icon_shadow',
                'selector' => '{{WRAPPER}} :hover .box__icon',
            ]
        );

        // Icon Hover Animation
        $this->add_control(
            'icon_hover_animation',
            [
                'label'    => __( 'Hover Animation', 'ultimate' ),
                'type'     => Controls_Manager::HOVER_ANIMATION,
                'selector' => '{{WRAPPER}} :hover .box__icon',
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

        // Icon Width
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
                    'size' => 80,
                ],
                'selectors' => [
                    '{{WRAPPER}} .box__icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Icon Height
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
                    'size' => 80,
                ],
                'selectors' => [
                    '{{WRAPPER}} .box__icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Icon Hr
        $this->add_control(
            'icon_hr5',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        // Icon Display;
        $this->add_responsive_control(
            'icon_display',
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
                    '{{WRAPPER}} .box__icon' => 'display: {{VALUE}};',
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
                    '{{WRAPPER}} .box__icon' => 'text-align: {{VALUE}};',
                ],
                'default' => 'center',
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
                'default' => 'initial',
                
                'options' => [
                    'initial'  => __( 'Initial', 'ultimate' ),
                    'absolute' => __( 'Absulute', 'ultimate' ),
                    'relative' => __( 'Relative', 'ultimate' ),
                    'static'   => __( 'Static', 'ultimate' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .box__icon' => 'position: {{VALUE}};',
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
                    '{{WRAPPER}} .box__icon' => 'left: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .box__icon' => 'right: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .box__icon' => 'top: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .box__icon' => 'bottom: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .box__icon,{{WRAPPER}} .box__icon img' => 'transition: {{SIZE}}s;',
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
                    '{{WRAPPER}} .box__icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .box__icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

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
        
        // Title Typography
        $this->add_group_control(
            Group_Control_Typography:: get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .box__title',
            ]
        );

        $this->start_controls_tabs( 'title_tab_style' );
        $this->start_controls_tab(
            'title_normal_tab',
            [
                'label' => __( 'Normal', 'ultimate' ),
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
                    '{{WRAPPER}} .box__title, {{WRAPPER}} .box__title a' => 'color: {{VALUE}};',
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

        // Title Hover Link Color
        $this->add_control(
            'hover_title_color',
            [
                'label'     => __( 'Link Color', 'ultimate' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .box__title a:hover, {{WRAPPER}} .box__title a:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Box Hover Title Color
        $this->add_control(
            'box_hover_title_color',
            [
                'label'     => __( 'Box Hover Color', 'ultimate' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} :hover .box__title a, {{WRAPPER}} :focus .box__title a, {{WRAPPER}} :hover .box__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        // Title Margin
        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __( 'Margin', 'ultimate' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .box__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        /*----------------------------
            TITLE STYLE END
        -----------------------------*/

        /*----------------------------
            TITLE BEFORE / AFTER
        -----------------------------*/
        $this->start_controls_section(
            'title_before_after_style_section',
            [
                'label' => __( 'Before / After', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'title_before_after_tab_style' );
        $this->start_controls_tab(
            'title_before_tab',
            [
                'label' => __( 'BEFORE', 'ultimate' ),
            ]
        );

        // Title Before Background
        $this->add_group_control(
            Group_Control_Background:: get_type(),
            [
                'name'     => 'before_background',
                'label'    => __( 'Background', 'plugin-domain' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .box__title:before',
            ]
        );

        // Title Before Display;
        $this->add_responsive_control(
            'title_before_display',
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
                    '{{WRAPPER}} .box__title:before' => 'display: {{VALUE}};',
                ],
            ]
        );

        // Title Before Postion
        $this->add_responsive_control(
            'before_position',
            [
                'label'   => __( 'Position', 'ultimate' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'relative',
                
                'options' => [
                    'initial'  => __( 'Initial', 'ultimate' ),
                    'absolute' => __( 'Absulute', 'ultimate' ),
                    'relative' => __( 'Relative', 'ultimate' ),
                    'static'   => __( 'Static', 'ultimate' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .box__title:before' => 'position: {{VALUE}};',
                ],
            ]
        );

        // Postion From Left
        $this->add_responsive_control(
            'before_position_from_left',
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
                    '{{WRAPPER}} .box__icon' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'before_position!' => ['initial','static']
                ],
            ]
        );

        // Postion From Right
        $this->add_responsive_control(
            'before_position_from_right',
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
                    '{{WRAPPER}} .box__icon' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'before_position!' => ['initial','static']
                ],
            ]
        );

        // Postion From Top
        $this->add_responsive_control(
            'before_position_from_top',
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
                    '{{WRAPPER}} .box__icon' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'before_position!' => ['initial','static']
                ],
            ]
        );

        // Postion From Bottom
        $this->add_responsive_control(
            'before_position_from_bottom',
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
                    '{{WRAPPER}} .box__icon' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'before_position!' => ['initial','static']
                ],
            ]
        );

        // Title Before Align
        $this->add_responsive_control(
            'title_before_align',
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
                    '{{WRAPPER}} .box__title:before' => '{{VALUE}};',
                ],
                'default' => 'text-align:left',
            ]
        );

        // Title Before Width
        $this->add_responsive_control(
            'title_before_width',
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
                    '{{WRAPPER}} .box__title:before' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Title Before Height
        $this->add_responsive_control(
            'title_before_height',
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
                    '{{WRAPPER}} .box__title:before' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Title Before Opacity
        $this->add_control(
            'before_opacity',
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
                    '{{WRAPPER}} .box__title:before' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        // Title Before Z-Index
        $this->add_control(
            'before_zindex',
            [
                'label'     => __( 'Z-Index', 'ultimate' ),
                'type'      => Controls_Manager::NUMBER,
                'min'       => -99,
                'max'       => 99,
                'step'      => 1,
                'selectors' => [
                    '{{WRAPPER}} .box__title:before' => 'z-index: {{SIZE}};',
                ],
            ]
        );

        // Title Before Margin
        $this->add_responsive_control(
            'title_before_margin',
            [
                'label'      => __( 'Margin', 'ultimate' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .box__title:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'title_after_tab',
            [
                'label' => __( 'AFTER', 'ultimate' ),
            ]
        );

        // Title After Background
        $this->add_group_control(
            Group_Control_Background:: get_type(),
            [
                'name'     => 'after_background',
                'label'    => __( 'Background', 'plugin-domain' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .box__title:after',
            ]
        );

        // Title After Display;
        $this->add_responsive_control(
            'title_after_display',
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
                    '{{WRAPPER}} .box__title:after' => 'display: {{VALUE}};',
                ],
            ]
        );

        // Title After Postion
        $this->add_responsive_control(
            'after_position',
            [
                'label'   => __( 'Position', 'ultimate' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'relative',
                
                'options' => [
                    'initial'  => __( 'Initial', 'ultimate' ),
                    'absolute' => __( 'Absulute', 'ultimate' ),
                    'relative' => __( 'Relative', 'ultimate' ),
                    'static'   => __( 'Static', 'ultimate' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .box__title:after' => 'position: {{VALUE}};',
                ],
            ]
        );

        // Postion From Left
        $this->add_responsive_control(
            'after_position_from_left',
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
                    '{{WRAPPER}} .box__icon' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'after_position!' => ['initial','static']
                ],
            ]
        );

        // Postion From Right
        $this->add_responsive_control(
            'after_position_from_right',
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
                    '{{WRAPPER}} .box__icon' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'after_position!' => ['initial','static']
                ],
            ]
        );

        // Postion From Top
        $this->add_responsive_control(
            'after_position_from_top',
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
                    '{{WRAPPER}} .box__icon' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'after_position!' => ['initial','static']
                ],
            ]
        );

        // Postion From Bottom
        $this->add_responsive_control(
            'after_position_from_bottom',
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
                    '{{WRAPPER}} .box__icon' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'after_position!' => ['initial','static']
                ],
            ]
        );

        // Title After Align
        $this->add_responsive_control(
            'title_after_align',
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
                    '{{WRAPPER}} .box__title:after' => '{{VALUE}};',
                ],
                'default' => 'text-align:left',
            ]
        );

        // Title After Width
        $this->add_responsive_control(
            'title_after_width',
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
                    '{{WRAPPER}} .box__title:after' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Title After Height
        $this->add_responsive_control(
            'title_after_height',
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
                    '{{WRAPPER}} .box__title:after' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Title After Opacity
        $this->add_control(
            'after_opacity',
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
                    '{{WRAPPER}} .box__title:after' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        // Title After Z-Index
        $this->add_control(
            'after_zindex',
            [
                'label'     => __( 'Z-Index', 'ultimate' ),
                'type'      => Controls_Manager::NUMBER,
                'min'       => -99,
                'max'       => 99,
                'step'      => 1,
                'selectors' => [
                    '{{WRAPPER}} .box__title:after' => 'z-index: {{SIZE}};',
                ],
            ]
        );

        // Title After Margin
        $this->add_responsive_control(
            'title_after_margin',
            [
                'label'      => __( 'Margin', 'ultimate' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .box__title:after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
        /*----------------------------
            TITLE BEFORE / AFTER END
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

        // Subtitle Typography
        $this->add_group_control(
            Group_Control_Typography:: get_type(),
            [
                'name'     => 'subtitle_typography',
                'selector' => '{{WRAPPER}} .box__subtitle',
            ]
        );

        // Subtitle Color
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
                    '{{WRAPPER}} .box__subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Box Hover Subtitle Color
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
                    '{{WRAPPER}} :hover .box__subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );

        // Subtitle Margin
        $this->add_responsive_control(
            'subtitle_margin',
            [
                'label'      => __( 'Margin', 'ultimate' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .box__subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        /*----------------------------
            SUBTITLE STYLE END
        -----------------------------*/

    }

    protected function render( $instance = [] ) {
        $settings = $this->get_settings_for_display();

        // Icon Animation
        if ( $settings['icon_hover_animation'] ) {
            $icon_animation = 'elementor-animation-' . $settings['icon_hover_animation'];
        }else{
            $icon_animation = '';
        }

        // Icon Condition
        if ( 'yes' == $settings['show_icon'] ) {
            if ( 'font_icon' == $settings['icon_type'] && !empty( $settings['font_icon'] ) ) {
                $icon = '<div class="box__icon '. esc_attr( $icon_animation ) .'"><i class="'.esc_attr( $settings['font_icon'] ).'"></i></div>';
            }elseif( 'image_icon' == $settings['icon_type'] && !empty( $settings['image_icon'] ) ){
                $icon_array = $settings['image_icon'];
                $icon_link = wp_get_attachment_image_url( $icon_array['id'], 'thumbnail' );
                $icon = '<div class="box__icon '. esc_attr( $icon_animation ) .'"><img src="'. esc_url( $icon_link ) .'" alt="" /></div>';
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
                $title = '<'.$title_tag.' class="box__title">'.esc_html( $settings['title'] ).'</'.$title_tag.'>';
        }else{
            $title = '';
        }

        // Subtitle
        if ( !empty( $settings['subtitle'] ) ) {
            $subtitle = '<div class="box__subtitle">'.esc_html( $settings['subtitle'] ).'</div>';
        }else{
            $subtitle = '';
        }

        // Description
        if ( !empty( $settings['description'] ) ) {
            $description = '<div class="box__description">'.wpautop( $settings['description'] ).'</div>';
        }else{
            $description = '';
        }

        // Title Condition
        if ( !empty($settings['subtitle_position']) ) {
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

        $this->add_render_attribute( 'tabs_area_attr', 'class', 'tabs__area' );
        $this->add_render_attribute( 'tabs_area_attr', 'class', 'tab__price_style__'.$settings['tab_style'] );

        $this->add_render_attribute( 'tab_menu_attr', 'class', 'nav-tabs tab__nav');
        $this->add_render_attribute( 'tab_menu_attr', 'role', 'tablist');
        $this->add_render_attribute( 'tab_menu_attr', 'class', 'tab__nav__style__'.$settings['tab_style'] );
        $id = $this->get_id();
        ?>
            <div <?php echo $this->get_render_attribute_string( 'tabs_area_attr' ); ?>>
    
                <?php if ( !empty( $icon ) || !empty( $title ) || !empty( $subtitle )  || !empty( $description ) ) : ?>

                    <div class="tab__menu__content">
                        <div class="tab__text__content">
                            <?php 
                                echo '
                                        '.( isset( $icon ) ? $icon : '' ).'
                                        '.( isset( $title_subtitle ) ? $title_subtitle : '' ).'
                                        '.( isset( $description ) ? $description : '' ).'
                                    ';
                            ?>
                        </div>
                        <ul <?php echo $this->get_render_attribute_string( 'tab_menu_attr' ); ?>>
                            <?php
                                $i = 0;
                                foreach ( $settings['tabs_list'] as $item ) {
                                $i++;
                                
                                if ( isset($item['set_default']) && 'active' == $item['set_default'] ) {
                                    $active_tab = $item['set_default'];
                                }elseif( !isset($item['set_default']) && $i == 1 ){
                                    $active_tab = 'active';
                                }else{
                                    $active_tab ='';
                                }                            

                                //if( $i == 1 ){ $active_tab = 'active'; } else{ $active_tab = ''; }

                                    $tabbuttontxt = $item['tab_title'];
                                    if( !empty( $item['tab_icon'] ) ){ $tabbuttontxt = '<div class="tab__button__icon"><i class="'.$item['tab_icon'].'"></i></div>'.$item['tab_title']; }
                                    echo sprintf( '<li class="%1$s" ><a class="tab__button %4$s" href="#tabitem-%2$s" data-toggle="tab">%3$s</a></li>',$active_tab, $id.$i, $tabbuttontxt, 'item-'.$item['_id']);
                                }
                            ?>
                        </ul>
                    </div>

                <?php else : ?>

                    <ul <?php echo $this->get_render_attribute_string( 'tab_menu_attr' ); ?>>
                        <?php
                            $i = 0;
                            foreach ( $settings['tabs_list'] as $item ) {
                            $i++;
                            
                            if ( isset($item['set_default']) && 'active' == $item['set_default'] ) {
                                $active_tab = $item['set_default'];
                            }elseif( !isset($item['set_default']) && $i == 1 ){
                                $active_tab = 'active';
                            }else{
                                $active_tab ='';
                            }                            

                            //if( $i == 1 ){ $active_tab = 'active'; } else{ $active_tab = ''; }

                                $tabbuttontxt = $item['tab_title'];
                                if( !empty( $item['tab_icon'] ) ){ $tabbuttontxt = '<div class="tab__button__icon"><i class="'.$item['tab_icon'].'"></i></div>'.$item['tab_title']; }
                                echo sprintf( '<li class="%1$s" ><a class="tab__button %4$s" href="#tabitem-%2$s" data-toggle="tab">%3$s</a></li>',$active_tab, $id.$i, $tabbuttontxt, 'item-'.$item['_id']);
                            }
                        ?>
                    </ul>

                <?php endif; ?>

                <div class = "tab__content__area tab-content">
                    <?php
                        $i = 0;
                        foreach ( $settings['tabs_list'] as $item ) {
                            $i++;                            

                            if ( isset($item['set_default']) && 'active' == $item['set_default'] ) {
                                $active_tab = $item['set_default'].' in';
                            }elseif( !isset($item['set_default']) && $i == 1 ){
                                $active_tab = 'active in';
                            }else{
                                $active_tab = '';
                            }

                            //if( $i == 1 ){ $active_tab = 'active in'; } else{ $active_tab = ''; }

                            if ( $item['content_source'] == 'custom' && !empty( $item['custom_content'] ) ) {
                                $tab_content = wp_kses_post( $item['custom_content'] );
                            } elseif ( $item['content_source'] == "elementor" && !empty( $item['template_id'] )) {
                                $tab_content = Plugin::instance()->frontend->get_builder_content_for_display( $item['template_id'] );
                            }else{
                                $tab_content = '';
                            }
                            echo sprintf('<div class="single__tab__item tab-pane tab_price %1$s %4$s" id="tabitem-%2$s"><div class="tab__inner__content">%3$s</div></div>', $active_tab, $id.$i, $tab_content,'elementor-repeater-item-'.$item['_id']);
                        }
                    ?>
                </div>
            </div>
        <?php
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new Ultimate_Price_Tabs_Widget() );