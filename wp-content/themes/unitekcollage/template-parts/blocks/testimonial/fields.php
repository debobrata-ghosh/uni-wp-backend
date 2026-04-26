<?php
if( function_exists('acf_add_local_field_group') ) {
    acf_add_local_field_group(array(
        'key' => 'group_testimonial',
        'title' => 'Testimonial Fields',
        'fields' => array(
            array(
                'key' => 'field_author_name',
                'label' => 'Author Name',
                'name' => 'author_name',
                'type' => 'text',
                'required' => 1,
            ),
            array(
                'key' => 'field_author_role',
                'label' => 'Author Role',
                'name' => 'author_role',
                'type' => 'text',
            ),
            array(
                'key' => 'field_author_message',
                'label' => 'Message',
                'name' => 'message',
                'type' => 'textarea',
            ),
            array(
                'key' => 'field_author_image',
                'label' => 'Author Image',
                'name' => 'author_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/testimonial', // matches block name
                ),
            ),
        ),
    ));
}
