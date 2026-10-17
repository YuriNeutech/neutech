/** Explain cached-form refusals; connected forms use the shared Tely loader. */
export default function initLeadForm() {
    const forms = document.querySelectorAll('.lp-form__form');
    if (!forms.length) return;

    document.addEventListener('submit', (e) => {
        const form = e.target.closest('.lp-form__form');
        if (!form || form.matches('[data-tely-cta="native"]')) return;
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
            .then((r) => r.json())
            .then((res) => {
                status.className = 'lp-form__status is-err';
                status.textContent = res && ['quote_form_moved', 'resource_form_moved'].includes(res.error)
                    ? res.message
                    : 'Something went wrong. Email us at info@neutech.co.';
            })
            .catch(() => {
                status.className = 'lp-form__status is-err';
                status.textContent = 'Something went wrong. Email us at info@neutech.co.';
            })
            .finally(() => { btn.disabled = false; });
    });
}
