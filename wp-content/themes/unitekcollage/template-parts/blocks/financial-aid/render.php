<?php
if (!defined('ABSPATH')) {
  exit;
}

$left_title    = get_field('left_title');
$left_desc     = get_field('left_desc');
$left_subdesc  = get_field('left_subdesc');
$left_cta_text = get_field('left_cta_text');
$left_cta_url  = get_field('left_cta_url');

$right_title    = get_field('right_title');
$right_desc     = get_field('right_desc');
$right_subdesc  = get_field('right_subdesc');
$right_cta_text = get_field('right_cta_text');
$right_cta_url  = get_field('right_cta_url');
?>

<section class="financial-aid-section">
  <div class="financial-aid-wrap">
    <div class="fa-col">
      <div class="fa-title"><?php echo esc_html($left_title); ?></div>
      <div class="fa-desc"><?php echo nl2br(esc_html($left_desc)); ?></div>
      <div class="fa-subdesc"><?php echo nl2br(esc_html($left_subdesc)); ?></div>
      <?php if($left_cta_text && $left_cta_url): ?>
        <a class="fa-cta" href="<?php echo esc_url($left_cta_url); ?>" target="_blank">
          <?php echo esc_html($left_cta_text); ?>
          <span class="fa-cta-arrow">
            <!-- Screenshot-matching arrow SVG -->
            <svg viewBox="0 0 32 32" fill="none">
              <path d="M11 16H25M25 16L19 10M25 16L19 22" stroke="#259429" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
        </a>
      <?php endif; ?>
    </div>
    <div class="fa-col">
      <div class="fa-title"><?php echo esc_html($right_title); ?></div>
      <div class="fa-desc"><?php echo nl2br(esc_html($right_desc)); ?></div>
      <div class="fa-subdesc"><?php echo nl2br(esc_html($right_subdesc)); ?></div>
      <?php if($right_cta_text && $right_cta_url): ?>
        <a class="fa-cta" href="<?php echo esc_url($right_cta_url); ?>" target="_blank">
          <?php echo esc_html($right_cta_text); ?>
          <span class="fa-cta-arrow">
            <svg viewBox="0 0 32 32" fill="none">
              <path d="M11 16H25M25 16L19 10M25 16L19 22" stroke="#259429" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </span>
        </a>
      <?php endif; ?>
    </div>
  </div>
</section>
