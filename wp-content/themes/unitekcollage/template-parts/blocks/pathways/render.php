<?php
if (!defined('ABSPATH')) {
  exit;
}

// template-parts/blocks/pathways/render.php

$block_id = 'pathways-' . $block['id'];
$title    = get_field('pathways_title');
$items    = get_field('pathways_items');

// Add dynamic inline style for block-specific ID
// if ($block_id) {
//     $inline_css = "#{$block_id}.pathways-block { background: #f8f9fb; padding: 40px 0px; border-left: 0px solid #0071bc; }";
//     wp_add_inline_style('pathways-style', $inline_css);
// }
?>
<div class="pathways-main-bg" id="bsn-pathways"> 
<div class="main-wrapper-desk-pathways">
<section id="<?php echo esc_attr($block_id); ?>" class="pathways-block pathways-block-for-mobile">
    <div class="pathways-inner" id="">
        <?php if ($title): ?>
            <div class="pathways-left">
                <h2><?php echo esc_html($title); ?></h2>
            </div>
        <?php endif; ?>

        <div class="pathways-right">
            <?php if ($items): ?>
                <div class="pathways-accordion">
                    <?php foreach ($items as $index => $item): ?>
                        <?php 
                        $panel_id = $block_id . '-panel-' . $index;
                        $button_id = $block_id . '-button-' . $index;
                        ?>
                        <div class="pathways-item">
                            <button 
                                class="pathways-trigger" 
                                id="<?php echo esc_attr($button_id); ?>"
                                data-index="<?php echo esc_attr($index); ?>"
                                aria-expanded="false"
                                aria-controls="<?php echo esc_attr($panel_id); ?>"
                                type="button">
                                <span class="arrow" aria-hidden="true">↓</span>
                                <?php echo esc_html($item['title']); ?>
                            </button>
                            <div 
                                class="pathways-panel" 
                                id="<?php echo esc_attr($panel_id); ?>"
                                role="region"
                                aria-labelledby="<?php echo esc_attr($button_id); ?>">
                                <?php echo wp_kses_post($item['content']); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
</div>
                    </div>