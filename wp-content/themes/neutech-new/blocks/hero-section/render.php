<?php
    /**
     * Block Name: Hero Section
     *
     * @param   array $block The block settings and attributes.
     * @param   bool $is_preview True during AJAX preview.
     * @param   (int|string) $post_id The post ID this block is saved to.
     */

    if ( ! empty( $block['data']['_is_inserter_preview'] ) ) {
        // Preview image path
        $preview_image_url = get_template_directory_uri() . '/assets/images/admin/hero-preview.png';
        
        // Print preview image
        echo '<img src="' . esc_url( $preview_image_url ) . '" style="width:100%; height:auto; display:block;" alt="Hero Preview">';
        return;
    }

    // Create id attribute supporting anchor values
    $id = 'hero-' . $block['id'];
    if( !empty($block['anchor']) ) {
        $id = $block['anchor'];
    }

    // Create class attribute allowing for custom classes
    $className = 'hero relative';
    if( !empty($block['className']) ) {
        $className .= ' ' . $block['className'];
    }

    // Load values (with escaping for security)
    $title = get_field('title') ?: 'Default Title';

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

        $title = str_replace('<p>', '<span class="hero__word-new-p">', $title);
        $title = str_replace('</p>', '</span>', $title);
        $title = preg_replace('/<br\s*\/?>/i', '<br class="hero__word-new-line">', $title);
    }
?>

<section id="<?= esc_attr($id); ?>" class="<?= esc_attr($className); ?>" data-header-theme="dark">
    <div class="hero__container container relative">
        <div class="hero__bg-effects absolute">
            <div class="hero__blur-bg absolute"></div>

            <div class="hero__particles">
                <div class="hero__particle bg-dot" style="top: 5%; left: 10%; opacity: 0.8;  filter: blur(2px);"></div>
                <div class="hero__particle bg-dot" style="top: -20%; left: 80%;"></div>
                <div class="hero__particle bg-dot" style="top: -60%; left: 15%; width: 1.2rem; hegiht: 1.2rem; filter: blur(4px);"></div>
                <div class="hero__particle bg-dot" style="top: 10%; left: 70%; opacity: 0.5; scale: 2; filter: blur(5px);"></div>
                <div class="hero__particle bg-dot" style="top: 15%; left: 40%; scale: 0.7; filter: blur(6px);"></div>
            </div>
        </div>
        <!-- /.hero__bg-effects -->
        <div class="hero__content">
            <?php if ($title): ?>
                <h1 class="hero__title split-text-target">
                    <?php echo wp_kses($title, $allowed_html); ?>
                </h1>
            <?php endif; ?>
        </div>
        <!-- /.hero__content -->
    </div>
    <!-- /.container -->

    <!-- Scroll Icon -->
    <?php \CleanTheme\Components\ActionIcon::render('hero__scroll-icon', get_field('action_circle_settings')) ?>
</section>