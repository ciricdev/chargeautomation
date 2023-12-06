<?php

function register_pms_partners() {
    $singular = 'PMS Partner Integration'; // Book
	$plural = 'PMS Partner Integrations';  // Books
	
    $slug = str_replace( ' ', '-', strtolower( $singular ) );

    $labels = array(
        'name' 			      => __( $plural, 'pipeson' ),
        'singular_name' 	  => __( $singular, 'pipeson' ),
        'add_new' 		      => _x( 'Add New', 'pipeson', 'pipeson' ),
        'add_new_item'  	  => __( 'Add New ' . $singular, 'pipeson' ),
        'edit'		          => __( 'Edit', 'pipeson' ),
        'edit_item'	          => __( 'Edit ' . $singular, 'pipeson' ),
        'new_item'	          => __( 'New ' . $singular, 'pipeson' ),
        'view' 			      => __( 'View ' . $singular, 'pipeson' ),
        'view_item' 		  => __( 'View ' . $singular, 'pipeson' ),
        'search_term'   	  => __( 'Search ' . $plural, 'pipeson' ),
        'parent' 		      => __( 'Parent ' . $singular, 'pipeson' ),
        'not_found'           => __( 'No ' . $plural .' found', 'pipeson' ),
        'not_found_in_trash'  => __( 'No ' . $plural .' in Trash', 'pipeson' ),
    );

    $args = array(
        'labels'              => $labels,
        'hierarchical'        => false,
        'public'              => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'has_archive'         => false,
        'rewrite'             => array('slug' => $slug),
        'menu_icon'           => 'dashicons-admin-userse',
        'supports'            => array( 'title', 'thumbnail', 'editor' ),
        'show_in_rest'        => true
    );

    register_post_type( $slug, $args );
}

add_action( 'init', 'register_pms_partners');