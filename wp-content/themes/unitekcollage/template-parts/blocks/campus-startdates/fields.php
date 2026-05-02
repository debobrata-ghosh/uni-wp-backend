<?php
/**
 * ACF Field Group for Campus Start Dates Block.
 *
 * Block Slug: campus-startdates
 * File Path: /template-parts/blocks/campus-startdates/fields.php
 */

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
    'key' => 'group_campus_start_dates',
    'title' => 'Campus Start Dates Block Fields',
    'fields' => array(
        // NEW: Main Repeater to make the whole two-column box repeatable
        array(
            'key' => 'field_campus_items_repeater',
            'label' => 'Campus/Date Sections',
            'name' => 'campus_items',
            'type' => 'repeater',
            'instructions' => 'Add one entry for each two-column section (Campus Location + Start Dates).',
            'required' => 1,
            'min' => 1,
            'layout' => 'block',
            'button_label' => 'Add Campus Section',
            'sub_fields' => array(
                
                // --- Left Column Fields: Campus Location & CTA ---
                array(
                    'key' => 'field_campus_left_column_title',
                    'label' => 'Left Column Title (Location)',
                    'name' => 'left_column_title',
                    'type' => 'text',
                    'instructions' => 'Title for the left column (e.g., New York Campus Location).',
                    'required' => 1,
                    'default_value' => 'New York Campus Location',
                    'maxlength' => 100,
                ),
                array(
                    'key' => 'field_campus_address',
                    'label' => 'Address Text',
                    'name' => 'campus_address',
                    'type' => 'textarea',
                    'instructions' => 'The full address or description text for the campus location.',
                    'required' => 1,
                    'default_value' => '123 Main Street, Suite 400, New York, NY 10001',
                    'rows' => 3,
                    'new_lines' => 'br',
                ),
                array(
                    'key' => 'field_campus_learn_more_text',
                    'label' => 'Learn More Button Text',
                    'name' => 'learn_more_text',
                    'type' => 'text',
                    'instructions' => 'Text for the "Learn More" link/button.',
                    'required' => 1,
                    'default_value' => 'Learn More',
                    'maxlength' => 30,
                ),
                array(
                    'key' => 'field_campus_learn_more_url',
                    'label' => 'Learn More Button URL',
                    'name' => 'learn_more_url',
                    'type' => 'url',
                    'instructions' => 'The URL the "Learn More" button links to.',
                    'required' => 1,
                ),
                
                // --- Right Column Fields: Start Dates Repeater ---
                array(
                    'key' => 'field_campus_start_date_section_title',
                    'label' => 'Right Column Title (Start Dates)',
                    'name' => 'start_date_section_title',
                    'type' => 'text',
                    'instructions' => 'Title for the right column (e.g., Upcoming Start Dates).',
                    'required' => 1,
                    'default_value' => 'Upcoming Start Dates',
                    'maxlength' => 100,
                ),
                array(
                    'key' => 'field_campus_start_date_items',
                    'label' => 'Start Date Details List',
                    'name' => 'start_date_details',
                    'type' => 'repeater',
                    'instructions' => 'Add individual start date details (Date and Time).',
                    'required' => 1,
                    'min' => 1,
                    'max' => 6,
                    'layout' => 'table',
                    'button_label' => 'Add Date/Time Detail',
                    'sub_fields' => array(
                        array(
                                'key' => 'field_campus_date_label',
                                'label' => 'Date Label',
                                'name' => 'date_label',
                                'type' => 'date_picker',
                                'instructions' => 'Select the start or applicable date.',
                                'required' => 1,
                                'display_format' => 'F j, Y',  // Example: January 15, 2025
                                'return_format'  => 'F j, Y',
                                'first_day'      => 1,
                            ),
                        array(
                            'key' => 'field_campus_time_label',
                            'label' => 'Time Label',
                            'name' => 'time_label',
                            'type' => 'text',
                            'instructions' => 'e.g., "Time: M-F 8am - 5pm"',
                            'required' => 0,
                            'placeholder' => 'Enter time label (optional)',
                            'maxlength' => 100,
                        ),
                    ),
                ),
            ), // end sub_fields for campus_items
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/campus-startdates', 
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
    'description' => 'A two-column section for campus details and start date information.',
));

endif;
