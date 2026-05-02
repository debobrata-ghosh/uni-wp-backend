<?php
if( function_exists('acf_register_block_type') ) {
    acf_register_block_type(array(
        'name'              => 'program-accreditations',
        'title'             => __('Program Accreditations Block'),
        'description'       => __('A two-column layout with program accreditation logos, titles, and descriptions.'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/program-accreditations/render.php',
        'category'          => 'design',
        'icon'              => 'welcome-learn-more', // Changed icon for differentiation
        'keywords'          => array( 'program', 'accreditations', 'approvals', 'certifications' ),
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
                    'program_accreditations_title' => 'Program Accreditations',
                    'program_accreditations_description' => 'The program is approved and/or accredited by the following recognized boards and commissions.',
                    'program_accreditations_view_all_text' => 'View all Program Info',
                    'program_accreditations_view_all_url' => '#',
                    'program_accreditations_items' => array(
                        array(
                            'program_accreditation_logo' => array('url' => '', 'alt' => 'Accrediting Body Logo 1'),
                            'program_accreditation_title' => 'Program Accrediting Commission Title',
                            'program_accreditation_description' => '(PACCT)'
                        ),
                        array(
                            'program_accreditation_logo' => array('url' => '', 'alt' => 'Accrediting Body Logo 2'),
                            'program_accreditation_title' => 'Specialized Program Accreditation Board',
                            'program_accreditation_description' => '(SPAB)'
                        ),
                        array(
                            'program_accreditation_logo' => array('url' => '', 'alt' => 'Accrediting Body Logo 3'),
                            'program_accreditation_title' => 'State Board of Education',
                            'program_accreditation_description' => ''
                        )
                    )
                )
            )
        ),
    ));
}