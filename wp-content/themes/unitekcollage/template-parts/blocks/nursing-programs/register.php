<?php
if( function_exists('acf_register_block_type') ) {
    acf_register_block_type(array(
        'name'              => 'nursing-programs',
        'title'             => __('Nursing Programs Block'),
        'description'       => __('A tabbed nursing programs block with program details, locations, and content.'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/nursing-programs/render.php',
        'category'          => 'custom-blocks',
        'icon'              => 'book',
        'keywords'          => array( 'nursing', 'programs', 'education', 'tabs', 'BSN' ),
        'supports'          => array(
            'align' => array('wide', 'full'),
            'anchor' => true,
            'customClassName' => true,
            'jsx' => false,
        ),
        'enqueue_assets'    => function() {
            wp_enqueue_style(
                'nursing-programs-block',
                get_template_directory_uri() . '/template-parts/blocks/nursing-programs/style.css',
                array(),
                filemtime(get_template_directory() . '/template-parts/blocks/nursing-programs/style.css')
            );
            wp_enqueue_script(
                'nursing-programs-block',
                get_template_directory_uri() . '/template-parts/blocks/nursing-programs/index.js',
                array(),
                filemtime(get_template_directory() . '/template-parts/blocks/nursing-programs/index.js'),
                true
            );
        },
        'mode'              => 'edit',
        'example'           => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'nursing_tabs' => array(
                        array(
                            'tab_title' => 'BSN Nursing Programs',
                            'tab_headline' => 'Earn your Bachelor of Science in Nursing (BSN) degree in as few as 10 to three years.',
                        )
                    )
                )
            )
        ),
    ));
}
