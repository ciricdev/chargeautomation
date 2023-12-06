<?php
add_image_size( 'testimonie-thumnail', 600, 600, true );

add_action('init', 'testimonie_register');  
   
function testimonie_register() {  
    $args = array(  
        'label' => __('Testimonial'),  
        'singular_label' => __('Testimonial'),  
        'public' => true,  
        'show_ui' => true,  
        'capability_type' => 'post',  
        'hierarchical' => false,  
        'rewrite' => true,  
        'supports' => array('title', 'editor', 'thumbnail'), 
		'taxonomies'          => array( 'genres' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	
    register_post_type( 'testimonie' , $args );  
}
add_action("admin_init", "testimonie_Testimoniename_meta_box");   
 
 
function testimonie_Testimoniename_meta_box(){  
    add_meta_box("projName-meta", "City Name", "testimonie_Testimoniename_meta_options", "testimonie", "side", "low");  
}  
   
 
function testimonie_Testimoniename_meta_options(){  
        global $post;  
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
        $custom = get_post_custom($post->ID);  
        $pname = $custom["Testimoniename"][0];  
?>  
    <label>City Name:</label><input name="Testimoniename" value="<?php echo $pname; ?>" />  
<?php  
    }
add_action('save_post', 'save_Testimonie_name'); 
   
function save_Testimonie_name(){  
    global $post;  
     
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){ 
        return $post_id;
    }else{
        update_post_meta($post->ID, "Testimoniename", $_POST["Testimoniename"]); 
    } 
}
add_filter("manage_edit-testimonie_columns", "Testimonie_edit_columns");   
   
function Testimonie_edit_columns($columns){  
        $columns = array(  
            "cb" => "<input type=\"checkbox\" />",  
            "title" => "Client Name",  
            "description" => "Description",  
            "link" => "Link",  
            "type" => "Testimonie Genre",  
        );  
   
        return $columns;  
}   
add_action("manage_posts_custom_column",  "Testimonie_custom_columns"); 
   
function Testimonie_custom_columns($column){  
        global $post;  
        switch ($column)  
        {  
            case "description":  
                the_excerpt();  
                break;  
            case "link":  
                $custom = get_post_custom();  
                echo $custom["projLink"][0];  
                break;  
            case "type":  
                echo get_the_term_list($post->ID, 'Testimonie_genre', '', ', ','');  
                break;  
        }  
}
add_filter('excerpt_length', 'testimononie_excerpt_length');
 
function testimononie_excerpt_length($length) {
 
    return 25; 
 
} 
 
function testimonie_thumbnail_url($pid){
    $image_id = get_post_thumbnail_id($pid);  
    $image_url = wp_get_attachment_image_src($image_id,'screen-shot');  
    return  $image_url[0];  
}
add_action( 'init', 'create_my_taxonomies', 0 );
function create_my_taxonomies() {
    register_taxonomy(
        'Testimonie_genre',
        'testimonie',
        array(
            'labels' => array(
                'name' => 'Testimonie Genre',
                'add_new_item' => 'Add New Movie Genre',
                'new_item_name' => "New Movie Type Genre"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
}
?>