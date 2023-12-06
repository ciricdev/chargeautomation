<?php
/*-------------------------------
	CUSTOM IMAGE SIZE
--------------------------------*/
add_image_size( 'ultimate_grid_big_thumb', 570, 330 );
add_image_size( 'ultimate_grid_small_thumb', 270, 180 );

/*------------------------------
	CUSTOM FONTS CONTROLS
-------------------------------*/
class Ultimate_Custom_Functions{

    public function __construct() {
		add_action( 'elementor/controls/controls_registered', [ $this, 'add_custom_font' ] );  
	}
	
	public function add_custom_font( $controls_registry ){

	    $new_fonts = array(        
	        "Gilroy" => "googlefonts"
	    );

	    // For Elementor 1.7.10 and newer
	    $fonts = $controls_registry->get_control( 'font' )->get_settings( 'options' );
	    $fonts = array_merge($fonts,$new_fonts);

	    // Register here the custom font families
	    $controls_registry->get_control( 'font' )->set_settings( 'options', $fonts );  
	}
}
new Ultimate_Custom_Functions();

/*------------------------------
    WOOCOMMERCE FUNCTIONALITY
-------------------------------*/
if ( class_exists( 'WooCommerce' ) ) {
    
    add_action( 'after_setup_theme', 'ultimate_woocommerce_setup' );
    function ultimate_woocommerce_setup() {

        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
        add_theme_support( 'woocommerce', array(
            'thumbnail_image_width' => 500,
        ));
    }

    /*---------------------------------------
        ADD EXTRA METABOX TAB TO WOOCOMMERCE
    ----------------------------------------*/
    if( !function_exists('ultimate_add_wc_extra_metabox_tab')){
        function ultimate_add_wc_extra_metabox_tab($tabs){
            $ultimate_tab = array(
                'label'    => __( 'Product Badge', 'ultimate' ),
                'target'   => 'ultimate_product_data',
                'class'    => '',
                'priority' => 80,
            );
            $tabs[] = $ultimate_tab;
            return $tabs;
        }
        add_filter( 'woocommerce_product_data_tabs', 'ultimate_add_wc_extra_metabox_tab' );
    }

    // add metabox to general tab
    if( !function_exists('ultimate_add_metabox_to_general_tab')){
        function ultimate_add_metabox_to_general_tab(){
            echo '<div id="ultimate_product_data" class="panel woocommerce_options_panel hidden">';
                woocommerce_wp_text_input( array(
                    'id'          => '_saleflash_text',
                    'label'       => __( 'Custom Product Badge Text', 'ultimate' ),
                    'placeholder' => __( 'New', 'ultimate' ),
                    'description' => __( 'Enter your prefered SaleFlash text. Ex: New / Free etc', 'ultimate' ),
                ) );
            echo '</div>';
        }
        add_action( 'woocommerce_product_data_panels', 'ultimate_add_metabox_to_general_tab' );
    }
    // Update data
    if( !function_exists('ultimate_save_metabox_of_general_tab') ){
        function ultimate_save_metabox_of_general_tab( $post_id ){
            $saleflash_text = wp_kses_post( stripslashes( $_POST['_saleflash_text'] ) );
            update_post_meta( $post_id, '_saleflash_text', $saleflash_text);
        }
        add_action( 'woocommerce_process_product_meta', 'ultimate_save_metabox_of_general_tab');
    }

    /*--------------------------------
        CUSTOM PRODUCT BADGE
    --------------------------------*/
    function ultimate_custom_product_badge( $show = 'yes' ){
        global $product;
        $custom_saleflash_text = get_post_meta( get_the_ID(), '_saleflash_text', true );
        if( $show == 'yes' ){
            if( !empty( $custom_saleflash_text ) && $product->is_in_stock() ){
                if( $product->is_featured() ){
                    echo '<span class="ht-product-label ht-product-label-left hot">' . esc_html( $custom_saleflash_text ) . '</span>';
                }else{
                    echo '<span class="ht-product-label ht-product-label-left">' . esc_html( $custom_saleflash_text ) . '</span>';
                }
            }
        }
    }

    /*--------------------------------
         SALE FLASH
    ---------------------------------*/
    function ultimate_sale_flash( $offertype = 'default' ){
        global $product;
        if( $product->is_on_sale() && $product->is_in_stock() ){
            if( $offertype !='default' && $product->get_regular_price() > 0 ){
                $_off_percent  = ( 1 - round( $product->get_price() / $product->get_regular_price(), 2 ))*100;
                $_off_price    = round($product->get_regular_price() - $product->get_price(), 0);
                $_price_symbol = get_woocommerce_currency_symbol();
                $symbol_pos    = get_option('woocommerce_currency_pos', 'left');
                $price_display = '';
                switch( $symbol_pos ){
                    case 'left':
                        $price_display = '-'.$_price_symbol.$_off_price;
                    break;
                    case 'right':
                        $price_display = '-'.$_off_price.$_price_symbol;
                    break;
                    case 'left_space':
                        $price_display = '-'.$_price_symbol.' '.$_off_price;
                    break;
                    default: /* right_space */
                        $price_display = '-'.$_off_price.' '.$_price_symbol;
                    break;
                }
                if( $offertype == 'number' ){
                    echo '<span class="ht-product-label ht-product-label-right">'.$price_display.'</span>';
                }elseif( $offertype == 'percent'){
                    echo '<span class="ht-product-label ht-product-label-right">'.$_off_percent.'%</span>';
                }else{ echo ' '; }

            }else{
                echo '<span class="ht-product-label ht-product-label-right">'.esc_html__( 'Sale!', 'ultimate' ).'</span>';
            }
        }else{
            $out_of_stock      = get_post_meta( get_the_ID(), '_stock_status', true );
            $out_of_stock_text = apply_filters( 'ultimate_shop_out_of_stock_text', __( 'Out of stock', 'ultimate' ) );
            if ( 'outofstock' === $out_of_stock ) {
                echo '<span class="ht-stockout ht-product-label ht-product-label-right">'.esc_html( $out_of_stock_text ).'</span>';
            }
        }
    }

    /*------------------------------------
        WOOCOMMERCE DEFAULT RESULT COUNT
    --------------------------------------*/
    function ultimate_product_result_count( $total, $perpage, $paged ){
        wc_set_loop_prop( 'total', $total );
        wc_set_loop_prop( 'per_page', $perpage );
        wc_set_loop_prop( 'current_page', $paged );
        $geargs = array(
            'total'    => wc_get_loop_prop( 'total' ),
            'per_page' => wc_get_loop_prop( 'per_page' ),
            'current'  => wc_get_loop_prop( 'current_page' ),
        );
        wc_get_template( 'loop/result-count.php', $geargs );
    }

    /*-------------------------------------
        WOOCOMMERCE DEFAULT PRODUCT SHORTING
    ---------------------------------------*/
    function ultimate_product_shorting( $getorderby ){
        ?>
        <div class="ultimate-custom-sorting">
            <form class="woocommerce-ordering" method="get">
                <select name="orderby" class="orderby">
                    <?php
                        $catalog_orderby = apply_filters( 'woocommerce_catalog_orderby', array(
                            'menu_order' => __( 'Default sorting', 'ultimate' ),
                            'popularity' => __( 'Sort by popularity', 'ultimate' ),
                            'rating'     => __( 'Sort by average rating', 'ultimate' ),
                            'date'       => __( 'Sort by latest', 'ultimate' ),
                            'price'      => __( 'Sort by price: low to high', 'ultimate' ),
                            'price-desc' => __( 'Sort by price: high to low', 'ultimate' ),
                        ) );
                        foreach ( $catalog_orderby as $id => $name ){
                            echo '<option value="' . esc_attr( $id ) . '" ' . selected( $getorderby, $id, false ) . '>' . esc_attr( $name ) . '</option>';
                        }
                    ?>
                </select>
                <?php
                    // Keep query string vars intact
                    foreach ( $_GET as $key => $val ) {
                        if ( 'orderby' === $key || 'submit' === $key )
                            continue;
                        if ( is_array( $val ) ) {
                            foreach( $val as $innerVal ) {
                                echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
                            }
                        } else {
                            echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
                        }
                    }
                ?>
            </form>
        </div>
        <?php
    }

    /*------------------------------
        CUSTOM PAGE PAGINATION
    -------------------------------*/
    function ultimate_custom_pagination( $totalpage ){
        echo '<div class="ht-row woocommerce"><div class="ht-col-xs-12"><nav class="woocommerce-pagination">';
            echo paginate_links( apply_filters(
                    'woocommerce_pagination_args', array(
                        'base'      => esc_url( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ), 
                        'format'    => '', 
                        'current'   => max( 1, get_query_var( 'paged' ) ), 
                        'total'     => $totalpage, 
                        'prev_text' => '&larr;', 
                        'next_text' => '&rarr;', 
                        'type'      => 'list', 
                        'end_size'  => 3, 
                        'mid_size'  => 3 
                    )
                )       
            );
        echo '</div></div></div>';
    }

    /*------------------------------
        CHANGE PRODUCT PER PAGE
    --------------------------------*/

    /*-----------------------------------------
        ADD TO CART BUTTON
    -----------------------------------------*/
    function ultimate_woocommerce_addcart(){
        echo '<div class="ultimate__add__to__cart">';
            woocommerce_template_loop_add_to_cart();
        echo '</div>';
    }
}

