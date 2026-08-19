<?php
/**
 * Gated download. Name + work email, then the file starts downloading.
 * $args: eyebrow, title, intro, magnet (slug registered in the `neutech_magnets`
 * option), label (button text), note.
 *
 * Shares the `neutech_lead` admin-ajax endpoint and the .lp-form__form async
 * handler; the `magnet` hidden field is what turns the response into a file URL.
 */
$a      = $args ?? [];
$magnet = $a['magnet'] ?? '';
$file   = function_exists('neutech_magnet_url') ? neutech_magnet_url($magnet) : '';
$ajax   = esc_url(admin_url('admin-ajax.php'));

// Nothing to hand over yet — don't show a form that can't deliver.
if (!$file) return;
?>
<section class="lp-section lp-section--dark lp-form lp-magnet" data-header-theme="dark">
    <div class="lp-cta__glow absolute"></div>
    <div class="container">
        <div class="lp-form__grid">
            <div class="lp-form__intro">
                <?php if (!empty($a['eyebrow'])): ?><span class="lp-eyebrow"><?= esc_html($a['eyebrow']); ?></span><?php endif; ?>
                <h2 class="lp-title"><?= esc_html($a['title'] ?? 'Get the guide'); ?></h2>
                <?php if (!empty($a['intro'])): ?><p class="lp-intro"><?= esc_html($a['intro']); ?></p><?php endif; ?>
            </div>

            <form class="lp-form__form lp-magnet__form" action="<?= $ajax; ?>" method="post" novalidate>
                <input type="hidden" name="action" value="neutech_lead">
                <input type="hidden" name="magnet" value="<?= esc_attr($magnet); ?>">
                <?php wp_nonce_field('neutech_lead', 'neutech_lead_nonce'); ?>
                <div class="lp-form__row">
                    <label class="lp-form__field"><span>Name</span>
                        <input type="text" name="name" required autocomplete="name"></label>
                    <label class="lp-form__field"><span>Work email</span>
                        <input type="email" name="email" required autocomplete="email"></label>
                </div>
                <div class="lp-form__actions">
                    <button type="submit" class="btn btn--theme-accent btn--cta-md relative">
                        <span class="btn__text-wr"><?= esc_html($a['label'] ?? 'Download Comparison Guide'); ?></span>
                        <span class="btn__glow absolute"></span>
                    </button>
                    <span class="lp-form__note"><?= esc_html($a['note'] ?? 'The PDF opens straight away. We never share your details.'); ?></span>
                </div>
                <p class="lp-form__status" role="status" aria-live="polite"></p>
            </form>
        </div>
    </div>
</section>
