<?php

namespace CleanTheme\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

class FaqFields
{
    public function get_fields()
    {
        // Group name 'faq_section' => field keys field_faq_section_<name>
        $faq = new FieldsBuilder('faq_section', [
            'title' => 'FAQ Section Settings',
            'style' => 'seamless',
        ]);

        $faq->setLocation('block', '==', 'acf/faq-section');

        $faq
            ->addText('eyebrow', [
                'label'         => 'Eyebrow',
                'default_value' => 'FAQ',
                'wrapper'       => ['width' => '40%'],
            ])
            ->addText('title', [
                'label'   => 'Heading',
                'wrapper' => ['width' => '60%'],
            ])
            ->addRepeater('items', [
                'label'        => 'Questions',
                'layout'       => 'block',
                'button_label' => 'Add Question',
                'min'          => 1,
            ])
                ->addText('question', [
                    'label'    => 'Question',
                    'required' => 1,
                ])
                ->addTextarea('answer', [
                    'label'     => 'Answer',
                    'required'  => 1,
                    'rows'      => 3,
                    'new_lines' => '',
                ])
            ->endRepeater();

        return $faq->build();
    }
}
