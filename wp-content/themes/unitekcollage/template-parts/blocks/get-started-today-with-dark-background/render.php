<?php
// Get ACF field values from options page
$heading = get_field('get_started_dark_heading', 'option');
$description = get_field('get_started_dark_description', 'option');
$form_settings = get_field('get_started_dark_form_settings', 'option');
$form_action = $form_settings['form_action'] ?? '#';
$form_method = $form_settings['form_method'] ?? 'post';
$disclaimer = get_field('get_started_dark_disclaimer', 'option');
$button_text = get_field('get_started_dark_button_text', 'option') ?: 'Get started today';

// Validate required fields but do not block rendering/preview
$required_fields = array(
    'get_started_dark_heading' => 'Heading',
    'get_started_dark_description' => 'Description'
);
unitek_college_validate_block_fields($required_fields, 'Get Started Today (Dark Background) Block');

// State options
$state_options = array(
    'AL' => 'Alabama', 'AK' => 'Alaska', 'AZ' => 'Arizona', 'AR' => 'Arkansas', 'CA' => 'California',
    'CO' => 'Colorado', 'CT' => 'Connecticut', 'DE' => 'Delaware', 'FL' => 'Florida', 'GA' => 'Georgia',
    'HI' => 'Hawaii', 'ID' => 'Idaho', 'IL' => 'Illinois', 'IN' => 'Indiana', 'IA' => 'Iowa',
    'KS' => 'Kansas', 'KY' => 'Kentucky', 'LA' => 'Louisiana', 'ME' => 'Maine', 'MD' => 'Maryland',
    'MA' => 'Massachusetts', 'MI' => 'Michigan', 'MN' => 'Minnesota', 'MS' => 'Mississippi', 'MO' => 'Missouri',
    'MT' => 'Montana', 'NE' => 'Nebraska', 'NV' => 'Nevada', 'NH' => 'New Hampshire', 'NJ' => 'New Jersey',
    'NM' => 'New Mexico', 'NY' => 'New York', 'NC' => 'North Carolina', 'ND' => 'North Dakota', 'OH' => 'Ohio',
    'OK' => 'Oklahoma', 'OR' => 'Oregon', 'PA' => 'Pennsylvania', 'RI' => 'Rhode Island', 'SC' => 'South Carolina',
    'SD' => 'South Dakota', 'TN' => 'Tennessee', 'TX' => 'Texas', 'UT' => 'Utah', 'VT' => 'Vermont',
    'VA' => 'Virginia', 'WA' => 'Washington', 'WV' => 'West Virginia', 'WI' => 'Wisconsin', 'WY' => 'Wyoming'
);

// Campus options
$campus_options = array(
    'fremont' => 'Fremont Campus',
    'hayward' => 'Hayward Campus',
    'sacramento' => 'Sacramento Campus',
    'san-jose' => 'San Jose Campus',
    'stockton' => 'Stockton Campus',
    'online' => 'Online Programs'
);

// Program options
$program_options = array(
    'nursing' => 'Nursing Programs',
    'healthcare' => 'Healthcare Programs',
    'business' => 'Business Programs',
    'technology' => 'Technology Programs',
    'education' => 'Education Programs'
);

// Get block attributes
$block_id = $block['id'] ?? '';
$block_class = $block['className'] ?? '';
$block_anchor = $block['anchor'] ?? '';

// Build CSS classes
$css_classes = array('get-started-dark-block');
if ($block_class) {
    $css_classes[] = $block_class;
}
if ($block['align']) {
    $css_classes[] = 'align' . $block['align'];
}
$css_class_string = implode(' ', $css_classes);
?>

