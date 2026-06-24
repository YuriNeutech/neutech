<?php
/**
 * home.php - Головна сторінка блогу
 */

use CleanTheme\Components\BlogCard;
use CleanTheme\Components\NewsletterBlock;


$blog_url = get_post_type_archive_link('post');

$header_args = array('theme' => 'light');
get_header(null, $header_args); 

$get_cat    = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';
$get_search = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';
$is_filtered = !empty($get_cat) || !empty($get_search);
?>

<section class="blog-page bg--white" data-header-theme="light">
    <div class="container blog-page__container">

        <div class="blog-page__content d-grid  <?php if ($get_search):?> blog-page__content--search<?php endif; ?>">
           
            <h1 class="blog-page__title fz-h1"><?php if ($get_search):?>Results for: <?= $get_search ?><?php else:?>Blog<?php endif;?></h1>
            
            <div class="blog-page__search">
                <form role="search" method="get" class="relative search-form" action="<?= esc_url($blog_url); ?>">
                    <input type="search" class="search-form__field w-full" 
                           placeholder="Search insights by topic..." 
                           value="<?= esc_attr($get_search); ?>" name="search" />
                    <button type="submit" class="btn search-form__submit absolute">
                        <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="wh-full">
                            <path d="M7.04758 12.3477C8.29907 13.7656 10.1301 14.6599 12.17 14.6599C15.9421 14.6599 19 11.602 19 7.82995C19 4.05787 15.9421 1 12.17 1C8.39797 1 5.34009 4.05787 5.34009 7.82995C5.34009 9.56211 5.9849 11.1437 7.04758 12.3477ZM7.04758 12.3477L1 18.3952" stroke-width="2"/>
                        </svg>
                    </button>
                </form>
            </div>

            <?php
                $exclude_id = [];
                if (!$is_filtered) :
                    $sticky = get_option('sticky_posts');
                    $s_args = [
                        'posts_per_page'      => 1,
                        'post__in'            => $sticky,
                        'ignore_sticky_posts' => 1,
                    ];
                    if (empty($sticky)) $s_args = ['posts_per_page' => 1];

                    $sticky_query = new WP_Query($s_args);
                    if ($sticky_query->have_posts()) :?>
                    <div class="blog-page__sticky-post">
                        <?php
                        while ($sticky_query->have_posts()) : $sticky_query->the_post();
                            BlogCard::render('blog-page__featured', get_post(), 'lg');
                            $exclude_id[] = get_the_ID();
                        endwhile;
                        wp_reset_postdata();?>
                    </div>
                    <?php endif;
                endif;
            ?>

            <div class="blog-page__cats">
                <div class="custom-select category-select relative">
                    <div class="custom-select__heading d-flex j-between category-select__heading">
                        <div class="category-select__title flex-row fz-title">
                            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13 17C14.1046 17 15 17.8954 15 19V25C15 26.0357 14.2128 26.887 13.2041 26.9893L13 27H7L6.7959 26.9893C5.85435 26.8938 5.1062 26.1457 5.01074 25.2041L5 25V19C5 17.8954 5.89543 17 7 17H13ZM25 17C26.1046 17 27 17.8954 27 19V25C27 26.0357 26.2128 26.887 25.2041 26.9893L25 27H19L18.7959 26.9893C17.8543 26.8938 17.1062 26.1457 17.0107 25.2041L17 25V19C17 17.8954 17.8954 17 19 17H25ZM19 25H25V19H19V25ZM7 25H13V19H7V25ZM13 5C14.1046 5 15 5.89543 15 7V13C15 14.0357 14.2128 14.887 13.2041 14.9893L13 15H7L6.7959 14.9893C5.85435 14.8938 5.1062 14.1457 5.01074 13.2041L5 13V7C5 5.89543 5.89543 5 7 5H13ZM25 5C26.1046 5 27 5.89543 27 7V13C27 14.0357 26.2128 14.887 25.2041 14.9893L25 15H19L18.7959 14.9893C17.8543 14.8938 17.1062 14.1457 17.0107 13.2041L17 13V7C17 5.89543 17.8954 5 19 5H25ZM7 13H13V7H7V13ZM19 13H25V7H19V13Z"/>
                            </svg>

                            <?php 
                                if ($get_cat) {
                                    $current_term = get_term_by('slug', $get_cat, 'category');
                                    echo $current_term ? esc_html($current_term->name) : 'categories';
                                } else {
                                    echo 'categories';
                                }
                            ?>
                        </div>
                        <span class="custom-select__arrow category-select__arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none" class="wh-full"><path d="M31 20L24 27L17 20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                    </div>

                    <div class="custom-select__dropdown category-select__dropdown">
                        <ul class="category-select__categories-list flex-col">
                            <li>
                                <?php $total_posts = wp_count_posts()->publish; ?>
                                <a href="<?= esc_url($blog_url); ?>" class="category-select__option d-block <?= empty($get_cat) ? 'active' : ''; ?>">
                                    All <span class="count">(<?= $total_posts; ?>)</span>
                                </a>
                            </li>
                            <?php
                            $categories = get_categories(['orderby' => 'name', 'show_count' => true, 'hide_empty' => 1]);
                            foreach ($categories as $category) : 
                                $is_active = ($get_cat === $category->slug) ? 'active' : '';
                            ?>
                                <li>
                                    <a href="<?= esc_url(add_query_arg('category', $category->slug, $blog_url)); ?>" 
                                       class="category-select__option d-block <?= $is_active; ?>">
                                        <?= esc_html($category->name); ?> 
                                        <span class="count">(<?= $category->count; ?>)</span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                             <?php
                            $categories = get_categories(['orderby' => 'name', 'show_count' => true, 'hide_empty' => 1]);
                            foreach ($categories as $category) : 
                                $is_active = ($get_cat === $category->slug) ? 'active' : '';
                            ?>
                                <li>
                                    <a href="<?= esc_url(add_query_arg('category', $category->slug, $blog_url)); ?>" 
                                       class="category-select__option d-block <?= $is_active; ?>">
                                        <?= esc_html($category->name); ?> 
                                        <span class="count">(<?= $category->count; ?>)</span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                             <?php
                            $categories = get_categories(['orderby' => 'name', 'show_count' => true, 'hide_empty' => 1]);
                            foreach ($categories as $category) : 
                                $is_active = ($get_cat === $category->slug) ? 'active' : '';
                            ?>
                                <li>
                                    <a href="<?= esc_url(add_query_arg('category', $category->slug, $blog_url)); ?>" 
                                       class="category-select__option d-block <?= $is_active; ?>">
                                        <?= esc_html($category->name); ?> 
                                        <span class="count">(<?= $category->count; ?>)</span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                             <?php
                            $categories = get_categories(['orderby' => 'name', 'show_count' => true, 'hide_empty' => 1]);
                            foreach ($categories as $category) : 
                                $is_active = ($get_cat === $category->slug) ? 'active' : '';
                            ?>
                                <li>
                                    <a href="<?= esc_url(add_query_arg('category', $category->slug, $blog_url)); ?>" 
                                       class="category-select__option d-block <?= $is_active; ?>">
                                        <?= esc_html($category->name); ?> 
                                        <span class="count">(<?= $category->count; ?>)</span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="blog-page__posts-wr <?php if (count($exclude_id) == 0):?>blog-page__posts-wr--single<?php endif;?>">
                <?php
                    $p_args = [
                        'post_type'      => 'post',
                        'posts_per_page' => 6,
                        'post__not_in'   => $exclude_id,
                        'paged'          => 1
                    ];

                    if ($get_cat)    $p_args['category_name'] = $get_cat;
                    if ($get_search) $p_args['s'] = $get_search;

                    $posts_query = new WP_Query($p_args);

                    if ($posts_query->have_posts()) : ?>
                        <div class="blog-page__posts d-grid" id="post-container">
                            <?php
                            $counter = 0;
                            $newsletter_rendered = false;

                            while ($posts_query->have_posts()) : $posts_query->the_post();
                                $counter++;
                                if (get_field('enable_newsletter', 'option')) {
                                    if ($counter === 5 && !$is_filtered) { 
                                        NewsletterBlock::render('blog-page__newsletter');
                                        $newsletter_rendered = true;
                                    }
                                }


                                BlogCard::render('blog-page__post-item', get_post(), 'sm');
                            endwhile;

                            if (get_field('enable_newsletter', 'option')) {
                                if (!$newsletter_rendered && !$is_filtered) {
                                    NewsletterBlock::render('blog-page__newsletter');
                                }
                            }
                            ?>
                        </div>
                <?php else : ?>
                        <p class="fz-title">No results found for your criteria.</p>
                <?php endif; ?>

                <?php if ($posts_query->max_num_pages > 1) : ?>
                    <div class="blog-page__pagination t-center">
                        <button id="load-more" 
                                class="btn d-block btn--theme-accent blog-page__load-more relative" 
                                data-movex="0.1"
                                data-movey="0.1"
                                data-page="1" 
                                data-max="<?= $posts_query->max_num_pages; ?>"
                                data-category="<?= esc_attr($get_cat); ?>"
                                data-search="<?= esc_attr($get_search); ?>"
                                data-exclude="<?= esc_attr(json_encode($exclude_id)); ?>">
                            <span class="btn__text-wr">View More</span>
                            <span class="btn__glow absolute"></span>
                        </button>
                    </div>
                <?php endif; wp_reset_postdata(); ?>
            </div>

        </div>
    </div>
</section>

<?php get_footer(); ?>