<?php
/**
 * Page Title Block Registration
 * 
 * Registers the ACF block for page title sections with headline, subheadline, and image.
 * 
 * @package UnitekCollege
 */

if ( ! function_exists( 'acf_register_block_type' ) ) {
    return;
}

acf_register_block_type( array(
    'name'              => 'page-title',
    'title'             => __( 'Page Title Section', 'unitek-college' ),
    'description'       => __( 'A page title section with headline, subheadline, and optional background image. Perfect for page headers and banners.', 'unitek-college' ),
    'render_template'   => get_template_directory() . '/template-parts/blocks/page-title/render.php',
    'category'          => 'design',
    'icon'              => 'cover-image',
    'keywords'          => array( 'page-title', 'page title', 'banner', 'headline', 'header', 'image', 'title' ),
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
                'page-title_headline'    => '',
                'page-title_subheadline' => '',
            )
        )
    ),
    'enqueue_assets'    => function() {
        $block_path = get_template_directory() . '/template-parts/blocks/page-title';
        $block_uri  = get_template_directory_uri() . '/template-parts/blocks/page-title';
        
        // Frontend styles
        $style_file = $block_path . '/style.css';
        if ( file_exists( $style_file ) ) {
            wp_enqueue_style(
                'page-title-block-style',
                $block_uri . '/style.css',
                array(),
                filemtime( $style_file )
            );
        }
        
        // Editor styles (only in admin)
        if ( is_admin() ) {
            $editor_file = $block_path . '/editor.css';
            if ( file_exists( $editor_file ) ) {
                wp_enqueue_style(
                    'page-title-block-editor',
                    $block_uri . '/editor.css',
                    array( 'wp-edit-blocks' ),
                    filemtime( $editor_file )
                );
            }
        }
        
        // Frontend JavaScript (if needed in the future)
        $script_file = $block_path . '/index.js';
        if ( file_exists( $script_file ) ) {
            wp_enqueue_script(
                'page-title-block-script',
                $block_uri . '/index.js',
                array(),
                filemtime( $script_file ),
                true
            );
        }
    },
) );