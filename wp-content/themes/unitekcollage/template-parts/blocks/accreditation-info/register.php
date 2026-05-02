<?php
if( function_exists('acf_register_block_type') ) {
    acf_register_block_type(array(
        'name'              => 'accreditation',
        'title'             => __('Accreditation Block'),
        'description'       => __('Displays an accreditation with heading, description, link, and badge.'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/accreditation-info/render.php',
        'category'          => 'layout',
        'icon'              => 'id-alt',
        'keywords'          => array( 'accreditation', 'badge', 'info' ),
        'mode'              => 'preview',
        'supports'          => array(
            'align' => false,
            'anchor' => true,
        ),
    ));
}
