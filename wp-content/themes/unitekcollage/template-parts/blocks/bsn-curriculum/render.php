<?php
if (!defined('ABSPATH')) { exit; }
$title        = get_field('main_title');
$total_credits= get_field('total_credits');
$strapline    = get_field('strapline');
$intro_col1   = get_field('intro_col1');
$intro_col2   = get_field('intro_col2');
$totals_label = get_field('totals_label');
$sections     = get_field('bsn_sections');
?>
<div class="main-wrapper-desk1" id="curriculum-sections">
<div class="bsn-curriculum-block">
  <div class="bsn-curriculum-hero">
    <div class="bsn-curriculum-hero-top">
      <h2 class="bsn-curriculum-title">
        <?php echo esc_html($title ?: 'BSN Curriculum'); ?>
        <?php if($strapline): ?>
          <span class="bsn-curriculum-strapline"><?php echo esc_html($strapline); ?></span>
        <?php endif; ?>
      </h2>
    </div>
    <div class="bsn-curriculum-intro-row">
      <div class="bsn-curriculum-intro-col"><?php echo wpautop($intro_col1); ?></div>
      <div class="bsn-curriculum-intro-col"><?php echo wpautop($intro_col2); ?></div>
    </div>
    <div class="bsn-curriculum-row bsn-curriculum-totals-bar">
      <div class="bsn-curriculum-totals-label">
        <?php echo esc_html($totals_label ?: 'Course Totals'); ?>
      </div>
      <?php if($total_credits): ?>
        <div class="bsn-curriculum-totalcredits-bar">
          <b><?php echo esc_html($total_credits); ?></b>
          <span>Credit hours</span>
        </div>
      <?php endif; ?>
    </div>
    <hr class="bsn-curriculum-divider" />
  </div>
  <div class="bsn-curriculum-accordion" role="tablist">
    <?php if($sections): foreach($sections as $i => $section):
      $uniq = 'bsn-curriculum-panel-'.$i;
      $is_open = ($i===0); // First open by default
      ?>
      <div class="bsn-curriculum-accordion-section">
        <button type="button"
          class="bsn-curriculum-accordion-header<?php if($is_open) echo ' open'; ?>"
          aria-controls="<?php echo esc_attr($uniq); ?>"
          aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>"
          id="bsn-curriculum-header-<?php echo $i; ?>"
          role="tab"
          >
          <span class="arrow" aria-hidden="true"><?php echo $is_open ? "↑" : "↓"; ?></span>
          <?php echo esc_html($section['title']); ?>
          <?php if(!empty($section['credits'])): ?>
            <span class="section-credits">| <b><?php echo esc_html($section['credits']); ?></b>
              <span style="font-size:.85em;">Credits</span>
            </span>
          <?php endif; ?>
        </button>
        <div
          class="bsn-curriculum-panel"
          id="<?php echo esc_attr($uniq); ?>"
          <?php if(!$is_open): ?>hidden<?php endif; ?>
          role="tabpanel"
          aria-labelledby="bsn-curriculum-header-<?php echo $i; ?>"
          tabindex="0"
        >
          <table class="bsn-curriculum-table" aria-label="<?php echo esc_attr($section['title']); ?>">
            <thead>
              <tr>
                <th>Course</th>
                <th>Credit Hours</th>
              </tr>
            </thead>
            <tbody>
            <?php if(!empty($section['courses'])): foreach($section['courses'] as $row): ?>
              <tr>
                <td><?php echo esc_html($row['course']); ?></td>
                <td style="text-align:right;"><?php echo esc_html($row['credit_hours']); ?></td>
              </tr>
            <?php endforeach; endif; ?>
            </tbody>
          </table>
          <div class="bsn-curriculum-footer">
            <button type="button" class="close" aria-label="Close section"><span style="font-size:19px;line-height:1;">&times;</span> Close</button>
            <?php if(!empty($section['note'])): ?>
              <span><?php echo esc_html($section['note']); ?></span>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; endif; ?>
  </div>
</div>
            </div>
