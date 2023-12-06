<?php

// Include Custom Post Types
require_once get_stylesheet_directory(). '/cpt/index.php';

//require_once('testimonie-type.php');
// Child Theme Setup
function wpbf_child_theme_setup() {

    // Child Theme Textdomain
    load_child_theme_textdomain( 'page-builder-framework-child', WPBF_CHILD_THEME_DIR . '/languages' );

}
add_action( 'after_setup_theme', 'wpbf_child_theme_setup' );

// Enqueue Child Theme Scripts and Styles
add_action( 'wp_enqueue_scripts', 'wpbf_child_scripts', 13 );

function wpbf_child_scripts() {

    // Styles
    wp_enqueue_style( 'wpbf-style-child', WPBF_CHILD_THEME_URI . '/style.css', false, WPBF_CHILD_VERSION );

    // Scripts 
        wp_enqueue_script( 'owl-scripts',  WPBF_CHILD_THEME_URI . '/js/owl.carousel.js', false, WPBF_CHILD_VERSION, true);
     wp_enqueue_script( 'wpbf-site-child', WPBF_CHILD_THEME_URI . '/js/site-child.js', false, WPBF_CHILD_VERSION, true );

}

function shortcode_PartnersList() {
	/*h = curl_init();
curl_setopt($_h, CURLOPT_HEADER, 1);
curl_setopt($_h, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($_h, CURLOPT_HTTPGET, 1);
curl_setopt($_h, CURLOPT_URL, 'https://dummy.restapiexample.com/api/v1/employees' );
curl_setopt($_h, CURLOPT_DNS_USE_GLOBAL_CACHE, false );
curl_setopt($_h, CURLOPT_DNS_CACHE_TIMEOUT, 2 );
	

var_dump(curl_exec($_h));
var_dump(curl_getinfo($_h));
var_dump(curl_error($_h)); 
	$handle = curl_init();
 */
global $wpdb;

    $posts = $wpdb->get_results("SELECT P1.ID, P1.post_title,P2.guid FROM $wpdb->posts AS P1 
                                JOIN $wpdb->posts AS P2 ON P2.post_parent   = P1.ID
                                WHERE P1.post_status = 'publish' AND P1.post_type IN('wlshowcase','attachment') 
                                ORDER BY P1.post_title  ASC ");
   // echo "<pre>";print_r($posts);
    #$url = "https://testapptor1a.chargeautomation.com/api/get-payment-gateways";
    //$request = wp_safe_remote_get('http://138.197.165.176/api/get-payment-gateways');
	//$request = wp_safe_remote_get('https://app.chargeautomation.com/api/get-payment-gateways');
//	$request = wp_safe_remote_get('https://chargeautomation.com/');
	//https://testapptor1a.chargeautomation.com/api/get-payment-gateways
	//$request = wp_safe_remote_get('https://reqres.in/api/users?page=1');
	
	//print_r($request);
	
   $data - new stdclass();
    if ( is_array( $request ) ) {
      $header = $response['headers']; 
      $body = $request['body']; 
      $data = json_decode( $body);
    }
	$html_partners = '';
	  $html_partners .=' </div>
<style>
.wp-block-image-cv{
        background: transparent;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 200px;
    margin-left: 5px;
    margin-right: 5px;
    flex: 1 1 200px;
    border: 1px solid #ccc;
}
.wp-block-column-cv {
    flex-basis: calc(25% - 16px) !important ;
}
</style>';
    if(isset($posts) && count($posts)>0){
        
        $ctr=0;
        
                foreach( $posts as $k => $list ) {
                if($list->ID !=6){
                    if($ctr==0){
                            $html_partners .='<div class="wp-block-columns has-4-columns logos">';      
                        }else if($ctr % 4 ==0){
                            $html_partners .='</div><div class="wp-block-columns has-4-columns logos">';        
                        }
                        $html_partners .=' <div class="wp-block-column wp-block-column-cv1">
                                                <figure class="wp-block-image wp-block-image-cv"><img src="'.$list->guid.'" alt="" class="wp-image-158"     ></figure>
                                        
                                        <p style="text-align:center" class="has-text-color has-very-dark-gray-color"><strong>'.$list->post_title.'</strong></p>
                                        <p style="text-align:center" class="has-text-color has-very-dark-gray-color hidden"><strong></strong></p>
                                    </div>';
                        $ctr++;
                }
            }
          
		
            return $html_partners;
    }else{
		$html_partners .= "<p> Data not found! </p>";
		return $html_partners;
        //return "<p> Data not found! </p>";
    }
}
add_shortcode('partnerslist', 'shortcode_PartnersList');