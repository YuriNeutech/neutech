<?php
namespace CleanTheme\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;
class PostFields {
    public function get_fields() {
        $post_fields = new FieldsBuilder('post_options', array(
            'title' => 'Post options',
            'style' => 'seamless'
        ));

        $post_fields->setLocation('post_type', '==', 'post');

        $post_fields->addText('time_to_read', array(
            'label' => 'Time to read'
        ));

        return $post_fields->build();
    }
}
