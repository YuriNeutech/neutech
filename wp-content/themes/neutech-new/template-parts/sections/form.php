<?php
/**
 * Quote / contact form section. $args: eyebrow, title, intro, options[] (project types)
 * Captures through the common Tely API; file requests and newsletters stay separate.
 */
$a = $args ?? [];
$opts = $a['options'] ?? ['Custom software', 'Healthcare software', 'Web app', 'Mobile app', 'Staff augmentation', 'Something else'];
$connection = get_option('tely_cta_connection', []);
$ready = is_array($connection) && !empty($connection['contextUrl'])
    && !empty($connection['submissionsUrl']) && !empty($connection['embedScriptUrl']);
if ($ready && !wp_script_is('neutech-native-forms', 'enqueued')) {
    wp_enqueue_script('neutech-native-forms', $connection['embedScriptUrl'], [], null, true);
}
$id = (string) ($a['id'] ?? '');
$class = 'lp-section lp-section--dark lp-form' . (!empty($a['className']) ? ' ' . $a['className'] : '');
?>
<section <?php if ($id !== '') echo 'id="' . esc_attr($id) . '"'; ?> class="<?= esc_attr($class); ?>" data-header-theme="dark">
    <div class="lp-cta__glow absolute"></div>
    <div class="container">
        <div class="lp-form__grid">
            <div class="lp-form__intro">
                <?php if (!empty($a['eyebrow'])): ?><span class="lp-eyebrow"><?= esc_html($a['eyebrow']); ?></span><?php endif; ?>
                <h2 class="lp-title"><?= esc_html($a['title'] ?? 'Get a quote'); ?></h2>
                <?php if (!empty($a['intro'])): ?><p class="lp-intro"><?= esc_html($a['intro']); ?></p><?php endif; ?>
            </div>

            <form class="lp-form__form" method="post" onsubmit="return false;" data-tely-cta="native"
                  data-tely-context-url="<?= esc_url($ready ? $connection['contextUrl'] : ''); ?>"
                  data-tely-submissions-url="<?= esc_url($ready ? $connection['submissionsUrl'] : ''); ?>">
                <fieldset disabled data-tely-pending style="border:0;padding:0;margin:0;min-width:0;display:contents">
                <div class="lp-form__row">
                    <label class="lp-form__field"><span>Name</span>
                        <input type="text" name="name" data-tely-field="name" required autocomplete="name"></label>
                    <label class="lp-form__field"><span>Work email</span>
                        <input type="email" name="email" data-tely-field="email" required autocomplete="email"></label>
                </div>
                <div class="lp-form__row">
                    <label class="lp-form__field"><span>Company</span>
                        <input type="text" name="company" data-tely-field="company" autocomplete="organization"></label>
                    <label class="lp-form__field"><span>What do you need?</span>
                        <select name="project_type" data-tely-field="project_type">
                            <?php foreach ($opts as $o): ?><option value="<?= esc_attr($o); ?>"><?= esc_html($o); ?></option><?php endforeach; ?>
                        </select></label>
                </div>
                <label class="lp-form__field"><span>Tell us about the project</span>
                    <textarea name="message" data-tely-field="notes" rows="4"></textarea></label>
                <div hidden aria-hidden="true"><label>Website<input type="text" name="company_website" data-tely-field="website" tabindex="-1" autocomplete="off"></label></div>
                <div class="lp-form__actions">
                    <button type="submit" class="btn btn--theme-accent btn--cta-md relative">
                        <span class="btn__text-wr">Send request</span>
                        <span class="btn__glow absolute"></span>
                    </button>
                    <span class="lp-form__note">Senior engineer replies, not a bot. We never share your details.</span>
                </div>
                <p class="lp-form__status" data-tely-status role="status" aria-live="polite"><?php if (!$ready) echo 'Form unavailable. Please email info@neutech.co.'; ?></p>
                </fieldset>
                <noscript>Please email info@neutech.co; this form requires JavaScript.</noscript>
            </form>
        </div>
    </div>
</section>
<?php
// The common native SDK owns validation, physical retries and acknowledged success.
