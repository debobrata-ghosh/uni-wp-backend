<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Skip to Main Content Link for Accessibility -->
<a href="#main-content" class="skip-link"><?php _e('Skip to main content', 'unitek-college'); ?></a>

<?php
// Get theme settings
$acf_get_option = static function ( string $key, $default = null ) {
	if ( function_exists( 'get_field' ) ) {
		$val = get_field( $key, 'option' );
		return ( $val === null || $val === '' ) ? $default : $val;
	}
	return $default;
};

$top_bar_enabled = (bool) $acf_get_option( 'top_bar_enabled', false );
$top_bar_text    = (string) $acf_get_option( 'top_bar_text', 'Get info' );
$header_phone    = $acf_get_option( 'header_phone', '' );
?>

<?php if ($top_bar_enabled): ?>
<!-- Top Bar -->
<div class="top-bar">
    <div class="top-bar-container">
        <div class="top-bar-left">
        </div>
        <div class="top-bar-right">
            <a href="#" class="top-bar-link">
                <span class="info-icon-circle">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                        <path d="M12 8v4m0 4h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </span>
                <?php echo esc_html($top_bar_text ?: 'Get info'); ?>
            </a>
            
            <div class="top-bar-separator"></div>
            
            <button class="top-bar-icon search-toggle" aria-label="<?php _e('Search', 'unitek-college'); ?>">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="10" cy="10" r="7" stroke="currentColor" stroke-width="2"/>
                    <path d="M15 15l6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>
            
            <div class="top-bar-separator"></div>
            
            <?php if ($header_phone): ?>
            <a href="tel:<?php echo esc_attr($header_phone); ?>" class="top-bar-icon" aria-label="<?php _e('Phone', 'unitek-college'); ?>">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 3H9C10 3 11 4 11 5V8C11 9 10 10 9 10H5C5 14 8 17 12 17V13C12 12 13 11 14 11H17C18 11 19 12 19 13V17C19 18 18 19 17 19H13C7 19 3 15 3 9V5C3 4 4 3 5 3Z" stroke="currentColor" stroke-width="2" fill="none"/>
                </svg>
            </a>
            <?php endif; ?>
            
            <div class="top-bar-separator"></div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Header -->
<header class="header">
    <div class="header-container">
        <!-- Logo -->
        <div class="header-logo">
            <?php
            $header_logo = $acf_get_option( 'header_logo', null );
            $mobile_logo = $acf_get_option( 'mobile_logo', null );
            
            // Determine which logo to use for mobile
            $mobile_logo_src = $mobile_logo ? $mobile_logo : $header_logo;
            
            if ($header_logo) {
                ?>
                <!-- Desktop Logo (hidden when menu is open on mobile) -->
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="logo-link desktop-logo">
                    <img src="<?php echo esc_url($header_logo['url']); ?>" 
                         alt="<?php echo esc_attr($header_logo['alt'] ?: 'Site Logo'); ?>"
                         width="<?php echo esc_attr($header_logo['width'] ?? ''); ?>"
                         height="<?php echo esc_attr($header_logo['height'] ?? ''); ?>">
                </a>
                
                <!-- Mobile Logo (shown only when menu is open on mobile) -->
                <?php if ($mobile_logo_src): ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="logo-link mobile-logo">
                    <img src="<?php echo esc_url($mobile_logo_src['url']); ?>" 
                         alt="<?php echo esc_attr($mobile_logo_src['alt'] ?: 'Site Logo'); ?>"
                         width="<?php echo esc_attr($mobile_logo_src['width'] ?? ''); ?>"
                         height="<?php echo esc_attr($mobile_logo_src['height'] ?? ''); ?>">
                </a>
                <?php endif; ?>
                <?php
            } elseif (has_custom_logo()) {
                the_custom_logo();
            } else {
                ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="logo-link desktop-logo">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/UC-main-logo.png" alt="Unitek College Logo">
                </a>
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="logo-link mobile-logo">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/UC-main-logo.png" alt="Unitek College Logo">
                </a>
                <?php
            }
            ?>
        </div>
        
        <!-- Main Navigation -->
        <nav class="header-nav" role="navigation" aria-label="<?php _e('Primary Menu', 'unitek-college'); ?>">
            <?php
            wp_nav_menu(array(
                'menu'           => 'Header Main Menu',
                'theme_location' => 'primary_menu',
                'container'      => false,
                'menu_class'     => 'nav-list',
                'walker'         => new Mega_Menu_Walker(),
                'fallback_cb'    => false,
            ));
            ?>
        </nav>

        
        
        <!-- Apply Button (Desktop Only) -->
        <div class="header-cta">
            <?php
            $apply_text = get_field('apply_button_text', 'option') ?: 'Apply now';
            $apply_url = get_field('apply_button_url', 'option') ?: '#';
            ?>
            <a href="<?php echo esc_url($apply_url); ?>" class="btn-apply">
                <?php echo esc_html($apply_text); ?>
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 10h12m0 0l-4-4m4 4l-4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
        
        <!-- Mobile Header Right Section (Mobile Only) -->
        <div class="mobile-header-right">
            <!-- Phone Icon (Always visible on mobile) -->
            <?php if ($header_phone): ?>
            <a href="tel:<?php echo esc_attr($header_phone); ?>" class="mobile-header-icon mobile-phone-icon" aria-label="<?php _e('Phone', 'unitek-college'); ?>">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 3H9C10 3 11 4 11 5V8C11 9 10 10 9 10H5C5 14 8 17 12 17V13C12 12 13 11 14 11H17C18 11 19 12 19 13V17C19 18 18 19 17 19H13C7 19 3 15 3 9V5C3 4 4 3 5 3Z" stroke="currentColor" stroke-width="2" fill="none"/>
                </svg>
            </a>
            <?php endif; ?>
            
            <div class="mobile-header-separator"></div>
            
            <!-- Hamburger Icon (default state) -->
            <button class="mobile-menu-toggle" aria-label="<?php _e('Toggle mobile menu', 'unitek-college'); ?>">
                <span></span>
                <span></span>
                <span></span>
            </button>
            
            <!-- Close Icon (when menu is open) -->
            <button class="mobile-header-icon mobile-menu-close-btn" aria-label="<?php _e('Close mobile menu', 'unitek-college'); ?>">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
    </div>
</header>

<!-- Search Overlay -->
<div class="search-overlay" id="searchOverlay">
    <div class="search-overlay-container">
        <div class="search-overlay-content">
            <!-- Logo Section -->
            <div class="search-logo">
                <div class="search-logo-icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/UC-Side-Stack.png" alt="Unitek College Logo">
                </div>
            </div>
            
            <!-- Search Prompt -->
            <div class="search-prompt">
                <h2 class="search-prompt-text">What can we help you find?</h2>
            </div>
            
            <!-- Search Form -->
            <form class="search-form-overlay" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                <div class="search-input-container">
                    <input type="search" 
                           class="search-input-field" 
                           placeholder="Search programs" 
                           value="<?php echo get_search_query(); ?>" 
                           name="s" 
                           autocomplete="off"
                           required minlength="2"
                           aria-label="Search programs">
                    <button type="submit" class="search-submit-btn" aria-label="Search">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="8.5" cy="8.5" r="6.5" stroke="currentColor" stroke-width="1.5"/>
                            <path d="M14 14l4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </button>
                </div>
                <!-- Search Results Container -->
                <div class="search-results" id="searchResults"></div>
            </form>
            
            <!-- Close Button -->
            <button class="search-close-btn" aria-label="Close search">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            
        </div>
    </div>
</div>


