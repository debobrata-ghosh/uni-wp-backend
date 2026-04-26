<?php
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
    'key' => 'group_home_overview',
    'title' => 'Home Overview Block',
    'fields' => array(
        array(
            'key' => 'field_home_overview_headline',
            'label' => 'Headline',
            'name' => 'home_overview_headline',
            'type' => 'text',
            'instructions' => 'Enter the main headline for the overview section',
            'required' => 1,
            'default_value' => 'Not all careers reward compassion. In healthcare, it\'s your greatest asset.',
            'placeholder' => 'Enter headline text',
            'maxlength' => 200,
        ),
        array(
            'key' => 'field_home_overview_description',
            'label' => 'Description',
            'name' => 'home_overview_description',
            'type' => 'textarea',
            'instructions' => 'Enter the description text (supports multiple paragraphs)',
            'required' => 1,
            'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.

Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.',
            'rows' => 6,
            'new_lines' => 'wpautop',
        ),
        array(
            'key' => 'field_home_overview_stats',
            'label' => 'Statistics',
            'name' => 'home_overview_stats',
            'type' => 'repeater',
            'instructions' => 'Add statistics to display on the right side',
            'required' => 1,
            'min' => 1,
            'layout' => 'table',
            'button_label' => 'Add Statistic',
            'sub_fields' => array(
                array(
                    'key' => 'field_home_overview_stat_value',
                    'label' => 'Value',
                    'name' => 'stat_value',
                    'type' => 'text',
                    'instructions' => 'Enter the statistic value (e.g., 98%, $103K)',
                    'required' => 1,
                    'placeholder' => '98%',
                    'maxlength' => 20,
                ),
                
                array(
                    'key' => 'field_home_overview_stat_description',
                    'label' => 'Short Description',
                    'name' => 'stat_description',
                    'type' => 'text',
                    'instructions' => 'Enter the short description for this statistic',
                    'required' => 1,
                    'placeholder' => 'Lorem ipsum dolor sit amet',
                    'maxlength' => 100,
                ),
                array(
                    'key' => 'field_home_overview_stat_expanded_content',
                    'label' => 'Expanded Content',
                    'name' => 'stat_expanded_content',
                    'type' => 'textarea',
                    'instructions' => 'Enter the expanded content that appears when the stat is clicked',
                    'required' => 0,
                    'placeholder' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                    'rows' => 4,
                ),
                array(
                    'key' => 'field_home_overview_stat_read_more_link',
                    'label' => 'Read More Link',
                    'name' => 'stat_read_more_link',
                    'type' => 'url',
                    'instructions' => 'Enter the URL for the "Read more" link (optional)',
                    'required' => 0,
                    'placeholder' => 'https://example.com',
                ),
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/home-overview',
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
    'description' => 'Home overview section with headline, description, and statistics',
));

endif;
