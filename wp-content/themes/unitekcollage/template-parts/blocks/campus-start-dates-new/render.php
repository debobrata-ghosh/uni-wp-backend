<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$title = get_field( 'campus_dates_title' );
$list = get_field( 'campus_dates_list' );
$blockid = $block['id'] ?? '';
$blockclass = $block['className'] ?? '';
?>
<section id="start-dates" class="campus-dates-block <?php echo esc_attr($blockclass); ?>" id="<?php echo esc_attr($blockid); ?>">
  <?php if ( $title ) : ?>
    <div class="campus-dates-block-title"><?php echo esc_html( $title ); ?></div>
  <?php endif; ?>

  <!-- Programs Accordion: Available Programs -->
  <!-- <button class="category-toggle" type="button" aria-expanded="true">Available Programs <span class="arrow">&#8593;</span></button> -->
  <div class="category-panel active">
    <?php if ( ! empty( $list ) ) : ?>
      <div class="campus-dates-list">
        <?php foreach ( $list as $card ) : ?>
          <div class="campus-dates-card">
            <div class="campus-info">
              <div class="campus-location"><?php echo esc_html( $card['campus_location'] ); ?></div>
              <div class="campus-address"><?php echo nl2br( esc_html( $card['campus_address'] ) ); ?></div>
              <?php if ( ! empty( $card['button_url'] ) ) : ?>
                <a href="<?php echo esc_url( $card['button_url'] ); ?>" class="campus-card-btn"><?php echo esc_html( $card['button_text'] ); ?></a>
              <?php endif; ?>
            </div>
            <div class="campus-calendar" style="">
              <div class="start-date-stack">
              <div class="start-date">Start Date</div>
              <div class="lg-calendar">
                <img class="vector" src="<?php echo esc_url( get_site_url() ); ?>/wp-content/uploads/2025/11/vector0.png">
                <img class="vector2" src="<?php echo esc_url( get_site_url() ); ?>/wp-content/uploads/2025/11/vector1.png">
                <img class="vector3" src="<?php echo esc_url( get_site_url() ); ?>/wp-content/uploads/2025/11/vector3.png">
                <img class="vector4" src="<?php echo esc_url( get_site_url() ); ?>/wp-content/uploads/2025/11/vector2.png">
                <div class="abc"><?php echo esc_html( $card['calendar_sub'] ); ?></div>
                <div class="_00"><?php echo esc_html( $card['calendar_day'] ); ?></div>
              </div>
            </div>
          </div>
              <!-- <div class="calendar-label"><?php //echo esc_html( $card['calendar_label'] ); ?></div>
              <div class="calendar-sub"><?php //echo esc_html( $card['calendar_sub'] ); ?></div>
              <div class="calendar-day"><?php //echo esc_html( $card['calendar_day'] ); ?></div> -->
            </div>
            
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

  <!-- Programs Accordion: Online Programs (panel empty for now) -->
  <!-- <button class="category-toggle" type="button" aria-expanded="false">Online Programs <span class="arrow">&#8595;</span></button> -->
  <div class="category-panel">
    <!-- Add your online programs content here if required -->
  </div>
</section>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.category-toggle').forEach(function(btn) {
      btn.addEventListener('click', function() {
        const panel = btn.nextElementSibling;
        const isActive = panel.classList.contains('active');
        panel.classList.toggle('active');
        btn.querySelector('.arrow').textContent = panel.classList.contains('active') ? '↑' : '↓';
        btn.setAttribute('aria-expanded', panel.classList.contains('active') ? 'true' : 'false');
      });
    });
  });
</script>
