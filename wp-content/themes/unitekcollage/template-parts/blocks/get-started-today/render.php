<?php
// Get ACF field values
$heading = get_field('get_started_heading');
$description = get_field('get_started_description');
$content_type = get_field('get_started_content_type');
$image = get_field('get_started_image');
$wysiwyg_content = get_field('get_started_wysiwyg');
$cf7_form_id = get_field('get_started_cf7_form');

// Validate required fields but do not block rendering/preview
$required_fields = array(
    'get_started_heading' => 'Heading',
    'get_started_description' => 'Description'
);
unitek_college_validate_block_fields($required_fields, 'Get Started Today Block');

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
?>

<section class="get-started-today-block" id="get-started-today">
    <div class="get-started-today-content">
        <!-- Left Column - Form -->
        <div class="get-started-today-form">
            <?php if ($heading): ?>
                <h2 class="get-started-today-heading"><?php echo esc_html($heading); ?></h2>
            <?php endif; ?>
            <?php if ($description): ?>
                <p class="get-started-today-description"><?php echo esc_html($description); ?></p>
            <?php endif; ?>
            
            <?php if ($cf7_form_id && function_exists('wpcf7_contact_form')): ?>
                <!-- Display Contact Form 7 -->
                <?php
                // Disable autop formatting for CF7
                add_filter('wpcf7_autop_or_not', '__return_false', 999);
                
                // Capture CF7 output
                ob_start();
                echo do_shortcode('[contact-form-7 id="' . intval($cf7_form_id) . '"]');
                $cf7_output = ob_get_clean();
                
                // Remove unwanted p and br tags
                $cf7_output = preg_replace('/<p[^>]*>\s*<\/p>/i', '', $cf7_output); // Empty p tags
                $cf7_output = preg_replace('/<p[^>]*>/i', '', $cf7_output); // Opening p tags
                $cf7_output = preg_replace('/<\/p>/i', '', $cf7_output); // Closing p tags
                $cf7_output = preg_replace('/<br\s*\/?>\s*/i', '', $cf7_output); // br tags
                $cf7_output = preg_replace('/\n\s*\n/', '', $cf7_output); // Double line breaks
                
                echo $cf7_output;
                
                // Remove filter
                remove_filter('wpcf7_autop_or_not', '__return_false', 999);
                ?>
            <?php else: ?>
                <!-- Custom Form (fallback) -->
            <form class="get-started-today-form-fields" action="#" method="post">
                <!-- Row 1: Firstname, Lastname -->
                <div class="get-started-today-form-row">
                    <div class="get-started-today-form-field">
                        <label for="firstname" class="sr-only">First Name</label>
                        <input type="text" id="firstname" name="firstname" placeholder="Firstname" required>
                    </div>
                    <div class="get-started-today-form-field">
                        <label for="lastname" class="sr-only">Last Name</label>
                        <input type="text" id="lastname" name="lastname" placeholder="Lastname" required>
                    </div>
                </div>
                
                <!-- Row 2: Email, Phone -->
                <div class="get-started-today-form-row">
                    <div class="get-started-today-form-field">
                        <label for="email" class="sr-only">Email</label>
                        <input type="email" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="get-started-today-form-field">
                        <label for="phone" class="sr-only">Phone</label>
                        <input type="tel" id="phone" name="phone" placeholder="Phone" required>
                    </div>
                </div>
                
                <!-- Row 3: State, Zipcode -->
                <div class="get-started-today-form-row">
                    <div class="get-started-today-form-field">
                        <label for="state" class="sr-only">State</label>
                        <select id="state" name="state" required>
                            <option value="">State</option>
                            <?php foreach ($state_options as $value => $label): ?>
                                <option value="<?php echo esc_attr($value); ?>"><?php echo esc_html($label); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="get-started-today-form-field">
                        <label for="zipcode" class="sr-only">Zipcode</label>
                        <input type="text" id="zipcode" name="zipcode" placeholder="Zipcode" required>
                    </div>
                </div>
                
                <!-- Row 4: Campus, Program -->
                <div class="get-started-today-form-row">
                    <div class="get-started-today-form-field">
                        <label for="campus" class="sr-only">Campus of Interest</label>
                        <select id="campus" name="campus" required>
                            <option value="">Campus of interest</option>
                            <?php foreach ($campus_options as $value => $label): ?>
                                <option value="<?php echo esc_attr($value); ?>"><?php echo esc_html($label); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="get-started-today-form-field">
                        <label for="program" class="sr-only">Program of Interest</label>
                        <select id="program" name="program" required>
                            <option value="">Program of interest</option>
                            <?php foreach ($program_options as $value => $label): ?>
                                <option value="<?php echo esc_attr($value); ?>"><?php echo esc_html($label); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <button type="submit" class="get-started-today-submit">
                    Get started today →
                </button>
            </form>
            <?php endif; ?>
        </div>
        
        <!-- Right Column - Image or WYSIWYG Content -->
        <div class="get-started-today-image">
            <?php if ($content_type === 'wysiwyg' && $wysiwyg_content): ?>
                <!-- Display WYSIWYG Content -->
                <div class="get-started-today-wysiwyg-content">
                    <?php 
                    // Allow iframes and other HTML tags in WYSIWYG content
                    $allowed_html = wp_kses_allowed_html('post');
                    $allowed_html['iframe'] = array(
                        'src'             => true,
                        'height'          => true,
                        'width'           => true,
                        'frameborder'     => true,
                        'allowfullscreen' => true,
                        'style'           => true,
                        'class'           => true,
                        'id'              => true,
                        'loading'         => true,
                        'title'           => true,
                    );
                    echo wp_kses($wysiwyg_content, $allowed_html); 
                    ?>
                </div>
            <?php elseif ($content_type === 'image' || !$content_type): ?>
                <!-- Display Image -->
                <?php if ($image && !empty($image['url'])): ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? 'Get Started Today'); ?>">
                <?php else: ?>
                    <div class="get-started-today-image-placeholder">
                        [ Image ]
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
