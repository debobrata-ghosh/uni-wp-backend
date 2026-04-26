<?php
if( function_exists('acf_register_block_type') ) {
    acf_register_block_type(array(
        'name'              => 'home-overview',
        'title'             => __('Home Overview Block'),
        'description'       => __('A two-column layout with headline, description, and statistics.'),
        'render_template'   => get_template_directory() . '/template-parts/blocks/home-overview/render.php',
        'category'          => 'design',
        'icon'              => 'admin-home',
        'keywords'          => array( 'home', 'overview', 'statistics', 'headline' ),
        'supports'          => array(
            'align' => array('wide', 'full'),
            'anchor' => true,
            'customClassName' => true,
            'jsx' => false,
        ),
        'enqueue_assets'    => function() {
            wp_enqueue_style(
                'home-overview-block',
                get_template_directory_uri() . '/template-parts/blocks/home-overview/style.css',
                array(),
                filemtime(get_template_directory() . '/template-parts/blocks/home-overview/style.css')
            );
            wp_enqueue_script(
                'home-overview-block',
                get_template_directory_uri() . '/template-parts/blocks/home-overview/index.js',
                array(),
                filemtime(get_template_directory() . '/template-parts/blocks/home-overview/index.js'),
                true
            );
        },
        'mode'              => 'edit',
        'example'           => array(
            'attributes' => array(
                'mode' => 'preview',
                'data' => array(
                    'home_overview_headline' => 'Not all careers reward compassion. In healthcare, it\'s your greatest asset.',
                    'home_overview_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                    'home_overview_stats' => array(
                        array('stat_value' => '98%', 'stat_description' => 'Lorem ipsum dolor sit amet'),
                        array('stat_value' => '100%', 'stat_description' => 'Lorem ipsum dolor sit amet'),
                        array('stat_value' => '$103K', 'stat_description' => 'Lorem ipsum dolor sit amet')
                    )
                )
            )
        ),
    ));
}
