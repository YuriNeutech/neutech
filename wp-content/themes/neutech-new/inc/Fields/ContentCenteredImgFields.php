<?php

namespace CleanTheme\Fields;

use CleanTheme\Components\FieldHelpers;
use CleanTheme\Components\QuoteBlock;
use CleanTheme\Components\TextBlock;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ContentCenteredImgFields
{
    public function get_fields()
    {
        $instruction_image_url = get_template_directory_uri() . '/assets/images/instructions/content-image-instructions.jpg';

        $content_img_fields = new FieldsBuilder('content_centered_img_section', [
            'title' => 'Centered Image Section',
            'style' => 'seamless' 
        ]);

        $content_img_fields
            ->setLocation('block', '==', 'acf/content-centered-image-section')->addMessage('content_centered_img_section_instructions', FieldHelpers::get_block_header('Centered Image Section', ''), FieldHelpers::get_header_args());


        $content_img_fields
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
                ->addRadio('title_position', array(
                    'label' => 'Title Position',
                    'choices' => ['left' => 'Left', 'right' => 'Right'],
                    'default_value' => 'left',
                    'return_format' => 'key',
                    'layout' => 'horizontal',
                    'wrapper' => ['width' => '50%'],
                    'required' => 1
                ))
            ->endGroup()
            ->addText('title', [
                'label' => 'Title',
                'default_value' => '',
                'required' => 1,
                'wrapper' => array('width' => '50%')
            ])
            ->addImage('image', [
                'label' => 'Image',
                'preview_size' => 'medium',
                'library' => 'all',
                'wrapper' => array('width' => '50%'),
                'required' => 1,
            ])
            ->addFlexibleContent('flexible_content_blocks', array(
                'label' => 'Content',
                'button_label' => 'Add New Block',
            ))
                ->addLayout(QuoteBlock::getFields(), array('label' => 'Quote'))
                ->addLayout(TextBlock::getFields(), array('label' => 'Text'))
            ->endFlexibleContent()

            ->addMessage('two_col_visual_guide', '
                <div style="margin-bottom: 15px;">
                    <img src="' . esc_url($instruction_image_url) . '" alt="Two col visual Guide" style="max-width: 100%; height: auto; border-radius: 4px; border: 1px solid #c3c4c7; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                </div>
            ', [
                'label' => 'Blocks Visualization',
            ]);


        return $content_img_fields->build();
    }
}