import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

/**
 * Reveal animation for the reusable landing sections (.lp-*).
 * Matches the hero's feel: fade + rise + de-blur, staggered.
 * Elements are NOT hidden in CSS, so if JS never runs the page is fully visible.
 */
export default function initSectionReveal() {
    const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (reduced) return;

    const RISE = { y: 60, autoAlpha: 0, filter: "blur(8px)" };
    const SETTLE = { y: 0, autoAlpha: 1, filter: "blur(0px)", ease: "power3.out" };

    // ── Hero: reveal on load (once), no scroll trigger ──
    const hero = document.querySelector('.lp-hero');
    if (hero) {
        const bits = hero.querySelectorAll('.lp-hero__eyebrow, .lp-hero__title, .lp-hero__subtitle, .lp-hero__actions, .lp-hero__visual');
        gsap.fromTo(bits, RISE, { ...SETTLE, duration: 1.2, stagger: 0.12, ease: "back.out(1.2)" });

        // Ambient glow pulse + drifting particles (mirrors the original hero).
        const glow = hero.querySelector('.lp-hero__glow');
        if (glow) gsap.to(glow, { scale: 1.25, opacity: 0.55, duration: 3.5, repeat: -1, yoyo: true, ease: "sine.inOut" });
        hero.querySelectorAll('.hero__particle').forEach((p) => {
            gsap.to(p, {
                x: (Math.random() - 0.5) * 60,
                y: (Math.random() - 0.5) * 70,
                duration: 4 + Math.random() * 4,
                repeat: -1, yoyo: true, ease: "sine.inOut", delay: Math.random() * 2,
            });
        });
    }

    // ── Every other section: reveal its content on scroll-in ──
    document.querySelectorAll('.lp-section').forEach((section) => {
        const head = section.querySelector('.lp-head');
        const items = section.querySelectorAll(
            '.lp-cards__item, .lp-stats__item, .lp-faq__item, .lp-rich__body, .lp-cta__inner'
        );
        const targets = [head, ...items].filter(Boolean);
        if (!targets.length) return;

        gsap.fromTo(targets, RISE, {
            ...SETTLE,
            duration: 0.9,
            stagger: 0.08,
            scrollTrigger: {
                trigger: section,
                start: "top 82%",
                toggleActions: "play none none none",
                once: true,
            },
        });
    });
}
