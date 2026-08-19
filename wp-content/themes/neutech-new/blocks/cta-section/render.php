<?php
/**
 * Block Name: CTA Band
 */
if ( ! empty( $block['data']['_is_inserter_preview'] ) ) {
    neutech_block_preview( 'CTA Band', 'Dark centered closer with heading, text and two buttons.' );
    return;
}

$title     = get_field( 'title' );
$text      = get_field( 'text' );
$primary   = get_field( 'primary_button' );
$secondary = get_field( 'secondary_button' );

$className = 'lp-section lp-cta';
if ( ! empty( $block['className'] ) ) { $className .= ' ' . $block['className']; }
$id = ! empty( $block['anchor'] ) ? $block['anchor'] : '';
?>
<section <?php if ( $id ) echo 'id="' . esc_attr( $id ) . '"'; ?> class="<?= esc_attr( $className ); ?>" data-header-theme="dark">
    <div class="lp-cta__glow absolute"></div>
    <div class="container">
        <div class="lp-cta__inner">
            <h2 class="lp-cta__title"><?= esc_html( $title ?? '' ); ?></h2>
            <?php if ( $text ): ?><p class="lp-cta__text"><?= esc_html( $text ); ?></p><?php endif; ?>
            <div class="lp-cta__actions">
                <?php
                neutech_link_button( $primary, 'accent', 'Get a quote' );
                neutech_link_button( $secondary, 'white-border', 'See our work' );
                ?>
            </div>
        </div>
    </div>
</section>
