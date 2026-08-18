/**
 * Async lead form. Posts to admin-ajax and reports status inline.
 */
export default function initLeadForm() {
    const forms = document.querySelectorAll('.lp-form__form');
    if (!forms.length) return;

    document.addEventListener('submit', (e) => {
        const form = e.target.closest('.lp-form__form');
        if (!form) return;
        e.preventDefault();

        const status = form.querySelector('.lp-form__status');
        const btn = form.querySelector('button[type="submit"]');
        const email = form.querySelector('[name="email"]');

        if (email && !email.checkValidity()) {
            status.className = 'lp-form__status is-err';
            status.textContent = 'Please enter a valid work email.';
            email.focus();
            return;
        }

        btn.disabled = true;
        status.className = 'lp-form__status';
        status.textContent = 'Sending…';

        // NB: `form.action` resolves to the hidden <input name="action">, not the
        // form's URL (DOM clobbering), so read the attribute explicitly.
        const endpoint = form.getAttribute('action');

        fetch(endpoint, { method: 'POST', body: new FormData(form) })
            .then((r) => r.json().catch(() => ({ success: r.ok })))
            .then((res) => {
                if (res && res.success && res.file) {
                    // Gated download: hand the file over immediately, and leave a
                    // visible link in case the browser blocks the programmatic open.
                    form.reset();
                    status.className = 'lp-form__status is-ok';
                    status.innerHTML =
                        'Thanks — your guide is downloading. ' +
                        '<a href="' + res.file + '" target="_blank" rel="noopener">Download again</a>.';
                    window.open(res.file, '_blank', 'noopener');
                } else if (res && res.success) {
                    form.reset();
                    status.className = 'lp-form__status is-ok';
                    status.textContent = "Thanks — we'll be in touch within one business day.";
                } else {
                    status.className = 'lp-form__status is-err';
                    status.textContent = 'Something went wrong. Email us at info@neutech.co.';
                }
            })
            .catch(() => {
                status.className = 'lp-form__status is-err';
                status.textContent = 'Something went wrong. Email us at info@neutech.co.';
            })
            .finally(() => { btn.disabled = false; });
    });
}
