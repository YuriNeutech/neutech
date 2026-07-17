<?php
namespace CleanTheme\Components;

use StoutLogic\AcfBuilder\FieldsBuilder;

class ArrowLink {
    public static function getFields()
    {
        $arrow_link = new FieldsBuilder('arrow_link_block');

        $arrow_link
            ->addLink('link_data', [
                'label' => 'Link',
                'required' => 1,
                'instructions' => 'Select the URL, text, and target for this link.',
            ]);

        return $arrow_link;
    }

    public static function render($link = array(), $className = '', $attributes = '') {
        if (empty($link) && !is_array($link)) {
            return;
        }

        ?>
        <a href="<?= $link['url'] ?>" class="btn <?= $className ?> btn--arrow-pointer lower fz-btn flex-row relative" target="<?= $link['target'] ?>" <?= $attributes ?>>
            <span class="btn__text-wr"><?= $link['title'] ?></span>
            <span class="btn__icon-wr">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 19" fill="none">
                    <path d="M1.00053 17.9703L17.9711 0.999693M17.9711 0.999693H8.0716M17.9711 0.999693V10.8992" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
            <span class="btn__glow absolute"></span>
        </a>
        <?php
    }
}