<?php

namespace CleanTheme\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

class BenefitsFields
{
public function get_fields()
    {
        $benefits = new FieldsBuilder('benefits_section', [
            'title' => 'Benefits Section Settings',
            'style' => 'seamless' // Remove borders from section
        ]);

        $benefits
            ->setLocation('block', '==', 'acf/benefits-slider-section');


        $benefits
            ->addRepeater('slides', [
                'label' => 'Slides',
                'layout' => 'block',
                'button_label' => 'Add Slide',
                'min' => 1
            ])
                ->addText('title', [
                    'label' => 'Slide Title',
                    'required' => 1,
                    'wrapper' => ['width' => '80%']
                ])
                ->addImage('image', [
                    'label' => 'Icon',
                    'return_format' => 'id',
                    'preview_size' => 'thumbnail',
                    'library' => 'all',
                    'wrapper' => ['width' => '20%'],
                ])
                ->addTextarea('description', [
                    'label' => 'Slide Desctiption',
                    'new_lines' => 'wpautop',
                ])
            ->endRepeater()
            ->addFields(ActionsCircleFields::getFields());

        return $benefits->build();
    }
}