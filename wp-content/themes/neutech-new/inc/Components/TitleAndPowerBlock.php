<?php
namespace CleanTheme\Components;

use StoutLogic\AcfBuilder\FieldsBuilder;

class TitleAndPowerBlock
{
    public static function getFields()
    {
        $layout_title = new FieldsBuilder('title_power_block');
        $layout_title
            ->addMessage('title_block_instructions', 'On desktop this block always first', [
                'label' => 'Notice',
                'new_lines' => 'wpautop',
                'esc_html' => 0,
            ])
            ->addText('title_text', array(
                'label' => 'Heading Text',
                'wrapper' => ['width' => '50%'],
                'required' => 1,
            ))
            ->addText('title_tag', array(
                'label' => 'Heading Tag',
                'wrapper' => ['width' => '50%'],
                'required' => 1,
            ));

        return $layout_title;
    }

    public static function render($title, $power, $className = 'two-col__heading') {
        ?>
            <div class="<?= $className ?> flex-row j-between">
                <h2 class="fz-h2"><?= $title ?></h2>
                <span class="tagline c-action lower fz-nav"><?= $power ?></span>
            </div>
        <?php
    }
}