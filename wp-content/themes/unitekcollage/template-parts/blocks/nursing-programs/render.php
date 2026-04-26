<?php
/**
 * Nursing Programs Block Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Get the field values
$tabs = get_field('nursing_tabs');

// Validate required fields but do not block rendering/preview
$required_fields = array(
    'nursing_main_title' => 'Main Title'
);
unitek_college_validate_block_fields($required_fields, 'Nursing Programs Block');

// Set default values if fields are empty
if (is_admin() && (!$tabs || empty($tabs))) {
    $tabs = array(
        array(
            'tab_title' => 'BSN Nursing Programs',
            'tab_image' => null,
            'tab_headline' => 'Earn your Bachelor of Science in Nursing (BSN) degree in as few as 10 to three years.',
            'tab_description' => '<p>Train to enter a rewarding career with a nationally ranked nursing school...</p>',
            'tab_primary_button' => array('button_text' => 'Learn more', 'button_url' => '#'),
            'tab_secondary_button' => array('button_text' => 'Get started', 'button_url' => '#'),
            'tab_program_details' => array(
                array('detail_item' => 'Duration: as few as 3 years'),
                array('detail_item' => 'CCNE Accredited'),
                array('detail_item' => 'NCLEX pass rate: 98.9%')
            ),
            'tab_program_locations' => array(
                array('location_name' => 'Fremont, CA', 'location_url' => '#'),
                array('location_name' => 'Hayward, CA', 'location_url' => '#'),
                array('location_name' => 'San Jose, CA', 'location_url' => '#')
            )
        )
    );
}

// Get block attributes
$block_id = $block['id'] ?? '';
$block_class = $block['className'] ?? '';
$block_anchor = $block['anchor'] ?? '';

// Build CSS classes
$css_classes = array('nursing-programs');
if ($block_class) {
    $css_classes[] = $block_class;
}
if ($block['align']) {
    $css_classes[] = 'align' . $block['align'];
}

$css_class_string = implode(' ', $css_classes);
?>

<script>
// Nursing Programs Tab Data
window.nursingTabsData = <?php 
$json_data = json_encode($tabs, JSON_HEX_APOS | JSON_HEX_QUOT);
if ($json_data === false) {
    echo '[]';
} else {
    echo $json_data;
}
?>;
</script>

<section <?php if ($block_anchor): ?>id="<?php echo esc_attr($block_anchor); ?>"<?php endif; ?> 
         class="<?php echo esc_attr($css_class_string); ?>"
         role="region"
         aria-label="Nursing programs section">
    
    <!-- Header with Tabs -->
    <div class="nursing-programs__header">
        <div class="nursing-programs__header-container">
            <?php $nursing_title = get_field('nursing_main_title'); if (is_admin() && !$nursing_title) { $nursing_title = 'Nursing Programs'; } ?>
            <?php if ($nursing_title): ?>
                <h2 class="nursing-programs__title"><?php echo esc_html($nursing_title); ?></h2>
            <?php endif; ?>
            <div class="nursing-programs__tabs">
                <?php foreach ($tabs as $index => $tab): ?>
                    <button class="nursing-programs__tab <?php echo $index === 0 ? 'active' : ''; ?>" 
                            data-tab-index="<?php echo $index; ?>"
                            onclick="switchNursingTab(<?php echo $index; ?>)">
                        <?php echo esc_html($tab['tab_title'] ?? ''); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="nursing-programs__content">
        <div class="nursing-programs__content-container">
            <!-- Left Column -->
            <div class="nursing-programs__left">
                <div class="nursing-programs__top-content">
                    <?php 
                    $active_tab = $tabs[0] ?? array();
                    if ($active_tab['tab_image'] ?? null): 
                    ?>
                        <div class="nursing-programs__image tab-image">
                            <img src="<?php echo esc_url($active_tab['tab_image']['url']); ?>" 
                                 alt="<?php echo esc_attr($active_tab['tab_image']['alt'] ?? ''); ?>">
                        </div>
                    <?php else: ?>
                        <div class="nursing-programs__image tab-image">[ Image ]</div>
                    <?php endif; ?>
                    
                    <div class="nursing-programs__text-content">
                        <h3 class="nursing-programs__headline tab-headline">
                            <?php echo esc_html($active_tab['tab_headline'] ?? ''); ?>
                        </h3>
                        
                        <div class="nursing-programs__description tab-description">
                            <?php echo wp_kses_post($active_tab['tab_description'] ?? ''); ?>
            </div>
        </div>
    </div>
    
                <div class="nursing-programs__buttons">
                    <?php if (!empty($active_tab['tab_primary_button']['button_text'])): ?>
                        <a href="<?php echo esc_url($active_tab['tab_primary_button']['button_url'] ?? '#'); ?>" 
                           class="nursing-programs__button nursing-programs__button--primary tab-primary-btn">
                            <?php echo esc_html($active_tab['tab_primary_button']['button_text']); ?>
                        </a>
                    <?php endif; ?>
                    
                    <?php if (!empty($active_tab['tab_secondary_button']['button_text'])): ?>
                        <a href="<?php echo esc_url($active_tab['tab_secondary_button']['button_url'] ?? '#'); ?>" 
                           class="nursing-programs__button nursing-programs__button--secondary tab-secondary-btn">
                            <?php echo esc_html($active_tab['tab_secondary_button']['button_text']); ?>
                        </a>
                <?php endif; ?>
                </div>
            </div>
            
            <!-- Right Column -->
            <div class="nursing-programs__right">
                <?php if (!empty($active_tab['tab_program_details'])): ?>
                    <div class="nursing-programs__details">
                        <h4 class="nursing-programs__details-title tab-details-title">
                            <?php echo esc_html($active_tab['tab_details_title'] ?? 'BSN Program Details'); ?>
                        </h4>
                        <ul class="nursing-programs__details-list tab-details-list">
                            <?php foreach ($active_tab['tab_program_details'] as $detail): ?>
                                <li class="nursing-programs__details-item">
                                    <?php echo esc_html($detail['detail_item'] ?? ''); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($active_tab['tab_program_locations'])): ?>
                    <div class="nursing-programs__locations">
                        <h4 class="nursing-programs__locations-title tab-locations-title">
                            <?php echo esc_html($active_tab['tab_locations_title'] ?? 'BSN Program Locations'); ?>
                        </h4>
                        <ul class="nursing-programs__locations-list tab-locations-list">
                            <?php foreach ($active_tab['tab_program_locations'] as $location): ?>
                                <li class="nursing-programs__locations-item">
                                    <?php if (!empty($location['location_url'])): ?>
                                        <a href="<?php echo esc_url($location['location_url']); ?>" 
                                           class="nursing-programs__locations-link"
                                           target="_blank"
                                           rel="noopener noreferrer">
                                            <?php echo esc_html($location['location_name'] ?? ''); ?>
                                        </a>
                                    <?php else: ?>
                                        <?php echo esc_html($location['location_name'] ?? ''); ?>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
       
    </div>
</section>