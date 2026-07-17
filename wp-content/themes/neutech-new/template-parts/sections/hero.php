<?php
/**
 * Landing hero. $args: eyebrow, title, subtitle, primary[url,label], secondary[url,label]
 */
$a = $args ?? [];
?>
<section class="lp-hero" data-header-theme="dark">
    <div class="lp-hero__bg absolute">
        <div class="lp-hero__glow absolute"></div>
        <div class="hero__particles">
            <div class="hero__particle bg-dot" style="top: 12%; left: 12%; opacity:.8; filter:blur(2px);"></div>
            <div class="hero__particle bg-dot" style="top: 22%; left: 82%; scale:1.6; filter:blur(4px);"></div>
            <div class="hero__particle bg-dot" style="top: 68%; left: 30%; opacity:.5; filter:blur(5px);"></div>
        </div>
    </div>
    <div class="lp-hero__container container">
        <div class="lp-hero__inner">
            <?php if (!empty($a['eyebrow'])): ?>
                <span class="lp-hero__eyebrow"><?= esc_html($a['eyebrow']); ?></span>
            <?php endif; ?>
            <h1 class="lp-hero__title"><?= wp_kses_post($a['title'] ?? ''); ?></h1>
            <?php if (!empty($a['subtitle'])): ?>
                <p class="lp-hero__subtitle"><?= esc_html($a['subtitle']); ?></p>
            <?php endif; ?>
            <div class="lp-hero__actions">
                <?php
                if (!empty($a['primary']))   neutech_button($a['primary']['url'], $a['primary']['label'], 'accent');
                if (!empty($a['secondary'])) neutech_button($a['secondary']['url'], $a['secondary']['label'], 'white-border');
                ?>
            </div>
        </div>
        <?php echo neutech_hero_visual( $a['visual'] ?? 'stack' ); ?>
    </div>
</section>
