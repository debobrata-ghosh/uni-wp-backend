<?php
if( function_exists('acf_register_block_type') ) {
    acf_register_block_type(array(
        'name'              => 'healthcare-programs',
        'title'             => __('Healthcare Programs Block'),
        'description'       => __('A comprehensive healthcare programs block with hero section, program tabs, statistics, and testimonial.'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/healthcare-programs/render.php',
        'category'          => 'design',
        'icon'              => 'admin-users',
        'keywords'          => array( 'healthcare', 'programs', 'nursing', 'education' ),
        'supports'          => array(
            'align' => array('wide', 'full'),
            'anchor' => true,
            'customClassName' => true,
            'jsx' => false,
        ),
        'mode'              => 'edit',
        'example'           => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'healthcare_headline' => 'Healthcare programs focused on your future.',
                    'program_headline' => 'EARN YOUR BSN DEGREE IN AS FEW AS 3 YEARS.',
                )
            )
        ),
        'enqueue_assets'    => function() {
            $block_path = get_template_directory() . '/template-parts/blocks/healthcare-programs';
            
            // Enqueue main styles (frontend & editor)
            wp_enqueue_style(
                'healthcare-programs-style',
                get_template_directory_uri() . '/template-parts/blocks/healthcare-programs/style.css',
                array(),
                filemtime($block_path . '/style.css')
            );
            
            // Enqueue main script
            wp_enqueue_script(
                'healthcare-programs-script',
                get_template_directory_uri() . '/template-parts/blocks/healthcare-programs/index.js',
                array(),
                filemtime($block_path . '/index.js'),
                true
            );
            
            // Enqueue editor-specific styles
            if ( is_admin() ) {
                wp_enqueue_style(
                    'healthcare-programs-editor',
                    get_template_directory_uri() . '/template-parts/blocks/healthcare-programs/editor.css',
                    array(),
                    filemtime($block_path . '/editor.css')
                );
            }
        },
    ));
}
