<?php 
if( function_exists('acf_register_block_type') ) {
    acf_register_block_type(array(
        'name'              => 'testimonial-video-section',
        'title'             => __('Testimonial Video Section'),
        'description'       => __('Section with top testimonial, right image, lower YouTube or local video, resources and description'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/testimonial-video-section/render.php',
        'category'          => 'design',
        'icon'              => 'format-image',
        'keywords'          => array( 'testimonial', 'video', 'resources', 'section' ),
        'supports'          => array(
            'align' => array( 'wide', 'full' ),
            'anchor' => true,
            'customClassName' => true,
        ),
        'enqueue_assets'    => function() {
            // No additional assets needed for local video playback
        },
    ));
}
?>
