<?php
if( function_exists('acf_register_block_type') ) {
    acf_register_block_type(array(
        'name'              => 'get-started-today',
        'title'             => __('Get Started Today'),
        'description'       => __('A custom form block with two-column layout featuring a contact form and image placeholder.'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/get-started-today/render.php',
        'category'          => 'design',
        'icon'              => 'forms',
        'keywords'          => array( 'form', 'contact', 'get-started', 'admissions', 'enrollment' ),
        'supports'          => array(
            'align' => array('wide', 'full'),
            'anchor' => true,
            'customClassName' => true,
            'jsx' => false,
        ),
        'enqueue_assets'    => function() {
            wp_enqueue_style(
                'get-started-today-block',
                get_template_directory_uri() . '/template-parts/blocks/get-started-today/style.css',
                array(),
                filemtime(get_template_directory() . '/template-parts/blocks/get-started-today/style.css')
            );
            wp_enqueue_script(
                'get-started-today-block',
                get_template_directory_uri() . '/template-parts/blocks/get-started-today/index.js',
                array(),
                filemtime(get_template_directory() . '/template-parts/blocks/get-started-today/index.js'),
                true
            );
        },
        'mode'              => 'edit',
        'example'           => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'get_started_heading' => 'Get started today!',
                    'get_started_description' => 'Complete this form and our Admissions department will contact you shortly with more information.',
                    'get_started_button_text' => 'Get started today →',
                )
            )
        ),
    ));
}
