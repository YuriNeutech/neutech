<?php
/**
 * Content-pillar map: ties the existing blog posts to our service / vertical
 * hubs (hub-and-spoke). Blog categories → pillar page. Used to:
 *   1. show each hub its cluster of blog posts (the "Insights" section), and
 *   2. give every blog post a conversion path to the right solution.
 * Nothing is deleted or merged — this is purely an organizing + linking layer.
 */

// Page-slug of the pillar => label, hub URL, and the blog category slugs it owns.
// Order matters for post→pillar resolution: first match (top-down) wins, so the
// most specific / highest-intent pillars (healthcare) come first.
function neutech_pillars() {
    return [
        'healthcare-software-development' => [
            'label' => 'Healthcare Software Development',
            'url'   => '/industries/healthcare-software-development/',
            'cats'  => ['engineering-for-regulated-industries'],
        ],
        'ai-ml-data' => [
            'label' => 'AI/ML & Data Engineering',
            'url'   => '/services/ai-ml-data/',
            'cats'  => ['data-engineering-for-critical-applications'],
        ],
        'cloud-devops' => [
            'label' => 'Cloud & DevOps',
            'url'   => '/services/cloud-devops/',
            'cats'  => ['cloud-technologies-and-devops-practices'],
        ],
        'staff-augmentation' => [
            'label' => 'Staff Augmentation',
            'url'   => '/services/staff-augmentation/',
            'cats'  => ['building-high-performance-remote-teams', 'outsourced-teams', 'talent-development-and-training-in-tech'],
        ],
        'product-engineering-mvp' => [
            'label' => 'Product Engineering & MVP',
            'url'   => '/services/product-engineering-mvp/',
            'cats'  => ['mvp-development-and-scaling-strategies', 'agile-solutions-for-dynamic-markets'],
        ],
        'web-application-development' => [
            'label' => 'Web Application Development',
            'url'   => '/services/web-application-development/',
            'cats'  => ['tech-stack-insights-frameworks-and-languages', 'bigcommerce', 'ecommerce'],
        ],
        'custom-software-development' => [
            'label' => 'Custom Software Development',
            'url'   => '/services/custom-software-development/',
            'cats'  => ['business', 'business-software', 'general', 'ethics-in-software-development', 'digital-marketing', 'uncategorized'],
        ],
    ];
}

/** Category slugs owned by a pillar page slug (or null). */
function neutech_pillar_cats_for_slug($slug) {
    $p = neutech_pillars();
    return isset($p[$slug]) ? $p[$slug]['cats'] : null;
}

/**
 * Resolve the best pillar for a post from its categories.
 * Returns ['label','url'] or the Custom Software Development fallback.
 */
function neutech_pillar_for_post($post_id) {
    $slugs = wp_list_pluck(get_the_category($post_id), 'slug');
    foreach (neutech_pillars() as $pillar) {
        foreach ($pillar['cats'] as $c) {
            if (in_array($c, $slugs, true)) {
                return ['label' => $pillar['label'], 'url' => $pillar['url']];
            }
        }
    }
    $p = neutech_pillars();
    return ['label' => $p['custom-software-development']['label'], 'url' => $p['custom-software-development']['url']];
}
