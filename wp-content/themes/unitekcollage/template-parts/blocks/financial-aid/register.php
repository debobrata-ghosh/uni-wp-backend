<?php
if(function_exists('acf_register_block_type')){
    acf_register_block_type([
        'name' => 'financial-aid',
        'title' => __('Financial Aid & Cross Program'),
        'description' => __('Side-by-side content section for financial aid and cross program info'),
        'render_template' => get_template_directory() . '/template-parts/blocks/financial-aid/render.php',
        'category' => 'design',
        'icon' => 'money',
        'keywords' => ['financial aid', 'cross program', 'aid', 'section'],
        'supports' => [
            'align' => ['wide', 'full'],
            'anchor' => true,
            'customClassName' => true,
        ],
        'enqueue_assets' => function() {
            $block_dir = get_template_directory() . '/template-parts/blocks/financial-aid/';
            $block_url = get_template_directory_uri() . '/template-parts/blocks/financial-aid/';
            
            wp_enqueue_style(
                'financial-aid-style',
                $block_url . 'style.css',
                array(),
                filemtime($block_dir . 'style.css')
            );
        },
    ]);
}
