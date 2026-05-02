<?php
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group([
        'key' => 'group_program_concord',
        'title' => 'Program Concord Block',
        'fields' => [
            
            [
                'key' => 'field_pc_main_title',
                'label' => 'Section Title',
                'name' => 'pc_main_title',
                'type' => 'text',
                'default_value' => 'Programs at Concord',
                'required' => 1,
            ],
            [
                'key' => 'field_pc_tabs',
                'label' => 'Program Tabs',
                'name' => 'pc_tabs',
                'type' => 'repeater',
                'layout' => 'block',
                'sub_fields' => [
                    [
                        'key' => 'field_pc_tab_title',
                        'label' => 'Tab Name',
                        'name' => 'pc_tab_title',
                        'type' => 'text',
                        'required' => 1,
                    ],
                    [
                        'key' => 'field_pc_sidebar',
                        'label' => 'Sidebar Description',
                        'name' => 'pc_sidebar',
                        'type' => 'textarea',
                        'required' => 1,
                    ],
                    [
                        'key' => 'field_pc_program_list',
                        'label' => 'Programs',
                        'name' => 'pc_program_list',
                        'type' => 'repeater',
                        'layout' => 'block',
                        'button_label' => 'Add Program Box',
                        'max' => 4,
                        'sub_fields' => [
                            [
                                'key' => 'field_pc_program_title',
                                'label' => 'Program Title',
                                'name' => 'pc_program_title',
                                'type' => 'text',
                            ],
                            [
                                'key' => 'field_pc_program_desc',
                                'label' => 'Program Description',
                                'name' => 'pc_program_desc',
                                'type' => 'textarea',
                            ],
                            [
                                'key' => 'field_pc_program_url',
                                'label' => 'Program URL (Arrow)',
                                'name' => 'pc_program_url',
                                'type' => 'url',
                            ],
                        ]
                    ],
                ]
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/program-concord',
                ],
            ],
        ],
    ]);
}