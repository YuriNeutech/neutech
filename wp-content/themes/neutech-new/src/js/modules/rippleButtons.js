import { gsap } from "gsap";

export default function initRippleButtons() {
    
    document.addEventListener('mouseover', (e) => {
        const btn = e.target.closest('[data-animate-ripple]');
        if (!btn) return;

        const rect = btn.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const size = Math.max(rect.width, rect.height) * 2.5;

        gsap.set(btn, {
            "--ripple-x": `${x}px`,
            "--ripple-y": `${y}px`,
            "--ripple-size": `${size}px`
        });

        gsap.to(btn, {
            "--ripple-scale": 1,
            duration: 0.6,
            ease: "power2.out",
            overwrite: true
        });
    });

    document.addEventListener('mouseout', (e) => {
        const btn = e.target.closest('[data-animate-ripple]');
        if (!btn) return;
        const relatedTarget = e.relatedTarget;
        if (btn.contains(relatedTarget)) return;

        gsap.to(btn, {
            "--ripple-scale": 0,
            duration: 0.4,
            ease: "power2.inOut",
            overwrite: true
        });
    });
}