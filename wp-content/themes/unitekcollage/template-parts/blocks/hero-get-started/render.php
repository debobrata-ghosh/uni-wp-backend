<?php
/**
 * Hero Get Started Block Template
 * 
 * @package UnitekCollege
 */

// Get the field values
$heading            = get_field( 'hero_get_started_heading' );
$programs           = get_field( 'hero_get_started_programs' );
$placeholder        = get_field( 'hero_get_started_placeholder' );
$button_text        = get_field( 'hero_get_started_button_text' );
$action_url         = get_field( 'hero_get_started_action_url' );
$total_steps        = 6; // Total steps: one field per step

// Validate required fields but do not block rendering/preview
$required_fields = array(
    'hero_get_started_heading' => 'Heading'
);
unitek_college_validate_block_fields( $required_fields, 'Hero Get Started Block' );

// Set default values if fields are empty (editor preview)
if ( is_admin() && ! $heading ) {
    $heading = 'Get started today.';
}

if ( is_admin() && ! $placeholder ) {
    $placeholder = 'What is your program of interest?';
}

if ( is_admin() && ! $button_text ) {
    $button_text = 'Next';
}

// Set default programs if none are set
if ( is_admin() && ( ! $programs || empty( $programs ) ) ) {
    $programs = array(
        array( 'program_name' => 'Web Development', 'program_value' => 'web-development' ),
        array( 'program_name' => 'Design', 'program_value' => 'design' ),
        array( 'program_name' => 'Marketing', 'program_value' => 'marketing' ),
        array( 'program_name' => 'Data Science', 'program_value' => 'data-science' ),
        array( 'program_name' => 'Business', 'program_value' => 'business' )
    );
}

// Get block attributes
$block_id     = $block['id'] ?? '';
$block_class  = $block['className'] ?? '';
$block_anchor = $block['anchor'] ?? '';

// Build CSS classes
$css_classes = array( 'hero-get-started-block' );
if ( $block_class ) {
    $css_classes[] = $block_class;
}
if ( ! empty( $block['align'] ) ) {
    $css_classes[] = 'align' . $block['align'];
}

$css_class_string = implode( ' ', $css_classes );
?>

