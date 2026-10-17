<?php
namespace CleanTheme\Components;

class NewsletterBlock {
    public static function render($parent_class = null) {
        $connections = get_option('tely_cta_connections', []);
        $connection = is_array($connections) ? ($connections['newsletter'] ?? []) : [];
        $ready = is_array($connection) && !empty($connection['definition']['newsletter'])
            && \neutech_tely_form_ready($connection);
        ?>
        
        <div class="blog-newsletter bg--action o-hid <?= $parent_class ?>">
            <div class="blog-newsletter__inner bg--accent">
                <h3 class="blog-newsletter__title fz-h2"><?= get_field('newsletter_title', 'option') ?></h3>
                <p class="blog-newsletter__text"><?= get_field('newsletter_subtitle', 'option') ?></p>
                <form class="blog-newsletter__form" method="post" onsubmit="return false;" data-tely-cta="native"
                      data-tely-context-url="<?= esc_url($ready ? $connection['contextUrl'] : ''); ?>"
                      data-tely-submissions-url="<?= esc_url($ready ? $connection['submissionsUrl'] : ''); ?>">
                    <fieldset disabled data-tely-pending style="border:0;padding:0;margin:0;min-width:0;display:contents">
                    <label class="sr-only" for="newsletter-email">Email</label>
                    <input type="email" placeholder="Your email" id="newsletter-email" name="email" data-tely-field="email" required autocomplete="email" class="blog-newsletter__field w-full">
                    <button type="submit" class="btn btn--theme-white-border btn--arrow-pointer flex-row blog-newsletter__btn w-full btn--ripple" data-animate-ripple>
                        <span>Subscribe now</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 19" fill="none">
                            <path d="M1.00053 17.9707L17.9711 1.00018M17.9711 1.00018H8.0716M17.9711 1.00018V10.8997" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <p data-tely-status role="status" aria-live="polite"><?php if (!$ready) echo 'Newsletter unavailable. Please email info@neutech.co.'; ?></p>
                    </fieldset>
                    <noscript>This form requires JavaScript. Please email info@neutech.co.</noscript>
                </form>
            </div>
        </div>

        <?php
    }
}
