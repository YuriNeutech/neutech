<?php
namespace CleanTheme;

class Setup {
    public function __construct() {
        add_filter( 'block_categories_all', [ $this, 'register_block_categories' ], 10, 2 );
        // Remove unnecessary blocks.
        add_filter( 'allowed_block_types_all', [ $this, 'neutech_allowed_block_types' ], 10, 2 );
        // Registration of a custom toolbar for the wysiwyg editor.
        add_filter( 'acf/fields/wysiwyg/toolbars', [ $this, 'register_italic_toolbar' ] );

        // Register theme settings
        add_action( 'acf/init', [ $this, 'register_theme_settings' ] );
    }

    public function register_theme_settings() {
        if ( function_exists( 'acf_add_options_page' ) ) {
            acf_add_options_page([
                'page_title'    => 'Theme Settings',
                'menu_title'    => 'Theme Settings',
                'menu_slug'     => 'theme-settings',
                'capability'    => 'edit_posts',
                'redirect'      => false,
                'icon_url'      => 'dashicons-admin-generic',
                'position'      => 2,
            ]);
        }
    }

    public function register_block_categories( $categories, $block_editor_context ) {
        return array_merge(
            [
                [
                    'slug'  => 'neutech',
                    'title' => 'NeuTech Blocks',
                    'icon'  => 'star-filled',
                ],
            ],
            $categories
        );
    }

    public function neutech_allowed_block_types( $allowed_blocks, $editor_context ) {
        if ( ! empty( $editor_context->post ) ) {
            
            return [
                // 1. Custom blocks.
                'acf/hero-section',
                'acf/benefits-slider-section',
                'acf/video-section',
                'acf/process-steps-section',
                'acf/link-with-arrow',
                
                // 2. Critically necessary standard blocks.
                'core/paragraph',
                'core/heading',
                'core/list',
                'core/image',
                'core/columns',
            ];
        }
        
        return $allowed_blocks;
    }

    public function register_italic_toolbar( $toolbars ) {
        $toolbars['italic_only'] = [];
        $toolbars['italic_only'][1] = [ 'italic' ]; 

        $toolbars['no_toolbar'] = [];
        $toolbars['no_toolbar'][1] = [];

        return $toolbars;
    }
}