document.addEventListener('DOMContentLoaded', function () {
  // Hide CF7 Akismet honeypot label inside this block only
  var honeypots = document.querySelectorAll(
    '.get-started-today-block textarea[name="_wpcf7_ak_hp_textarea"]'
  );

  honeypots.forEach(function (textarea) {
    var label = textarea.closest('label');
    if (label) {
      label.style.display = 'none';
    } else {
      // Fallback: hide the textarea itself
      textarea.style.display = 'none';
    }
  });
});

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

