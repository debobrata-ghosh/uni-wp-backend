<?php
// Get the field values
$heading = get_field('unitek_advantage_heading');
$subheading = get_field('unitek_advantage_subheading');
$body_text = get_field('unitek_advantage_body_text');
$features = get_field('unitek_advantage_features');
$cta_text = get_field('unitek_advantage_cta_text');
$cta_url = get_field('unitek_advantage_cta_url');

// Function to get colors based on thumbnail selection
if (!function_exists('get_testimonial_colors_by_thumbnail')) {
function get_testimonial_colors_by_thumbnail($thumbnail) {
    $color_map = array(
        'thumbnail_1' => array(
            'bg' => '#28323C',      // Dark Grey
            'font' => '#00A3E0'     // Light Blue
        ),
        'thumbnail_2' => array(
            'bg' => '#0072CE',      // Dark Blue
            'font' => '#00A3E0'     // Light Blue
        ),
        'thumbnail_3' => array(
            'bg' => '#28323C',      // Dark Grey
            'font' => '#B4E850'     // Light Green
        ),
        'thumbnail_4' => array(
            'bg' => '#00A3E0',      // Bright Blue
            'font' => '#FFFFFF'     // White
        ),
        'thumbnail_5' => array(
            'bg' => '#B4E850',      // Light Green
            'font' => '#FFFFFF'     // White
        ),
        'thumbnail_6' => array(
            'bg' => '#B4E850',      // Light Green
            'font' => '#28323C'     // Dark Grey
        ),
    );
    
    return $color_map[$thumbnail] ?? array('bg' => '#B4E850', 'font' => '#28323C');
}
}

// Get category, thumbnail style, number of posts, and order from block field
$selected_category = get_field('unitek_advantage_testimonial_category');
$thumbnail_style = get_field('unitek_advantage_testimonial_thumbnail') ?: 'thumbnail_1';
$number_of_posts = get_field('unitek_advantage_testimonial_number') ?: 5;
$display_order = get_field('unitek_advantage_testimonial_order') ?: 'DESC';
$testimonials = array();

// Validate number of posts (1-10)
$number_of_posts = max(1, min(10, intval($number_of_posts)));

// Validate order (ASC or DESC)
$display_order = in_array($display_order, array('ASC', 'DESC')) ? $display_order : 'DESC';

// Get colors based on selected thumbnail style (same for all testimonials)
$colors = get_testimonial_colors_by_thumbnail($thumbnail_style);
$testimonial_bg_color = $colors['bg'];
$testimonial_font_color = $colors['font'];

if ($selected_category) {
    // Get testimonials from the selected category
    $category_query = new WP_Query(array(
        'post_type' => 'testimonials',
        'posts_per_page' => $number_of_posts,
        'post_status' => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'testimonial_category',
                'field' => 'term_id',
                'terms' => $selected_category,
            ),
        ),
        'orderby' => 'date',
        'order' => $display_order
    ));
    
    if ($category_query->have_posts()) {
        while ($category_query->have_posts()) {
            $category_query->the_post();
            $testimonial_id = get_the_ID();
            $testimonial_text = get_field('field_testimonial_text', $testimonial_id);
            $testimonial_name = get_field('field_testimonial_name', $testimonial_id);
            $testimonial_title = get_field('field_testimonial_title', $testimonial_id);
            
            if (!empty($testimonial_text) && !empty($testimonial_name)) {
                $testimonials[] = array(
                    'testimonial_text' => $testimonial_text,
                    'testimonial_name' => $testimonial_name,
                    'testimonial_title' => $testimonial_title ?: '',
                    'testimonial_color' => $testimonial_bg_color,
                    'testimonial_font_color' => $testimonial_font_color
                );
            }
        }
        wp_reset_postdata();
    }
} else {
    // Fallback: Get testimonials from custom post type
    $testimonials_query = new WP_Query(array(
        'post_type' => 'testimonials',
        'posts_per_page' => 5,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
    ));
    
    if ($testimonials_query->have_posts()) {
        while ($testimonials_query->have_posts()) {
            $testimonials_query->the_post();
            $testimonial_id = get_the_ID();
            $testimonial_text = get_field('field_testimonial_text', $testimonial_id);
            $testimonial_name = get_field('field_testimonial_name', $testimonial_id);
            $testimonial_title = get_field('field_testimonial_title', $testimonial_id);
            $testimonial_color = get_field('testimonial_color', $testimonial_id) ?: '#B4E850';
            $testimonial_font_color = get_field('testimonial_font_color', $testimonial_id) ?: '#28323C';
            
            if (!empty($testimonial_text) && !empty($testimonial_name)) {
                $testimonials[] = array(
                    'testimonial_text' => $testimonial_text,
                    'testimonial_name' => $testimonial_name,
                    'testimonial_title' => $testimonial_title ?: '',
                    'testimonial_color' => $testimonial_color,
                    'testimonial_font_color' => $testimonial_font_color
                );
            }
        }
        wp_reset_postdata();
    }
}

