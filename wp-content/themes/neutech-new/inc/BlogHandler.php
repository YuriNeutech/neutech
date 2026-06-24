<?php
namespace CleanTheme;

use WP_Query;
use CleanTheme\Components\BlogCard;

class BlogHandler 
{
    private static $template_name = 'home.php';

    public static function init() 
    {
        add_action('template_redirect', [self::class, 'handle_redirects']);
        add_action('wp_ajax_load_more_posts', [self::class, 'ajax_load_more']);
        add_action('wp_ajax_nopriv_load_more_posts', [self::class, 'ajax_load_more']);
    }

    private static function get_blog_url() 
    {
        $pages = get_pages([
            'meta_key'   => '_wp_page_template',
            'meta_value' => self::$template_name
        ]);

        return !empty($pages) ? get_permalink($pages[0]->ID) : home_url('/blog');
    }

    public static function handle_redirects() 
    {
        if (is_admin()) return;

        $blog_url = self::get_blog_url();
        

        $current_path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $blog_path = trim(parse_url($blog_url, PHP_URL_PATH), '/');


        if (is_category()) {
            $cat = get_queried_object();
            wp_redirect(add_query_arg('category', $cat->slug, $blog_url));
            exit;
        }

        if (is_search() && $current_path !== $blog_path) {
            wp_redirect(add_query_arg('search', get_search_query(), $blog_url));
            exit;
        }
    }

    public static function ajax_load_more() 
    {
        $page     = isset($_POST['page'])     ? intval($_POST['page']) : 1;
        $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
        $search   = isset($_POST['search'])   ? sanitize_text_field($_POST['search']) : '';
        $exclude  = isset($_POST['exclude'])  ? json_decode(stripslashes($_POST['exclude']), true) : [];

        $args = [
            'post_type'      => 'post',
            'posts_per_page' => 6,
            'paged'          => $page + 1,
            'post_status'    => 'publish',
            'post__not_in'   => is_array($exclude) ? $exclude : [],
        ];

        if (!empty($category)) {
            $args['category_name'] = $category;
        }

        if (!empty($search)) {
            $args['s'] = $search;
        }

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            ob_start();
            while ($query->have_posts()) {
                $query->the_post();
                BlogCard::render('blog-page__post-item', get_post(), 'sm');
            }
            echo ob_get_clean();
        }

        wp_reset_postdata();
        wp_die();
    }
}

BlogHandler::init();