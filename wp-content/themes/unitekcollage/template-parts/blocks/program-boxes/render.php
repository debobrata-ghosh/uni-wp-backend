<?php
if (!defined('ABSPATH')) {
    exit;
}

$section_tab_label = 'PROGRAM BOXES';

$top_heading    = get_field('pb_top_heading');
$top_text       = get_field('pb_top_text');
$bottom_heading = get_field('pb_bottom_heading');
$bottom_text    = get_field('pb_bottom_text');
$button_text    = get_field('pb_button_text');
$button_url     = get_field('pb_button_url');
$image_bl       = get_field('pb_image_bottom_left');
$image_br       = get_field('pb_image_bottom_right');

$block_id       = $block['id'] ?? '';
$block_class    = $block['className'] ?? '';

$required_fields = array(
    'pb_top_heading'        => 'Top Heading',
    'pb_top_text'           => 'Top Text',
    'pb_bottom_heading'     => 'Bottom Heading',
    'pb_bottom_text'        => 'Bottom Text',
    'pb_button_text'        => 'Button Text',
    'pb_button_url'         => 'Button URL',
    'pb_media_type_top'     => 'Top Image/Video',
    'pb_image_bottom_left'  => 'Bottom Left Image',
    'pb_image_bottom_right' => 'Bottom Right Image',
);
if (function_exists('unitek_college_validate_block_fields')) {
    unitek_college_validate_block_fields($required_fields, 'PROGRAM BOXES');
}

$is_preview = ( isset($block['data']['_is_preview']) && $block['data']['_is_preview'] )
              || (is_admin() && !wp_doing_ajax() && !wp_is_json_request());

// Add preview class via inline script if needed
if ($is_preview && $block_id) {
    wp_add_inline_script('program-boxes-script', 
        "document.addEventListener('DOMContentLoaded', function() { 
            var block = document.getElementById('" . esc_js($block_id) . "'); 
            if(block) block.classList.add('preview'); 
        });"
    );
}
?>

<div class="program-boxes-block <?php echo esc_attr($block_class); ?>" id="<?php echo esc_attr($block_id); ?>">
    <div class="pb-content-col">
        <div class="pb-block">
            <?php if($top_heading): ?>
                <div class="pb-heading"><?php echo esc_html($top_heading); ?></div>
            <?php endif; ?>
            <?php if($top_text): ?>
                <div class="pb-desc"><?php echo esc_html($top_text); ?></div>
            <?php endif; ?>
        </div>
        <div class="pb-block for-mobile-box">
            <?php if($bottom_heading): ?>
                <div class="pb-heading"><?php echo esc_html($bottom_heading); ?></div>
            <?php endif; ?>
            <?php if($bottom_text): ?>
                <div class="pb-desc"><?php echo esc_html($bottom_text); ?></div>
            <?php endif; ?>
        </div>
        <?php if($button_text && $button_url): ?>
            <div class="pb-button-row">
                <a href="<?php echo esc_url($button_url); ?>" class="pb-btn"><?php echo esc_html($button_text); ?></a>
            </div>
        <?php endif; ?>
    </div>
    <div class="pb-image-col">
        <div class="pb-image-top">
            <?php
            $media_type_top = get_field('pb_media_type_top');
            $image_top = get_field('pb_image_top');
            $youtube_url_top = get_field('pb_youtube_url_top');
            $local_video_top = get_field('pb_local_video_top');
            $video_poster_top = get_field('pb_local_video_poster_top');

            if ($media_type_top === 'youtube' && $youtube_url_top) {
                echo '<div class="pb-video-wrapper">' . wp_oembed_get($youtube_url_top) . '</div>';
            } elseif ($media_type_top === 'local_video' && $local_video_top && $local_video_top['url']) {
                ?>
                <div class="pb-video-wrapper">
                    <?php if ($video_poster_top && $video_poster_top['url']): ?>
                        <img src="<?php echo esc_url($video_poster_top['url']); ?>" alt="Video Placeholder" class="pb-video-poster">
                    <?php else: ?>
                        <div class="media-placeholder">Video Placeholder</div>
                    <?php endif; ?>
                    <button class="pb-video-play-btn" type="button" aria-label="Play video"></button>
                    <video src="<?php echo esc_url($local_video_top['url']); ?>" controls style="width:100%; height:100%; object-fit:cover; display:none;"></video>
                </div>
            <?php } elseif ($media_type_top === 'image' && $image_top && $image_top['url']) { ?>
                <img src="<?php echo esc_url($image_top['url']); ?>" alt="<?php echo esc_attr($image_top['alt']); ?>" style="width:100%; height:100%; object-fit:cover;">
            <?php } else { ?>
                <div class="media-placeholder">Media Placeholder</div>
            <?php } ?>
        </div>

        <div class="pb-image-bottom-left">
            <?php if ($image_bl && is_array($image_bl) && !empty($image_bl['url'])): ?>
                <img decoding="async" loading="lazy" src="<?php echo esc_url($image_bl['url']); ?>" alt="<?php echo esc_attr($image_bl['alt'] ?? 'Bottom Left Image'); ?>">
            <?php else: ?>
                <div class="media-placeholder">[ Bottom Left Image Placeholder ]</div>
            <?php endif; ?>
        </div>

        <div class="pb-image-bottom-right">
            <?php if ($image_br && is_array($image_br) && !empty($image_br['url'])): ?>
                <img decoding="async" loading="lazy" src="<?php echo esc_url($image_br['url']); ?>" alt="<?php echo esc_attr($image_br['alt'] ?? 'Bottom Right Image'); ?>">
            <?php else: ?>
                <div class="media-placeholder">[ Bottom Right Image Placeholder ]</div>
            <?php endif; ?>
        </div>
    </div>
    <div class="pb-content-col for-desktop-box">
        <div class="pb-block">
            <?php if($bottom_heading): ?>
                <div class="pb-heading"><?php echo esc_html($bottom_heading); ?></div>
            <?php endif; ?>
            <?php if($bottom_text): ?>
                <div class="pb-desc"><?php echo esc_html($bottom_text); ?></div>
            <?php endif; ?>
        </div>
        <?php if($button_text && $button_url): ?>
            <div class="pb-button-row">
                <a href="<?php echo esc_url($button_url); ?>" class="pb-btn"><?php echo esc_html($button_text); ?></a>
            </div>
        <?php endif; ?>
    </div>
</div>
