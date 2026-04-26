<?php
if( function_exists('acf_register_block_type') ) {
    acf_register_block_type(array(
        'name'              => 'faq',
        'title'             => __('FAQ Section Block'),
        'description'       => __('A two-column FAQ section with blue sidebar navigation and accordion functionality.'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/faq/render.php',
        'category'          => 'design',
        'icon'              => 'editor-help',
        'keywords'          => array( 'faq', 'questions', 'accordion', 'help', 'support' ),
        'supports'          => array(
            'align' => array('wide', 'full'),
            'anchor' => true,
            'customClassName' => true,
            'jsx' => false,
        ),
        'enqueue_assets'    => function() {
            wp_enqueue_style(
                'faq-block',
                get_template_directory_uri() . '/template-parts/blocks/faq/style.css',
                array(),
                filemtime(get_template_directory() . '/template-parts/blocks/faq/style.css')
            );
            wp_enqueue_script(
                'faq-block',
                get_template_directory_uri() . '/template-parts/blocks/faq/index.js',
                array(),
                filemtime(get_template_directory() . '/template-parts/blocks/faq/index.js'),
                true
            );
        },
        'mode'              => 'edit',
        'example'           => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'faq_section_title' => 'frequently asked questions at Unitek.',
                    'faq_categories' => array(
                        array(
                            'category_title' => 'Tuition and Financial Aid',
                            'category_items' => array(
                                array(
                                    'question' => 'Does Unitek lorem ipsum dolor sit amet?',
                                    'answer' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
                                ),
                                array(
                                    'question' => 'Are there lorem ipsum dolor sit amet?',
                                    'answer' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'
                                )
                            )
                        ),
                        array(
                            'category_title' => 'Transfer Credits',
                            'category_items' => array(
                                array(
                                    'question' => 'Can I transfer credits to Unitek?',
                                    'answer' => 'Yes, Unitek accepts transfer credits from accredited institutions.'
                                )
                            )
                        )
                    )
                )
            )
        ),
    ));
}
