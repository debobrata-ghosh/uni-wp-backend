<?php
if(function_exists('acf_add_local_field_group')):

acf_add_local_field_group(array(
    'key' => 'group_financial_aid',
    'title' => 'Financial Aid Section',
    'fields' => array(
        array(
            'key' => 'field_left_title',
            'label'=> 'Left Section Title',
            'name'=> 'left_title',
            'type'=> 'text',
            'default_value' => 'Cost and Financial Aid',
        ),
        array(
            'key' => 'field_left_desc',
            'label'=> 'Left Section Description',
            'name'=> 'left_desc',
            'type'=> 'textarea',
        ),
        array(
            'key' => 'field_left_subdesc',
            'label'=> 'Left Section Sub-description',
            'name'=> 'left_subdesc',
            'type'=> 'textarea',
        ),
        array(
            'key' => 'field_left_cta_text',
            'label'=> 'Left CTA Text',
            'name'=> 'left_cta_text',
            'type'=> 'text',
            'default_value' => 'Learn more',
        ),
        array(
            'key' => 'field_left_cta_url',
            'label'=> 'Left CTA URL',
            'name'=> 'left_cta_url',
            'type'=> 'url',
        ),
        array(
            'key' => 'field_right_title',
            'label'=> 'Right Section Title',
            'name'=> 'right_title',
            'type'=> 'text',
            'default_value' => 'Cross Program',
        ),
        array(
            'key' => 'field_right_desc',
            'label'=> 'Right Section Description',
            'name'=> 'right_desc',
            'type'=> 'textarea',
        ),
        array(
            'key' => 'field_right_subdesc',
            'label'=> 'Right Section Sub-description',
            'name'=> 'right_subdesc',
            'type'=> 'textarea',
        ),
        array(
            'key' => 'field_right_cta_text',
            'label'=> 'Right CTA Text',
            'name'=> 'right_cta_text',
            'type'=> 'text',
            'default_value' => 'Get started today',
        ),
        array(
            'key' => 'field_right_cta_url',
            'label'=> 'Right CTA URL',
            'name'=> 'right_cta_url',
            'type'=> 'url',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/financial-aid',
            ),
        ),
    ),
));
endif;
