<?php
/**
 * The template for displaying single video posts
 *
 * @package UnitekCollege
 * @since 1.0.0
 */

get_header(); ?>

<style>
    .single-videos {
        background-color: #f0f1f2;
    }

    /* ===================================
   13. SINGLE VIDEO TEMPLATE
   =================================== */

.single-video-template {
    background-color: #F0F1F2;
    min-height: 100vh;
}

/* Video Header Section */
.single-video-header {
    margin: 32px auto 40px;
    max-width: 1728px;
    padding: 0 150px;
}

.single-video-header__content {
    text-align: center;
}

.single-video-header__text {
    display: flex;
    flex-direction: column;
    gap: 16px;
    max-width: 800px;
    margin: 0 auto;
}

.single-video-header__date {
    font-family: 'Outfit', sans-serif;
    font-size: 16px;
    font-weight: 500;
    line-height: 1.25em;
    color: #007ACC;
}

.single-video-header__title {
    font-family: 'Outfit', sans-serif;
    font-size: 48px;
    font-weight: 400;
    line-height: 1.1667em;
    color: #28323C;
    margin: 0;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.single-video-header__subtitle {
    font-family: 'Outfit', sans-serif;
    font-size: 24px;
    font-weight: 400;
    line-height: 1.3333em;
    color: #007ACC;
    margin: 0;
}

/* Video Player Section */
.single-video-player {
    margin: 0 auto 60px;
    max-width: 1728px;
    padding: 0 150px;
}

.single-video-player__wrapper {
    max-width: 1200px;
    margin: 0 auto;
}

.video-embed-wrapper {
    position: relative;
    width: 100%;
    padding-bottom: 56.25%; /* 16:9 aspect ratio */
    height: 0;
    overflow: hidden;
    background: #000;
    border-radius: 12px;
    box-shadow: 0px 4px 8px 0px rgba(48, 48, 48, 0.08);
}

.video-iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
}

.video-popup-link {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
}

.video-thumbnail {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
}

.video-play-button {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1;
    transition: transform 0.3s ease;
}

.video-popup-link:hover .video-play-button {
    transform: translate(-50%, -50%) scale(1.1);
}

.video-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #ACB4BC;
    color: #68747C;
    font-family: 'Outfit', sans-serif;
    font-size: 18px;
    font-weight: 500;
}

/* Video Content Section */
.single-video-content {
    margin: 0 auto 60px;
    max-width: 1000px;
    padding: 0 150px;
}

.single-video-content__body {
    font-family: 'Outfit', sans-serif;
}

.single-video-content__body p {
    font-size: 16px;
    font-weight: 300;
    line-height: 1.5em;
    color: #141A1E;
    margin: 0 0 24px 0;
}

/* Video Share Section */
.single-video-share {
    margin: 60px auto;
    max-width: 1728px;
    padding: 0 150px;
    text-align: center;
}

.single-video-share__title {
    font-family: 'Outfit', sans-serif;
    font-size: 24px;
    font-weight: 600;
    color: #28323C;
    margin: 0 0 24px 0;
}

.single-video-share__icons {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
}

.single-video-share__icons .share-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.2s ease;
}

.single-video-share__icons .share-icon:hover {
    transform: scale(1.1);
}

/* Related Videos Section */
.related-videos {
    margin: 80px auto;
    max-width: 1728px;
    padding: 0 150px;
}

.related-videos__headline {
    font-family: 'Outfit', sans-serif;
    font-size: 32px;
    font-weight: 600;
    color: #28323C;
    margin: 0 0 40px 0;
}

.related-videos__grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 32px;
}

.related-videos__card {
    background: #FFFFFF;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0px 4px 8px 0px rgba(48, 48, 48, 0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.related-videos__card:hover {
    transform: translateY(-4px);
    box-shadow: 0px 8px 16px 0px rgba(48, 48, 48, 0.12);
}

.related-videos__image {
    position: relative;
    width: 100%;
    padding-bottom: 56.25%; /* 16:9 aspect ratio */
    height: 0;
    overflow: hidden;
    background: #ACB4BC;
}

