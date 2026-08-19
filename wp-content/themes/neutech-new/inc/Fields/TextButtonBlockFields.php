<?php

namespace CleanTheme\Fields;

use CleanTheme\Components\FieldHelpers;
use StoutLogic\AcfBuilder\FieldsBuilder;

class TextButtonBlockFields
{
    public function get_fields()
    {

        $text_button_fields = new FieldsBuilder('text_button_block_section', [
            'title' => 'CTA Banner Settings',
            'style' => 'seamless' 
        ]);

        $text_button_fields
            ->setLocation('block', '==', 'acf/text-button-block-section')->addMessage('text_content_instructions', FieldHelpers::get_block_header('CTA Banner'), FieldHelpers::get_header_args());;


        $text_button_fields
            ->addGroup('global_settings', array(
                'label' => 'Global Settings'
            ))
                ->addRadio('theme', array(
                    'label' => 'Background Color',
                    'choices' => ['white' => 'Light', 'black' => 'Dark', 'gray' => "Gray"],
                    'default_value' => 'light',
                    'return_format' => 'key',
                    'layout' => 'horizontal',
                    'wrapper' => ['width' => '50%'],
                    'required' => 1
                ))
                ->addRadio('content_block_theme', array(
                    'label' => 'Content Block Theme',
                    'choices' => ['black' => 'Dark', "action" => "Red"],
                    'default_value' => 'action',
                    'return_format' => 'key',
                    'layout' => 'horizontal',
                    'required' => 1,
                    'wrapper' => ['width' => '50%']
                ))
            ->endGroup()
            ->addText('title', [
                'label' => 'Title',
                'default_value' => '',
                'required' => 1,
                'wrapper' => array('width' => '33%')
            ])
            ->addTextarea('subtitle', array(
                'label' => 'Subtitle',
                'wrapper' => array('width' => '33%')
            ))
            ->addLink('action_link', array(
                'label' => 'Action Link',
                'instructions' => '',
                'required' => 0,
                'wrapper' => array('width' => '33%')
            ));

        return $text_button_fields->build();
    }
}