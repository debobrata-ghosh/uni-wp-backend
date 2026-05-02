<?php
// Get theme settings
$footer_logo = get_field('footer_logo', 'option');
$footer_copyright = get_field('footer_copyright', 'option') ?: '© ' . date('Y') . ' Unitek College. All rights reserved.';
$footer_description = get_field('footer_description', 'option');
?>

<!-- Footer -->

<div class="saparator">
            <img src="<?php echo get_template_directory_uri(); ?>/images/1920-Wave.png" alt="Unitek College" class="saparator-img">
        </div>

<footer class="footer">
    <div class="footer-container">
        <!-- Logo Section -->
        <div class="footer-logo">
            <?php if ($footer_logo): ?>
                <img src="<?php echo esc_url($footer_logo['url']); ?>" 
                     alt="<?php echo esc_attr($footer_logo['alt'] ?: 'Site Logo'); ?>" 
                     class="footer-logo-img"
                     width="<?php echo esc_attr($footer_logo['width'] ?? ''); ?>"
                     height="<?php echo esc_attr($footer_logo['height'] ?? ''); ?>">
            <?php else: ?>
                <img src="<?php echo get_template_directory_uri(); ?>/images/UC-Lndscp-R.png" alt="Unitek College" class="footer-logo-img">
            <?php endif; ?>
        </div>
        
        <!-- Footer Links Grid (Theme Options) -->
        <div class="footer-links">
            <?php if (have_rows('footer_columns', 'option')): ?>
                <?php while (have_rows('footer_columns', 'option')): the_row(); ?>
                    <div class="footer-column">
                        <?php $col_title = get_sub_field('title'); ?>
                        <?php if ($col_title): ?><h4><?php echo esc_html($col_title); ?></h4><?php endif; ?>
                        <?php if (have_rows('links')): ?>
                            <ul>
                                <?php while (have_rows('links')): the_row(); ?>
                                    <?php 
                                    $label = get_sub_field('label'); 
                                    $url = get_sub_field('url'); 
                                    
                                    if ($label):
                                        // Handle URL: if empty or relative, prepend home URL
                                        if (empty($url)) {
                                            $url = home_url('/');
                                        } elseif (!preg_match('/^https?:\/\//i', $url) && !preg_match('/^\/\//', $url)) {
                                            // Relative URL - normalize and prepend home URL
                                            $url = trim($url);
                                            // Remove leading slash if present (home_url will add it correctly)
                                            $url = ltrim($url, '/');
                                            // Use home_url() which handles subdirectory installations correctly
                                            $url = home_url('/' . $url);
                                            // Ensure trailing slash for consistency
                                            $url = trailingslashit($url);
                                        }
                                        
                                        // Check if it's an external link
                                        $home_url_parsed = parse_url(home_url());
                                        $link_url_parsed = parse_url($url);
                                        $is_external = false;
                                        
                                        if (isset($link_url_parsed['host']) && isset($home_url_parsed['host'])) {
                                            $is_external = (strtolower($link_url_parsed['host']) !== strtolower($home_url_parsed['host']));
                                        }
                                        
                                        // Build link attributes
                                        $link_attrs = 'href="' . esc_url($url) . '"';
                                        $link_attrs .= ' class="footer-link"';
                                        $link_attrs .= ' data-footer-link="true"';
                                        if ($is_external) {
                                            $link_attrs .= ' target="_blank" rel="noopener noreferrer"';
                                        }
                                    ?>
                                        <li><a <?php echo $link_attrs; ?>><?php echo esc_html($label); ?></a></li>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        
        <!-- Social Icons -->
        <div class="footer-social">
            <?php if (have_rows('social_links', 'option')): ?>
                <?php while (have_rows('social_links', 'option')): the_row(); ?>
                    <?php
                    $icon_class = get_sub_field('icon_class');
                    $url = get_sub_field('url');
                    $label = get_sub_field('label');
                    
                    // Generate default label if not provided
                    if (!$label) {
                        $label = 'Follow us on social media';
                    }
                    ?>
                    <a href="<?php echo esc_url($url); ?>" 
                       class="social-icon" 
                       aria-label="<?php echo esc_attr($label); ?>"
                       target="_blank" 
                       rel="noopener noreferrer">
                        <i class="<?php echo esc_attr($icon_class); ?>"></i>
                    </a>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        
        <!-- Copyright -->
        <?php if ($footer_copyright): ?>
            <div class="footer-copyright">
                <p><?php echo esc_html($footer_copyright); ?></p>
            </div>
        <?php endif; ?>
        
        <!-- Footer Description -->
        <?php if ($footer_description): ?>
            <div class="footer-description" >
                <p style="text-align: center;"><?php echo esc_html($footer_description); ?></p>
            </div>
        <?php endif; ?>
    </div>
</footer>

<?php wp_footer(); ?>

<script>
// Ensure footer links work correctly and aren't intercepted
(function() {
    document.addEventListener('DOMContentLoaded', function() {
        const footerLinks = document.querySelectorAll('.footer-link[data-footer-link="true"]');
        footerLinks.forEach(function(link) {
            // Remove any existing click handlers that might interfere
            link.addEventListener('click', function(e) {
                // Only prevent default if it's not a valid link
                const href = this.getAttribute('href');
                if (!href || href === '#' || href === 'javascript:void(0)') {
                    e.preventDefault();
                    return false;
                }
                // Allow normal navigation for valid links
                // Don't prevent default - let the browser handle it naturally
            }, true); // Use capture phase to run before other handlers
        });
    });
})();
</script>

</body>
</html>
