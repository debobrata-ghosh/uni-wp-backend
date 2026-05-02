<?php
if (!defined('ABSPATH')) exit;

acf_register_block_type(array(
    'name'              => 'campus-start-dates-new',
    'title'             => 'Campus Start Dates New',
    'description'       => 'Responsive cards for campus start dates',
    'render_template'   => get_template_directory() . '/template-parts/blocks/campus-start-dates-new/render.php',
    'category'          => 'layout',
    'icon'              => 'calendar-alt',
    'keywords'          => array('campus', 'start dates', 'schedule'),
    'mode'              => 'edit',
    'enqueue_style'     => get_template_directory_uri() . '/template-parts/blocks/campus-start-dates-new/style.css',
    'supports'          => array(
        'align' => false,
        'multiple' => true,
        'jsx' => true
    ),
));
