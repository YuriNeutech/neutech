<?php
/**
 * SEO / GEO infrastructure: llms.txt, JSON-LD schema, per-page meta description,
 * canonical + Open Graph description. Kept theme-side so it ships with the rebuild
 * (Yoast is intentionally not part of this stack).
 */

// ── /llms.txt ────────────────────────────────────────────────
add_action('init', 'neutech_serve_llms_txt');
function neutech_serve_llms_txt() {
    $req = strtok($_SERVER['REQUEST_URI'] ?? '', '?');
    if ($req !== '/llms.txt') return;

    $home = home_url();
    header('Content-Type: text/plain; charset=utf-8');
    $lines = [];
    $lines[] = '# Neutech, Inc.';
    $lines[] = '';
    $lines[] = '> Neutech is a US-based custom software development and product engineering company (HQ Orange County, California). Senior engineers design, build, and ship custom software, web and mobile apps, and healthcare and fintech platforms — from first prototype to production.';
    $lines[] = '';
    $lines[] = '## Solutions';
    foreach ([
        'custom-software-development' => 'Custom Software Development',
        'product-engineering-mvp'     => 'Product Engineering & MVP',
        'staff-augmentation'          => 'IT Staff Augmentation & Dedicated Teams',
        'web-application-development'  => 'Web Application Development',
        'mobile-app-development'       => 'Mobile App Development',
        'qa-test-automation'          => 'QA & Test Automation',
        'cloud-devops'                => 'Cloud Migration & DevOps',
        'ai-ml-data'                  => 'AI/ML & Data Engineering',
        'ui-ux-design'                => 'Product Design (UI/UX)',
    ] as $slug => $label) {
        $lines[] = "- [{$label}]({$home}/services/{$slug}/)";
    }
    $lines[] = '';
    $lines[] = '## Industries';
    $lines[] = "- [Healthcare Software Development]({$home}/industries/healthcare-software-development/) — telemedicine, EHR/EMR, practice management, medical device (HIPAA-compliant)";
    foreach ([
        'telemedicine-app-development' => 'Telemedicine & Telehealth App Development',
        'ehr-emr-software-development'  => 'EHR / EMR Software Development',
        'medical-practice-software'     => 'Medical Practice Management Software',
        'medical-device-software'       => 'Medical Device & SaMD Software',
        'healthcare-it-consulting'      => 'Healthcare IT Consulting',
    ] as $slug => $label) {
        $lines[] = "  - [{$label}]({$home}/industries/healthcare-software-development/{$slug}/)";
    }
    $lines[] = "- [Fintech & Financial Software]({$home}/industries/fintech-software-development/) — banking, payments, trading software";
    $lines[] = "  - [Banking Software Development]({$home}/industries/banking-software-development/)";
    $lines[] = '';
    $lines[] = '## Guides';
    foreach ([
        'staff-augmentation-vs-managed-services'         => 'Staff Augmentation vs. Managed Services',
        'offshore-vs-nearshore-software-development'      => 'Offshore vs. Nearshore Software Development',
        'cost-of-custom-healthcare-software-development'  => 'Cost of Custom Healthcare Software Development',
        'cost-to-develop-a-mobile-app'                    => 'Cost to Develop a Mobile App',
        'build-vs-buy-ehr-software'                       => 'Build vs. Buy: EHR Software',
    ] as $slug => $label) {
        $lines[] = "- [{$label}]({$home}/{$slug}/)";
    }
    $lines[] = '';
    $lines[] = '## Company';
    $lines[] = "- [Engagement Models & Pricing]({$home}/pricing/)";
    $lines[] = "- [HIPAA & Security]({$home}/hipaa-security/)";
    $lines[] = "- [Selected Work]({$home}/work/)";
    $lines[] = "- [About / Our Team]({$home}/our-team/)";
    $lines[] = "- [How We Work]({$home}/how-we-work/)";
    $lines[] = "- [Get a Quote]({$home}/get-a-quote/)";
    $lines[] = "- [Blog]({$home}/blog/) — engineering guides across healthcare, fintech, cloud, data, and product";
    $lines[] = '';
    $lines[] = 'Contact: info@neutech.co';
    echo implode("\n", $lines) . "\n";
    exit;
}

// ── Legacy redirects ─────────────────────────────────────────
add_action('template_redirect', 'neutech_legacy_redirects');
function neutech_legacy_redirects() {
    $map = [
        'what-we-do' => '/services/',
    ];
    if (is_page()) {
        $slug = get_post_field('post_name', get_the_ID());
        if (isset($map[$slug])) { wp_redirect(home_url($map[$slug]), 301); exit; }
    }
}

