<?php
// Get the field values
$title = get_field('accreditations_title');
$description = get_field('accreditations_description');
$view_all_text = get_field('accreditations_view_all_text');
$view_all_url = get_field('accreditations_view_all_url');
$accreditation_items = get_field('accreditations_items');

// Validate required fields but do not block rendering/preview
$required_fields = array(
    'accreditations_title' => 'Title'
);
unitek_college_validate_block_fields($required_fields, 'Accreditations & Approvals Block');

// Set default values if fields are empty
// No editor fallbacks; if empty, nothing will render in editor or frontend
if (!is_array($accreditation_items)) {
    $accreditation_items = array();
}

// Get block attributes
$block_id = $block['id'] ?? '';
$block_class = $block['className'] ?? '';
$block_anchor = $block['anchor'] ?? '';

// Build CSS classes
$css_classes = array('accreditations-approvals-block');
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
         aria-label="Accreditations and approvals section">
    
    <div class="accreditations-approvals-content">
        <!-- Left Column - Title and Description -->
        <div class="accreditations-approvals-left">
            <?php if ($title): ?>
                <h2 class="accreditations-approvals-title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
            <?php if ($description): ?>
                <div class="accreditations-approvals-description">
                    <?php echo wp_kses_post($description); ?>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Right Column - Accreditation Items -->
        <div class="accreditations-approvals-right">
            <?php if ($view_all_text && $view_all_url): ?>
                <div class="accreditations-approvals-view-all">
                    <a href="<?php echo esc_url($view_all_url); ?>"><?php echo esc_html($view_all_text); ?></a>
                </div>
            <?php endif; ?>
            
            <div class="accreditations-approvals-items">
                <?php foreach ($accreditation_items as $item): ?>
                    <div class="accreditations-approvals-item">
                        <?php if ($item['accreditation_logo'] && !empty($item['accreditation_logo']['url'])): ?>
                            <div class="accreditations-approvals-item-logo">
                                <img src="<?php echo esc_url($item['accreditation_logo']['url']); ?>" 
                                     alt="<?php echo esc_attr($item['accreditation_logo']['alt'] ?? $item['accreditation_title']); ?>">
                            </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($item['accreditation_title'])): ?>
                            <h3 class="accreditations-approvals-item-title">
                                <?php echo esc_html($item['accreditation_title']); ?>
                            </h3>
                        <?php endif; ?>
                        
                        <?php if ($item['accreditation_description'] ?? ''): ?>
                            <p class="accreditations-approvals-item-description">
                                <?php echo esc_html($item['accreditation_description']); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
