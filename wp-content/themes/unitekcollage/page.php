<?php
/**
 * The template for displaying all pages
 *
 * @package UnitekCollege
 * @since 1.0.0
 */

get_header(); 
?>
<style>
    .block-search-area input {
    color: #074975 !important;
    height: 40px;
    font-size: 16px !important;
    margin: 0 !important;
    width: 100%;
    padding-left: 10px;
}

.unitek-dms-document {
    position: relative;
    min-height: 200px;
    padding: 20px;
    border: 1px solid #ffffff;
    border-radius: 4px;
    background-color: #ffffff;
    font-family: 'Outfit', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
}

</style>

<main id="main-content" class="main-container" role="main">
<?php while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
<?php endwhile; ?>
</main>
<?php get_footer(); ?>


