<?php

namespace CleanTheme\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

class LeadFormFields
{
    public function get_fields()
    {
        // Group name 'lead_form_section' => field keys field_lead_form_section_<name>
        $form = new FieldsBuilder('lead_form_section', [
            'title' => 'Lead Form Section Settings',
            'style' => 'seamless',
        ]);

        $form->setLocation('block', '==', 'acf/lead-form-section');

        $form
            ->addText('eyebrow', [
                'label'   => 'Eyebrow',
                'wrapper' => ['width' => '40%'],
            ])
            ->addText('title', [
                'label'         => 'Heading',
                'default_value' => 'Get a quote',
                'wrapper'       => ['width' => '60%'],
            ])
            ->addTextarea('intro', [
                'label' => 'Intro',
                'rows'  => 2,
            ])
            ->addTextarea('options', [
                'label'        => 'Project-type options',
                'instructions' => 'One option per line. Leave blank for the default list.',
                'rows'         => 5,
            ]);

        return $form->build();
    }
}
