<?php
if (!defined('ABSPATH')) {
  exit;
}

$quotes = get_field('quotes');
if( !$quotes ) return;
?>
<div class="quote-section-slider">
    <!-- Navigation arrows: desktop only -->
    <div class="quote-slider-nav left desktop-nav" aria-label="Quote navigation">
        <button class="nav-arrow prev" aria-label="Previous quote">
            <svg width="32" height="32" viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6" style="fill:none;stroke:#2d3748;stroke-width:2;stroke-linecap:round;stroke-linejoin:round"/></svg>
        </button>
    </div>
    <div class="quote-slider-wrapper">
        <?php foreach($quotes as $index => $quote): ?>
            <div class="quote-slide<?php if($index === 0) echo ' active'; ?>">
                <blockquote class="quote-text">
                    <span class="quote-icon" aria-hidden="true">“</span>
                    <?php echo wp_kses_post(nl2br($quote['quote_text'])); ?>
                </blockquote>
                <div class="quote-meta">
                    <span class="quote-name"><?php echo esc_html($quote['quote_attribution']); ?></span><br>
                    <?php if (!empty($quote['quote_caption'])): ?>
                        <span class="quote-caption"><?php echo esc_html($quote['quote_caption']); ?></span>
                    <?php endif; ?>
                </div>
                <!-- Dots: mobile only, below text and above meta -->
                <div class="quote-pagination mobile-pagination">
                    <?php foreach($quotes as $dotIndex => $dot): ?>
                        <button class="pagination-dot<?php if($dotIndex === $index) echo ' active'; ?>" aria-label="Go to quote <?php echo $dotIndex+1; ?>"></button>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="quote-slider-nav right desktop-nav">
        <button class="nav-arrow next" aria-label="Next quote">
            <svg width="32" height="32" viewBox="0 0 24 24"><polyline points="9 6 15 12 9 18" style="fill:none;stroke:#2d3748;stroke-width:2;stroke-linecap:round;stroke-linejoin:round"/></svg>
        </button>
    </div>
</div>
