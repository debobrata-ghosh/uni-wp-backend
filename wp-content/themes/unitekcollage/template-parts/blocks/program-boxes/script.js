/**
 * Program Boxes Block Script
 */
(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        // Get all program boxes blocks
        const blocks = document.querySelectorAll('.program-boxes-block');
        
        blocks.forEach(function(block) {
            const blockId = block.getAttribute('id');
            if (!blockId) return;
            
            // Check if this is a preview in admin
            const isPreview = document.body.classList.contains('wp-admin') || 
                             block.classList.contains('preview');
            
            if (isPreview) {
                block.classList.add('preview');
            }
        });
    });
})();

function toggleResponsiveClass() {
  var isMobile = window.matchMedia("(max-width: 600px)").matches;
  var el = document.querySelector('.for-mobile-box');
  if (el) {
    if (isMobile) {
      el.classList.add('is-mobile-box');
    } else {
      el.classList.remove('is-mobile-box');
    }
  }
}

// Run on page load and window resize:
document.addEventListener('DOMContentLoaded', toggleResponsiveClass);
window.addEventListener('resize', toggleResponsiveClass);

function setDesktopClass() {
  var isDesktop = window.matchMedia("(min-width: 601px)").matches;
  var element = document.querySelector('.for-desktop-box');
  if (element) {
    if (isDesktop) {
      element.classList.add('is-desktop');
    } else {
      element.classList.remove('is-desktop');
    }
  }
}

document.addEventListener('DOMContentLoaded', setDesktopClass);
window.addEventListener('resize', setDesktopClass);
document.addEventListener('DOMContentLoaded', function () {
    const videoWrappers = document.querySelectorAll('.pb-video-wrapper');
    videoWrappers.forEach(wrapper => {
        const img = wrapper.querySelector('img');
        const video = wrapper.querySelector('video');
        if (img && video) {
            img.addEventListener('click', function () {
                img.style.display = 'none';
                video.style.display = 'block';
                video.play();
            });
        }
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const videoWrappers = document.querySelectorAll('.pb-video-wrapper');
    videoWrappers.forEach(wrapper => {
        const poster = wrapper.querySelector('.pb-video-poster');
        const btn = wrapper.querySelector('.pb-video-play-btn');
        const video = wrapper.querySelector('video');
        if (poster && btn && video) {
            btn.addEventListener('click', function () {
                poster.style.display = 'none';
                btn.style.display = 'none';
                video.style.display = 'block';
                video.play();
            });
        }
    });
});