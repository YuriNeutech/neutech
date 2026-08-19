<?php
namespace CleanTheme\Fields;

use CleanTheme\Components\ArrowLink;
use CleanTheme\Components\FieldHelpers;
use CleanTheme\Components\SmallCards;
use CleanTheme\Components\TaglineBlock;
use CleanTheme\Components\TagsBlock;
use CleanTheme\Components\TextBlock;
use CleanTheme\Components\TitleAndPowerBlock;
use CleanTheme\Components\TitleBlock;
use CleanTheme\Components\QuoteBlock;
use CleanTheme\Components\ListBlock;
use CleanTheme\Components\LayoutImage;
use StoutLogic\AcfBuilder\FieldsBuilder;

class TwoColFields {
    public function get_fields() {

    $instruction_image_url = get_template_directory_uri() . '/assets/images/instructions/two-col-instructions.jpg';

        // --- MAIN SECTIN FIELDS --- 
        $two_col_fields = new FieldsBuilder('two_col_section', array(
            'title' => 'Two Columns',
            'style' => 'seamless',
        ));

        $two_col_fields
            ->setLocation('block', '==', 'acf/two-col-section');

        $two_col_fields
            ->addMessage('two_col_instructions', FieldHelpers::get_block_header('Two Columns', '<strong>Notice</strong>: First column is smaller that second one'), FieldHelpers::get_header_args());

        $two_col_fields->addGroup('global_settings', array(
            'label' => 'Global Settings'
        ))->addRadio('theme', array(
            'label' => 'Background Color',
            'choices' => ['white' => 'Light', 'black' => 'Dark', 'gray' => "Gray", "action" => "Red"],
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
        ))->addTrueFalse('swap_cols',   array(
            'label' => 'Swap Columns?',
            'default_value' => 0,
            'ui' => 1,
            'wrapper' => ['width' => '25%']
        ))->addRadio('align_content', array(
            'label' => 'Align Content',
            'choices' => ['start' => 'Top', 'center' => 'Center', 'end' => 'Bottom'],
            'default_value' => 'start',
            'return_format' => 'key',
            'layout' => 'horizontal',
        ))->endGroup();

        $two_col_fields->addGroup('heading', array(
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
            
        // --- FIRST COLUMN ---
        $two_col_fields->addFlexibleContent('flexible_content_blocks', array(
            'label' => 'First Column',
            'button_label' => 'Add New Block',
            'wrapper' => ['width' => '50%'],

        ))
            ->addLayout(TitleBlock::getFields(), array('label' => 'Title'))
            ->addLayout(TextBlock::getFields(), array('label' => 'Text'))
            ->addLayout(ListBlock::getFields(), array('label' => 'Bordered List'))
            ->addLayout(ListBlock::getFields('dotted_list_block'), array('label' => 'Dotted List'))
            ->addLayout(ListBlock::getFields('crossed_list_block'), array('label' => 'Crossed List'))
            // ->addLayout(ListBlock::getFields('ticked_list_block'), array('label' => 'Ticked List'))
            ->addLayout(QuoteBlock::getFields(), array('label' => 'Quote'))
            ->addLayout(LayoutImage::getFields(), array('label' => 'Image'))
            ->addLayout(TagsBlock::getFields(), array('label' => 'Tags'))
            ->addLayout(TitleAndPowerBlock::getFields(), array('label' => 'Title and Tag'))
            ->addLayout(SmallCards::getFields(), array('label' => 'Small Cards'))
            ->addLayout(ArrowLink::getFields(), array('label' => 'Action Link'))
            ->addLayout(TaglineBlock::getFields(), array('label' => 'Tagline'))

        ->endFlexibleContent()

        // ---- SECOND COLUMN ---
        ->addFlexibleContent('second_column_blocks', array(
            'label' => 'Second Column',
            'button_label' => 'Add New Block',
            'wrapper' => ['width' => '50%']
        ))
            ->addLayout(TitleBlock::getFields(), array('label' => 'Title'))
            ->addLayout(TextBlock::getFields(), array('label' => 'Text'))
            ->addLayout(ListBlock::getFields(), array('label' => 'Bordered List'))
            ->addLayout(ListBlock::getFields('dotted_list_block'), array('label' => 'Dotted List'))
            ->addLayout(ListBlock::getFields('crossed_list_block'), array('label' => 'Crossed List'))
            // ->addLayout(ListBlock::getFields('ticked_list_block'), array('label' => 'Ticked List'))
            ->addLayout(QuoteBlock::getFields(), array('label' => 'Quote'))
            ->addLayout(LayoutImage::getFields(), array('label' => 'Image'))
            ->addLayout(TagsBlock::getFields(), array('label' => 'Tags'))
            ->addLayout(TitleAndPowerBlock::getFields(), array('label' => 'Title and Tag'))
            ->addLayout(SmallCards::getFields(), array('label' => 'Small Cards'))
            ->addLayout(ArrowLink::getFields(), array('label' => 'Action Link'))
            ->addLayout(TaglineBlock::getFields(), array('label' => 'Tagline'))

        ->endFlexibleContent()
        ->addMessage('two_col_visual_guide', '
            <div style="margin-bottom: 15px;">
                <img src="' . esc_url($instruction_image_url) . '" alt="Two col visual Guide" style="max-width: 100%; height: auto; border-radius: 4px; border: 1px solid #c3c4c7; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            </div>
        ', [
            'label' => 'Blocks Visualization',
        ]);

        return $two_col_fields->build();
    }
}