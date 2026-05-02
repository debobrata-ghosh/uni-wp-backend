<?php
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group([
        'key' => 'group_program_boxes',
        'title' => 'Program Boxes Block',
        'fields' => [
            [
                'key' => 'field_pb_section_tab',
                'label' => 'PROGRAM BOXES',
                'type' => 'tab',
                'placement' => 'top',
            ],
            [
                'key' => 'field_pb_top_heading',
                'label' => 'First Heading*',
                'name' => 'pb_top_heading',
                'type' => 'text',
                'required' => 1,
            ],
            [
                'key' => 'field_pb_top_text',
                'label' => 'First Text*',
                'name' => 'pb_top_text',
                'type' => 'textarea',
                'required' => 1,
            ],
            [
                'key' => 'field_pb_bottom_heading',
                'label' => 'Second Heading*',
                'name' => 'pb_bottom_heading',
                'type' => 'text',
                'required' => 1,
            ],
            [
                'key' => 'field_pb_bottom_text',
                'label' => 'Second Text*',
                'name' => 'pb_bottom_text',
                'type' => 'textarea',
                'required' => 1,
            ],
            [
                'key' => 'field_pb_button_text',
                'label' => 'Button Text',
                'name' => 'pb_button_text',
                'type' => 'text',
                'default_value' => 'Learn More',
            ],
            [
                'key' => 'field_pb_button_url',
                'label' => 'Button URL',
                'name' => 'pb_button_url',
                'type' => 'url',
            ],
            [
                'key' => 'field_pb_media_type_top',
                'label' => 'Top Media Type',
                'name' => 'pb_media_type_top',
                'type' => 'select',
                'choices' => [
                    'image' => 'Image',
                    'youtube' => 'YouTube',
                    'local_video' => 'Local Video',
                ],
                'default_value' => 'image',
                'ui' => 1,
            ],
            [
                'key' => 'field_pb_image_top',
                'label' => 'Top Right Image',
                'name' => 'pb_image_top',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'large',
                'conditional_logic' => [
                    [
                        [
                            'field' => 'field_pb_media_type_top',
                            'operator' => '==',
                            'value' => 'image',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'field_pb_youtube_url_top',
                'label' => 'Top YouTube URL',
                'name' => 'pb_youtube_url_top',
                'type' => 'url',
                'conditional_logic' => [
                    [
                        [
                            'field' => 'field_pb_media_type_top',
                            'operator' => '==',
                            'value' => 'youtube',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'field_pb_local_video_top',
                'label' => 'Top Local Video',
                'name' => 'pb_local_video_top',
                'type' => 'file',
                'return_format' => 'array',
                'library' => 'all',
                'mime_types' => 'mp4,webm,ogg',
                'conditional_logic' => [
                    [
                        [
                            'field' => 'field_pb_media_type_top',
                            'operator' => '==',
                            'value' => 'local_video',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'field_pb_local_video_poster_top',
                'label' => 'Top Local Video Placeholder',
                'name' => 'pb_local_video_poster_top',
                'type' => 'image',
                'return_format' => 'array',
                'conditional_logic' => [
                    [
                        [
                            'field' => 'field_pb_media_type_top',
                            'operator' => '==',
                            'value' => 'local_video',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'field_pb_image_bottom_left',
                'label' => 'Bottom Left Image',
                'name' => 'pb_image_bottom_left',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ],
            [
                'key' => 'field_pb_image_bottom_right',
                'label' => 'Bottom Right Image',
                'name' => 'pb_image_bottom_right',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/program-boxes',
                ],
            ],
        ],
    ]);
}
