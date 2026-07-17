<?php
/**
 * Quote / contact form section. $args: eyebrow, title, intro, options[] (project types)
 * Submits to admin-ajax action 'neutech_lead' (handled in inc/NewsletterHandler-style hook).
 */
$a = $args ?? [];
$opts = $a['options'] ?? ['Custom software', 'Healthcare software', 'Web app', 'Mobile app', 'Staff augmentation', 'Something else'];
$ajax = esc_url(admin_url('admin-ajax.php'));
?>
<section class="lp-section lp-section--dark lp-form" data-header-theme="dark">
    <div class="lp-cta__glow absolute"></div>
    <div class="container">
        <div class="lp-form__grid">
            <div class="lp-form__intro">
                <?php if (!empty($a['eyebrow'])): ?><span class="lp-eyebrow"><?= esc_html($a['eyebrow']); ?></span><?php endif; ?>
                <h2 class="lp-title"><?= esc_html($a['title'] ?? 'Get a quote'); ?></h2>
                <?php if (!empty($a['intro'])): ?><p class="lp-intro"><?= esc_html($a['intro']); ?></p><?php endif; ?>
            </div>

            <form class="lp-form__form" action="<?= $ajax; ?>" method="post" novalidate>
                <input type="hidden" name="action" value="neutech_lead">
                <?php if (function_exists('wp_nonce_field')) wp_nonce_field('neutech_lead', 'neutech_lead_nonce'); ?>
                <div class="lp-form__row">
                    <label class="lp-form__field"><span>Name</span>
                        <input type="text" name="name" required autocomplete="name"></label>
                    <label class="lp-form__field"><span>Work email</span>
                        <input type="email" name="email" required autocomplete="email"></label>
                </div>
                <div class="lp-form__row">
                    <label class="lp-form__field"><span>Company</span>
                        <input type="text" name="company" autocomplete="organization"></label>
                    <label class="lp-form__field"><span>What do you need?</span>
                        <select name="project_type">
                            <?php foreach ($opts as $o): ?><option value="<?= esc_attr($o); ?>"><?= esc_html($o); ?></option><?php endforeach; ?>
                        </select></label>
                </div>
                <label class="lp-form__field"><span>Tell us about the project</span>
                    <textarea name="message" rows="4"></textarea></label>
                <div class="lp-form__actions">
                    <button type="submit" class="btn btn--theme-accent btn--cta-md relative">
                        <span class="btn__text-wr">Send request</span>
                        <span class="btn__glow absolute"></span>
                    </button>
                    <span class="lp-form__note">Senior engineer replies, not a bot. We never share your details.</span>
                </div>
                <p class="lp-form__status" role="status" aria-live="polite"></p>
            </form>
        </div>
    </div>
</section>
<?php
// Async submit is handled globally by blocks/lead-form-section/script.js
// (loaded via app.js), which targets the same .lp-form__form markup.
