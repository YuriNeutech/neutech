<?php
    use CleanTheme\Components\ArrowLink;
    use CleanTheme\Components\LayoutImage;
    use CleanTheme\Components\QuoteBlock;
    use CleanTheme\Components\SmallCards;
    use CleanTheme\Components\TaglineBlock;
    use CleanTheme\Components\TitleAndPowerBlock;
    use CleanTheme\Components\TitleBlock;
    use CleanTheme\Components\TextBlock;
    use CleanTheme\Components\ListBlock;
    use CleanTheme\Components\TagsBlock;

    if ( ! empty( $block['data']['_is_inserter_preview'] ) ) {
        echo '<img src="' . get_template_directory_uri() . '/assets/images/admin/two-col-preview.jpg" style="width:100%;">';
        return;
    }

    $theme = get_field('global_settings')['theme'];

    if ( ! function_exists('render_image_content_column') ) {
        function render_image_content_column( $column_field_name ) {
            if ( have_rows( $column_field_name ) ) :
                while ( have_rows( $column_field_name ) ) : the_row();
                    
                    switch ( get_row_layout() ) {
                       
                        case 'title_block':
                            $text = get_sub_field('title_text');
                            $tag = get_sub_field('title_tag') ? get_sub_field('title_tag') : 'h2';
                            TitleBlock::render( $tag, $text, 'two-col__title w-full' );
                            break;
                        case 'text_block':
                            TextBlock::render( get_sub_field('text_content'), 'two-col__text w-full');
                            break;
                        case 'list_block':
                            ListBlock::render( get_sub_field('list_items'), 'two-col__list w-full bordered-list fz-title' ); 
                            break;
                        case 'quote':
                            QuoteBlock::render( get_sub_field('quote_items'), 'two-col__quote w-full' );
                            break;
                        case 'image_block':
                            $className = 'two-col__img';
                            if (get_sub_field('add_background_shadow')) {
                                $className .= ' two-col__img--shadow';
                            }
                            LayoutImage::render( get_sub_field('image'), get_sub_field('size'), $className );
                            break;
                        case 'tags':
                            TagsBlock::render( get_sub_field('tags_items') );
                            break;
                        case 'title_power_block':
                            $title = get_sub_field('title_text');
                            $power = get_sub_field('title_tag');
                            TitleAndPowerBlock::render( $title, $power );
                            break;
                        case 'dotted_list_block':
                            ListBlock::render( get_sub_field('list_items'), 'dotted-list two-col__list fz-p w-full' );
                            break;
                        case 'crossed_list_block':
                            ListBlock::render( get_sub_field('list_items'), 'crossed-list two-col__list fz-p w-full' );
                            break;
                        case 'small_cards':
                            SmallCards::render( get_sub_field('cards') );
                            break;
                        case 'arrow_link_block':
                            $btn_theme = 'btn--theme-accent two-col__btn';
                            $btn_attributes = 'data-movex="0.1" data-movey="0.1" data-cta-btn';
                            if ($theme == 'action') {
                                $btn_theme = 'btn--theme-white  two-col__btn';
                                $btn_attributes = 'data-movex="0.1" data-movey="0.1" data-cta-btn';
                            }
                            ArrowLink::render( get_sub_field('link_data'), $btn_theme, $btn_attributes);
                            break;
                        case 'tagline':
                            TaglineBlock::render( get_sub_field('text'), 'two-col__tagline w-full' );
                            break;
                        default:
                    }

                endwhile;
            endif;
        }
    }

    $heading = get_field('heading');
    $title = $heading['section_title'];
    $subtitle = $heading['section_subtitle'];


    $header_theme = "light";
    if ($theme == 'black') {
        $header_theme = "dark";
    }
?>

<section class="two-col bg--<?= get_field('global_settings')['theme'] ?> pb--M <?php if (get_field('global_settings')['add_border_below']):?> relative two-col--bordered<?php endif;?>" data-header-theme="<?= $header_theme ?>">
    <?php if (!empty($title) || !empty($subtitle)): ?>
        <div class="two-col__heading container t-center">
            <?php if (!empty($title)): ?>
                <h2 class="two-col__title fz-h1"><?=  $title  ?></h2>
            <?php endif;?>
            <?php if (!empty($subtitle)): ?>
                <p class="fz-h3 two-col__subtitle"><?= $subtitle ?></p>
            <?php endif;?>
        </div>
    <?php endif;?>
    <div class="container two-col__container d-grid <?php if (get_field('global_settings')['swap_cols']):?> two-col__container--reverse<?php endif;?> a-<?= get_field('global_settings')['align_content'] ?>">
        
        <div class="two-col__col two-col__col--narrow flex-col">
            <?php render_image_content_column('flexible_content_blocks'); ?>
        </div>

        <div class="two-col__col two-col__col--second flex-col">
            <?php render_image_content_column('second_column_blocks'); ?>
        </div>

    </div>
</section>