<?php
/**
 * The template for displaying all pages
 *
 * @package UnitekCollege
 * @since 1.0.0
 */

get_header(); ?>
<main id="main-content" class="container" role="main">
<?php while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
<?php endwhile; ?>
</main>
<?php get_footer(); ?>
