<?php
/**
 * Page Sub Navigation Bar Block Registration
 * 
 * @package UnitekCollege
 */

if ( function_exists( 'acf_register_block_type' ) ) {
    acf_register_block_type( array(
        'name'              => 'page-sub-navigation-bar',
        'title'             => __( 'Page Sub Navigation Bar', 'unitek-college' ),
        'description'       => __( 'A horizontal sub navigation bar with centered navigation items, hover states, and bottom border. Based on Figma design.', 'unitek-college' ),
        'render_template'   => get_template_directory() . '/template-parts/blocks/Page Sub Navigation Bar/render.php',
        'category'          => 'design',
        'icon'              => 'cover-image',
        'keywords'          => array( 'sub navigation', 'nav bar', 'navigation', 'menu', 'sub menu' ),
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
                    'page-sub-nav-items' => array(
                        array( 'label' => 'Overview', 'url' => '#overview' ),
                        array( 'label' => 'Start Dates', 'url' => '#start-dates' ),
                        array( 'label' => 'Admissions', 'url' => '#admissions' ),
                    )
                )
            )
        ),
        'enqueue_assets'    => function() {
            $block_path = get_template_directory() . '/template-parts/blocks/Page Sub Navigation Bar';
            $block_uri  = get_template_directory_uri() . '/template-parts/blocks/Page Sub Navigation Bar';
            
            // Frontend styles - with timestamp for cache-busting
            if ( file_exists( $block_path . '/style.css' ) ) {
                wp_enqueue_style(
                    'page-sub-nav-bar-block-style',
                    $block_uri . '/style.css',
                    array(),
                    filemtime( $block_path . '/style.css' ) // Timestamp for cache-busting
                );
            }
            
            // Editor styles (only in admin) - with timestamp for cache-busting
            if ( is_admin() && file_exists( $block_path . '/editor.css' ) ) {
                wp_enqueue_style(
                    'page-sub-nav-bar-block-editor',
                    $block_uri . '/editor.css',
                    array( 'wp-edit-blocks' ),
                    filemtime( $block_path . '/editor.css' ) // Timestamp for cache-busting
                );
            }
            
            // Frontend JavaScript - with timestamp for cache-busting
            if ( ! is_admin() && file_exists( $block_path . '/index.js' ) ) {
                wp_enqueue_script(
                    'page-sub-nav-bar-block-script',
                    $block_uri . '/index.js',
                    array(),
                    filemtime( $block_path . '/index.js' ), // Timestamp for cache-busting
                    true
                );
            }
        },
    ) );
}
