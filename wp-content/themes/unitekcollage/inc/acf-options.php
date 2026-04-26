<?php
/**
 * ACF Options Pages
 *
 * @package UnitekCollege
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Register Theme Settings Options Page
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title'  => 'Theme Settings',
        'menu_title'  => 'Theme Settings',
        'menu_slug'   => 'theme-settings',
        'capability'  => 'edit_posts',
        'redirect'    => false,
        'icon_url'    => 'dashicons-admin-customizer',
        'position'    => 30
    ));
    
    // Header & Footer Sub Page
    acf_add_options_sub_page(array(
        'page_title'  => 'Header & Footer Settings',
        'menu_title'  => 'Header & Footer',
        'menu_slug'   => 'theme-settings-header-footer',
        'parent_slug' => 'theme-settings',
        'capability'  => 'edit_posts'
    ));
    
    // Social Media Sub Page
    acf_add_options_sub_page(array(
        'page_title'  => 'Social Media Settings',
        'menu_title'  => 'Social Media',
        'menu_slug'   => 'theme-settings-social',
        'parent_slug' => 'theme-settings',
        'capability'  => 'edit_posts'
    ));
    
    // Mega Menu Sub Page
    acf_add_options_sub_page(array(
        'page_title'  => 'Mega Menu Settings',
        'menu_title'  => 'Mega Menu',
        'menu_slug'   => 'theme-settings-mega-menu',
        'parent_slug' => 'theme-settings',
        'capability'  => 'edit_posts'
    ));
}
