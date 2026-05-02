<?php
if (!defined('ABSPATH')) { exit; }
acf_add_local_field_group(array(
    'key' => 'group_bsn_curriculum',
    'title' => 'BSN Curriculum Block',
    'fields' => array(
        array(
            'key' => 'field_bsn_curriculum_title',
            'label' => 'Main Title',
            'name' => 'main_title',
            'type' => 'text',
            'default_value' => 'BSN Curriculum',
        ),
        array(
            'key' => 'field_bsn_curriculum_total_credits',
            'label' => 'Total Program Credits',
            'name' => 'total_credits',
            'type' => 'number',
            'min' => 1,
            'instructions' => 'Displays at right of Totals row (e.g. 120).',
        ),
        array(
            'key' => 'field_bsn_curriculum_strapline',
            'label' => 'Title Format/Strapline',
            'name' => 'strapline',
            'type' => 'text',
            'default_value' => '(120 Credits*)'
        ),
        array(
            'key' => 'field_bsn_intro_col1',
            'label' => 'Intro Left',
            'name' => 'intro_col1',
            'type' => 'textarea',
            'rows' => 4
        ),
        array(
            'key' => 'field_bsn_intro_col2',
            'label' => 'Intro Right',
            'name' => 'intro_col2',
            'type' => 'textarea',
            'rows' => 4
        ),
        array(
            'key' => 'field_bsn_totals_label',
            'label' => 'Totals Label',
            'name' => 'totals_label',
            'type' => 'text',
            'default_value' => 'Course Totals'
        ),
        array(
            'key' => 'field_bsn_sections',
            'label' => 'Curriculum Sections',
            'name' => 'bsn_sections',
            'type' => 'repeater',
            'button_label' => 'Add Section',
            'min' => 1,
            'layout' => 'row',
            'sub_fields' => array(
                array(
                    'key' => 'field_bsn_section_title',
                    'label' => 'Section Title',
                    'name' => 'title',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_bsn_section_credits',
                    'label' => 'Credits',
                    'name' => 'credits',
                    'type' => 'number',
                    'min' => 0,
                    'step' => 1
                ),
                array(
                    'key' => 'field_bsn_section_courses',
                    'label' => 'Courses',
                    'name' => 'courses',
                    'type' => 'repeater',
                    'button_label' => 'Add Course',
                    'layout' => 'table',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_bsn_course_code',
                            'label' => 'Course Code & Name',
                            'name' => 'course',
                            'type' => 'text',
                        ),
                        array(
                            'key' => 'field_bsn_course_credits',
                            'label' => 'Credit Hours',
                            'name' => 'credit_hours',
                            'type' => 'number',
                            'min' => 0,
                            'step' => 1
                        ),
                    ),
                ),
                array(
                    'key' => 'field_bsn_section_note',
                    'label' => 'Section Note',
                    'name' => 'note',
                    'type' => 'text',
                    'instructions' => 'Appears at bottom of courses table',
                ),
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/bsn-curriculum',
            ),
        ),
    ),
));
