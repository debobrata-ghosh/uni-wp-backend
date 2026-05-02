/**
 * Pathways Block Script - Accordion Functionality
 */
(function() {
    'use strict';
    
    document.addEventListener("DOMContentLoaded", function() {
        // Get all pathways blocks on the page
        const pathwaysBlocks = document.querySelectorAll('.pathways-block');
        
        pathwaysBlocks.forEach(function(block) {
            const blockId = block.getAttribute('id');
            if (!blockId) return;
            
            const triggers = block.querySelectorAll('.pathways-trigger');
            
            if (triggers.length === 0) return;

            triggers.forEach(function(trigger) {
                // Click handler
                trigger.addEventListener("click", function() {
                    toggleAccordion(this);
                });

                // Keyboard handler for accessibility
                trigger.addEventListener("keydown", function(e) {
                    if (e.key === "Enter" || e.key === " ") {
                        e.preventDefault();
                        toggleAccordion(this);
                    }
                });

                function toggleAccordion(button) {
                    const item = button.closest(".pathways-item");
                    if (!item) return;
                    
                    const panel = item.querySelector(".pathways-panel");
                    const isExpanded = button.getAttribute("aria-expanded") === "true";

                    // Toggle active state
                    item.classList.toggle("active");
                    
                    // Update ARIA attributes
                    button.setAttribute("aria-expanded", isExpanded ? "false" : "true");
                }
            });
        });
    });
})();

