<?php
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
    'key' => 'group_curriculum',
    'title' => 'Curriculum Block',
    'fields' => array(
        array(
            'key' => 'field_curriculum_heading',
            'label' => 'Heading',
            'name' => 'curriculum_heading',
            'type' => 'text',
            'default_value' => 'BSN training with a career-driven curriculum.',
            'required' => 1,
        ),
        array(
            'key' => 'field_curriculum_description',
            'label' => 'Description',
            'name' => 'curriculum_description',
            'type' => 'textarea',
            'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'required' => 1,
            'rows' => 3,
        ),
        array(
            'key' => 'field_curriculum_highlighted_sentence',
            'label' => 'Highlighted Sentence',
            'name' => 'curriculum_highlighted_sentence',
            'type' => 'textarea',
            'instructions' => 'This sentence will be displayed in blue color.',
            'default_value' => 'Many of our BSN course topics are designed for aspiring students who plan to specialize later in their nursing careers.',
            'required' => 0,
            'rows' => 2,
        ),
        array(
            'key' => 'field_curriculum_course_topics',
            'label' => 'Course Topics',
            'name' => 'curriculum_course_topics',
            'type' => 'repeater',
            'instructions' => 'Add course topics that will be displayed in two columns.',
            'required' => 1,
            'min' => 1,
            'max' => 20,
            'layout' => 'table',
            'button_label' => 'Add Course Topic',
            'sub_fields' => array(
                array(
                    'key' => 'field_curriculum_topic_text',
                    'label' => 'Course Topic',
                    'name' => 'topic_text',
                    'type' => 'text',
                    'required' => 1,
                ),
            ),
        ),
        array(
            'key' => 'field_curriculum_image',
            'label' => 'Right Side Image',
            'name' => 'curriculum_image',
            'type' => 'image',
            'return_format' => 'array',
            'preview_size' => 'medium',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/curriculum',
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
