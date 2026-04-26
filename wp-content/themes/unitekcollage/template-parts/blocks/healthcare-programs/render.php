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

// Use only ACF data - no default fallback
if (!$program_tabs || empty($program_tabs)) {
    $program_tabs = array();
} else {
    // Remove duplicates based on tab_name (more thorough)
    $unique_tabs = array();
    $seen_names = array();
    
    foreach ($program_tabs as $tab) {
        $tab_name = trim($tab['tab_name'] ?? '');
        $tab_name_clean = strtolower(preg_replace('/\s+/', ' ', $tab_name)); // Normalize spaces
        
        if (!empty($tab_name) && !in_array($tab_name_clean, $seen_names)) {
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
    // Get testimonial background image
    $testimonial_bg_image = $active_tab['tab_testimonial_background_image'] ?? null;
    $testimonial_bg_url = '';
    if (!empty($testimonial_bg_image) && is_array($testimonial_bg_image)) {
        $testimonial_bg_url = $testimonial_bg_image['url'] ?? '';
    }
    
    // Build testimonial card style attribute
    $testimonial_card_style = '';
    $is_testimonial_empty = empty($active_tab['tab_testimonial_text'] ?? '') && empty($active_tab['tab_testimonial_name'] ?? '') && empty($active_tab['tab_testimonial_title'] ?? '');
    
    if ($is_testimonial_empty) {
        $testimonial_card_style = 'display:none;';
    } elseif (!empty($testimonial_bg_url)) {
        $testimonial_card_style = 'background-image: url(\'' . esc_url($testimonial_bg_url) . '\'); background-size: cover; background-position: center; background-repeat: no-repeat;';
    }
    ?>
    <div class="healthcare-testimonial">
        <div class="healthcare-testimonial-content">
            <div class="healthcare-testimonial-card" <?php if (!empty($testimonial_card_style)): ?>style="<?php echo $testimonial_card_style; ?>"<?php endif; ?>>
                <div class="healthcare-testimonial-content-wrapper">
                    <div class="healthcare-testimonial-quote" <?php echo empty($active_tab['tab_testimonial_text'] ?? '') ? 'style="display:none;"' : ''; ?>>"</div>
                    <div class="healthcare-testimonial-content-inner">
                        <p class="healthcare-testimonial-text tab-testimonial-text" <?php echo empty($active_tab['tab_testimonial_text'] ?? '') ? 'style="display:none;"' : ''; ?>><?php echo esc_html($active_tab['tab_testimonial_text'] ?? ''); ?></p>
                        <div class="healthcare-testimonial-author" <?php echo empty($active_tab['tab_testimonial_name'] ?? '') && empty($active_tab['tab_testimonial_title'] ?? '') ? 'style="display:none;"' : ''; ?>>
                            <div class="healthcare-testimonial-name tab-testimonial-name" <?php echo empty($active_tab['tab_testimonial_name'] ?? '') ? 'style="display:none;"' : ''; ?>><?php echo esc_html($active_tab['tab_testimonial_name'] ?? ''); ?></div>
                            <div class="healthcare-testimonial-title tab-testimonial-title" <?php echo empty($active_tab['tab_testimonial_title'] ?? '') ? 'style="display:none;"' : ''; ?>><?php echo esc_html($active_tab['tab_testimonial_title'] ?? ''); ?></div>
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

