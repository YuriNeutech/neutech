<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php // Site favicon (Neutech brand dot) — served from theme so it survives DB/uploads resets ?>
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_theme_file_uri( 'assets/images/favicon-32.png' ) ); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( get_theme_file_uri( 'assets/images/favicon-16.png' ) ); ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo esc_url( get_theme_file_uri( 'assets/images/favicon-192.png' ) ); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_theme_file_uri( 'assets/images/favicon-180.png' ) ); ?>">
    <link rel="shortcut icon" href="<?php echo esc_url( get_theme_file_uri( 'assets/images/favicon-32.png' ) ); ?>">

    <?php
        // Prepare Social Data
        $share_title = wp_get_document_title();
        $share_url   = is_front_page() ? home_url('/') : get_permalink();
        // Per-page description (not the site tagline) so each URL shares uniquely.
        $share_desc  = function_exists('neutech_truncate_desc')
            ? neutech_truncate_desc( neutech_meta_description() )
            : get_bloginfo('description');

        // Share image: post thumbnail when present, else the branded default.
        $share_img = ( is_singular() && has_post_thumbnail() )
            ? get_the_post_thumbnail_url(get_the_ID(), 'large')
            : ( function_exists('neutech_default_share_image') ? neutech_default_share_image() : '' );
    ?>

    <meta property="og:type" content="<?= is_singular('post') ? 'article' : 'website'; ?>">
    <meta property="og:site_name" content="<?= esc_attr(get_bloginfo('name')); ?>">
    <meta property="og:locale" content="en_US">
    <meta property="og:url" content="<?= esc_url($share_url); ?>">
    <meta property="og:title" content="<?= esc_attr($share_title); ?>">
    <meta property="og:description" content="<?= esc_attr($share_desc); ?>">
    <?php if ($share_img): ?>
    <meta property="og:image" content="<?= esc_url($share_img); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <?php endif; ?>
    <?php if (is_singular('post')): ?>
    <meta property="article:published_time" content="<?= esc_attr(get_the_date('c')); ?>">
    <meta property="article:modified_time" content="<?= esc_attr(get_the_modified_date('c')); ?>">
    <?php endif; ?>

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= esc_url($share_url); ?>">
    <meta property="twitter:title" content="<?= esc_attr($share_title); ?>">
    <meta property="twitter:description" content="<?= esc_attr($share_desc); ?>">
    <?php if ($share_img): ?>
    <meta property="twitter:image" content="<?= esc_url($share_img); ?>">
    <?php endif; ?>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php 
    $header_theme = isset($args['theme']) ? $args['theme'] : '';
