<?php
if (!defined('ABSPATH')) {
  exit;
}
$section_title = get_field('bsn_section_title_new');
$section_desc = get_field('bsn_section_desc');
$f1_title = get_field('bsn_feature_1_title');
$f1_desc = get_field('bsn_feature_1_desc');
$f2_title = get_field('bsn_feature_2_title');
$f2_desc = get_field('bsn_feature_2_desc');
$f3_title = get_field('bsn_feature_3_title');
$f3_year = get_field('bsn_feature_3_year');
$f3_rate = get_field('bsn_feature_3_rate');
$f3_source = get_field('bsn_feature_3_source');
$f3_source_url = get_field('bsn_feature_3_source_url'); // The source URL
$bsn_program_outcomes_link_text = get_field('bsn_program_outcomes_link_text');
$bsn_program_outcomes_link_url = get_field('bsn_program_outcomes_link_url');
?>
<div class="main-wrapper-deska" id="main-overview">
<section class="bsn-program-section" >
  <div class="bsn-program-wrap">
    <div class="bsn-program-left">
      <div class="bsn-program-title"><?php echo esc_html($section_title); ?></div>
      <div class="bsn-program-desc"><?php echo nl2br(esc_html($section_desc)); ?></div>
    </div>
    <div class="bsn-program-right">
      <!-- Feature 1 -->
      <div class="bsn-feature-block">
        <div>
          <div class="bsn-feature-title"><?php echo esc_html($f1_title); ?></div>
        </div>
        <div class="bsn-feature-right">
          <div class="bsn-feature-desc"><?php echo esc_html($f1_desc); ?></div>
        </div>
        <a href="<?php echo esc_url(get_field('bsn_feature_1_link_url')); ?>" class="bsn-card-arrow">
    <!-- SVG arrow icon: up-right, matches your screenshot style -->
    <svg width="21" height="21" viewBox="0 0 21 21" fill="none">
        <path d="M6 15L15 6M15 6H6.75M15 6V14.25" stroke="#73e2f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</a>

      </div>
      <!-- Feature 2 -->
      <div class="bsn-feature-block">
        <div>
          <div class="bsn-feature-title"><?php echo esc_html($f2_title); ?></div>
        </div>
        <div class="bsn-feature-right">
          <div class="bsn-feature-desc"><?php echo esc_html($f2_desc); ?></div>
        </div>
        <a href="<?php echo esc_url(get_field('bsn_feature_2_link_url')); ?>" class="bsn-card-arrow">
    <!-- SVG arrow icon: up-right, matches your screenshot style -->
    <svg width="21" height="21" viewBox="0 0 21 21" fill="none">
        <path d="M6 15L15 6M15 6H6.75M15 6V14.25" stroke="#73e2f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</a>

      </div>
      <!-- Feature 3: NCLEX -->
      <div class="bsn-feature-block">
        <div>
          <div class="bsn-feature-title"><?php echo esc_html($f3_title); ?></div>
        </div>
        <div class="bsn-nclex-content">
          <div class="bsn-nclex-label"><?php echo esc_html($f3_year); ?></div>
          <div class="bsn-nclex-rate"><?php echo esc_html($f3_rate); ?></div>
          <?php if ($f3_source && $f3_source_url) {
    echo '<div class="source_text_main">Source: <a class="bsn-nclex-source" href="' . esc_url($f3_source_url) . '">' . esc_html($f3_source) . '</a></div>';
} ?>
          <div class="bsn-nclex-meta">View all <a class="bsn-nclex-source" href=" <?php echo esc_url($bsn_program_outcomes_link_url);?> "><?php echo esc_html($bsn_program_outcomes_link_text) ;?> </a></div>
        </div>
        <a href="<?php echo esc_url(get_field('bsn_feature_3_link_url')); ?>" class="bsn-card-arrow">
    <!-- SVG arrow icon: up-right, matches your screenshot style -->
    <svg width="21" height="21" viewBox="0 0 21 21" fill="none">
        <path d="M6 15L15 6M15 6H6.75M15 6V14.25" stroke="#73e2f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</a>

      </div>
    </div>
  </div>
</section>
</div>