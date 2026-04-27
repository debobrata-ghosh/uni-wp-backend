<?php
// inc/blocks-loader.php

// Register on both hooks so blocks load reliably in wp-admin/editor.
// (If ACF is inactive, the function guards below will prevent fatal errors.)
add_action( 'acf/init', 'mytheme_load_acf_blocks' );
add_action( 'init', 'mytheme_load_acf_blocks', 20 );
function mytheme_load_acf_blocks() {
    $blocks_dir = get_template_directory() . '/template-parts/blocks/';

    if ( ! is_dir( $blocks_dir ) ) {
        return;
    }

    // If ACF isn't active, none of the block or field registration functions exist.
    if ( ! function_exists( 'acf_register_block_type' ) && ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    /**
     * Avoid relying on glob(), which can be disabled on some hosts.
     * Use DirectoryIterator to discover block folders.
     */
    foreach ( new DirectoryIterator( $blocks_dir ) as $entry ) {
        if ( $entry->isDot() || ! $entry->isDir() ) {
            continue;
        }

        $block_dir     = $entry->getPathname();
        $register_file = $block_dir . '/register.php';
        $fields_file   = $block_dir . '/fields.php';

        if ( function_exists( 'acf_register_block_type' ) && file_exists( $register_file ) ) {
            include $register_file;
        }
        if ( function_exists( 'acf_add_local_field_group' ) && file_exists( $fields_file ) ) {
            include $fields_file;
        }
    }
}
