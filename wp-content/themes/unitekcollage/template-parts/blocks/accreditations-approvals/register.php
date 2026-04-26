<?php
if( function_exists('acf_register_block_type') ) {
    acf_register_block_type(array(
        'name'              => 'accreditations-approvals',
        'title'             => __('Accreditations & Approvals Block'),
        'description'       => __('A two-column layout with accreditation logos, titles, and descriptions.'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/accreditations-approvals/render.php',
        'category'          => 'design',
        'icon'              => 'admin-awards',
        'keywords'          => array( 'accreditations', 'approvals', 'logos', 'certifications' ),
        'supports'          => array(
            'align' => array('wide', 'full'),
            'anchor' => true,
            'customClassName' => true,
            'jsx' => false,
        ),
        'enqueue_assets'    => function() {
            wp_enqueue_style(
                'accreditations-approvals-block',
                get_template_directory_uri() . '/template-parts/blocks/accreditations-approvals/style.css',
                array(),
                filemtime(get_template_directory() . '/template-parts/blocks/accreditations-approvals/style.css')
            );
        },
        'mode'              => 'edit',
        'example'           => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'accreditations_title' => 'Accreditations & Approvals',
                    'accreditations_description' => 'Unitek College is an accredited private institution that combines unique academic and technical specialties to provide educational programs in healthcare and nursing.',
                    'accreditations_view_all_text' => 'View all',
                    'accreditations_view_all_url' => '#',
                    'accreditations_items' => array(
                        array(
                            'accreditation_logo' => array('url' => '', 'alt' => 'ACCSC Logo'),
                            'accreditation_title' => 'Accredited by Accrediting Commission of Career Schools and Colleges',
                            'accreditation_description' => '(ACCSC)'
                        ),
                        array(
                            'accreditation_logo' => array('url' => '', 'alt' => 'CCNE Logo'),
                            'accreditation_title' => 'Commission on Collegiate Nursing Education',
                            'accreditation_description' => '(CCNE)'
                        ),
                        array(
                            'accreditation_logo' => array('url' => '', 'alt' => 'BPPE Logo'),
                            'accreditation_title' => 'Bureau for Private Postsecondary Education (BPPE) - Department of Consumer Affairs',
                            'accreditation_description' => ''
                        )
                    )
                )
            )
        ),
    ));
}
