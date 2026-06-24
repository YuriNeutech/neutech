<?php
    if ( ! empty( $block['data']['_is_inserter_preview'] ) ) {
        echo '<img src="' . get_template_directory_uri() . '/assets/images/admin/benefits-slider-preview.jpg" style="width:100%;">';
        return;
    }

    $slider = get_field('slides') ?: [];
    // Number of slides
    $total_formatted = str_pad(count($slider), 2, '0', STR_PAD_LEFT);
?>

<section class="benefits relative" data-header-theme="dark">
    <div class="benefits__slider relative">
        <div class="benefits__slider-viewport">
            <div class="benefits__slider-container">
                <?php foreach ($slider as $index => $slide):
                    // Current slide number
                    $current_number = str_pad($index + 1, 2, '0', STR_PAD_LEFT);    
                    $title = $slide['title'];
                    $description = $slide['description'];
                    $image_id = $slide['image'];
                    $image_html = '';
                    if ($image_id) {
                        $sizes = '(min-width: 576px) 48px, (min-width: 768px) 64px, 80px';
                        $image_html = wp_get_attachment_image($image_id, 'full', false, [
                            'class' => 'benefit-slide__icon',
                            'sizes' => $sizes,
                            'loading' => 'lazy',
                            'draggable' => 'false'
                        ]);
                    }
                ?>
                    <article class="benefits__slide benefit-slide">
                        <div class="benefit-slide__counter fz-nav">
                            <span class="current"><?= $current_number; ?></span>
                            <span class="divider">/</span>
                            <span class="total"><?= $total_formatted; ?></span>
                        </div>
                        <!-- /.benefit-slide__counter -->

                        <div class="benefit-slide__content-wr">
                            <?php if ($title): ?>
                                <h3 class="benefit-slide__title fz-h2"><?=  esc_html($title) ?></h3>
                            <?php endif ?>

                            <?php if ($description): ?>
                                <div class="benefit-slide__desc"><?=  wp_kses_post($description) ?></div>
                            <?php endif ?>
                        </div>
                        <!-- /.benefit-slide__content-wr -->

                        <?php if ($image_html): ?>
                            <div class="benefit-slide__icon-wr">
                                <?= $image_html ?>
                            </div>
                            <!-- /.benefit-slide__icon-wr -->
                        <?php endif ?>
                    </article>
                <?php endforeach ?>
            </div>
            <!-- /.benefits__slider-container -->
        </div>
        <!-- /.benefits__slider-viewport -->
    </div>
    <!-- /.benefits__slider -->

    <div class="benefits__particles absolute">
        <div class="benefits__particle bg-dot" style="top: 70%; left: 10%; opacity: 1; filter: blur(10px);  width: 1.2rem; hegiht: 1.2rem;"></div>
        <div class="benefits__particle bg-dot" style="top: 30%; left: 80%; opacity: .8; filter: blur(10px);"></div>
        <div class="benefits__particle bg-dot" style="top: 80%; left: 45%; opacity: 1; width: 1.2rem; hegiht: 1.2rem; filter: blur(10px);"></div>
    </div>

    <!-- Scroll Icon -->
    <?php \CleanTheme\Components\ActionIcon::render('benefits__scroll-icon', get_field('action_circle_settings')) ?>
</section>