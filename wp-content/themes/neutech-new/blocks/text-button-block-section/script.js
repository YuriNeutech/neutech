import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

export default function initTextButtonSection() {
    const sections = document.querySelectorAll('.text-button');
    if (sections.length === 0) return;

    sections.forEach(section => {
        const container = section.querySelector('.text-button__container');
        if (!container) return;
        
        
        const elements = container.children;

        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: section,
                start: "top 75%", 
                toggleActions: "play none none none",
                once: true
            },
            defaults: { ease: "power3.out" }
        });

        
        
        tl.fromTo(container, 
            { y: 30, autoAlpha: 0 },
            { y: 0, autoAlpha: 1, duration: 1, ease: "power2.out" }
        );

        
        if (elements.length > 0) {
            tl.fromTo(elements,
                { 
                    y: 40, 
                    autoAlpha: 0, 
                    filter: "blur(6px)",
                    
                    scale: (index, target) => target.classList.contains('text-button__btn') ? 0.95 : 1
                },
                { 
                    y: 0, 
                    autoAlpha: 1, 
                    filter: "blur(0px)", 
                    scale: 1,
                    duration: 1.2, 
                    stagger: 0.15,
                    ease: "back.out(1.2)" 
                },
                "-=0.6" 
            );
        }
    });
}