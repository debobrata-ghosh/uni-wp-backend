<?php
/**
 * Page Title Block Template
 * 
 * @package UnitekCollege
 */

$config = isset( $GLOBALS['_uc_pt_config'] ) ? $GLOBALS['_uc_pt_config'] : array();
if ( ! empty( $config ) && ! in_array( get_the_ID(), $config, true ) ) {
    return;
}

// Get the field values
$headline            = get_field( 'page-title_headline' );
$subheadline         = get_field( 'page-title_subheadline' );
$page_image          = get_field( 'page-title_image' );
$get_started_title   = get_field( 'page-title_get_started_title' );
$get_started_url     = get_field( 'page-title_get_started_url' );
$apply_now_title     = get_field( 'page-title_apply_now_title' );
$apply_now_url       = get_field( 'page-title_apply_now_url' );

// Set default URLs to home URL if empty (only if button title exists)
if ( ! empty( $get_started_title ) ) {
    if ( empty( $get_started_url ) ) {
        $get_started_url = function_exists( 'home_url' ) ? home_url() : '#';
    } else {
        // Prepend home_url() if the URL is relative (doesn't start with http://, https://, or #)
        if ( is_string( $get_started_url ) && ! preg_match( '/^https?:\/\//', $get_started_url ) && ! preg_match( '/^#/', $get_started_url ) ) {
            $get_started_url = function_exists( 'home_url' ) ? home_url( $get_started_url ) : $get_started_url;
        }
    }
}
if ( ! empty( $apply_now_title ) ) {
    if ( empty( $apply_now_url ) ) {
        $apply_now_url = function_exists( 'home_url' ) ? home_url() : '#';
    } else {
        // Prepend home_url() if the URL is relative (doesn't start with http://, https://, or #)
        if ( is_string( $apply_now_url ) && ! preg_match( '/^https?:\/\//', $apply_now_url ) && ! preg_match( '/^#/', $apply_now_url ) ) {
            $apply_now_url = function_exists( 'home_url' ) ? home_url( $apply_now_url ) : $apply_now_url;
        }
    }
}

// If headline is empty, use page title as fallback
if ( empty( $headline ) ) {
    $headline = get_the_title();
}

// Generate programmatic breadcrumbs
if ( ! function_exists( 'unitek_get_breadcrumbs' ) ) {
    function unitek_get_breadcrumbs() {
        $breadcrumbs = array();
        
        // Always start with Home
        $home_url = function_exists( 'home_url' ) ? home_url() : '#';
        $breadcrumbs[] = array(
            'label' => 'Home',
            'url' => $home_url,
        );
        
        // Handle different page types
        if ( is_page() ) {
            // Get page hierarchy
            $page_id = get_the_ID();
            if ( $page_id ) {
                $ancestors = get_post_ancestors( $page_id );
                
                // Add parent pages in reverse order (top to bottom)
                if ( ! empty( $ancestors ) ) {
                    $ancestors = array_reverse( $ancestors );
                    foreach ( $ancestors as $ancestor_id ) {
                        $ancestor_title = get_the_title( $ancestor_id );
                        $ancestor_url = get_permalink( $ancestor_id );
                        if ( $ancestor_title && $ancestor_url ) {
                            $breadcrumbs[] = array(
                                'label' => $ancestor_title,
                                'url' => $ancestor_url,
                            );
                        }
                    }
                }
                
                // Add current page (not linked)
                $current_title = get_the_title();
                if ( $current_title ) {
                    $breadcrumbs[] = array(
                        'label' => $current_title,
                        'url' => '',
                    );
                }
            }
        } elseif ( is_single() ) {
            // For single posts, show category or post type archive
            $post_type = get_post_type();
            if ( $post_type ) {
                $post_type_obj = get_post_type_object( $post_type );
                
                if ( $post_type_obj && isset( $post_type_obj->has_archive ) && $post_type_obj->has_archive ) {
                    $archive_url = get_post_type_archive_link( $post_type );
                    if ( $archive_url ) {
                        $breadcrumbs[] = array(
                            'label' => $post_type_obj->labels->name,
                            'url' => $archive_url,
                        );
                    }
                }
            }
            
            // Add current post (not linked)
            $current_title = get_the_title();
            if ( $current_title ) {
                $breadcrumbs[] = array(
                    'label' => $current_title,
                    'url' => '',
                );
            }
        } elseif ( is_category() ) {
            $cat_title = single_cat_title( '', false );
            if ( $cat_title ) {
                $breadcrumbs[] = array(
                    'label' => $cat_title,
                    'url' => '',
                );
            }
        } elseif ( is_tag() ) {
            $tag_title = single_tag_title( '', false );
            if ( $tag_title ) {
                $breadcrumbs[] = array(
                    'label' => $tag_title,
                    'url' => '',
                );
            }
        } elseif ( is_archive() ) {
            $archive_title = get_the_archive_title();
            if ( $archive_title ) {
                $breadcrumbs[] = array(
                    'label' => $archive_title,
                    'url' => '',
                );
            }
        } elseif ( is_search() ) {
            $breadcrumbs[] = array(
                'label' => 'Search Results',
                'url' => '',
            );
        } elseif ( is_404() ) {
            $breadcrumbs[] = array(
                'label' => '404 - Page Not Found',
                'url' => '',
            );
        }
        
        return $breadcrumbs;
    }
}

