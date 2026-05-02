<?php
/**
 * Unitek College Theme Functions
 *
 * @package UnitekCollege
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}


require get_template_directory() . '/inc/blocks-loader.php';
require get_template_directory() . '/inc/acf-options.php';
require get_template_directory() . '/inc/acf-fields/theme-settings.php';
require get_template_directory() . '/inc/acf-fields/mega-menu-settings.php';
require get_template_directory() . '/inc/class-mega-menu-walker.php';
require get_template_directory() . '/inc/acf-fields/testimonials.php';
require get_template_directory() . '/inc/custom-post-types.php';

// Register native Gutenberg blocks
// DISABLED - Using plugin version instead
/*
add_action('init', function() {
    $block_path = get_template_directory() . '/template-parts/blocks/full-width-container';
    
    register_block_type(
        $block_path . '/block.json',
        array(
            'render_callback' => function($attributes, $content, $block) use ($block_path) {
                // For dynamic blocks with save: null, WordPress should populate $content with inner blocks
                $inner_content = '';
                
                // First, try to use $content if WordPress populated it automatically
                if ( ! empty( $content ) ) {
                    $inner_content = $content;
                }
                // If content is empty, manually render inner blocks from $block object
                elseif ( ! empty( $block ) && is_object( $block ) ) {
                    // Method 1: Directly iterate inner_blocks (WP_Block_List) - this is the most reliable
                    if ( ! empty( $block->inner_blocks ) ) {
                        foreach ( $block->inner_blocks as $inner_block ) {
                            if ( is_object( $inner_block ) && method_exists( $inner_block, 'render' ) ) {
                                $inner_content .= $inner_block->render();
                            }
                        }
                    }
                    
                    // Method 2: Use inner_content array if inner_blocks didn't work
                    if ( empty( $inner_content ) && ! empty( $block->inner_content ) && is_array( $block->inner_content ) ) {
                        $block_index = 0;
                        $inner_blocks_list = array();
                        // Convert WP_Block_List to array for indexed access
                        if ( ! empty( $block->inner_blocks ) ) {
                            foreach ( $block->inner_blocks as $idx => $ib ) {
                                $inner_blocks_list[ $idx ] = $ib;
                            }
                        }
                        
                        foreach ( $block->inner_content as $chunk ) {
                            if ( is_string( $chunk ) ) {
                                $inner_content .= $chunk;
                            } elseif ( isset( $inner_blocks_list[ $block_index ] ) ) {
                                $inner_content .= $inner_blocks_list[ $block_index ]->render();
                                $block_index++;
                            }
                        }
                    }
                    
                    // Method 3: Use parsed_block as last resort
                    if ( empty( $inner_content ) && ! empty( $block->parsed_block['innerBlocks'] ) ) {
                        foreach ( $block->parsed_block['innerBlocks'] as $inner_block_data ) {
                            $inner_content .= render_block( $inner_block_data );
                        }
                    }
                }
                
                // Get block wrapper attributes
                $wrapper_attributes = get_block_wrapper_attributes( array(
                    'class' => 'full-width-container-block',
                ) );
                
                // Output the template
                ob_start();
                ?>
                <section <?php echo $wrapper_attributes; ?> role="region" aria-label="Full width container">
                    <div class="full-width-container-inner">
                        <?php echo $inner_content; ?>
                    </div>
                </section>
                <?php
                return ob_get_clean();
            }
        )
    );
});
*/









/**
 * Theme setup
 */
function unitek_college_setup() {
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    add_theme_support('custom-logo');
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_editor_style('editor-style.css');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'unitek-college'),
        'primary_menu' => __('Header Main Menu', 'unitek-college'),
        'footer' => __('Footer Menu', 'unitek-college'),
    ));
    
    // Add image sizes
    add_image_size('hero-image', 1200, 600, true);
    add_image_size('program-card', 400, 300, true);
    add_image_size('campus-image', 600, 400, true);
    add_image_size('thumbnail-large', 400, 400, true);
    add_image_size('thumbnail-medium', 300, 300, true);
    add_image_size('thumbnail-small', 150, 150, true);
}
add_action('after_setup_theme', 'unitek_college_setup');

/**
 * Add preconnect for Google Fonts
 */
function unitek_college_google_fonts_preconnect() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action('wp_head', 'unitek_college_google_fonts_preconnect', 1);

/**
 * Enqueue scripts and styles
 */
function unitek_college_scripts() {
    // Get current timestamp for cache busting
    $version = time();
    
    // Enqueue Google Fonts - Outfit as primary font
    wp_enqueue_style('unitek-college-fonts', 'https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&display=swap', array(), null);
    
    // Enqueue main stylesheet (after fonts)
    wp_enqueue_style('unitek-college-style', get_stylesheet_uri(), array('unitek-college-fonts'), $version);
    
    // Enqueue Font Awesome
    wp_enqueue_style('unitek-college-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', array(), '6.0.0');
    
    // Enqueue main JavaScript
    wp_enqueue_script('unitek-college-script', get_template_directory_uri() . '/script.js', array('jquery'), $version, true);
    
    // Localize script for AJAX
    wp_localize_script('unitek-college-script', 'unitek_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('unitek_nonce'),
    ));
    
    // Localize script for search functionality
    wp_localize_script('unitek-college-script', 'unitekSearchNonce', wp_create_nonce('unitek_search_nonce'));
    wp_localize_script('unitek-college-script', 'ajaxurl', admin_url('admin-ajax.php'));
    wp_localize_script('unitek-college-script', 'unitek_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
    // Globals for front-end scripts
    wp_localize_script('unitek-college-script', 'unitekGlobals', array(
        'home_url' => home_url('/'),
    ));
}
add_action('wp_enqueue_scripts', 'unitek_college_scripts');

/**
 * Register widget areas
 */
