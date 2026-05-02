<?php
if (!defined('ABSPATH')) {
  exit;
}

$section_tab_label = 'PROGRAM OVERVIEW'; // Label for backend and preview
$city_title       = get_field('po_city_title');
$main_text        = get_field('po_main_text');
$secondary_text   = get_field('po_secondary_text');
$highlight_text   = get_field('po_highlight_text');
$cta_text         = get_field('po_cta_text');
$cta_url          = get_field('po_cta_url');
$address          = get_field('po_address');
$cityzip          = get_field('po_city_state_zip');
$phone            = get_field('po_phone');
$phone_url        = get_field('po_phone_url');
$map_caption      = get_field('po_map_caption');
$map_image        = get_field('po_map_image');
$map_width        = get_field('po_map_image_width');
$map_height       = get_field('po_map_image_height');
$block_id         = $block['id'] ?? '';
$block_class      = $block['className'] ?? '';

$required_fields = array(
    'po_city_title'        => 'City Title',
    'po_main_text'         => 'Main Text',
    'po_secondary_text'    => 'Secondary Text',
    'po_cta_text'          => 'CTA Text',
    'po_cta_url'           => 'CTA URL',
    'po_address'           => 'Address',
    'po_city_state_zip'    => 'City/State/ZIP',
    'po_phone'             => 'Phone',
);

if (function_exists('unitek_college_validate_block_fields')) {
    unitek_college_validate_block_fields($required_fields, $section_tab_label);
}

$is_preview = (
    ( isset($block['data']['_is_preview']) && $block['data']['_is_preview'] )
    || (is_admin() && !wp_doing_ajax() && !wp_is_json_request())
);

// Default styles for map box dimensions
$map_box_width = !empty($map_width) ? (is_numeric($map_width) ? $map_width . 'px' : $map_width) : '100%';
$map_box_height = !empty($map_height) ? (is_numeric($map_height) ? $map_height . 'px' : $map_height) : '400px';
?>

<style>
.program-overview-section-label {
    font-family: inherit;
    font-weight: 600;
    font-size: 1.1em;
    color: #1976d2;
    background: #e3f1fc;
    padding: 8px 22px;
    border-radius: 20px;
    display: inline-block;
    margin-bottom: 20px;
    letter-spacing: 0.05em;
    box-shadow: 0 2px 6px rgba(21,80,164,0.1);
    user-select: none;
}
.program-overview-block {
    display: flex;
    justify-content: center;
    gap: 60px;
    align-items: flex-start;
    margin-bottom: 80px;
    position: relative;
    padding:40px 0px;
    max-width: 1728px;
    margin: 0 auto;
}
@media (max-width:1150px) {
    .program-overview-block { gap: 30px; }
}
@media (max-width:850px) {
    .program-overview-block { flex-direction: column; gap: 24px; }
}
@media (max-width:480px) {
    .program-overview-block {
        display: inherit;
        padding: 0px 0px;
    }
.po-right-box {
    width: 100% !important;
}
}
.po-left-box {
    background:#fff;
    color:#222;
    border-radius:3px;
    width:40%;                                                                                                                                        
    padding:20px 25px;
}
.po-right-box{width: 39%;}
.po-left-box h2 {
    font-size:2rem;
    font-weight:500;
    margin:0 0 5px;
}
.po-left-box .po-main { margin:10px 0; }
.po-left-box .po-secondary {
    font-size:.98em;
    color:#666;
    margin-bottom:8px;
}
.po-left-box .po-highlight {
    font-size:.98em;
    color:#1976d2;
    margin-bottom:6px;
}
.po-left-box .po-cta { margin-top:14px; }
.po-left-box .po-cta-link {
    color:#2196f3;
    text-decoration:none;
    font-weight:600;
    font-size:.98em;
    transition:.2s;
}
.po-left-box .po-cta-link:hover, .po-left-box .po-cta-link:focus {
    color:#0d4976;
    outline: 2px solid #1976d2;
}
.po-left-box .po-cta-link svg {
    margin-left:4px;
    width:1em;
    vertical-align:-2px;
}
.po-right-info {
    display:grid;
    grid-template-columns:1fr 1fr;
    align-items:center;
    font-size:1.07em;
    margin-bottom:15px;
}
.wp-block-acf-program-overview::before {
    content: "🎓 Program Overview";
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 8px 12px;
    font-size: 11px;
    border-radius: 4px;
    z-index: 10;
    font-weight: 500;
    max-width: 280px;
    text-align: center;
    line-height: 1.3;
}
.po-right-address { text-align:left; }
.po-right-phone { text-align:left; }
.po-right-info span, .po-right-info a { display:block; }
.po-right-info .po-phone { color:#2196f3; font-weight:600; }
@media (max-width:480px) {
    .po-right-info {
        grid-template-columns:1fr;
        row-gap:8px;
    }
    .po-right-phone {
        text-align:left;
    }
}
.po-map-box {
    background:#a6acb1;
    display:flex;
    justify-content:center;
    align-items:center;
    width: <?php echo esc_attr($map_box_width); ?>;
    height: <?php echo esc_attr($map_box_height); ?>;
    border-radius:20px;
    font-size:1.14em;
    color:#495057;
    overflow:hidden;
}
.po-map-box img {
    display:block;
    max-width:100%;
    max-height:100%;
    border-radius:14px;
}
@media (max-width:900px) {
    .po-left-box, .po-map-box { width: 100%; }
    .po-right-box{
    padding: 20px 25px;
    }
}
.program-overview-font{
    font-size:20px
}
.po-secondary.program-overview-font{
    font-size:20px
}
</style>

<section class="program-overview-block <?php echo esc_attr($block_class); ?>" id="<?php echo esc_attr($block_id); ?>" aria-label="Program Overview">

    <div class="po-left-box">
        <?php if ($city_title): ?>
            <h2><?php echo esc_html($city_title); ?></h2>
        <?php endif; ?>
        <?php if ($main_text): ?>
            <div class="po-main program-overview-font"><?php echo esc_html($main_text); ?></div>
        <?php endif; ?>
        <?php if ($secondary_text): ?>
            <div class="po-secondary program-overview-font"><?php echo esc_html($secondary_text); ?></div>
        <?php endif; ?>
        <?php if ($highlight_text): ?>
            <div class="po-highlight"><?php echo esc_html($highlight_text); ?></div>
        <?php endif; ?>
        <?php if ($cta_text && $cta_url): ?>
            <div class="po-cta">
                <a class="btn-apply" href="<?php echo esc_url($cta_url); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr('Learn more: ' . $cta_text); ?>">
                    <?php echo esc_html($cta_text); ?>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 10h12m0 0l-4-4m4 4l-4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                </a>
            </div>
        <?php endif; ?>
    </div>
    <div class="po-right-box">
        <div class="po-right-info">
            <address class="po-right-address">
                <?php if ($address): ?><span><?php echo esc_html($address); ?></span><?php endif; ?>
                <?php if ($cityzip): ?><span><?php echo esc_html($cityzip); ?></span><?php endif; ?>
            </address>
            <div class="po-right-phone">
                <?php if ($phone && $phone_url): ?>
                    <a class="po-phone" href="<?php echo esc_attr('tel:' . preg_replace('/[^0-9+]/', '', $phone)); ?>" aria-label="<?php echo esc_attr('Call ' . $phone); ?>">
                        <?php echo esc_html($phone); ?>
                    </a>
                <?php elseif ($phone): ?>
                    <span class="po-phone"><?php echo esc_html($phone); ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="po-map-box" role="region" aria-label="Location map">
            <?php echo $map_caption; ?>
        </div>
    </div>
</section>
