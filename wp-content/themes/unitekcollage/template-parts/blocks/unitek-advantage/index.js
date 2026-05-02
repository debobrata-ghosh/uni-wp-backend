// Color mapping for thumbnail styles (matches PHP function)
const THUMBNAIL_COLORS = {
    'thumbnail_1': { bg: '#28323C', font: '#00A3E0' },  // Dark Grey with Light Blue
    'thumbnail_2': { bg: '#0072CE', font: '#00A3E0' },  // Dark Blue with Light Blue
    'thumbnail_3': { bg: '#28323C', font: '#B4E850' },  // Dark Grey with Light Green
    'thumbnail_4': { bg: '#00A3E0', font: '#FFFFFF' },  // Bright Blue with White
    'thumbnail_5': { bg: '#B4E850', font: '#FFFFFF' },  // Light Green with White
    'thumbnail_6': { bg: '#B4E850', font: '#28323C' }   // Light Green with Dark Grey
};

// Function to get thumbnail style from current slide data attributes (fallback)
function getThumbnailStyleFromDOM() {
    // First, try to get from container data attribute (most reliable)
    const container = document.querySelector('.unitek-advantage-testimonial');
    if (container) {
        const thumbnailStyle = container.getAttribute('data-thumbnail-style');
        if (thumbnailStyle) {
            return thumbnailStyle;
        }
    }
    
    // Fallback: try from first slide
    const firstSlide = document.querySelector('.unitek-advantage-testimonial-slide');
    if (firstSlide) {
        const bgColor = firstSlide.getAttribute('data-color');
        // Try to match background color to thumbnail style
        for (const [style, colors] of Object.entries(THUMBNAIL_COLORS)) {
            if (colors.bg === bgColor) {
                return style;
            }
        }
    }
    return null;
}

