<?php
// template-parts/blocks/pathways/fields.php

if( function_exists('acf_add_local_field_group') ) :

acf_add_local_field_group(array(
    'key' => 'group_pathways',
    'title' => 'Pathways Fields',
    'fields' => array(
        array(
            'key' => 'field_pathways_title',
            'label' => 'Section Title',
            'name' => 'pathways_title',
            'type' => 'text',
            'default_value' => 'Explore the pathways to your BSN degree.',
        ),
        array(
            'key' => 'field_pathways_items',
            'label' => 'Pathways Items',
            'name' => 'pathways_items',
            'type' => 'repeater',
            'button_label' => 'Add Pathway',
            'sub_fields' => array(
                array(
                    'key' => 'field_pathways_item_title',
                    'label' => 'Pathway Title',
                    'name' => 'title',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_pathways_item_content',
                    'label' => 'Pathway Content',
                    'name' => 'content',
                    'type' => 'wysiwyg',
                    'tabs' => 'all',
                    'toolbar' => 'basic',
                    'media_upload' => 0,
                ),
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/pathways',
            ),
        ),
    ),
));

endif;