.related-videos__image img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.related-videos__image-link {
    display: block;
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
}

.related-videos__play-overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1;
    opacity: 0.9;
    transition: opacity 0.3s ease;
}

.related-videos__card:hover .related-videos__play-overlay {
    opacity: 1;
}

.related-videos__content {
    padding: 24px;
}

.related-videos__title {
    font-family: 'Outfit', sans-serif;
    font-size: 18px;
    font-weight: 500;
    line-height: 1.4444em;
    color: #28323C;
    margin: 0 0 12px 0;
}

.related-videos__title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.2s ease;
}

.related-videos__title a:hover {
    color: #007ACC;
}

.related-videos__meta {
    display: flex;
    align-items: center;
    gap: 12px;
}

.related-videos__date {
    font-family: 'Outfit', sans-serif;
    font-size: 14px;
    font-weight: 400;
    color: #68747C;
}

/* Responsive Styles for Single Video */
@media (max-width: 1280px) {
    .single-video-header,
    .single-video-player,
    .single-video-content,
    .single-video-share,
    .related-videos {
        padding: 0 40px;
    }
}

@media (max-width: 768px) {
    .single-video-header__title {
        font-size: 32px;
    }
    
    .single-video-header__subtitle {
        font-size: 18px;
    }
    
    .single-video-header,
    .single-video-player,
    .single-video-content,
    .single-video-share,
    .related-videos {
        padding: 0 20px;
    }
    
    .related-videos__grid {
        grid-template-columns: 1fr;
        gap: 24px;
    }
}
</style>

