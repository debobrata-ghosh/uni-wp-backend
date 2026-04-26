<?php
// Get the field values
$headline = get_field('home_overview_headline');
$description = get_field('home_overview_description');
$stats = get_field('home_overview_stats');

// Validate required fields but do not block rendering/preview
$required_fields = array(
    'home_overview_headline' => 'Headline'
);
unitek_college_validate_block_fields($required_fields, 'Home Overview Block');

// Set default values if fields are empty
// No editor fallbacks; if empty, nothing will render in editor or frontend

// Keep description empty if user leaves it blank

if (!$stats || empty($stats)) {
    $stats = array(
        array('stat_value' => '98%', 'stat_description' => 'Lorem ipsum dolor sit amet'),
        array('stat_value' => '100%', 'stat_description' => 'Lorem ipsum dolor sit amet'),
        array('stat_value' => '$103K', 'stat_description' => 'Lorem ipsum dolor sit amet')
    );
}

// Get block attributes
$block_id = $block['id'] ?? '';
$block_class = $block['className'] ?? '';
$block_anchor = $block['anchor'] ?? '';

// Build CSS classes
$css_classes = array('home-overview-block');
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
         aria-label="Home overview section">
    
    <div class="home-overview-content">
        <!-- Left Column - Headline and Description -->
        <div class="home-overview-left">
            <?php if ($headline): ?>
                <h2 class="home-overview-headline"><?php echo esc_html($headline); ?></h2>
            <?php endif; ?>
            <?php if ($description): ?>
                <div class="home-overview-description">
                    <?php echo wp_kses_post($description); ?>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Right Column - Statistics -->
        <div class="home-overview-right">
            <?php foreach ($stats as $index => $stat): ?>
                <div class="home-overview-stat" data-stat-index="<?php echo esc_attr($index); ?>">
                    <div class="home-overview-stat-row">
                        <div class="home-overview-stat-value"><?php echo esc_html($stat['stat_value'] ?? ''); ?></div>
                        <div class="home-overview-stat-description" role="button" tabindex="0" aria-expanded="false" aria-controls="stat-content-<?php echo esc_attr($index); ?>">
                            <span class="home-overview-stat-text"><?php echo esc_html($stat['stat_description'] ?? ''); ?></span>
                            <svg class="home-overview-stat-arrow" width="24" height="24" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <mask id="mask0_arrow_<?php echo esc_attr($index); ?>" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="-5" y="-5" width="26" height="26">
                                <rect x="-4.54554" y="-4.10915" width="24.6549" height="24.6549" fill="#D9D9D9"/>
                            </mask>
                            <g mask="url(#mask0_arrow_<?php echo esc_attr($index); ?>)">
                                <path d="M6.75441 12.5072V1.02729C6.75441 0.736222 6.85286 0.492241 7.04975 0.295345C7.24665 0.0984483 7.49063 0 7.7817 0C8.07276 0 8.31674 0.0984483 8.51364 0.295345C8.71053 0.492241 8.80898 0.736222 8.80898 1.02729V12.5072L13.8427 7.47351C14.0481 7.26805 14.2878 7.1696 14.5618 7.17816C14.8357 7.18673 15.0754 7.29373 15.2809 7.49919C15.4692 7.70465 15.5677 7.94435 15.5762 8.21829C15.5848 8.49223 15.4863 8.73194 15.2809 8.93739L8.5008 15.7175C8.39807 15.8202 8.28678 15.893 8.16693 15.9358C8.04708 15.9786 7.91867 16 7.7817 16C7.64472 16 7.51631 15.9786 7.39646 15.9358C7.27661 15.893 7.16532 15.8202 7.06259 15.7175L0.282504 8.93739C0.0941679 8.74906 0 8.51364 0 8.23113C0 7.94863 0.0941679 7.70465 0.282504 7.49919C0.487961 7.29373 0.731942 7.19101 1.01445 7.19101C1.29695 7.19101 1.54093 7.29373 1.74639 7.49919L6.75441 12.5072Z" fill="currentColor"/>
                            </g>
                        </svg>
                        </div>
                    </div>
                    <div class="home-overview-stat-content" id="stat-content-<?php echo esc_attr($index); ?>">
                        <div class="home-overview-stat-expanded-text">
                            <?php echo esc_html($stat['stat_expanded_content'] ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.'); ?>
                        </div>
                        <?php if (!empty($stat['stat_read_more_link'])): ?>
                            <a href="<?php echo esc_url($stat['stat_read_more_link']); ?>" class="home-overview-stat-read-more">
                                Read more
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 12h14m0 0l-7-7m7 7l-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        <?php else: ?>
                            <a href="#" class="home-overview-stat-read-more">
                                Read more
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 12h14m0 0l-7-7m7 7l-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if ($index < count($stats) - 1): ?>
                    <!-- Divider line between stats -->
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
