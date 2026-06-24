<?php
    /**
     * Block Name: Process Steps Section
     */

    $steps = get_field('steps') ?: [];
    // Number of slides
    $total_formatted = str_pad(count($steps), 2, '0', STR_PAD_LEFT);

    // Preview
    if ( ! empty( $block['data']['_is_inserter_preview'] ) ) {
        echo '<img src="' . get_template_directory_uri() . '/assets/images/admin/process-steps-preview.jpg" style="width:100%;">';
        return;
    }
?>

<section class="process-steps relative" data-header-theme="light">
    <div class="container">
        <?php foreach ($steps as $index => $step):
            $current_number = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
            $link_url = null;
            $link_target = null;
            $link_title = null;
            if (is_array($step['link']) && !empty($step['link'])) {
                $link = $step['link'];
                $link_url = $link['url'];
                $link_target = $link['target'];
                $link_title = $link['title'];
            }
            $title = $step['title'];
            $desc = $step['description'];
        ?>
            <article class="process-steps__item process-step-item relative">
                <div class="process-step-item__counter fz-nav">
                    <span class="current"><?= $current_number; ?></span>
                    <span class="divider">/</span>
                    <span class="total"><?= $total_formatted; ?></span>
                </div>
                <!-- End counter -->

                <div class="process-step-item__content-wr">
                    <?php if ($title):?>
                        <h4 class="fz-h2 process-step-item__title"><?= esc_html($title) ?></h4>
                    <?php endif;?>

                    <?php if ($desc): ?>
                        <div class="process-step-item__desc"><?=  wp_kses_post($desc) ?></div>
                    <?php endif ?>
                </div>
                <!-- /.process-step-item__content-wr -->
                <?php if ($link_url):?>
                    <a href="<?=  esc_url($link_url) ?>" class="process-step-item__link absolute"  <?php if ($link_target): ?>target="<?=  esc_attr($link_target) ?>"<?php endif ?>><?= esc_html($link_title) ?></a>
                <?php endif;?>
            </article>
            <!-- /.process-steps__item process-step-item -->
        <?php endforeach ?>
    </div>
    <!-- /.container -->

    <!-- Scroll Icon -->
    <?php \CleanTheme\Components\ActionIcon::render('process-steps__scroll-icon', get_field('action_circle_settings')) ?>
</section>
<!-- /.process-steps -->