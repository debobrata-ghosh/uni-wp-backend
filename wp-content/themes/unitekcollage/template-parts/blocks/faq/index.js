// Category switching function
function switchFAQCategory(categoryIndex) {
    // Update tab active states
    const tabs = document.querySelectorAll('.faq-category-tab');
    tabs.forEach((tab, index) => {
        if (index === categoryIndex) {
            tab.classList.add('active');
            tab.setAttribute('aria-expanded', 'true');
        } else {
            tab.classList.remove('active');
            tab.setAttribute('aria-expanded', 'false');
        }
    });
    
    // Update desktop accordion content - hide all categories first
    const accordionCategories = document.querySelectorAll('.faq-accordion-category');
    accordionCategories.forEach((category, index) => {
        if (index === categoryIndex) {
            category.classList.add('active');
        } else {
            category.classList.remove('active');
        }
    });
    
    // Update mobile accordion - show/hide categories
    const mobileAccordions = document.querySelectorAll('.faq-mobile-accordion');
    mobileAccordions.forEach((accordion, index) => {
        if (index === categoryIndex) {
            accordion.classList.add('active');
        } else {
            accordion.classList.remove('active');
        }
    });
    
    // Close all open accordion items when switching categories
    const allAnswers = document.querySelectorAll('.faq-accordion-answer, .faq-mobile-answer');
    const allQuestions = document.querySelectorAll('.faq-accordion-question, .faq-mobile-question');
    
    allAnswers.forEach(answer => {
        answer.classList.remove('active');
    });
    
    allQuestions.forEach(question => {
        question.classList.remove('active');
        question.setAttribute('aria-expanded', 'false');
    });
}

// FAQ item toggle function (desktop)
function toggleFAQItem(button) {
    const answer = button.nextElementSibling;
    const isActive = answer.classList.contains('active');
    
    // Only work within the active category
    const currentCategory = button.closest('.faq-accordion-category');
    if (!currentCategory.classList.contains('active')) {
        return; // Don't toggle if category is not active
    }
    
    // Close all other FAQ items in the same category
    const allQuestionsInCategory = currentCategory.querySelectorAll('.faq-accordion-question');
    const allAnswersInCategory = currentCategory.querySelectorAll('.faq-accordion-answer');
    
    allQuestionsInCategory.forEach(q => {
        if (q !== button) {
            q.classList.remove('active');
            q.setAttribute('aria-expanded', 'false');
        }
    });
    
    allAnswersInCategory.forEach(a => {
        if (a !== answer) {
            a.classList.remove('active');
        }
    });
    
    // Toggle current item
    if (isActive) {
        answer.classList.remove('active');
        button.classList.remove('active');
        button.setAttribute('aria-expanded', 'false');
    } else {
        answer.classList.add('active');
        button.classList.add('active');
        button.setAttribute('aria-expanded', 'true');
    }
}

// Mobile FAQ item toggle function
function toggleMobileFAQItem(button) {
    const answer = button.nextElementSibling;
    const isActive = answer.classList.contains('active');
    
    // Only work within the active mobile category
    const currentMobileCategory = button.closest('.faq-mobile-accordion');
    if (!currentMobileCategory.classList.contains('active')) {
        return; // Don't toggle if category is not active
    }
    
    // Close all other FAQ items in the same mobile category
    const allQuestionsInCategory = currentMobileCategory.querySelectorAll('.faq-mobile-question');
    const allAnswersInCategory = currentMobileCategory.querySelectorAll('.faq-mobile-answer');
    
    allQuestionsInCategory.forEach(q => {
        if (q !== button) {
            q.classList.remove('active');
            q.setAttribute('aria-expanded', 'false');
        }
    });
    
    allAnswersInCategory.forEach(a => {
        if (a !== answer) {
            a.classList.remove('active');
        }
    });
    
    // Toggle current item
    if (isActive) {
        answer.classList.remove('active');
        button.classList.remove('active');
        button.setAttribute('aria-expanded', 'false');
    } else {
        answer.classList.add('active');
        button.classList.add('active');
        button.setAttribute('aria-expanded', 'true');
    }
}