/*------------------------------------------
    PRODUCT QUICKVIEW BUTTON
-------------------------------------------*/
/**
[yith_quick_view product_id="30" type="button" label="Quick View"]

* Usages: Compare button shortcode [yith_compare_button] From "YITH WooCommerce Quickview" plugins.
* Plugins URL: https://wordpress.org/plugins/yith-woocommerce-quickview/
* File Path: https://docs.yithemes.com/yith-woocommerce-quick-view/premium-version-settings/shortcode/
* The Function "ultimate_woocommerce_compare_button" Depends on YITH WooCommerce Compare plugins. If YITH WooCommerce Compare is installed and actived, then it will work.
*/
function ultimate_quick_view_button( $product_id = 0, $label = '', $return = false ) {
    if( !class_exists('YITH_WCQV_Frontend') ){
        return;
    }
    global $product;

    if( ! $product_id ){
        $product instanceof WC_Product && $product_id = yit_get_prop( $product, 'id', true );
    }
    $show_quick_view_button = apply_filters( 'yith_wcqv_show_quick_view_button', true, $product_id );
    if( !$show_quick_view_button ) return;

    $button = '';
    if( $product_id ) {
        // get label
        $label  = $label ? $label : esc_html__( 'Quick View', 'ultimate' );
        $button = '<div class="ultimate__quickview__button"><a title="'.esc_attr__( 'Quick View', 'ultimate' ).'" href="#" class="button yith-wcqv-button" data-product_id="' . $product_id . '"><i class="ti ti-zoom-in"></i>' . $label . '</a></div>';
        $button = apply_filters('yith_add_quick_view_button_html', $button, $label, $product);
    }
    if( $return ) {
        return $button;
    }
    echo $button;
}
remove_action( 'woocommerce_after_shop_loop_item', 'yith_add_quick_view_button', 15 );
remove_action( 'yith_wcwl_table_after_product_name', 'yith_add_quick_view_button', 15 );

