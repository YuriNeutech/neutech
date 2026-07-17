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

    /**
     * Version an asset by its file mtime so any rebuild busts the browser cache.
     */
    private function asset_ver($relative_path) {
        $file = get_template_directory() . '/' . ltrim($relative_path, '/');
        return file_exists($file) ? (string) filemtime($file) : wp_get_theme()->get('Version');
    }

    public function enqueue_scripts() {
        // Main Stylesheet
        wp_enqueue_style(
            'clean-theme-style',
            get_template_directory_uri() . '/build/css/style.css',
            [],
            $this->asset_ver('build/css/style.css')
        );

        // Main Script (In footer, no dependencies)
        wp_enqueue_script(
            'clean-theme-js',
            get_template_directory_uri() . '/build/js/main.js',
            [],
            $this->asset_ver('build/js/main.js'),
            true
        );

        if ( is_home() ) {
            wp_enqueue_style(
                'clean-theme-blog-style',
                get_template_directory_uri() . '/build/css/blogStyle.css',
                [],
                $this->asset_ver('build/css/blogStyle.css')
            );

            wp_enqueue_script(
                'clean-theme-blog',
                get_template_directory_uri() . '/build/js/blog.js',
                [],
                $this->asset_ver('build/js/blog.js'),
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
                $this->asset_ver('build/css/single-post.css')
            );


            wp_enqueue_script(
                'clean-theme-single-post',
                get_template_directory_uri() . '/build/js/singlePost.js',
                [],
                $this->asset_ver('build/js/singlePost.js'),
                true
            );
        }
    }
}