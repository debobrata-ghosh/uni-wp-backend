<?php
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
    'key' => 'group_career_block',
    'title' => 'Career Block Fields',
    'fields' => array(
        array(
            'key' => 'field_career_headline',
            'label' => 'Headline',
            'name' => 'career_headline',
            'type' => 'text',
            'instructions' => 'Enter the main headline text',
            'required' => 1,
            'default_value' => 'The support you need to navigate the costs of your education and launch your career.',
        ),
        array(
            'key' => 'field_career_subheadline',
            'label' => 'Subheadline',
            'name' => 'career_subheadline',
            'type' => 'textarea',
            'instructions' => 'Enter the subheadline or description text',
            'required' => 0,
            'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'rows' => 4,
        ),
        array(
            'key' => 'field_career_cards',
            'label' => 'Career Cards',
            'name' => 'career_cards',
            'type' => 'repeater',
            'instructions' => 'Add career service cards',
            'required' => 0,
            'min' => 1,
            'max' => 6,
            'layout' => 'table',
            'button_label' => 'Add Card',
            'sub_fields' => array(
                array(
                    'key' => 'field_card_title',
                    'label' => 'Card Title',
                    'name' => 'card_title',
                    'type' => 'text',
                    'instructions' => 'Enter the card title',
                    'required' => 1,
                    'default_value' => 'Apply for Transcript Evaluations',
                ),
                array(
                    'key' => 'field_card_url',
                    'label' => 'Card URL',
                    'name' => 'card_url',
                    'type' => 'url',
                    'instructions' => 'Enter the URL for this card (optional)',
                    'required' => 0,
                ),
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/career',
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
