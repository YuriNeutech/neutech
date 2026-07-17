<?php
/**
 * Blog cluster ("Insights") for a pillar page. $args:
 *   categories (array of category slugs), eyebrow, title, intro, count, all_url
 * Queries recent posts in the given categories and renders them as cards.
 */
$a = $args ?? [];
$cats = $a['categories'] ?? [];
if (empty($cats)) return;

$q = new WP_Query([
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => $a['count'] ?? 3,
    'category_name'       => implode(',', $cats),
    'ignore_sticky_posts' => true,
    'no_found_rows'       => true,
]);
if (!$q->have_posts()) { wp_reset_postdata(); return; }
?>
<section class="lp-section lp-section--light">
    <div class="container">
        <div class="lp-head">
            <span class="lp-eyebrow"><?= esc_html($a['eyebrow'] ?? 'From the blog'); ?></span>
            <h2 class="lp-title"><?= esc_html($a['title'] ?? 'Insights & guides'); ?></h2>
            <?php if (!empty($a['intro'])): ?><p class="lp-intro"><?= esc_html($a['intro']); ?></p><?php endif; ?>
        </div>

        <div class="lp-cards">
            <?php while ($q->have_posts()): $q->the_post();
                $cat = get_the_category(); $cat = !empty($cat) ? $cat[0]->name : '';
            ?>
            <a class="lp-cards__item" href="<?= esc_url(get_permalink()); ?>">
                <?php if ($cat): ?><span class="lp-cards__eyebrow"><?= esc_html($cat); ?></span><?php endif; ?>
                <h3 class="lp-cards__title"><?= esc_html(get_the_title()); ?></h3>
                <p class="lp-cards__text"><?= esc_html(wp_trim_words(get_the_excerpt(), 22)); ?></p>
                <span class="lp-cards__meta"><?= esc_html(get_the_date('M j, Y')); ?></span>
                <span class="lp-cards__arrow"><?= neutech_arrow_svg(); ?></span>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <?php if (!empty($a['all_url'])): ?>
        <div class="lp-posts__all">
            <?php neutech_button($a['all_url'], 'Read more insights', 'black-border'); ?>
        </div>
        <?php endif; ?>
    </div>
</section>
