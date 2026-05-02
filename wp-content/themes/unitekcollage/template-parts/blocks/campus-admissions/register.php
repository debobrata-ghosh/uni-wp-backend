<?php
if( function_exists('acf_register_block_type') ) {
    acf_register_block_type(array(
        'name'              => 'campus-admissions',
        'title'             => __('Admissions Requirements'),
        'description'       => __('A block displaying admissions requirements in a card grid layout.'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/campus-admissions/render.php',
        'category'          => 'design',
        'icon'              => 'clipboard',
        'keywords'          => array( 'admissions', 'requirements', 'cards', 'bsn', 'program' ),
        'supports'          => array(
            'align' => array('wide', 'full'),
            'anchor' => true,
            'customClassName' => true,
            'jsx' => false,
        ),
        'enqueue_assets'    => function() {
            wp_enqueue_style(
                'campus-admissions-block',
                get_template_directory_uri() . '/template-parts/blocks/campus-admissions/style.css',
                array(),
                filemtime(get_template_directory() . '/template-parts/blocks/campus-admissions/style.css')
            );
        },
        'mode'              => 'edit',
        'example'           => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'admissions_heading' => 'Admissions requirements for the Concord BSN program.',
                    'admissions_description' => 'To enroll in our Bachelor of Science in Nursing program, applicants must complete all admissions requirements, which include the following:',
                    'admissions_requirements' => array(
                        array('requirement_title' => 'HIGH SCHOOL DIPLOMA', 'requirement_description' => 'Submit proof of high school education or equivalent.'),
                        array('requirement_title' => 'SCHOLASTIC LEVEL EXAM - Q', 'requirement_description' => 'Receive a score of at least 19 on the SLE-Q to begin the application and ranking selection process.'),
                    )
                )
            )
        ),
    ));
}
