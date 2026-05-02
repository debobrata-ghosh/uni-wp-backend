<?php
if (!defined('ABSPATH')) { exit; }
if(function_exists('acf_register_block_type')){
    acf_register_block_type([
        'name'              => 'bsn-curriculum',
        'title'             => __('BSN Curriculum'),
        'description'       => __('Program curriculum: intro, summary, accordion'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/bsn-curriculum/render.php',
        'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/bsn-curriculum/style.css',
        'enqueue_script'    => get_template_directory_uri() . '/template-parts/blocks/bsn-curriculum/script.js',
        'category'          => 'design',
        'icon'              => 'schedule',
        'keywords'          => ['curriculum', 'accordion', 'courses', 'bsn'],
        'supports'          => [
            'anchor' => true,
            'customClassName' => true
        ],
    ]);
}