/*------------------------------------------
    PRODUCT WISHLIST BUTTON
-------------------------------------------*/
/**
* Usages: "ultimate_add_to_wishlist_button()" function is used  to modify the wishlist button from "YITH WooCommerce Wishlist" plugins.
* Plugins URL: https://wordpress.org/plugins/yith-woocommerce-wishlist/
* File Path: yith-woocommerce-wishlist/templates/add-to-wishlist.php
* The below Function depends on YITH WooCommerce Wishlist plugins. If YITH WooCommerce Wishlist is installed and actived, then it will work.
*/

function ultimate_add_to_wishlist_button( $normalicon = '<i class="fa fa-heart-o"></i>', $addedicon = '<i class="fa fa-heart"></i>', $tooltip = 'no' ) {
    global $product, $yith_wcwl;

    if ( ! class_exists( 'YITH_WCWL' ) || empty(get_option( 'yith_wcwl_wishlist_page_id' ))) return;

    $url          = YITH_WCWL()->get_wishlist_url();
    $product_type = $product->get_type();
    $exists       = $yith_wcwl->is_product_in_wishlist( $product->get_id() );
    $classes      = 'class="add_to_wishlist"';
    $add          = get_option( 'yith_wcwl_add_to_wishlist_text' );
    $browse       = get_option( 'yith_wcwl_browse_wishlist_text' );
    $added        = get_option( 'yith_wcwl_product_added_text' );

    $output = '';
    $output  .= '<div class="'.( $tooltip == 'yes' ? '' : 'tooltip_no' ).' wishlist button-default yith-wcwl-add-to-wishlist add-to-wishlist-' . esc_attr( $product->get_id() ) . '">';
        $output .= '<div class="yith-wcwl-add-button';
            $output .= $exists ? ' hide" style="display:none;"' : ' show"';
            $output .= '><a href="' . esc_url( htmlspecialchars( YITH_WCWL()->get_wishlist_url() ) ) . '" data-product-id="' . esc_attr( $product->get_id() ) . '" data-product-type="' . esc_attr( $product_type ) . '" ' . $classes . ' >'.$normalicon.'<span class="ultimate__product__action__tooltip">'.esc_html( $add ).'</span></a>';
            $output .= '<i class="fa fa-spinner fa-pulse ajax-loading" style="visibility:hidden"></i>';
        $output .= '</div>';

        $output .= '<div class="yith-wcwl-wishlistaddedbrowse show" style="display:block;"><a class="" href="' . esc_url( $url ) . '">'.$addedicon.'<span class="ultimate__product__action__tooltip">'.esc_html( $browse ).'</span></a></div>';
        $output .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><a href="' . esc_url( $url ) . '" class="">'.$addedicon.'<span class="ultimate__product__action__tooltip">'.esc_html( $added ).'</span></a></div>';
    $output .= '</div>';
    echo $output;
}

