<?php
if( function_exists('acf_register_block_type') ) {
    acf_register_block_type(array(
        'name'              => 'career',
        'title'             => __('Career Block'),
        'description'       => __('A custom career block with two-column layout featuring headline, subheadline, and interactive service cards.'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/career/render.php',
        'category'          => 'design',
        'icon'              => 'businessman',
        'keywords'          => array( 'career', 'services', 'cards', 'support' ),
        'supports'          => array(
            'align' => array('wide', 'full'),
            'anchor' => true,
            'customClassName' => true,
            'jsx' => false,
        ),
        'enqueue_assets'    => function() {
            wp_enqueue_style(
                'career-block',
                get_template_directory_uri() . '/template-parts/blocks/career/style.css',
                array(),
                filemtime(get_template_directory() . '/template-parts/blocks/career/style.css')
            );
        },
        'mode'              => 'edit',
        'example'           => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'career_headline' => 'The support you need to navigate the costs of your education and launch your career.',
                    'career_subheadline' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                )
            )
        ),
    ));
}
