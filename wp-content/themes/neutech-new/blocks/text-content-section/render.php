<?php
    use CleanTheme\Components\ArrowLink;
    use CleanTheme\Components\TaglineBlock;
    use CleanTheme\Components\TitleBlock;
    use CleanTheme\Components\TextBlock;

    if ( ! empty( $block['data']['_is_inserter_preview'] ) ) {
        echo '<img src="' . get_template_directory_uri() . '/assets/images/admin/text-content-preview.jpg" style="width:100%;">';
        return;
    }

    $theme = get_field('global_settings')['theme'];

    if ( ! function_exists('render_text_content') ) {
        function render_text_content( $column_field_name ) {
            if ( have_rows( $column_field_name ) ) :
                while ( have_rows( $column_field_name ) ) : the_row();
                    
                    switch ( get_row_layout() ) {
                       
                        case 'title_block':
                            $text = get_sub_field('title_text');
                            $tag = get_sub_field('title_tag') ? get_sub_field('title_tag') : 'h2';
                            TitleBlock::render( $tag, $text, 'text-content__title' );
                            break;
                        case 'text_block':
                            TextBlock::render( get_sub_field('text_content'), 'text-content__text');
                            break;
                        case 'arrow_link_block':
                            $link = get_sub_field('link_data');
                            $btn_theme = 'btn--theme-accent text-content__btn';
                            $btn_attributes = 'data-movex="0.1" data-movey="0.1" data-cta-btn';
                            ArrowLink::render( $link, $btn_theme, $btn_attributes );
                            break;
                        case 'tagline':
                            TaglineBlock::render( get_sub_field('text'), 'text-content__tag' );
                            break;
                        default:
                    }

                endwhile;
            endif;
        }
    }


    $header_theme = "light";
    if ($theme == 'black') {
        $header_theme = "dark";
    }
?>

<section class="text-content bg--<?= $theme ?> pb--M  <?php if (get_field('global_settings')['add_border_below']):?> text-content--bordered_below <?php endif;?><?php if (get_field('global_settings')['add_border_above']):?> text-content--bordered_above <?php endif;?>" data-header-theme="<?= $header_theme ?>">
    <div class="container  relative text-content__container t-center">
        <?php render_text_content('flexible_content_blocks'); ?>
    </div>
</section>