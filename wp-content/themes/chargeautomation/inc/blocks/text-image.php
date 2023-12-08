<?php
add_action('acf/init', 'ca_acf_init_text_image');

function ca_acf_init_text_image() {
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name' => 'text_image',
            'title' => __('Text Image'),
            'description' => __('Text with big image after'),
            'render_template' => 'template-parts/blocks/text-image.php',
            'category' => 'partner-integration',
            'icon' => 'search',
            'mode' => 'edit',
            'keywords' => array('text', 'image', 'description'),
            'example' => [
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'preview_image_help' => get_stylesheet_directory_uri() . '/assets/images/block-previews/text-image.png',
                    )
                )
            ],
        ));
    }
}