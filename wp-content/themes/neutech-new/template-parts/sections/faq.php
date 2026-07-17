<?php
/**
 * FAQ accordion + FAQPage schema. $args: eyebrow, title, items[ [q,a] ]
 */
$a = $args ?? [];
$items = $a['items'] ?? [];
if (empty($items)) return;

// FAQPage JSON-LD
$schema = [
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => array_map(function ($it) {
        return [
            '@type' => 'Question',
            'name'  => wp_strip_all_tags($it['q']),
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => wp_strip_all_tags($it['a'])],
        ];
    }, $items),
];
?>
<section class="lp-section lp-section--light lp-faq">
    <div class="container">
        <div class="lp-head">
            <?php if (!empty($a['eyebrow'])): ?><span class="lp-eyebrow"><?= esc_html($a['eyebrow']); ?></span><?php endif; ?>
            <h2 class="lp-title"><?= esc_html($a['title'] ?? 'Frequently asked questions'); ?></h2>
        </div>
        <div class="lp-faq__list">
            <?php foreach ($items as $it): ?>
            <div class="lp-faq__item">
                <button class="lp-faq__q" type="button" aria-expanded="false">
                    <span><?= esc_html($it['q']); ?></span>
                    <span class="lp-faq__sign" aria-hidden="true"></span>
                </button>
                <div class="lp-faq__a"><p><?= esc_html($it['a']); ?></p></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script type="application/ld+json"><?= wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?></script>
</section>
<?php
// Accordion behaviour is handled globally by blocks/faq-section/script.js
// (loaded via app.js), which targets the same .lp-faq markup.
