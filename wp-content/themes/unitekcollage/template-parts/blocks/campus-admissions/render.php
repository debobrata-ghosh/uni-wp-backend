<?php
// Get ACF field values
$heading = get_field('admissions_heading');
$description = get_field('admissions_description');
$requirements = get_field('admissions_requirements');

// Validate required fields but do not block rendering/preview
$required_fields = array(
    'admissions_heading' => 'Heading',
    'admissions_description' => 'Description',
    'admissions_requirements' => 'Requirements'
);
unitek_college_validate_block_fields($required_fields, 'Admissions Requirements Block');
?>

<section class="campus-admissions-block" id="campus-admissions">
    <div class="campus-admissions-content">
        <?php if ($heading): ?>
            <h2 class="campus-admissions-heading"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        
        <?php if ($description): ?>
            <p class="campus-admissions-description"><?php echo esc_html($description); ?></p>
        <?php endif; ?>
        
        <?php if ($requirements && is_array($requirements) && !empty($requirements)): ?>
            <div class="campus-admissions-requirements">
                <?php foreach ($requirements as $requirement): ?>
                    <?php if (!empty($requirement['requirement_title'])): ?>
                        <div class="campus-admissions-requirement-card">
                            <h3 class="campus-admissions-requirement-title"><?php echo esc_html($requirement['requirement_title']); ?></h3>
                            <?php if (!empty($requirement['requirement_description'])): ?>
                                <p class="campus-admissions-requirement-description"><?php echo esc_html($requirement['requirement_description']); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
