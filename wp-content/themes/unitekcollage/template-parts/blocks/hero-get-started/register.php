<?php
/**
 * Hero Get Started Block Registration
 * 
 * @package UnitekCollege
 */

if ( function_exists( 'acf_register_block_type' ) ) {
    acf_register_block_type( array(
        'name'              => 'hero-get-started',
        'title'             => __( 'Hero Get Started', 'unitek-college' ),
        'description'       => __( 'A multi-step form block with campus and program selection.', 'unitek-college' ),
        'render_template'   => get_template_directory() . '/template-parts/blocks/hero-get-started/render.php',
        'category'          => 'design',
        'icon'              => 'forms',
        'keywords'          => array( 'form', 'hero', 'get-started', 'program', 'dropdown', 'admissions' ),
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
                    'hero_get_started_heading'     => 'Get started today.',
                    'hero_get_started_placeholder' => 'What is your program of interest?',
                    'hero_get_started_button_text' => 'Next',
                )
            )
        ),
        'enqueue_assets'    => function() {
            $block_path = get_template_directory() . '/template-parts/blocks/hero-get-started';
            $block_uri  = get_template_directory_uri() . '/template-parts/blocks/hero-get-started';
            
            // Frontend styles
            if ( file_exists( $block_path . '/style.css' ) ) {
                wp_enqueue_style(
                    'hero-get-started-block-style',
                    $block_uri . '/style.css',
                    array(),
                    filemtime( $block_path . '/style.css' )
                );
            }
            
            // Editor styles (only in admin)
            if ( is_admin() && file_exists( $block_path . '/editor.css' ) ) {
                wp_enqueue_style(
                    'hero-get-started-block-editor',
                    $block_uri . '/editor.css',
                    array( 'wp-edit-blocks' ),
                    filemtime( $block_path . '/editor.css' )
                );
            }
            
            // JavaScript
            if ( file_exists( $block_path . '/index.js' ) ) {
                wp_enqueue_script(
                    'hero-get-started-block-script',
                    $block_uri . '/index.js',
                    array(),
                    filemtime( $block_path . '/index.js' ),
                    true
                );
            }
        },
    ) );
}
