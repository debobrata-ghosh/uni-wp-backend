<?php
if( function_exists('acf_register_block_type') ) {
    acf_register_block_type(array(
        'name'              => 'admissions',
        'title'             => __('Admissions Section Block'),
        'description'       => __('A two-column block with left title and right repeater points.'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/admissions/render.php',
        'category'          => 'design',
        'icon'              => 'welcome-learn-more',
        'keywords'          => array( 'admissions', 'requirements', 'list', 'points' ),
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
                    'admissions_title' => 'BSN admissions requirements.',
                    'admissions_points' => array(
                        array('point_text' => 'Submit proof of high school education or equivalent'),
                        array('point_text' => 'Submit a copy of a government-issued photo ID'),
                        array('point_text' => 'Complete all financing arrangements'),
                    )
                )
            )
        ),
        'enqueue_assets'  => function() {
            $block_dir = get_template_directory() . '/template-parts/blocks/admissions/';
            $block_url = get_template_directory_uri() . '/template-parts/blocks/admissions/';
            
            wp_enqueue_style(
                'admissions-style',
                $block_url . 'style.css',
                array(),
                filemtime($block_dir . 'style.css')
            );
        },
    ));
}
