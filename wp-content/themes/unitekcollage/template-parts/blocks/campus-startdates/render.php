<?php
if (!defined('ABSPATH')) {
  exit;
}

/**
 * Campus Start Dates Block Template (Repeatable Two Column Layout).
 *
 * Block Slug: campus-startdates
 * File Path: /template-parts/blocks/campus-startdates/render.php
 *
 * @param array $block The block settings and attributes.
 */

// --- Block Setup ---
$block_id = $block['id'] ?? '';
$block_class = $block['className'] ?? '';
$css_classes = array('campus-startdates-block');
if ($block_class) {
    $css_classes[] = $block_class;
}
$css_class_string = implode(' ', $css_classes);

// Define colors/styles for consistency
$bg_color = '#FFFFFF';      // White background for cards
$section_bg = '#f9f9f9';    // Light grey background for the whole block
$border_color = '#e0e0e0';  // Light grey border
$text_color = '#333333';    // Dark text
$accent_color = '#003366';  // Dark Blue primary color 
?>

<section id="<?php echo esc_attr($block_id); ?>" 
         class="<?php echo esc_attr($css_class_string); ?>"
         role="region"
         aria-label="Campus details and upcoming start dates">
    
    <div class="campus-startdates-inner-container">

    <?php 
    // START MAIN REPEATER: Loop through each campus section
    if (have_rows('campus_items')): 
        while (have_rows('campus_items')): the_row();
            
            // --- 1. Get Left Column Fields ---
            $left_title = get_sub_field('left_column_title');
            $address = get_sub_field('campus_address');
            $learn_more_text = get_sub_field('learn_more_text');
            $learn_more_url = get_sub_field('learn_more_url');

            // --- 2. Get Right Column Title ---
            $right_title = get_sub_field('start_date_section_title');
        ?>
        
            <!-- START: Repeatable Two-Column Box (One Campus Section) -->
            <div class="campus-startdates-container">
                
                <!-- LEFT COLUMN: Campus Location & CTA -->
                <div class="campus-startdates-column campus-startdates-left">
                    <div>
                        <?php if ($left_title): ?>
                            <h2><?php echo esc_html($left_title); ?></h2>
                        <?php endif; ?>
                        
                        <?php if ($address): ?>
                            <p class="campus-startdates-left-address">
                                <?php echo nl2br(esc_html($address)); ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <?php if ($learn_more_url && $learn_more_text): ?>
                        <div class="campus-startdates-learn-more">
                            <a href="<?php echo esc_url($learn_more_url); ?>">
                                <?php echo esc_html($learn_more_text); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- RIGHT COLUMN: Start Dates List -->
                <div class="campus-startdates-column campus-startdates-right">
                    <?php if ($right_title): ?>
                        <h2><?php echo esc_html($right_title); ?></h2>
                    <?php endif; ?>

                    <?php 
                    // START NESTED REPEATER: Loop through individual date/time details
                    if (have_rows('start_date_details')): 
                    ?>
                        <div class="start-dates-details-list">
                            <?php 
                            while (have_rows('start_date_details')): the_row();
                                $date_label = get_sub_field('date_label');
                                $time_label = get_sub_field('time_label');
                                
                                if ($date_label):
                                ?>
                                    <div class="start-dates-detail-item">
                                        <span class="start-dates-detail-label"><?php echo esc_html($date_label); ?></span>
                                        <?php if ($time_label): ?>
                                            <span class="start-dates-detail-time"><?php echo esc_html($time_label); ?></span>
                                        <?php endif; ?>
                                    </div>
                                <?php
                                endif;
                            endwhile; 
                            ?>
                        </div>
                    <?php else: ?>
                        <p>Please add start dates for this section.</p>
                    <?php endif; ?>
                    <!-- END NESTED REPEATER -->
                </div>
            </div>
            <!-- END: Repeatable Two-Column Box -->
        
        <?php endwhile; ?>
        <!-- END MAIN REPEATER -->
        
    <?php else: ?>
        <div class="campus-startdates-container" style="text-align: center; padding: 40px; border: 1px solid #ccc; box-shadow: none; background: #fff;">
             <p>Please add at least one Campus/Date Section in the block settings to display content.</p>
        </div>
    <?php endif; ?>

    </div>
</section>
