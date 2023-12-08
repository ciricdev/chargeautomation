<?php
add_action('acf/init', 'ca_acf_init_integration_list');

function ca_acf_init_integration_list() {
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name' => 'integration_list',
            'title' => __('Integration List'),
            'description' => __('List of all two-way or one-way integrations'),
            'render_template' => 'template-parts/blocks/integration-list.php',
            'category' => 'partner-integration',
            'icon' => 'columns',
            'mode' => 'edit',
            'keywords' => array('list', 'integration'),
            'example' => [
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'preview_image_help' => get_stylesheet_directory_uri() . '/assets/images/block-previews/integration-list.png',
                    )
                )
            ],
        ));
    }
}