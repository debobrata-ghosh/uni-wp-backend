<?php
if (!defined('ABSPATH')) {
  exit;
}

$title = get_field('admissions_title');
$points = get_field('admissions_points');

// Example fallback
if(!$points || !is_array($points)){
    $points = array(
        array('point_text'=>'Submit proof of high school education or equivalent'),
        array('point_text'=>'Submit a copy of a government-issued photo ID'),
        array('point_text'=>'Complete all financing arrangements'),
    );
    $title = "BSN admissions requirements.";
}

// Unique ids for a11y labels
$section_id = 'admissions-' . uniqid();
$title_id = $section_id . '-title';
?>
<div class="main-wrapper-desk12" id="admissions-sections">
<section 
    class="admissions-block admissions-block-main" 
    role="region" 
    aria-labelledby="<?php echo esc_attr($title_id); ?>" 
    id="<?php echo esc_attr($section_id); ?>">
    <!-- Left Column -->
    <div class="admissions-left">
        <h2 id="<?php echo esc_attr($title_id); ?>"><?php echo esc_html($title); ?></h2>
    </div>
    <!-- Right Column -->
    <div class="admissions-right">
        <ul class="admissions-list">
            <?php foreach($points as $point): ?>
                <li class="admissions-item">
                    <span class="admissions-check" aria-hidden="true">&#10003;</span>
                    <span class="admissions-item-text"><?php echo esc_html($point['point_text']); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
            </div>