// Function to update testimonial colors
function updateTestimonialColors(thumbnailStyle) {
    const colors = THUMBNAIL_COLORS[thumbnailStyle];
    if (!colors) {
        console.warn('Unknown thumbnail style:', thumbnailStyle);
        return;
    }
    
    // Try to find elements - check multiple contexts (main document, iframe, block container)
    let testimonialContainer = document.querySelector('.unitek-advantage-testimonial');
    let testimonialSlides = document.querySelectorAll('.unitek-advantage-testimonial-slide');
    let testimonialDots = document.querySelectorAll('.unitek-advantage-testimonial-dot');
    
    // If not found, try within block container
    if (!testimonialContainer) {
        const blockContainer = document.querySelector('.wp-block-acf-unitek-advantage');
        if (blockContainer) {
            testimonialContainer = blockContainer.querySelector('.unitek-advantage-testimonial');
            testimonialSlides = blockContainer.querySelectorAll('.unitek-advantage-testimonial-slide');
            testimonialDots = blockContainer.querySelectorAll('.unitek-advantage-testimonial-dot');
        }
    }
    
    // Try iframe (WordPress editor preview)
    if (!testimonialContainer && window.frameElement) {
        try {
            const iframeDoc = window.frameElement.contentDocument || window.frameElement.contentWindow.document;
            testimonialContainer = iframeDoc.querySelector('.unitek-advantage-testimonial');
            testimonialSlides = iframeDoc.querySelectorAll('.unitek-advantage-testimonial-slide');
            testimonialDots = iframeDoc.querySelectorAll('.unitek-advantage-testimonial-dot');
        } catch (e) {
            console.log('Cannot access iframe:', e);
        }
    }
    
    if (!testimonialContainer && testimonialSlides.length === 0) {
        console.log('No testimonial elements found. Searching again in 500ms...');
        // Retry after a delay
        setTimeout(() => {
            updateTestimonialColors(thumbnailStyle);
        }, 500);
        return;
    }
    
    // Update container background - use setProperty to ensure it overrides inline styles
    // Update ALL testimonial containers on the page (in case there are multiple blocks)
    const allContainers = document.querySelectorAll('.unitek-advantage-testimonial');
    
    if (allContainers.length > 0) {
        allContainers.forEach((container, index) => {
            // Update data attributes
            container.setAttribute('data-thumbnail-style', thumbnailStyle);
            container.setAttribute('data-bg-color', colors.bg);
            container.setAttribute('data-font-color', colors.font);
            
            // Remove existing inline style first
            container.style.removeProperty('background-color');
            // Set new background color with !important
            container.style.setProperty('background-color', colors.bg, 'important');
            console.log(`✅ Updated container ${index + 1} background to:`, colors.bg);
        });
        console.log(`✅ Updated ${allContainers.length} testimonial container(s)`);
    } else if (testimonialContainer) {
        // Fallback to single container
        testimonialContainer.setAttribute('data-thumbnail-style', thumbnailStyle);
        testimonialContainer.setAttribute('data-bg-color', colors.bg);
        testimonialContainer.setAttribute('data-font-color', colors.font);
        testimonialContainer.style.removeProperty('background-color');
        testimonialContainer.style.setProperty('background-color', colors.bg, 'important');
        console.log('✅ Updated container background to:', colors.bg);
    } else {
        console.error('❌ Testimonial container not found!');
        console.log('   Searching for:', '.unitek-advantage-testimonial');
        console.log('   Document ready state:', document.readyState);
        console.log('   Body exists:', !!document.body);
    }
    
    // Update all slides with new colors
    testimonialSlides.forEach((slide, index) => {
        // Update data attributes
        slide.setAttribute('data-color', colors.bg);
        slide.setAttribute('data-font-color', colors.font);
        
        // Update visible elements
        const quoteElement = slide.querySelector('.unitek-advantage-testimonial-quote');
        const textElement = slide.querySelector('.unitek-advantage-testimonial-text');
        const nameElement = slide.querySelector('.unitek-advantage-testimonial-name');
        const titleElement = slide.querySelector('.unitek-advantage-testimonial-title');
        
        if (quoteElement) quoteElement.style.color = colors.font;
        if (textElement) textElement.style.color = colors.font;
        if (nameElement) nameElement.style.color = colors.font;
        if (titleElement) titleElement.style.color = colors.font;
        
        // Update slide style if active
        if (slide.classList.contains('active')) {
            slide.style.color = colors.font;
        }
    });
    
    // Update pagination dots
    testimonialDots.forEach((dot, index) => {
        const isActive = dot.classList.contains('active');
        if (isActive) {
            dot.style.backgroundColor = colors.font;
        } else {
            // Convert hex to rgba for transparency
            const r = parseInt(colors.font.slice(1, 3), 16);
            const g = parseInt(colors.font.slice(3, 5), 16);
            const b = parseInt(colors.font.slice(5, 7), 16);
            dot.style.backgroundColor = `rgba(${r}, ${g}, ${b}, 0.3)`;
        }
    });
    
    console.log('✅ Updated testimonial colors for', thumbnailStyle, ':', colors);
}

