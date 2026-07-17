<?php

namespace CleanTheme\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

class StatsFields
{
    public function get_fields()
    {
        // Group name 'stats_section' => field keys field_stats_section_<name>
        $stats = new FieldsBuilder('stats_section', [
            'title' => 'Stats Section Settings',
            'style' => 'seamless',
        ]);

        $stats->setLocation('block', '==', 'acf/stats-section');

        $stats
            ->addText('title', [
                'label' => 'Heading (optional)',
            ])
            ->addRepeater('items', [
                'label'        => 'Stats',
                'layout'       => 'table',
                'button_label' => 'Add Stat',
                'min'          => 1,
            ])
                ->addText('num', [
                    'label'    => 'Figure',
                    'required' => 1,
                    'wrapper'  => ['width' => '40%'],
                ])
                ->addText('label', [
                    'label'    => 'Label',
                    'required' => 1,
                    'wrapper'  => ['width' => '60%'],
                ])
            ->endRepeater();

        return $stats->build();
    }
}
