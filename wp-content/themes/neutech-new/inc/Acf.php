<?php
namespace CleanTheme;

use CleanTheme\Fields\BenefitsFields;
use CleanTheme\Fields\HeroFields;
use CleanTheme\Fields\ProcessStepsFields;
use CleanTheme\Fields\VideoFields;
use CleanTheme\Fields\ThemeOptionsFields;
use CleanTheme\Fields\PostFields;
use CleanTheme\Fields\LinkWithArrowFields;


class Acf {
    public function __construct() {
        // Register blocks (block.json)
        add_action('init', [$this, 'register_blocks']);
        
        // Fields regsiter (ACF Builder)
        add_action('acf/init', [$this, 'register_fields']);
    }

    public function register_blocks() {
        register_block_type( get_template_directory() . '/blocks/hero-section' );
        register_block_type( get_template_directory() . '/blocks/benefits-section' );
        register_block_type( get_template_directory() . '/blocks/video-section' );
        register_block_type( get_template_directory() . '/blocks/process-steps-section' );
        register_block_type( get_template_directory() . '/blocks/link-with-arrow' );
    }

    public function register_fields() {
        if ( ! function_exists('acf_add_local_field_group') ) {
            return;
        }

        $theme_options = new ThemeOptionsFields();
        acf_add_local_field_group( $theme_options->get_fields() );

        $post_options = new PostFields();
        acf_add_local_field_group( $post_options->get_fields() );

        $hero_fields = new HeroFields();
        acf_add_local_field_group( $hero_fields->get_fields() );

        $benefits_fields = new BenefitsFields();
        acf_add_local_field_group( $benefits_fields->get_fields() );

        $video_fields = new VideoFields();
        acf_add_local_field_group( $video_fields->get_fields() );

        $process_steps_fields = new ProcessStepsFields();
        acf_add_local_field_group( $process_steps_fields->get_fields() );

        $arrow_link_fields = new LinkWithArrowFields();
        acf_add_local_field_group( $arrow_link_fields->get_fields() );
    }
}