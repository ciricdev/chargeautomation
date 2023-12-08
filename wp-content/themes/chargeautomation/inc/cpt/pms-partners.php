<?php

function register_partner_integration() {
    $singular = 'Partner Integration';
	$plural = 'Partner Integrations';

    $slug = str_replace( ' ', '-', strtolower( $singular ) );

    $labels = array(
        'name' 			      => __( $plural, 'ca' ),
        'singular_name' 	  => __( $singular, 'ca' ),
        'add_new' 		      => _x( 'Add New', 'ca', 'ca' ),
        'add_new_item'  	  => __( 'Add New ' . $singular, 'ca' ),
        'edit'		          => __( 'Edit', 'ca' ),
        'edit_item'	          => __( 'Edit ' . $singular, 'ca' ),
        'new_item'	          => __( 'New ' . $singular, 'ca' ),
        'view' 			      => __( 'View ' . $singular, 'ca' ),
        'view_item' 		  => __( 'View ' . $singular, 'ca' ),
        'search_term'   	  => __( 'Search ' . $plural, 'ca' ),
        'parent' 		      => __( 'Parent ' . $singular, 'ca' ),
        'not_found'           => __( 'No ' . $plural .' found', 'ca' ),
        'not_found_in_trash'  => __( 'No ' . $plural .' in Trash', 'ca' ),
    );

    $args = array(
        'labels'              => $labels,
        'hierarchical'        => false,
        'public'              => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'has_archive'         => false,
        'rewrite'             => array('slug' => $slug),
        'menu_icon'           => 'dashicons-controls-repeat',
        'supports'            => array( 'title', 'thumbnail', 'editor', 'excerpt' ),
        'show_in_rest'        => true
    );

    register_post_type( $slug, $args );
}

add_action( 'init', 'register_partner_integration');