<section <?php if ( $block_anchor ): ?>id="<?php echo esc_attr( $block_anchor ); ?>"<?php endif; ?> 
         class="<?php echo esc_attr( $css_class_string ); ?>"
         role="region"
         aria-label="Get started form section">
    
    <div class="hero-get-started-content">
        <!-- Left Section - Heading Text -->
        <div class="hero-get-started-text">
            <?php echo esc_html( $heading ); ?>
        </div>
        
        <!-- Right Section - Multi-step Form -->
        <form class="hero-get-started-form" method="post" action="" id="hgs-form" novalidate onsubmit="handleFormSubmit(event)">
            <div class="hgs-steps">
                <!-- Step 1: Campus Selection -->
                <div class="hgs-step active" data-step="1">
                    <select class="hgs-select" name="campus_interest" id="hgs-campus" aria-label="Campus of interest" required onchange="var nextBtn=document.getElementById('hgs-next');if(this.value!=''){this.style.color='#ffffff';this.style.fontWeight='500';this.style.backgroundColor='transparent';nextBtn.disabled=false;nextBtn.classList.add('active');nextBtn.style.backgroundColor='#B4E850';nextBtn.style.color='#28323C';nextBtn.style.cursor='pointer';}else{this.style.color='#68747C';this.style.fontWeight='300';this.style.backgroundColor='#ffffff';nextBtn.disabled=true;nextBtn.classList.remove('active');nextBtn.style.backgroundColor='#68747C';nextBtn.style.color='#28323C';nextBtn.style.cursor='not-allowed';}">
                        <option value="" disabled selected>CAMPUS OF INTEREST*</option>
                        <option value="Unitek College - Bakersfield">Bakersfield, CA</option>
                        <option value="Unitek College - Concord">Concord, CA</option>
                        <option value="Unitek College - Fremont">Fremont, CA</option>
                        <option value="Unitek College - Hayward">Hayward, CA</option>
                        <option value="Unitek College - Ontario">Ontario, CA</option>
                        <option value="Unitek College - Reno">Reno, NV</option>
                        <option value="Unitek College - Sacramento">Sacramento, CA</option>
                        <option value="Unitek College - San Jose">San Jose, CA</option>
                        <option value="Unitek College - South San Francisco">South San Francisco, CA</option>
                        <option value="Unitek College - Online">Online Instruction</option>
                    </select>
                </div>

                <!-- Step 2: Program Selection -->
                <div class="hgs-step" data-step="2">
                    <select class="hgs-select" name="program_interest" id="hgs-program" aria-label="Program of interest" required onchange="var nextBtn=document.getElementById('hgs-next');if(this.value!=''){this.style.color='#ffffff';this.style.fontWeight='500';this.style.backgroundColor='transparent';nextBtn.disabled=false;nextBtn.classList.add('active');nextBtn.style.backgroundColor='#B4E850';nextBtn.style.color='#28323C';nextBtn.style.cursor='pointer';}else{this.style.color='#68747C';this.style.fontWeight='300';this.style.backgroundColor='#ffffff';nextBtn.disabled=true;nextBtn.classList.remove('active');nextBtn.style.backgroundColor='#68747C';nextBtn.style.color='#28323C';nextBtn.style.cursor='not-allowed';}">
                        <option value="" disabled selected><?php echo esc_html( $placeholder ); ?></option>
                        <?php foreach ( $programs as $program ): ?>
                            <option value="<?php echo esc_attr( $program['program_value'] ?? '' ); ?>"><?php echo esc_html( $program['program_name'] ?? '' ); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Step 3: First Name -->
                <div class="hgs-step" data-step="3">
                    <input type="text" class="hgs-input" name="first_name" id="hgs-first" placeholder="First name" required oninput="var nextBtn=document.getElementById('hgs-next');if(this.value.trim()!=''){this.style.color='#ffffff';this.style.fontWeight='500';this.style.backgroundColor='transparent';nextBtn.disabled=false;nextBtn.classList.add('active');nextBtn.style.backgroundColor='#B4E850';nextBtn.style.color='#28323C';nextBtn.style.cursor='pointer';}else{this.style.color='#68747C';this.style.fontWeight='300';this.style.backgroundColor='#ffffff';nextBtn.disabled=true;nextBtn.classList.remove('active');nextBtn.style.backgroundColor='#68747C';nextBtn.style.color='#28323C';nextBtn.style.cursor='not-allowed';}">
                </div>

                <!-- Step 4: Last Name -->
                <div class="hgs-step" data-step="4">
                    <input type="text" class="hgs-input" name="last_name" id="hgs-last" placeholder="Last name" required oninput="var nextBtn=document.getElementById('hgs-next');if(this.value.trim()!=''){this.style.color='#ffffff';this.style.fontWeight='500';this.style.backgroundColor='transparent';nextBtn.disabled=false;nextBtn.classList.add('active');nextBtn.style.backgroundColor='#B4E850';nextBtn.style.color='#28323C';nextBtn.style.cursor='pointer';}else{this.style.color='#68747C';this.style.fontWeight='300';this.style.backgroundColor='#ffffff';nextBtn.disabled=true;nextBtn.classList.remove('active');nextBtn.style.backgroundColor='#68747C';nextBtn.style.color='#28323C';nextBtn.style.cursor='not-allowed';}">
                </div>

                <!-- Step 5: Phone -->
                <div class="hgs-step" data-step="5">
                    <input type="tel" class="hgs-input" name="phone" id="hgs-phone" placeholder="Mobile phone" required pattern="[0-9]{10}" maxlength="10" inputmode="numeric" oninput="validatePhoneInput(this)">
                </div>

                <!-- Step 6: Email + Consent -->
                <div class="hgs-step" data-step="6">
                    <div class="hgs-step-row">
                        <input type="email" class="hgs-input" name="email" id="hgs-email" placeholder="Email address" required oninput="validateEmailInput(this)">
                        <button type="submit" class="hero-get-started-button" id="hgs-submit" disabled>Get started</button>
                    </div>
                    <label class="hgs-consent">
                        <input type="checkbox" id="hgs-consent" required onchange="validateConsentInput(this)">
                        <span>By submitting contact information on this website, you are consenting to receive calls, SMS and emails from Unitek Learning Education Group Corp (ULEGC) and its affiliates. Your information will not be sold or shared with parties unrelated to ULEGC. You certify that you are the owner of the contact information provided and agree to our privacy policy. Please note, this consent is not required to attend our institutions.</span>
                    </label>
                </div>

                <!-- Actions (right) -->
                <div class="hgs-actions">
                    <button type="button" class="hero-get-started-button" id="hgs-next" disabled onclick="goToNextStep()">Next</button>
                    <button type="submit" class="hero-get-started-button hgs-hidden" id="hgs-submit-mobile" disabled>Get started</button>
                </div>

                <!-- Progress row below -->
                <div class="hgs-progress">
                    <button type="button" class="hgs-back hgs-hidden" id="hgs-back" aria-label="Back" onclick="goToPreviousStep()">← Back</button>
                    <div class="hgs-progress-bar" aria-hidden="true"><span id="hgs-progress"></span></div>
                    <div class="hgs-progress-text" id="hgs-progress-text">1 of <?php echo (int) $total_steps; ?></div>
                </div>
            </div>
        </form>
    </div>
    
    <!-- Confirmation Message -->
    <div class="confirmation-message" id="confirmation-message" style="display: none;">
        <h2>You've just completed your first step toward an exciting new career.</h2>
        <div class="confirmation-content">
            <div class="confirmation-msg">
                <p>An Admissions Representative will be contacting you shortly. If you have any questions, please call us directly at <span class="phone-number">(661) 347 2158</span></p>
            </div>
            <div class="contact-details">
                <a href="tel:6613472158" class="contact-link">Additional contact information</a>
            </div>
        </div>
    </div>
</section>
