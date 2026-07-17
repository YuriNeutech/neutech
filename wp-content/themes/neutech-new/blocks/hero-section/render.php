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

    // Load extended values
    $eyebrow     = get_field('eyebrow');
    $subtitle    = get_field('subtitle');
    $primary     = get_field('primary_button');
    $secondary   = get_field('secondary_button');
    $show_visual = get_field('show_visual');

    // Create class attribute allowing for custom classes
    $className = 'hero relative';
    if ( $show_visual ) { $className .= ' hero--split'; }
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
            <?php if ($eyebrow): ?>
                <span class="hero__eyebrow"><?php echo esc_html($eyebrow); ?></span>
            <?php endif; ?>
            <?php if ($title): ?>
                <h1 class="hero__title split-text-target">
                    <?php echo wp_kses($title, $allowed_html); ?>
                </h1>
            <?php endif; ?>
            <?php if ($subtitle): ?>
                <p class="hero__subtitle"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>
            <?php if ( ! empty($primary['url']) || ! empty($secondary['url']) ): ?>
                <div class="hero__actions">
                    <?php
                    neutech_link_button($primary, 'accent', 'Get a quote');
                    neutech_link_button($secondary, 'white-border', 'Learn more');
                    ?>
                </div>
            <?php endif; ?>
        </div>
        <!-- /.hero__content -->

        <?php if ($show_visual): ?>
        <div class="hero__visual" aria-hidden="true">
            <svg class="hero__stack" viewBox="0 0 440 460" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="hero__stack-edge" d="M65 150 L65 315" />
                <path class="hero__stack-edge" d="M375 150 L375 315" />
                <path class="hero__stack-edge" d="M220 224 L220 389" />
                <path class="hero__plate hero__plate--4" d="M220 241 L375 315 L220 389 L65 315 Z" />
                <path class="hero__plate hero__plate--3" d="M220 186 L375 260 L220 334 L65 260 Z" />
                <path class="hero__plate hero__plate--2" d="M220 131 L375 205 L220 279 L65 205 Z" />
                <path class="hero__plate hero__plate--1" d="M220 76 L375 150 L220 224 L65 150 Z" />
            </svg>
        </div>
        <!-- /.hero__visual -->
        <?php endif; ?>
    </div>
    <!-- /.container -->

    <!-- Scroll Icon -->
    <?php \CleanTheme\Components\ActionIcon::render('hero__scroll-icon', get_field('action_circle_settings')) ?>
</section>