function unitek_college_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar', 'unitek-college'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here.', 'unitek-college'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    
    register_sidebar(array(
        'name' => __('Footer Widget Area 1', 'unitek-college'),
        'id' => 'footer-1',
        'description' => __('Add widgets here.', 'unitek-college'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => __('Footer Widget Area 2', 'unitek-college'),
        'id' => 'footer-2',
        'description' => __('Add widgets here.', 'unitek-college'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => __('Footer Widget Area 3', 'unitek-college'),
        'id' => 'footer-3',
        'description' => __('Add widgets here.', 'unitek-college'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'unitek_college_widgets_init');

/**
 * Customizer additions
 */
function unitek_college_customize_register($wp_customize) {
    // Add theme options panel
    $wp_customize->add_panel('unitek_college_options', array(
        'title' => __('Unitek College Options', 'unitek-college'),
        'priority' => 30,
    ));
    
    // Hero section
    $wp_customize->add_section('unitek_college_hero', array(
        'title' => __('Hero Section', 'unitek-college'),
        'panel' => 'unitek_college_options',
    ));
    
    $wp_customize->add_setting('hero_headline', array(
        'default' => 'DISPLAY HEADLINE COPY',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_headline', array(
        'label' => __('Hero Headline', 'unitek-college'),
        'section' => 'unitek_college_hero',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('hero_subheadline', array(
        'default' => 'Headline payoff/lead-in copy lorem ipsum sit amemt dolor.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_subheadline', array(
        'label' => __('Hero Subheadline', 'unitek-college'),
        'section' => 'unitek_college_hero',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('hero_image', array(
        'default' => '',
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'hero_image', array(
        'label' => __('Hero Image', 'unitek-college'),
        'section' => 'unitek_college_hero',
        'mime_type' => 'image',
    )));
}
add_action('customize_register', 'unitek_college_customize_register');

/**
 * Custom post types
 */
// function unitek_college_custom_post_types() {
//     // Programs post type
//     register_post_type('program', array(
//         'labels' => array(
//             'name' => __('Programs', 'unitek-college'),
//             'singular_name' => __('Program', 'unitek-college'),
//             'add_new' => __('Add New Program', 'unitek-college'),
//             'add_new_item' => __('Add New Program', 'unitek-college'),
//             'edit_item' => __('Edit Program', 'unitek-college'),
//             'new_item' => __('New Program', 'unitek-college'),
//             'view_item' => __('View Program', 'unitek-college'),
//             'search_items' => __('Search Programs', 'unitek-college'),
//             'not_found' => __('No programs found', 'unitek-college'),
//             'not_found_in_trash' => __('No programs found in trash', 'unitek-college'),
//         ),
//         'public' => true,
//         'has_archive' => true,
//         'menu_icon' => 'dashicons-book-alt',
//         'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
//         'rewrite' => array('slug' => 'programs'),
//     ));
    
//     // Campuses post type
//     register_post_type('campus', array(
//         'labels' => array(
//             'name' => __('Campuses', 'unitek-college'),
//             'singular_name' => __('Campus', 'unitek-college'),
//             'add_new' => __('Add New Campus', 'unitek-college'),
//             'add_new_item' => __('Add New Campus', 'unitek-college'),
//             'edit_item' => __('Edit Campus', 'unitek-college'),
//             'new_item' => __('New Campus', 'unitek-college'),
//             'view_item' => __('View Campus', 'unitek-college'),
//             'search_items' => __('Search Campuses', 'unitek-college'),
//             'not_found' => __('No campuses found', 'unitek-college'),
//             'not_found_in_trash' => __('No campuses found in trash', 'unitek-college'),
//         ),
//         'public' => true,
//         'has_archive' => true,
//         'menu_icon' => 'dashicons-location-alt',
//         'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
//         'rewrite' => array('slug' => 'campuses'),
//     ));
// }
// add_action('init', 'unitek_college_custom_post_types');

/**
 * Customize excerpt length
 */
function unitek_college_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'unitek_college_excerpt_length');

/**
 * Customize excerpt more
 */
function unitek_college_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'unitek_college_excerpt_more');

/**
 * Add custom body classes
 */
function unitek_college_body_classes($classes) {
    if (is_front_page()) {
        $classes[] = 'home-page';
    }
    return $classes;
}
add_filter('body_class', 'unitek_college_body_classes');

/**
 * Add custom CSS for admin
 */
function unitek_college_admin_styles() {
    echo '<style>
        .wp-admin #wpbody-content .metabox-holder { padding-top: 20px; }
        
        /* Additional editor width fixes */
        .block-editor-block-list__layout {
            max-width: 100% !important;
        }
        
        .editor-styles-wrapper {
            max-width: 100% !important;
        }
        
        .interface-interface-skeleton__content {
            max-width: 100% !important;
        }
    </style>';
}
add_action('admin_head', 'unitek_college_admin_styles');

/**
 * Theme activation hook
 */
function unitek_college_theme_activation() {
    // Flush rewrite rules
    flush_rewrite_rules();
    
    // Set default options
    if (!get_option('unitek_college_theme_options')) {
        update_option('unitek_college_theme_options', array(
            'hero_headline' => 'DISPLAY HEADLINE COPY',
            'hero_subheadline' => 'Headline payoff/lead-in copy lorem ipsum sit amemt dolor.',
        ));
    }
}
add_action('after_switch_theme', 'unitek_college_theme_activation');

/**
 * Theme deactivation hook
 */
function unitek_college_theme_deactivation() {
    // Flush rewrite rules
    flush_rewrite_rules();
}
add_action('switch_theme', 'unitek_college_theme_deactivation');






/**
 * Dynamic Posts Shortcode
 */
function unitek_college_posts_shortcode($atts) {
    // Parse shortcode attributes
    $atts = shortcode_atts(array(
        'posts_per_page' => 3,
        'category' => '',
        'tag' => '',
        'orderby' => 'date',
        'order' => 'DESC',
        'show_excerpt' => 'true',
        'show_thumbnail' => 'true',
        'show_date' => 'true',
        'show_author' => 'true',
        'layout' => 'grid', // grid, list, carousel
        'columns' => 3,
        'title' => 'Latest News',
        'class' => '',
    ), $atts);
    
    // Build query arguments
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => intval($atts['posts_per_page']),
        'orderby' => sanitize_text_field($atts['orderby']),
        'order' => sanitize_text_field($atts['order']),
        'ignore_sticky_posts' => true,
    );
    
    // Add category filter
    if (!empty($atts['category'])) {
        $args['category_name'] = sanitize_text_field($atts['category']);
    }
    
    // Add tag filter
    if (!empty($atts['tag'])) {
        $args['tag'] = sanitize_text_field($atts['tag']);
    }
    
    // Execute query
    $posts_query = new WP_Query($args);
    
    if (!$posts_query->have_posts()) {
        return '<p>' . __('No posts found.', 'unitek-college') . '</p>';
    }
    
    // Start output buffering
    ob_start();
    
    ?>
    <section class="news">
        <div class="container">
            <h2 class="news-headline"><?php echo esc_html($atts['title']); ?></h2>
            <div class="news-grid">
                <?php while ($posts_query->have_posts()) : $posts_query->the_post(); ?>
                    <article class="news-card">
                        <div class="news-image">
                            <?php if ($atts['show_thumbnail'] === 'true' && has_post_thumbnail()) : ?>
                                <?php 
                                $thumbnail_id = get_post_thumbnail_id();
                                $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'medium')[0];
                                $thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                                ?>
                                <a href="<?php the_permalink(); ?>" class="news-image-link" aria-label="<?php echo esc_attr(get_the_title()); ?>">
                                    <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr($thumbnail_alt); ?>" class="wp-post-image">
                                </a>
                            <?php else : ?>
                                <div class="image-placeholder">[ Image ]</div>
                            <?php endif; ?>
                            <?php 
                            // Get the first category for the tag
                            $categories = get_the_category();
                            $category_name = !empty($categories) ? $categories[0]->name : 'News';
                            ?>
                            <div class="category-tag"><?php echo esc_html($category_name); ?></div>
                        </div>
                        <div class="news-content">
                            <!-- <?php if ($atts['show_date'] === 'true') : ?>
                                <time class="news-date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                    <?php echo get_the_date('F j, Y'); ?>
                                </time>

                            <?php endif; ?> -->

                            <div class="article-card__meta">
                                    <span class="article-card__date"><?php echo get_the_date('F j, Y'); ?></span>
                                    <span class="article-card__divider"></span>
                                    <span class="article-card__author"><?php echo esc_html(get_the_author()); ?></span>
                                </div>
                            <h3 class="news-title">
                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <!-- <?php if ($atts['show_excerpt'] === 'true') : ?>
                                <p class="news-snippet"><?php // echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></p>
                            <?php endif; ?> -->
                            <a href="<?php the_permalink(); ?>" class="read-more-link">Read more →</a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <?php
    
    // Reset post data
    wp_reset_postdata();
    
    // Return buffered content
    return ob_get_clean();
}
add_shortcode('unitek_posts', 'unitek_college_posts_shortcode');

/**
 * Process shortcodes in ACF fields
 */
function unitek_college_process_acf_shortcodes($value, $post_id, $field) {
    // Process shortcodes in text-based fields
    if (in_array($field['type'], array('wysiwyg', 'textarea', 'text'))) {
        if (is_string($value) && !empty($value)) {
            $value = do_shortcode($value);
        }
    }
    return $value;
}
add_filter('acf/format_value/type=wysiwyg', 'unitek_college_process_acf_shortcodes', 10, 3);
add_filter('acf/format_value/type=textarea', 'unitek_college_process_acf_shortcodes', 10, 3);
add_filter('acf/format_value/type=text', 'unitek_college_process_acf_shortcodes', 10, 3);

/**
 * Process shortcodes in ACF field output (when using the_field)
 */
function unitek_college_process_acf_output_shortcodes($value, $post_id, $field) {
    if (is_string($value) && !empty($value)) {
        $value = do_shortcode($value);
    }
    return $value;
}
add_filter('acf/format_value', 'unitek_college_process_acf_output_shortcodes', 20, 3);

/**
 * Process shortcodes in post content (fallback)
 */
function unitek_college_process_content_shortcodes($content) {
    if (is_string($content)) {
        $content = do_shortcode($content);
    }
    return $content;
}
add_filter('the_content', 'unitek_college_process_content_shortcodes', 20);

/**
 * Remove shortcodes from titles and excerpts in search results
 */
function unitek_college_remove_shortcodes_from_search($text) {
    if (empty($text) || !is_string($text)) {
        return $text;
    }
    
    // Remove all shortcodes (including [unitek_posts] and any other shortcodes)
    $text = strip_shortcodes($text);
    
    // Also remove any remaining shortcode-like patterns that might have been missed
    $text = preg_replace('/\[[^\]]+\]/', '', $text);
    
    // Clean up extra whitespace
    $text = preg_replace('/\s+/', ' ', $text);
    $text = trim($text);
    
    return $text;
}

/**
 * Remove shortcodes from excerpts (especially in search results)
 */
function unitek_college_clean_excerpt_shortcodes($excerpt) {
    // Always remove shortcodes from excerpts
    return unitek_college_remove_shortcodes_from_search($excerpt);
}
add_filter('get_the_excerpt', 'unitek_college_clean_excerpt_shortcodes', 10, 1);
add_filter('the_excerpt', 'unitek_college_clean_excerpt_shortcodes', 10, 1);
add_filter('wp_trim_excerpt', 'unitek_college_clean_excerpt_shortcodes', 10, 1);

/**
 * Remove shortcodes from titles in search results and admin
 */
function unitek_college_clean_title_shortcodes($title, $post_id = null) {
    // Remove shortcodes from titles in search context or admin
    if (is_search() || is_admin()) {
        return unitek_college_remove_shortcodes_from_search($title);
    }
    return $title;
}
add_filter('the_title', 'unitek_college_clean_title_shortcodes', 10, 2);
add_filter('get_the_title', 'unitek_college_clean_title_shortcodes', 10, 2);

/**
 * Remove shortcodes from REST API responses (for JavaScript search)
 */
function unitek_college_clean_rest_api_shortcodes($response, $post, $request) {
    // Clean title
    if (isset($response->data['title']['rendered'])) {
        $response->data['title']['rendered'] = unitek_college_remove_shortcodes_from_search($response->data['title']['rendered']);
    }
    
    // Clean excerpt
    if (isset($response->data['excerpt']['rendered'])) {
        $response->data['excerpt']['rendered'] = unitek_college_remove_shortcodes_from_search($response->data['excerpt']['rendered']);
    }
    
    // Clean content if needed
    if (isset($response->data['content']['rendered'])) {
        // Only strip shortcodes, don't remove all content
        $response->data['content']['rendered'] = strip_shortcodes($response->data['content']['rendered']);
    }
    
    return $response;
}
add_filter('rest_prepare_post', 'unitek_college_clean_rest_api_shortcodes', 10, 3);
add_filter('rest_prepare_page', 'unitek_college_clean_rest_api_shortcodes', 10, 3);

/**
 * ACF Field Validation for Required Fields
 */
function unitek_college_validate_acf_fields($valid, $value, $field, $input) {
    // Only validate if the field is required and empty
    if ($field['required'] && empty($value)) {
        $valid = sprintf(
            __('%s is required and cannot be empty.', 'unitek-college'),
            $field['label']
        );
    }
    
    return $valid;
}
add_filter('acf/validate_value', 'unitek_college_validate_acf_fields', 10, 4);

/**
 * Prevent saving posts with empty required ACF fields
 */
/**
 * Validate ACF required fields using ACF's validation filter
 * This runs BEFORE ACF saves, so we check POST data (new values)
 */
function unitek_college_validate_acf_required_fields($valid, $value, $field, $input) {
    // Only validate if field is required
    if ($field['required'] && $field['type'] !== 'tab') {
        // Check if value is empty (but allow 0 and '0' as valid values)
        $is_empty = ($value === '' || $value === null || $value === false || (is_array($value) && empty($value)));
        
        if ($is_empty) {
            $valid = sprintf(
                __('%s is required.', 'unitek-college'),
                $field['label']
            );
        }
    }
    
    return $valid;
}
add_filter('acf/validate_value', 'unitek_college_validate_acf_required_fields', 10, 4);

/**
 * JavaScript validation for ACF blocks in editor
 */
function unitek_college_acf_block_validation_script() {
    if (!is_admin()) {
        return;
    }
    
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        // Listen for ACF field changes
        $(document).on('change', '.acf-field input, .acf-field select, .acf-field textarea', function() {
            var field = $(this).closest('.acf-field');
            var isRequired = field.data('required');
            var fieldValue = $(this).val();
            
            if (isRequired && !fieldValue) {
                field.addClass('acf-error');
                if (!field.find('.acf-error-message').length) {
                    field.append('<div class="acf-error-message">This field is required</div>');
                }
            } else {
                field.removeClass('acf-error');
                field.find('.acf-error-message').remove();
            }
        });
        
        // Prevent block save if required fields are empty
        $(document).on('click', '.acf-block-component .acf-button', function(e) {
            var block = $(this).closest('.acf-block-component');
            var hasErrors = false;
            
            block.find('.acf-field[data-required="1"]').each(function() {
                var field = $(this);
                var input = field.find('input, select, textarea');
                var value = input.val();
                
                if (!value) {
                    field.addClass('acf-error');
                    if (!field.find('.acf-error-message').length) {
                        field.append('<div class="acf-error-message">This field is required</div>');
                    }
                    hasErrors = true;
                }
            });
            
            if (hasErrors) {
                e.preventDefault();
                return false;
            }
        });
    });
    </script>
    
    <style>
    .acf-field.acf-error {
        border: 2px solid #dc3232 !important;
        border-radius: 4px;
        padding: 10px;
    }
    
    .acf-error-message {
        color: #dc3232;
        font-size: 12px;
        margin-top: 5px;
        font-weight: bold;
    }
    </style>
    <?php
}
add_action('admin_head', 'unitek_college_acf_block_validation_script');

/**
 * Admin styles to beautify the Theme Settings → Header & Footer page
 */
function unitek_college_theme_settings_admin_styles() {
    $screen = isset($_GET['page']) ? sanitize_text_field($_GET['page']) : '';
    if ($screen !== 'theme-settings-header-footer') {
        return;
    }
    echo '<style>
    /* Container */
    .acf-admin-page .wrap h1 { letter-spacing: .2px; }
    /* Notices - improve readability */
    .acf-admin-page .notice, .acf-admin-page .acf-notice { border-radius:10px; padding:10px 14px; }
    /* Hide the global red validation bar on this options page (non-blocking UX) */
    .acf-admin-page .notice-error, .acf-admin-page .acf-notice.-error { display:none !important; }
    /* Card look for groups */
    .acf-fields { background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden; }
    .acf-field { padding: 14px 16px; border-top: 1px solid #f1f5f9; }
    .acf-field:first-child { border-top: 0; }
    .acf-label label { font-weight:600; color:#0f172a; }
    .acf-input input[type="text"],
    .acf-input input[type="email"],
    .acf-input input[type="url"],
    .acf-input input[type="number"],
    .acf-input textarea,
    .acf-input select { border-radius: 8px; border-color:#cbd5e1; box-shadow:none; }
    .acf-input input:focus, .acf-input textarea:focus, .acf-input select:focus { border-color:#0072ce; box-shadow: 0 0 0 2px rgba(0,114,206,.15); }
    /* Section headers */
    .acf-field[data-name="header_logo"],
    .acf-field[data-name="footer_logo"] { background:#f8fafc; }
    /* Repeater styling */
    .acf-repeater.-row .acf-table { border-radius: 10px; overflow:hidden; }
    .acf-repeater .acf-row-handle.order { background:#f1f5f9; color:#475569; }
    .acf-repeater .acf-button { border-radius: 20px; padding: 6px 12px; }
    /* Footer columns - make it compact */
    .acf-field[data-name="footer_columns"] .acf-repeater .acf-row { background:#ffffff; }
    .acf-field[data-name="footer_columns"] .acf-repeater .acf-row:hover { background:#fbfdff; }
    </style>';
}
add_action('admin_head', 'unitek_college_theme_settings_admin_styles');

/**
 * Reusable function to validate required ACF fields in blocks
 */
function unitek_college_validate_block_fields($required_fields, $block_name = '') {
    $missing_fields = array();
    
    // 1) Include any explicitly-declared required fields passed in
    if (is_array($required_fields) && !empty($required_fields)) {
        foreach ($required_fields as $field_name => $field_label) {
            $value = get_field($field_name);
            if (empty($value)) {
                $missing_fields[] = $field_label;
            }
        }
    }
    
    // 2) Auto-detect REQUIRED ACF fields for this block (including nested repeaters/groups)
    //    and include any that are empty. Non-blocking: we only collect and display.
    if (function_exists('get_field_objects')) {
        $field_objects = get_field_objects();
        
        if (is_array($field_objects)) {
            // Recursive collector for nested structures
            $collect_missing = function($field, $path = '') use (&$collect_missing, &$missing_fields) {
                $type  = isset($field['type']) ? $field['type'] : '';
                $name  = isset($field['name']) ? $field['name'] : '';
                $label = isset($field['label']) ? $field['label'] : $name;
                $is_required = !empty($field['required']);
                
                // Skip non-content UI fields
                if ($type === 'tab' || $type === 'message') {
                    return;
                }
                
                $label_path = trim($path ? $path . ' · ' . $label : $label);
                
                if ($type === 'group' && !empty($field['sub_fields'])) {
                    $group_value = $name ? get_field($name) : null;
                    foreach ($field['sub_fields'] as $sub_field) {
                        // For groups, pass the path but check emptiness against group array if available
                        if (is_array($group_value) && !empty($sub_field['name'])) {
                            $sub_name  = $sub_field['name'];
                            $sub_value = isset($group_value[$sub_name]) ? $group_value[$sub_name] : null;
                            if (!empty($sub_field['required']) && (empty($sub_value) && $sub_value !== '0')) {
                                $missing_label = trim($label_path . ' · ' . ($sub_field['label'] ?? $sub_name));
                                if (!in_array($missing_label, $missing_fields, true)) {
                                    $missing_fields[] = $missing_label;
                                }
                            }
                        }
                        $collect_missing($sub_field, $label_path);
                    }
                    return;
                }
                
                if ($type === 'repeater' && !empty($field['sub_fields'])) {
                    $rows = $name ? get_field($name) : null;
                    if (is_array($rows)) {
                        foreach ($rows as $index => $row) {
                            foreach ($field['sub_fields'] as $sub_field) {
                                if (empty($sub_field['required'])) {
                                    continue;
                                }
                                $sub_name  = $sub_field['name'] ?? '';
                                $sub_label = $sub_field['label'] ?? $sub_name;
                                if (!$sub_name) {
                                    continue;
                                }
                                $sub_value = isset($row[$sub_name]) ? $row[$sub_name] : null;
                                if (empty($sub_value) && $sub_value !== '0') {
                                    $missing_label = $label_path . ' · ' . $sub_label . ' (row ' . ($index + 1) . ')';
                                    if (!in_array($missing_label, $missing_fields, true)) {
                                        $missing_fields[] = $missing_label;
                                    }
                                }
                            }
                        }
                    } else {
                        // If repeater has no rows and any subfield is required, note the repeater label
                        foreach ($field['sub_fields'] as $sub_field) {
                            if (!empty($sub_field['required'])) {
                                if (!in_array($label_path, $missing_fields, true)) {
                                    $missing_fields[] = $label_path;
                                }
                                break;
                            }
                        }
                    }
                    return;
                }
                
                // Simple field
                if ($name) {
                    $value = get_field($name);
                    if ($is_required && (empty($value) && $value !== '0')) {
                        if (!in_array($label_path, $missing_fields, true)) {
                            $missing_fields[] = $label_path;
                        }
                    }
                }
            };
            
            foreach ($field_objects as $field_object) {
                $collect_missing($field_object, '');
            }
        }
    }
    
    if (!empty($missing_fields) && is_admin()) {
        echo '<div class="acf-block-validation-error" style="background:#eef6ff;border:1px solid #b6d4fe;padding:14px 16px;margin:12px 0;border-radius:10px;">';
        echo '  <div style="display:flex;gap:12px;align-items:flex-start;">';
        echo '    <div style="flex:0 0 auto;width:28px;height:28px;border-radius:6px;background:#dbeafe;display:flex;align-items:center;justify-content:center;color:#0b5ed7;font-weight:700;">i</div>';
        echo '    <div style="flex:1 1 auto;min-width:0;">';
        echo '      <div style="display:flex;flex-wrap:wrap;gap:8px;align-items:center;margin:0 0 4px 0;">';
        echo '        <h4 style="color:#0b5ed7;margin:0;font-weight:600;font-size:14px;">' . ($block_name ? esc_html($block_name) . ' · ' : '') . 'Missing recommended fields</h4>';
        echo '        <span style="color:#475569;font-size:13px;">Preview is available</span>';
        echo '      </div>';
        echo '      <div style="margin-top:2px;">';
        echo '        <div style="color:#1f2937;line-height:1.55;font-size:13px;">The following fields are empty:</div>';
        echo '        <ul style="margin:6px 0 0 18px;padding-left:0;color:#1f2937;font-size:13px;">';
        foreach ($missing_fields as $field) {
            echo '          <li>' . esc_html($field) . '</li>';
        }
        echo '        </ul>';
        echo '      </div>';
        echo '      <div style="margin-top:8px;color:#475569;font-size:12.5px;">Please complete these fields before saving.</div>';
        echo '    </div>';
        echo '  </div>';
        echo '</div>';
        // Do not block rendering/preview
    }
    
    return true; // Always return true to avoid blocking previews
}

/**
 * Helper function to get field value with fallback
 */
function unitek_college_get_field_with_fallback($field_name, $fallback = '') {
    $value = get_field($field_name);
    return !empty($value) ? $value : $fallback;
}

/**
 * Add thumbnail support for specific post types
 */
function unitek_college_add_thumbnail_support() {
    // Add thumbnail support for all post types
    add_post_type_support('page', 'thumbnail');
    add_post_type_support('post', 'thumbnail');
}
add_action('init', 'unitek_college_add_thumbnail_support');

/**
 * Customize thumbnail sizes in admin
 */
function unitek_college_custom_image_sizes($sizes) {
    return array_merge($sizes, array(
        'hero-image' => __('Hero Image'),
        'program-card' => __('Program Card'),
        'campus-image' => __('Campus Image'),
        'thumbnail-large' => __('Large Thumbnail'),
        'thumbnail-medium' => __('Medium Thumbnail'),
        'thumbnail-small' => __('Small Thumbnail'),
    ));
}
add_filter('image_size_names_choose', 'unitek_college_custom_image_sizes');

/**
 * AJAX handler for live search
 */
function unitek_live_search() {
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'unitek_search_nonce')) {
        wp_die('Security check failed');
    }
    
    $query = sanitize_text_field($_POST['query']);
    
    if (empty($query) || strlen($query) < 2) {
        wp_send_json_error('Query too short');
        return;
    }
    
    // Debug: Log the search query
    error_log('Search query: ' . $query);
    
    // Simplified search - just search posts and pages without meta query
    $search_args = array(
        'post_type' => array('post', 'page'),
        'post_status' => 'publish',
        's' => $query,
        'posts_per_page' => 10,
        'orderby' => 'relevance'
    );
    
    $search_query = new WP_Query($search_args);
    $results = array();
    
    // Debug: Log total posts found
    error_log('Total posts found: ' . $search_query->found_posts);
    
    if ($search_query->have_posts()) {
        while ($search_query->have_posts()) {
            $search_query->the_post();
            
            $excerpt = get_the_excerpt();
            if (empty($excerpt)) {
                $excerpt = wp_trim_words(get_the_content(), 20);
            }
            
            $results[] = array(
                'title' => get_the_title(),
                'url' => get_permalink(),
                'excerpt' => $excerpt,
                'type' => get_post_type()
            );
        }
        wp_reset_postdata();
    }
    
    // Search custom post types if they exist
    $custom_post_types = array('program', 'campus', 'faculty');
    foreach ($custom_post_types as $post_type) {
        if (post_type_exists($post_type)) {
            $custom_args = array(
                'post_type' => $post_type,
                'post_status' => 'publish',
                's' => $query,
                'posts_per_page' => 3
            );
            
            $custom_query = new WP_Query($custom_args);
            
            if ($custom_query->have_posts()) {
                while ($custom_query->have_posts()) {
                    $custom_query->the_post();
                    
                    $excerpt = get_the_excerpt();
                    if (empty($excerpt)) {
                        $excerpt = wp_trim_words(get_the_content(), 20);
                    }
                    
                    $results[] = array(
                        'title' => get_the_title(),
                        'url' => get_permalink(),
                        'excerpt' => $excerpt,
                        'type' => $post_type
                    );
                }
                wp_reset_postdata();
            }
        }
    }
    
    // Debug: Log results count
    error_log('Results count: ' . count($results));
    
    // Limit results to 8 total
    $results = array_slice($results, 0, 8);
    
    wp_send_json_success($results);
}
add_action('wp_ajax_unitek_live_search', 'unitek_live_search');
add_action('wp_ajax_nopriv_unitek_live_search', 'unitek_live_search');

/**
 * Load the search template even when the query string is empty (?s=)
 */
add_action('template_redirect', function() {
    if (isset($_GET['s']) && $_GET['s'] === '') {
        // Force search template
        load_template(get_query_template('search'));
        exit;
    }
});

/**
 * Broaden front-end search to posts, pages and CPT(s)
 */
function unitek_search_filter($query) {
    if ($query->is_search && !is_admin() && $query->is_main_query()) {
        // Search across multiple post types; extend as needed
        $query->set('post_type', array('post', 'page', 'program'));
    }
    return $query;
}
add_filter('pre_get_posts', 'unitek_search_filter');

/**
 * Optional: include custom fields/meta values in search matching (ACF etc.)
 */
function unitek_search_meta_fields($search, $query) {
    global $wpdb;

    if ($query->is_search && !is_admin() && $query->is_main_query()) {
        $search_term = $query->get('s');
        if (!empty($search_term)) {
            $like = '%' . $wpdb->esc_like($search_term) . '%';
            $fragment = $wpdb->prepare(
                " AND (({$wpdb->posts}.post_title LIKE %s) OR ({$wpdb->posts}.post_content LIKE %s) OR (meta.meta_value LIKE %s))",
                $like,
                $like,
                $like
            );
            // Append to existing search clause instead of replacing it
            $search .= $fragment;
        }
    }
    return $search;
}
add_filter('posts_search', 'unitek_search_meta_fields', 10, 2);

function unitek_search_join_meta($join, $query) {
    global $wpdb;
    if ($query->is_search && !is_admin() && $query->is_main_query()) {
        $join .= " LEFT JOIN {$wpdb->postmeta} meta ON {$wpdb->posts}.ID = meta.post_id ";
    }
    return $join;
}
add_filter('posts_join', 'unitek_search_join_meta', 10, 2);

function unitek_search_distinct($distinct, $query) {
    if ($query->is_search && !is_admin() && $query->is_main_query()) {
        return 'DISTINCT';
    }
    return $distinct;
}
add_filter('posts_distinct', 'unitek_search_distinct', 10, 2);

/**
 * AJAX Handler for Blog Category Filtering
 */
function filter_blog_posts_ajax() {
    // Get category from request
    $category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : 'all';
    $paged = isset($_GET['paged']) ? absint($_GET['paged']) : 1;
    
    // Query arguments
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 9,
        'paged' => $paged,
        'post_status' => 'publish'
    );
    
    // Add category filter if not "all"
    if ($category !== 'all') {
        $args['category_name'] = $category;
    }
    
    // The Query
    $blog_query = new WP_Query($args);
    
    // Start output buffering
    ob_start();
    
    if ($blog_query->have_posts()) :
        $animation_delay = 0;
        while ($blog_query->have_posts()) : $blog_query->the_post();
            // Get post categories
            $post_categories = get_the_category();
            
            // Determine which category to display
            $display_category_name = 'Uncategorized';
            
            if (!empty($post_categories)) {
                // If a specific category is filtered and post has that category, show it
                if ($category !== 'all') {
                    foreach ($post_categories as $cat) {
                        if ($cat->slug === $category) {
                            $display_category_name = $cat->name;
                            break;
                        }
                    }
                    // If filtered category not found in post's categories, show first one
                    if ($display_category_name === 'Uncategorized') {
                        $display_category_name = $post_categories[0]->name;
                    }
                } else {
                    // No filter active, show first category
                    $display_category_name = $post_categories[0]->name;
                }
            }
            
            // Get author name
            $author_name = get_the_author();
    ?>
        <article class="article-card" style="opacity: 0; transform: translateY(20px); transition: opacity 0.5s ease-out <?php echo $animation_delay; ?>s, transform 0.5s ease-out <?php echo $animation_delay; ?>s;" data-categories="<?php echo esc_attr(implode(',', array_map(function($cat) { return $cat->slug; }, $post_categories))); ?>">
          <div class="article-card__tag">
            <span class="label"><?php echo esc_html($display_category_name); ?></span>
          </div>
          <div class="article-card__image" role="img" aria-label="Article featured image">
            <?php if (has_post_thumbnail()) : ?>
              <?php the_post_thumbnail('medium', array('alt' => get_the_title())); ?>
            <?php endif; ?>
          </div>
          <div class="article-card__overlay">
            <div class="article-card__meta">
              <span class="article-card__date"><?php echo get_the_date('F j, Y'); ?></span>
              <span class="article-card__divider"></span>
              <span class="article-card__author"><?php echo esc_html($author_name); ?></span>
            </div>
            <h3 class="article-card__title">
              <?php echo wp_trim_words(get_the_title(), 12, '...'); ?>
            </h3>
            <a href="<?php the_permalink(); ?>" class="article-card__footer">
              <span>Read more</span>
              <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 10h12m0 0l-4-4m4 4l-4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </a>
          </div>
        </article>
    <?php 
        $animation_delay += 0.1;
        endwhile;
        wp_reset_postdata();
    else : 
    ?>
        <p style="grid-column: 1 / -1; text-align: center; padding: 40px; font-family: 'Outfit', sans-serif; font-size: 18px; color: #68747C;">
          No articles found in this category.
        </p>
    <?php 
    endif;
    
    $html = ob_get_clean();
    
    // Load more button HTML
    $load_more_html = '';
    if ($blog_query->max_num_pages > 1 && $paged < $blog_query->max_num_pages) {
        $next_page = $paged + 1;
        ob_start();
        ?>
        <a href="#" class="btn-link load-more-btn" data-page="<?php echo $next_page; ?>" data-category="<?php echo esc_attr($category); ?>" aria-label="Load more articles">
            Load more stories
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4 10h12m0 0l-4-4m4 4l-4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
        <?php
        $load_more_html = ob_get_clean();
    }
    
    // Return JSON response
    wp_send_json_success(array(
        'html' => $html,
        'has_more' => $blog_query->max_num_pages > $paged,
        'load_more_html' => $load_more_html,
        'total_posts' => $blog_query->found_posts,
        'max_pages' => $blog_query->max_num_pages
    ));
}
add_action('wp_ajax_filter_blog_posts', 'filter_blog_posts_ajax');
add_action('wp_ajax_nopriv_filter_blog_posts', 'filter_blog_posts_ajax');

/**
 * AJAX Handler for Inline Blog Search
 */
function blog_inline_search_posts() {
    // Get search query and category from request
    $search_query = isset($_GET['query']) ? sanitize_text_field($_GET['query']) : '';
    $category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : 'all';
    
    // Validate search query
    if (empty($search_query) || strlen($search_query) < 2) {
        wp_send_json_error('Search query too short');
        return;
    }
    
    // Query arguments
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 9,
        'post_status' => 'publish',
        's' => $search_query
    );
    
    // Add category filter if not "all"
    if ($category !== 'all') {
        $args['category_name'] = $category;
    }
    
    // The Query
    $search_results = new WP_Query($args);
    
    // Start output buffering
    ob_start();
    
    if ($search_results->have_posts()) :
        $animation_delay = 0;
        while ($search_results->have_posts()) : $search_results->the_post();
            // Get post categories
            $post_categories = get_the_category();
            
            // Determine which category to display
            $display_category_name = 'Uncategorized';
            
            if (!empty($post_categories)) {
                // If a specific category is filtered and post has that category, show it
                if ($category !== 'all') {
                    foreach ($post_categories as $cat) {
                        if ($cat->slug === $category) {
                            $display_category_name = $cat->name;
                            break;
                        }
                    }
                    // If filtered category not found in post's categories, show first one
                    if ($display_category_name === 'Uncategorized') {
                        $display_category_name = $post_categories[0]->name;
                    }
                } else {
                    // No filter active, show first category
                    $display_category_name = $post_categories[0]->name;
                }
            }
            
            // Get author name
            $author_name = get_the_author();
    ?>
        <article class="article-card" style="opacity: 0; transform: translateY(20px); transition: opacity 0.5s ease-out <?php echo $animation_delay; ?>s, transform 0.5s ease-out <?php echo $animation_delay; ?>s;" data-categories="<?php echo esc_attr(implode(',', array_map(function($cat) { return $cat->slug; }, $post_categories))); ?>">
          <div class="article-card__tag">
            <span class="label"><?php echo esc_html($display_category_name); ?></span>
          </div>
          <div class="article-card__image" role="img" aria-label="Article featured image">
            <?php if (has_post_thumbnail()) : ?>
              <?php the_post_thumbnail('medium', array('alt' => get_the_title())); ?>
            <?php endif; ?>
          </div>
          <div class="article-card__overlay">
            <div class="article-card__meta">
              <span class="article-card__date"><?php echo get_the_date('F j, Y'); ?></span>
              <span class="article-card__divider"></span>
              <span class="article-card__author"><?php echo esc_html($author_name); ?></span>
            </div>
            <h3 class="article-card__title">
              <?php echo wp_trim_words(get_the_title(), 12, '...'); ?>
            </h3>
            <a href="<?php the_permalink(); ?>" class="article-card__footer">
              <span>Read more</span>
              <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 10h12m0 0l-4-4m4 4l-4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </a>
          </div>
        </article>
    <?php 
        $animation_delay += 0.1;
        endwhile;
        wp_reset_postdata();
    else : 
    ?>
        <p style="grid-column: 1 / -1; text-align: center; padding: 40px; font-family: 'Outfit', sans-serif; font-size: 18px; color: #68747C;">
          No articles found matching "<?php echo esc_html($search_query); ?>"<?php echo ($category !== 'all') ? ' in this category' : ''; ?>.
        </p>
    <?php 
    endif;
    
    $html = ob_get_clean();
    
    // Return JSON response
    wp_send_json_success(array(
        'html' => $html,
        'total_posts' => $search_results->found_posts,
        'search_query' => $search_query
    ));
}
add_action('wp_ajax_blog_inline_search_posts', 'blog_inline_search_posts');
add_action('wp_ajax_nopriv_blog_inline_search_posts', 'blog_inline_search_posts');

/**
 * Featured Post Functionality
 * Add a "Featured" column to posts list with checkbox toggle
 */

// Add "Featured" column to posts list
function add_featured_post_column($columns) {
    $columns['featured_post'] = __('Featured', 'unitek-college');
    return $columns;
}
add_filter('manage_posts_columns', 'add_featured_post_column');

// Display checkbox in the column
function show_featured_post_column($column, $post_id) {
    if ($column === 'featured_post') {
        $is_featured = get_post_meta($post_id, '_is_featured', true);
        $checked = $is_featured ? 'checked' : '';
        echo '<input type="checkbox" class="toggle-featured" data-post-id="' . esc_attr($post_id) . '" ' . $checked . ' />';
    }
}
add_action('manage_posts_custom_column', 'show_featured_post_column', 10, 2);

// Add column width
function featured_post_column_style() {
    echo '<style>.column-featured_post {width:80px;text-align:center}</style>';
}
add_action('admin_head', 'featured_post_column_style');

// Add AJAX Toggle Script (So it works instantly)
function featured_post_admin_script() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            $('.toggle-featured').on('change', function(){
                var post_id = $(this).data('post-id');
                var is_featured = $(this).is(':checked') ? 1 : 0;

                $.post(ajaxurl, {
                    action: 'toggle_featured_post',
                    post_id: post_id,
                    is_featured: is_featured,
                    _ajax_nonce: '<?php echo wp_create_nonce("toggle_featured_post_nonce"); ?>'
                }, function(response){
                    if(!response.success) alert('Error: ' + response.data);
                });
            });
        });
    </script>
    <?php
}
add_action('admin_footer-edit.php', 'featured_post_admin_script');

// Handle the AJAX Request
function toggle_featured_post_callback() {
    check_ajax_referer('toggle_featured_post_nonce');

    $post_id = intval($_POST['post_id']);
    $is_featured = intval($_POST['is_featured']);

    if (!current_user_can('edit_post', $post_id)) {
        wp_send_json_error('Permission denied');
    }

    update_post_meta($post_id, '_is_featured', $is_featured);
    wp_send_json_success();
}
add_action('wp_ajax_toggle_featured_post', 'toggle_featured_post_callback');


/**
 * Automatically clean HTML entities from post titles when saving
 * Converts &nbsp; to regular spaces and other HTML entities to their proper characters
 */
function unitek_clean_post_title_on_save($data, $postarr) {
    // Only process if we have a title
    if (!empty($data['post_title'])) {
        // Decode HTML entities (converts &nbsp; to actual non-breaking space, &amp; to &, etc.)
        $cleaned_title = html_entity_decode($data['post_title'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        
        // Replace non-breaking spaces with regular spaces for better readability
        $cleaned_title = str_replace("\xC2\xA0", ' ', $cleaned_title); // UTF-8 non-breaking space
        $cleaned_title = str_replace('&nbsp;', ' ', $cleaned_title); // In case any remain
        
        // Remove any multiple spaces and trim
        $cleaned_title = preg_replace('/\s+/', ' ', $cleaned_title);
        $cleaned_title = trim($cleaned_title);
        
        // Update the title
        $data['post_title'] = $cleaned_title;
    }
    
    return $data;
}
add_filter('wp_insert_post_data', 'unitek_clean_post_title_on_save', 10, 2);
add_shortcode('html_sitemap', 'htmlSitemap');

function htmlSitemap() {
    ob_start();

    $excludesIds = get_posts([
        'post_type'      => 'page',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'fields'         => 'ids',
        'meta_query'     => [
            [
                'key'     => '_yoast_wpseo_meta-robots-noindex',
                'value'   => '1',
                'compare' => '='
            ]
        ]
    ]);

    $excludesIds = implode(',', $excludesIds);

    echo '<div class="html-sitemap">';

    echo '<h2>Pages</h2>';
    echo '<ul>';
    wp_list_pages([
        'exclude'   => $excludesIds,
        'title_li'  => '',
        'depth'     => 0,       // keep hierarchy
        'sort_column' => 'menu_order'
    ]);
    echo '</ul>';

    $posts = get_posts([
        'post_type'      => 'post',
        'posts_per_page' => -1
    ]);

    echo '<h2>Blog Posts</h2>';
    echo '<ul>';
    foreach ( $posts as $post ) {
        echo '<li><a href="' . get_permalink($post->ID) . '">' . esc_html($post->post_title) . '</a></li>';
    }
    echo '</ul>';

    echo '</div>';

    return ob_get_clean();
}
add_action( 'template_redirect', function() {
 
    // Only on frontend, only when it's a 404
    if ( is_404() && ! is_admin() ) {
 
        // URL of your custom 404 page
        $url = home_url( '/404-error/' );
 
        // Optional: keep it as 404 in browser (better for SEO)
        status_header( 404 );
 
        // Show the page content instead of default 404 template
        wp_redirect( $url, 302 );
        exit;
    }
});