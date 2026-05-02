<?php
// Get the field values
$headline = get_field('healthcare_headline');
$program_tabs = get_field('program_tabs');
$all_programs_link = get_field('all_programs_link');

// Story Card fields
$story_card_heading = get_field('story_card_heading');
$story_card_description = get_field('story_card_description');
$story_card_link = get_field('story_card_link');
$story_card_link_text = get_field('story_card_link_text');
$story_card_background_image = get_field('story_card_background_image');

// Validate required fields but do not block rendering/preview
$required_fields = array(
    'healthcare_headline' => 'Headline'
);
unitek_college_validate_block_fields($required_fields, 'Healthcare Programs Block');


// Set default values if fields are empty
if (is_admin() && !$headline) {
    $headline = 'Healthcare programs focused on your future.';
}

// Story Card defaults for editor preview
if (is_admin() && !$story_card_heading) {
    $story_card_heading = 'NURSING NEEDS YOU.';
}
if (is_admin() && !$story_card_description) {
    $story_card_description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.';
}
if (is_admin() && !$story_card_link_text) {
    $story_card_link_text = 'Watch the story';
}

// Helper function to extract string value from ACF field (handles arrays, objects, etc.)

if (!function_exists('extract_acf_string_value')) {
function extract_acf_string_value($value) {
    if (is_string($value) && trim($value) !== '') {
        return trim($value);
    }
    if (is_array($value)) {
        // If it's an array, get the first non-empty string value
        foreach ($value as $item) {
            if (is_string($item) && trim($item) !== '') {
                return trim($item);
            }
            if (is_array($item) || is_object($item)) {
                $nested = extract_acf_string_value($item);
                if (!empty($nested)) {
                    return $nested;
                }
            }
        }
        // If array has numeric keys, try first element
        if (isset($value[0])) {
            if (is_string($value[0])) {
                return trim($value[0]);
            }
        }
    }
    if (is_object($value)) {
        // If it's an object, try to get a string property
        if (isset($value->value) && is_string($value->value)) {
            return trim($value->value);
        }
        if (isset($value->text) && is_string($value->text)) {
            return trim($value->text);
        }
    }
    return '';
}
}


