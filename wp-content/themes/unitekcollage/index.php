<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @package UnitekCollege
 * @since 1.0.0
 */

get_header(); ?>

<main id="main-content" class="site-main">
    <div class="container">
        <?php if (have_posts()) : ?>
            <div class="posts-container">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('large'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="post-content">
                            <header class="entry-header">
                                <h2 class="entry-title">
                                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>
                                
                                <div class="entry-meta">
                                    <span class="posted-on">
                                        <i class="fas fa-calendar"></i>
                                        <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                            <?php echo get_the_date(); ?>
                                        </time>
                                    </span>
                                    
                                    <span class="byline">
                                        <i class="fas fa-user"></i>
                                        <span class="author vcard">
                                            <a class="url fn n" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                                <?php echo get_the_author(); ?>
                                            </a>
                                        </span>
                                    </span>
                                    
                                    <?php if (has_category()) : ?>
                                        <span class="cat-links">
                                            <i class="fas fa-folder"></i>
                                            <?php the_category(', '); ?>
                                        </span>
                                    <?php endif; ?>
                                    
                                    <?php if (has_tag()) : ?>
                                        <span class="tags-links">
                                            <i class="fas fa-tags"></i>
                                            <?php the_tags('', ', '); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </header>
                            
                            <div class="entry-content">
                                <?php
                                if (is_home() || is_archive()) {
                                    the_excerpt();
                                } else {
                                    the_content();
                                }
                                ?>
                            </div>
                            
                            <footer class="entry-footer">
                                <a href="<?php the_permalink(); ?>" class="read-more">
                                    <?php _e('Read More', 'unitek-college'); ?>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </footer>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            
            <?php
            // Pagination
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => __('Previous', 'unitek-college'),
                'next_text' => __('Next', 'unitek-college'),
            ));
            ?>
            
        <?php else : ?>
            <div class="no-posts">
                <h2><?php _e('Nothing Found', 'unitek-college'); ?></h2>
                <p><?php _e('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'unitek-college'); ?></p>
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>