/*------------------------------------------
    PRODUCT COMPARE BUTTON
-------------------------------------------*/
/**
* Usages: Compare button shortcode [yith_compare_button] From "YITH WooCommerce Compare" plugins.
* Plugins URL: https://wordpress.org/plugins/yith-woocommerce-compare/
* File Path: yith-woocommerce-compare/includes/class.yith-woocompare-frontend.php
* The Function "ultimate_woocommerce_compare_button" Depends on YITH WooCommerce Compare plugins. If YITH WooCommerce Compare is installed and actived, then it will work.
*/
function ultimate_woocommerce_compare_button( $buttonstyle = 1 ){
    if( !class_exists('YITH_Woocompare') ) return;
    global $product;
    $product_id = $product->get_id();
    $comp_link  = site_url() . '?action=yith-woocompare-add-product';
    $comp_link  = add_query_arg('id', $product_id, $comp_link);

    if( $buttonstyle == 1 ){
        echo do_shortcode('[yith_compare_button]');
    }else{
        echo '<a href="'. esc_url( $comp_link ) .'" class="ultimate__compare__button woocommerce product compare-button" data-product_id="'. esc_attr( $product_id ) .'" rel="nofollow"><i class="ti ti-reload"></i>'.esc_html__( 'Compare', 'ultimate' ).'</a>';
    }
}

/*----------------------------
	CONTACT FORM 7 RETURN ARRAY
-------------------------------*/
function ultimate_get_contact_forms_seven_list(){
	$forms_list = array();
	$forms_args = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
	$forms      = get_posts( $forms_args );

    if( $forms ){
        foreach ( $forms as $form ){
            $forms_list[$form->ID] = $form->post_title;
        }
    }else{
        $forms_list[ esc_html__( 'No contact form found', 'ultimate' ) ] = 0;
    }
    return $forms_list;
}

/*---------------------------
	WP FORMS RETURN ARRAY
-----------------------------*/
/*function ultimate_get_wpforms_forms_list(){
	$forms_list = array();
	$forms_args = array( 'posts_per_page' => -1, 'post_type'=> 'wpforms' );
	$forms      = get_posts( $forms_args );
    if( $forms ){
        foreach ( $forms as $form ){
            $forms_list[$form->ID] = $form->post_title;
        }
    }else{
        $forms_list[ __( 'Form not found', 'ultimate' ) ] = 0;
    }
    return $forms_list;
}
*/
/*---------------------------
	WE FORM RETURN ARRAY
-----------------------------*/
/*function ultimate_get_we_forms_list() {
    $forms = [];
    if ( class_exists( 'WeForms' ) ) {
        $_forms = get_posts( [
			'post_type'      => 'wpuf_contact_form',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'orderby'        => 'title',
			'order'          => 'ASC',
        ] );

        if ( ! empty( $_forms ) ) {
            $forms = wp_list_pluck( $_forms, 'post_title', 'ID' );
        }
    }
    return $forms;
}*/

