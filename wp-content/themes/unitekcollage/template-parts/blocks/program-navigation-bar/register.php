<?php
if (!defined('ABSPATH')) {
  exit;
}
acf_register_block_type([
    'name' => 'program-navigation-bar',
    'title' => 'Program Navigation Bar',
    'description' => 'Horizontal navigation for program sections',
    'render_template' => get_template_directory() . '/template-parts/blocks/program-navigation-bar/render.php',
    'category' => 'design',
    'icon' => 'menu',
    'keywords' => ['navigation', 'tabs', 'anchor', 'program'],
    'supports' => [
        'align' => ['wide', 'full'],
        'anchor' => true,
        'customClassName' => true,
    ],
    'enqueue_script' => get_template_directory_uri() . '/template-parts/blocks/program-navigation-bar/javascript.js',
    'enqueue_style' => get_template_directory_uri() . '/template-parts/blocks/program-navigation-bar/style.css',
]);
