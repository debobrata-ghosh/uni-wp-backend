document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.bsn-curriculum-accordion-header').forEach(function(header, i){
    header.addEventListener('click',function(e){
      var expanded = this.getAttribute('aria-expanded');
      if(expanded==="true") {
        this.setAttribute('aria-expanded',"false");
        this.classList.remove('open');
        document.getElementById(this.getAttribute('aria-controls')).setAttribute('hidden','');
      } else {
        // close all
        document.querySelectorAll('.bsn-curriculum-accordion-header').forEach(function(other){
          other.setAttribute('aria-expanded',"false");
          other.classList.remove('open');
        });
        document.querySelectorAll('.bsn-curriculum-panel').forEach(function(panel){
          panel.setAttribute('hidden','');
        });
        this.setAttribute('aria-expanded',"true");
        this.classList.add('open');
        document.getElementById(this.getAttribute('aria-controls')).removeAttribute('hidden');
      }
    });
    // Keyboard support
    header.addEventListener('keydown', function(e){
      if(e.key === " " || e.key === "Enter"){
        e.preventDefault();
        this.click();
      }
      // Up/Down: move focus
      if(e.key === "ArrowDown" || e.key === "ArrowUp") {
        let headers = Array.from(document.querySelectorAll('.bsn-curriculum-accordion-header'));
        let idx = headers.indexOf(document.activeElement);
        if(e.key === "ArrowDown" && idx < headers.length - 1){
          headers[idx+1].focus();
        } else if(e.key === "ArrowUp" && idx > 0){
          headers[idx-1].focus();
        }
      }
    });
  });
  // Footer close buttons (for accessibility and visual aid)
  document.querySelectorAll('.bsn-curriculum-footer .close').forEach(function(btn){
    btn.addEventListener('click', function(){
      let parentPanel = this.closest('.bsn-curriculum-panel');
      let id = parentPanel.getAttribute('id');
      document.querySelectorAll('.bsn-curriculum-accordion-header').forEach(function(header){
        if(header.getAttribute('aria-controls')===id){
          header.setAttribute('aria-expanded',"false");
          header.classList.remove('open');
        }
      });
      parentPanel.setAttribute('hidden','');
      // Set focus back to the header for accessibility
      document.querySelector('[aria-controls="'+id+'"]').focus();
    });
  });
});
