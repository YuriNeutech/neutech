import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

export default function initCardsSection() {
    const sections = document.querySelectorAll('.cards');
    if (sections.length === 0) return;

    sections.forEach(section => {
        
        const titles = section.querySelectorAll('.cards__title');
        const cards = section.querySelectorAll('.cards__text-card');
        const arrows = section.querySelectorAll('.cards__arrow');
        const ticks = section.querySelectorAll('.text-card__icon');
        const button = section.querySelector('.cards__action-link');

        
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: section,
                start: "top 75%", 
                toggleActions: "play none none none",
                once: true
            },
            defaults: { ease: "power3.out" }
        });

        
        if (titles.length > 0) {
            tl.fromTo(titles,
                { y: 40, autoAlpha: 0, filter: "blur(6px)" },
                { y: 0, autoAlpha: 1, filter: "blur(0px)", duration: 1.2, stagger: 0.2, ease: "back.out(1.2)" }
            );
        }

        
        if (cards.length > 0) {
            tl.fromTo(cards,
                { y: 50, autoAlpha: 0 },
                { y: 0, autoAlpha: 1, duration: 1.2, stagger: 0.2, ease: "back.out(1.1)" },
                titles.length > 0 ? "-=0.8" : 0 
            );
        }

        
        if (arrows.length > 0) {
            
            gsap.set(arrows, { transformOrigin: "center center" });
            
            tl.fromTo(arrows,
                { scaleY: 0, autoAlpha: 0 },
                { scaleY: 1, autoAlpha: 1, duration: 0.6, stagger: 0.2, ease: "power2.out" },
                "-=1.2" 
            );
        }

        
        if (ticks.length > 0) {
            
            gsap.set(ticks, { transformOrigin: "center center" });

            tl.fromTo(ticks,
                { scale: 0, autoAlpha: 0 },
                { scale: 1, autoAlpha: 1, duration: 0.6, stagger: 0.2, ease: "back.out(2)" },
                "-=1" 
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