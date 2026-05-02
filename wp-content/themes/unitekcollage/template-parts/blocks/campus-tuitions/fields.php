<?php
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
    'key' => 'group_campus_tuitions',
    'title' => 'Campus Tuitions Fields',
    'fields' => array(
        array(
            'key' => 'field_campus_tuitions_title',
            'label' => 'Section Title',
            'name' => 'campus_tuitions_title',
            'type' => 'text',
            'default_value' => 'frequently asked questions at Unitek.',
        ),
        array(
            'key' => 'field_campus_tuitions_tabs',
            'label' => 'Tabs',
            'name' => 'campus_tuitions_tabs',
            'type' => 'repeater',
            'button_label' => 'Add Tab',
            'sub_fields' => array(
                array(
                    'key' => 'field_tab_title',
                    'label' => 'Tab Title',
                    'name' => 'tab_title',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_tab_items',
                    'label' => 'Tab Items',
                    'name' => 'tab_items',
                    'type' => 'repeater',
                    'button_label' => 'Add Question',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_item_question',
                            'label' => 'Question',
                            'name' => 'question',
                            'type' => 'text',
                        ),
                        array(
                            'key' => 'field_item_answer',
                            'label' => 'Answer',
                            'name' => 'answer',
                            'type' => 'wysiwyg',
                            'toolbar' => 'basic',
                            'media_upload' => 0,
                        ),
                    ),
                ),
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/campus-tuitions',
            ),
        ),
    ),
));

endif;
?>
