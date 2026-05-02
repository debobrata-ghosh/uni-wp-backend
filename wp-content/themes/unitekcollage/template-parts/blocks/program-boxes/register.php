<?php
if(function_exists('acf_register_block_type')){
    acf_register_block_type([
        'name'            => 'program-boxes',
        'title'           => __('Program Boxes'),
        'description'     => __('Section with two feature text blocks, button, and three right-side images.'),
        'render_template' => get_template_directory() . '/template-parts/blocks/program-boxes/render.php',
        'category'        => 'design',
        'icon'            => 'screenoptions',
        'keywords'        => ['program', 'boxes', 'cta', 'layout'],
        'supports'        => [
            'align'           => ['wide', 'full'],
            'anchor'          => true,
            'customClassName' => true,
        ],
        'enqueue_assets'  => function() {
            $block_dir = get_template_directory() . '/template-parts/blocks/program-boxes/';
            $block_url = get_template_directory_uri() . '/template-parts/blocks/program-boxes/';
            
            wp_enqueue_style(
                'program-boxes-style',
                $block_url . 'style.css',
                array(),
                filemtime($block_dir . 'style.css')
            );
            
            wp_enqueue_script(
                'program-boxes-script',
                $block_url . 'script.js',
                array(),
                filemtime($block_dir . 'script.js'),
                true
            );
        },
    ]);
}
