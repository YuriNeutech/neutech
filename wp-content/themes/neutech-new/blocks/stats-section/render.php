<?php
/**
 * Block Name: Stats Section
 */
if ( ! empty( $block['data']['_is_inserter_preview'] ) ) {
    neutech_block_preview( 'Stats Section', 'Dark strip of stat figures with labels.' );
    return;
}

$title = get_field( 'title' );
$items = get_field( 'items' ) ?: [];

$className = 'lp-section lp-section--dark lp-stats';
if ( ! empty( $block['className'] ) ) { $className .= ' ' . $block['className']; }
$id = ! empty( $block['anchor'] ) ? $block['anchor'] : '';
?>
<section <?php if ( $id ) echo 'id="' . esc_attr( $id ) . '"'; ?> class="<?= esc_attr( $className ); ?>" data-header-theme="dark">
    <div class="container">
        <?php if ( $title ): ?>
        <div class="lp-head"><h2 class="lp-title"><?= esc_html( $title ); ?></h2></div>
        <?php endif; ?>
        <div class="lp-stats__grid">
            <?php foreach ( $items as $it ): ?>
            <div class="lp-stats__item">
                <div class="lp-stats__num"><?= esc_html( $it['num'] ?? '' ); ?></div>
                <div class="lp-stats__label"><?= esc_html( $it['label'] ?? '' ); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
