<?php
namespace CleanTheme\Components;

class LinePost {
    public static function render($parent_class = null, $post = null) {
        if (empty($post)) {
            return;
        }

        $post_id = is_object($post) ? $post->ID : $post;
        $read_label   = get_field('time_to_read', $post_id);
        ?>

        <article class="<?= $parent_class ?> line-post">
            <div class="line-post__meta flex-row-wrap fz-label">
                <span class="line-post__date"><?= get_the_date('M j, Y', $post_id) ?></span>
                <span class="line-post__read-time"><?php echo esc_html($read_label); ?></span>
            </div>
            <h4 class="line-post__title fz-title">
                <a href="<?= get_permalink($post_id) ?>"><?= get_the_title($post_id) ?></a>
            </h4>
        </article>
        <?php
    }
}