<section <?php if ($block_anchor): ?>id="<?php echo esc_attr($block_anchor); ?>"<?php endif; ?> 
         class="<?php echo esc_attr($css_class_string); ?>"
         role="region"
         aria-label="Get started form">
    
    <div class="get-started-dark-container">
        <div class="get-started-dark-content">
            <!-- Form Section Wrapper -->
            <div class="get-started-dark-form-wrapper">
                <!-- Header Section -->
                <div class="get-started-dark-header">
                    <?php if ($heading): ?>
                        <h2 class="get-started-dark-heading"><?php echo esc_html($heading); ?></h2>
                    <?php endif; ?>
                    <?php if ($description): ?>
                        <p class="get-started-dark-description"><?php echo esc_html($description); ?></p>
                    <?php endif; ?>
                </div>
                
                <!-- Divider -->
                <div class="get-started-dark-divider"></div>
                
                <!-- Form Section -->
                <form class="get-started-dark-form" action="<?php echo esc_url($form_action); ?>" method="<?php echo esc_attr($form_method); ?>">
                <div class="get-started-dark-form-grid">
                    <!-- Column 1 -->
                    <div class="get-started-dark-form-column">
                        <!-- Firstname -->
                        <div class="get-started-dark-form-field">
                            <label for="gsd-firstname" class="sr-only">First Name</label>
                            <input type="text" id="gsd-firstname" name="firstname" placeholder="Firstname" required>
                        </div>
                        
                        <!-- Lastname -->
                        <div class="get-started-dark-form-field">
                            <label for="gsd-lastname" class="sr-only">Last Name</label>
                            <input type="text" id="gsd-lastname" name="lastname" placeholder="Lastname" required>
                        </div>
                        
                        <!-- State -->
                        <div class="get-started-dark-form-field">
                            <label for="gsd-state" class="sr-only">State</label>
                            <select id="gsd-state" name="state" required>
                                <option value="" disabled selected>State</option>
                                <?php foreach ($state_options as $code => $state_name): ?>
                                    <option value="<?php echo esc_attr($code); ?>"><?php echo esc_html($state_name); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <svg class="get-started-dark-form-icon" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.83 16.67L20 23.82L27.17 16.67" stroke="#141A1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        
                        <!-- Zipcode -->
                        <div class="get-started-dark-form-field">
                            <label for="gsd-zipcode" class="sr-only">Zipcode</label>
                            <input type="text" id="gsd-zipcode" name="zipcode" placeholder="Zipcode" pattern="[0-9]{5}" required>
                        </div>
                    </div>
                    
                    <!-- Column 2 -->
                    <div class="get-started-dark-form-column">
                        <!-- Email -->
                        <div class="get-started-dark-form-field">
                            <label for="gsd-email" class="sr-only">Email</label>
                            <input type="email" id="gsd-email" name="email" placeholder="Email" required>
                        </div>
                        
                        <!-- Phone -->
                        <div class="get-started-dark-form-field">
                            <label for="gsd-phone" class="sr-only">Phone</label>
                            <input type="tel" id="gsd-phone" name="phone" placeholder="Phone" pattern="[0-9]{10}" required>
                        </div>
                        
                        <!-- Campus of interest -->
                        <div class="get-started-dark-form-field">
                            <label for="gsd-campus" class="sr-only">Campus of Interest</label>
                            <select id="gsd-campus" name="campus" required>
                                <option value="" disabled selected>Campus of interest</option>
                                <?php foreach ($campus_options as $value => $campus_name): ?>
                                    <option value="<?php echo esc_attr($value); ?>"><?php echo esc_html($campus_name); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <svg class="get-started-dark-form-icon" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.83 16.67L20 23.82L27.17 16.67" stroke="#141A1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        
                        <!-- Program of interest -->
                        <div class="get-started-dark-form-field">
                            <label for="gsd-program" class="sr-only">Program of Interest</label>
                            <select id="gsd-program" name="program" required>
                                <option value="" disabled selected>Program of interest</option>
                                <?php foreach ($program_options as $value => $program_name): ?>
                                    <option value="<?php echo esc_attr($value); ?>"><?php echo esc_html($program_name); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <svg class="get-started-dark-form-icon" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.83 16.67L20 23.82L27.17 16.67" stroke="#141A1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- Consent Checkbox -->
                <div class="get-started-dark-consent">
                    <input type="checkbox" id="gsd-consent" name="consent" required>
                    <label for="gsd-consent">
                        <?php if ($disclaimer): ?>
                            <?php echo wp_kses_post($disclaimer); ?>
                        <?php endif; ?>
                    </label>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="get-started-dark-submit">
                    <?php echo esc_html($button_text); ?>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 12H20M20 12L14 6M20 12L14 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</section>

