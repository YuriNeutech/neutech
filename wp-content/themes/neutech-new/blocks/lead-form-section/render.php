<?php
/**
 * Block Name: Lead Form Section
 * Submits to admin-ajax action 'neutech_lead' (handler in inc/template-helpers.php).
 */
if ( ! empty( $block['data']['_is_inserter_preview'] ) ) {
    neutech_block_preview( 'Lead Form Section', 'Dark "get a quote" band with an async lead-capture form.' );
    return;
}

$eyebrow = get_field( 'eyebrow' );
$title   = get_field( 'title' );
$intro   = get_field( 'intro' );

// Options: one project type per line.
$raw  = get_field( 'options' );
$opts = $raw ? array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', $raw ) ) ) ) : [];
if ( empty( $opts ) ) {
    $opts = [ 'Custom software', 'Healthcare software', 'Web app', 'Mobile app', 'Staff augmentation', 'Something else' ];
}

$className = 'lp-section lp-section--dark lp-form';
if ( ! empty( $block['className'] ) ) { $className .= ' ' . $block['className']; }
$id   = ! empty( $block['anchor'] ) ? $block['anchor'] : '';
$ajax = esc_url( admin_url( 'admin-ajax.php' ) );
?>
<section <?php if ( $id ) echo 'id="' . esc_attr( $id ) . '"'; ?> class="<?= esc_attr( $className ); ?>" data-header-theme="dark">
    <div class="lp-cta__glow absolute"></div>
    <div class="container">
        <div class="lp-form__grid">
            <div class="lp-form__intro">
                <?php if ( $eyebrow ): ?><span class="lp-eyebrow"><?= esc_html( $eyebrow ); ?></span><?php endif; ?>
                <h2 class="lp-title"><?= esc_html( $title ?: 'Get a quote' ); ?></h2>
                <?php if ( $intro ): ?><p class="lp-intro"><?= esc_html( $intro ); ?></p><?php endif; ?>
            </div>

            <form class="lp-form__form" action="<?= $ajax; ?>" method="post" novalidate>
                <input type="hidden" name="action" value="neutech_lead">
                <?php wp_nonce_field( 'neutech_lead', 'neutech_lead_nonce' ); ?>
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
                            <?php foreach ( $opts as $o ): ?><option value="<?= esc_attr( $o ); ?>"><?= esc_html( $o ); ?></option><?php endforeach; ?>
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
