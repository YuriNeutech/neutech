<?php

namespace CleanTheme\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

class ProcessStepsFields
{
    public function get_fields()
    {
        $process_steps = new FieldsBuilder('process_steps', [
            'title' => 'Services List Full With Section',
            'style' => 'seamless'
        ]);

        $process_steps
            ->setLocation('block', '==', 'acf/process-steps-section');


        $process_steps
            ->addRepeater('steps', [
                'label' => 'Steps',
                'layout' => 'block',
                'button_label' => 'Add Step',
                'min' => 1
            ])
            ->addText('title', array(
                'label' => "Title",
                'required' => 1,
                'wrapper' => [
                    'width' => '50%',
                ],
            ))
                ->addLink('link', [
                    'label' => 'Link',
                    'instructions' => '',
                    'required' => 0,
                    'wrapper' => [
                        'width' => '50%',
                    ],
                    'return_format' => 'array',
                ])
                ->addTextarea('description', [
                    'label' => 'Description',
                    'wrapper' => ['width' => '100%'],
                    'rows' => 3,
                ]);
            
        $process_steps
            ->addFields(ActionsCircleFields::getFields());

        return $process_steps->build();
    }
}
