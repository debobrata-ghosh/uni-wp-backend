document.addEventListener('DOMContentLoaded', function() {
    const testimonialDots = document.querySelectorAll('.admissions-testimonial-dot');
    const testimonialSlides = document.querySelectorAll('.admissions-testimonial-slide');
    let currentSlide = 0;
    
    // Function to show specific slide
    function showSlide(slideIndex) {
        // Remove active class from all slides and dots
        testimonialSlides.forEach(slide => slide.classList.remove('active'));
        testimonialDots.forEach(dot => dot.classList.remove('active'));
        
        // Add active class to current slide and dot
        if (testimonialSlides[slideIndex]) {
            testimonialSlides[slideIndex].classList.add('active');
        }
        if (testimonialDots[slideIndex]) {
            testimonialDots[slideIndex].classList.add('active');
        }
        
        currentSlide = slideIndex;
    }
    
    // Add click event listeners to dots
    testimonialDots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            showSlide(index);
        });
    });
    
    // Auto-rotate carousel every 5 seconds
    if (testimonialSlides.length > 0) {
        setInterval(() => {
            const nextSlide = (currentSlide + 1) % testimonialSlides.length;
            showSlide(nextSlide);
        }, 5000);
    }
});
