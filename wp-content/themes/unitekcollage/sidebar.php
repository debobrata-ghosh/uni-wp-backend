<?php
/**
 * The sidebar containing the main widget area
 *
 * @package UnitekCollege
 * @since 1.0.0
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area sidebar">
    <div class="sidebar-content">
        <?php dynamic_sidebar('sidebar-1'); ?>
    </div>
</aside>