// ── Helpers ──────────────────────────────────────────────────
/** Trim a description to ~155 chars on a word boundary (Google snippet width). */
function neutech_truncate_desc($text, $limit = 155) {
    $text = trim(preg_replace('/\s+/', ' ', wp_strip_all_tags($text)));
    if (mb_strlen($text) <= $limit) return $text;
    $cut = mb_substr($text, 0, $limit);
    $sp  = mb_strrpos($cut, ' ');
    if ($sp !== false) $cut = mb_substr($cut, 0, $sp);
    return rtrim($cut, " ,.;:–—-") . '…';
}

/** Absolute URL of the brand logo shipped in the theme (schema + share image). */
function neutech_logo_url() {
    return get_template_directory_uri() . '/assets/images/logo.png';
}
function neutech_default_share_image() {
    return get_template_directory_uri() . '/assets/images/og-default.png';
}

// ── Per-page meta description ────────────────────────────────
function neutech_meta_description() {
    if (is_front_page()) {
        return 'Neutech is a US-based product engineering team. Senior engineers build custom software, web and mobile apps, and healthcare and fintech platforms — from prototype to production.';
    }
    if (is_singular('post')) {
        $ex = has_excerpt() ? get_the_excerpt() : wp_trim_words(wp_strip_all_tags(get_the_content()), 30);
        return wp_strip_all_tags($ex);
    }
    if (is_page()) {
        $slug = get_post_field('post_name', get_the_ID());
        if (function_exists('neutech_landing_content')) {
            $map = neutech_landing_content();
            if (isset($map[$slug])) {
                foreach ($map[$slug] as $section) {
                    if (!empty($section['subtitle'])) return wp_strip_all_tags($section['subtitle']);
                    if (!empty($section['intro']))    return wp_strip_all_tags($section['intro']);
                }
            }
        }
        if (has_excerpt()) return wp_strip_all_tags(get_the_excerpt());
    }
    return get_bloginfo('description');
}

// ── Head output: meta description, canonical, JSON-LD ────────
add_action('wp_head', 'neutech_seo_head', 1);
function neutech_seo_head() {
    $desc = neutech_truncate_desc(neutech_meta_description());
    if ($desc) {
        echo '<meta name="description" content="' . esc_attr($desc) . '">' . "\n";
    }
    $canonical = is_singular() ? get_permalink() : home_url(add_query_arg([], $GLOBALS['wp']->request ?? ''));
    if (is_front_page()) $canonical = home_url('/');
    echo '<link rel="canonical" href="' . esc_url($canonical) . '">' . "\n";

    // Organization + WebSite (every page)
    $home = home_url();
    $org = [
        '@context' => 'https://schema.org',
        '@type'    => 'Organization',
        '@id'      => $home . '/#org',
        'name'     => 'Neutech, Inc.',
        'alternateName' => 'Neutech',
        'url'      => $home . '/',
        'logo'     => ['@type' => 'ImageObject', 'url' => neutech_logo_url()],
        'image'    => neutech_default_share_image(),
        'slogan'   => 'Senior software designers & developers',
        'description' => 'US-based custom software development and product engineering company.',
        'email'    => 'info@neutech.co',
        'address'  => ['@type' => 'PostalAddress', 'addressRegion' => 'CA', 'addressLocality' => 'Orange County', 'addressCountry' => 'US'],
        'contactPoint' => ['@type' => 'ContactPoint', 'contactType' => 'sales', 'email' => 'info@neutech.co', 'areaServed' => 'US', 'availableLanguage' => 'English'],
        'areaServed' => 'US',
        'knowsAbout' => ['Custom Software Development', 'Healthcare Software', 'Fintech Software', 'Web Application Development', 'Mobile App Development', 'Staff Augmentation', 'QA & Test Automation', 'Cloud & DevOps', 'AI/ML'],
    ];
    $website = [
        '@context' => 'https://schema.org',
        '@type'    => 'WebSite',
        'url'      => $home . '/',
        'name'     => 'Neutech, Inc.',
        'publisher' => ['@id' => $home . '/#org'],
        'potentialAction' => [
            '@type'  => 'SearchAction',
            'target' => ['@type' => 'EntryPoint', 'urlTemplate' => $home . '/?s={search_term_string}'],
            'query-input' => 'required name=search_term_string',
        ],
    ];
    neutech_print_jsonld($org);
    neutech_print_jsonld($website);

    // Service + BreadcrumbList on landing pages
    if (is_page()) {
        $slug = get_post_field('post_name', get_the_ID());
        $is_landing = function_exists('neutech_landing_content') && isset(neutech_landing_content()[$slug]);
        if ($is_landing) {
            neutech_print_jsonld([
                '@context' => 'https://schema.org',
                '@type'    => 'Service',
                'name'     => wp_strip_all_tags(get_the_title()),
                'description' => $desc,
                'provider' => ['@id' => $home . '/#org'],
                'areaServed' => 'US',
                'url'      => get_permalink(),
            ]);
        }
        // Breadcrumbs from ancestors
        $crumbs = [['name' => 'Home', 'url' => $home . '/']];
        $ancestors = array_reverse(get_post_ancestors(get_the_ID()));
        foreach ($ancestors as $aid) { $crumbs[] = ['name' => get_the_title($aid), 'url' => get_permalink($aid)]; }
        $crumbs[] = ['name' => wp_strip_all_tags(get_the_title()), 'url' => get_permalink()];
        if (count($crumbs) > 1) {
            $items = [];
            foreach ($crumbs as $i => $c) {
                $items[] = ['@type' => 'ListItem', 'position' => $i + 1, 'name' => $c['name'], 'item' => $c['url']];
            }
            neutech_print_jsonld(['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $items]);
        }
    }

    // Article schema + breadcrumb on blog posts
    if (is_singular('post')) {
        $img = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: neutech_default_share_image();
        $cats = get_the_category();
        neutech_print_jsonld([
            '@context'         => 'https://schema.org',
            '@type'            => 'BlogPosting',
            'headline'         => wp_strip_all_tags(get_the_title()),
            'description'      => $desc,
            'image'            => $img,
            'datePublished'    => get_the_date('c'),
            'dateModified'     => get_the_modified_date('c'),
            'author'           => ['@type' => 'Organization', 'name' => 'Neutech, Inc.', 'url' => $home . '/'],
            'publisher'        => ['@id' => $home . '/#org'],
            'mainEntityOfPage' => ['@type' => 'WebPage', '@id' => get_permalink()],
            'url'              => get_permalink(),
            'articleSection'   => !empty($cats) ? $cats[0]->name : 'Blog',
        ]);
        neutech_print_jsonld([
            '@context' => 'https://schema.org',
            '@type'    => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $home . '/'],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => $home . '/blog/'],
                ['@type' => 'ListItem', 'position' => 3, 'name' => wp_strip_all_tags(get_the_title()), 'item' => get_permalink()],
            ],
        ]);
    }
}

