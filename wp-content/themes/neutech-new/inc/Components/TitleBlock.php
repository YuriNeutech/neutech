<?php
namespace CleanTheme\Components;

use StoutLogic\AcfBuilder\FieldsBuilder;

class TitleBlock
{
    public static function getFields()
    {
        $layout_title = new FieldsBuilder('title_block');
        $layout_title
            ->addText('title_text', array(
                'label' => 'Heading Text',
                'wrapper' => ['width' => '50%'],
                'required' => 1,
            ))
            ->addSelect('title_tag', array(
                'label' => 'Heading Tag',
                'choices' => ['h1' => 'H2', 'h2' => 'H3', 'h3' => 'H4'],
                'default_value' => 'h1',
                'wrapper' => ['width' => '50%'],
            ));

        return $layout_title;
    }

    public static function render($tag, $text, $className = 'two-col__title') {
        if (preg_match('/^h([1-5])$/i', $tag, $matches)) {
            $html_tag = 'h' . ($matches[1] + 1);
        }
        if ($text) {
            echo "<{$html_tag} class='{$className} fz-{$tag}'>" . esc_html( $text ) . "</{$html_tag}>";
        }
    }
}