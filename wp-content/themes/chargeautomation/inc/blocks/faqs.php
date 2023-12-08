<?php
add_action('acf/init', 'ca_acf_init_faqs');

function ca_acf_init_faqs() {
    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name' => 'faqs',
            'title' => __('FAQs'),
            'description' => __('A collapsible list of FAQs'),
            'render_template' => 'template-parts/blocks/faqs.php',
            'category' => 'partner-integration',
            'icon' => 'format-chat',
            'mode' => 'edit',
            'keywords' => array('faq'),
            'example' => [
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'preview_image_help' => get_stylesheet_directory_uri() . '/assets/images/block-previews/faqs.png',
                    )
                )
            ],
        ));
    }
}