$breadcrumbs = array();
if ( function_exists( 'unitek_get_breadcrumbs' ) ) {
    $breadcrumbs = unitek_get_breadcrumbs();
}

// Get block attributes
$block_id     = $block['id'] ?? '';
$block_class  = $block['className'] ?? '';
$block_anchor = $block['anchor'] ?? '';

// Build CSS classes
$css_classes = array( 'page-title-block' );
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
         aria-label="Page title section">
    <div class="page-title-container">
        <!-- Left Column - Content Panel -->
        <div class="page-title-content-panel">
            <div class="page-title-content">
                <?php if ( ! empty( $breadcrumbs ) && count( $breadcrumbs ) > 1 ): ?>
                    <nav class="page-title-breadcrumb" aria-label="Breadcrumb">
                        <ol class="page-title-breadcrumb-list">
                            <?php 
                            $breadcrumb_count = count( $breadcrumbs );
                            foreach ( $breadcrumbs as $index => $crumb ): 
                                $is_last = ( $index + 1 ) === $breadcrumb_count;
                            ?>
                                <li class="page-title-breadcrumb-item">
                                    <?php if ( $is_last || empty( $crumb['url'] ) ): ?>
                                        <span class="page-title-breadcrumb-current" aria-current="page">
                                            <?php echo esc_html( $crumb['label'] ); ?>
                                        </span>
                                    <?php else: ?>
                                        <a href="<?php echo esc_url( $crumb['url'] ); ?>" class="page-title-breadcrumb-link">
                                            <?php echo esc_html( $crumb['label'] ); ?>
                                        </a>
                                        <span class="page-title-breadcrumb-separator" aria-hidden="true">/</span>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ol>
                    </nav>
                <?php endif; ?>
                
                <?php if ( ! empty( $headline ) ): ?>
                    <h1 class="page-title-headline"><?php echo esc_html( $headline ); ?></h1>
                <?php endif; ?>
                <?php if ( ! empty( $subheadline ) ): ?>
                    <p class="page-title-subheadline"><?php echo esc_html( $subheadline ); ?></p>
                <?php endif; ?>
                
                <?php if ( ! empty( $get_started_title ) || ! empty( $apply_now_title ) ): ?>
                    <div class="page-title-buttons">
                        <?php if ( ! empty( $get_started_title ) ): ?>
                            <a href="<?php echo esc_url( $get_started_url ); ?>" class="page-title-button page-title-button--get-started">
                                <?php echo esc_html( $get_started_title ); ?>
                            </a>
                        <?php endif; ?>
                        <?php if ( ! empty( $apply_now_title ) ): ?>
                            <a href="<?php echo esc_url( $apply_now_url ); ?>" class="page-title-button page-title-button--apply-now">
                                <?php echo esc_html( $apply_now_title ); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Right Column - Image -->
        <?php if ( $page_image ): ?>
            <div class="page-title-image-column">
                <div class="page-title-image-wrapper">
                    <img src="<?php echo esc_url( $page_image['url'] ); ?>" 
                         alt="<?php echo esc_attr( $page_image['alt'] ?: ( ! empty( $headline ) ? $headline : get_the_title() ) ); ?>" 
                         class="page-title-image"
                         loading="lazy"
                         width="<?php echo esc_attr( $page_image['width'] ?? '' ); ?>"
                         height="<?php echo esc_attr( $page_image['height'] ?? '' ); ?>">
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

