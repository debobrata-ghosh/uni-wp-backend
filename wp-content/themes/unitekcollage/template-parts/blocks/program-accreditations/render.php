<?php
// Get the field values - CHANGED FIELD NAMES
$title = get_field('program_accreditations_title');
$description = get_field('program_accreditations_description');
$view_all_text = get_field('program_accreditations_view_all_text');
$view_all_url = get_field('program_accreditations_view_all_url');
$accreditation_items = get_field('program_accreditations_items');

$required_fields = array(
    'program_accreditations_title'            => 'Accreditations Title',
    //'program_accreditations_description'      => 'Accreditations Description',
    'program_accreditations_view_all_text'    => 'View All Text',
    'program_accreditations_view_all_url'     => 'View All URL',
    //'program_accreditations_items'             => 'Accreditation Items',
);

unitek_college_validate_block_fields($required_fields, 'PROGRAM ACCREDITATIONS');

$is_preview = ( isset($block['data']['_is_preview']) && $block['data']['_is_preview'] )
              || (is_admin() && !wp_doing_ajax() && !wp_is_json_request());
// Set default values if fields are empty
if (!is_array($accreditation_items)) {
    $accreditation_items = array();
}

// Get block attributes
$block_id = $block['id'] ?? '';
$block_class = $block['className'] ?? '';
$block_anchor = $block['anchor'] ?? '';

// Build CSS classes - CHANGED BASE CSS CLASS
$css_classes = array('program-accreditations-block');
if ($block_class) {
    $css_classes[] = $block_class;
}
if ($block['align']) {
    $css_classes[] = 'align' . $block['align'];
}

$css_class_string = implode(' ', $css_classes);
?>

<style>
/* Editor overflow fix for program accreditations block - CHANGED CSS SELECTORS */
.block-editor-block-list__layout .program-accreditations-block,
.editor-styles-wrapper .program-accreditations-block,
.wp-block-acf-program-accreditations .program-accreditations-block {
    max-width: 100%;
    overflow-x: hidden;
}

/* Program Accreditations Block Styles - CHANGED BASE CSS CLASS */
.program-accreditations-block {
    width: 100%;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
    background-color: #f5f5f5;
    padding: 100px 0;
    color: #333333;
    box-sizing: border-box;
}

/* CHANGED ALL CSS SELECTORS */
.program-accreditations-content {
    max-width: 1440px;
    margin: 0 auto;
    padding: 0 80px;
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 60px;
    align-items: start;
    box-sizing: border-box;
}

.program-accreditations-left {
    display: flex;
    flex-direction: column;
    gap: 24px;
    min-width: 0;
    box-sizing: border-box;
}

