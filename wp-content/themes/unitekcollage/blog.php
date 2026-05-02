<?php
/*
 Template Name: blog

*/

get_header(); ?>

<main id="main-content" class="page-template-blog" role="main">
    <!-- Category Navigation -->
   

    <!-- Hero Section - Featured Post -->
    <?php
    // Query for featured post
    $featured_args = array(
        'post_type' => 'post',
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'meta_key' => '_is_featured',
        'meta_value' => '1',
        'orderby' => 'date',
        'order' => 'DESC'
    );
    $featured_query = new WP_Query($featured_args);
    
    if ($featured_query->have_posts()) :
        while ($featured_query->have_posts()) : $featured_query->the_post();
            $featured_title = get_the_title();
            $featured_excerpt = wp_trim_words(get_the_excerpt(), 25, '...');
            $featured_link = get_permalink();
            $featured_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
            $featured_category = get_the_category();
            $category_name = !empty($featured_category) ? $featured_category[0]->name : 'Featured';
    ?>
    <section class="hero" aria-labelledby="hero-title">
      <div class="hero__container">
        <div class="hero__content">
          <!-- <span class="hero__label" style="display: inline-block; background: #0072CE; color: white; padding: 6px 14px; border-radius: 20px; font-size: 14px; font-weight: 600; margin-bottom: 20px;">
            <?php// echo esc_html($category_name); ?>
          </span> -->
          <h1 class="hero__title" id="hero-title">
            <?php echo esc_html($featured_title); ?>
          </h1>
          <p class="hero__subtitle">
            <?php echo esc_html($featured_excerpt); ?>
          </p>
          <a href="<?php echo esc_url($featured_link); ?>" class="btn-link" aria-label="Read the full story">
            Read the story
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4 10h12m0 0l-4-4m4 4l-4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </a>
        </div>
        <div class="hero__image" style="<?php echo $featured_image ? 'background-image: url(' . esc_url($featured_image) . '); background-size: cover; background-position: center;' : ''; ?>" aria-label="<?php echo esc_attr($featured_title); ?> featured image">
          <?php if (!$featured_image) : ?>
            [ Image ]
          <?php endif; ?>
        </div>
      </div>
    </section>
    <?php 
        endwhile;
        wp_reset_postdata();
    else : 
        // Fallback if no featured post
    ?>
    <section class="hero" aria-labelledby="hero-title">
      <div class="hero__container">
        <div class="hero__content">
          <h1 class="hero__title" id="hero-title">
            Welcome to Our Blog
          </h1>
          <p class="hero__subtitle">
            Discover the latest news, insights, and stories from our team. Mark a post as "Featured" to showcase it here.
          </p>
          <a href="#articles" class="btn-link" aria-label="Browse all articles">
            Browse Articles
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4 10h12m0 0l-4-4m4 4l-4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </a>
        </div>
        <div class="hero__image" aria-label="Hero image placeholder">
          [ Image ]
        </div>
      </div>
    </section>
    <?php endif; ?>

    <?php
    // Get current category from URL
    $current_category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : 'all';
    
    // Get all categories
    $categories = get_categories(array(
        'taxonomy' => 'category',
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => false
    ));
    ?>
    
    <nav class="category-nav" aria-label="Blog categories">
      <div class="category-nav__container">
        <!-- Desktop Navigation List -->
        <ul class="category-nav__list category-nav__list--desktop">
          <li>
            <a href="#" 
               data-category="all"
               class="category-nav__link category-filter-link <?php echo ($current_category === 'all') ? 'active' : ''; ?>">
              All Categories
            </a>
          </li>
          <?php foreach ($categories as $category) : ?>
          <li>
            <a href="#" 
               data-category="<?php echo esc_attr($category->slug); ?>"
               class="category-nav__link category-filter-link <?php echo ($current_category === $category->slug) ? 'active' : ''; ?>">
              <?php echo esc_html($category->name); ?>
            </a>
          </li>
          <?php endforeach; ?>
          <li class="category-nav__search" role="search">
            <!-- Search Button (default state) -->
            <button class="category-nav__search-btn" id="blog-search-btn" aria-label="Search articles">
              <svg class="category-nav__search-icon" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <mask id="mask0_1_283" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="32" height="32">
                  <rect width="32" height="32" fill="#D9D9D9"/>
                </mask>
                <g mask="url(#mask0_1_283)">
                  <path d="M3.77665 25.3333C3.46198 25.3333 3.19809 25.2264 2.98498 25.0127C2.77209 24.7991 2.66565 24.5343 2.66565 24.2183C2.66565 23.9023 2.77209 23.6388 2.98498 23.4277C3.19809 23.2166 3.46198 23.111 3.77665 23.111H14.888C15.2027 23.111 15.4665 23.2179 15.6797 23.4317C15.8925 23.6454 15.999 23.9102 15.999 24.226C15.999 24.542 15.8925 24.8056 15.6797 25.0167C15.4665 25.2278 15.2027 25.3333 14.888 25.3333H3.77665ZM3.77665 18.4443C3.46198 18.4443 3.19809 18.3376 2.98498 18.124C2.77209 17.9102 2.66565 17.6453 2.66565 17.3293C2.66565 17.0136 2.77209 16.7501 2.98498 16.539C3.19809 16.3279 3.46198 16.2223 3.77665 16.2223H8.22132C8.53598 16.2223 8.79987 16.3291 9.01298 16.5427C9.22587 16.7564 9.33232 17.0213 9.33232 17.3373C9.33232 17.6531 9.22587 17.9166 9.01298 18.1277C8.79987 18.3388 8.53598 18.4443 8.22132 18.4443H3.77665ZM3.77665 11.5557C3.46198 11.5557 3.19809 11.4488 2.98498 11.235C2.77209 11.0212 2.66565 10.7564 2.66565 10.4407C2.66565 10.1247 2.77209 9.86111 2.98498 9.65C3.19809 9.43889 3.46198 9.33333 3.77665 9.33333H8.22132C8.53598 9.33333 8.79987 9.44022 9.01298 9.654C9.22587 9.86756 9.33232 10.1323 9.33232 10.4483C9.33232 10.7643 9.22587 11.0279 9.01298 11.239C8.79987 11.4501 8.53598 11.5557 8.22132 11.5557H3.77665ZM18.6657 21.3333C16.8212 21.3333 15.249 20.6833 13.949 19.3833C12.649 18.0833 11.999 16.5111 11.999 14.6667C11.999 12.8222 12.649 11.25 13.949 9.95C15.249 8.65 16.8212 8 18.6657 8C20.5101 8 22.0823 8.65 23.3823 9.95C24.6823 11.25 25.3323 12.8222 25.3323 14.6667C25.3323 15.3556 25.2268 16.0278 25.0157 16.6833C24.8045 17.3389 24.4879 17.9481 24.0657 18.511L28.5547 23C28.7693 23.2149 28.8767 23.4741 28.8767 23.7777C28.8767 24.0814 28.7693 24.3408 28.5547 24.5557C28.3398 24.7703 28.0804 24.8777 27.7767 24.8777C27.4731 24.8777 27.2139 24.7703 26.999 24.5557L22.51 20.0667C21.9471 20.4889 21.3379 20.8056 20.6823 21.0167C20.0268 21.2278 19.3545 21.3333 18.6657 21.3333ZM18.6603 19.111C19.8934 19.111 20.9433 18.6794 21.81 17.8163C22.6767 16.9532 23.11 15.9051 23.11 14.672C23.11 13.4389 22.6784 12.389 21.8153 11.5223C20.9522 10.6557 19.9041 10.2223 18.671 10.2223C17.4379 10.2223 16.388 10.6539 15.5213 11.517C14.6547 12.3801 14.2213 13.4282 14.2213 14.6613C14.2213 15.8944 14.6529 16.9443 15.516 17.811C16.3791 18.6777 17.4272 19.111 18.6603 19.111Z" fill="currentColor"/>
                </g>
              </svg>
              <span class="category-nav__search-text">Search</span>
            </button>
            
            <!-- Search Field (hidden by default) -->
            <div class="category-nav__search-field" id="blog-search-field" style="display: none;">
              <input type="text" 
                     class="category-nav__search-input" 
                     id="blog-search-input" 
                     placeholder="Search articles..." 
                     aria-label="Search articles">
              <button class="category-nav__search-submit" id="blog-search-submit" aria-label="Submit search">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="10" cy="10" r="7" stroke="currentColor" stroke-width="2"/>
                  <path d="M15 15l6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
              </button>
              <button class="category-nav__search-clear" id="blog-search-clear" aria-label="Clear search">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </button>
            </div>
          </li>
        </ul>
        
        <!-- Mobile Dropdown -->
        <div class="category-nav__mobile">
          <select class="category-nav__select category-filter-select" aria-label="Select blog category">
            <option value="all" <?php selected($current_category, 'all'); ?>>
              All Categories
            </option>
            <?php foreach ($categories as $category) : ?>
            <option value="<?php echo esc_attr($category->slug); ?>" 
                    <?php selected($current_category, $category->slug); ?>>
              <?php echo esc_html($category->name); ?>
            </option>
            <?php endforeach; ?>
          </select>
          <svg class="category-nav__select-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </div>
    </nav>

    <!-- Articles Section -->
    <section class="articles-section" aria-labelledby="articles-title">
      <h2 id="articles-title" class="sr-only">Latest Articles</h2>
      
      <?php
      // Query arguments
      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      $args = array(
          'post_type' => 'post',
          'posts_per_page' => 9,
          'paged' => $paged,
          'orderby' => 'date',
          'order' => 'DESC',
          'post_status' => 'publish'
      );
      
      // Add category filter if not "all"
      if ($current_category !== 'all') {
          $args['category_name'] = $current_category;
      }
      
      // The Query
      $blog_query = new WP_Query($args);
      ?>
      
      <div class="articles-grid">
        <?php 
        if ($blog_query->have_posts()) :
          $animation_delay = 0;
          while ($blog_query->have_posts()) : $blog_query->the_post();
            // Get post categories
            $post_categories = get_the_category();
            
            // Determine which category to display
            $display_category_name = 'Uncategorized';
            
            if (!empty($post_categories)) {
                // If a specific category is filtered and post has that category, show it
                if ($current_category !== 'all') {
                    foreach ($post_categories as $cat) {
                        if ($cat->slug === $current_category) {
                            $display_category_name = $cat->name;
                            break;
                        }
                    }
                    // If filtered category not found in post's categories, show first one
                    if ($display_category_name === 'Uncategorized') {
                        $display_category_name = $post_categories[0]->name;
                    }
                } else {
                    // No filter active, show first category
                    $display_category_name = $post_categories[0]->name;
                }
            }
            
            // Get author name
            $author_name = get_the_author();
            
            // Get excerpt
            $excerpt = wp_trim_words(get_the_excerpt(), 20, '...');
        ?>
        <article class="article-card" style="opacity: 1; transform: translateY(0px); transition: opacity 0.5s ease-out <?php echo $animation_delay > 0 ? $animation_delay . 's' : ''; ?>, transform 0.5s ease-out <?php echo $animation_delay > 0 ? $animation_delay . 's' : ''; ?>;" data-categories="<?php echo esc_attr(implode(',', array_map(function($cat) { return $cat->slug; }, $post_categories))); ?>">
          <div class="article-card__tag">
            <span class="label"><?php echo esc_html($display_category_name); ?></span>
          </div>
          <div class="article-card__image" role="img" aria-label="Article featured image">
            <?php if (has_post_thumbnail()) : ?>
              <?php the_post_thumbnail('medium', array('alt' => get_the_title())); ?>
            <?php endif; ?>
          </div>
          <div class="article-card__overlay">
            <div class="article-card__meta">
              <span class="article-card__date"><?php echo get_the_date('F j, Y'); ?></span>
              <span class="article-card__divider"></span>
              <span class="article-card__author"><?php echo esc_html($author_name); ?></span>
            </div>
            <h3 class="article-card__title">
              <?php echo wp_trim_words(get_the_title(), 12, '...'); ?>
            </h3>
            <a href="<?php the_permalink(); ?>" class="article-card__footer">
              <span>Read more</span>
              <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 10h12m0 0l-4-4m4 4l-4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </a>
          </div>
        </article>
        <?php 
            $animation_delay += 0.1;
          endwhile;
          wp_reset_postdata();
        else : 
        ?>
          <p style="grid-column: 1 / -1; text-align: center; padding: 40px; font-family: 'Outfit', sans-serif; font-size: 18px; color: #68747C;">
            No articles found in this category.
          </p>
        <?php endif; ?>
      </div>

      <!-- Load More Button / Pagination -->
      <?php if ($blog_query->max_num_pages > 1) : ?>
      <div class="load-more">
        <?php
        $next_page = ($paged < $blog_query->max_num_pages) ? $paged + 1 : false;
        if ($next_page) :
        ?>
          <a href="<?php echo esc_url(add_query_arg('paged', $next_page)); ?>" class="btn-link" aria-label="Load more articles">
            Load more stories
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4 10h12m0 0l-4-4m4 4l-4 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </a>
        <?php endif; ?>
      </div>
      <?php endif; ?>

        <div class="blog-disclaimer">
          <p class="blog-disclaimer__text">
            While this blog may occasionally contain information that relates to Unitek College's programs or courses, the majority of information provided within this blog is for general informational purposes only and is not intended to represent the specific details of any educational offerings or opinions of Unitek College.
          </p>
          <p class="blog-disclaimer__note">
            *Please note that wage data provided by the Bureau of Labor Statistics (BLS) or other third-party sources may not be an accurate reflection of all areas of the country, may not account for the employees' years of experience, and may not reflect the wages or outlook of entry-level employees, such as graduates of our program. (accessed on 5/20/2025)
          </p>
        </div>
    </section>
  </main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterLinks = document.querySelectorAll('.category-filter-link');
    const filterSelect = document.querySelector('.category-filter-select');
    const articlesGrid = document.querySelector('.articles-grid');
    const loadMoreSection = document.querySelector('.load-more');
    
    // Inline Search Elements
    const searchBtn = document.getElementById('blog-search-btn');
    const searchField = document.getElementById('blog-search-field');
    const searchInput = document.getElementById('blog-search-input');
    const searchSubmit = document.getElementById('blog-search-submit');
    const searchClear = document.getElementById('blog-search-clear');
    let isSearchActive = false;
    let currentSearchQuery = '';
    
    // Search Button Click - Transform to input field
    if (searchBtn) {
        searchBtn.addEventListener('click', function(e) {
            e.preventDefault();
            searchBtn.style.display = 'none';
            searchField.style.display = 'flex';
            searchInput.focus();
            isSearchActive = true;
        });
    }
    
    // Search Submit Click
    if (searchSubmit) {
        searchSubmit.addEventListener('click', function(e) {
            e.preventDefault();
            performSearch();
        });
    }
    
    // Search on Enter key
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                performSearch();
            }
        });
    }
    
    // Clear Search Click
    if (searchClear) {
        searchClear.addEventListener('click', function(e) {
            e.preventDefault();
            closeSearch();
            
            // Reset to current category filter
            const activeCategory = document.querySelector('.category-filter-link.active');
            const category = activeCategory ? activeCategory.getAttribute('data-category') : 'all';
            filterPosts(category);
        });
    }
    
    // Perform Search Function
    function performSearch() {
        const query = searchInput.value.trim();
        
        if (query.length < 2) {
            alert('Please enter at least 2 characters to search');
            return;
        }
        
        currentSearchQuery = query;
        
        // Get current active category
        const activeCategory = document.querySelector('.category-filter-link.active');
        const category = activeCategory ? activeCategory.getAttribute('data-category') : 'all';
        
        // Show loading state
        articlesGrid.style.opacity = '0.5';
        articlesGrid.style.pointerEvents = 'none';
        
        // AJAX search request
        fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=blog_inline_search_posts&query=' + encodeURIComponent(query) + '&category=' + category)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    articlesGrid.innerHTML = data.data.html;
                    
                    // Trigger fade-in animation
                    setTimeout(() => {
                        const cards = articlesGrid.querySelectorAll('.article-card');
                        cards.forEach(card => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0px)';
                        });
                    }, 50);
                    
                    // Hide load more button during search
                    if (loadMoreSection) {
                        loadMoreSection.style.display = 'none';
                    }
                    
                    // Restore visibility
                    articlesGrid.style.opacity = '1';
                    articlesGrid.style.pointerEvents = 'auto';
                } else {
                    console.error('Search failed:', data);
                    articlesGrid.style.opacity = '1';
                    articlesGrid.style.pointerEvents = 'auto';
                }
            })
            .catch(error => {
                console.error('AJAX error:', error);
                articlesGrid.style.opacity = '1';
                articlesGrid.style.pointerEvents = 'auto';
            });
    }
    
    // Close Search Function
    function closeSearch() {
        searchBtn.style.display = 'flex';
        searchField.style.display = 'none';
        searchInput.value = '';
        isSearchActive = false;
        currentSearchQuery = '';
    }
    
    // Desktop category links
    filterLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const category = this.getAttribute('data-category');
            
            // Close search if active
            if (isSearchActive) {
                closeSearch();
            }
            
            filterPosts(category);
            
            // Update active state
            filterLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
            
            // Update mobile select to match
            if (filterSelect) {
                filterSelect.value = category;
            }
        });
    });
    
    // Mobile dropdown
    if (filterSelect) {
        filterSelect.addEventListener('change', function() {
            const category = this.value;
            
            // Close search if active
            if (isSearchActive) {
                closeSearch();
            }
            
            filterPosts(category);
            
            // Update desktop links to match
            filterLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('data-category') === category) {
                    link.classList.add('active');
                }
            });
        });
    }
    
    // AJAX filter function
    function filterPosts(category) {
        // Show loading state
        articlesGrid.style.opacity = '0.5';
        articlesGrid.style.pointerEvents = 'none';
        
        // AJAX request
        fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=filter_blog_posts&category=' + category)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    articlesGrid.innerHTML = data.data.html;
                    
                    // Trigger fade-in animation
                    setTimeout(() => {
                        const cards = articlesGrid.querySelectorAll('.article-card');
                        cards.forEach(card => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0px)';
                        });
                    }, 50);
                    
                    // Update load more button
                    if (loadMoreSection) {
                        if (data.data.has_more) {
                            loadMoreSection.innerHTML = data.data.load_more_html;
                            loadMoreSection.style.display = 'block';
                            
                            // Add event listener to new load more button
                            const loadMoreBtn = loadMoreSection.querySelector('.load-more-btn');
                            if (loadMoreBtn) {
                                loadMoreBtn.addEventListener('click', function(e) {
                                    e.preventDefault();
                                    const page = this.getAttribute('data-page');
                                    const cat = this.getAttribute('data-category');
                                    loadMorePosts(cat, page);
                                });
                            }
                        } else {
                            loadMoreSection.style.display = 'none';
                        }
                    }
                    
                    // Restore visibility
                    articlesGrid.style.opacity = '1';
                    articlesGrid.style.pointerEvents = 'auto';
                } else {
                    console.error('Filter failed:', data);
                    articlesGrid.style.opacity = '1';
                    articlesGrid.style.pointerEvents = 'auto';
                }
            })
            .catch(error => {
                console.error('AJAX error:', error);
                articlesGrid.style.opacity = '1';
                articlesGrid.style.pointerEvents = 'auto';
            });
    }
    
    // Load more posts function
    function loadMorePosts(category, page) {
        // Show loading state
        if (loadMoreSection) {
            loadMoreSection.style.opacity = '0.5';
            loadMoreSection.style.pointerEvents = 'none';
        }
        
        // AJAX request for next page
        fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=filter_blog_posts&category=' + category + '&paged=' + page)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Append new posts
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = data.data.html;
                    const newCards = tempDiv.querySelectorAll('.article-card');
                    
                    newCards.forEach(card => {
                        articlesGrid.appendChild(card);
                    });
                    
                    // Trigger fade-in for new cards
                    setTimeout(() => {
                        newCards.forEach(card => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0px)';
                        });
                    }, 50);
                    
                    // Update load more button
                    if (loadMoreSection) {
                        if (data.data.has_more) {
                            loadMoreSection.innerHTML = data.data.load_more_html;
                            loadMoreSection.style.opacity = '1';
                            loadMoreSection.style.pointerEvents = 'auto';
                            
                            // Re-attach event listener
                            const loadMoreBtn = loadMoreSection.querySelector('.load-more-btn');
                            if (loadMoreBtn) {
                                loadMoreBtn.addEventListener('click', function(e) {
                                    e.preventDefault();
                                    const p = this.getAttribute('data-page');
                                    const c = this.getAttribute('data-category');
                                    loadMorePosts(c, p);
                                });
                            }
                        } else {
                            loadMoreSection.style.display = 'none';
                        }
                    }
                } else {
                    console.error('Load more failed:', data);
                    if (loadMoreSection) {
                        loadMoreSection.style.opacity = '1';
                        loadMoreSection.style.pointerEvents = 'auto';
                    }
                }
            })
            .catch(error => {
                console.error('AJAX error:', error);
                if (loadMoreSection) {
                    loadMoreSection.style.opacity = '1';
                    loadMoreSection.style.pointerEvents = 'auto';
                }
            });
    }
});
</script>

<?php get_footer(); ?>