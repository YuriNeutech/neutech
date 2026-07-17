<?php
namespace CleanTheme\Components;

use StoutLogic\AcfBuilder\FieldsBuilder;

class TagsBlock
{
    public static function getFields()
    {
        $layout_quote = new FieldsBuilder('tags');
        $layout_quote
            ->addRepeater('tags_items', array(
                'label' => 'Tags',
                'button_label' => 'Add Tag',
                'layout' => 'block'
            ))
                ->addText('tag_text', array(
                    'label' => 'Tag Text', 
                    'required' => 1,
                ))
            ->endRepeater();

        return $layout_quote;
    }

    public static function render($tags_items, $className = 'two-col__tags') {
        if (!empty($tags_items)) {
            echo "<div class='{$className} tags-block flex-row-wrap'>";
            foreach ($tags_items as $item) {
               echo "<span class='tags-block__tag fz-title'>";
               echo $item['tag_text'];
               echo "</span>";
            }
            echo '</div>';
        }
    }
}