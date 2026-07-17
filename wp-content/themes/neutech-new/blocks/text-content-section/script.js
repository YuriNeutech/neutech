import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

export default function initTextContentSection() {
    const sections = document.querySelectorAll('.text-content');
    if (sections.length === 0) return;

    sections.forEach(section => {
        
        const container = section.querySelector('.text-content__container');
        if (!container) return;
        
        
        const blocks = container.children;

        
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: section,
                start: "top 75%", 
                toggleActions: "play none none none",
                once: true
            },
            defaults: { ease: "power3.out" }
        });

        if (blocks.length > 0) {
            tl.fromTo(blocks,
                { 
                    y: 40, 
                    autoAlpha: 0, 
                    filter: "blur(6px)", 
                    
                    scale: (index, target) => target.classList.contains('text-content__btn') ? 0.95 : 1
                },
                { 
                    y: 0, 
                    autoAlpha: 1, 
                    filter: "blur(0px)", 
                    scale: 1,
                    duration: 1.2, 
                    stagger: 0.15, 
                    ease: "back.out(1.2)" 
                }
            );
        }
    });
}