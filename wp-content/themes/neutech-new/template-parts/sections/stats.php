<?php
/**
 * Stats strip (dark). $args: title, items[ [num,label] ]
 */
$a = $args ?? [];
?>
<section class="lp-section lp-section--dark lp-stats" data-header-theme="dark">
    <div class="container">
        <?php if (!empty($a['title'])): ?>
        <div class="lp-head"><h2 class="lp-title"><?= esc_html($a['title']); ?></h2></div>
        <?php endif; ?>
        <div class="lp-stats__grid">
            <?php foreach (($a['items'] ?? []) as $it): ?>
            <div class="lp-stats__item">
                <div class="lp-stats__num"><?= esc_html($it['num']); ?></div>
                <div class="lp-stats__label"><?= esc_html($it['label']); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
