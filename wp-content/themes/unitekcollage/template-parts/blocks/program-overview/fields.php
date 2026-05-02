<?php
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group([
        'key' => 'group_program_overview',
        'title' => 'Program Overview Block',
        'fields' => [
            [
                'key' => 'field_po_section_tab',
                'label' => 'PROGRAM OVERVIEW',
                'type' => 'tab',
                'placement' => 'top',
            ],
            [
                'key' => 'field_po_city_title',
                'label' => 'City Title*',
                'name' => 'po_city_title',
                'type' => 'text',
                'default_value' => 'Concord, CA',
                'required' => 1,
            ],
            [
                'key' => 'field_po_main_text',
                'label' => 'Main Text*',
                'name' => 'po_main_text',
                'type' => 'textarea',
                'rows' => 3,
                'required' => 1,
            ],
            [
                'key' => 'field_po_secondary_text',
                'label' => 'Secondary Text*',
                'name' => 'po_secondary_text',
                'type' => 'textarea',
                'rows' => 2,
                'required' => 1,
            ],
            [
                'key' => 'field_po_highlight_text',
                'label' => 'Highlight Text',
                'name' => 'po_highlight_text',
                'type' => 'textarea',
                'rows' => 2,
            ],
            [
                'key' => 'field_po_cta_text',
                'label' => 'CTA Text',
                'name' => 'po_cta_text',
                'type' => 'text',
                'default_value' => 'Get started today',
            ],
            [
                'key' => 'field_po_cta_url',
                'label' => 'CTA URL',
                'name' => 'po_cta_url',
                'type' => 'url',
            ],
            [
                'key' => 'field_po_address',
                'label' => 'Address Line*',
                'name' => 'po_address',
                'type' => 'text',
                'required' => 1,
            ],
            [
                'key' => 'field_po_city_state_zip',
                'label' => 'City/State/ZIP*',
                'name' => 'po_city_state_zip',
                'type' => 'text',
                'required' => 1,
            ],
            [
                'key' => 'field_po_phone',
                'label' => 'Phone (display format)*',
                'name' => 'po_phone',
                'type' => 'text',
            ],
            [
                'key' => 'field_po_phone_url',
                'label' => 'Phone Click-to-Call URL*',
                'name' => 'po_phone_url',
                'type' => 'text',
                'instructions' => 'Format: tel:+18772452802'
            ],
            [
                'key' => 'field_po_map_caption',
                'label' => 'Map Caption*',
                'name' => 'po_map_caption',
                'type' => 'text',
                'default_value' => '[ MAP FPO ]',
                'required' => 1,
            ],
            [
            'key' => 'field_po_map_caption',
            'label' => 'Map Shortcode*',
            'name' => 'po_map_caption',
            'type' => 'wysiwyg',
            'layout' => 'horizontal',
            'return_format' => 'value',
            'required' => 1,
            ],
        ],
        'location' => [
            [ [ 'param' => 'block', 'operator' => '==', 'value' => 'acf/program-overview' ] ],
        ],
    ]);
}