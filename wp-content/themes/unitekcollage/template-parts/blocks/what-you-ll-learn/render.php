<?php
// Get ACF field values
$heading = get_field('what_youll_learn_heading');
$description = get_field('what_youll_learn_description');
$learning_points = get_field('what_youll_learn_points');
$button_text = get_field('what_youll_learn_button_text');
$button_link = get_field('what_youll_learn_button_link');
$image = get_field('what_youll_learn_image');

// Validate required fields but do not block rendering/preview
$required_fields = array(
    'what_youll_learn_heading' => 'Heading',
    'what_youll_learn_description' => 'Description',
    'what_youll_learn_points' => 'Learning Points'
);
unitek_college_validate_block_fields($required_fields, 'What you\'ll learn Block');

// Split learning points into two columns
$points_array = array();
if ($learning_points && is_array($learning_points)) {
    foreach ($learning_points as $point) {
        if (!empty($point['point_text'])) {
            $points_array[] = $point['point_text'];
        }
    }
}

$total_points = count($points_array);
$mid_point = ceil($total_points / 2);
$left_column_points = array_slice($points_array, 0, $mid_point);
$right_column_points = array_slice($points_array, $mid_point);
?>

<section class="what-youll-learn-block" id="what-youll-learn">
    <div class="what-youll-learn-content">
        <!-- Left Column - Dark Green Background -->
        <div class="what-youll-learn-left">
            <?php if ($heading): ?>
                <h2 class="what-youll-learn-heading"><?php echo esc_html($heading); ?></h2>
            <?php endif; ?>
            
            <?php if ($description): ?>
                <p class="what-youll-learn-description"><?php echo esc_html($description); ?></p>
            <?php endif; ?>
            
            <?php if (!empty($points_array)): ?>
                <div class="what-youll-learn-separator"></div>
                
                <div class="what-youll-learn-points">
                    <div class="what-youll-learn-points-column">
                        <?php foreach ($left_column_points as $point): ?>
                            <div class="what-youll-learn-point">
                                <?php echo esc_html($point); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="what-youll-learn-points-column">
                        <?php foreach ($right_column_points as $point): ?>
                            <div class="what-youll-learn-point">
                                <?php echo esc_html($point); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if ($button_text): ?>
                <?php 
                $button_url = '#';
                $button_target = '';
                if ($button_link && is_array($button_link)) {
                    $button_url = $button_link['url'] ?? '#';
                    $button_target = $button_link['target'] ?? '';
                }
                ?>
                <a href="<?php echo esc_url($button_url); ?>" 
                   class="what-youll-learn-button" 
                   <?php if ($button_target): ?>target="<?php echo esc_attr($button_target); ?>"<?php endif; ?>>
                    <?php echo esc_html($button_text); ?>
                    <span class="what-youll-learn-button-arrow">→</span>
                </a>
            <?php endif; ?>
        </div>
        
        <!-- Right Column - Light Gray Background -->
        <div class="what-youll-learn-right">
            <?php if ($image && !empty($image['url'])): ?>
                <?php 
                // Get full-size image URL for better quality
                $image_url = !empty($image['sizes']['large']) ? $image['sizes']['large'] : $image['url'];
                if (empty($image_url)) {
                    $image_url = $image['url'];
                }
                ?>
                <img src="<?php echo esc_url($image_url); ?>" 
                     srcset="<?php echo esc_url($image['url']); ?> 1x, <?php echo esc_url($image_url); ?> 2x"
                     alt="<?php echo esc_attr($image['alt'] ?? 'What you\'ll learn'); ?>"
                     class="what-youll-learn-image"
                     loading="eager">
            <?php else: ?>
                <div class="what-youll-learn-image-placeholder">
                    [ Image ]
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
