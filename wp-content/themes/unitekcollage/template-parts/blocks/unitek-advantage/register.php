<?php
if( function_exists('acf_register_block_type') ) {
    acf_register_block_type(array(
        'name'              => 'unitek-advantage',
        'title'             => __('Unitek Advantage Block'),
        'description'       => __('A two-column layout with features, CTA button, and testimonial card.'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/unitek-advantage/render.php',
        'category'          => 'design',
        'icon'              => 'admin-star-filled',
        'keywords'          => array( 'unitek', 'advantage', 'features', 'testimonial', 'cta' ),
        'supports'          => array(
            'align' => array('wide', 'full'),
            'anchor' => true,
            'customClassName' => true,
            'jsx' => false,
        ),
        'enqueue_assets'    => function() {
            wp_enqueue_style(
                'unitek-advantage-block',
                get_template_directory_uri() . '/template-parts/blocks/unitek-advantage/style.css',
                array(),
                filemtime(get_template_directory() . '/template-parts/blocks/unitek-advantage/style.css')
            );
            wp_enqueue_script(
                'unitek-advantage-block',
                get_template_directory_uri() . '/template-parts/blocks/unitek-advantage/index.js',
                array(),
                filemtime(get_template_directory() . '/template-parts/blocks/unitek-advantage/index.js'),
                true
            );
        },
        'mode'              => 'edit',
        'example'           => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'unitek_advantage_heading' => 'The Unitek advantage.',
                    'unitek_advantage_subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                    'unitek_advantage_body_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                    'unitek_advantage_features' => array(
                        array('feature_title' => 'REAL-WORLD EXPERIENCE.', 'feature_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
                        array('feature_title' => 'FLEXIBLE PROGRAMS.', 'feature_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
                        array('feature_title' => 'CAREER SUPPORT.', 'feature_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
                    ),
                    'unitek_advantage_cta_text' => 'Get started today',
                    'unitek_advantage_cta_url' => '#',
                    'unitek_advantage_testimonial_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.',
                    'unitek_advantage_testimonial_name' => 'Name A.',
                    'unitek_advantage_testimonial_title' => 'Unitek Graduate'
                )
            )
        ),
    ));
}
