<?php

use CleanTheme\Components\ActionIcon;
use CleanTheme\Components\ProjectSlide;
use CleanTheme\Components\TaglineBlock;
use CleanTheme\Components\TagsBlock;
use CleanTheme\Components\TextBlock;
use CleanTheme\Components\TitleBlock;

    if ( ! empty( $block['data']['_is_inserter_preview'] ) ) {
        echo '<img src="' . get_template_directory_uri() . '/assets/images/admin/projects-slider-preview.jpg" style="width:100%;">';
        return;
    }

    $heading = get_field('heading');
    $title = $heading['section_title'];

    $header = get_field('header');
    $tags_title = $header['tags_title'];
    $header_text = $header['header_text'];
    $tags = $header['tags_items'];

    $text_near_slider = get_field('text_near_slider');
    $slider_title = $text_near_slider['slider_title'];
    $slider_tag = $text_near_slider['slider_tag'];
    $slider_text = $text_near_slider['slider_text'];

    $slides = get_field('slides');
?>

<section class="bg--black two-col pb--M projects-slider o-hid">
    <?php if (!empty($title)): ?>
        <div class="two-col__heading container t-center projects-slider__heading">
            <h2 class="two-col__title fz-h1"><?= $title ?></h2>
        </div>
    <?php endif;?>

    <div class="container two-col__container d-grid a-start projects-slider__top">
        <div class="two-col__col two-col__col--narrow flex-col">
            <?php if (!empty($tags_title)):?>
                <?= TaglineBlock::render( $tags_title, 'two-col__tagline projects-slider__tagline') ?>
            <?php endif;?>
            <?php if (!empty($tags)):?>
                <?= TagsBlock::render( $tags, 'two-col__tags projects-slider__tags' )?>
            <?php endif;?>
        </div>
        <div class="two-col__col two-col__col--second flex-col">
            <?php if (!empty($header_text)):?>
                <?= TextBlock::render( $header_text, 'two-col__text' ) ?>
            <?php endif;?>
        </div>
    </div>
    
    <div class="container two-col__container d-grid a-start projects-slider__bottom">
        <div class="two-col__col two-col__col--narrow flex-col">
            <?php if (!empty($slider_tag)):?>
                <?= TaglineBlock::render( $slider_tag, 'two-col__tagline') ?>
            <?php endif;?>
            <?php if (!empty($slider_title)):?>
                <?= TitleBlock::render( 'h2', $slider_title, 'two-col__title' ) ?>
            <?php endif;?>
            <?php if (!empty($slider_text)):?>
                <?= TextBlock::render( $slider_text, 'two-col__text' ) ?>
            <?php endif;?>
        </div>

        <div class="two-col__col two-col__col--second flex-col projects-slider__slider-wr">
            
            <?php if (!empty($slides) && is_array($slides)): ?>
                <div class="projects-slider__slider embla relative w-full">
                    
                    <div class="embla__viewport projects-slider__viewport ">
                        <div class="embla__container projects-slider__container flex-row">
                            
                            <?php foreach ($slides as $slide): ?>
                                <?= ProjectSlide::render( 'embla__slide projects-slider__slide', $slide) ?>
                            <?php endforeach; ?>

                        </div>
                    </div>

                    <div class="projects-slider__nav flex-row j-between">
                        <button class="btn projects-slider__btn projects-slider__btn--prev embla__prev" aria-label="Previous Slide">
                            <svg xmlns="http://www.w3.org/2000/svg" class="wh-full" viewBox="0 0 48 48" fill="none">
                              <path d="M21 17L28 24L21 31" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        
                        <div class="projects-slider__pagination embla__pagination flex-row"></div>
                        
                        <button class="btn projects-slider__btn projects-slider__btn--next embla__next" aria-label="Next Slide">
                            <svg xmlns="http://www.w3.org/2000/svg" class="wh-full" viewBox="0 0 48 48" fill="none">
                              <path d="M21 17L28 24L21 31" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>

                    <?php ActionIcon::render('projects-slider__scroll-icon', get_field('action_circle_settings')) ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>