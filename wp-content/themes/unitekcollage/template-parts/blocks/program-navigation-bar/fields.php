<?php
if(function_exists('acf_add_local_field_group')):
acf_add_local_field_group(array(
    'key' => 'group_program_navigation_bar',
    'title' => 'Program Navigation Bar',
    'fields' => array(
        array(
            'key' => 'field_program_nav_tabs',
            'label' => 'Navigation Tabs',
            'name' => 'program_nav_tabs',
            'type' => 'repeater',
            'button_label' => 'Add Tab',
            'sub_fields' => array(
                array(
                    'key' => 'field_program_nav_tab_title',
                    'label' => 'Tab Label',
                    'name' => 'tab_label',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_program_nav_tab_id',
                    'label' => 'Section ID (for scroll)',
                    'name' => 'tab_section_id',
                    'type' => 'text',
                    'instructions' => 'e.g. overview, admissions, tuition. This should match the anchor ID of the section to scroll to.'
                ),
            ),
            'min' => 1,
            'max' => 12,
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/program-navigation-bar',
            ),
        ),
    ),
));
endif;
