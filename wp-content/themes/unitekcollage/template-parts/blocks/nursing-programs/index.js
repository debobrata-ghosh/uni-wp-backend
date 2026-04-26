// Tab switching function
function switchNursingTab(tabIndex) {
    // Update tab active states
    const tabs = document.querySelectorAll('.nursing-programs__tab');
    tabs.forEach((tab, index) => {
        if (index === tabIndex) {
            tab.classList.add('active');
        } else {
            tab.classList.remove('active');
        }
    });
    
    // Get tab data
    const tabData = window.nursingTabsData[tabIndex];
    if (!tabData) return;
    
    // Update image
    const imageContainer = document.querySelector('.tab-image');
    if (imageContainer && tabData.tab_image) {
        imageContainer.innerHTML = `<img src="${tabData.tab_image.url}" alt="${tabData.tab_image.alt || ''}">`;
    } else if (imageContainer) {
        imageContainer.innerHTML = '[ Image ]';
    }
    
    // Update headline
    const headline = document.querySelector('.tab-headline');
    if (headline) headline.textContent = tabData.tab_headline || '';
    
    // Update description
    const description = document.querySelector('.tab-description');
    if (description) description.innerHTML = tabData.tab_description || '';
    
    // Update buttons
    const primaryBtn = document.querySelector('.tab-primary-btn');
    if (primaryBtn && tabData.tab_primary_button) {
        primaryBtn.textContent = tabData.tab_primary_button.button_text || '';
        primaryBtn.href = tabData.tab_primary_button.button_url || '#';
    }
    
    const secondaryBtn = document.querySelector('.tab-secondary-btn');
    if (secondaryBtn && tabData.tab_secondary_button) {
        secondaryBtn.textContent = tabData.tab_secondary_button.button_text || '';
        secondaryBtn.href = tabData.tab_secondary_button.button_url || '#';
    }
    
    // Update program details title
    const detailsTitle = document.querySelector('.tab-details-title');
    if (detailsTitle) {
        detailsTitle.textContent = tabData.tab_details_title || 'BSN Program Details';
    }
    
    // Update program details
    const detailsList = document.querySelector('.tab-details-list');
    if (detailsList && tabData.tab_program_details) {
        detailsList.innerHTML = '';
        tabData.tab_program_details.forEach(detail => {
            const li = document.createElement('li');
            li.className = 'nursing-programs__details-item';
            li.textContent = detail.detail_item || '';
            detailsList.appendChild(li);
        });
    }
    
    // Update program locations title
    const locationsTitle = document.querySelector('.tab-locations-title');
    if (locationsTitle) {
        locationsTitle.textContent = tabData.tab_locations_title || 'BSN Program Locations';
    }
    
    // Update locations
    const locationsList = document.querySelector('.tab-locations-list');
    if (locationsList && tabData.tab_program_locations) {
        locationsList.innerHTML = '';
        tabData.tab_program_locations.forEach(location => {
            const li = document.createElement('li');
            li.className = 'nursing-programs__locations-item';
            
            if (location.location_url) {
                const a = document.createElement('a');
                a.href = location.location_url;
                a.className = 'nursing-programs__locations-link';
                a.textContent = location.location_name || '';
                li.appendChild(a);
            } else {
                li.textContent = location.location_name || '';
            }
            locationsList.appendChild(li);
        });
    }
}

