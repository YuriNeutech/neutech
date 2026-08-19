<?php
namespace CleanTheme\Components;

use StoutLogic\AcfBuilder\FieldsBuilder;

class QuoteBlock
{
    public static function getFields()
    {
        $layout_quote = new FieldsBuilder('quote');
        $layout_quote
            ->addRepeater('quote_items', array(
                'label' => 'Quote Items',
                'button_label' => 'Add Item',
                'layout' => 'block'
            ))
                ->addTextarea('quote_text', array(
                    'label' => 'Quote Text', 
                    'rows'=> 2,
                    'wrapper' => ['width' => '50%'],
                    'required' => 1,
                    'new_lines' => 'br',
                ))
                ->addRadio('text_color', array(
                    'label' => 'Text Color',
                    'choices' => ['default' => 'Default', 'action' => 'Red'],
                    'default_value' => 'default',
                    'wrapper' => ['width' => '50%'],
                    'return_format' => 'key',
                    'layout' => 'horizontal',
                    'required' => 1,
                ))
            ->endRepeater();

        return $layout_quote;
    }

    public static function render($quote_items, $className = 'two-col__quote') {
        if (!empty($quote_items)) {
            echo "<div class='{$className} quote-block d-flex fz-h2'>";
            echo '<svg xmlns="http://www.w3.org/2000/svg" class="quote-block__icon" viewBox="0 0 30 37" fill="none"><path d="M2 2V26.7742H27M27 26.7742L19.7083 34M27 26.7742L19.7083 19.5484" stroke="currentColor" stroke-width="4" stroke-linecap="square"/></svg>';
            echo '<blockquote>';
            foreach ($quote_items as $item) {
               echo "<p class='c-{$item['text_color']}'>";
               echo $item['quote_text'];
               echo "</p>";
            }
            echo '</blockquote>';
            echo '</div>';
        }
    }
}