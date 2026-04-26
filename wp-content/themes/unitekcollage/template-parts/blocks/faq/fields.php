<?php
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
    'key' => 'group_faq_section',
    'title' => 'FAQ Section Block',
    'fields' => array(
        array(
            'key' => 'field_faq_section_title',
            'label' => 'Section Title',
            'name' => 'faq_section_title',
            'type' => 'text',
            'instructions' => 'Enter the main title for the FAQ section',
            'required' => 1,
            'placeholder' => 'Enter section title',
            'maxlength' => 100,
        ),
        array(
            'key' => 'field_faq_categories',
            'label' => 'FAQ Categories',
            'name' => 'faq_categories',
            'type' => 'repeater',
            'instructions' => 'Add FAQ categories with their questions and answers',
            'required' => 1,
            'min' => 1,
            'max' => 10,
            'layout' => 'block',
            'button_label' => 'Add FAQ Category',
            'sub_fields' => array(
                array(
                    'key' => 'field_faq_category_title',
                    'label' => 'Category Title',
                    'name' => 'category_title',
                    'type' => 'text',
                    'instructions' => 'Enter the category title (e.g., Tuition and Financial Aid)',
                    'required' => 1,
                    'placeholder' => 'Enter category title',
                    'maxlength' => 100,
                ),
                array(
                    'key' => 'field_faq_category_items',
                    'label' => 'FAQ Items',
                    'name' => 'category_items',
                    'type' => 'repeater',
                    'instructions' => 'Add questions and answers for this category',
                    'required' => 1,
                    'min' => 1,
                    'max' => 20,
                    'layout' => 'table',
                    'button_label' => 'Add FAQ Item',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_faq_question',
                            'label' => 'Question',
                            'name' => 'question',
                            'type' => 'text',
                            'instructions' => 'Enter the FAQ question',
                            'required' => 1,
                            'placeholder' => 'Enter question text',
                            'maxlength' => 200,
                        ),
                        array(
                            'key' => 'field_faq_answer',
                            'label' => 'Answer',
                            'name' => 'answer',
                            'type' => 'wysiwyg',
                            'instructions' => 'Enter the FAQ answer',
                            'required' => 1,
                            'tabs' => 'all',
                            'toolbar' => 'basic',
                            'media_upload' => 0,
                            'delay' => 0,
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
                'value' => 'acf/faq',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => 'FAQ section with categories, tabs, and accordion functionality',
));

endif;