?>
<div class="site-wrapper">

    <div class="header-wrapper w-full">
        <header class="header w-full <?php if ($header_theme):?>is-<?= $header_theme ?><?php endif;?>">
    		<?php
    			// Prefer an uploaded SVG logo; fall back to the styled "neutech."
    			// wordmark when none is set OR the referenced attachment is gone
    			// (get_inline_svg returns '' for a missing/non-SVG file).
    			$logo_id  = get_field('general_logo', 'option');
    			$logo_svg = $logo_id ? \CleanTheme\SvgSupport::get_inline_svg( $logo_id ) : '';
    			if ( empty( $logo_svg ) ) {
    				$logo_svg = neutech_brandmark();
    			}

    			$cta = get_field('general_cta', 'option');
    			$cta_title = null;
    			$cta_link = null;
    			$cta_target = null;

    			if (is_array($cta) && !empty($cta)) {
    				$cta_title = esc_html($cta['title']);
    				$cta_link = esc_url($cta['url']);
    				$cta_target = 'target="' . esc_attr($cta['target']) . '"';
    			}
    		?>
    		<div class="header__container relative">
                
            <?php 
                // Check if the menu object exists by its name/slug
                $menu_exists = wp_get_nav_menu_object('Main menu'); 

                if ($menu_exists) : 
            ?>

    			<!-- Nav -->
    			<nav class="header__nav header-nav">
                    <button class="btn header-nav__button" type="button" aria-label="Open mobile menu">
                        <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" class="wh-full">
                            <line x1="14" y1="17" x2="34" y2="17" stroke-width="2" stroke-linecap="round"/>
                            <line x1="14" y1="23" x2="34" y2="23" stroke-width="2" stroke-linecap="round"/>
                            <line x1="14" y1="29" x2="34" y2="29" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </button>

                    <div class="header-nav__menu-wr w-full flex-col fz-btn">
                        <div class="header-nav__bg absolute inset">
                            <div class="header-nav__blur-bg absolute w-full"></div>

                            <div class="header-nav__particles">
                                <div class="header-nav__particle bg-dot" style="top: -10%; left: 30%;"></div>
                                <div class="header-nav__particle bg-dot" style="top: 85%; left: 30%;"></div>
                                <div class="header-nav__particle bg-dot" style="top: 40%; left: 70%; width: 1.4rem; height: 1.4rem; filter: blur(5px);"></div>
                                <div class="header-nav__particle bg-dot" style="top: 10%; left: 70%;"></div>
                                <div class="header-nav__particle bg-dot" style="top: 0%; left: -5%;"></div>
                            </div>
                        </div>
        				<?php
                            wp_nav_menu([
                                'menu'            => 'Main menu', 
                                'container'       => false,       
                                'menu_class'      => 'header-nav__list flex-col relative', 
                                'fallback_cb'     => false,      
                                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'depth'           => 2,          
                            ]);
                        ?>
                        <a href="<?=  $cta_link ?>" class="header-nav__cta-btn btn btn--theme-accent btn--cta-md relative" <?= $cta_target ?>>
            				<span class="btn__text-wr"><?=  $cta_title ?></span>
            				<span class="btn__icon-wr">
            					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" id="Brand-Superhuman--Streamline-Tabler" height="24" width="24">
                                  <path d="m16 12 4 3 -8 7 -8 -7 4 -3" stroke-width="2"/>
                                  <path d="M12 3 4 9l8 6 8 -6z" stroke-width="2"/>
                                  <path d="M12 15h8" stroke-width="2"/>
                                </svg>
            				</span>
            				<span class="btn__glow absolute"></span>
            			</a>

                        <button type="button" class="btn header-nav__close relative">
                            <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M30 18L24 24M18 30L24 24M24 24L30 30M24 24L17.9999 18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
    			</nav>
    			<!-- /.header__nav header-nav -->
            <?php endif;?>

    			<?php
    				$logo_tag = is_front_page() ? 'div' : 'a';
    				$logo_attrs = is_front_page() ? '' : 'href="' . esc_url(home_url('/')) . '"';
    				$logo_class = 'header__logo';
    				if ( strpos( $logo_svg, 'brandmark' ) !== false ) { $logo_class .= ' header__logo--wordmark'; }
    			?>
    			<!-- Logo -->
    			<<?= $logo_tag; ?> class="<?= esc_attr( $logo_class ); ?>" <?= $logo_attrs; ?> aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
    				<?=  $logo_svg ?>
    			</<?= $logo_tag; ?>>

    			<a href="<?=  $cta_link ?>" class="header__cta-btn btn btn--theme-accent btn--cta-md relative" <?= $cta_target ?>>
    				<span class="btn__text-wr"><?=  $cta_title ?></span>
    				<span class="btn__icon-wr flex-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" id="Brand-Superhuman--Streamline-Tabler" height="24" width="24">
                          <path d="m16 12 4 3 -8 7 -8 -7 4 -3" stroke-width="2"/>
                          <path d="M12 3 4 9l8 6 8 -6z" stroke-width="2"/>
                          <path d="M12 15h8" stroke-width="2"/>
                        </svg>

    				</span>

    				<span class="btn__glow absolute"></span>
    			</a>

    			<!-- <button class="header__burger burger" aria-label="Menu">
    				<span></span>
    				<span></span>
    			</button> -->
    		</div>
    		<!-- /.container header__container -->
    	</header>
        <?php if ( is_singular('post') ) : ?>
            <div class="progress w-full">
                <div class="progress__bar wh-full"></div>
            </div>
        <?php endif;?>
    </div>
	
    <?php if (is_front_page()):?>
	<div class="preloader" id="preloader">
		<div class="preloader__logo-wr">
			<?= neutech_preloader_wordmark() ?>
		</div>
	</div>
    <?php endif;?>


	<main id="main" class="site-main">