/*---------------------------
	CALDERA FORM RETURN ARRAY
-----------------------------*/
/*function ultimate_get_caldera_forms_list() {
    if ( class_exists( 'Caldera_Forms' ) ) {
		$caldera_forms = Caldera_Forms_Forms::get_forms( true, true );
		$form_list     = ['0' => esc_html__( 'Select Form', 'ultimate' )];
		$form          = array();
        if ( ! empty( $caldera_forms ) && ! is_wp_error( $caldera_forms ) ) {
            foreach ( $caldera_forms as $form ) {
                if ( isset($form['ID']) and isset($form['name'])) {
                    $form_list[$form['ID']] = $form['name'];
                }   
            }
        }
    }else{
        $form_list = ['0' => esc_html__( 'Form Not Found!', 'ultimate' ) ];
    }
    return $form_list;
}*/

/*---------------------------
	GRAVITY FORM RETURN ARRAY
----------------------------*/
/*function ultimate_get_gravity_forms_list() {
    if ( class_exists( 'GFForms' ) ) {
		$gravity_forms = \RGFormsModel::get_forms( null, 'title' );
		$form_list     = ['0' => esc_html__( 'Select Form', 'ultimate' )];
        if ( ! empty( $gravity_forms ) && ! is_wp_error( $gravity_forms ) ) {
            foreach ( $gravity_forms as $form ) {   
                $form_list[ $form->id ] = $form->title;
            }
        }
    }else{
        $form_list = ['0' => esc_html__( 'Form Not Found!', 'ultimate' ) ];
    }
    return $form_list;
}
*/
/*---------------------------
	NINJA FORM RETURN ARRAY
-----------------------------*/
/*function ultimate_get_ninja_forms_list() {
    $form_list = array();
    if ( class_exists( 'Ninja_Forms' ) ) {
        $ninja_forms  = Ninja_Forms()->form()->get_forms();
        if ( ! empty( $ninja_forms ) && ! is_wp_error( $ninja_forms ) ) {
            $form_list = ['0' => esc_html__( 'Select Form', 'ultimate' )];
            foreach ( $ninja_forms as $form ) {   
                $form_list[ $form->get_id() ] = $form->get_setting( 'title' );
            }
        }
    } else {
        $form_list = ['0' => esc_html__( 'Form Not Found.', 'ultimate' ) ];
    }
    return $form_list;
}*/

/*----------------------------
    SAASMAX WIDGETS CONTROL
-----------------------------*/
function ultimate_widget_control(){
    return [
        'area_title'         => esc_html__( 'Area Title', 'ultimate' ),
        'box'                => esc_html__( 'Box', 'ultimate' ),
        'counter'            => esc_html__( 'Counter', 'ultimate' ),
        'download_button'    => esc_html__( 'Download Button', 'ultimate' ),
        'image_carousel'     => esc_html__( 'Image Carousel', 'ultimate' ),
        'image_carousel_alt' => esc_html__( 'Image Carousel Alt', 'ultimate' ),
        'navigation_menu'    => esc_html__( 'Navigation Menu', 'ultimate' ),
        'price_table'        => esc_html__( 'Price Table', 'ultimate' ),
        'position_element'   => esc_html__( 'Position Element', 'ultimate' ),
        'progress_roadmap'   => esc_html__( 'Progress Roadmap', 'ultimate' ),
        'post_carousel'      => esc_html__( 'Post Carousel', 'ultimate' ),
        'post_group'         => esc_html__( 'Post Group', 'ultimate' ),
        'subscriber_form'    => esc_html__( 'Subscriber Form', 'ultimate' ),
        'socials'            => esc_html__( 'Socials', 'ultimate' ),
        'shortcode'          => esc_html__( 'Shortcode', 'ultimate' ),
        'tabs_price'         => esc_html__( 'Tabs Price', 'ultimate' ),
        'teams'              => esc_html__( 'Teams', 'ultimate' ),
        'testimonials'       => esc_html__( 'Testimonial', 'ultimate' ),
        'timeline_step'      => esc_html__( 'Timeline Step', 'ultimate' ),
        'tabs'               => esc_html__( 'Tabs', 'ultimate' ),
        'video_popup_button' => esc_html__( 'Video Popup Button', 'ultimate' ),
    ];
}