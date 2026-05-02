/**
 * Quote Section Block Script
 */
(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.quote-slide');
        const prev = document.querySelector('.nav-arrow.prev');
        const next = document.querySelector('.nav-arrow.next');
        
        if (slides.length === 0) return;
        
        let current = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('active', i === index);
                // Dots update for each slide
                const dots = slide.querySelectorAll('.pagination-dot');
                dots.forEach((dot, dIdx) => {
                    dot.classList.toggle('active', dIdx === index);
                });
            });
            current = index;
        }

        // Arrows: only for desktop
        if (prev && next) {
            prev.addEventListener('click', function() {
                showSlide((current - 1 + slides.length) % slides.length);
            });
            next.addEventListener('click', function() {
                showSlide((current + 1) % slides.length);
            });
        }

        // Dots: only for mobile, inside each slide
        slides.forEach((slide, sIdx) => {
            const dots = slide.querySelectorAll('.pagination-dot');
            dots.forEach((dot, dIdx) => {
                dot.addEventListener('click', function() {
                    showSlide(dIdx);
                });
            });
        });

        showSlide(0);
    });
})();

