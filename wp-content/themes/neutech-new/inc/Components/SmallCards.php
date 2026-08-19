<?php
namespace CleanTheme\Components;

use StoutLogic\AcfBuilder\FieldsBuilder;

class SmallCards
{
    public static function getFields()
    {
        $layout_list = new FieldsBuilder('small_cards');
        $layout_list
            ->addRepeater('cards', array(
                'label' => 'Cards',
                'button_label' => 'Add Card',
                'layout' => 'block',
                'min' => 1,
                'max' => 2
            ))
                ->addText('title', array('label' => 'Card Text', 'required' => 1))
                ->addText('subtitle', array('label' => 'Card Subtitle', 'required' => 1))
                ->addTextarea('desc', array('label' => 'Card Text'))
            ->endRepeater();

        return $layout_list;
    
    }

    public static function render($cards, $className = 'two-col__cards', $cardClassname = 'bg--gradient two-col__card') {
        if ( ! empty($cards) ) {
            ?>
            <div class="d-grid relative <?= $className ?>">
                <?php foreach ( $cards as $card ) :?>
                    <article class="text-card relative z1 w-full <?= $cardClassname ?> flex-col">
                        <div class="text-card__shine text-card__shine--top absolute"></div>
                        <div class="text-card__shine text-card__shine--bottom absolute"></div>
                        <div class="text-card__heading flex-row">
                           <?php if (!empty($card['title'])):?>
                                <h3 class="text-card__main-title fz-h2"><?=  $card['title']  ?></h3>
                            <?php endif;?>
                            <?php if (!empty($card['subtitle'])):?>
                                <div class="text-card__subtitle flex-row fz-title">
                                    <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 11.8387L6.54167 6.41935L1 1" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    </svg>

                                    <span><?= $card['subtitle'] ?></span>
                                </div>
                            <?php endif;?>
                        </div>
         
                        <?php if (!empty($card['desc'])):?>
                            <div class="text-card__text fz-title"><?= $card['desc'] ?></div>
                        <?php endif;?>
                    </article>
                <?php endforeach;?>
            </div>
            <?php
        }
    }
}