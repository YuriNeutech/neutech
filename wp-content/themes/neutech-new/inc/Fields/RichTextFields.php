<?php

namespace CleanTheme\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

class RichTextFields
{
    public function get_fields()
    {
        // Group name 'rich_text_section' => field keys field_rich_text_section_<name>
        $rich = new FieldsBuilder('rich_text_section', [
            'title' => 'Rich Text Section Settings',
            'style' => 'seamless',
        ]);

        $rich->setLocation('block', '==', 'acf/rich-text-section');

        $rich
            ->addSelect('theme', [
                'label'         => 'Background',
                'choices'       => ['white' => 'White', 'light' => 'Light grey'],
                'default_value' => 'white',
                'wrapper'       => ['width' => '30%'],
            ])
            ->addText('eyebrow', [
                'label'   => 'Eyebrow',
                'wrapper' => ['width' => '70%'],
            ])
            ->addText('title', [
                'label' => 'Heading',
            ])
            ->addWysiwyg('body', [
                'label'        => 'Body',
                'tabs'         => 'all',
                'media_upload' => 0,
            ]);

        return $rich->build();
    }
}
