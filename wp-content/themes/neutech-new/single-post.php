<?php
/**
 * The template for displaying all single posts
 */
use CleanTheme\Components\LinePost;

$header_args = array('theme' => 'light');
get_header(null, $header_args); 

while ( have_posts() ) :
    the_post();

    $post_id = $post->ID;
    $reading_time = get_field('time_to_read', $post_id);
    $categories = get_the_category();
    $main_cat   = !empty($categories) ? $categories[0] : null;
    $thumbnail  = get_the_post_thumbnail_url($post_id, 'mobile'); 
    $alt_text   = get_post_meta(get_post_thumbnail_id($post_id), '_wp_attachment_image_alt', true) ?: $title;
?>

<article class="post-page bg--white">
        
    <nav class="breadcrumbs fz-label post-page__breadcrumbs">
        <div class="container breadcrumbs__list o-hid">
            <a href="<?= get_post_type_archive_link('post'); ?>" class="breadcrumbs__link">Blog</a>
            <?php if ($main_cat) : ?>
                <span class="breadcrumbs__separator">></span>
                    <a href="<?= esc_url(get_category_link($main_cat->term_id)); ?>" class="breadcrumbs__link">
                        <?= esc_html($main_cat->name); ?>
                    </a>
            <?php endif; ?>
            <span class="breadcrumbs__separator">></span>
            <span class="breadcrumbs__current"><?php the_title(); ?></span>
        </div>
    </nav>
    <!-- ./end breadcrumbs -->

    <header class="container post-page__header d-grid <?php if (empty($thumbnail)):?>post-page__header--single<?php endif;?>">
        <?php if (!empty($thumbnail)):?>
            <div class="post-page__thumbnail o-hid w-full">
                <picture class="h-full">
                    <img src="<?= esc_url($thumbnail) ?>" alt="<?= $alt_text ?>" loading="lazy" width="392" height="280" class="cover-image">
                </picture>
            </div>
        <?php endif;?>

        <div class="post-page__intro">
            <?php if ($main_cat) : ?>
                <a class="post-page__cat cat fz-label" href="<?= esc_url(get_category_link($main_cat->term_id)); ?>"><?= esc_html($main_cat->name); ?></a>
            <?php endif; ?>

            <h1 class="post-page__title fz-h2"><?php the_title(); ?></h1>
            
            <?php if (has_excerpt()) : ?>
                <div class="post-page__excerpt">
                    <?php the_excerpt(); ?>
                </div>
            <?php endif; ?>

            <div class="post-page__meta flex-row j-between">
                <div class="post-page__details flex-row-wrap fz-label">
                    <span class="post-page__date"><?= get_the_date('M j, Y'); ?></span>
                    <?php if ($reading_time):?>
                        <span class="post-page__read-time"><?= $reading_time; ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="post-page__share flex-row">
                    <span class="post-page__share-label fz-title d-block">share:</span>
                    <ul class="post-page__share-list flex-row">
                        <li>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" rel="nofollow" class="post-page__share-link d-block">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="wh-full">
                                  <path fill-rule="evenodd" clip-rule="evenodd" d="M18.9355 4.00022C20.0343 3.99595 21.1331 4.05307 22.2256 4.17015V7.9846H19.9805C18.2085 7.9846 17.8643 8.83001 17.8643 10.0647V12.7903H22.0986L21.5508 17.0686H17.8643V27.9963H13.4482V17.0608H9.77734V12.7815H13.4404V9.64183C13.4404 5.99 15.6771 4.00041 18.9355 4.00022Z"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" target="_blank" rel="nofollow" class="post-page__share-link d-block">
                                <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.04876 7L13.7705 17.3247L6 25.7192H7.74884L14.5519 18.3697L20.0486 25.7192H26L17.8438 14.8137L25.0765 7H23.3277L17.0624 13.7687L12.0001 7H6.04876ZM8.62056 8.2882H11.3546L23.4278 24.4308H20.6937L8.62056 8.2882Z"/>
                                </svg>
                            </a>
                        </li>

                        <!-- <?php if (get_field('instagram_link', 'options')):?>
                        <li>
                            <a href="<?= get_field('instagram_link', 'options') ?>?igsh=NGVhN2U2NjQ0Yg%3D%3D&utm_source=qr" target="_blank" rel="nofollow" class="post-page__share-link d-block">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"  class="wh-full">
                                  <path d="M15.9785 4C19.2276 4 19.634 4.01639 20.915 4.07227C21.9093 4.09268 22.8932 4.28139 23.8242 4.63086C24.6198 4.93861 25.343 5.40863 25.9463 6.01172C26.5495 6.61476 27.0201 7.3374 27.3281 8.13281C27.6833 9.07654 27.8732 10.0748 27.8887 11.083C27.9632 12.3564 27.9629 12.7691 27.9629 16.0195C27.9629 19.2704 27.9459 19.6769 27.8887 20.957C27.8687 21.9521 27.6809 22.934 27.3311 23.8652C27.0226 24.6605 26.5514 25.3831 25.9482 25.9863C25.345 26.5895 24.6225 27.0607 23.8271 27.3691C22.896 27.718 21.9121 27.9065 20.918 27.9268C19.6473 27.9999 19.2307 28 15.9814 28C12.7322 28 12.3261 27.9826 11.0449 27.9268C10.0487 27.894 9.06477 27.6917 8.13672 27.3281C7.34121 27.0202 6.61905 26.5492 6.01562 25.9463C5.41211 25.3432 4.94039 24.6206 4.63184 23.8252C4.28199 22.8925 4.09418 21.9102 4.07422 20.915C3.99973 19.642 4 19.2276 4 15.9785C4 12.7279 4.017 12.322 4.07422 11.042C4.09367 10.0478 4.28227 9.06377 4.63184 8.13281C4.93951 7.3372 5.41039 6.6148 6.01367 6.01172C6.61703 5.40859 7.33993 4.93825 8.13574 4.63086C9.06556 4.28036 10.0485 4.09164 11.042 4.07227C12.3127 4.00041 12.7292 4 15.9785 4ZM15.9307 6.10645C12.6881 6.10645 12.3327 6.12248 11.0674 6.17969C10.309 6.19028 9.55797 6.33052 8.84668 6.59375C7.79678 6.99561 6.96445 7.82217 6.55859 8.87207C6.29348 9.59097 6.15413 10.35 6.14551 11.1162C6.07498 12.4056 6.07422 12.7376 6.07422 15.9805C6.07422 19.2216 6.08829 19.5787 6.14551 20.8428C6.15795 21.6009 6.2971 22.3518 6.55859 23.0635C6.7593 23.5819 7.06696 24.0522 7.46094 24.4443C7.85497 24.8365 8.3273 25.1416 8.84668 25.3398C9.55761 25.6043 10.3089 25.7446 11.0674 25.7539C12.3553 25.8271 12.6868 25.8271 15.9307 25.8271C19.1721 25.8271 19.5289 25.8125 20.793 25.7539C21.5519 25.7441 22.304 25.6039 23.0156 25.3398C23.5331 25.1403 24.0032 24.8344 24.3955 24.4424C24.7876 24.0504 25.0932 23.5807 25.293 23.0635C25.5582 22.344 25.6984 21.5841 25.707 20.8174V20.8184H25.7217C25.7789 19.5462 25.7793 19.1976 25.7793 15.9561C25.7793 12.7135 25.7642 12.358 25.707 11.0928C25.6946 10.3346 25.5545 9.58383 25.293 8.87207C25.0931 8.35471 24.7876 7.88443 24.3955 7.49219C24.0033 7.09996 23.533 6.79372 23.0156 6.59375C22.3042 6.32904 21.552 6.18882 20.793 6.17969C19.5063 6.10651 19.1734 6.10645 15.9307 6.10645ZM15.9717 9.81738C17.6036 9.81738 19.1693 10.4662 20.3232 11.6201C21.4769 12.774 22.125 14.339 22.125 15.9707C22.125 17.6024 21.4769 19.1674 20.3232 20.3213C19.1693 21.4752 17.6036 22.124 15.9717 22.124C14.3399 22.124 12.7749 21.4751 11.6211 20.3213C10.4673 19.1674 9.81934 17.6025 9.81934 15.9707C9.81935 14.3389 10.4673 12.774 11.6211 11.6201C12.7749 10.4663 14.3399 9.81746 15.9717 9.81738ZM15.9717 11.9717C14.9117 11.9718 13.8951 12.3931 13.1455 13.1426C12.3959 13.8922 11.9746 14.9096 11.9746 15.9697C11.9747 17.0298 12.3959 18.0463 13.1455 18.7959C13.8951 19.5455 14.9116 19.9667 15.9717 19.9668C17.0318 19.9668 18.0492 19.5455 18.7988 18.7959C19.5483 18.0463 19.9696 17.0297 19.9697 15.9697C19.9697 14.9096 19.5485 13.8922 18.7988 13.1426C18.0492 12.3929 17.0318 11.9717 15.9717 11.9717ZM22.3682 8.15723C23.1604 8.15723 23.8027 8.79956 23.8027 9.5918C23.8025 10.3839 23.1603 11.0264 22.3682 11.0264C21.5761 11.0263 20.9338 10.3838 20.9336 9.5918C20.9336 8.79963 21.576 8.15734 22.3682 8.15723Z"/>
                                </svg>
                            </a>
                        </li>
                        <?php endif;?> -->
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <div class="container post-page__container">
        <div class="post-page__content-wrapper d-grid">
            
            <div class="post-page__main-content entry-content">
                <?php the_content(); ?>
                
            </div>

            <aside class="post-page__sidebar">
                <div class="related-articles flex-col">
                    <h3 class="related-articles__title">Similar articles</h3>
                    
                    <?php

                    $current_post_id = get_the_ID();

                    $related_args = array(
                        'post_type'      => 'post',
                        'posts_per_page' => 4,
                        'post__not_in'   => array($current_post_id),
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                        'ignore_sticky_posts' => true,
                    );

                    $related_query = new WP_Query($related_args);

                    if ($related_query->have_posts()) :
                        while ($related_query->have_posts()) : $related_query->the_post(); ?>
                            <?= LinePost::render('related-articles__item', get_post()); ?>
                           
                        <?php endwhile;
                        wp_reset_postdata();
                    endif; ?>
                </div>
            </aside>

        </div>
    </div>
</article>

<?php 
endwhile; // End of the loop.
get_footer(); 
?>