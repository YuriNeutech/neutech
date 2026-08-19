<?php
namespace CleanTheme;

use CleanTheme\Fields\BenefitsFields;
use CleanTheme\Fields\HeroFields;
use CleanTheme\Fields\ProcessStepsFields;
use CleanTheme\Fields\VideoFields;
use CleanTheme\Fields\ThemeOptionsFields;
use CleanTheme\Fields\PostFields;
use CleanTheme\Fields\LinkWithArrowFields;
use CleanTheme\Fields\RichTextFields;
use CleanTheme\Fields\CardsFields;
use CleanTheme\Fields\StatsFields;
use CleanTheme\Fields\CtaFields;
use CleanTheme\Fields\FaqFields;
use CleanTheme\Fields\LeadFormFields;
use CleanTheme\Fields\InsightsFields;

// Ported from client's Kinsta staging (Yuri's original marketing-page blocks).
use CleanTheme\Fields\TwoColFields;
use CleanTheme\Fields\PageHeroFields;
use CleanTheme\Fields\TextContentFields;
use CleanTheme\Fields\TextButtonBlockFields;
use CleanTheme\Fields\ContentCenteredImgFields;
use CleanTheme\Fields\FeaturesGridFields;
use CleanTheme\Fields\WheelFields;
use CleanTheme\Fields\ProjectsSliderFields;
use CleanTheme\Fields\TilesFields;
use CleanTheme\Fields\MediaVideoFields;


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

        // Landing-page section blocks (converted from PHP partials).
        register_block_type( get_template_directory() . '/blocks/rich-text-section' );
        register_block_type( get_template_directory() . '/blocks/cards-section' );
        register_block_type( get_template_directory() . '/blocks/stats-section' );
        register_block_type( get_template_directory() . '/blocks/cta-section' );
        register_block_type( get_template_directory() . '/blocks/faq-section' );
        register_block_type( get_template_directory() . '/blocks/lead-form-section' );
        register_block_type( get_template_directory() . '/blocks/insights-section' );

        // Ported client marketing-page blocks (from Kinsta staging).
        register_block_type( get_template_directory() . '/blocks/two-columns-section' );
        register_block_type( get_template_directory() . '/blocks/page-hero-section' );
        register_block_type( get_template_directory() . '/blocks/text-content-section' );
        register_block_type( get_template_directory() . '/blocks/text-button-block-section' );
        register_block_type( get_template_directory() . '/blocks/content-centered-image-section' );
        register_block_type( get_template_directory() . '/blocks/features-grid-section' );
        register_block_type( get_template_directory() . '/blocks/wheel-section' );
        register_block_type( get_template_directory() . '/blocks/projects-slider-section' );
        register_block_type( get_template_directory() . '/blocks/tiles-section' );
        register_block_type( get_template_directory() . '/blocks/media-video-section' );
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

        // Landing-page section block field groups.
        foreach ( [ RichTextFields::class, CardsFields::class, StatsFields::class,
                    CtaFields::class, FaqFields::class, LeadFormFields::class,
                    InsightsFields::class,
                    // Ported client marketing-page block field groups.
                    TwoColFields::class, PageHeroFields::class, TextContentFields::class,
                    TextButtonBlockFields::class, ContentCenteredImgFields::class,
                    FeaturesGridFields::class, WheelFields::class, ProjectsSliderFields::class,
                    TilesFields::class, MediaVideoFields::class ] as $class ) {
            $group = new $class();
            acf_add_local_field_group( $group->get_fields() );
        }
    }
}