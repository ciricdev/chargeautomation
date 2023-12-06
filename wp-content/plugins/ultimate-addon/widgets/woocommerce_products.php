<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Ultimatee_WooCommerce_Products_Widget extends Widget_Base {

    public function get_name() {
        return 'Ultimatee_WooCommerce_Products_Widget';
    }
    
    public function get_title() {
        return esc_html__( 'Product Tab', 'ultimate' );
    }

    public function get_icon() {
        return 'eicon-woocommerce';
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

    public function ultimate_product_layout_style(){
        return [
            'ultimate__product__layout__1' => esc_html__( 'Product style One', 'ultimate' ),
            'ultimate__product__layout__2' => esc_html__( 'Product style Two', 'ultimate' ),
            'ultimate__product__layout__3' => esc_html__( 'Product style Three', 'ultimate' ),
        ];
    }

    public function ultimate_get_product_taxonomies( $ultimate_texonomy = 'product_cat' ){
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

        /*---------------------------
            PRODUCT CONTENT SECTION
        ----------------------------*/
        $this->start_controls_section(
            'ultimate-products',
            [
                'label' => esc_html__( 'Product Settings', 'ultimate' ),
            ]
        );
            $this->add_control(
                'ultimate_product_layout',
                [
                    'label'   => esc_html__( 'Product style', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'ultimate__product__layout__1',
                    'options' => $this->ultimate_product_layout_style(),
                ]
            );
            $this->add_control(
                'product_tabs',
                [
                    'label'        => esc_html__( 'Product Tab', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'no',
                    'separator'    =>'before',
                    'description'  => esc_html__('When you toggle the product tab you must set some category for filtering tabs content.','ultimate'),
                ]
            );
            $this->add_control(
                'product_slider',
                [
                    'label'        => esc_html__( 'Product slider', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'no',
                    'description'  => esc_html__('When product tab is off then task slider.','ultimate'),
                    'separator'    =>'before',
                ]
            );
            $this->add_control(
                'ultimate_product_grid_product_filter',
                [
                    'label'   => esc_html__( 'Filter By', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'recent',
                    'options' => [
                        'recent'       => esc_html__( 'Recent Products', 'ultimate' ),
                        'featured'     => esc_html__( 'Featured Products', 'ultimate' ),
                        'best_selling' => esc_html__( 'Best Selling Products', 'ultimate' ),
                        'sale'         => esc_html__( 'Sale Products', 'ultimate' ),
                        'top_rated'    => esc_html__( 'Top Rated Products', 'ultimate' ),
                        'mixed_order'  => esc_html__( 'Mixed order Products', 'ultimate' ),
                    ],
                    'separator'    =>'before',
                ]
            );
            $this->add_control(
                'ultimate_product_grid_categories',
                [
                    'label'       => esc_html__( 'Product Categories', 'ultimate' ),
                    'type'        => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple'    => true,
                    'options'     => $this->ultimate_get_product_taxonomies(),
                    'description' => esc_html__('It also appear in tab menu items when tab mode is enabled.','ultimate'),
                    'separator'   =>'before',
                ]
            );
            $this->add_control(
                'ultimate_product_grid_column',
                [
                    'label'   => esc_html__( 'Columns', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '4',
                    'options' => [
                        '1' => esc_html__( '1', 'ultimate' ),
                        '2' => esc_html__( '2', 'ultimate' ),
                        '3' => esc_html__( '3', 'ultimate' ),
                        '4' => esc_html__( '4', 'ultimate' ),
                        '5' => esc_html__( '5', 'ultimate' ),
                        '6' => esc_html__( '6', 'ultimate' ),
                    ],
                    'separator'    =>'before',
                ]
            );
            $this->add_control(
              'ultimate_product_grid_row',
              [
                 'label'   => esc_html__( 'Rows', 'ultimate' ),
                 'type'    => Controls_Manager::NUMBER,
                 'default' => 1,
                 'min'     => 1,
                 'max'     => 20,
                 'step'    => 1,
              ]
            );
            $this->add_control(
              'ultimate_product_grid_products_count',
              [
                 'label'   => esc_html__( 'Products Count', 'ultimate' ),
                 'type'    => Controls_Manager::NUMBER,
                 'default' => 4,
                 'min'     => 1,
                 'max'     => 100,
                 'step'    => 1,
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
                'order',
                [
                    'label'   => esc_html__( 'order', 'ultimate' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'DESC',
                    'options' => [
                        'DESC' => esc_html__('Descending','ultimate'),
                        'ASC'  => esc_html__('Ascending','ultimate'),
                    ],
                    'condition' => [
                        'custom_order' => 'yes',
                    ]
                ]
            );
            $this->add_control(
                'more_options',
                [
                    'label' => __( 'Content & Buttons Options', 'ultimate' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'show_saleflash',
                [
                    'label'        => esc_html__( 'Show Sale Flash ?', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'show_attribute',
                [
                    'label'        => esc_html__( 'Show Attributes ?', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'no',
                ]
            );
            $this->add_control(
                'show_title',
                [
                    'label'        => esc_html__( 'Show Title ?', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );
            $this->add_control(
                'show_price',
                [
                    'label'        => esc_html__( 'Show Price ?', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );
            $this->add_control(
                'show_buttons',
                [
                    'label'        => esc_html__( 'Show Action Buttons ?', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );
            $this->add_control(
                'show_quickview',
                [
                    'label'        => esc_html__( 'Show Quick View Button ?', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );
            $this->add_control(
                'show_wishlist',
                [
                    'label'        => esc_html__( 'Show Wish List Button ?', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );
            $this->add_control(
                'show_buynow',
                [
                    'label'        => esc_html__( 'Show Buy Now Button ?', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );
            $this->add_control(
                'show_compare',
                [
                    'label'        => esc_html__( 'Show Compare Button ?', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );
        $this->end_controls_section();
        /*---------------------------
            PRODUCT CONTENT SECTION END
        ----------------------------*/

        /*--------------------------
            PRODUCT TAB MENU
        ---------------------------*/
        $this->start_controls_section(
            'ultimate-products-tab-menu',
            [
                'label'     => esc_html__( 'Tab Menu Style', 'ultimate' ),
                'condition' => [
                    'product_tabs' => 'yes',
                ]
            ]
        );
            $this->add_responsive_control(
                'ultimate-tab-menu-align',
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
                        '{{WRAPPER}} .product__tab__menu__list' => 'text-align: {{VALUE}};',
                    ],
                    'default'   => 'center',
                ]
            );
            
            $this->start_controls_tabs(
                'product_tab_style_tabs',[
                    'separator'    =>'before',
                ]
            );
                // TAB MENU STYLE NORMAL
                $this->start_controls_tab(
                    'product_tab_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'ultimate' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name'     => 'tab_menu_typography',
                            'selector' => '{{WRAPPER}} .ht-tab-menus li a',
                        ]
                    );
                    $this->add_control(
                        'tab_menu_color',
                        [
                            'label'     => esc_html__( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ht-tab-menus li a' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'tab_menu_background',
                            'label'    => esc_html__( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .ht-tab-menus li a',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'tab_menu_border',
                            'label'    => esc_html__( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .ht-tab-menus li a',
                        ]
                    );
                    $this->add_responsive_control(
                        'tab_menu_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .ht-tab-menus li a' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'tab_menu_box_shadow',
                            'selector' => '{{WRAPPER}} ht-tab-menus li a',
                        ]
                    );
                    $this->add_responsive_control(
                        'tab_menu_padding',
                        [
                            'label'      => esc_html__( 'Padding', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .ht-tab-menus li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'tab_menu_margin',
                        [
                            'label'      => esc_html__( 'Margin', 'ultimate' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .ht-tab-menus li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'product_tab_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'ultimate' ),
                    ]
                );
                    $this->add_control(
                        'tab_menu_hover_color',
                        [
                            'label'     => esc_html__( 'Color', 'ultimate' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ht-tab-menus li a:hover'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .ht-tab-menus li a.active' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'tab_menu_hover_background',
                            'label'    => esc_html__( 'Background', 'ultimate' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .ht-tab-menus li a.active',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'tab_menu_hover_border',
                            'label'    => esc_html__( 'Border', 'ultimate' ),
                            'selector' => '{{WRAPPER}} .ht-tab-menus li a:hover',
                            'selector' => '{{WRAPPER}} .ht-tab-menus li a.active',
                        ]
                    );
                    $this->add_responsive_control(
                        'tab_menu_hover_border_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'ultimate' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .ht-tab-menus li a:hover'  => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .ht-tab-menus li a.active' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'tab_menu_hover_box_shadow',
                            'selector' => '{{WRAPPER}} ht-tab-menus li a',
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*--------------------------
            PRODUCT TAB MENU END
        ---------------------------*/

        /*--------------------------
            PRODUCT SLIDER
        ---------------------------*/
        $this->start_controls_section(
            'ultimate-products-slider',
            [
                'label'     => esc_html__( 'Slider Option', 'ultimate' ),
                'condition' => [
                    'product_slider' => 'yes',
                ]
            ]
        );
            $this->add_control(
                'slitems',
                [
                    'label'     => esc_html__( 'Slider Items', 'ultimate' ),
                    'type'      => Controls_Manager::NUMBER,
                    'min'       => 1,
                    'max'       => 10,
                    'step'      => 1,
                    'default'   => 4,
                    'condition' => [
                        'product_slider' => 'yes',
                    ]
                ]
            );
            $this->add_control(
                'slarrows',
                [
                    'label'        => esc_html__( 'Slider Arrow', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'condition'    => [
                        'product_slider' => 'yes',
                    ]
                ]
            );
            $this->add_control(
                'sldots',
                [
                    'label'        => esc_html__( 'Slider dots', 'ultimate' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'no',
                    'condition'    => [
                        'product_slider' => 'yes',
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
                    'default'      => 'yes',
                    'label'        => esc_html__('Pause on Hover?', 'ultimate'),
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
                        'product_slider' => 'yes',
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
                        'slautolay' => 'yes',
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
                        'slautolay' => 'yes',
                    ]
                ]
            );
            $this->add_control(
                'slscroll_columns',
                [
                    'label'   => esc_html__('Slider item to scroll', 'ultimate'),
                    'type'    => Controls_Manager::NUMBER,
                    'min'     => 1,
                    'max'     => 10,
                    'step'    => 1,
                    'default' => 3,
                ]
            );
            $this->add_control(
                'heading_tablet',
                [
                    'label'     => esc_html__( 'Tablet', 'ultimate' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'after',
                ]
            );
            $this->add_control(
                'sltablet_display_columns',
                [
                    'label'   => esc_html__('Slider Items', 'ultimate'),
                    'type'    => Controls_Manager::NUMBER,
                    'min'     => 1,
                    'max'     => 8,
                    'step'    => 1,
                    'default' => 2,
                ]
            );
            $this->add_control(
                'sltablet_scroll_columns',
                [
                    'label'   => esc_html__('Slider item to scroll', 'ultimate'),
                    'type'    => Controls_Manager::NUMBER,
                    'min'     => 1,
                    'max'     => 8,
                    'step'    => 1,
                    'default' => 2,
                ]
            );
            $this->add_control(
                'sltablet_width',
                [
                    'label'       => esc_html__('Tablet Resolution', 'ultimate'),
                    'description' => esc_html__('The resolution to tablet.', 'ultimate'),
                    'type'        => Controls_Manager::NUMBER,
                    'default'     => 750,
                ]
            );
            $this->add_control(
                'heading_mobile',
                [
                    'label'     => esc_html__( 'Mobile Phone', 'ultimate' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'after',
                ]
            );
            $this->add_control(
                'slmobile_display_columns',
                [
                    'label'   => esc_html__('Slider Items', 'ultimate'),
                    'type'    => Controls_Manager::NUMBER,
                    'min'     => 1,
                    'max'     => 4,
                    'step'    => 1,
                    'default' => 1,
                ]
            );
            $this->add_control(
                'slmobile_scroll_columns',
                [
                    'label'   => esc_html__('Slider item to scroll', 'ultimate'),
                    'type'    => Controls_Manager::NUMBER,
                    'min'     => 1,
                    'max'     => 4,
                    'step'    => 1,
                    'default' => 1,
                ]
            );
            $this->add_control(
                'slmobile_width',
                [
                    'label'       => esc_html__('Mobile Resolution', 'ultimate'),
                    'description' => esc_html__('The resolution to mobile.', 'ultimate'),
                    'type'        => Controls_Manager::NUMBER,
                    'default'     => 480,
                ]
            );
        $this->end_controls_section();
        /*--------------------------
            PRODUCT SLIDER END
        ---------------------------*/
    }

    protected function render( $instance = [] ) {

        $settings        = $this->get_settings_for_display();
        $product_type    = $this->get_settings_for_display('ultimate_product_grid_product_filter');
        $per_page        = $this->get_settings_for_display('ultimate_product_grid_products_count');
        $custom_order_ck = $this->get_settings_for_display('custom_order');
        $orderby         = $this->get_settings_for_display('orderby');
        $order           = $this->get_settings_for_display('order');
        $grid_columns    = $this->get_settings_for_display('ultimate_product_grid_column');
        $rows            = $this->get_settings_for_display('ultimate_product_grid_row');
        $tab_uniqid      = $this->get_id();
        $product_slider  = $this->get_settings_for_display('product_slider');
        $product_tabs    = $this->get_settings_for_display('product_tabs');

        $is_rtl    = is_rtl();
        $direction = $is_rtl ? 'rtl' : 'ltr';

        $slider_settings = [
            'arrows'          => ('yes' === $settings['slarrows']),
            'dots'            => ('yes' === $settings['sldots']),
            'autoplay'        => ('yes' === $settings['slautolay']),
            'autoplay_speed'  => absint($settings['slautoplay_speed']),
            'animation_speed' => absint($settings['slanimation_speed']),
            'pause_on_hover'  => ('yes' === $settings['slpause_on_hover']),
            'rtl'             => $is_rtl,
        ];

        $slider_responsive_settings = [
            'product_items'          => $settings['slitems'],
            'scroll_columns'         => $settings['slscroll_columns'],
            'tablet_width'           => $settings['sltablet_width'],
            'tablet_display_columns' => $settings['sltablet_display_columns'],
            'tablet_scroll_columns'  => $settings['sltablet_scroll_columns'],
            'mobile_width'           => $settings['slmobile_width'],
            'mobile_display_columns' => $settings['slmobile_display_columns'],
            'mobile_scroll_columns'  => $settings['slmobile_scroll_columns'],
        ];

        $slider_settings = array_merge($slider_settings, $slider_responsive_settings);

        // WooCommerce Category
        $args = array(
            'post_type'           => 'product',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page'      => $per_page,
        );
        switch( $product_type ){
            case 'sale': 
                $args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
            break;
            case 'featured': 
                $args['tax_query'][] = array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'featured',
                    'operator' => 'IN',
                );
            break;
            case 'best_selling': 
                $args['meta_key'] = 'total_sales';
                $args['orderby']  = 'meta_value_num';
                $args['order']    = 'desc';
            break;
            case 'top_rated': 
                $args['meta_key'] = '_wc_average_rating';
                $args['orderby']  = 'meta_value_num';
                $args['order']    = 'desc';
            break;
            case 'mixed_order': 
                $args['orderby'] = 'rand';
            break;
            default:   /* Recent */
                $args['orderby'] = 'date';
                $args['order']   = 'desc';
            break;
        }

        // Custom Order
        if( $custom_order_ck == 'yes' ){
            $args['orderby'] = $orderby;
            $args['order']   = $order;
        }

        $get_product_categories = $settings['ultimate_product_grid_categories'];  // get custom field value
        $product_cats           = str_replace(' ', '', $get_product_categories);

        if ( "0" != $get_product_categories) {
            if( is_array($product_cats) && count($product_cats) > 0 ){
                      $field_name  = is_numeric($product_cats[0])?'term_id':'slug';
                $args['tax_query'] = array(
                    array(
                        'taxonomy'         => 'product_cat',
                        'terms'            => $product_cats,
                        'field'            => $field_name,
                        'include_children' => false
                    )
                );
            }
        }
        $products_query = new \WP_Query( $args );

        if( ( $product_slider == 'yes' ) && ( $product_tabs != 'yes' ) ){
            $columns = 'product__slide__item col-xs-12';
        }else{
            $columns = 'col-lg-3 col-md-6 col-sm-6 col-xs-12 mb50';
            if( $grid_columns != '' ){
                if( $grid_columns == 5 ){
                    $columns = 'cus-col-5 ul-col-md-6 col-sm-6 col-xs-12 mb-50';
                }else{
                    $colwidth = round( 12 / $grid_columns );
                    $columns  = 'col-lg-'.$colwidth.' col-md-6 col-sm-6 col-xs-12 mb50';
                }
            }
        }
        ?>

        <div class="ultimate__product__products__wrap">

            <?php

                /**
                 *  PRODUCT FILTER MENU
                 */
                if ( $product_tabs == 'yes' ) {
                    $this->ultimate_product_filter_menu();
                }
            ?>

            <?php if( is_array( $product_cats ) && (count( $product_cats ) > 0) && ( $product_tabs == 'yes' ) ): ?>
                
                <div class="tab-content product__tab__content">
                    <?php
                        /**
                         *  SINGLE CATEGORY QUERY
                         */
                        $default = 0;
                        foreach( $product_cats as $cats ):
                            $default++;
                            $field_name        = is_numeric($product_cats[0])?'term_id':'slug';
                            $args['tax_query'] = array(
                                array(
                                    'taxonomy'         => 'product_cat',
                                    'terms'            => $cats,
                                    'field'            => $field_name,
                                    'include_children' => false
                                )
                            );
                            $products_query = new \WP_Query( $args ); ?>
                            <div class="tab-pane fade <?php if( $default == 1 ){echo 'active in';} ?>" id="<?php echo 'ultimate'.$tab_uniqid.$default;?>">
                                <div class="row">
                                    <div class="<?php echo esc_attr( $columns );?>"><!-- DEFAULT COLUMNS COUNTER -->
                                    <?php
                                        $item_count = 1;
                                        if( $products_query->have_posts() ): while( $products_query->have_posts() ) : $products_query->the_post(); 
                                            $this->ultimate_product_item_loop_content();  ?>
                                    <?php if ( $item_count % $rows == 0 && ( $products_query->post_count != $item_count ) ) : ?>
                                    <!-- ITEM ROW COUNT -->
                                    </div>
                                <div class="<?php echo esc_attr( $columns );?>">
                                    <!-- ITEM ROW COUNT END -->
                                    <?php endif; $item_count++; endwhile; wp_reset_postdata(); endif; ?>
                                    </div> <!-- DEFAULT COLUMNS COUNTER END-->
                                </div>
                            </div>
                    <?php endforeach; ?>
                </div>

            <?php else : ?>

                <div class="product__list__wrap__default">
                    <div class="product__items">
                        <?php
                            /**
                             *  GENARAL POST QUERY
                             */
                            if( $products_query->have_posts() ): while( $products_query->have_posts() ): $products_query->the_post();
                                $this->ultimate_product_item_loop_content(); endwhile; wp_reset_postdata();
                            endif;
                        ?>
                    </div>
                </div>

            <?php endif; ?>
        </div> 
    <?php
    }

    /*------------------------------------------
        PRODUCT LOOP CONTENT
    -------------------------------------------*/
    public function ultimate_product_item_loop_content(){
        $settings = $this->get_settings_for_display();  ?>
            <div class="single__product__item">
                <div class="product__item__inner">
                    <div class="product__image__wrap">
                        <a href="<?php the_permalink();?>" class="product__image__and__sale_flush">
                            <?php 
                                $this->ultimate_sale_flush();
                                $this->ultimate_product_thumb();
                            ?>
                        </a>
                        <?php $this->ultimate_product_action_buttons(); ?>
                    </div>
                    <div class="product__information__area">
                        <?php $this->ultimate_product_content(); ?>
                    </div>
                </div>
            </div>
        <?php 
    }

    /*------------------------------------------
        PRODUCT CONTENT
    -------------------------------------------*/
    public function ultimate_product_content(){
        $settings = $this->get_settings_for_display(); ?>
        <div class="product__item__content">
            <?php $this->ultimate_product_title(); ?>
            <?php $this->ultimate_product_price(); ?>
        </div>
    <?php
    }    

    /*-----------------------------------------
        ULTIMATE SALE FLUSH
    -----------------------------------------*/
    public function ultimate_product_thumb(){
        woocommerce_template_loop_product_thumbnail();
    }

    /*-----------------------------------------
        ULTIMATE SALE FLUSH
    -----------------------------------------*/
    public function ultimate_sale_flush(){
        $settings = $this->get_settings_for_display();
        if ( 'yes' == $settings['show_saleflash'] ){
            woocommerce_show_product_loop_sale_flash();
        }
    }

    /*-----------------------------------------
        PRODUCT TITLE
    -----------------------------------------*/
    public function ultimate_product_title(){
        $settings = $this->get_settings_for_display(); ?>
        <?php if ( 'yes' == $settings['show_title'] ): ?>
            <h4 class="product__item__title"><a href="<?php the_permalink();?>"><?php echo get_the_title();?></a></h4>
        <?php endif; ?>
    <?php
    }

    /*-----------------------------------------
        PRODUCT PRICE
    -----------------------------------------*/
    public function ultimate_product_price(){
        $settings = $this->get_settings_for_display(); ?>
        <?php if ( 'yes' == $settings['show_price'] ): ?>
        <div class="product__item__price">
            <?php woocommerce_template_loop_price(); ?>
        </div>
        <?php endif; ?>
    <?php
    }

    /*------------------------------------------
        PRODUCT ACTION BUTTON
    -------------------------------------------*/
    public function ultimate_product_action_buttons(){
        $settings = $this->get_settings_for_display(); ?>
        <?php if( 'yes' == $settings['show_buttons'] ): ?>
        <div class="product__item__buttons">
            <?php
                if ( 'yes' == $settings['show_quickview'] ) {
                    if ( class_exists( 'YITH_WCQV_Frontend' ) ) {
                        ultimate_quick_view_button();
                    }
                }
                if ( 'yes' == $settings['show_wishlist'] ) {
                    if ( class_exists( 'YITH_WCWL' ) ) {
                        ultimate_add_to_wishlist_button();
                    }
                }
                if ( 'yes' == $settings['show_compare'] ) {
                    if ( class_exists( 'YITH_Woocompare' ) && !Plugin::instance()->editor->is_edit_mode() ) {
                        ultimate_woocommerce_compare_button();
                    }
                }
                if ( 'yes' == $settings['show_buynow'] ) {
                    if ( function_exists('ultimate_woocommerce_addcart') ) {
                        ultimate_woocommerce_addcart();
                    }
                }
            ?>
        </div>
        <?php endif; ?>
    <?php
    }

    /*------------------------------------------
        PRODUCT ATTRIBUTE
    -------------------------------------------*/
    public function ultimate_product_attribute(){
        $settings = $this->get_settings_for_display();
        if ( 'yes' == $settings['show_attribute'] ) {
            global $product; 
            $attributes = $product->get_attributes();

            if( $attributes ) : ?>
                <div class="product__item__attributes">
                    <?php foreach ( $attributes as $attribute ) : ?>
                        <?php $name = $attribute->get_name(); ?>
                        <ul>
                            <li class="attribute_label"><?php echo wc_attribute_label( $attribute->get_name() ).esc_html__(':','ultimate'); ?></li>
                            <?php
                                if ( $attribute->is_taxonomy() ) {
                                    global $wc_product_attributes;
                                    $product_terms = wc_get_product_terms( $product->get_id(), $name, array( 'fields' => 'all' ) );
                                    foreach ( $product_terms as $product_term ) {
                                        $product_term_name = esc_html( $product_term->name );
                                        $link              = get_term_link( $product_term->term_id, $name );
                                        $color             = get_term_meta( $product_term->term_id, 'color', true );
                                        if ( ! empty ( $wc_product_attributes[ $name ]->attribute_public ) ) {
                                            echo '<li><a href="' . esc_url( $link  ) . '" rel="tag">' . $product_term_name . '</a></li>';
                                        }else{
                                            if(!empty($color)){
                                                echo '<li class="color_attribute" style="background-color: '.$color.';">&nbsp;</li>';
                                            }else{
                                                echo '<li>' . $product_term_name . '</li>';
                                            } 
                                        }
                                    }
                                }
                            ?>
                        </ul>
                    <?php endforeach; ?>
                </div>
            <?php
            endif;
        }
    }

    /*------------------------------------------
        PRODUCT FILTER LIST
    -------------------------------------------*/
    public function ultimate_product_filter_menu(){ 
        $settings   = $this->get_settings_for_display();
        $tab_uniqid = $this->get_id();?>
        <!-- CATEGORY RETRIVE FOR FILTERING -->
        <div class="product__tab__menu__list">
            <ul class="tab__menus nav nav-tabs">
                <?php
                    $get_product_categories = $settings['ultimate_product_grid_categories'];  /*get custom field value*/
                    $product_cats           = str_replace(' ', '', $get_product_categories);
                    $default = 0;
                    if( is_array( $product_cats ) && count( $product_cats ) > 0 ){

                        // Category Retrive
                        $catargs = array(
                            'orderby'    => 'name',
                            'order'      => 'ASC',
                            'hide_empty' => true,
                            'slug'       => $product_cats,
                        );
                        $prod_categories = get_terms( 'product_cat', $catargs);
                        foreach( $prod_categories as $prod_cats ){ $default++; ?>
                            <li <?php if($default==1){echo 'class="active"';} ?>>
                                <a data-toggle="tab" href="#ultimate<?php echo $tab_uniqid.esc_attr( $default );?>"><?php echo esc_attr( $prod_cats->name,'ultimate' );?></a>
                            </li>
                            <?php
                        }
                    }
                ?>
            </ul>
        </div>
        <!-- CATEGORY RETRIVE FOR FILTERING -->
    <?php
    }
}
Plugin::instance()->widgets_manager->register_widget_type( new Ultimatee_WooCommerce_Products_Widget() );