// Listen for ACF field changes in the editor
function initEditorPreview() {
    // Method 1: Direct event listener on radio buttons (most reliable)
    function attachRadioListeners() {
        // Try multiple possible field name patterns
        const fieldNamePatterns = [
            'input[name="acf[field_unitek_advantage_testimonial_thumbnail]"]',
            'input[name*="unitek_advantage_testimonial_thumbnail"]',
            'input[type="radio"][value^="thumbnail_"]',
            '.acf-field[data-name="unitek_advantage_testimonial_thumbnail"] input[type="radio"]',
            '.acf-field[data-key="field_unitek_advantage_testimonial_thumbnail"] input[type="radio"]'
        ];
        
        let radioButtons = [];
        fieldNamePatterns.forEach(pattern => {
            const found = document.querySelectorAll(pattern);
            if (found.length > 0) {
                console.log('Found radio buttons with pattern:', pattern, found.length);
                radioButtons = Array.from(found);
            }
        });
        
        if (radioButtons.length === 0) {
            console.log('No radio buttons found. Will retry...');
            return false;
        }
        
        radioButtons.forEach(radio => {
            // Remove existing listeners to avoid duplicates
            const newRadio = radio.cloneNode(true);
            radio.parentNode.replaceChild(newRadio, radio);
            
            newRadio.addEventListener('change', function() {
                const thumbnailStyle = this.value;
                console.log('📻 Radio button changed to:', thumbnailStyle);
                if (thumbnailStyle) {
                    // Wait a bit for block to re-render, then update multiple times
                    setTimeout(() => {
                        updateTestimonialColors(thumbnailStyle);
                    }, 300);
                    setTimeout(() => {
                        updateTestimonialColors(thumbnailStyle);
                    }, 800);
                    setTimeout(() => {
                        updateTestimonialColors(thumbnailStyle);
                    }, 1500);
                }
            });
        });
        
        // Also check initial value
        const checkedRadio = radioButtons.find(r => r.checked);
        if (checkedRadio) {
            const thumbnailStyle = checkedRadio.value;
            console.log('📻 Initial radio value:', thumbnailStyle);
            if (thumbnailStyle) {
                setTimeout(() => {
                    updateTestimonialColors(thumbnailStyle);
                }, 200);
            }
        }
        
        return true;
    }
    
    // Try to attach listeners immediately
    let attached = attachRadioListeners();
    
    // Also try after delays (in case DOM isn't ready or ACF loads later)
    if (!attached) {
        setTimeout(() => {
            attachRadioListeners();
        }, 500);
    }
    setTimeout(() => {
        attachRadioListeners();
    }, 1500);
    setTimeout(() => {
        attachRadioListeners();
    }, 3000);
    
    // Method 2: ACF hooks (if available)
    if (typeof acf !== 'undefined' && acf.addAction) {
        // Listen for field changes
        acf.addAction('change_field/name=unitek_advantage_testimonial_thumbnail', function(field) {
            const thumbnailStyle = field.val();
            console.log('🔧 ACF field changed to:', thumbnailStyle);
            if (thumbnailStyle) {
                // Wait a bit for block to re-render
                setTimeout(() => {
                    updateTestimonialColors(thumbnailStyle);
                }, 300);
            }
        });
        
        // Also listen for ready event to set initial colors
        acf.addAction('ready', function() {
            const thumbnailField = acf.getField('unitek_advantage_testimonial_thumbnail');
            if (thumbnailField) {
                const thumbnailStyle = thumbnailField.val();
                console.log('🔧 Initial thumbnail style from ACF:', thumbnailStyle);
                if (thumbnailStyle) {
                    // Small delay to ensure DOM is ready
                    setTimeout(() => {
                        updateTestimonialColors(thumbnailStyle);
                    }, 100);
                }
            } else {
                // Fallback: try to get from DOM
                setTimeout(() => {
                    const styleFromDOM = getThumbnailStyleFromDOM();
                    if (styleFromDOM) {
                        console.log('Using thumbnail style from DOM:', styleFromDOM);
                        updateTestimonialColors(styleFromDOM);
                    }
                }, 200);
            }
        });
    }
    
    // Also use MutationObserver as a fallback to watch for DOM changes (debounced)
    if (typeof MutationObserver !== 'undefined') {
        let updateTimeout;
        const observer = new MutationObserver(function(mutations) {
            // Debounce updates to avoid excessive calls
            clearTimeout(updateTimeout);
            updateTimeout = setTimeout(() => {
                // Check if testimonial block exists
                const testimonialBlock = document.querySelector('.unitek-advantage-testimonial');
                if (testimonialBlock) {
                    let thumbnailStyle = null;
                    
                    // Try to get thumbnail style from ACF field first
                    if (typeof acf !== 'undefined') {
                        const thumbnailField = acf.getField('unitek_advantage_testimonial_thumbnail');
                        if (thumbnailField) {
                            thumbnailStyle = thumbnailField.val();
                        }
                    }
                    
                    // Fallback: get from DOM data attributes
                    if (!thumbnailStyle) {
                        thumbnailStyle = getThumbnailStyleFromDOM();
                    }
                    
                    if (thumbnailStyle) {
                        updateTestimonialColors(thumbnailStyle);
                    }
                }
            }, 500); // Wait 500ms after last mutation
        });
        
        // Only observe in editor context
        if (document.body && (document.body.classList.contains('block-editor-page') || window.wp)) {
            observer.observe(document.body, {
                childList: true,
                subtree: true,
                attributes: false
            });
        }
    }
    
    // Initial check on load (fallback if ACF isn't available)
    setTimeout(() => {
        if (typeof acf === 'undefined' || !acf.getField) {
            const styleFromDOM = getThumbnailStyleFromDOM();
            if (styleFromDOM) {
                console.log('Initial load: Using thumbnail style from DOM:', styleFromDOM);
                updateTestimonialColors(styleFromDOM);
            }
        }
    }, 300);
}

