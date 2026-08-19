<?php
namespace CleanTheme\Components;

use StoutLogic\AcfBuilder\FieldsBuilder;

class LayoutImage
{
    public static function getFields()
    {
        $layout_image = new FieldsBuilder('image_block');
        $layout_image->addImage('image', array(
            'label' => 'Image',
            'return_format' => 'array',
            'preview_size' => 'thumbnail',
            'library' => 'all',
            'wrapper' => array('width' => '60%'),
        ))->addRadio('size', array(
            'label' => 'Image Size',
            'choices' => ['small' => 'Small', 'medium' => 'Medium'],
            'default_value' => 'medium',
            'return_format' => 'key',
            'layout' => 'horizontal',
            'wrapper' => array('width' => '20%'),
            'required' => 1,
        ))->addTrueFalse('add_background_shadow', array(
            'label' => 'Add Background Shadow?',
            'default_value' => 0,
            'wrapper' => array('width' => '20%'),
        ));

        return $layout_image;
    
    }

    public static function render($image, $image_size, $className = 'two-col__img') {
        switch($image_size) {
            case 'small':
                $image_size = 'thumbnail';
                $width = 376;
                $height = 269;
                break;
            case 'medium':
                $image_size = 'medium';
                $width = 784;
                $height = 588;
                break;
            default:
                $image_size = 'medium'; 
                $width = 784;
                $height = 588;
                break;
        }
        if ( ! empty( $image ) ) {
            echo "<div class='{$className} w-full relative two-col__img--size_{$image_size}'>";
            echo wp_get_attachment_image( $image['ID'], 'large', false, ['width' => $width, 'height' => $height, 'loading' => 'lazy', 'class' => 'w-full relative'] );
            echo "</div>";
        }
    }
}