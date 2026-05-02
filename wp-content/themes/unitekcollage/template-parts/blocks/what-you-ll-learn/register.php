<?php
if( function_exists('acf_register_block_type') ) {
    acf_register_block_type(array(
        'name'              => 'what-you-ll-learn',
        'title'             => __('What you\'ll learn'),
        'description'       => __('A two-column block featuring learning points on a dark green background with an image on the right.'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/what-you-ll-learn/render.php',
        'category'          => 'design',
        'icon'              => 'list-view',
        'keywords'          => array( 'learn', 'learning', 'education', 'curriculum', 'skills' ),
        'supports'          => array(
            'align' => array('wide', 'full'),
            'anchor' => true,
            'customClassName' => true,
            'jsx' => false,
        ),
        'enqueue_assets'    => function() {
            wp_enqueue_style(
                'what-you-ll-learn-block',
                get_template_directory_uri() . '/template-parts/blocks/what-you-ll-learn/style.css',
                array(),
                filemtime(get_template_directory() . '/template-parts/blocks/what-you-ll-learn/style.css')
            );
            wp_enqueue_script(
                'what-you-ll-learn-block',
                get_template_directory_uri() . '/template-parts/blocks/what-you-ll-learn/index.js',
                array(),
                filemtime(get_template_directory() . '/template-parts/blocks/what-you-ll-learn/index.js'),
                true
            );
        },
        'mode'              => 'edit',
        'example'           => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'what_youll_learn_heading' => 'What you\'ll learn.',
                    'what_youll_learn_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                    'what_youll_learn_button_text' => 'Get started',
                )
            )
        ),
    ));
}
