<?php
/**
 * Page Title Block - ACF Fields
 * 
 * Defines the ACF field group for the page-title block.
 * 
 * @package UnitekCollege
 */

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
    return;
}

acf_add_local_field_group( array(
    'key' => 'group_page_title_block',
    'title' => 'Page Title Block Fields',
    'fields' => array(
        array(
            'key' => 'field_page_title_headline',
            'label' => 'Headline',
            'name' => 'page-title_headline',
            'type' => 'text',
            'instructions' => 'Enter the main headline text (Optional). If left empty, the page title will be used. This will be displayed in uppercase.',
            'required' => 0,
            'placeholder' => 'Enter your headline here...',
            'prepend' => '',
            'append' => '',
            'maxlength' => 100,
            'conditional_logic' => 0,
        ),
        array(
            'key' => 'field_page_title_subheadline',
            'label' => 'Subheadline',
            'name' => 'page-title_subheadline',
            'type' => 'text',
            'instructions' => 'Enter the subheadline or lead-in copy (Optional)',
            'required' => 0,
            'placeholder' => 'Enter your subheadline here...',
            'prepend' => '',
            'append' => '',
            'maxlength' => 200,
            'conditional_logic' => 0,
        ),
        array(
            'key' => 'field_page_title_image',
            'label' => 'Page Title Image',
            'name' => 'page-title_image',
            'type' => 'image',
            'instructions' => 'Upload the image for the right column (Optional). Recommended size: 988x408px or larger.',
            'required' => 0,
            'return_format' => 'array',
            'preview_size' => 'medium',
            'library' => 'all',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => 'jpg,jpeg,png,webp',
        ),
        array(
            'key' => 'field_page_title_get_started_title',
            'label' => 'Get Started Button Title',
            'name' => 'page-title_get_started_title',
            'type' => 'text',
            'instructions' => 'Enter the text for the "Get Started" button (Optional). Default: "Get Started"',
            'required' => 0,
            'default_value' => 'Get Started',
            'placeholder' => 'Get Started',
            'maxlength' => 50,
        ),
        array(
            'key' => 'field_page_title_get_started_url',
            'label' => 'Get Started Button URL',
            'name' => 'page-title_get_started_url',
            'type' => 'url',
            'instructions' => 'Enter the URL for the "Get Started" button (Optional). Defaults to home page if empty.',
            'required' => 0,
            'placeholder' => 'Leave empty to use home page URL',
        ),
        array(
            'key' => 'field_page_title_apply_now_title',
            'label' => 'Apply Now Button Title',
            'name' => 'page-title_apply_now_title',
            'type' => 'text',
            'instructions' => 'Enter the text for the "Apply Now" button (Optional). Default: "Apply Now"',
            'required' => 0,
            'default_value' => 'Apply Now',
            'placeholder' => 'Apply Now',
            'maxlength' => 50,
        ),
        array(
            'key' => 'field_page_title_apply_now_url',
            'label' => 'Apply Now Button URL',
            'name' => 'page-title_apply_now_url',
            'type' => 'url',
            'instructions' => 'Enter the URL for the "Apply Now" button (Optional). Defaults to home page if empty.',
            'required' => 0,
            'placeholder' => 'Leave empty to use home page URL',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/page-title',
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
    'description' => 'Fields for the Page Title block with headline, subheadline, and optional image.',
) );