<main id="main-content" class="single-video-template" role="main">
    
    <?php while ( have_posts() ) : the_post(); ?>
        
        <!-- Video Navigation -->
        <div class="single-navigation">
            <div class="single-navigation__container">
                <?php
                $prev_post = get_previous_post( false, '', 'videos' );
                $next_post = get_next_post( false, '', 'videos' );
                ?>
                
                <!-- Previous Video -->
                <?php if ( $prev_post ) : ?>
                    <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="single-nav-link single-nav-link--prev">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <div class="single-nav-text">
                            <span class="single-nav-label">Previous</span>
                        </div>
                    </a>
                <?php endif; ?>
                
                <!-- Back to Videos -->
                <?php 
                // Try to find the News page that lists videos
                $news_page = get_page_by_path('news');
                $videos_url = $news_page ? get_permalink($news_page->ID) : home_url('/news');
                ?>
                <a href="<?php echo esc_url( $videos_url ); ?>" class="single-nav-link single-nav-link--back">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 12h18M3 6h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>Back to Videos</span>
                </a>
                
                <!-- Next Video -->
                <?php if ( $next_post ) : ?>
                    <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="single-nav-link single-nav-link--next">
                        <div class="single-nav-text">
                            <span class="single-nav-label">Next</span>
                        </div>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Video Header Section -->
        <section class="single-video-header">
            <div class="container">
                <div class="single-video-header__content">
                    <div class="single-video-header__text">
                        <span class="single-video-header__date"><?php echo get_the_date( 'F j, Y' ); ?></span>
                        <h1 class="single-video-header__title"><?php the_title(); ?></h1>
                        <?php if ( has_excerpt() ) : ?>
                            <p class="single-video-header__subtitle"><?php echo get_the_excerpt(); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Video Player Section -->
        <section class="single-video-player">
            <div class="container">
                <div class="single-video-player__wrapper">
                    <?php
                    $video_url = get_field("video_url") ?? '';
                    $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                    
                    if ( $video_url ) :
                        // Check if it's a YouTube or Vimeo URL for embedding
                        $is_youtube = preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $video_url, $youtube_matches);
                        $is_vimeo = preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', $video_url, $vimeo_matches);
                        
                        if ( $is_youtube ) :
                            $video_id = $youtube_matches[1];
                            ?>
                            <div class="video-embed-wrapper">
                                <iframe 
                                    src="https://www.youtube.com/embed/<?php echo esc_attr($video_id); ?>?rel=0" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen
                                    class="video-iframe"
                                ></iframe>
                            </div>
                        <?php elseif ( $is_vimeo ) :
                            $video_id = $vimeo_matches[1];
                            ?>
                            <div class="video-embed-wrapper">
                                <iframe 
                                    src="https://player.vimeo.com/video/<?php echo esc_attr($video_id); ?>?title=0&byline=0&portrait=0" 
                                    frameborder="0" 
                                    allow="autoplay; fullscreen; picture-in-picture" 
                                    allowfullscreen
                                    class="video-iframe"
                                ></iframe>
                            </div>
                        <?php else : ?>
                            <!-- Direct video URL or other video service -->
                            <div class="video-embed-wrapper">
                                <a href="<?php echo esc_url($video_url); ?>" class="video-popup-link" target="_blank" rel="noopener">
                                    <?php if ( $featured_img_url ) : ?>
                                        <img src="<?php echo esc_url($featured_img_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="video-thumbnail">
                                        <div class="video-play-button">
                                            <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="40" cy="40" r="40" fill="rgba(0, 0, 0, 0.6)"/>
                                                <path d="M32 24l24 16-24 16V24z" fill="white"/>
                                            </svg>
                                        </div>
                                    <?php else : ?>
                                        <div class="video-placeholder">
                                            <span>Click to play video</span>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    <?php elseif ( $featured_img_url ) : ?>
                        <!-- Fallback: Show featured image if no video URL -->
                        <div class="video-embed-wrapper">
                            <img src="<?php echo esc_url($featured_img_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="video-thumbnail">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        
        <!-- Video Content Section -->
        <?php if ( get_the_content() ) : ?>
        <article class="single-video-content">
            <div class="container">
                <div class="single-video-content__body">
                    <?php the_content(); ?>
                </div>
            </div>
        </article>
        <?php endif; ?>
        
        <!-- Share Section -->
        <div class="single-video-share">
            <div class="container">
                <h3 class="single-video-share__title">Share this video</h3>
                <div class="single-video-share__icons">
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
                </div>
            </div>
        </div>
        
    <?php endwhile; ?>
    
    <!-- Related Videos Section -->
    <!-- <section class="related-videos">
        <div class="container">
            <h2 class="related-videos__headline">Related Videos</h2>
            <div class="related-videos__grid">
                <?php
                $related_args = array(
                    'post_type'      => 'videos',
                    'posts_per_page' => 2,
                    'post__not_in'   => array( get_the_ID() ),
                    'orderby'        => 'rand',
                );
                
                $related_query = new WP_Query( $related_args );
                
                if ( $related_query->have_posts() ) :
                    while ( $related_query->have_posts() ) : $related_query->the_post();
                        $related_video_url = get_field("video_url") ?? '';
                        $related_featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                ?>
                    <article class="related-videos__card">
                        <div class="related-videos__image">
                            <?php if ( $related_featured_img_url ) : ?>
                                <a href="<?php the_permalink(); ?>" class="related-videos__image-link" aria-label="<?php echo esc_attr(get_the_title()); ?>">
                                    <img src="<?php echo esc_url($related_featured_img_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="wp-post-image">
                                    <?php if ( $related_video_url ) : ?>
                                        <div class="related-videos__play-overlay">
                                            <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="30" cy="30" r="30" fill="rgba(0, 0, 0, 0.6)"/>
                                                <path d="M24 18l18 12-18 12V18z" fill="white"/>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            <?php else : ?>
                                <div class="image-placeholder">[ Image ]</div>
                            <?php endif; ?>
                        </div>
                        <div class="related-videos__content">
                            <h3 class="related-videos__title">
                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                    <?php echo wp_trim_words( get_the_title(), 12, '...' ); ?>
                                </a>
                            </h3>
                            <div class="related-videos__meta">
                                <span class="related-videos__date"><?php echo get_the_date('F j, Y'); ?></span>
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
    </section> -->
</main>

<?php get_footer(); ?>