// Helper function to get testimonial data for a tab
if (!function_exists('get_testimonial_data_for_tab')) {
function get_testimonial_data_for_tab($tab, $repeater_row_index = null) {
    global $post;
    $testimonial_post_id = null;
    $testimonial_text = '';
    $testimonial_name = '';
    $testimonial_title = '';
    
    // Get the current block/post ID to read repeater field directly
    $block_post_id = $post->ID ?? get_the_ID();
    
    // Priority 1: Check if specific testimonial is selected on this repeater row
    $selected_testimonial = $tab['tab_testimonial'] ?? null;
    
    // Also try to get the raw value directly from post meta if we have the row index
    if ($repeater_row_index !== null && function_exists('get_field')) {
        // Try to get the raw value directly from the repeater field
        $raw_testimonial_value = get_field('program_tabs', $block_post_id);
        if (is_array($raw_testimonial_value) && isset($raw_testimonial_value[$repeater_row_index])) {
            $raw_row = $raw_testimonial_value[$repeater_row_index];
            if (isset($raw_row['tab_testimonial'])) {
                $raw_testimonial = $raw_row['tab_testimonial'];
                // Use raw value if it's different
                if (!empty($raw_testimonial)) {
                    $selected_testimonial = $raw_testimonial;
                }
            }
        }
        
        // Also try direct post meta lookup for this specific repeater row
        // ACF stores repeater sub-fields as: {repeater_name}_{row_index}_{sub_field_name}
        $repeater_meta_key = 'program_tabs_' . $repeater_row_index . '_tab_testimonial';
        $direct_meta_value = get_post_meta($block_post_id, $repeater_meta_key, true);
        if (!empty($direct_meta_value) && is_numeric($direct_meta_value)) {
            $selected_testimonial = (int) $direct_meta_value;
        }
    }
    
    if (!empty($selected_testimonial)) {
        // Handle different return formats (ID, object, array)
        if (is_numeric($selected_testimonial)) {
            $testimonial_post_id = (int) $selected_testimonial;
        } elseif (is_object($selected_testimonial) && isset($selected_testimonial->ID)) {
            $testimonial_post_id = (int) $selected_testimonial->ID;
        } elseif (is_array($selected_testimonial)) {
            $first_item = reset($selected_testimonial);
            if (is_numeric($first_item)) {
                $testimonial_post_id = (int) $first_item;
            } elseif (is_object($first_item) && isset($first_item->ID)) {
                $testimonial_post_id = (int) $first_item->ID;
            }
        }
    }
    
    // Priority 2: Fallback to category-based selection if no specific testimonial selected
    if (empty($testimonial_post_id)) {
        $selected_testimonial_category = $tab['healthcare_testimonial_category'] ?? null;
        
        // Handle ACF taxonomy field - it might return array, object, or ID
        $category_term_id = null;
        if (!empty($selected_testimonial_category)) {
            if (is_array($selected_testimonial_category)) {
                $first_item = reset($selected_testimonial_category);
                if (is_object($first_item) && isset($first_item->term_id)) {
                    $category_term_id = $first_item->term_id;
                } elseif (is_numeric($first_item)) {
                    $category_term_id = (int) $first_item;
                }
            } elseif (is_object($selected_testimonial_category) && isset($selected_testimonial_category->term_id)) {
                $category_term_id = $selected_testimonial_category->term_id;
            } elseif (is_numeric($selected_testimonial_category)) {
                $category_term_id = (int) $selected_testimonial_category;
            }
        }
        
        // Query testimonials by category if category is selected
        if (!empty($category_term_id)) {
            $testimonial_query_args = array(
                'post_type'      => 'testimonials',
                'posts_per_page' => 1,
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'testimonial_category',
                        'field'    => 'term_id',
                        'terms'    => $category_term_id,
                    ),
                ),
            );
            
            $testimonial_query = new WP_Query($testimonial_query_args);
            if ($testimonial_query->have_posts()) {
                $testimonial_query->the_post();
                $testimonial_post_id = get_the_ID();
                wp_reset_postdata();
            }
        }
    }
    
    // Get ACF fields from the testimonial post
    if (!empty($testimonial_post_id)) {
        // Verify post exists and is correct post type
        $post_obj = get_post($testimonial_post_id);
        if (!$post_obj) {
            // Post doesn't exist - return empty
            return array(
                'tab_testimonial_text'  => '',
                'tab_testimonial_name'  => '',
                'tab_testimonial_title' => '',
            );
        }
        
        // ACF field keys: field_testimonial_text, field_testimonial_name, field_testimonial_title
        // ACF field names: testimonial_text, testimonial_name, testimonial_title
        
        // Priority 1: Try get_field() with field name (ACF function - most reliable)
        // This handles all ACF storage formats automatically
        if (function_exists('get_field')) {
            $testimonial_text_raw = get_field('field_testimonial_text', $testimonial_post_id);
            $testimonial_name_raw = get_field('field_testimonial_name', $testimonial_post_id);
            $testimonial_title_raw = get_field('field_testimonial_title', $testimonial_post_id);
            
            // Extract string values from arrays/objects
            $testimonial_text = extract_acf_string_value($testimonial_text_raw);
            $testimonial_name = extract_acf_string_value($testimonial_name_raw);
            $testimonial_title = extract_acf_string_value($testimonial_title_raw);
            
            // If get_field returns false/null, try with format_value = false to get raw value
            if (empty($testimonial_text)) {
                $testimonial_text_raw = get_field('testimonial_text', $testimonial_post_id, false);
                $testimonial_text = extract_acf_string_value($testimonial_text_raw);
            }
            if (empty($testimonial_name)) {
                $testimonial_name_raw = get_field('testimonial_name', $testimonial_post_id, false);
                $testimonial_name = extract_acf_string_value($testimonial_name_raw);
            }
            if (empty($testimonial_title)) {
                $testimonial_title_raw = get_field('testimonial_title', $testimonial_post_id, false);
                $testimonial_title = extract_acf_string_value($testimonial_title_raw);
            }
        }
        
        // Priority 2: Try get_fields() to get all fields at once
        if ((empty($testimonial_text) || empty($testimonial_name) || empty($testimonial_title)) && function_exists('get_fields')) {
            $testimonial_acf = get_fields($testimonial_post_id, false); // false = get raw values
            if (is_array($testimonial_acf) && !empty($testimonial_acf)) {
                if (empty($testimonial_text)) {
                    $testimonial_text = extract_acf_string_value($testimonial_acf['testimonial_text'] ?? '');
                }
                if (empty($testimonial_name)) {
                    $testimonial_name = extract_acf_string_value($testimonial_acf['testimonial_name'] ?? '');
                }
                if (empty($testimonial_title)) {
                    $testimonial_title = extract_acf_string_value($testimonial_acf['testimonial_title'] ?? '');
                }
            }
        }
        
        // Priority 3: Get directly from post meta using field NAME (standard ACF storage)
        // ACF stores values in meta keys matching the field NAME, not the field KEY
        if (empty($testimonial_text)) {
            $testimonial_text_raw = get_post_meta($testimonial_post_id, 'testimonial_text', true);
            $testimonial_text = extract_acf_string_value($testimonial_text_raw);
            // Also try with single=false to get all values if it's an array
            if (empty($testimonial_text)) {
                $testimonial_text_raw = get_post_meta($testimonial_post_id, 'testimonial_text', false);
                $testimonial_text = extract_acf_string_value($testimonial_text_raw);
            }
        }
        if (empty($testimonial_name)) {
            $testimonial_name_raw = get_post_meta($testimonial_post_id, 'testimonial_name', true);
            $testimonial_name = extract_acf_string_value($testimonial_name_raw);
            if (empty($testimonial_name)) {
                $testimonial_name_raw = get_post_meta($testimonial_post_id, 'testimonial_name', false);
                $testimonial_name = extract_acf_string_value($testimonial_name_raw);
            }
        }
        if (empty($testimonial_title)) {
            $testimonial_title_raw = get_post_meta($testimonial_post_id, 'testimonial_title', true);
            $testimonial_title = extract_acf_string_value($testimonial_title_raw);
            if (empty($testimonial_title)) {
                $testimonial_title_raw = get_post_meta($testimonial_post_id, 'testimonial_title', false);
                $testimonial_title = extract_acf_string_value($testimonial_title_raw);
            }
        }
        
        // Direct database query as last resort to see what's actually stored
        if ((empty($testimonial_text) || empty($testimonial_name) || empty($testimonial_title))) {
            global $wpdb;
            $meta_keys = array('testimonial_text', 'testimonial_name', 'testimonial_title', 
                              'field_testimonial_text', 'field_testimonial_name', 'field_testimonial_title');
            $placeholders = implode(',', array_fill(0, count($meta_keys), '%s'));
            $meta_values = $wpdb->get_results($wpdb->prepare(
                "SELECT meta_key, meta_value FROM {$wpdb->postmeta} WHERE post_id = %d AND meta_key IN ($placeholders)",
                array_merge(array($testimonial_post_id), $meta_keys)
            ));
            
            foreach ($meta_values as $meta) {
                if ($meta->meta_key === 'testimonial_text' && empty($testimonial_text) && !empty($meta->meta_value)) {
                    $testimonial_text = extract_acf_string_value($meta->meta_value);
                } elseif ($meta->meta_key === 'testimonial_name' && empty($testimonial_name) && !empty($meta->meta_value)) {
                    $testimonial_name = extract_acf_string_value($meta->meta_value);
                } elseif ($meta->meta_key === 'testimonial_title' && empty($testimonial_title) && !empty($meta->meta_value)) {
                    $testimonial_title = extract_acf_string_value($meta->meta_value);
                }
            }
        }
        
        // Priority 4: Get directly from post meta using field KEY
        // Note: field_ keys usually contain field references, but checking just in case
        if (empty($testimonial_text)) {
            $field_value = get_post_meta($testimonial_post_id, 'field_testimonial_text', true);
            $testimonial_text = extract_acf_string_value($field_value);
        }
        if (empty($testimonial_name)) {
            $field_value = get_post_meta($testimonial_post_id, 'field_testimonial_name', true);
            $testimonial_name = extract_acf_string_value($field_value);
        }
        if (empty($testimonial_title)) {
            $field_value = get_post_meta($testimonial_post_id, 'field_testimonial_title', true);
            $testimonial_title = extract_acf_string_value($field_value);
        }
    }
    
    // Ensure values are strings (handle arrays, objects, null/false)
    // Use extract_acf_string_value to handle arrays/objects properly
    $testimonial_text = extract_acf_string_value($testimonial_text);
    $testimonial_name = extract_acf_string_value($testimonial_name);
    $testimonial_title = extract_acf_string_value($testimonial_title);
    
    // Final fallback: convert to string if still not a string
    if (!is_string($testimonial_text)) {
        $testimonial_text = ($testimonial_text !== false && $testimonial_text !== null) ? trim((string) $testimonial_text) : '';
    }
    if (!is_string($testimonial_name)) {
        $testimonial_name = ($testimonial_name !== false && $testimonial_name !== null) ? trim((string) $testimonial_name) : '';
    }
    if (!is_string($testimonial_title)) {
        $testimonial_title = ($testimonial_title !== false && $testimonial_title !== null) ? trim((string) $testimonial_title) : '';
    }
    
    return array(
        'tab_testimonial_text'  => $testimonial_text,
        'tab_testimonial_name'  => $testimonial_name,
        'tab_testimonial_title' => $testimonial_title,
    );
}
}

