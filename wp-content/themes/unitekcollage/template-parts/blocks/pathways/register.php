<?php
// template-parts/blocks/pathways/register.php

acf_register_block_type(array(
    'name'              => 'pathways',
    'title'             => __('Pathways'),
    'description'       => __('Displays pathways with accordion-style tabs'),
    'render_template'   => get_template_directory() . '/template-parts/blocks/pathways/render.php',
    'category'          => 'formatting',
    'icon'              => 'editor-ol',
    'keywords'          => array('pathways', 'accordion', 'faq'),
    'mode'              => 'edit',
    'supports'          => array(
        'align' => false,
        'jsx'   => true,
    ),
    'enqueue_assets'  => function() {
        $block_dir = get_template_directory() . '/template-parts/blocks/pathways/';
        $block_url = get_template_directory_uri() . '/template-parts/blocks/pathways/';
        
        wp_enqueue_style(
            'pathways-style',
            $block_url . 'style.css',
            array(),
            filemtime($block_dir . 'style.css')
        );
        
        wp_enqueue_script(
            'pathways-script',
            $block_url . 'script.js',
            array(),
            filemtime($block_dir . 'script.js'),
            true
        );
    },
));
