<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Ultimate_Image_Carousel extends Widget_Base {

    public function get_name() {
        return 'Ultimate_Image_Carousel';
    }
    
    public function get_title() {
        return __( 'Image Carousel', 'ultimate' );
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }
    
	public function get_categories() {
		return [ 'ultimate-addons' ];
	}

    public function get_script_depends() {
        return [
            'slick',
            'ultimate-core',
        ];
    }

    public function get_style_depends() {
        return [
            'slick',
        ];
    }

    static function image_crousel_style(){
        return[
            '1' => __( 'Style One', 'ultimate' ),
        ];
    }
    
    protected function _register_controls() {

        $this->start_controls_section(
            'carosul_content',
            [
                'label' => __( 'Carousel', 'ultimate' ),
            ]
        );
            $this->add_control(
                'image_carousel_style',
                [
                    'label'   => esc_html__( 'Carousel Style', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '1',
                    'options' => self::image_crousel_style(),
                ]
            );            
            $this->add_control(
                'link_click_event',
                [
                    'label'   => __( 'Click Event', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'none',
                    'options' => [
                        'none'        => __( 'None', 'ultimate' ),
                        'lightbox'    => __( 'Lightbox', 'ultimate' ),
                        'custom_link' => __( 'Custom Link', 'ultimate' ),
                    ],
                    'separator' => 'before',
                ]
            );
        
            $repeater = new Repeater();
        
            $repeater->add_control(
                'carosul_image',
                [
                    'label'   => __( 'Image', 'ultimate' ),
                    'type'    => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                ]
            );

            $repeater->add_group_control(
                Group_Control_Image_Size:: get_type(),
                [
                    'name'      => 'carosul_imagesize',
                    'default'   => 'large',
                    'separator' => 'none',
                ]
            );

            $repeater->add_control(
                'carosul_image_title',
                [
                    'label'   => __( 'Image Caption', 'ultimate' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => '',
                ]
            );
            $repeater->add_control(
                'custom_link',
                [
                    'label'         => __( 'Custom Link', 'ultimate' ),
                    'type'          => Controls_Manager::URL,
                    'placeholder'   => __( 'http://your-link.com', 'ultimate' ),
                    'show_external' => true,
                    'default'       => [
                        'url'         => '#',
                        'is_external' => false,
                        'nofollow'    => true,
                    ]
                ]
            );
            $this->add_control(
                'carosul_image_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => array_values( $repeater->get_controls() ),
                    'default' => [
                        [
                            'carosul_image_title' => __('Image Title #1','ultimate'),
                        ],

                    ],
                    'title_field' => '{{{ carosul_image_title }}}',
                    'separator'   => 'before',
                ]
            );


            $this->add_control(
                'slider_on',
                [
                    'label'        => __( 'Slider', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'ultimate' ),
                    'label_off'    => __( 'Off', 'ultimate' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'separator'    => 'before',
                ]
            );
        
            $this->add_control(
                'show_caption',
                [
                    'label'        => __( 'Display Caption', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'ultimate' ),
                    'label_off'    => __( 'Off', 'ultimate' ),
                    'return_value' => 'yes',
                    'default'      => 'no',
                    'separator'    => 'before',
                ]
            );
        
        $this->end_controls_section();
        
        // Carousel setting
        $this->start_controls_section(
            'slider_option',
            [
                'label'     => esc_html__( 'Carousel Option', 'ultimate' ),
                'condition' => [
                    'slider_on' => 'yes',
                ]
            ]
        );

            $this->add_control(
                'slitems',
                [
                    'label'     => esc_html__( 'Slider Items', 'ultimate' ),
                    'type'      => Controls_Manager::NUMBER,
                    'min'       => 1,
                    'max'       => 20,
                    'step'      => 1,
                    'default'   => 3,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slrows',
                [
                    'label'     => esc_html__( 'Slider Rows', 'ultimate' ),
                    'type'      => Controls_Manager::NUMBER,
                    'min'       => 0,
                    'max'       => 5,
                    'step'      => 1,
                    'default'   => 0,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_responsive_control(
                'slitemmargin',
                [
                    'label'     => esc_html__( 'Slider Item Margin', 'ultimate' ),
                    'type'      => Controls_Manager::NUMBER,
                    'min'       => 0,
                    'max'       => 100,
                    'step'      => 1,
                    'default'   => 1,
                    'selectors' => [
                        '{{WRAPPER}} .single__image__slide' => 'margin: calc( {{VALUE}}px / 2 );',
                        '{{WRAPPER}} .slick-list'                 => 'margin: calc( -{{VALUE}}px / 2 );',
                    ],
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slarrows',
                [
                    'label'        => esc_html__( 'Slider Arrow', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'separator'    => 'before',
                    'default'      => 'yes',
                    'condition'    => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'nav_position',
                [
                    'label'   => esc_html__( 'Arrow Position', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'outside_vertical_center_nav',
                    'options' => [
                        'inside_vertical_center_nav'  => __( 'Inside Vertical Center', 'ultimate' ),
                        'outside_vertical_center_nav' => __( 'Outside Vertical Center', 'ultimate' ),
                        'top_left_nav'                => __( 'Top Left', 'ultimate' ),
                        'top_center_nav'              => __( 'Top Center', 'ultimate' ),
                        'top_right_nav'               => __( 'Top Right', 'ultimate' ),
                        'bottom_left_nav'             => __( 'Bottom Left', 'ultimate' ),
                        'bottom_center_nav'           => __( 'Bottom Center', 'ultimate' ),
                        'bottom_right_nav'            => __( 'Bottom Right', 'ultimate' ),
                    ],
                    'condition' => [
                        'slarrows' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slprevicon',
                [
                    'label'     => __( 'Previous icon', 'ultimate' ),
                    'type'      => Controls_Manager::ICON,
                    'default'   => 'fa fa-angle-left',
                    'condition' => [
                        'slider_on' => 'yes',
                        'slarrows'  => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slnexticon',
                [
                    'label'     => __( 'Next icon', 'ultimate' ),
                    'type'      => Controls_Manager::ICON,
                    'default'   => 'fa fa-angle-right',
                    'condition' => [
                        'slider_on' => 'yes',
                        'slarrows'  => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'nav_visible',
                [
                    'label'        => __( 'Arrow Visibility', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'visibility:visible;opacity:1;',
                    'default'      => 'no',
                    'selectors'    => [
                        '{{WRAPPER}} .sldier-content-area .owl-nav > div' => '{{VALUE}}',
                    ],
                    'condition'   => [
                        'slarrows' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sldots',
                [
                    'label'        => esc_html__( 'Slider dots', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'separator'    => 'before',
                    'default'      => 'no',
                    'condition'    => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slpause_on_hover',
                [
                    'type'         => Controls_Manager::SWITCHER,
                    'label_off'    => __('No', 'ultimate'),
                    'label_on'     => __('Yes', 'ultimate'),
                    'return_value' => 'yes',
                    'separator'    => 'before',
                    'default'      => 'yes',
                    'label'        => __('Pause on Hover?', 'ultimate'),
                    'condition'    => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slcentermode',
                [
                    'label'        => esc_html__( 'Center Mode', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'separator'    => 'before',
                    'default'      => 'no',
                    'condition'    => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slcenterpadding',
                [
                    'label'     => esc_html__( 'Center padding', 'ultimate' ),
                    'type'      => Controls_Manager::NUMBER,
                    'min'       => 0,
                    'max'       => 500,
                    'step'      => 1,
                    'default'   => 50,
                    'condition' => [
                        'slider_on'    => 'yes',
                        'slcentermode' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slfade',
                [
                    'label'        => esc_html__( 'Slider Fade', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'separator'    => 'before',
                    'default'      => 'no',
                    'condition'    => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slfocusonselect',
                [
                    'label'        => esc_html__( 'Focus On Select', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'separator'    => 'before',
                    'default'      => 'no',
                    'condition'    => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slvertical',
                [
                    'label'        => esc_html__( 'Vertical Slide', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'separator'    => 'before',
                    'default'      => 'no',
                    'condition'    => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slinfinite',
                [
                    'label'        => esc_html__( 'Infinite', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'separator'    => 'before',
                    'default'      => 'yes',
                    'condition'    => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slrtl',
                [
                    'label'        => esc_html__( 'RTL Slide', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'separator'    => 'before',
                    'default'      => 'no',
                    'condition'    => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slautolay',
                [
                    'label'        => esc_html__( 'Slider auto play', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'separator'    => 'before',
                    'default'      => 'no',
                    'condition'    => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slautoplay_speed',
                [
                    'label'     => __('Autoplay speed', 'ultimate'),
                    'type'      => Controls_Manager::NUMBER,
                    'default'   => 3000,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );


            $this->add_control(
                'slanimation_speed',
                [
                    'label'     => __('Autoplay animation speed', 'ultimate'),
                    'type'      => Controls_Manager::NUMBER,
                    'default'   => 300,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slscroll_columns',
                [
                    'label'     => __('Slider item to scroll', 'ultimate'),
                    'type'      => Controls_Manager::NUMBER,
                    'min'       => 1,
                    'max'       => 10,
                    'step'      => 1,
                    'default'   => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'heading_tablet',
                [
                    'label'     => __( 'Tablet', 'ultimate' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'after',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sltablet_display_columns',
                [
                    'label'     => __('Slider Items', 'ultimate'),
                    'type'      => Controls_Manager::NUMBER,
                    'min'       => 1,
                    'max'       => 8,
                    'step'      => 1,
                    'default'   => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sltablet_scroll_columns',
                [
                    'label'     => __('Slider item to scroll', 'ultimate'),
                    'type'      => Controls_Manager::NUMBER,
                    'min'       => 1,
                    'max'       => 8,
                    'step'      => 1,
                    'default'   => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sltablet_width',
                [
                    'label'       => __('Tablet Resolution', 'ultimate'),
                    'description' => __('The resolution to tablet.', 'ultimate'),
                    'type'        => Controls_Manager::NUMBER,
                    'default'     => 750,
                    'condition'   => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'heading_mobile',
                [
                    'label'     => __( 'Mobile Phone', 'ultimate' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'after',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slmobile_display_columns',
                [
                    'label'     => __('Slider Items', 'ultimate'),
                    'type'      => Controls_Manager::NUMBER,
                    'min'       => 1,
                    'max'       => 4,
                    'step'      => 1,
                    'default'   => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slmobile_scroll_columns',
                [
                    'label'     => __('Slider item to scroll', 'ultimate'),
                    'type'      => Controls_Manager::NUMBER,
                    'min'       => 1,
                    'max'       => 4,
                    'step'      => 1,
                    'default'   => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slmobile_width',
                [
                    'label'       => __('Mobile Resolution', 'ultimate'),
                    'description' => __('The resolution to mobile.', 'ultimate'),
                    'type'        => Controls_Manager::NUMBER,
                    'default'     => 480,
                    'condition'   => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

        $this->end_controls_section();
        /*-----------------------
            SLIDER OPTIONS END
        -------------------------*/     
        
        /*-------------------------
            AREA STYLE
        --------------------------*/
        $this->start_controls_section(
            'items_area_style_section',
            [
                'label' => __( 'Area Style', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_responsive_control(
                'area_height',
                [
                    'label'      => __( 'Height', 'ultimate' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'vw','vh' ],
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
                        '{{WRAPPER}}' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'area_width',
                [
                    'label'      => __( 'Width', 'ultimate' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%', 'vw', 'vh' ],
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
                        '{{WRAPPER}}' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'area_margin',
                [
                    'label'      => __( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
        $this->end_controls_section();   

        /*-------------------------
            ITEM PARENT STYLE
        --------------------------*/
        $this->start_controls_section(
            'item_grid_style_section',
            [
                'label'     => __( 'Column Style', 'ultimate' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_on!' => 'yes',
                ]
            ]
        );
            $this->add_responsive_control(
                'item_grid_margin',
                [
                    'label'      => __( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__image__slide__item__parent' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );        
            $this->add_responsive_control(
                'item_grid_padding',
                [
                    'label'      => __( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__image__slide__item__parent' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );        
    		$this->add_responsive_control(
    			'item_grid_width',
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
    					]
    				],
    				'default' => [
    					'unit' => '%',
    					'size' => 33.33,
    				],
    				'selectors' => [
    					'{{WRAPPER}} .ultimate__image__slide__item__parent' => 'width: {{SIZE}}{{UNIT}};',
    				],
    			]
    		);
        $this->end_controls_section();

        /*-------------------------
            CENTER ITEM STYLE
        --------------------------*/
        $this->start_controls_section(
            'center_item_style_section',
            [
                'label'     => __( 'Center Item Style', 'ultimate' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_on'    => 'yes',
                    'slcentermode' => 'yes',
                ]
            ]
        );
            $this->add_group_control(
                Group_Control_Css_Filter:: get_type(),
                [
                    'name'      => 'center_item_image_filters',
                    'selector'  => '{{WRAPPER}} .ultimate__image__slide__item__parent.slick-active.slick-center img',
                ]
            );
            $this->add_control(
                'center_item_opacity',
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
                        '{{WRAPPER}} .ultimate__image__slide__item__parent.slick-active.slick-center' => 'opacity:{{SIZE}};',
                        '{{WRAPPER}} .slick-active.slick-center .ultimate__image__slide__item__parent' => 'opacity:{{SIZE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'center_item_margin',
                [
                    'label'      => __( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__image__slide__item__parent.slick-active.slick-center' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .slick-active.slick-center .ultimate__image__slide__item__parent' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );        
            $this->add_responsive_control(
                'center_item_padding',
                [
                    'label'      => __( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__image__slide__item__parent.slick-active.slick-center' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .slick-active.slick-center .ultimate__image__slide__item__parent' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'center_item_scale',
                [
                    'label' => __( 'Scale', 'ultimate' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 5,
                            'step' => 0.1,
                        ],
                    ],
                    'default' => [
                        'size' => 1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ultimate__image__slide__item__parent.slick-active.slick-center' => 'transform: scale({{SIZE}});',
                        '{{WRAPPER}} .slick-active.slick-center .ultimate__image__slide__item__parent' => 'transform: scale({{SIZE}});',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'center_item_transition',
                [
                    'label' => __( 'Transition', 'ultimate' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 5,
                            'step' => 0.1,
                        ],
                    ],
                    'default' => [
                        'size' => 0.5,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ultimate__image__slide__item__parent' => 'transition: {{SIZE}}s;',
                        '{{WRAPPER}} .slick-slide' => 'transition: {{SIZE}}s;',
                    ],
                    'separator' => 'before',
                ]
            );
        $this->end_controls_section();  


        /*-------------------------
            ITEM BOX STYLE
        --------------------------*/
        $this->start_controls_section(
            'ultimate_carousel_style_section',
            [
                'label' => __( 'Item Style', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_group_control(
                Group_Control_Css_Filter:: get_type(),
                [
                    'name'      => 'carousel_single_item_image_filters',
                    'selector'  => '{{WRAPPER}} .single__image__slide img',
                ]
            );
            $this->add_responsive_control(
                'item_image_width',
                [
                    'label'      => __( 'Item Image Width', 'ultimate' ),
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
                        '{{WRAPPER}} .single__image__slide img' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'carousel_single_item_opacity',
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
                        '{{WRAPPER}} .ultimate__image__slide__item__parent' => 'opacity:{{SIZE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'carousel_single_background',
                    'label'    => __( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .single__image__slide',
                ]
            );

           $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'carousel_single_box_shadow',
                    'label'    => __( 'Box Shadow', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .single__image__slide',
                ]
            );
            
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'carousel_single_border',
                    'label'    => __( 'Border', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .single__image__slide',
                ]
            );

            $this->add_responsive_control(
                'carousel_single_radius',
                [
                    'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .single__image__slide' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'carousel_single_margin',
                [
                    'label'      => __( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .single__image__slide' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'carousel_single_padding',
                [
                    'label'      => __( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .single__image__slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'item_horizontal_align',
                [
                    'label' => __( 'Vertical Align', 'ultimate' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'align-items:center;',
                    'options' => [
                        'align-items:center;'  => __( 'Center', 'ultimate' ),
                        'align-items:flex-start;'  => __( 'Start', 'ultimate' ),
                        'align-items:flex-end;'  => __( 'End', 'ultimate' ),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .slick-slider .slick-track' => 'display: flex; {{VALUE}}',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'item_align',
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
                        '{{WRAPPER}} .single__image__slide,{{WRAPPER}} .single__image__slide img' => 'margin: 0 auto; text-align: {{VALUE}};',
                    ],
                    'separator' => 'after',
                ]
            );

            $this->add_responsive_control(
                'nth_child_margin',
                [
                    'label'      => __( 'Item Nth Child 2 Margin Vartically', 'ultimate' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min'  => -200,
                            'max'  => 200,
                            'step' => 5,
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
                        '{{WRAPPER}} .ultimate__image__slide__item__parent:nth-child(2n)' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'item_transition',
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
                        '{{WRAPPER}} .single__image__slide,{{WRAPPER}} .single__image__slide img' => 'transition: {{SIZE}}s;',
                    ],
                ]
            );
            $this->add_control(
                'item_opacity',
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
                        '{{WRAPPER}} .single__image__slide' => 'opacity: {{SIZE}};',
                    ],
                ]
            );
            $this->add_control(
                'item_hover_title',
                [
                    'label'     => __( 'Item Hover', 'ultimate' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'heading_hr1',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );
            $this->add_group_control(
                Group_Control_Css_Filter:: get_type(),
                [
                    'name'      => 'carousel_single_item_image_hover_filters',
                    'selector'  => '{{WRAPPER}} .single__image__slide:hover img',
                ]
            );
            $this->add_control(
                'item_hover_opacity',
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
                        '{{WRAPPER}} .single__image__slide:hover' => 'opacity: {{SIZE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'item_hover_margin',
                [
                    'label'      => __( 'Item Hover Offset Vartically', 'ultimate' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min'  => -200,
                            'max'  => 200,
                            'step' => 5,
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
                        '{{WRAPPER}} .ultimate__image__slide__item__parent:hover' => 'transform: translateY({{SIZE}}{{UNIT}});',
                    ],
                    'separator' => 'before',
                ]
            );
        $this->end_controls_section();
        
        /*-------------------------
            CAPTION STYLE
        --------------------------*/
        $this->start_controls_section(
            'box_title_section',
            [
                'label'     => __( 'Caption Style', 'ultimate' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_caption' => 'yes'
                ]
            ]
        );
        
        $this->start_controls_tabs('box_title_style_tab');        
        $this->start_controls_tab( 'box_title_normal',
			[
				'label' => __( 'Normal', 'ultimate' ),
			]
		);        
        
        $this->add_group_control(
            Group_Control_Typography:: get_type(),
            [
                'name'     => 'feature_title_typography',
                'selector' => '{{WRAPPER}} .image__caption',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Color', 'ultimate' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .image__caption' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background:: get_type(),
            [
                'name'     => 'title_background',
                'label'    => __( 'Background', 'ultimate' ),
                'default'  => '#ffffff',
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .image__caption',
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __( 'Margin', 'ultimate' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .image__caption' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .image__caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
                
		$this->add_control(
			'feature_title_transition',
			[
				'label'   => __( 'Transition Duration', 'ultimate' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.3,
				],
				'range' => [
					'px' => [
						'max'  => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .image__caption' => 'transition-duration: {{SIZE}}s',
				],
			]
		);
        
        $this->end_controls_tab(); // Hover Style tab end
         
        $this->start_controls_tab( 'box_title_hover',
			[
				'label' => __( 'Hover', 'ultimate' ),
			]
		);        
        
        $this->add_control(
            'title_hover_color',
            [
                'label'     => __( 'Color', 'ultimate' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .image__caption:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background:: get_type(),
            [
                'name'     => 'hover_title_background',
                'label'    => __( 'Background', 'ultimate' ),
                'default'  => '#ffffff',
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .image__caption:hover',
            ]
        );
        $this->end_controls_tab(); // Hover Style tab end
        $this->end_controls_tabs();// Box Style tabs end  
        $this->end_controls_section();
        
        /*----------------------------
            SLIDER NAV WARP
        -----------------------------*/
        $this->start_controls_section(
            'slider_control_warp_style_section',
            [
                'label' => __( 'Slider Arrow Warp', 'ultimate' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_on' => 'yes',
                    'slarrows'  => 'yes',
                ],
            ]
        );

        // Background
        $this->add_group_control(
            Group_Control_Background:: get_type(),
            [
                'name'     => 'slider_nav_warp_background',
                'label'    => __( 'Background', 'ultimate' ),
                'types'    => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav',
            ]
        );

        // Border
        $this->add_group_control(
            Group_Control_Border:: get_type(),
            [
                'name'     => 'slider_nav_warp_border',
                'label'    => __( 'Border', 'ultimate' ),
                'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav',
            ]
        );

        // Border Radius
        $this->add_control(
            'slider_nav_warp_radius',
            [
                'label'      => __( 'Border Radius', 'ultimate' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .sldier-content-area .owl-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Shadow
        $this->add_group_control(
            Group_Control_Box_Shadow:: get_type(),
            [
                'name'     => 'slider_nav_warp_shadow',
                'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav',
            ]
        );

        // Display;
        $this->add_responsive_control(
            'slider_nav_warp_display',
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
                    '{{WRAPPER}} .sldier-content-area .owl-nav' => 'display: {{VALUE}};',
                ],
            ]
        );

        // Before Postion
        $this->add_responsive_control(
            'slider_nav_warp_position',
            [
                'label'   => __( 'Position', 'ultimate' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                
                'options' => [
                    'initial'  => __( 'Initial', 'ultimate' ),
                    'absolute' => __( 'Absulute', 'ultimate' ),
                    'relative' => __( 'Relative', 'ultimate' ),
                    'static'   => __( 'Static', 'ultimate' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .sldier-content-area .owl-nav' => 'position: {{VALUE}};',
                ],
            ]
        );

        // Postion From Left
        $this->add_responsive_control(
            'slider_nav_warp_position_from_left',
            [
                'label'      => __( 'From Left', 'ultimate' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
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
                    '{{WRAPPER}} .sldier-content-area .owl-nav' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_nav_warp_position' => ['absolute','relative']
                ],
            ]
        );

        // Postion From Right
        $this->add_responsive_control(
            'slider_nav_warp_position_from_right',
            [
                'label'      => __( 'From Right', 'ultimate' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
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
                    '{{WRAPPER}} .sldier-content-area .owl-nav' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_nav_warp_position' => ['absolute','relative']
                ],
            ]
        );

        // Postion From Top
        $this->add_responsive_control(
            'slider_nav_warp_position_from_top',
            [
                'label'      => __( 'From Top', 'ultimate' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
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
                    '{{WRAPPER}} .sldier-content-area .owl-nav' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_nav_warp_position' => ['absolute','relative']
                ],
            ]
        );

        // Postion From Bottom
        $this->add_responsive_control(
            'slider_nav_warp_position_from_bottom',
            [
                'label'      => __( 'From Bottom', 'ultimate' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
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
                    '{{WRAPPER}} .sldier-content-area .owl-nav' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'slider_nav_warp_position' => ['absolute','relative']
                ],
            ]
        );

        // Align
        $this->add_responsive_control(
            'slider_nav_warp_align',
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
                    '{{WRAPPER}} .sldier-content-area .owl-nav' => 'text-align: {{VALUE}};',
                ],
                'default' => '',
            ]
        );

        // Width
        $this->add_responsive_control(
            'slider_nav_warp_width',
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
                    '{{WRAPPER}} .sldier-content-area .owl-nav' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Height
        $this->add_responsive_control(
            'slider_nav_warp_height',
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
                    '{{WRAPPER}} .sldier-content-area .owl-nav' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Opacity
        $this->add_control(
            'slider_nav_warp_opacity',
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
                    '{{WRAPPER}} .sldier-content-area .owl-nav' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        // Z-Index
        $this->add_control(
            'slider_nav_warp_zindex',
            [
                'label'     => __( 'Z-Index', 'ultimate' ),
                'type'      => Controls_Manager::NUMBER,
                'min'       => -99,
                'max'       => 99,
                'step'      => 1,
                'selectors' => [
                    '{{WRAPPER}} .sldier-content-area .owl-nav' => 'z-index: {{SIZE}};',
                ],
            ]
        );

        // Margin
        $this->add_responsive_control(
            'slider_nav_warp_margin',
            [
                'label'      => __( 'Margin', 'ultimate' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .sldier-content-area .owl-nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding
        $this->add_responsive_control(
            'slider_nav_warp_padding',
            [
                'label'      => __( 'Padding', 'ultimate' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .sldier-content-area .owl-nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        /*----------------------------
            SLIDER NAV WARP END
        -----------------------------*/
        /*------------------------
             ARROW STYLE
        --------------------------*/
        $this->start_controls_section(
            'slider_arrow_style',
            [
                'label'     => __( 'Arrow', 'ultimate' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_on' => 'yes',
                    'slarrows'  => 'yes',
                ],
            ]
        );
        
            $this->start_controls_tabs( 'slider_arrow_style_tabs' );

                // Normal tab Start
                $this->start_controls_tab(
                    'slider_arrow_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'ultimate' ),
                    ]
                );

                    $this->add_control(
                        'slider_arrow_color',
                        [
                            'label'  => __( 'Color', 'ultimate' ),
                            'type'   => Controls_Manager::COLOR,
                            'scheme' => [
                                'type'  => \Elementor\Core\Schemes\Color::get_type(),
                                'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .slick-arrow' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_fontsize',
                        [
                            'label'      => __( 'Font Size', 'ultimate' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
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
                                '{{WRAPPER}} .sldier-content-area .slick-arrow' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'slider_arrow_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .sldier-content-area .slick-arrow',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'slider_arrow_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .sldier-content-area .slick-arrow',
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .slick-arrow' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'slider_arrow_shadow',
                            'selector' => '{{WRAPPER}} .sldier-content-area .slick-arrow',
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_height',
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
                                'size' => 40,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .slick-arrow' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_width',
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
                                'size' => 46,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .slick-arrow' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'slider_arrow_margin',
                        [
                            'label'      => __( 'Margin', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .sldier-content-area .slick-arrow' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'slider_arrow_padding',
                        [
                            'label'      => __( 'Padding', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .sldier-content-area .slick-arrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    // Postion From Left
                    $this->add_responsive_control(
                        'slide_button_position_from_left',
                        [
                            'label'      => __( 'Left Arrow Position From Left', 'ultimate' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => -1000,
                                    'max'  => 1000,
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
                                '{{WRAPPER}} .sldier-content-area .owl-nav > div.owl-prev' => 'left: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    // Postion Bottom Top
                    $this->add_responsive_control(
                        'slide_button_position_from_bottom',
                        [
                            'label'      => __( 'Left Arrow Position From Top', 'ultimate' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => -1000,
                                    'max'  => 1000,
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
                                '{{WRAPPER}} .sldier-content-area .owl-nav > div.owl-prev' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );


                    // Postion From Left
                    $this->add_responsive_control(
                        'slide_button_position_from_right',
                        [
                            'label'      => __( 'Right Arrow Position From Right', 'ultimate' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => -1000,
                                    'max'  => 1000,
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
                                '{{WRAPPER}} .sldier-content-area .owl-nav > div.owl-next' => 'right: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    // Postion Bottom Top
                    $this->add_responsive_control(
                        'slide_button_position_from_top',
                        [
                            'label'      => __( 'Right Arrow Position From Top', 'ultimate' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => -1000,
                                    'max'  => 1000,
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
                                '{{WRAPPER}} .sldier-content-area .owl-nav > div.owl-next' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Normal tab end

                // Hover tab Start
                $this->start_controls_tab(
                    'slider_arrow_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'ultimate' ),
                    ]
                );

                    $this->add_control(
                        'slider_arrow_hover_color',
                        [
                            'label'  => __( 'Color', 'ultimate' ),
                            'type'   => Controls_Manager::COLOR,
                            'scheme' => [
                                'type'  => \Elementor\Core\Schemes\Color::get_type(),
                                'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .slick-arrow:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'slider_arrow_hover_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .sldier-content-area .slick-arrow:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'slider_arrow_hover_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .sldier-content-area .slick-arrow:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_hover_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .slick-arrow:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'slider_arrow_hover_shadow',
                            'selector' => '{{WRAPPER}} .sldier-content-area .slick-arrow:hover',
                        ]
                    );

                    // Postion From Left
                    $this->add_responsive_control(
                        'slide_button_hover_position_from_left',
                        [
                            'label'      => __( 'Left Arrow Position From Left', 'ultimate' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => -1000,
                                    'max'  => 1000,
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
                                '{{WRAPPER}} .sldier-content-area:hover .owl-nav > div.owl-prev' => 'left: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    // Postion Bottom Top
                    $this->add_responsive_control(
                        'slide_button_hover_position_from_bottom',
                        [
                            'label'      => __( 'Left Arrow Position From Top', 'ultimate' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => -1000,
                                    'max'  => 1000,
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
                                '{{WRAPPER}} .sldier-content-area:hover .owl-nav > div.owl-prev' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );


                    // Postion From Left
                    $this->add_responsive_control(
                        'slide_button_hover_position_from_right',
                        [
                            'label'      => __( 'Right Arrow Position From Right', 'ultimate' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => -1000,
                                    'max'  => 1000,
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
                                '{{WRAPPER}} .sldier-content-area:hover .owl-nav > div.owl-next' => 'right: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    // Postion Bottom Top
                    $this->add_responsive_control(
                        'slide_button_hover_position_from_top',
                        [
                            'label'      => __( 'Right Arrow Position From Top', 'ultimate' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => -1000,
                                    'max'  => 1000,
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
                                '{{WRAPPER}} .sldier-content-area:hover .owl-nav > div.owl-next' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section(); // Style Slider arrow style end
        /*------------------------
             ARROW STYLE END
        --------------------------*/

        /*----------------------------
            SLIDER DOTS WARP
        -----------------------------*/
        $this->start_controls_section(
            'slider_dots_warp_style_section',
            [
                'label'     => esc_html__( 'Slider Pagination Warp', 'ultimate' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_on' => 'yes',
                    'sldots'    => 'yes',
                ],
            ]
        );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'slider_dots_warp_background',
                    'label'    => esc_html__( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .sldier-content-area .owl-dots',
                ]
            );
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'slider_dots_warp_border',
                    'label'    => esc_html__( 'Border', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .sldier-content-area .owl-dots',
                ]
            );
            $this->add_control(
                'slider_dots_warp_radius',
                [
                    'label'      => esc_html__( 'Border Radius', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .sldier-content-area .owl-dots' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'slider_dots_warp_shadow',
                    'selector' => '{{WRAPPER}} .sldier-content-area .owl-dots',
                ]
            );
            $this->add_responsive_control(
                'slider_dots_warp_display',
                [
                    'label'   => esc_html__( 'Display', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        'initial'      => esc_html__( 'Initial', 'ultimate' ),
                        'block'        => esc_html__( 'Block', 'ultimate' ),
                        'inline-block' => esc_html__( 'Inline Block', 'ultimate' ),
                        'flex'         => esc_html__( 'Flex', 'ultimate' ),
                        'inline-flex'  => esc_html__( 'Inline Flex', 'ultimate' ),
                        'none'         => esc_html__( 'none', 'ultimate' ),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sldier-content-area .owl-dots' => 'display: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'slider_dots_warp_position',
                [
                    'label'   => esc_html__( 'Position', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '',
                    
                    'options' => [
                        'initial'  => esc_html__( 'Initial', 'ultimate' ),
                        'absolute' => esc_html__( 'Absulute', 'ultimate' ),
                        'relative' => esc_html__( 'Relative', 'ultimate' ),
                        'static'   => esc_html__( 'Static', 'ultimate' ),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sldier-content-area .owl-dots' => 'position: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'slider_dots_warp_position_from_left',
                [
                    'label'      => esc_html__( 'From Left', 'ultimate' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min'  => -1000,
                            'max'  => 1000,
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
                        '{{WRAPPER}} .sldier-content-area .owl-dots' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'slider_dots_warp_position' => ['absolute','relative']
                    ],
                ]
            );
            $this->add_responsive_control(
                'slider_dots_warp_position_from_right',
                [
                    'label'      => esc_html__( 'From Right', 'ultimate' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min'  => -1000,
                            'max'  => 1000,
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
                        '{{WRAPPER}} .sldier-content-area .owl-dots' => 'right: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'slider_dots_warp_position' => ['absolute','relative']
                    ],
                ]
            );
            $this->add_responsive_control(
                'slider_dots_warp_position_from_top',
                [
                    'label'      => esc_html__( 'From Top', 'ultimate' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min'  => -1000,
                            'max'  => 1000,
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
                        '{{WRAPPER}} .sldier-content-area .owl-dots' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'slider_dots_warp_position' => ['absolute','relative']
                    ],
                ]
            );
            $this->add_responsive_control(
                'slider_dots_warp_position_from_bottom',
                [
                    'label'      => esc_html__( 'From Bottom', 'ultimate' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min'  => -1000,
                            'max'  => 1000,
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
                        '{{WRAPPER}} .sldier-content-area .owl-dots' => 'bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'slider_dots_warp_position' => ['absolute','relative']
                    ],
                ]
            );
            $this->add_responsive_control(
                'slider_dots_warp_align',
                [
                    'label'   => esc_html__( 'Alignment', 'ultimate' ),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => esc_html__( 'Left', 'ultimate' ),
                            'icon'  => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'ultimate' ),
                            'icon'  => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__( 'Right', 'ultimate' ),
                            'icon'  => 'fa fa-align-right',
                        ],
                        'justify' => [
                            'title' => esc_html__( 'Justify', 'ultimate' ),
                            'icon'  => 'fa fa-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sldier-content-area .owl-dots,{{WRAPPER}} .sldier-content-area .slick-dots' => 'text-align: {{VALUE}};',
                    ],
                    'default' => '',
                ]
            );
            $this->add_responsive_control(
                'slider_dots_warp_width',
                [
                    'label'      => esc_html__( 'Width', 'ultimate' ),
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
                        '{{WRAPPER}} .sldier-content-area .owl-dots' => 'width: {{SIZE}}{{UNIT}} !important;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'slider_dots_warp_height',
                [
                    'label'      => esc_html__( 'Height', 'ultimate' ),
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
                        '{{WRAPPER}} .sldier-content-area .owl-dots' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'slider_dots_warp_opacity',
                [
                    'label' => esc_html__( 'Opacity', 'ultimate' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max'  => 1,
                            'min'  => 0.10,
                            'step' => 0.01,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sldier-content-area .owl-dots' => 'opacity: {{SIZE}};',
                    ],
                ]
            );
            $this->add_control(
                'slider_dots_warp_zindex',
                [
                    'label'     => esc_html__( 'Z-Index', 'ultimate' ),
                    'type'      => Controls_Manager::NUMBER,
                    'min'       => -99,
                    'max'       => 99,
                    'step'      => 1,
                    'selectors' => [
                        '{{WRAPPER}} .sldier-content-area .owl-dots' => 'z-index: {{SIZE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'slider_dots_warp_margin',
                [
                    'label'      => esc_html__( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .sldier-content-area .owl-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'slider_dots_warp_padding',
                [
                    'label'      => esc_html__( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .sldier-content-area .owl-dots' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'pagination_active_content_wrap_heading',
                [
                    'label'     => esc_html__( 'Slide Content Wrap', 'ultimate' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'pagination_active_content_wrap_margin',
                [
                    'label'      => esc_html__( 'Content Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'separator'  => 'before',
                    'selectors'  => [
                        '{{WRAPPER}} .sldier-content-area .slick-dotted.slick-slider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        /*----------------------------
            SLIDER DOTS WARP END
        -----------------------------*/

        /*------------------------
             DOTS STYLE
        --------------------------*/
        $this->start_controls_section(
            'post_slider_pagination_style_section',
            [
                'label'     => esc_html__( 'Pagination', 'ultimate' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_on' => 'yes',
                    'sldots'    => 'yes',
                ],
            ]
        );
            $this->start_controls_tabs('pagination_style_tabs');
                $this->start_controls_tab(
                    'pagination_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'ultimate' ),
                    ]
                );
                    $this->add_responsive_control(
                        'slider_pagination_width',
                        [
                            'label'      => esc_html__( 'Width', 'ultimate' ),
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
                                'size' => 15,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .slick-dots li' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'slider_pagination_height',
                        [
                            'label'      => esc_html__( 'Height', 'ultimate' ),
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
                                'size' => 15,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .slick-dots li' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'pagination_background',
                            'label'    => esc_html__( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .sldier-content-area .slick-dots li',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'pagination_border',
                            'label'    => esc_html__( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .sldier-content-area .slick-dots li',
                        ]
                    );
                    $this->add_responsive_control(
                        'pagination_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .slick-dots li' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'pagination_margin',
                        [
                            'label'      => esc_html__( 'Margin', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .sldier-content-area .slick-dots li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'pagination_style_active_tab',
                    [
                        'label' => esc_html__( 'Active', 'ultimate' ),
                    ]
                );
                    $this->add_responsive_control(
                        'slider_pagination_hover_width',
                        [
                            'label'      => esc_html__( 'Width', 'ultimate' ),
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
                                'size' => 15,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .slick-dots li:hover, {{WRAPPER}} .sldier-content-area .slick-dots li.slick-active' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'slider_pagination_hover_height',
                        [
                            'label'      => esc_html__( 'Height', 'ultimate' ),
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
                                'size' => 15,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .slick-dots li:hover, {{WRAPPER}} .sldier-content-area .slick-dots li.slick-active' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'pagination_hover_background',
                            'label'    => esc_html__( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .sldier-content-area .slick-dots li:hover, {{WRAPPER}} .sldier-content-area .slick-dots li.slick-active',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'pagination_hover_border',
                            'label'    => esc_html__( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .sldier-content-area .slick-dots li:hover, {{WRAPPER}} .sldier-content-area .slick-dots li.slick-active',
                        ]
                    );
                    $this->add_responsive_control(
                        'pagination_hover_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .slick-dots li.slick-active' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .sldier-content-area .slick-dots li:hover'        => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*------------------------
             DOTS STYLE END
        --------------------------*/
    }

    protected function render( $instance = [] ) {
        $settings = $this->get_settings_for_display();
        // Carousel Attribute
        $this->add_render_attribute( 'ultimate_carousel_wrap', 'class', 'sldier-content-area '.$settings['nav_position'] );
        // Slider Attr
        /*$this->add_render_attribute( 'ultimate_carousel_attr', 'class', 'ultimate__content__or__slider' );*/

        if( $settings['slider_on'] == 'yes' ){

            $this->add_render_attribute( 'ultimate_carousel_attr', 'class', 'ultimate-carousel-activation' );

            $slideid = rand(2564,1245);

            $slider_settings = [
                'slideid'         => $slideid,
                'arrows'          => ('yes' === $settings['slarrows']),
                'arrow_prev_txt'  => $settings['slprevicon'],
                'arrow_next_txt'  => $settings['slnexticon'],
                'dots'            => ('yes' === $settings['sldots']),
                'autoplay'        => ('yes' === $settings['slautolay']),
                'autoplay_speed'  => absint($settings['slautoplay_speed']),
                'animation_speed' => absint($settings['slanimation_speed']),
                'pause_on_hover'  => ('yes' === $settings['slpause_on_hover']),
                'center_mode'     => ( 'yes' === $settings['slcentermode']),
                'center_padding'  => absint($settings['slcenterpadding']),
                'rows'            => absint($settings['slrows']),
                'fade'            => ( 'yes' === $settings['slfade']),
                'focusonselect'   => ( 'yes' === $settings['slfocusonselect']),
                'vertical'        => ( 'yes' === $settings['slvertical']),
                'rtl'             => ( 'yes' === $settings['slrtl']),
                'infinite'        => ( 'yes' === $settings['slinfinite']),
            ];

            $slider_responsive_settings = [
                'display_columns'        => $settings['slitems'],
                'scroll_columns'         => $settings['slscroll_columns'],
                'tablet_width'           => $settings['sltablet_width'],
                'tablet_display_columns' => $settings['sltablet_display_columns'],
                'tablet_scroll_columns'  => $settings['sltablet_scroll_columns'],
                'mobile_width'           => $settings['slmobile_width'],
                'mobile_display_columns' => $settings['slmobile_display_columns'],
                'mobile_scroll_columns'  => $settings['slmobile_scroll_columns'],

            ];

            $slider_settings = array_merge( $slider_settings, $slider_responsive_settings );
            $this->add_render_attribute( 'ultimate_carousel_attr', 'data-settings', wp_json_encode( $slider_settings ) );
        }else{
            $this->add_render_attribute( 'ultimate_carousel_attr', 'class', 'ultimate__slide__content__grid' );            
        }

        $this->add_render_attribute( 'ultimate_carousel_item_parent_attr', 'class', 'ultimate__image__slide__item__parent' );
        $this->add_render_attribute( 'ultimate_carousel_item_attr', 'class', 'single__image__slide ultimate__image__slide__layout__'.$settings['image_carousel_style'] );
        ?>
        <div <?php echo $this->get_render_attribute_string('ultimate_carousel_wrap'); ?>>
            <div <?php echo $this->get_render_attribute_string('ultimate_carousel_attr'); ?>>

                <?php foreach ( $settings['carosul_image_list'] as $imagecarosul ): ?>
                    <div <?php echo $this->get_render_attribute_string('ultimate_carousel_item_parent_attr'); ?>>
                        <div <?php echo $this->get_render_attribute_string('ultimate_carousel_item_attr'); ?>>
                            <?php 
                                if( $settings['link_click_event'] == 'lightbox' ){
                                    echo '<a href="'.$imagecarosul['carosul_image']['url'].'" class="lightbox"  >'.Group_Control_Image_Size::get_attachment_image_html( $imagecarosul, 'carosul_imagesize', 'carosul_image' ).'</a>';
                                }elseif( $settings['link_click_event'] == 'custom_link' ){
                                    if ( ! empty( $imagecarosul['custom_link']['url'] ) ) {
                                        $link_attr = 'href="'.esc_url($imagecarosul['custom_link']['url']).'"';
                                        if ( $imagecarosul['custom_link']['is_external'] ) {
                                            $link_attr .= ' target="_blank"';
                                        }
                                        if ( ! empty( $imagecarosul['custom_link']['nofollow'] ) ) {
                                            $link_attr .= ' rel="nofollow"';
                                        }
                                        echo '<a '.$link_attr.' >'.Group_Control_Image_Size::get_attachment_image_html( $imagecarosul, 'carosul_imagesize', 'carosul_image' ).'</a>';
                                    }else{
                                        echo Group_Control_Image_Size::get_attachment_image_html( $imagecarosul, 'carosul_imagesize', 'carosul_image' );                  
                                    }
                                    unset($link_attr);
                                }else{
                                    echo Group_Control_Image_Size::get_attachment_image_html( $imagecarosul, 'carosul_imagesize', 'carosul_image' );
                                }
                            ?>
                            <?php if( $settings['show_caption'] == 'yes' and !empty($imagecarosul['carosul_image_title']) ): ?>
                                <h3 class="image__caption"><?php echo esc_html($imagecarosul['carosul_image_title']); ?></h3>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

            <?php if( $settings['slarrows'] == 'yes' || $settings['sldots'] == 'yes' ) : ?>

                <div class="owl-controls">
                <?php if( $settings['slarrows'] == 'yes' ) : ?>
                    <div class="ultimate-carousel-nav<?php echo esc_attr( $slideid ); ?> owl-nav"></div>
                <?php endif; ?>

                <?php if( $settings['sldots'] == 'yes' ) : ?>
                    <div class="ultimate-carousel-dots<?php echo esc_attr( $slideid ); ?> owl-dots"></div>
                <?php endif; ?>
                </div>

            <?php endif; ?>

        </div>
    <?php
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new Ultimate_Image_Carousel() );