.program-accreditations-title {
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1.2;
    color: #333333;
    margin: 0;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.program-accreditations-description {
    font-size: 1rem;
    line-height: 1.6;
    color: #666666;
    margin: 0;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.program-accreditations-right {
    position: relative;
    min-width: 0;
    box-sizing: border-box;
}

.program-accreditations-view-all {
    position: absolute;
    top: 0;
    right: 0;
    z-index: 10;
}

.program-accreditations-view-all a {
    color: #2196f3;
    text-decoration: none;
    font-size: 1rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: all 0.3s ease;
}

.program-accreditations-view-all a:hover {
    text-decoration: underline;
}

.program-accreditations-view-all a::after {
    content: '→';
    font-size: 0.9rem;
}

.program-accreditations-items {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 0;
    margin-top: 40px;
    box-sizing: border-box;
}

.program-accreditations-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 15px;
    position: relative;
    min-width: 0;
    box-sizing: border-box;
}

.program-accreditations-item:not(:last-child)::after {
    content: '';
    position: absolute;
    right: 0;
    top: 20px;
    bottom: 20px;
    width: 1px;
    background-color: #e0e0e0;
}

.program-accreditations-item-logo {
    margin-bottom: 16px;
    max-width: 100px;
    height: auto;
    width: 100%;
}

.program-accreditations-item-logo img {
    max-width: 100%;
    height: auto;
    display: block;
}

.program-accreditations-item-title {
    font-size: 0.85rem;
    font-weight: 700;
    color: #333333;
    margin: 0 0 8px 0;
    line-height: 1.3;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.program-accreditations-item-description {
    font-size: 0.75rem;
    color: #666666;
    margin: 0;
    line-height: 1.4;
    text-align: center;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

/* Block Alignment Support - CHANGED CSS SELECTORS */
.program-accreditations-block.alignwide {
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
}

.program-accreditations-block.alignfull {
    max-width: 100vw;
    margin-left: calc(50% - 50vw);
    margin-right: calc(50% - 50vw);
}

/* Fix for editor - prevent overflow - CHANGED CSS SELECTORS */
.block-editor-block-list__layout .program-accreditations-block.alignfull,
.editor-styles-wrapper .program-accreditations-block.alignfull,
.wp-block-acf-program-accreditations .program-accreditations-block.alignfull {
    max-width: 100%;
    margin-left: 0;
    margin-right: 0;
}

/* Responsive Design - CHANGED CSS SELECTORS */
@media (max-width: 1200px) {
    .program-accreditations-content {
        padding: 0 40px;
    }
}

@media (max-width: 768px) {
    .program-accreditations-block {
        padding: 80px 0;
    }
    
    .program-accreditations-content {
        padding: 0 20px;
        grid-template-columns: 1fr;
        gap: 60px;
    }
    
    .program-accreditations-title {
        font-size: 2rem;
    }
    
    .program-accreditations-view-all {
        position: static;
        margin-bottom: 20px;
        text-align: center;
    }
    
    .program-accreditations-items {
        grid-template-columns: 1fr;
        gap: 20px;
        margin-top: 20px;
    }
    
    .program-accreditations-item:not(:last-child)::after {
        display: none;
    }
    
    .program-accreditations-item {
        padding: 20px 0;
        border-bottom: 1px solid #e0e0e0;
    }
    
    .program-accreditations-item:last-child {
        border-bottom: none;
    }
}

@media (max-width: 480px) {
    .program-accreditations-block {
        padding: 60px 0;
    }
    
    .program-accreditations-content {
        padding: 0 16px;
        gap: 40px;
    }
    
    .program-accreditations-title {
        font-size: 1.8rem;
    }
    
    .program-accreditations-item {
        padding: 16px 0;
    }
    
    .program-accreditations-item-logo {
        max-width: 100px;
        margin-bottom: 12px;
    }
}

/* Editor Preview Styles - CHANGED CSS SELECTORS AND CONTENT */
.wp-block-acf-program-accreditations .program-accreditations-block {
    border: 2px dashed #ccc;
    position: relative;
}

.wp-block-acf-program-accreditations .program-accreditations-block::after {
    content: "🎓 Program Accreditations";
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(0,0,0,0.8);
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
</style>

<section <?php if ($block_anchor): ?>id="<?php echo esc_attr($block_anchor); ?>"<?php endif; ?> 
         class="<?php echo esc_attr($css_class_string); ?>"
         role="region"
         aria-label="Program accreditations section">
    
    <div class="program-accreditations-content">
        <div class="program-accreditations-left">
            <?php if ($title): ?>
                <h2 class="program-accreditations-title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
            <?php if ($description): ?>
                <div class="program-accreditations-description">
                    <?php echo wp_kses_post($description); ?>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="program-accreditations-right">
            <?php if ($view_all_text && $view_all_url): ?>
                <div class="program-accreditations-view-all">
                    <a href="<?php echo esc_url($view_all_url); ?>"><?php echo esc_html($view_all_text); ?></a>
                </div>
            <?php endif; ?>
            
            <div class="program-accreditations-items">
                <?php foreach ($accreditation_items as $item): ?>
                    <div class="program-accreditations-item">
                        <?php 
                            // CHANGED FIELD NAMES
                            $logo_field = $item['program_accreditation_logo'] ?? null;
                            $item_title = $item['program_accreditation_title'] ?? '';
                            $item_description = $item['program_accreditation_description'] ?? '';
                        ?>
                        
                        <?php if ($logo_field && !empty($logo_field['url'])): ?>
                            <div class="program-accreditations-item-logo">
                                <img src="<?php echo esc_url($logo_field['url']); ?>" 
                                     alt="<?php echo esc_attr($logo_field['alt'] ?? $item_title); ?>">
                            </div>
                        <?php endif; ?>
                        
                        <h3 class="program-accreditations-item-title">
                            <?php echo esc_html($item_title); ?>
                        </h3>
                        
                        <?php if ($item_description): ?>
                            <p class="program-accreditations-item-description">
                                <?php echo esc_html($item_description); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>