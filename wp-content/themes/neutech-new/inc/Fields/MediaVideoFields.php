<?php

namespace CleanTheme\Fields;

use CleanTheme\Components\FieldHelpers;
use StoutLogic\AcfBuilder\FieldsBuilder;

class MediaVideoFields
{
    public function get_fields()
    {
        $video = new FieldsBuilder('media_video_section', [
            'title' => 'Video Section',
            'style' => 'seamless'
        ]);

        $video
            ->setLocation('block', '==', 'acf/media-video-section')->addMessage('video_instructions', FieldHelpers::get_block_header('Video Section', 'Highlight the word in italics to apply the pill style.'), FieldHelpers::get_header_args());;


        $video
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
