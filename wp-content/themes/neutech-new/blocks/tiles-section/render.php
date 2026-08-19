<?php
    use CleanTheme\Components\ArrowLink;
    use CleanTheme\Components\ListBlock;
    use CleanTheme\Components\TaglineBlock;
    use CleanTheme\Components\TextBlock;
    use CleanTheme\Components\TitleBlock;

    if ( ! empty( $block['data']['_is_inserter_preview'] ) ) {
        echo '<img src="' . get_template_directory_uri() . '/assets/images/admin/cards-section-preview.jpg" style="width:100%;">';
        return;
    }
    if ( ! function_exists('render_card_content') ) {
        function render_card_content( $layouts ) {
            if ( empty($layouts) || !is_array($layouts) ) return;

            foreach ( $layouts as $layout ) {
                switch ( $layout['acf_fc_layout'] ) {
                    
                    case 'title_block':
                        $text = $layout['title_text'];
                        $tag = !empty($layout['title_tag']) ? $layout['title_tag'] : 'h2';
                        TitleBlock::render( $tag, $text, 'text-card__title' );
                        break;

                    case 'tagline':
                        TaglineBlock::render( $layout['text'], 'text-card__tag' );
                        break;

                    case 'text_block':
                        TextBlock::render( $layout['text_content'], 'text-card__text');
                        break;

                    case 'progress':
                        ?>
                        <div class="text-card__progress flex-row j-between">
                            <?php foreach ($layout['progress_items'] as $item): 
                                TaglineBlock::render( $item['item_text'], 'text-card__progress-item' );
                            endforeach; ?>
                        </div>
                        <?php 
                        break;
                    case 'ticked_list_block':
                        ListBlock::render( $layout['list_items'], 'ticked-list text-card__list fz-p' );
                        break;
                    case 'crossed_list_block':
                        ListBlock::render( $layout['list_items'], 'crossed-list text-card__list fz-p' );
                        break;
                    case 'unordered_list_block':
                        ListBlock::render( $layout['list_items'], 'ul-list text-card__list fz-p' );
                        break;
                    case 'big_text':
                        $text = $layout['big_text_text'];
                        $theme = $layout['text_theme'];
                        if (!empty($text)):
                        ?>
                        <div class="text-card__txt-inblock fz-h3 bg--<?= $theme ?>">
                            <?= $text ?>
                        </div>
                        <?php
                        endif;
                    default:
                }
            }
        }
    }

    $settings = get_field('global_settings');
    $heading = get_field('heading');
    $title = $heading['section_title'] ?: '';
    $subtitle = $heading['section_subtitle'];
    $link = get_field('action_link');
    $action_intro = get_field('action_intro');
    $cards = get_field('cards');
    $enable_arrow = $settings['enable_arrows'];
    $enable_tick = $settings['enable_tick_icons'];

    $btn_theme = 'btn--theme-accent';
    $btn_attributes = 'data-movex="0.1" data-movey="0.1" data-cta-btn';
    $content_block_theme = $settings['theme'];
    if ($content_block_theme == 'action') {
        $btn_theme = 'btn--theme-white';
        $btn_attributes = '';
    }

    $header_theme = "light";
    if ($content_block_theme == 'black') {
        $header_theme = "dark";
    }
?>


<section class="cards relative bg--<?= $content_block_theme ?> pb--M" data-header-theme="<?= $header_theme ?>">
    <div class="container cards__container relative">
        <?php if ($title):?>
            <h2 class="cards__title fz-h1"><?= $title ?></h2>
        <?php endif;?>
        <?php if ($subtitle):?>
            <h3 class="cards__title fz-h3"><?= $subtitle ?></h3>
        <?php endif;?>

        <?php if (!empty($cards) && is_array($cards)):?>
            <div class="cards__wrapper flex-col">
                <?php foreach($cards as $key => $card):?>
                    <?php if ($enable_arrow && $key != 0):?>
                        <div class="cards__arrow">
                            <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 14 22" fill="none" class="wh-full">
                              <path d="M6.83455 20L6.83455 1M6.83455 20L1.4152 14.4583M6.83455 20L12.2539 14.4583" stroke="black" stroke-width="2" stroke-linecap="square"/>
                            </svg>
                        </div>
                    <?php endif;?>
                    <article class="text-card relative w-full cards__text-card flex-col bg--<?= $card['card_theme'] ?>">
                        <?php if ($card['card_theme'] == 'gradient'):?>
                            <div class="text-card__shine text-card__shine--top absolute"></div>
                            <div class="text-card__shine text-card__shine--bottom absolute"></div>
                        <?php endif;?>
                        <?php if ($enable_tick):?>
                            <div class="text-card__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="wh-full" viewBox="0 0 50 50" fill="none">
                                  <path d="M16 23.8L23.0312 31L34.75 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                  <circle cx="25" cy="25" r="24" stroke="currentColor" stroke-width="2"/>
                                </svg>
                            </div>
                        <?php endif;?>
                        <?= render_card_content($card['flexible_content_blocks']) ?>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif;?>

        <?php if ($action_intro):?>
            <p class="cards__action-intro fz-p"><?= wp_kses_post($action_intro) ?></p>
        <?php endif;?>

        <?php if (is_array($link) && !empty($link)):?>

            <?= ArrowLink::render($link, $btn_theme . ' cards__action-link', $btn_attributes); ?>
        <?php endif;?>
    </div>
</section>
