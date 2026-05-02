<?php
if (function_exists('acf_register_block_type')) {
    acf_register_block_type([
        'name'            => 'program-overview',
        'title'           => __('Program Overview Block'),
        'description'     => __('Block displaying program overview and location details.'),
        'render_template' => get_template_directory() . '/template-parts/blocks/program-overview/render.php',
        'category'        => 'formatting',
        'icon'            => 'location-alt',
        'keywords'        => array('program', 'overview', 'location'),
        'supports'        => array(
            'align' => array('wide', 'full'),
            'anchor' => true,
            'customClassName' => true,
        ),
        'enqueue_assets'  => function() {
            // Optional: Add CSS
        },
    ]);
}