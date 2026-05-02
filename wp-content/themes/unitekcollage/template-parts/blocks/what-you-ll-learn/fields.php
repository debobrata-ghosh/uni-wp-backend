<?php
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
    'key' => 'group_what_youll_learn',
    'title' => 'What you\'ll learn Block',
    'fields' => array(
        array(
            'key' => 'field_what_youll_learn_heading',
            'label' => 'Heading',
            'name' => 'what_youll_learn_heading',
            'type' => 'text',
            'default_value' => 'What you\'ll learn.',
            'required' => 1,
        ),
        array(
            'key' => 'field_what_youll_learn_description',
            'label' => 'Description',
            'name' => 'what_youll_learn_description',
            'type' => 'textarea',
            'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'required' => 1,
            'rows' => 3,
        ),
        array(
            'key' => 'field_what_youll_learn_points',
            'label' => 'Learning Points',
            'name' => 'what_youll_learn_points',
            'type' => 'repeater',
            'instructions' => 'Add learning points that will be displayed in two columns.',
            'required' => 1,
            'min' => 1,
            'max' => 20,
            'layout' => 'table',
            'button_label' => 'Add Learning Point',
            'sub_fields' => array(
                array(
                    'key' => 'field_what_youll_learn_point_text',
                    'label' => 'Learning Point',
                    'name' => 'point_text',
                    'type' => 'text',
                    'required' => 1,
                ),
            ),
        ),
        array(
            'key' => 'field_what_youll_learn_button_text',
            'label' => 'Button Text',
            'name' => 'what_youll_learn_button_text',
            'type' => 'text',
            'default_value' => 'Get started',
            'required' => 1,
        ),
        array(
            'key' => 'field_what_youll_learn_button_link',
            'label' => 'Button Link',
            'name' => 'what_youll_learn_button_link',
            'type' => 'link',
            'return_format' => 'array',
        ),
        array(
            'key' => 'field_what_youll_learn_image',
            'label' => 'Right Side Image',
            'name' => 'what_youll_learn_image',
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
                'value' => 'acf/what-you-ll-learn',
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
