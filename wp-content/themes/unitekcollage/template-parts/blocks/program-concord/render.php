<?php
if (!defined('ABSPATH')) {
    exit;
}

$section_title = get_field('pc_main_title');
$section_tab_label = 'PROGRAM CONCORD';
$tabs = get_field('pc_tabs');
$block_id = $block['id'] ?? '';
$block_class = $block['className'] ?? '';

$required_fields = array(
    'pc_main_title' => 'Main Title',
    'pc_tabs' => 'Tabs',
);

if (function_exists('unitek_college_validate_block_fields')) {
    unitek_college_validate_block_fields($required_fields, $section_tab_label);
}

$is_preview = ( isset($block['data']['_is_preview']) && $block['data']['_is_preview'] )
    || (is_admin() && !wp_doing_ajax() && !wp_is_json_request());
?>
<h2 id="<?php echo esc_attr($block_id); ?>-title" class="main-concord-section- program-concord-title"><?php echo esc_html($section_title); ?></h2>
<section class="program-concord-block <?php echo esc_attr($block_class); ?>" id="<?php echo esc_attr($block_id); ?>" role="region" aria-labelledby="<?php echo esc_attr($block_id); ?>-title">
<h2 id="<?php echo esc_attr($block_id); ?>-title" class="main-concord-section- program-concord-title program-concord-title for-desktop"><?php echo esc_html($section_title); ?></h2>
<style>
    /* -- Desktop: unchanged -- */
    .main-concord-section- {max-width:1728px;margin:0 auto;position:relative;padding:20px 10rem;box-sizing:border-box;}
    /* Block label */
    .wp-block-acf-program-concord::before {content:"🎓 Program Concord";position:absolute;top:10px;right:10px;background:rgba(0,0,0,0.8);color:white;padding:8px 12px;font-size:11px;border-radius:4px;z-index:10;font-weight:500;max-width:280px;text-align:center;line-height:1.3;}
    .program-concord-block {background:#0d4976;color:#fff;border-radius:8px;padding:20px 5%;margin-bottom:40px;position:relative;}
    .program-concord-title {font-size:2.2rem;font-weight:600;margin-bottom:1.3em;}
    .program-concord-tabs {display:flex;gap:8px;margin-bottom:1.5em;margin-top:-56px;}
    .program-concord-tab {background:#1976d2;color:#fff;border:none;padding:.8em 2em;border-radius:5px 5px 0 0;font-weight:bold;cursor:pointer;}
    .program-concord-tab.active, .program-concord-tab[aria-selected="true"] {background:#0d4976;color:#fff;}
    .program-concord-tab-content {background:#0d4976;border-radius:0 8px 8px 8px;padding:2em 2em 2em 1em;}
    .program-concord-info {display:flex;gap:40px;}
    .program-concord-sidebar {width:250px;color:#e5f2fa;}
    .program-concord-list {display:grid;grid-template-columns:repeat(3,1fr);gap:24px;width:100%;}
    .program-concord-card {background:#2196f3;color:#fff;border-radius:8px;padding:1.25em;min-height:120px;box-shadow:0 2px 6px rgba(0,0,0,0.1);position:relative;overflow:hidden;}
    .program-concord-card-title {margin:0 0 .5em;font-size:1.14em;position:relative;min-height:24px;font-weight:700;line-height:1.25;}
    .program-concord-arrow {position:absolute;top:-0.8em;right:-1em;display:inline-flex;align-items:center;color:#fff;text-decoration:none;transition:color 0.2s;padding:4px;background:transparent;z-index:1;}
    .program-concord-arrow:hover,.program-concord-arrow:focus {color:#e5f2fa;}
    .program-concord-arrow svg {width:1.2em;height:1.2em;vertical-align:middle;pointer-events:none;}
    .hidden-mobile {display:inherit;}
    .show-mobile {display:none;}
    .accordion-arrow {margin-left:15px;transition:transform 0.15s;font-size:1.4em;width:24px;height:24px;display:none;align-items:center;justify-content:center;}
    .accordion-arrow.down {transform:rotate(90deg);}
    .accordion-arrow.right {transform:rotate(0deg);}
    @media (max-width:1200px){.program-concord-list{grid-template-columns:repeat(3,1fr);}}
    @media (max-width:900px){
      .program-concord-info {flex-direction:column;}
      .program-concord-sidebar {width:100%;}
      .program-concord-list {grid-template-columns:1fr;gap:16px;}
    }
    /* -- Mobile: updated per screenshot -- */
    @media (min-width:1200px){
    
.program-concord-tabs-for-desk{
      max-width: 1728px;
    padding: 0 8%;
}
    }
  @media (min-width: 1729px) {
    .program-concord-tabs-for-desk {
                padding-left: calc((100vw - 1728px) / 2 + 3rem);
    }
}
@media (max-width: 1200px) {
  .main-concord-section- {
    padding: 20px 4rem;
}  }
    @media (max-width:480px){
      .for-desktop{display:block !important}
      .program-concord-block {        padding: 0px 12px;
        background: #133250;
        border-radius: 0px;
        margin: 0;}
      .program-concord-title {         font-size: 1.04rem;
        font-weight: 600;
        padding: 29px 20PX 20px;
        margin-bottom: 0PX;
        margin-top: 0;
        background: #133250;
        color: #fff;
        border-radius: 12px 12px 0 0;
        text-align: left;}
      .program-concord-tabs {flex-direction:column;gap:0;margin-bottom:0;}
      .program-concord-tab {
        background:#1795ec;
        color:#fff;
        border-radius:10px;
        box-shadow:0 2px 8px rgba(0,0,0,0.09);
        border:none;
        font-size:1rem;
        padding:17px 15px 17px 19px;
        width:100%;
        text-align:left;
        position:relative;
        display:flex;
        align-items:center;
        justify-content:space-between;
        font-weight:600;
        letter-spacing:0.5px;
        margin-bottom:0px;
        border-bottom:1.8px solid rgba(255,255,255,0.13);
        transition:background 0.16s;
        box-sizing:border-box;
      }
      .program-concord-tab.active, .program-concord-tab[aria-selected="true"] {
        background:#1372ba;
        color:#fff;
        box-shadow:0 0 0 2px #1270b8 inset;
        margin-top:10px;
      }
      .program-concord-tab .accordion-arrow {
        display:inline-flex;
        color:#fff;
        background:transparent;
        font-size:1.32em;
        margin-right:2px;
      }
      .accordion-arrow.down {transform:rotate(90deg);}
      .accordion-arrow.right {transform:rotate(0deg);}
      .program-concord-tab-content {
        padding:0 9px 2px 9px;
        background:#186094;
        border-radius:0 0 12px 12px;
        box-shadow:none;
        margin-bottom:9px;
      }
      .program-concord-info,.program-concord-list,.program-concord-sidebar,.program-concord-card{width:100%;}
      .program-concord-info{display:block;gap:0;padding:0;}
      .program-concord-list{display:block;margin:0;}
      .program-concord-card{
                background: #186094;
        color: #fff;
        margin: 0 0 7px 0;
        border-radius: 9px;
        box-shadow: 0 3px 16px rgba(0, 18, 52, 0.08);
        min-height: unset;
        font-size: 15px;
        padding: 16px 14px 15px 18px;
        display: block;
        cursor: pointer;
        border-bottom: 1px solid #53cfff29;
      }
      .program-concord-card-title{
        font-size:1.035em;
        margin:0 0 5px 0;
        position:relative;
        font-weight:700;
        text-transform:uppercase;
        letter-spacing:.025em;
        color:#fff;
      }
      .program-concord-arrow{position:absolute;top:2px;right:-5px;}
      .program-concord-card p{display:none;}
      .program-concord-sidebar{display:none;}
    }
    .for-desktop{display:none}
</style>
<?php if ($section_title): ?>
<!-- <h2 id="<?php //echo esc_attr($block_id); ?>-title" class="program-concord-title"><?php //echo esc_html($section_title); ?></h2> -->
<?php endif; ?>
<?php if (!empty($tabs)): ?>
<div class="program-concord-tabs program-concord-tabs-for-desk" role="tablist" aria-label="Program Tabs">
  <?php foreach ($tabs as $i => $tab): ?>
    <button type="button"
      class="program-concord-tab<?php if ($i === 0) echo ' active'; ?>"
      id="<?php echo esc_attr($block_id) . '-tab-' . $i; ?>"
      role="tab"
      aria-controls="<?php echo esc_attr($block_id) . '-tabpanel-' . $i; ?>"
      aria-selected="<?php echo ($i === 0 ? 'true' : 'false'); ?>"
      tabindex="<?php echo ($i === 0 ? '0' : '-1'); ?>"
      data-tab="<?php echo $i; ?>">
      <?php echo esc_html($tab['pc_tab_title']); ?>
      <span class="accordion-arrow <?php echo ($i === 0 ? 'down' : 'right'); ?>">&#8250;</span>
    </button>
  <?php endforeach; ?>
</div>
<div class="program-concord-panels program-concord-tabs-for-desk">
  <?php foreach ($tabs as $i => $tab): ?>
    <div class="program-concord-tab-content"
      role="tabpanel"
      id="<?php echo esc_attr($block_id) . '-tabpanel-' . $i; ?>"
      aria-labelledby="<?php echo esc_attr($block_id) . '-tab-' . $i; ?>"
      data-content="<?php echo $i; ?>"
      <?php if ($i !== 0) echo 'style="display:none"'; ?>>
      <div class="program-concord-info">
        <?php if (!empty($tab['pc_sidebar'])): ?>
          <div class="program-concord-sidebar hidden-mobile"><?php echo esc_html($tab['pc_sidebar']); ?></div>
        <?php endif; ?>
        <?php if (!empty($tab['pc_program_list'])): ?>
          <div class="program-concord-list">
            <?php foreach ($tab['pc_program_list'] as $program): ?>
              <div class="program-concord-card">
                <h3 class="program-concord-card-title">
                  <?php echo esc_html($program['pc_program_title']); ?>
                  <?php if (!empty($program['pc_program_url'])): ?>
                    <a class="program-concord-arrow"
                      href="<?php echo esc_url($program['pc_program_url']); ?>"
                      rel="noopener"
                      aria-label="<?php echo esc_attr('Visit ' . $program['pc_program_title'] . ' (opens in new tab)'); ?>">
                      <svg viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false">
                        <path d="M7 17L17 7M17 7H7M17 7V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                    </a>
                  <?php endif; ?>
                </h3>
                <p class="hidden-mobile"><?php echo esc_html($program['pc_program_desc']); ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  <?php endforeach; ?>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.program-concord-tab');
    const panelsContainer = document.querySelector('.program-concord-panels');
    const panels = document.querySelectorAll('.program-concord-tab-content');
    const arrows = document.querySelectorAll('.accordion-arrow');

    function isMobile() {
      return window.matchMedia('(max-width: 480px)').matches;
    }

    function desktopTabs(idx) {
      panels.forEach(panel => panelsContainer.appendChild(panel));
      tabs.forEach((tab, i) => {
        tab.classList.remove('active');
        tab.setAttribute('aria-selected', 'false');
        tab.setAttribute('tabindex', '-1');
        panels[i].style.display = 'none';
        arrows[i].classList.remove('down');
        arrows[i].classList.add('right');
      });
      tabs[idx].classList.add('active');
      tabs[idx].setAttribute('aria-selected', 'true');
      tabs[idx].setAttribute('tabindex', '0');
      panels[idx].style.display = 'block';
      arrows[idx].classList.add('down');
      arrows[idx].classList.remove('right');
      tabs[idx].focus();
    }

    function mobileAccordion(idx) {
      tabs.forEach((tab, i) => {
        if (i === idx) {
          tab.classList.add('active');
          tab.setAttribute('aria-selected', 'true');
          tab.setAttribute('tabindex', '0');
          panels[i].style.display = 'block';
          arrows[i].classList.add('down');
          arrows[i].classList.remove('right');
          tab.parentNode.insertBefore(panels[i], tab.nextSibling);
        } else {
          tab.classList.remove('active');
          tab.setAttribute('aria-selected', 'false');
          tab.setAttribute('tabindex', '-1');
          panels[i].style.display = 'none';
          arrows[i].classList.remove('down');
          arrows[i].classList.add('right');
          if (!panelsContainer.contains(panels[i])) {
            panelsContainer.appendChild(panels[i]);
          }
        }
      });
    }

    tabs.forEach((tab, idx) => {
      tab.addEventListener('click', function () {
        if (isMobile()) {
          mobileAccordion(idx);
        } else {
          desktopTabs(idx);
        }
      });
    });

    if (isMobile()) {
      mobileAccordion(0);  // open first tab for mobile
    } else {
      desktopTabs(0);  // desktop first tab active
    }

    document.querySelector('.program-concord-tabs').addEventListener('keydown', function (e) {
      if (isMobile()) return;
      const activeIndex = Array.from(tabs).findIndex(tab => tab.classList.contains('active'));
      let newIndex = null;
      if (e.key === 'ArrowRight') newIndex = (activeIndex + 1) % tabs.length;
      if (e.key === 'ArrowLeft') newIndex = (activeIndex - 1 + tabs.length) % tabs.length;
      if (newIndex !== null) {
        desktopTabs(newIndex);
        e.preventDefault();
      }
    });

    window.addEventListener('resize', () => {
      if (isMobile()) {
        const activeIdx = Array.from(tabs).findIndex(tab => tab.classList.contains('active'));
        mobileAccordion(activeIdx === -1 ? 0 : activeIdx);
      } else {
        desktopTabs(0);
      }
    });
  });
  document.addEventListener('DOMContentLoaded', function () {
  // Scroll to top on page load
  window.scrollTo(0, 0);

  // Your existing code...
  const tabs = document.querySelectorAll('.program-concord-tab');
  const panelsContainer = document.querySelector('.program-concord-panels');
  const panels = document.querySelectorAll('.program-concord-tab-content');
  const arrows = document.querySelectorAll('.accordion-arrow');

  // ... rest of your code
});
(function ($) {
    // Only run in backend editor
    if (typeof acf !== 'undefined') {
        acf.addAction('render_block_preview/type=program-concord', function ($block) {
            // Wait for the block to be fully rendered
            setTimeout(function () {
                const tabs = $block.find('.program-concord-tab');
                const panels = $block.find('.program-concord-tab-content');
                const arrows = $block.find('.accordion-arrow');

                function showTab(idx) {
                    panels.hide();
                    tabs.removeClass('active');
                    tabs.attr('aria-selected', 'false');
                    arrows.removeClass('down').addClass('right');
                    
                    tabs.eq(idx).addClass('active').attr('aria-selected', 'true');
                    panels.eq(idx).show();
                    arrows.eq(idx).removeClass('right').addClass('down');
                }

                tabs.on('click', function () {
                    const idx = tabs.index(this);
                    showTab(idx);
                });

                // Show first tab by default
                showTab(0);
            }, 100);
        });
    }
})(jQuery);
</script>
<?php endif; ?>
</section>
