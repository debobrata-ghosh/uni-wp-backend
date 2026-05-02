<?php
/**
 * The template for displaying single news posts
 *
 * @package UnitekCollege
 * @since 1.0.0
 */

get_header(); ?>

<style>
    .single-news {
        background-color: #f0f1f2;
    }

    /* ===================================
   13. SINGLE NEWS TEMPLATE
   =================================== */

.single-news-template {
    background-color: #F0F1F2;
    min-height: 100vh;
}

/* News Header Section */
.single-news-header {
    margin: 32px auto 40px;
    max-width: 1728px;
    padding: 0 150px;
}

.single-news-header__content {
    text-align: center;
}

.single-news-header__text {
    display: flex;
    flex-direction: column;
    gap: 16px;
    max-width: 800px;
    margin: 0 auto;
}

.single-news-header__date {
    font-family: 'Outfit', sans-serif;
    font-size: 16px;
    font-weight: 500;
    line-height: 1.25em;
    color: #007ACC;
}

.single-news-header__title {
    font-family: 'Outfit', sans-serif;
    font-size: 48px;
    font-weight: 400;
    line-height: 1.1667em;
    color: #28323C;
    margin: 0;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.single-news-header__subtitle {
    font-family: 'Outfit', sans-serif;
    font-size: 24px;
    font-weight: 400;
    line-height: 1.3333em;
    color: #007ACC;
    margin: 0;
}

.single-news-header__meta {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
    margin-top: 8px;
}

.single-news-header__author,
.single-news-header__category {
    display: flex;
    align-items: center;
    gap: 8px;
    font-family: 'Outfit', sans-serif;
    font-size: 14px;
    font-weight: 400;
    color: #68747C;
}

.single-news-header__author svg,
.single-news-header__category svg {
    flex-shrink: 0;
}

/* News Featured Image Section */
.single-news-featured-image {
    margin: 0 auto 60px;
    max-width: 1728px;
    padding: 0 150px;
}

.single-news-featured-image__wrapper {
    max-width: 1200px;
    margin: 0 auto;
}

.news-image-wrapper {
    position: relative;
    width: 100%;
    padding-bottom: 56.25%; /* 16:9 aspect ratio */
    height: 0;
    overflow: hidden;
    background: #ACB4BC;
    border-radius: 12px;
    box-shadow: 0px 4px 8px 0px rgba(48, 48, 48, 0.08);
}

.news-image-wrapper img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.news-image-placeholder {
    position: absolute;
    top: 0;
    left: 0;
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

/* News Container */
.news-container {
    max-width: 1728px;
    margin: 0 auto;
    padding: 0 150px;
    box-sizing: border-box;
}

/* News Content Section */
.single-news-content {
    margin: 0 auto 60px;
    max-width: 1000px;
    /* padding: 0 150px; */
}

.single-news-content__body {
    font-family: 'Outfit', sans-serif;
}

.single-news-content__body p {
    font-size: 16px;
    font-weight: 300;
    line-height: 1.5em;
    color: #141A1E;
    margin: 0 0 24px 0;
}

/* News Share Section */
.single-news-share {
    margin: 60px auto;
    max-width: 1728px;
    padding: 0 150px;
    text-align: center;
}

.single-news-share__title {
    font-family: 'Outfit', sans-serif;
    font-size: 24px;
    font-weight: 600;
    color: #28323C;
    margin: 0 0 24px 0;
}

.single-news-share__icons {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
}

.single-news-share__icons .share-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.2s ease;
}

.single-news-share__icons .share-icon:hover {
    transform: scale(1.1);
}

/* Related News Section */
.related-news {
    margin: 80px auto;
    max-width: 1728px;
    padding: 0 150px;
}

.related-news__headline {
    font-family: 'Outfit', sans-serif;
    font-size: 32px;
    font-weight: 600;
    color: #28323C;
    margin: 0 0 40px 0;
}

.related-news__grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 32px;
}

.related-news__card {
    background: #FFFFFF;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0px 4px 8px 0px rgba(48, 48, 48, 0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.related-news__card:hover {
    transform: translateY(-4px);
    box-shadow: 0px 8px 16px 0px rgba(48, 48, 48, 0.12);
}

.related-news__image {
    position: relative;
    width: 100%;
    padding-bottom: 56.25%; /* 16:9 aspect ratio */
    height: 0;
    overflow: hidden;
    background: #ACB4BC;
}

.related-news__image img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.related-news__image-link {
    display: block;
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
}

.related-news__content {
    padding: 24px;
}

.related-news__title {
    font-family: 'Outfit', sans-serif;
    font-size: 18px;
    font-weight: 500;
    line-height: 1.4444em;
    color: #28323C;
    margin: 0 0 12px 0;
}

.related-news__title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.2s ease;
}

.related-news__title a:hover {
    color: #007ACC;
}

