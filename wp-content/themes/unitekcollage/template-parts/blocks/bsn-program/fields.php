<?php
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
    'key' => 'group_bsn_program_fields',
    'title' => 'BSN Program Fields',
    'fields' => array(
        array(
            'key' => 'field_bsn_section_title_new',
            'label' => 'Section Title',
            'name' => 'bsn_section_title_new',
            'type' => 'text',
        ),
        array(
            'key' => 'field_bsn_section_desc',
            'label' => 'Section Description',
            'name' => 'bsn_section_desc',
            'type' => 'textarea',
        ),
        array(
            'key' => 'field_bsn_feature_1_title',
            'label' => 'Feature 1 Title',
            'name' => 'bsn_feature_1_title',
            'type' => 'text',
        ),
        array(
            'key' => 'field_bsn_feature_1_desc',
            'label' => 'Feature 1 Description',
            'name' => 'bsn_feature_1_desc',
            'type' => 'text',
        ),
        // Feature 1 Link
        array(
            'key' => 'field_bsn_feature_1_link_url',
            'label' => 'Feature 1 Link URL',
            'name' => 'bsn_feature_1_link_url',
            'type' => 'url',
        ),
        array(
            'key' => 'field_bsn_feature_2_title',
            'label' => 'Feature 2 Title',
            'name' => 'bsn_feature_2_title',
            'type' => 'text',
        ),
        array(
            'key' => 'field_bsn_feature_2_desc',
            'label' => 'Feature 2 Description',
            'name' => 'bsn_feature_2_desc',
            'type' => 'text',
        ),
        // Feature 2 Link
        array(
            'key' => 'field_bsn_feature_2_link_url',
            'label' => 'Feature 2 Link URL',
            'name' => 'bsn_feature_2_link_url',
            'type' => 'url',
        ),
        array(
            'key' => 'field_bsn_feature_3_title',
            'label' => 'Feature 3 Title',
            'name' => 'bsn_feature_3_title',
            'type' => 'text',
        ),
        array(
            'key' => 'field_bsn_feature_3_year',
            'label' => 'Feature 3 Year Label',
            'name' => 'bsn_feature_3_year',
            'type' => 'text',
        ),
        array(
            'key' => 'field_bsn_feature_3_rate',
            'label' => 'Feature 3 Pass Rate',
            'name' => 'bsn_feature_3_rate',
            'type' => 'text',
        ),
        array(
            'key' => 'field_bsn_feature_3_source',
            'label' => 'Feature 3 Source Text',
            'name' => 'bsn_feature_3_source',
            'type' => 'text',
        ),
        array(
            'key' => 'field_bsn_feature_3_source_url',
            'label' => 'Feature 3 Source URL',
            'name' => 'bsn_feature_3_source_url',
            'type' => 'url',
        ),
        // Feature 3 Link
        array(
            'key' => 'field_bsn_feature_3_link_url',
            'label' => 'Feature 3 Link URL',
            'name' => 'bsn_feature_3_link_url',
            'type' => 'url',
        ),
        array(
            'key' => 'field_bsn_program_outcomes_link_text',
            'label' => 'Program Outcomes Link Text',
            'name' => 'bsn_program_outcomes_link_text',
            'type' => 'text',
            'default_value' => 'Program Outcomes',
        ),
        array(
            'key' => 'field_bsn_program_outcomes_link_url',
            'label' => 'Program Outcomes Link URL',
            'name' => 'bsn_program_outcomes_link_url',
            'type' => 'url',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/bsn-program',
            ),
        ),
    ),
));
endif;
?>
