<?php
/**
 * Page Sub Navigation Bar Block Template
 * 
 * @package UnitekCollege
 */

// Get the field values
$nav_items = get_field( 'page-sub-nav-items' );

// Get block attributes
$block_id     = $block['id'] ?? '';
$block_class  = $block['className'] ?? '';
$block_anchor = $block['anchor'] ?? '';

// Build CSS classes
$css_classes = array( 'page-sub-nav-bar-block' );
if ( $block_class ) {
    $css_classes[] = $block_class;
}
if ( ! empty( $block['align'] ) ) {
    $css_classes[] = 'align' . $block['align'];
}

$css_class_string = implode( ' ', $css_classes );

// If no navigation items, don't render
if ( empty( $nav_items ) || ! is_array( $nav_items ) ) {
    return;
}
?>

<nav <?php if ( $block_anchor ): ?>id="<?php echo esc_attr( $block_anchor ); ?>"<?php endif; ?> 
     class="<?php echo esc_attr( $css_class_string ); ?>"
     role="navigation"
     aria-label="Page sub navigation">
    
    <div class="page-sub-nav-bar-container">
        <div class="page-sub-nav-bar-wrapper">
            <ul class="page-sub-nav-bar-list">
                <?php foreach ( $nav_items as $index => $item ): 
                    $label = $item['label'] ?? '';
                    $url = $item['url'] ?? '';
                    $anchor = $item['anchor'] ?? '';
                    
                    // Skip if no label
                    if ( empty( $label ) ) {
                        continue;
                    }
                    
                    // Determine the href
                    $href = '#';
                    if ( ! empty( $url ) ) {
                        $href = esc_url( $url );
                    } elseif ( ! empty( $anchor ) ) {
                        $href = '#' . esc_attr( $anchor );
                    }
                ?>
                    <li class="page-sub-nav-bar-item">
                        <a href="<?php echo esc_attr( $href ); ?>" 
                           class="page-sub-nav-bar-link"
                           <?php if ( ! empty( $anchor ) && empty( $url ) ): ?>
                               data-anchor="<?php echo esc_attr( $anchor ); ?>"
                           <?php endif; ?>>
                            <?php echo esc_html( $label ); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <!-- Mobile Chevron Icon - Clickable -->
            <button type="button" class="page-sub-nav-bar-chevron" aria-label="Scroll navigation right">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
    </div>
    
    <div class="page-sub-nav-bar-rule"></div>
</nav>

