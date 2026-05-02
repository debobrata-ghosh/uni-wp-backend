<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Register ACF field group for testimonials post type
// Use acf/init hook to ensure ACF is loaded before registering
add_action('acf/init', 'unitek_register_testimonial_fields');
function unitek_register_testimonial_fields() {
    if( function_exists('acf_add_local_field_group') ) {
        acf_add_local_field_group(array(
            'key' => 'group_testimonials',
            'title' => 'Testimonial Fields',
            'fields' => array(
                array(
                    'key' => 'field_testimonial_text',
                    'label' => 'Testimonial Text',
                    'name' => 'testimonial_text',
                    'type' => 'textarea',
                    'instructions' => 'Enter the testimonial quote text',
                    'required' => 1,
                    'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.',
                    'rows' => 3,
                    'new_lines' => 'br',
                ),
                array(
                    'key' => 'field_testimonial_name',
                    'label' => 'Author Name',
                    'name' => 'testimonial_name',
                    'type' => 'text',
                    'instructions' => 'Enter the testimonial author name',
                    'required' => 1,
                    'default_value' => 'Name A.',
                    'placeholder' => 'Enter author name',
                    'maxlength' => 50,
                ),
                array(
                    'key' => 'field_testimonial_title',
                    'label' => 'Author Title',
                    'name' => 'testimonial_title',
                    'type' => 'text',
                    'instructions' => 'Enter the testimonial author title/designation',
                    'required' => 1,
                    'default_value' => 'Unitek Graduate',
                    'placeholder' => 'Enter author title',
                    'maxlength' => 50,
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'testimonials',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => 'Fields for testimonials custom post type',
        ));
    }
}

