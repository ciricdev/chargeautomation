<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Ultimate_Post_Group extends Widget_Base {

    public function get_name() {
        return 'Ultimate_Post_Group';
    }
    
    public function get_title() {
        return __( 'Post Group', 'ultimate' );
    }

    public function get_icon() {
        return 'eicon-posts-group';
    }

    public function get_categories() {
        return [ 'ultimate-addons' ];
    }

    public function get_script_depends() {
        return [
            'imagesloaded',
            'masonry',
            'ultimate-core',
        ];
    }

    static function post_layout_style(){
        return[
            '1' => __( 'Layout One', 'ultimate' ),
            '2' => __( 'Layout Two', 'ultimate' ),
            '3' => __( 'Layout Three', 'ultimate' ),
        ];
    }

    static function ultimate_get_post_types( $args = [] ) {
   
        $post_type_args = [
            'show_in_nav_menus' => true,
        ];
        if ( ! empty( $args['post_type'] ) ) {
            $post_type_args['name'] = $args['post_type'];
        }
        $_post_types = get_post_types( $post_type_args , 'objects' );

        $post_types  = [];
        foreach ( $_post_types as $post_type => $object ) {
            $post_types[ $post_type ] = $object->label;
        }
        return $post_types;
    }

    static function ultimate_get_taxonomies( $ultimate_texonomy = 'category' ){
        $terms = get_terms( array(
            'taxonomy'   => $ultimate_texonomy,
            'hide_empty' => true,
        ));
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
            foreach ( $terms as $term ) {
                $options[ $term->slug ] = $term->name;
            }
            return $options;
        }
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'post_content_section',
            [
                'label' => __( 'Post Content', 'ultimate' ),
            ]
        );

            $this->add_control(
                'post_layout_style',
                [
                    'label'   => __( 'Layout', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '1',
                    'options' => self::post_layout_style(),
                ]
            );

            $this->add_control(
                'post_masonry',
                [
                    'label'        => __( 'Post Masonry', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'On', 'ultimate' ),
                    'label_off'    => __( 'Off', 'ultimate' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );
            
        $this->end_controls_section();

        // Content Option Start
        $this->start_controls_section(
            'post_content_option',
            [
                'label' => __( 'Post Option', 'ultimate' ),
            ]
        );
            
            $this->add_control(
                'ultimate_post_type',
                [
                    'label'       => esc_html__( 'Content Sourse', 'ultimate' ),
                    'type'        => Controls_Manager::SELECT2,
                    'label_block' => false,
                    'options'     => self::ultimate_get_post_types(),
                ]
            );

            $this->add_control(
                'posts_categories',
                [
                    'label'       => esc_html__( 'Categories', 'ultimate' ),
                    'type'        => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple'    => true,
                    'options'     => self::ultimate_get_taxonomies(),
                    'condition'   => [
                        'ultimate_post_type' => 'post',
                    ]
                ]
            );

            $this->add_control(
                'ultimate_prod_categories',
                [
                    'label'       => esc_html__( 'Categories', 'ultimate' ),
                    'type'        => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple'    => true,
                    'options'     => self::ultimate_get_taxonomies('product_cat'),
                    'condition'   => [
                        'ultimate_post_type' => 'product',
                    ]
                ]
            );

            $this->add_control(
                'post_limit',
                [
                    'label'     => __('Limit', 'ultimate'),
                    'type'      => Controls_Manager::NUMBER,
                    'default'   => 5,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'custom_order',
                [
                    'label'        => esc_html__( 'Custom order', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'no',
                ]
            );

            $this->add_control(
                'postorder',
                [
                    'label'   => esc_html__( 'Order', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'DESC',
                    'options' => [
                        'DESC' => esc_html__('Descending','ultimate'),
                        'ASC'  => esc_html__('Ascending','ultimate'),
                    ],
                    'condition' => [
                        'custom_order!' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'orderby',
                [
                    'label'   => esc_html__( 'Orderby', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'none',
                    'options' => [
                        'none'          => esc_html__('None','ultimate'),
                        'ID'            => esc_html__('ID','ultimate'),
                        'date'          => esc_html__('Date','ultimate'),
                        'name'          => esc_html__('Name','ultimate'),
                        'title'         => esc_html__('Title','ultimate'),
                        'comment_count' => esc_html__('Comment count','ultimate'),
                        'rand'          => esc_html__('Random','ultimate'),
                    ],
                    'condition' => [
                        'custom_order' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'show_thumb',
                [
                    'label'        => esc_html__( 'Thumbnail', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'label'        => esc_html__( 'Thumb Size', 'ultimate' ),
                    'name'    =>'thumb_size',
                    'default' => 'large',
                    'condition' => [
                        'show_thumb' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'show_category',
                [
                    'label'        => esc_html__( 'Category', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );

            $this->add_control(
                'show_author',
                [
                    'label'        => esc_html__( 'Author', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );

            $this->add_control(
                'show_date',
                [
                    'label'        => esc_html__( 'Date', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );

            $this->add_control(
                'date_type',
                [
                    'label'   => esc_html__( 'Date Type', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'date',
                    'options' => [
                        'date'     => esc_html__('Date','ultimate'),
                        'time'     => esc_html__('Time','ultimate'),
                        'time_ago' => esc_html__('Time Ago','ultimate'),
                        'date_time' => esc_html__('Date and Time','ultimate'),
                    ],
                    'condition' => [
                        'show_date' => 'yes',
                    ]
                ]
            );

             $this->add_control(
                'show_title',
                [
                    'label'        => esc_html__( 'Title', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );

            $this->add_control(
                'title_length',
                [
                    'label'     => __( 'Title Length', 'ultimate' ),
                    'type'      => Controls_Manager::NUMBER,
                    'step'      => 1,
                    'default'   => 5,
                    'condition' => [
                        'show_title' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'show_content',
                [
                    'label'        => esc_html__( 'Content', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );

            $this->add_control(
                'content_length',
                [
                    'label'     => __( 'Content Length', 'ultimate' ),
                    'type'      => Controls_Manager::NUMBER,
                    'step'      => 1,
                    'default'   => 20,
                    'condition' => [
                        'show_content' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'show_read_more_btn',
                [
                    'label'        => esc_html__( 'Read More', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );

            $this->add_control(
                'read_more_txt',
                [
                    'label'       => __( 'Read More button text', 'ultimate' ),
                    'type'        => Controls_Manager::TEXT,
                    'default'     => __( 'Read More', 'ultimate' ),
                    'placeholder' => __( 'Read More', 'ultimate' ),
                    'label_block' => true,
                    'condition'   => [
                        'show_read_more_btn' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'readmore_icon',
                [
                    'label'     => __( 'Readmore Icon', 'ultimate' ),
                    'type'      => Controls_Manager::ICON,
                    'condition' => [
                        'show_read_more_btn' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'readmore_icon_position',
                [
                    'label'   => __( 'Icon Postion', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'right',
                    'options' => [
                        'left'  => __( 'Left', 'ultimate' ),
                        'right' => __( 'Right', 'ultimate' ),
                    ],
                    'condition'   => [
                        'readmore_icon!' => '',
                    ]
                ]
            );

            // Button Icon Margin
            $this->add_control(
                'readmore_icon_indent',
                [
                    'label' => __( 'Icon Spacing', 'ultimate' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 50,
                        ],
                    ],
                    'condition' => [
                        'readmore_icon!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .readmore__btn .readmore_icon_right' => 'margin-left: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .readmore__btn .readmore_icon_left'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section(); // Content Option End

        /*-----------------------
            BOX STYLE
        -------------------------*/
        $this->start_controls_section(
            'post_slider_content_box',
            [
                'label'     => __( 'Box', 'ultimate' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'box_typography',
                    'label'    => __( 'Typography', 'ultimate' ),
                    'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .ultimate__single__post',
                ]
            );

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
                        '{{WRAPPER}} .ultimate__single__post' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'box_background',
                    'label'    => __( 'Background', 'ultimate' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .ultimate__single__post',
                ]
            );

            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'box_border',
                    'label'    => __( 'Border', 'ultimate' ),
                    'selector' => '{{WRAPPER}} .ultimate__single__post',
                ]
            );

            $this->add_responsive_control(
                'box_border_radius',
                [
                    'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .ultimate__single__post' => 'overflow:hidden;border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',

                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow:: get_type(),
                [
                    'name'     => 'box_shadow',
                    'selector' => '{{WRAPPER}} .ultimate__single__post',
                ]
            );

            $this->add_responsive_control(
                'box_padding',
                [
                    'label'      => __( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__single__post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .ultimate__single__post' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        '{{WRAPPER}} .slick-list' => 'margin: -{{TOP}}{{UNIT}} -{{RIGHT}}{{UNIT}} -{{BOTTOM}}{{UNIT}} -{{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'box_item_margin_vartically',
                [
                    'label'              => __( 'Item Margin Vartically', 'ultimate' ),
                    'type'               => Controls_Manager::DIMENSIONS,
                    'size_units'         => [ 'px', '%', 'em' ],
                    'allowed_dimensions' => [ 'top', 'bottom'],
                    'selectors'          => [
                        '{{WRAPPER}} .ultimate__single__post' => 'margin-top: {{TOP}}{{UNIT}}; margin-bottom:{{BOTTOM}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'box_nth_child_margin',
                [
                    'label' => __( 'Nth Child 2 Margin Vartically', 'ultimate' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -200,
                            'max' => 200,
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
                        '{{WRAPPER}} .ultimate__single__post:nth-child(2n)' => 'margin-top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'box_item_hover_margin',
                [
                    'label' => __( 'Item Hover Margin Vartically', 'ultimate' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -200,
                            'max' => 200,
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
                        '{{WRAPPER}} .ultimate__single__post:hover' => 'transform: translateY({{SIZE}}{{UNIT}});',
                    ],
                ]
            );

        $this->end_controls_section();
        /*-----------------------
            BOX STYLE END
        -------------------------*/

        /*-----------------------
            CONTENT STYLE
        -------------------------*/
        $this->start_controls_section(
            'post_slider_content_style_section',
            [
                'label'     => __( 'Content', 'ultimate' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_content' => 'yes',
                ]
            ]
        );
            $this->add_control(
                'content_color',
                [
                    'label'  => __( 'Color', 'ultimate' ),
                    'type'   => Controls_Manager::COLOR,
                    'scheme' => [
                        'type'  => \Elementor\Core\Schemes\Color::get_type(),
                        'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ultimate__single__post .post__content' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'content_typography',
                    'label'    => __( 'Typography', 'ultimate' ),
                    'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .ultimate__single__post .post__content',
                ]
            );

            $this->add_responsive_control(
                'content_margin',
                [
                    'label'      => __( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__single__post .post__content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'content_padding',
                [
                    'label'      => __( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__single__post .post__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'content_align',
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
                        '{{WRAPPER}} .ultimate__single__post .post__content' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();
        /*-----------------------
            CONTENT STYLE END
        -------------------------*/

        /*-----------------------
            TITLE STYLE
        -------------------------*/
        $this->start_controls_section(
            'post_slider_title_style_section',
            [
                'label'     => __( 'Title', 'ultimate' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_title' => 'yes',
                ]
            ]
        );
            $this->add_control(
                'title_color',
                [
                    'label'  => __( 'Color', 'ultimate' ),
                    'type'   => Controls_Manager::COLOR,
                    'scheme' => [
                        'type'  => \Elementor\Core\Schemes\Color::get_type(),
                        'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ultimate__single__post .post__content .post__title a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'title_hover_color',
                [
                    'label'  => __( 'Hover Color', 'ultimate' ),
                    'type'   => Controls_Manager::COLOR,
                    'scheme' => [
                        'type'  => \Elementor\Core\Schemes\Color::get_type(),
                        'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ultimate__single__post .post__content .post__title a:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'title_typography',
                    'label'    => __( 'Typography', 'ultimate' ),
                    'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .ultimate__single__post .post__content .post__title',
                ]
            );

            $this->add_responsive_control(
                'title_margin',
                [
                    'label'      => __( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__single__post .post__content .post__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_padding',
                [
                    'label'      => __( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__single__post .post__content .post__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_align',
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
                        '{{WRAPPER}} .ultimate__single__post .post__content .post__title' => 'text-align: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();
        /*-----------------------
            TITLE STYLE END
        -------------------------*/

        /*-----------------------
            CATEGORY STYLE
        -------------------------*/
        $this->start_controls_section(
            'post_slider_category_style_section',
            [
                'label'     => __( 'Category', 'ultimate' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_category' => 'yes',
                ]
            ]
        );
            
            $this->start_controls_tabs('category_style_tabs');

                $this->start_controls_tab(
                    'category_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'ultimate' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'category_typography',
                            'label'    => __( 'Typography', 'ultimate' ),
                            'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                            'selector' => '{{WRAPPER}} .ultimate__single__post .post__category li a',
                        ]
                    );

                    $this->add_control(
                        'category_color',
                        [
                            'label'  => __( 'Color', 'ultimate' ),
                            'type'   => Controls_Manager::COLOR,
                            'scheme' => [
                                'type'  => \Elementor\Core\Schemes\Color::get_type(),
                                'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .ultimate__single__post .post__category li a' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'category_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .ultimate__single__post .post__category li a',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'category_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .ultimate__single__post .post__category li a',
                        ]
                    );

                    $this->add_responsive_control(
                        'category_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .ultimate__single__post .post__category li a' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'category_shadow',
                            'selector' => '{{WRAPPER}} .ultimate__single__post .post__category li a',
                        ]
                    );

                    $this->add_responsive_control(
                        'category_padding',
                        [
                            'label'      => __( 'Padding', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .ultimate__single__post .post__category li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'category_margin',
                        [
                            'label'      => __( 'Margin', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .ultimate__single__post .post__category li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );


                $this->end_controls_tab(); // Normal Tab end

                $this->start_controls_tab(
                    'category_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'ultimate' ),
                    ]
                );
                    $this->add_control(
                        'category_hover_color',
                        [
                            'label'  => __( 'Color', 'ultimate' ),
                            'type'   => Controls_Manager::COLOR,
                            'scheme' => [
                                'type'  => \Elementor\Core\Schemes\Color::get_type(),
                                'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .ultimate__single__post .post__category li a:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'category_hover_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .ultimate__single__post .post__category li a:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'category_hover_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .ultimate__single__post .post__category li a:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'category_hover_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .ultimate__single__post .post__category li a:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'category_hover_shadow',
                            'selector' => '{{WRAPPER}} .ultimate__single__post .post__category li a:hover',
                        ]
                    );

                $this->end_controls_tab(); // Hover Tab end

            $this->end_controls_tabs();

        $this->end_controls_section();
        /*-----------------------
            CATEGORY STYLE END
        -------------------------*/

        /*-----------------------
            META STYLE
        -------------------------*/
        $this->start_controls_section(
            'post_meta_style_section',
            [
                'label' => __( 'Meta', 'ultimate' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'meta_typography',
                    'label'    => __( 'Typography', 'ultimate' ),
                    'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .ultimate__single__post ul.post__meta li',
                ]
            );

            $this->add_control(
                'meta_color',
                [
                    'label'  => __( 'Color', 'ultimate' ),
                    'type'   => Controls_Manager::COLOR,
                    'scheme' => [
                        'type'  => \Elementor\Core\Schemes\Color::get_type(),
                        'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ultimate__single__post ul.post__meta'                           => 'color: {{VALUE}}',
                        '{{WRAPPER}} .ultimate__single__post ul.post__meta a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'meta_margin',
                [
                    'label'      => __( 'Margin', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__single__post ul.post__meta li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'meta_padding',
                [
                    'label'      => __( 'Padding', 'ultimate' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .ultimate__single__post ul.post__meta li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'meta_align',
                [
                    'label'   => __( 'Alignment', 'ultimate' ),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => [
                        'start' => [
                            'title' => __( 'Left', 'ultimate' ),
                            'icon'  => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'ultimate' ),
                            'icon'  => 'fa fa-align-center',
                        ],
                        'end' => [
                            'title' => __( 'Right', 'ultimate' ),
                            'icon'  => 'fa fa-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justified', 'ultimate' ),
                            'icon'  => 'fa fa-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .ultimate__single__post ul.post__meta' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_section();

        /*-----------------------
            META STYLE END
        -------------------------*/

        /*-----------------------
            READMORE STYLE
        -------------------------*/
        $this->start_controls_section(
            'post_slider_readmore_style_section',
            [
                'label'     => __( 'Read More', 'ultimate' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_read_more_btn' => 'yes',
                ]
            ]
        );
            
            $this->start_controls_tabs('readmore_style_tabs');

                $this->start_controls_tab(
                    'readmore_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'ultimate' ),
                    ]
                );

                    $this->add_control(
                        'readmore_color',
                        [
                            'label'  => __( 'Color', 'ultimate' ),
                            'type'   => Controls_Manager::COLOR,
                            'scheme' => [
                                'type'  => \Elementor\Core\Schemes\Color::get_type(),
                                'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .ultimate__single__post .post__btn a.readmore__btn' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'readmore_typography',
                            'label'    => __( 'Typography', 'ultimate' ),
                            'scheme'   => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                            'selector' => '{{WRAPPER}} .ultimate__single__post .post__btn a.readmore__btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'readmore_margin',
                        [
                            'label'      => __( 'Margin', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .ultimate__single__post .post__btn a.readmore__btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'readmore_padding',
                        [
                            'label'      => __( 'Padding', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .ultimate__single__post .post__btn a.readmore__btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'readmore_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .ultimate__single__post .post__btn a.readmore__btn',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'readmore_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .ultimate__single__post .post__btn a.readmore__btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'readmore_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .ultimate__single__post .post__btn a.readmore__btn' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'readmore_shadow',
                            'selector' => '{{WRAPPER}} .ultimate__single__post .post__btn a.readmore__btn',
                        ]
                    );

                $this->end_controls_tab(); // Normal Tab end

                $this->start_controls_tab(
                    'readmore_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'ultimate' ),
                    ]
                );
                    $this->add_control(
                        'readmore_hover_color',
                        [
                            'label'  => __( 'Color', 'ultimate' ),
                            'type'   => Controls_Manager::COLOR,
                            'scheme' => [
                                'type'  => \Elementor\Core\Schemes\Color::get_type(),
                                'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .ultimate__single__post .post__btn a.readmore__btn:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'readmore_hover_background',
                            'label'    => __( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .ultimate__single__post .post__btn a.readmore__btn:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'readmore_hover_border',
                            'label'    => __( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .ultimate__single__post .post__btn a.readmore__btn:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'readmore_hover_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .ultimate__single__post .post__btn a.readmore__btn:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'readmore_hover_shadow',
                            'selector' => '{{WRAPPER}} .ultimate__single__post .post__btn a.readmore__btn:hover',
                        ]
                    );

                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*-----------------------
            READMORE STYLE END
        -------------------------*/
    }

    protected function render( $instance = [] ) {

        $settings = $this->get_settings_for_display();

        $custom_order_ck = $this->get_settings_for_display('custom_order');
        $orderby         = $this->get_settings_for_display('orderby');
        $postorder       = $this->get_settings_for_display('postorder');

        $this->add_render_attribute( 'ultimate_posts_wrap__area_attr', 'class', 'ultimate__post__content__layout-'.$settings['post_layout_style'] );
        $this->add_render_attribute( 'ultimate_post_item_attr', 'class', 'ultimate__single__post ultimate__post__layout__'.$settings['post_layout_style'] );

        $this->add_render_attribute( 'ultimate_posts_container_attr', 'class', 'row' );
        if ( 'yes' == $settings['post_masonry'] ) {
            $this->add_render_attribute( 'ultimate_posts_container_attr', 'id', 'posts__masonry' );
        }

        // POST SLIDER OPTIONS
        /*if( $settings['slider_on'] == 'yes' ){
            $this->add_render_attribute( 'ultimate_posts_container_attr', 'class', 'ultimate-carousel-activation' );
            $slideid = rand(2564,1245);
            $slider_settings = [
                'slideid'          => $slideid,
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
            $this->add_render_attribute( 'ultimate_posts_container_attr', 'data-settings', wp_json_encode( $slider_settings ) );
        }*/


        // Query
        $args = array(
            'post_type'           => !empty( $settings['ultimate_post_type'] ) ? $settings['ultimate_post_type'] : 'post',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page'      => !empty( $settings['post_limit'] ) ? $settings['post_limit'] : 3,
            'order'               => $postorder
        );

        // Custom Order
        if( $custom_order_ck == 'yes' ){
            $args['orderby']    = $orderby;
        }

        if( !empty($settings['ultimate_prod_categories']) ){
            $get_categories = $settings['ultimate_prod_categories'];
        }else{
            $get_categories = $settings['posts_categories'];
        }

        $get_posts_cats = str_replace(' ', '', $get_categories);

        if (  !empty( $get_categories ) ) {
            if( is_array($get_posts_cats) && count($get_posts_cats) > 0 ){
                $field_name         = is_numeric( $get_posts_cats[0] ) ? 'term_id' : 'slug';
                $args['tax_query']  = array(
                    array(
                        'taxonomy'         => ( $settings['ultimate_post_type'] == 'product' ) ? 'product_cat' : 'category',
                        'terms'            => $get_posts_cats,
                        'field'            => $field_name,
                        'include_children' => false
                    )
                );
            }
        }
        $query_post = new \WP_Query( $args );
        $first_post = 5;

        ?>
            <div <?php echo $this->get_render_attribute_string( 'ultimate_posts_wrap__area_attr' ); ?>>
                <div <?php echo $this->get_render_attribute_string( 'ultimate_posts_container_attr' ); ?>>

                    <?php
                        if( $query_post->have_posts() ):
                        while( $query_post->have_posts() ): $query_post->the_post();
                    ?>

                        <?php if ( $first_post % 5 == 0 ) : ?>

                            <div class="col-sm-12 col-md-6 single__masonry__item">
                                <div <?php echo $this->get_render_attribute_string( 'ultimate_post_item_attr' ); ?> >
                                    <?php $this->ultimate_render_loop_content( 1 ); ?>
                                </div>
                            </div>

                        <?php else: ?>

                            <div class="col-sm-6 col-md-3 single__masonry__item">                                
                                <div <?php echo $this->get_render_attribute_string( 'ultimate_post_item_attr' ); ?> >
                                    <?php if ( 'yes' == $settings['show_thumb'] && has_post_thumbnail() ) : ?>
                                        <div class="post__thumb">
                                            <a href="<?php the_permalink();?>"><?php the_post_thumbnail( 'ultimate_grid_small_thumb' ); ?></a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="post__content">
                                        <div class="post__inner">
                                            <?php $this->ultimate_post_meta(); ?>
                                            <?php $this->ultimate_post_category(); ?>
                                            <?php $this->ultimate_post_title(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endif; $first_post++; ?>

                    <?php endwhile; wp_reset_postdata(); wp_reset_query(); endif; ?>

                </div>
            </div>
        <?php
    }

    // Loop Content
    public function ultimate_render_loop_content( $contetntstyle = NULL ){
        $settings   = $this->get_settings_for_display(); ?>

            <?php if( $contetntstyle == 1 ) : ?>

                <?php $this->ultimate_post_thumbnail(); ?>
                <div class="post__content">
                    <div class="post__inner">
                        <?php $this->ultimate_post_meta(); ?>
                        <?php $this->ultimate_post_category(); ?>
                        <?php $this->ultimate_post_title(); ?>
                        <?php $this->ultimate_post_content(); ?>
                        <?php $this->ultimate_post_readmore(); ?>
                    </div>
                </div>

            <?php endif; ?>

        <?php
    }

    // Time Ago Content
    public function ultimate_time_ago(){
        return human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ).' '.__( 'ago','ultimate' );
    }

    public function ultimate_post_thumbnail(){
        global $post;
        $settings   = $this->get_settings_for_display();
        $thumb_link  = Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumb_size', $settings );
        ?>
        <?php if ( 'yes' == $settings['show_thumb'] && has_post_thumbnail() ) : ?>
            <div class="post__thumb">
                <a href="<?php the_permalink();?>"><img src="<?php echo esc_url( $thumb_link ) ?>" alt="<?php the_title(); ?>"></a>
            </div>
        <?php endif;
    }

    public function ultimate_post_category(){
        $settings   = $this->get_settings_for_display(); ?>
        <?php if( $settings['show_category'] == 'yes' ): ?>
            <ul class="post__category">
                <?php
                    foreach ( get_the_category() as $category ) {
                        $term_link = get_term_link( $category );
                        ?>
                            <li><a href="<?php echo esc_url( $term_link ); ?>" class="category <?php echo esc_attr( $category->slug ); ?>"><?php echo esc_attr( $category->name );?></a></li>
                        <?php
                    }
                ?>
            </ul>
        <?php endif;
    }

    public function ultimate_post_title(){
        $settings   = $this->get_settings_for_display(); ?>
        <?php if( $settings['show_title'] == 'yes' ):?>
            <h3 class="post__title"><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title(), $settings['title_length'], '' ); ?></a></h3>
        <?php endif;
    }

    public function ultimate_post_content(){
        $settings   = $this->get_settings_for_display();
        if( $settings['show_content'] == 'yes' ){
            echo '<p>'.wp_trim_words( get_the_content(), $settings['content_length'], '' ).'</p>'; 
        }
    }

    public function ultimate_post_meta(){
        $settings   = $this->get_settings_for_display(); ?>
        <?php if( $settings['show_author'] == 'yes' || $settings['show_date'] == 'yes'): ?>
            <ul class="post__meta">

                <?php if( $settings['show_author'] == 'yes' ): ?>
                    <li><i class="fa fa-user-circle"></i><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author();?></a></li>
                <?php endif; ?>

                <?php if( $settings['show_date'] == 'yes' ):?>

                    <?php if( 'date'== $settings['date_type'] ) : ?>                                
                    <li><i class="fa fa-clock-o"></i><?php the_time(esc_html__('d F Y','ultimate'));?></li>
                    <?php endif; ?>

                    <?php if( 'time'== $settings['date_type'] ) : ?>
                    <li><i class="fa fa-clock-o"></i><?php the_time(); ?></li>
                    <?php endif; ?>

                    <?php if( 'time_ago'== $settings['date_type'] ) : ?>
                    <li><i class="fa fa-clock-o"></i><?php echo $this->ultimate_time_ago(); ?></li>
                    <?php endif; ?>
                    
                    <?php if( 'date_time'== $settings['date_type'] ) : ?>
                    <li><i class="fa fa-clock-o"></i><?php echo get_the_time( 'd F y - D g:i:a' ) ?></li>
                    <?php endif; ?>

                <?php endif; ?>

            </ul>
        <?php endif;
    }

    public function ultimate_post_readmore(){
        $settings   = $this->get_settings_for_display(); ?>
        <?php if( $settings['show_read_more_btn'] == 'yes' ): ?>
            <div class="post__btn">
                <?php if ( !empty( $settings['readmore_icon'] ) ) : ?>
                    <?php if( 'right'  == $settings['readmore_icon_position'] ) : ?>
                        <a class="readmore__btn" href="<?php the_permalink();?>"><?php echo esc_html__( $settings['read_more_txt'], 'ultimate' );?> <i class="readmore_icon_right <?php echo esc_attr( $settings['readmore_icon'] ) ?>"></i></a>
                    <?php elseif( 'left'  == $settings['readmore_icon_position'] ): ?>
                        <a class="readmore__btn" href="<?php the_permalink();?>"><i class="readmore_icon_left <?php echo esc_attr( $settings['readmore_icon'] ) ?>"></i><?php echo esc_html__( $settings['read_more_txt'], 'ultimate' );?></a>
                    <?php endif; ?>
                <?php else: ?>
                    <a class="readmore__btn" href="<?php the_permalink();?>"><?php echo esc_html__( $settings['read_more_txt'], 'ultimate' );?></a>
                <?php endif; ?>
            </div>
        <?php endif;
    }

}
Plugin::instance()->widgets_manager->register_widget_type( new Ultimate_Post_Group() );