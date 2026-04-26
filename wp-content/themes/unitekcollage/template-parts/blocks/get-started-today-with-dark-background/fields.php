<?php
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
    'key' => 'group_get_started_dark',
    'title' => 'Get Started Today (Dark Background) Block',
    'fields' => array(
        array(
            'key' => 'field_get_started_dark_heading',
            'label' => 'Heading',
            'name' => 'get_started_dark_heading',
            'type' => 'text',
            'default_value' => 'Get started today!',
            'required' => 1,
        ),
        array(
            'key' => 'field_get_started_dark_description',
            'label' => 'Description',
            'name' => 'get_started_dark_description',
            'type' => 'textarea',
            'default_value' => 'Complete this form and our Admissions department will contact you shortly with more information.',
            'required' => 1,
            'rows' => 3,
        ),
        array(
            'key' => 'field_get_started_dark_form_settings',
            'label' => 'Form Settings',
            'name' => 'get_started_dark_form_settings',
            'type' => 'group',
            'sub_fields' => array(
                array(
                    'key' => 'field_dark_form_action',
                    'label' => 'Form Action URL',
                    'name' => 'form_action',
                    'type' => 'url',
                    'default_value' => '#',
                ),
                array(
                    'key' => 'field_dark_form_method',
                    'label' => 'Form Method',
                    'name' => 'form_method',
                    'type' => 'select',
                    'choices' => array(
                        'post' => 'POST',
                        'get' => 'GET',
                    ),
                    'default_value' => 'post',
                ),
            ),
        ),
        array(
            'key' => 'field_get_started_dark_disclaimer',
            'label' => 'Consent Text',
            'name' => 'get_started_dark_disclaimer',
            'type' => 'wysiwyg',
            'default_value' => 'By submitting contact information on this website, you are consenting to receive calls, SMS and emails from Unitek Learning Education Group Corp (ULEGC) and its affiliates. Your information will not be sold or shared with parties unrelated to ULEGC. You certify that you are the owner of the contact information provided and agree to our privacy policy. Please note, this consent is not required to attend our institutions.',
            'required' => 1,
        ),
        array(
            'key' => 'field_get_started_dark_button_text',
            'label' => 'Submit Button Text',
            'name' => 'get_started_dark_button_text',
            'type' => 'text',
            'default_value' => 'Get started today',
            'required' => 1,
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'options_page',
                'operator' => '==',
                'value' => 'theme-settings',
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