.related-news__meta {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

.related-news__date {
    font-family: 'Outfit', sans-serif;
    font-size: 14px;
    font-weight: 400;
    color: #68747C;
}

.related-news__author {
    font-family: 'Outfit', sans-serif;
    font-size: 14px;
    font-weight: 400;
    color: #68747C;
}

/* Responsive Styles for Single News */
@media (max-width: 1280px) {
    .single-news-header,
    .single-news-featured-image,
    .single-news-content,
    .single-news-share,
    .related-news {
        padding: 0 40px;
    }
    
    .news-container {
        padding: 0 40px;
    }
}

@media (max-width: 768px) {
    .single-news-header__title {
        font-size: 32px;
    }
    
    .single-news-header__subtitle {
        font-size: 18px;
    }
    
    .single-news-header,
    .single-news-featured-image,
    .single-news-content,
    .single-news-share,
    .related-news {
        padding: 0 20px;
    }
    
    .news-container {
        padding: 0 20px;
    }
    
    .related-news__grid {
        grid-template-columns: 1fr;
        gap: 24px;
    }
    
    .single-news-header__meta {
        flex-direction: column;
        gap: 12px;
    }
}
</style>

<main id="main-content" class="single-news-template" role="main">
    
    <?php while ( have_posts() ) : the_post(); ?>
        
        <!-- News Navigation -->
        <div class="single-navigation">
            <div class="single-navigation__container">
                <?php
                $prev_post = get_previous_post( false, '', 'news' );
                $next_post = get_next_post( false, '', 'news' );
                ?>
                
                <!-- Previous News -->
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
                
                <!-- Back to News -->
                <?php 
                // Try to find the News page that lists news
                $news_page = get_page_by_path('news');
                $news_url = $news_page ? get_permalink($news_page->ID) : home_url('/news');
                ?>
                <a href="<?php echo esc_url( $news_url ); ?>" class="single-nav-link single-nav-link--back">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 12h18M3 6h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>Back to News</span>
                </a>
                
                <!-- Next News -->
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
        
        <!-- News Header Section -->
        <section class="single-news-header">
            <div class="news-container">
                <div class="single-news-header__content">
                    <div class="single-news-header__text">
                        <span class="single-news-header__date"><?php echo get_the_date( 'F j, Y' ); ?></span>
                        <h1 class="single-news-header__title"><?php the_title(); ?></h1>
                        <?php if ( has_excerpt() ) : ?>
                            <p class="single-news-header__subtitle"><?php echo get_the_excerpt(); ?></p>
                        <?php endif; ?>
                        <div class="single-news-header__meta">
                            <?php 
                            $author_id = get_the_author_meta('ID');
                            if ( $author_id ) : 
                            ?>
                            <span class="single-news-header__author">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 8C10.2091 8 12 6.20914 12 4C12 1.79086 10.2091 0 8 0C5.79086 0 4 1.79086 4 4C4 6.20914 5.79086 8 8 8Z" fill="#68747C"/>
                                    <path d="M8 9.33333C4.3181 9.33333 1.33333 10.8252 1.33333 12.6667V16H14.6667V12.6667C14.6667 10.8252 11.6819 9.33333 8 9.33333Z" fill="#68747C"/>
                                </svg>
                                <?php echo get_the_author(); ?>
                            </span>
                            <?php endif; ?>
                            <?php 
                            $categories = get_the_category();
                            if ( ! empty( $categories ) ) : 
                            ?>
                            <span class="single-news-header__category">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2 3C2 2.44772 2.44772 2 3 2H6C6.55228 2 7 2.44772 7 3V6C7 6.55228 6.55228 7 6 7H3C2.44772 7 2 6.55228 2 6V3Z" fill="#68747C"/>
                                    <path d="M9 3C9 2.44772 9.44772 2 10 2H13C13.5523 2 14 2.44772 14 3V6C14 6.55228 13.5523 7 13 7H10C9.44772 7 9 6.55228 9 6V3Z" fill="#68747C"/>
                                    <path d="M2 10C2 9.44772 2.44772 9 3 9H6C6.55228 9 7 9.44772 7 10V13C7 13.5523 6.55228 14 6 14H3C2.44772 14 2 13.5523 2 13V10Z" fill="#68747C"/>
                                    <path d="M9 10C9 9.44772 9.44772 9 10 9H13C13.5523 9 14 9.44772 14 10V13C14 13.5523 13.5523 14 13 14H10C9.44772 14 9 13.5523 9 13V10Z" fill="#68747C"/>
                                </svg>
                                <?php echo esc_html( $categories[0]->name ); ?>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- News Featured Image Section -->
        <?php if ( has_post_thumbnail() ) : ?>
        <section class="single-news-featured-image">
            <div class="news-container">
                <div class="single-news-featured-image__wrapper">
                    <div class="news-image-wrapper">
                        <?php the_post_thumbnail( 'large', array( 'alt' => get_the_title() ) ); ?>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>
        
        <!-- News Content Section -->
        <?php if ( get_the_content() ) : ?>
        <article class="single-news-content">
            <div class="news-container">
                <div class="single-news-content__body">
                    <?php the_content(); ?>
                </div>
            </div>
        </article>
        <?php endif; ?>
        
        <!-- Share Section -->
        <div class="single-news-share">
            <div class="news-container">
                <h3 class="single-news-share__title">Share this article</h3>
                <div class="single-news-share__icons">
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
    
   
</main>

<?php get_footer(); ?>