// Function to activate first category and expand first question
function activateFirstCategory() {
    const isDesktop = window.innerWidth > 768;
    const isEditor = document.body.classList.contains('block-editor-page') || 
                     document.querySelector('.block-editor-block-list__layout') ||
                     document.querySelector('.editor-styles-wrapper');
    
    // Always activate first category in editor or on desktop
    if (isDesktop || isEditor) {
        const firstTab = document.querySelector('.faq-category-tab');
        if (firstTab) {
            const tabs = document.querySelectorAll('.faq-category-tab');
            const tabIndex = Array.from(tabs).indexOf(firstTab);
            if (tabIndex >= 0 && !firstTab.classList.contains('active')) {
                switchFAQCategory(tabIndex);
            }
            
            // Also expand first question in first category for editor preview
            if (isEditor) {
                setTimeout(function() {
                    const firstCategory = document.querySelector('.faq-accordion-category:first-child');
                    if (firstCategory) {
                        const firstQuestion = firstCategory.querySelector('.faq-accordion-question:first-child');
                        const firstAnswer = firstCategory.querySelector('.faq-accordion-answer:first-child');
                        if (firstQuestion && firstAnswer && !firstAnswer.classList.contains('active')) {
                            firstAnswer.classList.add('active');
                            firstQuestion.classList.add('active');
                            firstQuestion.setAttribute('aria-expanded', 'true');
                        }
                    }
                }, 100);
            }
        }
    }
}

// Use event delegation for better editor compatibility
document.addEventListener('click', function(e) {
    // Handle category tab clicks
    if (e.target.classList.contains('faq-category-tab') || e.target.closest('.faq-category-tab')) {
        const tab = e.target.classList.contains('faq-category-tab') ? e.target : e.target.closest('.faq-category-tab');
        if (tab) {
            e.preventDefault();
            e.stopPropagation();
            const tabs = document.querySelectorAll('.faq-category-tab');
            const index = Array.from(tabs).indexOf(tab);
            if (index >= 0) {
                switchFAQCategory(index);
            }
        }
    }
    
    // Handle desktop FAQ question clicks
    if (e.target.classList.contains('faq-accordion-question') || e.target.closest('.faq-accordion-question')) {
        const question = e.target.classList.contains('faq-accordion-question') ? e.target : e.target.closest('.faq-accordion-question');
        if (question) {
            e.preventDefault();
            e.stopPropagation();
            toggleFAQItem(question);
        }
    }
    
    // Handle mobile FAQ question clicks
    if (e.target.classList.contains('faq-mobile-question') || e.target.closest('.faq-mobile-question')) {
        const question = e.target.classList.contains('faq-mobile-question') ? e.target : e.target.closest('.faq-mobile-question');
        if (question) {
            e.preventDefault();
            e.stopPropagation();
            toggleMobileFAQItem(question);
        }
    }
}, true); // Use capture phase for better event handling

// Initialize on page load
function initializeFAQ() {
    activateFirstCategory();
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeFAQ);
} else {
    initializeFAQ();
}

// Also initialize for editor preview (Gutenberg)
if (typeof wp !== 'undefined' && wp.domReady) {
    wp.domReady(initializeFAQ);
}

// Re-initialize when ACF block is rendered/updated
if (typeof acf !== 'undefined') {
    acf.addAction('render_block_preview/type=faq', function() {
        setTimeout(initializeFAQ, 50);
    });
}

// Use MutationObserver to handle dynamically loaded content in editor
if (typeof MutationObserver !== 'undefined') {
    let initTimeout;
    const observer = new MutationObserver(function(mutations) {
        const hasFAQBlock = document.querySelector('.faq-section-block');
        if (hasFAQBlock) {
            clearTimeout(initTimeout);
            initTimeout = setTimeout(initializeFAQ, 100);
        }
    });
    
    // Start observing when body is available
    if (document.body) {
        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    } else {
        document.addEventListener('DOMContentLoaded', function() {
            if (document.body) {
                observer.observe(document.body, {
                    childList: true,
                    subtree: true
                });
            }
        });
    }
}

