import { gsap } from "gsap";

export default function initMagneticButton() {
    const buttons = document.querySelectorAll('.header__cta-btn, .footer__cta-btn, .blog-page__load-more');

    buttons.forEach(btn => {
        const icon = btn.querySelector('.btn__icon-wr');
        const text = btn.querySelector('.btn__text-wr');
        const glow = btn.querySelector('.btn__glow');
        const moveX = parseFloat(btn.dataset.movex) || 0.3;
        const moveY = parseFloat(btn.dataset.movey) || 0.3;

        // 1. РУХ МИШКИ ПО КНОПЦІ
        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;

            gsap.to(btn, {
                x: x * moveX,
                y: y * moveY,
                duration: 0.3,
                ease: "power2.out"
            });

            if (icon) {
                gsap.to(icon, {
                    x: x * 0.1, 
                    y: y * 0.1,
                    duration: 0.3
                });
            }

            if (text) {
                gsap.to(text, {
                    x: x * 0.05,
                    y: y * 0.05,
                    duration: 0.3
                });
            }

            if (glow) {
                 gsap.to(glow, {
                    x: x * 0.2,
                    y: (y * 0.2) + 5,
                    duration: 0.3
                });
            }
        });

        btn.addEventListener('mouseleave', () => {
            gsap.to(btn, {
                x: 0,
                y: 0,
                duration: 1,
                ease: "elastic.out(1, 0.3)"
            });

            if (icon) gsap.to(icon, { x: 0, y: 0, duration: 0.5 });
            if (text) gsap.to(text, { x: 0, y: 0, duration: 0.5 });
            if (glow) gsap.to(glow, { x: 0, y: 0, duration: 0.5 });
        });
    });
}