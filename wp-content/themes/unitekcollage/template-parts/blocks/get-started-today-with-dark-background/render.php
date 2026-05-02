<?php
/**
 * Get ACF field values - supports both block context (pages) and options page
 * When used as a block in pages, fields are in block context
 * When used in theme options, fields are in options context
 */
// Determine context: block context (pages) or options page context
$is_block_context = isset($block) && !empty($block['id']);

// Get fields based on context
if ($is_block_context) {
    // Block context - fields are stored with the block instance
    $heading = get_field('get_started_dark_heading');
    $description = get_field('get_started_dark_description');
    $cf7_form_id = get_field('get_started_dark_cf7_form');
} else {
    // Options page context - fields are stored in options
    $heading = get_field('get_started_dark_heading', 'option');
    $description = get_field('get_started_dark_description', 'option');
    $cf7_form_id = get_field('get_started_dark_cf7_form', 'option');
}

// Validate required fields but do not block rendering/preview
$required_fields = array(
    'get_started_dark_heading' => 'Heading',
    'get_started_dark_description' => 'Description'
);
unitek_college_validate_block_fields($required_fields, 'Get Started Today (Dark Background) Block');

// Get block attributes
$block_id = $block['id'] ?? '';
$block_class = $block['className'] ?? '';
$block_anchor = $block['anchor'] ?? '';

// Build CSS classes
$css_classes = array('get-started-dark-block');
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
         aria-label="Get started form">
    
    <div class="get-started-dark-container">
        <div class="get-started-dark-content">
            <!-- Form Section Wrapper -->
            <div class="get-started-dark-form-wrapper">
                <!-- Header Section -->
                <div class="get-started-dark-header">
                    <?php if ($heading): ?>
                        <h2 class="get-started-dark-heading"><?php echo esc_html($heading); ?></h2>
                    <?php endif; ?>
                    <?php if ($description): ?>
                        <p class="get-started-dark-description"><?php echo esc_html($description); ?></p>
                    <?php endif; ?>
                </div>
                
                <!-- Divider -->
                <div class="get-started-dark-divider"></div>
                
                <!-- Form Section -->
                <?php if ($cf7_form_id && function_exists('wpcf7_contact_form')): ?>
                    <!-- Display Contact Form 7 -->
                    <?php
                    // Disable autop formatting for CF7
                    add_filter('wpcf7_autop_or_not', '__return_false', 999);
                    
                    // Capture CF7 output
                    ob_start();
                    echo do_shortcode('[contact-form-7 id="' . intval($cf7_form_id) . '"]');
                    $cf7_output = ob_get_clean();
                    
                    // Remove unwanted p and br tags
                    $cf7_output = preg_replace('/<p[^>]*>\s*<\/p>/i', '', $cf7_output); // Empty p tags
                    $cf7_output = preg_replace('/<p[^>]*>/i', '', $cf7_output); // Opening p tags
                    $cf7_output = preg_replace('/<\/p>/i', '', $cf7_output); // Closing p tags
                    $cf7_output = preg_replace('/<br\s*\/?>\s*/i', '', $cf7_output); // br tags
                    $cf7_output = preg_replace('/\n\s*\n/', '', $cf7_output); // Double line breaks
                    
                    echo $cf7_output;
                    
                    // Remove filter
                    remove_filter('wpcf7_autop_or_not', '__return_false', 999);
                    ?>
                <?php else: ?>
                    <p class="get-started-dark-no-form">Please select a Contact Form 7 form in the block settings.</p>
                <?php endif; ?>
        </div>
    </div>
</section>

