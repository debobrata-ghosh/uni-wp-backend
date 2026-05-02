<?php
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
    'key' => 'group_campus_admissions',
    'title' => 'Admissions Requirements Block',
    'fields' => array(
        array(
            'key' => 'field_admissions_heading',
            'label' => 'Heading',
            'name' => 'admissions_heading',
            'type' => 'text',
            'default_value' => 'Admissions requirements for the Concord BSN program.',
            'required' => 1,
        ),
        array(
            'key' => 'field_admissions_description',
            'label' => 'Description',
            'name' => 'admissions_description',
            'type' => 'textarea',
            'default_value' => 'To enroll in our Bachelor of Science in Nursing program, applicants must complete all admissions requirements, which include the following:',
            'required' => 1,
            'rows' => 3,
        ),
        array(
            'key' => 'field_admissions_requirements',
            'label' => 'Requirements',
            'name' => 'admissions_requirements',
            'type' => 'repeater',
            'instructions' => 'Add admission requirements that will be displayed in a card grid.',
            'required' => 1,
            'min' => 1,
            'max' => 20,
            'layout' => 'table',
            'button_label' => 'Add Requirement',
            'sub_fields' => array(
                array(
                    'key' => 'field_admissions_requirement_title',
                    'label' => 'Requirement Title',
                    'name' => 'requirement_title',
                    'type' => 'text',
                    'instructions' => 'Enter the requirement title (will be displayed in uppercase and green color).',
                    'required' => 1,
                ),
                array(
                    'key' => 'field_admissions_requirement_description',
                    'label' => 'Requirement Description',
                    'name' => 'requirement_description',
                    'type' => 'textarea',
                    'instructions' => 'Enter the requirement description.',
                    'required' => 1,
                    'rows' => 2,
                ),
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/campus-admissions',
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
