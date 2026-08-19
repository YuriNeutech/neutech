<?php

use CleanTheme\Components\ArrowLink;


    if ( ! empty( $block['data']['_is_inserter_preview'] ) ) {
        echo '<img src="' . get_template_directory_uri() . '/assets/images/admin/page-hero-preview.jpg" style="width:100%;">';
        return;
    }

    $allowed_html = [
        'em' => ['class' => []], 
        'strong' => [],
        'span'   => [
            'class' => []
        ],
        'br'     => [
            'class' => []
        ]
    ];


    $title = get_field('title') ?: '';
    if ($title) {
        $title = wpautop($title);

        $title = str_replace('<p>', '<span class="page-hero__word-new-p">', $title);
        $title = str_replace('</p>', '</span>', $title);
        $title = preg_replace('/<br\s*\/?>/i', '<br class="page-hero__word-new-line">', $title);
    }

    $subtitle = get_field('subtitle');
    $link = get_field('action_link');
    $features_group = get_field('features');
    $background_group = get_field('image_background');
    $is_bg_type = $background_group['enable_image_background'];
    $with_features_list = $features_group['enable_features'];
    $bg_images = $background_group['bg_images'];

?>

<section class="page-hero <?php if ($with_features_list):?>page-hero--with-features<?php endif;?> relative d-flex o-hid <?php if ($is_bg_type):?>page-hero--type_images<?php endif;?>" data-header-theme="dark">
    <?php if (!$is_bg_type):?>
        <div class="page-hero__blur-bg absolute <?php if (!$features_group['enable_features']):?>d-none<?php endif;?>"></div>
    <?php else:?>
        <?php if (!empty($bg_images) && is_array($bg_images)):?>
            <div class="page-hero__bg-images">
                <?php foreach ($bg_images as $image):?>
                    <div class="page-hero__bg-image absolute">
                        <picture>
                            <?= wp_get_attachment_image($image['ID'], 'large', false, ['class' => ' w-full cover-image']); ?>
                        </picture>
                    </div>
                <?php endforeach;?>
            </div>
        <?php endif;?>
    <?php endif;?>
    <div class="container page-hero__container flex-col">
        <div class="page-hero__content relative">
            <span class="fz-nav page-hero__tag c-action lower tagline"><?= get_field('tagline') ? get_field('tagline') : get_the_title() ?></span>

            <?php if ($title): ?>
                <h1 class="page-hero__title split-text-target fz-h1">
                    <?php echo wp_kses($title, $allowed_html); ?>
                </h1>
            <?php endif; ?>

            <?php if ($subtitle): ?>
                <h2 class="page-hero__subtitle fz-title"><?= $subtitle ?></h2>
            <?php endif; ?>

            <?php if (!empty($link) && is_array($link)):?>
                <?= ArrowLink::render($link, 'page-hero__btn btn--theme-white-border'); ?>
            <?php endif; ?>
        </div>

        <?php if ($features_group['enable_features']):
            $feature_list = $features_group['feature_items'];
            if (!empty($feature_list)):?>
            <div class="features-list fz-title page-hero__features-list d-grid">
                <?php foreach ($feature_list as $item):?>
                    <div class="features-list__item flex-col">
                        <div class="features-list__icon relative"></div>
                        <p class="features-list__txt"><?= $item['feature_text'] ?></p>
                    </div>
                <?php endforeach;?>
            </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <?php \CleanTheme\Components\ActionIcon::render('page-hero__scroll-icon d-none', get_field('action_circle_settings')) ?>
    <?php if (!empty($link) && is_array($link) && !$is_preview):?>
        <a href="<?= $link['url'] ?>" target="<?= $link['target']?>" class="absolute wh-full inset page-hero__hidden-link"><?= $link['title'] ?></a>
    <?php endif; ?>
</section>