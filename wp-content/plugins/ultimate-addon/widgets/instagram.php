<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Ultimate_Instagram_Widget extends Widget_Base {

    public function get_name() {
        return 'Ultimate_Instagram_Widget';
    }
    
    public function get_title() {
        return esc_html__( 'Instagram', 'ultimate' );
    }

    public function get_icon() {
        return 'eicon-photo-library';
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

    public function ultimate_instagam_style(){
        return [
            '1' => esc_html__( 'Style One', 'ultimate' ),
            '2' => esc_html__( 'Style Two', 'ultimate' ),
            '3' => esc_html__( 'Style Three', 'ultimate' ),
            '4' => esc_html__( 'Style Four', 'ultimate' ),
        ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'instagram_content',
            [
                'label' => esc_html__( 'Instagram', 'ultimate' ),
            ]
        );
            $this->add_control(
                'instagram_style',
                [
                    'label'   => esc_html__( 'Style', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '1',
                    'options' => $this->ultimate_instagam_style(),
                ]
            );
            $this->add_control(
                'slider_on',
                [
                    'label'        => esc_html__( 'Slider ?', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'On', 'ultimate' ),
                    'label_off'    => esc_html__( 'Off', 'ultimate' ),
                    'return_value' => 'yes',
                    'default'      => 'no',
                    'separator'    => 'before',
                ]
            );
            $this->add_control(
                'content_source_heading',
                [
                    'label'     => esc_html__( 'Content Source', 'ultimate' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'userid',
                [
                    'label'       => esc_html__( 'Instagram User ID', 'ultimate' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( '8616541633', 'ultimate' ),
                    'label_block' => true,
                    'description' => wp_kses_post( '(<a href="'.esc_url('https://codeofaninja.com/tools/find-instagram-user-id').'" target="_blank">Lookup your User ID</a>)', 'ultimate' ),
                    'separator'   => 'before',
                ]
            );
            $this->add_control(
                'access_token',
                [
                    'label'       => esc_html__( 'Instagram Access Token', 'ultimate' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( '8616541633.2a45a81.15ce43649b1c489f989c87e4d7ec8b63', 'ultimate' ),
                    'label_block' => true,
                    'description' => wp_kses_post( '(<a href="'.esc_url('http://instagram.pixelunion.net/').'" target="_blank">Lookup your Access Token</a>)', 'ultimate' ),
                ]
            );
            $this->add_control(
                'content_heading',
                [
                    'label'     => esc_html__( 'Content Options', 'ultimate' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'limit',
                [
                    'label'     => esc_html__( 'Item Limit (Max 12)', 'ultimate' ),
                    'type'      => Controls_Manager::NUMBER,
                    'min'       => 1,
                    'max'       => 20,
                    'step'      => 1,
                    'default'   => 8,
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'instagram_columns',
                [
                    'label' => esc_html__( 'Columns', 'ultimate' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min'  => 1,
                            'max'  => 12,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'size' => 4
                    ],
                    'condition' => [
                        'slider_on!' => 'yes',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'instagram_gutter',
                [
                    'label'      => esc_html__( 'Columns Gutter', 'ultimate' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px','%' ],
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
                        'size' => 0
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ultimate__instagram__list li' => 'width:calc( 100% / {{instagram_columns.size}} - {{SIZE}}{{UNIT}} )!important; margin-left:{{SIZE}}{{UNIT}} !important;margin-bottom:{{SIZE}}{{UNIT}} !important; float:left !important;',
                        '{{WRAPPER}} .ultimate__instagram__list'     => 'margin-left:-{{SIZE}}{{UNIT}} !important;',
                    ],
                    'condition' => [
                        'slider_on!' => 'yes',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'instagram_image_size',
                [
                    'label'   => esc_html__( 'Image Size', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'standard_resolution',
                    'options' => [
                        'thumbnail'           => esc_html__( 'Thumbnail', 'ultimate' ),
                        'low_resolution'      => esc_html__( 'Medium', 'ultimate' ),
                        'standard_resolution' => esc_html__( 'Standard', 'ultimate' ),
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'show_flow_button',
                [
                    'label'        => esc_html__( 'Show Follow Button ?', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Show', 'ultimate' ),
                    'label_off'    => esc_html__( 'Hide', 'ultimate' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'separator'    => 'before',
                ]
            );
            $this->add_control(
                'short_by_tags',
                [
                    'label'        => esc_html__( 'Short By Tags ?', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Show', 'ultimate' ),
                    'label_off'    => esc_html__( 'Hide', 'ultimate' ),
                    'return_value' => 'yes',
                    'default'      => 'no',
                    'separator'    => 'before',
                ]
            );
            $this->add_control(
                'tag_name',
                [
                    'label'       => esc_html__( 'Tag Name', 'ultimate' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'restaurant', 'ultimate' ),
                    'label_block' => true,
                    'description' => esc_html__('Please write tag with out hash.', 'ultimate' ),
                    'condition'   => [
                        'short_by_tags' => 'yes',
                    ],
                ]
            );
            $this->add_control(
                'show_like',
                [
                    'label'        => esc_html__( 'Show Like ?', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Show', 'ultimate' ),
                    'label_off'    => esc_html__( 'Hide', 'ultimate' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'separator'    => 'before',
                ]
            );
            $this->add_control(
                'show_comment',
                [
                    'label'        => esc_html__( 'Show Comment ?', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Show', 'ultimate' ),
                    'label_off'    => esc_html__( 'Hide', 'ultimate' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'separator'    => 'before',
                ]
            );
            $this->add_control(
                'show_light_box',
                [
                    'label'        => esc_html__( 'Show In Light Box ?', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Show', 'ultimate' ),
                    'label_off'    => esc_html__( 'Hide', 'ultimate' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'separator'    => 'before',
                ]
            );
            $this->add_control(
                'popup_icon_type',
                [
                    'label'   => esc_html__('Popup Icon Type','ultimate'),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => [
                        'icon' =>[
                            'title' => esc_html__('Icon','ultimate'),
                            'icon'  => 'fa fa-info',
                        ],
                        'img' =>[
                            'title' => esc_html__('Image','ultimate'),
                            'icon'  => 'fa fa-picture-o',
                        ],
                    ],
                    'default'   => 'icon',
                    'condition' => [
                        'show_light_box' => 'yes',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'popup_image',
                [
                    'label'   => esc_html__('Image','ultimate'),
                    'type'    => Controls_Manager::MEDIA,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'condition' => [
                        'show_light_box'  => 'yes',
                        'popup_icon_type' => 'img',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_group_control(
                Group_Control_Image_Size:: get_type(),
                [
                    'name'      => 'popup_imagesize',
                    'default'   => 'large',
                    'separator' => 'none',
                    'condition' => [
                        'show_light_box'  => 'yes',
                        'popup_icon_type' => 'img',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'popup_icon',
                [
                    'label'     => esc_html__('Icon','ultimate'),
                    'type'      => Controls_Manager::ICON,
                    'default'   => 'fa fa-plus',
                    'condition' => [
                        'show_light_box'  => 'yes',
                        'popup_icon_type' => 'icon',
                    ],
                    'separator' => 'before',
                ]
            );
        $this->end_controls_section();

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
                        '{{WRAPPER}} .single__gallery__item' => 'margin: calc( {{VALUE}}px / 2 );',
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

        /*------------------------
             DOTS STYLE
        --------------------------*/
        $this->start_controls_section(
            'slider_pagination_style_section',
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
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'pagination_background',
                            'label'    => esc_html__( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .sldier-content-area .slick-dots li',
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
                        'pagination_warp_margin',
                        [
                            'label'      => esc_html__( 'Pagination Warp Margin', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .sldier-content-area .slick-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'pagi_war_align',
                        [
                            'label'   => esc_html__( 'Pagination Warp Alignment', 'ultimate' ),
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
                                '{{WRAPPER}} .sldier-content-area .slick-dots' => 'text-align: {{VALUE}};',
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

        /*===========================
            STYLE SECTION
        =============================*/
        /*---------------------------
            ITEM STYLE
        ----------------------------*/
        $this->start_controls_section(
            'htmega_instagram_item_style_section',
            [
                'label' => esc_html__( 'Item Style', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'instagram_item_background',
                    'label'    => esc_html__( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .ultimate__instagram__list li',
                ]
            );
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'instagram_item_border',
                    'label'    => esc_html__( 'Border', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .ultimate__instagram__list li',
                ]
            );
            $this->add_responsive_control(
                'instagram_item_border_radius',
                [
                    'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .ultimate__instagram__list li' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'instagram_item_margin',
                [
                    'label'      => esc_html__( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__instagram__list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'instagram_item_padding',
                [
                    'label'      => esc_html__( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__instagram__list li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        /*--------------------------
            ITEM STYLE END
        ---------------------------*/

        /*--------------------------
            CONTENT STYLE
        ---------------------------*/
        $this->start_controls_section(
            'htmega_instagram_style_section',
            [
                'label' => esc_html__( 'Content Wrap', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'instagram_color',
                [
                    'label'     => esc_html__( 'Color', 'ultimate' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .instagram__content__wrap' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'instagram_background',
                    'label'    => esc_html__( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .instagram__content__wrap',
                ]
            );
            $this->add_responsive_control(
                'instagram_border_radius',
                [
                    'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .instagram__content__wrap' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'instagram_margin',
                [
                    'label'      => esc_html__( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__instragram__feed .instagram__content__wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_responsive_control(
                'instagram_padding',
                [
                    'label'      => esc_html__( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__instragram__feed .instagram__content__wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        /*---------------------------
            CONTENT STYLE END
        -----------------------------*/

        /*--------------------------
            POPUP BUTTON STYLE
        ---------------------------*/
        $this->start_controls_section(
            'htmega_instagram_icon_style_section',
            [
                'label'     => esc_html__( 'Light Box Button', 'ultimate' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'popup_icon_type' => 'icon',
                    'popup_icon!'     => '',
                ]
            ]
        );
            $this->start_controls_tabs( 'instagram_icon_style_tabs' );
                $this->start_controls_tab(
                    'instagram_icon_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'ultimate' ),
                    ]
                );
                    $this->add_control(
                        'instagram_icon_color',
                        [
                            'label'     => esc_html__( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .instagram__btn a' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'instagram_icon_typography',
                            'selector' => '{{WRAPPER}} .instagram__btn a',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'instagram_icon_background',
                            'label'    => esc_html__( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .instagram__btn a',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'instagram_icon_border',
                            'label'    => esc_html__( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .instagram__btn a',
                        ]
                    );
                    $this->add_responsive_control(
                        'instagram_icon_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .instagram__btn a' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                    $this->add_control(
                        'instagram_icon_width',
                        [
                            'label'      => esc_html__( 'Width', 'ultimate' ),
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
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .instagram__btn a' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_control(
                        'instagram_icon_height',
                        [
                            'label'      => esc_html__( 'Height', 'ultimate' ),
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
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .instagram__btn a' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'instagram_icon_padding',
                        [
                            'label'      => esc_html__( 'Padding', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .instagram__btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'instagram_icon_margin',
                        [
                            'label'      => esc_html__( 'Margin', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .instagram__btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'instagram_icon_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'ultimate' ),
                    ]
                );
                    $this->add_control(
                        'instagram_icon_hover_color',
                        [
                            'label'     => esc_html__( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .instagram__btn a:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'instagram_icon_hover_background',
                            'label'    => esc_html__( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .instagram__btn a:hover',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'instagram_icon_hover_border',
                            'label'    => esc_html__( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .instagram__btn a:hover',
                        ]
                    );
                    $this->add_responsive_control(
                        'instagram_icon_hover_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .instagram__btn a:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*--------------------------
            POPUP BUTTON STYLE END
        ---------------------------*/

        /*-------------------------
            COMMENTS LIKE STYLE
        --------------------------*/
        $this->start_controls_section(
            'htmega_instagram_commentlike_style_section',
            [
                'label' => esc_html__( 'Comment & Like', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_like' => 'yes',
                ],
            ]
        );
            $this->add_control(
                'instagram_commentlike_color',
                [
                    'label'     => esc_html__( 'Color', 'ultimate' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .instagram__like__comment' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'instagram_commentlike_typography',
                    'selector' => '{{WRAPPER}} .instagram__like__comment',
                ]
            );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'instagram_commentlike_background',
                    'label'    => esc_html__( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .instagram__like__comment',
                ]
            );
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'instagram_commentlike_border',
                    'label'    => esc_html__( 'Border', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .instagram__like__comment',
                ]
            );
            $this->add_responsive_control(
                'instagram_commentlike_border_radius',
                [
                    'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .instagram__like__comment' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'instagram_commentlike_padding',
                [
                    'label'      => esc_html__( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .instagram__like__comment' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'instagram_commentlike_margin',
                [
                    'label'      => esc_html__( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .instagram__like__comment' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
        /*-------------------------
            COMMENTS LIKE STYLE END
        --------------------------*/
    }

    protected function render( $instance = [] ) {

        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'ultimate_instragram_wrap_attr', 'class', 'sldier-content-area' );
        $this->add_render_attribute( 'ultimate_instragram_wrap_attr', 'class', $settings['nav_position'] );

        $this->add_render_attribute( 'ultimate_instragram_wrap_attr', 'class', 'ultimate__instragram__feed' );
        $this->add_render_attribute( 'ultimate_instragram_wrap_attr', 'class', 'ultimate__instragram__feed__style__'.$settings['instagram_style'] );
        $imagesize = $settings['instagram_image_size'];

        $limit   = !empty( $settings['limit'] ) ? $settings['limit'] : 8;
        $user_id = !empty( $settings['userid'] ) ? $settings['userid'] : 3287251940;
        $tags    = !empty( $settings['tag_name'] ) ? $settings['tag_name'] : 'restaurant';
        $token   = !empty( $settings['access_token'] ) ? $settings['access_token'] : '3287251940.4ac71b3.d88be01ca9c94e2e8a2d923fe0a5169e';
        
        $response = wp_remote_get( 'https://api.instagram.com/v1/users/' . esc_attr( $user_id ) . '/media/recent/?access_token=' . esc_attr( $token ) .'&count=' . esc_attr( $limit ) );
        if ( 'yes' == $settings['short_by_tags'] && !empty( $settings['tag_name'] ) ) {
            $response = wp_remote_get( 'https://api.instagram.com/v1/tags/' . $tags . '/media/recent/?access_token=' . esc_attr( $token ) .'&count=' . esc_attr( $limit ) );
        }
        
        if ( ! is_wp_error( $response ) ) {
            $response_body = json_decode( $response['body'] );
            if ( empty( $response_body ) ) {
                echo '<p>'.esc_html__('Incorrect user ID specified.','ultimate').'</p>';
                return;
            }
            $username = $profile_link = '';
            if(isset($response_body->data)){
                $items_as_objects = $response_body->data;
                $items            = array();
                foreach ( $items_as_objects as $item_object ) {
                    $item['link']       = $item_object->link;
                    $item['imgsrc']     = $item_object->images->low_resolution->url;
                    $item['imgfullsrc'] = $item_object->images->$imagesize->url;
                    $item['comments']   = $item_object->comments->count;
                    $item['likes']      = $item_object->likes->count;
                    $username           = $item_object->user->username;
                    $profile_link       = 'https://www.instagram.com/'.$username;
                    $items[]            = $item;
                }
            }
        }

        /*---------------------------------------
            INSTAGRAM ACTIVATION WRAP ATTRIBUTE
        -----------------------------------------*/
        $this->add_render_attribute( 'instagram_activation_wrap_attr', 'class', 'ultimate__instagram__list' );

        if( $settings['slider_on'] == 'yes' ){
            $this->add_render_attribute( 'instagram_activation_wrap_attr', 'class', 'ultimate-carousel-activation' );
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
            $this->add_render_attribute( 'instagram_activation_wrap_attr', 'data-settings', wp_json_encode( $slider_settings ) );
        }
       
        ?>
            <div <?php echo $this->get_render_attribute_string('ultimate_instragram_wrap_attr'); ?> >

                <ul <?php echo $this->get_render_attribute_string('instagram_activation_wrap_attr'); ?>>
                    <?php
                        if ( isset( $items ) && !empty($items) ):
                            foreach ( $items as $item ):
                    ?>
                        <li>
                            <a href="<?php echo esc_url( $item['link'] ); ?>">
                                <img src="<?php echo esc_url( $item['imgsrc'] ); ?>" alt="<?php echo esc_html__($username,'ultimate');?>">
                            </a>
                            <?php if( $settings['show_comment'] == 'yes' || $settings['show_like'] == 'yes' || $settings['show_light_box'] == 'yes' ): ?>
                                <div class="instagram__content__wrap">
                                    <div class="instagram__content">

                                        <?php if( $settings['show_comment'] == 'yes' || $settings['show_like'] == 'yes' ): ?>
                                            <div class="instagram__like__comment">
                                                <?php
                                                    if( $settings['show_like'] == 'yes' ){
                                                        echo '<span class="like"><i class="fa fa-heart-o"></i>'.esc_html__($item['likes'],'ultimate').'</span>';
                                                    }
                                                    if( $settings['show_comment'] == 'yes' ){
                                                        echo '<span class="comment"><i class="fa fa-comment-o"></i>'.esc_html__($item['comments'],'ultimate').'</span>';
                                                    }
                                                ?>
                                            </div>
                                        <?php endif; if( $settings['show_light_box'] == 'yes' ): ?>
                                            <div class="instagram__btn">
                                                <a class="image-popup-vertical-fit" href="<?php echo esc_url( $item['imgfullsrc'] ); ?>">
                                                    <?php
                                                        if( !empty( $settings['popup_image'] ) && $settings['popup_icon_type'] == 'img' ){
                                                            echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'popup_imagesize', 'popup_image' );
                                                        }else{
                                                            echo sprintf('<span class="insta__popup__icon"><i class="%1$s"></i></span>',$settings['popup_icon']);
                                                        }
                                                    ?>
                                                </a>
                                            </div>
                                        <?php endif;?>

                                    </div>
                                </div>
                            <?php endif;?>
                        </li>
                    <?php endforeach; endif; ?>
                </ul>

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

                <?php if( $settings['show_flow_button'] == 'yes' ): ?>
                    <a class="instagram__follow__btn" href="<?php echo esc_url( $profile_link ); ?>" target="_blank">
                        <i class="fa fa-instagram"></i>
                        <span><?php echo esc_html__('Follow @ '.$username,'ultimate');?></span>
                    </a>
                <?php endif; ?>

            </div>
        <?php
    }

}
Plugin::instance()->widgets_manager->register_widget_type( new Ultimate_Instagram_Widget() );