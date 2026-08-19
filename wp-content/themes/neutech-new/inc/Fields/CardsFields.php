<?php

namespace CleanTheme\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

class CardsFields
{
    public function get_fields()
    {
        // Group name 'cards_section' => field keys field_cards_section_<name>.
        // Repeater subfields are prefixed item_* to avoid colliding with the
        // section-head fields (eyebrow/title) in the same key namespace.
        $cards = new FieldsBuilder('cards_section', [
            'title' => 'Cards Section Settings',
            'style' => 'seamless',
        ]);

        $cards->setLocation('block', '==', 'acf/cards-section');

        $cards
            ->addSelect('theme', [
                'label'         => 'Background',
                'choices'       => ['light' => 'Light grey', 'white' => 'White (numbered)'],
                'default_value' => 'light',
                'wrapper'       => ['width' => '34%'],
            ])
            ->addSelect('columns', [
                'label'         => 'Columns',
                'choices'       => [3 => '3 columns', 2 => '2 columns'],
                'default_value' => 3,
                'wrapper'       => ['width' => '33%'],
            ])
            ->addTrueFalse('center', [
                'label'   => 'Center the heading',
                'ui'      => 1,
                'wrapper' => ['width' => '33%'],
            ])
            ->addText('eyebrow', [
                'label'   => 'Eyebrow',
                'wrapper' => ['width' => '40%'],
            ])
            ->addText('title', [
                'label'   => 'Heading',
                'wrapper' => ['width' => '60%'],
            ])
            ->addTextarea('intro', [
                'label'      => 'Intro',
                'rows'       => 2,
                'new_lines'  => '',
            ])
            ->addRepeater('items', [
                'label'        => 'Cards',
                'layout'       => 'block',
                'button_label' => 'Add Card',
                'min'          => 1,
            ])
                ->addText('item_eyebrow', [
                    'label'   => 'Eyebrow (optional)',
                    'wrapper' => ['width' => '40%'],
                ])
                ->addText('item_title', [
                    'label'    => 'Title',
                    'required' => 1,
                    'wrapper'  => ['width' => '60%'],
                ])
                ->addTextarea('item_text', [
                    'label' => 'Text',
                    'rows'  => 3,
                ])
                ->addText('item_meta', [
                    'label'   => 'Meta (optional, e.g. a date)',
                    'wrapper' => ['width' => '50%'],
                ])
                ->addLink('item_link', [
                    'label'   => 'Link (optional — makes the whole card clickable)',
                    'wrapper' => ['width' => '50%'],
                ])
            ->endRepeater();

        return $cards->build();
    }
}
