<?php
/**
 * Front page — rebuilt from reusable landing sections.
 */
get_header(null, ['theme' => 'dark']);

// If the front page has been assembled from ACF blocks in the editor, render
// those (the client can then edit Home in the visual builder). Otherwise fall
// back to the hardcoded section partials below.
if ( has_blocks( get_the_ID() ) ) {
    while ( have_posts() ) { the_post(); the_content(); }
    get_footer();
    return;
}

$quote = ['url' => '/get-a-quote/', 'label' => 'Get a quote'];
$work  = ['url' => '/work/', 'label' => 'See our work'];

// Hero
get_template_part('template-parts/sections/hero', null, [
    'eyebrow'  => 'Senior software designers & developers',
    'title'    => 'We build the software your business runs on',
    'subtitle' => 'Neutech is a US-based product engineering team. Senior engineers design, build, and ship custom software, web and mobile apps, and healthcare and fintech platforms — from first prototype to production.',
    'primary'  => $quote,
    'secondary'=> $work,
]);

// Services grid
get_template_part('template-parts/sections/cards', null, [
    'theme' => 'white',
    'eyebrow' => 'Services',
    'title' => 'What we do',
    'intro' => 'Full-lifecycle software engineering — as a product team, an augmentation of yours, or a focused specialist crew.',
    'columns' => 3,
    'items' => [
        ['title' => 'Custom Software Development', 'text' => 'Bespoke software built around your workflows, not forced into someone else\'s template.', 'url' => '/services/custom-software-development/'],
        ['title' => 'Product Engineering & MVP', 'text' => 'From discovery to a shipped MVP to scale — with a team that owns outcomes.', 'url' => '/services/product-engineering-mvp/'],
        ['title' => 'Staff Augmentation', 'text' => 'Senior engineers who plug into your team and ship from week one.', 'url' => '/services/staff-augmentation/'],
        ['title' => 'Web Application Development', 'text' => 'Fast, reliable web apps and SaaS platforms in modern stacks.', 'url' => '/services/web-application-development/'],
        ['title' => 'Mobile App Development', 'text' => 'iOS, Android, and cross-platform apps people actually keep on their phones.', 'url' => '/services/mobile-app-development/'],
        ['title' => 'QA & Test Automation', 'text' => 'Automated testing and QA-as-a-service that keeps releases safe.', 'url' => '/services/qa-test-automation/'],
        ['title' => 'Cloud & DevOps', 'text' => 'Cloud migration, CI/CD, and infrastructure that scales without drama.', 'url' => '/services/cloud-devops/'],
        ['title' => 'AI/ML & Data Engineering', 'text' => 'Generative AI, ML, and data platforms built on your data, safely.', 'url' => '/services/ai-ml-data/'],
        ['title' => 'Product Design (UI/UX)', 'text' => 'Interfaces that are clear, fast, and a pleasure to use.', 'url' => '/services/ui-ux-design/'],
    ],
]);

// Industries
get_template_part('template-parts/sections/cards', null, [
    'theme' => 'light',
    'eyebrow' => 'Industries',
    'title' => 'Depth where it matters',
    'intro' => 'We go deep in the domains where software is hardest and the stakes are highest.',
    'columns' => 2,
    'items' => [
        ['eyebrow' => 'Featured', 'title' => 'Healthcare Software Development', 'text' => 'HIPAA-compliant telemedicine, EHR/EMR, practice management, and medical-device software for providers and health-tech companies.', 'url' => '/industries/healthcare-software-development/'],
        ['title' => 'Fintech & Financial Software', 'text' => 'Custom banking, payments, and financial platforms built for security and compliance.', 'url' => '/industries/fintech-software-development/'],
    ],
]);

// Stats
get_template_part('template-parts/sections/stats', null, [
    'title' => 'A team that ships',
    'items' => [
        ['num' => 'Senior', 'label' => 'Engineers on every engagement'],
        ['num' => 'US-based', 'label' => 'HQ in Orange County, California'],
        ['num' => 'Full-cycle', 'label' => 'Discovery, build, QA, and support'],
        ['num' => 'HIPAA', 'label' => 'Compliance built in for healthcare'],
    ],
]);

// CTA
get_template_part('template-parts/sections/cta', null, [
    'title' => 'Let\'s build what\'s next',
    'text' => 'Tell us what you\'re trying to ship. You\'ll talk to a senior engineer and leave with a scoped path forward.',
    'primary' => $quote,
    'secondary' => $work,
]);

get_footer();
