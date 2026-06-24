<?php
namespace CleanTheme\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

class ActionsCircleFields
{
    public static function getFields()
    {
        $actionCircle = new FieldsBuilder('action_circle_module');

        $actionCircle->addGroup('action_circle_settings', [
            'label' => 'Action Icon Settings'
        ])
            ->addTrueFalse('enable', [
                'label' => 'Enable Action Icon?',
                'ui' => 1
            ])
            ->addSelect('action_style', [
                'label' => "Select Icon Type",
                'wrapper' => ['width' => '33%'],
                'choices' => [
                    'arrows' => 'Arrows',
                    'circle' => 'Circle'
                ],
                'default_value' => 'arrows',
                'return_format' => 'key',
            ])
                ->conditional('enable', '==', '1')
            ->addSelect('direction', [
                'label' => 'Select Scroll Direction',
                'wrapper' => ['width' => '33%'],
                'choices' => [
                    'up' => 'Up',
                    'right' => 'Right',
                    'down' => 'Down',
                    'left' => 'Left'
                ],
                'default_value' => 'Down',
                'return_format' => 'key'
            ])
                ->conditional('action_style', '==', 'arrows')
            ->addTextarea('message', [
                'label' => 'Message',
                'rows' => 3,
                'wrapper' => ['width' => '33%'],
                'new_lines' => 'br'
            ])
        ->endGroup();

        return $actionCircle;
    }
}