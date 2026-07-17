<?php
    use CleanTheme\Components\ArrowLink;
    $theme = get_field('global_settings')['theme'];
    $content_block_theme = get_field('global_settings')['content_block_theme'];
    if ( ! empty( $block['data']['_is_inserter_preview'] ) ) {
        echo '<img src="' . get_template_directory_uri() . '/assets/images/admin/text-button-block-section.jpg" style="width:100%;">';
        return;
    }

    $header_theme = "light";
    if ($theme == 'black') {
        $header_theme = "dark";
    }
?>

<section class="text-button bg--<?= $theme ?> pb--M" data-header-theme="<?= $header_theme ?>">
    <div class="container text-button__container t-center bg--<?= $content_block_theme ?>">
        <?php if (!empty(get_field('title'))):?>
            <h2 class="fz-h1 text-button__title"><?= get_field('title') ?></h2>
        <?php endif;?>
        <?php if (!empty(get_field('subtitle'))):?>
            <p class="text-button__subtitle fz-title"><?=  get_field('subtitle') ?></p>
        <?php endif;?>
        <?php if (!empty(get_field('action_link'))):?>
            <?php
                $link = get_field('action_link');
                $btn_theme = 'btn--theme-accent text-button__btn';
                $btn_attributes = 'data-movex="0.1" data-movey="0.1" data-cta-btn';
                $content_block_theme = get_field('global_settings')['content_block_theme'];
                if ($content_block_theme == 'action') {
                    $btn_theme = 'btn--theme-white  text-button__btn';
                    $btn_attributes = 'data-movex="0.1" data-movey="0.1" data-cta-btn';
                }

                ArrowLink::render( $link, $btn_theme, $btn_attributes );    
            ?>
        <?php endif;?>
    </div>
</section>