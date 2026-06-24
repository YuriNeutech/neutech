<?php
namespace CleanTheme\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

class ThemeOptionsFields {
    public function get_fields() {
        $theme_options = new FieldsBuilder('theme_options', [
            'title' => 'Global Theme Settings',
            'style' => 'seamless'
        ]);

        $theme_options
            ->setLocation('options_page', '==', 'theme-settings');

        $theme_options
            ->addTab('general_tab', ['label' => 'General'])
            
            ->addImage('general_logo', [
                'label' => 'Site Logo (SVG)',
                'instructions' => 'Upload an SVG file. It will be inlined for color manipulation.',
                'required' => 1,
                'return_format' => 'id',
                'preview_size' => 'medium',
                'library' => 'all',
                'mime_types' => 'svg',
                'wrapper' => [
                    'width' => '50%',
                ],
            ])

            ->addLink('general_cta', [
                'label' => 'CTA Button',
                'instructions' => 'Link for the "Let\'s Chat" button',
                'wrapper' => [
                    'width' => '50%',
                ],
            ])
            ->addMessage('footer_text', 'Highlight the word in italics to apply the pill style.', [
                'label'   => 'How to edit the title',
                'wrapper' => [
                    'class' => 'info-box-top',
                    'style' => 'background: #f0f0f1; padding: 10px; border-left: 4px solid #0073aa; margin-bottom: 15px;',
                ],
            ])
            ->addWysiwyg('footer_title', [
                'label' => 'Footer Text',
                'default_value' => 'Talk with our team',
                'required' => 1,
                'toolbar' => 'italic_only',
                'media_upload' => 0,
                'delay' => 0,
            ])
            ->addLink('footer_cta', [
                'label' => 'Footer CTA Button',
                'instructions' => 'Link for the "Schedule a call via" button',
                'wrapper' => [
                    'width' => '33%',
                ],
            ])
            ->addRepeater('contacts', [
                'min' => 1,
                'max' => 7,
                'button_label' => 'Add Contact Row'
            ])
                ->addRepeater('contact_row', [
                    'min' => 1,
                    'max' => 3,
                    'button_label' => 'Add Contact Item',
                    'layout' => 'block'
                ])
                    ->addTrueFalse('is_link', [
                        'label' => 'Is Link?',
                        'wrapper' => ['width' => '33%'],
                        'default_value' => 1,
                        'ui' => 1,
                        'ui_on_text' => 'Link Contact Item',
                        'ui_off_text' => 'Text Contact Item'
                    ])
                    ->addText('contact_text', [
                        'label' => 'Contact Text',
                        'wrapper' => ['width' => '33%']
                    ])
                        ->conditional('is_link', '==', 0)
                    ->addLink('contact_link', [
                        'label' => 'Contact Link',
                        'wrapper' => ['width' => '33%']
                    ])
                        ->conditional('is_link', '==', 1)
            ->endRepeater();

        $theme_options
            ->addText('copyright', [
                'label' => 'Copyright Text',
                'default_value' => 'Neutech, Inc. All Rights Reserved',
                'required' => 0,
                'wrapper' => [
                    'width' => '33%',
                ],
            ]);

        $theme_options->addImage('thumbnail_placeholder', array(
            'label' => 'Post image placeholder',
            'wrapper' => ['width' => '33%'],
            'required' => 1,
        ))->addUrl('instagram_link', array(
            'label' => 'Instagram URL',
            'wrapper' => ['width' => '33%'],
            'required' => 1,
        ));
        
        $theme_options->addTab('newsletter_tab', ['label' => 'Newsletter block'])
        ->addTrueFalse('enable_newsletter', array(
            'label' => 'Enable newsletter block?',
            'default' => true,
            'ui' => 1,
            'wrapper' => array(
                'width' => '100%'
            )
        ))
        ->addText('newsletter_title', array(
            'wrapper' => ['width' => '50%'],
            'label' => 'Newsletter title'
        ))->addTextarea('newsletter_subtitle', array(
            'wrapper' => ['width' => '50%'],
            'label' => 'Newsletter subtitle',
            'rows' => 3,
        ));

        // $theme_options
        //     ->addTab('footer_tab', ['label' => 'Footer'])
        //     ->addText('copyright_text', ['label' => 'Copyright']);

        return $theme_options->build();
    }
}