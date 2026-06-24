<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php
        // Prepare Social Data
        $share_title = wp_get_document_title();
        $share_url   = get_permalink();
        $share_desc  = get_bloginfo('description');
        
        $logo_id    = get_field('general_logo', 'option');
        $share_img  = $logo_id ? wp_get_attachment_image_url($logo_id, 'full') : '';

        if ( is_singular() && has_post_thumbnail() ) {
            $share_img = get_the_post_thumbnail_url(get_the_ID(), 'large');
        }
    ?>

    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= esc_url($share_url); ?>">
    <meta property="og:title" content="<?= esc_attr($share_title); ?>">
    <meta property="og:description" content="<?= esc_attr($share_desc); ?>">
    <?php if ($share_img): ?>
    <meta property="og:image" content="<?= esc_url($share_img); ?>">
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
    			$logo_id = get_field('general_logo', 'option');
    			$logo_svg = null;

    			if ($logo_id) {
    				$logo_svg = \CleanTheme\SvgSupport::get_inline_svg( $logo_id );
    			} else {
    				$logo_svg = 'NeuTech.';
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
    			?>
    			<!-- Logo -->
    			<<?= $logo_tag; ?> class="header__logo" <?= $logo_attrs; ?>>
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
			<?=  $logo_svg ?>
		</div>
	</div>
    <?php endif;?>


	<main id="main" class="site-main">