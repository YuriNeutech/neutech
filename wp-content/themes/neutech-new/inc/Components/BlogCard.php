<?php
namespace CleanTheme\Components;

class BlogCard
{
    public static function render($parent_class = null, $post = null, $type = 'sm')
    {
        if (empty($post)) {
            return;
        }


        $post_id    = is_object($post) ? $post->ID : $post;
        $title      = get_the_title($post_id);
        $permalink  = get_permalink($post_id);
        $thumbnail = get_the_post_thumbnail_url($post_id, 'large');

        if ( ! $thumbnail ) {
            $placeholder = get_field('thumbnail_placeholder', 'option');
            $thumbnail = ( is_array($placeholder) && !empty($placeholder['url']) ) 
                ? $placeholder['url'] 
                : 'absolute-default-image.jpg';
        }

        $thumbnail_id = get_post_thumbnail_id($post_id);
        $alt_text     = '';

        if ( $thumbnail_id ) {
            $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
        }

        if ( empty($alt_text) ) {
            $alt_text = $title;
        }

        $categories = get_the_category($post_id);
        $category_name = !empty($categories) ? $categories[0]->name : '';

        $reading_time = get_field('time_to_read', $post_id);

        $class_name = trim($parent_class . ' relative blog-card ' . 'blog-card--type_' . $type);
        ?>

        <article class="<?= esc_attr($class_name) ?>">
            <div class="blog-card__preview-img relative o-hid">
                <picture class="absolute wh-full inset">
                    <img src="<?= esc_url($thumbnail) ?>" alt="<?= esc_attr($alt_text) ?>" loading="lazy" class="cover-image" width="392" height="277">
                </picture>              
            </div>

            <div class="blog-card__content w-full">
                <?php if ($category_name) : ?>
                    <span class="cat fz-label blog-card__cat"><?= esc_html($category_name) ?></span>
                <?php endif; ?>

                <a href="<?= esc_url($permalink) ?>" class="d-block blog-card__title <?php if ($type == 'lg'):?>fz-h3<?php else:?>fz-title<?php endif;?>">
                    <h3><?= esc_html($title) ?></h3>
                </a>

                <?php if ($type == 'lg'):?>
                <div class="blog-card__excerpt">
                    <?= wp_trim_words(get_the_excerpt($post_id), 20, '...') ?>
                </div>
                <?php endif;?>

                <div class="blog-card__footer fz-label flex-row j-between">
                    <div class="blog-card__features flex-row-wrap">
                        <span class="blog-card__date"><?= get_the_date('M d, Y', $post_id) ?></span>
                        <span class="blog-card__time-to-read"><?= esc_html($reading_time) ?></span>
                    </div>

                    <?php if ($type == 'sm'): ?>
                        <a href="<?= esc_url($permalink) ?>" class="btn flex-row btn--arrow-pointer btn--theme-black-border blog-card__btn-link btn--ripple" data-animate-ripple>
                            <span>read more</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 19" fill="none">
                                <path d="M1.00053 17.9707L17.9711 1.00018M17.9711 1.00018H8.0716M17.9711 1.00018V10.8997" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <a href="<?= esc_url($permalink) ?>" class="blog-card__hidden-url absolute wh-full d-block inset" aria-hidden="true"><?= esc_html($title) ?></a>
        </article>
        <?php
    }
}