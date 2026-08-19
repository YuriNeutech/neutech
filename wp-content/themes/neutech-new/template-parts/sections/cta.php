<?php
/**
 * CTA band (dark). $args: title, text, primary[url,label], secondary[url,label]
 */
$a = $args ?? [];
?>
<section class="lp-section lp-cta" data-header-theme="dark">
    <div class="lp-cta__glow absolute"></div>
    <div class="container">
        <div class="lp-cta__inner">
            <h2 class="lp-cta__title"><?= esc_html($a['title'] ?? ''); ?></h2>
            <?php if (!empty($a['text'])): ?><p class="lp-cta__text"><?= esc_html($a['text']); ?></p><?php endif; ?>
            <div class="lp-cta__actions">
                <?php
                if (!empty($a['primary']))   neutech_button($a['primary']['url'], $a['primary']['label'], 'accent');
                if (!empty($a['secondary'])) neutech_button($a['secondary']['url'], $a['secondary']['label'], 'white-border');
                ?>
            </div>
        </div>
    </div>
</section>
