import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

export default function initFeaturesGridSection() {
    const sections = document.querySelectorAll('.features-grid');
    if (sections.length === 0) return;

    sections.forEach(section => {
        
        const title = section.querySelector('.features-grid__heading .features-grid__title');
        const subtitle = section.querySelector('.features-grid__heading .features-grid__subtitle');
        
        
        const cards = section.querySelectorAll('.features-grid__card');
        const button = section.querySelector('.features-grid__action-link');

        
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: section,
                start: "top 75%", 
                toggleActions: "play none none none",
                once: true
            },
            defaults: { ease: "power3.out" }
        });

        
        if (title) {
            tl.fromTo(title,
                { y: 40, autoAlpha: 0, filter: "blur(6px)" },
                { y: 0, autoAlpha: 1, filter: "blur(0px)", duration: 1.2, ease: "back.out(1.2)" }
            );
        }

        
        if (subtitle) {
            tl.fromTo(subtitle,
                { y: 30, autoAlpha: 0, filter: "blur(4px)" }, 
                { y: 0, autoAlpha: 1, filter: "blur(0px)", duration: 1 },
                title ? "-=0.8" : 0 
            );
        }

        
        if (cards.length > 0) {
            tl.fromTo(cards,
                { y: 50, autoAlpha: 0, filter: "blur(5px)" }, 
                { 
                    y: 0, 
                    autoAlpha: 1, 
                    filter: "blur(0px)", 
                    duration: 1.2, 
                    stagger: 0.15, 
                    ease: "back.out(1.1)" 
                },
                (title || subtitle) ? "-=0.8" : 0
            );
        }

        
        if (button) {
            tl.fromTo(button,
                { y: 20, autoAlpha: 0, scale: 0.95 },
                { y: 0, autoAlpha: 1, scale: 1, duration: 1, ease: "back.out(1.5)" },
                "-=0.6" 
            );
        }
    });
}