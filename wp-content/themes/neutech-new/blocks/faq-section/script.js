/**
 * FAQ accordion. Single delegated listener; animates max-height per panel.
 */
export default function initFaq() {
    const lists = document.querySelectorAll('.lp-faq');
    if (!lists.length) return;

    document.addEventListener('click', (e) => {
        const btn = e.target.closest('.lp-faq__q');
        if (!btn) return;

        const item = btn.closest('.lp-faq__item');
        const panel = item.querySelector('.lp-faq__a');
        const open = item.classList.toggle('is-open');

        btn.setAttribute('aria-expanded', open ? 'true' : 'false');
        panel.style.maxHeight = open ? panel.scrollHeight + 'px' : null;
    });
}