// Set default values if fields are empty
if (!$heading) {
    $heading = 'The Unitek advantage.';
}

if (!$subheading) {
    $subheading = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
}

if (!$body_text) {
    $body_text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.';
}

if (!$features || empty($features)) {
    $features = array(
        array('feature_title' => 'REAL-WORLD EXPERIENCE.', 'feature_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
        array('feature_title' => 'FLEXIBLE PROGRAMS.', 'feature_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
        array('feature_title' => 'CAREER SUPPORT.', 'feature_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
    );
}


// Get block attributes
$block_id = $block['id'] ?? '';
$block_class = $block['className'] ?? '';
$block_anchor = $block['anchor'] ?? '';

// Build CSS classes
$css_classes = array('unitek-advantage-block');
if ($block_class) {
    $css_classes[] = $block_class;
}
if ($block['align']) {
    $css_classes[] = 'align' . $block['align'];
}

$css_class_string = implode(' ', $css_classes);
?>

<section <?php if ($block_anchor): ?>id="<?php echo esc_attr($block_anchor); ?>"<?php endif; ?> 
         class="<?php echo esc_attr($css_class_string); ?>"
         role="region"
         aria-label="Unitek advantage section">
    
    <div class="unitek-advantage-content">
        <!-- Left Column - Content and Features -->
        <div class="unitek-advantage-left">
            <h2 class="unitek-advantage-heading"><?php echo esc_html($heading); ?></h2>
            
            <div class="unitek-advantage-subheading">
                <?php echo wp_kses_post($subheading); ?>
            </div>
            
            <div class="unitek-advantage-body-text">
                <?php echo wp_kses_post($body_text); ?>
            </div>
            
            <div class="unitek-advantage-features">
                <?php foreach ($features as $feature): ?>
                    <?php
                    $feature_title       = $feature['feature_title'] ?? '';
                    $feature_description = $feature['feature_description'] ?? '';
                    $feature_url         = $feature['feature_url'] ?? '';

                    // If a URL is provided, make the entire feature block a link so the ::after arrow is clickable.
                    $wrapper_tag   = $feature_url ? 'a' : 'div';
                    $wrapper_attrs = 'class="unitek-advantage-feature"';
                    if ($feature_url) {
                        // Check if URL is external or internal
                        $home_url = get_home_url();
                        $parsed_url = parse_url($feature_url);
                        $parsed_home = parse_url($home_url);
                        
                        // Determine if it's an external link
                        $is_external = false;
                        if (isset($parsed_url['host'])) {
                            // URL has a host, check if it's different from home URL
                            $is_external = ($parsed_url['host'] !== $parsed_home['host']);
                        } elseif (strpos($feature_url, 'http://') === 0 || strpos($feature_url, 'https://') === 0) {
                            // Full URL but parse_url might have failed, assume external
                            $is_external = true;
                        }
                        
                        // For internal links, prepend home URL if it's a relative path
                        if (!$is_external) {
                            if (strpos($feature_url, 'http://') !== 0 && strpos($feature_url, 'https://') !== 0) {
                                // Relative path, prepend home URL
                                $feature_url = rtrim($home_url, '/') . '/' . ltrim($feature_url, '/');
                            }
                            $wrapper_attrs .= ' href="' . esc_url($feature_url) . '"';
                        } else {
                            // External link, open in new tab
                            $wrapper_attrs .= ' href="' . esc_url($feature_url) . '" target="_blank" rel="noopener"';
                        }
                    }
                    ?>
                    <<?php echo $wrapper_tag . ' ' . $wrapper_attrs; ?>>
                        <h3 class="unitek-advantage-feature-title"><?php echo esc_html($feature_title); ?></h3>
                        <p class="unitek-advantage-feature-description"><?php echo esc_html($feature_description); ?></p>
                    </<?php echo $wrapper_tag; ?>>
                <?php endforeach; ?>
            </div>
            
            <?php if ($cta_text && $cta_url): ?>
                <div class="unitek-advantage-cta">
                    <a href="<?php echo esc_url($cta_url); ?>" class="unitek-advantage-cta-button">
                        <?php echo esc_html($cta_text); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Right Column - Testimonial Carousel -->
        <div class="unitek-advantage-right">
            <?php 
            $first_testimonial_color = !empty($testimonials) ? ($testimonials[0]['testimonial_color'] ?? '#B4E850') : '#B4E850';
            $first_testimonial_font_color = !empty($testimonials) ? ($testimonials[0]['testimonial_font_color'] ?? '#28323C') : '#28323C';
            ?>
            <div class="unitek-advantage-testimonial" 
                 style="background-color: <?php echo esc_attr($first_testimonial_color); ?>;"
                 data-thumbnail-style="<?php echo esc_attr($thumbnail_style); ?>"
                 data-bg-color="<?php echo esc_attr($first_testimonial_color); ?>"
                 data-font-color="<?php echo esc_attr($first_testimonial_font_color); ?>">
                <div class="unitek-advantage-testimonial-carousel">
                    <?php foreach ($testimonials as $index => $testimonial): ?>
                        <?php 
                        $testimonial_color = $testimonial['testimonial_color'] ?? '#B4E850';
                        $testimonial_font_color = $testimonial['testimonial_font_color'] ?? '#28323C';
                        $is_active = $index === 0;
                        ?>
                        <div class="unitek-advantage-testimonial-slide <?php echo $is_active ? 'active' : ''; ?>" 
                             data-color="<?php echo esc_attr($testimonial_color); ?>"
                             data-font-color="<?php echo esc_attr($testimonial_font_color); ?>"
                             <?php if ($is_active): ?>
                             style="color: <?php echo esc_attr($testimonial_font_color); ?>;"
                             <?php endif; ?>>
                            <div class="unitek-advantage-testimonial-quote" <?php if ($is_active): ?>style="color: <?php echo esc_attr($testimonial_font_color); ?>;"<?php endif; ?>>"</div>
                            <p class="unitek-advantage-testimonial-text" <?php if ($is_active): ?>style="color: <?php echo esc_attr($testimonial_font_color); ?>;"<?php endif; ?>><?php echo esc_html($testimonial['testimonial_text'] ?? ''); ?></p>
                            <div class="unitek-advantage-testimonial-author">
                                <div class="unitek-advantage-testimonial-name" <?php if ($is_active): ?>style="color: <?php echo esc_attr($testimonial_font_color); ?>;"<?php endif; ?>><?php echo esc_html($testimonial['testimonial_name'] ?? ''); ?></div>
                                <div class="unitek-advantage-testimonial-title" <?php if ($is_active): ?>style="color: <?php echo esc_attr($testimonial_font_color); ?>;"<?php endif; ?>><?php echo esc_html($testimonial['testimonial_title'] ?? ''); ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Pagination Dots - Only show if testimonials exist from custom post type -->
                <?php if (!empty($testimonials)): ?>
                <div class="unitek-advantage-testimonial-pagination">
                    <?php foreach ($testimonials as $index => $testimonial): ?>
                        <?php 
                        $dot_font_color = $testimonial['testimonial_font_color'] ?? '#28323C';
                        $dot_style = '';
                        if ($index === 0) {
                            $dot_style = 'background-color: ' . esc_attr($dot_font_color) . ';';
                        } else {
                            // Convert hex to rgba for transparency (30% opacity)
                            $r = hexdec(substr($dot_font_color, 1, 2));
                            $g = hexdec(substr($dot_font_color, 3, 2));
                            $b = hexdec(substr($dot_font_color, 5, 2));
                            $dot_style = 'background-color: rgba(' . $r . ', ' . $g . ', ' . $b . ', 0.3);';
                        }
                        ?>
                        <div class="unitek-advantage-testimonial-dot <?php echo $index === 0 ? 'active' : ''; ?>" 
                             data-slide="<?php echo $index; ?>"
                             style="<?php echo $dot_style; ?>"></div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
