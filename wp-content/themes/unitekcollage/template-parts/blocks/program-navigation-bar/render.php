<?php
if (!defined('ABSPATH')) {
  exit;
}
$tabs = get_field('program_nav_tabs');
$tab_count = $tabs ? count($tabs) : 0;
?>
<section class="program-navigation-bar-section">
    <nav aria-label="Program Navigation" role="navigation" style="position:relative;">
        <ul class="program-navigation-bar-nav" id="programNavBar">
            <?php
            if($tabs): foreach($tabs as $i => $tab):
                $label = trim($tab['tab_label']);
                $section_id = trim($tab['tab_section_id']);
                $href = $section_id ? "#$section_id" : "#";
            ?>
                <li data-tab-index="<?php echo $i; ?>">
                    <a class="program-navigation-bar-link" href="<?php echo esc_attr($href); ?>">
                        <?php echo esc_html($label); ?>
                    </a>
                </li>
            <?php endforeach; endif; ?>
        </ul>
        <?php if($tab_count > 3): ?>
        <span class="program-navigation-bar-chevron" id="programNavChevron" onclick="moveProgramNavBar()">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M8 6L12 10L8 14" stroke="#23272a" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
        <?php endif; ?>
    </nav>
</section>

