<?php

namespace CleanTheme\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;
use CleanTheme\Fields\ActionsCircleFields;

class HeroFields
{
    public function get_fields()
    {
        // 'hero_section' - unique section key
        $hero = new FieldsBuilder('hero_section', [
            'title' => 'Hero Section Settings',
            'style' => 'seamless' // Remove borders from section
        ]);

        $hero
            ->setLocation('block', '==', 'acf/hero-section');


        $hero
            ->addMessage('hero_instructions_top', 'Highlight the word in italics to apply the pill style.', [
                'label'   => 'How to edit the title',
                'wrapper' => [
                    'class' => 'info-box-top',
                    'style' => 'background: #f0f0f1; padding: 10px; border-left: 4px solid #0073aa; margin-bottom: 15px;',
                ],
            ])
            ->addText('eyebrow', [
                'label' => 'Eyebrow (optional)',
                'instructions' => 'Small label above the title.',
            ])
            ->addWysiwyg('title', [
                'label' => 'Hero Text',
                'default_value' => 'Welcome to NeuTech',
                'required' => 1,
                'toolbar' => 'italic_only',
                'media_upload' => 0,
                'delay' => 0,
            ])
            ->addTextarea('subtitle', [
                'label' => 'Subtitle (optional)',
                'rows' => 3,
                'new_lines' => '',
            ])
            ->addLink('primary_button', [
                'label' => 'Primary button (optional)',
                'wrapper' => ['width' => '50%'],
            ])
            ->addLink('secondary_button', [
                'label' => 'Secondary button (optional)',
                'wrapper' => ['width' => '50%'],
            ])
            ->addTrueFalse('show_visual', [
                'label' => 'Show the stacked-plates visual on the right',
                'ui' => 1,
                'default_value' => 0,
            ])
            ->addFields(ActionsCircleFields::getFields());

        return $hero->build();
    }
}
