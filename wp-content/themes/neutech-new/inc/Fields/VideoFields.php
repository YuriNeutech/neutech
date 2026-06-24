<?php

namespace CleanTheme\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

class VideoFields
{
    public function get_fields()
    {
        $video = new FieldsBuilder('video_section', [
            'title' => 'Video Full With Section',
            'style' => 'seamless' // Remove borders from section
        ]);

        $video
            ->setLocation('block', '==', 'acf/video-section');


        $video
            ->addMessage('video_instructions_top', 'Highlight the word in italics to apply the pill style.', [
                'label'   => 'How to edit the title',
                'wrapper' => [
                    'class' => 'info-box-top',
                    'style' => 'background: #f0f0f1; padding: 10px; border-left: 4px solid #0073aa; margin-bottom: 15px;',
                ],
            ])
            ->addWysiwyg('title', [
                'label' => 'Title',
                'default_value' => 'Take a look',
                'required' => 1,
                'toolbar' => 'italic_only',
                'media_upload' => 0,
                'delay' => 0,
                'wrapper' => [
                    'width' => '50%',
                ]
            ])
            ->addTextarea('desc', [
                'label' => 'Description',
                'default_value' => 'Your description to video',
                'rows' => 3,
                'wrapper' => ['width' => '50%']
            ])
            ->addImage('poster-mob', [
                'label' => 'Mobile Poster',
                'return_format' => 'id',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'wrapper' => ['width' => '20%'],
            ])
            ->addImage('poster-desktop', [
                'label' => 'Desktop Poster',
                'return_format' => 'id',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'wrapper' => ['width' => '20%'],
                'required' => 1,
            ])
            ->addNumber('vimeo-id', [
                'label' => 'Vimeo ID',
                'required' => 1,
                'wrapper' => ['width' => '20%'],

            ])
            ->addNumber('vimeo-id-mobile', [
                'label' => 'Vimeo ID Mobile',
                'required' => 0,
                'wrapper' => ['width' => '20%'],

            ])
            ->addTrueFalse('hide_on_mobile', [
                'label' => 'Hide on Mobile?',
                'instructions' => 'Hide section up to 767px',
                'default_value' => 0,
                'ui' => 1,
                'wrapper' => ['width' => '20%']
            ])
            ->addFields(ActionsCircleFields::getFields());

        return $video->build();
    }
}
