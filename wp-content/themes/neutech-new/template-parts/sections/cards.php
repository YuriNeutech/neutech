<?php
/**
 * Card grid. $args: theme(light|white), eyebrow, title, intro, center(bool),
 * columns(2|3), items[ [eyebrow,title,text,meta,url] ]
 */
$a = $args ?? [];
$theme = $a['theme'] ?? 'light';
$cols  = ($a['columns'] ?? 3) == 2 ? ' lp-cards--2' : '';
$center = !empty($a['center']) ? ' lp-head--center' : '';
?>
<section class="lp-section lp-section--<?= esc_attr($theme); ?>">
    <div class="container">
        <?php if (!empty($a['title'])): ?>
        <div class="lp-head<?= $center; ?>">
            <?php if (!empty($a['eyebrow'])): ?><span class="lp-eyebrow"><?= esc_html($a['eyebrow']); ?></span><?php endif; ?>
            <h2 class="lp-title"><?= esc_html($a['title']); ?></h2>
            <?php if (!empty($a['intro'])): ?><p class="lp-intro"><?= esc_html($a['intro']); ?></p><?php endif; ?>
        </div>
        <?php endif; ?>

        <div class="lp-cards<?= $cols; ?>">
            <?php foreach (($a['items'] ?? []) as $it):
                $tag  = !empty($it['url']) ? 'a' : 'div';
                $href = !empty($it['url']) ? ' href="' . esc_url($it['url']) . '"' : '';
            ?>
            <<?= $tag; ?> class="lp-cards__item"<?= $href; ?>>
                <?php if (!empty($it['eyebrow'])): ?><span class="lp-cards__eyebrow"><?= esc_html($it['eyebrow']); ?></span><?php endif; ?>
                <h3 class="lp-cards__title"><?= esc_html($it['title']); ?></h3>
                <?php if (!empty($it['text'])): ?><p class="lp-cards__text"><?= esc_html($it['text']); ?></p><?php endif; ?>
                <?php if (!empty($it['meta'])): ?><span class="lp-cards__meta"><?= esc_html($it['meta']); ?></span><?php endif; ?>
                <?php if (!empty($it['url'])): ?><span class="lp-cards__arrow"><?= neutech_arrow_svg(); ?></span><?php endif; ?>
            </<?= $tag; ?>>
            <?php endforeach; ?>
        </div>
    </div>
</section>
