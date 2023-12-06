<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Ultimate_Image_Carousel_Alt extends Widget_Base {

    public function get_name() {
        return 'Ultimate_Image_Carousel_Alt';
    }
    
    public function get_title() {
        return __( 'Image Carousel Alt', 'ultimate' );
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }
    
    public function get_categories() {
        return [ 'ultimate-addons' ];
    }

    public function get_script_depends() {
        return [
            'swiper',
            'ultimate-core',
        ];
    }
    public function get_style_depends() {
        return [
            'swiper',
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
                'slide_style',
                [
                    'label'   => esc_html__( 'Slider Style', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'coverflow',                                /* "slide", "fade", "cube", "coverflow" or "flip"*/
                    'options' => [
                        'slide'     => __( 'Default Slide', 'ultimate' ),
                        'fade'      => __( 'Fade Slide', 'ultimate' ),
                        'cube'      => __( 'Cube Slide', 'ultimate' ),
                        'coverflow' => __( 'Coverflow Slide', 'ultimate' ),
                        'flip'      => __( 'Flip Slide', 'ultimate' ),
                    ],
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );


            /* FADE */
            $this->add_control(
                'cross_fade',
                [
                    'label'        => esc_html__( 'Cross Fade', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'no',
                    'condition'    => [
                        'slider_on'   => 'yes',
                        'slide_style' => 'fade',
                    ]
                ]
            );

            /* CUBE */
            $this->add_control(
                'cube_shadow',
                [
                    'label'        => esc_html__( 'Cube Shadow', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'condition'    => [
                        'slider_on'   => 'yes',
                        'slide_style' => 'cube',
                    ]
                ]
            );
            $this->add_control(
                'cube_item_shadow',
                [
                    'label'        => esc_html__( 'Cube Item Shadow', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'condition'    => [
                        'slider_on'   => 'yes',
                        'slide_style' => 'cube',
                    ]
                ]
            );
            $this->add_control(
                'cube_shadow_offset',
                [
                    'label' => esc_html__( 'Cube Shadow Offset', 'ultimate' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min'  => -100,
                            'max'  => 100,
                            'step' => 0.5,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 20,
                    ],
                    'condition' => [
                        'slider_on'   => 'yes',
                        'slide_style' => 'cube',
                    ]
                ]
            );            
            $this->add_control(
                'cube_shadow_scale',
                [
                    'label' => esc_html__( 'Cube Shadow Scale', 'ultimate' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min'  => -10,
                            'max'  => 10,
                            'step' => 0.01,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0.94,
                    ],
                    'condition' => [
                        'slider_on'   => 'yes',
                        'slide_style' => 'cube',
                    ]
                ]
            );

            /* COVERFLOW */
            $this->add_control(
                'coverflow_rotate',
                [
                    'label' => esc_html__( 'Coverflow Rotate', 'ultimate' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min'  => -360,
                            'max'  => 360,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'condition' => [
                        'slider_on'   => 'yes',
                        'slide_style' => 'coverflow',
                    ]
                ]
            );
            $this->add_control(
                'coverflow_stretch',
                [
                    'label' => esc_html__( 'Coverflow Stretch', 'ultimate' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min'  => -300,
                            'max'  => 300,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 80,
                    ],
                    'condition' => [
                        'slider_on'   => 'yes',
                        'slide_style' => 'coverflow',
                    ]
                ]
            );
            $this->add_control(
                'coverflow_depth',
                [
                    'label' => esc_html__( 'Coverflow Depth', 'ultimate' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min'  => -500,
                            'max'  => 500,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 200,
                    ],
                    'condition' => [
                        'slider_on'   => 'yes',
                        'slide_style' => 'coverflow',
                    ]
                ]
            );
            $this->add_control(
                'coverflow_modifier',
                [
                    'label' => esc_html__( 'Coverflow Modifier', 'ultimate' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min'  => -15,
                            'max'  => 15,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 1,
                    ],
                    'condition' => [
                        'slider_on'   => 'yes',
                        'slide_style' => 'coverflow',
                    ]
                ]
            );
            $this->add_control(
                'coverflow_shadow',
                [
                    'label'        => esc_html__( 'Coverflow Shadow', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'condition'    => [
                        'slider_on'   => 'yes',
                        'slide_style' => 'coverflow',
                    ]
                ]
            );

            /* FLIP */
            $this->add_control(
                'flip_rotate',
                [
                    'label' => esc_html__( 'Flip Rotate', 'ultimate' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min'  => -100,
                            'max'  => 100,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 30,
                    ],
                    'condition' => [
                        'slider_on'   => 'yes',
                        'slide_style' => 'flip',
                    ]
                ]
            );
            $this->add_control(
                'flip_shadow',
                [
                    'label'        => esc_html__( 'Flip Shadow', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'condition'    => [
                        'slider_on'   => 'yes',
                        'slide_style' => 'flip',
                    ]
                ]
            );
            /* END EFFECT*/

            $this->add_control(
                'desktop_item',
                [
                    'label'     => esc_html__( 'Slider Desktop Items', 'ultimate' ),
                    'type'      => Controls_Manager::SLIDER,
                    'separator' => 'before',
                    'range'     => [
                        'px' => [
                            'min'  => 1,
                            'max'  => 20,
                            'step' => 0.5,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 3,
                    ],
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slrows',
                [
                    'label' => esc_html__( 'Slider Rows', 'ultimate' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 5,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 1,
                    ],
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slide_item_margin',
                [
                    'label' => esc_html__( 'Slider Item Space', 'ultimate' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min'  => -200,
                            'max'  => 200,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 0,
                    ],
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'desktop_item_scroll',
                [
                    'label' => __('Slider item to scroll', 'ultimate'),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 20,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 1,
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
                    'default'      => 'no',
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
                    'label'        => esc_html__( 'Slider Pagination', 'ultimate' ),
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
                'dots_type',
                [
                    'label'   => esc_html__( 'Pagination Style', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'bullets',                                      /* "bullets", "fraction", "progressbar" or "custom"*/
                    'options' => [
                        'bullets'     => __( 'Bullets', 'ultimate' ),
                        'fraction'    => __( 'Fraction', 'ultimate' ),
                        'progressbar' => __( 'Progressbar', 'ultimate' ),
                        'custom'      => __( 'Custom Pagination', 'ultimate' ),
                    ],
                    'condition' => [
                        'sldots' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'dynamic_dots',
                [
                    'label'        => esc_html__( 'Dynamic Pagination', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'condition'    => [
                        'dots_type' => 'bullets',
                        'sldots'    => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slide_scrollbar',
                [
                    'label'        => esc_html__( 'Slide Scrollbar', 'ultimate' ),
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
                'slide_scrollbar_dragable',
                [
                    'label'        => esc_html__( 'Scrollbar Dragable', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'condition'    => [
                        'slide_scrollbar' => 'yes',
                    ]
                ]
            );
            $this->add_control(
                'slide_scrollbar_hide',
                [
                    'label'        => esc_html__( 'Hide Scrollbar', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'no',
                    'condition'    => [
                        'slide_scrollbar' => 'yes',
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
                'slautolay',
                [
                    'label'        => esc_html__( 'Slider Autoplay', 'ultimate' ),
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
                    'label' => __('Autoplay Speed', 'ultimate'),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 10000,
                            'step' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 3000,
                    ],
                    'condition' => [
                        'slider_on' => 'yes',
                        'slautolay' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'slanimation_speed',
                [
                    'label' => __('Smart Speed', 'ultimate'),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min'  => 0,
                            'max'  => 10000,
                            'step' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 500,
                    ],
                    'condition' => [
                        'slider_on' => 'yes',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'heading_medium',
                [
                    'label'     => __( 'Medium Desktop', 'ultimate' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'medium_item',
                [
                    'label'     => __('Slider Items', 'ultimate'),
                    'type'      => Controls_Manager::SLIDER,
                    'separator' => 'before',
                    'range'     => [
                        'px' => [
                            'min'  => 1,
                            'max'  => 10,
                            'step' => 0.5,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 1,
                    ],
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'medium_item_margin',
                [
                    'label'       => __('Slider Item Space', 'ultimate'),
                    'description' => __('The item margin between slide to medium desktop.', 'ultimate'),
                    'type'        => Controls_Manager::SLIDER,
                    'range'       => [
                        'px' => [
                            'min'  => 1,
                            'max'  => 200,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 1,
                    ],
                    'condition'   => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'medium_item_scroll',
                [
                    'label' => __('Slider item to scroll', 'ultimate'),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min'  => 1,
                            'max'  => 10,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 1,
                    ],
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
                    'separator' => 'before',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'tablet_item',
                [
                    'label'     => __('Slider Items', 'ultimate'),
                    'type'      => Controls_Manager::SLIDER,
                    'separator' => 'before',
                    'range'     => [
                        'px' => [
                            'min'  => 1,
                            'max'  => 10,
                            'step' => 0.5,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 1,
                    ],
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'tablet_item_margin',
                [
                    'label'       => __('Slider Item Space', 'ultimate'),
                    'description' => __('The item margin between slide to tablet.', 'ultimate'),
                    'type'        => Controls_Manager::SLIDER,
                    'range'       => [
                        'px' => [
                            'min'  => 1,
                            'max'  => 200,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 1,
                    ],
                    'condition'   => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'tablet_item_scroll',
                [
                    'label' => __('Slider item to scroll', 'ultimate'),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min'  => 1,
                            'max'  => 10,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 1,
                    ],
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'heading_mobile',
                [
                    'label'     => __( 'Mobile Phone', 'ultimate' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'mobile_item',
                [
                    'label'     => __('Slider Items', 'ultimate'),
                    'type'      => Controls_Manager::SLIDER,
                    'separator' => 'before',
                    'range'     => [
                        'px' => [
                            'min'  => 1,
                            'max'  => 10,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 1,
                    ],
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'mobile_item_margin',
                [
                    'label'       => __('Slider Item Space', 'ultimate'),
                    'description' => __('The item margin between slide to mobile.', 'ultimate'),
                    'type'        => Controls_Manager::SLIDER,
                    'range'       => [
                        'px' => [
                            'min'  => 1,
                            'max'  => 100,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 1,
                    ],
                    'condition'   => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'mobile_item_scroll',
                [
                    'label' => __('Slider item to scroll', 'ultimate'),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min'  => 1,
                            'max'  => 10,
                            'step' => 1,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 1,
                    ],
                    'condition' => [
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
                'area_width',
                [
                    'label'      => __( 'Area Width', 'ultimate' ),
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
                    'label'      => __( 'Area Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'slider_container_width',
                [
                    'label'      => __( 'Slider Container Width', 'ultimate' ),
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
                        '{{WRAPPER}} .swiper-container' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'slider_container_height',
                [
                    'label'      => __( 'Slider Container Height', 'ultimate' ),
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
                        '{{WRAPPER}} .swiper-container' => 'height: {{SIZE}}{{UNIT}};',
                    ],
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
            ITEM BOX STYLE
        --------------------------*/
        $this->start_controls_section(
            'ultimate_carousel_style_section',
            [
                'label' => __( 'Item Style', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_responsive_control(
                'slider_item_width',
                [
                    'label'      => __( 'Slider Item Width', 'ultimate' ),
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
                        '{{WRAPPER}} .swiper-slide' => 'width: {{SIZE}}{{UNIT}} !important;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'slider_item_height',
                [
                    'label'      => __( 'Slider Item Height', 'ultimate' ),
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
                        '{{WRAPPER}} .swiper-slide' => 'height: {{SIZE}}{{UNIT}} !important;',
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
                    'label'   => __( 'Vertical Align', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'align-items:center;',
                    'options' => [
                        'align-items:center;'     => __( 'Center', 'ultimate' ),
                        'align-items:flex-start;' => __( 'Start', 'ultimate' ),
                        'align-items:flex-end;'   => __( 'End', 'ultimate' ),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .slick-slider .slick-track' => 'display: flex; {{VALUE}}',
                    ],
                    'separator' => 'before',
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
                                '{{WRAPPER}} .sldier-content-area .owl-nav > div' => 'color: {{VALUE}};',
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
                                '{{WRAPPER}} .sldier-content-area .owl-nav > div' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'slider_arrow_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav > div',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'slider_arrow_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav > div',
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .owl-nav > div' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'slider_arrow_shadow',
                            'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav > div',
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
                                '{{WRAPPER}} .sldier-content-area .owl-nav > div' => 'height: {{SIZE}}{{UNIT}};',
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
                                '{{WRAPPER}} .sldier-content-area .owl-nav > div' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_padding',
                        [
                            'label'      => __( 'Padding', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .sldier-content-area .owl-nav > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                                '{{WRAPPER}} .sldier-content-area .owl-nav > div:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'slider_arrow_hover_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav > div:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'slider_arrow_hover_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav > div:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_hover_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .owl-nav > div:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'slider_arrow_hover_shadow',
                            'selector' => '{{WRAPPER}} .sldier-content-area .owl-nav > div:hover',
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

        /*------------------------
             DOTS STYLE
        --------------------------*/
        $this->start_controls_section(
            'post_slider_pagination_style_section',
            [
                'label'     => __( 'Pagination', 'ultimate' ),
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
                        'label' => __( 'Normal', 'ultimate' ),
                    ]
                );

                    $this->add_responsive_control(
                        'slider_pagination_height',
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
                                'size' => 15,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .owl-dots > div' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_pagination_width',
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
                                'size' => 15,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .owl-dots > div' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'pagination_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .sldier-content-area .owl-dots > div',
                        ]
                    );

                    $this->add_responsive_control(
                        'pagination_margin',
                        [
                            'label'      => __( 'Margin', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .sldier-content-area .owl-dots > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'pagination_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .sldier-content-area .owl-dots > div',
                        ]
                    );

                    $this->add_responsive_control(
                        'pagination_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .owl-dots > div' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'pagination_warp_margin',
                        [
                            'label'      => __( 'Pagination Warp Margin', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .sldier-content-area .owl-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'pagi_war_align',
                        [
                            'label'   => __( 'Pagination Warp Alignment', 'ultimate' ),
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
                                '{{WRAPPER}} .sldier-content-area .owl-dots' => 'text-align: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Normal Tab end

                $this->start_controls_tab(
                    'pagination_style_active_tab',
                    [
                        'label' => __( 'Active', 'ultimate' ),
                    ]
                );
                    
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'pagination_hover_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .sldier-content-area .owl-dots > div:hover, {{WRAPPER}} .sldier-content-area .owl-dots > div.swiper-pagination-bullet-active',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'pagination_hover_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .sldier-content-area .owl-dots > div:hover, {{WRAPPER}} .sldier-content-area .owl-dots > div.swiper-pagination-bullet-active',
                        ]
                    );

                    $this->add_responsive_control(
                        'pagination_hover_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .sldier-content-area .owl-dots > div.swiper-pagination-bullet-active' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .sldier-content-area .owl-dots > div:hover'        => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Hover Tab end

            $this->end_controls_tabs();

        $this->end_controls_section();
        /*------------------------
             DOTS STYLE END
        --------------------------*/

        /*-------------------------
            PRGORESSBAR STYLE
        --------------------------*/
        $this->start_controls_section(
            'slider_progressbar_style_section',
            [
                'label'     => __( 'Progressbar Style', 'ultimate' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_on'    => 'yes',
                    'dots_type' => 'progressbar',
                ]
            ]
        );

            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'progress_background',
                    'label'    => __( 'Progress Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .sldier-content-area .swiper-pagination-progressbar-fill',
                ]
            );

            $this->add_control(
                'progressbar_wrap',
                [
                    'label'     => __( 'Progressbar Wrap', 'ultimate' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );


            $this->add_responsive_control(
                'slider_progressbar_height',
                [
                    'label'      => __( 'Height', 'ultimate' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'separator' => 'before',
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
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sldier-content-area .swiper-pagination-progressbar' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'progressbar_background',
                    'label'    => __( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .sldier-content-area .swiper-pagination-progressbar',
                ]
            );

            $this->add_responsive_control(
                'progressbar_margin',
                [
                    'label'      => __( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .sldier-content-area .swiper-pagination-progressbar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'progressbar_border',
                    'label'    => __( 'Border', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .sldier-content-area .swiper-pagination-progressbar',
                ]
            );

            $this->add_responsive_control(
                'progressbar_border_radius',
                [
                    'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .sldier-content-area .swiper-pagination-progressbar' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'progressbar_warp_margin',
                [
                    'label'      => __( 'Progressbar Warp Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .sldier-content-area .swiper-pagination-progressbar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        /*-------------------------
            SCROLLBAR STYLE
        --------------------------*/
        $this->start_controls_section(
            'scrollrogressbar_style_section',
            [
                'label'     => __( 'Scrollbar Style', 'ultimate' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_on'    => 'yes',
                    'slide_scrollbar' => 'yes',
                ]
            ]
        );

            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'scroll_background',
                    'label'    => __( 'Progress Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .sldier-content-area .swiper-scrollbar-drag',
                ]
            );

            $this->add_control(
                'scrollbar_wrap',
                [
                    'label'     => __( 'Scrollbar Wrap', 'ultimate' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );


            $this->add_responsive_control(
                'scrollrogressbar_height',
                [
                    'label'      => __( 'Height', 'ultimate' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'separator' => 'before',
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
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sldier-content-area .swiper-scrollbar' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'scrollbar_background',
                    'label'    => __( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .sldier-content-area .swiper-scrollbar',
                ]
            );

            $this->add_responsive_control(
                'scrollbar_margin',
                [
                    'label'      => __( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .sldier-content-area .swiper-scrollbar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'scrollbar_border',
                    'label'    => __( 'Border', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .sldier-content-area .swiper-scrollbar',
                ]
            );

            $this->add_responsive_control(
                'scrollbar_border_radius',
                [
                    'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .sldier-content-area .swiper-scrollbar' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .sldier-content-area .swiper-scrollbar-drag' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'scrollbar_warp_margin',
                [
                    'label'      => __( 'Progressbar Warp Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .sldier-content-area .swiper-scrollbar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {
        $settings = $this->get_settings_for_display();
        
        // Carousel Attribute
        $this->add_render_attribute( 'ultimate_carousel_wrap', 'class', 'sldier-content-area '.$settings['nav_position'] );

        // Slider Attr
        $this->add_render_attribute( 'ultimate_carousel_attr', 'class', 'ultimate__content__or__slider' );

        if( $settings['slider_on'] == 'yes' ){

            $this->add_render_attribute( 'ultimate_carousel_attr', 'class', 'ultimate-carousel-activation' );
            $this->add_render_attribute( 'ultimate_carousel_attr', 'class', 'swiper-container' );

            $slideid = rand(2564,1245);

            $slider_settings = [
                'slideid'                  => $slideid,
                'slide_style'              => $settings['slide_style'],
                'cross_fade'               => ('yes' === $settings['cross_fade']),
                'cube_shadow'              => ('yes' === $settings['cube_shadow']),
                'cube_item_shadow'         => ('yes' === $settings['cube_item_shadow']),
                'cube_shadow_offset'       => $settings['cube_shadow_offset']['size'],
                'cube_shadow_scale'        => $settings['cube_shadow_scale']['size'],
                'coverflow_shadow'         => ('yes' === $settings['coverflow_shadow']),
                'coverflow_rotate'         => $settings['coverflow_rotate']['size'],
                'coverflow_stretch'        => $settings['coverflow_stretch']['size'],
                'coverflow_depth'          => $settings['coverflow_depth']['size'],
                'coverflow_modifier'       => $settings['coverflow_modifier']['size'],
                'flip_rotate'              => $settings['flip_rotate']['size'],
                'flip_shadow'              => ('yes' === $settings['flip_shadow']),
                'rows'                     => absint($settings['slrows']['size']),
                'slide_item_margin'        => $settings['slide_item_margin']['size'],
                'arrows'                   => ('yes' === $settings['slarrows']),
                'arrow_prev_txt'           => $settings['slprevicon'],
                'arrow_next_txt'           => $settings['slnexticon'],
                'dots'                     => ('yes' === $settings['sldots']),
                'dots_type'                =>   $settings['dots_type'],
                'dynamic_dots'             => ('yes' === $settings['dynamic_dots']),
                'slide_scrollbar'          => ('yes' === $settings['slide_scrollbar']),
                'slide_scrollbar_dragable' => ('yes' === $settings['slide_scrollbar_dragable']),
                'slide_scrollbar_hide'     => ('yes' === $settings['slide_scrollbar_hide']),                
                'autoplay'                 => ('yes' === $settings['slautolay']),
                'autoplay_speed'           => absint($settings['slautoplay_speed']['size']),
                'animation_speed'          => absint($settings['slanimation_speed']['size']),
                'infinite'                 => ( 'yes' === $settings['slinfinite']),
                'focusonselect'            => ( 'yes' === $settings['slfocusonselect']),
                'vertical'                 => ( 'yes' === $settings['slvertical']),
                'center_mode'              => ( 'yes' === $settings['slcentermode']),
            ];

            $slider_responsive_settings = [
                'desktop_item'        => $settings['desktop_item']['size'],
                'desktop_item_scroll' => $settings['desktop_item_scroll']['size'],
                'medium_item'         => $settings['medium_item']['size'],
                'medium_item_margin'  => $settings['medium_item_margin']['size'],
                'medium_item_scroll'  => $settings['medium_item_scroll']['size'],
                'tablet_item'         => $settings['tablet_item']['size'],
                'tablet_item_margin'  => $settings['tablet_item_margin']['size'],
                'tablet_item_scroll'  => $settings['tablet_item_scroll']['size'],
                'mobile_item'         => $settings['mobile_item']['size'],
                'mobile_item_margin'  => $settings['mobile_item_margin']['size'],
                'mobile_item_scroll'  => $settings['mobile_item_scroll']['size'],
            ];

            $slider_settings = array_merge( $slider_settings, $slider_responsive_settings );
            $this->add_render_attribute( 'ultimate_carousel_attr', 'data-settings', wp_json_encode( $slider_settings ) );
        }else{
            $this->add_render_attribute( 'ultimate_carousel_attr', 'class', 'ultimate__slide__content__grid' );            
        }

        $this->add_render_attribute( 'ultimate_carousel_item_parent_attr', 'class', 'ultimate__image__slide__item__parent' );
        $this->add_render_attribute( 'ultimate_carousel_item_parent_attr', 'class', 'swiper-slide' );
        $this->add_render_attribute( 'ultimate_carousel_item_parent_attr', 'data-swiper-parallax', '-1000' );
        $this->add_render_attribute( 'ultimate_carousel_item_attr', 'class', 'single__image__slide ultimate__image__slide__layout__'.$settings['image_carousel_style'] );
        ?>
        <div <?php echo $this->get_render_attribute_string('ultimate_carousel_wrap'); ?>>
            <div <?php echo $this->get_render_attribute_string('ultimate_carousel_attr'); ?>>

                <div class="swiper-wrapper">

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
            </div>

            <?php if( $settings['slarrows'] == 'yes' || $settings['sldots'] == 'yes'|| 'yes' == $settings['slide_scrollbar'] ) : ?>

                <div class="owl-controls">
                    <?php if( $settings['slarrows'] == 'yes' ) : ?>
                        <div class="ultimate-carousel-nav<?php echo esc_attr( $slideid ); ?> owl-nav">
                            <div class="ultimate-carosul-prev<?php echo esc_attr( $slideid ); ?> owl-prev"><i class="<?php echo esc_attr( $settings['slprevicon'] ); ?>"></i></div>
                            <div class="ultimate-carosul-next<?php echo esc_attr( $slideid ); ?> owl-next"><i class="<?php echo esc_attr( $settings['slnexticon'] ); ?>"></i></div>
                        </div>
                    <?php endif; ?>

                    <?php if( $settings['sldots'] == 'yes' ) : ?>
                        <div class="ultimate-carousel-dots<?php echo esc_attr( $slideid ); ?> owl-dots swiper-pagination swiper-pagination"></div>
                    <?php endif; ?>

                    <?php if( 'yes' === $settings['slide_scrollbar'] ): ?>
                        <div class="swiper-scrollbar<?php echo esc_attr( $slideid ); ?> swiper-scrollbar"></div>
                    <?php endif; ?>
                </div>

            <?php endif; ?>

        </div>
    <?php
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new Ultimate_Image_Carousel_Alt() );