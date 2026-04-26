<?php
// Get the field values
$headline = get_field('career_headline');
$subheadline = get_field('career_subheadline');
$career_cards = get_field('career_cards');

// Validate required fields but do not block rendering/preview
$required_fields = array(
    'career_headline' => 'Headline'
);
unitek_college_validate_block_fields($required_fields, 'Career Block');

// Set default values if fields are empty
// No editor fallbacks; if empty, nothing will render in editor or frontend

// Default cards if none are set
if (!is_array($career_cards)) {
    $career_cards = array();
}

// Get block attributes
$block_id = $block['id'] ?? '';
$block_class = $block['className'] ?? '';
$block_anchor = $block['anchor'] ?? '';

// Build CSS classes
$css_classes = array('career-block');
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
         aria-label="Career services section">
    <div class="career-container">
        <!-- Left Column - Text Content -->
        <div class="career-text-column">
            <div class="career-content">
                <?php if ($headline): ?>
                    <h1 class="career-headline"><?php echo esc_html($headline); ?></h1>
                <?php endif; ?>
                <?php if ($subheadline): ?>
                    <p class="career-subheadline"><?php echo esc_html($subheadline); ?></p>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Right Column - Career Cards -->
        <div class="career-cards-column">
            <div class="career-cards-container">
                <?php foreach ($career_cards as $card): ?>
                    <?php 
                    $card_title = $card['card_title'] ?? '';
                    $card_url = $card['card_url'] ?? '';
                    ?>
                    <?php if ($card_title): ?>
                        <?php if ($card_url): ?>
                            <a href="<?php echo esc_url($card_url); ?>" class="career-card" target="_blank" rel="noopener">
                                <span class="career-card-title"><?php echo esc_html($card_title); ?></span>
                                <span class="career-card-arrow">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7 17L17 7M17 7H7M17 7V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                            </a>
                        <?php else: ?>
                            <div class="career-card">
                                <span class="career-card-title"><?php echo esc_html($card_title); ?></span>
                                <span class="career-card-arrow">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7 17L17 7M17 7H7M17 7V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
