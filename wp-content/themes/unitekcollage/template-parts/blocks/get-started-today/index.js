document.addEventListener('DOMContentLoaded', function() {
    // Form validation and submission handling
    const form = document.querySelector('.get-started-today-form-fields');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Basic validation
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.style.borderColor = '#dc3545';
                    isValid = false;
                } else {
                    field.style.borderColor = '#CED4DA';
                }
            });
            
            // Email validation
            const emailField = form.querySelector('input[type="email"]');
            if (emailField && emailField.value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailField.value)) {
                    emailField.style.borderColor = '#dc3545';
                    isValid = false;
                }
            }
            
            if (isValid) {
                // Here you can add form submission logic
                console.log('Form submitted successfully');
                alert('Thank you for your submission! We will contact you shortly.');
            } else {
                alert('Please fill in all required fields correctly.');
            }
        });
    }
});

