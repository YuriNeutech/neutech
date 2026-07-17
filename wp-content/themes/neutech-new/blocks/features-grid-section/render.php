<?php

use CleanTheme\Components\ArrowLink;
use CleanTheme\Components\ListBlock;
use CleanTheme\Components\TaglineBlock;
use CleanTheme\Components\TextBlock;
use CleanTheme\Components\TitleBlock;

if ( ! empty( $block['data']['_is_inserter_preview'] ) ) {
    $preview_image_url = get_template_directory_uri() . '/assets/images/admin/features-grid-preview.jpg';
    echo '<img src="' . esc_url( $preview_image_url ) . '" style="width:100%; height:auto; display:block;">';
    return;
}

$global_settings = get_field('global_settings');
$theme           = $global_settings['theme'] ?? 'white';
$column_count    = $global_settings['columns_count'] ?? false;


if ( ! function_exists('render_features_grid_card_content') ) {
    function render_features_grid_card_content( $blocks ) {
        if ( empty( $blocks ) || ! is_array( $blocks ) ) return;

        foreach ( $blocks as $layout ) {
            switch ( $layout['acf_fc_layout'] ) {
                case 'title_block':
                    TitleBlock::render( 'h3', $layout['title_text'], 'features-grid__title' );
                    break;
                case 'text_block':
                    TextBlock::render( $layout['text_content'], 'features-grid__text w-full' );
                    break;
                case 'ticked_list_block':
                    ListBlock::render( $layout['list_items'], 'ticked-list features-grid__list fz-p' );
                    break;
                case 'unordered_list_block':
                    ListBlock::render( $layout['list_items'], 'ul-list features-list__list fz-p' );
                    break;
            }
        }
    }
}

$heading     = get_field('heading');
$title       = $heading['section_title'] ?? '';
$subtitle    = $heading['section_subtitle'] ?? '';
$cards       = get_field('cards');
$header_theme = ($theme === 'black') ? "dark" : "light";
$link = get_field('action_link');
$btn_theme = 'btn--theme-accent';
$btn_attributes = 'data-movex="0.1" data-movey="0.1" data-cta-btn';
if ($theme == 'action') {
    $btn_theme = 'btn--theme-white';
    $btn_attributes = '';
}
?>

<section class="features-grid pb--M bg--<?= esc_attr($theme) ?>" data-header-theme="<?= esc_attr($header_theme) ?>">
    <div class="container features-grid__container">
        <?php if (!empty($title) || !empty($subtitle)): ?>
            <div class="features-grid__heading t-center">
                <?php if (!empty($title)): ?>
                    <h2 class="features-grid__title fz-h1"><?= esc_html($title) ?></h2>
                <?php endif;?>
                <?php if (!empty($subtitle)): ?>
                    <p class="fz-h3 features-grid__subtitle"><?= esc_html($subtitle) ?></p>
                <?php endif;?>
            </div>
        <?php endif;?>

        <?php if (!empty($cards) && is_array($cards)): ?>
            <div class="features-grid__grid <?php if ($column_count): ?>d-grid features-grid__grid--col features-grid__grid--col_<?= (int)$column_count ?><?php else:?> flex-col features-grid__grid--row<?php endif;?>">
                <?php foreach($cards as $index => $card): ?>
                    <div class="features-grid__card">
                        <?php 
                            $number_label = sprintf('/%02d', $index + 1); 
                            TaglineBlock::render($number_label, 'features-grid__number'); 
                        ?>
                        
                        <?php 
                            if (!empty($card['flexible_content_blocks'])) {
                                render_features_grid_card_content($card['flexible_content_blocks']);
                            }
                        ?>
                    </div>
                <?php endforeach;?>
            </div>
        <?php endif;?>

        <?php if (is_array($link) && !empty($link)):?>

            <?= ArrowLink::render($link, $btn_theme . ' features-grid__action-link', $btn_attributes); ?>
        <?php endif;?>
    </div>
</section>