<?php
add_action('acf/init', 'ca_acf_init_documentation');

function ca_acf_init_documentation() {
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name' => 'documentation',
            'title' => __('Documentation'),
            'description' => __('Repeater of Contents and Links'),
            'render_template' => 'template-parts/blocks/documentation.php',
            'category' => 'partner-integration',
            'icon' => 'media-document',
            'mode' => 'edit',
            'keywords' => array('link', 'documentation'),
            'example' => [
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'preview_image_help' => get_stylesheet_directory_uri() . '/assets/images/block-previews/documentation.png',
                    )
                )
            ],
        ));
    }
}