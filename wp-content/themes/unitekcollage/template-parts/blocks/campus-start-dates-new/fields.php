<?php
if (!defined('ABSPATH')) exit;

acf_add_local_field_group(array(
    'key' => 'group_campus_start_dates_new',
    'title' => 'Campus Start Dates New',
    'fields' => array(
        array(
            'key' => 'field_campus_dates_title',
            'label' => 'Title',
            'name' => 'campus_dates_title',
            'type' => 'text',
            'default_value' => 'Enroll before our next start date.',
            'instructions' => 'Large heading above the cards.',
        ),
        array(
            'key' => 'field_campus_dates_list',
            'label' => 'Start Dates',
            'name' => 'campus_dates_list',
            'type' => 'repeater',
            'button_label' => 'Add Campus Card',
            'sub_fields' => array(
                array(
                    'key' => 'field_campus_location',
                    'label' => 'Campus Location',
                    'name' => 'campus_location',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_campus_address',
                    'label' => 'Address',
                    'name' => 'campus_address',
                    'type' => 'textarea',
                    'rows' => 2,
                ),
                array(
                    'key' => 'field_calendar_label',
                    'label' => 'Calendar Label',
                    'name' => 'calendar_label',
                    'type' => 'text',
                    'default_value' => 'START DATE',
                ),
                array(
                    'key' => 'field_calendar_sub',
                    'label' => 'Calendar Subtitle',
                    'name' => 'calendar_sub',
                    'type' => 'text',
                    'default_value' => 'ABC',
                ),
                array(
                    'key' => 'field_calendar_day',
                    'label' => 'Calendar Day',
                    'name' => 'calendar_day',
                    'type' => 'text',
                    'default_value' => '00',
                ),
                array(
                    'key' => 'field_button_text',
                    'label' => 'Button Text',
                    'name' => 'button_text',
                    'type' => 'text',
                    'default_value' => 'Get started',
                ),
                array(
                    'key' => 'field_button_url',
                    'label' => 'Button URL',
                    'name' => 'button_url',
                    'type' => 'url',
                ),
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/campus-start-dates-new',
            ),
        ),
    ),
));
