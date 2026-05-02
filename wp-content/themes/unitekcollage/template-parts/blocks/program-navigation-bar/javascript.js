var navBarIndex = 0;
function moveProgramNavBar() {
    var navBar = document.getElementById('programNavBar');
    var tabs = navBar.querySelectorAll('li');
    var total = tabs.length;
    var chevron = document.getElementById('programNavChevron');
    // Show next 3 tabs, wrap if at end
    navBarIndex += 3;
    if(navBarIndex >= total) navBarIndex = 0;
    tabs.forEach(function(tab, i){
       tab.style.display = (i >= navBarIndex && i < navBarIndex+3) ? 'list-item' : 'none';
    });
    // Hide chevron if only one group
    if(total <= 3) chevron.style.display = 'none';
}
// INIT for mobile: Only show first 3 tabs if mobile
window.addEventListener('DOMContentLoaded',function(){
    if(window.innerWidth <= 600) {
        moveProgramNavBar(); // Initialize only 3 visible
    }
});
window.addEventListener('resize',function(){
    var navBar = document.getElementById('programNavBar');
    var chevron = document.getElementById('programNavChevron');
    if(window.innerWidth > 600) {
        // Show all tabs and chevron hidden
        navBarIndex = 0;
        navBar.querySelectorAll('li').forEach(tab => tab.style.display = 'list-item');
        if(chevron) chevron.style.display = 'none';
    } else {
        // Reset to mobile single group
        if(chevron) chevron.style.display = '';
        moveProgramNavBar();
    }
});
document.addEventListener("DOMContentLoaded", function(){
  var navBar = document.querySelector('.program-navigation-bar-section');
  var header = document.querySelector('.header');
  if(!navBar || !header) return;

  var navOrigOffset = navBar.getBoundingClientRect().top + window.pageYOffset;
  var navHeight = navBar.offsetHeight;
  var headerHeight = header.offsetHeight;

  function onScroll() {
    if(window.pageYOffset + headerHeight >= navOrigOffset){
      navBar.classList.add('js-fixed');
      navBar.style.top = headerHeight + 'px';
      document.body.classList.add('body-has-fixed-bar');
      document.body.style.marginTop = navHeight + 'px'; // Prevents content jump
    } else {
      navBar.classList.remove('js-fixed');
      navBar.style.top = '';
      document.body.classList.remove('body-has-fixed-bar');
      document.body.style.marginTop = '';
    }
  }

  window.addEventListener('scroll', onScroll, {passive:true});
  window.addEventListener('resize', function(){
    navOrigOffset = navBar.getBoundingClientRect().top + window.pageYOffset;
    navHeight = navBar.offsetHeight;
    headerHeight = header.offsetHeight;
    onScroll();
  });

  onScroll(); // Initial check at page load
});