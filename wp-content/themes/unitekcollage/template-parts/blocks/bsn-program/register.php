<?php
if(function_exists('acf_register_block_type')){
    acf_register_block_type([
        'name'              => 'bsn-program',
        'title'             => __('BSN Program'),
        'description'       => __('Section with BSN overview and three feature cards'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/bsn-program/render.php',
        'category'          => 'design',
        'icon'              => 'awards',
        'keywords'          => ['bsn', 'nursing', 'program', 'degree', 'NCLEX'],
        'supports'          => [
            'align'             => ['wide', 'full'],
            'anchor'            => true,
            'customClassName'   => true,
        ],
        'enqueue_assets'    => function() {
            $block_dir = get_template_directory() . '/template-parts/blocks/bsn-program/';
            $block_url = get_template_directory_uri() . '/template-parts/blocks/bsn-program/';
            
            wp_enqueue_style(
                'bsn-program-style',
                $block_url . 'style.css',
                array(),
                filemtime($block_dir . 'style.css')
            );
        },
    ]);
}
