<?php
/**
 * Theme Settings ACF Fields
 *
 * @package UnitekCollege
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

if (function_exists('acf_add_local_field_group')) :

// Header & Footer Settings
acf_add_local_field_group(array(
    'key' => 'group_theme_settings_header_footer',
    'title' => 'Header & Footer Settings',
    'fields' => array(
        // Header Logo Section
        array(
            'key' => 'field_header_logo',
            'label' => 'Header Logo',
            'name' => 'header_logo',
            'type' => 'image',
            'instructions' => 'Upload your main site logo for the header',
            'return_format' => 'array',
            'preview_size' => 'medium',
            'library' => 'all',
        ),
        
        array(
            'key' => 'field_mobile_logo',
            'label' => 'Mobile Logo',
            'name' => 'mobile_logo',
            'type' => 'image',
            'instructions' => 'Upload your mobile logo (displays when hamburger menu is open). If empty, will use the main header logo.',
            'return_format' => 'array',
            'preview_size' => 'medium',
            'library' => 'all',
        ),
        
        // Header Contact Info
        array(
            'key' => 'field_header_phone',
            'label' => 'Phone Number',
            'name' => 'header_phone',
            'type' => 'text',
            'instructions' => 'Main contact phone number',
            'placeholder' => '+1 (555) 123-4567',
        ),
        
        array(
            'key' => 'field_header_email',
            'label' => 'Email Address',
            'name' => 'header_email',
            'type' => 'email',
            'instructions' => 'Main contact email address',
            'placeholder' => 'info@unitekcollage.edu',
        ),
        
        // Top Bar Settings
        array(
            'key' => 'field_top_bar_enabled',
            'label' => 'Enable Top Bar',
            'name' => 'top_bar_enabled',
            'type' => 'true_false',
            'instructions' => 'Show/hide the top bar above header',
            'default_value' => 1,
        ),
        
        array(
            'key' => 'field_top_bar_text',
            'label' => 'Top Bar Text',
            'name' => 'top_bar_text',
            'type' => 'text',
            'instructions' => 'Text to display in top bar (if enabled)',
            'placeholder' => 'Get info',
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_top_bar_enabled',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
        ),
        
        // Get Started Button Settings
        array(
            'key' => 'field_apply_button_text',
            'label' => 'Get Started Button Text',
            'name' => 'apply_button_text',
            'type' => 'text',
            'instructions' => 'Text for the main get started button in header',
        ),
        
        array(
            'key' => 'field_apply_button_url',
            'label' => 'Get Started Button URL',
            'name' => 'apply_button_url',
            'type' => 'text',
            'instructions' => 'URL for the get started button',
            'placeholder' => '#get-started-today',
        ),
        
        // Footer Settings
        array(
            'key' => 'field_footer_logo',
            'label' => 'Footer Logo',
            'name' => 'footer_logo',
            'type' => 'image',
            'instructions' => 'Upload your footer logo (optional - will use header logo if empty)',
            'return_format' => 'array',
            'preview_size' => 'medium',
            'library' => 'all',
        ),
        
        array(
            'key' => 'field_footer_copyright',
            'label' => 'Copyright Text',
            'name' => 'footer_copyright',
            'type' => 'text',
            'instructions' => 'Copyright text for footer',
            'default_value' => '© ' . date('Y') . ' Unitek College. All rights reserved.',
        ),
        
        array(
            'key' => 'field_footer_description',
            'label' => 'Footer Description',
            'name' => 'footer_description',
            'type' => 'textarea',
            'instructions' => 'Brief description about your institution',
            'rows' => 3,
        ),

        // Footer Link Columns
        array(
            'key' => 'field_footer_columns',
            'label' => 'Footer Link Columns',
            'name' => 'footer_columns',
            'type' => 'repeater',
            'instructions' => 'Add footer link columns (title and links).',
            'min' => 0,
            'max' => 6,
            'layout' => 'block',
            'button_label' => 'Add Column',
            'sub_fields' => array(
                array(
                    'key' => 'field_footer_column_title',
                    'label' => 'Column Title',
                    'name' => 'title',
                    'type' => 'text',
                    'wrapper' => array('width' => '30'),
                ),
                array(
                    'key' => 'field_footer_column_links',
                    'label' => 'Links',
                    'name' => 'links',
                    'type' => 'repeater',
                    'button_label' => 'Add Link',
                    'layout' => 'table',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_footer_link_label',
                            'label' => 'Label',
                            'name' => 'label',
                            'type' => 'text',
                            'wrapper' => array('width' => '50'),
                        ),
                        array(
                            'key' => 'field_footer_link_url',
                            'label' => 'URL',
                            'name' => 'url',
                            'type' => 'url',
                            'wrapper' => array('width' => '50'),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'options_page',
                'operator' => '==',
                'value' => 'theme-settings-header-footer',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
));

// Social Media Settings
acf_add_local_field_group(array(
    'key' => 'group_theme_settings_social',
    'title' => 'Social Media Settings',
    'fields' => array(
        array(
            'key' => 'field_social_links',
            'label' => 'Social Media Links',
            'name' => 'social_links',
            'type' => 'repeater',
            'instructions' => 'Add your social media links',
            'min' => 0,
            'max' => 10,
            'layout' => 'table',
            'button_label' => 'Add Social Link',
            'sub_fields' => array(
                array(
                    'key' => 'field_social_icon_class',
                    'label' => 'Icon Class',
                    'name' => 'icon_class',
                    'type' => 'text',
                    'instructions' => 'FontAwesome icon class (e.g., fab fa-facebook-f)',
                    'placeholder' => 'fab fa-facebook-f',
                    'wrapper' => array(
                        'width' => '25',
                    ),
                ),
                array(
                    'key' => 'field_social_url',
                    'label' => 'URL',
                    'name' => 'url',
                    'type' => 'url',
                    'instructions' => 'Full URL to your social media profile',
                    'placeholder' => 'https://facebook.com/yourpage',
                    'wrapper' => array(
                        'width' => '50',
                    ),
                ),
                array(
                    'key' => 'field_social_label',
                    'label' => 'Label',
                    'name' => 'label',
                    'type' => 'text',
                    'instructions' => 'Accessibility label for screen readers',
                    'placeholder' => 'Follow us on Facebook',
                    'wrapper' => array(
                        'width' => '25',
                    ),
                ),
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'options_page',
                'operator' => '==',
                'value' => 'theme-settings-social',
            ),
        ),
    ),
    'menu_order' => 1,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
));

endif;
