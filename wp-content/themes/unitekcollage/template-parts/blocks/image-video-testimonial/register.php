<?php
if (function_exists('acf_register_block_type')) {
    acf_register_block_type(array(
        'name' => 'image-video-testimonial',
        'title' => __('Image Video Testimonial'),
        'description' => __('Testimonial card and video inline (YouTube/local)'),
        'render_template' => get_template_directory() . '/template-parts/blocks/image-video-testimonial/render.php',
        'category' => 'design',
        'icon' => 'format-quote',
        'keywords' => array('feature', 'image', 'video', 'testimonial'),
        'supports' => array(
            'align' => array('wide', 'full'),
            'anchor' => true,
            'customClassName' => true,
        ),
    ));
}
?>
