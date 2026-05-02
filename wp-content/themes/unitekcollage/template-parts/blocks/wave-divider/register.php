<?php
/**
 * wave-divider Block Registration
 * 
 * @package UnitekCollege
 */

if ( function_exists( 'acf_register_block_type' ) ) {
    acf_register_block_type( array(
        'name'              => 'wave-divider',
        'title'             => __( 'Wave Divider', 'unitek-college' ),
        'description'       => __( 'A responsive wave divider section with customizable colors and wave patterns for desktop, tablet, and mobile.', 'unitek-college' ),
        'render_template'   => get_template_directory() . '/template-parts/blocks/wave-divider/render.php',
        'category'          => 'design',
        'icon'              => 'cover-image',
        'keywords'          => array( 'wave', 'divider', 'separator', 'section-break', 'wave-divider' ),
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
                    'wave-divider_top_color'    => '#000000',
                    'wave-divider_bottom_color' => '#E5E5E5',
                    'wave-divider_wave_color'   => '#074975',
                )
            )
        ),
        'enqueue_assets'    => function() {
            $block_path = get_template_directory() . '/template-parts/blocks/wave-divider';
            $block_uri  = get_template_directory_uri() . '/template-parts/blocks/wave-divider';
            
            // Frontend styles
            if ( file_exists( $block_path . '/style.css' ) ) {
                wp_enqueue_style(
                    'wave-divider-block-style',
                    $block_uri . '/style.css',
                    array(),
                    filemtime( $block_path . '/style.css' )
                );
            }
            
            // Editor styles (only in admin)
            if ( is_admin() && file_exists( $block_path . '/editor.css' ) ) {
                wp_enqueue_style(
                    'wave-divider-block-editor',
                    $block_uri . '/editor.css',
                    array( 'wp-edit-blocks' ),
                    filemtime( $block_path . '/editor.css' )
                );
            }
        },
    ) );
}
