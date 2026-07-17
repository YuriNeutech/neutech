<?php 

use CleanTheme\Components\QuoteBlock;
use CleanTheme\Components\TextBlock;

    if ( ! empty( $block['data']['_is_inserter_preview'] ) ) {
        echo '<img src="' . get_template_directory_uri() . '/assets/images/admin/content-centered-image-preview.jpg" style="width:100%;">';
        return;
    }

    $theme = get_field('global_settings')['theme'];

    if ( ! function_exists('render_img_center_content') ) {
        function render_img_center_content( $column_field_name ) {
            if ( have_rows( $column_field_name ) ) :
                while ( have_rows( $column_field_name ) ) : the_row();
                    
                    switch ( get_row_layout() ) {
                        case 'quote':
                            QuoteBlock::render( get_sub_field('quote_items'), 'center-img-content__quote' );
                            break;
                        case 'text_block':
                            TextBlock::render( get_sub_field('text_content'), 'center-img-content__text');
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

<section class="bg--<?= $theme ?> pb--M center-img-content"  data-header-theme="<?= $header_theme ?>">
    <div class="relative container center-img-content__container flex-col center-img-content__container--dir_<?= get_field('global_settings')['title_position'] ?>">
        <?php if (!empty(get_field('image'))):?>
            <div class="center-img-content__img">
                <?php echo wp_get_attachment_image( get_field('image')['ID'], 'large', false, ['width' => 183, 'height' => 92, 'loading' => 'lazy', 'class' => 'w-full relative'] ); ?>
            </div>
        <?php endif;?>  

        <?php if (!empty(get_field('title'))): ?>
            <h2 class="fz-h1 center-img-content__title"><?=  get_field('title')?></h2>
        <?php endif;?>

        <div class="center-img-content__content">
            <?php render_img_center_content('flexible_content_blocks'); ?>
        </div>
    </div>
</section>