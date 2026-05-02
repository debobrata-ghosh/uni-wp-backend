<?php
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
    'key' => 'group_accreditation',
    'title' => 'Accreditation Block Fields',
    'fields' => array(
        array(
            'key' => 'field_acc_heading',
            'label' => 'Heading',
            'name' => 'heading',
            'type' => 'text',
            'default_value' => 'Accreditation',
        ),
        array(
            'key' => 'field_acc_description',
            'label' => 'Description',
            'name' => 'description',
            'type' => 'textarea',
            'default_value' => 'The Bachelor of Science in Nursing Program at Unitek College is accredited by the Commission on Collegiate Nursing Education (CCNE).',
        ),
        array(
            'key' => 'field_acc_link_text',
            'label' => 'Link Text',
            'name' => 'link_text',
            'type' => 'text',
        ),
        array(
            'key' => 'field_acc_link_url',
            'label' => 'Link URL',
            'name' => 'link_url',
            'type' => 'url',
        ),
        array(
            'key' => 'field_acc_badge',
            'label' => 'Badge',
            'name' => 'badge',
            'type' => 'image',
            'return_format' => 'array',
        ),
        array(
            'key' => 'field_acc_badge_width',
            'label' => 'Badge Width (px)',
            'name' => 'badge_width',
            'type' => 'number',
            'default_value' => 50, // default width
        ),
        array(
            'key' => 'field_acc_badge_height',
            'label' => 'Badge Height (px)',
            'name' => 'badge_height',
            'type' => 'number',
            'default_value' => 50, // default height
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/accreditation',
            ),
        ),
    ),
));

endif;
