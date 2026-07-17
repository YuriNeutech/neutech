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

        fetch(form.action, { method: 'POST', body: new FormData(form) })
            .then((r) => r.json().catch(() => ({ success: r.ok })))
            .then((res) => {
                if (res && res.success) {
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
