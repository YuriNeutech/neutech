<?php
namespace CleanTheme\Fields;

use CleanTheme\Components\ArrowLink;
use CleanTheme\Components\FieldHelpers;
use CleanTheme\Components\TaglineBlock;
use CleanTheme\Components\TextBlock;
use CleanTheme\Components\TitleBlock;

use StoutLogic\AcfBuilder\FieldsBuilder;

class TextContentFields {
    public function get_fields() {

        $instruction_image_url = get_template_directory_uri() . '/assets/images/instructions/text-banner-instructions.jpg';

        // --- MAIN SECTIN FIELDS --- 
        $text_content_fields = new FieldsBuilder('text_content_section', array(
            'title' => 'Text Banner',
            'style' => 'seamless',
        ));

        $text_content_fields
            ->setLocation('block', '==', 'acf/text-content-section');
        $text_content_fields->addMessage('text_content_instructions', FieldHelpers::get_block_header('Text Banner'), FieldHelpers::get_header_args());

        $text_content_fields->addGroup('global_settings', array(
            'label' => 'Global Settings'
        ))->addRadio('theme', array(
            'label' => 'Background Сolor',
            'choices' => ['white' => 'Light', 'black' => 'Dark', 'gray' => "Gray"],
            'default_value' => 'light',
            'return_format' => 'key',
            'layout' => 'horizontal',
            'wrapper' => ['width' => '50%'],
            'required' => 1
        ))->addTrueFalse('add_border_below', array(
            'label' => 'Add Border Below?',
            'default_value' => 0,
            'ui' => 1,
            'wrapper' => ['width' => '25%']
        ))->addTrueFalse('add_border_above', array(
            'label' => 'Add Border Above?',
            'default_value' => 0,
            'ui' => 1,
            'wrapper' => ['width' => '25%']
        ))->endGroup();
            
        // --- Content ---
        $text_content_fields->addFlexibleContent('flexible_content_blocks', array(
            'label' => 'Content',
            'button_label' => 'Add New Block',
        ))
            ->addLayout(TitleBlock::getFields(), array('label' => 'Title'))
            ->addLayout(TextBlock::getFields(), array('label' => 'Text'))
            ->addLayout(TaglineBlock::getFields(), array('label' => 'Tagline'))
            ->addLayout(ArrowLink::getFields(), array('label' => 'Action Link'))
        ->endFlexibleContent()

        ->addMessage('two_col_visual_guide', '
            <div style="margin-bottom: 15px;">
                <img src="' . esc_url($instruction_image_url) . '" alt="Two col visual Guide" style="max-width: 100%; height: auto; border-radius: 4px; border: 1px solid #c3c4c7; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            </div>
        ', [
            'label' => 'Blocks Visualization',
        ]);
       

        return $text_content_fields->build();
    }
}