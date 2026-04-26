<?php
// Get the field values
$section_title = get_field('faq_section_title');
$faq_categories = get_field('faq_categories');

// Validate required fields but do not block rendering/preview
$required_fields = array(
    'faq_section_title' => 'Section Title'
);
unitek_college_validate_block_fields($required_fields, 'FAQ Block');

// Do not use fallbacks; keep empty in both editor and frontend
if (!is_array($faq_categories)) {
    $faq_categories = array();
}

// Get block attributes
$block_id = $block['id'] ?? '';
$block_class = $block['className'] ?? '';
$block_anchor = $block['anchor'] ?? '';

// Build CSS classes
$css_classes = array('faq-section-block');
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
         aria-label="FAQ section">
    
    <div class="faq-section-content">
        <!-- Left Sidebar - Categories -->
        <div class="faq-section-sidebar">
            <?php if ($section_title): ?>
                <h2 class="faq-section-title"><?php echo esc_html($section_title); ?></h2>
            <?php endif; ?>
            
            <div class="faq-section-categories">
                <?php if (!empty($faq_categories)): ?>
                    <?php foreach ($faq_categories as $index => $category): ?>
                        <?php $cat_title = $category['category_title'] ?? ''; ?>
                        <?php if ($cat_title): ?>
                            <button class="faq-category-tab" 
                                    data-category-index="<?php echo $index; ?>"
                                    aria-expanded="false">
                                <?php echo esc_html($cat_title); ?>
                            </button>
                            <!-- Mobile: Inline FAQ items within category -->
                            <div class="faq-mobile-accordion" 
                                 data-mobile-category="<?php echo $index; ?>">
                                <?php if (!empty($category['category_items'])): ?>
                                    <?php foreach ($category['category_items'] as $item_index => $item): ?>
                                        <div class="faq-mobile-accordion-item">
                                            <button class="faq-mobile-question" 
                                                    aria-expanded="false"
                                                    aria-controls="faq-mobile-answer-<?php echo $index; ?>-<?php echo $item_index; ?>">
                                                <?php if (!empty($item['question'])) echo esc_html($item['question']); ?>
                                            </button>
                                            <div class="faq-mobile-answer" 
                                                 id="faq-mobile-answer-<?php echo $index; ?>-<?php echo $item_index; ?>">
                                                <div class="faq-mobile-answer-content">
                                                    <?php if (!empty($item['answer'])) echo wp_kses_post($item['answer']); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Right Section - FAQ Accordion -->
        <div class="faq-section-main">
            <?php if (!empty($faq_categories)): foreach ($faq_categories as $category_index => $category): ?>
                <div class="faq-accordion-category" 
                     data-category="<?php echo $category_index; ?>">
                    <div class="faq-accordion">
                        <?php if (!empty($category['category_items'])): ?>
                            <?php foreach ($category['category_items'] as $item_index => $item): ?>
                                <div class="faq-accordion-item">
                                    <button class="faq-accordion-question" 
                                            aria-expanded="false"
                                            aria-controls="faq-answer-<?php echo $category_index; ?>-<?php echo $item_index; ?>">
                                        <?php if (!empty($item['question'])) echo esc_html($item['question']); ?>
                                    </button>
                                    <div class="faq-accordion-answer" 
                                         id="faq-answer-<?php echo $category_index; ?>-<?php echo $item_index; ?>">
                                        <div class="faq-accordion-answer-content">
                                            <?php if (!empty($item['answer'])) echo wp_kses_post($item['answer']); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</section>
