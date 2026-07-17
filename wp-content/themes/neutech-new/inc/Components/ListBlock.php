<?php
namespace CleanTheme\Components;

use StoutLogic\AcfBuilder\FieldsBuilder;

class ListBlock
{
    public static function getFields($field_name = 'list_block')
    {
        $layout_list = new FieldsBuilder($field_name);
        $layout_list
            ->addRepeater('list_items', array(
                'label' => 'List Items',
                'button_label' => 'Add Item',
                'layout' => 'block'
            ))
                ->addText('item_text', array('label' => 'Item Text', 'required' => 1))
            ->endRepeater();

        return $layout_list;
    
    }

    public static function render($items, $className = 'bordered-list two-col__list fz-title') {
        if ( ! empty($items) ) {
            echo "<ul class='{$className}'>";
            foreach ( $items as $item ) {
                echo "<li>" . esc_html( $item['item_text'] ) . "</li>";
            }
            
            echo '</ul>';
        }
    }
}