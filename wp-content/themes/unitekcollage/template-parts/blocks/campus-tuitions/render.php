<?php
$title = get_field('campus_tuitions_title');
$tabs = get_field('campus_tuitions_tabs');
?>

<?php if( $tabs ): ?>
<section class="campus-tuitions-block" style="display:flex; align-items:flex-start; background:#fff; border-top:3px solid #e5e5e5;">
    <div class="sidebar" style="background:#003b63; padding:40px 20px; flex:0 0 30%; color:#fff;">
        <?php if($title): ?>
            <h2 style="font-size:22px; line-height:1.3; font-weight:600; margin-bottom:30px;"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>
        <ul class="tabs-list" style="list-style:none; padding:0; margin:0;">
            <?php $t_index = 0; foreach($tabs as $tab): ?>
                <li class="tab-item <?php echo $t_index === 0 ? 'active' : ''; ?>" data-index="<?php echo $t_index; ?>" 
                    style="cursor:pointer; padding:15px 10px; background:<?php echo $t_index === 0 ? '#fff' : 'transparent'; ?>; color:<?php echo $t_index === 0 ? '#003b63' : '#fff'; ?>; margin-bottom:1px;">
                    <?php echo esc_html($tab['tab_title']); ?>
                </li>
            <?php $t_index++; endforeach; ?>
        </ul>
    </div>

    <div class="tab-content" style="flex:1; padding:40px 50px;">
        <?php $t_index = 0; foreach($tabs as $tab): ?>
            <div class="tab-panel" data-index="<?php echo $t_index; ?>" style="display:<?php echo $t_index === 0 ? 'block' : 'none'; ?>;">
                <?php if( !empty($tab['tab_items']) ): ?>
                    <?php foreach($tab['tab_items'] as $item): ?>
                        <div class="pathways-item" style="border-bottom:1px solid #d9d9d9; padding:15px 0;">
                            <button class="pathways-trigger" style="background:none; border:none; width:100%; text-align:left; font-size:16px; color:#0071bb; display:flex; align-items:center; justify-content:space-between; cursor:pointer;">
                                <span><?php echo esc_html($item['question']); ?></span>
                                <span class="arrow" style="transition:transform 0.3s;">↓</span>
                            </button>
                            <div class="pathways-panel" style="display:none; margin-top:10px;">
                                <div style="color:#444; font-size:15px; line-height:1.6;"><?php echo $item['answer']; ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <?php $t_index++; endforeach; ?>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabItems = document.querySelectorAll('.campus-tuitions-block .tab-item');
        const tabPanels = document.querySelectorAll('.campus-tuitions-block .tab-panel');
        const triggers = document.querySelectorAll('.campus-tuitions-block .pathways-trigger');

        tabItems.forEach(tab => {
            tab.addEventListener('click', () => {
                const index = tab.dataset.index;
                tabItems.forEach(t => { 
                    t.classList.remove('active'); 
                    t.style.background = 'transparent'; 
                    t.style.color = '#fff'; 
                });
                tabPanels.forEach(panel => panel.style.display = 'none');

                tab.classList.add('active');
                tab.style.background = '#fff';
                tab.style.color = '#003b63';
                document.querySelector(`.campus-tuitions-block .tab-panel[data-index="${index}"]`).style.display = 'block';
            });
        });

        triggers.forEach(trigger => {
            trigger.addEventListener('click', () => {
                const panel = trigger.nextElementSibling;
                const arrow = trigger.querySelector('.arrow');
                const isOpen = panel.style.display === 'block';
                panel.style.display = isOpen ? 'none' : 'block';
                arrow.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
            });
        });
    });
    </script>
</section>
<?php endif; ?>
