<?php
namespace CleanTheme\Components;

use StoutLogic\AcfBuilder\FieldsBuilder;

class TextBlock
{
    public static function getFields()
    {
        $layout_text = new FieldsBuilder('text_block');
        $layout_text
            ->addWysiwyg('text_content', array(
                'label' => 'Content',
                'rows'=> 2,
                'new_lines' => 'wpautop',
                'required' => 1,
                'toolbar' => 'bold_only',
                'media_upload' => 0,
                'delay' => 0,
            ));
        return $layout_text;
    
    }

    public static function render($content, $className = 'two-col__text') {
        if ( $content ) {
            echo "<div class='{$className} fz-p'>" .  $content  . "</div>";
        }
    }
}