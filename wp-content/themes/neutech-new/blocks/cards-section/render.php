<?php
/**
 * Block Name: Cards Section
 */
if ( ! empty( $block['data']['_is_inserter_preview'] ) ) {
    neutech_block_preview( 'Cards Section', 'Grid of 2–3 column cards, each optionally linked with a hover arrow.' );
    return;
}

$theme   = get_field( 'theme' ) ?: 'light';
$eyebrow = get_field( 'eyebrow' );
$title   = get_field( 'title' );
$intro   = get_field( 'intro' );
$center  = get_field( 'center' );
$columns = get_field( 'columns' ) ?: 3;
$items   = get_field( 'items' ) ?: [];

$className = 'lp-section lp-section--' . $theme;
if ( ! empty( $block['className'] ) ) { $className .= ' ' . $block['className']; }
$id = ! empty( $block['anchor'] ) ? $block['anchor'] : '';

$grid_class = 'lp-cards' . ( (int) $columns === 2 ? ' lp-cards--2' : '' );
$head_class = 'lp-head' . ( $center ? ' lp-head--center' : '' );
?>
<section <?php if ( $id ) echo 'id="' . esc_attr( $id ) . '"'; ?> class="<?= esc_attr( $className ); ?>">
    <div class="container">
        <?php if ( $title ): ?>
        <div class="<?= esc_attr( $head_class ); ?>">
            <?php if ( $eyebrow ): ?><span class="lp-eyebrow"><?= esc_html( $eyebrow ); ?></span><?php endif; ?>
            <h2 class="lp-title"><?= esc_html( $title ); ?></h2>
            <?php if ( $intro ): ?><p class="lp-intro"><?= esc_html( $intro ); ?></p><?php endif; ?>
        </div>
        <?php endif; ?>

        <div class="<?= esc_attr( $grid_class ); ?>">
            <?php foreach ( $items as $it ):
                $link  = $it['item_link'] ?? [];
                $url   = ! empty( $link['url'] ) ? $link['url'] : '';
                $tag   = $url ? 'a' : 'div';
                $tgt   = ( $url && ! empty( $link['target'] ) ) ? ' target="' . esc_attr( $link['target'] ) . '"' : '';
                $href  = $url ? ' href="' . esc_url( $url ) . '"' : '';
            ?>
            <<?= $tag; ?> class="lp-cards__item"<?= $href . $tgt; ?>>
                <?php if ( ! empty( $it['item_eyebrow'] ) ): ?><span class="lp-cards__eyebrow"><?= esc_html( $it['item_eyebrow'] ); ?></span><?php endif; ?>
                <h3 class="lp-cards__title"><?= esc_html( $it['item_title'] ?? '' ); ?></h3>
                <?php if ( ! empty( $it['item_text'] ) ): ?><p class="lp-cards__text"><?= esc_html( $it['item_text'] ); ?></p><?php endif; ?>
                <?php if ( ! empty( $it['item_meta'] ) ): ?><span class="lp-cards__meta"><?= esc_html( $it['item_meta'] ); ?></span><?php endif; ?>
                <?php if ( $url ): ?><span class="lp-cards__arrow"><?= neutech_arrow_svg(); ?></span><?php endif; ?>
            </<?= $tag; ?>>
            <?php endforeach; ?>
        </div>
    </div>
</section>