function neutech_print_jsonld($data) {
    echo '<script type="application/ld+json">' . wp_json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}

// ── De-duplicate embedded post JSON-LD against the theme's ───
// Blog posts carry JSON-LD in their body — both the 1,387 migrated imports and
// anything the autoposter emits. The theme (neutech_seo_head) is the single
// source for Organization / WebSite / BlogPosting / BreadcrumbList, so we strip
// ONLY those "theme-owned" types from the body to avoid duplicate/conflicting
// schema, while KEEPING article-specific schema the theme doesn't emit
// (FAQPage, HowTo, ItemList, VideoObject, etc.). @graph blocks are filtered
// node-by-node so a mixed graph keeps its non-conflicting parts.
add_filter('the_content', 'neutech_dedupe_embedded_jsonld', 20);
function neutech_dedupe_embedded_jsonld($content) {
    if (! is_singular('post')) return $content;
    if (stripos($content, 'application/ld+json') === false) return $content;

    $owned = ['Organization', 'WebSite', 'WebPage', 'BlogPosting', 'Article', 'NewsArticle', 'BreadcrumbList'];

    $node_is_owned = function ($node) use ($owned) {
        if (! is_array($node) || ! isset($node['@type'])) return false;
        foreach ((array) $node['@type'] as $t) {
            if (in_array($t, $owned, true)) return true;
        }
        return false;
    };

    return preg_replace_callback(
        '#<script\b[^>]*type=["\']application/ld\+json["\'][^>]*>(.*?)</script>#is',
        function ($m) use ($owned, $node_is_owned) {
            $data = json_decode(trim($m[1]), true);
            if (! is_array($data)) return $m[0]; // unparseable → leave untouched

            // @graph: keep only nodes the theme does NOT already emit.
            if (isset($data['@graph']) && is_array($data['@graph'])) {
                $kept = array_values(array_filter($data['@graph'], function ($n) use ($node_is_owned) {
                    return ! $node_is_owned($n);
                }));
                if (empty($kept)) return '';
                $data['@graph'] = $kept;
                return '<script type="application/ld+json">'
                    . wp_json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
                    . '</script>';
            }

            // Single object: drop if it's a theme-owned type, else keep.
            return $node_is_owned($data) ? '' : $m[0];
        },
        $content
    );
}

// ── Keyword-forward homepage <title> (keeps the brand) ───────
add_filter('document_title_parts', function ($parts) {
    if (is_front_page()) {
        $parts['title']   = 'Custom Software Development Company';
        $parts['tagline'] = 'Neutech, Inc.';
    }
    return $parts;
});

// ── robots.txt: advertise llms.txt + keep AI crawlers welcome ─
add_filter('robots_txt', function ($output) {
    $output .= "\n# AI / LLM guidance\nAllow: /llms.txt\n";
    return $output;
}, 20);
