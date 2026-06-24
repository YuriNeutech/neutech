<?php

namespace CleanTheme\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

class LinkWithArrowFields
{
    public function get_fields()
    {
        $arrow_link = new FieldsBuilder('arrow_link_block', [
            'title' => 'Arrow Link Settings',
            'style' => 'seamless'
        ]);

        $arrow_link
            ->setLocation('block', '==', 'acf/link-with-arrow');

        $arrow_link
            ->addLink('link_data', [
                'label' => 'Link',
                'required' => 1,
                'instructions' => 'Select the URL, text, and target for this link.',
            ]);

        return $arrow_link->build();
    }
}