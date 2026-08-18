<?php
    $copyright = get_field('copyright', 'option') ?? null;

    $title = get_field('footer_title', 'option') ?: 'Default Title';

    $allowed_html = [
        'em' => ['class' => []], 
        'strong' => [],
        'span'   => [
            'class' => []
        ],
        'br'     => [
            'class' => []
        ]
    ];

    if ($title) {
        $title = wpautop($title);

        $title = str_replace('<p>', '<span class="footer__word-new-p">', $title);
        $title = str_replace('</p>', '</span>', $title);
        $title = preg_replace('/<br\s*\/?>/i', '<br class="footer__word-new-line">', $title);
    }

    $cta = get_field('footer_cta', 'option');
    $cta_title = null;
    $cta_link = null;
    $cta_target = null;

    if (is_array($cta) && !empty($cta)) {
        $cta_title = esc_html($cta['title']);
        $cta_link = esc_url($cta['url']);
        $cta_target = 'target="' . esc_attr($cta['target']) . '"';
    }

    $contacts = get_field('contacts', 'option');
?>
        </main>
        <footer class="footer relative">
            <div class="footer__bg-effects absolute">
                <div class="footer__blur-bg absolute"></div>

                <div class="footer__particles">
                    <div class="footer__particle bg-dot" style="top: 85%; left: 2.3rem; opacity: 1;  filter: blur(6px);"></div>
                    <div class="footer__particle bg-dot" style="top: 10%; left: 80%; filter: blur(6px);"></div>
                    <div class="footer__particle bg-dot" style="top: 60%; left: 15%; width: 1.2rem; hegiht: 1.2rem; filter: blur(4px);"></div>
                    <div class="footer__particle bg-dot" style="top: 10%; left: 70%; opacity: 0.5; scale: 2; filter: blur(5px);"></div>
                    <div class="footer__particle bg-dot" style="top: 45%; left: 22%; scale: 0.7; filter: blur(6px);"></div>
                    <div class="footer__particle bg-dot" style="top: 40%; left: 70%; opacity: 0.5; scale: 2; filter: blur(5px);"></div>
                    <div class="footer__particle bg-dot" style="top: 15%; left: 60%; scale: 0.7; filter: blur(6px);"></div>
                </div>
            </div>

            <div class="container footer__container">
                <div class="footer__block footer__block--title">
                    <?php if ($title): ?>
                        <h4 class="footer__title split-text-target h1">
                            <?php echo wp_kses($title, $allowed_html); ?>
                        </h4>
                    <?php endif; ?>
                </div>
                <div class="footer__block">
                    <a href="<?=  $cta_link ?>" class="footer__cta-btn btn btn--theme-accent btn--cta-md relative" <?= $cta_target ?>>
                        <span class="btn__text-wr"><?=  $cta_title ?></span>
                        <span class="btn__icon-wr flex-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" id="Brand-Superhuman--Streamline-Tabler" height="24" width="24">
                              <path d="m16 12 4 3 -8 7 -8 -7 4 -3" stroke-width="2"/>
                              <path d="M12 3 4 9l8 6 8 -6z" stroke-width="2"/>
                              <path d="M12 15h8" stroke-width="2"/>
                            </svg>
                        </span>

                        <span class="btn__glow absolute"></span>
                    </a>
                </div>
                <div class="footer__block footer__block--nav footer-nav">
                    <div class="footer-nav__col">
                        <span class="footer-nav__head">Solutions</span>
                        <a href="<?= esc_url(home_url('/services/custom-software-development/')); ?>">Custom Software</a>
                        <a href="<?= esc_url(home_url('/services/staff-augmentation/')); ?>">Staff Augmentation</a>
                        <a href="<?= esc_url(home_url('/services/web-application-development/')); ?>">Web Apps</a>
                        <a href="<?= esc_url(home_url('/services/mobile-app-development/')); ?>">Mobile Apps</a>
                        <a href="<?= esc_url(home_url('/services/ai-ml-data/')); ?>">AI/ML &amp; Data</a>
                        <a href="<?= esc_url(home_url('/services/')); ?>">All solutions</a>
                    </div>
                    <div class="footer-nav__col">
                        <span class="footer-nav__head">Industries</span>
                        <a href="<?= esc_url(home_url('/industries/healthcare-software-development/')); ?>">Healthcare Software</a>
                        <a href="<?= esc_url(home_url('/industries/fintech-software-development/')); ?>">Fintech Software</a>
                        <a href="<?= esc_url(home_url('/hipaa-security/')); ?>">HIPAA &amp; Security</a>
                        <a href="<?= esc_url(home_url('/work/')); ?>">Our Work</a>
                    </div>
                    <div class="footer-nav__col">
                        <span class="footer-nav__head">Company</span>
                        <a href="<?= esc_url(home_url('/our-team/')); ?>">About &amp; Team</a>
                        <a href="<?= esc_url(home_url('/how-we-work/')); ?>">How We Work</a>
                        <a href="<?= esc_url(home_url('/pricing/')); ?>">Pricing</a>
                        <a href="<?= esc_url(home_url('/get-a-quote/')); ?>">Get a Quote</a>
                    </div>
                    <div class="footer-nav__col">
                        <span class="footer-nav__head">Why Neutech</span>
                        <a href="<?= esc_url(home_url('/residency-program/')); ?>">Residency Program</a>
                        <a href="<?= esc_url(home_url('/senior-level-redefined/')); ?>">Senior Level Redefined</a>
                        <a href="<?= esc_url(home_url('/where-we-specialize/')); ?>">Where We Specialize</a>
                        <a href="<?= esc_url(home_url('/the-neutech-wave/')); ?>">The Neutech Wave</a>
                        <a href="<?= esc_url(home_url('/month-to-month-flexibility/')); ?>">Month-to-Month Flexibility</a>
                        <a href="<?= esc_url(home_url('/the-neutech-office/')); ?>">The Neutech Office</a>
                    </div>
                    <div class="footer-nav__col">
                        <span class="footer-nav__head">Resources</span>
                        <a href="<?= esc_url(home_url('/blog/')); ?>">Blog</a>
                        <?php // /resources/ was unpublished (markup #5) — it advertised downloads that did not exist. ?>
                        <a href="<?= esc_url(home_url('/guides/staff-augmentation-vs-managed-services/')); ?>">Comparison Guides</a>
                    </div>
                </div>
                <div class="footer__block footer__block--contacts">
                        <?php
                            if (is_array($contacts) && !empty($contacts)):
                                foreach ($contacts as $contact_row):
                        ?>
                        <div class="footer__block--row">
                            <?php
                                if (is_array($contact_row['contact_row']) && !empty($contact_row['contact_row'])):
                                    foreach ($contact_row['contact_row'] as $contact_item):
                                        $contact_item_is_link = $contact_item['is_link'];
                            ?>
                                <?php if (is_array($contact_item['contact_link']) && !empty($contact_item_is_link)): ?>
                                    <a href="<?=  $contact_item['contact_link']['url'] ?>" class="footer__contact-item fz-h3" target="<?=  $contact_item['contact_link']['target'] ?>"><?=  $contact_item['contact_link']['title'] ?></a>
                                <?php else: ?>
                                    <span class="footer__contact-item fz-h3"><?=  $contact_item['contact_text'] ?></span>
                                <?php endif ?>
                            <?php endforeach; endif; ?>
                        </div>
                        <?php endforeach; endif; ?>
                </div>
                <!-- /.footer__block footer__block--contacts -->
                <div class="footer__block footer__block--copiright fz-nav"><?php echo date( 'Y' ); ?>. <?=  esc_html($copyright) ?></div>
            </div>
            <!-- /.container footer__contianer -->
        </footer>
        <!-- /.footer -->

    </div>
    <?php wp_footer(); ?>

    </body>
</html>