// Use only ACF data - no default fallback
if (!$program_tabs || empty($program_tabs)) {
    $program_tabs = array();
} else {
    // Remove duplicates based on tab_name (more thorough)
    $unique_tabs = array();
    $seen_names = array();
    
    foreach ($program_tabs as $index => $tab) {
        $tab_name = trim($tab['tab_name'] ?? '');
        $tab_name_clean = strtolower(preg_replace('/\s+/', ' ', $tab_name)); // Normalize spaces
        
        if (!empty($tab_name) && !in_array($tab_name_clean, $seen_names)) {
            // Fetch and add testimonial data for this tab
            $testimonial_data = get_testimonial_data_for_tab($tab, $index);
            $tab = array_merge($tab, $testimonial_data);
            
            $unique_tabs[] = $tab;
            $seen_names[] = $tab_name_clean;
        }
    }
    
    $program_tabs = $unique_tabs;
}

// Get first tab as active tab
$active_tab = null;
if (!empty($program_tabs)) {
    $active_tab = $program_tabs[0];
}

// Get block attributes
$block_id = $block['id'] ?? '';
$block_class = $block['className'] ?? '';
$block_anchor = $block['anchor'] ?? '';

// Build CSS classes
$css_classes = array('healthcare-programs-block');
if ($block_class) {
    $css_classes[] = $block_class;
}
if ($block['align']) {
    $css_classes[] = 'align' . $block['align'];
}

