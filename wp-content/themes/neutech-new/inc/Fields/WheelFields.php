<?php
namespace CleanTheme\Fields;

use CleanTheme\Components\FieldHelpers;
use StoutLogic\AcfBuilder\FieldsBuilder;

class WheelFields {
    public function get_fields() {

        // --- MAIN SECTION FIELDS --- 
        $wheel_fields = new FieldsBuilder('wheel_section', array(
            'title' => 'Wheel 3-Step Section',
            'style' => 'seamless',
        ));

        $wheel_fields
            ->setLocation('block', '==', 'acf/wheel-section')
            ->addMessage('wheel_instructions', FieldHelpers::get_block_header('Wheel 3-Step Section', ''), FieldHelpers::get_header_args());


        $wheel_fields->addGroup('heading', array(
            'label' => 'Heading'
        ))->addText('section_title', array(
            'label' => 'Section Title',
            'required' => 0,
            'wrapper' => ['width' => '50%']
        ))->addText('section_subtitle', array(
            'label' => 'Section Subtitle',
            'required' => 0,
            'wrapper' => ['width' => '50%']
        ))->endGroup();

        $wheel_fields->addRepeater('process', array(
            'label' => 'Wheel Process',
            'layout' => 'block',
            'button_label' => 'Add Process Item',
            'min' => 3,
            'max' => 3,
        ))
            ->addText('title', array(
                'label' => 'Title',
                'required' => 1,
                'wrapper' => ['width' => '50%']
            ))
            ->addText('subtitle', array(
                'label' => 'Subtitle',
                'required' => 1,
                'wrapper' => ['width' => '50%']
            ))
            ->addTextarea('description', array(
                'label' => 'Description',
                'required' => 1,
                'rows' => 3,
                'wrapper' => ['width' => '100%']
            ))
        ->endRepeater();
            
        return $wheel_fields->build();
    }
}