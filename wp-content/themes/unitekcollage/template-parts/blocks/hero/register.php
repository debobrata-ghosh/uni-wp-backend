<?php
/**
 * Hero Block Registration
 * 
 * @package UnitekCollege
 */

if ( function_exists( 'acf_register_block_type' ) ) {
    acf_register_block_type( array(
        'name'              => 'hero',
        'title'             => __( 'Hero Section', 'unitek-college' ),
        'description'       => __( 'A hero section with headline, subheadline, and image.', 'unitek-college' ),
        'render_template'   => get_template_directory() . '/template-parts/blocks/hero/render.php',
        'category'          => 'design',
        'icon'              => 'cover-image',
        'keywords'          => array( 'hero', 'banner', 'headline', 'image' ),
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
                    'hero_headline'    => 'Welcome to Unitek College',
                    'hero_subheadline' => 'Start your healthcare career journey today',
                )
            )
        ),
        'enqueue_assets'    => function() {
            $block_path = get_template_directory() . '/template-parts/blocks/hero';
            $block_uri  = get_template_directory_uri() . '/template-parts/blocks/hero';
            
            // Frontend styles
            if ( file_exists( $block_path . '/style.css' ) ) {
                wp_enqueue_style(
                    'hero-block-style',
                    $block_uri . '/style.css',
                    array(),
                    filemtime( $block_path . '/style.css' )
                );
            }
            
            // Editor styles (only in admin)
            if ( is_admin() && file_exists( $block_path . '/editor.css' ) ) {
                wp_enqueue_style(
                    'hero-block-editor',
                    $block_uri . '/editor.css',
                    array( 'wp-edit-blocks' ),
                    filemtime( $block_path . '/editor.css' )
                );
            }
        },
    ) );
}
