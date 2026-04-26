<?php
/**
 * The template for displaying all single posts
 *
 * @package UnitekCollege
 * @since 1.0.0
 */

get_header(); ?>

<main id="main-content" class="single-post-template" role="main">
    
    <?php while ( have_posts() ) : the_post(); ?>
        
        <!-- Post Navigation -->
        <div class="single-navigation">
            <div class="single-navigation__container">
                <?php
                $prev_post = get_previous_post();
                $next_post = get_next_post();
                ?>
                
                <!-- Previous Post -->
                <?php if ( $prev_post ) : ?>
                    <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="single-nav-link single-nav-link--prev">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="single-nav-text">
                            <span class="single-nav-label">Previous</span>
                            <!-- <span class="single-nav-title"><?php echo esc_html( wp_trim_words( $prev_post->post_title, 8, '...' ) ); ?></span> -->
                        </div>
                    </a>
                <?php endif; ?>
                
                <!-- Back to Blog -->
                <a href="<?php echo  home_url( '/blog' ) ; ?>" class="single-nav-link single-nav-link--back">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 12h18M3 6h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>Back to Blog</span>
                </a>
                
                <!-- Next Post -->
                <?php if ( $next_post ) : ?>
                    <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="single-nav-link single-nav-link--next">
                        <div class="single-nav-text">
                            <span class="single-nav-label">Next</span>
                            <!-- <span class="single-nav-title"><?php echo esc_html( wp_trim_words( $next_post->post_title, 8, '...' ) ); ?></span> -->
                        </div>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Header Section -->
        <section class="single-header">
            <div class="single-header__container">
                <div class="single-header__content">
                    <div class="single-header__text">
                        <?php
                        $categories = get_the_category();
                        if ( ! empty( $categories ) ) :
                        ?>
                            <span class="single-header__date"><?php echo get_the_date( 'F j, Y' ); ?></span>
                        <?php endif; ?>
                        
                        <h1 class="single-header__title"><?php the_title(); ?></h1>
                        
                        <?php if ( has_excerpt() ) : ?>
                            <p class="single-header__subtitle"><?php echo get_the_excerpt(); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="single-header__image">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'large', array( 'alt' => get_the_title() ) ); ?>
                    <?php else : ?>
                        <span class="image-placeholder-text">[ Image ]</span>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        
        <!-- Content Section -->
        <article class="single-content">
            <div class="single-content__body">
                <?php the_content(); ?>
            </div>
            
            <!-- Share Section -->
            <div class="single-share">
                <h3 class="single-share__title">Share this entry.</h3>
                <div class="single-share__icons">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink() ); ?>" target="_blank" rel="noopener" aria-label="Share on Facebook" class="share-icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="16" cy="16" r="14" fill="#1877F2"/>
                            <path d="M21 16.5h-3.5v9h-3v-9H12v-3h2.5v-2c0-2.5 1.5-4 4-4h2.5v3h-1.5c-.828 0-1.5.672-1.5 1.5v1.5h3l-.5 3z" fill="white"/>
                        </svg>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode( get_permalink() ); ?>&text=<?php echo urlencode( get_the_title() ); ?>" target="_blank" rel="noopener" aria-label="Share on Twitter" class="share-icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="16" cy="16" r="14" fill="#1DA1F2"/>
                            <path d="M24 10.5c-.6.3-1.2.4-1.9.5.7-.4 1.2-1 1.4-1.8-.6.4-1.3.6-2.1.8-.6-.6-1.5-1-2.4-1-1.7 0-3.2 1.5-3.2 3.3 0 .3 0 .5.1.7-2.7-.1-5.2-1.4-6.8-3.4-.3.5-.4 1-.4 1.7 0 1.1.6 2.1 1.5 2.7-.5 0-1-.2-1.4-.4v.1c0 1.6 1.1 2.9 2.6 3.2-.3.1-.6.1-.9.1-.2 0-.4 0-.6-.1.4 1.3 1.6 2.3 3.1 2.3-1.1.9-2.5 1.4-4.1 1.4H8c1.5.9 3.2 1.5 5 1.5 6 0 9.3-5 9.3-9.3v-.4c.7-.5 1.3-1.1 1.7-1.8z" fill="white"/>
                        </svg>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode( get_permalink() ); ?>&title=<?php echo urlencode( get_the_title() ); ?>" target="_blank" rel="noopener" aria-label="Share on LinkedIn" class="share-icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="16" cy="16" r="14" fill="#0077B5"/>
                            <path d="M11.5 13.5h-2v8h2v-8zm-1-3c-.7 0-1.2.5-1.2 1.2s.5 1.3 1.2 1.3 1.2-.6 1.2-1.3-.5-1.2-1.2-1.2zm10.5 6.7c0-2.1-1.3-3.2-3.1-3.2-1.4 0-2 .8-2.4 1.3v-1.3h-2v8h2v-4.5c0-.9.2-1.8 1.3-1.8s1.2.9 1.2 1.8v4.5h2v-4.8z" fill="white"/>
                        </svg>
                    </a>
                    <a href="mailto:?subject=<?php echo urlencode( get_the_title() ); ?>&body=<?php echo urlencode( get_permalink() ); ?>" aria-label="Share via Email" class="share-icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="16" cy="16" r="14" fill="#68747C"/>
                            <path d="M22 10H10c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-8c0-1.1-.9-2-2-2zm0 3l-6 3.75L10 13v-1l6 3.75L22 12v1z" fill="white"/>
                        </svg>
                    </a>
                    <a href="javascript:void(0);" onclick="navigator.clipboard.writeText('<?php echo esc_js( get_permalink() ); ?>'); alert('Link copied to clipboard!');" aria-label="Copy link" class="share-icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="16" cy="16" r="14" fill="#28323C"/>
                            <path d="M17.5 13.5l-1.4 1.4 2.1 2.1H12v2h6.2l-2.1 2.1 1.4 1.4 4.5-4.5-4.5-4.5zm-9-1.5h5v-2h-5c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h5v-2h-5v-8z" fill="white"/>
                        </svg>
                    </a>
                    <a href="javascript:void(0);" onclick="window.print();" aria-label="Print article" class="share-icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="16" cy="16" r="14" fill="#007ACC"/>
                            <path d="M21 12H11c-1.1 0-2 .9-2 2v4h2v2h10v-2h2v-4c0-1.1-.9-2-2-2zm-1 6H12v-3h8v3zm1-4.5c-.4 0-.8-.3-.8-.8 0-.4.3-.7.8-.7.4 0 .8.3.8.8 0 .4-.4.7-.8.7zM20 9H12v3h8V9z" fill="white"/>
                        </svg>
                    </a>
                    <a href="javascript:void(0);" onclick="if(navigator.share){navigator.share({title:'<?php echo esc_js( get_the_title() ); ?>',url:'<?php echo esc_js( get_permalink() ); ?>'});}" aria-label="Share" class="share-icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="16" cy="16" r="14" fill="#B4E850"/>
                            <path d="M19 11c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm-6 12c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm6 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm-8.6-7.5l6.9 4m.8-11l-6.9 4" stroke="#28323C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="javascript:void(0);" onclick="if(window.getSelection){var selection=window.getSelection();var range=document.createRange();range.selectNodeContents(document.querySelector('.single-content__body'));selection.removeAllRanges();selection.addRange(range);document.execCommand('copy');alert('Content copied!');}" aria-label="Copy content" class="share-icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="16" cy="16" r="14" fill="#50D8FF"/>
                            <path d="M18 10h-8c-1.1 0-2 .9-2 2v8h2v-8h8v-2zm3 4h-7c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h7c1.1 0 2-.9 2-2v-8c0-1.1-.9-2-2-2zm0 10h-7v-8h7v8z" fill="white"/>
                        </svg>
                    </a>
                    <a href="javascript:void(0);" onclick="var bookmarkUrl=this.getAttribute('data-url');var bookmarkTitle=this.getAttribute('data-title');if(window.sidebar&&window.sidebar.addPanel){window.sidebar.addPanel(bookmarkTitle,bookmarkUrl,'');}else if(window.external&&('AddFavorite' in window.external)){window.external.AddFavorite(bookmarkUrl,bookmarkTitle);}else{alert('Press Ctrl+D (Cmd+D on Mac) to bookmark this page');}" data-url="<?php echo esc_url( get_permalink() ); ?>" data-title="<?php echo esc_attr( get_the_title() ); ?>" aria-label="Bookmark" class="share-icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="16" cy="16" r="14" fill="#FF6B6B"/>
                            <path d="M19 9H13c-1.1 0-2 .9-2 2v12l5-2.2 5 2.2V11c0-1.1-.9-2-2-2z" fill="white"/>
                        </svg>
                    </a>
                </div>
                
                <!-- Disclaimer -->
                <p class="single-disclaimer">
                    While this blog may occasionally contain information that relates to Unitek College's programs or courses, the majority of information provided within this blog is for general informational purposes only and is not intended to represent the specific details of any educational offerings or opinions of Unitek College. *Please note that wage data provided by the Bureau of Labor Statistics (BLS) or other third-party sources may not be an accurate reflection of all areas of the country, may not account for the employees' years of experience, and may not reflect the wages or outlook of entry-level employees, such as graduates of our program. (accessed on <?php echo date( 'm/d/Y' ); ?>)
                </p>
            </div>
        </article>
        
    <?php endwhile; ?>
    
   
    
    <!-- Get Started Today (Dark Background) Block - Full Width -->
    <?php
    // Render the Get Started Today Dark Background Block
    if ( function_exists( 'acf' ) ) {
        echo do_blocks( '<!-- wp:acf/get-started-today-dark {"align":"full"} /-->' );
    }
    ?>
     <!-- Related News Section -->
     <section class="Related-Posts">
        <div class="container">
            <h2 class="Related-Posts-headline">Related Posts</h2>
            <div class="Related-Posts-grid">
                <?php
                // Get related posts from the same category
                $categories = get_the_category();
                $category_ids = array();
                if ( $categories ) {
                    foreach ( $categories as $category ) {
                        $category_ids[] = $category->term_id;
                    }
                }
                
                $related_args = array(
                    'post_type'      => 'post',
                    'posts_per_page' => 3,
                    'post__not_in'   => array( get_the_ID() ),
                    'category__in'   => $category_ids,
                    'orderby'        => 'rand',
                );
                
                $related_query = new WP_Query( $related_args );
                
                if ( $related_query->have_posts() ) :
                    while ( $related_query->have_posts() ) : $related_query->the_post();
                        $post_categories = get_the_category();
                        $category_name = ! empty( $post_categories ) ? $post_categories[0]->name : 'News';
                ?>
                    <article class="Related-Posts-card">
                        <div class="news-image">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php 
                                $thumbnail_id = get_post_thumbnail_id();
                                $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'medium')[0];
                                $thumbnail_alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
                                ?>
                                <a href="<?php the_permalink(); ?>" class="news-image-link" aria-label="<?php echo esc_attr(get_the_title()); ?>">
                                    <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr($thumbnail_alt); ?>" class="wp-post-image">
                                </a>
                            <?php else : ?>
                                <div class="image-placeholder">[ Image ]</div>
                            <?php endif; ?>
                            <div class="category-tag"><?php echo esc_html($category_name); ?></div>
                        </div>
                        <div class="Related-Posts-content">
                            <div class="article-card__overlay">
                                <div class="article-card__meta">
                                    <span class="article-card__date"><?php echo get_the_date('F j, Y'); ?></span>
                                    <span class="article-card__divider"></span>
                                    <span class="article-card__author"><?php echo esc_html(get_the_author()); ?></span>
                                </div>
                                <h3 class="article-card__title">
                                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                                        <?php echo wp_trim_words( get_the_title(), 12, '...' ); ?>
                                    </a>
                                </h3>
                                <a href="<?php the_permalink(); ?>" class="article-card__footer">
                                    <span>Read more</span>
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 10h12m0 0l-4-4m4 4l-4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
