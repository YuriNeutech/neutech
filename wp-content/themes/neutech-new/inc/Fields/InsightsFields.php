<?php

namespace CleanTheme\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

class InsightsFields
{
    public function get_fields()
    {
        // Group name 'insights_section' => field keys field_insights_section_<name>
        $insights = new FieldsBuilder('insights_section', [
            'title' => 'Insights Section Settings',
            'style' => 'seamless',
        ]);

        $insights->setLocation('block', '==', 'acf/insights-section');

        $insights
            ->addText('eyebrow', [
                'label'         => 'Eyebrow',
                'default_value' => 'From the blog',
                'wrapper'       => ['width' => '50%'],
            ])
            ->addText('title', [
                'label'         => 'Heading',
                'default_value' => 'Insights & guides',
                'wrapper'       => ['width' => '50%'],
            ])
            ->addTextarea('intro', [
                'label' => 'Intro',
                'rows'  => 2,
            ])
            ->addTaxonomy('categories', [
                'label'         => 'Categories to pull from',
                'taxonomy'      => 'category',
                'field_type'    => 'multi_select',
                'add_term'      => 0,
                'save_terms'    => 0,
                'load_terms'    => 0,
                'return_format' => 'id',
                'wrapper'       => ['width' => '70%'],
            ])
            ->addNumber('count', [
                'label'         => 'How many posts',
                'default_value' => 3,
                'min'           => 1,
                'max'           => 12,
                'wrapper'       => ['width' => '30%'],
            ])
            ->addLink('all_link', [
                'label' => '"Read more" button (optional)',
            ]);

        return $insights->build();
    }
}
