<?php
/**
 * Wave Divider Block Template
 * 
 * @package UnitekCollege
 */

// Get the field values
$direction     = get_field( 'wave-divider_direction' ) ?: 'top-bottom';
$width         = get_field( 'wave-divider_width' ) ?: 'full';

// Get block attributes
$block_id     = $block['id'] ?? '';
$block_class  = $block['className'] ?? '';
$block_anchor = $block['anchor'] ?? '';

// Build CSS classes
$css_classes = array( 'wave-divider-block' );
if ( $block_class ) {
    $css_classes[] = $block_class;
}
if ( ! empty( $block['align'] ) ) {
    $css_classes[] = 'align' . $block['align'];
}
if ( $direction === 'bottom-top' ) {
    $css_classes[] = 'wave-direction-bottom-top';
}
if ( $width === 'container' ) {
    $css_classes[] = 'wave-width-container';
}

$css_class_string = implode( ' ', $css_classes );

// Get image paths
$block_dir = get_template_directory_uri() . '/template-parts/blocks/wave-divider/media';
$desktop_image = $block_dir . '/1920 Wave (1).png';
$tablet_image = $block_dir . '/1024 Wave.png';
$mobile_image = $block_dir . '/600 Wave.png';
?>

<section <?php if ( $block_anchor ): ?>id="<?php echo esc_attr( $block_anchor ); ?>"<?php endif; ?> 
         class="<?php echo esc_attr( $css_class_string ); ?>"
         role="region"
         aria-label="Wave divider section"
>
    
    <div class="wave-divider-wrapper">
        <!-- Desktop Wave Image (1920px) -->
        <img src="<?php echo esc_url( $desktop_image ); ?>" 
             alt="Wave divider - Desktop" 
             class="wave-divider-image wave-divider-desktop"
             loading="lazy"
             aria-hidden="true">
        
        <!-- Tablet Wave Image (1024px) -->
        <img src="<?php echo esc_url( $tablet_image ); ?>" 
             alt="Wave divider - Tablet" 
             class="wave-divider-image wave-divider-tablet"
             loading="lazy"
             aria-hidden="true">
        
        <!-- Mobile Wave Image (600px) -->
        <img src="<?php echo esc_url( $mobile_image ); ?>" 
             alt="Wave divider - Mobile" 
             class="wave-divider-image wave-divider-mobile"
             loading="lazy"
             aria-hidden="true">
    </div>
</section>

