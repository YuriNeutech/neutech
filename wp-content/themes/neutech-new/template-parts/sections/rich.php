<?php
/**
 * Rich prose section. $args: theme, eyebrow, title, body(html)
 */
$a = $args ?? [];
$theme = $a['theme'] ?? 'white';
?>
<section class="lp-section lp-section--<?= esc_attr($theme); ?> lp-rich">
    <div class="container">
        <?php if (!empty($a['title'])): ?>
        <div class="lp-head">
            <?php if (!empty($a['eyebrow'])): ?><span class="lp-eyebrow"><?= esc_html($a['eyebrow']); ?></span><?php endif; ?>
            <h2 class="lp-title"><?= esc_html($a['title']); ?></h2>
        </div>
        <?php endif; ?>
        <div class="lp-rich__body"><?= wp_kses_post($a['body'] ?? ''); ?></div>
    </div>
</section>
