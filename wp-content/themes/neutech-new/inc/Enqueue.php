<?php
namespace CleanTheme;

class Enqueue {
    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('after_setup_theme', [$this, 'theme_support']);
    }

    public function theme_support() {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('align-wide');
        add_theme_support('editor-styles');
        
        // Load compiled CSS into Gutenberg editor for consistency
        add_editor_style('build/css/style.css');
        add_editor_style('build/css/editor-tweaks.css');
    }

    public function enqueue_scripts() {
        $theme_version = wp_get_theme()->get('Version');

        // Main Stylesheet
        wp_enqueue_style(
            'clean-theme-style',
            get_template_directory_uri() . '/build/css/style.css',
            [],
            $theme_version
        );

        // Main Script (In footer, no dependencies)
        wp_enqueue_script(
            'clean-theme-js',
            get_template_directory_uri() . '/build/js/main.js',
            [],
            $theme_version,
            true 
        );

        if ( is_home() ) {
            wp_enqueue_style(
                'clean-theme-blog-style',
                get_template_directory_uri() . '/build/css/blogStyle.css',
                [],
                $theme_version
            );

            wp_enqueue_script(
                'clean-theme-blog',
                get_template_directory_uri() . '/build/js/blog.js',
                [],
                $theme_version,
                true
            );
            wp_localize_script('clean-theme-blog', 'blogSettings', [
                'ajaxUrl' => admin_url('admin-ajax.php')
            ]);
        }

        if (is_singular('post')) {
            wp_enqueue_style(
                'clean-theme-single-post-style',
                get_template_directory_uri() . '/build/css/single-post.css',
                [],
                $theme_version
            );


            wp_enqueue_script(
                'clean-theme-single-post',
                get_template_directory_uri() . '/build/js/singlePost.js',
                [],
                $theme_version,
                true
            );
        }
    }
}