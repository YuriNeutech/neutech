<?php
    /**
     * Block Name: Video Section
     */

    // Load values (with escaping for security)
    $title = get_field('title') ?: 'Default Title';
    $description = get_field('desc');
    $poster_mobile_id = get_field('poster-mob');
    $poster_desk_id = get_field('poster-desktop');
    $video_id = get_field('vimeo-id');
    $video_mobile_id = get_field('vimeo-id-mobile');
    $hide_on_mobile = get_field('hide_on_mobile');

    // Preview
    if ( ! empty( $block['data']['_is_inserter_preview'] ) ) {
        echo '<img src="' . get_template_directory_uri() . '/assets/images/admin/video-preview.jpg" style="width:100%;">';
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

    if ($title) {
        $title = wpautop($title);

        $title = str_replace('<p>', '<span class="full-video__word-new-p">', $title);
        $title = str_replace('</p>', '</span>', $title);
        $title = preg_replace('/<br\s*\/?>/i', '<br class="full-video__word-new-line">', $title);
    }

    // Use desktop poster for all sizes if moile poster dind't upload
    if (!$poster_mobile_id) {
        $poster_mobile_id = $poster_desk_id;
    }

    // Get destop poster uri
    $desktop_url = wp_get_attachment_image_url($poster_desk_id, 'full');

    $section_classes = 'full-video relative';
    if ($hide_on_mobile) {
        $section_classes .= ' hide-section-mobile';
    }
?>

<section class="<?= esc_attr($section_classes); ?>" data-header-theme="hidden">
    <div class="full-video__player">
        <?php if ($video_mobile_id): ?>
            <div class="full-video__iframe wh-full full-video__iframe--mobile"  data-vimeomobile-id="<?= esc_attr($video_mobile_id); ?>"></div>
        <?php endif; ?>

        <div class="full-video__iframe wh-full full-video__iframe--desktop" data-vimeo-id="<?= esc_attr($video_id); ?>"></div>
        
    </div>

    <div class="full-video__poster relative">
        <picture>
            <?php if ($desktop_url): ?>
                <source media="(min-width: 768px)" srcset="<?php echo esc_url($desktop_url); ?>">
            <?php endif; ?>

            <?php 
                echo wp_get_attachment_image($poster_mobile_id, 'full', false, [
                    'class'   => 'full-video__bg cover-img',
                    'loading' => 'lazy',
                    'alt'     => 'Video cover'
                ]); 
            ?>
        </picture>
    </div>
    <!-- /.full-video__poster -->

    <div class="full-video__container container absolute">
        <?php if ($title): ?>
            <div class="full-video__title-wr">
                <h2 class="full-video__title fz-h1 split-text-target"><?= wp_kses($title, $allowed_html); ?></h2>
            </div>
        <?php endif ?>

        <?php if ($description): ?>
            <div class="full-video__desc-wr"><?=  wp_kses_post($description) ?></div>
        <?php endif ?>
    </div>
    <!-- /.full-video__container container -->

    <!-- Scroll Icon -->
    <?php \CleanTheme\Components\ActionIcon::render('full-video__scroll-icon', get_field('action_circle_settings')) ?>
</section>
<!-- /.full-video -->