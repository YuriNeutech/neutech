<?php
namespace CleanTheme\Components;

use StoutLogic\AcfBuilder\FieldsBuilder;

class TaglineBlock
{
    public static function getFields()
    {
        $layout_text = new FieldsBuilder('tagline');
        $layout_text
            ->addText('text', array(
                'label' => 'Text',
                'required' => 1,
            ));
        return $layout_text;
    
    }

    public static function render($content, $className = '') {
        if ( $content ) {
            echo "<span class='{$className} tagline c-action lower fz-nav'>" .  $content  . "</span>";
        }
    }
}