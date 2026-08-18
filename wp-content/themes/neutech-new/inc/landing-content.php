<?php
/**
 * Landing-page content map. Keyed by page slug → ordered list of sections.
 * Each section: ['type' => <sections/ partial>, ...args].
 * Rendered by page-landing.php. New pages = add a slug here + assign the template.
 */

function neutech_landing_content() {
    $quote = ['url' => '/get-a-quote/', 'label' => 'Get a quote'];
    $work  = ['url' => '/work/', 'label' => 'See our work'];

    // Shared "why Neutech" stats used across solution hubs.
    $why_stats = [
        'type' => 'stats',
        'title' => 'Why teams build with Neutech',
        'items' => [
            ['num' => 'Senior', 'label' => 'Engineers lead every engagement'],
            ['num' => 'Global', 'label' => 'Leadership and engineering across the US, LATAM, and Europe'],
            ['num' => 'Full-cycle', 'label' => 'Discovery, build, QA, and support'],
            ['num' => 'Quality', 'label' => 'Battle-tested engineers, held to a higher bar'],
        ],
    ];

    // Helper to build a standard closing CTA.
    $cta = function ($title, $text) use ($quote, $work) {
        return ['type' => 'cta', 'title' => $title, 'text' => $text, 'primary' => $quote, 'secondary' => $work];
    };

    return [

    // ══════════════════════════════════════════════════════════
    //  SOLUTIONS INDEX  (/services/)
    // ══════════════════════════════════════════════════════════
    'services' => [
        ['type' => 'hero',
            'eyebrow' => 'Solutions',
            'title' => 'Engineering solutions for every stage of your product',
            'subtitle' => 'Whether you need a whole product team, extra senior hands, or a specialist crew, Neutech has a solution built around the outcome you\'re after.',
            'primary' => $quote, 'secondary' => $work,
            'visual' => 'stack',
        ],
        ['type' => 'cards', 'theme' => 'white', 'eyebrow' => 'What we do', 'title' => 'Nine ways we ship',
            'intro' => 'Each solution is led by senior engineers and delivered as an outcome, not a stack of hours.',
            'columns' => 3,
            'items' => [
                ['title' => 'Custom Software Development', 'text' => 'Bespoke software built around your workflows.', 'url' => '/services/custom-software-development/'],
                ['title' => 'Product Engineering & MVP', 'text' => 'From discovery to a shipped MVP to scale.', 'url' => '/services/product-engineering-mvp/'],
                ['title' => 'Staff Augmentation', 'text' => 'Senior engineers who plug into your team.', 'url' => '/services/staff-augmentation/'],
                ['title' => 'Web Application Development', 'text' => 'Fast, reliable web apps and SaaS platforms.', 'url' => '/services/web-application-development/'],
                ['title' => 'Mobile App Development', 'text' => 'iOS, Android, and cross-platform apps.', 'url' => '/services/mobile-app-development/'],
                ['title' => 'QA & Test Automation', 'text' => 'Automated testing that keeps releases safe.', 'url' => '/services/qa-test-automation/'],
                ['title' => 'Cloud & DevOps', 'text' => 'Cloud migration, CI/CD, and scalable infra.', 'url' => '/services/cloud-devops/'],
                ['title' => 'AI/ML & Data Engineering', 'text' => 'Generative AI, ML, and data platforms.', 'url' => '/services/ai-ml-data/'],
                ['title' => 'Product Design (UI/UX)', 'text' => 'Interfaces that are clear, fast, and usable.', 'url' => '/services/ui-ux-design/'],
            ],
        ],
        $why_stats,
        $cta('Not sure which solution fits?', 'Tell us the outcome you need. We\'ll point you to the right engagement — or tell you honestly if we\'re not the fit.'),
    ],

    // ══════════════════════════════════════════════════════════
    //  SERVICE HUBS  (/services/…)
    // ══════════════════════════════════════════════════════════

    'custom-software-development' => [
        ['type' => 'hero', 'eyebrow' => 'Custom Software Development',
            'title' => 'Software built around your business, not the other way around',
            'subtitle' => 'Neutech is a US-based custom software development company. Senior engineers design and build bespoke systems that fit your workflows, integrate with what you already run, and scale as you grow.',
            'primary' => $quote, 'secondary' => $work],
        ['type' => 'rich', 'theme' => 'white', 'eyebrow' => 'What we build',
            'title' => 'Custom software that earns its keep',
            'body' => '<p>Off-the-shelf tools force your business to bend around someone else\'s assumptions. Custom software does the opposite — it encodes how <em>you</em> actually work, removes the manual glue between systems, and becomes an asset you own.</p>'
                . '<p>We take products from idea to production and beyond: discovery and architecture, build, QA, launch, and long-term support — all led by senior engineers who own the outcome.</p>'
                . '<ul><li>Enterprise and internal business systems</li><li>Customer-facing web and SaaS platforms</li><li>Workflow automation and systems integration</li><li>Legacy modernization and re-platforming</li></ul>'],
        ['type' => 'cards', 'theme' => 'light', 'eyebrow' => 'Capabilities', 'title' => 'End-to-end, or exactly the part you need',
            'intro' => 'Engage us for the full lifecycle or plug us in where you need senior firepower.',
            'columns' => 3,
            'items' => [
                ['title' => 'Discovery & Architecture', 'text' => 'Scope, technical design, and a plan you can budget against.'],
                ['title' => 'Full-Stack Build', 'text' => 'Modern, maintainable code across web, backend, and data.'],
                ['title' => 'Systems Integration', 'text' => 'Connect the tools, APIs, and data you already depend on.'],
                ['title' => 'Legacy Modernization', 'text' => 'Re-platform aging systems without a risky big-bang rewrite.'],
                ['title' => 'QA & Test Automation', 'text' => 'Confidence that releases won\'t break what worked yesterday.'],
                ['title' => 'Support & Iteration', 'text' => 'Maintenance and continued delivery after go-live.'],
            ]],
        ['type' => 'faq', 'eyebrow' => 'FAQ', 'title' => 'Custom software development questions',
            'items' => [
                ['q' => 'How much does custom software development cost?', 'a' => 'It depends on scope and integrations. Most first releases start in the low-to-mid six figures; we scope a fixed range in a short paid discovery so you see the number before committing.'],
                ['q' => 'Do you work fixed-scope or time-and-materials?', 'a' => 'Both. Fixed-scope suits well-defined projects; dedicated-team or time-and-materials suits evolving products. We\'ll recommend the model that de-risks your specific build.'],
                ['q' => 'Will we own the code and IP?', 'a' => 'Yes. You own all source code and intellectual property produced in the engagement.'],
            ]],
        $cta('Have a system to build?', 'Tell us what you\'re trying to ship. You\'ll talk to a senior engineer and leave with a scoped path forward.'),
    ],

    'product-engineering-mvp' => [
        ['type' => 'hero', 'eyebrow' => 'Product Engineering & MVP',
            'title' => 'From idea to a shipped MVP — and everything after',
            'subtitle' => 'We help founders and product teams turn a concept into a real, usable product fast, then scale it as the market responds.',
            'primary' => $quote, 'secondary' => $work],
        ['type' => 'rich', 'theme' => 'white', 'eyebrow' => 'How it works',
            'title' => 'Build the right thing, then build it right',
            'body' => '<p>An MVP isn\'t a cheaper, worse product — it\'s the fastest honest test of the riskiest assumption. We help you find that core, ship it to real users, and iterate on what you learn.</p>'
                . '<ul><li>Product discovery and scope definition</li><li>Rapid MVP and prototype development</li><li>Iteration from real user feedback</li><li>Scaling architecture as you grow</li></ul>'],
        ['type' => 'cards', 'theme' => 'light', 'eyebrow' => 'The path', 'title' => 'Discovery to scale',
            'columns' => 3,
            'items' => [
                ['title' => 'Discovery Sprint', 'text' => 'Define the core, de-risk the plan, and set a realistic scope.'],
                ['title' => 'MVP Build', 'text' => 'A focused, production-grade first release in weeks, not quarters.'],
                ['title' => 'Prototype & PoC', 'text' => 'Prove a concept before you commit to a full build.'],
                ['title' => 'Iterate', 'text' => 'Ship, measure, and improve against real usage.'],
                ['title' => 'Scale', 'text' => 'Harden architecture and team as traction grows.'],
                ['title' => 'Own It', 'text' => 'Hand off cleanly or keep us on as your product team.'],
            ]],
        ['type' => 'faq', 'eyebrow' => 'FAQ', 'title' => 'MVP development questions',
            'items' => [
                ['q' => 'How long does an MVP take?', 'a' => 'Most MVPs ship in 3-5 months depending on scope and integrations. We define the smallest release that proves the core in a short discovery first.'],
                ['q' => 'What does MVP development cost?', 'a' => 'MVPs typically range from mid-five to low-six figures. We give a fixed range after discovery so there are no surprises.'],
                ['q' => 'Can you scale the MVP later?', 'a' => 'Yes — we build MVPs on architecture that can grow, so you\'re not forced into a rewrite when traction arrives.'],
            ]],
        $cta('Got an idea to validate?', 'Let\'s find the fastest honest test of it. Talk to a senior engineer about your MVP.'),
    ],

    'staff-augmentation' => [
        ['type' => 'hero', 'eyebrow' => 'IT Staff Augmentation',
            'title' => 'Senior engineers who ship from week one',
            'subtitle' => 'Extend your team with vetted senior developers who integrate into your process, your standups, and your codebase — without the overhead of hiring.',
            'primary' => $quote, 'secondary' => $work],
        ['type' => 'rich', 'theme' => 'white', 'eyebrow' => 'When it fits',
            'title' => 'Capacity when you need it, seniority you can trust',
            'body' => '<p>Sometimes you don\'t need a vendor to run a project — you need more strong engineers, now, working the way your team already works. That\'s staff augmentation done right: our people, your process, real velocity.</p>'
                . '<ul><li>Fill a critical skill gap fast</li><li>Ramp capacity for a deadline or roadmap push</li><li>Add senior leadership to a growing team</li><li>Flex up and down without hiring risk</li></ul>'],
        ['type' => 'cards', 'theme' => 'light', 'eyebrow' => 'How we plug in', 'title' => 'Your team, extended',
            'columns' => 3,
            'items' => [
                ['title' => 'Vetted Seniors', 'text' => 'Engineers who have shipped in production before, not juniors learning on your budget.'],
                ['title' => 'Week-One Velocity', 'text' => 'They join your standups, tools, and workflow and start delivering fast.'],
                ['title' => 'Full-Stack Roles', 'text' => 'Frontend, backend, mobile, QA, DevOps, and data — matched to your gap.'],
                ['title' => 'Dedicated Teams', 'text' => 'Scale from one engineer to a full pod under your direction.'],
                ['title' => 'Flexible Terms', 'text' => 'Ramp up for a push, ramp down when it\'s done — no hiring overhang.'],
                ['title' => 'Your Process', 'text' => 'We adapt to how you work, not the other way around.'],
            ]],
        ['type' => 'faq', 'eyebrow' => 'FAQ', 'title' => 'Staff augmentation questions',
            'items' => [
                ['q' => 'What is the difference between staff augmentation and managed services?', 'a' => 'With staff augmentation, our engineers work under your direction and process — you manage the work. With managed services, we own delivery of an outcome end to end. Many clients mix both; we\'ll help you pick per initiative.'],
                ['q' => 'How fast can engineers start?', 'a' => 'Typically within one to two weeks, depending on the skill mix and any security onboarding on your side.'],
                ['q' => 'Can we scale the team up or down?', 'a' => 'Yes. Flexing capacity without hiring risk is the whole point — add engineers for a push and reduce when the roadmap eases.'],
            ]],
        $cta('Need senior capacity, fast?', 'Tell us the skills and the timeline. We\'ll match vetted engineers who ship from week one.'),
    ],

    'web-application-development' => [
        ['type' => 'hero', 'eyebrow' => 'Web Application Development',
            'title' => 'Web apps and SaaS platforms built to last',
            'subtitle' => 'Fast, secure, maintainable web applications in modern stacks — from internal tools to customer-facing SaaS products.',
            'primary' => $quote, 'secondary' => $work],
        ['type' => 'rich', 'theme' => 'white', 'eyebrow' => 'What we build',
            'title' => 'From dashboard to full SaaS platform',
            'body' => '<p>The browser is where most software lives now. We build web applications that are quick to load, easy to maintain, and ready to scale — with the security and reliability real businesses depend on.</p>'
                . '<ul><li>Custom SaaS products and multi-tenant platforms</li><li>Internal tools, dashboards, and admin systems</li><li>Progressive web apps (PWAs)</li><li>API and third-party integrations</li></ul>'],
        ['type' => 'cards', 'theme' => 'light', 'eyebrow' => 'Stacks & scope', 'title' => 'Modern, maintainable, yours',
            'columns' => 3,
            'items' => [
                ['title' => 'React & Modern Frontend', 'text' => 'Fast, accessible interfaces that feel instant.'],
                ['title' => 'Robust Backends', 'text' => 'Node, PHP, and Java services built to scale.'],
                ['title' => 'SaaS & Multi-Tenant', 'text' => 'Billing, roles, and tenancy done right from the start.'],
                ['title' => 'Progressive Web Apps', 'text' => 'App-like experiences without an app-store gate.'],
                ['title' => 'Integrations & APIs', 'text' => 'Connect the services your product relies on.'],
                ['title' => 'Security & Performance', 'text' => 'Hardened, fast, and built to pass an audit.'],
            ]],
        ['type' => 'faq', 'eyebrow' => 'FAQ', 'title' => 'Web application development questions',
            'items' => [
                ['q' => 'What does web application development cost?', 'a' => 'It varies with complexity. A focused app can start in the mid-five figures; a full SaaS platform is a larger, phased investment. We scope a range in discovery.'],
                ['q' => 'Which technologies do you use?', 'a' => 'We choose per project — commonly React on the frontend with Node, PHP, or Java services — favoring proven, maintainable stacks over hype.'],
                ['q' => 'Can you take over an existing web app?', 'a' => 'Yes. We regularly inherit, stabilize, and extend existing codebases, starting with an architecture and code review.'],
            ]],
        $cta('Building a web product?', 'Tell us what it needs to do. You\'ll get a scoped plan from senior engineers, not a sales pitch.'),
    ],

    'mobile-app-development' => [
        ['type' => 'hero', 'eyebrow' => 'Mobile App Development',
            'title' => 'Apps people actually keep on their phones',
            'subtitle' => 'iOS, Android, and cross-platform apps designed for real use — fast, reliable, and built to grow with your product.',
            'primary' => $quote, 'secondary' => $work],
        ['type' => 'rich', 'theme' => 'white', 'eyebrow' => 'What we build',
            'title' => 'Native quality, cross-platform economics',
            'body' => '<p>A great app disappears into the task. We design and build mobile apps that load fast, work offline when they should, and hold up under real-world conditions — on the platforms your users are actually on.</p>'
                . '<ul><li>Native iOS and Android apps</li><li>Cross-platform apps (React Native / Flutter)</li><li>Backend, APIs, and app infrastructure</li><li>App Store and Play Store launch support</li></ul>'],
        ['type' => 'cards', 'theme' => 'light', 'eyebrow' => 'Capabilities', 'title' => 'End-to-end mobile',
            'columns' => 3,
            'items' => [
                ['title' => 'iOS Development', 'text' => 'Native apps that feel right at home on Apple hardware.'],
                ['title' => 'Android Development', 'text' => 'Fast, reliable apps across the Android ecosystem.'],
                ['title' => 'Cross-Platform', 'text' => 'One codebase, both stores, sensible economics.'],
                ['title' => 'App Backends', 'text' => 'APIs, auth, sync, and push built to scale.'],
                ['title' => 'UX for Mobile', 'text' => 'Interfaces designed for thumbs and real contexts.'],
                ['title' => 'Launch & Iterate', 'text' => 'Store submission, analytics, and post-launch delivery.'],
            ]],
        ['type' => 'faq', 'eyebrow' => 'FAQ', 'title' => 'Mobile app development questions',
            'items' => [
                ['q' => 'How much does it cost to develop an app?', 'a' => 'A focused app typically starts in the mid-five to low-six figures depending on features, platforms, and backend needs. We give a fixed range after discovery.'],
                ['q' => 'Should we build native or cross-platform?', 'a' => 'It depends on performance needs and budget. Cross-platform (React Native / Flutter) covers most products efficiently; we recommend native when the experience demands it.'],
                ['q' => 'Do you handle App Store submission?', 'a' => 'Yes — we manage store submission, review, and post-launch updates for both Apple and Google.'],
            ]],
        $cta('Have an app to build?', 'Tell us who it\'s for and what it needs to do. We\'ll scope a path to launch.'),
    ],

    'qa-test-automation' => [
        ['type' => 'hero', 'eyebrow' => 'QA & Test Automation',
            'title' => 'Ship faster without shipping bugs',
            'subtitle' => 'Automated testing and QA-as-a-service that catches regressions before your users do — so your team can release with confidence.',
            'primary' => $quote, 'secondary' => $work],
        ['type' => 'rich', 'theme' => 'white', 'eyebrow' => 'What we do',
            'title' => 'Quality that keeps up with your release cadence',
            'body' => '<p>Manual testing can\'t keep pace with modern delivery. We build the automated safety net that lets you release often and sleep at night — plus expert manual QA where human judgment matters.</p>'
                . '<ul><li>Test automation frameworks (web, mobile, API)</li><li>Regression, integration, and end-to-end suites</li><li>Performance and load testing</li><li>QA-as-a-service and dedicated QA engineers</li></ul>'],
        ['type' => 'cards', 'theme' => 'light', 'eyebrow' => 'Coverage', 'title' => 'The full quality stack',
            'columns' => 3,
            'items' => [
                ['title' => 'Test Automation', 'text' => 'Reusable suites that run on every commit.'],
                ['title' => 'Regression Testing', 'text' => 'Confidence that new work won\'t break old work.'],
                ['title' => 'API Testing', 'text' => 'Verify contracts and edge cases automatically.'],
                ['title' => 'Performance & Load', 'text' => 'Know how your system behaves under pressure.'],
                ['title' => 'Manual & Exploratory', 'text' => 'Human judgment where automation can\'t reach.'],
                ['title' => 'QA-as-a-Service', 'text' => 'Dedicated QA engineers embedded in your team.'],
            ]],
        ['type' => 'faq', 'eyebrow' => 'FAQ', 'title' => 'QA & testing questions',
            'items' => [
                ['q' => 'What do QA and test automation services cost?', 'a' => 'We scope to your release cadence and surface area. Many teams start with a focused automation build, then add ongoing QA-as-a-service — priced per engineer or per outcome.'],
                ['q' => 'Can you add automation to an existing product?', 'a' => 'Yes. We assess your current coverage, prioritize the highest-risk paths, and build automation incrementally so you see value early.'],
                ['q' => 'Which tools do you use?', 'a' => 'We match tools to your stack — commonly Playwright, Cypress, Selenium, and REST/GraphQL API testing frameworks.'],
            ]],
        $cta('Releases making you nervous?', 'Let\'s build the safety net. Talk to a senior QA engineer about your test automation.'),
    ],

    'cloud-devops' => [
        ['type' => 'hero', 'eyebrow' => 'Cloud & DevOps',
            'title' => 'Cloud migration and DevOps that scale without drama',
            'subtitle' => 'Move to the cloud, tame your infrastructure, and ship faster with CI/CD, automation, and cost control done by engineers who\'ve done it before.',
            'primary' => $quote, 'secondary' => $work],
        ['type' => 'rich', 'theme' => 'white', 'eyebrow' => 'What we do',
            'title' => 'Infrastructure that gets out of your way',
            'body' => '<p>The cloud only pays off when it\'s architected well. We plan and execute migrations, build the pipelines that make releases boring, and keep your bill and your uptime under control.</p>'
                . '<ul><li>Cloud migration (AWS, Azure, GCP)</li><li>CI/CD pipelines and release automation</li><li>Infrastructure as code and containerization</li><li>Cost optimization, monitoring, and reliability</li></ul>'],
        ['type' => 'cards', 'theme' => 'light', 'eyebrow' => 'Capabilities', 'title' => 'From migration to steady state',
            'columns' => 3,
            'items' => [
                ['title' => 'Cloud Migration', 'text' => 'Move workloads with a plan, not a prayer.'],
                ['title' => 'CI/CD Pipelines', 'text' => 'Automated, safe, repeatable releases.'],
                ['title' => 'Infrastructure as Code', 'text' => 'Reproducible environments you can trust.'],
                ['title' => 'Containers & Orchestration', 'text' => 'Docker and Kubernetes done sensibly.'],
                ['title' => 'Cost Optimization', 'text' => 'Right-size the bill without risking uptime.'],
                ['title' => 'Monitoring & Reliability', 'text' => 'See problems before your users do.'],
            ]],
        ['type' => 'faq', 'eyebrow' => 'FAQ', 'title' => 'Cloud & DevOps questions',
            'items' => [
                ['q' => 'What do cloud migration services cost?', 'a' => 'It depends on the size and state of your current systems. We start with an assessment that gives you a migration plan and a cost/risk picture before any lift-and-shift.'],
                ['q' => 'Which cloud providers do you work with?', 'a' => 'AWS, Azure, and Google Cloud. We recommend based on your workloads and existing commitments, not a vendor preference.'],
                ['q' => 'Can you reduce our cloud bill?', 'a' => 'Usually, yes. Right-sizing, autoscaling, and architecture fixes often cut spend meaningfully while improving reliability.'],
            ]],
        $cta('Cloud costs or chaos out of hand?', 'Let\'s assess it. Talk to a senior DevOps engineer about migration or optimization.'),
    ],

    'ai-ml-data' => [
        ['type' => 'hero', 'eyebrow' => 'AI/ML & Data Engineering',
            'title' => 'Put your data and AI to work — safely',
            'subtitle' => 'Generative AI, machine learning, and data platforms built on your data, with the guardrails and engineering rigor real businesses need.',
            'primary' => $quote, 'secondary' => $work],
        ['type' => 'rich', 'theme' => 'white', 'eyebrow' => 'What we build',
            'title' => 'AI that ships, not AI that demos',
            'body' => '<p>Most AI projects stall between a promising demo and something you can trust in production. We build the data foundation, the models or integrations, and the guardrails that turn AI from a science project into a dependable feature.</p>'
                . '<ul><li>Generative AI and LLM-powered features</li><li>Machine learning models and MLOps</li><li>Data engineering, warehousing, and pipelines</li><li>Business intelligence and analytics</li></ul>'],
        ['type' => 'cards', 'theme' => 'light', 'eyebrow' => 'Capabilities', 'title' => 'From raw data to real intelligence',
            'columns' => 3,
            'items' => [
                ['title' => 'Generative AI', 'text' => 'LLM features, assistants, and automation — with guardrails.'],
                ['title' => 'Machine Learning', 'text' => 'Models built, deployed, and monitored in production.'],
                ['title' => 'Data Engineering', 'text' => 'Pipelines and warehouses your teams can rely on.'],
                ['title' => 'Business Intelligence', 'text' => 'Analytics that answer the questions leaders ask.'],
                ['title' => 'MLOps', 'text' => 'The plumbing that keeps models healthy over time.'],
                ['title' => 'AI Strategy', 'text' => 'Where AI actually pays off in your business — and where it doesn\'t.'],
            ]],
        ['type' => 'faq', 'eyebrow' => 'FAQ', 'title' => 'AI & data questions',
            'items' => [
                ['q' => 'What do AI development services cost?', 'a' => 'It ranges from a focused feature integration to a full platform. We start with a scoped proof of value so you see results before a large commitment.'],
                ['q' => 'Is our data safe with generative AI?', 'a' => 'We design for it — private deployments, data-handling controls, and guardrails so sensitive data isn\'t exposed. For regulated data we build to your compliance requirements.'],
                ['q' => 'Do we need a data platform first?', 'a' => 'Not always. We meet you where you are, and often deliver a useful AI feature while laying the data foundation in parallel.'],
            ]],
        $cta('Want AI that actually ships?', 'Tell us the problem, not the buzzword. We\'ll scope an AI solution that earns its place.'),
    ],

    'ui-ux-design' => [
        ['type' => 'hero', 'eyebrow' => 'Product Design (UI/UX)',
            'title' => 'Interfaces that are clear, fast, and a pleasure to use',
            'subtitle' => 'Product design and UI/UX that make complex software feel simple — grounded in real user needs, delivered ready to build.',
            'primary' => $quote, 'secondary' => $work],
        ['type' => 'rich', 'theme' => 'white', 'eyebrow' => 'What we do',
            'title' => 'Design that engineering can actually ship',
            'body' => '<p>Good design isn\'t decoration — it\'s the difference between software people adopt and software they abandon. Because we\'re also the team that builds, our design is grounded in what\'s buildable and shipped without the usual handoff friction.</p>'
                . '<ul><li>Product and UX design</li><li>UI design and design systems</li><li>User research and usability testing</li><li>Prototyping and design-to-build handoff</li></ul>'],
        ['type' => 'cards', 'theme' => 'light', 'eyebrow' => 'Capabilities', 'title' => 'Research to shipped interface',
            'columns' => 3,
            'items' => [
                ['title' => 'UX Design', 'text' => 'Flows and structure that make complex tasks feel simple.'],
                ['title' => 'UI Design', 'text' => 'Clean, on-brand interfaces down to the detail.'],
                ['title' => 'Design Systems', 'text' => 'Reusable components that keep products consistent.'],
                ['title' => 'User Research', 'text' => 'Decisions grounded in what users actually do.'],
                ['title' => 'Prototyping', 'text' => 'Test the experience before you build it.'],
                ['title' => 'Design-to-Build', 'text' => 'Handoff to the same team that ships it — no lost intent.'],
            ]],
        ['type' => 'faq', 'eyebrow' => 'FAQ', 'title' => 'Product design questions',
            'items' => [
                ['q' => 'Do you do design without development?', 'a' => 'Yes — we take standalone design engagements. But our edge is that we also build, so the design is grounded in what ships.'],
                ['q' => 'Can you redesign an existing product?', 'a' => 'Yes. We start with a UX audit and research, then redesign in a way that can be rolled out without breaking your users\' habits.'],
                ['q' => 'Do you build design systems?', 'a' => 'Yes — reusable component libraries that keep a growing product visually and functionally consistent.'],
            ]],
        $cta('Product feel clunky?', 'Let\'s make it clear and fast. Talk to us about design that\'s ready to build.'),
    ],

    // ══════════════════════════════════════════════════════════
    //  HEALTHCARE PILLAR  (/industries/healthcare-software-development/)
    // ══════════════════════════════════════════════════════════
    'healthcare-software-development' => [
        ['type' => 'hero', 'eyebrow' => 'Healthcare Software Development',
            'title' => 'Custom healthcare software, built for compliance and care',
            'subtitle' => 'Neutech designs and builds HIPAA-compliant telemedicine platforms, EHR/EMR systems, and medical practice software — with senior engineers who ship, not juniors who learn on your budget.',
            'primary' => $quote, 'secondary' => ['url' => '/hipaa-security/', 'label' => 'HIPAA & security']],
        ['type' => 'rich', 'theme' => 'white', 'eyebrow' => 'What we build',
            'title' => 'Software for the way modern healthcare actually runs',
            'body' => '<p>Healthcare teams don\'t need another off-the-shelf tool that almost fits. They need software shaped around their workflows, their compliance obligations, and the systems they already depend on. That\'s what we build.</p>'
                . '<p>From virtual-care platforms and custom EHR/EMR builds to practice-management and medical-device software, every engagement is led by senior engineers and run against HIPAA, HL7/FHIR interoperability, and SOC 2 controls from day one — not bolted on before launch.</p>'
                . '<ul><li>Discovery and solution architecture with a named senior team</li><li>HIPAA-compliant builds with audit-ready documentation</li><li>HL7 / FHIR integration with EHRs, labs, and payers</li><li>Ongoing support, QA, and compliance maintenance after launch</li></ul>'],
        ['type' => 'cards', 'theme' => 'light', 'eyebrow' => 'Healthcare capabilities',
            'title' => 'Where healthcare teams put us to work',
            'intro' => 'Five focused practice areas, each staffed by engineers who have shipped in regulated healthcare environments before.',
            'columns' => 3,
            'items' => [
                ['title' => 'Telemedicine & Telehealth', 'text' => 'Video-visit platforms, remote patient monitoring, and virtual-care apps built for scale, reliability, and reimbursement.', 'meta' => 'Telemedicine app development', 'url' => '/industries/healthcare-software-development/telemedicine-app-development/'],
                ['title' => 'EHR / EMR Software', 'text' => 'Custom electronic health record systems and integrations with Epic, Cerner, and FHIR-based data exchange.', 'meta' => 'EHR/EMR development', 'url' => '/industries/healthcare-software-development/ehr-emr-software-development/'],
                ['title' => 'Practice Management & Billing', 'text' => 'Scheduling, patient portals, revenue-cycle and medical-billing software that cuts admin load.', 'meta' => 'Practice management software', 'url' => '/industries/healthcare-software-development/medical-practice-software/'],
                ['title' => 'Medical Device & SaMD', 'text' => 'Software as a Medical Device and connected-device firmware built to FDA and IEC 62304 expectations.', 'meta' => 'Medical device software', 'url' => '/industries/healthcare-software-development/medical-device-software/'],
                ['title' => 'Healthcare IT Consulting', 'text' => 'Architecture, compliance, and modernization strategy for healthcare organizations and health-tech startups.', 'meta' => 'Healthcare IT consulting', 'url' => '/industries/healthcare-software-development/healthcare-it-consulting/'],
                ['title' => 'AI in Healthcare', 'text' => 'Clinical decision support, documentation automation, and analytics built on your data — safely.', 'meta' => 'AI/ML for healthcare', 'url' => '/services/ai-ml-data/'],
            ]],
        ['type' => 'stats', 'title' => 'Why healthcare teams choose Neutech',
            'items' => [
                ['num' => 'HIPAA', 'label' => 'Compliant by default on every build'],
                ['num' => 'HL7 / FHIR', 'label' => 'Interoperability with EHRs, labs & payers'],
                ['num' => 'Senior', 'label' => 'Engineers lead every engagement'],
                ['num' => 'US-based', 'label' => 'HQ in Orange County, California'],
            ]],
        ['type' => 'faq', 'eyebrow' => 'FAQ', 'title' => 'Healthcare software development questions',
            'items' => [
                ['q' => 'How much does custom healthcare software development cost?', 'a' => 'It depends on scope, integrations, and compliance surface. Most healthcare builds start in the low-to-mid six figures for a first release; we scope a fixed range during a short paid discovery so you see the number before committing to a full build.'],
                ['q' => 'Do you build HIPAA-compliant software?', 'a' => 'Yes. HIPAA safeguards, access controls, encryption, and audit logging are designed in from the start, and we provide audit-ready documentation. We can also work within your SOC 2 program and sign a BAA.'],
                ['q' => 'Can you integrate with our existing EHR?', 'a' => 'Yes. We integrate with major EHRs (Epic, Cerner, athenahealth and others) and build HL7 v2 and FHIR interfaces for data exchange with labs, payers, and health information exchanges.'],
                ['q' => 'How long does a telemedicine or EHR build take?', 'a' => 'A focused MVP typically takes 3-5 months; larger platforms are delivered in phases so you get usable software early and expand from there.'],
                ['q' => 'Do you offer ongoing support after launch?', 'a' => 'Yes. We provide maintenance, QA, compliance updates, and feature development through dedicated-team or retainer engagements after go-live.'],
            ]],
        $cta('Have a healthcare product to build?', 'Tell us what you\'re trying to ship. You\'ll talk to a senior engineer, not a salesperson, and leave with a scoped path forward.'),
    ],

    // ── Healthcare spokes ──────────────────────────────────────
    'telemedicine-app-development' => [
        ['type' => 'hero', 'eyebrow' => 'Telemedicine & Telehealth',
            'title' => 'Telemedicine platforms that patients and providers actually use',
            'subtitle' => 'We build HIPAA-compliant video-visit platforms, remote patient monitoring, and virtual-care apps — reliable, reimbursable, and ready to scale.',
            'primary' => $quote, 'secondary' => ['url' => '/industries/healthcare-software-development/', 'label' => 'Healthcare software']],
        ['type' => 'rich', 'theme' => 'white', 'eyebrow' => 'What we build',
            'title' => 'Virtual care, engineered for the real world',
            'body' => '<p>Telehealth only works when the video connects, the visit is documented, and the whole thing is compliant. We build platforms that hold up on a patient\'s home Wi-Fi and inside a provider\'s workflow.</p>'
                . '<ul><li>Video-visit and virtual-consultation platforms</li><li>Remote patient monitoring (RPM) and connected devices</li><li>Scheduling, e-prescribing, and payment integration</li><li>EHR and payer integration for documentation and billing</li></ul>'],
        ['type' => 'cards', 'theme' => 'light', 'eyebrow' => 'Capabilities', 'title' => 'A complete telehealth stack', 'columns' => 3,
            'items' => [
                ['title' => 'Video Visits', 'text' => 'Low-latency, reliable video built for clinical use.'],
                ['title' => 'Remote Monitoring', 'text' => 'Device data, alerts, and dashboards for RPM programs.'],
                ['title' => 'Scheduling & Intake', 'text' => 'Booking, forms, and eligibility that reduce no-shows.'],
                ['title' => 'E-Prescribing', 'text' => 'Integrated prescribing and pharmacy workflows.'],
                ['title' => 'Billing & Reimbursement', 'text' => 'Coding and payer integration so visits get paid.'],
                ['title' => 'EHR Integration', 'text' => 'Documentation flows straight into the record.'],
            ]],
        ['type' => 'faq', 'eyebrow' => 'FAQ', 'title' => 'Telemedicine development questions',
            'items' => [
                ['q' => 'Is the platform HIPAA-compliant?', 'a' => 'Yes — encryption, access controls, audit logging, and a signed BAA are standard. We build for HIPAA from day one, not as a launch-week scramble.'],
                ['q' => 'Can it integrate with our EHR and billing?', 'a' => 'Yes. We integrate with major EHRs via HL7/FHIR and wire up coding and payer flows so telehealth visits are documented and reimbursed.'],
                ['q' => 'How long does a telemedicine build take?', 'a' => 'A focused MVP typically ships in 3-5 months; broader platforms are delivered in phases.'],
            ]],
        $cta('Building a telehealth product?', 'Talk to a senior engineer about your telemedicine or RPM platform.'),
    ],

    'ehr-emr-software-development' => [
        ['type' => 'hero', 'eyebrow' => 'EHR / EMR Software',
            'title' => 'Custom EHR/EMR software that fits how your clinicians work',
            'subtitle' => 'Off-the-shelf records systems force bad workflows. We build and integrate EHR/EMR software shaped around your specialty, your data, and your compliance needs.',
            'primary' => $quote, 'secondary' => ['url' => '/industries/healthcare-software-development/', 'label' => 'Healthcare software']],
        ['type' => 'rich', 'theme' => 'white', 'eyebrow' => 'What we build',
            'title' => 'Records software that helps instead of hurts',
            'body' => '<p>The right record system disappears into the visit; the wrong one becomes the visit. We build custom EHR/EMR software and integrations that match your specialty and connect to the rest of your stack.</p>'
                . '<ul><li>Custom and specialty-specific EHR/EMR builds</li><li>Integration with Epic, Cerner, athenahealth, and others</li><li>HL7 v2 and FHIR interfaces with labs, payers, and HIEs</li><li>Patient portals and clinician-facing workflows</li></ul>'],
        ['type' => 'cards', 'theme' => 'light', 'eyebrow' => 'Capabilities', 'title' => 'Build, integrate, or modernize', 'columns' => 3,
            'items' => [
                ['title' => 'Custom EHR/EMR', 'text' => 'Specialty-fit records systems built to your workflows.'],
                ['title' => 'EHR Integration', 'text' => 'Connect to Epic, Cerner, athenahealth and more.'],
                ['title' => 'HL7 / FHIR Interfaces', 'text' => 'Interoperable data exchange with labs and payers.'],
                ['title' => 'Patient Portals', 'text' => 'Secure access to records, messaging, and results.'],
                ['title' => 'Clinical Workflows', 'text' => 'Charting, orders, and documentation that clinicians tolerate.'],
                ['title' => 'Data Migration', 'text' => 'Move legacy records safely and completely.'],
            ]],
        ['type' => 'faq', 'eyebrow' => 'FAQ', 'title' => 'EHR/EMR development questions',
            'items' => [
                ['q' => 'Should we build custom or integrate with an existing EHR?', 'a' => 'Often both — a custom layer for your specialty plus integration with a system of record. We help you decide based on cost, compliance, and workflow fit.'],
                ['q' => 'Do you support FHIR interoperability?', 'a' => 'Yes. We build FHIR and HL7 v2 interfaces for data exchange with EHRs, labs, payers, and health information exchanges.'],
                ['q' => 'Is patient data secure and compliant?', 'a' => 'Yes — HIPAA safeguards, encryption, and audit logging are built in, with audit-ready documentation.'],
            ]],
        $cta('Need EHR/EMR software?', 'Talk to a senior engineer about building or integrating your records system.'),
    ],

    'medical-practice-software' => [
        ['type' => 'hero', 'eyebrow' => 'Practice Management & Billing',
            'title' => 'Practice software that cuts the admin, not the care',
            'subtitle' => 'Scheduling, patient portals, revenue-cycle, and medical-billing software that reduces the paperwork load and gets your practice paid faster.',
            'primary' => $quote, 'secondary' => ['url' => '/industries/healthcare-software-development/', 'label' => 'Healthcare software']],
        ['type' => 'rich', 'theme' => 'white', 'eyebrow' => 'What we build',
            'title' => 'Run the practice, not the paperwork',
            'body' => '<p>Administrative overhead quietly eats a practice\'s margin and its staff\'s patience. We build software that automates scheduling, intake, billing, and the revenue cycle so your team spends time on patients.</p>'
                . '<ul><li>Scheduling and appointment management</li><li>Patient portals and intake automation</li><li>Medical billing and revenue-cycle management</li><li>Outsourced-billing integration and claims workflows</li></ul>'],
        ['type' => 'cards', 'theme' => 'light', 'eyebrow' => 'Capabilities', 'title' => 'The back office, automated', 'columns' => 3,
            'items' => [
                ['title' => 'Scheduling', 'text' => 'Booking, reminders, and no-show reduction.'],
                ['title' => 'Patient Portals', 'text' => 'Intake, messaging, records, and payments.'],
                ['title' => 'Medical Billing', 'text' => 'Coding, claims, and clean-claim automation.'],
                ['title' => 'Revenue Cycle', 'text' => 'From eligibility to collections, tracked end to end.'],
                ['title' => 'Reporting', 'text' => 'See where revenue and time actually go.'],
                ['title' => 'Integrations', 'text' => 'Connect to your EHR, clearinghouse, and payers.'],
            ]],
        ['type' => 'faq', 'eyebrow' => 'FAQ', 'title' => 'Practice software questions',
            'items' => [
                ['q' => 'Can you integrate with our billing service?', 'a' => 'Yes. We integrate with clearinghouses, outsourced billers, and payers, and can automate the claim and revenue-cycle workflow around them.'],
                ['q' => 'Will it work with our EHR?', 'a' => 'Yes — we integrate practice-management software with your existing EHR so data flows without double entry.'],
                ['q' => 'Is it HIPAA-compliant?', 'a' => 'Yes, with the same compliance and audit standards we apply to every healthcare build.'],
            ]],
        $cta('Drowning in practice admin?', 'Talk to a senior engineer about software that cuts the overhead.'),
    ],

    'medical-device-software' => [
        ['type' => 'hero', 'eyebrow' => 'Medical Device & SaMD',
            'title' => 'Medical device software built to a regulated bar',
            'subtitle' => 'Software as a Medical Device (SaMD) and connected-device firmware engineered to FDA and IEC 62304 expectations — safe, documented, and auditable.',
            'primary' => $quote, 'secondary' => ['url' => '/hipaa-security/', 'label' => 'Compliance & security']],
        ['type' => 'rich', 'theme' => 'white', 'eyebrow' => 'What we build',
            'title' => 'Where a bug isn\'t just a bug',
            'body' => '<p>Medical-device software carries a burden most software doesn\'t: it has to be safe, and you have to prove it. We build SaMD and connected-device software with the process, documentation, and rigor that regulated work demands.</p>'
                . '<ul><li>Software as a Medical Device (SaMD)</li><li>Connected-device and IoMT firmware</li><li>IEC 62304 lifecycle and FDA-aligned documentation</li><li>Data pipelines, dashboards, and cloud connectivity</li></ul>'],
        ['type' => 'cards', 'theme' => 'light', 'eyebrow' => 'Capabilities', 'title' => 'Engineering for regulated devices', 'columns' => 3,
            'items' => [
                ['title' => 'SaMD Development', 'text' => 'Diagnostic and therapeutic software built to standard.'],
                ['title' => 'Device Firmware', 'text' => 'Reliable embedded software for connected devices.'],
                ['title' => 'IEC 62304 Process', 'text' => 'A software lifecycle regulators recognize.'],
                ['title' => 'Cloud & Connectivity', 'text' => 'Secure device-to-cloud data and remote updates.'],
                ['title' => 'Data & Dashboards', 'text' => 'Turn device data into clinical insight.'],
                ['title' => 'V&V Documentation', 'text' => 'Verification and validation you can submit.'],
            ]],
        ['type' => 'faq', 'eyebrow' => 'FAQ', 'title' => 'Medical device software questions',
            'items' => [
                ['q' => 'Do you follow IEC 62304?', 'a' => 'Yes. We run a software lifecycle aligned to IEC 62304 with the documentation and traceability regulated submissions require.'],
                ['q' => 'Can you support our FDA submission?', 'a' => 'We produce the software documentation, verification, and validation artifacts that support FDA submissions; we work alongside your regulatory team.'],
                ['q' => 'Do you build both firmware and cloud?', 'a' => 'Yes — embedded device software plus the secure cloud, data pipelines, and dashboards around it.'],
            ]],
        $cta('Building a medical device?', 'Talk to a senior engineer about your SaMD or connected-device software.'),
    ],

    'healthcare-it-consulting' => [
        ['type' => 'hero', 'eyebrow' => 'Healthcare IT Consulting',
            'title' => 'A senior technical partner for healthcare organizations',
            'subtitle' => 'Architecture, compliance, and modernization strategy for providers and health-tech companies — from engineers who build, not just advise.',
            'primary' => $quote, 'secondary' => ['url' => '/industries/healthcare-software-development/', 'label' => 'Healthcare software']],
        ['type' => 'rich', 'theme' => 'white', 'eyebrow' => 'What we do',
            'title' => 'Advice that comes with the ability to execute',
            'body' => '<p>Most healthcare IT consulting stops at a slide deck. Ours comes from a team that ships — so the strategy is grounded in what can actually be built, integrated, and maintained.</p>'
                . '<ul><li>Solution architecture and technology strategy</li><li>HIPAA and SOC 2 compliance readiness</li><li>Interoperability and integration planning</li><li>Legacy modernization and cloud migration roadmaps</li></ul>'],
        ['type' => 'cards', 'theme' => 'light', 'eyebrow' => 'How we help', 'title' => 'Strategy you can build on', 'columns' => 3,
            'items' => [
                ['title' => 'Architecture Review', 'text' => 'An honest assessment of where you are and what to fix.'],
                ['title' => 'Compliance Readiness', 'text' => 'A path to HIPAA and SOC 2 that engineers can execute.'],
                ['title' => 'Interoperability', 'text' => 'HL7/FHIR strategy that connects your systems.'],
                ['title' => 'Modernization Roadmap', 'text' => 'Retire legacy risk without a big-bang rewrite.'],
                ['title' => 'Vendor Selection', 'text' => 'Build-vs-buy calls made with clear eyes.'],
                ['title' => 'Fractional CTO', 'text' => 'Senior technical leadership when you need it.'],
            ]],
        ['type' => 'faq', 'eyebrow' => 'FAQ', 'title' => 'Healthcare IT consulting questions',
            'items' => [
                ['q' => 'Do you also build what you recommend?', 'a' => 'Yes — that\'s the point. We can advise only, or advise and then execute, so the strategy doesn\'t die in a deck.'],
                ['q' => 'Can you help us get HIPAA or SOC 2 ready?', 'a' => 'Yes. We assess your current state and give you a concrete, engineer-executable path to compliance.'],
                ['q' => 'Do you work with early-stage health-tech?', 'a' => 'Yes — from architecture and MVP through scale, including fractional technical leadership.'],
            ]],
        $cta('Need a technical partner in healthcare?', 'Talk to a senior engineer about your architecture, compliance, or modernization.'),
    ],

    // ── Industries index ───────────────────────────────────────
    'industries' => [
        ['type' => 'hero', 'eyebrow' => 'Industries',
            'title' => 'Depth in the domains where software is hardest',
            'subtitle' => 'We go deep where the stakes are highest and the rules are strictest — starting with healthcare and fintech.',
            'primary' => $quote, 'secondary' => $work, 'visual' => 'cube'],
        ['type' => 'cards', 'theme' => 'white', 'eyebrow' => 'Where we specialize', 'title' => 'Industry expertise', 'columns' => 2,
            'items' => [
                ['eyebrow' => 'Featured', 'title' => 'Healthcare Software Development', 'text' => 'HIPAA-compliant telemedicine, EHR/EMR, practice management, and medical-device software.', 'url' => '/industries/healthcare-software-development/'],
                ['title' => 'Fintech & Financial Software', 'text' => 'Custom banking, payments, and financial platforms built for security and compliance.', 'url' => '/industries/fintech-software-development/'],
            ]],
        $why_stats,
        $cta('Work in a regulated industry?', 'Tell us the domain and the constraints. We\'ve probably shipped into them before.'),
    ],

    // ── Fintech pillar ─────────────────────────────────────────
    'fintech-software-development' => [
        ['type' => 'hero', 'eyebrow' => 'Fintech & Financial Software',
            'title' => 'Financial software built for security and compliance',
            'subtitle' => 'Custom fintech, banking, and payments software engineered by senior developers who understand that in finance, trust is the product.',
            'primary' => $quote, 'secondary' => $work],
        ['type' => 'rich', 'theme' => 'white', 'eyebrow' => 'What we build',
            'title' => 'Software the finance world can rely on',
            'body' => '<p>In financial software, a bug is a breach and downtime is a headline. We build fintech products with the security, reliability, and compliance posture the industry demands.</p>'
                . '<ul><li>Custom fintech and financial platforms</li><li>Banking, payments, and lending software</li><li>Trading, portfolio, and investment tools</li><li>Compliance, security, and audit-ready architecture</li></ul>'],
        ['type' => 'cards', 'theme' => 'light', 'eyebrow' => 'Capabilities', 'title' => 'Across the financial stack', 'columns' => 3,
            'items' => [
                ['title' => 'Banking & Payments', 'text' => 'Core banking, digital wallets, and payment flows.', 'url' => '/industries/fintech-software-development/banking-software-development/'],
                ['title' => 'Lending & Credit', 'text' => 'Origination, underwriting, and servicing software.'],
                ['title' => 'Trading & Investment', 'text' => 'Portfolio, analytics, and trading tools.'],
                ['title' => 'Fintech Apps', 'text' => 'Consumer and B2B financial products, web and mobile.'],
                ['title' => 'Security & Compliance', 'text' => 'Built to pass the audits your industry runs.'],
                ['title' => 'Integrations', 'text' => 'Connect to processors, ledgers, and data providers.'],
            ]],
        ['type' => 'faq', 'eyebrow' => 'FAQ', 'title' => 'Fintech development questions',
            'items' => [
                ['q' => 'How do you handle security and compliance?', 'a' => 'Security and auditability are designed in — encryption, access control, logging, and architecture aligned to the standards your product must meet (PCI DSS, SOC 2, and others).'],
                ['q' => 'Can you integrate with payment processors and banking rails?', 'a' => 'Yes — we integrate with processors, banking-as-a-service providers, ledgers, and market-data sources.'],
                ['q' => 'Do you build both web and mobile fintech apps?', 'a' => 'Yes, across web and native mobile, with shared secure backends.'],
            ]],
        $cta('Building a financial product?', 'Talk to a senior engineer about your fintech, banking, or payments software.'),
    ],

    'banking-software-development' => [
        ['type' => 'hero', 'eyebrow' => 'Banking & Payments',
            'title' => 'Banking and payments software, engineered for trust',
            'subtitle' => 'Core banking, digital banking, and payment platforms built with the security and reliability financial institutions require.',
            'primary' => $quote, 'secondary' => ['url' => '/industries/fintech-software-development/', 'label' => 'Fintech software']],
        ['type' => 'rich', 'theme' => 'white', 'eyebrow' => 'What we build',
            'title' => 'From ledgers to digital wallets',
            'body' => '<p>Money software has to be right, every time. We build banking and payment products — and the secure integrations behind them — to a standard the industry can trust.</p>'
                . '<ul><li>Core and digital banking platforms</li><li>Payment processing and digital wallets</li><li>White-label and banking-as-a-service builds</li><li>Ledger, reconciliation, and compliance tooling</li></ul>'],
        ['type' => 'cards', 'theme' => 'light', 'eyebrow' => 'Capabilities', 'title' => 'Across banking & payments', 'columns' => 3,
            'items' => [
                ['title' => 'Digital Banking', 'text' => 'Customer-facing banking apps and portals.'],
                ['title' => 'Payments', 'text' => 'Processing, wallets, and money movement.'],
                ['title' => 'BaaS & White-Label', 'text' => 'Launch financial products faster on solid rails.'],
                ['title' => 'Ledgers & Reconciliation', 'text' => 'Accurate, auditable records of every cent.'],
                ['title' => 'Compliance Tooling', 'text' => 'KYC, AML, and reporting workflows.'],
                ['title' => 'Integrations', 'text' => 'Connect to processors, networks, and cores.'],
            ]],
        ['type' => 'faq', 'eyebrow' => 'FAQ', 'title' => 'Banking software questions',
            'items' => [
                ['q' => 'Is the software PCI and security compliant?', 'a' => 'Yes — we build to PCI DSS and financial security standards, with encryption, access control, and audit logging throughout.'],
                ['q' => 'Can you build white-label or BaaS products?', 'a' => 'Yes. We build on banking-as-a-service rails and deliver white-label products so you launch faster.'],
                ['q' => 'Do you integrate with existing core systems?', 'a' => 'Yes — we integrate with core banking systems, processors, and networks.'],
            ]],
        $cta('Building a banking or payments product?', 'Talk to a senior engineer about your platform.'),
    ],

    // ── BoFu: proof & decision ─────────────────────────────────
    'work' => [
        ['type' => 'hero', 'eyebrow' => 'Selected Work',
            'title' => 'Software we\'ve shipped',
            'subtitle' => 'A look at the kinds of products we build. Detailed, named case studies available under NDA on request.',
            'primary' => $quote, 'secondary' => ['url' => '/services/', 'label' => 'Our solutions'], 'visual' => 'frame'],
        ['type' => 'cards', 'theme' => 'white', 'eyebrow' => 'Case studies', 'title' => 'Representative projects', 'columns' => 3,
            'intro' => 'Illustrative of scope and outcomes; client names shared under NDA.',
            'items' => [
                ['eyebrow' => 'Healthcare', 'title' => 'Telemedicine platform for a multi-state provider', 'text' => 'HIPAA-compliant video-visit and RPM platform with EHR integration, launched in phases.', 'meta' => 'Telemedicine · EHR integration'],
                ['eyebrow' => 'Healthcare', 'title' => 'Custom EHR module for a specialty clinic group', 'text' => 'Specialty-fit charting and patient portal integrated with an existing system of record.', 'meta' => 'EHR/EMR · FHIR'],
                ['eyebrow' => 'Fintech', 'title' => 'Payments platform for a B2B marketplace', 'text' => 'Secure money movement, ledgering, and reconciliation on banking-as-a-service rails.', 'meta' => 'Payments · Compliance'],
                ['eyebrow' => 'SaaS', 'title' => 'Multi-tenant web platform for an operations startup', 'text' => 'From MVP to scale — roles, billing, and integrations, shipped by a dedicated team.', 'meta' => 'Web app · MVP to scale'],
                ['eyebrow' => 'Staff Aug', 'title' => 'Senior engineers embedded in a product team', 'text' => 'Filled a critical capacity gap; shipping in the client\'s process from week one.', 'meta' => 'Staff augmentation'],
                ['eyebrow' => 'AI', 'title' => 'Document-automation feature for a services firm', 'text' => 'LLM-powered automation with guardrails, built on the client\'s private data.', 'meta' => 'AI/ML · Data'],
            ]],
        $cta('Want to see relevant case studies?', 'Tell us your domain and we\'ll walk you through named, detailed work under NDA.'),
    ],

    'hipaa-security' => [
        ['type' => 'hero', 'eyebrow' => 'Compliance & Security',
            'title' => 'HIPAA and SOC 2, built in from day one',
            'subtitle' => 'Security and compliance aren\'t a launch-week checklist for us — they\'re how we architect every healthcare and financial build.',
            'primary' => $quote, 'secondary' => ['url' => '/industries/healthcare-software-development/', 'label' => 'Healthcare software']],
        ['type' => 'rich', 'theme' => 'white', 'eyebrow' => 'Our approach',
            'title' => 'Compliance is an architecture, not an afterthought',
            'body' => '<p>Bolting compliance on before launch is how projects slip and audits fail. We design safeguards into the system from the first sprint, and hand you the documentation to prove it.</p>'
                . '<ul><li>HIPAA safeguards: encryption, access control, audit logging</li><li>SOC 2-aligned engineering practices</li><li>Signed BAAs and audit-ready documentation</li><li>Secure SDLC, code review, and penetration testing</li></ul>'],
        ['type' => 'cards', 'theme' => 'light', 'eyebrow' => 'What we cover', 'title' => 'The controls we build in', 'columns' => 3,
            'items' => [
                ['title' => 'Encryption', 'text' => 'Data encrypted in transit and at rest, by default.'],
                ['title' => 'Access Control', 'text' => 'Least-privilege roles and strong authentication.'],
                ['title' => 'Audit Logging', 'text' => 'Every access to PHI is logged and reviewable.'],
                ['title' => 'BAAs', 'text' => 'We sign Business Associate Agreements.'],
                ['title' => 'Secure SDLC', 'text' => 'Code review, testing, and vulnerability scanning.'],
                ['title' => 'Documentation', 'text' => 'Audit-ready artifacts for your compliance team.'],
            ]],
        ['type' => 'faq', 'eyebrow' => 'FAQ', 'title' => 'Compliance & security questions',
            'items' => [
                ['q' => 'Will you sign a BAA?', 'a' => 'Yes. We sign Business Associate Agreements for engagements that involve protected health information.'],
                ['q' => 'Are you SOC 2 compliant?', 'a' => 'We follow SOC 2-aligned engineering practices and can build and document your product to support your own SOC 2 program.'],
                ['q' => 'Do you do penetration testing?', 'a' => 'Yes — secure code review and penetration testing are part of how we ship regulated software.'],
            ]],
        $cta('Have compliance requirements?', 'Tell us your obligations. We\'ll show you how we build to meet them.'),
    ],

    'pricing' => [
        ['type' => 'hero', 'eyebrow' => 'Engagement Models',
            'title' => 'How we work together — and what it costs',
            'subtitle' => 'Clear engagement models built around your stage and risk. No mystery, no lock-in you didn\'t agree to.',
            'primary' => $quote, 'secondary' => $work],
        ['type' => 'cards', 'theme' => 'white', 'eyebrow' => 'Ways to engage', 'title' => 'Three ways to work with us', 'columns' => 3,
            'intro' => 'Most engagements start with a short paid discovery, then move into the model that best de-risks your build.',
            'items' => [
                ['title' => 'Fixed-Scope Project', 'text' => 'Well-defined scope, fixed price and timeline. Best for clear, bounded builds.', 'meta' => 'Fixed price'],
                ['title' => 'Dedicated Team', 'text' => 'A senior team working your roadmap month to month. Best for evolving products.', 'meta' => 'Monthly retainer'],
                ['title' => 'Staff Augmentation', 'text' => 'Individual senior engineers under your direction. Best for filling capacity fast.', 'meta' => 'Per engineer', 'url' => '/services/staff-augmentation/'],
            ]],
        ['type' => 'rich', 'theme' => 'light', 'eyebrow' => 'What to expect',
            'title' => 'Honest ranges, scoped before you commit',
            'body' => '<p>Every project is different, but you shouldn\'t have to guess. Most first releases and MVPs land in the mid-five to low-six figures; larger platforms are phased so you fund value as it ships. We give you a fixed range after a short discovery — before you commit to a full build.</p>'
                . '<ul><li>Short paid discovery to scope and de-risk</li><li>A fixed range before the full engagement</li><li>You own all code and IP</li><li>No long lock-ins you didn\'t agree to</li></ul>'],
        ['type' => 'faq', 'eyebrow' => 'FAQ', 'title' => 'Pricing questions',
            'items' => [
                ['q' => 'How much does a project cost?', 'a' => 'Most first releases and MVPs range from mid-five to low-six figures depending on scope, integrations, and compliance. We scope a fixed range in a short discovery so you see the number before committing.'],
                ['q' => 'Do you do fixed price or time-and-materials?', 'a' => 'Both. Fixed-scope suits bounded projects; dedicated-team and staff augmentation suit evolving work. We recommend the model that de-risks your specific build.'],
                ['q' => 'Do we own the code?', 'a' => 'Yes — you own all source code and intellectual property.'],
            ]],
        $cta('Want a number for your project?', 'Tell us the scope. We\'ll scope a fixed range in a short discovery.'),
    ],

    'get-a-quote' => [
        ['type' => 'form', 'eyebrow' => 'Get a Quote',
            'title' => 'Tell us what you\'re trying to build',
            'intro' => 'Share a few details and a senior engineer will get back to you within one business day — with real questions, not a canned pitch. Prefer email? info@neutech.co.',
            'options' => ['Custom software development', 'Healthcare software', 'Fintech / financial software', 'Web application', 'Mobile app', 'Product / MVP', 'Staff augmentation', 'QA & testing', 'Cloud & DevOps', 'AI/ML & data', 'Something else'],
        ],
    ],

    // ══════════════════════════════════════════════════════════
    //  COMPANY / TRUST  [PLACEHOLDER COPY — awaiting client assets]
    // ══════════════════════════════════════════════════════════
    'our-team' => [
        ['type' => 'hero', 'eyebrow' => 'About Neutech',
            'title' => 'We build the engine. You build the car.',
            'subtitle' => 'We\'re obsessed with one thing: the quality of the engineer. Every vehicle is only as good as its engine, and we\'ve spent years perfecting ours — senior engineers trained on real enterprise systems, held to a bar most firms don\'t attempt. And we like the work others don\'t: the high-paced startup racing to ship, and the highly regulated enterprise where nothing ships without scrutiny. Different vehicles. Same engine.',
            'primary' => $quote, 'secondary' => $work],
        ['type' => 'rich', 'theme' => 'white', 'eyebrow' => 'Who we are',
            'title' => 'Built in California. Engineered across three continents.',
            'body' => '<p>Neutech is headquartered in Orange County, California, with our engineering hub anchored by two offices in S&atilde;o Paulo, Brazil — a real campus where 350+ engineers collaborate, train, and ship, not a mailing address. From there, our footprint extends across Latin America, the United States, and Europe, giving clients senior talent that works their hours, speaks their language, and understands their market.</p>'
                . '<p>That structure is deliberate — and so is our leadership. Neutech is run by executives on the ground on both sides of the operation: client partnership and growth in California, engineering and delivery leadership in S&atilde;o Paulo, with reach into Europe for clients and talent operating across time zones. No offshore black box, no satellite office running on autopilot — senior leadership everywhere the work happens.</p>'
                . '<ul><li>HQ in Orange County, California</li><li>Two offices in S&atilde;o Paulo — 350+ engineers on campus</li><li>Presence across LATAM, the US, and Europe</li><li>Executive leadership in both the US and Brazil</li><li>Senior engineers on every engagement</li><li>Full-lifecycle: discovery, build, QA, and support</li></ul>'],
        ['type' => 'cards', 'theme' => 'light', 'eyebrow' => 'Leadership', 'title' => 'The people behind the work',
            'columns' => 3,
            'items' => [
                ['eyebrow' => 'President & CEO', 'title' => 'Jared Neutel', 'text' => 'Leads Neutech\'s vision, growth, and client partnerships. Jared works directly with every client relationship — from first conversation through delivery — and splits his time between California and S&atilde;o Paulo, staying close to both sides of the operation.'],
                ['eyebrow' => 'CTO', 'title' => 'Rafael Goncalves', 'text' => 'Leads Neutech\'s global engineering organization from S&atilde;o Paulo. Rafael architected infrastructure for the Central Bank of Brazil and has led systems processing billions in daily transactions. He oversees the Residency Program and the technical bar every Neutech engineer has to clear.'],
                ['eyebrow' => 'COO', 'title' => 'Gustavo Haramura', 'text' => 'Leads global operations and delivery across every engagement. Gustavo owns the machinery that makes month-to-month flexibility possible — onboarding engineers in one to two weeks, keeping engagements on track, and making sure every client always knows exactly where things stand.'],
            ]],
        $why_stats,
        $cta('Want to work with a senior team?', 'Tell us what you\'re building. You\'ll talk to an engineer, not a salesperson.'),
    ],

    'how-we-work' => [
        ['type' => 'hero', 'eyebrow' => 'How We Work',
            'title' => 'Two ways to engage.<br>One standard of engineer.',
            'subtitle' => 'Every Neutech engagement runs on the same foundation: senior engineers, EST-aligned and English-first, on flexible month-to-month terms. The difference between our two models isn\'t the talent — it\'s who\'s steering. Pick the path that matches how you want to work.',
            'primary' => $quote, 'secondary' => $work],
        ['type' => 'cards', 'theme' => 'white', 'columns' => 2, 'plain' => true,
            'items' => [
                [
                    'title' => 'Staff Augmentation',
                    'lead'  => 'Your team. Your process. Our engineers.',
                    'text'  => 'Senior engineers who plug directly into your team — your standups, your tools, your company email. You interview them your way and direct the work day to day; we handle recruiting, HR, payroll, and replacement risk behind the scenes. Ramp up before a big push, ramp down when it ships. No recruiting fees, no headcount, no hiring overhang.',
                    'note'  => 'This is your path if: you have technical leadership and a clear roadmap — what you need is proven senior hands executing under your direction, fast.',
                    'url'   => '/services/staff-augmentation/',
                    'link_label' => 'Explore Staff Augmentation',
                ],
                [
                    'title' => 'The Wave',
                    'lead'  => 'Tell us the outcome. We ship it.',
                    'text'  => 'A Neutech-led delivery team — senior engineers, architecture, and project management under one roof — that takes your product from discovery to shipped. It\'s powered by our AI-native Residency Program: engineers trained on real enterprise systems who arrive already battle-tested, in coordinated waves, so momentum never stalls between phases. You own the result; we own the delivery.',
                    'note'  => 'This is your path if: you need something built — an MVP, a platform, a legacy modernization — and you\'d rather own the outcome than manage the process.',
                    'url'   => '/the-neutech-wave/',
                    'link_label' => 'Ride The Wave',
                ],
            ]],
        ['type' => 'rich', 'theme' => 'white',
            'body' => '<p>Still deciding? The simplest test: if you\'ll manage the engineers, that\'s Staff Augmentation. If you want us to manage the delivery, that\'s The Wave. Either way, you\'re getting the same seniors — just tell us where you want to sit.</p>'],
        ['type' => 'faq', 'eyebrow' => 'FAQ', 'title' => 'How we work — questions',
            'items' => [
                ['q' => 'How do engagements start?', 'a' => 'With a short, paid discovery that scopes the work and gives you a fixed range before any full build commitment.'],
                ['q' => 'How do you communicate progress?', 'a' => 'You get regular working demos and direct access to the engineers — not status theater.'],
                ['q' => 'Who owns the code?', 'a' => 'You do. All source code and IP produced in the engagement are yours.'],
            ]],
        $cta('Ready to start?', 'Book a short discovery call and get a scoped path forward.'),
    ],

    // ══════════════════════════════════════════════════════════
    //  GUIDES  (/guides/…)  — high-intent comparison / cost content
    // ══════════════════════════════════════════════════════════
    'staff-augmentation-vs-managed-services' => [
        ['type' => 'hero', 'eyebrow' => 'Guide',
            'title' => 'Staff augmentation vs managed services: which do you need?',
            'subtitle' => 'Two very different ways to get software built. Here\'s how to choose the right one for your team and your risk.',
            'primary' => $quote, 'secondary' => ['url' => '/services/staff-augmentation/', 'label' => 'Staff augmentation']],
        ['type' => 'rich', 'theme' => 'white', 'eyebrow' => 'The short answer',
            'title' => 'Direction vs outcome',
            'body' => '<p><strong>Staff augmentation</strong> adds senior engineers who work <em>under your direction</em> and inside your process — you own the roadmap and the management. <strong>Managed services</strong> hand an <em>outcome</em> to a vendor who owns delivery end to end.</p>'
                . '<ul><li>Choose staff augmentation when you have strong product/eng leadership and just need capacity or a specific skill.</li><li>Choose managed services when you want a team to own a deliverable and you don\'t want to manage the day-to-day.</li><li>Many teams mix both — augment the core team, and hand discrete projects to a managed pod.</li></ul>'],
        ['type' => 'magnet', 'eyebrow' => 'Free guide',
            'title' => 'The full comparison, in one PDF',
            'intro' => 'Cost, control, and risk side by side — including when we\'d tell you not to use us. Six pages, no gate beyond your name and email.',
            'magnet' => 'staffaug_vs_managed',
            'label' => 'Download Comparison Guide'],
        ['type' => 'faq', 'eyebrow' => 'FAQ', 'title' => 'Common questions',
            'items' => [
                ['q' => 'Which is cheaper?', 'a' => 'Staff augmentation usually has a lower headline rate; managed services can be cheaper in total when you factor in the management overhead you avoid.'],
                ['q' => 'Can Neutech do both?', 'a' => 'Yes — we offer senior staff augmentation and full managed delivery, and help you pick per initiative.'],
            ]],
        $cta('Not sure which fits?', 'Tell us your situation. We\'ll recommend the model that de-risks your build.'),
    ],

    'offshore-vs-nearshore-software-development' => [
        ['type' => 'hero', 'eyebrow' => 'Guide',
            'title' => 'Offshore vs nearshore software development',
            'subtitle' => 'Time zones, communication, cost, and quality — a clear-eyed look at how the two models really compare.',
            'primary' => $quote, 'secondary' => ['url' => '/services/staff-augmentation/', 'label' => 'Hire developers']],
        ['type' => 'rich', 'theme' => 'white', 'eyebrow' => 'The trade-offs',
            'title' => 'It comes down to overlap and oversight',
            'body' => '<p><strong>Offshore</strong> (far time zones) can lower cost but adds communication lag; <strong>nearshore</strong> (nearby time zones) trades a little cost for real-time overlap and easier collaboration.</p>'
                . '<ul><li>Offshore fits well-specified, loosely-coupled work where overlap matters less.</li><li>Nearshore fits fast-moving product work that needs daily collaboration.</li><li>What matters most either way is seniority and process — cheap juniors are expensive in rework.</li></ul>'
                . '<p>[Placeholder guide — expand with cost bands, overlap tables, and vendor-selection checklist.]</p>'],
        $cta('Want senior engineers who overlap with your day?', 'Talk to us about a team that fits your time zone and your standards.'),
    ],

    'cost-of-custom-healthcare-software-development' => [
        ['type' => 'hero', 'eyebrow' => 'Guide',
            'title' => 'What does custom healthcare software development cost?',
            'subtitle' => 'A practical breakdown of what drives the price of telemedicine, EHR/EMR, and practice software — and how to budget for it.',
            'primary' => $quote, 'secondary' => ['url' => '/industries/healthcare-software-development/', 'label' => 'Healthcare software']],
        ['type' => 'rich', 'theme' => 'white', 'eyebrow' => 'What drives the number',
            'title' => 'Scope, integrations, and compliance',
            'body' => '<p>Most custom healthcare builds start in the low-to-mid six figures for a first release. The biggest cost drivers are integration surface (EHRs, labs, payers), compliance depth (HIPAA, SOC 2), and the number of user roles and workflows.</p>'
                . '<ul><li>MVP vs full platform — phasing lets you fund value as it ships.</li><li>Integrations (HL7/FHIR) add cost but remove manual work later.</li><li>Compliance designed in from day one is far cheaper than retrofitted before launch.</li></ul>'
                . '<p>[Placeholder guide — expand with cost tables by project type and a budgeting worksheet.]</p>'],
        $cta('Want a real number for your project?', 'We scope a fixed range in a short discovery — before you commit.'),
    ],

    'cost-to-develop-a-mobile-app' => [
        ['type' => 'hero', 'eyebrow' => 'Guide',
            'title' => 'How much does it cost to develop an app?',
            'subtitle' => 'The honest version: what actually moves the price of a mobile app, and how to spend where it matters.',
            'primary' => $quote, 'secondary' => ['url' => '/services/mobile-app-development/', 'label' => 'Mobile app development']],
        ['type' => 'rich', 'theme' => 'white', 'eyebrow' => 'The cost drivers',
            'title' => 'Features, platforms, and backend',
            'body' => '<p>A focused app typically starts in the mid-five to low-six figures. Cost scales with feature complexity, whether you build native or cross-platform, and how much backend (auth, sync, payments, integrations) sits behind it.</p>'
                . '<ul><li>Cross-platform (React Native / Flutter) covers most products efficiently.</li><li>Native makes sense when the experience demands it.</li><li>The backend is often the real cost — plan for it.</li></ul>'
                . '<p>[Placeholder guide — expand with feature-by-feature cost ranges and an app-cost calculator.]</p>'],
        $cta('Scoping an app?', 'Tell us what it needs to do and we\'ll give you a fixed range.'),
    ],

    'build-vs-buy-ehr-software' => [
        ['type' => 'hero', 'eyebrow' => 'Guide',
            'title' => 'Build vs buy: EHR/EMR software',
            'subtitle' => 'When an off-the-shelf record system is enough, and when a custom build pays for itself. A decision framework.',
            'primary' => $quote, 'secondary' => ['url' => '/industries/healthcare-software-development/ehr-emr-software-development/', 'label' => 'EHR/EMR development']],
        ['type' => 'rich', 'theme' => 'white', 'eyebrow' => 'How to decide',
            'title' => 'Fit vs control vs cost',
            'body' => '<p>Buy when a standard system fits your specialty and workflows closely enough. Build (or build a custom layer on top of a system of record) when your workflows are your edge, or when off-the-shelf forces bad clinical processes.</p>'
                . '<ul><li>Buy: fastest to live, lowest upfront cost, least control.</li><li>Build: best fit and full ownership, higher upfront investment.</li><li>Hybrid: integrate a custom layer with an existing EHR — often the sweet spot.</li></ul>'
                . '<p>[Placeholder guide — expand with a scoring worksheet and TCO comparison.]</p>'],
        $cta('Weighing build vs buy?', 'We\'ll give you an honest read — including when not to build.'),
    ],

    // ══════════════════════════════════════════════════════════
    //  RESOURCES / LEAD MAGNETS  (/resources/)
    //  Unpublished on the client's request (markup #5): it advertised six
    //  downloads that were never produced. Kept here so the page can be
    //  restored once real assets exist — see the `magnet` section type.
    // ══════════════════════════════════════════════════════════
    'resources' => [
        ['type' => 'hero', 'eyebrow' => 'Resources',
            'title' => 'Guides, checklists, and tools for building software',
            'subtitle' => 'Practical resources from the team that ships. Grab what\'s useful — no fluff, no hard sell.',
            'primary' => $quote, 'secondary' => ['url' => '/blog/', 'label' => 'Read the blog']],
        ['type' => 'cards', 'theme' => 'white', 'eyebrow' => 'Downloads', 'title' => 'Free resources',
            'intro' => 'Placeholder — gated assets and downloads to be produced. Each links to the quote form for now.',
            'columns' => 3,
            'items' => [
                ['eyebrow' => 'PDF', 'title' => 'Healthcare Software Cost Guide', 'text' => 'What drives the price of a healthcare build — and how to budget.', 'url' => '/get-a-quote/'],
                ['eyebrow' => 'Checklist', 'title' => 'HIPAA Compliance Checklist', 'text' => 'The safeguards every healthcare software team needs to cover.', 'url' => '/get-a-quote/'],
                ['eyebrow' => 'Worksheet', 'title' => 'Build vs Buy EHR Worksheet', 'text' => 'Score your situation and get to a clear decision.', 'url' => '/get-a-quote/'],
                ['eyebrow' => 'Calculator', 'title' => 'Mobile App Cost Calculator', 'text' => 'Ballpark your app budget from features and platforms.', 'url' => '/get-a-quote/'],
                ['eyebrow' => 'Rate sheet', 'title' => 'Staff-Aug Skills & Rate Sheet', 'text' => 'Roles, seniority, and how augmentation is priced.', 'url' => '/get-a-quote/'],
                ['eyebrow' => 'Guides', 'title' => 'All comparison guides', 'text' => 'Staff-aug vs managed, offshore vs nearshore, build vs buy, and more.', 'url' => '/guides/staff-augmentation-vs-managed-services/'],
            ]],
        $cta('Want something tailored to your project?', 'Skip the download — tell us what you\'re building and we\'ll send specifics.'),
    ],

    ];
}
