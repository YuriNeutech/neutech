<?php
namespace CleanTheme\Fields;

use CleanTheme\Components\FieldHelpers;
use CleanTheme\Components\ListBlock;
use CleanTheme\Components\TextBlock;

use StoutLogic\AcfBuilder\FieldsBuilder;

class FeaturesGridFields {
    public function get_fields() {

        $instruction_image_url = get_template_directory_uri() . '/assets/images/instructions/grid-instructions.jpg';

        // --- MAIN SECTION FIELDS --- 
        $cards_fields = new FieldsBuilder('features_grid_section', array(
            'title' => 'Grid Section',
            'style' => 'seamless',
        ));

        $cards_fields
            ->setLocation('block', '==', "acf/featured-grid-section")
            ->addMessage('grid_instructions', FieldHelpers::get_block_header('Grid Section', ''), FieldHelpers::get_header_args());

        $cards_fields->addGroup('global_settings', array(
            'label' => 'Global Settings'
        ))->addRadio('theme', array(
            'label' => 'Section Background color',
            'choices' => ['white' => 'Light', 'dark' => 'Dark', 'gray' => "Gray", "action" => "Red"],
            'default_value' => 'light',
            'return_format' => 'key',
            'layout' => 'horizontal',
            'wrapper' => ['width' => '50%']
        ))->addNumber('columns_count', array(
            'label' => 'Columns count',
            'min' => 1,
            'max' => 5,
            'instructions' => 'Default to cards count',
            'required' => 0,
            'wrapper' => ['width' => '50%']
        ))->endGroup();

        $cards_fields->addGroup('heading', array(
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

        $cards_fields->addRepeater('cards', array(
            'label' => 'Cards',
            'layout' => 'block',
            'button_label' => 'Add Card',
            'min' => 1
        ))
            ->addFlexibleContent('flexible_content_blocks', array(
                'label' => 'Card content',
                'button_label' => 'Add New Block',
                'wrapper' => ['width' => '100%'],
            ))
                ->addLayout('title_block', array(
                    'label' => 'Title',
                    'wrapper' => ['width' => '100%'],
                ))
                    ->addText('title_text', array(
                        'label' => 'Heading Text',
                        'required' => 1,
                    ))
                ->addLayout(TextBlock::getFields(), array('label' => 'Text'))
                ->addLayout(ListBlock::getFields('ticked_list_block'), array('label' => 'Ticked List'))
                ->addLayout(ListBlock::getFields('unordered_list_block'), array('label' => 'Simple dotted List'))
            ->endFlexibleContent()
        ->endRepeater();

        $cards_fields->addLink('action_link', array(
            'label' => 'Action Link',
            'instructions' => '',
            'required' => 0
        ))

        ->addMessage('two_col_visual_guide', '
            <div style="margin-bottom: 15px;">
                <img src="' . esc_url($instruction_image_url) . '" alt="Two col visual Guide" style="max-width: 100%; height: auto; border-radius: 4px; border: 1px solid #c3c4c7; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            </div>
        ', [
            'label' => 'Blocks Visualization',
        ]);
            
        return $cards_fields->build();
    }
}