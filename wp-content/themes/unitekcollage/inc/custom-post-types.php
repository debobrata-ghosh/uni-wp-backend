<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register custom post types for the theme.
 *
 * Currently:
 * - testimonials
 */
function unitek_register_testimonials_cpt() {
    $labels = array(
        'name'                  => __('Testimonials', 'unitek-college'),
        'singular_name'         => __('Testimonial', 'unitek-college'),
        'menu_name'             => __('Testimonials', 'unitek-college'),
        'name_admin_bar'        => __('Testimonial', 'unitek-college'),
        'add_new'               => __('Add New', 'unitek-college'),
        'add_new_item'          => __('Add New Testimonial', 'unitek-college'),
        'edit_item'             => __('Edit Testimonial', 'unitek-college'),
        'new_item'              => __('New Testimonial', 'unitek-college'),
        'view_item'             => __('View Testimonial', 'unitek-college'),
        'search_items'          => __('Search Testimonials', 'unitek-college'),
        'not_found'             => __('No testimonials found', 'unitek-college'),
        'not_found_in_trash'    => __('No testimonials found in Trash', 'unitek-college'),
        'all_items'             => __('All Testimonials', 'unitek-college'),
        'archives'              => __('Testimonial Archives', 'unitek-college'),
        'insert_into_item'      => __('Insert into testimonial', 'unitek-college'),
        'uploaded_to_this_item' => __('Uploaded to this testimonial', 'unitek-college'),
        'featured_image'        => __('Featured Image', 'unitek-college'),
        'set_featured_image'    => __('Set featured image', 'unitek-college'),
        'remove_featured_image' => __('Remove featured image', 'unitek-college'),
        'use_featured_image'    => __('Use as featured image', 'unitek-college'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-format-quote',
        'supports'           => array('title', 'thumbnail'),
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'testimonials'),
        'publicly_queryable' => true,
        'exclude_from_search'=> false,
        'hierarchical'       => false,
        'show_in_nav_menus'  => true,
    );

    register_post_type('testimonials', $args);
}

// Register on init so WordPress knows about the CPT on every request.
add_action('init', 'unitek_register_testimonials_cpt');

/**
 * Register taxonomy for testimonials
 */
function unitek_register_testimonials_taxonomy() {
    $labels = array(
        'name'                       => __('Testimonial Categories', 'unitek-college'),
        'singular_name'              => __('Testimonial Category', 'unitek-college'),
        'menu_name'                  => __('Categories', 'unitek-college'),
        'all_items'                  => __('All Categories', 'unitek-college'),
        'parent_item'                => __('Parent Category', 'unitek-college'),
        'parent_item_colon'          => __('Parent Category:', 'unitek-college'),
        'new_item_name'              => __('New Category Name', 'unitek-college'),
        'add_new_item'               => __('Add New Category', 'unitek-college'),
        'edit_item'                  => __('Edit Category', 'unitek-college'),
        'update_item'                => __('Update Category', 'unitek-college'),
        'view_item'                  => __('View Category', 'unitek-college'),
        'separate_items_with_commas' => __('Separate categories with commas', 'unitek-college'),
        'add_or_remove_items'        => __('Add or remove categories', 'unitek-college'),
        'choose_from_most_used'      => __('Choose from the most used', 'unitek-college'),
        'popular_items'              => __('Popular Categories', 'unitek-college'),
        'search_items'               => __('Search Categories', 'unitek-college'),
        'not_found'                  => __('Not Found', 'unitek-college'),
        'no_terms'                   => __('No categories', 'unitek-college'),
        'items_list'                 => __('Categories list', 'unitek-college'),
        'items_list_navigation'      => __('Categories list navigation', 'unitek-college'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
        'rewrite'                    => array('slug' => 'testimonial-category'),
    );

    register_taxonomy('testimonial_category', array('testimonials'), $args);
}

// Register taxonomy on init
add_action('init', 'unitek_register_testimonials_taxonomy', 0);
