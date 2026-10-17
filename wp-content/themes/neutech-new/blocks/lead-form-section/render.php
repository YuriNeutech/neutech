<?php
/**
 * Block Name: Lead Form Section
 * Uses the same native Tely quote renderer as landing-page sections.
 */
if ( ! empty( $block['data']['_is_inserter_preview'] ) ) {
    neutech_block_preview( 'Lead Form Section', 'Dark "get a quote" band with an async lead-capture form.' );
    return;
}

$eyebrow = get_field( 'eyebrow' );
$title   = get_field( 'title' );
$intro   = get_field( 'intro' );

// Options: one project type per line.
$raw  = get_field( 'options' );
$opts = $raw ? array_values( array_filter( array_map( 'trim', preg_split( '/\r\n|\r|\n/', $raw ) ) ) ) : [];
if ( empty( $opts ) ) {
    $opts = [ 'Custom software', 'Healthcare software', 'Web app', 'Mobile app', 'Staff augmentation', 'Something else' ];
}

get_template_part('template-parts/sections/form', null, [
    'eyebrow' => $eyebrow,
    'title' => $title ?: 'Get a quote',
    'intro' => $intro,
    'options' => $opts,
    'className' => $block['className'] ?? '',
    'id' => $block['anchor'] ?? '',
]);