document.addEventListener('DOMContentLoaded', function() {
    const testimonialDots = document.querySelectorAll('.unitek-advantage-testimonial-dot');
    const testimonialSlides = document.querySelectorAll('.unitek-advantage-testimonial-slide');
    const testimonialContainer = document.querySelector('.unitek-advantage-testimonial');
    let currentSlide = 0;
    
    // Initialize editor preview updates
    initEditorPreview();
    
    // Function to show specific slide
    function showSlide(slideIndex) {
        // Remove active class from all slides and dots
        testimonialSlides.forEach(slide => slide.classList.remove('active'));
        testimonialDots.forEach(dot => dot.classList.remove('active'));
        
        // Add active class to current slide and dot
        if (testimonialSlides[slideIndex]) {
            const activeSlide = testimonialSlides[slideIndex];
            activeSlide.classList.add('active');
            
            // Get colors from data attributes
            const bgColor = activeSlide.getAttribute('data-color');
            const fontColor = activeSlide.getAttribute('data-font-color');
            
            // Update container background color based on active slide
            if (testimonialContainer && bgColor) {
                testimonialContainer.style.backgroundColor = bgColor;
            }
            
            // Update font colors based on active slide
            if (fontColor) {
                const quoteElement = activeSlide.querySelector('.unitek-advantage-testimonial-quote');
                const textElement = activeSlide.querySelector('.unitek-advantage-testimonial-text');
                const nameElement = activeSlide.querySelector('.unitek-advantage-testimonial-name');
                const titleElement = activeSlide.querySelector('.unitek-advantage-testimonial-title');
                
                if (quoteElement) quoteElement.style.color = fontColor;
                if (textElement) textElement.style.color = fontColor;
                if (nameElement) nameElement.style.color = fontColor;
                if (titleElement) titleElement.style.color = fontColor;
                
                // Update pagination dots color
                testimonialDots.forEach((dot, index) => {
                    if (index === slideIndex) {
                        dot.style.backgroundColor = fontColor;
                    } else {
                        // Convert hex to rgba for transparency
                        const r = parseInt(fontColor.slice(1, 3), 16);
                        const g = parseInt(fontColor.slice(3, 5), 16);
                        const b = parseInt(fontColor.slice(5, 7), 16);
                        dot.style.backgroundColor = `rgba(${r}, ${g}, ${b}, 0.3)`;
                    }
                });
            }
        }
        if (testimonialDots[slideIndex]) {
            testimonialDots[slideIndex].classList.add('active');
        }
        
        currentSlide = slideIndex;
    }
    
    // Initialize with first slide's color and font color
    if (testimonialSlides.length > 0) {
        showSlide(0);
    }
    
    // Add click event listeners to dots
    testimonialDots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            showSlide(index);
        });
    });
    
    // Auto-rotate carousel every 5 seconds (only on frontend, not in editor)
    if (!document.body.classList.contains('block-editor-page')) {
        setInterval(() => {
            const nextSlide = (currentSlide + 1) % testimonialSlides.length;
            showSlide(nextSlide);
        }, 5000);
    }
});

