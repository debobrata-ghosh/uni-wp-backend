<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package UnitekCollege
 * @since 1.0.0
 */

get_header(); ?>

<main id="main-content" class="site-main">
    <div class="container">
        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title"><?php _e('Oops! That page can&rsquo;t be found.', 'unitek-college'); ?></h1>
            </header>
            
            <div class="page-content">
                <p><?php _e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'unitek-college'); ?></p>
                
                <?php get_search_form(); ?>
                
                <div class="error-404-widgets">
                    <div class="widget">
                        <h3><?php _e('Most Used Categories', 'unitek-college'); ?></h3>
                        <ul>
                            <?php
                            wp_list_categories(array(
                                'orderby'    => 'count',
                                'order'      => 'DESC',
                                'show_count' => 1,
                                'title_li'   => '',
                                'number'     => 5,
                            ));
                            ?>
                        </ul>
                    </div>
                    
                    <div class="widget">
                        <h3><?php _e('Recent Posts', 'unitek-college'); ?></h3>
                        <ul>
                            <?php
                            $recent_posts = wp_get_recent_posts(array(
                                'numberposts' => 5,
                                'post_status' => 'publish',
                            ));
                            
                            foreach ($recent_posts as $post) :
                                ?>
                                <li>
                                    <a href="<?php echo get_permalink($post['ID']); ?>">
                                        <?php echo $post['post_title']; ?>
                                    </a>
                                </li>
                                <?php
                            endforeach;
                            wp_reset_query();
                            ?>
                        </ul>
                    </div>
                    
                    <div class="widget">
                        <h3><?php _e('Archives', 'unitek-college'); ?></h3>
                        <ul>
                            <?php
                            wp_get_archives(array(
                                'type' => 'monthly',
                                'limit' => 5,
                            ));
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
