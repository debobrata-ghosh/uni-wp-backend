<?php
// inc/blocks-loader.php

add_action('acf/init', 'mytheme_load_acf_blocks');
function mytheme_load_acf_blocks() {
    $blocks_dir = get_template_directory() . '/template-parts/blocks/';

    // Scan all subfolders inside blocks/
    foreach (glob($blocks_dir . '*', GLOB_ONLYDIR) as $block_dir) {
        $register_file = $block_dir . '/register.php';
        $fields_file   = $block_dir . '/fields.php';

        if (file_exists($register_file)) {
            include $register_file;
        }
        if (file_exists($fields_file)) {
            include $fields_file;
        }
    }
}
