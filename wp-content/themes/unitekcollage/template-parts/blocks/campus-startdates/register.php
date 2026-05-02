<?php
/**
* ACF Block Registration for Campus Start Dates Block.
*
* Block Slug: campus-startdates
* File Path: /template-parts/blocks/campus-startdates/register.php
*/

if( function_exists('acf_register_block_type') ) {
    acf_register_block_type(array(
        'name'              => 'campus-startdates', // The unique block slug
        'title'             => __('Campus Start Dates'),
        'description'       => __('A two-column section for campus details and start date information.'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/campus-startdates/render.php',
        'category'          => 'design',
        'icon'              => 'calendar-alt', 
        'keywords'          => array( 'start date', 'campus', 'enrollment', 'location' ),
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
                    'left_column_title' => 'New York Campus Location',
                    'start_date_section_title' => 'Upcoming Start Dates',
                )
            )
        ),
        'enqueue_assets'  => function() {
            $block_dir = get_template_directory() . '/template-parts/blocks/campus-startdates/';
            $block_url = get_template_directory_uri() . '/template-parts/blocks/campus-startdates/';
            
            wp_enqueue_style(
                'campus-startdates-style',
                $block_url . 'style.css',
                array(),
                filemtime($block_dir . 'style.css')
            );
        },
    ));
}
