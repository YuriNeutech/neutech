<?php

namespace CleanTheme\Fields;

use CleanTheme\Components\FieldHelpers;
use StoutLogic\AcfBuilder\FieldsBuilder;
use CleanTheme\Fields\ActionsCircleFields;

class PageHeroFields
{
    public function get_fields()
    {

        $page_hero = new FieldsBuilder('page_hero_section', [
            'title' => 'Page Hero Section Settings',
            'style' => 'seamless'
        ]);

        $page_hero
            ->setLocation('block', '==', 'acf/page-hero-section');


        $page_hero
            ->addMessage('page_hero_instructions', FieldHelpers::get_block_header('Page Hero Section', '<strong>How to edit the title:</strong> Highlight the word in italics to apply the pill style.'), FieldHelpers::get_header_args())
            ->addWysiwyg('title', [
                'label' => 'Hero Text',
                'default_value' => '',
                'required' => 1,
                'toolbar' => 'italic_only',
                'media_upload' => 0,
                'delay' => 0,
            ])
            ->addText('subtitle', array(
                'label' => 'Subtitle (Below the Title)',
                'required' => 1,
                'wrapper' => array('width' => '33%')
            ))
            ->addText('tagline', array(
                'label' => 'Tagline (Above the Title)',
                'instructions' => 'Default to page title',
                'wrapper' => array('width' => '33%')
            ))
            ->addLink('action_link', array(
                'label' => 'Action Link',
                'instructions' => '',
                'required' => 0,
                'wrapper' => array('width' => '33%')
            ))
            ->addFields(ActionsCircleFields::getFields())
            ->addGroup('features', array(
                'label' => 'Features'
            ))
                ->conditional('image_background_enable_image_background', '!=', '1')

                ->addTrueFalse('enable_features', array(
                    'label' => 'Enable Features?',
                    'default_value' => 0,
                    'ui' => 1
                ))

                ->addRepeater('feature_items', array(
                    'label' => 'Feature Items',
                    'button_label' => 'Add Item',
                    'layout' => 'block',
                    'max'          => 4
                ))
                    ->conditional('enable_features', '==', '1')

                    ->addText('feature_text', array(
                        'label' => 'Feature Text',
                        'required' => 1
                    ))
                ->endRepeater()
            ->endGroup()

            ->addGroup('image_background', array(
                'label' => 'Background of images'
            ))
                ->conditional('features_enable_features', '!=', '1')

                ->addTrueFalse('enable_image_background', array(
                    'label' => 'Enable Hero With Image Background?',
                    'default_value' => 0,
                    'ui' => 1
                ))

                ->addGallery('bg_images', array(
                    'label' => 'Background Images',
                    'required' => 1,
                    'max' => 5,
                    'min' => 1,
                ))
                    ->conditional('enable_image_background', '==', '1')
            ->endGroup();
            

        return $page_hero->build();
    }
}