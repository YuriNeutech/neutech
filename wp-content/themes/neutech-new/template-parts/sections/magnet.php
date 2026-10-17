<?php
/**
 * Name/email capture with the accepted Tely completion link.
 * $args: eyebrow, title, intro, magnet (connection key), label, note.
 */
$a      = $args ?? [];
$magnet = $a['magnet'] ?? '';
$connections = get_option('tely_cta_connections', []);
$connection = is_array($connections) ? ($connections[$magnet] ?? []) : [];

// The prepared owner artifact must include a configured resource result.
if (!is_array($connection) || empty($connection['definition']['completionLink'])
    || !neutech_tely_form_ready($connection)) return;
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

            <form class="lp-form__form lp-magnet__form" method="post" onsubmit="return false;" data-tely-cta="native"
                  data-tely-context-url="<?= esc_url($connection['contextUrl']); ?>"
                  data-tely-submissions-url="<?= esc_url($connection['submissionsUrl']); ?>">
                <fieldset disabled data-tely-pending style="border:0;padding:0;margin:0;min-width:0;display:contents">
                <div class="lp-form__row">
                    <label class="lp-form__field"><span>Name</span>
                        <input type="text" name="name" data-tely-field="name" required autocomplete="name"></label>
                    <label class="lp-form__field"><span>Work email</span>
                        <input type="email" name="email" data-tely-field="email" required autocomplete="email"></label>
                </div>
                <div hidden aria-hidden="true"><label>Website<input type="text" name="company_website" data-tely-field="website" tabindex="-1" autocomplete="off"></label></div>
                <div class="lp-form__actions">
                    <button type="submit" class="btn btn--theme-accent btn--cta-md relative">
                        <span class="btn__text-wr"><?= esc_html($a['label'] ?? 'Download Comparison Guide'); ?></span>
                        <span class="btn__glow absolute"></span>
                    </button>
                    <span class="lp-form__note"><?= esc_html($a['note'] ?? 'The PDF opens straight away. We never share your details.'); ?></span>
                </div>
                <p class="lp-form__status" data-tely-status role="status" aria-live="polite"></p>
                </fieldset>
                <noscript>This form requires JavaScript. Please email info@neutech.co.</noscript>
            </form>
        </div>
    </div>
</section>
