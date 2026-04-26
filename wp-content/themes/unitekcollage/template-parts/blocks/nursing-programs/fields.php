<?php
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
    'key' => 'group_nursing_programs',
    'title' => 'Nursing Programs Block',
    'fields' => array(
        // Main Title
        array(
            'key' => 'field_nursing_main_title',
            'label' => 'Main Title',
            'name' => 'nursing_main_title',
            'type' => 'text',
            'instructions' => 'Main heading for the block',
            'required' => 0,
            'default_value' => 'Nursing Programs',
            'placeholder' => 'Nursing Programs',
        ),
        // Tabs Repeater
        array(
            'key' => 'field_nursing_tabs',
            'label' => 'Program Tabs',
            'name' => 'nursing_tabs',
            'type' => 'repeater',
            'instructions' => 'Add program tabs',
            'required' => 1,
            'min' => 1,
            'max' => 10,
            'layout' => 'block',
            'button_label' => 'Add Tab',
            'sub_fields' => array(
                array(
                    'key' => 'field_nursing_tab_title',
                    'label' => 'Tab Title',
                    'name' => 'tab_title',
                    'type' => 'text',
                    'required' => 1,
                    'placeholder' => 'BSN Nursing Programs',
                ),
                // Main Content Area
                array(
                    'key' => 'field_nursing_tab_image',
                    'label' => 'Image',
                    'name' => 'tab_image',
                    'type' => 'image',
                    'required' => 0,
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                ),
                array(
                    'key' => 'field_nursing_tab_headline',
                    'label' => 'Headline',
                    'name' => 'tab_headline',
                    'type' => 'text',
                    'required' => 1,
                    'placeholder' => 'Earn your Bachelor of Science in Nursing (BSN) degree in as few as 10 to three years.',
                ),
                array(
                    'key' => 'field_nursing_tab_description',
                    'label' => 'Description',
                    'name' => 'tab_description',
                    'type' => 'wysiwyg',
                    'required' => 0,
                    'tabs' => 'visual',
                    'toolbar' => 'basic',
                    'media_upload' => 0,
                ),
                // Buttons
                array(
                    'key' => 'field_nursing_tab_primary_button',
                    'label' => 'Primary Button',
                    'name' => 'tab_primary_button',
                    'type' => 'group',
                    'layout' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_nursing_primary_button_text',
                            'label' => 'Button Text',
                            'name' => 'button_text',
                            'type' => 'text',
                            'default_value' => 'Learn more',
                        ),
                        array(
                            'key' => 'field_nursing_primary_button_url',
                            'label' => 'Button URL',
                            'name' => 'button_url',
                            'type' => 'url',
                        ),
                    ),
                ),
                array(
                    'key' => 'field_nursing_tab_secondary_button',
                    'label' => 'Secondary Button',
                    'name' => 'tab_secondary_button',
                    'type' => 'group',
                    'layout' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_nursing_secondary_button_text',
                            'label' => 'Button Text',
                            'name' => 'button_text',
                            'type' => 'text',
                            'default_value' => 'Get started',
                        ),
                        array(
                            'key' => 'field_nursing_secondary_button_url',
                            'label' => 'Button URL',
                            'name' => 'button_url',
                            'type' => 'url',
                        ),
                    ),
                ),
                // Program Details Section Title
                array(
                    'key' => 'field_nursing_tab_details_title',
                    'label' => 'Program Details Title',
                    'name' => 'tab_details_title',
                    'type' => 'text',
                    'default_value' => 'BSN Program Details',
                    'placeholder' => 'BSN Program Details',
                ),
                // Program Details
                array(
                    'key' => 'field_nursing_tab_program_details',
                    'label' => 'Program Details',
                    'name' => 'tab_program_details',
                    'type' => 'repeater',
                    'layout' => 'table',
                    'button_label' => 'Add Detail',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_nursing_detail_item',
                            'label' => 'Detail Item',
                            'name' => 'detail_item',
                            'type' => 'text',
                            'placeholder' => 'Duration: as few as 3 years',
                        ),
                    ),
                ),
                // Program Locations Section Title
                array(
                    'key' => 'field_nursing_tab_locations_title',
                    'label' => 'Program Locations Title',
                    'name' => 'tab_locations_title',
                    'type' => 'text',
                    'default_value' => 'BSN Program Locations',
                    'placeholder' => 'BSN Program Locations',
                ),
                // Program Locations
                array(
                    'key' => 'field_nursing_tab_program_locations',
                    'label' => 'Program Locations',
                    'name' => 'tab_program_locations',
                    'type' => 'repeater',
                    'layout' => 'table',
                    'button_label' => 'Add Location',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_nursing_location_name',
                            'label' => 'Location Name',
                            'name' => 'location_name',
                            'type' => 'text',
                            'placeholder' => 'Fremont, CA',
                        ),
                        array(
                            'key' => 'field_nursing_location_url',
                            'label' => 'Location URL',
                            'name' => 'location_url',
                            'type' => 'url',
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
                'value' => 'acf/nursing-programs',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
));

endif;
