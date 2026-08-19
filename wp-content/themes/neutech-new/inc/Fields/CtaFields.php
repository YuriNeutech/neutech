<?php

namespace CleanTheme\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

class CtaFields
{
    public function get_fields()
    {
        // Group name 'cta_section' => field keys field_cta_section_<name>
        $cta = new FieldsBuilder('cta_section', [
            'title' => 'CTA Band Settings',
            'style' => 'seamless',
        ]);

        $cta->setLocation('block', '==', 'acf/cta-section');

        $cta
            ->addText('title', [
                'label'    => 'Heading',
                'required' => 1,
            ])
            ->addTextarea('text', [
                'label' => 'Text',
                'rows'  => 2,
            ])
            ->addLink('primary_button', [
                'label'   => 'Primary button',
                'wrapper' => ['width' => '50%'],
            ])
            ->addLink('secondary_button', [
                'label'   => 'Secondary button',
                'wrapper' => ['width' => '50%'],
            ]);

        return $cta->build();
    }
}
