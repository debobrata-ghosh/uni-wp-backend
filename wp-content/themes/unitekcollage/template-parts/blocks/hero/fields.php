<?php
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
    'key' => 'group_hero_block',
    'title' => 'Hero Block Fields',
    'fields' => array(
        array(
            'key' => 'field_hero_headline',
            'label' => 'Headline',
            'name' => 'hero_headline',
            'type' => 'text',
            'instructions' => 'Enter the main headline text (Required)',
            'required' => 1,
            'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'placeholder' => 'Enter your headline here...',
            'prepend' => '',
            'append' => '',
            'maxlength' => 150,
            'conditional_logic' => 0,
        ),
        array(
            'key' => 'field_hero_subheadline',
            'label' => 'Subheadline',
            'name' => 'hero_subheadline',
            'type' => 'text',
            'instructions' => 'Enter the subheadline or lead-in copy',
            'required' => 0,
            'default_value' => 'Headline payoff/lead-in copy lorem ipsum sit amemt dolor.',
        ),
        array(
            'key' => 'field_hero_image',
            'label' => 'Hero Image',
            'name' => 'hero_image',
            'type' => 'image',
            'instructions' => 'Upload the hero image for the right column',
            'required' => 0,
            'return_format' => 'array',
            'preview_size' => 'medium',
            'library' => 'all',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/hero',
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
