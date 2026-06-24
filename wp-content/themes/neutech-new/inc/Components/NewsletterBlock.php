<?php
namespace CleanTheme\Components;

class NewsletterBlock {
    public static function render($parent_class = null) {
        ?>
        
        <div class="blog-newsletter bg--action o-hid <?= $parent_class ?>">
            <div class="blog-newsletter__inner bg--accent">
                <h3 class="blog-newsletter__title fz-h2"><?= get_field('newsletter_title', 'option') ?></h3>
                <p class="blog-newsletter__text"><?= get_field('newsletter_subtitle', 'option') ?></p>
                <form id="custom-beehiiv-form" class="blog-newsletter__form" data-form-id="1">
                    <input type="email" placeholder="Your email" id="email" name="newletter_email" required class="blog-newsletter__field w-full">
                    <button type="submit" class="btn btn--theme-white-border btn--arrow-pointer flex-row blog-newsletter__btn w-full btn--ripple" data-animate-ripple>
                        <span>Subscribe now</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 19" fill="none">
                            <path d="M1.00053 17.9707L17.9711 1.00018M17.9711 1.00018H8.0716M17.9711 1.00018V10.8997" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </form>
                
                <div id="form-message" class="blog-newsletter__success fz-title">
                    Thanks for subscribing!
                </div>
            </div>
        </div>

        <?php
    }
}