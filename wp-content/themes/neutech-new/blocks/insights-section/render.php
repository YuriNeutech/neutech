<?php
/**
 * Block Name: Insights Section
 * Dynamically pulls recent posts from the chosen categories.
 */
if ( ! empty( $block['data']['_is_inserter_preview'] ) ) {
    neutech_block_preview( 'Insights Section', 'Auto-pulls recent posts from chosen categories as cards.' );
    return;
}

$eyebrow  = get_field( 'eyebrow' );
$title    = get_field( 'title' );
$intro    = get_field( 'intro' );
$count    = (int) ( get_field( 'count' ) ?: 3 );
$cat_ids  = get_field( 'categories' ) ?: [];
$all_link = get_field( 'all_link' );

$args = [
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => $count,
    'ignore_sticky_posts' => true,
    'no_found_rows'       => true,
];
if ( ! empty( $cat_ids ) ) {
    $args['category__in'] = array_map( 'intval', (array) $cat_ids );
}

$q = new WP_Query( $args );
if ( ! $q->have_posts() ) { wp_reset_postdata(); return; }

$className = 'lp-section lp-section--light';
if ( ! empty( $block['className'] ) ) { $className .= ' ' . $block['className']; }
$id = ! empty( $block['anchor'] ) ? $block['anchor'] : '';
?>
<section <?php if ( $id ) echo 'id="' . esc_attr( $id ) . '"'; ?> class="<?= esc_attr( $className ); ?>">
    <div class="container">
        <div class="lp-head">
            <span class="lp-eyebrow"><?= esc_html( $eyebrow ?: 'From the blog' ); ?></span>
            <h2 class="lp-title"><?= esc_html( $title ?: 'Insights & guides' ); ?></h2>
            <?php if ( $intro ): ?><p class="lp-intro"><?= esc_html( $intro ); ?></p><?php endif; ?>
        </div>

        <div class="lp-cards">
            <?php while ( $q->have_posts() ): $q->the_post();
                $cats = get_the_category();
                $cat  = ! empty( $cats ) ? $cats[0]->name : '';
            ?>
            <a class="lp-cards__item" href="<?= esc_url( get_permalink() ); ?>">
                <?php if ( $cat ): ?><span class="lp-cards__eyebrow"><?= esc_html( $cat ); ?></span><?php endif; ?>
                <h3 class="lp-cards__title"><?= esc_html( get_the_title() ); ?></h3>
                <p class="lp-cards__text"><?= esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
                <span class="lp-cards__meta"><?= esc_html( get_the_date( 'M j, Y' ) ); ?></span>
                <span class="lp-cards__arrow"><?= neutech_arrow_svg(); ?></span>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <?php if ( ! empty( $all_link['url'] ) ): ?>
        <div class="lp-posts__all">
            <?php neutech_link_button( $all_link, 'black-border', 'Read more insights' ); ?>
        </div>
        <?php endif; ?>
    </div>
</section>
