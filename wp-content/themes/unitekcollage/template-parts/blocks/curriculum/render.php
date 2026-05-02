<?php
// Get ACF field values
$heading = get_field('curriculum_heading');
$description = get_field('curriculum_description');
$highlighted_sentence = get_field('curriculum_highlighted_sentence');
$course_topics = get_field('curriculum_course_topics');
$image = get_field('curriculum_image');

// Validate required fields but do not block rendering/preview
$required_fields = array(
    'curriculum_heading' => 'Heading',
    'curriculum_description' => 'Description',
    'curriculum_course_topics' => 'Course Topics'
);
unitek_college_validate_block_fields($required_fields, 'Curriculum Block');

// Split course topics into two columns
$topics_array = array();
if ($course_topics && is_array($course_topics)) {
    foreach ($course_topics as $topic) {
        if (!empty($topic['topic_text'])) {
            $topics_array[] = $topic['topic_text'];
        }
    }
}

$total_topics = count($topics_array);
$mid_point = ceil($total_topics / 2);
$left_column_topics = array_slice($topics_array, 0, $mid_point);
$right_column_topics = array_slice($topics_array, $mid_point);
?>

<section class="curriculum-block" id="curriculum">
    <div class="curriculum-content">
        <!-- Left Column - Content Area -->
        <div class="curriculum-left">
            <?php if ($heading): ?>
                <h2 class="curriculum-heading"><?php echo esc_html($heading); ?></h2>
            <?php endif; ?>
            
            <?php if ($description): ?>
                <p class="curriculum-description"><?php echo esc_html($description); ?></p>
            <?php endif; ?>
            
            <?php if ($highlighted_sentence): ?>
                <p class="curriculum-highlighted"><?php echo esc_html($highlighted_sentence); ?></p>
            <?php endif; ?>
            
            <?php if (!empty($topics_array)): ?>
                <div class="curriculum-topics">
                    <div class="curriculum-topics-column">
                        <?php foreach ($left_column_topics as $topic): ?>
                            <div class="curriculum-topic">
                                <?php echo esc_html($topic); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="curriculum-topics-column">
                        <?php foreach ($right_column_topics as $topic): ?>
                            <div class="curriculum-topic">
                                <?php echo esc_html($topic); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Right Column - Image Area -->
        <div class="curriculum-right">
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
                     alt="<?php echo esc_attr($image['alt'] ?? 'Curriculum'); ?>"
                     class="curriculum-image"
                     loading="eager">
            <?php else: ?>
                <div class="curriculum-image-placeholder">
                    [ Clipped Portrait Image ]
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
