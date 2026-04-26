<?php
if( function_exists('acf_register_block_type') ) {
    acf_register_block_type(array(
        'name'              => 'get-started-today-dark',
        'title'             => __('Get Started Today (Dark Background)'),
        'description'       => __('A contact form block with dark background and two-column field layout.'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/get-started-today-with-dark-background/render.php',
        'category'          => 'design',
        'icon'              => 'forms',
        'keywords'          => array( 'form', 'contact', 'dark', 'get-started', 'admissions', 'enrollment' ),
        'supports'          => array(
            'align' => array('wide', 'full'),
            'anchor' => true,
            'customClassName' => true,
            'jsx' => false,
        ),
        'enqueue_assets'    => function() {
            wp_enqueue_style(
                'get-started-today-dark-block',
                get_template_directory_uri() . '/template-parts/blocks/get-started-today-with-dark-background/style.css',
                array(),
                filemtime(get_template_directory() . '/template-parts/blocks/get-started-today-with-dark-background/style.css')
            );
            wp_enqueue_script(
                'get-started-today-dark-block',
                get_template_directory_uri() . '/template-parts/blocks/get-started-today-with-dark-background/index.js',
                array(),
                filemtime(get_template_directory() . '/template-parts/blocks/get-started-today-with-dark-background/index.js'),
                true
            );
        },
        'mode'              => 'edit',
        'example'           => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'get_started_dark_heading' => 'Get started today!',
                    'get_started_dark_description' => 'Complete this form and our Admissions department will contact you shortly with more information.',
                    'get_started_dark_button_text' => 'Get started today',
                )
            )
        ),
    ));
}
