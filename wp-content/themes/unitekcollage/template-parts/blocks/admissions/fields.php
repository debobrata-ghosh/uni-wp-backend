<?php
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
    'key' => 'group_admissions_block',
    'title' => 'Admissions Block',
    'fields' => array(
        array(
            'key' => 'field_admissions_title',
            'label' => 'Title',
            'name' => 'admissions_title',
            'type' => 'text',
            'default_value' => 'BSN admissions requirements.',
        ),
        array(
            'key' => 'field_admissions_points',
            'label' => 'Points',
            'name' => 'admissions_points',
            'type' => 'repeater',
            'layout' => 'row',
            'button_label' => 'Add Point',
            'sub_fields' => array(
                array(
                    'key' => 'field_point_text',
                    'label' => 'Point Text',
                    'name' => 'point_text',
                    'type' => 'textarea',
                ),
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/admissions',
            ),
        ),
    ),
));

endif;
