<?php
/**
 * Wave Divider Block - ACF Fields
 * 
 * Defines the ACF field group for the wave-divider block.
 * 
 * @package UnitekCollege
 */

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
    return;
}

acf_add_local_field_group( array(
    'key' => 'group_wave_divider_block',
    'title' => 'Wave Divider Block Fields',
    'fields' => array(
        array(
            'key' => 'field_wave_divider_direction',
            'label' => 'Wave Direction',
            'name' => 'wave-divider_direction',
            'type' => 'select',
            'instructions' => 'Choose the wave direction. Top to Bottom: wave dips down. Bottom to Top: wave rises up.',
            'required' => 0,
            'choices' => array(
                'top-bottom' => 'Top to Bottom (Wave dips down)',
                'bottom-top' => 'Bottom to Top (Wave rises up)',
            ),
            'default_value' => 'top-bottom',
            'allow_null' => 0,
            'multiple' => 0,
        ),
        array(
            'key' => 'field_wave_divider_width',
            'label' => 'Width',
            'name' => 'wave-divider_width',
            'type' => 'select',
            'instructions' => 'Choose the width of the wave divider. Full Width: spans entire viewport. Container Width: constrained to max-width 1728px with auto margins.',
            'required' => 0,
            'choices' => array(
                'full' => 'Full Width',
                'container' => 'Container Width (max-width: 1728px)',
            ),
            'default_value' => 'full',
            'allow_null' => 0,
            'multiple' => 0,
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/wave-divider',
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
    'description' => 'Fields for the Wave Divider block with customizable wave direction and width. Uses responsive images for desktop, tablet, and mobile.',
) );

