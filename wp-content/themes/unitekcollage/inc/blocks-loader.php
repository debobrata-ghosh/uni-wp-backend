<?php
// inc/blocks-loader.php

add_action('acf/init', 'mytheme_load_acf_blocks');
function mytheme_load_acf_blocks() {
    $blocks_dir = get_template_directory() . '/template-parts/blocks/';

    if ( ! is_dir( $blocks_dir ) ) {
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

        if ( file_exists( $register_file ) ) {
            include $register_file;
        }
        if ( file_exists( $fields_file ) ) {
            include $fields_file;
        }
    }
}
