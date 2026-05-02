<?php
if( function_exists('acf_register_block_type') ) {
    acf_register_block_type(array(
        'name'              => 'curriculum',
        'title'             => __('Curriculum Block'),
        'description'       => __('A two-column block featuring curriculum content with course topics and an image.'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/curriculum/render.php',
        'category'          => 'design',
        'icon'              => 'book-alt',
        'keywords'          => array( 'curriculum', 'courses', 'education', 'training', 'bsn' ),
        'supports'          => array(
            'align' => array('wide', 'full'),
            'anchor' => true,
            'customClassName' => true,
            'jsx' => false,
        ),
        'enqueue_assets'    => function() {
            wp_enqueue_style(
                'curriculum-block',
                get_template_directory_uri() . '/template-parts/blocks/curriculum/style.css',
                array(),
                filemtime(get_template_directory() . '/template-parts/blocks/curriculum/style.css')
            );
        },
        'mode'              => 'edit',
        'example'           => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'curriculum_heading' => 'BSN training with a career-driven curriculum.',
                    'curriculum_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                    'curriculum_highlighted_sentence' => 'Many of our BSN course topics are designed for aspiring students who plan to specialize later in their nursing careers.',
                )
            )
        ),
    ));
}
