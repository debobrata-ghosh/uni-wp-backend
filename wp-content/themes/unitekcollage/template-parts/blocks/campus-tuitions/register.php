<?php
if( function_exists('acf_register_block_type') ) {
    acf_register_block_type(array(
        'name'              => 'campus-tuitions',
        'title'             => __('Campus Tuitions'),
        'description'       => __('A two-column section with sidebar tabs and right-side accordion items.'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/campus-tuitions/render.php',
        'category'          => 'design',
        'icon'              => 'money-alt',
        'keywords'          => array('campus', 'tuition', 'faq', 'accordion', 'college'),
        'supports'          => array(
            'align' => array('wide', 'full'),
            'anchor' => true,
            'customClassName' => true,
        ),
        'mode'              => 'edit',
    ));
}
?>
