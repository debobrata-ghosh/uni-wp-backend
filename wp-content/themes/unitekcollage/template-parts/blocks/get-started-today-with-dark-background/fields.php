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
            'key' => 'field_get_started_dark_cf7_form',
            'label' => 'Contact Form 7',
            'name' => 'get_started_dark_cf7_form',
            'type' => 'select',
            'instructions' => 'Select a Contact Form 7 form to display.',
            'choices' => array(),
            'allow_null' => 1,
            'default_value' => '',
        ),
    ),
    'location' => array(
        // Support block editor (pages, posts)
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/get-started-today-dark',
            ),
        ),
        // Support theme options page
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

// Populate CF7 form choices dynamically
add_filter('acf/load_field/name=get_started_dark_cf7_form', function($field) {
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