$css_class_string = implode(' ', $css_classes);
?>

<?php
// Initialize JavaScript data
$json_data = json_encode($program_tabs, JSON_HEX_APOS | JSON_HEX_QUOT);
if ($json_data === false) {
    $json_data = '[]';
}
?>

<section <?php if ($block_anchor): ?>id="<?php echo esc_attr($block_anchor); ?>"<?php endif; ?> 
         class="<?php echo esc_attr($css_class_string); ?>"
         role="region"
         aria-label="Healthcare programs section">

        <!-- Story Card Section -->
<?php if ($story_card_heading || $story_card_description || $story_card_link): ?>
<div class="story-card-section">
    <div class="story-card-wrapper">
        <div class="story-card-container">
            <div class="story-card-content">
                <div class="story-card-text-group">
                    <?php if ($story_card_heading): ?>
                        <h2 class="story-card-heading"><?php echo esc_html($story_card_heading); ?></h2>
                    <?php endif; ?>
                    <?php if ($story_card_description): ?>
                        <p class="story-card-description"><?php echo esc_html($story_card_description); ?></p>
                    <?php endif; ?>
                </div>
                <?php if ($story_card_link && $story_card_link_text): ?>
                    <a href="<?php echo esc_url($story_card_link); ?>" class="story-card-link">
                        <?php echo esc_html($story_card_link_text); ?>
                    </a>
                <?php endif; ?>
            </div>
            <div class="story-card-background" <?php if ($story_card_background_image): ?>style="background-image: url('<?php echo esc_url($story_card_background_image['url'] ?? $story_card_background_image); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;"<?php endif; ?>></div>
        </div>
    </div>
