<?php
/**
 * Hero Block Template
 * 
 * @package UnitekCollege
 */

// Get the field values
$headline    = get_field( 'hero_headline' );
$subheadline = get_field( 'hero_subheadline' );
$hero_image  = get_field( 'hero_image' );

// Validation for required fields
$required_fields = array(
    'hero_headline' => 'Headline'
);

// Validate required fields but do not block rendering/preview
unitek_college_validate_block_fields( $required_fields, 'Hero Block' );

// Get block attributes
$block_id     = $block['id'] ?? '';
$block_class  = $block['className'] ?? '';
$block_anchor = $block['anchor'] ?? '';

// Build CSS classes
$css_classes = array( 'hero-block' );
if ( $block_class ) {
    $css_classes[] = $block_class;
}
if ( ! empty( $block['align'] ) ) {
    $css_classes[] = 'align' . $block['align'];
}

$css_class_string = implode( ' ', $css_classes );
?>

<section <?php if ( $block_anchor ): ?>id="<?php echo esc_attr( $block_anchor ); ?>"<?php endif; ?> 
         class="<?php echo esc_attr( $css_class_string ); ?>"
         role="region"
         aria-label="Hero section">
    <div class="hero-container">
        <!-- Left Column - Text Content -->
        <div class="hero-text-column">
            <div class="hero-content">
                <?php if ( $headline ): ?>
                    <h1 class="hero-headline"><?php echo esc_html( $headline ); ?></h1>
                <?php endif; ?>
                <?php if ( $subheadline ): ?>
                    <p class="hero-subheadline"><?php echo esc_html( $subheadline ); ?></p>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Right Column - Image -->
        <div class="hero-image-column">
            <?php if ( $hero_image ): ?>
                <div class="hero-image-wrapper">
                    <img src="<?php echo esc_url( $hero_image['url'] ); ?>" 
                         alt="<?php echo esc_attr( $hero_image['alt'] ?: $headline ); ?>" 
                         class="hero-image"
                         loading="lazy"
                         width="<?php echo esc_attr( $hero_image['width'] ?? '' ); ?>"
                         height="<?php echo esc_attr( $hero_image['height'] ?? '' ); ?>">
                </div>
            <?php else: ?>
                <div class="hero-image-placeholder" role="img" aria-label="Image placeholder">
                    <span class="placeholder-text">[ Image ]</span>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
