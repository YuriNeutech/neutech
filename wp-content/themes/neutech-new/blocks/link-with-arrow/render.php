<?php
    /**
     * Arrow Link Block Render Template.
     */

    // Preview for the block inserter
    if ( ! empty( $block['data']['_is_inserter_preview'] ) ) {

        $preview_image_url = get_template_directory_uri() . '/assets/images/admin/link-with-arrow-preview.jpg';
        echo '<img src="' . esc_url( $preview_image_url ) . '" style="width:100%; height:auto; display:block;" alt="Hero Preview">';
        return;
    }

    $link = get_field('link_data');

    if ( ! $link ) return;

    $url    = esc_url($link['url']);
    $title  = esc_html($link['title']);
    $target = $link['target'] ? esc_attr($link['target']) : '_self';
?>


<a href="<?= $url; ?>" 
   class="arrow-link fz-title flex-row" 
   target="<?= $target; ?>" 
   <?php if($target === '_blank') echo 'rel="noopener noreferrer"'; ?>>
    
    <span class="arrow-link__text"><?= $title; ?></span>

    <span class="arrow-link__icon-wr">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" fill="none" class="full-wh">
            <path d="M0.99905 12.3135L12.3128 0.999795M12.3128 0.999795H5.7131M12.3128 0.999795V7.59946"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </span>
</a>
