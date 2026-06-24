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

// Initialize classes
new \CleanTheme\Cleanup();
new \CleanTheme\Enqueue();
new \CleanTheme\Acf();
new \CleanTheme\Setup();
new \CleanTheme\SvgSupport();
new \CleanTheme\BlogHandler();
new \CleanTheme\NewsletterHandler();
new \CleanTheme\ImageSizes();