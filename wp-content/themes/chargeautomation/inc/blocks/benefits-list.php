<?php
add_action('acf/init', 'ca_acf_init_benefits_list');

function ca_acf_init_benefits_list() {
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name' => 'benefits_list',
            'title' => __('Benifints List'),
            'description' => __('List of Benefits with Heading and content'),
            'render_template' => 'template-parts/blocks/benefits-list.php',
            'category' => 'partner-integration',
            'icon' => 'editor-ul',
            'mode' => 'edit',
            'keywords' => array('list', 'benefits'),
            'example' => [
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'preview_image_help' => get_stylesheet_directory_uri() . '/assets/images/block-previews/benefits-list.png',
                    )
                )
            ],
        ));
    }
}