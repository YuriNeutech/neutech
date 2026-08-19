<?php
/**
 * Block Name: FAQ Section
 */
if ( ! empty( $block['data']['_is_inserter_preview'] ) ) {
    neutech_block_preview( 'FAQ Section', 'Accordion of Q&A with FAQPage schema for rich results.' );
    return;
}

$eyebrow = get_field( 'eyebrow' );
$title   = get_field( 'title' );
$items   = get_field( 'items' ) ?: [];
if ( empty( $items ) ) { return; }

$className = 'lp-section lp-section--light lp-faq';
if ( ! empty( $block['className'] ) ) { $className .= ' ' . $block['className']; }
$id = ! empty( $block['anchor'] ) ? $block['anchor'] : '';

// FAQPage JSON-LD
$schema = [
    '@context'   => 'https://schema.org',
    '@type'      => 'FAQPage',
    'mainEntity' => array_map( function ( $it ) {
        return [
            '@type'          => 'Question',
            'name'           => wp_strip_all_tags( $it['question'] ?? '' ),
            'acceptedAnswer' => [ '@type' => 'Answer', 'text' => wp_strip_all_tags( $it['answer'] ?? '' ) ],
        ];
    }, $items ),
];
?>
<section <?php if ( $id ) echo 'id="' . esc_attr( $id ) . '"'; ?> class="<?= esc_attr( $className ); ?>">
    <div class="container">
        <div class="lp-head">
            <?php if ( $eyebrow ): ?><span class="lp-eyebrow"><?= esc_html( $eyebrow ); ?></span><?php endif; ?>
            <h2 class="lp-title"><?= esc_html( $title ?: 'Frequently asked questions' ); ?></h2>
        </div>
        <div class="lp-faq__list">
            <?php foreach ( $items as $it ): ?>
            <div class="lp-faq__item">
                <button class="lp-faq__q" type="button" aria-expanded="false">
                    <span><?= esc_html( $it['question'] ?? '' ); ?></span>
                    <span class="lp-faq__sign" aria-hidden="true"></span>
                </button>
                <div class="lp-faq__a"><p><?= esc_html( $it['answer'] ?? '' ); ?></p></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script type="application/ld+json"><?= wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?></script>
</section>
