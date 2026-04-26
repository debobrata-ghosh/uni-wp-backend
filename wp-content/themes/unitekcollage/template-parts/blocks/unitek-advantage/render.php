<?php
// Get the field values
$heading = get_field('unitek_advantage_heading');
$subheading = get_field('unitek_advantage_subheading');
$body_text = get_field('unitek_advantage_body_text');
$features = get_field('unitek_advantage_features');
$cta_text = get_field('unitek_advantage_cta_text');
$cta_url = get_field('unitek_advantage_cta_url');
$testimonials = get_field('unitek_advantage_testimonials');

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

if (!$testimonials || empty($testimonials)) {
    $testimonials = array(
        array(
            'testimonial_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.',
            'testimonial_name' => 'Name A.',
            'testimonial_title' => 'Unitek Graduate'
        ),
        array(
            'testimonial_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'testimonial_name' => 'Name B.',
            'testimonial_title' => 'Unitek Graduate'
        ),
        array(
            'testimonial_text' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'testimonial_name' => 'Name C.',
            'testimonial_title' => 'Unitek Graduate'
        )
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
                    <div class="unitek-advantage-feature">
                        <h3 class="unitek-advantage-feature-title"><?php echo esc_html($feature['feature_title'] ?? ''); ?></h3>
                        <p class="unitek-advantage-feature-description"><?php echo esc_html($feature['feature_description'] ?? ''); ?></p>
                    </div>
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
            <div class="unitek-advantage-testimonial">
                <div class="unitek-advantage-testimonial-carousel">
                    <?php foreach ($testimonials as $index => $testimonial): ?>
                        <div class="unitek-advantage-testimonial-slide <?php echo $index === 0 ? 'active' : ''; ?>">
                            <div class="unitek-advantage-testimonial-quote">"</div>
                            <p class="unitek-advantage-testimonial-text"><?php echo esc_html($testimonial['testimonial_text'] ?? ''); ?></p>
                            <div class="unitek-advantage-testimonial-author">
                                <div class="unitek-advantage-testimonial-name"><?php echo esc_html($testimonial['testimonial_name'] ?? ''); ?></div>
                                <div class="unitek-advantage-testimonial-title"><?php echo esc_html($testimonial['testimonial_title'] ?? ''); ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Pagination Dots -->
                <div class="unitek-advantage-testimonial-pagination">
                    <?php foreach ($testimonials as $index => $testimonial): ?>
                        <div class="unitek-advantage-testimonial-dot <?php echo $index === 0 ? 'active' : ''; ?>" data-slide="<?php echo $index; ?>"></div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
