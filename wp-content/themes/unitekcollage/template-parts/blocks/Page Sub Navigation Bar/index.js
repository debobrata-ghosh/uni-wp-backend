/**
 * Page Sub Navigation Bar - Frontend JavaScript
 * Handles smooth scrolling and active state management
 */

(function() {
    'use strict';

    // Wait for DOM to be ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Helper function to calculate total sticky offset (header + nav bar + padding)
    function getStickyOffset() {
        const header = document.querySelector('.header');
        const navBar = document.querySelector('.page-sub-nav-bar-block');
        
        // Get actual heights
        const headerHeight = header ? header.offsetHeight : 0;
        const navBarHeight = navBar ? navBar.offsetHeight : 0;
        
        // Get window width for responsive calculation
        const windowWidth = window.innerWidth || document.documentElement.clientWidth;
        
        // Calculate extra padding based on screen size
        let extraPadding = 40; // Default padding
        if (windowWidth <= 768) {
            // Mobile: Much more padding to ensure heading is fully visible and not hidden
            extraPadding = 122; // Significantly increased to ensure heading is completely visible
        } else if (windowWidth <= 1024) {
            // Tablet: Standard padding
            extraPadding = 40;
        }
        
        // Calculate base offset
        let calculatedOffset = headerHeight + navBarHeight + extraPadding;
        
        // For mobile/tablet, ensure we account for actual header height
        if (windowWidth <= 1024) {
            // On tablet/mobile, header is typically 48px
            const mobileHeaderHeight = 48;
            // Use the actual header height if available, otherwise use mobile default
            const actualHeaderHeight = headerHeight > 0 ? headerHeight : mobileHeaderHeight;
            calculatedOffset = actualHeaderHeight + navBarHeight + extraPadding;
        }
        
        return calculatedOffset;
    }

    function init() {
        const navBar = document.querySelector('.page-sub-nav-bar-block');
        if (!navBar) return;

        const navLinks = navBar.querySelectorAll('.page-sub-nav-bar-link[data-anchor]');
        const navList = navBar.querySelector('.page-sub-nav-bar-list');
        const chevronButton = navBar.querySelector('.page-sub-nav-bar-chevron');
        
        // Handle chevron button click to scroll navigation
        if (chevronButton && navList) {
            chevronButton.addEventListener('click', function(e) {
                e.preventDefault();
                const scrollAmount = 200; // Scroll 200px to the right
                navList.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            });
            
            // Show/hide chevron based on scroll position
            function updateChevronVisibility() {
                if (navList.scrollWidth > navList.clientWidth) {
                    // There's overflow, check if we're at the end
                    const isAtEnd = navList.scrollLeft + navList.clientWidth >= navList.scrollWidth - 10;
                    chevronButton.style.opacity = isAtEnd ? '0.3' : '1';
                    chevronButton.style.pointerEvents = isAtEnd ? 'none' : 'auto';
                } else {
                    // No overflow, hide chevron
                    chevronButton.style.opacity = '0.3';
                    chevronButton.style.pointerEvents = 'none';
                }
            }
            
            // Check on scroll
            navList.addEventListener('scroll', updateChevronVisibility);
            
            // Check on load and resize
            updateChevronVisibility();
            window.addEventListener('resize', updateChevronVisibility);
        }
        
        // Handle click events for anchor links
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const anchor = this.getAttribute('data-anchor');
                if (anchor) {
                    const target = document.getElementById(anchor);
                    if (target) {
                        e.preventDefault();
                        
                        // Calculate total sticky offset (header + nav bar + padding)
                        const offset = getStickyOffset();
                        const windowWidth = window.innerWidth || document.documentElement.clientWidth;
                        const currentScrollY = window.pageYOffset || window.scrollY || document.documentElement.scrollTop;
                        
                        // Find the actual element to scroll to (heading if target is section/div)
                        let scrollTarget = target;
                        if (target.tagName === 'SECTION' || target.tagName === 'DIV') {
                            // Look for first heading inside the section/div
                            const firstHeading = target.querySelector('h1, h2, h3, h4, h5, h6');
                            if (firstHeading) {
                                scrollTarget = firstHeading;
                            }
                        }
                        
                        // Get the scroll target's position relative to the document
                        const targetRect = scrollTarget.getBoundingClientRect();
                        const targetTop = targetRect.top + currentScrollY;
                        
                        // Calculate final scroll position with proper offset
                        let scrollPosition = targetTop - offset;
                        
                        // On mobile, add extra buffer to ensure heading is fully visible
                        if (windowWidth <= 768) {
                            // For mobile, add significant buffer to ensure heading is completely visible
                            scrollPosition = targetTop - offset - 30; // Extra 30px buffer on mobile for better visibility
                        }
                        
                        // Use requestAnimationFrame for smoother scrolling
                        requestAnimationFrame(function() {
                            window.scrollTo({
                                top: Math.max(0, scrollPosition), // Ensure we don't scroll to negative position
                                behavior: 'smooth'
                            });
                            
                            // Double-check position after scroll completes (for mobile)
                            if (windowWidth <= 768) {
                                setTimeout(function() {
                                    const finalRect = target.getBoundingClientRect();
                                    const finalOffset = getStickyOffset();
                                    if (finalRect.top < finalOffset) {
                                        // If still hidden, scroll a bit more
                                        window.scrollTo({
                                            top: window.pageYOffset + (finalOffset - finalRect.top) + 10,
                                            behavior: 'smooth'
                                        });
                                    }
                                }, 600); // Wait for smooth scroll to complete
                            }
                        });
                        
                        // Update active state after a small delay to ensure scroll completes
                        setTimeout(function() {
                            updateActiveState(anchor);
                        }, 100);
                        
                        // Update URL hash without scrolling
                        if (history.pushState) {
                            history.pushState(null, null, '#' + anchor);
                        }
                    }
                }
            });
        });

        // Update active state on scroll
        let ticking = false;
        window.addEventListener('scroll', function() {
            if (!ticking) {
                window.requestAnimationFrame(function() {
                    updateActiveStateOnScroll();
                    ticking = false;
                });
                ticking = true;
            }
        });

        // Update active state and scroll to anchor on page load if hash exists
        if (window.location.hash) {
            const hash = window.location.hash.substring(1);
            const target = document.getElementById(hash);
            if (target) {
                // Small delay to ensure page is fully loaded and heights are calculated
                setTimeout(function() {
                    // Calculate total sticky offset (header + nav bar + padding)
                    const offset = getStickyOffset();
                    
                    const targetRect = target.getBoundingClientRect();
                    const currentScrollY = window.pageYOffset || window.scrollY || document.documentElement.scrollTop;
                    const targetTop = targetRect.top + currentScrollY;
                    const scrollPosition = targetTop - offset;
                    
                    requestAnimationFrame(function() {
                        window.scrollTo({
                            top: Math.max(0, scrollPosition), // Ensure we don't scroll to negative position
                            behavior: 'smooth'
                        });
                    });
                }, 300); // Increased delay to ensure all elements are rendered
            }
            updateActiveState(hash);
        }
    }

    function updateActiveState(anchorId) {
        const navBar = document.querySelector('.page-sub-nav-bar-block');
        if (!navBar) return;

        const links = navBar.querySelectorAll('.page-sub-nav-bar-link');
        links.forEach(link => {
            const linkAnchor = link.getAttribute('data-anchor');
            if (linkAnchor === anchorId) {
                link.classList.add('is-active');
            } else {
                link.classList.remove('is-active');
            }
        });
    }

    function updateActiveStateOnScroll() {
        const navBar = document.querySelector('.page-sub-nav-bar-block');
        if (!navBar) return;

        const navLinks = navBar.querySelectorAll('.page-sub-nav-bar-link[data-anchor]');
        // Calculate total sticky offset (header + nav bar + padding)
        const stickyOffset = getStickyOffset();
        const scrollOffset = window.pageYOffset + stickyOffset;

        let currentActive = null;
        let currentActiveOffset = Infinity;

        navLinks.forEach(link => {
            const anchor = link.getAttribute('data-anchor');
            if (anchor) {
                const target = document.getElementById(anchor);
                if (target) {
                    const targetOffset = target.getBoundingClientRect().top + window.pageYOffset;
                    const distance = Math.abs(scrollOffset - targetOffset);
                    
                    if (targetOffset <= scrollOffset && distance < currentActiveOffset) {
                        currentActive = anchor;
                        currentActiveOffset = distance;
                    }
                }
            }
        });

        if (currentActive) {
            updateActiveState(currentActive);
        }
    }
})();

