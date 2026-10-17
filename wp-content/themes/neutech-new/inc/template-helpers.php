<?php
/**
 * Global template helpers for landing sections.
 */

if ( ! function_exists('neutech_button') ) {
    /**
     * Render a themed button matching the header CTA markup.
     *
     * @param string $url
     * @param string $label
     * @param string $variant 'accent' | 'white-border' | 'black-border'
     * @param string $target
     */
    function neutech_button($url, $label, $variant = 'accent', $target = '') {
        if ( empty($url) || empty($label) ) { return; }
        $cls = 'btn btn--theme-' . $variant . ' btn--cta-md relative';
        $tgt = $target ? ' target="' . esc_attr($target) . '"' : '';
        $icon = '';
        if ( $variant === 'accent' ) {
            $icon = '<span class="btn__icon-wr flex-center"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" width="24" height="24"><path d="m16 12 4 3 -8 7 -8 -7 4 -3" stroke-width="2"/><path d="M12 3 4 9l8 6 8 -6z" stroke-width="2"/><path d="M12 15h8" stroke-width="2"/></svg></span><span class="btn__glow absolute"></span>';
        }
        printf(
            '<a href="%s" class="%s"%s><span class="btn__text-wr">%s</span>%s</a>',
            esc_url($url), esc_attr($cls), $tgt, esc_html($label), $icon
        );
    }
}

if ( ! function_exists('neutech_link_button') ) {
    /**
     * Render a themed button from an ACF Link field array ([url,title,target]).
     *
     * @param array|null $link    ACF link value.
     * @param string     $variant 'accent' | 'white-border' | 'black-border'
     * @param string     $fallback_label Used when the link has a URL but no title.
     */
    function neutech_link_button($link, $variant = 'accent', $fallback_label = 'Learn more') {
        if ( empty($link) || empty($link['url']) ) { return; }
        $label  = ! empty($link['title']) ? $link['title'] : $fallback_label;
        $target = ! empty($link['target']) ? $link['target'] : '';
        neutech_button($link['url'], $label, $variant, $target);
    }
}

if ( ! function_exists('neutech_block_preview') ) {
    /**
     * Lightweight inline preview shown in the block inserter (avoids shipping a
     * PNG per block). Called from a block's render.php when _is_inserter_preview.
     */
    function neutech_block_preview($label, $desc = '') {
        printf(
            '<div style="border:1px solid #e2e2e6;border-left:4px solid #EF3F50;border-radius:8px;'
            . 'padding:14px 16px;background:#fafafa;font-family:system-ui,sans-serif;">'
            . '<strong style="display:block;color:#111;font-size:13px;letter-spacing:.02em;">%s</strong>'
            . '%s</div>',
            esc_html($label),
            $desc ? '<span style="display:block;margin-top:4px;color:#666;font-size:12px;line-height:1.4;">' . esc_html($desc) . '</span>' : ''
        );
    }
}

if ( ! function_exists('neutech_arrow_svg') ) {
    function neutech_arrow_svg() {
        return '<svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M5 12h14"/><path d="M13 6l6 6-6 6"/></svg>';
    }
}

if ( ! function_exists('neutech_logo_svg') ) {
    /**
     * The original "neutech." brand logo as inline SVG (assets/images/neutech-logo.svg).
     * Letters are 7 `.logo-text` vector paths + a `.logo-dot` path — the exact
     * typeface and dot proportions from the live neutech.co logo. Inlined (not an
     * <img>) so the preloader can animate the letters/dot and call getBBox on the dot.
     * Cached per-request.
     */
    function neutech_logo_svg() {
        static $svg = null;
        if ( $svg === null ) {
            $path = get_template_directory() . '/assets/images/neutech-logo.svg';
            $svg  = is_readable( $path ) ? trim( file_get_contents( $path ) ) : '';
        }
        return $svg;
    }
}

if ( ! function_exists('neutech_brandmark') ) {
    /**
     * Header/nav brand logo. Uses the original inline SVG logo; falls back to the
     * styled text wordmark only if the SVG asset is missing.
     */
    function neutech_brandmark() {
        $svg = neutech_logo_svg();
        if ( $svg !== '' ) {
            // Raw SVG sits directly in .header__logo (sized 13.3rem×3.2rem for it),
            // matching the original markup; .header svg .logo-text recolors the letters.
            return $svg;
        }
        return '<span class="brandmark">neutech<span class="brandmark__dot">.</span></span>';
    }
}

if ( ! function_exists('neutech_preloader_wordmark') ) {
    /**
     * Animated brand logo for the intro preloader. Uses the original inline SVG
     * (7 `.logo-text` letter paths staggered in + the `.logo-dot`). Falls back to
     * a text wordmark only if the SVG asset is missing.
     */
    function neutech_preloader_wordmark() {
        $svg = neutech_logo_svg();
        if ( $svg !== '' ) {
            return '<div class="preloader__wordmark" aria-label="neutech">' . $svg . '</div>';
        }
        $letters = str_split('neutech');
        $out = '<div class="preloader__wordmark" aria-label="neutech">';
        foreach ($letters as $l) {
            $out .= '<span class="logo-text">' . esc_html($l) . '</span>';
        }
        $out .= '<svg class="preloader__dot" viewBox="0 0 100 100" aria-hidden="true"><circle class="logo-dot" cx="50" cy="50" r="50" fill="#EF3F50"/></svg>';
        $out .= '</div>';
        return $out;
    }
}

/** One shared native loader for the site's forms. */
function neutech_tely_form_ready($connection) {
    if (!is_array($connection) || empty($connection['contextUrl'])
        || empty($connection['submissionsUrl']) || empty($connection['embedScriptUrl'])) return false;
    if (wp_script_is('neutech-native-forms', 'enqueued')) {
        $scripts = wp_scripts();
        return isset($scripts->registered['neutech-native-forms'])
            && $scripts->registered['neutech-native-forms']->src === $connection['embedScriptUrl'];
    }
    wp_enqueue_script('neutech-native-forms', $connection['embedScriptUrl'], [], null, true);
    return true;
}

/** Cached forms must not create a parallel intake store or send mail. */
add_action('wp_ajax_neutech_lead', 'neutech_handle_lead');
add_action('wp_ajax_nopriv_neutech_lead', 'neutech_handle_lead');
function neutech_handle_lead() {
    $magnet = sanitize_key($_POST['magnet'] ?? '');
    wp_send_json(['success' => false, 'error' => $magnet === '' ? 'quote_form_moved' : 'resource_form_moved', 'retryable' => false,
        'message' => 'This form has moved. Your answers are still on this page. Reload to use the current form, or email info@neutech.co.'], 409);
}
