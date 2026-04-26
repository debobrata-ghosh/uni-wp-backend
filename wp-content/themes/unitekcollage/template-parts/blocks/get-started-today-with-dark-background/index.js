/**
 * Get Started Today (Dark Background) Block JavaScript
 */

(function() {
    'use strict';
    
    // Initialize form functionality
    function initGetStartedDarkForm() {
        const forms = document.querySelectorAll('.get-started-dark-form');
        
        forms.forEach(form => {
            // Add form submission handler
            form.addEventListener('submit', function(e) {
                // You can add custom form validation or AJAX submission here
                // For now, it uses default form submission
                
                // Validate consent checkbox
                const consentCheckbox = form.querySelector('#gsd-consent');
                if (consentCheckbox && !consentCheckbox.checked) {
                    e.preventDefault();
                    alert('Please accept the consent terms to continue.');
                    return false;
                }
            });
            
            // Add phone number formatting
            const phoneInput = form.querySelector('#gsd-phone');
            if (phoneInput) {
                phoneInput.addEventListener('input', function(e) {
                    // Remove non-numeric characters
                    let value = e.target.value.replace(/\D/g, '');
                    // Limit to 10 digits
                    if (value.length > 10) {
                        value = value.slice(0, 10);
                    }
                    // Format as (XXX) XXX-XXXX
                    if (value.length > 6) {
                        value = '(' + value.slice(0, 3) + ') ' + value.slice(3, 6) + '-' + value.slice(6);
                    } else if (value.length > 3) {
                        value = '(' + value.slice(0, 3) + ') ' + value.slice(3);
                    } else if (value.length > 0) {
                        value = '(' + value;
                    }
                    e.target.value = value;
                });
            }
            
            // Add zipcode formatting
            const zipcodeInput = form.querySelector('#gsd-zipcode');
            if (zipcodeInput) {
                zipcodeInput.addEventListener('input', function(e) {
                    // Remove non-numeric characters and limit to 5 digits
                    let value = e.target.value.replace(/\D/g, '');
                    if (value.length > 5) {
                        value = value.slice(0, 5);
                    }
                    e.target.value = value;
                });
            }
        });
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initGetStartedDarkForm);
    } else {
        initGetStartedDarkForm();
    }
    
    // Re-initialize on block update in editor (WordPress blocks may reload content)
    if (typeof acf !== 'undefined') {
        acf.addAction('render_block_preview/type=get-started-today-dark', function() {
            setTimeout(initGetStartedDarkForm, 150);
        });
    }
})();

