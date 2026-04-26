<?php
/**
 * Testimonial Block Registration
 * 
 * @package UnitekCollege
 */

if ( function_exists( 'acf_register_block_type' ) ) {
    acf_register_block_type( array(
        'name'              => 'testimonial',
        'title'             => __( 'Testimonial', 'unitek-college' ),
        'description'       => __( 'A testimonial block with author image, message, and attribution.', 'unitek-college' ),
        'render_template'   => get_template_directory() . '/template-parts/blocks/testimonial/render.php',
        'category'          => 'design',
        'icon'              => 'format-quote',
        'keywords'          => array( 'testimonial', 'quote', 'review' ),
        'supports'          => array(
            'align'           => array( 'wide', 'full' ),
            'anchor'          => true,
            'customClassName' => true,
            'jsx'             => false,
        ),
        'mode'              => 'edit',
        'example'           => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'author_name'  => 'Jane Doe',
                    'author_role'  => 'Graduate, Class of 2024',
                    'message'      => 'Unitek College prepared me for my career in healthcare. The hands-on training was invaluable.',
                )
            )
        ),
        'enqueue_assets'    => function() {
            $block_path = get_template_directory() . '/template-parts/blocks/testimonial';
            $block_uri  = get_template_directory_uri() . '/template-parts/blocks/testimonial';
            
            // Frontend styles
            if ( file_exists( $block_path . '/style.css' ) ) {
                wp_enqueue_style(
                    'testimonial-block-style',
                    $block_uri . '/style.css',
                    array(),
                    filemtime( $block_path . '/style.css' )
                );
            }
            
            // Editor styles (only in admin)
            if ( is_admin() && file_exists( $block_path . '/editor.css' ) ) {
                wp_enqueue_style(
                    'testimonial-block-editor',
                    $block_uri . '/editor.css',
                    array( 'wp-edit-blocks' ),
                    filemtime( $block_path . '/editor.css' )
                );
            }
        },
    ) );
}
