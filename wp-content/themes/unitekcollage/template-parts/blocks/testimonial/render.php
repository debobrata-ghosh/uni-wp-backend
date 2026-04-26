<?php
/**
 * Testimonial Block Template
 * 
 * @package UnitekCollege
 */

// Get field values
$author_name = get_field( 'author_name' ) ?: 'Anonymous';
$author_role = get_field( 'author_role' ) ?: '';
$message     = get_field( 'message' ) ?: '';
$image       = get_field( 'author_image' );

// Validate required fields but do not block rendering/preview
$required_fields = array(
    'message' => 'Testimonial Message'
);
unitek_college_validate_block_fields( $required_fields, 'Testimonial Block' );

// Get block attributes
$block_id     = $block['id'] ?? '';
$block_class  = $block['className'] ?? '';
$block_anchor = $block['anchor'] ?? '';

// Build CSS classes
$css_classes = array( 'testimonial-block' );
if ( $block_class ) {
    $css_classes[] = $block_class;
}
if ( ! empty( $block['align'] ) ) {
    $css_classes[] = 'align' . $block['align'];
}

$css_class_string = implode( ' ', $css_classes );
?>

<div <?php if ( $block_anchor ): ?>id="<?php echo esc_attr( $block_anchor ); ?>"<?php endif; ?> 
     class="<?php echo esc_attr( $css_class_string ); ?>"
     role="region"
     aria-label="Testimonial">
    
    <?php if ( $image ): ?>
        <img src="<?php echo esc_url( $image['url'] ); ?>" 
             alt="<?php echo esc_attr( $image['alt'] ?: $author_name ); ?>"
             loading="lazy">
    <?php endif; ?>

    <?php if ( $message ): ?>
        <blockquote>
            <p><?php echo esc_html( $message ); ?></p>
            <cite>
                <?php echo esc_html( $author_name ); ?>
                <?php if ( $author_role ): ?> – <?php echo esc_html( $author_role ); ?><?php endif; ?>
            </cite>
        </blockquote>
    <?php endif; ?>
</div>
