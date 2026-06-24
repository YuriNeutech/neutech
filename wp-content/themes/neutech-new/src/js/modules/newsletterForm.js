import { gsap } from "gsap";

export default async function initNewsletterForm() {
    const section = document.querySelector('.blog-newsletter');
    const customForm = section?.querySelector('.blog-newsletter__form');
    const successMsg = section?.querySelector('.blog-newsletter__success');

    const elementsToHide = section?.querySelectorAll('.blog-newsletter__title, .blog-newsletter__text, .blog-newsletter__form');

    if (!customForm || !successMsg) return;

    customForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const emailInput = customForm.querySelector('#email');
        const submitBtn = customForm.querySelector('button');
        const btnText = submitBtn?.querySelector('span');

        gsap.to(submitBtn, { opacity: 0.5, pointerEvents: 'none', duration: 0.3 });
        if (btnText) btnText.textContent = 'Sending...';

        try {
            const response = await fetch('/wp-json/cleantheme/v1/subscribe', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email: emailInput.value })
            });

            const data = await response.json();

            if (response.ok) {
                showSuccessState(elementsToHide, successMsg);
            } else {
                throw new Error(data.message || 'Server error');
            }
        } catch (error) {
            console.error('Subscription Error:', error);
            gsap.to(submitBtn, { opacity: 1, pointerEvents: 'all', duration: 0.3 });
            
            if (btnText) {
                btnText.textContent = 'Try again'; 
            }
        }
    });
}
function showSuccessState(toHide, successEl) {
    const tl = gsap.timeline();
    tl.to(toHide, {
        opacity: 0,
        y: -20,
        duration: 0.5,
        stagger: 0.1,
        ease: "power2.in",
        onComplete: () => {
            toHide.forEach(el => el.style.display = 'none');
        }
    });

    tl.set(successEl, { 
        display: 'block', 
        opacity: 0, 
        y: 20 
    });

    tl.to(successEl, {
        opacity: 1,
        y: 0,
        duration: 0.6,
        ease: "back.out(1.7)"
    });
}