</div>
<?php endif; ?>


    
    <!-- Hero Section -->
    <?php if ($headline || !empty($program_tabs) || $all_programs_link): ?>
    <div class="healthcare-hero">
        <div class="healthcare-hero-content">
            
            
            <div class="healthcare-hero-text">
                <?php if ($headline): ?>
                    <h1><?php echo esc_html($headline); ?></h1>
                <?php endif; ?>
            </div>
            
            <?php if (!empty($program_tabs) || $all_programs_link): ?>
            <div class="healthcare-tabs">
            <?php if ($all_programs_link): ?>
                <div class="healthcare-all-programs">
                    <a href="<?php echo esc_url($all_programs_link); ?>">All programs</a>
                </div>
            <?php endif; ?>
                <?php foreach ($program_tabs as $index => $tab): ?>
                    <?php 
                    $tab_name = $tab['tab_name'] ?? '';
                    ?>
                    <?php if ($tab_name): ?>
                        <div class="healthcare-tab <?php echo ($index === 0) ? 'active' : ''; ?>" 
                             data-tab-index="<?php echo $index; ?>">
                            <?php echo esc_html($tab_name); ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Program Details Section -->
    <?php if ($active_tab && !empty($program_tabs)): ?>
    <div class="healthcare-program-details">
        <div class="healthcare-program-content">
            <!-- Left Column - Program Headline -->
            <div class="healthcare-program-headline" <?php echo empty($active_tab['tab_program_headline'] ?? '') ? 'style="display:none;"' : ''; ?>>
                <h2 class="tab-program-headline"><?php echo esc_html($active_tab['tab_program_headline'] ?? ''); ?></h2>
            </div>
            
            <!-- Middle Column - Program Description + Link -->
            <div class="healthcare-program-description-wrapper">
                <div class="healthcare-program-description">
                    <p class="tab-program-description" <?php echo empty($active_tab['tab_program_description'] ?? '') ? 'style="display:none;"' : ''; ?>><?php echo esc_html($active_tab['tab_program_description'] ?? ''); ?></p>
                </div>
                <a href="<?php echo esc_url($active_tab['tab_learn_more_link'] ?? '#'); ?>" class="healthcare-learn-more" <?php echo empty($active_tab['tab_learn_more_link'] ?? '') ? 'style="display:none;"' : ''; ?>>Learn more</a>
            </div>
            
            <!-- Right Column - NCLEX Stats -->
            <div class="healthcare-stats">
                <div class="healthcare-stats-label tab-nclex-label" <?php echo empty($active_tab['tab_nclex_label'] ?? '') ? 'style="display:none;"' : ''; ?>><?php echo esc_html($active_tab['tab_nclex_label'] ?? ''); ?></div>
                <div class="healthcare-stats-rate tab-nclex-rate" <?php echo empty($active_tab['tab_nclex_rate'] ?? '') ? 'style="display:none;"' : ''; ?>><?php echo esc_html($active_tab['tab_nclex_rate'] ?? ''); ?></div>
                <div class="healthcare-stats-source tab-nclex-source" <?php echo empty($active_tab['tab_nclex_source'] ?? '') ? 'style="display:none;"' : ''; ?>><?php echo esc_html($active_tab['tab_nclex_source'] ?? ''); ?></div>
                <div class="healthcare-stats-outcomes" <?php echo empty($active_tab['tab_program_outcomes_link'] ?? '') ? 'style="display:none;"' : ''; ?>>
                    <a href="<?php echo esc_url($active_tab['tab_program_outcomes_link'] ?? '#'); ?>">View all Program Outcomes</a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Testimonial Section -->
    <?php if ($active_tab && !empty($program_tabs)): ?>
    <?php 
    // Check for video file upload first, then fall back to URL
    $video_file = $active_tab['tab_video_file'] ?? null;
    $video_url = '';
    $thumbnail_url = '';
    $is_uploaded_video = false;
    
    // Priority 1: Check for custom thumbnail first
    if (!empty($active_tab['tab_video_thumbnail']) && is_array($active_tab['tab_video_thumbnail'])) {
        $thumbnail_url = $active_tab['tab_video_thumbnail']['url'] ?? '';
    }
    
    if (!empty($video_file) && is_array($video_file)) {
        // Video file uploaded from library
        $video_url = $video_file['url'] ?? '';
        $is_uploaded_video = true;
        
        // Priority 2: If no custom thumbnail, try to get from video metadata
        if (empty($thumbnail_url) && isset($video_file['id'])) {
            $thumbnail_id = get_post_thumbnail_id($video_file['id']);
            if ($thumbnail_id) {
                $thumbnail_url = wp_get_attachment_image_url($thumbnail_id, 'large');
            }
        }
    } elseif (!empty($active_tab['tab_video_url'] ?? '')) {
        // External video URL
        $video_url = $active_tab['tab_video_url'];
        
        // Priority 3: If no custom thumbnail, auto-generate for YouTube/Vimeo
        if (empty($thumbnail_url)) {
            if (strpos($video_url, 'youtube.com') !== false || strpos($video_url, 'youtu.be') !== false) {
                preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\n?#]+)/', $video_url, $matches);
                if (isset($matches[1])) {
                    $thumbnail_url = 'https://img.youtube.com/vi/' . $matches[1] . '/maxresdefault.jpg';
                }
            } elseif (strpos($video_url, 'vimeo.com') !== false) {
                preg_match('/vimeo\.com\/(\d+)/', $video_url, $matches);
                if (isset($matches[1])) {
                    $vimeo_id = $matches[1];
                    $vimeo_data = wp_remote_get("https://vimeo.com/api/v2/video/{$vimeo_id}.json");
                    if (!is_wp_error($vimeo_data)) {
                        $vimeo_json = json_decode(wp_remote_retrieve_body($vimeo_data), true);
                        if (isset($vimeo_json[0]['thumbnail_large'])) {
                            $thumbnail_url = $vimeo_json[0]['thumbnail_large'];
                        }
                    }
                }
            }
        }
    }
    ?>
    <?php
    // Get testimonial data for active tab (use helper function for consistency)
    $testimonial_data = get_testimonial_data_for_tab($active_tab);
    $testimonial_text = $testimonial_data['tab_testimonial_text'];
    $testimonial_name = $testimonial_data['tab_testimonial_name'];
    $testimonial_title = $testimonial_data['tab_testimonial_title'];
    
    // Check if we have any testimonial content
    $has_testimonial_content = !empty($testimonial_text) || !empty($testimonial_name) || !empty($testimonial_title);
    
    // Get testimonial background image
    $testimonial_bg_image = $active_tab['tab_testimonial_background_image'] ?? null;
    $testimonial_bg_url = '';
    if (!empty($testimonial_bg_image) && is_array($testimonial_bg_image)) {
        $testimonial_bg_url = $testimonial_bg_image['url'] ?? '';
    }
    
    // Build testimonial card style attribute
    $testimonial_card_style_parts = array();
    $has_testimonial_content = !empty($testimonial_text) || !empty($testimonial_name) || !empty($testimonial_title);
    
    // Only hide card if there's NO testimonial content at all
    if (!$has_testimonial_content) {
        $testimonial_card_style_parts[] = 'display:none;';
    } else {
        // Add background image if available
    if (!empty($testimonial_bg_url)) {
        $testimonial_card_style_parts[] = 'background-image: url(\'' . esc_url($testimonial_bg_url) . '\');';
        $testimonial_card_style_parts[] = 'background-size: cover;';
        $testimonial_card_style_parts[] = 'background-position: center;';
        $testimonial_card_style_parts[] = 'background-repeat: no-repeat;';
        }
    }
    
    $testimonial_card_style = implode(' ', $testimonial_card_style_parts);
    ?>
    <div class="healthcare-testimonial">
        <div class="healthcare-testimonial-content">
            <div class="healthcare-testimonial-card" <?php if (!empty($testimonial_card_style)): ?>style="<?php echo esc_attr($testimonial_card_style); ?>"<?php endif; ?>>
                <div class="healthcare-testimonial-content-wrapper">
                    <div class="healthcare-testimonial-quote" <?php echo empty($testimonial_text) ? 'style="display:none;"' : ''; ?>>"</div>
                    <div class="healthcare-testimonial-content-inner">
                        <p class="healthcare-testimonial-text tab-testimonial-text" <?php echo empty($testimonial_text) ? 'style="display:none;"' : ''; ?>><?php echo esc_html($testimonial_text); ?></p>
                        <div class="healthcare-testimonial-author" <?php echo empty($testimonial_name) && empty($testimonial_title) ? 'style="display:none;"' : ''; ?>>
                            <div class="healthcare-testimonial-name tab-testimonial-name" <?php echo empty($testimonial_name) ? 'style="display:none;"' : ''; ?>><?php echo esc_html($testimonial_name); ?></div>
                            <div class="healthcare-testimonial-title tab-testimonial-title" <?php echo empty($testimonial_title) ? 'style="display:none;"' : ''; ?>><?php echo esc_html($testimonial_title); ?></div>
                        </div>
                    </div>
                    <div class="healthcare-testimonial-read-more" <?php echo empty($active_tab['tab_read_more_link'] ?? '') ? 'style="display:none;"' : ''; ?>>
                        <a href="<?php echo esc_url($active_tab['tab_read_more_link'] ?? '#'); ?>">Read more</a>
                    </div>
                </div>
            </div>
            
            <div class="healthcare-video-placeholder" 
                 data-is-uploaded="<?php echo $is_uploaded_video ? '1' : '0'; ?>"
                 <?php echo empty($video_url) ? 'style="display:none;"' : ''; ?> 
                 <?php if ($thumbnail_url): ?>style="background-image: url('<?php echo esc_url($thumbnail_url); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat; <?php echo empty($video_url) ? 'display:none;' : ''; ?>"<?php endif; ?>>
                <button class="healthcare-video-play" 
                        data-video-url="<?php echo esc_attr($video_url); ?>"
                        data-is-uploaded="<?php echo $is_uploaded_video ? '1' : '0'; ?>"
                        aria-label="Play video"></button>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Video Modal -->
    <?php if ($active_tab && !empty($program_tabs)): ?>
    <div class="healthcare-video-modal" id="healthcareVideoModal">
        <div class="healthcare-video-modal-content">
            <button class="healthcare-video-modal-close" aria-label="Close video"></button>
            <div id="healthcareVideoContainer"></div>
        </div>
    </div>
    <?php endif; ?>
</section>

<script>
(function() {
    'use strict';
    
    // Initialize healthcare tabs with data
    function initHealthcareTabs() {
        if (typeof window.initHealthcareTabsData === 'function') {
            window.initHealthcareTabsData(<?php echo $json_data; ?>);
        } else {
            // If function not loaded yet, wait and try again
            setTimeout(initHealthcareTabs, 100);
        }
    }
    
    // Initialize when DOM is ready (works in both frontend and backend)
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initHealthcareTabs);
    } else {
        // DOM already loaded (common in admin preview)
        initHealthcareTabs();
    }
    
    // Re-initialize on block update in editor (WordPress blocks may reload content)
    if (typeof acf !== 'undefined') {
        acf.addAction('render_block_preview/type=healthcare-programs', function() {
            window.healthcareInitialized = false; // Reset initialization flag
            setTimeout(initHealthcareTabs, 150);
        });
    }
    
    // Also listen for ACF field changes in preview
    if (typeof acf !== 'undefined' && typeof jQuery !== 'undefined') {
        jQuery(document).on('change', '.acf-field input, .acf-field select, .acf-field textarea', function() {
            window.healthcareInitialized = false;
            setTimeout(initHealthcareTabs, 200);
        });
    }
})();
</script>

