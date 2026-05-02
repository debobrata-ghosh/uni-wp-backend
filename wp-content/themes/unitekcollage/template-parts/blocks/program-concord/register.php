<?php
if (function_exists('acf_register_block_type')) {
    acf_register_block_type([
        'name'            => 'program-concord',
        'title'           => __('Program Concord Block'),
        'description'     => __('Tabbed list of programs for Concord.'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/program-concord/render.php',
        'category'        => 'formatting',
        'icon'            => 'screenoptions',
        'keywords'        => array('program', 'concord', 'tabs'),
        'supports'        => array(
            'align' => array('wide', 'full'),
            'anchor' => true,
            'customClassName' => true,
        ),
        'enqueue_assets'  => function() {
            // Inline CSS or enqueue as needed
        },
    ]);
}