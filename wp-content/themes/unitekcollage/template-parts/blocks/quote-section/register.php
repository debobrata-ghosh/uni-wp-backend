<?php
if( function_exists('acf_register_block_type') ) {
    acf_register_block_type(array(
        'name'              => 'quote-section',
        'title'             => __('Quote Section'),
        'description'       => __('Pixel-perfect quote slider matching desktop and mobile screenshots.'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/quote-section/render.php',
        'category'          => 'formatting',
        'icon'              => 'format-quote',
        'keywords'          => array('quote', 'testimonial', 'slider'),
        'mode'              => 'edit',
        'supports'          => array('align' => false, 'mode' => true),
        'enqueue_assets'  => function() {
            $block_dir = get_template_directory() . '/template-parts/blocks/quote-section/';
            $block_url = get_template_directory_uri() . '/template-parts/blocks/quote-section/';
            
            wp_enqueue_style(
                'quote-section-style',
                $block_url . 'style.css',
                array(),
                filemtime($block_dir . 'style.css')
            );
            
            wp_enqueue_script(
                'quote-section-script',
                $block_url . 'script.js',
                array(),
                filemtime($block_dir . 'script.js'),
                true
            );
        },
    ));
}
