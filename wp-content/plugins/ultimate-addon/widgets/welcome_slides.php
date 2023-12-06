<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Ultimate_Welcome_Slides_Widget extends Widget_Base {

    public function get_name() {
        return 'Ultimate_Welcome_Slides_Widget';
    }
    
    public function get_title() {
        return __( 'Welcome Slides', 'ultimate' );
    }

    public function get_icon() {
        return 'eicon-slides';
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
        return[
            'slick',
        ];
    }

    static function content_content_layout_style(){
        return[
            'ultimate__slides__layout__1'      => esc_html__( 'Style One', 'ultimate' ),
            'ultimate__slides__layout__2'      => esc_html__( 'Style Two', 'ultimate' ),
            'ultimate__slides__layout__custom' => esc_html__( 'Custom Style', 'ultimate' ),
        ];
    }
    
    protected function _register_controls() {

        /*---------------------------
            CONTENT SECTION
        -----------------------------*/
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content Section & Layout', 'ultimate' ),
            ]
        );
            $this->add_control(
                'content_style_heading',
                [
                    'label' => esc_html__( 'Slides Layout Style', 'ultimate' ),
                    'type'  => Controls_Manager::HEADING,
                ]
            );
            $this->add_control(
                'content_layout_style',
                [
                    'label'     => esc_html__( 'Content Style', 'ultimate' ),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'ultimate__slides__layout__1',
                    'options'   => self::content_content_layout_style(),
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'content_slider_heading',
                [
                    'label'     => esc_html__( 'Slider Settings', 'ultimate' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'slider_on',
                [
                    'label'        => esc_html__( 'Slider On', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'On', 'ultimate' ),
                    'label_off'    => esc_html__( 'Off', 'ultimate' ),
                    'return_value' => 'yes',
                    'default'      => 'no',
                    'separator'    => 'before',
                ]
            );

            $repeater = new Repeater();
            $repeater->add_control(
                'content_image',
                [
                    'label'   => esc_html__( 'Image', 'ultimate' ),
                    'type'    => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'separator' => 'before',
                ]
            );
            $repeater->add_group_control(
                Group_Control_Image_Size:: get_type(),
                [
                    'name'      => 'content_imagesize',
                    'default'   => 'large',
                    'separator' => 'none',
                    'separator' => 'before',
                ]
            );
            $repeater->add_control(
                'content_title',
                [
                    'label'     => esc_html__( 'Title', 'ultimate' ),
                    'type'      => Controls_Manager::TEXT,
                    'default'   => esc_html__('Example Title #1','ultimate'),
                    'separator' => 'before',
                ]
            );
            $repeater->add_control(
                'content_subtitle',
                [
                    'label'       => esc_html__( 'Subtitle', 'ultimate' ),
                    'type'        => Controls_Manager::TEXT,
                    'separator' => 'before',
                ]
            );
            $repeater->add_control(
                'content_description',
                [
                    'label'     => esc_html__( 'Description', 'ultimate' ),
                    'type'      => Controls_Manager::WYSIWYG,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'content_items_heading',
                [
                    'label'     => esc_html__( 'Slides Items', 'ultimate' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'content_slide_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => array_values( $repeater->get_controls() ),
                    'default' => [
                        [
                            'content_title' => esc_html__('Title #1','ultimate'),
                        ],
                    ],
                    'title_field' => '{{{ content_title }}}',
                    'separator'   => 'before',
                ]
            );
            $this->add_control(
                'link_click_event',
                [
                    'label'   => esc_html__( 'Click Event', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'none',
                    'options' => [
                        'none'        => esc_html__( 'None', 'ultimate' ),
                        'lightbox'    => esc_html__( 'Lightbox', 'ultimate' ),
                        'custom_link' => esc_html__( 'Custom Link', 'ultimate' ),
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'content_options_heading',
                [
                    'label'     => esc_html__( 'Content Options', 'ultimate' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'show_content',
                [
                    'label'        => esc_html__( 'Show Content ?', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'On', 'ultimate' ),
                    'label_off'    => esc_html__( 'Off', 'ultimate' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'separator'    => 'before',
                ]
            );
            $this->add_control(
                'show_title',
                [
                    'label'        => esc_html__( 'Show Title ?', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'On', 'ultimate' ),
                    'label_off'    => esc_html__( 'Off', 'ultimate' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'separator'    => 'before',
                    'condition' => [
                        'show_content' => 'yes',
                    ],
                ]
            );
            $this->add_control(
                'show_subtitle',
                [
                    'label'        => esc_html__( 'Show Subtitle', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'On', 'ultimate' ),
                    'label_off'    => esc_html__( 'Off', 'ultimate' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'separator'    => 'before',
                    'condition' => [
                        'show_content' => 'yes',
                    ],
                ]
            );
            $this->add_control(
                'show_description',
                [
                    'label'        => esc_html__( 'Show Description ?', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'On', 'ultimate' ),
                    'label_off'    => esc_html__( 'Off', 'ultimate' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'separator'    => 'before',
                    'condition' => [
                        'show_content' => 'yes',
                    ],
                ]
            );
            $this->add_control(
                'content_size',
                [
                    'label'     => esc_html__( 'Content Total Words', 'ultimate' ),
                    'type'      => Controls_Manager::NUMBER,
                    'min'       => 1,
                    'max'       => 50,
                    'step'      => 1,
                    'default'   => 10,
                    'condition' => [
                        'show_description' => 'yes',
                        'show_content' => 'yes',
                    ],
                ]
            );
        $this->end_controls_section();
        /*---------------------------
            CONTENT SECTION END
        -----------------------------*/

        /*---------------------------
            CAROUSEL SETTING
        -----------------------------*/
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
                        '{{WRAPPER}} .single__welcome__slide__item' => 'margin: calc( {{VALUE}}px / 2 );',
                        '{{WRAPPER}} .slick-list'            => 'margin: calc( -{{VALUE}}px / 2 );',
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
                        'inside_vertical_center_nav'  => esc_html__( 'Inside Vertical Center', 'ultimate' ),
                        'outside_vertical_center_nav' => esc_html__( 'Outside Vertical Center', 'ultimate' ),
                        'top_left_nav'                => esc_html__( 'Top Left', 'ultimate' ),
                        'top_center_nav'              => esc_html__( 'Top Center', 'ultimate' ),
                        'top_right_nav'               => esc_html__( 'Top Right', 'ultimate' ),
                        'bottom_left_nav'             => esc_html__( 'Bottom Left', 'ultimate' ),
                        'bottom_center_nav'           => esc_html__( 'Bottom Center', 'ultimate' ),
                        'bottom_right_nav'            => esc_html__( 'Bottom Right', 'ultimate' ),
                    ],
                    'condition' => [
                        'slarrows' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slprevicon',
                [
                    'label'     => esc_html__( 'Previous icon', 'ultimate' ),
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
                    'label'     => esc_html__( 'Next icon', 'ultimate' ),
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
                    'label'        => esc_html__( 'Arrow Visibility', 'ultimate' ),
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
                    'label_off'    => esc_html__('No', 'ultimate'),
                    'label_on'     => esc_html__('Yes', 'ultimate'),
                    'return_value' => 'yes',
                    'separator'    => 'before',
                    'default'      => 'yes',
                    'label'        => esc_html__('Pause on Hover?', 'ultimate'),
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
                    'label'     => esc_html__('Autoplay speed', 'ultimate'),
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
                    'label'     => esc_html__('Autoplay animation speed', 'ultimate'),
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
                    'label'     => esc_html__('Slider item to scroll', 'ultimate'),
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
                    'label'     => esc_html__( 'Tablet', 'ultimate' ),
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
                    'label'     => esc_html__('Slider Items', 'ultimate'),
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
                    'label'     => esc_html__('Slider item to scroll', 'ultimate'),
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
                    'label'       => esc_html__('Tablet Resolution', 'ultimate'),
                    'description' => esc_html__('The resolution to tablet.', 'ultimate'),
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
                    'label'     => esc_html__( 'Mobile Phone', 'ultimate' ),
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
                    'label'     => esc_html__('Slider Items', 'ultimate'),
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
                    'label'     => esc_html__('Slider item to scroll', 'ultimate'),
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
                    'label'       => esc_html__('Mobile Resolution', 'ultimate'),
                    'description' => esc_html__('The resolution to mobile.', 'ultimate'),
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
                'label' => esc_html__( 'Area Style', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_responsive_control(
                'area_width',
                [
                    'label'      => esc_html__( 'Width', 'ultimate' ),
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
                        '{{WRAPPER}}' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'area_margin',
                [
                    'label'      => esc_html__( 'Margin', 'ultimate' ),
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
            AREA STYLE END
        --------------------------*/

        /*-------------------------
            ITEM PARENT STYLE
        --------------------------*/
        $this->start_controls_section(
            'item_grid_style_section',
            [
                'label'     => esc_html__( 'Column Style', 'ultimate' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_on!' => 'yes',
                ]
            ]
        );
            $this->add_responsive_control(
                'item_grid_margin',
                [
                    'label'      => esc_html__( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__slide__item__parent' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );        
            $this->add_responsive_control(
                'item_grid_padding',
                [
                    'label'      => esc_html__( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__slide__item__parent' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );        
    		$this->add_responsive_control(
    			'item_grid_width',
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
    						'min'  => 0,
    						'max'  => 100,
    						'step' => 0.1,
    					]
    				],
    				'default' => [
    					'unit' => '%',
    				],
    				'selectors' => [
                        '{{WRAPPER}} .ultimate__slide__item__parent' => 'width:{{SIZE}}{{UNIT}};',
    				],
    			]
    		);
        $this->end_controls_section();
        /*-------------------------
            ITEM PARENT STYLE END
        --------------------------*/

        /*-------------------------
            CENTER ITEM STYLE
        --------------------------*/
        $this->start_controls_section(
            'center_item_style_section',
            [
                'label'     => esc_html__( 'Center Item Style', 'ultimate' ),
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
                    'name'     => 'center_item_image_filters',
                    'selector' => '{{WRAPPER}} .ultimate__slide__item__parent.slick-active.slick-center img',
                ]
            );
            
            $this->add_control(
                'center_item_opacity',
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
                        '{{WRAPPER}} .ultimate__slide__item__parent.slick-active.slick-center'  => 'opacity:{{SIZE}};',
                        '{{WRAPPER}} .slick-active.slick-center .ultimate__slide__item__parent' => 'opacity:{{SIZE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'center_item_margin',
                [
                    'label'      => esc_html__( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__slide__item__parent.slick-active.slick-center'  => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .slick-active.slick-center .ultimate__slide__item__parent' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );        
            $this->add_responsive_control(
                'center_item_padding',
                [
                    'label'      => esc_html__( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__slide__item__parent.slick-active.slick-center'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .slick-active.slick-center .ultimate__slide__item__parent' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'center_item_scale',
                [
                    'label' => esc_html__( 'Scale', 'ultimate' ),
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
                        '{{WRAPPER}} .ultimate__slide__item__parent.slick-active.slick-center'  => 'transform: scale({{SIZE}});',
                        '{{WRAPPER}} .slick-active.slick-center .ultimate__slide__item__parent' => 'transform: scale({{SIZE}});',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'center_item_transition',
                [
                    'label' => esc_html__( 'Transition', 'ultimate' ),
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
                        '{{WRAPPER}} .ultimate__slide__item__parent' => 'transition: {{SIZE}}s;',
                        '{{WRAPPER}} .slick-slide'                     => 'transition: {{SIZE}}s;',
                    ],
                    'separator' => 'before',
                ]
            );
        $this->end_controls_section();
        /*-------------------------
            END CENTER ITEM STYLE
        --------------------------*/

        /*-------------------------
            BOX STYLE
        --------------------------*/
        $this->start_controls_section(
            'box_style_section',
            [
                'label' => esc_html__( 'Item Style', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'box_single_item_opacity',
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
                        '{{WRAPPER}} .ultimate__slide__item__parent' => 'opacity:{{SIZE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'box_typography',
                    'selector' => '{{WRAPPER}} .single__welcome__slide__item',
                ]
            );
            $this->add_control(
                'box_color',
                [
                    'label'     => esc_html__( 'Color', 'ultimate' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .single__welcome__slide__item' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'box_background',
                    'label'    => esc_html__( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .single__welcome__slide__item',
                ]
            );
           $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'box_box_shadow',
                    'label'    => esc_html__( 'Box Shadow', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .single__welcome__slide__item',
                ]
            );
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'box_border',
                    'label'    => esc_html__( 'Border', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .single__welcome__slide__item',
                ]
            );
            $this->add_responsive_control(
                'box_radius',
                [
                    'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .single__welcome__slide__item' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'box_margin',
                [
                    'label'      => esc_html__( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .single__welcome__slide__item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'box_padding',
                [
                    'label'      => esc_html__( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .single__welcome__slide__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'box_item_horizontal_align',
                [
                    'label'   => esc_html__( 'Vertical Align', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'align-items:center;',
                    'options' => [
                        'align-items:center;'     => esc_html__( 'Center', 'ultimate' ),
                        'align-items:flex-start;' => esc_html__( 'Start', 'ultimate' ),
                        'align-items:flex-end;'   => esc_html__( 'End', 'ultimate' ),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .slick-slider .slick-track' => 'display: flex; {{VALUE}}',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'box_align',
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
                        '{{WRAPPER}} .single__welcome__slide__item,{{WRAPPER}} .single__welcome__slide__item img' => 'margin: 0 auto; text-align: {{VALUE}};',
                    ],
                    'separator' => 'after',
                ]
            );
            $this->add_responsive_control(
                'box_nth_child_margin',
                [
                    'label'      => esc_html__( 'Item Nth Child 2 Margin Vartically', 'ultimate' ),
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
                        '{{WRAPPER}} .ultimate__slide__item__parent:nth-child(2n)' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'box_transition',
                [
                    'label'      => esc_html__( 'Transition', 'ultimate' ),
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
                        '{{WRAPPER}} .single__welcome__slide__item,{{WRAPPER}} .single__welcome__slide__item img' => 'transition: {{SIZE}}s;',
                    ],
                ]
            );
            $this->add_control(
                'box_opacity',
                [
                    'label'      => esc_html__( 'Opacity', 'ultimate' ),
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
                        '{{WRAPPER}} .single__welcome__slide__item' => 'opacity: {{SIZE}};',
                    ],
                ]
            );
            $this->add_control(
                'box_hover_title',
                [
                    'label'     => esc_html__( 'Item Hover', 'ultimate' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'box_hover_opacity',
                [
                    'label'      => esc_html__( 'Opacity', 'ultimate' ),
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
                        '{{WRAPPER}} .single__welcome__slide__item:hover' => 'opacity: {{SIZE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'box_hover_margin',
                [
                    'label'      => esc_html__( 'Item Hover Offset Vartically', 'ultimate' ),
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
                        '{{WRAPPER}} .ultimate__slide__item__parent:hover' => 'transform: translateY({{SIZE}}{{UNIT}});',
                    ],
                    'separator' => 'before',
                ]
            );
        $this->end_controls_section();
        /*-------------------------
            BOX STYLE END
        --------------------------*/

        /*----------------------------
            IMAGE WRAP
        -----------------------------*/
        $this->start_controls_section(
            'image_wrap_style_section',
            [
                'label' => __( 'Image Wrap', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_responsive_control(
                'image_wrap_width',
                [
                    'label'      => esc_html__( 'Item Image Width', 'ultimate' ),
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
                        '{{WRAPPER}} .slide__item__thumbnail img' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'image_wrap_background',
                    'label'    => __( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .slide__item__thumbnail',
                ]
            );
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'image_wrap_border',
                    'label'    => __( 'Border', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .slide__item__thumbnail',
                ]
            );
            $this->add_responsive_control(
                'image_wrap_radius',
                [
                    'label'      => __( 'Border Radius', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .slide__item__thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'image_wrap_shadow',
                    'selector' => '{{WRAPPER}} .slide__item__thumbnail',
                ]
            );
            $this->add_responsive_control(
                'image_wrap_margin',
                [
                    'label'      => __( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .slide__item__thumbnail' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'image_wrap_padding',
                [
                    'label'      => __( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .slide__item__thumbnail' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        /*----------------------------
            IMAGE WRAP END
        -----------------------------*/

        /*----------------------------
            CONTENT WRAP STYLE
        -----------------------------*/
        $this->start_controls_section(
            'content_wrap_style_section',
            [
                'label' => __( 'Content Wrap', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs( 'content_wrap_tabs_style' );
                $this->start_controls_tab(
                    'content_wrap_normal_tab',
                    [
                        'label' => __( 'Normal', 'ultimate' ),
                    ]
                );
                    $this->add_control(
                        'content_wrap_color',
                        [
                            'label'     => __( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .slide__item__content' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'content_wrap_typography',
                            'selector' => '{{WRAPPER}} .slide__item__content',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'content_wrap_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .slide__item__content',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'content_wrap_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .slide__item__content',
                        ]
                    );
                    $this->add_responsive_control(
                        'content_wrap_radius',
                        [
                            'label'      => __( 'Border Radius', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .slide__item__content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'content_wrap_shadow',
                            'selector' => '{{WRAPPER}} .slide__item__content',
                        ]
                    );
                    $this->add_responsive_control(
                        'content_wrap_width',
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
                                '{{WRAPPER}} .slide__item__content' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'content_wrap_margin',
                        [
                            'label'      => __( 'Margin', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .slide__item__content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'content_wrap_padding',
                        [
                            'label'      => __( 'Padding', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .slide__item__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'content_wrap_hover_tab',
                    [
                        'label' => __( 'Hover', 'ultimate' ),
                    ]
                );
                    $this->add_control(
                        'hover_content_wrap_color',
                        [
                            'label'     => __( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .single__welcome__slide__item:hover .slide__item__content' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'hover_content_wrap_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .single__welcome__slide__item:hover .slide__item__content',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'hover_content_wrap_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .single__welcome__slide__item:hover .slide__item__content',
                        ]
                    );
                    $this->add_responsive_control(
                        'hover_content_wrap_radius',
                        [
                            'label'      => __( 'Border Radius', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__welcome__slide__item:hover .slide__item__content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'hover_content_wrap_shadow',
                            'selector' => '{{WRAPPER}} .single__welcome__slide__item:hover .slide__item__content',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*----------------------------
            CONTENT WRAP STYLE END
        -----------------------------*/
        
        /*-------------------------
            TITLE STYLE
        --------------------------*/
        $this->start_controls_section(
            'title_section_style',
            [
                'label'     => esc_html__( 'Title', 'ultimate' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );
            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'title_typography',
                    'selector' => '{{WRAPPER}} .slide__title',
                ]
            );
            $this->add_control(
                'title_color',
                [
                    'label'     => esc_html__( 'Color', 'ultimate' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .slide__title' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'title_background',
                    'label'    => esc_html__( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .slide__title',
                ]
            );
            $this->add_responsive_control(
                'title_margin',
                [
                    'label'      => esc_html__( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .slide__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'title_padding',
                [
                    'label'      => esc_html__( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .slide__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
        $this->end_controls_section();
        /*-------------------------
            TITLE STYLE END
        --------------------------*/
        
        /*-------------------------
            SUBTITLE
        --------------------------*/
        $this->start_controls_section(
            'subtitle_section_style',
            [
                'label'     => esc_html__( 'Subtitle', 'ultimate' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );
            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'subtitle_typography',
                    'selector' => '{{WRAPPER}} .slide__subtitle',
                ]
            );
            $this->add_control(
                'subtitle_color',
                [
                    'label'     => esc_html__( 'Color', 'ultimate' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .slide__subtitle' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'subtitle_background',
                    'label'    => esc_html__( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .slide__subtitle',
                ]
            );
            $this->add_responsive_control(
                'subtitle_margin',
                [
                    'label'      => esc_html__( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .slide__subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'subtitle_padding',
                [
                    'label'      => esc_html__( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .slide__subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
        $this->end_controls_section();
        /*-------------------------
            SUBTITLE END
        --------------------------*/

        /*----------------------------
            DESCRIPTION STYLE
        -----------------------------*/
        $this->start_controls_section(
            'description_style_section',
            [
                'label'     => __( 'Description', 'ultimate' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_content' => 'yes'
                ],
            ]
        );
            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'description_typography',
                    'selector' => '{{WRAPPER}} .slide__description',
                ]
            );
            $this->add_control(
                'description_color',
                [
                    'label'     => __( 'Color', 'ultimate' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        '{{WRAPPER}} .slide__description' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'description_background',
                    'label'    => __( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .slide__description',
                ]
            );
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'description_border',
                    'label'    => __( 'Border', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .slide__description',
                ]
            );
            $this->add_responsive_control(
                'description_radius',
                [
                    'label'      => __( 'Border Radius', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .slide__description' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'description_shadow',
                    'selector' => '{{WRAPPER}} .slide__description',
                ]
            );
            $this->add_responsive_control(
                'description_margin',
                [
                    'label'      => __( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .slide__description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'description_padding',
                [
                    'label'      => __( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .slide__description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        /*----------------------------
            DESCRIPTION STYLE END
        -----------------------------*/
        
        /*----------------------------
            SLIDER NAV WARP
        -----------------------------*/
        $this->start_controls_section(
            'slider_control_warp_style_section',
            [
                'label'     => esc_html__( 'Slider Arrow Warp', 'ultimate' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_on' => 'yes',
                    'slarrows'  => 'yes',
                ],
            ]
        );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'slider_nav_warp_background',
                    'label'    => esc_html__( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav',
                ]
            );
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'slider_nav_warp_border',
                    'label'    => esc_html__( 'Border', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav',
                ]
            );
            $this->add_control(
                'slider_nav_warp_radius',
                [
                    'label'      => esc_html__( 'Border Radius', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .sldier-content-area .owl-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'slider_nav_warp_shadow',
                    'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav',
                ]
            );
            $this->add_responsive_control(
                'slider_nav_warp_display',
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
                        '{{WRAPPER}} .sldier-content-area .owl-nav' => 'display: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'slider_nav_warp_position',
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
                        '{{WRAPPER}} .sldier-content-area .owl-nav' => 'position: {{VALUE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'slider_nav_warp_position_from_left',
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
                        '{{WRAPPER}} .sldier-content-area .owl-nav' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'slider_nav_warp_position' => ['absolute','relative']
                    ],
                ]
            );
            $this->add_responsive_control(
                'slider_nav_warp_position_from_right',
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
                        '{{WRAPPER}} .sldier-content-area .owl-nav' => 'right: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'slider_nav_warp_position' => ['absolute','relative']
                    ],
                ]
            );
            $this->add_responsive_control(
                'slider_nav_warp_position_from_top',
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
                        '{{WRAPPER}} .sldier-content-area .owl-nav' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'slider_nav_warp_position' => ['absolute','relative']
                    ],
                ]
            );
            $this->add_responsive_control(
                'slider_nav_warp_position_from_bottom',
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
                        '{{WRAPPER}} .sldier-content-area .owl-nav' => 'bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'slider_nav_warp_position' => ['absolute','relative']
                    ],
                ]
            );
            $this->add_responsive_control(
                'slider_nav_warp_align',
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
                        '{{WRAPPER}} .sldier-content-area .owl-nav' => 'text-align: {{VALUE}};',
                    ],
                    'default' => '',
                ]
            );
            $this->add_responsive_control(
                'slider_nav_warp_width',
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
                        '{{WRAPPER}} .sldier-content-area .owl-nav' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'slider_nav_warp_height',
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
                        '{{WRAPPER}} .sldier-content-area .owl-nav' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_control(
                'slider_nav_warp_opacity',
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
                        '{{WRAPPER}} .sldier-content-area .owl-nav' => 'opacity: {{SIZE}};',
                    ],
                ]
            );
            $this->add_control(
                'slider_nav_warp_zindex',
                [
                    'label'     => esc_html__( 'Z-Index', 'ultimate' ),
                    'type'      => Controls_Manager::NUMBER,
                    'min'       => -99,
                    'max'       => 99,
                    'step'      => 1,
                    'selectors' => [
                        '{{WRAPPER}} .sldier-content-area .owl-nav' => 'z-index: {{SIZE}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'slider_nav_warp_margin',
                [
                    'label'      => esc_html__( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .sldier-content-area .owl-nav' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'slider_nav_warp_padding',
                [
                    'label'      => esc_html__( 'Padding', 'ultimate' ),
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
                'label'     => esc_html__( 'Arrow', 'ultimate' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_on' => 'yes',
                    'slarrows'  => 'yes',
                ],
            ]
        );
            $this->start_controls_tabs( 'slider_arrow_style_tabs' );
                $this->start_controls_tab(
                    'slider_arrow_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'ultimate' ),
                    ]
                );
                    $this->add_control(
                        'slider_arrow_color',
                        [
                            'label'  => esc_html__( 'Color', 'ultimate' ),
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
                            'label'      => esc_html__( 'Font Size', 'ultimate' ),
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
                            'label'    => esc_html__( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .sldier-content-area .slick-arrow',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'slider_arrow_border',
                            'label'    => esc_html__( 'Border', 'ultimate' ),
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
                            'label'      => esc_html__( 'Margin', 'ultimate' ),
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
                            'label'      => esc_html__( 'Padding', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .sldier-content-area .slick-arrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'slide_button_position_from_left',
                        [
                            'label'      => esc_html__( 'Left Arrow Position From Left', 'ultimate' ),
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
                    $this->add_responsive_control(
                        'slide_button_position_from_bottom',
                        [
                            'label'      => esc_html__( 'Left Arrow Position From Top', 'ultimate' ),
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
                    $this->add_responsive_control(
                        'slide_button_position_from_right',
                        [
                            'label'      => esc_html__( 'Right Arrow Position From Right', 'ultimate' ),
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
                    $this->add_responsive_control(
                        'slide_button_position_from_top',
                        [
                            'label'      => esc_html__( 'Right Arrow Position From Top', 'ultimate' ),
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
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'slider_arrow_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'ultimate' ),
                    ]
                );
                    $this->add_control(
                        'slider_arrow_hover_color',
                        [
                            'label'  => esc_html__( 'Color', 'ultimate' ),
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
                            'label'    => esc_html__( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .sldier-content-area .slick-arrow:hover',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'slider_arrow_hover_border',
                            'label'    => esc_html__( 'Border', 'ultimate' ),
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
                    $this->add_responsive_control(
                        'slide_button_hover_position_from_left',
                        [
                            'label'      => esc_html__( 'Left Arrow Position From Left', 'ultimate' ),
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
                    $this->add_responsive_control(
                        'slide_button_hover_position_from_bottom',
                        [
                            'label'      => esc_html__( 'Left Arrow Position From Top', 'ultimate' ),
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
                    $this->add_responsive_control(
                        'slide_button_hover_position_from_right',
                        [
                            'label'      => esc_html__( 'Right Arrow Position From Right', 'ultimate' ),
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
                    $this->add_responsive_control(
                        'slide_button_hover_position_from_top',
                        [
                            'label'      => esc_html__( 'Right Arrow Position From Top', 'ultimate' ),
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
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*------------------------
             ARROW STYLE END
        --------------------------*/

        /*----------------------------
            SLIDER DOTS WARP
        -----------------------------*/
        $this->start_controls_section(
            'slider_dots_warp_style_section',
            [
                'label'     => esc_html__( 'Slider Dots Warp', 'ultimate' ),
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
                    /*$this->add_control(
                        'pagination_wrap_heading',
                        [
                            'label'     => esc_html__( 'Pagination Wrap', 'ultimate' ),
                            'type'      => Controls_Manager::HEADING,
                            'separator' => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'pagination_warp_margin',
                        [
                            'label'      => esc_html__( 'Margin', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'separator'  => 'before',
                            'selectors'  => [
                                '{{WRAPPER}} .sldier-content-area .owl-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'pagi_war_align',
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
                                    'title' => esc_html__( 'Justified', 'ultimate' ),
                                    'icon'  => 'fa fa-align-justify',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .owl-dots' => 'text-align: {{VALUE}};',
                            ],
                        ]
                    );*/
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
        $gallery_id = $this->get_id();
        // Carousel Aea Atrribute
        $this->add_render_attribute( 'ultimate_content_main_wrap', 'class', 'sldier-content-area' );
        $this->add_render_attribute( 'ultimate_content_main_wrap', 'class', $settings['nav_position'] );
        // Gallery Wrap Class
        $this->add_render_attribute( 'ultimate_content_main_wrap', 'class', 'ultimate-slides-content-area' );

        if( $settings['slider_on'] == 'yes' ){

            $this->add_render_attribute( 'ultimate_content_wrap_attr', 'class', 'ultimate-carousel-activation' );
            $slideid = rand(2564,1245);

            $slider_settings = [
                'gallery_id'      => $gallery_id,
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
            $this->add_render_attribute( 'ultimate_content_wrap_attr', 'data-settings', wp_json_encode( $slider_settings ) );
        }else{
            $this->add_render_attribute( 'ultimate_content_wrap_attr', 'class', 'ultimate-welcome-area' );
        }

        $this->add_render_attribute( 'ultimate_carousel_item_parent_attr', 'class', 'ultimate__slide__item__parent' );




        $this->add_render_attribute( 'ultimate_carousel_item_attr', 'class', 'single__welcome__slide__item' );
        $this->add_render_attribute( 'ultimate_carousel_item_attr', 'class', $settings['content_layout_style'] );
        ?>
        <div <?php echo $this->get_render_attribute_string('ultimate_content_main_wrap'); ?>>

            <div <?php echo $this->get_render_attribute_string('ultimate_content_wrap_attr'); ?>>

                <?php foreach ( $settings['content_slide_list'] as $single_item ): ?>

                <?php 
                    $img_array = $single_item['content_image'];
                    $img_link  = wp_get_attachment_image_url( $img_array['id'], 'full' );
                ?>

                    <div <?php echo $this->get_render_attribute_string('ultimate_carousel_item_parent_attr'); ?>>
                        <div class="single__slide__bg__overlay" style="background:url(<?php echo esc_url($img_link); ?>) no-repeat center center / cover;"></div>
                        <div <?php echo $this->get_render_attribute_string('ultimate_carousel_item_attr'); ?>>
                            <div class="slide__item__thumbnail">
                                <?php 
                                    if( $settings['link_click_event'] == 'lightbox' ){
                                        echo '<a href="'.$single_item['content_image']['url'].'" class="lightbox"  >'.Group_Control_Image_Size::get_attachment_image_html( $single_item, 'content_imagesize', 'content_image' ).'</a>';
                                    }elseif( $settings['link_click_event'] == 'custom_link' ){
                                        if ( ! empty( $single_item['custom_link']['url'] ) ) {
                                            $link_attr = 'href="'.esc_url($single_item['custom_link']['url']).'"';
                                            if ( $single_item['custom_link']['is_external'] ) {
                                                $link_attr .= ' target="_blank"';
                                            }
                                            if ( ! empty( $single_item['custom_link']['nofollow'] ) ) {
                                                $link_attr .= ' rel="nofollow"';
                                            }
                                            echo '<a '.$link_attr.' >'.Group_Control_Image_Size::get_attachment_image_html( $single_item, 'content_imagesize', 'content_image' ).'</a>';
                                        }else{
                                            echo Group_Control_Image_Size::get_attachment_image_html( $single_item, 'content_imagesize', 'content_image' );                  
                                        }
                                        unset($link_attr);
                                    }else{
                                        echo Group_Control_Image_Size::get_attachment_image_html( $single_item, 'content_imagesize', 'content_image' );
                                    }
                                ?>
                            </div>
                            <?php if( 'yes' == $settings['show_content'] && ( !empty( $single_item['content_subtitle'] || $single_item['content_title'] || $single_item['content_description'] ) ) ) : ?>
                            <div class="slide__item__content">

                                <?php if( 'yes' == $settings['show_subtitle'] && !empty($single_item['content_subtitle']) ): ?>
                                    <div class="slide__subtitle"><?php echo esc_html( $single_item['content_subtitle'] ); ?></div>
                                <?php endif; ?>

                                <?php if( $settings['show_title'] == 'yes' && !empty($single_item['content_title']) ): ?>
                                    <h3 class="slide__title"><?php echo esc_html($single_item['content_title']); ?></h3>
                                <?php endif; ?>

                                <?php if( 'yes' == $settings['show_description'] && !empty($single_item['content_description']) ): ?>
                                    <?php $description = wp_trim_words( $single_item['content_description'], $settings['content_size'] ); ?>
                                    <div class="slide__description"><?php echo esc_html( $description ); ?></div>
                                <?php endif; ?>

                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>

            <?php if( ( $settings['slarrows'] == 'yes' || $settings['sldots'] == 'yes' ) && 'yes' == $settings['slider_on'] ) : ?>
                <!-- CUSTOM SLIDER CONTROL -->
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
Plugin::instance()->widgets_manager->register_widget_type( new Ultimate_Welcome_Slides_Widget() );