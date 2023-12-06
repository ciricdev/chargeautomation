<?php

add_filter( 'block_categories_all' , function( $categories ) {

// Adding a new category.
$categories[] = array(
    'slug'  => 'partner-integration',
    'title' => 'Partner Integration CPT Blocks'
);

return $categories;
} );