<?php
/**
 * Theme Entry Point
 * * Auto-loading classes from /inc directory.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( file_exists( get_template_directory() . '/vendor/autoload.php' ) ) {
    require_once get_template_directory() . '/vendor/autoload.php';
}

require_once get_template_directory() . '/inc/template-helpers.php';
require_once get_template_directory() . '/inc/hero-visuals.php';
require_once get_template_directory() . '/inc/landing-content.php';
require_once get_template_directory() . '/inc/blog-pillars.php';
require_once get_template_directory() . '/inc/seo.php';

// Marketing pages ported from the client's Kinsta staging keep Yuri's original
// (non-lowercased) heading typography. Tag them with a body class to scope the reset.
add_filter( 'body_class', function ( $classes ) {
    if ( is_page() && get_post_meta( get_queried_object_id(), '_ntc_ported', true ) ) {
        $classes[] = 'ntc-ported';
    }
    // Per-page hook for slug-scoped CSS (WP core only emits page-id-N).
    if ( is_page() ) {
        $slug = get_post_field( 'post_name', get_queried_object_id() );
        if ( $slug ) {
            $classes[] = 'ntc-page-' . sanitize_html_class( $slug );
        }
    }
    return $classes;
} );

// Initialize classes
new \CleanTheme\Cleanup();
new \CleanTheme\Enqueue();
new \CleanTheme\Acf();
new \CleanTheme\Setup();
new \CleanTheme\SvgSupport();
new \CleanTheme\BlogHandler();
new \CleanTheme\NewsletterHandler();
new \CleanTheme\ImageSizes();