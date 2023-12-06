<?php
add_filter('acf/settings/save_json', function() {
    return get_stylesheet_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function($paths) {
    $paths[] = get_template_directory() . '/acf-json';

    if(is_child_theme()) {
        $paths[] = get_stylesheet_directory() . '/acf-json';
    }

    return $paths;
});