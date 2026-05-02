<?php
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
    'key' => 'group_hero_get_started',
    'title' => 'Hero Get Started Block Fields',
    'fields' => array(
        array(
            'key' => 'field_hero_get_started_heading',
            'label' => 'Heading Text',
            'name' => 'hero_get_started_heading',
            'type' => 'text',
            'instructions' => 'Enter the main heading text for the block.',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => 'Get started today.',
            'placeholder' => 'Get started today.',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
        ),
        array(
            'key' => 'field_hero_get_started_programs',
            'label' => 'Program Options',
            'name' => 'hero_get_started_programs',
            'type' => 'repeater',
            'instructions' => 'Add program options for the dropdown menu.',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'collapsed' => 'field_program_name',
            'min' => 1,
            'max' => 0,
            'layout' => 'table',
            'button_label' => 'Add Program',
            'sub_fields' => array(
                array(
                    'key' => 'field_program_name',
                    'label' => 'Program Name',
                    'name' => 'program_name',
                    'type' => 'text',
                    'instructions' => 'Enter the program name.',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => 'e.g., Web Development',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
                array(
                    'key' => 'field_program_value',
                    'label' => 'Program Value',
                    'name' => 'program_value',
                    'type' => 'text',
                    'instructions' => 'Enter the program value (used in form submission).',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => 'web-development',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
            ),
        ),
        array(
            'key' => 'field_hero_get_started_placeholder',
            'label' => 'Dropdown Placeholder',
            'name' => 'hero_get_started_placeholder',
            'type' => 'text',
            'instructions' => 'Enter the placeholder text for the dropdown.',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => 'What is your program of interest?',
            'placeholder' => 'What is your program of interest?',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
        ),
        array(
            'key' => 'field_hero_get_started_button_text',
            'label' => 'Button Text',
            'name' => 'hero_get_started_button_text',
            'type' => 'text',
            'instructions' => 'Enter the button text.',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => 'Next',
            'placeholder' => 'Next',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
        ),
        array(
            'key' => 'field_hero_get_started_cf7_form',
            'label' => 'Contact Form 7',
            'name' => 'hero_get_started_cf7_form',
            'type' => 'select',
            'instructions' => 'Select a Contact Form 7 form to process submissions. The CF7 form should only contain hidden fields.',
            'choices' => array(),
            'allow_null' => 1,
            'default_value' => '',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/hero-get-started',
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
    'description' => 'Fields for the Hero Get Started block.',
));

endif;

// Populate CF7 form choices dynamically
add_filter('acf/load_field/name=hero_get_started_cf7_form', function($field) {
    // Check if Contact Form 7 is active
    if (!function_exists('wpcf7_contact_form')) {
        $field['choices'] = array('' => 'Contact Form 7 is not installed');
        return $field;
    }
    
    // Get all Contact Form 7 forms
    $forms = get_posts(array(
        'post_type' => 'wpcf7_contact_form',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'title',
        'order' => 'ASC',
    ));
    
    $field['choices'] = array();
    
    if (!empty($forms)) {
        foreach ($forms as $form) {
            $form_id = $form->ID;
            $form_title = $form->post_title;
            $field['choices'][$form_id] = $form_title . ' (ID: ' . $form_id . ')';
        }
    } else {
        $field['choices'][''] = 'No Contact Form 7 forms found';
    }
    
    return $field;
});
