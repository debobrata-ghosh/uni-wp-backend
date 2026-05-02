/**
 * Hero Get Started Block - JavaScript
 * Multi-step form functionality
 */

(function() {
    'use strict';

    // Global variables
    var currentStep = 1;
    var totalSteps = 6; // Updated to 6 steps: campus, program, first name, last name, phone, email+consent
    var isSubmitting = false; // Flag to prevent duplicate submissions

    // Campus-specific programs
    var campusPrograms = {
        'Unitek College - Bakersfield': [
            {value: '', text: 'PROGRAM OF INTEREST*'},
            {value: 'Bachelors of Science in Nursing', text: 'Bachelors of Science in Nursing'},
            {value: 'Bachelors of Science in Nursing{LVNtoBSN}', text: 'LVN to BSN (Track)'},
            {value: 'Medical Assisting', text: 'Medical Assisting'},
            {value: 'Vocational Nursing', text: 'Vocational Nursing'},
            {value: 'Associate of Science in Vocational Nursing', text: 'Vocational Nursing (Associate Degree)'}
        ],
        'Unitek College - Concord': [
            {value: '', text: 'PROGRAM OF INTEREST*'},
            {value: 'Bachelors of Science in Nursing', text: 'Bachelors of Science in Nursing'},
            {value: 'Bachelors of Science in Nursing{LVNtoBSN}', text: 'LVN to BSN (Track)'},
            {value: 'Medical Assisting', text: 'Medical Assisting'},
            {value: 'Vocational Nursing', text: 'Vocational Nursing'},
            {value: 'Associate of Science in Vocational Nursing', text: 'Vocational Nursing (Associate Degree)'}
        ],
        'Unitek College - Fremont': [
            {value: '', text: 'PROGRAM OF INTEREST*'},
            {value: 'Bachelors of Science in Nursing', text: 'Bachelors of Science in Nursing'},
            {value: 'Bachelors of Science in Nursing{LVNtoBSN}', text: 'LVN to BSN (Track)'},
            {value: 'Medical Assisting', text: 'Medical Assisting'},
            {value: 'Medical Office Administration', text: 'Medical Office Administration'},
            {value: 'Vocational Nursing', text: 'Vocational Nursing'},
            {value: 'Associate of Science in Vocational Nursing', text: 'Vocational Nursing (Associate Degree)'}
        ],
        'Unitek College - Hayward': [
            {value: '', text: 'PROGRAM OF INTEREST*'},
            {value: 'Medical Assisting', text: 'Medical Assisting'},
            {value: 'Vocational Nursing', text: 'Vocational Nursing'},
            {value: 'Associate of Science in Vocational Nursing', text: 'Vocational Nursing (Associate Degree)'}
        ],
        'Unitek College - Ontario': [
            {value: '', text: 'PROGRAM OF INTEREST*'},
            {value: 'Medical Assisting', text: 'Medical Assisting'}
        ],
        'Unitek College - Reno': [
            {value: '', text: 'PROGRAM OF INTEREST*'},
            {value: 'Bachelors of Science in Nursing', text: 'Bachelors of Science in Nursing'},
            {value: 'Bachelors of Science in Nursing{LVNtoBSN}', text: 'LVN to BSN (Track)'},
            {value: 'Medical Assisting', text: 'Medical Assisting'},
            {value: 'Practical Nursing', text: 'Practical Nursing'},
            {value: 'Associate of Science in Vocational Nursing', text: 'Vocational Nursing (Associate Degree)'}
        ],
        'Unitek College - Sacramento': [
            {value: '', text: 'PROGRAM OF INTEREST*'},
            {value: 'Bachelors of Science in Nursing', text: 'Bachelors of Science in Nursing'},
            {value: 'Bachelors of Science in Nursing{LVNtoBSN}', text: 'LVN to BSN (Track)'},
            {value: 'Medical Assisting', text: 'Medical Assisting'},
            {value: 'Vocational Nursing', text: 'Vocational Nursing'},
            {value: 'Associate of Science in Vocational Nursing', text: 'Vocational Nursing (Associate Degree)'}
        ],
        'Unitek College - San Jose': [
            {value: '', text: 'PROGRAM OF INTEREST*'},
            {value: 'Medical Assisting', text: 'Medical Assisting'},
            {value: 'Vocational Nursing', text: 'Vocational Nursing'},
            {value: 'Associate of Science in Vocational Nursing', text: 'Vocational Nursing (Associate Degree)'}
        ],
        'Unitek College - South San Francisco': [
            {value: '', text: 'PROGRAM OF INTEREST*'},
            {value: 'Medical Assisting', text: 'Medical Assisting'},
            {value: 'Vocational Nursing', text: 'Vocational Nursing'},
            {value: 'Associate of Science in Vocational Nursing', text: 'Vocational Nursing (Associate Degree)'}
        ],
        'Unitek College - Online': [
            {value: '', text: 'PROGRAM OF INTEREST*'},
            {value: 'Associate of Science in Vocational Nursing', text: 'Vocational Nursing (Associate Degree)'}
        ]
    };

    // Function to validate phone input
    window.validatePhoneInput = function(input) {
        // Remove any non-numeric characters
        var numericValue = input.value.replace(/\D/g, '');
        
        // Limit to maximum 10 digits
        if (numericValue.length > 10) {
            numericValue = numericValue.substring(0, 10);
        }
        
        // Update the input with only numeric characters (max 10 digits)
        if (input.value !== numericValue) {
            input.value = numericValue;
        }
        
        // Update input text color and background when populated
        if (numericValue.length > 0) {
            input.style.color = '#ffffff';
            input.style.fontWeight = '500';
            input.style.backgroundColor = 'transparent';
        } else {
            input.style.color = '#68747C';
            input.style.fontWeight = '300';
            input.style.backgroundColor = '#ffffff';
        }
        
        console.log('Phone input validation called, value:', numericValue, 'length:', numericValue.length);
        var nextBtn = document.getElementById('hgs-next');
        if (!nextBtn) {
            console.log('Next button not found!');
            return;
        }
        
        // Check if we have exactly 10 digits
        if (numericValue.length === 10) {
            nextBtn.disabled = false;
            nextBtn.classList.add('active');
            nextBtn.style.backgroundColor = '#B4E850';
            nextBtn.style.color = '#28323C';
            nextBtn.style.cursor = 'pointer';
            console.log('Next button enabled');
        } else {
            nextBtn.disabled = true;
            nextBtn.classList.remove('active');
            nextBtn.style.backgroundColor = '#68747C';
            nextBtn.style.color = '#28323C';
            nextBtn.style.cursor = 'not-allowed';
            console.log('Next button disabled');
        }
    };

    // Function to validate email input
    window.validateEmailInput = function(input) {
        // Email validation regex pattern
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var isValidEmail = emailPattern.test(input.value.trim());
        
        // Update input text color and background when populated
        if (input.value.trim().length > 0) {
            input.style.color = '#ffffff';
            input.style.fontWeight = '500';
            input.style.backgroundColor = 'transparent';
        } else {
            input.style.color = '#68747C';
            input.style.fontWeight = '300';
            input.style.backgroundColor = '#ffffff';
        }
        
        console.log('Email input validation called, value:', input.value, 'valid:', isValidEmail);
        
        // Check both email validity and consent checkbox
        checkStep6Validation();
    };

    // Function to validate consent checkbox
    window.validateConsentInput = function(checkbox) {
        console.log('Consent checkbox validation called, checked:', checkbox.checked);
        
        // Check both email validity and consent checkbox
        checkStep6Validation();
    };

    // Function to check if both email and consent are valid for step 6
    function checkStep6Validation() {
        var emailInput = document.getElementById('hgs-email');
        var consentCheckbox = document.getElementById('hgs-consent');
        var submitBtn = document.getElementById('hgs-submit');
        var submitBtnMobile = document.getElementById('hgs-submit-mobile');
        
        if (!emailInput || !consentCheckbox || !submitBtn) {
            console.log('Step 6 elements not found');
            return;
        }
        
        // Email validation regex pattern
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var isValidEmail = emailPattern.test(emailInput.value.trim());
        var isConsentChecked = consentCheckbox.checked;
        
        console.log('Step 6 validation check - Email valid:', isValidEmail, 'Consent checked:', isConsentChecked);
        
        // Enable submit buttons only if both email is valid AND consent is checked
        var buttons = [submitBtn];
        if (submitBtnMobile) {
            buttons.push(submitBtnMobile);
        }
        
        buttons.forEach(function(btn) {
            if (isValidEmail && isConsentChecked) {
                btn.disabled = false;
                btn.classList.add('active');
                btn.style.backgroundColor = '#B4E850';
                btn.style.color = '#28323C';
                btn.style.cursor = 'pointer';
            } else {
                btn.disabled = true;
                btn.classList.remove('active');
                btn.style.backgroundColor = '#68747C';
                btn.style.color = '#28323C';
                btn.style.cursor = 'not-allowed';
            }
        });
        
        if (isValidEmail && isConsentChecked) {
            console.log('Get started button enabled');
        } else {
            console.log('Get started button disabled - Email valid:', isValidEmail, 'Consent:', isConsentChecked);
        }
    }

    // Function to update programs based on campus selection
    function updateProgramsForCampus(campusValue) {
        var programSelect = document.getElementById('hgs-program');
        if (!programSelect) return;
        
        // Clear existing options
        programSelect.innerHTML = '';
        
        // Reset to unselected state (white background, gray text)
        programSelect.style.color = '#68747C';
        programSelect.style.fontWeight = '300';
        programSelect.style.backgroundColor = '#ffffff';
        
        // Get programs for selected campus
        var programs = campusPrograms[campusValue] || campusPrograms['Unitek College - Bakersfield'];
        
        // Add new options
        for (var i = 0; i < programs.length; i++) {
            var option = document.createElement('option');
            option.value = programs[i].value;
            option.textContent = programs[i].text;
            if (i === 0) {
                option.disabled = true;
                option.selected = true;
            }
            programSelect.appendChild(option);
        }
    }

    // Function to go to next step
    window.goToNextStep = function() {
        console.log('goToNextStep called, current step:', currentStep);
        
        // Check if campus is selected
        var campusSelect = document.getElementById('hgs-campus');
        if (!campusSelect || !campusSelect.value || campusSelect.value === '') {
            console.log('Campus not selected');
            return;
        }
        
        // If going to step 2 (programs), update programs based on campus
        if (currentStep === 1) {
            updateProgramsForCampus(campusSelect.value);
            console.log('Updated programs for campus:', campusSelect.value);
        }
        
        // Hide all steps
        var steps = document.querySelectorAll('.hgs-step');
        for (var i = 0; i < steps.length; i++) {
            steps[i].classList.remove('active');
        }
        
        // Show next step
        currentStep++;
        console.log('Moving to step:', currentStep);
        var nextStepElement = document.querySelector('.hgs-step[data-step="' + currentStep + '"]');
        if (nextStepElement) {
            nextStepElement.classList.add('active');
            console.log('Showing step:', currentStep);
        } else {
            console.log('Step element NOT found for step:', currentStep);
        }
        
        // Update progress bar
        var progressFill = document.getElementById('hgs-progress');
        if (progressFill) {
            var percentage = Math.round(((currentStep - 1) / (totalSteps - 1)) * 100);
            progressFill.style.width = percentage + '%';
            console.log('Progress updated to:', percentage + '%');
        }
        
        // Update progress text
        var progressText = document.getElementById('hgs-progress-text');
        if (progressText) {
            progressText.textContent = currentStep + ' of ' + totalSteps;
            console.log('Progress text updated to:', currentStep + '/' + totalSteps);
        }
        
        // Show back button
        var backBtn = document.getElementById('hgs-back');
        if (backBtn) {
            backBtn.classList.remove('hgs-hidden');
            console.log('Back button shown');
        }
        
        // Handle final step
        if (currentStep === totalSteps) {
            // Hide next button on final step
            var nextBtn = document.getElementById('hgs-next');
            if (nextBtn) {
                nextBtn.classList.add('hgs-hidden');
            }
            
            console.log('Reached final step - submit button will be enabled by validation');
        } else {
            // Disable next button until next step is filled
            var nextBtn = document.getElementById('hgs-next');
            if (nextBtn) {
                nextBtn.disabled = true;
                nextBtn.classList.remove('active');
                nextBtn.style.backgroundColor = '#68747C';
                nextBtn.style.color = '#28323C';
                nextBtn.style.cursor = 'not-allowed';
                console.log('Next button disabled');
            }
            
            // Ensure submit buttons are disabled on non-final steps
            var submitBtn = document.getElementById('hgs-submit');
            var submitBtnMobile = document.getElementById('hgs-submit-mobile');
            
            var submitButtons = [];
            if (submitBtn) submitButtons.push(submitBtn);
            if (submitBtnMobile) submitButtons.push(submitBtnMobile);
            
            submitButtons.forEach(function(btn) {
                btn.disabled = true;
                btn.classList.remove('active');
                btn.style.backgroundColor = '#68747C';
                btn.style.color = '#28323C';
                btn.style.cursor = 'not-allowed';
            });
        }
    };

    // Function to go to previous step
    window.goToPreviousStep = function() {
        console.log('goToPreviousStep called, current step:', currentStep);
        
        if (currentStep <= 1) {
            console.log('Already at first step');
            return;
        }
        
        // Hide all steps
        var steps = document.querySelectorAll('.hgs-step');
        for (var i = 0; i < steps.length; i++) {
            steps[i].classList.remove('active');
        }
        
        // Show previous step
        currentStep--;
        var prevStepElement = document.querySelector('.hgs-step[data-step="' + currentStep + '"]');
        if (prevStepElement) {
            prevStepElement.classList.add('active');
            console.log('Showing step:', currentStep);
        }
        
        // Update progress bar
        var progressFill = document.getElementById('hgs-progress');
        if (progressFill) {
            var percentage = Math.round(((currentStep - 1) / (totalSteps - 1)) * 100);
            progressFill.style.width = percentage + '%';
            console.log('Progress updated to:', percentage + '%');
        }
        
        // Update progress text
        var progressText = document.getElementById('hgs-progress-text');
        if (progressText) {
            progressText.textContent = currentStep + ' of ' + totalSteps;
            console.log('Progress text updated to:', currentStep + '/' + totalSteps);
        }
        
        // Hide back button if at first step
        if (currentStep === 1) {
            var backBtn = document.getElementById('hgs-back');
            if (backBtn) {
                backBtn.classList.add('hgs-hidden');
                console.log('Back button hidden');
            }
        }
        
        // Show next button and disable submit buttons when going back from final step
        var nextBtn = document.getElementById('hgs-next');
        if (nextBtn) {
            nextBtn.classList.remove('hgs-hidden');
            nextBtn.disabled = false;
            nextBtn.classList.add('active');
            nextBtn.style.backgroundColor = '#B4E850';
            nextBtn.style.color = '#28323C';
            nextBtn.style.cursor = 'pointer';
            console.log('Next button enabled');
        }
        
        // Disable submit buttons when not on final step
        var submitBtn = document.getElementById('hgs-submit');
        var submitBtnMobile = document.getElementById('hgs-submit-mobile');
        
        var submitButtons = [];
        if (submitBtn) submitButtons.push(submitBtn);
        if (submitBtnMobile) submitButtons.push(submitBtnMobile);
        
        submitButtons.forEach(function(btn) {
            btn.disabled = true;
            btn.classList.remove('active');
            btn.style.backgroundColor = '#68747C';
            btn.style.color = '#28323C';
            btn.style.cursor = 'not-allowed';
        });
        console.log('Submit buttons disabled');
    };

    // Function to handle form submission - Copy values to CF7 and submit
    window.handleFormSubmit = function(event) {
        // Prevent duplicate submissions
        if (isSubmitting) {
            console.log('⚠️ Form submission already in progress, ignoring duplicate call');
            if (event) {
                event.preventDefault();
                event.stopPropagation();
                event.stopImmediatePropagation();
            }
            return false;
        }
        
        if (event) {
            event.preventDefault(); // Prevent page refresh if called from form
            event.stopPropagation(); // Stop event from bubbling
            event.stopImmediatePropagation(); // Stop all other handlers
        }
        
        // Set submission lock IMMEDIATELY
        isSubmitting = true;
        
        // Store current scroll position to prevent page from moving
        var scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
        
        // Disable submit buttons IMMEDIATELY to prevent double-clicks
        var submitBtn = document.getElementById('hgs-submit');
        var submitBtnMobile = document.getElementById('hgs-submit-mobile');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.style.opacity = '0.6';
            submitBtn.style.cursor = 'not-allowed';
            submitBtn.textContent = 'Submitting...';
            // Blur the button to prevent focus-related scrolling
            submitBtn.blur();
        }
        if (submitBtnMobile) {
            submitBtnMobile.disabled = true;
            submitBtnMobile.style.opacity = '0.6';
            submitBtnMobile.style.cursor = 'not-allowed';
            submitBtnMobile.textContent = 'Submitting...';
            // Blur the button to prevent focus-related scrolling
            submitBtnMobile.blur();
        }
        
        // Maintain scroll position during submission
        // Prevent any scroll changes that might occur during form processing
        requestAnimationFrame(function() {
            window.scrollTo(0, scrollPosition);
        });
        console.log('=== FORM SUBMISSION DEBUG START ===');
        
        // Get custom form values
        var customCampus = document.getElementById('hgs-campus');
        var customProgram = document.getElementById('hgs-program');
        var customFirst = document.getElementById('hgs-first');
        var customLast = document.getElementById('hgs-last');
        var customPhone = document.getElementById('hgs-phone');
        var customEmail = document.getElementById('hgs-email');
        var customConsent = document.getElementById('hgs-consent');
        
        console.log('Custom form values:');
        console.log('- Campus:', customCampus ? customCampus.value : 'NOT FOUND');
        console.log('- Program:', customProgram ? customProgram.value : 'NOT FOUND');
        console.log('- First:', customFirst ? customFirst.value : 'NOT FOUND');
        console.log('- Last:', customLast ? customLast.value : 'NOT FOUND');
        console.log('- Phone:', customPhone ? customPhone.value : 'NOT FOUND');
        console.log('- Email:', customEmail ? customEmail.value : 'NOT FOUND');
        console.log('- Consent:', customConsent ? customConsent.checked : 'NOT FOUND');
        
        // Find CF7 form wrapper
        var cf7Wrapper = document.querySelector('.cf7-hidden-wrapper');
        if (!cf7Wrapper) {
            console.error('❌ CF7 wrapper (.cf7-hidden-wrapper) not found!');
            alert('CF7 form wrapper not found. Please check if CF7 form is configured.');
            return false;
        }
        console.log('✅ CF7 wrapper found');
        
        // Find CF7 form
        var cf7Form = cf7Wrapper.querySelector('.wpcf7 form');
        if (!cf7Form) {
            console.error('❌ CF7 form not found inside wrapper!');
            console.log('Looking for: .cf7-hidden-wrapper .wpcf7 form');
            console.log('Wrapper HTML:', cf7Wrapper.innerHTML.substring(0, 500));
            alert('CF7 form not found. Please check if CF7 form ID is correct.');
            isSubmitting = false; // Reset lock on error
            return false;
        }
        console.log('✅ CF7 form found');
        
        // Don't block CF7 form submission - let it submit normally
        // We'll only prevent duplicates after the first submission starts
        
        // Try multiple ways to find CF7 fields (by ID, by name attribute, by class)
        var fieldMapping = [
            { custom: customCampus, cf7Id: 'cf7-campus', cf7Name: 'campus_interest', label: 'Campus' },
            { custom: customProgram, cf7Id: 'cf7-program', cf7Name: 'program_interest', label: 'Program' },
            { custom: customFirst, cf7Id: 'cf7-first', cf7Name: 'first_name', label: 'First Name' },
            { custom: customLast, cf7Id: 'cf7-last', cf7Name: 'last_name', label: 'Last Name' },
            { custom: customPhone, cf7Id: 'cf7-phone', cf7Name: 'phone', label: 'Phone' },
            { custom: customEmail, cf7Id: 'cf7-email', cf7Name: 'email', label: 'Email' },
            { custom: customConsent, cf7Id: 'cf7-consent', cf7Name: 'consent', label: 'Consent', isCheckbox: true }
        ];
        
        var allFieldsFound = true;
        var foundFields = [];
        var missingFields = [];
        
        fieldMapping.forEach(function(field) {
            var cf7Field = null;
            var customValue = null;
            
            // Get custom value
            if (field.custom) {
                customValue = field.isCheckbox ? field.custom.checked : field.custom.value;
            }
            
            // Try to find CF7 field by ID first
            cf7Field = document.getElementById(field.cf7Id);
            
            // If not found by ID, try by name attribute
            if (!cf7Field) {
                cf7Field = cf7Form.querySelector('[name="' + field.cf7Name + '"]');
            }
            
            // If still not found, try by name containing
            if (!cf7Field) {
                var allInputs = cf7Form.querySelectorAll('input, select, textarea');
                allInputs.forEach(function(input) {
                    if (input.name && input.name.indexOf(field.cf7Name) !== -1) {
                        cf7Field = input;
                    }
                });
            }
            
            if (cf7Field && customValue !== null && customValue !== '') {
                // Copy value
                if (field.isCheckbox) {
                    if (cf7Field.type === 'checkbox') {
                        cf7Field.checked = customValue;
                    } else if (cf7Field.type === 'hidden') {
                        cf7Field.value = customValue ? '1' : '0';
                    }
                } else {
                    cf7Field.value = customValue;
                }
                foundFields.push(field.label + ' (' + (cf7Field.id || cf7Field.name || 'no id/name') + ')');
                console.log('✅ ' + field.label + ' copied:', customValue, '→ Field:', cf7Field.id || cf7Field.name || cf7Field);
            } else {
                if (!cf7Field) {
                    missingFields.push(field.label + ' - CF7 field not found (tried: ' + field.cf7Id + ', ' + field.cf7Name + ')');
                    console.warn('⚠️ ' + field.label + ' - CF7 field not found (tried ID: ' + field.cf7Id + ', name: ' + field.cf7Name + ')');
                } else if (!customValue || customValue === '') {
                    missingFields.push(field.label + ' - Custom field has no value');
                    console.warn('⚠️ ' + field.label + ' - Custom field empty');
                }
                allFieldsFound = false;
            }
        });
        
        console.log('Fields found and copied:', foundFields.length);
        console.log('Missing/empty fields:', missingFields.length);
        
        if (missingFields.length > 0) {
            console.warn('Missing fields:', missingFields);
        }
        
        // Debug: List all CF7 form fields
        console.log('=== All CF7 Form Fields ===');
        var allCf7Fields = cf7Form.querySelectorAll('input, select, textarea');
        allCf7Fields.forEach(function(field) {
            console.log('- Type:', field.type, '| ID:', field.id, '| Name:', field.name, '| Class:', field.className);
        });
        console.log('=== End CF7 Fields ===');
        
        // Check if form is valid before submission
        // Note: CF7 forms might not support checkValidity(), so we'll skip this check
        // CF7 will handle its own validation
        console.log('✅ Ready to submit CF7 form. CF7 will handle validation.');
        
        // Disable submit buttons to prevent multiple clicks
        var submitBtn = document.getElementById('hgs-submit');
        var submitBtnMobile = document.getElementById('hgs-submit-mobile');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.style.opacity = '0.6';
            submitBtn.style.cursor = 'not-allowed';
        }
        if (submitBtnMobile) {
            submitBtnMobile.disabled = true;
            submitBtnMobile.style.opacity = '0.6';
            submitBtnMobile.style.cursor = 'not-allowed';
        }
        
        // Trigger CF7 form submission
        // CF7 uses AJAX, so we need to click the submit button (not use form.submit())
        setTimeout(function() {
            console.log('=== TRIGGERING CF7 SUBMISSION ===');
            
            // Re-find CF7 form (in case DOM changed)
            var cf7FormToSubmit = cf7Wrapper.querySelector('.wpcf7 form');
            if (!cf7FormToSubmit) {
                console.error('❌ CF7 form not found when trying to submit!');
                isSubmitting = false; // Reset lock
                return;
            }
            
            // Find CF7 submit button - CF7 requires clicking the button for AJAX to work
            var cf7SubmitBtn = cf7FormToSubmit.querySelector('input[type="submit"], button[type="submit"], .wpcf7-submit');
            
            if (cf7SubmitBtn) {
                console.log('✅ CF7 submit button found');
                console.log('Button disabled:', cf7SubmitBtn.disabled);
                console.log('Button display:', window.getComputedStyle(cf7SubmitBtn).display);
                
                // Ensure button is enabled and visible for click
                cf7SubmitBtn.disabled = false;
                cf7SubmitBtn.removeAttribute('disabled');
                cf7SubmitBtn.style.display = '';
                cf7SubmitBtn.style.visibility = 'visible';
                cf7SubmitBtn.style.opacity = '1';
                cf7SubmitBtn.style.position = 'static';
                cf7SubmitBtn.style.width = 'auto';
                cf7SubmitBtn.style.height = 'auto';
                
                console.log('Button enabled and visible. Clicking...');
                
                // Remove action attribute from form if present (to prevent page reload)
                if (cf7FormToSubmit.hasAttribute('action')) {
                    cf7FormToSubmit.removeAttribute('action');
                    console.log('⚠️ Removed action attribute from CF7 form');
                }
                
                // Ensure form method is not causing page reload
                if (cf7FormToSubmit.method && cf7FormToSubmit.method.toLowerCase() === 'get') {
                    cf7FormToSubmit.method = 'post';
                    console.log('⚠️ Changed CF7 form method to POST');
                }
                
                // Ensure form cannot cause page reload
                // Remove action attribute completely (this prevents page reload)
                if (cf7FormToSubmit.hasAttribute('action')) {
                    cf7FormToSubmit.removeAttribute('action');
                    console.log('✅ Removed action attribute to prevent page reload');
                }
                
                // Ensure form method is POST (not GET which can cause URL changes)
                if (!cf7FormToSubmit.method || cf7FormToSubmit.method.toLowerCase() === 'get') {
                    cf7FormToSubmit.method = 'post';
                }
                
                // CF7 should handle submission via AJAX automatically
                // We just need to ensure the form can't cause a page reload
                // Click the button to trigger CF7 AJAX submission
                cf7SubmitBtn.click();
                
                console.log('✅ CF7 submit button clicked - form has no action attribute (AJAX only)');
            } else {
                console.error('❌ CF7 submit button not found!');
                console.log('Available inputs in form:');
                var allInputs = cf7FormToSubmit.querySelectorAll('input, button');
                allInputs.forEach(function(input) {
                    console.log('  - Type:', input.type, '| Class:', input.className, '| ID:', input.id);
                });
                
                // Fallback: try requestSubmit if available (but prevent page reload)
                if (typeof cf7FormToSubmit.requestSubmit === 'function') {
                    console.log('Trying requestSubmit() as fallback...');
                    // Prevent page reload before calling requestSubmit
                    var preventReloadHandler = function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        e.stopImmediatePropagation();
                    };
                    cf7FormToSubmit.addEventListener('submit', preventReloadHandler, true);
                    cf7FormToSubmit.requestSubmit();
                } else {
                    console.error('❌ No way to submit CF7 form - submit button missing and requestSubmit() not available');
                    isSubmitting = false; // Reset lock on error
                }
            }
        }, 300);
        
        console.log('=== FORM SUBMISSION DEBUG END ===');
        
        // CRITICAL: Prevent any page reload/navigation
        // Return false to prevent any default form behavior
        if (event) {
            event.preventDefault();
            event.stopPropagation();
            event.stopImmediatePropagation();
        }
        
        // Maintain scroll position - prevent any unwanted page movement
        // Check scroll position periodically during submission
        var checkScrollInterval = setInterval(function() {
            var currentScroll = window.pageYOffset || document.documentElement.scrollTop;
            if (Math.abs(currentScroll - scrollPosition) > 5) {
                // Scroll position changed, restore it
                window.scrollTo(0, scrollPosition);
            }
        }, 100);
        
        // Clear the interval after 5 seconds (submission should be complete by then)
        setTimeout(function() {
            clearInterval(checkScrollInterval);
        }, 5000);
        
        // Reset submission lock after CF7 responds (success or failure)
        // This will be reset in the event handlers below
        
        return false;
    };
    
    // Helper function to trigger CF7 form submission (used by fallback)
    function triggerCF7Submission(cf7Form) {
        var submitButton = cf7Form.querySelector('input[type="submit"], button[type="submit"], .wpcf7-submit');
        if (submitButton && !submitButton.disabled) {
            console.log('Clicking CF7 submit button');
            // Temporarily enable and make visible for click
            submitButton.disabled = false;
            submitButton.style.display = '';
            submitButton.click();
        } else if (submitButton && submitButton.disabled) {
            console.log('CF7 submit button is disabled, enabling and clicking');
            submitButton.disabled = false;
            submitButton.click();
        } else {
            console.log('No submit button found, using form.submit()');
            // Use native form submit method
            cf7Form.submit();
        }
    }
    
    // Function to show confirmation message
    function showConfirmationMessage() {
        // Store current scroll position before showing confirmation
        var scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
        
        // Hide the entire content container
        var contentContainer = document.querySelector('.hero-get-started-content');
        if (contentContainer) {
            contentContainer.style.display = 'none';
        }
        
        // Show confirmation message
        var confirmationMessage = document.getElementById('confirmation-message');
        if (confirmationMessage) {
            confirmationMessage.style.display = 'block';
        }
        
        // Restore scroll position to prevent page movement
        // Use requestAnimationFrame to ensure it happens after DOM updates
        requestAnimationFrame(function() {
            window.scrollTo(0, scrollPosition);
        });
    }
    
    // Handle CF7 form submission responses
    document.addEventListener('DOMContentLoaded', function() {
        console.log('=== Initializing CF7 Integration ===');
        
        // Debug: Check if CF7 wrapper exists
        var cf7Wrapper = document.querySelector('.cf7-hidden-wrapper');
        if (cf7Wrapper) {
            console.log('✅ CF7 wrapper found on page load');
            var cf7Form = cf7Wrapper.querySelector('.wpcf7 form');
            if (cf7Form) {
                console.log('✅ CF7 form found on page load');
                console.log('CF7 form HTML structure:', cf7Form.innerHTML.substring(0, 1000));
                
                // Hide CF7's default submit button visually but keep it functional
                // We need it for programmatic submission
                var cf7SubmitBtn = cf7Form.querySelector('input[type="submit"], button[type="submit"], .wpcf7-submit');
                if (cf7SubmitBtn) {
                    // Hide visually but keep it in DOM and enabled for programmatic clicks
                    cf7SubmitBtn.style.position = 'absolute';
                    cf7SubmitBtn.style.opacity = '0';
                    cf7SubmitBtn.style.width = '1px';
                    cf7SubmitBtn.style.height = '1px';
                    cf7SubmitBtn.style.overflow = 'hidden';
                    cf7SubmitBtn.style.pointerEvents = 'none';
                    cf7SubmitBtn.disabled = false; // Keep enabled so we can trigger it
                    console.log('✅ CF7 submit button hidden but kept functional');
                }
                
                // Remove action attribute to prevent page reload (CF7 uses AJAX by default)
                // CF7 forms should not have an action attribute - it submits via AJAX
                if (cf7Form.hasAttribute('action')) {
                    console.log('⚠️ Removing action attribute from CF7 form to prevent page reload');
                    cf7Form.removeAttribute('action');
                }
                
                // Ensure form method is POST (not GET) to avoid URL parameters
                if (!cf7Form.method || cf7Form.method.toLowerCase() === 'get') {
                    cf7Form.method = 'post';
                    console.log('✅ Set CF7 form method to POST');
                }
                
                // CF7 should handle form submission via AJAX automatically
                // We just need to ensure it doesn't have attributes that cause page reload
                console.log('✅ CF7 form configured for AJAX submission (no page reload)');
                
                // Duplicate prevention is handled at the button level (isSubmitting flag)
                console.log('✅ CF7 form ready for submission');
            } else {
                console.warn('⚠️ CF7 form not found in wrapper on page load');
            }
        } else {
            console.warn('⚠️ CF7 wrapper not found on page load');
        }
        
        // Listen for CF7 form submission events - reset flags on completion
        var handleCF7Success = function(event) {
            console.log('✅ CF7 form submitted successfully!', event.detail);
            isSubmitting = false; // Reset submission lock on success
            showConfirmationMessage();
        };
        
        var handleCF7Failure = function(event) {
            console.error('❌ CF7 form submission failed!', event.detail);
            isSubmitting = false; // Reset submission lock on failure
            alert('There was an error submitting your form. Please check console for details and try again.');
            
            // Re-enable submit buttons
            var submitBtn = document.getElementById('hgs-submit');
            var submitBtnMobile = document.getElementById('hgs-submit-mobile');
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                submitBtn.style.cursor = 'pointer';
                submitBtn.textContent = 'Get started';
            }
            if (submitBtnMobile) {
                submitBtnMobile.disabled = false;
                submitBtnMobile.style.opacity = '1';
                submitBtnMobile.style.cursor = 'pointer';
                submitBtnMobile.textContent = 'Get started';
            }
        };
        
        var handleCF7Invalid = function(event) {
            console.error('❌ CF7 form validation failed!', event.detail);
            isSubmitting = false; // Reset submission lock on validation error
            alert('Please fill in all required fields correctly.');
            
            // Re-enable submit buttons
            var submitBtn = document.getElementById('hgs-submit');
            var submitBtnMobile = document.getElementById('hgs-submit-mobile');
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                submitBtn.style.cursor = 'pointer';
                submitBtn.textContent = 'Get started';
            }
            if (submitBtnMobile) {
                submitBtnMobile.disabled = false;
                submitBtnMobile.style.opacity = '1';
                submitBtnMobile.style.cursor = 'pointer';
                submitBtnMobile.textContent = 'Get started';
            }
        };
        
        var handleCF7Spam = function(event) {
            console.error('❌ CF7 form marked as spam!', event.detail);
            isSubmitting = false; // Reset submission lock on spam
            alert('Form submission was marked as spam. Please try again.');
            
            // Re-enable submit buttons
            var submitBtn = document.getElementById('hgs-submit');
            var submitBtnMobile = document.getElementById('hgs-submit-mobile');
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                submitBtn.style.cursor = 'pointer';
                submitBtn.textContent = 'Get started';
            }
            if (submitBtnMobile) {
                submitBtnMobile.disabled = false;
                submitBtnMobile.style.opacity = '1';
                submitBtnMobile.style.cursor = 'pointer';
                submitBtnMobile.textContent = 'Get started';
            }
        };
        
        // Listen for CF7 events - allow multiple listeners but only handle once per submission
        document.addEventListener('wpcf7mailsent', handleCF7Success);
        document.addEventListener('wpcf7mailfailed', handleCF7Failure);
        document.addEventListener('wpcf7invalid', handleCF7Invalid);
        document.addEventListener('wpcf7spam', handleCF7Spam);
        
        // Reset flags after 15 seconds as a safety measure
        setTimeout(function() {
            if (isSubmitting) {
                console.warn('⚠️ Submission lock timeout - resetting after 15 seconds');
                isSubmitting = false;
            }
        }, 15000);
        
        // Remove duplicate event listeners - we're using onclick in HTML, so we don't need addEventListener
        // This prevents double submission
        console.log('ℹ️ Using onclick handlers from HTML, not attaching additional event listeners');
        
        console.log('=== CF7 Integration Initialized ===');
    });

    // Simple form initialization
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Form initialized');
        
        // Debug: Check all steps
        var steps = document.querySelectorAll('.hgs-step');
        console.log('Total steps found:', steps.length);
        for (var i = 0; i < steps.length; i++) {
            var stepNum = steps[i].getAttribute('data-step');
            console.log('Step', stepNum, 'has active class:', steps[i].classList.contains('active'));
        }
        
        // Ensure only step 1 is active initially
        steps.forEach(function(step) {
            step.classList.remove('active');
        });
        var firstStep = document.querySelector('.hgs-step[data-step="1"]');
        if (firstStep) {
            firstStep.classList.add('active');
            console.log('Step 1 activated');
        }
        
        // Ensure submit buttons are disabled initially
        var submitBtn = document.getElementById('hgs-submit');
        var submitBtnMobile = document.getElementById('hgs-submit-mobile');
        
        var submitButtons = [];
        if (submitBtn) submitButtons.push(submitBtn);
        if (submitBtnMobile) submitButtons.push(submitBtnMobile);
        
        submitButtons.forEach(function(btn) {
            btn.disabled = true;
            btn.classList.remove('active');
            btn.style.backgroundColor = '#68747C';
            btn.style.color = '#28323C';
            btn.style.cursor = 'not-allowed';
        });
        console.log('Submit buttons disabled on init');
        
        // Reset current step to 1
        currentStep = 1;
        console.log('Current step set to:', currentStep);
    });
    
    // Debug helper function - can be called from browser console: debugHeroGetStarted()
    window.debugHeroGetStarted = function() {
        console.log('=== HERO GET STARTED DEBUG INFO ===');
        
        // Check custom form fields
        console.log('\n1. CUSTOM FORM FIELDS:');
        var fields = ['hgs-campus', 'hgs-program', 'hgs-first', 'hgs-last', 'hgs-phone', 'hgs-email', 'hgs-consent'];
        fields.forEach(function(fieldId) {
            var field = document.getElementById(fieldId);
            if (field) {
                var value = field.type === 'checkbox' ? field.checked : field.value;
                console.log('  ✅', fieldId + ':', value);
            } else {
                console.log('  ❌', fieldId + ': NOT FOUND');
            }
        });
        
        // Check CF7 form
        console.log('\n2. CF7 FORM:');
        var cf7Wrapper = document.querySelector('.cf7-hidden-wrapper');
        if (cf7Wrapper) {
            console.log('  ✅ CF7 wrapper exists');
            var cf7Form = cf7Wrapper.querySelector('.wpcf7 form');
            if (cf7Form) {
                console.log('  ✅ CF7 form exists');
                console.log('  Form ID:', cf7Form.id);
                console.log('  Form action:', cf7Form.action);
                
                // List all CF7 fields
                console.log('\n3. CF7 FORM FIELDS:');
                var cf7Fields = cf7Form.querySelectorAll('input, select, textarea');
                cf7Fields.forEach(function(field) {
                    console.log('  - Type:', field.type || 'N/A', '| ID:', field.id || 'N/A', '| Name:', field.name || 'N/A', '| Value:', field.value || field.checked || 'N/A');
                });
            } else {
                console.log('  ❌ CF7 form NOT FOUND in wrapper');
                console.log('  Wrapper HTML:', cf7Wrapper.innerHTML.substring(0, 500));
            }
        } else {
            console.log('  ❌ CF7 wrapper NOT FOUND');
        }
        
        // Check submit buttons
        console.log('\n4. SUBMIT BUTTONS:');
        var submitBtn = document.getElementById('hgs-submit');
        var submitBtnMobile = document.getElementById('hgs-submit-mobile');
        console.log('  Submit button:', submitBtn ? '✅ Found (disabled: ' + submitBtn.disabled + ')' : '❌ NOT FOUND');
        console.log('  Mobile submit button:', submitBtnMobile ? '✅ Found (disabled: ' + submitBtnMobile.disabled + ')' : '❌ NOT FOUND');
        
        console.log('\n=== END DEBUG INFO ===');
        console.log('💡 Tip: Try calling handleFormSubmit() manually to test submission');
    };

})();

