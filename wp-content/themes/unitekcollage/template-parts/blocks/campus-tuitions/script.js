/**
 * Campus Tuitions Block Script
 */
(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        const blocks = document.querySelectorAll('.campus-tuitions-block');
        
        blocks.forEach(function(block) {
            const tabItems = block.querySelectorAll('.tab-item');
            const tabPanels = block.querySelectorAll('.tab-panel');
            const triggers = block.querySelectorAll('.pathways-trigger');

            // Tab switching
            tabItems.forEach(function(tab) {
                tab.addEventListener('click', function() {
                    const index = tab.dataset.index;
                    
                    // Reset all tabs
                    tabItems.forEach(function(t) {
                        t.classList.remove('active');
                        t.style.background = 'transparent';
                        t.style.color = '#fff';
                    });
                    
                    // Hide all panels
                    tabPanels.forEach(function(panel) {
                        panel.style.display = 'none';
                    });

                    // Activate clicked tab
                    tab.classList.add('active');
                    tab.style.background = '#fff';
                    tab.style.color = '#003b63';
                    
                    // Show corresponding panel
                    const targetPanel = block.querySelector('.tab-panel[data-index="' + index + '"]');
                    if (targetPanel) {
                        targetPanel.style.display = 'block';
                    }
                });
            });

            // Accordion toggle
            triggers.forEach(function(trigger) {
                trigger.addEventListener('click', function() {
                    const panel = trigger.nextElementSibling;
                    const arrow = trigger.querySelector('.arrow');
                    const isOpen = panel.style.display === 'block';
                    
                    panel.style.display = isOpen ? 'none' : 'block';
                    if (arrow) {
                        arrow.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
                    }
                });
            });
        });
    });
})();

