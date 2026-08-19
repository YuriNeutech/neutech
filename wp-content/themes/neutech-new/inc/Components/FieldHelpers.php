<?php

namespace CleanTheme\Components;

class FieldHelpers
{
    /**
     * Generates a styled header for ACF Block settings.
     */
    public static function get_block_header($title, $instructions = '')
    {
        $instructions_html = '';
        if (!empty($instructions)) {
            $instructions_html = '<p style="margin: 0; font-size: 13px; color: #F5F5F7;">' . $instructions . '</p>';
        }

        return '
            <div style="background: #000; color: #fff; padding: 15px; margin-bottom: 10px;">
                <h3 style="color: #fff; margin: 0 0 8px 0; font-weight: 600; text-transform: capitalize; font-family: var(--wp--preset--font-family--heading);" class="fz-h3">' . $title . '</h3>
                ' . $instructions_html . '
            </div>
        ';
    }

    /**
     * Returns the default configuration array for full-width header messages.
     */
    public static function get_header_args()
    {
        return [
            'label' => '',
            'wrapper' => [
                'style' => 'padding: 0;'
            ]
        ];
    }
}