<?php
namespace CleanTheme;

class SvgSupport {
    public function __construct() {
        add_filter( 'upload_mimes', [ $this, 'add_mime_type' ] );
        add_filter( 'wp_check_filetype_and_ext', [ $this, 'fix_mime_type_check' ], 10, 4 );
        add_action( 'admin_head', [ $this, 'fix_admin_display' ] );
    }

    public function add_mime_type( $mimes ) {
        if ( current_user_can( 'manage_options' ) ) {
            $mimes['svg'] = 'image/svg+xml';
        }
        return $mimes;
    }

    public function fix_mime_type_check( $data, $file, $filename, $mimes ) {
        $filetype = wp_check_filetype( $filename, $mimes );

        if ( $filetype['ext'] === 'svg' ) {
            $data['ext']  = 'svg';
            $data['type'] = 'image/svg+xml';
        }

        return $data;
    }

    public function fix_admin_display() {
        echo '<style>
            td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail {
                width: 100% !important;
                height: auto !important;
            }
        </style>';
    }

    /**
     * Helper to get inline SVG code by Attachment ID.
     * Static method allows calling it directly in templates.
     */
    public static function get_inline_svg( $image_id ) {
        if ( ! $image_id ) return '';

        $file_path = get_attached_file( $image_id );

        if ( ! $file_path || ! file_exists( $file_path ) ) {
            return '';
        }

        if ( pathinfo( $file_path, PATHINFO_EXTENSION ) !== 'svg' ) {
            return '';
        }

        $svg_content = file_get_contents( $file_path );

        if ( ! $svg_content ) return '';

        $svg_content = preg_replace( '/<\?xml.*?\?>/s', '', $svg_content );
        $svg_content = preg_replace( '/<!DOCTYPE.*?>/s', '', $svg_content );
        
        $svg_content = preg_replace( '//s', '', $svg_content );

        return trim( $svg_content );
    }
}