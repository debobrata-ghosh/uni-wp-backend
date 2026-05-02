<?php
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
    'key' => 'group_quote_section',
    'title' => 'Quote Section',
    'fields' => array (
        array (
            'key' => 'field_quotes',
            'label' => 'Quotes',
            'name' => 'quotes',
            'type' => 'repeater',
            'required' => 1,
            'sub_fields' => array (
                array (
                    'key' => 'field_quote_text',
                    'label' => 'Quote Text',
                    'name' => 'quote_text',
                    'type' => 'textarea',
                    'required' => 1,
                    'instructions' => 'Enter the quote text.',
                    'new_lines' => 'wpautop'
                ),
                array (
                    'key' => 'field_quote_attribution',
                    'label' => 'Attribution (Name)',
                    'name' => 'quote_attribution',
                    'type' => 'text',
                    'required' => 1,
                    'instructions' => 'Name of the quoted person.'
                ),
                array (
                    'key' => 'field_quote_caption',
                    'label' => 'Caption (Role/Note)',
                    'name' => 'quote_caption',
                    'type' => 'text',
                    'required' => 0,
                    'instructions' => 'Role or description (optional).'
                ),
            ),
            'min' => 1,
            'layout' => 'block',
            'button_label' => 'Add Quote',
        ),
    ),
    'location' => array (
        array (
            array (
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/quote-section',
            ),
        ),
    ),
));

endif;
