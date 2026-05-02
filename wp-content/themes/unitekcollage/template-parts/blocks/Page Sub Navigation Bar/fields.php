<?php
/**
 * Page Sub Navigation Bar Block - ACF Fields
 * 
 * Defines the ACF field group for the Page Sub Navigation Bar block.
 * 
 * @package UnitekCollege
 */

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
    return;
}

acf_add_local_field_group( array(
    'key' => 'group_page_sub_nav_bar_block',
    'title' => 'Page Sub Navigation Bar Block Fields',
    'fields' => array(
        array(
            'key' => 'field_page_sub_nav_items',
            'label' => 'Navigation Items',
            'name' => 'page-sub-nav-items',
            'type' => 'repeater',
            'instructions' => 'Add navigation items for the sub navigation bar. Each item can have a label and optional link.',
            'required' => 0,
            'min' => 1,
            'max' => 0,
            'layout' => 'table',
            'button_label' => 'Add Navigation Item',
            'sub_fields' => array(
                array(
                    'key' => 'field_page_sub_nav_item_label',
                    'label' => 'Label',
                    'name' => 'label',
                    'type' => 'text',
                    'instructions' => 'Enter the navigation item label (e.g., Overview, Start Dates)',
                    'required' => 1,
                    'placeholder' => 'Overview',
                    'maxlength' => 50,
                ),
                array(
                    'key' => 'field_page_sub_nav_item_url',
                    'label' => 'URL',
                    'name' => 'url',
                    'type' => 'url',
                    'instructions' => 'Enter the URL for this navigation item (optional). Leave empty for anchor links.',
                    'required' => 0,
                    'placeholder' => 'https://example.com or #section-id',
                ),
                array(
                    'key' => 'field_page_sub_nav_item_anchor',
                    'label' => 'Anchor ID',
                    'name' => 'anchor',
                    'type' => 'text',
                    'instructions' => 'Enter an anchor ID to scroll to on the same page (e.g., overview-section). Used if URL is empty.',
                    'required' => 0,
                    'placeholder' => 'overview-section',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_page_sub_nav_item_url',
                                'operator' => '==empty',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/page-sub-navigation-bar',
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
    'description' => 'Fields for the Page Sub Navigation Bar block with customizable navigation items.',
) );

