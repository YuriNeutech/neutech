<?php
/**
 * Hero visual motifs — branded isometric line-art, one distinct animated
 * variant per top-level hub so every hero hero reads uniquely while staying
 * in the same wireframe/red design language as the homepage hero.
 *
 * Variants: 'stack' (services, layered lifecycle), 'cube' (industries, nested
 * depth), 'frame' (work, tiled modules). Unknown/empty falls back to 'stack'.
 */
if ( ! function_exists( 'neutech_hero_visual' ) ) {
    function neutech_hero_visual( $variant = 'stack' ) {
        $variant = in_array( $variant, [ 'stack', 'cube', 'frame' ], true ) ? $variant : 'stack';

        ob_start();
        ?>
        <div class="lp-hero__visual lp-hero__visual--<?= esc_attr( $variant ); ?>" aria-hidden="true">
        <?php if ( $variant === 'stack' ) : ?>
            <svg class="lp-hero__viz lp-hero__viz--stack" viewBox="0 0 440 460" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="lp-hero__edge" d="M65 150 L65 315" />
                <path class="lp-hero__edge" d="M375 150 L375 315" />
                <path class="lp-hero__edge" d="M220 224 L220 389" />
                <path class="lp-hero__plate lp-hero__plate--4" d="M220 241 L375 315 L220 389 L65 315 Z" />
                <path class="lp-hero__plate lp-hero__plate--3" d="M220 186 L375 260 L220 334 L65 260 Z" />
                <path class="lp-hero__plate lp-hero__plate--2" d="M220 131 L375 205 L220 279 L65 205 Z" />
                <path class="lp-hero__plate lp-hero__plate--1" d="M220 76 L375 150 L220 224 L65 150 Z" />
            </svg>
        <?php elseif ( $variant === 'cube' ) : ?>
            <svg class="lp-hero__viz lp-hero__viz--cube" viewBox="0 0 440 460" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g class="lp-hero__cube-outer">
                    <path class="lp-hero__edge" d="M70 180 L70 325" />
                    <path class="lp-hero__edge" d="M370 180 L370 325" />
                    <path class="lp-hero__edge" d="M220 265 L220 410" />
                    <path class="lp-hero__face lp-hero__face--side" d="M70 180 L220 265 L220 410 L70 325 Z" />
                    <path class="lp-hero__face lp-hero__face--side" d="M370 180 L220 265 L220 410 L370 325 Z" />
                    <path class="lp-hero__face lp-hero__face--top" d="M220 95 L370 180 L220 265 L70 180 Z" />
                </g>
                <g class="lp-hero__cube-inner">
                    <path class="lp-hero__edge" d="M151 219 L151 286" />
                    <path class="lp-hero__edge" d="M289 219 L289 286" />
                    <path class="lp-hero__edge" d="M220 258 L220 325" />
                    <path class="lp-hero__face lp-hero__face--side" d="M151 219 L220 258 L220 325 L151 286 Z" />
                    <path class="lp-hero__face lp-hero__face--side" d="M289 219 L220 258 L220 325 L289 286 Z" />
                    <path class="lp-hero__face lp-hero__face--core" d="M220 180 L289 219 L220 258 L151 219 Z" />
                </g>
            </svg>
        <?php else : ?>
            <svg class="lp-hero__viz lp-hero__viz--frame" viewBox="0 0 440 460" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="lp-hero__tile lp-hero__tile--1" d="M220 110 L295 172.5 L220 235 L145 172.5 Z" />
                <path class="lp-hero__tile lp-hero__tile--2" d="M295 172.5 L370 235 L295 297.5 L220 235 Z" />
                <path class="lp-hero__tile lp-hero__tile--3" d="M145 172.5 L220 235 L145 297.5 L70 235 Z" />
                <path class="lp-hero__tile lp-hero__tile--4" d="M220 235 L295 297.5 L220 360 L145 297.5 Z" />
                <path class="lp-hero__frame-outline" d="M220 110 L370 235 L220 360 L70 235 Z" />
            </svg>
        <?php endif; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}
