<?php
/**
 * Mega Menu Settings ACF Fields
 *
 * @package UnitekCollege
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

if (function_exists('acf_add_local_field_group')) :

// Mega Menu Settings
acf_add_local_field_group(array(
    'key' => 'group_mega_menu_settings',
    'title' => 'Mega Menu Settings',
    'fields' => array(
        // Nursing Image
        array(
            'key' => 'field_nursing_image',
            'label' => 'Nursing Image',
            'name' => 'nursing_image',
            'type' => 'image',
            'instructions' => 'Upload an image for the Nursing category in the mega menu',
            'return_format' => 'array',
            'preview_size' => 'medium',
            'library' => 'all',
        ),
        
        // Healthcare Image
        array(
            'key' => 'field_healthcare_image',
            'label' => 'Healthcare Image',
            'name' => 'healthcare_image',
            'type' => 'image',
            'instructions' => 'Upload an image for the Healthcare category in the mega menu',
            'return_format' => 'array',
            'preview_size' => 'medium',
            'library' => 'all',
        ),
        
        // Mega Menu Footer
        array(
            'key' => 'field_mega_menu_footer_text',
            'label' => 'Footer Text',
            'name' => 'mega_menu_footer_text',
            'type' => 'text',
            'instructions' => 'Text displayed in the mega menu footer',
            'default_value' => 'Empowering the next generation of healthcare professionals.',
            'placeholder' => 'Empowering the next generation of healthcare professionals.',
        ),
        
        // Footer CTA Button
        array(
            'key' => 'field_mega_menu_cta_text',
            'label' => 'CTA Button Text',
            'name' => 'mega_menu_cta_text',
            'type' => 'text',
            'instructions' => 'Text for the call-to-action button',
            'default_value' => 'Find my path',
            'placeholder' => 'Find my path',
        ),
        
        array(
            'key' => 'field_mega_menu_cta_url',
            'label' => 'CTA Button URL',
            'name' => 'mega_menu_cta_url',
            'type' => 'url',
            'instructions' => 'URL for the call-to-action button',
            'placeholder' => 'https://example.com/find-my-path',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'options_page',
                'operator' => '==',
                'value' => 'theme-settings-mega-menu',
            ),
        ),
    ),
    'menu_order' => 2,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
));

endif;

