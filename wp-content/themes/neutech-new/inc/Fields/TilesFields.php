<?php
namespace CleanTheme\Fields;

use CleanTheme\Components\FieldHelpers;
use CleanTheme\Components\ListBlock;
use CleanTheme\Components\TaglineBlock;
use CleanTheme\Components\TextBlock;
use CleanTheme\Components\TitleBlock;

use StoutLogic\AcfBuilder\FieldsBuilder;

class TilesFields {
    public function get_fields() {

        $instruction_image_url = get_template_directory_uri() . '/assets/images/instructions/tiles-instructions.jpg';

        // --- MAIN SECTION FIELDS --- 
        $cards_fields = new FieldsBuilder('tiles_section', array(
            'title' => 'Tiles Section',
            'style' => 'seamless',
        ));

        $cards_fields
            ->setLocation('block', '==', 'acf/tiles-section')
            ->addMessage('two_col_instructions', FieldHelpers::get_block_header('Tiles Section', ''), FieldHelpers::get_header_args());

        $cards_fields->addGroup('global_settings', array(
            'label' => 'Global Settings'
        ))->addRadio('theme', array(
            'label' => 'Section Background Color',
            'choices' => ['white' => 'Light', 'dark' => 'Dark', 'gray' => "Gray", "action" => "Red", "gradient" => "Gradient"],
            'default_value' => 'light',
            'return_format' => 'key',
            'layout' => 'horizontal',
            'wrapper' => ['width' => '33%']
        ))->addTrueFalse('enable_tick_icons', array(
            'label' => 'Enable Check Icons On Cards?',
            'default_value' => 0,
            'ui' => 1,
            'wrapper' => ['width' => '33%']
        ))->addTrueFalse('enable_arrows', array(
            'label' => 'Add Arrows Between Cards?',
            'default_value' => 0,
            'ui' => 1,
            'wrapper' => ['width' => '33%']
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
            ->addRadio('card_theme', array(
                'label' => 'Card Background Color',
                'choices' => ['white' => 'Light', 'black' => 'Dark', 'gray' => "Gray", "action" => "Red", "gradient" => "Gradient"],
                'default_value' => 'light',
                'return_format' => 'key',
                'layout' => 'horizontal',
                'wrapper' => ['width' => '50%']
            ))
            ->addFlexibleContent('flexible_content_blocks', array(
                'label' => 'Card Content',
                'button_label' => 'Add New Block',
                'wrapper' => ['width' => '100%'],
            ))
                ->addLayout(TitleBlock::getFields(), array('label' => 'Title'))
                ->addLayout(TextBlock::getFields(), array('label' => 'Text'))
                ->addLayout(TaglineBlock::getFields(), array('label' => 'Tagline'))
                ->addLayout('progress', array(
                    'label' => 'Progress Line',
                    'wrapper' => ['width' => '100%'],
                ))
                    ->addRepeater('progress_items', array(
                        'label' => 'Progress Items',
                        'layout' => 'block',
                        'button_label' => 'Add Item',
                        'min' => 1,
                        'max' => 4,
                    ))
                        ->addText('item_text', array(
                            'label' => 'Item Text',
                            'required' => 1,
                            'wrapper' => ['width' => '100%'],
                        ))
                    ->endRepeater()
                ->addLayout(ListBlock::getFields('ticked_list_block'), array('label' => 'Ticked List'))
                ->addLayout(ListBlock::getFields('unordered_list_block'), array('label' => 'Simple dotted List'))
                ->addLayout('big_text', array(
                    'label' => 'Big Text in Container',
                    'wrapper' => ['width' => '100%'],
                ))
                    ->addTextarea('big_text_text', array(
                        'label' => 'Big Text',
                        'required' => 1,
                        'wrapper' => ['width' => '50%'],
                        'rows' => 3,
                    
                    ))
                    ->addRadio('text_theme', array(
                        'label' => 'Background Color',
                        'choices' => ['white' => 'Light', 'black' => 'Dark', 'gray' => "Gray", "action" => "Red", "gradient" => "Gradient"],
                        'default_value' => 'black',
                        'return_format' => 'key',
                        'layout' => 'horizontal',
                        'wrapper' => ['width' => '50%']
                    ))
                
            ->endFlexibleContent()
        ->endRepeater();

        $cards_fields->addLink('action_link', array(
            'label' => 'Action Link',
            'instructions' => '',
            'required' => 0,
            'wrapper' => ['width' => '70%']
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