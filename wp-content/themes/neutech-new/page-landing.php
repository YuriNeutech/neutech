<?php
/**
 * Template Name: Landing (section-driven)
 *
 * Renders the ordered sections defined for this page's slug in
 * inc/landing-content.php. Reusable across every service / industry /
 * MoFu landing page.
 */

get_header(null, ['theme' => 'dark']);

// Migrated pages hold their sections as ACF blocks in the editor — render those
// directly so the client can assemble/edit them in the visual builder. Pages
// still driven by inc/landing-content.php have empty post_content and fall
// through to the content map below.
if ( has_blocks( get_the_ID() ) ) {
    while ( have_posts() ) { the_post(); the_content(); }
    get_footer();
    return;
}

$slug     = get_post_field('post_name', get_the_ID());
$landings = neutech_landing_content();
$sections = $landings[$slug] ?? [];

// Content pillar: if this hub owns a blog cluster, inject an "Insights" section
// (its spoke posts) right before the closing CTA — turning the hub into a pillar.
$pillar_cats = function_exists('neutech_pillar_cats_for_slug') ? neutech_pillar_cats_for_slug($slug) : null;
if ($pillar_cats && !empty($sections)) {
    $insights = [
        'type'       => 'posts',
        'categories' => $pillar_cats,
        'eyebrow'    => 'From the blog',
        'title'      => 'Insights & guides',
        'intro'      => 'Practical guidance from the team that builds. Explore, then talk to us when you\'re ready.',
        'count'      => 3,
        'all_url'    => '/blog/',
    ];
    array_splice($sections, max(0, count($sections) - 1), 0, [$insights]);
}

if (empty($sections)) {
    // No content mapped yet — render the editor content as a fallback.
    while (have_posts()) { the_post(); the_content(); }
} else {
    foreach ($sections as $section) {
        $type = $section['type'] ?? '';
        if (!$type) continue;
        get_template_part('template-parts/sections/' . $type, null, $section);
    }
}

get_footer();
