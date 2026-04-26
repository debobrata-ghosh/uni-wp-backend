<?php
/**
 * Custom Walker for Mega Menu
 * 
 * @package UnitekCollege
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class Mega_Menu_Walker extends Walker_Nav_Menu {
    
    /**
     * Track if we're inside a mega menu structure
     */
    private $is_mega_menu = false;
    private $mega_menu_header_item = null;
    private $column_count = 0;
    private $current_parent_item = null;
    private $is_mobile = false;
    
    /**
     * Check if the current request is from a mobile device
     * Note: This is server-side detection and may not be as accurate as client-side detection
     * The JavaScript will handle the responsive behavior based on actual screen size
     *
     * @return bool True if mobile device, false otherwise
     */
    private function is_mobile_device() {
        // For responsive design, we'll let JavaScript handle the actual behavior
        // This server-side detection is just for initial structure
        // The JavaScript will create the appropriate mobile submenu dynamically
        
        // Check if we're in a mobile context
        if (wp_is_mobile()) {
            return true;
        }
        
        // Additional mobile detection using user agent
        $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        $mobile_agents = array(
            'Mobile', 'Android', 'iPhone', 'iPad', 'iPod', 'BlackBerry', 
            'Windows Phone', 'Opera Mini', 'IEMobile'
        );
        
        foreach ($mobile_agents as $agent) {
            if (stripos($user_agent, $agent) !== false) {
                return true;
            }
        }
        
        // Check for mobile screen size using CSS media query approach
        // This is more reliable for responsive design
        if (isset($_SERVER['HTTP_X_WAP_PROFILE']) || 
            isset($_SERVER['HTTP_ACCEPT']) && 
            strpos($_SERVER['HTTP_ACCEPT'], 'application/vnd.wap.xhtml+xml') !== false) {
            return true;
        }
        
        return false;
    }

    /**
     * Starts the list before the elements are added.
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function start_lvl(&$output, $depth = 0, $args = null) {
        if ($depth === 0) {
            // Check if this is a mega menu parent (has specific class or is "Programs")
            $parent_item = $this->get_current_parent_item();
            $is_mega_menu = $parent_item && (
                in_array('mega-menu', $parent_item->classes) || 
                strtolower($parent_item->title) === 'programs' ||
                strtolower($parent_item->title) === 'program'
            );
            
            if ($is_mega_menu) {
                // Always render full mega menu modal structure
                // JavaScript will handle responsive behavior
                $output .= "\n<div class=\"mega-menu-modal\">\n";
                $output .= "<div class=\"mega-menu-content\">\n";
                $this->is_mega_menu = true;
            } else {
                // Regular submenu
                $output .= "\n<ul class=\"sub-menu\">\n";
            }
        } elseif ($depth === 1) {
            if ($this->is_mega_menu) {
                // Start mega-menu-main after the header (contains columns)
                $output .= "<div class=\"mega-menu-main\">\n";
            } else {
                // Regular submenu at depth 1
                $output .= "\n<ul class=\"sub-menu\">\n";
            }
        } elseif ($depth === 2) {
            if ($this->is_mega_menu) {
                // Start the list of programs inside a column
                $output .= "<ul class=\"mega-menu-programs\">\n";
            } else {
                // Regular submenu at depth 2
                $output .= "\n<ul class=\"sub-menu\">\n";
            }
        }
    }
    
    /**
     * Ends the list of after the elements are added.
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function end_lvl(&$output, $depth = 0, $args = null) {
        if ($depth === 0) {
            if ($this->is_mega_menu) {
                // Close mega-menu-main wrapper
                $output .= "</div><!-- .mega-menu-main -->\n";
                
                // Add mega menu footer with dynamic content from ACF
                $footer_text = get_field('mega_menu_footer_text', 'option') ?: 'Empowering the next generation of healthcare professionals.';
                $cta_text = get_field('mega_menu_cta_text', 'option') ?: 'Find my path';
                $cta_url = get_field('mega_menu_cta_url', 'option') ?: '#';
                
                $output .= "<div class=\"mega-menu-footer\">\n";
                $output .= "<p class=\"mega-menu-footer-text\">" . esc_html($footer_text) . "</p>\n";
                
                // Use anchor tag instead of button for proper navigation
                $output .= "<a href=\"" . esc_url($cta_url) . "\" class=\"mega-menu-cta\">\n";
                $output .= esc_html($cta_text) . "\n";
                $output .= "<svg width=\"16\" height=\"16\" viewBox=\"0 0 16 16\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">\n";
                $output .= "<path d=\"M4 8h8m0 0l-4-4m4 4l-4 4\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n";
                $output .= "</svg>\n";
                $output .= "</a>\n";
                $output .= "</div><!-- .mega-menu-footer -->\n";
                
                // Close mega menu modal
                $output .= "</div><!-- .mega-menu-content -->\n";
                $output .= "</div><!-- .mega-menu-modal -->\n";
                
                $this->is_mega_menu = false;
                $this->column_count = 0;
            } else {
                // Close regular submenu (including mobile mega menu)
                $output .= "</ul><!-- .sub-menu -->\n";
            }
        } elseif ($depth === 1) {
            if ($this->is_mega_menu) {
                // Close mega-menu-main is handled in depth 0
            } else {
                // Close regular submenu
                $output .= "</ul><!-- .sub-menu -->\n";
            }
        } elseif ($depth === 2) {
            if ($this->is_mega_menu) {
                // Close the programs list
                $output .= "</ul><!-- .mega-menu-programs -->\n";
                $output .= "</div><!-- .mega-menu-column -->\n";
            } else {
                // Close regular submenu
                $output .= "</ul><!-- .sub-menu -->\n";
            }
        }
    }
    
    /**
     * Starts the element output.
     *
     * @param string   $output            Used to append additional content (passed by reference).
     * @param WP_Post  $item              Menu item data object.
     * @param int      $depth             Depth of menu item. Used for padding.
     * @param stdClass $args              An object of wp_nav_menu() arguments.
     * @param int      $current_object_id Optional. ID of the current menu item. Default 0.
     */
    public function start_el(&$output, $item, $depth = 0, $args = null, $current_object_id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        // Build classes array
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        // Add depth-specific classes
        if ($depth === 0) {
            // Check if this item has children (mega menu parent)
            $has_children = in_array('menu-item-has-children', $classes);
            if ($has_children) {
                $classes[] = 'mega-menu-parent';
            }
        }
        
        // Filter and join classes
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        // Build item ID
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        if ($depth === 0) {
            // Top level menu item
            $output .= $indent . '<li' . $id . $class_names . '>';
            
            // Store current parent for mega menu detection
            $this->current_parent_item = $item;
            
            // Build link attributes
            $atts = array();
            $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
            $atts['target'] = !empty($item->target) ? $item->target : '';
            if ('_blank' === $item->target && empty($item->xfn)) {
                $atts['rel'] = 'noopener noreferrer';
            } else {
                $atts['rel'] = $item->xfn;
            }
            $atts['href'] = !empty($item->url) ? $item->url : '';
            $atts['aria-current'] = $item->current ? 'page' : '';
            
            // Add mega-menu-trigger class if it has children and is a mega menu
            if (in_array('mega-menu-parent', $classes)) {
                $is_mega_menu = in_array('mega-menu', $item->classes) || 
                               strtolower($item->title) === 'programs' ||
                               strtolower($item->title) === 'program';
                if ($is_mega_menu) {
                    $atts['class'] = 'mega-menu-trigger';
                }
            }
            
            $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
            
            $attributes = '';
            foreach ($atts as $attr => $value) {
                if (!empty($value)) {
                    $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }
            
            // Build the link
            $title = apply_filters('the_title', $item->title, $item->ID);
            $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);
            
            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . $title . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;
            
            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
            
        } elseif ($depth === 1) {
            if ($this->is_mega_menu) {
                // Level 1: Mega menu header title (e.g., "Healthcare Programs")
                // Check if this is a custom link with a URL
                $has_url = !empty($item->url) && $item->url !== '#';
                
                // Store this item for the header
                if ($this->mega_menu_header_item === null) {
                    $this->mega_menu_header_item = $item;
                    
                    // Output the mega menu header
                    $output .= "<div class=\"mega-menu-header\">\n";
                    
                    if ($has_url) {
                        // If it has a URL, make it a clickable link
                        $output .= "<a href=\"" . esc_url($item->url) . "\" class=\"mega-menu-title-link\">\n";
                        $output .= "<h2 class=\"mega-menu-title\">" . esc_html($item->title) . "</h2>\n";
                        $output .= "</a>\n";
                    } else {
                        // If no URL, just display as title
                        $output .= "<h2 class=\"mega-menu-title\">" . esc_html($item->title) . "</h2>\n";
                    }
                    
                    $output .= "<button class=\"mega-menu-close\" aria-label=\"Close mega menu\">\n";
                    $output .= "<svg width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">\n";
                    $output .= "<path d=\"M18 6L6 18M6 6l12 12\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>\n";
                    $output .= "</svg>\n";
                    $output .= "</button>\n";
                    $output .= "</div><!-- .mega-menu-header -->\n";
                }
            } else {
                // Regular submenu item
                $output .= $indent . '<li' . $id . $class_names . '>';
                
                // Build link attributes
                $atts = array();
                $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
                $atts['target'] = !empty($item->target) ? $item->target : '';
                if ('_blank' === $item->target && empty($item->xfn)) {
                    $atts['rel'] = 'noopener noreferrer';
                } else {
                    $atts['rel'] = $item->xfn;
                }
                $atts['href'] = !empty($item->url) ? $item->url : '';
                $atts['aria-current'] = $item->current ? 'page' : '';
                
                $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
                
                $attributes = '';
                foreach ($atts as $attr => $value) {
                    if (!empty($value)) {
                        $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                        $attributes .= ' ' . $attr . '="' . $value . '"';
                    }
                }
                
                // Build the link
                $title = apply_filters('the_title', $item->title, $item->ID);
                $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);
                
                $item_output = $args->before;
                $item_output .= '<a' . $attributes . '>';
                $item_output .= $args->link_before . $title . $args->link_after;
                $item_output .= '</a>';
                $item_output .= $args->after;
                
                $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
            }
            
        } elseif ($depth === 2) {
            if ($this->is_mega_menu) {
                // Level 2: Column headers (e.g., "Nursing", "Healthcare")
                // Check if this is a custom link with a URL
                $has_url = !empty($item->url) && $item->url !== '#';
                
                // Add placeholder with ACF image before each column
                $output .= "<div class=\"mega-menu-placeholder\">";
                
                // Get ACF image based on column title
                $column_title_lower = strtolower(trim($item->title));
                $image = null;
                
                if (strpos($column_title_lower, 'nursing') !== false) {
                    $image = get_field('nursing_image', 'option');
                } elseif (strpos($column_title_lower, 'healthcare') !== false || strpos($column_title_lower, 'medical') !== false) {
                    $image = get_field('healthcare_image', 'option');
                }
                
                // Display image if available
                if ($image && !empty($image['url'])) {
                    $output .= '<img src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt'] ?: $item->title) . '">';
                }
                
                $output .= "</div>\n";
                
                $output .= "<div class=\"mega-menu-column\">\n";
                
                if ($has_url) {
                    // If it has a URL, make it a clickable link
                    $output .= "<a href=\"" . esc_url($item->url) . "\" class=\"mega-menu-column-title-link\">\n";
                    $output .= "<h3 class=\"mega-menu-column-title\">" . esc_html($item->title) . "</h3>\n";
                    $output .= "</a>\n";
                } else {
                    // If no URL, just display as title
                    $output .= "<h3 class=\"mega-menu-column-title\">" . esc_html($item->title) . "</h3>\n";
                }
                
                $this->column_count++;
            } else {
                // Regular submenu item at depth 2
                $output .= $indent . '<li' . $id . $class_names . '>';
                
                // Build link attributes
                $atts = array();
                $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
                $atts['target'] = !empty($item->target) ? $item->target : '';
                if ('_blank' === $item->target && empty($item->xfn)) {
                    $atts['rel'] = 'noopener noreferrer';
                } else {
                    $atts['rel'] = $item->xfn;
                }
                $atts['href'] = !empty($item->url) ? $item->url : '';
                $atts['aria-current'] = $item->current ? 'page' : '';
                
                $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
                
                $attributes = '';
                foreach ($atts as $attr => $value) {
                    if (!empty($value)) {
                        $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                        $attributes .= ' ' . $attr . '="' . $value . '"';
                    }
                }
                
                // Build the link
                $title = apply_filters('the_title', $item->title, $item->ID);
                $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);
                
                $item_output = $args->before;
                $item_output .= '<a' . $attributes . '>';
                $item_output .= $args->link_before . $title . $args->link_after;
                $item_output .= '</a>';
                $item_output .= $args->after;
                
                $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
            }
            
        } elseif ($depth === 3) {
            if ($this->is_mega_menu) {
                // Level 3: Actual program links inside columns
                $output .= $indent . '<li>';
                
                // Build link
                $atts = array();
                $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
                $atts['target'] = !empty($item->target) ? $item->target : '';
                if ('_blank' === $item->target && empty($item->xfn)) {
                    $atts['rel'] = 'noopener noreferrer';
                } else {
                    $atts['rel'] = $item->xfn;
                }
                $atts['href'] = !empty($item->url) ? $item->url : '';
                
                $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
                
                $attributes = '';
                foreach ($atts as $attr => $value) {
                    if (!empty($value)) {
                        $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                        $attributes .= ' ' . $attr . '="' . $value . '"';
                    }
                }
                
                $title = apply_filters('the_title', $item->title, $item->ID);
                $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);
                
                $item_output = $args->before;
                $item_output .= '<a' . $attributes . '>';
                $item_output .= $args->link_before . $title . $args->link_after;
                $item_output .= '</a>';
                $item_output .= $args->after;
                
                $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
            } else {
                // Regular submenu item at depth 3
                $output .= $indent . '<li' . $id . $class_names . '>';
                
                // Build link attributes
                $atts = array();
                $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
                $atts['target'] = !empty($item->target) ? $item->target : '';
                if ('_blank' === $item->target && empty($item->xfn)) {
                    $atts['rel'] = 'noopener noreferrer';
                } else {
                    $atts['rel'] = $item->xfn;
                }
                $atts['href'] = !empty($item->url) ? $item->url : '';
                $atts['aria-current'] = $item->current ? 'page' : '';
                
                $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
                
                $attributes = '';
                foreach ($atts as $attr => $value) {
                    if (!empty($value)) {
                        $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                        $attributes .= ' ' . $attr . '="' . $value . '"';
                    }
                }
                
                // Build the link
                $title = apply_filters('the_title', $item->title, $item->ID);
                $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);
                
                $item_output = $args->before;
                $item_output .= '<a' . $attributes . '>';
                $item_output .= $args->link_before . $title . $args->link_after;
                $item_output .= '</a>';
                $item_output .= $args->after;
                
                $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
            }
        }
    }
    
    /**
     * Ends the element output, if needed.
     *
     * @param string   $output Used to append additional content (passed by reference).
     * @param WP_Post  $item   Page data object. Not used.
     * @param int      $depth  Depth of page. Not Used.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function end_el(&$output, $item, $depth = 0, $args = null) {
        if ($depth === 0) {
            // Close top-level li
            $output .= "</li>\n";
        } elseif ($depth === 1) {
            if ($this->is_mega_menu) {
                // Level 1 items don't have closing tags (they're just headers)
            } else {
                // Close regular submenu li
                $output .= "</li>\n";
            }
        } elseif ($depth === 2) {
            if ($this->is_mega_menu) {
                // Column closing is handled in end_lvl
            } else {
                // Close regular submenu li
                $output .= "</li>\n";
            }
        } elseif ($depth === 3) {
            // Close program link li or regular submenu li
            $output .= "</li>\n";
        }
    }
    
    /**
     * Get the current parent item for mega menu detection
     */
    private function get_current_parent_item() {
        return $this->current_parent_item;
    }
}

