<?php
/**
 * Block Name: Rich Text Section
 */
if ( ! empty( $block['data']['_is_inserter_preview'] ) ) {
    neutech_block_preview( 'Rich Text Section', 'Eyebrow, heading and formatted body copy.' );
    return;
}

$theme   = get_field( 'theme' ) ?: 'white';
$eyebrow = get_field( 'eyebrow' );
$title   = get_field( 'title' );
$body    = get_field( 'body' );

$className = 'lp-section lp-section--' . $theme . ' lp-rich';
if ( ! empty( $block['className'] ) ) { $className .= ' ' . $block['className']; }
$id = ! empty( $block['anchor'] ) ? $block['anchor'] : '';
?>
<section <?php if ( $id ) echo 'id="' . esc_attr( $id ) . '"'; ?> class="<?= esc_attr( $className ); ?>">
    <div class="container">
        <?php if ( $title || $eyebrow ): ?>
        <div class="lp-head">
            <?php if ( $eyebrow ): ?><span class="lp-eyebrow"><?= esc_html( $eyebrow ); ?></span><?php endif; ?>
            <?php if ( $title ): ?><h2 class="lp-title"><?= esc_html( $title ); ?></h2><?php endif; ?>
        </div>
        <?php endif; ?>
        <div class="lp-rich__body"><?= wp_kses_post( $body ?? '' ); ?></div>
    </div>
</section>
